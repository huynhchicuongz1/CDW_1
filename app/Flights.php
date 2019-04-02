<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flights extends Model
{
    protected $table = 'flights';
    protected $fillable = ['flight_id', 'airway_id', 'flight_time_from', 'flight_time_to', 'flight_city_from_id',
     'flight_city_to_id', 'flight_transit', 'flight_direction', 'flight_price'];

    // relationship
    public function city_from()
    {
        return $this->hasOne('App\Cities', 'city_id' , 'flight_city_from_id');
    }

    public function city_to()
    {
        return $this->hasOne('App\Cities', 'city_id' , 'flight_city_to_id');
    }

    public function airport_city_from()
    {
        return $this->hasOne('App\Airports', 'airport_city_id' , 'flight_city_from_id');
    }

    public function airport_city_to()
    {
        return $this->hasOne('App\Airports', 'airport_city_id' , 'flight_city_to_id');
    }

     // get flight by id
    public static function getFlightById($flight_id)
    {
        return Flights::where('flight_id', $flight_id)
                        ->leftjoin('airways', 'airways.airways_id', 'flights.airways_id')
                        ->get();
    }

    // get search flight
    public static function getSearchFlight($from_city_id, $to_city_id)
    {
        return Flights::where([
                                ['flight_city_from_id','=', $from_city_id],
                                ['flight_city_to_id'  ,'=', $to_city_id]
                                ])
                        ->leftjoin('airways', 'airways.airways_id', 'flights.airways_id')
                        // ->where('flight_seat' , '<' , 10)
                        ->get();
    }

    public static function getTransit($parent_id)
    {
       return Flights::Where('flight_id', $parent_id)
                      ->leftjoin('airways', 'airways.airways_id', 'flights.airways_id')
                      ->first();
    }
}
