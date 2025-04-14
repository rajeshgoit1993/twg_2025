<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade

use Illuminate\Http\Request;
use App\PackageHotel;
use App\ActivateService;
use Sentinel;
use App\State;
use App\City;
use App\PackageHotelUploads;
use DB;
use Validator;
use App\countries;
use App\PackageImageGallery;
use App\Helpers\CustomHelpers;
use Image;
use Datatables;

class PackageHotelController extends Controller
{
    /*// search city (select 2)
    public function search_city_with_country(Request $request)
    {
        $destination_search_value=$request->searchTerm;
      $data=City::select("name","state_id")
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

    // search city (select 2)
    
    /*----------*/

    public function filter_array($array, $letter) {
    $filtered_array=array();
   
    foreach($array as $key=>$val) {
        if($val[0]==$letter) {
            $filtered_array[]=$val;
            }
        }
    return $filtered_array;
    }

    public function city_country_data(Request $request)
    {
     // $city=strtolower($request->city);
     $city_id=$request->city;
     $states_id=City::where('id','=',$city_id)->pluck('state_id');
    
     $countries=DB::table('countries')->join('states','states.country_id','=','countries.id')->whereIn('states.id',$states_id)->select('countries.*')->get();
      
      $output='<option value="">--Select Country--</option>';
     foreach($countries as $country)
     {
        $output.='<option value="'.$country->id.'">'.$country->name.'</option>';
     }
        echo $output;
    }

    // package hotel
    public function package_hotels(Request $request) {
        // Retrieve the country and city from the request
        $country = $request->country;
        $city = $request->city;
      
        // Fetch data from the 'package_hotel' table based on country and city filters
        if ($country == 'NA' && $city == 'NA') {
            // No filters applied, fetch all package hotels
            $data = DB::table('package_hotel')->get();
        } elseif ($country != 'NA' && $city == 'NA') {
            // Filter by country only
            $data = DB::table('package_hotel')->where('propertycountry', $country)->get();
        } elseif ($country == 'NA' && $city != 'NA') {
            // Filter by city only
            $data = DB::table('package_hotel')->where('location', $city)->get();
        } elseif ($country != 'NA' && $city != 'NA') {
            // Filter by both country and city
            $data = DB::table('package_hotel')
                ->where([['location', $city], ['propertycountry', $country]])
                ->get();
        }

        // Return the data in a DataTables format
        return Datatables::of($data)
            ->addIndexColumn() // Add index column for serial numbers

            // Add hotel name column
            ->addColumn('hotel_name', function($row) {
                return '<span class="textCapitalize">' . $row->hotelname . '</span>';
            })

            // Add image column
            ->addColumn('image', function ($row) {
                // Get the first gallery image
                $gallery_id = CustomHelpers::get_first_galleryid($row->id);
                $gallery_image = CustomHelpers::get_image_gallery($gallery_id, 'thum_small');

                // Set default image
                $default_image = url('/public/uploads/default-img.webp');
                $src = $default_image;

                // Check if gallery image exists
                if (!empty($gallery_image) && $gallery_image != "0") {
                    $image_path = public_path(parse_url($gallery_image, PHP_URL_PATH));
                    if (file_exists($image_path)) {
                        $src = $gallery_image;
                    }
                }

                // Check if the hotel has a specific image and if it exists
                if (!empty($row->hotel_image)) {
                    $hotel_image_path = public_path('/uploads/package_hotel/' . $row->hotel_image);
                    if (file_exists($hotel_image_path)) {
                        $src = url('/public/uploads/package_hotel/' . $row->hotel_image);
                    }
                }

                // Return the image HTML
                return "<div class='typeImage'><img src='$src' alt='Hotel Image'></div>";
            })




            // Add location column
            ->addColumn('location', function($row) {

             

                return '<span class="textCapitalize">' . CustomHelpers::get_master_table_data('city', 'id', (int)$row->location, 'name') . '</span>';
            })

            // Add property type column
            ->addColumn('propertytype', function($row) {
                return '<span class="textCapitalize">' . $row->propertytype . '</span>';
            })

            // Add star rating column
            ->addColumn('rating', function($row) {
                return $row->star_rating . ' Star'; // Append the star symbol after the rating
                //return str_repeat('★', $row->star_rating); // Display stars based on the rating
            })

            // Add gallery column with link to uploads
            ->addColumn('gallery', function($row) {
                $upload_id = url('/') . '/packagehotelUploads/' . $row->id;
                $image_upload = "<a href='$upload_id'><button type='button' class='btn btn-sm btn-info'>Uploads</button></a>";
                return $image_upload;
            })

            // Add action column for edit and delete buttons
            ->addColumn('action', function($row) {
                $form_url = url('/delete_packagehotel/' . $row->id);
                $del_id = "packagedel$row->id";
                $edit_pac_url = url('/editpackagehotel/' . $row->id);
                
                // Start building the action buttons
                $package_list_data = "<form action='$form_url' method='POST' id='$del_id'>";
                $package_list_data .= csrf_field();

                // Check if the user has admin or super_admin roles
                if (Sentinel::check()) {
                    if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                        $package_list_data .= "<input type='hidden' name='id' value='$row->id'/></form>";
                    }
                }

                if (Sentinel::check()) {
                    if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                        $package_list_data .= "<a href='$edit_pac_url'><button type='button' class='btn btn-sm btn-warning'>Edit</button></a>";
                    }
                }

                if (Sentinel::check()) {
                    if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')) {
                        $package_list_data .= "<button id='$del_id' type='button' class='deletePackage btn btn-sm btn-danger apndLft5'>Delete</button>";
                    }
                }

                return $package_list_data;
            })

            // Generate the final output for DataTables
            ->make(true);
    }

    /*public function index() {
        // Check if the 'tour_package_manager' service is activated
        $check_data = ActivateService::where('services', '=', 'tour_package_manager')->first();
        
        // If the service is activated
        if ($check_data->activation == 1):
            // Get a list of unique hotel countries from the PackageHotel table
            $hotels_countries = PackageHotel::whereNotNull('propertycountry')
                                            ->groupBy('propertycountry')
                                            ->pluck('propertycountry');
            
            // Retrieve all records from the PackageHotel table
            $data = PackageHotel::all();
            
            // Return the 'package_hotel.index' view with the retrieved data and hotel countries
            return view("package_hotel.index", compact('data', 'hotels_countries'));
        
        // If the service is not activated, return a 404 error page
        else:
            return response()->view('error.404', [], 404);
        endif;
    }*/

    public function index() 
    {

//     $all_datas=PackageHotel::all();


//         foreach ($all_datas as $package) {
   

//     $countries = $package->propertycountry;
   
//     $package->propertycountry = CustomHelpers::get_master_table_data('countries', 'name', $countries, 'id');

   

//     $cities = $package->location;
  
//     $package->location = CustomHelpers::get_master_table_data('city', 'name', $cities, 'id');


//     $package->save();
// }
        // Check if the 'tour_package_manager' service is activated
        $check_data = ActivateService::where('services', 'tour_package_manager')->first();

        // Ensure $check_data exists and activation is enabled
        if ($check_data && $check_data->activation == 1) {
            // Get a list of unique hotel countries from the PackageHotel table
            $hotels_countries = PackageHotel::whereNotNull('propertycountry')
                                            ->distinct()
                                            ->pluck('propertycountry');

            // Retrieve all records from the PackageHotel table
            $data = PackageHotel::all();

            // Return the view with data
            return view("package_hotel.index", compact('data', 'hotels_countries'));
        }

        // If service is not activated, return a 404 error page
        return response()->view('error.404', [], 404);
    }


    public function add_hotel_country(Request $request) {
        $addcountry=$request->addcountry;
        $hotels_cities = PackageHotel::where('propertycountry',$addcountry)->whereNotNull('location')->groupBy('location')->pluck('location');
        echo "<option value='0'>Select City</option>";
        foreach($hotels_cities as $single):
        echo "<option value='".$single."' >".$single."</option>";
        endforeach;
    }

    public function create()
    {
      $check_data=ActivateService::where('services','=','tour_package_manager')->first();
     if($check_data->activation==1):
        if(Sentinel::check()):
      if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
        return view("package_hotel.insert");
          else:
       return redirect("/");
          endif;
          endif;
          else:
       return response()->view('error.404', [], 404);
          endif;
    }

    public function store_packagehotel(Request $request)
    {
        $this->validate($request,[
          "hotelname"=>"required",
        ]);
        if($request->file("hotel_image")!="")
        {
        $hotel_image = $request->file("hotel_image");
        //dd($icon);
        $hotel_image_ext=$hotel_image->getClientOriginalExtension();
        $hotel_imagename = uniqid().".".$hotel_image_ext;
        //move the file to correct location
        $hotel_image->move(public_path().'/uploads/package_hotel/', $hotel_imagename);
        }
        else
        {
         $hotel_imagename="";
        }
        if(Sentinel::check()):
        if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
        $data=new PackageHotel;
        $data->hotelname=$request->hotelname;
        $data->location =$request->location ;
        $data->star_rating=$request->star_rating;
        $data->hotel_image=$hotel_imagename;
        $data->link=$request->link;
        $data->propertycountry=$request->propertycountry;
        $data->propertytype=$request->propertytype;
        $data->propertyaddress=$request->propertyaddress;
        $data->propertymobile=$request->propertymobile;
        $data->propertyphone=$request->propertyphone;
        $data->propertyemail=$request->propertyemail;
        $data->propertymaplocation=$request->propertymaplocation;
        $data->propertystatus=$request->propertystatus;
        $data->save();
        return redirect ('/package_hotel');
        else:
        return redirect("/");
        endif;
        endif;
    }

    public function edit_packagehotel($id , Request $request)
    {
      $check_data=ActivateService::where('services','=','tour_package_manager')->first();
      if($check_data->activation==1):
        if(PackageHotel::find($id)):
        $data=PackageHotel::find($id);
        //dd($data);

        $states_id=City::where('id','=',$data->location)->pluck('state_id');
        
        $countries=DB::table('countries')->join('states','states.country_id','=','countries.id')->whereIn('states.id',$states_id)->select('countries.*')->get();
        return view("package_hotel.edit",compact("data",'countries'));
        else:
        return redirect ('/package_hotel');
        endif;
        else:
    return response()->view('error.404', [], 404);
        endif;
    }

    public function update_packagehotel($id,Request $request)
    {
        $this->validate($request,[
          "hotelname"=>"required",
        ]);
        $data=PackageHotel::find($id);
        if($request->file("hotel_image")!=""):
        $hotel_image = $request->file("hotel_image");
        //dd($icon);
        $hotel_image_ext=$hotel_image->getClientOriginalExtension();
        $hotel_imagename = uniqid().".".$hotel_image_ext;
        //move the file to correct location
        $hotel_image->move(public_path().'/uploads/package_hotel/', $hotel_imagename);
          else:
          $hotel_imagename = $request->hotel_image_value;
        endif;
        $data->hotelname=$request->hotelname;
        $data->location =$request->location ;
        $data->star_rating=$request->star_rating;
        $data->hotel_image=$hotel_imagename;
        $data->link=$request->link;
        $data->propertycountry=$request->propertycountry;
        $data->propertytype=$request->propertytype;
        $data->propertyaddress=$request->propertyaddress;
        $data->propertymobile=$request->propertymobile;
        $data->propertyphone=$request->propertyphone;
        $data->propertyemail=$request->propertyemail;
        $data->propertymaplocation=$request->propertymaplocation;
        $data->propertystatus=$request->propertystatus;
        $data->save();
         return redirect ('/package_hotel');
    }

    public function delete_packagehotel($id,Request $request)
    {
        $data=PackageHotel::find($id);
        if($data):
        PackageHotel::destroy($id);
         return redirect ('/package_hotel');
        else:
           return redirect ('/package_hotel');
        endif;
    }
    public function up_image(Request $request)
    {
        $id=$request->pak_id;
        $data=PackageHotelUploads::find($id);
        $sort=$data->sort;
        if($sort!='' && $sort!=1 && $sort!=0):
            $negative_sort=(int)$sort-1;
          $check_data=PackageHotelUploads::where('sort','=',$negative_sort)->first();
          if($check_data!=''):
            $check_data->sort=$sort;
            $check_data->save();
          else:
          endif;
          $data->sort=$negative_sort;
          $data->save();
          elseif($sort=='' || $sort==0):
              $previous_id='';
              $previous=PackageHotelUploads::where('sort','=',1)->first();
            if($previous!=''):
            $previous->sort=2;
            $previous->save();
            $previous_id=$previous->id;
             endif;
             if($previous_id!=''):
              $i=2;
             do{
            $check_data=PackageHotelUploads::where('sort','=',$i)->whereNotIn('id',[$previous_id])->first();
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
    public function packagehotelUploads($id)
    {
        $HotelUploads = PackageHotelUploads::where('package_hotel_id',$id)->orderBy('sort','ASC')->get();
        $countries=countries::all();
        return view('package_hotel.packagehotelUploads',compact("HotelUploads","countries"));
    }

    public function packagehotel_image_location($id)
    {
        $data=PackageImageGallery::all();
        $data_country = PackageImageGallery::select('country')->distinct()->get();
        $data_city = PackageImageGallery::select('city')->distinct()->get();
        $countries=countries::all();
        return view('package_hotel.packagehotel_image_location',compact("data","countries","data_city"));
    }

    public function packagehotel_image_gallery($id,Request $request)
    {
     $country=$request->country;
     $state=$request->state;
     $city=$request->city;
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
     //$data=PackageImageGallery::all();
     return view('package_hotel.packagehotel_image_gallery',compact("data","country","state","city"));
    }

    public function packagehotel_image_save($id,Request $request)
    {
      $package_gallery_id=$id;
      $image_name=$request->image_from_gallery;
      $image_name_array_count=count($image_name);
      for($i=0;$i<$image_name_array_count;$i++)
      {
            $check=CustomHelpers::get_package_hotel_data_condition1($image_name[$i],$package_gallery_id);
            if($check!="1"):
            $data=new PackageHotelUploads;
            $data->package_hotel_id = $package_gallery_id;
            $data->gallery_id = $image_name[$i];
            $data->save();
            endif;
      }
      return redirect("/packagehotelUploads/".$package_gallery_id);
    }

    public function edit_packagehotel_gallery_image($id1,$id2)
    {
      $data=$id1;
      $data1=$id2;
      $gallery_data=PackageImageGallery::find($data);
        $countries=countries::all();
       
       
        $state=DB::table('states')
            ->where('country_id','=', $gallery_data->country)->get();
        $city=DB::table('city')
            ->where('state_id','=', $gallery_data->state)->get();
      return view("package_hotel.editimagemiddle",compact("data","data1","countries","state","city",'gallery_data'));
    }

    public function packagehotel_image_gallery_edit($id1,$id2,$id3,Request $request)
    {
     $country_name=$request->country_name;
     $state_name=$request->state_name;
     $city_name=$request->city_name;
     //$data=PackageImageGallery::all();
     $data=DB::table('package_image_gallery')
          ->where([['country','=',$country_name], ['city','=',$city_name]])->get();
     return view('package_hotel.packagehotel_image_gallery_edit',compact("data","country_name","city_name"));
    }

    public function packagehotels_image_save($id1,$id2,$id3,Request $request)
    {
        //$id=CustomHelpers::get_packageuploads_id($id1);
        $data=PackageHotelUploads::find($id3);
            $data->package_hotel_id = $id2;
            $data->gallery_id = $request->image_from_gallery;
            $data->save();
          return redirect("/packagehotelUploads/".$id2);
    }

    public function packagehotelfiledelete($id,$id2,Request $request)
    {
        $image = PackageHotelUploads::find($id);
            $image->destroy($id);
        return redirect ('/packagehotelUploads/'.$id2);
    }

    public function packagehotelfileUploads(Request $request)
    {
     $package_id = $request->input('package_id');
        if($request->file('uploadimage'))
        {
            $image_array=$request->file('uploadimage');
            $image_array_count=count($image_array);
            for($i=0;$i<$image_array_count;$i++)
            {
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
            $data=new PackageHotelUploads;
            $data->package_hotel_id = $package_id;
            $data->gallery_id = CustomHelpers::get_imgpath_id($path);
            $data->save();
            }
            return redirect("/packagehotelUploads/".$package_id);
        }
        else
        {
            return back();
        }
    }
}