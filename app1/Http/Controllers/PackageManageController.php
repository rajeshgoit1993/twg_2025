<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Packages;
use App\Pkgtype;
use App\PkgInclusions;
use App\PkgExclusions;
use App\PkgTours;
use App\Hotel;
use App\PkgPaymentPolicy;
use App\PkgCancelPolicy;
use App\PkgVisa;
use App\PackageUploads;
use App\Cities;
use App\PkgRatingType;
use App\PkgSupplier;
use App\Locations;
use App\DaySchedule;
use App\countries;
use App\Transport;
use App\rates;
use App\Icons;
use App\State;
use App\City;
use App\PackageHotel;
use App\ImportantNotes;
use App\PackageImageGallery;
use App\Helpers\CustomHelpers;
use App\Helpers\PackagePriceHelpers;
use Image;
use App\ActivateService;
use Sentinel;
use Datatables;
use App\transferList;
use Illuminate\Support\Facades\Crypt;
use App\airlineList;
use App\Activity;
use App\iataList;
use App\Gtags;
use App\Suitable;
use App\Holiday;
use App\TourType;
use App\TourCategory;
use App\Supplier;
use App\QuoteCharges;
use App\Coupon;

class PackageManageController extends Controller
{
    
    public function search_tour_destination(Request $request)
    {
       // try {
            // Get the search term from the request
            $destination_search_value = $request->input('searchTerm');

            
            if (empty($destination_search_value)) {
                return response()->json(['error' => 'No search term provided'], 400); 
            }

$cityIds = City::where('name', 'like', "%{$destination_search_value}%")->pluck('id');
$stateIds = State::where('name', 'like', "%{$destination_search_value}%")->pluck('id');
$countryIds = countries::where('name', 'like', "%{$destination_search_value}%")->pluck('id');

// Fetch data based on the location, state, and country IDs
$data = Locations::with(['country_list', 'state_list', 'city_list'])
    ->whereIn('location', $cityIds)
    ->orWhereIn('state', $stateIds)
    ->orWhereIn('country', $countryIds)
    ->get();

// Prepare the destination array
$dest = [];
foreach ($data as $data_value) {
    $location = $data_value->city_list->name; // Start with the city name
    
    // Check if the country is India
    if ($data_value->country_list->name == 'India') {
        // Append state if available
        $location .= ($data_value->state_list && $data_value->state_list->name) 
            ? ', ' . $data_value->state_list->name
            : '';  
        // Append country name
        $location .= ', ' . $data_value->country_list->name;
        
        $dest[] = ['id' => $data_value->id, 'location' => $location];
        
    } else {
        // For other countries, append the country after the city
        $location .= ', ' . $data_value->country_list->name;
        $dest[] = ['id' => $data_value->id, 'location' => $location];
    }
}



$uniqueDest = [];
$locations = [];  
foreach ($dest as $item) {
    if (!in_array($item['location'], $locations)) {
        $locations[] = $item['location'];
        $uniqueDest[] = $item;
    }
}


// dd($uniqueDest);
// Prepare data for the response, note that we're accessing array keys here
$show = [];
foreach ($uniqueDest as $d) {
    $show[] = ['id' => $d['id'], 'text' => $d['location']]; // Using array keys, not object properties
}


            // Organize the data into the format expected by Select2
            $final_data[] = ["text" => "Suggestion", 'children' => $show];

            // Return the data as JSON
            return response()->json($final_data);

        // } catch (\Exception $e) {
        //     // Log the error for debugging purposes
        //     \Log::error('Error fetching destinations: ' . $e->getMessage());

        //     // Return a 500 error response with a JSON message
        //     return response()->json(['error' => 'Internal Server Error'], 500);
        // } 
    }
   public function search_similar_package_city(Request $request)
   {
    $searchTerm = $request->input('searchTerm');

            
            if (empty($searchTerm)) {
                return response()->json(['error' => 'No search term provided'], 400); 
            }
    $matchingCityIds    = DB::table('city')->where('name', 'LIKE', "$searchTerm%")->pluck('id')->toArray();


$package_data = DB::table('rt_packages')->select('id','city', 'country', 'state')->get()->filter(function ($item) use ($matchingCityIds) {
    $cityIds = @unserialize($item->city) ?: [];
    return array_intersect($matchingCityIds, $cityIds);
});

$spcities = [];

foreach ($package_data as $data_value) {
    $cities    = @unserialize($data_value->city) ?: [];
    $countries = @unserialize($data_value->country) ?: [];
    $states    = @unserialize($data_value->state) ?: [];

    foreach ($cities as $row => $col) {
    if (!isset($countries[$row])) continue; 
    
    if ($countries[$row] == '101') {
        // Fetch state and country names
        $stateName = !empty($states[$row]) ? CustomHelpers::get_master_table_data('states', 'id', (int)$states[$row], 'name') . ', ' : '';
        $countryName = CustomHelpers::get_master_table_data('countries', 'id', (int)$countries[$row], 'name');
        $cityName = CustomHelpers::get_master_table_data('city', 'id', (int)$cities[$row], 'name');

        $spcities[] = [
            'id' => $cities[$row], 
            'location' => "{$cityName} ({$stateName}{$countryName})"
        ];
    } else {
        $cityName = CustomHelpers::get_master_table_data('city', 'id', (int)$cities[$row], 'name');
        $countryName = CustomHelpers::get_master_table_data('countries', 'id', (int)$countries[$row], 'name');

        $spcities[] = [
            'id' => $cities[$row], 
            'location' => "{$cityName} ({$countryName})"
        ];
    }
}


}


$uniqueDest = [];
$locations = [];  
foreach ($spcities as $item) {
    if (!in_array($item['location'], $locations)) {
        $locations[] = $item['location'];
        $uniqueDest[] = $item;
    }
}


// dd($uniqueDest);
// Prepare data for the response, note that we're accessing array keys here
$show = [];
foreach ($uniqueDest as $d) {
    $show[] = ['id' => $d['id'], 'text' => $d['location']]; // Using array keys, not object properties
}


            // Organize the data into the format expected by Select2
            $final_data[] = ["text" => "Suggestion", 'children' => $show];

            // Return the data as JSON
            return response()->json($final_data);


   }
    // Display a listing of the transfer types
    public function get_transfertype(Request $request) 
    {
        // Retrieve transfer types by selecting title and transport_type from the transferList model
        $data = transferList::select("title", "transport_type")->get();

        // Return the data as a JSON response with a status code of 200
        return response()->json($data, 200);
    }
    
    /*----------*/

    // activities lists
    /*public function get_activitieslist(Request $request) 
    {
      $cities_list=$request->cities_list;
     $data=Activity::select("activity")->whereIn('location',$cities_list)->get();
     foreach($data as $single):
      echo "<option value='".$single->activity."'>".$single->activity." </option>";
     endforeach;
    }*/

    // activities lists
    public function get_activitieslist(Request $request) 
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
          'cities_list' => 'required|array|min:1', // Ensure cities_list is an array and not empty
          ]);

        if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 422);
        }

        // Extract cities_list
        $cities_list = $request->cities_list;

        // Fetch activities based on the cities_list
        $data = Activity::select("activity")->whereIn('location', $cities_list)->get();

        // Check if data is empty and handle accordingly
        if ($data->isEmpty()) {
          return response()->json(['message' => 'No activities found.'], 404);
        }

        // Return activities as options
        $options = '';
        foreach ($data as $single) {
          $options .= "<option value='" . htmlspecialchars($single->activity) . "'>" . htmlspecialchars($single->activity) . "</option>";
        }

        return response()->json(['options' => $options]);
    }

    /*----------*/

    /*public function get_similarpkgs(Request $request) 
    {
      $data=Packages::select(array('title', 'city','id'))->get();
      return response()->json($data, 200);
      //if(count($data)>0):
      //foreach($data as $single):
      //echo "<option value='".$single->title."'>".$single->title." </option>";
      //endforeach;
      //else:
      //echo "<option value='No Result Found'>No Result Found</option>";
      //endif;
    }*/

    public function get_similarpkgs(Request $request) 
    {
        // Retrieve similar packages by selecting title, city, and id from the Packages model
        $data = Packages::select(['title', 'city', 'id'])->get();

        // Return the data as a JSON response with a status code of 200
        return response()->json($data, 200);
    }

    /*----------*/
  
    /*public function get_similarseing(Request $request) 
    {
      $data=PkgTours::select(array('location', 'activity','id'))->get();
      return response()->json($data, 200);
    }*/

    public function get_similarseing(Request $request) 
    {
        // Retrieve similar sightseeing tours by selecting location, activity, and id from the PkgTours model
        $data = PkgTours::select(['location', 'activity', 'id'])->get();

        // Return the data as a JSON response with a status code of 200
        return response()->json($data, 200);
    }

    /*----------*/

    // tour package manager
    /*public function index() 
    {
      // Check if the 'tour_package_manager' service is activated
      $check_data = ActivateService::where('services', '=', 'tour_package_manager')->first();

      // If the service is activated
      if ($check_data->activation == 1) :
          // Fetch paginated packages, ordered by creation date
          $all_packages = DB::table('rt_packages')->orderBy('created_at', 'desc')->paginate(5);
          
          // Fetch all package data
          $all_data = DB::table('rt_packages')->get();

          // Initialize variable for storing package countries
          $package_countries = "";

          // Loop through each package to extract country information
          foreach ($all_data as $package) :
              $country = unserialize($package->country); // Unserialize the country data

              // If the country data is an array, extract each country
              if (is_array($country)) {
                  foreach ($country as $cit) {
                      $package_countries .= $cit . ","; // Concatenate country names with a comma
                  }
              }
          endforeach;

          // Convert concatenated countries into an array
          $pac_countries = explode(",", $package_countries);

          // Remove duplicate and empty values from the array
          $pac_countries = array_unique($pac_countries);
          $pac_countries = array_filter($pac_countries);

          // Return the view with the list of unique countries
          return view('manage_packages.list', compact('pac_countries'));

      // If the service is not activated, return a 404 error page
      else :
          return response()->view('error.404', [], 404);
      endif;
    }*/

    // tour package manager
    public function index() 
    {
        // Check if the 'tour_package_manager' service is activated
        $check_data = ActivateService::where('services', 'tour_package_manager')->first();

        // If the service is not activated, return a 404 error page
        if ($check_data->activation != 1) {
            return response()->view('error.404', [], 404);
        }

        // Fetch only the 'country' field from all packages
        $all_data = DB::table('rt_packages')->pluck('country');

        // Initialize an empty array for storing unique countries
        $pac_countries = [];

        // Loop through each serialized country data
        foreach ($all_data as $serializedCountry) {
            $country = @unserialize($serializedCountry); // Suppress errors if unserialization fails

            // If it's a valid array, merge it into the countries array
            if (is_array($country)) {
                $pac_countries = array_merge($pac_countries, $country);
            }
        }

        // Remove duplicate and empty values
        $pac_countries = array_unique(array_filter($pac_countries));
        sort($pac_countries);
        $countries_list=DB::table('countries')
    ->whereIn('id', $pac_countries)
    ->get();
        // Sort the countries alphabetically
  
        // Return the view with the list of unique countries
        return view('manage_packages.list', compact('countries_list'));
    }

    /*----------*/

    

    // select state from country
    public function addcountry(Request $request) 
    {
        // Get the selected country from the request
        $addcountry = $request->addcountry;

        // Return early if no country is provided
        if (!$addcountry) {
            return response()->json(['error' => 'No country provided'], 400);
        }
      $country_id[]=$addcountry;
        // Fetch all packages where the country matches the provided value
        
        $all_data = DB::table('rt_packages')
             ->get(['state','country']) 
             ->filter(function ($package) use ($country_id) {
        $countryid = @unserialize($package->country) ?: [];  

        return array_intersect($countryid, $country_id);    
        });

        $package_states = [];

        // Loop through all the package states and unserialize each one
        foreach ($all_data as $serializedStates) {
            $states = @unserialize($serializedStates->state); // Suppress errors if unserialization fails

            // If unserialization is successful and results in an array, merge into the main states array
            if (is_array($states)) {
                $package_states = array_merge($package_states, $states);
            }
        }
      
      
        // Remove duplicate, empty values from states
        $package_states = array_unique(array_filter($package_states));
        sort($package_states); // Sort the states alphabetically
      
        // Output the default option
        echo "<option value='0'>Select State</option>";

        // Loop through each unique state and output an option if it belongs to the selected country
        foreach ($package_states as $state) {
           $state_data=DB::table('states')
              ->where('id',$state)
              ->first();
            if($state_data->country_id==$addcountry )
            {
                echo "<option value='" . htmlspecialchars($state, ENT_QUOTES, 'UTF-8') . "'>" . $state_data->name . "</option>";
            }
            
        }
    }

    /*----------*/

    // select city from state
    

    

    // select city from state
    public function addstate(Request $request) 
    {
        // Get country and state from the request
        $addcountry = $request->addcountry;
        $addstate = $request->addstate;

        // Check if addstate is provided
        if (empty($addstate)) {
            // Log if addstate is missing or empty
            //\Log::error("State not provided in the request (PackageManageController->addstate).");
            echo "<option value='0'>State not provided</option>";
            return;
        }
$state_id[]=$addstate;
$country_id[]=$addcountry;
        // Fetch all packages that match the country and state
 $all_data = DB::table('rt_packages')
             ->get(['city','state','state']) 
             ->filter(function ($package) use ($country_id, $state_id) {
        $countryid = @unserialize($package->country) ?: [];  
        $stateid = @unserialize($package->state) ?: [];
        return array_intersect($countryid, $country_id) || array_intersect($stateid, $state_id);    
        });

        // Initialize an array to hold unique cities
        $package_cities = [];

        // Loop through the packages to extract cities
        foreach ($all_data as $package) {
            // Unserialize the city data from the package
            $cities = unserialize($package->city);

            // Ensure cities is an array before merging
            if (is_array($cities)) {
                $package_cities = array_merge($package_cities, $cities);
            }
        }

        // Remove duplicates and empty values from the cities
        $package_cities = array_unique(array_filter($package_cities));

        // Sort cities alphabetically
        sort($package_cities);

        // Fetch the state code from the database
        $state_code = DB::table('states')
                      ->where('id', $addstate)
                      ->first();

        // Initialize an array for valid cities
        $cities_options = [];

        // Check if state_code exists
        if ($state_code) {
            // Loop through the unique, filtered cities
            foreach ($package_cities as $single) {
                // Fetch the city record from the database
                $st_code = DB::table('city')
                            ->where('id', $single)
                            ->first();

                // Check if the city belongs to the correct state
                if ($st_code && $st_code->state_id == $state_code->id) {
                    $cities_options[] = $single;

                }
            }
        } else {
            // Log or handle the case when state code is not found
            \Log::error("State not found: " . $addstate);
            echo "<option value=''>State not found</option>";
            return;
        }

        // Output the default "Select City" option
        echo "<option value=''>Select City</option>";

        // Loop through the valid cities and generate options
        foreach ($cities_options as $city) {
            // Output each city as an option
            $st_code = DB::table('city')
                            ->where('id', $city)
                            ->first();
                            
               if($st_code->state_id==$addstate) 
               {
              echo "<option value='" . htmlspecialchars($st_code->id, ENT_QUOTES, 'UTF-8') . "'>" 
                 . htmlspecialchars($st_code->name, ENT_QUOTES, 'UTF-8') . "</option>";  
               }            
            
        }
    }


    /*----------*/

    // push up tour packages
    /*public function up_package(Request $request) 
    {
        // Get the package ID from the request
        $package_id = $request->pak_id;

        // Find the package by its ID
        $data = Packages::find($package_id);
        $sort = $data->sort;

        // If the sort value is not empty, 1, or 0
        if ($sort != '' && $sort != 1 && $sort != 0) {
            $negative_sort = (int)$sort - 1; // Decrease the sort value by 1

            // Check for another package with the updated sort value
            $check_data = Packages::where('sort', '=', $negative_sort)->first();
            if ($check_data) {
                $check_data->sort = $sort; // Update the sort value of the found package
                $check_data->save();
            }

            // Update the current package's sort value
            $data->sort = $negative_sort;
            $data->save();
        } 
        // If the sort value is empty or 0
        elseif ($sort == '' || $sort == 0) {
            $previous_id = '';
            
            // Get the first package with a sort value of 1
            $previous = Packages::where('sort', '=', 1)->first();
            if ($previous) {
                $previous->sort = 2; // Update its sort value to 2
                $previous->save();
                $previous_id = $previous->id; // Store the ID of the previous package
            }

            // Update other packages' sort values
            if ($previous_id != '') {
                $i = 2;
                do {
                    // Find the next package with the current sort value
                    $check_data = Packages::where('sort', '=', $i)->whereNotIn('id', [$previous_id])->first();
                    if ($check_data) {
                        $check_data->sort = $i + 1; // Increment its sort value
                        $check_data->save();
                        $previous_id = $check_data->id; // Update previous ID
                    }
                    $i++;
                } while ($check_data);
            }

            // Set the current package's sort value to 1
            $data->sort = 1;
            $data->save();
        }

        // Output success message
        echo 'success';
    }*/

    // push up tour packages
    public function up_package(Request $request) 
    {
        // Retrieve the package ID from the request
        $package_id = $request->pak_id;

        // Find the package by ID
        $package = Packages::find($package_id);

        // If the package is not found, return an error response
        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }

        $sort = $package->sort;

        // Check if the sort value is valid and not already the lowest
        if ($sort !== '' && $sort != 1 && $sort != 0) {
            $negative_sort = (int)$sort - 1;

            // Check if a package exists with the negative sort value
            $check_data = Packages::where('sort', '=', $negative_sort)->first();
            if ($check_data) {
                $check_data->sort = $sort; // Update sort of the found package
                $check_data->save();
            }

            $package->sort = $negative_sort; // Update current package sort
            $package->save();
            return response()->json(['status' => 'success']);
        }

        // Handle the case where sort is empty or zero
        $previousPackage = Packages::where('sort', '=', 1)->first();
        if ($previousPackage) {
            $previousPackage->sort = 2; // Update the sort of the previous package
            $previousPackage->save();
        }

        $i = 2; // Start sorting from 2
        while ($check_data) {
            $check_data = Packages::where('sort', '=', $i)->where('id', '!=', $previousPackage ? $previousPackage->id : null)->first();
            if ($check_data) {
                $check_data->sort = $i + 1; // Update sort of found package
                $check_data->save();
            }
            $i++;
        }

        $package->sort = 1; // Set the current package sort to 1
        $package->save();

        return response()->json(['status' => 'success']);
    }

    /*----------*/

    /*// package lists
    public function package_lists(Request $request) 
    {
        $country=$request->country;
        $state=$request->state;
        $city=$request->city;
        if($country=='NA' && $state=='NA' && $city=='NA') {
          // $data =  DB::table('rt_packages')->orderBy('sort', 'asc')->get();
          $data =  DB::table('rt_packages')->orderBy('updated_at', 'desc')->get();
        } elseif($country!='NA' && $state=='NA' && $city=='NA') {
          // $data=DB::table('rt_packages')->where([['country', 'like', '%' . $country . '%']])->orderBy('sort', 'asc')->get();
          $data=DB::table('rt_packages')->where([['country', 'like', '%' . $country . '%']])->orderBy('updated_at', 'desc')->get();
        } elseif($country!='NA' && $state!='NA' && $city=='NA') {
          // $data=DB::table('rt_packages')->where([['country', 'like', '%' . $country . '%'],['    state', 'like', '%' . $state . '%']])->orderBy('sort', 'asc')->get();
          $data=DB::table('rt_packages')->where([['country', 'like', '%' . $country . '%'],['    state', 'like', '%' . $state . '%']])->orderBy('updated_at', 'desc')->get();
        } elseif($country!='NA' && $state!='NA' && $city!='NA') {
          // $data=DB::table('rt_packages')->where([['country', 'like', '%' . $country . '%'],['state', 'like', '%' . $state . '%'],['city', 'like', '%' . $city . '%']])->orderBy('sort', 'asc')->get();
          $data=DB::table('rt_packages')->where([['country', 'like', '%' . $country . '%'],['state', 'like', '%' . $state . '%'],['city', 'like', '%' . $city . '%']])->orderBy('updated_at', 'desc')->get();
        }
        // if($country=='NA')
        // {
        //  $data =  DB::table('rt_packages')->orderBy('sort', 'asc')->get();
        // }
        // else
        // {
        //   $data=DB::table('rt_packages')->where([['country', 'like', '%' . $country . '%']])->orderBy('sort', 'asc')->get();
        // }
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function($row) {
              $gallery_id=CustomHelpers::get_first_galleryid($row->id);
              if(CustomHelpers::get_image_gallery($gallery_id,'thum_small')!="0"):
                $src=CustomHelpers::get_image_gallery($gallery_id,'thum_small');
                $package_list_data="<img src='$src' href='#' class='img-responsive'>";
              elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_small')=="0"):
                $src=url('/').'/public/uploads/default_profile_image.png';
                $package_list_data="<img src='$src' href='#' class='img-responsive'>";
              endif;
              return $package_list_data;
            })
            ->addColumn('package_name', function($row) {
              if(is_numeric($row->id)):
                $href_id1=CustomHelpers::custom_encrypt($row->id);
                $form_action=url("/holidays/".str_slug($row->title)).'?package_id='.$href_id1;
                $package_url=url('/packages-detail/'.Crypt::encrypt(['id'=>$row->id]));
                $package_list_data="
                <a href='$form_action' target='_blank'>$row->title $row->sort</a> <br>";
              endif;
              if($row->sort == 1):
              else:
                $package_list_data.=" <button type='button' style='padding:2px 5px' class='btn btn-sm btn-danger up' value='$row->id'>UP</button>";
              endif;
              return $package_list_data;
            })
            ->addColumn('no_of_days', function($row) {
              $no_of_days="$row->duration Nights";
              return $no_of_days;
            })
            ->addColumn('price', function($row) {
              $package_list_data='';
              $new_price=PackagePriceHelpers::get_new_pricing_data($row->id,date('Y-m-d'));
              if($new_price!='na'):
              if($new_price['actual_price']==$new_price['discount_price']):
                $pr=$new_price['actual_price'];
                $package_list_data="&#x20B9 $pr";
              else:
                $dicount=(int)$new_price['actual_price']-(int)$new_price['discount_price'];
                $percentage=$dicount/$new_price['actual_price']*100;
                $pr=$new_price['discount_price'];
                $package_list_data="&#x20B9 $pr";
              endif;
              else:
                $package_list_data="On Request";
              endif;
              return $package_list_data;
            })
            ->addColumn('destination', function($row) {
              $country_name=substr(implode(',',unserialize($row->country)),0,15);
              $destination="$country_name";
              if(strlen(implode(',',unserialize($row->country)))>=15):
                $destination.=" ... ";
              endif;
              return $destination;
            })
            ->addColumn('supply_name', function($row) {
              if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
                $supply_name=CustomHelpers::get_supplier_data($row->id,"supplier_name");
              else:
                $supply_name="NA";
              endif;
              return $supply_name;
            })
            ->addColumn('image_upload', function($row) {
              $upload_id=url('/').'/packageUploads/'.$row->id;
              $image_upload="<a href='$upload_id'>Uploads</a>";
              return $image_upload;
            })
            ->addColumn('package_status', function($row) {
              if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
              if($row->status == 1):
                $supplier_name="<button type='button' class='btn-success btn_enable' value='$row->id'>Disable</button>";
              else:
                $supplier_name="<button type='button' class='btn-danger btn_enable' value='$row->id'>Enable</button>";
              endif;
              else:
                $supplier_name="NA";
              endif;
              return $supplier_name;
            })
            ->addColumn('search_status', function($row) {
              if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
              if($row->search_status == 1):
                $search_status="<button type='button' class='btn-success btn_search_enable' value='$row->id'>Disable</button>";
              else:
                $search_status="<button type='button' class='btn-danger btn_search_enable' value='$row->id'>Enable</button>";
              endif;
              else:
                $search_status="NA";
              endif;
              return $search_status;
            })
            ->addColumn('front_show', function($row) {
              if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
              if($row->front_show == 1):
                $package_list_data="<button type='button' class='btn-success btn_front_enable' value='$row->id'>Disable</button>";
              else:
                $package_list_data="<button type='button' class='btn-danger btn_front_enable' value='$row->id'>Enable</button>";
              endif;
              else:
                $package_list_data="NA";
              endif;
              return $package_list_data;
            })
            ->addColumn('action', function($row) {
              $form_url=url('/delete-package');
              $del_id="packagedel$row->id";
              $edit_pac_url=url('/editpackage/'.$row->id);
              $clone_pac_url=url('/clonepackage/'.$row->id);
              $package_list_data="<form action='$form_url'  method='POST'
              id='$del_id'>";
              $package_list_data.= csrf_field();
              if(Sentinel::check()):
              if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $package_list_data.="<input type='hidden' name='id' value='$row->id'/></form>";
              endif;
              endif;
              $package_list_data.="<span class='btn-group'>";
              if(Sentinel::check()):
              if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $package_list_data.="<a class='btn btn-default btn-xcrud btn btn-warning' href='$edit_pac_url'>
              Edit
              </a>
              <a class='btn btn-default btn-xcrud btn btn-info' href='$clone_pac_url'>Clone</a>";
              endif;
              endif;
              if(Sentinel::check()):
              if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $package_list_data.="<button id='$del_id' class='btn btn-danger deletePackage' > Delete </button>";
              endif;
              endif;
              $package_list_data.="</span>";
              return $package_list_data;
            })
            ->make(true);
    }*/

    /*// Package lists function
    public function package_lists(Request $request) 
    {
        // Retrieve the country, state, and city from the request
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        
        // Check for different combinations of country, state, and city and fetch packages accordingly
        if ($country == 'NA' && $state == 'NA' && $city == 'NA') {
            // Fetch all packages ordered by updated_at (descending)
            $data = DB::table('rt_packages')->orderBy('updated_at', 'desc')->get();
        } elseif ($country != 'NA' && $state == 'NA' && $city == 'NA') {
            // Fetch packages filtered by country
            $data = DB::table('rt_packages')
                ->where('country', 'like', '%' . $country . '%')
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($country != 'NA' && $state != 'NA' && $city == 'NA') {
            // Fetch packages filtered by country and state
            $data = DB::table('rt_packages')
                ->where([
                    ['country', 'like', '%' . $country . '%'],
                    ['state', 'like', '%' . $state . '%']
                ])
                ->orderBy('updated_at', 'desc')
                ->get();
        } elseif ($country != 'NA' && $state != 'NA' && $city != 'NA') {
            // Fetch packages filtered by country, state, and city
            $data = DB::table('rt_packages')
                ->where([
                    ['country', 'like', '%' . $country . '%'],
                    ['state', 'like', '%' . $state . '%'],
                    ['city', 'like', '%' . $city . '%']
                ])
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        // Return data formatted as a DataTable
        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('image', function($row) {
                $gallery_id = CustomHelpers::get_first_galleryid($row->id);
                $src = CustomHelpers::get_image_gallery($gallery_id, 'thum_small');
                
                if ($src != "0") {
                    $src = asset($src);  // Use asset helper for correct path
                    return "<img src='$src' class='list-item-image'>";
                } else {
                    //$src = asset('public/uploads/default_profile_image.png');  // Use asset for default image
                    //return "<img src='$src' class='list-item-image'>";
                    return "<div class='list-item-image makeflex align-center justify-center'>No Image Available</div>"; // Return 'No Image Available' message
                }
            })

        ->addColumn('package_name', function($row) {
            $package_list_data = '';

            // Check if the ID is numeric
            if (is_numeric($row->id)) {
                // Encrypt the ID and generate a slug for the package title
                $encrypted_id = CustomHelpers::custom_encrypt($row->id);
                $slug_title = str_slug($row->title);
                $form_action = url("/holidays/" . $slug_title) . '?package_id=' . $encrypted_id;

                // Generate the clickable link for the package name
                $package_list_data = "<a href='" . e($form_action) . "' target='_blank'>" . e($row->title) . "</a><br>";
            }

            // Return the link as package name
            return $package_list_data;
        })


        ->addColumn('push_to_up', function($row) {
            $push_button = '';
            if ($row->sort != 1) {
              //$push_button = "$row->sort <br>"; // Display the sort value separately
              $push_button .= "<button type='button' class='btn btn-sm btn-default up' value='$row->id'>Push to up ($row->sort)</button>"; // Display  "Push to up" button
            }
            return $push_button;  // Return only the button in this column
        })

        // Add combined duration and price column
        ->addColumn('duration_and_price', function($row) {
            // Format duration
            $duration = "$row->duration Nights";

            // Fetch and format price (including discount logic)
            $package_list_data = '';
            $new_price = PackagePriceHelpers::get_new_pricing_data($row->id, date('Y-m-d'));
            if ($new_price != 'na') {
                if ($new_price['actual_price'] == $new_price['discount_price']) {
                    $pr = $new_price['actual_price'];
                    $package_list_data = "&#x20B9 $pr";
                } else {
                    $discount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
                    $percentage = $discount / $new_price['actual_price'] * 100;
                    $pr = $new_price['discount_price'];
                    $package_list_data = "&#x20B9 $pr";
                }
            } else {
                $package_list_data = "On Request";
            }

            // Combine duration and price into one string
            return $duration . ' <br> ' . $package_list_data;
        })

        // Add destination column
        ->addColumn('destination', function($row) {
            $country_name = substr(implode(',', unserialize($row->country)), 0, 15);
            $destination = "$country_name";
            if (strlen(implode(',', unserialize($row->country))) >= 15) {
                $destination .= " ... ";
            }
            return $destination;
        })

        // Add supplier name column (only for certain roles)
        ->addColumn('supply_name', function($row) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                return CustomHelpers::get_supplier_data($row->id, "supplier_name");
            } else {
                return "NA";
            }
        })

        ->addColumn('image_upload', function($row) {
            // Use asset helper to ensure URL is properly generated
            $upload_id = url('/packageUploads/' . $row->id);
            return "<a href='$upload_id'><button class='btn btn-sm btn-info'>Uploads</button></a>";
        })

        // Add search status enable/disable button (hide from search but direct link)
        ->addColumn('search_status', function($row) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                if ($row->search_status == 1) {
                    return "<button type='button' class='btn btn-sm btn-success btn_search_enable' value='$row->id'>Enabled</button>";
                } else {
                    return "<button type='button' class='btn btn-sm btn-danger btn_search_enable' value='$row->id'>Disabled</button>";
                }
            } else {
                return "NA";
            }
        })

        // Add package status enable/disable button (second page)
        ->addColumn('package_status', function($row) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                if ($row->status == 1) {
                    return "<button type='button' class='btn btn-sm btn-success btn_enable' value='$row->id'>Enabled</button>";
                } else {
                    return "<button type='button' class='btn btn-sm btn-danger btn_enable' value='$row->id'>Disabled</button>";
                }
            } else {
                return "NA";
            }
        })

        // home page package enable/disable button (home page)
        ->addColumn('front_show', function($row) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                if ($row->front_show == 1) {
                    return "<button type='button' class='btn btn-sm btn-success btn_front_enable' value='$row->id'>Enabled</button>";
                } else {
                    return "<button type='button' class='btn btn-sm btn-danger btn_front_enable' value='$row->id'>Disabled</button>";
                }
            } else {
                return "NA";
            }
        })

        ->addColumn('action', function($row) {
            $form_url = url('/delete-package');
            $del_id = "packagedel$row->id";
            $edit_pac_url = url('/editpackage/' . $row->id);
            $clone_pac_url = url('/clonepackage/' . $row->id);
            $package_list_data = '';

            // Check if user is authenticated
            if (Sentinel::check()) {
                // Get the current user
                $user = Sentinel::getUser();
                
                // Only administrators or super_admins should see these actions
                if ($user->inRole('administrator') || $user->inRole('super_admin')) {
                    // Add form for deleting the package
                    $package_list_data .= "<form action='$form_url' method='POST' id='$del_id'>";
                    $package_list_data .= csrf_field();
                    $package_list_data .= "<input type='hidden' name='id' value='$row->id'/></form>";
                    
                    // Add edit, clone, and delete buttons
                    $package_list_data .= "<span class='btn-action'>";
                    $package_list_data .= "<a class='btn btn-sm btn-warning' href='$edit_pac_url'>Edit</a>";
                    $package_list_data .= "<a class='btn btn-sm btn-info' href='$clone_pac_url'>Clone</a>";
                    $package_list_data .= "<button id='$del_id' class='btn btn-sm btn-danger deletePackage'>Delete</button>";
                    $package_list_data .= "</span>";
                }
            }
            
            return $package_list_data;
        })

        ->make(true);
    }*/

    // Package lists function
    public function package_lists(Request $request) 
    {
    
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;


$query = DB::table('rt_packages')
    ->orderBy('country', 'asc')
    ->orderBy('updated_at', 'desc');

$data = $query->get();

// Apply filtering
$filteredData = $data->filter(function ($package) use ($country, $state, $city) {
    $packageCountries = @unserialize($package->country);
    $packageStates = @unserialize($package->state);
    $packageCities = @unserialize($package->city);

    // Ensure they are arrays; otherwise, default to an empty array
    $packageCountries = is_array($packageCountries) ? $packageCountries : [];
    $packageStates = is_array($packageStates) ? $packageStates : [];
    $packageCities = is_array($packageCities) ? $packageCities : [];

    // Filtering conditions
    $matchCountry = !empty($country) ? !empty(array_intersect($packageCountries, [$country])) : true;
    $matchState = !empty($state) ? !empty(array_intersect($packageStates, [$state])) : true;
    $matchCity = !empty($city) ? !empty(array_intersect($packageCities, [$city])) : true;

    return $matchCountry && $matchState && $matchCity; 
});

// Convert to array if needed
$filteredData = $filteredData->values();

        // Return data formatted as a DataTable
        return Datatables::of($filteredData)
            ->addIndexColumn()

            // tour thumb image
            ->addColumn('image', function($row) {
                $gallery_id = CustomHelpers::get_first_galleryid($row->id);
                $src = CustomHelpers::get_image_gallery($gallery_id, 'thum_small');
                
                if ($src != "0") {
                    $src = asset($src);  // Use asset helper for correct path
                    return "<div class='list-item-image'><img src='$src' title='img'></div>";
                } else {
                    $src = url('public/uploads/default-img.webp');  // Use asset for default image
                    return "<img src='$src' class='list-item-image' title='img'>";
                    //return "<div class='list-item-image makeflex align-center justify-center'>No Image Available</div>"; // Return 'No Image Available' message
                }
            })

            // package name
            ->addColumn('package_name', function($row) {
                $package_list_data = '';

                // Check if the ID is numeric
                if (is_numeric($row->id)) {
                    // Encrypt the ID and generate a slug for the package title
                    $encrypted_id = CustomHelpers::custom_encrypt($row->id);
                    $slug_title = str_slug($row->title);
                    $form_action = url("/holidays/" . $slug_title) . '?package_id=' . $encrypted_id;

                    // Generate the clickable link for the package name
                    $package_list_data = "<a href='" . e($form_action) . "' target='_blank'>" . e($row->title) . "</a><br>";
                }

                // Check for user roles to display supplier name
                if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                    // Add the supplier name if the user has the required role
                    $supplier_name = CustomHelpers::get_supplier_data($row->id, "supplier_name");
                    // Append supplier name in parentheses only if it's not empty or null
                    if (!empty($supplier_name)) {
                        $package_list_data .= "<span class='font12'>(" . e($supplier_name) . ")</span>";
                    }
                }

                // Return the link as package name
                return $package_list_data;
            })

            // search order
            ->addColumn('push_to_up', function($row) {
                $push_button = '';
                if ($row->sort != 1) {
                  //$push_button = "$row->sort <br>"; // Display the sort value separately
                  $push_button .= "<button type='button' class='btn btn-sm btn-default up' value='$row->id'>Push to up ($row->sort)</button>"; // Display  "Push to up" button
                }
                return $push_button;  // Return only the button in this column
            })

            // Add combined duration and destination column
            ->addColumn('duration_and_destination', function($row) {
    // Format duration
    $duration_label = "<u>Duration</u>";
    $city1 = @unserialize($row->city);
    $days = @unserialize($row->days);
    $duration_html = "";

    if (is_array($city1) && is_array($days)) {
        $city1_count = count($city1);
        $i = 0;

        foreach ($city1 as $index => $city) {
            $duration_html .= "<span class='itemDestDuration'>" . htmlspecialchars($days[$index] ?? '') . "N&nbsp;</span>";
            $duration_html .= "<span class='itemDestName'>" . htmlspecialchars(CustomHelpers::get_master_table_data('city', 'id', (int)$city, 'name')) . "</span>";

            if ($i < ($city1_count - 1)) {
                $duration_html .= "<span class='itemDestSepr'>&nbsp;&rarr;&nbsp;</span>";
            }

            if (($i + 1) % 3 === 0) {
                $duration_html .= "</span>";
            }

            $i++; // Increment the counter
        }
    } else {
        $duration_html = "duration loading...";
    }
   

   
    return $duration_html;
})


            // image upload
            ->addColumn('image_upload', function($row) {
                // Use asset helper to ensure URL is properly generated
                $upload_id = url('/packageUploads/' . $row->id);
                return "<a href='$upload_id'><button class='btn btn-sm btn-info'>Uploads</button></a>";
            })

            // Add combined price and price update column
            ->addColumn('price_and_update', function($row) {
                // Fetch and format price
                $price_label = "<u>Price</u>";
                $package_list_data = '';
                $new_price = PackagePriceHelpers::get_new_pricing_data($row->id, date('Y-m-d'));

                if ($new_price != 'na') {
                    if ($new_price['actual_price'] == $new_price['discount_price']) {
                        $pr = $new_price['actual_price'];
                        $package_list_data = "<div class='text-center apndTop10'>{$price_label}<br>&#x20B9 $pr</div>";
                    } else {
                        $pr = $new_price['discount_price'];
                        $package_list_data = "<div class='text-center apndTop10'>{$price_label}<br>&#x20B9 $pr</div>";
                    }
                } else {
                    $package_list_data = "<div class='text-center apndTop10'>{$price_label}<br>On Request</div>";
                }

                // Price update button
                $price_update_button = "<button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#priceUpdateModal$row->id'>Price Update</button>";

                // Create the modal structure
                $price_update_modal = "
                    <div class='modal fade' id='priceUpdateModal$row->id' tabindex='-1' role='dialog' aria-labelledby='priceUpdateLabel$row->id' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='priceUpdateLabel$row->id'>Price Update</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <form id='priceUpdateForm$row->id'>
                                    <div class='modal-body'>
                                        <div class='form-group'>
                                            <label for='priceInput$row->id'>New Price</label>
                                            <input type='number' class='form-control' id='priceInput$row->id' name='price' placeholder='Enter new price'>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='submit' class='btn btn-success'>Update Price</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                ";

                // Return price update button with modal first, followed by price display
                return $price_update_button . $price_update_modal . '<br>' . $package_list_data;
            })

            // Add search status enable/disable button (hide from search but direct link)
            ->addColumn('search_status', function($row) {
                if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                    if ($row->search_status == 1) {
                        return "<button type='button' class='btn btn-sm btn-success btn_search_enable' value='$row->id'>Enabled</button>";
                    } else {
                        return "<button type='button' class='btn btn-sm btn-danger btn_search_enable' value='$row->id'>Disabled</button>";
                    }
                } else {
                    return "NA";
                }
            })

            // Add package status enable/disable button (second page)
            ->addColumn('package_status', function($row) {
                if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                    if ($row->status == 1) {
                        return "<button type='button' class='btn btn-sm btn-success btn_enable' value='$row->id'>Enabled</button>";
                    } else {
                        return "<button type='button' class='btn btn-sm btn-danger btn_enable' value='$row->id'>Disabled</button>";
                    }
                } else {
                    return "NA";
                }
            })

            // home page package enable/disable button (home page)
            ->addColumn('front_show', function($row) {
                if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                    if ($row->front_show == 1) {
                        return "<button type='button' class='btn btn-sm btn-success btn_front_enable' value='$row->id'>Enabled</button>";
                    } else {
                        return "<button type='button' class='btn btn-sm btn-danger btn_front_enable' value='$row->id'>Disabled</button>";
                    }
                } else {
                    return "NA";
                }
            })

            // action
            ->addColumn('action', function($row) {
                $form_url = url('/delete-package');
                $del_id = "packagedel$row->id";
                $edit_pac_url = url('/editpackage/' . $row->id);
                $clone_pac_url = url('/clonepackage/' . $row->id);
                $package_list_data = '';

                // Check if user is authenticated
                if (Sentinel::check()) {
                    // Get the current user
                    $user = Sentinel::getUser();
                    
                    // Only administrators or super_admins should see these actions
                    if ($user->inRole('administrator') || $user->inRole('super_admin')) {
                        // Add form for deleting the package
                        $package_list_data .= "<form action='$form_url' method='POST' id='$del_id'>";
                        $package_list_data .= csrf_field();
                        $package_list_data .= "<input type='hidden' name='id' value='$row->id'/></form>";
                        
                        // Add edit, clone, and delete buttons
                        $package_list_data .= "<span class='btn-action'>";
                        $package_list_data .= "<a href='$edit_pac_url'><button type='button' class='btn btn-sm btn-warning'>Edit</button></a>";
                        $package_list_data .= "<a href='$clone_pac_url'><button type='button' class='btn btn-sm btn-info'>Clone</button></a>";
                        $package_list_data .= "<button id='$del_id' class='btn btn-sm btn-danger deletePackage'>Delete</button>";
                        $package_list_data .= "</span>";
                    }
                }
                
                return $package_list_data;
            })

            ->make(true);
    }

    /*----------*/

    /*public function package_list_filter_data(Request $request) 
    {
      $key=$request->key;

      if($key!="" && $key!="0") {
         $data=DB::table('rt_packages')->where([['title', 'like', '%' . $key . '%']])->orwhere([['continent', 'like', '%' . $key . '%']])->orwhere([['country', 'like', '%' . $key . '%']])->orwhere([['state', 'like', '%' . $key . '%']])->orwhere([['city', 'like', '%' . $key . '%']])
         ->orderBy('created_at', 'desc')->paginate(5);
      } else {
        $data = DB::table('rt_packages')->orderBy('created_at', 'desc')->paginate(5);
      }
      $data_value=CustomHelpers::get_package_list($data,$request->page);
      echo $data_value;
    }*/

    public function package_list_filter_data(Request $request) 
    {
        // Retrieve the search key from the request
        $key = $request->key;

        // Check if the search key is not empty and not equal to zero
        if ($key != "" && $key != "0") {
            // Query the 'rt_packages' table with filtering based on the search key
            $data = DB::table('rt_packages')
                ->where('title', 'like', '%' . $key . '%')
                ->orWhere('continent', 'like', '%' . $key . '%')
                ->orWhere('country', 'like', '%' . $key . '%')
                ->orWhere('state', 'like', '%' . $key . '%')
                ->orWhere('city', 'like', '%' . $key . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(5); // Paginate results, showing 5 items per page
        } else {
            // If no search key is provided, fetch all packages
            $data = DB::table('rt_packages')
                ->orderBy('created_at', 'desc')
                ->paginate(5); // Paginate results, showing 5 items per page
        }

        // Retrieve the package list HTML using a custom helper function
        $data_value = CustomHelpers::get_package_list($data, $request->page);

        // Output the generated HTML for the package list
        echo $data_value;
    }
  
    /*----------*/

    //Show the form for creating a new resource
    public function get_sunday_data(Request $request) 
    {
      $sunday_normal_discount=$request->sunday_normal_discount;
      $sunday_coupon_discount=$request->sunday_coupon_discount;

      $discunt_negative=QuoteCharges::where('charges_type','=','Discount (-)')->get();
      $coupons=Coupon::all();
       
       if($sunday_normal_discount==0)
       {
       $sunday_normal_discount_val='<option value="0" selected>0</option>';
       }
       else
       {
       $sunday_normal_discount_val='<option value="0">0</option>';      
       }
       
      foreach($discunt_negative as $markup_pro):
        if($sunday_normal_discount==$markup_pro->id)
       {
         $sunday_normal_discount_val.='<option value="'.$markup_pro->id.'" selected>'.$markup_pro->value.'</option>';
       }
       else
       {
        $sunday_normal_discount_val.='<option value="'.$markup_pro->id.'">'.$markup_pro->value.'</option>';
       }
       
      endforeach;
   
       if($sunday_coupon_discount==0)
       {
     $sunday_coupon_discount_val='<option value="0" selected>Select Coupon</option>';
       }
       else
       {
     $sunday_coupon_discount_val='<option value="0">Select Coupon</option>';      
       }
       foreach($coupons as $markup_pro):
         if($sunday_coupon_discount==$markup_pro->id)
       {
     $sunday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" selected>'.$markup_pro->coupon_name.'</option>';
       }
       else
       {
     $sunday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" >'.$markup_pro->coupon_name.'</option>';
       }
       endforeach;
             //
       $monday_normal_discount=$request->monday_normal_discount;
       $monday_coupon_discount=$request->monday_coupon_discount;

        if($monday_normal_discount==0)
           {
           $monday_normal_discount_val='<option value="0" selected>0</option>';
           }
           else
           {
           $monday_normal_discount_val='<option value="0">0</option>';      
           }
           
          foreach($discunt_negative as $markup_pro):
            if($monday_normal_discount==$markup_pro->id)
           {
             $monday_normal_discount_val.='<option value="'.$markup_pro->id.'" selected>'.$markup_pro->value.'</option>';
           }
           else
           {
            $monday_normal_discount_val.='<option value="'.$markup_pro->id.'">'.$markup_pro->value.'</option>';
           }
           
          endforeach;

       
         if($monday_coupon_discount==0)
           {
         $monday_coupon_discount_val='<option value="0" selected>Select Coupon</option>';
           }
           else
           {
         $monday_coupon_discount_val='<option value="0">Select Coupon</option>';      
           }
           foreach($coupons as $markup_pro):
             if($monday_coupon_discount==$markup_pro->id)
           {
         $monday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" selected>'.$markup_pro->coupon_name.'</option>';
           }
           else
           {
         $monday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" >'.$markup_pro->coupon_name.'</option>';
           }
        endforeach;
        //
        $tuesday_normal_discount=$request->tuesday_normal_discount;
        $tuesday_coupon_discount=$request->tuesday_coupon_discount;

        if($tuesday_normal_discount==0)
           {
           $tuesday_normal_discount_val='<option value="0" selected>0</option>';
           }
           else
           {
           $tuesday_normal_discount_val='<option value="0">0</option>';      
           }
           
          foreach($discunt_negative as $markup_pro):
            if($tuesday_normal_discount==$markup_pro->id)
           {
             $tuesday_normal_discount_val.='<option value="'.$markup_pro->id.'" selected>'.$markup_pro->value.'</option>';
           }
           else
           {
            $tuesday_normal_discount_val.='<option value="'.$markup_pro->id.'">'.$markup_pro->value.'</option>';
           }
           
          endforeach;

       
         if($tuesday_coupon_discount==0)
           {
         $tuesday_coupon_discount_val='<option value="0" selected>Select Coupon</option>';
           }
           else
           {
         $tuesday_coupon_discount_val='<option value="0">Select Coupon</option>';      
           }
           foreach($coupons as $markup_pro):
             if($tuesday_coupon_discount==$markup_pro->id)
           {
         $tuesday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" selected>'.$markup_pro->coupon_name.'</option>';
           }
           else
           {
         $tuesday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" >'.$markup_pro->coupon_name.'</option>';
           }
        endforeach;
        //
        $wednesday_normal_discount=$request->wednesday_normal_discount;
        $wednesday_coupon_discount=$request->wednesday_coupon_discount;

        if($wednesday_normal_discount==0)
           {
           $wednesday_normal_discount_val='<option value="0" selected>0</option>';
           }
           else
           {
           $wednesday_normal_discount_val='<option value="0">0</option>';      
           }
           
          foreach($discunt_negative as $markup_pro):
            if($wednesday_normal_discount==$markup_pro->id)
           {
             $wednesday_normal_discount_val.='<option value="'.$markup_pro->id.'" selected>'.$markup_pro->value.'</option>';
           }
           else
           {
            $wednesday_normal_discount_val.='<option value="'.$markup_pro->id.'">'.$markup_pro->value.'</option>';
           }
           
          endforeach;

       
         if($wednesday_coupon_discount==0)
           {
         $wednesday_coupon_discount_val='<option value="0" selected>Select Coupon</option>';
           }
           else
           {
         $wednesday_coupon_discount_val='<option value="0">Select Coupon</option>';      
           }
           foreach($coupons as $markup_pro):
             if($wednesday_coupon_discount==$markup_pro->id)
           {
         $wednesday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" selected>'.$markup_pro->coupon_name.'</option>';
           }
           else
           {
         $wednesday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" >'.$markup_pro->coupon_name.'</option>';
           }
       endforeach;
        //
       $thursday_normal_discount=$request->thursday_normal_discount;
       $thursday_coupon_discount=$request->thursday_coupon_discount;

        if($thursday_normal_discount==0)
           {
           $thursday_normal_discount_val='<option value="0" selected>0</option>';
           }
           else
           {
           $thursday_normal_discount_val='<option value="0">0</option>';      
           }
           
          foreach($discunt_negative as $markup_pro):
            if($thursday_normal_discount==$markup_pro->id)
           {
             $thursday_normal_discount_val.='<option value="'.$markup_pro->id.'" selected>'.$markup_pro->value.'</option>';
           }
           else
           {
            $thursday_normal_discount_val.='<option value="'.$markup_pro->id.'">'.$markup_pro->value.'</option>';
           }
           
          endforeach;

       
         if($thursday_coupon_discount==0)
           {
         $thursday_coupon_discount_val='<option value="0" selected>Select Coupon</option>';
           }
           else
           {
         $thursday_coupon_discount_val='<option value="0">Select Coupon</option>';      
           }
           foreach($coupons as $markup_pro):
             if($thursday_coupon_discount==$markup_pro->id)
           {
         $thursday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" selected>'.$markup_pro->coupon_name.'</option>';
           }
           else
           {
         $thursday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" >'.$markup_pro->coupon_name.'</option>';
           }
       endforeach;
          //
       $friday_normal_discount=$request->friday_normal_discount;
       $friday_coupon_discount=$request->friday_coupon_discount;

        if($friday_normal_discount==0)
           {
           $friday_normal_discount_val='<option value="0" selected>0</option>';
           }
           else
           {
           $friday_normal_discount_val='<option value="0">0</option>';      
           }
           
          foreach($discunt_negative as $markup_pro):
            if($friday_normal_discount==$markup_pro->id)
           {
             $friday_normal_discount_val.='<option value="'.$markup_pro->id.'" selected>'.$markup_pro->value.'</option>';
           }
           else
           {
            $friday_normal_discount_val.='<option value="'.$markup_pro->id.'">'.$markup_pro->value.'</option>';
           }
           
          endforeach;

       
         if($friday_coupon_discount==0)
           {
         $friday_coupon_discount_val='<option value="0" selected>Select Coupon</option>';
           }
           else
           {
         $friday_coupon_discount_val='<option value="0">Select Coupon</option>';      
           }
           foreach($coupons as $markup_pro):
             if($friday_coupon_discount==$markup_pro->id)
           {
         $friday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" selected>'.$markup_pro->coupon_name.'</option>';
           }
           else
           {
         $friday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" >'.$markup_pro->coupon_name.'</option>';
           }
       endforeach;

       //
       $saturday_normal_discount=$request->saturday_normal_discount;
       $saturday_coupon_discount=$request->saturday_coupon_discount;

        if($saturday_normal_discount==0)
           {
           $saturday_normal_discount_val='<option value="0" selected>0</option>';
           }
           else
           {
           $saturday_normal_discount_val='<option value="0">0</option>';      
           }
           
          foreach($discunt_negative as $markup_pro):
            if($saturday_normal_discount==$markup_pro->id)
           {
             $saturday_normal_discount_val.='<option value="'.$markup_pro->id.'" selected>'.$markup_pro->value.'</option>';
           }
           else
           {
            $saturday_normal_discount_val.='<option value="'.$markup_pro->id.'">'.$markup_pro->value.'</option>';
           }
           
          endforeach;

       
         if($saturday_coupon_discount==0)
           {
         $saturday_coupon_discount_val='<option value="0" selected>Select Coupon</option>';
           }
           else
           {
         $saturday_coupon_discount_val='<option value="0">Select Coupon</option>';      
           }
           foreach($coupons as $markup_pro):
             if($saturday_coupon_discount==$markup_pro->id)
           {
         $saturday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" selected>'.$markup_pro->coupon_name.'</option>';
           }
           else
           {
         $saturday_coupon_discount_val.='<option coupon_id="'.$markup_pro->id.'"  value="'.$markup_pro->id.'" >'.$markup_pro->coupon_name.'</option>';
           }
       endforeach;


       $data=['sunday_normal_discount_val'=>$sunday_normal_discount_val,'sunday_coupon_discount_val'=>$sunday_coupon_discount_val,
         'monday_normal_discount_val'=>$monday_normal_discount_val,
         'monday_coupon_discount_val'=>$monday_coupon_discount_val,
         'tuesday_normal_discount_val'=>$tuesday_normal_discount_val,
         'tuesday_coupon_discount_val'=>$tuesday_coupon_discount_val,
         'wednesday_normal_discount_val'=>$wednesday_normal_discount_val,
         'wednesday_coupon_discount_val'=>$wednesday_coupon_discount_val,
         'thursday_normal_discount_val'=>$thursday_normal_discount_val,
         'thursday_coupon_discount_val'=>$thursday_coupon_discount_val,
         'friday_normal_discount_val'=>$friday_normal_discount_val,
         'friday_coupon_discount_val'=>$friday_coupon_discount_val,
         'saturday_normal_discount_val'=>$saturday_normal_discount_val,
         'saturday_coupon_discount_val'=>$saturday_coupon_discount_val
       ];     

        return $data;
    }
  
    /*----------*/

    /*public function create()
    {
        // Check if the Tour Package Manager service is activated
        $check_data = ActivateService::where('services', 'tour_package_manager')->first();
        
        if ($check_data->activation == 1) {
            // Fetch required data for package creation
            $inclusions = PkgInclusions::where('status', '1')->get();
            $exclusions = PkgExclusions::where('status', '1')->get();
            $transfers = transferList::where('status', '1')->get();
            $airlines = airlineList::where('status', '1')->get();
            $activities = Activity::where('status', '1')->get();
            $iatalist = iataList::where('status', '1')->get();
            $country = DB::table('cities')->select('city_state')->distinct()->orderBy('city_state', 'ASC')->get();
            $subregions = DB::table('subregions')->select('name')->distinct()->orderBy('name', 'ASC')->get();

            // Fetch distinct locations from rt_packages table
            $data_s = DB::table('rt_packages')->get();
            $dest = [];

            if ($data_s) {
                foreach ($data_s as $data_value) {
                    $cities = unserialize($data_value->city);
                    $countries = unserialize($data_value->country);
                    $states = unserialize($data_value->state);
                    
                    foreach ($cities as $row => $col) {
                        if ($countries[$row] == 'India') {
                            $dest[] = $cities[$row] . ' (' . $states[$row] . ', ' . $countries[$row] . ')';
                        } else {
                            $dest[] = $cities[$row] . ' (' . $countries[$row] . ')';
                        }
                    }
                }
            }
            
            // Remove duplicates and sort the special cities
            $spcities = array_unique($dest);
            sort($spcities);

            // Fetch additional package-related data
            $types = Pkgtype::where('status', '1')->get();
            $PkgTours = PkgTours::where('status', '1')->get();
            $hotel = Hotel::select('id', 'name', 'city')->get();
            $hotelcity = Hotel::select('city')->distinct()->where('status', '1')->get();
            $paymentPolicy = PkgPaymentPolicy::where('status', '1')->get();
            $cancelPolicy = PkgCancelPolicy::where('status', '1')->get();
            $visaPolicy = PkgVisa::where('status', '1')->get();
            $ratingType = PkgRatingType::where('status', '1')->get();
            $locations = Locations::where('status', '1')->orderBy('location')->get();
            $countries = countries::all();
            $transport = Transport::all();
            $rates = rates::all();
            $icons = Icons::all();
            $suitables = Suitable::all();
            $generals = Gtags::all();
            $holidays = Holiday::all();
            $package_hotel = PackageHotel::all();
            $imp_notes = ImportantNotes::all();
            $tourtypes = TourType::where('status', '1')->get();
            $tourcategories = TourCategory::where('status', '1')->get();
            $supplier = Supplier::all();
            $coupons = Coupon::all();

            // Fetch charge types
            $markup_profit = QuoteCharges::where('charges_type', 'Markup Profit')->get();
            $discunt_positive = QuoteCharges::where('charges_type', 'Discount (+)')->get();
            $discunt_negative = QuoteCharges::where('charges_type', 'Discount (-)')->get();
            $gst = QuoteCharges::where('charges_type', 'GST')->get();
            $tcs = QuoteCharges::where('charges_type', 'TCS')->get();
            $pg = QuoteCharges::where('charges_type', 'PG')->get();

            // Return the create view with fetched data
            return view('manage_packages.create', [
                'inclusions' => $inclusions,
                'exclusions' => $exclusions,
                'transfers' => $transfers,
                'airlines' => $airlines,
                'activities' => $activities,
                'iatalist' => $iatalist,
                'types' => $types,
                'PkgTours' => $PkgTours,
                'hotel' => $hotel,
                'country' => $country,
                'subregions' => $subregions,
                'spcities' => $spcities,
                'paymentPolicy' => $paymentPolicy,
                'cancelPolicy' => $cancelPolicy,
                'visaPolicy' => $visaPolicy,
                'ratingType' => $ratingType,
                'locations' => $locations,
                'hotelcity' => $hotelcity,
                'countries' => $countries,
                'transport' => $transport,
                'rates' => $rates,
                'icons' => $icons,
                'suitables' => $suitables,
                'generals' => $generals,
                'holidays' => $holidays,
                'package_hotel' => $package_hotel,
                'imp_notes' => $imp_notes,
                'tourtypes' => $tourtypes,
                'tourcategories' => $tourcategories,
                'supplier' => $supplier,
                'markup_profit' => $markup_profit,
                'discunt_positive' => $discunt_positive,
                'discunt_negative' => $discunt_negative,
                'gst' => $gst,
                'tcs' => $tcs,
                'pg' => $pg,
                'coupons' => $coupons,
            ]);
        } else {
            // If service is not activated, return a 404 error page
            return response()->view('error.404', [], 404);
        }
    }*/

    public function create()
    {
        // Check if the service is activated
        $check_data = ActivateService::where('services', 'tour_package_manager')->first();
        if (!$check_data || $check_data->activation != 1) {
            return response()->view('error.404', [], 404);
        }

        // Fetch required data in batch to reduce multiple queries
        $inclusions = PkgInclusions::where('status', '1')->get();
        $exclusions = PkgExclusions::where('status', '1')->get();
        $transfers  = transferList::where('status', '1')->get();
        $airlines   = airlineList::where('status', '1')->get();
        $activities = Activity::where('status', '1')->get();
        $iatalist   = iataList::where('status', '1')->get();
        
        $types         = Pkgtype::where('status', '1')->get();
        $PkgTours      = PkgTours::where('status', '1')->get();
        $hotel         = Hotel::select('id', 'name', 'city')->get();
        $hotelcity     = Hotel::where('status', '1')->distinct()->pluck('city');
        $paymentPolicy = PkgPaymentPolicy::where('status', '1')->get();
        $cancelPolicy  = PkgCancelPolicy::where('status', '1')->get();
        $visaPolicy    = PkgVisa::where('status', '1')->get();
        $ratingType    = PkgRatingType::where('status', '1')->get();
        $locations     = Locations::where('status', '1')->orderBy('location')->get();
        
        // Fetch cities and subregions in one query
        $continents = DB::table('continent')->get();

        



        // Fetch destinations and process locations efficiently
        $destinations = DB::table('rt_packages')->pluck('city', 'country', 'state');

        $spcities = [];
    
        foreach ($destinations as $data_value) {
            // Ensure the values are not null before unserializing
            $cities    = !empty($data_value->city) ? unserialize($data_value->city) : [];
            $countries = !empty($data_value->country) ? unserialize($data_value->country) : [];
            $states    = !empty($data_value->state) ? unserialize($data_value->state) : [];

            if (!is_array($cities) || !is_array($countries) || !is_array($states)) {
                continue; // Skip iteration if unserialize fails
            }

            foreach ($cities as $row => $col) {
                $spcities[] = ($countries[$row] == 'India') ?
                    "{$cities[$row]} ({$states[$row]}, {$countries[$row]})" :
                    "{$cities[$row]} ({$countries[$row]})";
            }
        }

        // Ensure unique values and sort
        $spcities = array_unique($spcities);
        sort($spcities);
    

        // Fetch various other related data
        $countries       = countries::all();
        $transport       = Transport::all();
        $rates           = rates::all();
        $icons           = Icons::all();
        $suitables       = Suitable::all();
        $generals        = Gtags::all();
        $holidays        = Holiday::all();
        $package_hotel   = PackageHotel::all();
        $imp_notes       = ImportantNotes::all();
        $tourtypes       = TourType::where('status', '1')->get();
        $tourcategories  = TourCategory::where('status', '1')->get();
        $supplier        = Supplier::all();
        
        // Fetch Quote Charges in one query
        $quoteCharges = QuoteCharges::whereIn('charges_type', [
            'Markup Profit', 'Discount (+)', 'Discount (-)', 'GST', 'TCS', 'PG'
        ])->get()->groupBy('charges_type');

        $markup_profit    = $quoteCharges['Markup Profit'] ?? collect();
        $discunt_positive = $quoteCharges['Discount (+)'] ?? collect();
        $discunt_negative = $quoteCharges['Discount (-)'] ?? collect();
        $gst              = $quoteCharges['GST'] ?? collect();
        $tcs              = $quoteCharges['TCS'] ?? collect();
        $pg               = $quoteCharges['PG'] ?? collect();

        $coupons = Coupon::all();
      
        return view('manage_packages.create', compact(
            'inclusions', 'exclusions', 'transfers', 'airlines', 'activities', 'iatalist', 'types', 
            'PkgTours', 'hotel', 'continents', 'spcities', 'paymentPolicy', 'cancelPolicy', 
            'visaPolicy', 'ratingType', 'locations', 'hotelcity', 'countries', 'transport', 'rates', 
            'icons', 'suitables', 'generals', 'holidays', 'package_hotel', 'imp_notes', 'tourtypes', 
            'tourcategories', 'supplier', 'markup_profit', 'discunt_positive', 'discunt_negative', 
            'gst', 'tcs', 'pg', 'coupons'
        ));
    }

    /*----------*/

    //Store a newly created resource in storage
    public function list_data(Request $request)
    {
        $value=$request->value;
        $data=DB::table('rt_packages')
          ->where('country','like','%'. $value. '%')->orderBy('created_at', 'desc')->paginate(10);
        $data_value=CustomHelpers::get_package_list($data);
        echo $data_value;
    }
    
    public function country_url(Request $request) {
        $data=countries::all();

        echo "<option value='0'>Select Country</option>";
        foreach($data as $single):
        echo "<option value='".$single->name."' c_id='".$single->id."'>".$single->name."</option>";
        endforeach;
    }
   
    public function country_query(Request $request)
    {
        $data=countries::all();
        echo "<option value='0'>Select Country</option>";
        foreach($data as $single):
             if($single->name=='India'):
            echo "<option value='".$single->name."' selected>".$single->name."</option>";
        else:
            echo "<option value='".$single->name."'>".$single->name."</option>";
        endif;
        endforeach;
    }
  
    public function country_code(Request $request)
    {
        $data=countries::all();
        echo "<option value='0'>Select Code</option>";
        foreach($data as $single):
            if($single->phonecode==91):
        echo "<option value='".$single->phonecode."' selected>".$single->name." (+".$single->phonecode.")</option>";
            else:
        echo "<option value='".$single->phonecode."' >".$single->name." (+".$single->phonecode.")</option>";
            endif;
        endforeach;
    }
  
    /*public function country_query_s(Request $request)
    {
          $data=countries::all();
          echo "<option value='0'>Select Nationality</option>";
          foreach($data as $single):
              if($single->name=='India'):
              echo "<option value='".$single->name."' selected>".$single->name."</option>";
          else:
              echo "<option value='".$single->name."'>".$single->name."</option>";
          endif;
          endforeach;
    }*/

    public function country_query_s()
    {
        $data = countries::all();
        $html = "<option value='0'>Select Nationality</option>";

        foreach ($data as $single) {
            $selected = ($single->name == 'India') ? "selected" : "";
            $html .= "<option value='{$single->name}' {$selected}>{$single->name}</option>";
        }

        return response($html, 200)->header('Content-Type', 'text/html');
    }


    public function state_url(Request $request) 
    {
        $country_id = $request->country_id;
        $data = State::where('country_id',$country_id)->get();
        
        echo "<option value='0'>Select State</option>";
        foreach($data as $single):
          echo "<option value='".$single->name."' s_id='".$single->id."'>".$single->name."</option>";
        endforeach;
    }
  
    public function state_url1(Request $request) 
    {
        $country_id=$request->country_id;
        $data=State::where('country_id',$country_id)->get();

        echo "<option value='0'>Select State</option>";
        foreach($data as $single):
          echo "<option value='".$single->id."'>".$single->name."</option>";
        endforeach;
    }
      
    public function city_url(Request $request) 
    {
        $state_id=CustomHelpers::get_state_code($request->state_id);
        $data=City::where('state_id',$state_id)->get();
        
        echo "<option value='0'>Select City</option>";
        foreach($data as $single):
          echo "<option value='".$single->name."'>".$single->name."</option>";
        endforeach;
    }
      
    public function packagerating_url(Request $request)
    {
             $ratingType = PkgRatingType::where('status','1')->get();
             $output='<option value="" selected disabled>Select Category </option>';
            foreach($ratingType as $single):
                 $output.="<option value='".$single->id."'>".$single->name."</option>";
            endforeach;


            echo $output;
    }
      
    public function packagerating_url_new(Request $request)
    {
        $select_item=$request->select_item;

          $values=$request->values;
          $values_second=array_unique($values);
        $values_third=array_filter($values_second);
        foreach (array_keys($values_third, $select_item) as $key) {
        unset($values_third[$key]);
        }
        $final_array=[];
        foreach ($values_third as $key) {
         $final_array[]=$key;
        }
          $ratingType = PkgRatingType::where('status','1')->whereNotIn('id',$final_array)->get();
          $output='<option value="" selected disabled>Select Category </option>';
            foreach($ratingType as $single):
              if($select_item==$single->id):
        $output.="<option value='".$single->id."' selected>".$single->name."</option>";
              else:
        $output.="<option value='".$single->id."'>".$single->name."</option>";
              endif;
                 
            endforeach;

             $output.="<option value='other'>Other</option>";
             
            echo $output;
    }
      
    public function currency_url(Request $request)
    {
            $data=rates::all();
            foreach($data as $single):
                echo "<option value='".$single->rate."'>".$single->currency."</option>";
            endforeach;
    }
      
    public function dayItineraryCity(Request $request)
    {
       $data=Hotel::select('city')->distinct()->where('status','1')->get();
       foreach($data as $single):
       echo "<option value='".$single->city."'>".$single->city." </option>";
       endforeach;
    }
      
    public function quote_hotel_data(Request $request)
    {
          $id=$request->hotel_id;
          $data=PackageHotel::find($id);
          return $data;
    }
      
    public function quote_hotel_name(Request $request) 
    {
        $city_name=$request->city_name;
        $propertytype=$request->propertytype;
       
         if($city_name!='' && $propertytype!=''):
         $data=DB::table('package_hotel')
              ->where([['location','like','%'.$city_name.'%'],['propertytype','like','%'.$propertytype.'%']])->get();
        elseif($city_name!='' && $propertytype==''):
        $data=DB::table('package_hotel')
              ->where('location','like','%'.$city_name.'%')->get();

        elseif($city_name=='' && $propertytype!=''):
        $data=DB::table('package_hotel')
              ->where('propertytype','like','%'.$propertytype.'%')->get();  
        endif;
       
        foreach($data as $single):

       echo "<option value='".$single->id."'>".$single->hotelname." </option>";
       endforeach;
              echo $city_name;
    }

    public function query_hotel_name(Request $request)
    {
        $city_name=$request->city_name;
        $data=DB::table('package_hotel')
              ->where('location','like','%'.$city_name.'%')->get();
        foreach($data as $single):
       echo "<option value='".$single->id."'>".$single->hotelname." </option>";
       endforeach;
    }
      
    public function dayItineraryhotel(Request $request)
    {
       $data=PackageHotel::all();
       echo "<option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>";
       foreach($data as $single):
       echo "<option value='".$single->id."'>".$single->hotelname." </option>";
       endforeach;
    }
      
    public function add_package_hotel(Request $request)
    {
        $this->validate($request,[
            "hotelname"=>"required",
            "star_rating"=>"required",
             ]);
       $data=new PackageHotel;
       $data->hotelname=$request->hotelname;
       $data->location=$request->location;
       $data->star_rating=$request->star_rating;
       $data->save();
       $data1=PackageHotel::all();
       foreach($data1 as $key=>$pkhotel):
         if($pkhotel->hotelname==$request->hotelname):
                echo "<option value='".$pkhotel->id."'>".$pkhotel->hotelname."</option>";
         endif;
       endforeach;
    }

    public function add_hotel_star(Request $request)
    {
        $data=PackageHotel::find($request->id);
        echo $data->star_rating;
    }
      
    public function dayItinerarytour(Request $request)
    {
       $data=PkgTours::where('status','1')->get();
       foreach($data as $single):
       echo "<option value='".$single->id."'>".$single->activity." </option>";
       endforeach;
    }
      
    public function autocomplete(Request $request)
    {
          $data=City::select("name")
                    ->where("name","LIKE","%{$request->city_name}%")
                    ->get();
          return response()->json($data);
    }

    /*----------*/

    /*// search hotel city in tour accommodation (old)
    public function search_quote_destination(Request $request) 
    {
        $destination_search_value=$request->searchTerm;
        $data=City::select("name")
              ->where("name","LIKE","%{$destination_search_value}%")
              ->get();
        $dest=[];
        foreach($data as $data_value):
          $dest[]=$data_value->name;
        endforeach;
        $dest=array_unique($dest);
        $dest=$this->filter_array($dest, strtoupper(substr($destination_search_value, 0, 1)));
        $show=[];
        foreach($dest as $d) {
          $show[] = ['id'=>$d,'text'=>$d];
        }
        $final_data[]=["text"=>"Suggestion", 'children'=>$show];
        echo json_encode($final_data);
    }*/

    // search hotel city in tour accommodation
    public function search_quote_destination(Request $request) 
    {
        try {
            // Get the search term from the request
            $destination_search_value = $request->input('searchTerm');

            // Check if the search term is not empty
            if (empty($destination_search_value)) {
                return response()->json(['error' => 'No search term provided'], 400); // Return a 400 Bad Request if empty
            }

            // Fetch cities matching the search term
            $data = City::select("name",'id')
                        ->where("name", "LIKE", "%{$destination_search_value}%")
                        ->get();

            // Initialize arrays to store the results
            $dest = [];
            foreach ($data as $data_value) {
                $dest[] = ['id' => $data_value->id, 'location' => $data_value->name];
               
            }
            $uniqueDest = [];
            $locations = [];  
          foreach ($dest as $item) {
               if (!in_array($item['location'], $locations)) {
                   $locations[] = $item['location'];
                   $uniqueDest[] = $item;
               }
           }
           
            $show = [];
foreach ($uniqueDest as $d) {
    $show[] = ['id' => $d['id'], 'text' => $d['location']]; // Using array keys, not object properties
}



usort($show, function ($a, $b) use ($destination_search_value) {
    $startsWithA = stripos($a['text'], $destination_search_value) === 0;
    $startsWithB = stripos($b['text'], $destination_search_value) === 0;

    if ($startsWithA && !$startsWithB) {
        return -1; // Move $a up
    } elseif (!$startsWithA && $startsWithB) {
        return 1;  // Move $b up
    }
    return strcasecmp($a['text'], $b['text']); // Sort alphabetically otherwise
});


            // Organize the data into the format expected by Select2
            $final_data[] = ["text" => "Suggestion", 'children' => $show];

            // Return the data as JSON
            return response()->json($final_data);

        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error fetching destinations: ' . $e->getMessage());

            // Return a 500 error response with a JSON message
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /*----------*/

    public function filter_array($array, $letter) 
    {
        $filtered_array=array();
       
        foreach($array as $key=>$val) {
            if($val[0]==$letter) {
                $filtered_array[]=$val;
                }
            }
        return $filtered_array;
    }

    public function sort_tour_bycity(Request $request)
    {
         $city_name=$request->city_value;
         $data=PkgTours::where('status','1')
                       ->whereIn('location', $city_name)
                       ->get();
         foreach($data as $single):
       echo "<option value='".$single->id."'>".$single->activity." </option>";
       endforeach;
    }
      
        public function store(Request $request)
        {
            //$a =serialize($request->continent);
            //echo $a;
            //dd(unserialize($a));
           
           /* $this->validate($request, [
               'duration'              =>  'required',
               'package_name'          =>  'required',
               'package_category'      =>  'required',
               'continent'             =>  'required',
               'state'                 =>  'required',
               'city'                  =>  'required',
               'days'                  =>  'required',
               'description'           =>  'required',
               'transport'             =>  'required',
               'transport_description' =>  'required',
               'tours'                 =>  'required',
               'inclusions'            =>  'required',
               'exclusions'            =>  'required',
               'meta_title'            =>  'required',
               'meta_desc'             =>  'required',
               'meta_keyword'          =>  'required',
               'supplier_name'         =>  'required',
               'supplier_contact_no'   =>  'required',
               'supplier_emailId'      =>  'required',
               'supplier_price'        =>  'required',
               'supplier_address'      =>  'required',
               'Price_title'           =>  'required',
               'supplier_address'      =>  'required',
               'supplier_address'      =>  'required',
            

            ]);*/
            $this->validate($request, [          
               'package_name'          =>  'required',
             ]);
        
            if($request->input('id')){
                $package = Packages::findOrFail($request->input('id'));
               
            }else{
                $package = new Packages;
            }
           
            $package->duration = $request->duration;
            $package->title = $request->package_name;
            $package->package_category =  serialize($request->package_category);
            $package->transfers =  serialize($request->transfers);
            //$package->airlines =  $request->airlines;
            //$package->package_location =  serialize($request->package_location);
            $package->package_service =  serialize($request->package_service);
            $package->package_suitables =  serialize($request->package_suitables);
            $package->package_tags =  serialize($request->package_tags);
            $package->package_holiday =  serialize($request->package_holiday);
            $package->continent = serialize($request->continent);
            $package->country = serialize($request->country);
            $package->state = serialize($request->state);
            $package->city = serialize($request->city);
            $package->days = serialize($request->days);
            $package->description = $request->description;
            $package->highlights = $request->highlights;
            $package->transport = $request->transport;
            $package->transport_description = $request->transport_description;
            $package->customer_rating = $request->customer_rating;
            $package->tours = serialize($request->tours);
            $package->destinations = serialize($request->destinations);
            $package->similar_packages = serialize($request->similar_packages);
            $package->sp_city = serialize($request->sp_city);
            
            //$package->category = $request->category;
          
            //$package->package_destination = $request->package_destination;
            //$package->type_of_package = $request->type;
            $package->inclusions = $request->inclusions;
            $package->exclusions = $request->exclusions;
            //$package->transfers = $request->transfers;
            $package->day_itinerary = serialize($request->dayItinerary);
            $package->tour_inc = serialize($request->quote_inc);
            $package->tour_exc = serialize($request->quote_exc);
            $package->tour_type = $request->tour_type;
            $package->tour_category = $request->tour_category;
            $package->sourcecity = $request->sourcecity;
            $package->select_star_rating = $request->select_star_rating;

            $package->acc_type = $request->acc_type;
            
            if($request->acc_type=="normal_acc")
            {
            $package->accommodation = serialize($request->accommodation);
            }
            else if($request->acc_type=="extra_acc")
            {
              $package->accommodation_extra = $request->accommodation_extra;
            }
            $package->Price_title = $request->Price_title;
            $package->Price_type = $request->Price_type;
            $package->confirmation_type = $request->confirmation_type;
            $package->confirmation_type_upcoming = $request->confirmation_type_upcoming;
            $package->upcoming_title = $request->Price_title_upcoming;
            $package->upcoming_type = $request->Price_type_upcoming;
            $package->pricing = serialize($request->Price);
            $package->upcoming_pricing = serialize($request->Price_upcoming);
            $package->flight = serialize($request->flight);
            $package->meta_title = $request->meta_title;
            $package->meta_desc = $request->meta_desc;
            $package->meta_keyword = $request->meta_keyword;
            $package->rapidex_meta_title = $request->rapidex_meta_title;
            $package->rapidex_meta_desc = $request->rapidex_meta_desc;
            $package->rapidex_meta_keyword = $request->rapidex_meta_keyword;
            $package->visa_p = serialize($request->package_visa);
            $package->payment_p = serialize($request->package_payment);
            $package->can_p = serialize($request->package_can);
            $package->imp_notes = serialize($request->package_impnotes);
            $package->extra_notes =$request->extra_imp;
            $package->newprices = serialize($request->newprice);
            $package->newprices_discounts = serialize($request->NewPrice);
            $package->no_of_room =$request->no_of_room;
            $package->room = serialize($request->room);
            $package->priceremarks =$request->priceremarks;
            $package->show_status =$request->show_status;
            $package->anything =$request->remarks;
            $package->currency =$request->currency;
            $package->roe =$request->roe;
            $package->indian_rate =$request->indian_rate;
            $package->total_value =$request->total_value;

            $package->adult =$request->packages_number_of_adult;
            $package->extra_adult =$request->extra_adult;
            $package->child_with_bed =$request->child_with_bed;
            $package->child_without_bed =$request->child_without_bed;
            $package->solo_traveller =$request->infant;
            $package->infant =$request->solo_traveller;

            //$package->package_rating = $request->package_rating;
            //$package->accommodation = serialize($request->accommodation);


            if($request->package_hotel){
                $package->hotel_id = $request->package_hotel;
            }
            $package->payment_policy = $request->payment_policies;
            $package->cancel_policy = $request->cancellation;
            $package->visa_policies = $request->visa_policies;
            if($request->livemode)
            {
            $package->livemode = $request->livemode;
            }
        
            $package->package_code=(int)$request->package_code;
            $package->onrequest = $request->onrequest;
            $package->upcoming = $request->upcoming;
            $package->visa = $request->visa;
            $package->supplier_id = (int)$request->supplier_id;
            $package->supplier_remarks = $request->supplier_remarks;
            $dataSchedule = array();       

            if($package->save())
              {
                $lastInsertId = $package->id;
                //for package code
                // $package_data=Packages::find($lastInsertId);
                // $package_data->package_code=$lastInsertId;
                // $package_data->save();


                if(!empty($request->locationSed) && !empty($request->durationSed)){
                    foreach($request->locationSed as $key=>$loc){

                        $dataSchedule = new DaySchedule;
                         $dataSchedule->pkg_id = $package->id;
                         $dataSchedule->location = $loc;
                         $dataSchedule->duration = $request->durationSed[$key];
                         $dataSchedule->save();
                    }
                }
                return redirect ('/tours');
            }
        }
      
    //
    

    /***************************  Package Gallery Upload ******************/

    public function up_image(Request $request)
    {
        $package_id=$request->pak_id;
        $data=PackageUploads::find($package_id);
        $sort=$data->sort;
        if($sort!='' && $sort!=1 && $sort!=0):
            $negative_sort=(int)$sort-1;
          $check_data=PackageUploads::where('sort','=',$negative_sort)->first();
          if($check_data!=''):
            $check_data->sort=$sort;
            $check_data->save();
          else:
          endif;
          $data->sort=$negative_sort;
          $data->save();
          elseif($sort=='' || $sort==0):
              $previous_id='';
              $previous=PackageUploads::where('sort','=',1)->first();
            if($previous!=''):
            $previous->sort=2;
            $previous->save();
            $previous_id=$previous->id;
             endif;
             if($previous_id!=''):
              $i=2;
             do{
            $check_data=PackageUploads::where('sort','=',$i)->whereNotIn('id',[$previous_id])->first();
           if($check_data!=''):
            $check_data->sort=$i+1;
            $check_data->save();
            $previous_id=$check_data->id;
          endif;
          $i++;
             }while($check_data!='');
            endif;
          $data->sort=1;
          $data->save();
        endif;
        echo 'success';
    }
      
    public function packageUploads($id)
    {
        $packageUpload = PackageUploads::where('package_id',$id)->orderBy('sort','ASC')->get();
        $countries=countries::all();
        return view('manage_packages.packageUploads',compact("packageUpload","countries"));
    }
      
    public function change_thumb_no(Request $request)
    {
           $thumb_id=$request->thumb_id;
            $packageUpload = PackageUploads::find($thumb_id);
            $packageUpload->thumb_no=$request->thumb_no;
            $packageUpload->save(); 
    }
      
    public function packagefileUploads(Request $request)
    {
            //get the file from the post request
            $file = $request->file('file');
            $package_id = $request->input('package_id');
            $filename = uniqid(). $file->getClientOriginalName();
            $path = '/uploads/packages/'.$filename;
            //move the file to correct location
            $file->move(public_path().'/uploads/packages/', $filename);
            $hotels = new PackageUploads;
            $hotels->package_id = $package_id;
            $hotels->image_path = $path;
            $hotels->save();
           return redirect("/packageUploads/".$package_id);
    }
      
    public function packagefile_upload(Request $request)
    {
         $package_id = $request->input('package_id');

            if($request->file('uploadimage'))
            {
                $image_array=$request->file('uploadimage');
                $image_array_count=count($image_array);
                for($i=0;$i<$image_array_count;$i++)
                {
                //original
                $destination_original=public_path('/uploads/packages/original');
                $original_name=rand().'.'.$image_array[$i]->getClientOriginalExtension();
                $img_original = Image::make($image_array[$i]->getRealPath())->save($destination_original.'/'.$original_name);

                 //main_part
                $destination_main=public_path('/uploads/packages');
                $main_name=rand().'.'.$image_array[$i]->getClientOriginalExtension();
                $img_main = Image::make($image_array[$i]->getRealPath());
                $img_main->resize(750, 520, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destination_main.'/'.$main_name);
                //thumbnil_medium
                $destination_medium=public_path('/uploads/packages/thum_medium');
                $thum_medium=rand().'.'.$image_array[$i]->getClientOriginalExtension();
                $img_medium = Image::make($image_array[$i]->getRealPath());
                $img_medium->resize(350, 260, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destination_medium.'/'.$thum_medium);
                //thumbnil_small
                $destination_small=public_path('/uploads/packages/thum_small');
                $thum_small=rand().'.'.$image_array[$i]->getClientOriginalExtension();
                $img_small = Image::make($image_array[$i]->getRealPath());
                $img_small->resize(100, 70, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destination_small.'/'.$thum_small);
                //
                 //
                $path = '/uploads/packages/'.$main_name;

                $data1=new PackageImageGallery;
                $data1->image_path = $path;
                $data1->thum_medium = $thum_medium;
                $data1->thum_small = $thum_small;
                $data1->image_main = $main_name;
                $data1->country = $request->country;
                $data1->state = $request->state;
                $data1->city = $request->city;
                $data1->name = $request->name;
                $data1->save();
                $data=new PackageUploads;
                $data->package_id = $package_id;
                // $data->image_path = $path;
                $data->gallery_id = CustomHelpers::get_imgpath_id($path);
                $data->save();
                }
                return redirect("/packageUploads/".$package_id);
            }
            else
            {
                return back();
            }
        }
      
    public function package_image_location($id)
    {
        $data=PackageImageGallery::all();
        $data_country = PackageImageGallery::select('country')->distinct()->get();
        $data_city = PackageImageGallery::select('city')->distinct()->get();
        $countries=countries::all();
        return view('manage_packages.package_image_location',compact("data","countries","data_city"));
    }

    /*----------*/

    /*public function package_image_gallery($id, Request $request) 
    {
        // Retrieve country, state, and city from the request
        $country = $request->country_name;
        $state = $request->state_name;
        $city = $request->city_name;

        // Initialize $data as null to avoid undefined variable issues
        $data = null;

        // Check if only the country is selected, and state and city are not selected
        if ($country != "" && $country != "0" && $state == "0" && ($city == "Select City" || $city == "0")):
            // Fetch records matching the selected country
            $data = DB::table('package_image_gallery')
                ->where([['country', '=', $country]])
                ->get();
        
        // Check if country and state are selected, but city is not selected
        elseif ($country != "" && $country != "0" && $state != "0" && ($city == "Select City" || $city == "0")):
            // Fetch records matching the selected country and state
            $data = DB::table('package_image_gallery')
                ->where([['country', '=', $country], ['state', '=', $state]])
                ->get();

        // Check if country, state, and city are all selected
        elseif ($country != "" && $country != "0" && $state != "0" && $city != "Select City" && $city != "0"):
            // Fetch records matching the selected country, state, and city
            $data = DB::table('package_image_gallery')
                ->where([['country', '=', $country], ['state', '=', $state], ['city', '=', $city]])
                ->get();
        
        // If none of the country, state, and city are selected
        else:
            // Optionally, fetch all records or handle no selection scenario
            $data = DB::table('package_image_gallery')->get();  // Fetch all records
            // Alternatively, you could set $data = [] to return no records.
        endif;

        // Return the view with the fetched data and selected filters
        return view('manage_packages.package_image_gallery', compact("data", "country", "state", "city"));
    }*/

    public function package_image_gallery($id, Request $request) 
    {
        // Retrieve country, state, and city from the request
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;

        // Initialize $data as null to avoid undefined variable issues
        $data = null;
        $message = null;  // Initialize message variable

        // Check if only the country is selected, and state and city are not selected
        if ($country != "" && $state == "" && $city ==''):
            // Fetch records matching the selected country
            $data = DB::table('package_image_gallery')
                ->where([['country', '=', $country]])
                ->get();
        
        // Check if country and state are selected, but city is not selected
        elseif ($country != "" &&  $state != "" && $city == ''):
            // Fetch records matching the selected country and state
            $data = DB::table('package_image_gallery')
                ->where([['country', '=', $country], ['state', '=', $state]])
                ->get();

        // Check if country, state, and city are all selected
        elseif($country != ""  && $state != "" && $city != ""):
            // Fetch records matching the selected country, state, and city
            $data = DB::table('package_image_gallery')
                ->where([['country', '=', $country], ['state', '=', $state], ['city', '=', $city]])
                ->get();
        
        // If none of the country, state, and city are selected
        else:
            // Set $data to an empty array and define a message to indicate no filter was applied
            $data = [];
            $message = "No filter applied. Please select a country, state, or city.";
        endif;

        // Return the view with the fetched data, selected filters, and message (if any)
        return view('manage_packages.package_image_gallery', compact("data", "country", "state", "city", "message"));
    }

    /*----------*/

    /*public function package_image_gallery_edit($id1,$id2,$id3,Request $request) 
    {
         $country_name=$request->country_name;
         $state_name=$request->state_name;
         $city_name=$request->city_name;
         //$data=PackageImageGallery::all();
         $data=DB::table('package_image_gallery')
              ->where([['country','=',$country_name], ['city','=',$city_name]])->get();
         return view('manage_packages.packages_image_gallery_edit',compact("data","country_name","city_name"));
    }*/

    /*public function package_image_gallery_edit($id1, $id2, $id3, Request $request) 
    {
        // Retrieve country, state, and city from the request
        $country_name = $request->country_name;
        $state_name = $request->state_name;
        $city_name = $request->city_name;

        // Fetch records matching the selected country and city
        $data = DB::table('package_image_gallery')
            ->where([['country', '=', $country_name], ['city', '=', $city_name]])
            //->get(); // all images
            ->paginate(12);

        // Initialize message variable
        $message = null;

        // Check if no records were found
        if ($data->isEmpty()) {
            $message = "No images found for the selected country and city.";
        }

        // Return the view with the fetched data and message
        return view('manage_packages.packages_image_gallery_edit', compact("data", "country_name", "city_name", "message"));
    }*/

    /*public function package_image_gallery_edit($id1, $id2, $id3, Request $request) 
    {
        // Retrieve country, state, and city from the request
        $country_name = $request->country_name;
        $state_name = $request->state_name;
        $city_name = $request->city_name;

        // Fetch records matching the selected country and city, paginating the result (9 per page)
        $data = DB::table('package_image_gallery')
            ->where([['country', '=', $country_name], ['city', '=', $city_name]])
            ->paginate(12)
            ->appends([
                'country_name' => $country_name,
                'state_name' => $state_name,
                'city_name' => $city_name
            ]);

        // Initialize message variable
        $message = null;

        // Check if no records were found
        if ($data->isEmpty()) {
            $message = "No images found for the selected country and city.";
        }

        // Return the view with the fetched data and message
        return view('manage_packages.packages_image_gallery_edit', compact("data", "country_name", "state_name", "city_name", "message"));
    }*/

    public function package_image_gallery_edit($id1, $id2, $id3, Request $request) 
    {
        // Retrieve country, state, and city from the request
        $country_name = $request->country_name;
        $state_name = $request->state_name;
        $city_name = $request->city_name;

        // Initialize $data as null to avoid undefined variable issues
        $data = null;
        $message = null;  // Initialize message variable

        // Check if the country is "0" (not selected)
        if (empty($country_name)) {
            // Set an empty collection and show a message that no country is selected
            $data = collect();  // Use an empty collection to avoid errors in the view
            $message = "Please select a country.";
        }
        // Check if only the country is selected, and state and city are not selected
        elseif ($country_name != "" && $state_name == "" && $city_name=='') {
            // Fetch records matching the selected country
            $data = DB::table('package_image_gallery')
                ->where('country', '=', $country_name)
                ->paginate(12)
                ->appends([
                    'country_name' => $country_name,
                    'state_name' => $state_name,
                    'city_name' => $city_name
                ]);
        }
        // Check if country and state are selected, but city is not selected
        elseif ($country_name != "" && $state_name != "" && $city_name=='') {
            // Fetch records matching the selected country and state
            $data = DB::table('package_image_gallery')
                ->where([['country', '=', $country_name], ['state', '=', $state_name]])
                ->paginate(12)
                ->appends([
                    'country_name' => $country_name,
                    'state_name' => $state_name,
                    'city_name' => $city_name
                ]);
        }
        // Check if country, state, and city are all selected
        elseif ($country_name != "" && $state_name != "" && $city_name != "") {
            // Fetch records matching the selected country, state, and city
            $data = DB::table('package_image_gallery')
                ->where([['country', '=', $country_name], ['state', '=', $state_name], ['city', '=', $city_name]])
                ->paginate(12)
                ->appends([
                    'country_name' => $country_name,
                    'state_name' => $state_name,
                    'city_name' => $city_name
                ]);
        }

        // If no data is found, display a "No images found" message
        if ($data && $data->isEmpty()) {
            $message = "No images found for the selected country, state, and city.";
        }

        // Return the view with the fetched data, selected filters, and message (if any)
        return view('manage_packages.packages_image_gallery_edit', compact("data", "country_name", "state_name", "city_name", "message"));
    }

    /*----------*/

    public function package_image_save($id,Request $request)
    {
          $package_gallery_id=$id;
          $image_name=$request->image_from_gallery;
          $image_name_array_count=count($image_name);
          for($i=0;$i<$image_name_array_count;$i++)
          {
                $check=CustomHelpers::get_data_condition1($image_name[$i],$package_gallery_id);
                if($check!="1"):
                $data=new PackageUploads;
                $data->package_id = $package_gallery_id;
                $data->gallery_id = $image_name[$i];
                $data->save();
                endif;
          }
          return redirect("/packageUploads/".$package_gallery_id);
    }
      
    public function packages_image_save($id1,$id2,$id3,Request $request)
    {
            //$id=CustomHelpers::get_packageuploads_id($id1);
            $data=PackageUploads::find($id3);
                $data->package_id = $id2;
                $data->gallery_id = $request->image_from_gallery;
                $data->save();
          return redirect("/packageUploads/".$id2);
    }
      
    /*public function fetch_data(Request $request)
    {
          $country=$request->gallery_country;
          $state=$request->gallery_state;
          $city=$request->gallery_city;
          $search_by_name=$request->search_by_name;
           if($request->ajax())
           {

            if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") && $search_by_name=="")
        {
       
       $data=DB::table('package_image_gallery')
              ->where('country','=',$country)->orderBy('created_at', 'desc')->paginate(15);
              $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
        if($country!="" && $country!="0" && $state!="0" && ($city=="Select City" ||  $city=="0") && $search_by_name=="") {
          $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],['state','=',$state]])->orderBy('created_at', 'desc')->paginate(15);
              $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
        if($country!="" && $country!="0" && $state!="0" && $city!="Select City" && $city!="0" && $search_by_name=="") {
          $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],['state','=',$state],['city','=',$city]])->orderBy('created_at', 'desc')->paginate(15);
              $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
         }

         if($country!="" && $country!="0" && $state!="0" && $city!="Select City" && $city!="0" && $search_by_name!="") {
          $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],['state','=',$state],['city','=',$city],['name','like', '%' . $search_by_name . '%']])->orderBy('created_at', 'desc')->paginate(15);

              $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
        if($country!="" && $country!="0" && $state!="0" && ($city=="Select City" || $city=="0") && $search_by_name!="") {
       
       $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],
                       ['state','=',$state],
                       
                       ['name','like', '%' . $search_by_name . '%']])->orderBy('created_at', 'desc')->paginate(15);

         
         
          $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;  

         }

         if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" || $city=="0") && $search_by_name!="")


         {
       
       $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],
                      
                       
                       ['name','like', '%' . $search_by_name . '%']])->orderBy('created_at', 'desc')->paginate(15);

         
         
           $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;  
         }

        if(($country=="" || $country=="0") && $state=="0" && ($city=="Select City" || $city=="0") && $search_by_name!="") {
       
       $data=DB::table('package_image_gallery')
              ->where('name','like', '%' . $search_by_name . '%')->orderBy('created_at', 'desc')->paginate(15);

         
         
           $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;  
         }
     
        if($search_by_name=="" && ($country=="" || $country=="0") && $state=="0" && ($city=="Select City" ||  $city=="0"))
        {
       
       $data=PackageImageGallery::orderBy('created_at', 'desc')->paginate(15);

         
        $value_print =CustomHelpers::get_gall_data($data);
        echo $value_print;  
        }
        }
    }*/

    // fetch data in image gallery (pagination)
    public function fetch_data(Request $request) 
    {
        // Retrieve request inputs for country, state, city, and search term
        $country = $request->gallery_country;
        $state = $request->gallery_state;
        $city = $request->gallery_city;
        $search_by_name = $request->search_by_name;
       
        // Check if the request is an AJAX request
       

            // Case 1: Only country is selected, and no state, city, or search term
            if ($country != ""  && $state == "" && $city =='' && $search_by_name == "") {
                $data = DB::table('package_image_gallery')
                          ->where('country', '=', $country)
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
                $value_print = CustomHelpers::get_gall_data($data);
                echo $value_print;
            }

            // Case 2: Country and state are selected, but no city or search term
            if ($country != "" && $state != "" && $city =='' && $search_by_name == "") {
                $data = DB::table('package_image_gallery')
                          ->where([['country', '=', $country], ['state', '=', $state]])
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
                $value_print = CustomHelpers::get_gall_data($data);
                echo $value_print;
            }

            // Case 3: Country, state, and city are selected, but no search term
            if ($country != ""  && $state != "" && $city != "" && $search_by_name == "") {
                $data = DB::table('package_image_gallery')
                          ->where([['country', '=', $country], ['state', '=', $state], ['city', '=', $city]])
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
                $value_print = CustomHelpers::get_gall_data($data);
                echo $value_print;
            }

            // Case 4: Country, state, city, and search term are all selected
            if ($country != ""  && $state != "" && $city != "" && $search_by_name != "") {
                $data = DB::table('package_image_gallery')
                          ->where([
                              ['country', '=', $country],
                              ['state', '=', $state],
                              ['city', '=', $city],
                              ['name', 'like', '%' . $search_by_name . '%']
                          ])
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
                $value_print = CustomHelpers::get_gall_data($data);
                echo $value_print;
            }

            // Case 5: Country and state are selected, but no city, and search term is provided
            if ($country != ""  && $state != "" && $city == '' && $search_by_name != "") {
                $data = DB::table('package_image_gallery')
                          ->where([
                              ['country', '=', $country],
                              ['state', '=', $state],
                              ['name', 'like', '%' . $search_by_name . '%']
                          ])
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
                $value_print = CustomHelpers::get_gall_data($data);
                echo $value_print;
            }

            // Case 6: Only country and search term are provided, no state or city
            if ($country != ""  && $state == "" && $city ==''  && $search_by_name != "") {
                $data = DB::table('package_image_gallery')
                          ->where([
                              ['country', '=', $country],
                              ['name', 'like', '%' . $search_by_name . '%']
                          ])
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
                $value_print = CustomHelpers::get_gall_data($data);
                echo $value_print;
            }

            // Case 7: No country, state, or city, but search term is provided
            if ($country == "" && $state == "" && $city =='' && $search_by_name != "") {
                $data = DB::table('package_image_gallery')
                          ->where('name', 'like', '%' . $search_by_name . '%')
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
                $value_print = CustomHelpers::get_gall_data($data);
                echo $value_print;
            }

            // Case 8: No filters or search term are applied (fetch all data)
            if ($search_by_name == "" && $country == "" && $state == "" && $city =='' ) {
                $data = PackageImageGallery::orderBy('created_at', 'desc')->paginate(12);

                $value_print = CustomHelpers::get_gall_data($data);
                echo $value_print;
            }
        
    }

    public function img_gallery() 
    {

//         $all_datas=PackageImageGallery::all();


//         foreach ($all_datas as $package) {
   

//     $countries = $package->country;
   
//     $package->country = CustomHelpers::get_master_table_data('countries', 'name', $countries, 'id');

//     $states = $package->state;
  
//     $package->state = CustomHelpers::get_master_table_data('states', 'name', $states, 'id');

//     $cities = $package->city;
  
//     $package->city = CustomHelpers::get_master_table_data('city', 'name', $cities, 'id');


//     $package->save();
// }
            $check_data=ActivateService::where('services','=','tour_package_manager')->first();
            if($check_data->activation==1):
                $countries=countries::all();
                $data=PackageImageGallery::orderBy('created_at', 'desc')->paginate(8);
                // $data=PackageImageGallery::all();
                // foreach($data as $datas):
                //   $images=explode("/", $datas->image_path);
                //   $image=$images[3];
                //    echo $image."<br>";
                // endforeach;
                return view("imagegallery.index",compact("data","countries"));
            else:
                return response()->view('error.404', [], 404);
            endif;
    }
      
    public function country_sorting(Request $request) 
    {
            $country_name=$request->country;
            $search_by_name=$request->search_by_name;
            if($country_name!="" && $country_name!="0" && $search_by_name=="") {
                $data=DB::table('package_image_gallery')
                ->where('country','=',$country_name)->orderBy('created_at', 'desc')->paginate(8);
                $value_print =CustomHelpers::get_gall_data($data);
                echo $value_print;
                }
            if($country_name!="" && $country_name!="0" && $search_by_name!="") {
                $data=DB::table('package_image_gallery')
                ->where([['country','=',$country_name],['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(8);
                $value_print =CustomHelpers::get_gall_data($data);
                echo $value_print;
                }
    }
      
    public function state_sorting(Request $request) 
    {
            $country_name=$request->country;
            $state_name=$request->state;
            $search_by_name=$request->search_by_name;
            if($search_by_name=="") {
                $data=DB::table('package_image_gallery')
                ->where([['country','=',$country_name],['state','=',$state_name]])->orderBy('created_at', 'desc')->paginate(8);
                $value_print =CustomHelpers::get_gall_data($data);
                echo $value_print;
                }
            if($search_by_name!="") {
                $data=DB::table('package_image_gallery')
                ->where([['country','=',$country_name],['state','=',$state_name],['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(8);
                $value_print =CustomHelpers::get_gall_data($data);
                echo $value_print;
                }
    }
      
    public function city_sorting(Request $request) 
    {
            $country_name=$request->country;
            $state_name=$request->state;
            $city_name=$request->city;
            $search_by_name=$request->search_by_name;
            if($search_by_name=="") {
                $data=DB::table('package_image_gallery')
                ->where([['country','=',$country_name],['state','=',$state_name],['city','=',$city_name]])->orderBy('created_at', 'desc')->paginate(8);
                $value_print =CustomHelpers::get_gall_data($data);
                echo $value_print;
                }
            if($search_by_name!="") {
                $data=DB::table('package_image_gallery')
                ->where([['country','=',$country_name],['state','=',$state_name],['city','=',$city_name],['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(8);
                $value_print =CustomHelpers::get_gall_data($data);
                echo $value_print;
                }
    }
      
    public function get_gall_state(Request $request)
    {
            $country_id=$request->country;
            
            $state=$request->sta_name;
            $data=DB::table('states')
                 ->where('country_id','=',$country_id)
                 ->get();
            foreach($data as $datavalue):
            if($datavalue->id==$state):
            echo '<option value="'.$datavalue->id.'" selected="selected">'.$datavalue->name.'</option>';
            else:
              echo '<option value="'.$datavalue->id.'">'.$datavalue->name.'</option>';
            endif;
            endforeach;
    }
      
    public function get_gall_city(Request $request)
    {
            $state_code=$request->sta_name;
           
            $city=$request->cit_name;
            $data=DB::table('city')
                 ->where('state_id','=',$state_code)
                 ->get();
            foreach($data as $datavalue):
            if($datavalue->id==$city):
            echo '<option value="'.$datavalue->id.'" selected="selected">'.$datavalue->name.'</option>';
            else:
              echo '<option value="'.$datavalue->id.'">'.$datavalue->name.'</option>';
            endif;
            endforeach;
    }
      
    public function edit_gallery_form(Request $request) 
    {
            $data=PackageImageGallery::find($request->pac_id);
            $type=$data->type;
            if($type=='video'):
                if($request->file('uploadvideo')):
                    $video=$request->file('uploadvideo');
                    $mime = $video->getMimeType();
                if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") {
                    $file_path = public_path()."/uploads/packages/video/".$data->image_main;
                    unlink($file_path);
                    $new_name = rand().'.'.$video->getClientOriginalExtension();
                    $video->move(public_path().'/uploads/packages/video/', $new_name);
                    $data->image_main = $new_name;
                }
            endif;
            if($request->file('image_thumb')):
            //thumbnil_medium
                $image =$request->file('image_thumb');
                $destination_medium=public_path('/uploads/packages/thum_medium');
                $thum_medium=rand().'.'.$image->getClientOriginalExtension();
                $img_medium = Image::make($image->getRealPath());
                $img_medium->resize(350, 260, function ($constraint) {
                    $constraint->aspectRatio();
                    })
                ->save($destination_medium.'/'.$thum_medium);
            //thumbnil_small
                $destination_small=public_path('/uploads/packages/thum_small');
                $thum_small=rand().'.'.$image->getClientOriginalExtension();
                $img_small = Image::make($image->getRealPath());
                $img_small->resize(100, 70, function ($constraint) {
                    $constraint->aspectRatio();
                    })
                ->save($destination_small.'/'.$thum_small);
            //
                $data->thum_medium = $thum_medium;
                $data->thum_small = $thum_small;
            endif;
            else:
                if($request->file('uploadimage')) {
                    $image_array=$request->file('uploadimage');
                    $file_path=public_path($request->uploadimage_value);
                    unlink($file_path);
                    //main_part
                    $destination_main=public_path('/uploads/packages');
                    $main_name=rand().'.'.$image_array->getClientOriginalExtension();
                    $img_main = Image::make($image_array->getRealPath());
                    $img_main->resize(750, 520, function ($constraint) {
                        $constraint->aspectRatio();
                        })
                    ->save($destination_main.'/'.$main_name);
                    //thumbnil_medium
                    $destination_medium=public_path('/uploads/packages/thum_medium');
                    $thum_medium=rand().'.'.$image_array->getClientOriginalExtension();
                    $img_medium = Image::make($image_array->getRealPath());
                    $img_medium->resize(350, 260, function ($constraint) {
                        $constraint->aspectRatio();
                        })
                    ->save($destination_medium.'/'.$thum_medium);
                    //thumbnil_small
                    $destination_small=public_path('/uploads/packages/thum_small');
                    $thum_small=rand().'.'.$image_array->getClientOriginalExtension();
                    $img_small = Image::make($image_array->getRealPath());
                    $img_small->resize(100, 70, function ($constraint) {
                        $constraint->aspectRatio();
                        })
                    ->save($destination_small.'/'.$thum_small);
                    //
                    $data->image_main = $main_name;
                    $data->thum_medium = $thum_medium;
                    $data->thum_small = $thum_small;
                    $path = '/uploads/packages/'.$main_name;
                    //
                   $data->image_path = $path;
                    }
                endif;
                $data->country = $request->country;
                $data->state = $request->state;
                $data->city = $request->city;
                $data->name = $request->name;
                $data->save();
           $country=$request->c_val;
           $state=$request->s_val;
           $city=$request->ct_val;
           $search_by_name=$request->search_val;
        if($country!="" && $state=="" && $city=="" && $search_by_name=="")
        {
       $data=DB::table('package_image_gallery')
              ->where('country','=',$country)->orderBy('created_at', 'desc')->paginate(15);
        $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
        if($country!="" && $state!="" && $city=='' && $search_by_name=="")
        {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],['state','=',$state]])->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
           }
        if($country!="" && $state!="" && $city!="" && $search_by_name=="")
        {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],['state','=',$state],['city','=',$city]])->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
           }
           if($country!="" &&  $state!="" && $city!="" && $search_by_name!="")
           {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],['state','=',$state],['city','=',$city],['name','like', '%' . $search_by_name . '%']])->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
           }
         if($country!=""  && $state!="" && $city=="" && $search_by_name!="")
           {
          $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],
                         ['state','=',$state],
                         ['name','like', '%' . $search_by_name . '%']])->orderBy('created_at', 'desc')->paginate(15);
            $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
           }
           if($country!="" &&  $state=="" && $city=='' && $search_by_name!="")
           {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],
                         ['name','like', '%' . $search_by_name . '%']])->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
           }
          if($country=="" && $state=="" && $city=="" && $search_by_name!="")
           {
          $data=DB::table('package_image_gallery')
                ->where('name','like', '%' . $search_by_name . '%')->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
           }
          if($country=="" && $state=="" && $city=="" && $search_by_name=="")
           {
         $data=PackageImageGallery::orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
             echo $value_print;
           }
           // else
           // {
           //    $data=PackageImageGallery::orderBy('created_at', 'desc')->paginate(15);
           //      $value_print =CustomHelpers::get_gall_data($data);
           //      echo $value_print;
           // }
    }
      
    public function add_image_ingallery()
    {
          $check_data=ActivateService::where('services','=','tour_package_manager')->first();
          if($check_data->activation==1):
           if(Sentinel::check()):
           if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
            $countries=countries::all();
            return view("imagegallery.add_image_ingallery",compact("countries"));
          else:
            return redirect("/");
          endif;
        endif;
        else:
           return response()->view('error.404', [], 404);
         endif;
    }
      
    public function add_video_ingallery()
    {
          $check_data=ActivateService::where('services','=','tour_package_manager')->first();
          if($check_data->activation==1):
           if(Sentinel::check()):
           if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
            $countries=countries::all();
            return view("imagegallery.add_video_ingallery",compact("countries"));
          else:
            return redirect("/");
          endif;
        endif;
        else:
           return response()->view('error.404', [], 404);
         endif;
    }
      
    public function store_package_image_gallery(Request $request)
    {
            if($request->file('uploadimage'))
            {
                $image_array=$request->file('uploadimage');
                $image_array_count=count($image_array);
                for($i=0;$i<$image_array_count;$i++)
                {
                //original
           

             $destination_original=public_path('/uploads/packages/original');
                $original_name=rand().'.'.$image_array[$i]->getClientOriginalExtension();
                $img_original = Image::make($image_array[$i]->getRealPath())->save($destination_original.'/'.$original_name);
              

                //main_part
                $destination_main=public_path('/uploads/packages');
                $main_name=rand().'.'.$image_array[$i]->getClientOriginalExtension();
                $img_main = Image::make($image_array[$i]->getRealPath());
                $img_main->resize(750, 520, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destination_main.'/'.$main_name);
                //thumbnil_medium
                $destination_medium=public_path('/uploads/packages/thum_medium');
                $thum_medium=rand().'.'.$image_array[$i]->getClientOriginalExtension();
                $img_medium = Image::make($image_array[$i]->getRealPath());
                $img_medium->resize(350, 260, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destination_medium.'/'.$thum_medium);
                //thumbnil_small
                $destination_small=public_path('/uploads/packages/thum_small');
                $thum_small=rand().'.'.$image_array[$i]->getClientOriginalExtension();
                $img_small = Image::make($image_array[$i]->getRealPath());
                $img_small->resize(100, 70, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destination_small.'/'.$thum_small);
                //
                $path = '/uploads/packages/'.$main_name;
                //move the file to correct location
                $data=new PackageImageGallery;
                $data->image_path = $path;
                $data->original = $original_name;
                $data->thum_medium = $thum_medium;
                $data->thum_small = $thum_small;
                $data->image_main = $main_name;
                $data->country = $request->country;
                $data->state = $request->state;
                $data->city = $request->city;
                $data->name = $request->name;
                $data->save();
                }
                return redirect("/img_gallery");
            }
            else
            {
                return back();
            }
    }
      
    public function store_video_image_gallery(Request $request)
    {
            if($request->file('uploadvideo'))
            {
                $video=$request->file('uploadvideo');
                $mime = $video->getMimeType();
                if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv")
               {
                 $new_name = rand().'.'.$video->getClientOriginalExtension();
                 $video->move(public_path().'/uploads/packages/video/', $new_name);
                  //
                 //thumbnil_medium
                  $image =$request->file('image_thumb');
                $destination_medium=public_path('/uploads/packages/thum_medium');
                $thum_medium=rand().'.'.$image->getClientOriginalExtension();
                $img_medium = Image::make($image->getRealPath());
                $img_medium->resize(350, 260, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destination_medium.'/'.$thum_medium);
                //thumbnil_small
                $destination_small=public_path('/uploads/packages/thum_small');
                $thum_small=rand().'.'.$image->getClientOriginalExtension();
                $img_small = Image::make($image->getRealPath());
                $img_small->resize(100, 70, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destination_small.'/'.$thum_small);
                //
                 $data=new PackageImageGallery;
                $data->thum_medium = $thum_medium;
                $data->thum_small = $thum_small;
                $data->image_main = $new_name;
                $data->type = 'video';
                $data->country = $request->country;
                $data->state = $request->state;
                $data->city = $request->city;
                $data->name = $request->name;
                $data->save();
                return redirect("/img_gallery");
               }
               else
               {
                return back();
               }
            }
            else
            {
                return back();
            }
    }
      
    public function edit_image_ingallery($id)
    {
            $data=PackageImageGallery::find($id);
            return view("imagegallery.edit_image_ingallery",compact("data"));
    }
      
    public function update_package_image_gallery($id,Request $request)
    {
             $data=PackageImageGallery::find($id);
              if($request->file('uploadimage'))
            {
                $image_array=$request->file('uploadimage');
                $filename = uniqid(). $image_array->getClientOriginalName();
                $path = '/uploads/packages/'.$filename;
                //move the file to correct location
                $image_array->move(public_path().'/uploads/packages/', $filename);
            }
            else
            {
               $path=$request->uploadimage_value;
            }
                $data->image_path = $path;
                $data->country = $request->country;
                $data->city = $request->city;
                $data->name = $request->name;
                $data->save();
                return redirect("/img_gallery");
    }

    public function delete_image_ingallery($id)
    {
             $data=PackageImageGallery::find($id);
             if($data):
                PackageImageGallery::destroy($id);
                return redirect("/img_gallery");
             else:
               return redirect("/img_gallery");
             endif;
    }
      
    public function search_name_gallery(Request $request)
    {
           $country=$request->country;
           $state=$request->state;
           $city=$request->city;
           $search_by_name=$request->search_by_city;
            //if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") && $search_by_name=="")
        if($search_by_name!="" && $country!="" && $state=="" && $city=='') {
          $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
          $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
       //if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") && $search_by_name=="")
       if($search_by_name!="" && $country!="" && $state!="" && $city=='' )
        {
       $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],
                        ['state','=',$state],
                       ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
           $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
       //if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") && $search_by_name=="")
       if($search_by_name!="" && $country!="" && $state!="" && $city!="" )
        {
       $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],
                        ['state','=',$state],
                        ['city','=',$city],
                       ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
           $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
        if($search_by_name=="" && $country!="" && $state=="" && $city=='')
        {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],
                         ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
            $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
        }
        if($search_by_name=="" && $country!=""  && $state!="" && $city=='')
          {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],
                         ['state','=',$state],
                         ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
        }
        if($search_by_name=="" && $country!="" && $state!="" && $city!="")
          {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],
                         ['state','=',$state],
                         ['city','=',$city],
                         ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
        }
        if($search_by_name!="" && $country=="" && $state=='' && $city=='')
          {
         $data=DB::table('package_image_gallery')
                ->where('name','like','%'.$search_by_name.'%')->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
        }
        if($search_by_name=="" && $country=="" && $state=="" && $city=='')
        {
       $data=PackageImageGallery::orderBy('created_at', 'desc')->paginate(15);
        $value_print =CustomHelpers::get_gall_data($data);
        echo $value_print;
          }
    }
      
    public function delete_image_ingall(Request $request)
    {
           $data_get=PackageImageGallery::find($request->id);
           if (!empty($data_get->image_path)) {
            $path1 = public_path($data_get->image_path);
                  if (file_exists($path1)) {
                 unlink($path1);
                  }
              }
           if (!empty($data_get->original)) {
         $path2 = public_path('uploads/packages/original/' . $data_get->original);
           if (file_exists($path2)) {
            unlink($path2);
             }
              }
           if (!empty($data_get->thum_medium)) {
    $path3 = public_path('uploads/packages/thum_medium/' . $data_get->thum_medium);
    if (file_exists($path3)) {
        unlink($path3);
    }
}
           if (!empty($data_get->thum_small)) {
    $path4 = public_path('uploads/packages/thum_small/' . $data_get->thum_small);
    if (file_exists($path4)) {
        unlink($path4);
    }
}
          
           PackageImageGallery::destroy($request->id);
           $country=$request->country;
           $state=$request->state;
           $city=$request->city;
           $search_by_name=$request->search_by_city;
        //if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") && $search_by_name=="")
        if($search_by_name!="" && $country!="" && $state=="" && $city=='') {
          $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
          $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
       //if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") && $search_by_name=="")
       if($search_by_name!="" && $country!="" && $state!="" && $city=='' )
        {
       $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],
                        ['state','=',$state],
                       ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
           $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
       //if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") && $search_by_name=="")
       if($search_by_name!="" && $country!="" && $state!="" && $city!="" )
        {
       $data=DB::table('package_image_gallery')
              ->where([['country','=',$country],
                        ['state','=',$state],
                        ['city','=',$city],
                       ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
           $value_print =CustomHelpers::get_gall_data($data);
          echo $value_print;
        }
        if($search_by_name=="" && $country!="" && $state=="" && $city=='')
        {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],
                         ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
            $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
        }
        if($search_by_name=="" && $country!=""  && $state!="" && $city=='')
          {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],
                         ['state','=',$state],
                         ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
        }
        if($search_by_name=="" && $country!="" && $state!="" && $city!="")
          {
         $data=DB::table('package_image_gallery')
                ->where([['country','=',$country],
                         ['state','=',$state],
                         ['city','=',$city],
                         ['name','like','%'.$search_by_name.'%']])->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
        }
        if($search_by_name!="" && $country=="" && $state=='' && $city=='')
          {
         $data=DB::table('package_image_gallery')
                ->where('name','like','%'.$search_by_name.'%')->orderBy('created_at', 'desc')->paginate(15);
             $value_print =CustomHelpers::get_gall_data($data);
            echo $value_print;
        }
        if($search_by_name=="" && $country=="" && $state=="" && $city=='')
        {
       $data=PackageImageGallery::orderBy('created_at', 'desc')->paginate(15);
        $value_print =CustomHelpers::get_gall_data($data);
        echo $value_print;
          }
        // else
           // {
           //    $data=PackageImageGallery::orderBy('created_at', 'desc')->paginate(15);
           //      $value_print =CustomHelpers::get_gall_data($data);
           //      echo $value_print;
           // }
    }
      
    public function edit_package_image($id1,$id2)
    {
          $data=PackageUploads::find($id1);
          $data1=Packages::find($id2);
          return view("manage_packages.uploadimageedit",compact("data","data1"));
    }
      
    public function edit_package_gallery_image($id1,$id2) 
    {

        $data=$id1;
        $data1=$id2;
        $gallery_data=PackageImageGallery::find($data);
        $countries=countries::all();
       
       
        $state=DB::table('states')
            ->where('country_id','=', $gallery_data->country)->get();
        $city=DB::table('city')
            ->where('state_id','=', $gallery_data->state)->get();
        return view("manage_packages.editimagemiddle",compact("data","data1","countries","state","city",'gallery_data'));
    }
      
    public function update_uploadimage($id,Request $request)
    {
          $file=$request->file('upload_image');
          if($file):
            $filename = uniqid(). $file->getClientOriginalName();
            $path = '/uploads/packages/'.$filename;
            //move the file to correct location
            $file->move(public_path().'/uploads/packages/', $filename);
          else:
              $path=$request->upload_image_value;
          endif;
          $data=PackageUploads::find($id);
          $data->image_path = $path;
          $data->save();
          return redirect("/packageUploads/".$data->package_id);
    }
      
    public function packagefiledelete($id,$id2,Request $request)
    {
            $image = PackageUploads::find($id);
                $image->destroy($id);
            return redirect ('/packageUploads/'.$id2);
    }
      
    /*Display the specified resource*/  
    public function show($id)
    {
        //
    }
      
    /*Show the form for editing the specified resource.*/
    public function check_package_availibility(Request $request)
    {
          $package_name=$request->package_name;
           $Packages = Packages::where('title',$package_name)->get();
           if(count($Packages)>0)
           {
            echo 'This tour name is already in use';
           }
    }
    public function check_package_code_availibility(Request $request)
    {
          $package_code=$request->package_code;
           $Packages = Packages::where('package_code',$package_code)->get();
           if(count($Packages)>0)
           {
            echo 'This package code is already in use';
           }
    }
    public function common_edit_clone($id, $type)
    {
      //
//         $all_packages=Packages::all();

// $continentMappings = DB::table('continent')->pluck('id', 'continent_name')->toArray();
// $countryMappings = DB::table('countries')->pluck('id', 'name')->toArray();
// $stateMappings = DB::table('states')->pluck('id', 'name')->toArray();
// $cityMappings = DB::table('city')->pluck('id', 'name')->toArray();

//         foreach ($all_packages as $package) {
//     $continents = unserialize($package->continent);
//     $continentIds = array_map(fn($name) => $continentMappings[$name] ?? null, $continents);
//     $package->continent = serialize(array_filter($continentIds));

//     $countries = unserialize($package->country);
//     $countryIds = array_map(fn($name) => $countryMappings[$name] ?? null, $countries);
//     $package->country = serialize(array_filter($countryIds));

//     $states = unserialize($package->state);
//     $stateIds = array_map(fn($name) => $stateMappings[$name] ?? null, $states);
//     $package->state = serialize(array_filter($stateIds));

//     $cities = unserialize($package->city);
//     $cityIds = array_map(fn($name) => $cityMappings[$name] ?? null, $cities);
//     $package->city = serialize(array_filter($cityIds));

//     $package->save();
// }
      
            //
           $check_data=ActivateService::where('services','=','tour_package_manager')->first();
           if($check_data->activation==1):
             $Packages = Packages::findOrFail($id);
            
           //  dd($pkgSchedule);
            
             
            

            $pkgSupplier = PkgSupplier::where('pkg_id',$Packages->id)->first();

            $city[]="";
            if($Packages->accommodation!="" && $Packages->accommodation!="0"):
            $pkg_accommodation=unserialize($Packages->accommodation);
      
            
            if(count($pkg_accommodation)!="")
            {
              foreach($pkg_accommodation as $pkg_accommodations):
               if(array_key_exists('city',$pkg_accommodations)):
                $city[]=$pkg_accommodations["city"];
               endif;
                
              endforeach;
            }
          endif;
            $city=array_filter(array_unique($city));
           
            $inclusions = PkgInclusions::where('status','1')->get();
            $exclusions = PkgExclusions::where('status','1')->get();
            $transfers = transferList::where('status','1')->get();
            $airlines = airlineList::where('status','1')->get();
            $activities = Activity::where('status','1')->get();
            $locations = Locations::where('status','1')->orderBy('location')->get();
            
            $iatalist = iataList::where('status','1')->get();
            $continents = DB::table('continent')->get();
           
            $types = Pkgtype::where('status','1')->get();
            //$PkgTours = PkgTours::where('status','1')->whereIn('location', $city)->get();

         
            $hotel = Hotel::select('id','name')->get();
            $hotelcity = Hotel::select('city')->distinct()->where('status','1')->get();
            $paymentPolicy = PkgPaymentPolicy::where('status','1')->get();
            $cancelPolicy = PkgCancelPolicy::where('status','1')->get();
            $ratingType = PkgRatingType::where('status','1')->get();
            $visaPolicy = PkgVisa::where('status','1')->get();
            $countries=countries::all();
            $transport=Transport::all();
            $rates    =rates::all();
            $icons    =Icons::all();
            $generals    =Gtags::all();
            $suitables    =Suitable::all();
            $holidays    =Holiday::all();
            $package_hotel=PackageHotel::all();
            $imp_notes=ImportantNotes::all();
            $tourtypes = TourType::where('status','1')->get();
            $tourcategories = TourCategory::where('status','1')->get();
            $supplier=Supplier::all();
          $markup_profit=QuoteCharges::where('charges_type','=','Markup Profit')->get();
          $discunt_positive=QuoteCharges::where('charges_type','=','Discount (+)')->get();
          $discunt_negative=QuoteCharges::where('charges_type','=','Discount (-)')->get();
          $gst=QuoteCharges::where('charges_type','=','GST')->get();
          $tcs=QuoteCharges::where('charges_type','=','TCS')->get();
          $pg=QuoteCharges::where('charges_type','=','PG')->get();
          $coupons=Coupon::all();
          $page='manage_packages.edit';

            return view($page,[    'packagesData'=>CustomHelpers::get_package_details($Packages, 'main_data'),
                                                    'packageSupplier'=>$pkgSupplier,
                                                    'inclusions'=>$inclusions,
                                                    'exclusions'=>$exclusions,
                                                    'transfers'=>$transfers,
                                                    'airlines'=>$airlines,
                                                    'activities'=>$activities,
                                                    'locations'=>$locations,
                                                    'iatalist'=>$iatalist,
                                                    'types'=>$types,
                                                    'PkgTours'=>CustomHelpers::get_package_details($Packages, 'PkgTours'),
                                                    'hotel'=>$hotel,
                                                    'hotelcity'=>$hotelcity,
                                                    'continents'=>$continents,
                                                    
                                                    
                                                    'paymentPolicy'=>$paymentPolicy,
                                                    'cancelPolicy'=>$cancelPolicy,
                                                    'visaPolicy' =>$visaPolicy,
                                                    'ratingType'=>$ratingType,
                                                    
                                                    'countries'=>$countries,
                                                    'transport'=>$transport,
                                                    'rates'    =>$rates, 
                                                    'icons'    =>$icons, 
                                                    'suitables'    =>$suitables, 
                                                    'generals'    =>$generals, 
                                                    'holidays'    =>$holidays, 
                                                    'package_hotel'=>$package_hotel, 
                                                    'imp_notes'=>$imp_notes, 
                                                    'Packages'=>$Packages,
                                                    'tourtypes'=>$tourtypes,
                                                    'tourcategories'=>$tourcategories,
                                                    'supplier'=>$supplier, 
                                                    'markup_profit'=>$markup_profit, 
                                                    'discunt_positive'=>$discunt_positive, 
                                                    'discunt_negative'=>$discunt_negative,
                                                    'gst'=>$gst,
                                                    'tcs'=>$tcs,
                                                    'pg'=>$pg,
                                                    'coupons'=>$coupons,
                                                    'action_type'=>$type,
                                                ]);
            // dd($packageData);

          else:
           return response()->view('error.404', [], 404);
         endif; 
           
    }  
    public function edit($id)
    {
        return $this->common_edit_clone($id, 'edit');
    }
      
    public function duplicates($id)
    {
     return $this->common_edit_clone($id, 'clone');
            
    }

    

    /*Update the specified resource in storage.*/
    public function update(Request $request)
    {
           // dd($request);
            $this->validate($request, [
                'package_name' => 'required',
                'description' => 'required',
                'country' => 'required|not_in:0',               
                'package_destination' => 'required',               
                'duration' => 'required',               
            ]);
           // dd($request);
          
            $package = Packages::findOrFail($request->input('id'));

            $package->title = $request->package_name;
            $package->description = $request->description;
            $package->country = $request->country;
            $package->package_category =  $request->package_category;
            $package->transfers =  $request->transfers;
            $package->airlines =  $request->airlines;
            $package->activities =  $request->activities;
            $package->iatalist =  $request->iatalist;
            $package->package_destination = $request->package_destination;
            $package->destinations = $request->destinations;
            $package->similar_packages = $request->similar_packages;
            $package->sp_city = $request->sp_city;
            $package->type_of_package = $request->type;
            $package->duration = $request->duration;
            $package->inclusions = serialize($request->inclusions);
            $package->exclusions = serialize($request->exclusions);
            //$package->transfers = serialize($request->transfers);
            $package->day_itinerary = serialize($request->dayItinerary);
            $package->payment_policy = $request->payment_policies;
            $package->cancel_policy = $request->cancellation;
            $package->pricing = serialize($request->Price);
            $package->tour_inc = serialize($request->tour_inc);
            $package->tour_exc = serialize($request->tour_exc);
            $package->tour_type = $request->tour_type;
            $package->tour_category = $request->tour_category;
            $package->sourcecity = $request->sourcecity;
            $package->select_star_rating = $request->select_star_rating;
            if($package->save()){
                return redirect ('/tours');
            }       
    }
      
    public function delete(Request $request) 
    {
        $id = $request->input('id');
        Packages::find ( $request->id )->delete ();
        return redirect('/tours');
    }
      
    public function getCities(Request $request) 
    {
            if($request->input('cotegory')== 'international'){
                $cities = DB::table('subregions')->select('name')->whereIn('region_id',$request->input('state'))->orderBy('name', 'ASC')->get();
                 $option = '';
                 foreach($cities as $city){
                     if($request->input('selected')){
                        $option .='<option value="'.$city->name.'"';
                        if($request->input('selected')==$city->name){
                            $option .='selected="selected"';
                        }
                        $option .='>'.$city->name.'</option>';
                     }else{
                        $option .='<option value="'.$city->name.'">'.$city->name.'</option>';
                     }
                 }
                 echo $option;die;
            }else{
                $cities = DB::table('cities')->select('city_name')->whereIn('city_state',$request->input('state'))->orderBy('city_name', 'ASC')->get();
                 $option = '';
                 foreach($cities as $city){
                    if($request->input('selected')){
                        $option .='<option value="'.$city->city_name.'"';
                        if($request->input('selected')==$city->city_name){
                            $option .='selected="selected"';
                        }
                        $option .='>'.$city->city_name.'</option>';
                    }else{
                        $option .='<option value="'.$city->city_name.'">'.$city->city_name.'</option>';
                    }
                 }
                 echo $option;die;
            }
    }

    /*----------*/

    // enable package details
    /*public function search_enable(Request $request)
    {
            $status=$request->status;
            $id=$request->pak_id;
            $data=Packages::find($id);
            if($data):
                $data->search_status=$status;
                $data->save();
            endif;
    }
      
    // disable package details
    public function search_disable(Request $request)
    {
            $status=$request->status;
            $id=$request->pak_id;
            $data=Packages::find($id);
            if($data):
                $data->search_status=$status;
                $data->save();
            endif;
    }*/

    // enable/disable package details (combined)
    public function toggle_search_status(Request $request) 
    {
        $status = $request->status;
        $id = $request->pak_id;
        
        // Find the package by ID
        $data = Packages::find($id);
        
        if ($data) {
            // Update the search status
            $data->search_status = $status;
            $data->save();
            
            return response()->json(['success' => true, 'message' => 'Search status updated.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Package not found.']);
        }
    }

    /*----------*/
      
    /*// second page enable package status
    public function enable(Request $request) 
    {
            $status=$request->status;
            $id=$request->pak_id;
            $data=Packages::find($id);
            if($data):
                $data->status=$status;
                $data->save();
            endif;
    }

    // second page disable package status
    public function disable(Request $request) 
    {
            $status=$request->status;
            $id=$request->pak_id;
            $data=Packages::find($id);
            if($data):
                $data->status=$status;
                $data->save();
            endif;
    }*/

    // second page enable/disable package status (combined)
    public function toggle_second_page_package_status(Request $request) 
    {
        $status = $request->status;
        $id = $request->pak_id;
        $data = Packages::find($id);
        
        if($data) {
            $data->status = $status;
            $data->save();
            return response()->json(['message' => 'Status updated successfully']);
        }
        
        return response()->json(['message' => 'Package not found'], 404);
    }
      
    /*----------*/

    /*// home page package enable
    public function front_enable(Request $request) 
    {
            $status=$request->status;
            $id=$request->pak_id;
            $data=Packages::find($id);
            if($data):
                $data->front_show=$status;
                $data->save();
            endif;
    }
      
    // home page package disable
    public function front_disable(Request $request) 
    {
            $status=$request->status;
            $id=$request->pak_id;
            $data=Packages::find($id);
            if($data):
                $data->front_show=$status;
                $data->save();
            endif;
    }*/

    // home page package enable/disable (combined)
    public function toggle_home_page_package_status(Request $request) 
    {
          $status = $request->status;
          $id = $request->pak_id;
          $data = Packages::find($id);

          if ($data) {
              $data->front_show = $status;
              $data->save();
              return response()->json(['message' => 'Front show status updated successfully']);
          }

          return response()->json(['message' => 'Package not found'], 404);
    }
      
    /*----------*/

    public function getLocations(Request $request) 
    {
        // Check if the category is 'international'
        if ($request->input('cotegory') == 'international') {

            // Fetch locations where the country is in the input 'state' array
            $location = Locations::select('location', 'id')
                ->whereIn('country', $request->input('state'))
                ->orderBy('location', 'ASC')
                ->get();

            $option = ''; // Initialize option string for HTML

            // Loop through each location to create the <option> tags
            foreach ($location as $loc) {
                if ($request->input('selected')) {
                    // Build the option element with selected attribute if applicable
                    $option .= '<option value="' . $loc->id . '"';
                    if (in_array($loc->id, $request->input('selected'))) {
                        $option .= ' selected="selected"';
                    }
                    $option .= '>' . $loc->location . '</option>';
                } else {
                    // Build the option element without selected attribute
                    $option .= '<option value="' . $loc->id . '">' . $loc->location . '</option>';
                }
            }

            // Output the options and terminate the script
            echo $option;
            die;

        } else {
            // Fetch locations where the country is '356' (probably a default country)
            $location = Locations::select('location', 'id')
                ->where('country', '356')
                ->orderBy('location', 'ASC')
                ->get();

            $option = ''; // Initialize option string for HTML

            // Loop through each location to create the <option> tags
            foreach ($location as $loc) {
                if ($request->input('selected')) {
                    // Build the option element with selected attribute if applicable
                    $option .= '<option value="' . $loc->id . '"';
                    if (in_array($loc->id, $request->input('selected'))) {
                        $option .= ' selected="selected"';
                    }
                    $option .= '>' . $loc->location . '</option>';
                } else {
                    // Build the option element without selected attribute
                    $option .= '<option value="' . $loc->id . '">' . $loc->location . '</option>';
                }
            }

            // Output the options and terminate the script
            echo $option;
            die;
        }
    }

    /*----------*/

    public function getCountry(Request $request) 
    {
        // Check if the type is 'international'
        if ($request->input('type') == 'international') {

            // Fetch countries from the 'regions' table where the status is '1'
            $country = DB::table('regions')
                ->select()
                ->where('status', '1')
                ->orderBy('country', 'ASC')
                ->get();

            $option = ''; // Initialize option string for HTML

            // Loop through each country to create the <option> tags
            foreach ($country as $con) {
                if ($request->input('selected')) {
                    // Build the option element with selected attribute if applicable
                    $option .= '<option value="' . $con->id . '"';
                    if (in_array($con->id, $request->input('selected'))) {
                        $option .= ' selected="selected"';
                    }
                    $option .= '>' . $con->country . '</option>';
                } else {
                    // Build the option element without selected attribute
                    $option .= '<option value="' . $con->id . '">' . $con->country . '</option>';
                }
            }

            // Output the options and terminate the script
            echo $option;
            die;

        } else {
            // Fetch distinct city states from the 'cities' table
            $country = DB::table('cities')
                ->select('city_state')
                ->distinct()
                ->orderBy('city_state', 'ASC')
                ->get();

            $option = ''; // Initialize option string for HTML

            // Loop through each city state to create the <option> tags
            foreach ($country as $con) {
                if ($request->input('selected')) {
                    // Build the option element with selected attribute if applicable
                    $option .= '<option value="' . $con->city_state . '"';
                    if (in_array($con->city_state, $request->input('selected'))) {
                        $option .= ' selected="selected"';
                    }
                    $option .= '>' . $con->city_state . '</option>';
                } else {
                    // Build the option element without selected attribute
                    $option .= '<option value="' . $con->city_state . '">' . $con->city_state . '</option>';
                }
            }

            // Output the options and terminate the script
            echo $option;
            die;
        }
    }

    /*----------*/

    public function extra() 
    {
        // Check if the 'tour_package_manager' service is activated
        $check_data = ActivateService::where('services', '=', 'tour_package_manager')->first();

        // If the service is activated
        if ($check_data->activation == 1):

            // Return the 'hotel.extra' view with various hotel-related data
            return view('hotel.extra', [
                'hotelTypes' => $all_hoteltypes,
                'hotelAmenities' => $all_hotelamenities,
                'Roomsamenities' => $all_roomsamenities,
                'HotelGeneralSetting' => $all_HotelGeneralSetting,
                'HotelPaymentMethod' => $all_HotelPaymentMethod,
                'RoomsType' => $all_roomtype
            ]);

        // If the service is not activated, return a 404 error view
        else:
            return response()->view('error.404', [], 404);
        endif;
    }

    /*----------*/

    public function air_curr()
    {
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'>".$rate->currency." </option>";
            endforeach;
    }
      
    public function air_curr1(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    public function hot_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    public function tour_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    public function transfer_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    //
    public function visa_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    //
    public function adult_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    //
    public function chiildbed_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    //
    public function chiildwbed_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
             foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    //
    public function infant_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
            foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    //
    public function single_curr(Request $request)
    {
            $air_currency=$request->air_currency;
            $data=rates::all();
            foreach($data as $rate):
        echo "<option value='".$rate->id."' c_val='".$rate->rate."'";
            if($rate->id==$air_currency):
         echo "selected='selected'";
            endif;
        echo ">".$rate->currency." </option>";
            endforeach;
    }
      
    //
    public function total_adult(Request $request)
    {
          $air_currency=CustomHelpers::get_rate($request->air_currency);
          $air_fare_adult=$request->air_fare_adult;
          $hotel_currency=CustomHelpers::get_rate($request->hotel_currency);
          $hotel_fare_adult=$request->hotel_fare_adult;
          $tour_currency=CustomHelpers::get_rate($request->tour_currency);
          $tour_fare_adult=$request->tour_fare_adult;
          $transfer_currency=CustomHelpers::get_rate($request->transfer_currency);
          $transfer_fare_adult=$request->transfer_fare_adult;
          $visa_currency=CustomHelpers::get_rate($request->visa_currency);
          $visa_fare_adult=$request->visa_fare_adult;
          $total="0";
          if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
          {
               $total+=$air_currency*$air_fare_adult;
          }
          if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
          {
               $total+=$hotel_currency*$hotel_fare_adult;
          }
          if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
          {
               $total+=$tour_currency*$tour_fare_adult;
          }
          if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
          {
               $total+=$transfer_currency*$transfer_fare_adult;
          }
          if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
          {
               $total+=$visa_currency*$visa_fare_adult;
          }
          echo $total;
    }
      
    public function total_extra_adult(Request $request)
    {
          $air_currency=CustomHelpers::get_rate($request->air_currency);
          $air_fare_adult=$request->air_fare_exadult;
          $hotel_currency=CustomHelpers::get_rate($request->hotel_currency);
          $hotel_fare_adult=$request->hotel_fare_exadult;
          $tour_currency=CustomHelpers::get_rate($request->tour_currency);
          $tour_fare_adult=$request->tour_fare_exadult;
          $transfer_currency=CustomHelpers::get_rate($request->transfer_currency);
          $transfer_fare_adult=$request->transfer_fare_exadult;
          $visa_currency=CustomHelpers::get_rate($request->visa_currency);
          $visa_fare_adult=$request->visa_fare_exadult;
          $total="0";
          if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
          {
               $total+=$air_currency*$air_fare_adult;
          }
          if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
          {
               $total+=$hotel_currency*$hotel_fare_adult;
          }
          if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
          {
               $total+=$tour_currency*$tour_fare_adult;
          }
          if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
          {
               $total+=$transfer_currency*$transfer_fare_adult;
          }
          if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
          {
               $total+=$visa_currency*$visa_fare_adult;
          }
          echo $total;
    }
      
    public function total_child_with_bed(Request $request)
    {
          $air_currency=CustomHelpers::get_rate($request->air_currency);
          $air_fare_adult=$request->air_fare_childbed;
          $hotel_currency=CustomHelpers::get_rate($request->hotel_currency);
          $hotel_fare_adult=$request->hotel_fare_childbed;
          $tour_currency=CustomHelpers::get_rate($request->tour_currency);
          $tour_fare_adult=$request->tour_fare_childbed;
          $transfer_currency=CustomHelpers::get_rate($request->transfer_currency);
          $transfer_fare_adult=$request->transfer_fare_childbed;
          $visa_currency=CustomHelpers::get_rate($request->visa_currency);
          $visa_fare_adult=$request->visa_fare_childbed;
          $total="0";
          if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
          {
               $total+=$air_currency*$air_fare_adult;
          }
          if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
          {
               $total+=$hotel_currency*$hotel_fare_adult;
          }
          if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
          {
               $total+=$tour_currency*$tour_fare_adult;
          }
          if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
          {
               $total+=$transfer_currency*$transfer_fare_adult;
          }
          if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
          {
               $total+=$visa_currency*$visa_fare_adult;
          }
          echo $total;
    }
      
    public function total_child_without_bed(Request $request)
    {
          $air_currency=CustomHelpers::get_rate($request->air_currency);
          $air_fare_adult=$request->air_fare_childwbed;
          $hotel_currency=CustomHelpers::get_rate($request->hotel_currency);
          $hotel_fare_adult=$request->hotel_fare_childwbed;
          $tour_currency=CustomHelpers::get_rate($request->tour_currency);
          $tour_fare_adult=$request->tour_fare_childwbed;
          $transfer_currency=CustomHelpers::get_rate($request->transfer_currency);
          $transfer_fare_adult=$request->transfer_fare_childwbed;
          $visa_currency=CustomHelpers::get_rate($request->visa_currency);
          $visa_fare_adult=$request->visa_fare_childwbed;
          $total="0";
          if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
          {
               $total+=$air_currency*$air_fare_adult;
          }
          if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
          {
               $total+=$hotel_currency*$hotel_fare_adult;
          }
          if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
          {
               $total+=$tour_currency*$tour_fare_adult;
          }
          if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
          {
               $total+=$transfer_currency*$transfer_fare_adult;
          }
          if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
          {
               $total+=$visa_currency*$visa_fare_adult;
          }
          echo $total;
    }
      
    public function total_infant(Request $request)
    {
          $air_currency=CustomHelpers::get_rate($request->air_currency);
          $air_fare_adult=$request->air_fare_infant;
          $hotel_currency=CustomHelpers::get_rate($request->hotel_currency);
          $hotel_fare_adult=$request->hotel_fare_infant;
          $tour_currency=CustomHelpers::get_rate($request->tour_currency);
          $tour_fare_adult=$request->tour_fare_infant;
          $transfer_currency=CustomHelpers::get_rate($request->transfer_currency);
          $transfer_fare_adult=$request->transfer_fare_infant;
          $visa_currency=CustomHelpers::get_rate($request->visa_currency);
          $visa_fare_adult=$request->visa_fare_infant;
          $total="0";
          if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
          {
               $total+=$air_currency*$air_fare_adult;
          }
          if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
          {
               $total+=$hotel_currency*$hotel_fare_adult;
          }
          if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
          {
               $total+=$tour_currency*$tour_fare_adult;
          }
          if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
          {
               $total+=$transfer_currency*$transfer_fare_adult;
          }
          if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
          {
               $total+=$visa_currency*$visa_fare_adult;
          }
          echo $total;
    }
      
    public function total_single(Request $request)
    {
          $air_currency=CustomHelpers::get_rate($request->air_currency);
          $air_fare_adult=$request->air_fare_single;
          $hotel_currency=CustomHelpers::get_rate($request->hotel_currency);
          $hotel_fare_adult=$request->hotel_fare_single;
          $tour_currency=CustomHelpers::get_rate($request->tour_currency);
          $tour_fare_adult=$request->tour_fare_single;
          $transfer_currency=CustomHelpers::get_rate($request->transfer_currency);
          $transfer_fare_adult=$request->transfer_fare_single;
          $visa_currency=CustomHelpers::get_rate($request->visa_currency);
          $visa_fare_adult=$request->visa_fare_single;
          $total="0";
          if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
          {
               $total+=$air_currency*$air_fare_adult;
          }
          if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
          {
               $total+=$hotel_currency*$hotel_fare_adult;
          }
          if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
          {
               $total+=$tour_currency*$tour_fare_adult;
          }
          if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
          {
               $total+=$transfer_currency*$transfer_fare_adult;
          }
          if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
          {
               $total+=$visa_currency*$visa_fare_adult;
          }
          echo $total;
    }
}