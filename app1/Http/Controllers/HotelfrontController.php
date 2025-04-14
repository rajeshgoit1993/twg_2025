<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Hotel;
use App\Room;
use App\HotelUploads;
use App\Hotelamenities;
use App\Roomsamenities;
use App\RoomRatesPlan;
use App\RoomViews;
use App\RoomUploads;
use Route;
use Sentinel;
use Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class HotelfrontController extends Controller
{
	public function index(){
		//print"<>"
		$all_hotels = Hotel::all();
		return view('hotels.index',['Hotels'=>$all_hotels]);
	//  	$data_string = '{
	//  	"HOTEL_COUNTRY_CODE_FIELD": "AE",
	//  	"HOTEL_CITY_CODE_FIELD": "F_DXB",
	//  	"HOTEL_CHECK_IN_DATE_FIELD": "'.date('Y-m-d').'",
	// 	"HOTEL_CHECK_OUT_DATE_FIELD": "'.date('Y-m-d', strtotime("+3 days")).'",
	//  	 "HOTEL_NAME_FIELD": "",
	//  	 "HOTEL_STAR_RATING_FIELD": "1_2_3_4_5",
	//  	 "HOTEL_AVAILABLE_FIELD": "",
	//  	 "HOTEL_PRIMARY_CURRENCY_FIELD": "INR",
	//  	 "FLD_NATIONALITY_FIELD": "IN",
	//  	 "Fld_USERID_FIELD": "rapidextxml",
	//  	 "ROOM_INFO_FIELD": {
	//  	 "ROOM_LIST_FIELD": [
	//  	 {
	//  	 "NO_OF_ADULT_FIELD": 1,
	//  	 "NO_OF_CHILD_FIELD": 0,
	//  	 "CHILD_AGE_LIST_FIELD": []
	//  	 }
	//  	 ]
	//  	 },
	//  	 "Fld_API_KEY_FIELD": "2xzijL/0dqUXVGsG1oMzaMOpo28RlF/Ne4H/ERljGI8js/311ZbnChk8Ud1TRwwV"
	//  	}';
	//  $ch = curl_init('http://demo1.forerez.com/Service/Search/SearchHotel');
	//  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	//  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	//      'Content-Type: application/json',
	//      'Content-Length: ' . strlen($data_string))
	//  );
	//  $output = curl_exec($ch);
    //     // $arry = json_decode($output, true);
	//  	$json = $output;
	// 	 $resultForeHotel = json_decode ($json);
	// 	// dd($resultForeHotel);
	// 	if(count($resultForeHotel)>0){
	// 		$all_hotels = Hotel::all();
	// 		return view('hotels.index',['Hotels'=>$all_hotels,'ForezonHotels'=>$resultForeHotel]);
	// 	}else{
	// 		$all_hotels = Hotel::all();
	// 		return view('hotels.index',['Hotels'=>$all_hotels]);
	// 	 }
	}
	public function postSearchHotel(Request $request){
		//dd($request);
		$city = $request->hotelcity;
		 $checkin = $request->hotel_checkin;
		$checkout = $request->hotel_checkout;
		$guest_count = $request->guest;
		$city = explode(' - ' , $city);
	//	dd($city);die;
		$cityCode = DB::table('rt_fo_cities')->where('Cityname', $city[0])->get();
		//	dd($cityCode);die;
	 	$city = $cityCode[0]->CityCode;
		$country = $cityCode[0]->CountryCode;
		//echo $checkin;
		//echo date('Y-m-d',strtotime($checkin));die;
		/*
		$data_string = '{
		 "HOTEL_COUNTRY_CODE_FIELD": "'.$country.'",
		 "HOTEL_CITY_CODE_FIELD": "'.$city.'",
		 "HOTEL_CHECK_IN_DATE_FIELD": "'.date('Y-m-d',strtotime($checkin)).'",
		 "HOTEL_CHECK_OUT_DATE_FIELD": "'.date('Y-m-d',strtotime($checkout)).'",
		 "HOTEL_NAME_FIELD": "",
		 "HOTEL_STAR_RATING_FIELD": "1_2_3_4_5",
		 "HOTEL_AVAILABLE_FIELD": "",
		 "HOTEL_PRIMARY_CURRENCY_FIELD": "INR",
		 "FLD_NATIONALITY_FIELD": "IN",
		 "Fld_USERID_FIELD": "rapidextxml",
		 "ROOM_INFO_FIELD": {
		 "ROOM_LIST_FIELD": [
		 {
		 "NO_OF_ADULT_FIELD": "'.$guest_count.'",
		 "NO_OF_CHILD_FIELD": 0,
		 "CHILD_AGE_LIST_FIELD": []
		 }
		 ]
		 },
		 "Fld_API_KEY_FIELD": "2xzijL/0dqUXVGsG1oMzaMOpo28RlF/Ne4H/ERljGI8js/311ZbnChk8Ud1TRwwV"
		}';
	//print($data_string);die;
		$ch = curl_init('http://demo1.forerez.com/Service/Search/SearchHotel');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen($data_string))
		);
		$output = curl_exec($ch);
	      //  $arry = json_decode($output, true);
		  $json = $output;
		  $resultForeHotel = json_decode ($json);*/
		  //XML Hub
		 $str = '<?xml version="1.0" encoding="UTF-8"?>
		  <HotelFindRequest>
		  <Authentication>
		  <AgentCode>X85A056</AgentCode>
		  <UserName>rapidextravels</UserName>
		  <Password>rapidex$1</Password>
		</Authentication>
		  <Booking>
		  <ArrivalDate>'.date('d/m/Y',strtotime($checkin)).'</ArrivalDate>
		  <DepartureDate>'.date('d/m/Y',strtotime($checkout)).'</DepartureDate>
		  <CountryCode>AE</CountryCode>
		  <City>967</City>
		  <GuestNationality>AE</GuestNationality>
		  <HotelRatings>
		  <HotelRating>1</HotelRating>
		  <HotelRating>2</HotelRating>
		  <HotelRating>3</HotelRating>
		  <HotelRating>4</HotelRating>
		  <HotelRating>5</HotelRating>
		  </HotelRatings>
		  <Rooms>
		  <Room>
		  <Type>Room-1</Type>
		  <NoOfAdults>'.$guest_count.'</NoOfAdults>
		  <NoOfChilds>0</NoOfChilds>
		  </Room>
		  </Rooms>
		  </Booking>
		  </HotelFindRequest>';
		 $url = "http://test.xmlhub.com/testpanel.php/action/findhotel";
		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_URL, $url);
		  curl_setopt($ch, CURLOPT_POST, 1);
		  curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($str));
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  //execute post
		  $result = curl_exec($ch);
		$xml = simplexml_load_string($result, "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$xmlHubHotels = json_decode($json,TRUE);
			$hoteldata = array('HOTEL_COUNTRY_CODE_FIELD'=>$country,
							'HOTEL_CITY_CODE_FIELD'=>$city,
							'HOTEL_CHECK_IN_DATE_FIELD'=>date('Y-m-d',strtotime($checkin)),
							'HOTEL_CHECK_OUT_DATE_FIELD'=>date('Y-m-d',strtotime($checkout)),
							'HOTEL_PRIMARY_CURRENCY_FIELD'=>'INR',
							'FLD_NATIONALITY_FIELD'=>'IN',
							'NO_OF_ADULT_FIELD'=>$guest_count,
							'Fld_USERID_FIELD'=>'rapidextxml',
							'Fld_API_KEY_FIELD'=>'2xzijL/0dqUXVGsG1oMzaMOpo28RlF/Ne4H/ERljGI8js/311ZbnChk8Ud1TRwwV'
		);
		return view('hotels.search',['ForezonHotels'=>false,'xmlHubHotels'=>$xmlHubHotels,'hotelrequest'=>serialize($hoteldata)]);
	}
	public function postHotelDetails(Request $request){
		//dd($request);
		$data_string = '{
			"HOTEL_ID_FIELD": "'.$request->id.'",
			"Fld_USERID_FIELD": "rapidextxml",
			"Fld_API_KEY_FIELD": "2xzijL/0dqUXVGsG1oMzaMOpo28RlF/Ne4H/ERljGI8js/311ZbnChk8Ud1TRwwV"
		}';
		$ch = curl_init('http://demo1.forerez.com/Service/Search/HotelDetail');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen($data_string))
		);
		$output = curl_exec($ch);
      //  $arry = json_decode($output, true);
		$json = $output;
		$result = json_decode ($json);
		//dump(unserialize($request->room));
		return view('hotels.detail',['HotelDetail'=>$result,'Rooms'=>unserialize($request->room),'hotelrequest'=>unserialize($request->hotelrequest)]);
	}
	public function hotelDetailsXml(Request $request){
		//dd(unserialize($request->hotelrequest));
		$requ = unserialize($request->hotelrequest);
		 //XML Hub
		 $str = '<?xml version="1.0" encoding="UTF-8"?>
		 <HotelFindRequest>
		 <Authentication>
		 <AgentCode>X85A056</AgentCode>
		 <UserName>rapidextravels</UserName>
		 <Password>rapidex$1</Password>
	   </Authentication>
		 <Booking>
		 <ArrivalDate>'.date('d/m/Y',strtotime($requ['HOTEL_CHECK_IN_DATE_FIELD'])).'</ArrivalDate>
		 <DepartureDate>'.date('d/m/Y',strtotime($requ['HOTEL_CHECK_OUT_DATE_FIELD'])).'</DepartureDate>
		 <CountryCode>AE</CountryCode>
		 <City>967</City>
		 <HotelIDs>
		 <Int>'.$request->id.'</Int>
		 </HotelIDs>
		 <GuestNationality>AE</GuestNationality>
		 <HotelRatings>
		 <HotelRating>1</HotelRating>
		 <HotelRating>2</HotelRating>
		 <HotelRating>3</HotelRating>
		 <HotelRating>4</HotelRating>
		 <HotelRating>5</HotelRating>
		 </HotelRatings>
		 <Rooms>
		 <Room>
		 <Type>Room-1</Type>
		 <NoOfAdults>'.$requ['NO_OF_ADULT_FIELD'].'</NoOfAdults>
		 <NoOfChilds>0</NoOfChilds>
		 </Room>
		 </Rooms>
		 </Booking>
		 </HotelFindRequest>';
		$url = "http://test.xmlhub.com/testpanel.php/action/findhotelbyid";
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_URL, $url);
		 curl_setopt($ch, CURLOPT_POST, 1);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($str));
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 //execute post
		 $result = curl_exec($ch);
	   $xml = simplexml_load_string($result, "SimpleXMLElement", LIBXML_NOCDATA);
	   $json = json_encode($xml);
	   $xmlHubHotels = json_decode($json,TRUE);
		//print"<pre>";print_R($xmlHubHotels);die;
		$hotelOverview = DB::table('xmlhub_hotels')->select('*')->where('HotelCode',$request->id)->get()->first();
		$hotelAminities = DB::table('xmlhub_hotelsaminities')->select('*')->where('HotelCode',$request->id)->get()->first();
		//dd($hotelAminities);
		return view('hotels.detailxml',['xmlHubHotels'=>$xmlHubHotels,'aminities'=>$hotelAminities,'overview'=>$hotelOverview,'images'=>$hotelOverview,'hotelrequest'=>unserialize($request->hotelrequest)]);
	}
	public function xmlhubPreBooking(Request $request){
	//	dd($request);
		$pre_request = unserialize($request->pre_request);
		$room_data = unserialize($request->room_detail);
		//dd($room_data);
		$req = '<PreBookingRequest>
		<Authentication>
		<AgentCode>X85A056</AgentCode>
		<UserName>rapidextravels</UserName>
		<Password>rapidex$1</Password>
		</Authentication>
		<PreBooking>
		<SearchSessionId>'.$pre_request['SearchSessionId'].'</SearchSessionId>
		<ArrivalDate>'.$pre_request['ArrivalDate'].'</ArrivalDate>
		<DepartureDate>'.$pre_request['DepartureDate'].'</DepartureDate>
		<GuestNationality>AE</GuestNationality>
		<CountryCode>AE</CountryCode>
		<City>967</City>
		<HotelId>'.$pre_request['Hotels']['Hotel']['Id'].'</HotelId>
		<Price>'.$pre_request['Hotels']['Hotel']['Price'].'</Price>
		<Currency>INR</Currency>
		<RoomDetails>
		<RoomDetail>
		<Type>Double Room</Type>
		<BookingKey>'.$room_data['BookingKey'].'</BookingKey>
		<Adults>'.$room_data['Adults'].'</Adults>
		<Children>'.$room_data['Children'].'</Children>
		<ChildrenAges>'.$room_data['ChildrenAges'].'</ChildrenAges>
		<TotalRooms>'.$room_data['TotalRooms'].'</TotalRooms>
		<TotalRate>'.$room_data['TotalRate'].'</TotalRate>
		</RoomDetail>
		</RoomDetails>
		</PreBooking>
		</PreBookingRequest>';
		//echo $req;die;
		$url = "http://test.xmlhub.com/testpanel.php/action/prebook";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($req));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$result = curl_exec($ch);
		$xml = simplexml_load_string($result, "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$xmlpreBookingRes = json_decode($json,TRUE);
		$hotelOverview = DB::table('xmlhub_hotels')->select('*')->where('HotelCode',$xmlpreBookingRes['PreBookingRequest']['PreBooking']['HotelId'])->get()->first();
		$hotelImage = DB::table('xmlhub_hotelsimages')->select('*')->where('HotelCode',$xmlpreBookingRes['PreBookingRequest']['PreBooking']['HotelId'])->get()->first();
		//dd($xmlpreBookingRes);
		return view('hotels.bookingConfirmation',['xmlpreBookingRes'=>$xmlpreBookingRes,'hotelImage'=>$hotelImage,'hoteldata'=>$hotelOverview]);
	}
	public function checkAvailability(Request $request){
		//echo'<pre>';print_r($request->form_data);die;
		$data = '"HOTEL_ID_FIELD": "'.$request->form_data[1]['value'].'",
		"HOTEL_COUNTRY_CODE_FIELD": "'.$request->form_data[2]['value'].'",
		"HOTEL_CITY_CODE_FIELD": "'.$request->form_data[3]['value'].'",
		"HOTEL_CHECK_IN_DATE_FIELD": "'.$request->form_data[4]['value'].'",
		"HOTEL_CHECK_OUT_DATE_FIELD": "'.$request->form_data[5]['value'].'",
		"HOTEL_NAME_FIELD": "'.$request->form_data[6]['value'].'",
		"HOTEL_STAR_RATING_FIELD": "5",
		"HOTEL_AVAILABLE_FIELD": "AVAILABLE",
		"HOTEL_PRIMARY_CURRENCY_FIELD": "'.$request->form_data[7]['value'].'",
		"FLD_NATIONALITY_FIELD": "'.$request->form_data[8]['value'].'",
		"Fld_USERID_FIELD": "rapidextxml",
		"Fld_API_KEY_FIELD": "2xzijL/0dqUXVGsG1oMzaMOpo28RlF/Ne4H/ERljGI8js/311ZbnChk8Ud1TRwwV",
		"ROOM_TOKEN_FIELD":
		"'.$request->form_data[10]['value'].'",
		"ROOM_INFO_FIELD": {
			"ROOM_LIST_FIELD": [
			{
			"NO_OF_ADULT_FIELD": '.$request->form_data[11]['value'].',
			"NO_OF_CHILD_FIELD": 0,
			}
			]
			}
		}';
	//	echo $data;die;
		$ch = curl_init('http://demo1.forerez.com/Service/Search/AvailabilityCheck');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen($data))
		);
		$output = curl_exec($ch);
		print"<pre>";print_r($output);
	        $json = $output;
		  $availibility = json_decode ($json);
		  print"<pre>";print_r($availibility);
	}
	public function hotelDetails($id ,Request $request){
		$id = Crypt::decrypt($id);
		$all_hotelamenities = Hotelamenities::all();
        $all_roomsamenities = Roomsamenities::all();
		$hoteldata = Hotel::find($id['id']);
		$all_rooms = Room::where('assignedHotelname', $id['id'])->get();
		$HotelUploads = HotelUploads::where('hotel_id',$id['id'])->get();
		$pricing = RoomRatesPlan::where('hotel_id',$id['id'])->get();
		return view('hotels.hotelDetail',[
			'HotelDetail'=>$hoteldata,
			'Rooms'=>$all_rooms,
			'HotelAmeniies'=>$all_hotelamenities,
			'RoomAmeniies'=>$all_roomsamenities,
			'Pricing'=>$pricing,
			'images'=>$HotelUploads
		]);
	}
	/************************* Room filter ************************/
	public static function getRoomPrice($id){
        // Get Current Day
        $date = date('d-M-Y');
        $nameOfDay = strtolower(date('D', strtotime($date)));
        // Getting Special price from db
        $queryDataByDateRange = RoomRatesPlan::select($nameOfDay,'stay_Start_Date','stay_End_Date')
                    ->where(['room_id'=> $id,'price_Type' => "special", 'occupacyType' => 'single'])
                    ->first();
        $queryforRegular =RoomRatesPlan::select($nameOfDay)
                    ->where(['room_id'=> $id,'price_Type' => "regular", 'occupacyType' => 'single'])
                    ->first();
        // Checking Special price available Or Not
        if(!empty($queryDataByDateRange)){
            $strtdate = date('m-d-Y',strtotime($queryDataByDateRange->stay_Start_Date));
            $enddate =  date('m-d-Y',strtotime($queryDataByDateRange->stay_End_Date));
            $paymentDate=date('m-d-Y');
            if (($paymentDate >= $strtdate) && ($paymentDate <= $enddate)){
                if($queryDataByDateRange){
                    //echo "Special Price<br>";
                    return ($queryDataByDateRange->$nameOfDay);
                }else{
                    return('On Request');
                }
            }else{
                if($queryforRegular){
                    //echo "Regular Price<br>";
                    return ($queryforRegular->$nameOfDay);
                }else{
                    return('On Request');
                }
            }
        }else{
            if($queryforRegular){
                //echo "Regular Price<br>";
                return ($queryforRegular->$nameOfDay);
            }else{
                return('On Request');
            }
        }
    }
	public function roomFilter(Request $request){
		$all_roomsamenities = Roomsamenities::all();
		$strtdate = date('Y-m-d H:i:s',strtotime($request->date_from));
		$enddate =  date('Y-m-d H:i:s',strtotime($request->date_to));
		//return response()->json($strtdate);
		$noOfRooms = $request->noOfRooms;
		$noOfAdults = $request->noOfAdults;
		$noOfKids = $request->noOfKids;
		$hotelId  = $request->hotelId;
		$roomData = Room::
						where(['assignedHotelname' => $hotelId,'hotelstatus' => 'Yes'])
						->where('noOfRooms', '>=',  $noOfRooms)
						->where('roomOccBaseAdult', '>=',  $noOfAdults)
						->where('roomOccBaseChild', '>=',  $noOfKids)
						->get();
		foreach($roomData as $Room){
			//return response()->json($RoomViews->name);
			$roomImage = RoomUploads::where('room_id',$Room->id)->first();
        	if($roomImage){
				$roomImgName =  $roomImage->image_path;
    		}else{
				$roomImgName =  '/uploads/default_profile_image.png';
			}
			$RoomViews = RoomViews::where('id', $Room->roomView)->first();
			$roomViewName = $RoomViews->name ;
			?>
			<!-- <link href="{{ asset("/resources/assets/frontend/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" /> -->
			<article class="box">
				<div class="row">
					<div class="col-md-12 room_name">
						<h2><?php echo $Room->roomTypeName; ?>
							<small>
								(<?php echo $roomViewName; ?>)
							</small>
						</h2>
				</div>
					<figure class="col-sm-2 col-md-2">
							<img style="height:120px;" src="<?php echo url('/public'.$roomImgName) ?>" alt="">
						<div class="row">
							<div class="col-md-12 col-sm-12 line_height">
								<div class="sq">
									<i class="fa fa-check-circle"></i> Room Size: <?php echo $Room->roomSize; ?> Sqft
								</div>
							</div>
							<div class="col-md-12 col-sm-12 line_height">
								<div class="sq">
									<span><i class="fa fa-bed"></i></span> Bed Type: <?php echo $Room->bedType; ?>
								</div>
							</div>
					</figure>
					<figure class="col-sm-10 col-md-10">
						<div class="row mar0">
							<div class="col-sm-7">
								<h3>What’s Included</h3>
							</div>
							<div class="col-sm-1">
								<div class="Capacity">
								<h3>Capacity</h3>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="Price_per">
									<h3>Price Per Night</h3>
								</div>
							</div>
							<div class="col-sm-2">
								<h3>&nbsp;</h3>
							</div>
						</div>
						<div class="row border_oll">
							<div class="col-sm-7 border-right">
								<div class="row">
									<?php foreach($all_roomsamenities as $key=>$r_amenities){
											if(in_array($r_amenities->id,unserialize($Room->amenities))){
												$RoomAmn = Roomsamenities::where('id', $r_amenities->id)->first();
												$roomAmnName = $RoomAmn->icon ;
												?>
												<div class="col-sm-6 line_height"><span><i class="fa <?php echo $roomAmnName; ?>"></i></span><?php echo $r_amenities->name?></div>
									<?php 	}
										} ?>
									<div class="clearfix"></div>
									<div class="col-sm-6 line_height"><span><i class="fa fa-bed"></i></span>Meal Plan: <?php echo $Room->mealPlan; ?> </div>
									<div class="col-sm-6 line_height"><span><i class="fa fa-bed"></i></span>Payment Mode: <?php echo $Room->paymentMode; ?></div>
								</div>
							</div>
							<div class="col-sm-1 border-right">
								<div class="Capacity">
									<?php
									$OBA = $Room->roomOccBaseAdult;
									$OBC = $Room->roomOccBaseChild;
									$OMA = $Room->roomOccMaxAdult;
									$OMC = $Room->roomOccMaxChild;
									$OEI = $Room->roomOccMaxInfrant;
									$OIG = $Room->roomOccMaxGuest;
									?>
									<img src="<?php echo asset("/resources/assets/frontend/"); ?>/img/adultKids.jpg" style="width: 47px;">
									<p><?php echo $OBA; ?> Adults,<br><?php echo $OBC; ?> Kids</p>
								</div>
							</div>
							<div class="col-sm-2 border-right">
								<div class="Price_per">
									<span style="font-size: 15px;">Rs.</span><?php echo $this->getRoomPrice($Room->id); ?><br><br>
									<p class=""> <?php echo $Room->paymentType;  ?></p>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="Our_last">
									<p>Our last <?php echo $Room->noOfRooms; ?> room!</p>
									<!-- <a class="button yellow full-width uppercase btn-small sbmtFeedbck">Book</a> -->
									<form action="<?php echo url('/bookRooms'); ?>" method="post">
										<?php echo csrf_field(); ?>
										<input type="hidden" name="noOfRooms" value="<?php echo $noOfRooms; ?>">
										<input type="hidden" name="noOfAdults" value="<?php echo $noOfAdults; ?>">
										<input type="hidden" name="noOfKids" value="<?php echo $noOfKids; ?>">
										<input type="hidden" name="hotelId" value="<?php echo $hotelId; ?>">
										<input type="hidden" name="roomId" value="<?php echo $Room->id; ?>">
										<input type="hidden" name="checkInDate" value="<?php echo $strtdate; ?>">
										<input type="hidden" name="checkOutDate" value="<?php echo $enddate; ?>">
										<input type="hidden" name="TotalAmount" value="<?php echo $this->getRoomPrice($Room->id); ?>">
										<?php if(Sentinel::check()){ ?>
											<input type="hidden" name="customerId" value="<?php echo Sentinel::getUser()->id; ?>">
										<?php }else{ ?>
											<input type="hidden" name="customerId" value="">
										<?php } ?>
										<button type="submit" class="button yellow full-width uppercase btn-small" style="color: #fff;" value="Book Now">Book</button>
									</form><br>
									<?php if($Room->paymentType =='Refudnable'){ ?>
										<a data-toggle="collapse" data-target="#demo_<?php echo $Room->id; ?>">Cancellation Policies</a>
									<?php } ?>
								</div>
							</div>
						</div>
						<div id="demo_<?php echo $Room->id; ?>" class="collapse" style="background: #2b2828;color: white;padding: 12px;">
						<h4 style="color:white;">Cancellation Policies</h4><hr>
						<?php
						$policies = unserialize($Room->policy);
						$policiesKeys =  array_keys($policies);
						$totalPolicies = array();
						$allPolicies = array();
						foreach ($policiesKeys as $key => $value) {
							$totalPolicies['policy_percentege'] = $policies[$value]['policy_percentege'];
							$totalPolicies['selectFor'] = $policies[$value]['selectFor'];
							$totalPolicies['cancelledFrom'] = $policies[$value]['cancelledFrom'];
							$totalPolicies['cancelledTo'] = $policies[$value]['cancelledTo'];
							$allPolicies[] = $totalPolicies;
						}
						// echo '<pre>';
						// print_r($allPolicies);
						// echo '</pre>';
						if($Room->free_Cancellation_on !=''){
						?>
							<p>No Refund if cancelled between <?php echo $Room->free_Cancellation_on; ?> days prior to Check-in Date.</p>
						<?php }else{ ?>
							<?php foreach($allPolicies as $key=>$value){
								if(($value['selectFor']) != '0'){
									$hoursFrom = $value['cancelledFrom'];
									$hoursTo = $value['cancelledTo'];
									$hid = 24;
									$daysFrom = round($hoursFrom/$hid);
									$daysTo = round($hoursTo/$hid);
									if(($value['selectFor']) == 'Percentage'){ ?>
										<p style="font-size: 13px;"><?php echo $value['policy_percentege']; ?>% of Total Amount will deducted between
										<?php echo $daysTo; ?> to <?php echo $daysFrom; ?> days prior to Check-in Date.</p>
									<?php }else{ ?>
										<p style="font-size: 13px;"><?php echo $value['policy_percentege']; ?> days Amount of Total Amount will deducted between <?php echo $daysTo; ?> to <?php echo $daysFrom; ?> days prior to Check-in Date.</p>
									<?php }
									}
								}
							} ?>
						</div>
					</figure>
				</div>
			</article>
<?php /*
			<article class="box hotelDetail">
				<div class="row">
					<figure class="col-sm-3 col-md-3">
						<a class="hover-effect-- popup-gallery--" title="">
							<img width="230" height="160" src="<?php echo url('/public'.$roomImgName) ?>" alt="">
						</a>
					</figure>
					<figure class="col-sm-6 col-md-6">
						<div class="Options">
							<h3><?php echo $Room->roomTypeName; ?>
								<small>
									(<?php echo $roomViewName; ?>)
								</small>
							</h3>
							<!-- <h5>Amenities</h5>  -->
							<ul>
							<?php foreach($all_roomsamenities as $key=>$r_amenities){
								if(in_array($r_amenities->id,unserialize($Room->amenities))){
									$RoomAmn = Roomsamenities::where('id', $r_amenities->id)->first();
									$roomAmnName = $RoomAmn->icon ;
									?>
									<li>
										<a href="#" data-toggle="tooltip" title="<?php echo $r_amenities->name?>">
											<i class="fa <?php echo $roomAmnName; ?>"></i>
											<?php echo $r_amenities->name?>
										</a>
									</li>
						<?php 	}
							} ?>
							</ul>
						</div>
						<?php
						$OBA = $Room->roomOccBaseAdult;
						$OBC = $Room->roomOccBaseChild;
						$OMA = $Room->roomOccMaxAdult;
						$OMC = $Room->roomOccMaxChild;
						$OEI = $Room->roomOccMaxInfrant;
						$OIG = $Room->roomOccMaxGuest;
						?>
						<div class="clearfix"></div>
						<div class="occupancy">
							<?php
							if($OBA !=''){
								echo '<p><i class="fa fa-group"></i><b>Room Occupancy :</b>  ';
								echo $OBA.' Adults';
							}
							if($OBC !=''){
								echo ', '.$OBC.' Childs';
							}
							?>
							</p>
						</div>
					</figure>
					<figure class="col-sm-3 col-md-3">
						<div class="Avg">
						<p>
								<!-- Recommended for you <br> -->
							<span>We have <?php echo $Room->noOfRooms; ?> rooms left</span></p>
							<small>PER/NIGHT</small>
							<form action="<?php echo url('/bookRooms'); ?>" method="post">
								<?php echo csrf_field(); ?>
								<h1><b> <?php echo $this->getRoomPrice($Room->id); ?></h1>
								<input type="hidden" name="noOfRooms" value="<?php echo $noOfRooms; ?>">
								<input type="hidden" name="noOfAdults" value="<?php echo $noOfAdults; ?>">
								<input type="hidden" name="noOfKids" value="<?php echo $noOfKids; ?>">
								<input type="hidden" name="hotelId" value="<?php echo $hotelId; ?>">
								<input type="hidden" name="roomId" value="<?php echo $Room->id; ?>">
								<input type="hidden" name="checkInDate" value="<?php echo $strtdate; ?>">
								<input type="hidden" name="checkOutDate" value="<?php echo $enddate; ?>">
								<input type="hidden" name="TotalAmount" value="<?php echo $this->getRoomPrice($Room->id); ?>">
								<?php if(Sentinel::check()){ ?>
									<input type="hidden" name="customerId" value="<?php echo Sentinel::getUser()->id; ?>">
									<button type="submit" class="button yellow full-width uppercase btn-small" style="color: #fff;" value="Book Now">Reserve</button>
								<?php }else{ ?>
									<a href="#travelo-login" class="soap-popupbox button yellow full-width uppercase btn-small">Reserve</a>
								<?php } ?>
							</form>
							<br><a href="#" data-toggle="tooltip" title="Cancellation Policies" >Cancellation Policies</a>
						</div>
					</figure>
					<figure class="col-sm-12 col-md-12">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="sq">
								<span><i class="fa fa-check-circle"></i></span>  <b>Room Size :</b> <?php echo $Room->roomSize; ?> Sqft
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="sq">
								<span><i class="fa fa-bed"></i></span>  <b>Bed Type :</b> <?php echo $Room->bedType; ?>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="sq">
								<span><i class="fa fa-cutlery"></i></span>  <b>Meal Plan :</b> <?php echo $Room->mealPlan; ?>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="sq">
								<span><i class="fa fa-credit-card"></i></span>  <b>Payment Mode :</b> <?php echo $Room->paymentMode; ?>
							</div>
						</div>
					</div>
					</figure>
				</div>
			</article>
		<?php	*/
		}
	}
}