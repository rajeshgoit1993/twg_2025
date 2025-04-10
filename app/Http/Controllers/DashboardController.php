<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use App\RoomBooking;
use App\Query;

class DashboardController extends Controller
{
	public function dashboard(){
	$all_RoomBooking = RoomBooking::orderBy('id', 'desc')->get();
	 $queries = Query::where([["webnotation","=",env("WEBSITENAME")],['delete_status','=',1]])
               ->where(function ($queries) {
               $queries->whereIn('status', ['interested','not_interested','call_later','phone_not_reachable','wrong_number','destination_changed'])
               ->orWhereNull('status');
               })
               ->orderBy('created_at', 'desc')
               ->get();
	//$all_RoomBooking = RoomBooking::select('cca_order_id')->distinct()->get();
	//dd($all_RoomBooking);
		return view('admin.dasboard',['RoomBookings'=>$all_RoomBooking,'queries'=>$queries]);
	}
	
	public function view($id)
    {
		$RoomBookingSingle = RoomBooking::find($id);
		return view('admin.singleBookingDetail',['bookingDetail'=>$RoomBookingSingle]);
	}
}