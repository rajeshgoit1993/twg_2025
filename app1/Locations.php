<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = "rt_locations";

    public function country_list()
    {
        return $this->belongsTo(countries::class,'country');
    }

    public function state_list()
    {
        return $this->belongsTo(State::class,'state');
    }

    public function city_list()
    {
        return $this->belongsTo(City::class,'location');
    }
}
