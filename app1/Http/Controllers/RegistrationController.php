<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class RegistrationController extends Controller
{
    public function register(){
    	return view('authentication.register');
    }
    public function postRegister(Request $request){
    	$this->validate($request, [
           'email' => 'required|email|unique:users',
           'first_name' => 'required',
           'last_name' => 'required',
           'location' => 'required',
           'password' => 'required',
           'password_confirmation' => 'required|same:password'
       ]);
    	$user= Sentinel::registerAndActivate($request->all());
      $role = Sentinel::findRoleBySlug('guest');
      $role->users()->attach($user);
    	return redirect('/login');
    }
}