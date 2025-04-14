<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use App\rates;
use App\Transport;
Use App\PkgTours;
Use App\Icons;
use App\countries;
use App\State;
use App\City;
use App\Mid_Image;
use App\Testimonial;
use App\Theme;
use App\Pkgtype;
use App\Newsletter;
use Session;
use Illuminate\Support\Facades\DB;
use Image;
use Sentinel;
use Validator;
use App\ActivateService;
use App\TestimonialImage;
use Datatables;
use App\QuoteCharges;
use App\QuoteChargesDynamicData;
use App\Helpers\CustomHelpers;
use Redirect;
use DateTime;

class RateController extends Controller
{
    //
    public function index()
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
       if($check_data_settings->activation==1):
    	$data=rates::all();
        $data_transport=Transport::all();
        $data_icons=Icons::all();
        $data_quote_taxes=QuoteCharges::whereIn('charges_type',['GST','TCS','PG'])->get();
        $data_quote_discounts=QuoteCharges::whereIn('charges_type',['Markup Profit','Discount (+)','Discount (-)'])->get();
    	return view("rates.index",compact('data','data_transport','data_icons','data_quote_taxes','data_quote_discounts'));
      else:
       return response()->view('error.404', [], 404);
      endif;
    }


    public function create()
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
     if($check_data_settings->activation==1):
       if(Sentinel::check()):
       if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
    	return view("rates.insert");
        else:
        return redirect("/");
        endif;
        endif;
        else:
        return response()->view('error.404', [], 404);
        endif;
    }


    public function store_rate(Request $request)
    {
     $this->validate($request,[
      "currency"=>"required|Alpha",
      "rate"    =>"required|numeric",
     ]);

     $rate=new rates;
     $rate->currency=$request->currency;
     $rate->rate=$request->rate;
     $rate->save();
      return redirect ('/rate');
    }

    public function edit_rates($id , Request $request)
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
      if($check_data_settings->activation==1):
      if(Sentinel::check()):
       if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
     if(rates::find($id)):
        $data=rates::find($id);
        //dd($data);
        return view("rates.edit",compact("data"));
     else:
         return redirect ('/rate');
     endif;
        else:
        return redirect("/");
        endif;
        endif;
        else:
           return response()->view('error.404', [], 404);
        endif;
    }

    public function update_rate($id,Request $request)
    {
        $this->validate($request,[
        "currency"=>"required|Alpha",
        "rate"    =>"required|numeric",
         ]);
        $data=rates::find($id);
        if($data):
            $data->currency=$request->currency;
            $data->rate=$request->rate;
            $data->save();
            return redirect ('/rate');
        else:
            return redirect ('/rate');
        endif;
    }

    public function delete_rates($id,Request $request)
    {
        $data=rates::find($id);
        if($data):
        rates::destroy($id);
         return redirect ('/rate');
        else:
           return redirect ('/rate');
        endif;
    }

    // Tour Discounts
    public function create_tour_discounts() {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
		return view("rates.create_tour_discounts");
		else:
		return response()->view('error.404', [], 404);
		endif;
	}

	public function store_tour_discounts(Request $request) {
		$this->validate($request,[
		"charges_type"=>"required",
		"name"=>"required",
		"value"=>"required",
		]);
		$data=new QuoteCharges;
		$data->charges_type=$request->charges_type;
		$data->name=$request->name;
		$data->value=$request->value;
		$data->status=$request->status;
		$data->save();
		return redirect ('/rate');
	}

	public function edit_quotediscounts($id , Request $request) 
    {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
			if(QuoteCharges::find($id)):
				$data=QuoteCharges::find($id);
				//dd($data);
				return view("rates.edit_quotediscounts",compact("data"));
			else:
				return redirect ('/rate');
			endif;
		else:
			return response()->view('error.404', [], 404);
		endif;
	}

	public function update_quotediscounts($id,Request $request) 
    {
		$this->validate($request,[
		"charges_type"=>"required",
		"name"=>"required",
		"value"=>"required",
		]);
		$data=QuoteCharges::find($id);
		if($data):
			$data->charges_type=$request->charges_type;
			$data->name=$request->name;
			$data->value=$request->value;
			$data->status=$request->status;
			$data->save();
			return redirect ('/rate');
		else:
			return redirect ('/rate');
		endif;
	}

	public function delete_quotediscounts($id,Request $request) 
    {
		$data=QuoteCharges::find($id);
		if($data):
			QuoteCharges::destroy($id);
			return redirect ('/rate');
		else:
			return redirect ('/rate');
		endif;
	}
		
    //Tour Taxes
    public function create_quote_charge() 
    {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
		return view("rates.insert_quote_charge");
		else:
		return response()->view('error.404', [], 404);
		endif;
	}

	public function store_quote_charge(Request $request) 
    {
		$this->validate($request,[
		"charges_type"=>"required",
		"name"=>"required",
		"value"=>"required",
		]);
        $incoming_date=$request->valid_from_date;
        $date = DateTime::createFromFormat('d/m/Y', $incoming_date);
        $valid_date = $date->format('Y-m-d');
        if(strtotime($valid_date))
        {

        $data=new QuoteCharges;
		$data->charges_type=$request->charges_type;
		$data->name=$request->name;
		$data->value=$request->value;
		$data->status=$request->status;
		
		if($data->save())
		{
        $quote_charge_id=$data->id;
        $valid_date_in_format=date('Y-m-d', strtotime($valid_date));
        $valid_date_in_strtotime=strtotime($valid_date_in_format);
        $data_in_date=new QuoteChargesDynamicData;
        $data_in_date->quote_charges_id=$quote_charge_id;
        $data_in_date->value=$request->value;
        $data_in_date->valid_from_date=$valid_date_in_format;
        $data_in_date->valid_from_date_tmestamp=$valid_date_in_strtotime;
        $data_in_date->save();
        }
		return redirect ('/rate');
        }
        else
        {
        return Redirect::back()->with('error','select valid date');
        }
	}

	public function edit_quotecharge($id , Request $request) 
    {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
			if(QuoteCharges::find($id)):
				$data=QuoteCharges::find($id);
				//dd($data);
				return view("rates.edit_quote_charge",compact("data"));
			else:
				return redirect ('/rate');
			endif;
		else:
			return response()->view('error.404', [], 404);
		endif;
	}

	public function update_quotecharge($id,Request $request) 
    {
		$this->validate($request,[
		"charges_type"=>"required",
		"name"=>"required",
		"value"=>"required",
		]);
		$data=QuoteCharges::find($id);
		if($data):
			$data->charges_type=$request->charges_type;
			$data->name=$request->name;
			$data->value=$request->value;
			$data->status=$request->status;
			$data->save();
			return redirect ('/rate');
		else:
			return redirect ('/rate');
		endif;
	}

	public function delete_quotecharge($id,Request $request) {
		$data=QuoteCharges::find($id);
		if($data):
			QuoteCharges::destroy($id);
			return redirect ('/rate');
		else:
			return redirect ('/rate');
		endif;
	}

	public function addvalidfrom($id , Request $request) {
		$data_history=QuoteChargesDynamicData::where('quote_charges_id',$id)->orderBy('valid_from_date_tmestamp','DESC')->get();
				//dd($data);
				return view("rates.addvalidfrom",compact("data_history",'id'));
	}

    public function store_valid_from(Request $request) {

	   $quote_charge_id=$request->id;
	   $incoming_date=$request->valid_from_date;
       $date = DateTime::createFromFormat('d/m/Y', $incoming_date);
       $valid_date = $date->format('Y-m-d');
       $valid_date_in_format=date('Y-m-d', strtotime($valid_date));
       $valid_date_in_strtotime=strtotime($valid_date_in_format);
       $check_data=DB::table('quote_charges_dynamic_data')->where([['quote_charges_id',$quote_charge_id],['valid_from_date_tmestamp',$valid_date_in_strtotime]])->first();
       if($check_data=='')
       {
       	 $data_in_date=new QuoteChargesDynamicData;
       $data_in_date->quote_charges_id=$quote_charge_id;
       $data_in_date->value=$request->value;
       $data_in_date->valid_from_date=$valid_date_in_format;
       $data_in_date->valid_from_date_tmestamp=$valid_date_in_strtotime;
       $data_in_date->save();
       }
       return redirect ('/rate');
    }
	
    public function editvalidfrom($id , Request $request) 
    {
		$data_history=QuoteChargesDynamicData::find($id);
		$main_data=QuoteCharges::find($data_history->quote_charges_id);
				//dd($data);
				return view("rates.editvalidfrom",compact("data_history",'id','main_data'));
	}
	
    public function update_valid_from(Request $request) 
    {
	   $quote_charge_id=$request->id;
	   $incoming_date=$request->valid_from_date;
       $date = DateTime::createFromFormat('d/m/Y', $incoming_date);
       $valid_date = $date->format('Y-m-d');
       $valid_date_in_format=date('Y-m-d', strtotime($valid_date));
       $valid_date_in_strtotime=strtotime($valid_date_in_format);
       
       	 $data_in_date=QuoteChargesDynamicData::find($quote_charge_id);
    
       $data_in_date->value=$request->value;
       $data_in_date->valid_from_date=$valid_date_in_format;
       $data_in_date->valid_from_date_tmestamp=$valid_date_in_strtotime;
       $data_in_date->save();
       return redirect ('/rate');
    }
	
    public function delete_valid_from($id,Request $request) 
    {
		$data=QuoteChargesDynamicData::find($id);
		if($data):
			QuoteChargesDynamicData::destroy($id);
			return redirect ('/rate');
		else:
			return redirect ('/rate');
		endif;
	}
	
    //Transport
    public function create_transport()
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
      if($check_data_settings->activation==1):
        return view("rates.insert_transport");
        else:
       return response()->view('error.404', [], 404);
    endif;
    }
    
    public function store_transport(Request $request)
    {
     $this->validate($request,[
      "transport"=>"required|Alpha",
     ]);
     $transport=new Transport;
     $transport->name=$request->transport;
     $transport->save();
      return redirect ('/rate');
    }
    
    public function edit_transport($id , Request $request)
    {
     $check_data_settings=ActivateService::where('services','=','settings')->first();
     if($check_data_settings->activation==1):
     if(Transport::find($id)):
        $data=Transport::find($id);
        //dd($data);
        return view("rates.edit_transport",compact("data"));
     else:
         return redirect ('/rate');
     endif;
     else:
       return response()->view('error.404', [], 404);
     endif;
    }
    
    public function update_transport($id,Request $request)
    {
        $this->validate($request,[
        "transport"=>"required|Alpha",
         ]);
        $data=Transport::find($id);
        if($data):
            $data->name=$request->transport;
            $data->save();
            return redirect ('/rate');
        else:
            return redirect ('/rate');
        endif;
    }
    
    public function delete_transport($id,Request $request)
    {
        $data=Transport::find($id);
        if($data):
        Transport::destroy($id);
         return redirect ('/rate');
        else:
           return redirect ('/rate');
        endif;
    }
    
    public function add_tour_custom(Request $request)
    {
        $this->validate($request,[
        "name"=>"required",
        "description"=>"required",
        "location"=>"required",
        "status"=>"required",
         ]);
        $tour=new PkgTours;
        $tour->activity=$request->name;
        $tour->desc=$request->description;
        $tour->location=$request->location;
        $tour->status=$request->status;
        $tour->save();
        $data=PkgTours::all();
        foreach($data as $key=>$tour):
            echo "<option value='".$tour->id."'>".$tour->activity."</option>";
        endforeach;
    }
    
    public function create_icon()
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
     if($check_data_settings->activation==1):
        return view("rates.insert_icon");
     else:
       return response()->view('error.404', [], 404);
     endif;
    }
    
    public function store_icon(Request $request)
    {
        $this->validate($request,[
          "icon"=>"required",
          "icon_title"=>"required",
        ]);
        $icon = $request->file("icon");
        //dd($icon);
        $icon_ext=$icon->getClientOriginalExtension();
        $iconname = uniqid().".".$icon_ext;
        //move the file to correct location
        $icon->move(public_path().'/uploads/icons/', $iconname);
        $icon=new Icons;
        $icon->icon=$iconname;
        $icon->icon_title =$request->icon_title;
        $icon->save();
         return redirect ('/rate');
    }
    
    public function edit_icon($id , Request $request)
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
     if($check_data_settings->activation==1):
     if(Icons::find($id)):
        $data=Icons::find($id);
        //dd($data);
        return view("rates.edit_icon",compact("data"));
     else:
         return redirect ('/rate');
     endif;
     else:
       return response()->view('error.404', [], 404);
        endif;
    }
    
    public function update_icon($id,Request $request)
    {
        $this->validate($request,[
        "icon_title"=>"required",
         ]);
        $data=Icons::find($id);
        if($request->file("icon")!=""):
          $icon = $request->file("icon");
           //dd($icon);
          $icon_ext=$icon->getClientOriginalExtension();
          $iconname = uniqid().".".$icon_ext;
          //move the file to correct location
          $icon->move(public_path().'/uploads/icons/', $iconname);
          else:
          $iconname = $request->icon_value;
        endif;
            $data->icon=$iconname;
            $data->icon_title =$request->icon_title;
            $data->save();
            return redirect ('/rate');
    }
    
    public function delete_icon($id,Request $request)
    {
        $data=Icons::find($id);
        if($data):
        Icons::destroy($id);
         return redirect ('/rate');
        else:
           return redirect ('/rate');
        endif;
    }
	
    //Country-State-City Starts
	public function country() 
    {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
			if(Sentinel::check()):
			if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
			$country_data=countries::all();
				return view("rates.country_list",compact('country_data'));
			else:
				return redirect("/");
			endif;
			endif;
		else:
			return response()->view('error.404', [], 404);
		endif;
	}
	
    public function state() 
    {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
			if(Sentinel::check()):
			if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
			$country_data=countries::all();
				return view("rates.state_list",compact('country_data'));
			else:
				return redirect("/");
			endif;
			endif;
		else:
			return response()->view('error.404', [], 404);
		endif;
	}
	
    public function getstate(Request $request) 
    {
		$country_id=$request->country;
		$data = State::where('country_id','=',$country_id)->get();
		return Datatables::of($data)
		->addIndexColumn()
		->addColumn('action', function($row){
			$actionBtn = '<a href="#" id="'.$row->id.'" class="btn btn-warning edit fontSize14 lineHeight14 borderRadius3">Edit</a>
			<a href="#" id="'.$row->id.'" class="btn btn-danger fontSize14 lineHeight14 borderRadius3  delete">Delete</a>';
			return $actionBtn;
			})
			->make(true);
	}
	
    public function getcity(Request $request) 
    {
		$state_id=$request->state_id;
		$data = City::where('state_id','=',$state_id)->get();
		return Datatables::of($data)
		->addIndexColumn()
		->addColumn('action', function($row){
			$actionBtn = '<a href="#" id="'.$row->id.'" class="btn btn-warning edit fontSize14 lineHeight14 borderRadius3">Edit</a>
			<a href="#" id="'.$row->id.'" class="btn btn-danger fontSize14 lineHeight14 borderRadius3  delete">Delete</a>';
			return $actionBtn;
			})
			->make(true);
	}
	
    public function edit_country(Request $request) 
    {
		$id=$request->id;
		$data=countries::find($id);
		$output='<input type="hidden" name="id" value="'.$id.'"/>
		<div class="form-group">
			<label for="">Country</label>
			<input type="text" name="country" class="form-control" required value="'.$data->name.'">
		</div>
		<button type="submit" class="btn btn-success">Update</button>';
		echo $output;
	}
	
    public function edit_state(Request $request) 
    {
		$id=$request->id;
		$data=State::find($id);
		$output='<input type="hidden" name="id" value="'.$id.'"/>
		<div class="form-group">
			<label for="">State</label>
			<input type="text" name="name" class="form-control" required value="'.$data->name.'">
		</div>
		<button type="submit" class="btn btn-success">Update</button>';
		echo $output;
	}
	
    public function edit_city(Request $request) 
    {
		$id=$request->id;
		$data=City::find($id);
		$output='<input type="hidden" name="id" value="'.$id.'"/>
		<div class="form-group">
			<label for="">City</label>
			<input type="text" name="name" class="form-control" required value="'.$data->name.'">
		</div>
		<button type="submit" class="btn btn-success">Update</button>';
		echo $output;
	}
	
    public function delete_country(Request $request) 
    {
		$id=(int)$request->id;
		$country_data=countries::find($id);
		$state_data=State::where('country_id','=',$country_data->id)->get();
		foreach($state_data as $state) {
			$cities=City::where('state_id','=',$state->id)->get();
			foreach($cities as $city) {
				City::destroy($city->id);
				}
			State::destroy($state->id);
			}
			countries::destroy($country_data->id);
			echo 'success';
	}
	
    public function delete_state(Request $request) 
    {
		$id=(int)$request->id;
		$state_data=State::find($id);
		$city_data=City::where('state_id','=',$state_data->id)->get();
		foreach($city_data as $city) {
			City::destroy($city->id);
			}
		State::destroy($state_data->id);
		echo 'success';
	}
	
    public function delete_city(Request $request) 
    {
		$id=(int)$request->id;
		City::destroy($id);
		echo 'success';
	}
	
    public function update_country(Request $request) 
    {
		$id=$request->id;
		$data_validation=countries::where([['name','=',$request->country],['id','!=',$id]])->first();
		if($data_validation==''):
			$data=countries::find($id);
			$data->name=$request->country;
			$data->save();
			echo 'success';
		else:
			echo 'country already taken';
		endif;
	}
	
    public function update_state(Request $request) 
    {
		$id=$request->id;
		$data_validation=State::where([['name','=',$request->name],['id','!=',$id]])->first();
		if($data_validation==''):
			$data=State::find($id);
			$data->name=$request->name;
			$data->save();
			echo 'success';
		else:
			echo 'State already taken';
		endif;
	}
	
    public function update_city(Request $request) 
    {
		$id=$request->id;
		$data_validation=City::where([['name','=',$request->name],['id','!=',$id]])->first();
		if($data_validation==''):
			$data=City::find($id);
			$data->name=$request->name;
			$data->save();
			echo 'success';
		else:
			echo 'City already taken';
		endif;
	}
	
    public function country_save(Request $request) 
    {
		$data_validation=countries::where('name','=',$request->country)->first();
		if($data_validation==''):
			$data=new countries;
			$data->sortname=$request->sortname;
			$data->phonecode=$request->phonecode;
			$data->name=$request->country;
			$data->save();
			echo 'success';
		else:
			echo 'Country already taken';
		endif;
	}
	
    public function state_save(Request $request) 
    {
		$data_validation=State::where([['name','=',$request->name],['country_id','=',$request->country_id]])->first();
		if($data_validation==''):
			$data=new State;
			$data->country_id=$request->country_id;
			$data->name=$request->name;
			$data->save();
			echo 'success';
		else:
			echo 'State already taken';
		endif;
	}

	public function city_save(Request $request) 
    {
		$data_validation=City::where([['name','=',$request->name],['state_id','=',$request->state_id]])->first();
		if($data_validation==''):
			$data=new City;
			$data->state_id=$request->state_id;
			$data->name=$request->name;
			$data->save();
			echo 'success';
		else:
			echo 'City already taken';
		endif;
	}
	
    public function add_city() 
    {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
			if(Sentinel::check()):
			if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
			$country_data=countries::all();
			// return view("rates.addcity",compact('country_data'));
				return view("rates.city_list",compact('country_data'));
			else:
				return redirect("/");
			endif;
			endif;
		else:
			return response()->view('error.404', [], 404);
		endif;
	}

	public function store_city(Request $request) 
    {
		$this->validate($request,[
		"choosecountry"=>"required",
		"choosestate"=>"required",
		"add_city"=>"required",
		]);
		$city=new City;
		$city->name=$request->add_city;
		$city->state_id=$request->choosestate;
		$city->save();
		return redirect('/add_city');
	}

    /**********************/

    // home page mid images
    public function mid_image()
    {
        $check_data_settings = ActivateService::where('services', 'settings')->first();

        // Check if settings exist and activation is enabled
        if (!$check_data_settings || $check_data_settings->activation != 1) {
            return response()->view('error.404', [], 404);
        }

        // Check if the user is logged in
        if (!Sentinel::check()) {
            return redirect("/");
        }

        // Check if the user has the required roles
        $user = Sentinel::getUser();
        if (!$user->inRole('administrator') && !$user->inRole('super_admin')) {
            return redirect("/");
        }

        // Fetch data and return view
        $img_data = Mid_Image::all();
        return view("rates.mid_image", compact('img_data'));
    }

    /**********************/

    public function mid_image_save(Request $request,$id)
    {
        //$name=$request->name;
        //$file_name=$request->file_name;
        //$image_data=Mid_Image::all();
        $file = $request->file('file');
        $dbname=$id;
        $filename = rand().'.'.$file->getClientOriginalExtension();
        $path = '/uploads/mid_image/'.$filename;
        //move the file to correct location
        $file->move(public_path().'/uploads/mid_image/', $filename);
        $image_save=Mid_Image::find("1");
        $image_save->$dbname = $path;
        $image_save->save();
    }
    
    public function dest_add(Request $request)
    {
        $name=$request->name;
        $value=$request->value;
        $text_save=Mid_Image::find("1");
        $text_save->$name = $value;
        $text_save->save();
    }

    /**********************/
    
    /*public function testimonials()
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
       if($check_data_settings->activation==1):
      $data=Testimonial::all();
      return view("testimonial.index",compact("data"));
      else:
       return response()->view('error.404', [], 404);
     endif;
    }*/

    public function testimonials()
    {
        $check_data_settings = ActivateService::where('services', 'settings')->first();

        // Check if $check_data_settings exists and activation is 1
        if ($check_data_settings && $check_data_settings->activation == 1) {
            $data = Testimonial::all();
            return view('testimonial.index', compact('data'));
        }

        // Return a 404 error if settings are not activated
        abort(404);
    }

    /**********************/
    
    /*public function delete_item_image(Request $request)
    {
        $id=$request->id;
        $old=TestimonialImage::destroy($id);
    }*/

    public function delete_item_image(Request $request)
    {
        $id = $request->id;

        // Check if the image exists before deleting
        $image = TestimonialImage::find($id);

        if (!$image) {
            return response()->json(['status' => 'error', 'message' => 'Image not found'], 404);
        }

        // Delete the image and return response
        if ($image->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Image deleted successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to delete image'], 500);
        }
    }

    /**********************/
    
    public function get_item_image(Request $request)
    {
        $id=$request->id;
        $image_datas=TestimonialImage::where('testimonial_id','=',$id)->get();
        $output='<table class="table">
        <thead>
        <tr>
        <th>Image/Video</th>
        <th>Default</th>
        <th>Actions</th>
        </tr>
        </thead>
        <tbody>';
      foreach($image_datas as $images):
        if($images->type=='video'):
        $path=url('public/uploads/testimonial/'.$images->image_or_video);
        $checked='';
        if($images->default=='1'):
        $checked='checked';
        endif;
        $image_id=$images->id;
        $output.='<tr>
        <td>
        <video width="150" height="150" controls>
        <source src="'.$path.'" type="video/mp4">
        <source src="'.$path.'" type="video/ogg">
        Your browser does not support the video tag.
        </video>
       </td>
        <td><label class="form-check-label">
        <input type="radio" class="form-check-input" name="default" '.$checked.' value="'.$image_id.'">
        </label></td>
        <td>
            <a href="#" class="delete_image  btn btn-danger btn-sm" id="'.$image_id.'"><i class="far fa-trash-alt"></i> Delete</a>
        </td>
        </tr>';
        else:
        $path=url('public/uploads/testimonial/thumb/'.$images->image_thumb);
        $checked='';
        if($images->default=='1'):
        $checked='checked';
        endif;
        $image_id=$images->id;
        $output.='<tr>
        <td>
        <img src="'.$path.'" width="100px"></td>
        <td><label class="form-check-label">
        <input type="radio" class="form-check-input" name="default" '.$checked.' value="'.$image_id.'">
        </label></td>
        <td>
        <a href="#" class="delete_image  btn btn-danger btn-sm" id="'.$image_id.'"><i class="far fa-trash-alt"></i> Delete</a>
        </td>
        </tr>';
        endif;
        endforeach;
        $output.=' </tbody></table>';
        echo $output;
    }
    
    public function uploads_list_image(Request $request)
    {
       if($request->has('default')):
        $id=$request->id;
        $old_id=$request->default;
        $old_data=TestimonialImage::where('testimonial_id','=',$id)->get();
        foreach($old_data as $old_datas):
           $old=TestimonialImage::find($old_datas->id);
           if($old_datas->id==$old_id):
           $old->default=1;
           else:
           $old->default=0;
           endif;
           $old->save();
        endforeach;
       if($request->hasFile('images')):
        $images = $request->file('images');
        foreach($images as $image)
         {
            $mime = $image->getMimeType();
         if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv")
           {
           $new_name = rand().'.'.$image->getClientOriginalExtension();
       //
       // $destinationPath = public_path('/uploads/testimonial');
        // $img_main = Image::make($image->getRealPath());
        // $img_main->resize(1024, 768, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath.'/'.$new_name);
        $image->move(public_path().'/uploads/testimonial/', $new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->type='video';
         $image_data->save();
            }
            else
            {
        $new_name = rand().'.'.$image->getClientOriginalExtension();
       //
        $destinationPath_thumb = public_path('/uploads/testimonial/thumb');
        $thumb_name = rand().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->resize(400, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_thumb.'/'.$thumb_name);
       $destinationPath = public_path('/uploads/testimonial');
        $img_main = Image::make($image->getRealPath());
        $img_main->resize(1024, 768, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->image_thumb =$thumb_name;
         $image_data->type='image';
        $image_data->save();
        }
       }
       echo "success";
        else:
        echo "success";
        endif;
        else:
       if($request->hasFile('images')):
        $id=$request->id;
        $images = $request->file('images');
        $a=1;
        foreach($images as $image)
         {
        $mime = $image->getMimeType();
         if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv")
           {
             $new_name = rand().'.'.$image->getClientOriginalExtension();
       //
        $new_name = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path().'/uploads/testimonial/', $new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
          $image_data->type='video';
         if($a==1):
         $image_data->default=1;
        endif;
        $image_data->save();
           }
           else
           {
           $new_name = rand().'.'.$image->getClientOriginalExtension();
       //
        $destinationPath_thumb = public_path('/uploads/testimonial/thumb');
        $thumb_name = rand().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->resize(400, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_thumb.'/'.$thumb_name);
       $destinationPath = public_path('/uploads/testimonial');
        $img_main = Image::make($image->getRealPath());
        $img_main->resize(1024, 768, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->image_thumb=$thumb_name;
          $image_data->type='image';
         if($a==1):
         $image_data->default=1;
        endif;
        $image_data->save();
           }
       $a++;
       }
       echo "success";
        else:
        echo "success";
        endif;
        endif;
    }
    
    public function user_review($id)
    {
    	$testimonial_id=$id;
    	$id=CustomHelpers::custom_decrypt($id);
    	
    	$testimonial_data=Testimonial::find((int)$id);
    	if($testimonial_data!='')
    	{
        return view('testimonial.user_review',compact('testimonial_data','testimonial_id'));
    	}
    	else
    	{
        return redirect('/')->with('error','Data Not Found');		
    	}       
    }
    
    public function store_reviews(Request $request)
    {
      $id=CustomHelpers::custom_decrypt($request->id);
    
    	$testimonial_data=Testimonial::find((int)$id);
    	if($testimonial_data!='')
    	{
        $testimonial_data->c_exp=$request->c_exp;
        $testimonial_data->c_rating=$request->c_rating;
        $testimonial_data->save();

        if($request->hasFile('c_image'))
        {
       $old_data=TestimonialImage::where([['testimonial_id','=',$id],['default',1]])->first();
       if($old_data=='')
       {
        $a=1;
       }
       else
       {
        $a=2;    	
       }
        $images = $request->file('c_image');
        foreach($images as $image)
        {
            $mime = $image->getMimeType();
         if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv")
           {
           $new_name = rand().'.'.$image->getClientOriginalExtension();

        $image->move(public_path().'/uploads/testimonial/', $new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->type='video';
         if($a==1):
         $image_data->default=1;
        endif;
         $image_data->save();
            }
            else
            {
        $new_name = rand().'.'.$image->getClientOriginalExtension();
       //
        $destinationPath_thumb = public_path('/uploads/testimonial/thumb');
        $thumb_name = rand().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->resize(400, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_thumb.'/'.$thumb_name);
       $destinationPath = public_path('/uploads/testimonial');
        $img_main = Image::make($image->getRealPath());
        $img_main->resize(1024, 768, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->image_thumb =$thumb_name;
         if($a==1):
         $image_data->default=1;
        endif;
         $image_data->type='image';
        $image_data->save();
        }
          $a++;
       }
 	
        }
        //echo 'success';
    	}
    	else
    	{
        return redirect('/')->with('error','Data Not Found');		
    	} 
    }

    public function add_testimonial()
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
        if($check_data_settings->activation==1):
      if(Sentinel::check()):
       if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
      return view("testimonial.add_testimonial");
        else:
        return redirect("/");
        endif;
        endif;
        else:
       return response()->view('error.404', [], 404);
        endif;
    }

    /**********************/

    /*public function store_testimonial(Request $request)
    {
      $this->validate($request,[
          "c_name"=>"required",
        ]);
        $c_imagename="";
        // if($request->file("c_image")!=""):
        // $c_image = $request->file("c_image");
        // //dd($c_image);
        // $c_image_ext=$c_image->getClientOriginalExtension();
        // $destination=public_path('/uploads/testimonial');
        // $c_imagename = rand().".".$c_image_ext;
        // $img=Image::make($c_image->getRealPath());
        // $img->resize(350,260,function($constraint){
        //   $constraint->aspectRatio();
        // })->save($destination.'/'.$c_imagename);
        // //move the file to correct location
        // // $c_image->move(public_path().'/uploads/testimonial/', $c_imagename);
        // endif;
        if($request->hasFile('c_image'))
        {
            $a=1;
            $images = $request->file('c_image');
            foreach($images as $image)
            {
            $mime = $image->getMimeType();
            if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv")
           {
           $new_name = rand().'.'.$image->getClientOriginalExtension();
           $image->move(public_path().'/uploads/testimonial/', $new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->type='video';
         if($a==1):
         $image_data->default=1;
        endif;
         $image_data->save();
            }
            else
            {
        $new_name = rand().'.'.$image->getClientOriginalExtension();
        //
        $destinationPath_thumb = public_path('/uploads/testimonial/thumb');
        $thumb_name = rand().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->resize(400, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_thumb.'/'.$thumb_name);
       $destinationPath = public_path('/uploads/testimonial');
        $img_main = Image::make($image->getRealPath());
        $img_main->resize(1024, 768, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->image_thumb =$thumb_name;
         if($a==1):
         $image_data->default=1;
        endif;
         $image_data->type='image';
        $image_data->save();
        }
          $a++;
       }
        }
        
        //
        $testimonial=new Testimonial;
        $testimonial->c_image=$c_imagename;
        $testimonial->c_name=$request->c_name;
        $testimonial->c_email=$request->c_email;
        $testimonial->c_country=$request->c_country;
        $testimonial->c_exp=$request->c_exp;
        $testimonial->c_rating=$request->c_rating;
        $testimonial->c_mobile=$request->c_mobile;
        $testimonial->save();
         return redirect ('/testimonials');
    }*/

    public function store_testimonial(Request $request)
    {
        // Validate request
        $this->validate($request, [
            "c_name" => "required",
            "c_image.*" => "nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi,wmv|max:20480", // Max 20MB
        ]);

        // Save the testimonial first
        $testimonial = new Testimonial();
        $testimonial->c_name = $request->c_name;
        $testimonial->c_email = $request->c_email;
        $testimonial->c_country = $request->c_country;
        $testimonial->c_exp = $request->c_exp;
        $testimonial->c_rating = $request->c_rating;
        $testimonial->c_mobile = $request->c_mobile;
        $testimonial->save(); // Saves and generates an ID

        $id = $testimonial->id; // Get testimonial ID for images

        if ($request->hasFile('c_image')) {
            $images = $request->file('c_image');

            if (empty($images)) {
                return back()->with('error', 'No image uploaded.');
            }

            $a = 1;
            foreach ($images as $image) {
                if (!$image) {
                    continue; // Skip invalid images
                }

                $mime = $image->getMimeType();
                $new_name = uniqid() . '.' . $image->getClientOriginalExtension();

                if (strpos($mime, 'video/') === 0) {
                    $image->move(public_path('/uploads/testimonial/'), $new_name);
                    $image_data = new TestimonialImage;
                    $image_data->testimonial_id = $id;
                    $image_data->image_or_video = $new_name;
                    $image_data->type = 'video';
                    $image_data->default = $a == 1 ? 1 : 0;
                    $image_data->save();
                } else {
                    $thumb_name = uniqid() . '.' . $image->getClientOriginalExtension();
                    $destinationPath_thumb = public_path('/uploads/testimonial/thumb');
                    $destinationPath = public_path('/uploads/testimonial');

                    $img = Image::make($image->getRealPath());
                    $img->resize(400, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath_thumb . '/' . $thumb_name);

                    $img_main = Image::make($image->getRealPath());
                    $img_main->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $new_name);

                    $image_data = new TestimonialImage;
                    $image_data->testimonial_id = $id;
                    $image_data->image_or_video = $new_name;
                    $image_data->image_thumb = $thumb_name;
                    $image_data->type = 'image';
                    $image_data->default = $a == 1 ? 1 : 0;
                    $image_data->save();
                }

                $a++;
            }
        }

        return redirect('/testimonials')->with('success', 'Testimonial added successfully!');
    }

    /**********************/

    public function edit_testimonial($id)
    {
      $check_data_settings=ActivateService::where('services','=','settings')->first();
      if($check_data_settings->activation==1):
      if(Sentinel::check()):
       if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
      $data=Testimonial::find($id);
      return view("testimonial.edit_testimonial" , compact("data"));
        else:
      return redirect("/");
        endif;
        endif;
        else:
       return response()->view('error.404', [], 404);
        endif;
    }

    public function update_testimonial($id, Request $request)
    {
      $this->validate($request,[
        "c_name"=>"required",
         ]);
        $testimonial=Testimonial::find($id);
        // if($request->file("c_image")!=""):
        // $c_image = $request->file("c_image");
        // //dd($c_image);
        // $c_image_ext=$c_image->getClientOriginalExtension();
        // $destination=public_path('/uploads/testimonial');
        // $c_imagename = rand().".".$c_image_ext;
        // $img=Image::make($c_image->getRealPath());
        // $img->resize(350,260,function($constraint){
        //   $constraint->aspectRatio();
        // })->save($destination.'/'.$c_imagename);
        //   else:
        //   $c_imagename = $request->c_image_value;
        // endif;
        //
        if($request->hasFile('c_image'))
        {
       $old_data=TestimonialImage::where([['testimonial_id','=',$id],['default',1]])->first();
       if($old_data=='')
       {
        $a=1;
       }
       else
       {
        $a=2;       	
       }
        $images = $request->file('c_image');
        foreach($images as $image)
         {
            $mime = $image->getMimeType();
         if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv")
           {
           $new_name = rand().'.'.$image->getClientOriginalExtension();

        $image->move(public_path().'/uploads/testimonial/', $new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->type='video';
         if($a==1):
         $image_data->default=1;
        endif;
         $image_data->save();
            }
            else
            {
        $new_name = rand().'.'.$image->getClientOriginalExtension();
        //
        $destinationPath_thumb = public_path('/uploads/testimonial/thumb');
        $thumb_name = rand().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->resize(400, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_thumb.'/'.$thumb_name);
        $destinationPath = public_path('/uploads/testimonial');
        $img_main = Image::make($image->getRealPath());
        $img_main->resize(1024, 768, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$new_name);
         $image_data=new TestimonialImage;
         $image_data->testimonial_id=$id;
         $image_data->image_or_video=$new_name;
         $image_data->image_thumb =$thumb_name;
         if($a==1):
         $image_data->default=1;
        endif;
         $image_data->type='image';
        $image_data->save();
        }
          $a++;
        }
        }

        // $testimonial->c_image=$c_imagename;
        $testimonial->c_name=$request->c_name;
        $testimonial->c_email=$request->c_email;
        $testimonial->c_country=$request->c_country;
        $testimonial->c_exp=$request->c_exp;
        $testimonial->c_rating=$request->c_rating;
        $testimonial->c_mobile=$request->c_mobile;
        $testimonial->status=$request->status;
        $testimonial->save();
         return redirect ('/testimonials');
    }

    /**********************/
    
    /*public function delete_testimonial($id)
    {
       $data=Testimonial::find($id);
        if($data):
        Testimonial::destroy($id);
         return redirect ('/testimonials');
        else:
           return redirect ('/testimonials');
        endif;
    }*/

    public function delete_testimonial($id)
    {
        $data = Testimonial::find($id);

        if ($data !== null) {
            $data->delete(); // Use delete() instead of destroy()
        }

        return redirect('/testimonials'); // Single redirect
    }

    /**********************/
    
    public function select_theme_type(Request $request)
    {
        $theme_search_value=$request->searchTerm;
        // $data=Theme::all();
        $data=Pkgtype::all();
        $theme=[];
        foreach($data as $data_value):
        $theme[]=$data_value->name;
        endforeach;
        $theme=array_unique($theme);
        $theme=$this->filter_array($theme, strtoupper(substr($theme_search_value, 0, 1)));
        $show=[];
        foreach($theme  as $d) {
            $show[] = ['id'=>$d,'text'=>$d];
        }
        $final_data[]=["text"=>"Suggestion Theme", 'children'=>$show];
        echo json_encode($final_data);
    }
    
    public function filter_array($array, $letter){
        $filtered_array=array();
        foreach($array as $key=>$val){
          if($val[0]==$letter){
           $filtered_array[]=$val;
          }
        }
        return $filtered_array;
    }
    
    /**********************/

    /*public function theme_data()
    {
      $check_data=ActivateService::where('services','=','tour_package_manager')->first();
      if($check_data->activation==1):
      $data=Theme::all();
      return view("theme.index",compact("data"));
      else:
       return response()->view('error.404', [], 404);
        endif;
    }*/

    public function theme_data()
    {
        $check_data = ActivateService::where('services', 'tour_package_manager')->first();

        if ($check_data && $check_data->activation == 1) {
            $data = Theme::all();
            return view("theme.index", compact("data"));
        }

        // Return a 404 error view if the service is not activated
        return abort(404);
    }

    /**********************/

    /*public function add_theme_data()
    {
       if(Sentinel::check()):
       if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
      $data=Pkgtype::all();
      return view("theme.add_theme_data",compact("data"));
        else:
        return redirect("/");
        endif;
        endif;
    }*/

    public function add_theme_data()
    {
        // Check if the user is logged in using Sentinel
        if (!Sentinel::check()) {
            return redirect('/login'); // Redirect to login page if user is not authenticated
        }

        // Get the authenticated user
        $user = Sentinel::getUser();

        // Check if the user has the required roles (administrator, supervisor, super_admin)
        if ($user->inRole('administrator') || $user->inRole('supervisor') || $user->inRole('super_admin')) {
            // Fetch all Pkgtype records from the database
            $data = Pkgtype::all();

            // Return the view with the retrieved data
            return view("theme.add_theme_data", compact("data"));
        }

        // Redirect to the homepage if the user doesn't have the required role
        return redirect("/");
    }

    /**********************/

    /*public function edit_theme_data($id)
    {
      $check_data=ActivateService::where('services','=','tour_package_manager')->first();
      if($check_data->activation==1):
      $data=Pkgtype::all();
      $data_value=Theme::find($id);
      return view("theme.edit_theme_data" , compact("data","data_value"));
      else:
       return response()->view('error.404', [], 404);
      endif;
    }*/

    public function edit_theme_data($id)
    {
        // Check if the 'tour_package_manager' service is activated
        $check_data = ActivateService::where('services', 'tour_package_manager')->first();
        
        if (!$check_data || $check_data->activation != 1) {
            abort(404); // Return 404 if the service is not activated
        }

        // Fetch all Pkgtype records
        $data = Pkgtype::all();

        // Find the Theme record by ID
        $data_value = Theme::find($id);

        // If Theme record is not found, return 404
        if (!$data_value) {
            abort(404);
        }

        // Return the edit view with retrieved data
        return view("theme.edit_theme_data", compact("data", "data_value"));
    }

    /**********************/

    /*public function store_theme_data(Request $request)
    {
        $theme_data=DB::table('theme_data')->where([['theme_name', 'like', '%' . $request->theme_name. '%'],])->get();
        if(count($theme_data)!="0"):
          //return redirect ('/add_theme_data');
         Session::flash('message', "This theme already exist");
         return redirect()->back()->withInput();
        else:
        $c_imagename="";
        if($request->file("theme_image")!=""):
        $c_image = $request->file("theme_image");
        //dd($c_image);
        $c_image_ext=$c_image->getClientOriginalExtension();
        $c_imagename = uniqid().".".$c_image_ext;
        //move the file to correct location
        $c_image->move(public_path().'/uploads/theme/', $c_imagename);
        endif;
        $theme=new Theme;
        $theme->theme_image=$c_imagename;
        $theme->theme_name=$request->theme_name;
        $theme->theme_para1=$request->theme_para1;
        $theme->theme_para2=$request->theme_para2;
        $theme->about_theme=$request->about_theme;
        $theme->destination_theme_link=serialize($request->dynamic);
         if(Sentinel::getUser()->inRole('super_admin')):
        $theme->theme_key=$request->theme_key;
        $theme->title=$request->theme_title;
        $theme->theme_desc=$request->theme_desc;
        endif;
        $theme->save();
        return redirect ('/theme_data');
      endif;
    }*/

    public function store_theme_data(Request $request)
    {
        // Check if theme already exists
        $themeExists = DB::table('theme_data')->where('theme_name', $request->theme_name)->exists();

        if ($themeExists) {
            Session::flash('message', "This theme already exists");
            return redirect()->back()->withInput();
        }

        // Initialize image name
        $c_imagename = "";

        // Handle file upload securely
        if ($request->hasFile("theme_image")) {
            $c_image = $request->file("theme_image");
            $c_image_ext = $c_image->getClientOriginalExtension();
            $c_imagename = uniqid() . "." . $c_image_ext;

            // Store file in storage directory
            $c_image->move(public_path('/uploads/theme/'), $c_imagename);
        }

        // Create new Theme instance
        $theme = new Theme;
        $theme->theme_image = $c_imagename;
        $theme->theme_name = $request->theme_name;
        $theme->theme_para1 = $request->theme_para1;
        $theme->theme_para2 = $request->theme_para2;
        $theme->about_theme = $request->about_theme;
        //$theme->destination_theme_link = json_encode($request->dynamic); // Use JSON instead of serialize
        $theme->destination_theme_link = serialize($request->dynamic);

        // Check if user is logged in and has the 'super_admin' role
        if (Sentinel::check() && Sentinel::getUser()->inRole('super_admin')) {
            $theme->theme_key = $request->theme_key;
            $theme->title = $request->theme_title;
            $theme->theme_desc = $request->theme_desc;
        }

        // Save the new theme record
        $theme->save();

        // Redirect to theme data page
        return redirect('/theme_data');
    }

    /**********************/

    /*public function update_theme_data($id,Request $request)
    {
        $theme_data=DB::table('theme_data')->where([['theme_name',  '=',$request->theme_name],['id', '!=',$id],])->get();
         $theme=Theme::find($id);
        if(count($theme_data)!="0"):
          //return redirect ('/add_theme_data');
         Session::flash('message', "This theme already exist");
         return redirect()->back()->withInput();
        else:
        if($request->file("theme_image")!=""):
        $c_image = $request->file("theme_image");
        //dd($c_image);
        $c_image_ext=$c_image->getClientOriginalExtension();
        $c_imagename = uniqid().".".$c_image_ext;
        //move the file to correct location
        $c_image->move(public_path().'/uploads/theme/', $c_imagename);
        else:
          $c_imagename = $request->theme_image_value;
        endif;
        $theme->theme_image=$c_imagename;
        $theme->theme_name=$request->theme_name;
        $theme->theme_para1=$request->theme_para1;
        $theme->theme_para2=$request->theme_para2;
        $theme->about_theme=$request->about_theme;
        $theme->destination_theme_link=serialize($request->dynamic);
        if(Sentinel::getUser()->inRole('super_admin')):
        $theme->theme_key=$request->theme_key;
        $theme->title=$request->theme_title;
        $theme->theme_desc=$request->theme_desc;
        endif;
        $theme->save();
        return redirect ('/theme_data');
      endif;
    }*/

    public function update_theme_data($id, Request $request)
    {
        // Check if theme exists
        $theme = Theme::find($id);
        if (!$theme) {
            return response()->view('error.404', [], 404);
        }

        // Check if another theme with the same name exists
        $themeExists = DB::table('theme_data')
            ->where('theme_name', $request->theme_name)
            ->where('id', '!=', $id)
            ->exists();

        if ($themeExists) {
            Session::flash('message', "This theme already exists");
            return redirect()->back()->withInput();
        }

        // Handle file upload securely
        $c_imagename = $request->theme_image_value; // Keep the old image if no new one is uploaded

        if ($request->hasFile("theme_image")) {
            $c_image = $request->file("theme_image");
            $c_image_ext = $c_image->getClientOriginalExtension();
            $c_imagename = uniqid() . "." . $c_image_ext;

            // Move file to the correct location
            $c_image->move(public_path('/uploads/theme/'), $c_imagename);
        }

        // Update theme data
        $theme->theme_image = $c_imagename;
        $theme->theme_name = $request->theme_name;
        $theme->theme_para1 = $request->theme_para1;
        $theme->theme_para2 = $request->theme_para2;
        $theme->about_theme = $request->about_theme;
        //$theme->destination_theme_link = json_encode($request->dynamic); // Use JSON instead of serialize
        $theme->destination_theme_link = serialize($request->dynamic);

        // Check if user is logged in and has the 'super_admin' role
        if (Sentinel::check() && Sentinel::getUser()->inRole('super_admin')) {
            $theme->theme_key = $request->theme_key;
            $theme->title = $request->theme_title;
            $theme->theme_desc = $request->theme_desc;
        }

        // Save the updated theme record
        $theme->save();

        // Redirect to theme data page
        return redirect('/theme_data');
    }

    /**********************/

    /*public function delete_theme_data($id)
    {
        if(Sentinel::check()):
        if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
       $data=Theme::find($id);
        if($data):
        Theme::destroy($id);
         return redirect ('/theme_data');
        else:
           return redirect ('/theme_data');
        endif;
      else:
      return redirect("/");
      endif;
        endif;
	}*/

    public function delete_theme_data($id)
    {
        // Check if the user is authenticated and has the required role
        if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {

            // Attempt to find the theme by ID
            $data = Theme::find($id);

            if ($data) {
                $data->delete(); // Delete the theme safely
            }

            return redirect('/theme_data')->with('success', 'Theme deleted successfully.');
        }

        return redirect('/')->with('error', 'Unauthorized access.');
    }

	/**********************/

    // Newsletter
	/*public function newsletter(Request $request) 
    {
		$sub_email=$request->sub_email;
		$sub_data=DB::table('newsletter')->where([['sub_email',  '=',$sub_email],])->get();
		if(count($sub_data)!="0"):
			echo "Change the email id, this email already already exist";
		else:
			$sub=new Newsletter;
			$sub->sub_email=$sub_email;
			$sub->save();
			echo "Thank you for subscribing! Get Exclusive offers, Deals & Discounts";
		endif;
	}*/

    public function newsletter(Request $request) 
    {
        // Validate email input
        $request->validate([
            'sub_email' => 'required|email|unique:newsletter,sub_email'
        ]);

        // Check if the email already exists in the database
        if (Newsletter::where('sub_email', $request->sub_email)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'This email already exists. Please use a different email.'
            ], 400);
        }

        // Save new subscriber
        $subscriber = new Newsletter();
        $subscriber->sub_email = $request->sub_email;
        $subscriber->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you for subscribing! Get Exclusive Offers, Deals & Discounts.'
        ], 200);
    }

	/**********************/

    /*public function newsletter_back() 
    {
		$check_data_settings=ActivateService::where('services','=','settings')->first();
		if($check_data_settings->activation==1):
			if(Sentinel::check()):
				if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')):
					$data=Newsletter::all();
					return view("newsletter.index" ,compact("data") );
				else:
					return redirect("/");
				endif;
			endif;
			else:
				return response()->view('error.404', [], 404);
		endif;
	}*/

    public function newsletter_back() 
    {
        // Check if 'settings' service is activated
        if (!optional(ActivateService::where('services', 'settings')->first())->activation) {
            return response()->view('error.404', [], 404);
        }

        // Check if user is logged in
        if (!Sentinel::check()) {
            return redirect("/");
        }

        // Check if user has the required role
        if (!Sentinel::getUser()->inRole('administrator') && !Sentinel::getUser()->inRole('super_admin')) {
            return redirect("/");
        }

        // Fetch newsletter data and return view
        $data = Newsletter::all();
        return view("newsletter.index", compact("data"));
    }

	/**********************/
    
    /*public function delete_sub($id) 
    {
		$data=Newsletter::find($id);
		if($data):
			Newsletter::destroy($id);
			return redirect("/newsletter_back");
		else:
			return redirect("/newsletter_back");
		endif;
	}*/

    public function delete_sub($id) 
    {
        Newsletter::destroy($id);
        return redirect("/newsletter_back");
    }

}