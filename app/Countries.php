<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';
    protected $fillable = ['country_id', 'country_name', 'country_coop'];

    public static function getCountryCoopByID($id)
    {
        return Countries::Where('country_id', $id)->first();
    }
}
