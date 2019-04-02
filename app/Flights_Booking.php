<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flights_Booking extends Model
{
    protected $table = 'flights_booking';
    protected $fillable = ['booking_id', 'user_id', 'fb_flight_id',
    'total_price', 'Payment_Method', 'card_number', 'card_name', 'ccv_code'];

    // relationship
    public function flights()
    {
        return $this->hasOne('App\Flights', 'fb_flight_id' , 'flight_id');
    }

    public function city_from()
    {
        return $this->hasOne('App\Cities', 'city_id' , 'flight_city_from_id');
    }

    public function city_to()
    {
        return $this->hasOne('App\Cities', 'city_id' , 'flight_city_to_id');
    }


    public static function getBookById($user_id)
    {
        $sql = Flights_Booking::
        leftjoin('flights', 'flights.flight_id', '=', 'flights_booking.fb_flight_id')->
        join('airways', 'airways.airways_id' , 'flights.airways_id')
        ->where('flights_booking.user_id', $user_id)->get();
        return $sql;
    }

    public static function getBookByIdDe($user_id)
    {
        $sql = Flights_Booking::
        leftjoin('flights', 'flights.flight_id', '=', 'flights_booking.fb_flight_id')->
        join('airways', 'airways.airways_id' , 'flights.airways_id')
        ->where('flights_booking.user_id', $user_id)->first();
        return $sql;
    }

    public static function deleteBookById($id) {
        return Flights_Booking::Where('booking_id', $id)->delete();
    }
}
