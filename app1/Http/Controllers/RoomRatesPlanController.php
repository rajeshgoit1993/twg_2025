<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Hotel;
use App\Room;
use App\RoomRatesPlan;
use Validator;
use Sentinel;
use App\ActivateService;
class RoomRatesPlanController extends Controller
{
    public function index()
    {
        $check_data_rooms=ActivateService::where('services','=','rooms')->first();
if($check_data_rooms->activation==1):
         if(Sentinel::check()):
 if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')):
        $RoomRatesRegularPlan = RoomRatesPlan::select('id','hotel_Id','room_Id')
        ->where(['price_Type' => "regular", 'occupacyType' => 'single'])
        ->get();
        return view('roomRates.list',['RoomRatesRegular'=>$RoomRatesRegularPlan]);
 else:
    return redirect("/");
    endif;
endif;
else:
       return response()->view('error.404', [], 404);
endif;
    }
    public function deleteRoomRatePlans(Request $request) {
        // /dd($request);
        RoomRatesPlan::where([
            'hotel_Id' => $request->input('hotel_Id'),
            'room_Id' => $request->input('room_Id'),
        ])->delete();
        //RoomRatesPlan::find ( $request->input('id') )->delete ();
        return redirect('/room-rate-plans')->with('success','Room Rate Deleted Successfully');
    }
    public function deleteRoomRatePlanName(Request $request) {
        //dd($request);
        RoomRatesPlan::where([
            'price_Type' => 'special',
            'rate_Name' => $request->input('rateName'),
            'stay_Start_Date' => $request->input('staystartDate'),
            'stay_End_Date' => $request->input('stayEndDate'),
        ])->delete();
        //RoomRatesPlan::find ( $request->input('id') )->delete ();
        return redirect('/room-rate-plans')->with('success','Room Rate Deleted Successfully');
    }
    public function create()
    {
        $check_data_rooms=ActivateService::where('services','=','rooms')->first();
       if($check_data_rooms->activation==1):
        $hotels = Hotel::all();
        return view('roomRates.create',['hotels'=>$hotels]);
        else:
       return response()->view('error.404', [], 404);
       endif;
    }
    public function edit($hotelId,$roomId)
    {
        $check_data_rooms=ActivateService::where('services','=','rooms')->first();
       if($check_data_rooms->activation==1):
        // Get regular Price By Hotel Id and Room Id
        $RoomRatesRegularPlan = RoomRatesPlan::
        where([
            'price_Type' => "regular",
            'hotel_Id' => $hotelId,
            'room_Id' => $roomId,
        ])
        ->get();
        // Get rate Names By Hotel Id and Room Id
        $RoomRatesSpecialPlan = RoomRatesPlan::select('rate_Name','stay_Start_Date','stay_End_Date')->distinct()
        ->where([
             'price_Type' => "special",
             'hotel_Id' => $hotelId,
             'room_Id' => $roomId,
         ])
         ->get();
        //dd($RoomRatesSpecialPlan);
        // Get Plan Detail By Rate Name
        // $planData = array();
        // foreach($RoomRatesSpecialPlan as $planName){
        //     $RoomRatesSpecialPlan1 = RoomRatesPlan::select()
        //                         ->where([
        //                             'rate_Name' => $planName->rate_Name,
        //                             'hotel_Id' => $hotelId,
        //                             'room_Id' => $roomId,
        //                         ])
        //                         ->get();
        //     $planData[] = $RoomRatesSpecialPlan1;
        // }
        return view('roomRates.edit',['RoomRatesRegularPlan'=>$RoomRatesRegularPlan,'planData'=>$RoomRatesSpecialPlan]);
        else:
       return response()->view('error.404', [], 404);
       endif;
    }
    public function getRooms(Request $request)
    {
        $states = Room::select('id','roomTypeName')->where("assignedHotelname",$request->input('selectedHotel'))->get();
        return response()->json($states);
    }
    public function saveSpecialRoomRates(Request $request)
    {
        //dd($request->input('single')['Sun']);
        // $RoomsRatesData = new \stdClass();
        // $RoomsRatesData->id = $request->input('roomTypeName');
        $data = array(
            [
                'price_Type'=>$request->input('priceType'),
                'stay_Start_Date'=>date('Y-m-d',strtotime($request->input('dateFrom'))),
                'stay_End_Date'=>date('Y-m-d',strtotime($request->input('dateTo'))),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'single',
                'sun'=>$request->input('single')['Sun'],
                'mon'=>$request->input('single')['Mon'],
                'tue'=>$request->input('single')['Tue'],
                'wed'=>$request->input('single')['Wed'],
                'thu'=>$request->input('single')['Thu'],
                'fri'=>$request->input('single')['Fri'],
                'sat'=>$request->input('single')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                'price_Type'=>$request->input('priceType'),
                'stay_Start_Date'=>date('Y-m-d',strtotime($request->input('dateFrom'))),
                'stay_End_Date'=>date('Y-m-d',strtotime($request->input('dateTo'))),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'double',
                'sun'=>$request->input('double')['Sun'],
                'mon'=>$request->input('double')['Mon'],
                'tue'=>$request->input('double')['Tue'],
                'wed'=>$request->input('double')['Wed'],
                'thu'=>$request->input('double')['Thu'],
                'fri'=>$request->input('double')['Fri'],
                'sat'=>$request->input('double')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                'price_Type'=>$request->input('priceType'),
                'stay_Start_Date'=>date('Y-m-d',strtotime($request->input('dateFrom'))),
                'stay_End_Date'=>date('Y-m-d',strtotime($request->input('dateTo'))),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'triple',
                'sun'=>$request->input('triple')['Sun'],
                'mon'=>$request->input('triple')['Mon'],
                'tue'=>$request->input('triple')['Tue'],
                'wed'=>$request->input('triple')['Wed'],
                'thu'=>$request->input('triple')['Thu'],
                'fri'=>$request->input('triple')['Fri'],
                'sat'=>$request->input('triple')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                'price_Type'=>$request->input('priceType'),
                'stay_Start_Date'=>date('Y-m-d',strtotime($request->input('dateFrom'))),
                'stay_End_Date'=>date('Y-m-d',strtotime($request->input('dateTo'))),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'extraChild',
                'sun'=>$request->input('extraChild')['Sun'],
                'mon'=>$request->input('extraChild')['Mon'],
                'tue'=>$request->input('extraChild')['Tue'],
                'wed'=>$request->input('extraChild')['Wed'],
                'thu'=>$request->input('extraChild')['Thu'],
                'fri'=>$request->input('extraChild')['Fri'],
                'sat'=>$request->input('extraChild')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ]
        );
        // dd($data);
        if(RoomRatesPlan::insert($data)){
            return redirect('/room-rate-plans')->with('success','Room Rates Plan Added Successfully');
        }
    }
    public function saveRegularRoomRates(Request $request)
    {
        if ($request->input('capSingleId')) {
            $records_to_delete = array(
                $request->input('capSingleId'),
                $request->input('capDoubleId'),
                $request->input('capTripleId'),
                $request->input('capExtraChildId'),
            );
            //dd($records_to_delete);
            RoomRatesPlan::whereIn('id', $records_to_delete)->delete();
        }else{
            $this->validate($request,[
                'hotelId' => 'required|not_in:0',
                'roomId' => 'required|not_in:0',
            ]);
        }
        $data = array(
            [
                'price_Type'=>$request->input('priceType'),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'single',
                'sun'=>$request->input('single')['Sun'],
                'mon'=>$request->input('single')['Mon'],
                'tue'=>$request->input('single')['Tue'],
                'wed'=>$request->input('single')['Wed'],
                'thu'=>$request->input('single')['Thu'],
                'fri'=>$request->input('single')['Fri'],
                'sat'=>$request->input('single')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                'price_Type'=>$request->input('priceType'),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'double',
                'sun'=>$request->input('double')['Sun'],
                'mon'=>$request->input('double')['Mon'],
                'tue'=>$request->input('double')['Tue'],
                'wed'=>$request->input('double')['Wed'],
                'thu'=>$request->input('double')['Thu'],
                'fri'=>$request->input('double')['Fri'],
                'sat'=>$request->input('double')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                'price_Type'=>$request->input('priceType'),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'triple',
                'sun'=>$request->input('triple')['Sun'],
                'mon'=>$request->input('triple')['Mon'],
                'tue'=>$request->input('triple')['Tue'],
                'wed'=>$request->input('triple')['Wed'],
                'thu'=>$request->input('triple')['Thu'],
                'fri'=>$request->input('triple')['Fri'],
                'sat'=>$request->input('triple')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                'price_Type'=>$request->input('priceType'),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'extraChild',
                'sun'=>$request->input('extraChild')['Sun'],
                'mon'=>$request->input('extraChild')['Mon'],
                'tue'=>$request->input('extraChild')['Tue'],
                'wed'=>$request->input('extraChild')['Wed'],
                'thu'=>$request->input('extraChild')['Thu'],
                'fri'=>$request->input('extraChild')['Fri'],
                'sat'=>$request->input('extraChild')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ]
        );
        // dd($data);
        if(RoomRatesPlan::insert($data)){
            return redirect('/room-rate-plans')->with('success','Room Rates Plan Added Successfully');
        }
    }
    public function editRatePlan($planName,$dateFrom,$dateTo)
    {
        //dd($planName.'-'.$dateFrom.'-'.$dateTo);
        // Get regular Price By Hotel Id and Room Id
        $RoomRatesRegularPlan = RoomRatesPlan::
        where([
            'rate_Name' => $planName,
            'stay_Start_Date' => $dateFrom,
            'stay_End_Date' => $dateTo,
        ])
        ->get();
        //dd($RoomRatesRegularPlan);
        return view('roomRates.editPlan',['RoomRatesRegularPlan'=>$RoomRatesRegularPlan]);
    }
    public function updateRatePlan(Request $request){
        $data = array(
            [
                //'id'=>$request->input('capSingleId'),
                'price_Type'=>$request->input('priceType'),
                'stay_Start_Date'=>date('Y-m-d',strtotime($request->input('dateFrom'))),
                'stay_End_Date'=>date('Y-m-d',strtotime($request->input('dateTo'))),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'single',
                'sun'=>$request->input('single')['Sun'],
                'mon'=>$request->input('single')['Mon'],
                'tue'=>$request->input('single')['Tue'],
                'wed'=>$request->input('single')['Wed'],
                'thu'=>$request->input('single')['Thu'],
                'fri'=>$request->input('single')['Fri'],
                'sat'=>$request->input('single')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                //'id'=>$request->input('capDoubleId'),
                'price_Type'=>$request->input('priceType'),
                'stay_Start_Date'=>date('Y-m-d',strtotime($request->input('dateFrom'))),
                'stay_End_Date'=>date('Y-m-d',strtotime($request->input('dateTo'))),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'double',
                'sun'=>$request->input('double')['Sun'],
                'mon'=>$request->input('double')['Mon'],
                'tue'=>$request->input('double')['Tue'],
                'wed'=>$request->input('double')['Wed'],
                'thu'=>$request->input('double')['Thu'],
                'fri'=>$request->input('double')['Fri'],
                'sat'=>$request->input('double')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                //'id'=>$request->input('capTripleId'),
                'price_Type'=>$request->input('priceType'),
                'stay_Start_Date'=>date('Y-m-d',strtotime($request->input('dateFrom'))),
                'stay_End_Date'=>date('Y-m-d',strtotime($request->input('dateTo'))),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'triple',
                'sun'=>$request->input('triple')['Sun'],
                'mon'=>$request->input('triple')['Mon'],
                'tue'=>$request->input('triple')['Tue'],
                'wed'=>$request->input('triple')['Wed'],
                'thu'=>$request->input('triple')['Thu'],
                'fri'=>$request->input('triple')['Fri'],
                'sat'=>$request->input('triple')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ],
            [
                //'id'=>$request->input('capExtraChildId'),
                'price_Type'=>$request->input('priceType'),
                'stay_Start_Date'=>date('Y-m-d',strtotime($request->input('dateFrom'))),
                'stay_End_Date'=>date('Y-m-d',strtotime($request->input('dateTo'))),
                'rate_Name'=>$request->input('plan_name'),
                'hotel_Id'=>$request->input('SeleTedHotelID'),
                'room_Id'=>$request->input('SeleTedRoomID'),
                'commission_Offered'=>$request->input('commissionOffered'),
                'occupacyType'=>'extraChild',
                'sun'=>$request->input('extraChild')['Sun'],
                'mon'=>$request->input('extraChild')['Mon'],
                'tue'=>$request->input('extraChild')['Tue'],
                'wed'=>$request->input('extraChild')['Wed'],
                'thu'=>$request->input('extraChild')['Thu'],
                'fri'=>$request->input('extraChild')['Fri'],
                'sat'=>$request->input('extraChild')['Sat'],
                'currency'=>$request->input('SeleTedCurrency'),
            ]
        );
        $records_to_delete = array(
            $request->input('capSingleId'),
            $request->input('capDoubleId'),
            $request->input('capTripleId'),
            $request->input('capExtraChildId'),
        );
        //dd($data);
        RoomRatesPlan::whereIn('id', $records_to_delete)->delete();
        if(RoomRatesPlan::insert($data)){
            return redirect('/room-rate-plans')->with('success','Room Rates Plan Added Successfully');
        }
    }
}