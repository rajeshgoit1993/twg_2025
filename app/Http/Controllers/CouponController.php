<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use App\Coupon;
use App\CouponIncludeExclude;
use Illuminate\Http\Request;
use App\ActivateService;
use Sentinel;
use App\Packages;
use DB;

class CouponController extends Controller
{
  /*public function get_coupon_applicable_for(Request $request)
  {
    $applicable_for=$request->applicable_for;
    $all_packages = DB::table('rt_packages')->get();
    $quotes=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id', '=','option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
    ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')
    ->orderBy('created_at', 'desc')
    ->get();
    $output='';
    if($applicable_for==1)
    {
    $output.='<label class="control-label" for="exclude">Exclusion - Coupon not applicable on (Tour + Quote)</label>
    <select name="exclude[]" class="form-control select2" multiple>
    <option value="" disabled>Select</option>';
    foreach($quotes as $quote)
    {
    $output.='<option value="quote_'.$quote->quo_ref.'">'.$quote->package_name.' (Quote)</option>';
    }
    foreach($all_packages as $package)
    {
    $output.='<option value="package_'.$package->id.'">'.$package->title.' (Package)</option>';
    }
    $output.='</select>';
    }
    elseif($applicable_for==2)
    {
    $output.='<label class="control-label" for="exclude">Exclusion - Coupon not applicable on (Quote)</label>
    <select name="exclude[]" class="form-control select2" multiple>
    <option value="">--Choose--</option>';
    foreach($quotes as $quote)
    {
    $output.='<option value="quote_'.$quote->quo_ref.'">'.$quote->package_name.' (Quote)</option>';
    }
    $output.='</select>';
    }
    elseif($applicable_for==3)
    {
    $output.='<label class="control-label" for="exclude">Exclusion - Coupon not applicable on (Tour)</label>
    <select name="exclude[]" class="form-control select2" multiple>
    <option value="">--Choose--</option>';
    foreach($all_packages as $package)
    {
    $output.='<option value="package_'.$package->id.'">'.$package->title.' (Package)</option>';
    }
    $output.='</select>';
    }
    elseif($applicable_for==4)
    {
    $output.='<label class="control-label" for="include">Exclusion - Coupon not applicable on (Quote)</label>
    <select name="include[]" class="form-control select2" required multiple>
    <option value="">--Choose--</option>';
    foreach($quotes as $quote)
    {
    $output.='<option value="quote_'.$quote->quo_ref.'">'.$quote->package_name.' (Quote)</option>';
    }
    $output.='</select>';
    }
    elseif($applicable_for==5)
    {
    $output.='<label class="control-label" for="include">Exclusion - Coupon not applicable on (Tour)</label>
    <select name="include[]" class="form-control select2" required multiple>
    <option value="">--Choose--</option>';
    foreach($all_packages as $package)
    {
    $output.='<option value="package_'.$package->id.'">'.$package->title.' (Package)</option>';
    }
    $output.='</select>';
    }
    echo $output;
  }*/
  
  // Generate coupon applicable exclusions or inclusions based on the selected option
  /*public function get_coupon_applicable_for(Request $request)
  {
    // Retrieve the applicable option from the request
    $applicable_for = $request->applicable_for;

    // Fetch all packages
    $all_packages = DB::table('rt_packages')->get();

    // Fetch all quotes with specific conditions
    $quotes = DB::table('option1_quotation')
        ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
        ->where([
            ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
            ['option1_quotation.del_status', '=', 1],
            ['option1_quotation.send_option', '=', 1]
        ])
        ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
        ->orderBy('created_at', 'desc')
        ->get();

    // Initialize output
    $output = '';

    // Conditional output based on applicable_for value
    if ($applicable_for == 1) {
        // Exclude both Tour and Quote
        $output .= '<label class="control-label" for="exclude">Exclusion - Coupon not applicable on (Tour + Quote)</label>';
        $output .= '<select name="exclude[]" class="form-control select2" multiple>';
        $output .= '<option value="" disabled>Select</option>';

        // Add quotes to exclusion list
        foreach ($quotes as $quote) {
            $output .= '<option value="quote_' . $quote->quo_ref . '">' . $quote->package_name . ' (Quote)</option>';
        }

        // Add packages to exclusion list
        foreach ($all_packages as $package) {
            $output .= '<option value="package_' . $package->id . '">' . $package->title . ' (Package)</option>';
        }
        $output .= '</select>';

    } elseif ($applicable_for == 2) {
        // Exclude only Quotes
        $output .= '<label class="control-label" for="exclude">Exclusion - Coupon not applicable on (Quote)</label>';
        $output .= '<select name="exclude[]" class="form-control select2" multiple>';
        $output .= '<option value="">--Choose--</option>';

        foreach ($quotes as $quote) {
            $output .= '<option value="quote_' . $quote->quo_ref . '">' . $quote->package_name . ' (Quote)</option>';
        }
        $output .= '</select>';

    } elseif ($applicable_for == 3) {
        // Exclude only Tours
        $output .= '<label class="control-label" for="exclude">Exclusion - Coupon not applicable on (Tour)</label>';
        $output .= '<select name="exclude[]" class="form-control select2" multiple>';
        $output .= '<option value="">--Choose--</option>';

        foreach ($all_packages as $package) {
            $output .= '<option value="package_' . $package->id . '">' . $package->title . ' (Package)</option>';
        }
        $output .= '</select>';

    } elseif ($applicable_for == 4) {
        // Include only Quotes
        $output .= '<label class="control-label" for="include">Inclusion - Coupon applicable on (Quote)</label>';
        $output .= '<select name="include[]" class="form-control select2" required multiple>';
        $output .= '<option value="">--Choose--</option>';

        foreach ($quotes as $quote) {
            $output .= '<option value="quote_' . $quote->quo_ref . '">' . $quote->package_name . ' (Quote)</option>';
        }
        $output .= '</select>';

    } elseif ($applicable_for == 5) {
        // Include only Tours
        $output .= '<label class="control-label" for="include">Inclusion - Coupon applicable on (Tour)</label>';
        $output .= '<select name="include[]" class="form-control select2" required multiple>';
        $output .= '<option value="">--Choose--</option>';

        foreach ($all_packages as $package) {
            $output .= '<option value="package_' . $package->id . '">' . $package->title . ' (Package)</option>';
        }
        $output .= '</select>';
    }

    // Return the output
    echo $output;
  }*/

  public function get_coupon_applicable_for(Request $request)
  {
      $applicable_for = $request->applicable_for;
      
      // Retrieve all packages
      $all_packages = DB::table('rt_packages')->get();

      // Retrieve quotes with required conditions
      $quotes = DB::table('option1_quotation')
                  ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                  ->where([
                      ["option1_quotation.webnotation", '=', env("WEBSITENAME")],
                      ['option1_quotation.del_status', '=', 1],
                      ['option1_quotation.send_option', '=', 1]
                  ])
                  ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                  ->orderBy('created_at', 'desc')
                  ->get();

      // Initialize output
      $output = '';

      // Determine output based on `applicable_for` value
      switch ($applicable_for) {
          case 1:
              $output .= $this->generateLabel('Exclusion - Coupon not applicable on (Tour + Quote)');
              $output .= $this->generateSelectOptions($quotes, $all_packages, true, true);
              break;
          case 2:
              $output .= $this->generateLabel('Exclusion - Coupon not applicable on (Quote)');
              $output .= $this->generateSelectOptions($quotes, $all_packages, true, false);
              break;
          case 3:
              $output .= $this->generateLabel('Exclusion - Coupon not applicable on (Tour)');
              $output .= $this->generateSelectOptions($quotes, $all_packages, false, true);
              break;
          case 4:
              $output .= $this->generateLabel('Inclusion - Coupon only applicable on (Quote)');
              $output .= $this->generateSelectOptions($quotes, $all_packages, true, false, 'include');
              break;
          case 5:
              $output .= $this->generateLabel('Inclusion - Coupon only applicable on (Tour)');
              $output .= $this->generateSelectOptions($quotes, $all_packages, false, true, 'include');
              break;
          default:
              $output .= '<p>Invalid selection.</p>';
              break;
      }

      echo $output;
  }

  // Generate label HTML
  private function generateLabel(string $text): string
  {
      return '<label class="control-label" for="exclude">' . htmlspecialchars($text) . '</label>';
  }

  // Generate select options HTML
  private function generateSelectOptions($quotes, $packages, bool $includeQuotes = false, bool $includePackages = false, string $name = 'exclude'): string
  {
      $output = '<select name="' . htmlspecialchars($name) . '[]" class="form-control select2" multiple>';
      $output .= '<option value="" disabled>Select</option>';
      
      // Add quote options if needed
      if ($includeQuotes) {
          foreach ($quotes as $quote) {
              $output .= '<option value="quote_' . htmlspecialchars($quote->quo_ref) . '">' . htmlspecialchars($quote->package_name) . ' (Quote)</option>';
          }
      }

      // Add package options if needed
      if ($includePackages) {
          foreach ($packages as $package) {
              $output .= '<option value="package_' . htmlspecialchars($package->id) . '">' . htmlspecialchars($package->title) . ' (Package)</option>';
          }
      }

      $output .= '</select>';
      return $output;
  }

  // ----------------------------

  /*public function index()
  {
    $check_data_settings=ActivateService::where('services','=','settings')->first();
    if($check_data_settings->activation==1):
    $data=Coupon::all();
    return view("coupon.index",compact("data"));
    else:
    return response()->view('error.404', [], 404);
    endif;
  }*/

  public function index()
  {
    // Check if settings service is activated
    $checkDataSettings = ActivateService::where('services', 'settings')->first();

    // If settings service is activated, retrieve all coupons and load the view
    if ($checkDataSettings && $checkDataSettings->activation == 1) {
        $data = Coupon::all();
        return view("coupon.index", compact("data"));
    }

    // Otherwise, return a 404 error view
    return response()->view('error.404', [], 404);
  }

  // ----------------------------

  
  /*public function create()
  {
    $check_data_settings=ActivateService::where('services','=','settings')->first();
    if($check_data_settings->activation==1):
    if(Sentinel::check()):
    if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
    return view("coupon.add_coupon");
    else:
    return redirect("/");
    endif;
    endif;
    else:
    return response()->view('error.404', [], 404);
    endif;
  }*/

  public function create()
  {
    // Check if settings service is activated
    $checkDataSettings = ActivateService::where('services', 'settings')->first();

    // Return 404 if settings service is not activated
    if (!$checkDataSettings || $checkDataSettings->activation != 1) {
        return response()->view('error.404', [], 404);
    }

    // Check if the user is logged in
    if (Sentinel::check()) {
        $user = Sentinel::getUser();
        
        // Verify if user has an appropriate role to access the coupon creation page
        if ($user->inRole('super_admin') || $user->inRole('administrator')) {
            return view("coupon.add_coupon");
        }
        
        // Redirect unauthorized users to the homepage
        return redirect("/");
    }

    // Redirect guests to the login page if not authenticated
    return redirect("/login");
  }

  // ----------------------------
  
  /*public function store(Request $request)
  {
    $this->validate($request,[
    "coupon_name"=>"required",
    ]);
    $data=new Coupon;
    $data->coupon_name=$request->coupon_name;
    $data->coupon_desc=$request->coupon_desc;
    $data->type=$request->type;
    $data->value=$request->value;
    $data->start_date=date('Y-m-d', strtotime($request->start_date));
    $data->end_date=date('Y-m-d', strtotime($request->end_date));
    $data->coupon_code=$request->coupon_code;
    $data->status=$request->status;
    $data->applicable_for=$request->applicable_for;
    $data->save();
    if($request->has('include'))
    {
    $includes_data=$request->include;
    foreach($includes_data as $include)
    {
    $cou_data=new CouponIncludeExclude;
    $cou_data->coupon_id=$data->id;
    $cou_data->type='include';
    $cou_data->ref_id=$include;
    $cou_data->save();
    }
    }
    if($request->has('exclude'))
    {
    $exclude_data=$request->exclude;
    foreach($exclude_data as $exclude)
    {
    $cou_data=new CouponIncludeExclude;
    $cou_data->coupon_id=$data->id;
    $cou_data->type='exclude';
    $cou_data->ref_id=$exclude;
    $cou_data->save();
    }
    }
    return redirect ('/Coupon')->with("success","Successfully Added");
  }*/

  /*public function store(Request $request)
  {
    // Validate the request
    $request->validate([
        "coupon_name" => "required",
    ]);

    // Create and save new Coupon data
    $coupon = new Coupon;
    $coupon->coupon_name = $request->coupon_name;
    $coupon->coupon_desc = $request->coupon_desc;
    $coupon->type = $request->type;
    $coupon->value = $request->value;
    $coupon->start_date = date('Y-m-d', strtotime($request->start_date));
    $coupon->end_date = date('Y-m-d', strtotime($request->end_date));
    $coupon->coupon_code = $request->coupon_code;
    $coupon->status = $request->status;
    $coupon->applicable_for = $request->applicable_for;
    $coupon->save();

    // Add include items if present
    if ($request->has('include')) {
        foreach ($request->include as $include) {
            CouponIncludeExclude::create([
                'coupon_id' => $coupon->id,
                'type' => 'include',
                'ref_id' => $include,
            ]);
        }
    }

    // Add exclude items if present
    if ($request->has('exclude')) {
        foreach ($request->exclude as $exclude) {
            CouponIncludeExclude::create([
                'coupon_id' => $coupon->id,
                'type' => 'exclude',
                'ref_id' => $exclude,
            ]);
        }
    }

    // Redirect with success message
    return redirect('/Coupon')->with("success", "Coupon successfully added");
  }*/

  public function store(Request $request)
  {
        // Validate the request
        $this->validate($request, [
            'coupon_name' => 'required|string|max:255', // Ensure 'coupon_name' is a string and has a max length
            'coupon_desc' => 'nullable|string', // Description is optional
            'coupon_code' => 'required|string|max:50', // Coupon code is required
            'type' => 'required|string', // Type is required
            'value' => 'required|numeric|min:0', // Value must be a non-negative number
            'start_date' => 'required|date', // Start date must be a valid date
            'end_date' => 'required|date|after:start_date', // End date must be a valid date and after start date
            'status' => 'required|boolean', // Status must be a boolean
            'applicable_for' => 'required|integer', // Applicable for must be an integer
        ]);

        // Create and save new Coupon data
        $coupon = new Coupon();
        $coupon->coupon_name = $request->input('coupon_name');
        $coupon->coupon_desc = $request->input('coupon_desc');
        $coupon->coupon_code = $request->input('coupon_code');
        $coupon->type = $request->input('type');
        $coupon->value = $request->input('value');
        $coupon->start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $coupon->end_date = date('Y-m-d', strtotime($request->input('end_date')));
        $coupon->status = $request->input('status');
        $coupon->applicable_for = $request->input('applicable_for');
        $coupon->save();

        // Add include items if present
        if ($request->has('include')) {
            foreach ($request->input('include') as $include) {
                CouponIncludeExclude::create([
                    'coupon_id' => $coupon->id,
                    'type' => 'include',
                    'ref_id' => $include,
                ]);
            }
        }

        // Add exclude items if present
        if ($request->has('exclude')) {
            foreach ($request->input('exclude') as $exclude) {
                CouponIncludeExclude::create([
                    'coupon_id' => $coupon->id,
                    'type' => 'exclude',
                    'ref_id' => $exclude,
                ]);
            }
        }

        // Redirect with success message
        return redirect('/Coupon')->with('success', 'Coupon successfully added');
  }
  
  // ----------------------------

  /*public function edit($id)
  {
    $check_data_settings=ActivateService::where('services','=','settings')->first();
    if($check_data_settings->activation==1):
    if(Sentinel::check()):
    if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
    $data=Coupon::find($id);
    return view("coupon.edit_coupon" , compact("data"));
    else:
    return redirect("/");
    endif;
    endif;
    else:
    return response()->view('error.404', [], 404);
    endif;
  }*/

  public function edit($id)
  {
    // Check if settings service is activated
    $settingsService = ActivateService::where('services', 'settings')->first();

    if ($settingsService && $settingsService->activation == 1) {
        // Check if user is authenticated
        if (Sentinel::check()) {
            // Check if user has appropriate role
            if (Sentinel::getUser()->inRole('administrator') ||
                Sentinel::getUser()->inRole('super_admin')) 
            {
              // Retrieve the coupon data by ID
              $coupon = Coupon::findOrFail($id);

              return view("coupon.edit_coupon", compact("coupon"));
            }
            
            // Redirect unauthorized users to home
            return redirect('/');
        }
    }

    // Return 404 error page if service is inactive or user is unauthorized
    return response()->view('error.404', [], 404);
  }

  // ----------------------------
  
  /*public function update($id,Request $request)
  {
    $this->validate($request,[
    "coupon_name"=>"required",
    ]);
    $data=Coupon::find($id);
    $data->coupon_name=$request->coupon_name;
    $data->coupon_desc=$request->coupon_desc;
    $data->type=$request->type;
    $data->value=$request->value;
    $data->start_date=date('Y-m-d', strtotime($request->start_date));
    $data->end_date=date('Y-m-d', strtotime($request->end_date));
    $data->coupon_code=$request->coupon_code;
    $data->status=$request->status;
    $data->applicable_for=$request->applicable_for;
    $data->save();
    CouponIncludeExclude::where('coupon_id',$data->id)->delete();
    if($request->has('include'))
    {
    $includes_data=$request->include;
    foreach($includes_data as $include)
    {
    $cou_data=new CouponIncludeExclude;
    $cou_data->coupon_id=$data->id;
    $cou_data->type='include';
    $cou_data->ref_id=$include;
    $cou_data->save();
    }
    }
    if($request->has('exclude'))
    {
    $exclude_data=$request->exclude;
    foreach($exclude_data as $exclude)
    {
    $cou_data=new CouponIncludeExclude;
    $cou_data->coupon_id=$data->id;
    $cou_data->type='exclude';
    $cou_data->ref_id=$exclude;
    $cou_data->save();
    }
    }
    return redirect ('/Coupon')->with("success","Successfully Updated");
  }*/

  public function update($id, Request $request)
  {
    // Validate the request data
    $this->validate($request, [
        'coupon_name' => 'required|string|max:255', // Ensure 'coupon_name' is a string and has a max length
        'coupon_desc' => 'nullable|string', // Description is optional
        'coupon_code' => 'required|string|max:50', // Coupon code is required
        'type' => 'required|string', // Type is required
        'value' => 'required|numeric|min:0', // Value must be a non-negative number
        'start_date' => 'required|date', // Start date must be a valid date
        'end_date' => 'required|date|after:start_date', // End date must be valid and after start date
        'status' => 'required|boolean', // Status must be a boolean
        'applicable_for' => 'required|integer', // Applicable for must be an integer
    ]);

    // Find the existing coupon by ID, throw 404 if not found
    $coupon = Coupon::findOrFail($id);

    // Update coupon attributes
    $coupon->coupon_name = $request->coupon_name;
    $coupon->coupon_desc = $request->coupon_desc;
    $coupon->type = $request->type;
    $coupon->value = $request->value;
    $coupon->start_date = date('Y-m-d', strtotime($request->start_date));
    $coupon->end_date = date('Y-m-d', strtotime($request->end_date));
    $coupon->coupon_code = $request->coupon_code;
    $coupon->status = $request->status;
    $coupon->applicable_for = $request->applicable_for;

    // Save updated coupon data
    $coupon->save();

    // Delete previous include/exclude data
    CouponIncludeExclude::where('coupon_id', $coupon->id)->delete();

    // Save new included items if provided
    if ($request->has('include')) {
        foreach ($request->include as $include) {
            CouponIncludeExclude::create([
                'coupon_id' => $coupon->id,
                'type' => 'include',
                'ref_id' => $include,
            ]);
        }
    }

    // Save new excluded items if provided
    if ($request->has('exclude')) {
        foreach ($request->exclude as $exclude) {
            CouponIncludeExclude::create([
                'coupon_id' => $coupon->id,
                'type' => 'exclude',
                'ref_id' => $exclude,
            ]);
        }
    }

    // Redirect with a success message
    return redirect('/Coupon')->with('success', 'Successfully Updated');
  }
  
  // ----------------------------

  /*public function delete($id)
  {
    $data=Coupon::find($id);
    if($data):
    Coupon::destroy($id);
    return redirect ('/Coupon');
    else:
    return redirect ('/Coupon')->with("error","Successfully Deleted");;
    endif;
  }*/

  public function delete($id)
  {
    // Check if the user is authenticated
    if (!Sentinel::check()) {
        return redirect('/')->with('error', 'You are not authorized to perform this action.');
    }

    $user = Sentinel::getUser();

    // Check if the user has the required role
    if ($user->inRole('super_admin')) {
        // Attempt to find the coupon by ID
        $coupon = Coupon::find($id);

        if ($coupon) {
            // Delete the coupon and redirect with a success message
            $coupon->delete();
            return redirect('/Coupon')->with('success', 'Successfully Deleted');
        } else {
            // Redirect with an error message if coupon not found
            return redirect('/Coupon')->with('error', 'Coupon not found or already deleted');
        }
    } else {
        // Redirect with an error message if the user does not have the required role
        return redirect('/')->with('error', 'You do not have permission to delete this coupon.');
    }
  }

}
