<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Hotel;
use App\Room;
use App\Roomsamenities;
use App\RoomPlan;
use App\RoomRates;
use App\RoomUploads;
use App\RoomContractType;
use App\RoomViews;
use App\RoomBooking;
use Validator;
use Sentinel;
use App\ActivateService;
class RoomController extends Controller
{
    public function index()
    {
    }
    public function rooms()
    {
        $check_data_rooms=ActivateService::where('services','=','rooms')->first();
if($check_data_rooms->activation==1):
         if(Sentinel::check()):
 if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')):
        $all_Rooms = Room::all();
        return view('room.listRooms',['Rooms'=>$all_Rooms]);
         else:
    return redirect("/");
    endif;
endif;
else:
       return response()->view('error.404', [], 404);
endif;
    }
    public function listRoomRates()
    {
        $all_Roomrates = RoomRates::all();
        return view('room.listRoomRates',['RoomRates'=>$all_Roomrates]);
    }
    public function listRatePlans()
    {
        if(Sentinel::check()):
 if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')):
        $all_RoomPlan = RoomPlan::all();
        return view('room.listRatePlans',['RoomPlan'=>$all_RoomPlan]);
        else:
    return redirect("/");
    endif;
endif;
    }
    public function listTaxes()
    {
        return view('room.listTaxes');
    }
    public function listPolicies()
    {
        return view('room.listPolicies');
    }
    public function roomSettings()
    {
        $check_data_rooms=ActivateService::where('services','=','rooms')->first();
if($check_data_rooms->activation==1):
        if(Sentinel::check()):
 if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')):
        $allContract = RoomContractType::all();
        $allroomViews = RoomViews::all();
        $all_roomsamenities = Roomsamenities::all();
        return view('room.roomSettings',[
            'Roomsamenities'=>$all_roomsamenities,
            'RoomViews'=>$allroomViews,
            'Contract'=>$allContract
            ]);
         else:
    return redirect("/");
    endif;
endif;
else:
       return response()->view('error.404', [], 404);
endif;
    }
    public function createRoom()
    {
        $check_data_rooms=ActivateService::where('services','=','rooms')->first();
      if($check_data_rooms->activation==1):
        $all_hotels = Hotel::all();
        $all_roomsamenities = Roomsamenities::all();
        $allroomViews = RoomViews::all();
         return view('room.createRoom',[
             'hotels'=>$all_hotels,
             'Roomsamenities'=>$all_roomsamenities,
             'RoomViews'=>$allroomViews,
              ]);
      else:
       return response()->view('error.404', [], 404);
     endif;
    }
    public function storeContarctTppe(Request $request){
        if (!$request->input('id')) {
            $ct = new RoomContractType;
        }else{
            $ct = RoomContractType::findOrFail($request->input('id'));
        }
        $ct->name = $request->input('cTName');
        $ct->description = $request->input('cTDesc');
        $ct->status = $request->input('CTStatus');
        if($ct->save()){
            return redirect('/room-settings')->with('success','New Item Added Successfully');
        }
    }
    public function storeRoomView(Request $request){
        if (!$request->input('id')) {
            $rv = new RoomViews;
        }else{
            $rv = RoomViews::findOrFail($request->input('id'));
        }
        $rv->name = $request->input('roomViewName');
        $rv->status = $request->input('roomViewStatus');
        if($rv->save()){
            return redirect('/room-settings')->with('success','New Item Added Successfully');
        }
    }
    public function storeRoomAminities(Request $request){
        if (!$request->input('id')) {
            $ra = new Roomsamenities;
        }else{
            $ra = Roomsamenities::findOrFail($request->input('id'));
        }
        $ra->name = $request->input('aminiName');
        $ra->icon = $request->input('aminiIcon');
        $ra->desc = $request->input('aminiDesc');
        $ra->status = $request->input('statusopt');
        if($ra->save()){
            return redirect('/room-settings')->with('success','New Item Added Successfully');
        }
    }
    public function storeRooms(Request $request){
        //dd($request);
        if (!$request->input('id')) {
            $rp = new Room;
        }else{
            $rp = Room::findOrFail($request->input('id'));
        }
        $rp->roomTypeName = $request->input('roomTypeName');
        $rp->assignedHotelname = $request->input('assignedHotelname');
        $rp->hotelstatus = $request->input('hotelstatus');
        $rp->roomDescription = $request->input('roomDescription');
        $rp->roomSize = $request->input('roomSize');
        $rp->noOfRooms = $request->input('noOfRooms');
        $rp->bedType = $request->input('bedType');
        $rp->roomView = $request->input('roomView');
        $rp->extraBedType = $request->input('extraBedType');
        $rp->mealPlan = $request->input('mealPlan');
        $rp->paymentMode = $request->input('paymentMode');
        $rp->taxInclude = $request->input('taxInclude');
        $rp->paymentType = $request->input('paymentType');
        $rp->roomOccBaseAdult = $request->input('roomOccBaseAdult');
        $rp->roomOccBaseChild = $request->input('roomOccBaseChild');
        $rp->roomOccMaxAdult = $request->input('roomOccMaxAdult');
        $rp->roomOccMaxChild = $request->input('roomOccMaxChild');
        $rp->roomOccMaxInfrant = $request->input('roomOccMaxInfrant');
        $rp->roomOccMaxGuest = $request->input('roomOccMaxGuest');
        // $rp->roomOccBase = serialize($request->input('roomOccBase'));
        // $rp->roomOccMax = serialize($request->input('roomOccMax'));
        // $rp->roomOccExtra = serialize($request->input('roomOccExtra'));
        $rp->amenities = serialize($request->input('amenities'));
        // $rp->daysOfWeek = serialize($request->input('daysOfWeek'));
        // $rp->stayStartDate = date('Y-m-d',strtotime($request->input('stayStartDate')));
        // $rp->stayEndDate = date('Y-m-d',strtotime($request->input('stayEndDate')));
        // $rp->ContractType = $request->input('ContractType');
        // $rp->TypeOfRate = $request->input('TypeOfRate');
        // $rp->defaultCommission = $request->input('defaultCommission');
        // $rp->defaultTax = $request->input('defaultTax');
        // $rp->Declared = serialize($request->input('Declared'));
        // $rp->Sell = serialize($request->input('Sell'));
        // $rp->sellCommission = serialize($request->input('sellCommission'));
        // $rp->Net = serialize($request->input('Net'));
        // $rp->ExtraCharge = serialize($request->input('ExtraCharge'));
        // $rp->extraCommission = serialize($request->input('extraCommission'));
        // $rp->NettExtraCharge = serialize($request->input('NettExtraCharge'));
        $rp->free_Cancellation_on = $request->input('free_Cancellation_on');
        $rp->policy = serialize($request->input('policy'));
        //dd($rp);
        if($rp->save()){
            return redirect('/rooms');
        }
    }
    public function editRooms($id)
    {
        $check_data_rooms=ActivateService::where('services','=','rooms')->first();
if($check_data_rooms->activation==1):
        $Rooms = Room::findOrFail($id);
        $RoomsData = new \stdClass();
        $RoomsData->id = $Rooms->id;
        $RoomsData->roomTypeName = $Rooms->roomTypeName;
        $RoomsData->assignedHotelname = $Rooms->assignedHotelname;
        $RoomsData->hotelstatus = $Rooms->hotelstatus;
        $RoomsData->roomDescription = $Rooms->roomDescription;
        $RoomsData->roomSize = $Rooms->roomSize;
        $RoomsData->noOfRooms = $Rooms->noOfRooms;
        $RoomsData->bedType = $Rooms->bedType;
        $RoomsData->roomView = $Rooms->roomView;
        $RoomsData->extraBedType = $Rooms->extraBedType;
        $RoomsData->mealPlan = $Rooms->mealPlan;
        $RoomsData->paymentMode = $Rooms->paymentMode;
        $RoomsData->taxInclude = $Rooms->taxInclude;
        $RoomsData->paymentType = $Rooms->paymentType;
        $RoomsData->roomOccBaseAdult = $Rooms->roomOccBaseAdult;
        $RoomsData->roomOccBaseChild = $Rooms->roomOccBaseChild;
        $RoomsData->roomOccMaxAdult = $Rooms->roomOccMaxAdult;
        $RoomsData->roomOccMaxChild = $Rooms->roomOccMaxChild;
        $RoomsData->roomOccMaxInfrant = $Rooms->roomOccMaxInfrant;
        $RoomsData->roomOccMaxGuest = $Rooms->roomOccMaxGuest;
        // $RoomsData->roomOccBase = unserialize($Rooms->roomOccBase);
        // $RoomsData->roomOccMax = unserialize($Rooms->roomOccMax);
        // $RoomsData->roomOccExtra = unserialize($Rooms->roomOccExtra);
        $RoomsData->amenities = unserialize($Rooms->amenities);
        // $RoomsData->daysOfWeek = unserialize($Rooms->daysOfWeek);
        // $RoomsData->stayStartDate = date("m/d/Y",strtotime($Rooms->stayStartDate));
        // $RoomsData->stayEndDate = date("m/d/Y",strtotime($Rooms->stayEndDate));
        // $RoomsData->ContractType = $Rooms->ContractType;
        // $RoomsData->TypeOfRate = $Rooms->TypeOfRate;
        // $RoomsData->defaultCommission = $Rooms->defaultCommission;
        // $RoomsData->defaultTax = $Rooms->defaultTax;
        // $RoomsData->Declared = unserialize($Rooms->Declared);
        // $RoomsData->Sell = unserialize($Rooms->Sell);
        // $RoomsData->sellCommission = unserialize($Rooms->sellCommission);
        // $RoomsData->Net = unserialize($Rooms->Net);
        // $RoomsData->ExtraCharge = unserialize($Rooms->ExtraCharge);
        // $RoomsData->extraCommission = unserialize($Rooms->extraCommission);
        // $RoomsData->NettExtraCharge = unserialize($Rooms->NettExtraCharge);
        $RoomsData->free_Cancellation_on = $Rooms->free_Cancellation_on;
        $RoomsData->policy = unserialize($Rooms->policy);
        $all_hotels = Hotel::all();
        $all_roomsamenities = Roomsamenities::all();
        $allroomViews = RoomViews::all();
        $RoomBooking = RoomBooking::where(['roomId'=> $id,'bookingStatus' =>'upcoming'])->get();
        return view('room.editRoom',[
            'Room'=>$RoomsData,
            'hotels'=>$all_hotels,
            'Roomsamenities'=>$all_roomsamenities,
            'RoomViews'=>$allroomViews,
            'RoomBooking'=>$RoomBooking
             ]);
    else:
       return response()->view('error.404', [], 404);
endif;
    }
    public function deleteRoom(Request $request) {
        Room::find ( $request->input('id') )->delete();
        return redirect('/rooms/');
    }
    public function createRoomRates()
    {
         $all_RoomPlan = RoomPlan::all();
         return view('room.createRoomRates',['RoomPlan'=>$all_RoomPlan]);
    }
    public function createRatePlans()
    {
         return view('room.createRatePlan');
    }
    public function createTaxes()
    {
         return view('room.createTaxes');
    }
    public function createPolicies()
    {
         return view('room.createPolicies');
    }
    public function settings()
    {
    }
    public function store(Request $request)
    {
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    public function storeRatePlans(Request $request)
    {
        //print_r($request->all());
        $this->validate($request,[
            'ratePlanName' => 'required|not_in:0',
            'mealPlan' => 'required|not_in:0',
            'paymentMode' => 'required|not_in:0',
            'taxInclude' => 'required|not_in:0',
            'paymentType' => 'required|not_in:0',
        ]);
        if (!$request->input('id')) {
            $rp = new RoomPlan;
        }else{
             $rp = RoomPlan::findOrFail($request->input('id'));
        }
        $rp->RatePlanName = $request->input('ratePlanName');
        $rp->MealPlan = $request->input('mealPlan');
        $rp->PaymentMode = $request->input('paymentMode');
        $rp->TaxIncluded = $request->input('taxInclude');
        $rp->PaymentType = $request->input('paymentType');
        //$role->save();
        //return response ()->json ( $role );
        if($rp->save()){
            return redirect('/room-plans');
        }
    }
    public function editRatePlans($id)
    {
        $RatePlansdata = RoomPlan::find($id);
        return view('room.editRatePlan',['RoomPlan'=>$RatePlansdata]);
    }
    public function deleteRatePlans(Request $request) {
        RoomPlan::find ( $request->input('id') )->delete ();
        return redirect('/room-plans');
    }
    public function storeRates(Request $request)
    {
        //dd($request);
        // $this->validate($request,[
        //         'ratePlanName' => 'required|not_in:0',
        //         'mealPlan' => 'required|not_in:0',
        //         'paymentMode' => 'required|not_in:0',
        //         'taxInclude' => 'required|not_in:0',
        //         'paymentType' => 'required|not_in:0',
        //     ]);
        if (!$request->input('id')) {
            $rp = new RoomRates;
        }else{
            $rp = RoomRates::findOrFail($request->input('id'));
        }
        $rp->room_Type = $request->input('roomType');
        $rp->day_of_Week = serialize($request->input('daysOfWeek'));
        $rp->stay_Start_Date = date("y-m-d",strtotime($request->input('stayStartDate')));
        $rp->stay_End_Date = date("y-m-d",strtotime($request->input('stayEndDate')));
        $rp->contract_Type = $request->input('ContractType');
        $rp->commission_Offered = $request->input('CommissionOffered');
        $rp->declared_Rate = serialize($request->input('Declared'));
        $rp->sell_Rate = serialize($request->input('Sell'));
        $rp->net_Rate = serialize($request->input('Net'));
        $rp->type_of_Rate = $request->input('TypeOfRate');
        $rp->extra_charges = serialize($request->input('ExtraCharge'));
        $rp->nett_Extra_Charges = serialize($request->input('NettExtraCharge'));
        //dd($rp);
        //$role->save();
        //return response ()->json ( $role );
        if($rp->save()){
            return redirect('/room-rates');
        }
    }
    public function editRoomRates($id)
    {
        $RoomRates = RoomRates::findOrFail($id);
       ///  dd($Packages);
        $RoomRatesData = new \stdClass();
        $RoomRatesData->id = $RoomRates->id;
        $RoomRatesData->room_Type = $RoomRates->room_Type;
        $RoomRatesData->day_of_Week = unserialize($RoomRates->day_of_Week);
        $RoomRatesData->stay_Start_Date = date("m/d/Y",strtotime($RoomRates->stay_Start_Date));
        $RoomRatesData->stay_End_Date = date("m/d/Y",strtotime($RoomRates->stay_End_Date));
        $RoomRatesData->contract_Type = $RoomRates->contract_Type;
        $RoomRatesData->commission_Offered = $RoomRates->commission_Offered;
        $RoomRatesData->declared_Rate = unserialize($RoomRates->declared_Rate);
        $RoomRatesData->sell_Rate = unserialize($RoomRates->sell_Rate);
        $RoomRatesData->net_Rate = unserialize($RoomRates->net_Rate);
        $RoomRatesData->type_of_Rate = $RoomRates->type_of_Rate;
        $RoomRatesData->extra_charges = unserialize($RoomRates->extra_charges);
        $RoomRatesData->nett_Extra_Charges = unserialize($RoomRates->nett_Extra_Charges);
        $all_RoomPlan = RoomPlan::all();
        return view('room.editRoomRates',['RoomRates'=>$RoomRatesData,'RoomPlan'=>$all_RoomPlan]);
    }
    public function deleteRoomRates(Request $request) {
        RoomRates::find ( $request->input('id') )->delete ();
        return redirect('/room-rates');
    }
     /***************************  Room Gallery Upload ******************/
    public function roomUploads($id)
    {
 //dd($id);
         $RoomUploads = RoomUploads::where('room_id',$id)->get();
         return view('room.roomUploads',['images'=>$RoomUploads,'roomId'=>$id]);
    }
    public function roomfileUploads(Request $request)
    {
         //get the file from the post request
         $file = $request->file('file');
         $room_id = $request->input('room_id');
         $filename = uniqid(). $file->getClientOriginalName();
         $path = '/uploads/rooms/'.$filename;
         //move the file to correct location
         $file->move(public_path().'/uploads/rooms/', $filename);
         $rooms = new RoomUploads;
         $rooms->room_id = $room_id;
         $rooms->image_path = $path;
         $rooms->save();
    }
    public function deleteRoomImage(Request $request) {
        RoomUploads::find ( $request->input('id') )->delete();
        return redirect('/roomUploads/'.$request->input('RoomId'));
    }
}