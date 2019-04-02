<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use App\Flights_Booking;
use App\Airways;
use App\Cities;
use App\Passengers;
use App\Http\Requests\UserRequest;
use App\Http\Requests\FlightRequest;

class UserController extends Controller
{
    public function getEdit()
    {
        return View('front-end.edit-user');
    }

    // sửa thông tin của user
    public function postEdit(UserRequest $res)
    {
        $email    = $res->email;
        $name     = $res->name;
        $password = $res->password;
        $newpass  = Hash::make($password);
        $phone    = $res->phone;
        $gender   = $res->gender;
        $bird     = $res->bird;
        $address  = $res->address;

        $mess = "Cập nhật thành công";
        if($password == "") {
           $sql = User::updateUser($email, $name, $phone,  $gender, $bird, $address);
        }
        else {
            $sql = User::updateUser_2($email, $name, $newpass, $phone,  $gender, $bird, $address);           
        }

        return redirect('getEdit')->with('status', $mess);
    }

    // sửa thông tin passenger
    public function postEditPassenger(Request $res){
        $passenger_id    = $res->passenger_id;
        $passenger_title = $res->passenger_title;
        $firstName       = $res->firstName;
        $lastName        = $res->lastName;
        Passengers::postEditPassenger($passenger_id, $passenger_title, $firstName, $lastName);

        $mess = "Cập nhât thành công!";
        return redirect('getPassenger/'.$passenger_id)->with('status', $mess);
    }

    // hiển thị thông tin passenger theo id
    public function getPassenger($idPassenger)
    {
        $sql = Passengers::getPassenger($idPassenger);
        return view('front-end.form-edit-passenger', ['passenger' => $sql]);
    }

    // xem chi tiết vé đã đặt
    public function getDetailBook()
    {
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
        }

        $flight = Flights_Booking::getBookByIdDe($user_id);
            $data['get_city_from'] = Cities::getNameCityTo($flight->flight_city_from_id);
            $data['get_city_to'] = Cities::getNameCityFrom($flight->flight_city_to_id);
            $data['get_airline'] = Airways::getAirlineName($flight->airways_id);
            // kiểm tra data chưa đăng vé   
        
            // lấy passenger đã đặt trong chuyến bay
        $passenger = Passengers::getPassengerById($flight->user_id, $flight->fb_flight_id);
        
        return view('front-end.flight-view-book', ['flight'    => $flight,
                                                   'data'      =>$data,
                                                   'passenger' => $passenger]);
    }

    // quản lý các vé đã đặt
    public function getViewBook()
    {
        if(Auth::check())
        {
            // lấy user_id đang đăng nhập
            $user_id = Auth::user()->id;

            // lấy các chuyến bay mà user đã đặt
            $sql = Flights_Booking::getBookById($user_id);

            if(isset($sql)){
                foreach($sql as $row) {
                    $data['get_city_from'] = Cities::getNameCityFrom($row->flight_city_from_id);
                    $data['get_city_to']   = Cities::getNameCityTo($row->flight_city_to_id);
                }  
            }
            if(empty($data)){
                return redirect()->route('/');
            }

            return View('front-end.flight-user-book', ['flight' => $sql,
                                                        'data'  => $data]);
        }

    }

    // hủy vé đã đặt
    public function deleteBooked($id)
    {
        $sql = Flights_Booking::deleteBookById($id);
        $mess = "Xóa vé bay thành công!";
        return redirect()->route('viewBook')->with('status', $mess);
    }
}
