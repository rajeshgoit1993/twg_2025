@extends('layouts.front.masternofooter')
@if(env("WEBSITENAME")==1)
	@section("title", 'The World Gateway')
	@elseif(env("WEBSITENAME")==0)
	@section("title", 'RapidexTravels')
@endif
<?php 
	use App\Option1Quotation;
	use App\Option2Quotation;
	use App\Option3Quotation;
	use App\Option4Quotation;
	use App\Query;
	use App\QueryLeadTraveller;
	use App\QueryLeadTravellerInfo;
	use App\QueryTraveller;
	use App\Passengerinfo;
?>

@section('content')

<!-- my trips -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/userprofile.css') }}" />

<section>
	<!-- include('desktopSearchPanelHeader') -->
	<div class="myBookingBG flex-column">
		<div class="myBookingBreadCrumpCont"> 
			<div class="dPageContainer">
				<h5 class="myBookingBreadCrump">My Account&nbsp;<span class="rightArrow"></span>&nbsp;My Booking</h5>
			</div>
		</div>
		<div class="dPageContainer">
			<!-- trip tab heading -->
			<div class="tripHeading">
				<ul class="makeflex mobscroll scrollX">
					<li class="tablinks tripStatus" id="defaultOpen" data-target="upcoming">UPCOMING</li>
					<li class="tablinks tripStatus" data-target="pending_payment">PENDING PAYMENT</li>
					<!-- <li class="tablinks tripStatus" id="defaultOpen" data-target="unpaid">UNPAID</li> -->
					<li class="tablinks tripStatus" data-target="cancelled">CANCELLED</li>
					<li class="tablinks tripStatus" data-target="completed">COMPLETED</li>
					<li class="tablinks tripStatus" data-target="leadcancelled">LEAD CANCELLED</li>
				<!-- search booking -->
				<div class="searchBookingCont">
					<div class="searchBooking">
						<input type="text" name="search" placeholder="Search Booking" />
					</div>
				</div>
			</div>
			<!-- upcoming trip -->
			<div class="tripTabContent" id="upcoming">
				<div class="emptyTripBucket">
					<div class="bucketContainer">
						<div class="fa-suitcase fontSize60"></div>
						<div class="appendLeft40">
							<div class="appendBottom20">
								<p class="bucketTitle">You have no upcoming booking</p>
								<p class="bucketSubTitle">When you make a booking, you will see the details here.</p>
							</div>
							<a href="{{ URL::to('/') }}"><button type="button" name="plantrip" class="btnTripPlan">Plan my Trip</button></a>
						</div>
					</div>
				</div>
				<div class="myBookingCont">
					@foreach($upcoming as $up)
					<?php 
						$originalDate = $up->tour_date;
						$now = time();
						$your_date = strtotime($originalDate);
						$datediff =  $your_date-$now;
						$diff_days=round($datediff / (60 * 60 * 24));

						if($originalDate=="N" || $originalDate==""):
						$originalDate=date("d-m-Y");
						endif;
						
						$datefrom = str_replace(' ', '', $originalDate);
						$datefrom=explode("-", $datefrom);
						
						$datefrom_year=$datefrom["2"];
						$datefrom_day=$datefrom["1"];
						
						$datefrom_month=$datefrom["0"];
						$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
						
						$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
						$stop_date = $datefrom;
						$date_to=$datefrom;
						$datefrom_print = date("d M Y", strtotime($datefrom));
						$day_from = strtotime($datefrom);
						$day_from = date('D', $day_from);
						
						$to_days=$up->duration-1;
						
						$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
						$stop_date_print= date("d M Y", strtotime($stop_date));
						$day_to = strtotime($stop_date);
						$day_to = date('D', $day_to);

						$quotation_ref_no=$up->quo_ref;
						$room_passenger_data=DB::table('rt_passengerinfo')->where('quotation_ref_no',$quotation_ref_no)->first();
						$passenger_ids=array();
						if($room_passenger_data!='') {
							$room_passenger=unserialize($room_passenger_data->room_passenger);

							foreach($room_passenger as $row=>$col) {
								foreach($col as $a=>$b) {
									foreach($b as $c=>$d) {
										$name=CustomHelpers::get_master_table_data('query_traveller','id',CustomHelpers::custom_decrypt($d),'firstname').' '.CustomHelpers::get_master_table_data('query_traveller','id',CustomHelpers::custom_decrypt($d),'lastname');
										array_push($passenger_ids,$name);
										}
									}
								}
							}
					?>
					<div class="myBookingList">
						<div class="myBkngServiceIcon"></div>
						<div class="flexBetween">
							<div class="flex-column">
								<div class="flexCenter">
									<div>
										<h2 class="myBookingTitle">{{$up->package_name}}</h2>
									</div>
									<div>
										<span class="myBookingUpcomingDays_tag"> 
											@if($diff_days<0) Departure Date Ended @else In {{$diff_days}} days @endif</span>
									</div>
								</div>
								<div class="myBookingRefId">
									<span>Booking ID&nbsp;-&nbsp;#{{ $up->quo_ref }}</span>
								</div>
							</div>
							<div class="manageBkngBox" style="width:290px !important">
								<a href="{{ url('Manage-Booking/'.$up->quo_ref) }}">
									<button type="button" name="managebooking" class="btnManageBooking">Manage booking</button>
								</a>
								<a href="{{ url('/quotes/'.$up->unique_code) }}">
									<button type="button" name="managebooking" class="btnManageBooking">View quote</button>
								</a>
							</div>
						</div>
					</div>
					
					<div class="myBkngSummary">
						<div class="myBkngSummaryBox">
							<div class="summaryLeftPart">
								<div class="travelDtls">
									<p class="travelDtlsHead">DEPARTURE</p>
									<p class="travelDtlsDate"><?php echo "$day_from"; ?>, {{$datefrom_print}}</p>
									<p class="travelDtlsCity">{{$up->sourcecity}}</p>
								</div>
								<div class="travelDtls">
									<p class="travelDtlsHead">RETURN</p>
									<p class="travelDtlsDate"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
									<p class="travelDtlsCity">Sharjah</p>
								</div>
								<div class="bkngDtls">
									<div class="fa-cog appendBottom10"><span class="bkngDtlsDuration">{{ CustomHelpers::get_seperate_pass_payment_view($up->id,1,'room') }} Room(s), <?php $day_night=(int)filter_var($up->duration, FILTER_SANITIZE_NUMBER_INT); ?> {{ $day_night-1 }} Nights - {{ $day_night }} Days </span></div>
									<div class="flexCenter">
										<div class="makeflex alignitemsEnd" style="width: ">
											<div class="travellerIcon">
												<span class="bigFace"></span>
												<span class="bigBody"></span>
											</div>
											<div class="travellerIcon">
												<span class="smallFace"></span>
												<span class="smallBody"></span>
											</div>
										</div>
										<div class="bkngDtlsGuest">
											@if(count($passenger_ids)>0)
												{{ $passenger_ids[0]}} + {{count($passenger_ids)-1 }}
												@else
												0
											@endif
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="summaryRightPart">
								<div class="appendBottom10 cursorPointer">Cancel Booking</div>
								<div class="cursorPointer">Change Tour Dates</div>
							</div> -->
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<!-- trip pending payment -->
			<div class="tripTabContent" id="pending_payment">
				<div class="">
				<?php 
					$a1 = ['0'];
				?>
				@foreach($unsuccess_or_some_payments as $up)

					<?php
					// $quote_no=$up->accept_quote_no;
			        // if($quote_no==1) {
				    //     $data=Option1Quotation::find((int)$up->accept_quote_id);
				    //     $quote_ref_no=$data->quo_ref;
				    //     $price=$data->option1_price;
				    //     $price_data=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
				    // 	}
				    //     elseif($quote_no==2) {
					//         $data=Option2Quotation::find((int)$up->accept_quote_id);
					//         $quote_ref_no=$data->quotation_ref_no;
					//         $price=$data->option2_price;
					//         }
				    //     elseif($quote_no==3) {
				    //     	$data=Option3Quotation::find((int)$up->accept_quote_id);
				    //     	$quote_ref_no=$data->quotation_ref_no;
				    //     	$price=$data->option3_price;
				    //     	}
			        // 	elseif($quote_no==4) {
			        // 		$data=Option4Quotation::find((int)$up->accept_quote_id);
				    //     	$quote_ref_no=$data->quotation_ref_no;
				    //     	$price=$data->option4_price;
				    //     	}
			        // 	$amount=$price_data['query_pricetopay_adult'];

			        $price_data = ['query_pricetopay_adult' => 0]; // Default initialization to avoid undefined variable error

					$quote_no = $up->accept_quote_no;
					if ($quote_no == 1) {
					    $data = Option1Quotation::find((int)$up->accept_quote_id);
					    $quote_ref_no = $data->quo_ref;
					    $price = $data->option1_price;
					    $price_data = CustomHelpers::get_price_part_seperate($data->option1_price, $data->quote1_number_of_adult, $data->extra_adult, $data->child_with_bed, $data->child_without_bed, $data->infant, $data->solo_traveller);
					} elseif ($quote_no == 2) {
					    $data = Option2Quotation::find((int)$up->accept_quote_id);
					    $quote_ref_no = $data->quotation_ref_no;
					    $price = $data->option2_price;
					    // Add logic to set $price_data if needed
					} elseif ($quote_no == 3) {
					    $data = Option3Quotation::find((int)$up->accept_quote_id);
					    $quote_ref_no = $data->quotation_ref_no;
					    $price = $data->option3_price;
					    // Add logic to set $price_data if needed
					} elseif ($quote_no == 4) {
					    $data = Option4Quotation::find((int)$up->accept_quote_id);
					    $quote_ref_no = $data->quotation_ref_no;
					    $price = $data->option4_price;
					    // Add logic to set $price_data if needed
					}

					// Ensure $price_data is used safely below this point
					$amount = $price_data['query_pricetopay_adult'];

		        	$previous_amount = DB::table('rt_payments')
		        		->where([['quote_ref_no','=',(int)$up->quo_ref],['status','=',1]])
		        		->sum('amount');
		        		if($previous_amount<$amount  && $previous_amount>0) {
		        			$a1[]=1;
		        			$originalDate = $up->tour_date;
		        			$now = time();
		        			$your_date = strtotime($originalDate);
		        			$datediff =$your_date-$now;
		        			$diff_days=round($datediff / (60 * 60 * 24));
		        			if($originalDate=="N" || $originalDate==""):
								$originalDate=date("d-m-Y");
							endif;
							
							$datefrom = str_replace(' ', '', $originalDate);
							$datefrom=explode("-", $datefrom);
							
							$datefrom_year=$datefrom["2"];
							$datefrom_day=$datefrom["1"];
							
							$datefrom_month=$datefrom["0"];
							$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
							
							$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
							$stop_date = $datefrom;
							$date_to=$datefrom;
							$datefrom_print = date("d M Y", strtotime($datefrom));
							$day_from = strtotime($datefrom);
							$day_from = date('D', $day_from);
							
							$to_days=$up->duration-1;
							
							$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
							$stop_date_print= date("d M Y", strtotime($stop_date));
							$day_to = strtotime($stop_date);
							$day_to = date('D', $day_to);

							$quotation_ref_no=$up->quo_ref;
							$room_passenger_data=DB::table('rt_passengerinfo')->where('quotation_ref_no',$quotation_ref_no)->first();
							$passenger_ids=array();
							if($room_passenger_data!='') {
								$room_passenger=unserialize($room_passenger_data->room_passenger);
								foreach($room_passenger as $row=>$col) {
									foreach($col as $a=>$b) {
										foreach($b as $c=>$d) {
											$name=CustomHelpers::get_master_table_data('query_traveller','id',CustomHelpers::custom_decrypt($d),'firstname').' '.CustomHelpers::get_master_table_data('query_traveller','id',CustomHelpers::custom_decrypt($d),'lastname');
											array_push($passenger_ids,$name);
											}
										}
									}
								}
						?>
						<div class="myBookingList">
							<div class="myBkngServiceIcon"></div>
							<div class="flexBetween">
								<div class="flex-column">
									<div class="flexCenter">
										<div>
											<h2 class="myBookingTitle">{{$up->package_name}}</h2>
										</div>
										<div>
											<span class="myBookingUpcomingDays_tag">@if($diff_days<0) Departure Date Ended @else In {{ $diff_days }} days @endif</span>
										</div>
									</div>
									<div class="myBookingRefId">
										<span>Booking ID&nbsp;-&nbsp;#{{ $up->quo_ref }}</span>
									</div>
								</div>
								<div class="manageBkngBox">
									<!-- <a href="{{url('/quotes/'.$up->unique_code)}}" ><button type="button" name="managebooking" class="btnMain btnManageBooking">MANAGE BOOKING</button></a> -->
									<input type="hidden" name="quote_no" class="quote_no" value="{{ CustomHelpers::custom_encrypt(1) }}">
									<input type="hidden" name="unique_code" class="unique_code" value="{{ CustomHelpers::custom_encrypt($up->unique_code) }}"> 
									<a href="#" class="pay_now" content_action="{{route('paymentview')}}">
										<button type="button" name="managebooking" class="btnManageBooking">Pay Now</button>
									</a>
								</div>
							</div>
						</div>
						<!-- booking summary -->
						<div class="myBkngSummary">
							<div class="myBkngSummaryBox">
								<div class="summaryLeftPart">
									<div class="travelDtls">
										<p class="travelDtlsHead">DEPARTURE</p>
										<p class="travelDtlsDate"><?php echo "$day_from"; ?>, {{ $datefrom_print }}</p>
										<p class="travelDtlsCity">{{ $up->sourcecity }}</p>
									</div>
									<div class="travelDtls">
										<p class="travelDtlsHead">RETURN</p>
										<p class="travelDtlsDate"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
										<p class="travelDtlsCity">Sharjah</p>
									</div>
									<div class="bkngDtls">
										<div class="fa-cog appendBottom10"><span class="bkngDtlsDuration">{{ CustomHelpers::get_seperate_pass_payment_view($up->id,1,'room') }} Room(s), <?php $day_night=(int)filter_var($up->duration, FILTER_SANITIZE_NUMBER_INT); ?> {{ $day_night-1 }} Nights - {{ $day_night }} Days </span></div>
										<div class="flexCenter">
											<div class="makeflex alignitemsEnd" style="width: ">
												<div class="travellerIcon">
													<span class="bigFace"></span>
													<span class="bigBody"></span>
												</div>
												<div class="travellerIcon">
													<span class="smallFace"></span>
													<span class="smallBody"></span>
												</div>
											</div>
											<div class="bkngDtlsGuest">
												@if(count($passenger_ids)>0)
													{{ $passenger_ids[0]}} + {{count($passenger_ids)-1 }}
													@else
													0
												@endif
											</div>
										</div>
									</div>
								</div>
								<!-- <div class="summaryRightPart">
									<div class="appendBottom10 cursorPointer">Cancel Booking</div>
									<div class="cursorPointer">Change Tour Dates</div>
								</div> -->
							</div>
						</div>
						<?php
						}
						?>
						@endforeach
						@if(!in_array(1,$a1) || count($unsuccess_or_some_payments)==0)
						<div class="emptyTripBucket">
							<div class="bucketContainer">
								<div class="fa-suitcase fontSize60"></div>
								<div class="appendLeft40">
									<div class="appendBottom20">
										<p class="bucketTitle">You have no pending booking</p>
										<p class="bucketSubTitle">Great! Looks like you have no pending booking.</p>
									</div>
									<a href="{{ URL::to('/') }}"><button type="button" name="plantrip" class="btnTripPlan">Plan my Trip</button></a>
								</div>
							</div>
						</div>
					@endif
		           </div>
		    </div>

		    <!-- unpaid trip -->
		    <div class="tripTabContent" id="unpaid">
		    	<div class="">
					@foreach($unsuccess_or_some_payments as $up)
					<?php
						$quote_no=$up->accept_quote_no;
					        if($quote_no==1) {
						        $data=Option1Quotation::find((int)$up->accept_quote_id);
						        $quote_ref_no=$data->quo_ref;
						        $price=$data->option1_price;
						        $price_data=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
						        }
						        elseif($quote_no==2) {
							        $data=Option2Quotation::find((int)$up->accept_quote_id);
							        $quote_ref_no=$data->quotation_ref_no;
							        $price=$data->option2_price;
							        }
						        elseif($quote_no==3) {
									$data=Option3Quotation::find((int)$up->accept_quote_id);
							        $quote_ref_no=$data->quotation_ref_no;
							        $price=$data->option3_price;
							        }
						        elseif($quote_no==4) {
							        $data=Option4Quotation::find((int)$up->accept_quote_id);
							        $quote_ref_no=$data->quotation_ref_no;
							        $price=$data->option4_price;
							        }
						        $amount=$price_data['query_pricetopay_adult'];
								$previous_amount = DB::table('rt_payments')
								->where([['quote_ref_no','=',(int)$up->quo_ref],['status','=',1]])
								->sum('amount');
								$b=['0'];
								if($previous_amount<=0) {
									$b[]=1;

									$originalDate = $up->tour_date;

									$now = time();
									$your_date = strtotime($originalDate);
									$datediff =  $your_date-$now;
									$diff_days=round($datediff / (60 * 60 * 24));

									if($originalDate=="N" || $originalDate==""):
									$originalDate=date("d-m-Y");
									endif;
													
									$datefrom = str_replace(' ', '', $originalDate);
									$datefrom=explode("-", $datefrom);
												
									$datefrom_year=$datefrom["2"];
									$datefrom_day=$datefrom["1"];
													
									$datefrom_month=$datefrom["0"];
									$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
													
									$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
									$stop_date = $datefrom;
									$date_to=$datefrom;
									$datefrom_print = date("d M Y", strtotime($datefrom));
									$day_from = strtotime($datefrom);
									$day_from = date('D', $day_from);
													
									$to_days=$up->duration-1;
													
									$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
									$stop_date_print= date("d M Y", strtotime($stop_date));
									$day_to = strtotime($stop_date);
									$day_to = date('D', $day_to);
									$quotation_ref_no=$up->quo_ref;

									$room_passenger_data=DB::table('rt_passengerinfo')->where('quotation_ref_no',$quotation_ref_no)->first();
									$passenger_ids=array();
									if($room_passenger_data!='') {
										$room_passenger=unserialize($room_passenger_data->room_passenger);
										foreach($room_passenger as $row=>$col) {
											foreach($col as $a=>$b) {
												foreach($b as $c=>$d) {
													$name=CustomHelpers::get_master_table_data('query_traveller','id',CustomHelpers::custom_decrypt($d),'firstname').' '.CustomHelpers::get_master_table_data('query_traveller','id',CustomHelpers::custom_decrypt($d),'lastname');
													array_push($passenger_ids,$name);
													}
												}
											}
										}
					?>
					<div class="myBookingList">
						<div class="myBkngServiceIcon"></div>
						<div class="flexBetween">
							<div class="flex-column">
								<div class="flexCenter">
									<div>
										<h2 class="myBookingTitle">{{$up->package_name}}</h2>
									</div>
									<div>
										<span class="myBookingUpcomingDays_tag">@if($diff_days<0) Departure Date Ended @else In {{$diff_days}} days @endif</span>
									</div>
								</div>
								<div class="myBookingRefId">
									<span>Booking ID&nbsp;-&nbsp;#{{ $up->quo_ref }}</span>
								</div>
							</div>
							<div class="manageBkngBox">
								<a href="{{url('/quotes/'.$up->unique_code)}}" >
									<button type="button" name="managebooking" class="btnManageBooking">Manage booking</button>
								</a>
							</div>
						</div>
					</div>
					
					<div class="myBkngSummary">
						<div class="myBkngSummaryBox">
							<div class="summaryLeftPart">
								<div class="travelDtls">
									<p class="travelDtlsHead">DEPARTURE</p>
									<p class="travelDtlsDate"><?php echo "$day_from"; ?>, {{$datefrom_print}}</p>
									<p class="travelDtlsCity">{{$up->sourcecity}}</p>
								</div>
								<div class="travelDtls">
									<p class="travelDtlsHead">RETURN</p>
									<p class="travelDtlsDate"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
									<p class="travelDtlsCity">Sharjah</p>
								</div>
								<div class="bkngDtls">
									<div class="fa-cog appendBottom10"><span class="bkngDtlsDuration">{{CustomHelpers::get_seperate_pass_payment_view($up->id,1,'room')}} Room(s), <?php $day_night=(int)filter_var($up->duration, FILTER_SANITIZE_NUMBER_INT); ?> {{$day_night-1}} Nights - {{$day_night}} Days </span></div>
									<div class="flexCenter">
										<div class="makeflex alignitemsEnd" style="width: ">
											<div class="travellerIcon">
												<span class="bigFace"></span>
												<span class="bigBody"></span>
											</div>
											<div class="travellerIcon">
												<span class="smallFace"></span>
												<span class="smallBody"></span>
											</div>
										</div>
										<div class="bkngDtlsGuest">
											@if(count($passenger_ids)>0)
												{{ $passenger_ids[0] }} + {{ count($passenger_ids)-1 }}
												@else
												0
											@endif
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="summaryRightPart">
								<div class="appendBottom10 cursorPointer">Cancel Booking</div>
								<div class="cursorPointer">Change Tour Dates</div>
							</div> -->
						</div>
					</div>
					<?php
					}
					?>
					@endforeach
					<?php 
						if(!isset($b)) {
							$b=['0'];
							}
					?>
					@if(!in_array(1,$b) || count($unsuccess_or_some_payments)==0)
						<div class="emptyTripBucket">
							<div class="bucketContainer">
								<div class="fa-suitcase fontSize60"></div>
								<div class="appendLeft40">
									<div class="appendBottom20">
										<p class="bucketTitle">You have no unpaid booking</p>
										<p class="bucketSubTitle">Great! Looks like you have no failed booking.</p>
									</div>
									<a href="{{ URL::to('/') }}"><button type="button" name="plantrip" class="btnTripPlan">Plan my Trip</button></a>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>

			<!-- trip cancelled -->
			<div class="tripTabContent" id="cancelled">
				<div class="emptyTripBucket">
					<div class="bucketContainer">
						<div class="fa-suitcase fontSize60"></div>
						<div class="appendLeft40">
							<div class="appendBottom20">
								<p class="bucketTitle">You have no cancelled booking</p>
								<p class="bucketSubTitle">Looks like you don't have any cancelled trip.</p>
							</div>
							<a href="{{ URL::to('/') }}"><button type="button" name="plantrip" class="btnTripPlan">Plan my Trip</button></a>
						</div>
					</div>
				</div>
			</div>

			<!-- trip completed -->
			<div class="tripTabContent" id="completed">
				<div class="emptyTripBucket">
					<div class="bucketContainer">
						<div class="fa-suitcase fontSize60"></div>
						<div class="appendLeft40">
							<div class="appendBottom20">
								<p class="bucketTitle">You have no completed booking</p>
								<p class="bucketSubTitle">Looks like you don't have any completed trip.</p>
							</div>
							<a href="{{ URL::to('/') }}"><button type="button" name="plantrip" class="btnTripPlan">Plan my Trip</button></a>
						</div>
					</div>
				</div>
			</div>

			<!-- lead cancelled -->
			<div class="tripTabContent" id="leadcancelled">
				@if(count($cancelled)>0)
				<div class="myBookingCont">
					@foreach($cancelled as $up)
					<?php 
						$originalDate = $up->tour_date;
						$now = time();
						$your_date = strtotime($originalDate);
						$datediff =  $your_date-$now;
						$diff_days=round($datediff / (60 * 60 * 24));

						if($originalDate=="N" || $originalDate==""):
						$originalDate=date("d-m-Y");
						endif;
										
						$datefrom = str_replace(' ', '', $originalDate);
						$datefrom=explode("-", $datefrom);
										
						$datefrom_year=$datefrom["2"];
						$datefrom_day=$datefrom["1"];
										
						$datefrom_month=$datefrom["0"];
						$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
								
						$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
						$stop_date = $datefrom;
						$date_to=$datefrom;
						$datefrom_print = date("d M Y", strtotime($datefrom));
						$day_from = strtotime($datefrom);
						$day_from = date('D', $day_from);
									
						$to_days=$up->duration-1;
									
						$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
						$stop_date_print= date("d M Y", strtotime($stop_date));
						$day_to = strtotime($stop_date);
						$day_to = date('D', $day_to);

						$quotation_ref_no=$up->quo_ref;

						$room_passenger_data=DB::table('rt_passengerinfo')->where('quotation_ref_no',$quotation_ref_no)->first();
						$passenger_ids=array();
						if($room_passenger_data!='') {
							$room_passenger=unserialize($room_passenger_data->room_passenger);
							foreach($room_passenger as $row=>$col) {
								foreach($col as $a=>$b) {
									foreach($b as $c=>$d) {
										$name=CustomHelpers::get_master_table_data('query_traveller','id',CustomHelpers::custom_decrypt($d),'firstname').' '.CustomHelpers::get_master_table_data('query_traveller','id',CustomHelpers::custom_decrypt($d),'lastname');array_push($passenger_ids,$name);
										}
									}
								}
							}
					?>
					<div class="myBookingList">
					<div class="myBkngServiceIcon"></div>
						<div class="flexBetween">
							<div class="flex-column">
								<div class="flexCenter">
									<div>
										<h2 class="myBookingTitle">{{$up->package_name}}</h2>
									</div>
									<div>
										<span class="myBookingUpcomingDays_tag">@if($diff_days<0) Departure Date Ended @else In {{$diff_days}} days @endif</span>
									</div>
								</div>
								<div class="myBookingRefId">
									<span>Booking ID&nbsp;-&nbsp;#{{ $up->quo_ref }}</span>
								</div>
							</div>
							<div class="manageBkngBox">
								<a href="{{url('Manage-Booking/'.$up->quo_ref)}}">
									<button type="button" name="managebooking" class="btnManageBooking">Manage booking</button>
								</a>
							</div>
						</div>
					</div>
					<!-- lead cancelled booking summary -->
					<div class="myBkngSummary">
						<div class="myBkngSummaryBox">
							<div class="summaryLeftPart">
								<div class="travelDtls">
									<p class="travelDtlsHead">DEPARTURE</p>
									<p class="travelDtlsDate"><?php echo "$day_from"; ?>, {{$datefrom_print}}</p>
									<p class="travelDtlsCity">{{$up->sourcecity}}</p>
								</div>
								<div class="travelDtls">
									<p class="travelDtlsHead">RETURN</p>
									<p class="travelDtlsDate"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
									<p class="travelDtlsCity">Sharjah</p>
								</div>
								<div class="bkngDtls">
									<div class="fa-cog appendBottom10">
										<span class="bkngDtlsDuration">{{ CustomHelpers::get_seperate_pass_payment_view($up->id,1,'room') }} Room(s), <?php $day_night=(int)filter_var($up->duration, FILTER_SANITIZE_NUMBER_INT); ?> {{ $day_night-1 }} Nights - {{ $day_night }} Days </span>
									</div>
									<div class="flexCenter">
										<div class="makeflex alignitemsEnd" style="width: ">
											<div class="travellerIcon">
												<span class="bigFace"></span>
												<span class="bigBody"></span>
											</div>
											<div class="travellerIcon">
												<span class="smallFace"></span>
												<span class="smallBody"></span>
											</div>
										</div>
										<div class="bkngDtlsGuest">
											@if(count($passenger_ids)>0)
												{{ $passenger_ids[0] }} + {{ count($passenger_ids)-1 }}
												@else
												0
											@endif
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="summaryRightPart">
								<div class="appendBottom10 cursorPointer">Cancel Booking</div>
								<div class="cursorPointer">Change Tour Dates</div>
							</div> -->
						</div>
					</div>
					@endforeach
				</div>
				@else
				<div class="emptyTripBucket">
					<div class="bucketContainer">
						<div class="fa-suitcase fontSize60"></div>
						<div class="appendLeft40">
							<div class="appendBottom20">
								<p class="bucketTitle">You have no pending lead</p>
								<p class="bucketSubTitle">Great! Looks like you have no pending lead.</p>
							</div>
							<a href="{{ URL::to('/') }}"><button type="button" name="plantrip" class="btnTripPlan">Plan my Trip</button></a>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</section>

@endsection

@section("custom_js")

<!-- mytrips -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/userprofile.js") }}'></script>

<script type="text/javascript">

</script>

<script>
// home->mybooking
$(window).load(function() {
    // Disable CTRL Mouse Click    
    $('a').click(function (e) {
    	if (e.ctrlKey) {
    		return false;
    		}
    	})

    // Disable SHIFT Mouse Click    
    $('a').click(function (e) {
    	if (e.shiftKey) {
    		return false;
    		}
    	})
	})
</script>
@endsection