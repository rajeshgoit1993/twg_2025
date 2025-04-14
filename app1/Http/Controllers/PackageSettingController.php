<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Sentinel;
use Validator;
use App\Pkgtype;
use App\PkgInclusions;
use App\PkgExclusions;
use App\PkgTours;
use App\PkgCancelPolicy;
use App\PkgPaymentPolicy;
use App\PkgVisa;
use App\TravellerType;
use App\PkgRatingType;
use App\Locations;
use App\Packages;
use App\ImportantNotes;
use App\countries;
use App\State;
use App\City;
use App\QuotationHeader;
use App\QuotationFooter;
use App\PakagesSeo;
use App\Helpers\CustomHelpers;
use DB;
use App\ActivateService;
use App\Activity;
use App\airlineList;
use App\Gtags;
use App\Holiday;
use App\HotelPaymentMethod;
use App\iataList;
use App\Suitable;
use App\transferList;
use App\TourType;
use App\TourCategory;
use App\PayAtHotelPaymentType;

class PackageSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$//all_roles = Role::all();
        //dd($all_roles);
        return view('hotel.list');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$all_hoteltypes = Hoteltype::all();
      //  $all_hotelamenities = Hotelamenities::all();
      //  $all_HotelPaymentMethod = HotelPaymentMethod::all();
       // dd($all_hoteltypes);
        return view('manage_packages.create');
    }

    // Settings
    public function settings() {
        $check_data = ActivateService::where('services', '=', 'tour_package_manager')->first();
        if ($check_data->activation == 1) :
            //  dd($_SERVER['SERVER_ADDR']);
            $all_pkgtypes = Pkgtype::all();
            $all_inclusions = PkgInclusions::all();
            $all_exclusions = PkgExclusions::all();
            $all_tours = PkgTours::all();
            $activities = Activity::all();
            $pack_seo = PakagesSeo::all();
            $transfer_list = transferList::all();
            $airline_items = airlineList::all();
            $iata_list = iataList::all();
            $gtags = Gtags::all();
            $suitables = Suitable::all();
            $holiday = Holiday::all();
            $tour_types =TourType::all();
            $tour_categories =TourCategory::all();
            $payathotelpaymenttype=PayAtHotelPaymentType::all();
            return view('manage_packages.settings', [
                'hotelTypes' => $all_pkgtypes,
                'all_inclusions' => $all_inclusions,
                'all_exclusions' => $all_exclusions,
                'pack_seo' => $pack_seo,
                'all_tours' => $all_tours,
                'activities' => $activities,
                'transfer_list' => $transfer_list,
                'airline_items' => $airline_items,
                'iata_list' => $iata_list,
                'gtags' => $gtags,
                'suitables' => $suitables,
                'holiday' => $holiday,
                'tour_types' => $tour_types,
                'tour_categories' => $tour_categories,
                'payathotelpaymenttype' => $payathotelpaymenttype
            ]);
        else :
            return response()->view('error.404', [], 404);
        endif;
        }

     public function lead_settings()
    {
        $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):
      if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('employee')):
      //  dd($_SERVER['SERVER_ADDR']);
        $PkgPaymentPolicy = PkgPaymentPolicy::all();
        $PkgCancelPolicy = PkgCancelPolicy::all();
        $PkgVisaPolicy = PkgVisa::all();
        $TravellerType = TravellerType::all();
        $PkgRatingType = PkgRatingType::all();
        $imp_notes=ImportantNotes::all();
        $quotation_header=QuotationHeader::all();
        $quotation_footer=QuotationFooter::all();
        return view('query.setting.setting',['PkgPaymentPolicy'=>$PkgPaymentPolicy,
                                    'PkgCancelPolicy'=>$PkgCancelPolicy,
                                    'PkgVisaPolicy'=>$PkgVisaPolicy,
                                    'TravellerType' =>$TravellerType,
                                    'PkgRatingType'=>$PkgRatingType,
                                    'imp_notes'=>$imp_notes,
                                    'quotation_header'=>$quotation_header,
                                    'quotation_footer'=>$quotation_footer
                                     ]);
      else:
       return redirect("/enquiry");
    endif;
     else:
       return response()->view('error.404', [], 404);
    endif;
    }
    public function extra()
    {
      //  dd($_SERVER['SERVER_ADDR']);
        $PkgPaymentPolicy = PkgPaymentPolicy::all();
        $PkgCancelPolicy = PkgCancelPolicy::all();
        $PkgVisaPolicy = PkgVisa::all();
        $TravellerType = TravellerType::all();
        $PkgRatingType = PkgRatingType::all();
        $imp_notes=ImportantNotes::all();
        $quotation_header=QuotationHeader::all();
        $quotation_footer=QuotationFooter::all();
        return view('manage_packages.extra',['PkgPaymentPolicy'=>$PkgPaymentPolicy,
                                    'PkgCancelPolicy'=>$PkgCancelPolicy,
                                    'PkgVisaPolicy'=>$PkgVisaPolicy,
                                    'TravellerType' =>$TravellerType,
                                    'PkgRatingType'=>$PkgRatingType,
                                    'imp_notes'=>$imp_notes,
                                    'quotation_header'=>$quotation_header,
                                    'quotation_footer'=>$quotation_footer
                                     ]);
    }
    public function savePaymentPolicy(Request $request){
       if($request->id){
        $save = PkgPaymentPolicy::findOrFail($request->input('id'));
        $save->policy = $request->policy;
        $save->pkgPolicyDesc = $request->policy_desc;
        $save->status = $request->status;
        if($save->save()){
            return redirect('/extra')->with('success','Policy Updated Successfully!');
        }
       }else
       {
        $save = new PkgPaymentPolicy;
        $save->policy = $request->policy;
        $save->pkgPolicyDesc = $request->policy_desc;
        $save->status = $request->status;
        if($save->save()){
            return redirect('/extra')->with('success','Policy Created Successfully!');
        }
       }
    }
    public function saveVisaPolicy(Request $request){
               if($request->id){
                $save = PkgVisa::findOrFail($request->input('id'));
                $save->policy = $request->policy;
                $save->pkgPolicyDesc = $request->policy_desc;
                $save->status = $request->status;
                if($save->save()){
                    return redirect('/extra')->with('success','Visa Policy Updated Successfully!');
                }
               }else{
                $save = new PkgVisa;
                $save->policy = $request->policy;
                $save->pkgPolicyDesc = $request->policy_desc;
                $save->status = $request->status;
                if($save->save()){
                    return redirect('/extra')->with('success','Visa Policy Created Successfully!');
                }
               }
            }
    public function save_quotationheader(Request $request){
               if($request->id){
                $save = QuotationHeader::findOrFail($request->input('id'));
                $save->header = $request->quotationheader;
                $save->header_desc = $request->header_desc;
                $save->status = $request->quotation_header_status;
                if($save->save()){
                    return redirect('/lead_settings')->with('success','Quotation Header  Updated Successfully!');
                }
               }else{
                $save = new QuotationHeader;
                $save->header = $request->quotationheader;
                $save->header_desc = $request->header_desc;
                $save->status = $request->quotation_header_status;
                if($save->save()){
                    return redirect('/lead_settings')->with('success','Quotation Header  Added Successfully!');
                }
               }
            }
            public function save_quotationfooter(Request $request){
               if($request->id){
                $save = QuotationFooter::findOrFail($request->input('id'));
                $save->footer = $request->quotationfooter;
                $save->footer_desc = $request->footer_desc;
                $save->status = $request->quotation_footer_status;
                if($save->save()){
                    return redirect('/lead_settings')->with('success','Quotation Footer  Updated Successfully!');
                }
               }else{
                $save = new QuotationFooter;
                $save->footer = $request->quotationfooter;
                $save->footer_desc = $request->footer_desc;
                $save->status = $request->quotation_footer_status;
                if($save->save()){
                    return redirect('/lead_settings')->with('success','Quotation Footer  Added Successfully!');
                }
               }
            }
       public function savenotes(Request $request){
               if($request->id){
                $save = ImportantNotes::findOrFail($request->input('id'));
                $save->policy = $request->notes_name;
                $save->policy_desc = $request->notes_desc;
                $save->status = $request->notes_status;
                if($save->save()){
                    return redirect('/extra')->with('success','Important Notes Updated Successfully!');
                }
               }else{
                $save = new ImportantNotes;
                $save->policy = $request->notes_name;
                $save->policy_desc = $request->notes_desc;
                $save->status = $request->notes_status;
                if($save->save()){
                    return redirect('/extra')->with('success','Important Noptes Created Successfully!');
                }
               }
            }
    public function saveCancelPolicy(Request $request){
        if($request->id){
            $save = PkgCancelPolicy::findOrFail($request->input('id'));
            $save->policy = $request->policy;
            $save->can_policy_desc = $request->policy_desc;
            $save->status = $request->status;
            if($save->save()){
                return redirect('/extra')->with('success','Policy Updated Successfully!');
            }
        }else{
            $save = new PkgCancelPolicy;
            $save->policy = $request->policy;
            $save->can_policy_desc = $request->policy_desc;
            $save->status = $request->status;
            if($save->save()){
                return redirect('/extra')->with('success','Policy Created Successfully!');
            }
        }
    }
    public function saveTravellerType(Request $request){
        if($request->id){
            $save = TravellerType::findOrFail($request->input('id'));
            $save->name = $request->name;
            $save->status = $request->status;
            if($save->save()){
                return redirect('/extra')->with('success','Traveller Updated Successfully!');
            }
        }else{
            $save = new TravellerType;
            $save->name = $request->name;
            $save->status = $request->status;
            if($save->save()){
                return redirect('/extra')->with('success','Traveller Created Successfully!');
            }
        }
    }
    public function saveRatingType(Request $request){
        if($request->id){
            $save = PkgRatingType::findOrFail($request->input('id'));
            $save->name = $request->name;
            $save->status = $request->status;
            if($save->save()){
                return redirect('/extra')->with('success','Rating Updated Successfully!');
            }
        }else{
            $save = new PkgRatingType;
            $save->name = $request->name;
            $save->status = $request->status;
            if($save->save()){
                return redirect('/extra')->with('success','Rating Created Successfully!');
            }
        }
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
    //Package Type
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPackageType(Request $request)
    {
        $this->validate($request, [
        'pkgTypeName' => 'required',
        'pkgTypeStatus' => 'required'
        ]);
        $type = new Pkgtype;
        $type->name = $request->input('pkgTypeName');
        $type->status = $request->input('pkgTypeStatus');
        $type->showsfooter = $request->input('showsfooter');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return response ()->json ('added');
        }
    }
        //Package Type Edit
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editPackageType(Request $request)
    {
        $this->validate($request, [
        'pkgTypeName' => 'required',
        'pkgTypeStatus' => 'required'
        ]);
        $type = Pkgtype::findOrFail($request->input('id'));
        $type->name = $request->input('pkgTypeName');
        $type->status = $request->input('pkgTypeStatus');
         $type->showsfooter = $request->input('showsfooter');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
          return response ()->json ('update');
        }
    }
        /* Delete PackageType */
    public function deletePkgTypes(Request $request) {
         $data=Pkgtype::find($request->id);
        if($data):
        Pkgtype::destroy($request->id);
         return redirect ('/package-settings');
        else:
           return redirect ('/package-settings');
        endif;
    }
   public function deletePkgType(Request $request) {
         $data=PkgVisa::find($request->id);
        if($data):
        PkgVisa::destroy($request->id);
         return redirect ('/extra');
        else:
           return redirect ('/extra');
        endif;
    }
    public function deletePkgPayPolicy(Request $request) {
         $data=PkgPaymentPolicy::find($request->id);
        if($data):
        PkgPaymentPolicy::destroy($request->id);
         return redirect ('/extra');
        else:
           return redirect ('/extra');
        endif;
    }
   public function deleteimpnotes(Request $request) {
         $data=ImportantNotes::find($request->id);
        if($data):
        ImportantNotes::destroy($request->id);
         return redirect ('/extra');
        else:
           return redirect ('/extra');
        endif;
    }
    public function delete_quotationheader(Request $request) {
         $data=QuotationHeader::find($request->id);
        if($data):
        QuotationHeader::destroy($request->id);
         return redirect ('/lead_settings');
        else:
           return redirect ('/lead_settings');
        endif;
    }
    public function delete_quotationfooter(Request $request) {
         $data=QuotationFooter::find($request->id);
        if($data):
        QuotationFooter::destroy($request->id);
         return redirect ('/lead_settings');
        else:
           return redirect ('/lead_settings');
        endif;
    }
   public function deletePkgcan(Request $request) {
         $data=PkgCancelPolicy::find($request->id);
        if($data):
        PkgCancelPolicy::destroy($request->id);
         return redirect ('/extra');
        else:
           return redirect ('/extra');
        endif;
    }
     //Package Inclusion
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addInclusion(Request $request)
    {
        $this->validate($request, [
        'Name' => 'required',
        'Status' => 'required'
        ]);
        $type = new PkgInclusions;
        $type->name = $request->input('Name');
        $type->status = $request->input('Status');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return response ()->json ('added');
        }
    }
        //Package Inclusion Edit
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editInclusion(Request $request)
    {
        $this->validate($request, [
        'Name' => 'required',
        'Status' => 'required'
        ]);
        $type = PkgInclusions::findOrFail($request->input('id'));
        $type->name = $request->input('Name');
        $type->status = $request->input('Status');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
          return response ()->json ('update');
        }
    }
        /* Delete Inclusion */
    public function deleteInclusion(Request $request) {
        PkgInclusions::find ( $request->id )->delete ();
        return redirect('/package-settings');
    }
     //Package Inclusion
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addExclusion(Request $request)
    {
        $this->validate($request, [
        'Name' => 'required',
        'Status' => 'required'
        ]);
        $type = new PkgExclusions;
        $type->name = $request->input('Name');
        $type->status = $request->input('Status');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return response ()->json ('added');
        }
    }
    public function add_pay_at_hotel_payment_type(Request $request)
    {
        $this->validate($request, [
        'Name' => 'required',
        'Status' => 'required'
        ]);
        $type = new PayAtHotelPaymentType;
        $type->name = $request->input('Name');
        $type->status = $request->input('Status');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return response ()->json ('added');
        }
    }
    public function add_packages_seo(Request $request)
    {
        $this->validate($request, [
        'destination' => 'required',
        ]);
        $type = new PakagesSeo;
        $type->destination=$request->destination;
        $type->title=$request->title;
        $type->keywords    =$request->keywords;
        $type->description=$request->description;
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return response ()->json ('added');
        }
    }
    public function edit_packages_seo(Request $request)
    {
        $this->validate($request, [
        'destination' => 'required',
        ]);
        $type =PakagesSeo::find($request->seo_id);
        $type->destination=$request->destination;
        $type->title=$request->title;
        $type->keywords    =$request->keywords;
        $type->description=$request->description;
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return response ()->json ('added');
        }
    }
    public function delete_packages_seo($id,Request $request)
    {
       $data=PakagesSeo::find($id);
       if($data):
        PakagesSeo::destroy($id);
       endif;
      return redirect('/package-settings');
    }
        //Package Inclusion Edit
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     public function edit_pay_at_hotel_payment_type(Request $request)
    {
        $this->validate($request, [
        'Name' => 'required',
        'Status' => 'required'
        ]);
        $type = PayAtHotelPaymentType::findOrFail($request->input('id'));
        $type->name = $request->input('Name');
        $type->status = $request->input('Status');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
          return response ()->json ('update');
        }
    }
    public function editExclusion(Request $request)
    {
        $this->validate($request, [
        'Name' => 'required',
        'Status' => 'required'
        ]);
        $type = PkgExclusions::findOrFail($request->input('id'));
        $type->name = $request->input('Name');
        $type->status = $request->input('Status');
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
          return response ()->json ('update');
        }
    }
    /* Delete Exclusions */
    public function deleteExclusion(Request $request) {
        PkgExclusions::find ( $request->id )->delete ();
        return redirect('/package-settings');
    }

    public function deletePayHotelPayment(Request $request) {
        PayAtHotelPaymentType::find ( $request->id )->delete ();
        return redirect('/package-settings');
    }
    
//Add Transfers
    public function addTransfers(Request $request)
    {
        $this->validate($request, [
            'transport_type' => 'required',
            'transfer_type' => 'required',
            // 'title' => 'required',
            // 'vehicle_type' => 'required',
            // 'duration' => 'required',
            // 'includes' => 'required',
            // 'city' => 'required',
            // 'status' => 'required'
        ]);
        $transfer_image_name = "";
        if ($request->file("transfer_image") != "") :
            $transfer_image = $request->file("transfer_image");
            $transfer_image_ext = $transfer_image->getClientOriginalExtension();
            $transfer_image_name = uniqid() . "." . $transfer_image_ext;

            $transfer_image->move(public_path() . '/uploads/transfer_image/', $transfer_image_name);

        endif;

        $type = new transferList;
        $type->transport_type = $request->transport_type;
        $type->transfer_type = $request->transfer_type;
        $type->title = $request->title;
        $type->vehicle_type = $request->vehicle_type;
        $type->duration = $request->duration;
        $type->includes = $request->includes;
        $type->city = $request->city;
        $type->status = $request->status;
        $type->transfer_image = $transfer_image_name;

        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Transfer list Updated Successfully!');
        }
    }
    //Edit Transfers
    public function editTransfers(Request $request)
    {
        $this->validate($request, [
            'transport_type' => 'required',
            'transfer_type' => 'required',
            // 'title' => 'required',
            // 'vehicle_type' => 'required',
            // 'duration' => 'required',
            // 'includes' => 'required',
            // 'city' => 'required',
            // 'status' => 'required'
        ]);
        $type = transferList::find($request->edittransferid);
        $transfer_image_name = "";
        if ($request->file("transfer_image") != "") :
            $transfer_image = $request->file("transfer_image");
            $transfer_image_ext = $transfer_image->getClientOriginalExtension();
            $transfer_image_name = uniqid() . "." . $transfer_image_ext;
            $transfer_image->move(public_path() . '/uploads/transfer_image/', $transfer_image_name);
        $type->transfer_image = $transfer_image_name;
        endif;
        $type->transport_type = $request->transport_type;
        $type->transfer_type = $request->transfer_type;
        $type->title = $request->title;
        $type->vehicle_type = $request->vehicle_type;
        $type->duration = $request->duration;
        $type->includes = $request->includes;
        $type->city = $request->city;
        $type->status = $request->status;
        
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Transfer List Updated Successfully!');
        }
    }

    /* Delete Transfers */
    public function deleteTransfers(Request $request)
    {
        transferList::find($request->id)->delete();
        return redirect('/package-settings');
    }

    //Add Airlines
    public function addAirlines(Request $request)
    {
        $this->validate($request, [
            'airline_name' => 'required',
            'airline_code' => 'required',
            'status' => 'required'
        ]);
        $airline_logo_name = "";
        if ($request->file("airline_logo") != "") :
            $airline_logo = $request->file("airline_logo");
            $airline_logo_ext = $airline_logo->getClientOriginalExtension();
            $airline_logo_name = uniqid() . "." . $airline_logo_ext;

            $airline_logo->move(public_path() . '/uploads/airline_logo/', $airline_logo_name);

        endif;

        $type = new airlineList;
        $type->airline_name = $request->airline_name;
        $type->airline_code = $request->airline_code;
        $type->status = $request->status;
        $type->airline_logo = $airline_logo_name;

        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Airline list Updated Successfully!');
        }
    }
    //Edit Airlines
    public function editAirlines(Request $request)
    {
        $this->validate($request, [
            'airline_name' => 'required',
            'airline_code' => 'required',
            'status' => 'required'
        ]);
        $type = airlineList::find($request->editairlineid);
        
        $airline_logo_name = "";
        if ($request->file("airline_logo") != "") :
            $airline_logo = $request->file("airline_logo");
            $airline_logo_ext = $airline_logo->getClientOriginalExtension();
            $airline_logo_name = uniqid() . "." . $airline_logo_ext;

            $airline_logo->move(public_path() . '/uploads/airline_logo/', $airline_logo_name);
            $type->airline_logo = $airline_logo_name;
        endif;
        $type->airline_name = $request->airline_name;
        $type->airline_code = $request->airline_code;
        $type->status = $request->status;
        
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Airline List Updated Successfully!');
        }
    }

    /* Delete Airlines */
    public function deleteAirlines(Request $request)
    {
        airlineList::find($request->id)->delete();
        return redirect('/package-settings');
    }

    //Add Gtags
    public function addGtags(Request $request)
    {
        $this->validate($request, [
            'icon_title' => 'required',
            'status' => 'required'
        ]);
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/gtag/', $icon_name);

        endif;

        $type = new Gtags;
        $type->icon_title = $request->icon_title;
        $type->status = $request->status;
        $type->icon = $icon_name;

        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'General Tags list Updated Successfully!');
        }
    }
    //Edit Gtags
    public function editGtags(Request $request)
    {
        $this->validate($request, [
            'icon_title' => 'required',
            'status' => 'required'
        ]);
        $type = Gtags::find($request->editgtagsid);
       
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/gtag/', $icon_name);
            $type->icon = $icon_name;
        endif;
        $type->icon_title = $request->icon_title;
        $type->status = $request->status;
        
      
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'General Tags Updated Successfully!');
        }
    }

    /* Delete Gtags */
    public function deleteGtags(Request $request)
    {
        Gtags::find($request->id)->delete();
        return redirect('/package-settings');
    }

    //Add Suitables
    public function addSuitables(Request $request)
    {
        $this->validate($request, [
            'icon_title' => 'required',
            'status' => 'required'
        ]);
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/suitable/', $icon_name);

        endif;

        $type = new Suitable;
        $type->icon_title = $request->icon_title;
        $type->status = $request->status;
        $type->icon = $icon_name;

        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'General Tags list Updated Successfully!');
        }
    }
    //Edit Suitables
    public function editSuitables(Request $request)
    {
        $this->validate($request, [
            'icon_title' => 'required',
            'status' => 'required'
        ]);
        $type = Suitable::find($request->editstblsid);
        
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/suitable/', $icon_name);
            $type->icon = $icon_name;
        endif;
        $type->icon_title = $request->icon_title;
        $type->status = $request->status;
        
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Suitables Updated Successfully!');
        }
    }

    /* Delete Suitables */
    public function deleteSuitables(Request $request)
    {
        Suitable::find($request->id)->delete();
        return redirect('/package-settings');
    }
    //Add Holiday
    public function addHoliday(Request $request)
    {
        $this->validate($request, [
            'icon_title' => 'required',
            'status' => 'required'
        ]);
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/holiday/', $icon_name);

        endif;

        $type = new Holiday;
        $type->icon_title = $request->icon_title;
        $type->status = $request->status;
        $type->icon = $icon_name;

        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'General Tags list Updated Successfully!');
        }
    }
    //Edit Holiday
    public function editHoliday(Request $request)
    {
        $this->validate($request, [
            'icon_title' => 'required',
            'status' => 'required'
        ]);
        $type = Holiday::find($request->edithldid);
        
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/holiday/', $icon_name);
            $type->icon = $icon_name;
        endif;
        $type->icon_title = $request->icon_title;
        $type->status = $request->status;
        
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Suitables Updated Successfully!');
        }
    }

    /* Delete Holiday */
    public function deleteHoliday(Request $request)
    {
        Holiday::find($request->id)->delete();
        return redirect('/package-settings');
    }
    
    //Add Tour Type
    public function add_tour_type(Request $request)
    {
        $this->validate($request, [
            'tour_type' => 'required',
            'status' => 'required'
        ]);
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/tour_type_image/', $icon_name);

        endif;

        $type = new TourType;
        $type->tour_type = $request->tour_type;
        $type->status = $request->status;
        $type->icon = $icon_name;
        $type->description = $request->description;
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Tour Type list Added Successfully!');
        }
    }

    //Edit Tour Type
    public function edit_tour_type(Request $request)
    {
        $this->validate($request, [
            'tour_type' => 'required',
            'status' => 'required'
        ]);
        $type = TourType::find($request->edittourtypeid);
        
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/tour_type_image/', $icon_name);
            $type->icon = $icon_name;
        endif;
        $type->tour_type = $request->tour_type;
        $type->status = $request->status;
        
        $type->description = $request->description;
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Tour Type Updated Successfully!');
        }
    }

     /* Delete Tour Type */
    public function deletetourtype(Request $request)
    {
        TourType::find($request->id)->delete();
        return redirect('/package-settings');
    }

    //Add Tour Category
    public function add_tour_category(Request $request)
    {
        $this->validate($request, [
            'tour_category' => 'required',
            'status' => 'required'
        ]);
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/tour_category_image/', $icon_name);

        endif;

        $type = new TourCategory;
        $type->tour_category = $request->tour_category;
        $type->status = $request->status;
        $type->icon = $icon_name;
        $type->description = $request->description;
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Tour Category list Added Successfully!');
        }
    }

    //Edit Tour Category
    public function edit_tour_category(Request $request)
    {
        $this->validate($request, [
            'tour_category' => 'required',
            'status' => 'required'
        ]);
        $type = TourCategory::find($request->edittourcategoryid);
        
        $icon_name = "";
        if ($request->file("icon") != "") :
            $icon = $request->file("icon");
            $icon_ext = $icon->getClientOriginalExtension();
            $icon_name = uniqid() . "." . $icon_ext;

            $icon->move(public_path() . '/uploads/tour_category_image/', $icon_name);
            $type->icon = $icon_name;
        endif;
       $type->tour_category = $request->tour_category;
        $type->status = $request->status;
        
        $type->description = $request->description;
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Tour Type Updated Successfully!');
        }
    }

    /* Delete Tour Category */
    public function deletetourcategory(Request $request)
    {
        TourCategory::find($request->id)->delete();
        return redirect('/package-settings');
    }

    //Add IATA
    public function addIATA(Request $request)
    {
        $this->validate($request, [
            'iata_name' => 'required',
            'iata_code' => 'required',
            'status' => 'required'
        ]);

        $type = new iataList;
        $type->iata_name = $request->iata_name;
        $type->iata_code = $request->iata_code;
        $type->status = $request->status;

        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Airline list Updated Successfully!');
        }
    }

    //Edit IATA
    public function editIATA(Request $request)
    {
        $this->validate($request, [
            'iata_name' => 'required',
            'iata_code' => 'required',
            'status' => 'required'
        ]);
        $type = iataList::find($request->editiataid);
        $type->iata_name = $request->iata_name;
        $type->iata_code = $request->iata_code;
        $type->status = $request->status;
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Airline List Updated Successfully!');
        }
    }

    /* Delete IATA */
    public function deleteIATA(Request $request)
    {
        iataList::find($request->id)->delete();
        return redirect('/package-settings');
    }


    // Package Tours (Store a newly created resource in storage)
    public function addTour(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'location' => 'required',
        'status' => 'required'
        ]);
         $tour_image_name="";
         if($request->file("tour_image")!=""):
         $tour_image = $request->file("tour_image");
         $tour_image_ext=$tour_image->getClientOriginalExtension();
         $tour_image_name = uniqid().".".$tour_image_ext;
         $tour_image->move(public_path().'/uploads/tour_image/', $tour_image_name);
         endif;
        $type = new PkgTours;
        $type->activity = $request->name;
        $type->desc = $request->description;
        $type->location = $request->location;
        $type->duration = $request->duration;
        $type->inclusions = $request->inclusions;
        $type->exclusions = $request->exclusions;
        $type->status = $request->status;
        $type->tour_image = $tour_image_name;
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
        return redirect('/package-settings')->with('success','Package tour updated successfully!'); }
    }
     //Package Tours Edit
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editTour(Request $request)
    {
       $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'location' => 'required',
        'status' => 'required'
        ]);
       $type=PkgTours::find($request->edittypeid);
       if($request->file("tour_image")!=""):
        $tour_image = $request->file("tour_image");
        $tour_image = $request->file("tour_image");
        $tour_image_ext=$tour_image->getClientOriginalExtension();
        $tour_image_name = uniqid().".".$tour_image_ext;
        $tour_image->move(public_path().'/uploads/tour_image/', $tour_image_name);
         $type->tour_image = $tour_image_name;
        endif;
        $type->activity = $request->name;
        $type->desc = $request->description;
        $type->location = $request->location;
        $type->duration = $request->duration;
        $type->inclusions = $request->inclusions;
        $type->exclusions = $request->exclusions;
        $type->status = $request->status;
        
        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));
        if($type->save()){
                return redirect('/package-settings')->with('success','Package Tour Updated Successfully!');
            }
    }

    /* Delete Tour */
    public function deleteTour(Request $request) {
        PkgTours::find ($request->id)->delete ();
        return redirect('/package-settings');
    }

    /********************* Payment Method ***********************/

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function addActivity(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'status' => 'required'
        ]);
        $activity_image_name = "";
        if ($request->file("activity_image") != "") :
            $activity_image = $request->file("activity_image");
            $activity_image_ext = $activity_image->getClientOriginalExtension();
            $activity_image_name = uniqid() . "." . $activity_image_ext;

            $activity_image->move(public_path() . '/uploads/activity_image/', $activity_image_name);

        endif;

        $type = new Activity;
        $type->activity = $request->name;
        $type->desc = $request->description;
        $type->location = $request->location;
           $type->duration = $request->duration;
        $type->inclusions = $request->inclusions;
        $type->exclusions = $request->exclusions;
        $type->status = $request->status;
        $type->activity_image = $activity_image_name;

        //$role->save();
        //return response ()->json ($request->input('hotelTypeName'));

        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Package Activity Updated Successfully!');
        }
    }

    //Package Activity Edit
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editActivity(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'status' => 'required'
        ]);
        $type = Activity::find($request->editactivityid);
        if ($request->file("activity_image") != "") :
            $activity_image = $request->file("activity_image");
            $activity_image_ext = $activity_image->getClientOriginalExtension();
            $activity_image_name = uniqid() . "." . $activity_image_ext;
            $activity_image->move(public_path() . '/uploads/activity_image/', $activity_image_name);
        $type->activity_image = $activity_image_name;
        endif;
        $type->activity = $request->name;
        $type->desc = $request->description;
        $type->location = $request->location;
           $type->duration = $request->duration;
        $type->inclusions = $request->inclusions;
        $type->exclusions = $request->exclusions;
        $type->status = $request->status;
        
        if ($type->save()) {
            return redirect('/package-settings')->with('success', 'Package Activity Updated Successfully!');
        }
    }

    /* Delete Activity */
    public function deleteActivity(Request $request)
    {
        Activity::find($request->id)->delete();
        return redirect('/package-settings');
    }

    /*----------*/

    /*public function addPaymentMethod(Request $request) {
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
    }*/

    public function addPaymentMethod(Request $request) {
        // Validate the incoming request data
        $this->validate($request, [
            'PaymentMethodName' => 'required', // Ensure PaymentMethodName is provided
            'PaymentMethodStatus' => 'required' // Ensure PaymentMethodStatus is provided
        ]);
        
        // Create a new HotelPaymentMethod instance
        $type = new HotelPaymentMethod;
        $type->name = $request->input('PaymentMethodName'); // Set the name from the request
        $type->status = $request->input('PaymentMethodStatus'); // Set the status from the request
        
        // Save the new payment method to the database
        if ($type->save()) {
            return response()->json('added'); // Return a success response
        }
    }

    /*----------*/

    // Payment Method Edit (Store a newly created resource in storage)
    /*public function editPaymentMethod(Request $request) {
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
    }*/

    // Payment Method Edit (Store a newly created resource in storage)
    public function editPaymentMethod(Request $request) {
        // Validate the incoming request data
        $this->validate($request, [
            'PaymentMethodName' => 'required',       // Payment method name is required
            'PaymentMethodStatus' => 'required'      // Payment method status is required
        ]);

        // Find the payment method by its ID
        $type = HotelPaymentMethod::findOrFail($request->input('id'));

        // Update the payment method details
        $type->name = $request->input('PaymentMethodName');
        $type->status = $request->input('PaymentMethodStatus');

        // Save the changes to the database
        if ($type->save()) {
            return response()->json('update'); // Return a JSON response indicating success
        }

        // Optionally, you can return an error response if saving fails
        return response()->json('error', 500); // Return a JSON error response (optional)
    }

    /*----------*/

    /* Delete Payment Method */
    public function deletePaymentMethod(Request $request) {
        // Find the payment method by its ID and delete it
        HotelPaymentMethod::find($request->id)->delete();

        // Redirect to the hotel settings page after deletion
        return redirect('/hotel-settings');
    }

    /*----------*/

    /*public function location_data(Request $request) {
     $package=Packages::all();
     foreach($package as $package_data):
         $city=unserialize($package_data->city);
         $country=unserialize($package_data->country);
         $city_count=count($city);
         for($a=0;$a<$city_count;$a++):
            $check = Locations::where('location', '=', $city[$a])->count();
            if($check>0):
            else:
                $city_value=new Locations;
                $city_value->location=$city[$a];
                 $city_value->country=$country[$a];
                $city_value->save();
            endif;
         endfor;
     endforeach;
    }*/

    /*public function location_data(Request $request) {
        // Retrieve all packages
        $package = Packages::all();

        // Loop through each package
        foreach ($package as $package_data) {
            // Unserialize the city and country data from the package
            $city = unserialize($package_data->city);
            $country = unserialize($package_data->country);
            $city_count = count($city);

            // Loop through each city in the unserialized city array
            for ($a = 0; $a < $city_count; $a++) {
                // Check if the location already exists in the Locations table
                $check = Locations::where('location', '=', $city[$a])->count();

                // If the city does not exist, create a new Locations entry
                if ($check <= 0) {
                    $city_value = new Locations;
                    $city_value->location = $city[$a];
                    $city_value->country = $country[$a];
                    $city_value->save(); // Save the new location
                }
            }
        }
    }*/

    /*public function location_data(Request $request) 
    {
        // Retrieve all packages
        $package = Packages::all();

        // Loop through each package
        foreach ($package as $package_data) {
            // Unserialize city and country data safely
            $city = @unserialize($package_data->city);
            $country = @unserialize($package_data->country);

            // Validate unserialized data
            if (!is_array($city) || !is_array($country)) {
                \Log::error("Invalid city/country data in package ID {$package_data->id}", [
                    'city' => $package_data->city,
                    'country' => $package_data->country
                ]);
                continue; // Skip this package if data is not an array
            }

            $city_count = count($city);
            $country_count = count($country);

            // Check if both arrays have the same number of elements
            if ($city_count !== $country_count) {
                \Log::error("Mismatch in city-country count for package ID {$package_data->id}", [
                    'cities' => $city,
                    'countries' => $country
                ]);
                continue; // Skip this package to avoid errors
            }

            // Loop through each city in the unserialized city array
            for ($a = 0; $a < $city_count; $a++) {
                $locationName = trim($city[$a] ?? '');
                $countryName = trim($country[$a] ?? 'Unknown');

                // Ensure location is valid
                if ($locationName === '') {
                    \Log::error("Empty city name found in package ID {$package_data->id}", [
                        'city_index' => $a,
                        'city' => $city
                    ]);
                    continue;
                }

                // Check if the location already exists in the Locations table
                $check = Locations::where('location', '=', $locationName)->count();

                // If the city does not exist, create a new Locations entry
                if ($check <= 0) {
                    $city_value = new Locations;
                    $city_value->location = $locationName;
                    $city_value->country = $countryName;
                    $city_value->save(); // Save the new location
                }
            }
        }
    }*/

    public function location_data(Request $request) {
    // Retrieve all packages
    $package = Packages::all();

    foreach ($package as $package_data) {
        // Unserialize city and country safely
        $city = @unserialize($package_data->city);
        $country = @unserialize($package_data->country);

        // Skip if unserialization fails
        if (!is_array($city) || !is_array($country)) {
            \Log::error("Invalid city/country data in package ID {$package_data->id}", [
                'city' => $package_data->city,
                'country' => $package_data->country
            ]);
            continue;
        }

        $city = array_values($city);  // Reindex the array (fixes missing indexes)
        $country = array_values($country);

        $city_count = count($city);
        $country_count = count($country);

        // Check if both arrays have the same number of elements
        if ($city_count !== $country_count) {
            \Log::error("Mismatch in city-country count for package ID {$package_data->id}", [
                'cities' => $city,
                'countries' => $country
            ]);
            continue;
        }

        for ($a = 0; $a < $city_count; $a++) {
            $locationName = trim($city[$a] ?? '');
            $countryName = trim($country[$a] ?? 'Unknown');

            if ($locationName === '') {
                \Log::error("Empty city name found in package ID {$package_data->id}", [
                    'city_index' => $a,
                    'city' => $city
                ]);
                continue;
            }

            // Check if the location already exists in the Locations table
            $check = Locations::where('location', '=', $locationName)->count();

            if ($check <= 0) {
                $city_value = new Locations;
                $city_value->location = $locationName;
                $city_value->country = $countryName;
                $city_value->save();
            }
        }
    }
}



    /*----------*/

    public function locations() {

    //             $all_packages=Locations::all();


    //     foreach ($all_packages as $package) {
    // $country = $package->country;
 
    // $package->continent = CustomHelpers::get_master_table_data('countries', 'id', $country, 'continent_id');

    // $countries = $package->country;
   
    // $package->country = CustomHelpers::get_master_table_data('countries', 'name', $countries, 'id');

    // $states = $package->state;
  
    // $package->state = CustomHelpers::get_master_table_data('states', 'name', $states, 'id');

    // $cities = $package->location;
  
    // $package->location = CustomHelpers::get_master_table_data('city', 'name', $cities, 'id');


    // $package->save();
// }

        // Check if the 'tour_package_manager' service is activated
        $check_data = ActivateService::where('services', '=', 'tour_package_manager')->first();

        // If the service is activated
        if ($check_data->activation == 1) {
            // Retrieve all locations with pagination
            $all_locations = Locations::with(['country_list','state_list','city_list'])->paginate(10);
            
            // Return the view with the locations data
            return view('manage_packages.locations', ['locations' => $all_locations]);
        } else {
            // If the service is not activated, return a 404 error view
            return response()->view('error.404', [], 404);
        }
    }

    /*----------*/

    public function location_list_filter_data(Request $request) {
        // Get the search key from the request
        $key = $request->key;

        // Check if the key is not empty and not equal to "0"
        if ($key != "" && $key != "0") {
            // Fetch data from the database where location, country, or continent matches the key
$cityIds = City::where('name', 'like', "%{$key}%")->pluck('id');
$stateIds = State::where('name', 'like', "%{$key}%")->pluck('id');
$countryIds = countries::where('name', 'like', "%{$key}%")->pluck('id');

$data = Locations::with(['country_list', 'state_list', 'city_list'])
    ->whereIn('location', $cityIds)
    ->orWhereIn('state', $stateIds)
    ->orWhereIn('country', $countryIds)
    ->orderBy('created_at', 'desc')
    ->paginate(10);

        } else {
            // If no key is provided, fetch all locations ordered by creation date
            $data = Locations::with(['country_list','state_list','city_list'])->orderBy('created_at', 'desc')->paginate(10);

           
        }

        // Get formatted location data for the current page
        $data_value = CustomHelpers::get_location_data($data, $request->page);

        // Output the data
        echo $data_value;
    }

    /*----------*/

    /*public function location_enable(Request $request)
    {
        $status=$request->status;
        $id=$request->pak_id;
        $data=Locations::find($id);
        if($data):
            $data->status=$status;
            $data->save();
        endif;
    }
    public function location_disable(Request $request)
    {
        $status=$request->status;
        $id=$request->pak_id;
        $data=Locations::find($id);
        if($data):
            $data->status=$status;
            $data->save();
        endif;
    }*/    

    public function toggle_location_status(Request $request) {
        $status = $request->status;
        $id = $request->pak_id;
        $data = Locations::find($id);

        if ($data) {
            $data->status = $status;
            $data->save();
            return response()->json(['success' => true, 'status' => $data->status]);
        }

        return response()->json(['success' => false]);
    }

    /*----------*/
    public function get_continent_list(Request $request)
   {
    $continents = DB::table('continent')->get();
    return response()->json($continents);
   }
   public function get_continent_country(Request $request)
   {
    $country = countries::where('continent_id', $request->continent_id)->get();
    return response()->json($country);
   }
   public function get_country_states(Request $request)
   {
    $states = State::where('country_id', $request->country_id)->get();
    return response()->json($states);
   }
   public function get_cities_states(Request $request)
   {
    $cities = City::where('state_id', $request->state_id)->get();
    return response()->json($cities);
   }

    public function locationsCreate() {
        // Check if the user is authenticated
        if (Sentinel::check()) {
            // Check if the user has the role of administrator, supervisor, or super_admin
            if (Sentinel::getUser()->inRole('administrator') || 
                Sentinel::getUser()->inRole('supervisor') || 
                Sentinel::getUser()->inRole('super_admin')) {
                
                // Fetch all countries and distinct continents from the database
              
                $continent = DB::table('continent')->get();
                   
                    

                // Return the location creation view with country and continent data
                return view('manage_packages.locationCreate', [
                    
                    'continent' => $continent
                ]);
            } else {
                // Redirect to the homepage if the user doesn't have the required role
                return redirect("/");
            }
        }
    }

    /*----------*/

    /*public function locationsEdit($id){
        $check_data=ActivateService::where('services','=','tour_package_manager')->first();

        if($check_data->activation==1):
        $locationD = Locations::findOrFail($id);

        $locD = new \stdClass();
        $locD->id = $locationD->id;
        $locD->location = $locationD->location;
        $locD->overview = $locationD->overview;
        $locD->currency = $locationD->currency;
        $locD->country = $locationD->country;
        $locD->state = $locationD->state;
        $locD->continent = $locationD->continent;
        $locD->best_time_desc = $locationD->best_time_desc;
        $locD->status = $locationD->status;
        $locD->best_time_to_visit = unserialize($locationD->best_time_to_visit);

        $country = countries::all();
        $continent = DB::table('regions')->select('continent','continent_name')->distinct()->get();
        $country_id=CustomHelpers::get_country_code($locD->country);
        $state=DB::table('states')
          ->where('country_id','=', $country_id)->get();

        $state_id=CustomHelpers::get_state_code($locD->state);
        $city=DB::table('city')
          ->where('state_id','=', $state_id)->get();

        return view('manage_packages.locationEdit',
                      ['country'=>$country,
                       'locData'=>$locD,
                       'continent'=>$continent,
                       'state'=>$state,
                       'city'=>$city
                       ]);
     else:
       return response()->view('error.404', [], 404);
     endif;
    }*/

    public function locationsEdit($id) {
        // Check if the tour package manager service is activated
        $check_data = ActivateService::where('services', '=', 'tour_package_manager')->first();
        
        if ($check_data->activation == 1) {
            // Retrieve the location data by ID or fail if not found
            $locationD = Locations::findOrFail($id);
            
            // Create a new stdClass object to hold location data
            $locD = new \stdClass();
            $locD->id = $locationD->id;
            $locD->location = $locationD->location;
            $locD->overview = $locationD->overview;
            $locD->currency = $locationD->currency;
            $locD->country = $locationD->country;
            $locD->state = $locationD->state;
            $locD->continent = $locationD->continent;
            $locD->best_time_desc = $locationD->best_time_desc;
            $locD->status = $locationD->status;
            $locD->best_time_to_visit = unserialize($locationD->best_time_to_visit);
            
            $continent = DB::table('continent')->get();
            $countries = countries::where('continent_id', $locationD->continent)->get();
            $states = State::where('country_id', $locationD->country)->get();
            $cities = City::where('state_id', $locationD->state)->get();
            
           
            // Return the location edit view with relevant data
            return view('manage_packages.locationEdit', [
                
                'locData' => $locD,
                'continent' => $continent,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities
            ]);
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /*----------*/

    /*public function locationsStore(Request $request){
           // dd($request);
        if($request->input('id')){
            $ids=$request->input('id');
            $this->validate($request, [
            'location' => "required|unique:rt_locations,location,$ids"
            ]);

            $location = Locations::findOrFail($request->input('id'));

            $location->location = $request->location;
            $location->overview = $request->overview;
            $location->currency = $request->currency;
            $location->country = $request->country;
            $location->continent = $request->continent;
            $location->state = $request->state;
            $location->status = $request->status;
            $location->best_time_desc = $request->best_time_desc;
            $location->best_time_to_visit = serialize($request->best_time_to_visit);

            if($location->save())
            return redirect('package-locations')->with('success','Location has been updated succesfuly');
        } else {
            $this->validate($request, [
            'location' => "required|unique:rt_locations"
            ]);

            $location = new Locations;
            $location->location = $request->location;
            $location->overview = $request->overview;
            $location->currency = $request->currency;
            $location->country = $request->country;
            $location->continent = $request->continent;
            $location->state = $request->state;
            $location->status = $request->status;
            $location->best_time_desc = $request->best_time_desc;
            $location->best_time_to_visit = serialize($request->best_time_to_visit);

            if($location->save())
            return redirect('package-locations')->with('success','Location has been created succesfuly');;
        }
    }*/

    public function locationsStore(Request $request) {
        // Check if an ID is present in the request
        if ($request->input('id')) {
            $ids = $request->input('id');

            // Validate the incoming request data
            $this->validate($request, [
                'location' => "required|unique:rt_locations,location,$ids" // Ensure the location is unique, excluding the current ID
            ]);

            // Find the location by ID or fail if not found
            $location = Locations::findOrFail($request->input('id'));
            
            // Update the location fields with the request data
            $location->location = $request->location;
            $location->overview = $request->overview;
            $location->currency = $request->currency;
            $location->country = $request->country;
            $location->continent = $request->continent;
            $location->state = $request->state;
            $location->status = $request->status;
            $location->best_time_desc = $request->best_time_desc;
            $location->best_time_to_visit = serialize($request->best_time_to_visit);
            
            // Save the updated location and redirect with success message
            if ($location->save()) {
                return redirect('package-locations')->with('success', 'Location has been updated successfully');
            }
        } else {
            // Validate the incoming request data for new location
            $this->validate($request, [
                'location' => "required|unique:rt_locations" // Ensure the location is unique
            ]);

            // Create a new location instance
            $location = new Locations();
            
            // Set the location fields with the request data
            $location->location = $request->location;
            $location->overview = $request->overview;
            $location->currency = $request->currency;
            $location->country = $request->country;
            $location->continent = $request->continent;
            $location->state = $request->state;
            $location->status = $request->status;
            $location->best_time_desc = $request->best_time_desc;
            $location->best_time_to_visit = serialize($request->best_time_to_visit);
            
            // Save the new location and redirect with success message
            if ($location->save()) {
                return redirect('package-locations')->with('success', 'Location has been created successfully');
            }
        }
    }

    /*----------*/

    public function locationsDelete(Request $request) {
        // Find the location by ID from the request and delete it
        Locations::find($request->id)->delete();

        // Redirect back to the package locations with a success message
        return redirect('/package-locations')->with('success', 'Location has been deleted successfully');
    }

}