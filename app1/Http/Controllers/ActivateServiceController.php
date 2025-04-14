<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use App\ActivateService;
use Sentinel;

class ActivateServiceController extends Controller
{
    //
    public function index()
    {
    $data=ActivateService::all();
    if(Sentinel::getUser()->inRole('super_admin')):
     return view("activate_service.index",compact("data"));
    else:
     return response()->view('error.404', [], 404);
    endif;
    }
    public function activation_data(Request $request)
    {
     $data=ActivateService::find($request->id);
     $data->activation=$request->activation;
     $data->save();
     echo "success";
    }
}