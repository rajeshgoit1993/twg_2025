<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "rt_rooms";
    protected $fillable = ['assignedHotelname'];
}
