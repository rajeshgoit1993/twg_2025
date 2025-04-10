<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use App\ShortUrl;
use Sentinel;
use App\Helpers\CustomHelpers;
use DB;
use App\ActivateService;
use App\ShortUrlTracking;
use URL;

class ShorturlController extends Controller
{
	public function index() {
		$data=ShortUrl::all();
		return view("short_urls.index",compact("data"));
	}
	
	public function create() {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
			if(Sentinel::check()):
			if(Sentinel::getUser()->inRole('administrator') || 
				Sentinel::getUser()->inRole('supervisor') || 
				Sentinel::getUser()->inRole('super_admin')):
				return view("short_urls.create");
			else:
				return redirect("/");
			endif;
			endif;
		else:
			return response()->view('error.404', [], 404);
		endif;
	}
	
	public function store_short_urls(Request $request) {
		$this->validate($request,[
			"long_url"=>"required",
			]);
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code=substr(str_shuffle(str_repeat($pool, 5)), 0, 7);
		$data=new ShortUrl;
		$data->url_domain=$request->url_domain;
		$data->url_title=$request->url_title;
		$data->url_app=$request->url_app;
		$data->url_device=$request->url_device;
		$data->hits='0';
		$data->url_tags=$request->url_tags;
		$data->long_url=$request->long_url;
		$data->short_code='s/'.$code;
		$data->save();
		return redirect ('/Short-URLs');
	}

	public function edit_short_url($id) {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
			if(Sentinel::check()):
			if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
				$data=ShortUrl::find($id);
				return view("short_urls.edit_short_url" , compact("data"));
			else:
				return redirect("/");
			endif;
			endif;
		else:
			return response()->view('error.404', [], 404);
		endif;
	}
	
	public function update_short_url($id, Request $request) {
		$this->validate($request,[
			"long_url"=>"required",
			]);
		$data=ShortUrl::find($id);
		$data->url_domain=$request->url_domain;
		$data->url_title=$request->url_title;
		$data->url_app=$request->url_app;
		$data->url_device=$request->url_device;
		$data->hits='0';
		$data->url_tags=$request->url_tags;
		$data->long_url=$request->long_url;
		$data->save();
		return redirect ('/Short-URLs');
	}
	
	public function delete_short_url($id) {
		$data=ShortUrl::find($id);
		if($data):
			ShortUrl::destroy($id);
			return redirect ('/Short-URLs');
		else:
			return redirect ('/Short-URLs');
		endif;
	}
	
	public function get_url($id) {
		$find = ShortUrl::where('short_code','s/'.$id)->first();
		$system_id=$_SERVER['REMOTE_ADDR'];
		$check_data=ShortUrlTracking::where([['system_ip','=',$system_id],['short_url_id','=',$find->id]])->first();
		if($check_data=='') {
			$data= new ShortUrlTracking;
			$data->system_ip=$system_id;
			$data->short_url_id=$find->id;
			$data->save();
			}
		return redirect($find->long_url);
		}
}