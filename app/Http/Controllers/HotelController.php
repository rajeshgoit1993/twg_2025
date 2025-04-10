<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use App\Hotel;
use App\Room;
use App\Hoteltype;
use App\Hotelamenities;
use App\Roomsamenities;
use App\Roomtype;
use App\HotelGeneralSetting;
use App\HotelPaymentMethod;
use App\HotelUploads;
use DB;
use Validator;
use Sentinel;
use App\ActivateService;
use App\countries;
use App\PackageImageGallery;
use App\Helpers\CustomHelpers;
use Image;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $check_data_hotels=ActivateService::where('services','=','hotels')->first();
if($check_data_hotels->activation==1):
         if(Sentinel::check()):
 if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')):
        $all_hotels = Hotel::all();
        return view('hotel.list',['hotels'=>$all_hotels]);
    else:
    return redirect("/");
    endif;
endif;
else:
       return response()->view('error.404', [], 404);
endif;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $check_data_hotels=ActivateService::where('services','=','hotels')->first();
        if($check_data_hotels->activation==1):
    	$all_hotels = Hotel::all();
        $all_hoteltypes = Hoteltype::all();
        $all_hotelamenities = Hotelamenities::all();
        $all_HotelPaymentMethod = HotelPaymentMethod::all();
        // dd($all_hoteltypes);
        return view('hotel.create',['hotelTypes'=>$all_hoteltypes,
                                      'hotelAmenities'=>$all_hotelamenities,
                                      'HotelPaymentMethod'=>$all_HotelPaymentMethod,
                                      'hotels'=>$all_hotels   ]);
      else:
       return response()->view('error.404', [], 404);
      endif;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $check_data_hotels=ActivateService::where('services','=','hotels')->first();
        if($check_data_hotels->activation==1):
        if(Sentinel::check()):
 if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')):
        $all_hoteltypes = Hoteltype::all();
        $all_hotelamenities = Hotelamenities::all();
        $all_roomsamenities = Roomsamenities::all();
        $all_roomtype = Roomtype::all();
        $all_HotelGeneralSetting = HotelGeneralSetting::all();
        $all_HotelPaymentMethod = HotelPaymentMethod::all();
        // dd($all_hoteltypes);
        return view('hotel.settings',['hotelTypes'=>$all_hoteltypes,
                                      'hotelAmenities'=>$all_hotelamenities,
                                      'Roomsamenities'=>$all_roomsamenities,
                                      'HotelGeneralSetting'=>$all_HotelGeneralSetting,
                                      'HotelPaymentMethod'=>$all_HotelPaymentMethod,
                                      'RoomsType'=>$all_roomtype  ]);
       else:
     return redirect("/");
       endif;
     endif;
     else:
       return response()->view('error.404', [], 404);
endif;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required',
            'role_slug' => 'required|unique:roles,slug',
        ]);
        $role = new Role;
        $role->name = $request->input('role_name');
        $role->slug = $request->input('role_slug');
        //$role->save();
        //return response ()->json ( $role );
        if($role->save()){
            return response ()->json ('added');
          }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $check_data_hotels=ActivateService::where('services','=','hotels')->first();
       if($check_data_hotels->activation==1):
        $hoteldata = Hotel::find($id);
        $all_hotels = Hotel::all();
        $all_rooms = Room::where('assignedHotelname', $id)->get();
        $all_hoteltypes = Hoteltype::all();
        $all_hotelamenities = Hotelamenities::all();
        $all_HotelPaymentMethod = HotelPaymentMethod::all();
       // dd($all_hoteltypes);
        return view('hotel.edit',['hotelDetail'=>$hoteldata,
                                        'hotelTypes'=>$all_hoteltypes,
                                        'hotelAmenities'=>$all_hotelamenities,
                                        'HotelPaymentMethod'=>$all_HotelPaymentMethod,
                                        'hotels'=>$all_hotels,
                                        'rooms'=>$all_rooms   ]);
        else:
       return response()->view('error.404', [], 404);
endif;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateRole(Request $request)
    {
        $role = Role::findOrFail($request->input('id'));
        $role->name = $request->input('role_name');
        $role->slug = $request->input('role_slug');
        if($role->save()){
            return response ()->json ('updated');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /* Delete Roles */
    public function deleteRole(Request $request) {
        Role::find ( $request->id )->delete ();
        return redirect('/role');
    }
      //General Hotel Setting
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addGeneralSetting(Request $request)
    {
        $this->validate($request, [
        'headertitle' => 'required',
        'noFeatured' => 'required',
        'checkin' => 'required',
        'checkout' => 'required'
        ]);
        $type = HotelGeneralSetting::findOrFail($request->input('id'));
        $type->header_title = $request->input('headertitle');
        $type->no_of_featured_hotels = $request->input('noFeatured');
        $type->check_in_time = $request->input('checkin');
        $type->check_out_time = $request->input('checkout');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
          return response ()->json ('update');
        }
    }
    //Hotel Type
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addHotelType(Request $request)
    {
        $this->validate($request, [
        'hotelTypeName' => 'required',
        'hotelTypeStatus' => 'required'
        ]);
        $type = new Hoteltype;
        $type->name = $request->input('hotelTypeName');
        $type->status = $request->input('hotelTypeStatus');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return response ()->json ('added');
        }
    }
        //Hotel Type Edit
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editHotelType(Request $request)
    {
        $this->validate($request, [
        'hotelTypeName' => 'required',
        'hotelTypeStatus' => 'required'
        ]);
        $type = Hoteltype::findOrFail($request->input('id'));
        $type->name = $request->input('hotelTypeName');
        $type->status = $request->input('hotelTypeStatus');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
          return response ()->json ('update');
        }
    }
        /* Delete HotelType */
    public function deleteHotelType(Request $request) {
        Hoteltype::find ( $request->id )->delete ();
        return redirect('/hotel-settings#tab2');
    }
    //Hotel Aminities
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addHotelAminities(Request $request)
    {
        $this->validate($request,
        $rules=[
        'aminiName' => 'required',
        'aminiDesc' => 'required',
        'aminiIcon' => 'required',
        'aminiStatus' => 'required'
        ],
        $messages=[
        'aminiName.required'=>'Amenitie Name field is required.',
        'aminiDesc.required'=>'Amenitie Description field is required.',
        'aminiIcon.required'=>'Amenitie Icon field is required.'
        ]);
        $amenites = new Hotelamenities;
        $amenites->name = $request->input('aminiName');
        $amenites->desc = $request->input('aminiDesc');
        $amenites->icon = $request->input('aminiIcon');
        $amenites->status = $request->input('aminiStatus');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($amenites->save()){
        return response ()->json ('added');
        }
    }
      //Hotel Aminities
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editHotelAminities(Request $request)
    {
        $this->validate($request,
        $rules=[
        'aminiName' => 'required',
        'aminiDesc' => 'required',
        'aminiIcon' => 'required',
        'aminiStatus' => 'required'
        ],
        $messages=[
        'aminiName.required'=>'Amenitie Name field is required.',
        'aminiDesc.required'=>'Amenitie Description field is required.',
        'aminiIcon.required'=>'Amenitie Icon field is required.'
        ]);
        //dd($request->input('id'));
        $amenites = Hotelamenities::findOrFail($request->input('id'));
        $amenites->name = $request->input('aminiName');
        $amenites->desc = $request->input('aminiDesc');
        $amenites->icon = $request->input('aminiIcon');
        $amenites->status = $request->input('aminiStatus');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($amenites->save()){
        return response ()->json ('update');
        }
    }
            /* Delete HotelAmenities */
    public function deleteHotelAmenities(Request $request) {
        Hotelamenities::find ( $request->id )->delete ();
        return redirect('/hotel-settings#tab5');
    }
    /********************* Payment Method ***********************/
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPaymentMethod(Request $request)
    {
        $this->validate($request, [
        'PaymentMethodName' => 'required',
        'PaymentMethodStatus' => 'required'
        ]);
        $type = new HotelPaymentMethod;
        $type->name = $request->input('PaymentMethodName');
        $type->status = $request->input('PaymentMethodStatus');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return response ()->json ('added');
        }
    }
    //Payment Method Edit
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editPaymentMethod(Request $request)
    {
        $this->validate($request, [
        'PaymentMethodName' => 'required',
        'PaymentMethodStatus' => 'required'
        ]);
        $type = HotelPaymentMethod::findOrFail($request->input('id'));
        $type->name = $request->input('PaymentMethodName');
        $type->status = $request->input('PaymentMethodStatus');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
          return response ()->json ('update');
        }
    }
    /* Delete Payment Method */
    public function deletePaymentMethod(Request $request) {
        HotelPaymentMethod::find ( $request->id )->delete ();
        return redirect('/hotel-settings');
    }
    /************************************  For Hotel Listing ****************************************/
    //Hotel Aminities
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addHotel(Request $request)
    {
        //return response()->json (implode(',',$request->input('amenities')));
        //dd($request);
        //die();
        $this->validate($request,
        $rules=[
        'hotelName' => 'required',
         'hotelDesc' => 'required',
         'amenities' => 'required',
         'hotelemail' => 'required'
           ],
         $messages=[
         'hotelName.required'=>'Hotel Name field is required.',
         'hotelDesc.required'=>'Hotel Description field is required.',
        'amenities.required'=>'Hotel Amenities field is required.',
         'hotelemail.required'=>'Email field is required.'
          ]);
        if (!$request->input('id')) {
            $hotels = new Hotel;
        }else{
            $hotels = Hotel::findOrFail($request->input('id'));
        }
        //$hotels = new Hotel;
        $hotels->name = $request->input('hotelName');
        $hotels->description = $request->input('hotelDesc');
        $hotels->stars = $request->input('hotelStars');
        $hotels->hotel_type = $request->input('hotelType');
        $hotels->featured = $request->input('hotelisfeatured');
        if($request->input('reltatedHotels')){
            $hotels->hotel_group = implode(',',$request->input('reltatedHotels'));
        }
        $hotels->continent = $request->input('Continent');
        $hotels->country = $request->input('Country');
        $hotels->state = $request->input('State');
        $hotels->city = $request->input('City');
        $hotels->area_code = $request->input('AreaCode');
        $hotels->zip_code = $request->input('Zip');
        $hotels->isd_code = $request->input('isd');
        $hotels->nearest_point = $request->input('nearest_point');
        $hotels->map_address = $request->input('hotelAddress');
        $hotels->map_lat = $request->input('hotelLat');
        $hotels->map_long = $request->input('hotelLang');
        $hotels->facilities = implode(',',$request->input('amenities'));
        $hotels->check_in = $request->input('checkInTime');
        $hotels->check_out = $request->input('checkOutTime');
        $hotels->paymentOption = implode(',',$request->input('paymentOption'));
        $hotels->policy = $request->input('policy');
        $hotels->email_id = $request->input('hotelemail');
        $hotels->website = $request->input('hotelwebsite');
        $hotels->contact_no = $request->input('hotelphone');
        /* Contact Details*/
        $hotels->bankName = $request->input('bankName');
        $hotels->bankAcName = $request->input('bankAcName');
        $hotels->acNumber = $request->input('acNumber');
        $hotels->branchName = $request->input('branchName');
        $hotels->branchCode = $request->input('branchCode');
        $hotels->ifscCode = $request->input('ifscCode');
        $hotels->swiftCode = $request->input('swiftCode');
        $hotels->panNumber = $request->input('panNumber');
        $hotels->nameOnPAN = $request->input('nameOnPAN');
        $hotels->gstNo = $request->input('gstNo');
        $hotels->gstName = $request->input('gstName');
        $hotels->gstContactNumber = $request->input('gstContactNumber');
        $hotels->gstAddress = $request->input('gstAddress');
        $hotels->gstEmail = $request->input('gstEmail');
        $hotels->financeHead = $request->input('financeHead');
        $hotels->acDeptContactNo = $request->input('acDeptContactNo');
        $hotels->acDeptEmailId = $request->input('acDeptEmailId');
        $hotels->taxes = serialize($request->input('tax'));
        //dd($hotels);
    //return response ()->json ($request->input('hotelTypeName'));
        if($hotels->save()){
            return redirect('/hotel')->with('success','Hotel Added Successfully');
        }
        }
      //Hotel Aminities
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editHotel($id)
    {
        //return response ()->json ($request->input('paymentOption'));
        // $this->validate($request,
        // $rules=[
        // 'hotelName' => 'required',
        // 'hotelDesc' => 'required',
        // 'amenities' => 'required',
        // 'hotelemail' => 'required'
        // ],
        // $messages=[
        // 'hotelName.required'=>'Hotel Name field is required.',
        // 'hotelDesc.required'=>'Hotel Description field is required.',
        // 'amenities.required'=>'Hotel Amenities field is required.',
        // 'hotelemail.required'=>'Email field is required.'
        //  ]);
        $hotels = Hotel::findOrFail($id);
          //  dd($hotels);
        $HotelsData = new \stdClass();
        $HotelsData->status = $hotels->status;
        $HotelsData->id = $hotels->id;
        $HotelsData->name = $hotels->name;
        $HotelsData->description = $hotels->description;
        $HotelsData->stars = $hotels->stars;
        $HotelsData->hotel_type = $hotels->hotel_type;
        $HotelsData->featured = $hotels->featured;
        $HotelsData->hotel_group = explode(',',$hotels->hotel_group);
        $HotelsData->continent = $hotels->continent;
        $HotelsData->country = $hotels->country;
        $HotelsData->state = $hotels->state;
        $HotelsData->city = $hotels->city;
        $HotelsData->area_code = $hotels->area_code;
        $HotelsData->zip_code = $hotels->zip_code;
        $HotelsData->isd_code = $hotels->isd_code;
        $HotelsData->nearest_point = $hotels->nearest_point;
        $HotelsData->map_address = $hotels->map_address;
        $HotelsData->map_lat = $hotels->map_lat;
        $HotelsData->map_long = $hotels->map_long;
        $HotelsData->facilities = explode(',',$hotels->facilities);
        $HotelsData->check_in = $hotels->check_in;
        $HotelsData->check_out = $hotels->check_out;
        $HotelsData->paymentOption = explode(',',$hotels->paymentOption);
        $HotelsData->policy = $hotels->policy;
        $HotelsData->email_id = $hotels->email_id;
        $HotelsData->website = $hotels->website;
        $HotelsData->contact_no = $hotels->contact_no;
        $HotelsData->bankName = $hotels->bankName;
        $HotelsData->bankAcName = $hotels->bankAcName;
        $HotelsData->acNumber = $hotels->acNumber;
        $HotelsData->branchName = $hotels->branchName;
        $HotelsData->branchCode = $hotels->branchCode;
        $HotelsData->ifscCode = $hotels->ifscCode;
        $HotelsData->swiftCode = $hotels->swiftCode;
        $HotelsData->panNumber = $hotels->panNumber;
        $HotelsData->nameOnPAN = $hotels->nameOnPAN;
        $HotelsData->gstNo = $hotels->gstNo;
        $HotelsData->gstName = $hotels->gstName;
        $HotelsData->gstContactNumber = $hotels->gstContactNumber;
        $HotelsData->gstAddress = $hotels->gstAddress;
        $HotelsData->gstEmail = $hotels->gstEmail;
        $HotelsData->financeHead = $hotels->financeHead;
        $HotelsData->acDeptContactNo = $hotels->acDeptContactNo;
        $HotelsData->acDeptEmailId = $hotels->acDeptEmailId;
        $HotelsData->taxes = unserialize($hotels->taxes);
            //dd($HotelsData);
        // if($hotels->save()){
        // return response()->json ('update');
        // }else{
        //    return response()->json ('not');
        // }
        $all_hotels = Hotel::all();
        $all_hoteltypes = Hoteltype::all();
        $all_hotelamenities = Hotelamenities::all();
        $all_HotelPaymentMethod = HotelPaymentMethod::all();
        $all_rooms = Room::where('assignedHotelname', $id)->get();
        return view('hotel.edit',[
            'hotelDetail'=>$HotelsData,
            'hotels'=>$all_hotels,
            'hotelTypes'=>$all_hoteltypes,
            'hotelAmenities'=>$all_hotelamenities,
            'rooms'=>$all_rooms,
            'HotelPaymentMethod'=>$all_HotelPaymentMethod]);
    }
            /* Delete HotelAmenities */
    public function deleteHotel(Request $request) {
        Hotel::find ( $request->hotelId )->delete ();
        return response()->json ('delete');
    }
    /***************************  Hotel Gallery Upload ******************/
    public function hotelUploads($id)
    {
        $HotelUploads = HotelUploads::where('hotel_id',$id)->get();
        $countries=countries::all();
        return view('hotel.hotelUploads',compact("HotelUploads","countries"));
    }
    public function edit_hotel_gallery_image($id1,$id2)
    {
      $data=$id1;
      $data1=$id2;
      $countries=countries::all();
      $country_name=CustomHelpers::get_gallery_country($id1);
      $state_name=CustomHelpers::get_gallery_state($id1);
      $country_id=CustomHelpers::get_country_code($country_name);
      $state_id=CustomHelpers::get_state_code($state_name);
      $state=DB::table('states')
          ->where('country_id','=', $country_id)->get();
      $city=DB::table('city')
          ->where('state_id','=', $state_id)->get();
      return view("hotel.editimagemiddle",compact("data","data1","countries","state","city"));
    }
     public function hotel_image_gallery_edit($id1,$id2,$id3,Request $request)
    {
     $country_name=$request->country_name;
     $state_name=$request->state_name;
     $city_name=$request->city_name;
     //$data=PackageImageGallery::all();
     $data=DB::table('package_image_gallery')
          ->where([['country','=',$country_name], ['city','=',$city_name]])->get();
     return view('hotel.hotel_image_gallery_edit',compact("data","country_name","city_name"));
    }
    public function hotel_image_save($id,Request $request)
    {
      $package_gallery_id=$id;
      $image_name=$request->image_from_gallery;
      $image_name_array_count=count($image_name);
      for($i=0;$i<$image_name_array_count;$i++)
      {
            $check=CustomHelpers::get_hotel_data_condition1($image_name[$i],$package_gallery_id);
            if($check!="1"):
            $data=new HotelUploads;
            $data->hotel_id = $package_gallery_id;
            $data->gallery_id = $image_name[$i];
            $data->save();
            endif;
      }
      return redirect("/hotelUploads/".$package_gallery_id);
    }
      public function hotels_image_save($id1,$id2,$id3,Request $request)
    {
        //$id=CustomHelpers::get_packageuploads_id($id1);
        $data=HotelUploads::find($id3);
            $data->hotel_id = $id2;
            $data->gallery_id = $request->image_from_gallery;
            $data->save();
      return redirect("/hotelUploads/".$id2);
    }
     public function hotelfiledelete($id,$id2,Request $request)
    {
        $image = HotelUploads::find($id);
            $image->destroy($id);
        return redirect ('/hotelUploads/'.$id2);
    }
     public function hotelfileUploads(Request $request)
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
            $data=new HotelUploads;
            $data->hotel_id = $package_id;
            $data->gallery_id = CustomHelpers::get_imgpath_id($path);
            $data->save();
            }
            return redirect("/hotelUploads/".$package_id);
        }
        else
        {
            return back();
        }
    }
     public function hotel_image_location($id)
   {
    $data=PackageImageGallery::all();
    $data_country = PackageImageGallery::select('country')->distinct()->get();
    $data_city = PackageImageGallery::select('city')->distinct()->get();
    $countries=countries::all();
    return view('hotel.hotel_image_location',compact("data","countries","data_city"));
   }
   public function hotel_image_gallery($id,Request $request)
    {
     $country=$request->country_name;
     $state=$request->state_name;
     $city=$request->city_name;
     if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") ):
       $data=DB::table('package_image_gallery')
          ->where([['country','=',$country]])->get();
     elseif($country!="" && $country!="0" && $state!="0" && ($city=="Select City" ||  $city=="0") ):
       $data=DB::table('package_image_gallery')
          ->where([['country','=',$country], ['state','=',$state]])->get();
      elseif($country!="" && $country!="0" && $state!="0" && $city!="Select City" && $city!="0"):
         $data=DB::table('package_image_gallery')
          ->where([['country','=',$country], ['state','=',$state], ['city','=',$city]])->get();
    endif;
     //$data=PackageImageGallery::all();
     return view('hotel.hotel_image_gallery',compact("data","country","state","city"));
    }
    /*************** Region Country State City Filter****************/
    public function getHotelCountry(Request $request){
        //return response ()->json ($request->input('SelectedCont'));
        $country = DB::table('regions')
        ->select('id','country')
        ->where('continent',$request->input('SelectedCont'))
        ->orderBy('country','ASC')
        ->get();
        //print_r($country);
        //die("ss");
            $option = '';
            foreach($country as $con){
                $option .='<option value="'.$con->id.'">'.$con->country.'</option>';
            }
        return $option;
    }
    public function getHotelState(Request $request){
        //return response ()->json ($request->input('SelectedCont'));
        $state = DB::table('subregions')
        ->select('id','name')
        ->where('region_id',$request->input('SelectedState'))
        ->orderBy('name','ASC')
        ->get();
        //print_r($country);
        //die("ss");
            $option = '';
            foreach($state as $st){
                $option .='<option value="'.$st->id.'">'.$st->name.'</option>';
            }
        return $option;
    }
}