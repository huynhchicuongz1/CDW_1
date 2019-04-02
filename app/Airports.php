<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airports extends Model
{
    protected $table = 'airports';
    protected $fillable = ['airport_id', 'airport_name', 'airport_code', 'airport_city_id', 'airport_province_id'];

     //a. load sân bay theo tỉnh
     public static function getAirportByID($id)
     {
         return Airports::where('airport_province_id', $id)->get();
     }
}
