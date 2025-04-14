<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{

    protected $fillable = ['user_id', 'phone_no', 'dob', 'address', 'city', 'zipcode', 'country', 'streetname'  , 'state' , 'about' , 'profile_image'];
    protected $table = "users_details";
}
