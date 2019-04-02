<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinces;
use App\Airways;
use App\Countries;
use App\Airports;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

      //a. load các sân bay theo tỉnh
      public function loadAirport($id)
      {
          $airport = Airports::getAirportByID($id);
          return response()->json($airport);
         
      }


    public function index()
    {
        return view('front-end.index');
    }

    // hiển thị danh sách các sân bay theo tỉnh
    public function getListAirport()
    {
        $sql = Provinces::get();

        return view('front-end.airport', ['sql' => $sql]);
    }

    // hiển thị danh sách các hãng bay theo nước
    public function listAirline()
    {
        $sql = Countries::
        leftjoin('airways', 'airways.airway_country_id', '=', 'countries.country_id')
        ->get();
        return view('front-end.airline', ['sql' => $sql]);
    }

    
}
