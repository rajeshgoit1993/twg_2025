<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Sentinel;
use Validator;
use App\User;
use App\UserDetails;
use App\Packages;
use App\RoomBooking;
use App\Mid_Image;
use App\Testimonial;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Illuminate\Support\Facades\DB;
use App\Helpers\CustomHelpers;
use Mail;
use Hash;
use Reminder;
use Activation;
use App\Option1Quotation;
use App\Option2Quotation;
use App\Option3Quotation;
use App\Option4Quotation;
use App\Query;
use App\QueryLeadTraveller;
use App\QueryLeadTravellerInfo;
use App\QueryTraveller;
use App\Passengerinfo;
use Session;
use Laravel\Socialite\Facades\Socialite;


class HomeController extends Controller
{
	public function showImage() {
	    $imagePath = public_path('images/example.jpg'); // Adjust the path as needed
	    $base64Image = YourClassName::get_base64_image($imagePath); 

	    return view('display-image', ['base64Image' => $base64Image]);
	}
}