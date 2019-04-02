<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'list_cities';
    protected $fillable = ['city_id', 'city_name', 'city_code'];
    public $timestamps = false;

    // realationship 
    public function flight_list_city()
    {
        return $this->belongsTo('App\Flights');
    }

    // quan hệ 3 ngôi
    // public function airports() {
    //     return $this->hasManyThrough('App\Airports', 'App\Flights' , 'flight_city_from_id' ,'airport_city_id', 'city_id');
    // }


    public function getCityById($city_id) {
        $sql = $this->where('city_id', '=' , $city_id)->get();
        return $sql;
    }

    public static function getNameCityFrom($from)
    {
        return Cities::where('city_id', $from)->first();
    }

    public static function getListCity()
    {
        return Cities::all();
    }

    public static function getNameCityTo($to)
    {
        return Cities::where('city_id', $to)->first();
    }

    //a. load thành phố theo quốc gia
    public static function getCityByCountryID($id)
    {
        return Cities::where('city_country_id', $id)->get();
    }

    
}
