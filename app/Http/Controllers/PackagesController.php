<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Sentinel;
use Validator;
use App\Packages;
use App\PackageUploads;
use App\Theme;
use App\Icons;
use App\PackageHotel;
use Illuminate\Support\Facades\DB;

class PackagesController extends Controller
{
	public function index($id,Request $request) {
		$theme_name=explode("-", $id)[0];
		$packagesH=DB::table('rt_packages')->where([['package_category', 'like','%' . $theme_name . '%'],['status', '=', '1'],])->inRandomOrder()->limit(6)->get();
		// $theme_data=DB::table('theme_data')->where([['theme_name', 'like','%' . $theme_name . '%'],])->get();
		$theme_data=DB::table('theme_data')->where('theme_name','=',$theme_name)->first();
		
		return view('packages.packagetheme',['packagesH'=>$packagesH,
		                          'theme_name'=>$theme_name,
		                          'theme_data'=>$theme_data
		                           ]);
		}
	public function PackageInfo($id) {
		$data = Crypt::decrypt($id);
		$Packages = Packages::findOrFail($data['id']);
		$id=$Packages->id;
		if($Packages->onrequest == 1){
			$price = false;
			}
		else {
			$price = unserialize($Packages->pricing);
			}
		$images = PackageUploads::all()->where('package_id',$data['id']);
		$daywise = unserialize($Packages->day_itinerary);
        $city = unserialize($Packages->city);
        $country = unserialize($Packages->country);
        $continent = unserialize($Packages->continent);
        $state = unserialize($Packages->state);
        $icon_data = Icons::all();
        $hoteldata = PackageHotel::all();
		return view('packages.pagethree',['details'=>$Packages,
										'price'=>$price,
										'images'=>$images,
										'daywise'=>$daywise,
									    'city'=>$city,
									    'country'=>$country,
									    'continent'=>$continent,
									    'state'=>$state,
									    'id'=>$data,
									    'hoteldata'=>$hoteldata,
									    'icon_data'=>$icon_data,
									    'id'=>$id]);
		}
}