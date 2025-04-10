<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Sentinel;
use Validator;
class FlightsController extends Controller
{
	public function index(){
	// return view('flights.index');
     return redirect()->away('https://flights.theworldgateway.com/');
	}
}