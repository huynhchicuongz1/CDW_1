<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airways extends Model
{
    protected $table = 'airways';
    protected $fillable = ['airways_id', 'airways_name', 'airway_country_id'];
    public $timestamps = false;


    public static function getAirlineName($id)
    {
        return Airways::where('airways_id', $id)->first();
    }

    public static function getAirlineByCountryID($id)
    {
        return Airways::where('airway_country_id', $id)->get();
    }

    // update doanh thu
    public static function updateRevanue($airway_id, $fl_price)
    {
        return Airways::where('airways_id' , $airway_id)
                    ->update(['airways_total_revanue'     => $fl_price]);
    }

}
