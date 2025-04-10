@extends('layouts.master')

@section('custom_css_code')

	<!-- lead manager css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/backend/css/lead-manager.css') }}" />

	<!-- enquiry timeline CSS -->
	<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/enquiry-timeline.css') }}" />

	<!-- lead modal CSS -->
	<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/lead-validation.css') }}" />

	<!-- JS modal pop-up -->
	<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/modal-popup.css') }}" />

@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box autoScroll">
					<div class="box-header">
						<h3 class="box-title">
						<!-- query-quotation page -->
						@if($val=='quote_sent')
							Quote Sent
							@elseif($val=='lead_follow_ups')
								Lead Follow-up 
							@elseif($val=='process_booking')
								Process Booking <span class="font16">(proceed to confirm services)</span>
							@elseif($val=='payment_follow_up')
								Payment Follow-up
							@elseif($val=='under_cancellation')
								Trip Under Cancellation
							@elseif($val=='confirmation')
								Issue Voucher <span class="font16">(Tour Confirmation)</span>
							@elseif($val=='voucher_issued')
								Trip Vouchers
							@elseif($val=='tour_cancelled')
								Trip Cancelled
							@elseif($val=='refund_issued')
								Process Refund <span class="font16">(Refund Issued)</span>
							@else
								Quotation List
						@endif
						</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						@if (\Session::has('message'))
						<div class="alert alert-success">
							<ul>
								<li>{!! \Session::get('message') !!}</li>
							</ul>
						</div>
						@endif

						<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
							<p>Query Deleted Successfully</p>
						</div>

						<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
							<ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
						</div>

						<div class="dashboard-outer-table">
						<table id="example1" class="table table-bordered table-striped example1">
							<thead>
								<tr>
									<!-- s.no. -->
									<th style="display: none">S.No.</th>

									<!-- quote reference no -->
									<th style="width: 135px">Reference No</th>

									<!-- guest details -->
									<th style="min-width: 180px">Guest Name,<br>Mobile No & Email id</th>

									<!-- travel date & nationality -->
									<th style="width: 150px">Travel Date,<br>Guests & Nationality</th>

									<!-- travel destination -->
									<th style="min-width: 180px">Destination & <br>Package Name</th>

									<!-- lead status -->
									<th style="width: 180px">Lead Status</th>

									<!-- quote status -->
									<th style="width: 180px">Quote status</th>

									<!-- last update & user -->
									<!-- <th style="min-width:80px">
									@if($val==='process_booking' || $val==='payment_follow_up' || $val==='under_cancellation' || $val==='confirmation' || $val==='voucher_issued' || $val==='tour_cancelled' ) 
										Payment
									@else
										Updated
									@endif 
									<br>Date & Time 
									</th> -->

									<!-- payment status -->
									<th style="width: 240px">Payment Status</th>
									
									<!-- action -->
									<th width="70px">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count="1"; ?>
								@foreach($data as $key=>$query)
									@if(CustomHelpers::get_query_field($query->query_reference,'status')=='' || 
									CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent" || CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up" || CustomHelpers::get_query_field($query->query_reference,'status')=="process_booking" || CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up" || CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation" || CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issue" || CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued" || CustomHelpers::get_query_field($query->query_reference,'status')=="issue_voucher" || CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled" || CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund" || CustomHelpers::get_query_field($query->query_reference,'status')=="refund_processed" || CustomHelpers::get_query_field($query->query_reference,'status')=="refund_under_process")
								<tr>
									<!-- s.no. -->
									<td style="display: none">{{ $count++ }}</td>

									<!-- quote reference no -->
									<td id={{$query->query_reference}}>
										<!-- enquiry reference no -->
										<div class="dashboard-inner-table">
										    <div><u><h5>Enquiry Reference No</h5></u></div>

										    {{-- Debugging output --}}
										    @php
										        //dd($query); // Dump the entire $query object to see its structure
										    @endphp

										    <!-- enquiry reference no -->
										    @if(isset($query->enq_ref_no))
										        <p class="q-dtls">
										        	{{ $query->enq_ref_no }}
										        </p>
										    @else
										        <p class="q-dtls">
										        	No enquiry id available.
										        </p>
										    @endif

										    <!-- service type -->
										    <p class="q-dtls">
										    	{{ $query->service_type ?? 'No service type available.' }}
										    </p>

										    <!-- channel type -->
										    <p class="q-dtls">
										    	{{ $query->channel_type ?? 'No channel type available.' }}
										    </p>
										</div>

										<!-- --------- -->

										<!-- quote reference no -->
										<div class="dashboard-inner-table">
											<div><u><h5>Quote Reference No</h5></u></div>
											@if(isset($query->quo_ref))
										        <p class="q-dtls">#{{ $query->quo_ref }}</p>
										    @else
										        <p class="q-dtls">No quote id available.</p>
										    @endif
										</div>

										<!-- --------- -->

										<div class="dashboard-inner-table">
											<u><h5>Payment Last updated</h5></u>
											@if($val==='process_booking' || $val==='payment_follow_up' || $val==='under_cancellation' || $val==='confirmation' || $val==='voucher_issued' || $val==='tour_cancelled' )
												<?php
													$latest_payment=DB::table('rt_payments')->where([['quote_ref_no','=',$query->quo_ref],['status','=',1],['transaction_type','=',0]])->latest()->first();
												?>
												<p class="q-dtls textCenter">{{ date('D',strtotime($latest_payment->created_at))}}, {{date("d M Y, H:i:s", strtotime($latest_payment->updated_at)) }}</p>
											@else
											<?php
												$newDate_flight = date("d M Y, H:i:s", strtotime($query->updated_at)); ?>
											<p class="q-dtls textCenter">{{date('D',strtotime($query->created_at))}}, {{$newDate_flight}}</p>
											@endif
										</div>
									</td>

									<!-- ********************** -->

									<!-- guest details -->
									<td>
										<div class="dashboard-inner-table">
											<div>
												<u><h5>Guest Details</h5></u>
											</div>
											<p class="q-dtls">{{ $query->name }}</p>
											@if($query->mobile!="")
												<p class="q-dtls">{{ $query->mobile }}</p>
											@endif
											<p class="q-dtls">{{ $query->email }}</p>
										</div>
									</td>

									<!-- ********************** -->

									<!-- travel date, no of guests & nationality -->
									<td>
										<div class="dashboard-inner-table">
											<div><u><h5>Travel Details</h5></u></div>

										<!-- travel date -->

										<!-- @if(CustomHelpers::get_query_field($query->query_reference,'date_arrival')!="N" && CustomHelpers::get_query_field($query->query_reference,'date_arrival')!="")
										<p class="q-dtls">
										<?php
											$date_arrival = CustomHelpers::get_query_field($query->query_reference,'date_arrival');
											$date_arrival = str_replace('/', '-', $date_arrival);
											//Explode the string into an array.
											$exploded = explode("-", $date_arrival);
											 
											//Reverse the order.
											$exploded = array_reverse($exploded);
											$newFormat = array_map('trim', $exploded);
											//Convert it back into a string.
											$newFormat = implode("-", $newFormat);

											$newFormat = date("d M Y", strtotime($newFormat));
											//Print it out.
											echo $newFormat;
										?>
										</p>
										@endif -->

										<!-- -- -->

										<!-- <p class="q-dtls">{{CustomHelpers::get_tour_date($query->tour_date)}}</p> -->

										<!-- -- -->

										<!-- travel date -->
										
											<p class="q-dtls">
												@if($query->date_arrival!="")
												<?php
													$date_arrival = CustomHelpers::get_query_field($query->query_reference,'date_arrival');
													$date_arrival = str_replace('/', '-', $date_arrival);
													//Explode the string into an array.
													$exploded = explode("-", $date_arrival);
													//Reverse the order.
													$exploded = array_reverse($exploded);
													$newFormat = array_map('trim', $exploded);
													//Convert it back into a string.
													$newFormat = implode("-", $newFormat);
													$newFormat = date("d M Y", strtotime($newFormat));
													//Print it out.
													echo $newFormat;
												?>
												@endif
											</p>

										<!-- --------- -->

										<!-- no of guests -->
										<p class="q-dtls">
											<?php
											    $adult = 0;
											    $child_with_bed = 0;
											    $child_without_bed = 0;
											    $infant = 0;

											    if ($query->quote1_number_of_adult != '' && $query->quote1_number_of_adult != 0) {
											        $adult += (int) $query->quote1_number_of_adult;
											    }

											    if ($query->extra_adult != '' && $query->extra_adult != 0) {
											        $adult += (int) $query->extra_adult;
											    }

											    if ($query->solo_traveller != '' && $query->solo_traveller != 0) {
											        $adult += (int) $query->solo_traveller;
											    }

											    if ($query->child_with_bed != '' && $query->child_with_bed != 0) {
											        $child_with_bed += (int) $query->child_with_bed;
											    }

											    if ($query->child_without_bed != '' && $query->child_without_bed != 0) {
											        $child_without_bed += (int) $query->child_without_bed;
											    }

											    if ($query->infant != '' && $query->infant != 0) {
											        $infant += (int) $query->infant;
											    }
											?>

											@if($adult != "" && $adult != "0")
											    @php
											        $adultText = $adult == 1 ? 'Adult' : 'Adults';
											    @endphp
											    {{$adult}} {{$adultText}}
											@endif

											@if($child_with_bed != "" && $child_with_bed != "0")
											    @php
											        $childWithBedText = $child_with_bed == 1 ? 'Child (with bed)' : 'Children (with bed)';
											    @endphp
											    + {{$child_with_bed}} {{$childWithBedText}}
											@endif

											@if($child_without_bed != "" && $child_without_bed != "0")
											    @php
											        $childWithoutBedText = $child_without_bed == 1 ? 'Child (without bed)' : 'Children (without bed)';
											    @endphp
											    + {{$child_without_bed}} {{$childWithoutBedText}}
											@endif

											@if($infant != "" && $infant != "0")
											    @php
											        $infantText = $infant == 1 ? 'Infant' : 'Infants';
											    @endphp
											    + {{$infant}} {{$infantText}}
											@endif
										</p>

										<!-- --------- -->

										<!-- nationality -->
										@if($query->nationality!="")
											<p class="q-dtls">{{ $query->nationality }}</p>
										@endif
										</div>
									</td>

									<!-- ********************** -->

									<!-- travel destination -->
									<td>
										<div class="dashboard-inner-table">

											<!-- destination -->
											@if(is_numeric((int) $query->query_reference))
											    <div><u><h5>Destination</h5></u></div>
											    @php  
											        $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
											        $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', $packageId, 'city');

											        if ($cities === false || $cities === null || !is_string($cities)) {
											            Log::error('Invalid serialized data from helper function.');
											            $cities = [];
											        } else {
											            try {
											                $cities = unserialize($cities);
											                if ($cities === false && $cities !== 'b:0;') {
											                    Log::error('Unserialize returned false for non-empty data.');
											                    $cities = [];
											                }
											            } catch (Exception $e) {
											                Log::error('Unserialize error: ' . $e->getMessage());
											                $cities = [];
											            }
											        }

											        if (!is_array($cities)) {
											            Log::error('Unserialized data is not an array.');
											            $cities = [];
											        }
											    @endphp

											    @if(!empty($cities))
											        <ul class="q-dtls">
											            @foreach($cities as $c)
											                <li>{{ $c }}</li>
											            @endforeach
											        </ul>
											    @elseif(!empty($query->destinations))
											        <ul class="q-dtls">
											            <li>{{ $query->destinations }}</li>
											        </ul>
											    @else
											        <p class="q-dtls">No destination available</p>
											    @endif

											@else
											    @if(!empty($query->destinations))
											        <p class="q-dtls">{{ $query->destinations }}</p>
											    @else
											        <p class="q-dtls">No destinations available.</p>
											    @endif
											@endif

											<!-- --------- -->

											<!-- tour name & link -->
											<!-- @if(CustomHelpers::get_query_field((int)$query->query_reference, 'packageId') != "N" && 
											    CustomHelpers::get_query_field((int)$query->query_reference, 'packageId') != "" && 
											    is_numeric((int)CustomHelpers::get_query_field((int)$query->query_reference, 'packageId')) &&
											    !empty($query->package_name)) !-- Check if package name is not empty --
											    <div class="pdngTop7"><u><h5>Tour Name</h5></u></div>
											    <p class="q-dtls">
											        <a href="{{ url('/Holidays/'.str_slug($query->package_name).'?package_id='.CustomHelpers::custom_encrypt((int)CustomHelpers::get_query_field((int)$query->query_reference, 'packageId'))) }}" target="_blank">
											        {{ $query->package_name }}</a>
											    </p>
											@endif -->

											<!-- tour name & link -->
											<!-- @if(is_numeric((int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId')) && 
											    !empty($query->package_name)) !-- Check if package name is not empty --
											    @php
											        $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
											        $href_id = CustomHelpers::custom_encrypt($packageId);
											        $form_action = url('/Holidays/' . str_slug($query->package_name)) . '?package_id=' . $href_id;
											    @endphp
											    <div class="pdngTop7"><u><h5>Tour Name</h5></u></div>
											    <p class="q-dtls">
											        <a href="{{ $form_action }}" target="_blank">
											            {{ $query->package_name }}
											        </a>
											    </p>
											@endif -->

											<!-- tour name & link -->
											@if(is_numeric((int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId')))
											    @php
											        $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
											        $packageName = $query->package_name;
											        $href_id = CustomHelpers::custom_encrypt($packageId);
											        $form_action = url('/Holidays/' . str_slug($packageName)) . '?package_id=' . $href_id;
											    @endphp

											    @if(!empty($packageName)) <!-- Check if package name is not empty -->
											        <div class="pdngTop7"><u><h5>Tour Name</h5></u></div>
											        <p class="q-dtls">
											            <a href="{{ $form_action }}" target="_blank">
											                {{ $packageName }}
											            </a>
											        </p>
											    @else
											        <div class="pdngTop7"><u><h5>Source</h5></u></div>
											        <p class="q-dtls">
											            Quick enquiry
											        </p>
											    @endif

											@else
											    <p class="q-dtls">{{ $query->packageId }}</p>
											@endif

										</div>
									</td>

									<!-- ********************** -->
									
									<!-- lead status -->
									<td id={{ $query->query_reference }}>
										<div class="dashboard-inner-table textCenter">

											<div><u><h5>Update status</h5></u></div>

											<select class="query_status q-select">
												@if($val=='process_booking' || $val=='payment_follow_up' || $val=='under_cancellation' || $val=='confirmation' || $val=='voucher_issued' || $val=='tour_cancelled' || $val=='refund_issued')
												<?php
													$quote_no=CustomHelpers::get_query_field($query->query_reference,'accept_quote_no');
													$quote_id=CustomHelpers::get_query_field($query->query_reference,'accept_quote_id');

													if($quote_no==1) {
												        $data=DB::table('option1_quotation')->where('id',(int)$quote_id)->first();
												        $quote_ref_no=$data->quo_ref;
												        $price=$data->option1_price;
												        $price_data=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
												        } elseif($quote_no==2) {
													        $data=DB::table('option2_quotation')->where('id',(int)$quote_id)->first();
													        $quote_ref_no=$data->quotation_ref_no;
													        $price=$data->option2_price;
												        } elseif($quote_no==3) {
												        	$data=DB::table('option3_quotation')->where('id',(int)$quote_id)->first();
												        	$quote_ref_no=$data->quotation_ref_no;
												        	$price=$data->option3_price;
												        } elseif($quote_no==4) {
												        	$data=DB::table('option4_quotation')->where('id',(int)$quote_id)->first();
												        	$quote_ref_no=$data->quotation_ref_no;
												        	$price=$data->option4_price;
												        }
														$amount=$price_data['query_pricetopay_adult'];
														$due_amount=CustomHelpers::get_remaining_due($quote_ref_no,$amount);
														$pg_charge=CustomHelpers::get_pg_charge($quote_ref_no);
												?>
												@endif
				                             
				                              	@if($val=='quote_sent')

													<option value="quote_sent" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent") selected @endif>Quote Sent</option>

													<option value="lead_follow_up" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up") selected @endif>Lead Follow-up</option>

													<option value="lead_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_cancelled") selected @endif>Lead Cancelled</option>

												@elseif($val=='lead_follow_ups')

													<option value="lead_follow_up" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up") selected @endif>Lead Follow-up</option>

													<option value="lead_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_cancelled") selected @endif>Lead Cancelled</option>

												@elseif($val=='process_booking')

													<option value="process_booking" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_booking") selected @endif>Process Booking</option>

													<option value="payment_follow_up" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up") selected @endif>Payment Follow-up</option>

													<option value="issue_voucher" @if($due_amount>0) disabled @endif>Issue Voucher</option>

													<option value="under_cancellation" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation") selected @endif>Under Cancellation</option>

													<option value="tour_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled") selected @endif>Tour Cancelled</option>

												@elseif($val=='payment_follow_up')

													<option value="payment_follow_up" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up") selected @endif>Payment Pending</option>

													<option value="payment_follow_up">Add Payment Follow-up</option>

													<option value="issue_voucher" @if($due_amount>0) disabled @endif>Issue Voucher</option>

													<option value="under_cancellation" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation") selected @endif>Under Cancellation</option>

													<option value="tour_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled") selected @endif>Tour Cancelled</option>

												@elseif($val=='under_cancellation')

													<option value="under_cancellation" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation") selected @endif>Under Cancellation</option>
													<option value="issue_voucher" @if($due_amount>0) disabled @endif>Issue Voucher</option>

													<option value="tour_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled") selected @endif>Tour Cancelled</option>

												@elseif($val=='confirmation')

													<option value="issue_voucher" disabled @if($due_amount>0) disabled @else @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="issue_voucher") selected @endif @endif>Voucher Pending</option>

													<option value="voucher_issued" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued") selected @endif>Tour Vouchers Issued</option>

													<option value="under_cancellation" disabled @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation") selected @endif>Under Cancellation</option>

													<option value="tour_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled") selected @endif>Tour Cancelled</option>

												@elseif($val=='voucher_issued')

													<option value="voucher_issued" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued") selected @endif>Vouchered</option>

													<option value="tour_completed" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_completed") selected @endif>Tour Completed</option>

													<option disabled value="under_cancellation" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation") selected @endif>Under Cancellation</option>

													<option value="tour_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled") selected @endif>Tour Cancelled</option>

												@elseif($val=='tour_cancelled')

													<option value="tour_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled") selected @endif>Tour Cancelled</option>
													<!-- <option value="process_refund" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund") selected @endif>Process Refund</option> -->

													<option value="refund_under_process" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="refund_under_process") selected @endif>Refund Under Process</option>

												@elseif($val=='refund_issued')

													<!-- <option value="process_refund" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund") selected @endif>Process Refund</option> -->
													<?php 
														$refunded_amounts=CustomHelpers::get_refunded_amount($query->quo_ref);
													?>
													<option value="refund_processed" @if($refunded_amounts==0) disabled @endif  @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="refund_processed") selected @endif>Refund Processed</option>

													<option value="refund_under_process" @if($refunded_amounts>0) disabled @endif @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="refund_under_process") selected @endif>Refund Under Process</option>

												@else
													<option value="quote_sent" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent") selected @endif>Quote Sent</option>

					                                <option value="lead_follow_up" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_follow_up") selected @endif>Lead Follow-up</option>

					                                <!-- <option value="follow_up_pending" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="follow_up_pending") selected @endif>Follow-up Pending</option> -->

					                                <option value="process_booking" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_booking") selected @endif>Process Booking</option>

					                                <!-- <option value="booking_confirmed" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="booking_confirmed") selected @endif>Booking Confirmed</option> -->

					                                <option value="payment_follow_up" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up") selected @endif>Payment Follow-up</option>   

													<option value="under_cancellation" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="under_cancellation") selected @endif>Under Cancellation</option>

													<option value="issue_voucher" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="issue_voucher") selected @endif>Issue Voucher</option>

													<option value="voucher_issued" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="voucher_issued") selected @endif>Voucher Issued</option>

													<option value="tour_completed" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_completed") selected @endif>Tour Completed</option>

													<option value="send_review_form" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="send_review_form") selected @endif>Send Review Form</option>

													<option value="tour_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled") selected @endif>Tour Cancelled</option>

													<option value="process_refund" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="process_refund") selected @endif>Process Refund</option>

													<option value="refund_processed" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="refund_processed") selected @endif>Refund Processed</option>

													<option value="lead_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="lead_cancelled") selected @endif>Lead Cancelled</option>

													<option value="na" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="na") selected @endif>Not Applicable</option>
												@endif
											</select>

											<!-- --------- -->

											<!-- add remarks -->
											@if($val!='refund_issued')
												<!-- add remarks into lead -->
												<button class="btn-backend-main btnInfo submit_status" data-id="{{ $query->id }}">Add Lead Remarks</button>
											@endif
										</div>

										<!-- --------- -->

										<!-- resend quote -->
										<!-- refund issued -->
										@if($val!='refund_issued')
											<div class="dashboard-inner-table textCenter">
				               					<div><u><h5>Resend Quote</h5></u></div>
												<!-- <div class="q-box textCenter"> -->
												<select class="q-select">
													<option id="0" quotation_no='0' ref_no='0'>Select Quote</option>
													{{ CustomHelpers::get_quotation_option($query->quo_ref) }}
												</select>
												<button class="btn-backend-main btnInfo quotation_send">Email Quote</button>
											</div>
										@endif

										<!-- --------- -->

										<!-- lead follow-up -->
										@if($val=='lead_follow_ups')
											<?php 
												$lead_follow_up_data=DB::table('enquiry_lead_follow_up')->where('enquiry_id',$query->query_reference)->latest()->first();
												$reason=DB::table('lead_dynamic_field')->where('id',$lead_follow_up_data->reason)->first();
											?>
											<div class="dashboard-inner-table apndTop7">
												<div><u><h5>Lead follow-up details</h5></u></div>
												<p class="q-dtls">Follow-up date: {{ date('d-m-Y', strtotime($lead_follow_up_data->follow_up_date)) }}</p>
												<p class="q-dtls">Follow-up time: {{ $lead_follow_up_data->follow_up_time }} hrs.</p>
												<p class="q-dtls">Reason: {{ $reason->field_name }}</p>
											</div>
										@endif

										<!-- *************************** -->

										<!-- assigned user -->
										<?php
											$user_data = DB::table('users')
												->where('id', $query->assign_id)
												->first();
										?>
										@if($user_data)
											<div class="dashboard-inner-table textCenter">
												<div><u><h5>Assigned Consultant</h5></u></div>
												<p class="q-user-name">{{ $user_data->first_name }} {{ $user_data->last_name }}</p>
											</div>
										@endif

										<!-- --------- -->

										<!-- payment follow-up -->
										@if($val=='payment_follow_up')
											<?php
												$lead_follow_up_data=DB::table('payment_follow_up')->where('enquiry_id',$query->query_reference)->latest()->first();
											?>
											<p>Follow up Date: {{date('d-m-Y', strtotime($lead_follow_up_data->follow_up_date))}}</p>
											<p>Follow up Time: {{$lead_follow_up_data->follow_up_time}}</p>
											<p>Remarks: {{$lead_follow_up_data->remarks}}</p>
										@endif
									</td>

									<!-- ********************** -->

									<!-- quote status -->
									<td id={{ $query->query_reference }}>
										<!-- booking label -->
										<div class="dashboard-inner-table">
											<table>
												<tr>
													<td><label>Lead Label</label></td>
													<td>
													  <div>
														<select class="q-select booking_label">
															@foreach($booking_lavel as $b_label)
																<option value="{{ $b_label->id }}" @if($query->booking_label==$b_label->id) selected @endif>{{ $b_label->field_name }}</option>
															@endforeach
														</select>
													  </div>
													</td>
												</tr>
											</table>
										</div>

										<!-- --------- -->

										<!-- quote view -->
										<div class="dashboard-inner-table">
											<u><h5>Quote Viewed</h5></u>
											<table>
												<!--<thead>
													<tr>
														<th><u>Description</u></th>
														<th><u>Amount</u></th>
													</tr>
												</thead>-->
												<tbody>
												<tr class="makeflex">
													<td class="flexOne">
														@if($query->send_option=='0' && $query->accept_status=='0')
														<p class="q-sendbox">Not Sent</p>
														@elseif($query->send_option=='1' && $query->accept_status=='0')
														<p class="q-noresponsebox">No Response</p>
														@elseif($query->send_option=='1' && $query->accept_status=='1')
														<p class="q-acceptancebox">Quote Accepted</p>
														@elseif($query->send_option=='0' && $query->accept_status=='1')
														<p class="q-acceptancebox">Quote Accepted</p>
														@elseif($query->send_option=='1' && $query->accept_status=='2')
														<p class="q-rejectionbox">Quote Rejected</p>
														@elseif($query->send_option=='0' && $query->accept_status=='2')
														<p class="q-rejectionbox">Quote Rejected</p>
														@endif
													</td>
													<td class="flexOne">
														@if($query->quote_view=='0')
														<p class="q-responsebox">Not Viewed</p>
														@else
														<p class="q-responsebox">Viewed</p>
														@endif
													</td>
												</tr>
												</tbody>
											</table>
										</div>

										<!-- --------- -->

										<!-- quote raise concern -->
										<?php 
											$check_raise_concern=DB::table('quote_raise_concern')->where('query_reference',(int)$query->query_reference)->get();
											$pending=DB::table('quote_raise_concern')->where([['query_reference',(int)$query->query_reference],['status',0]])->get();
											$open=DB::table('quote_raise_concern')->where([['query_reference',(int)$query->query_reference],['status',1]])->get();
										?>
										@if(count($pending)>0)
										<?php 
											$btn_class='btn-danger';
										?>

										@elseif(count($pending)==0 && count($open)>0)
										<?php 
											$btn_class='btn-warning';
										?>

										@else
										<?php 
											$btn_class='btn-success';
										?>
										@endif

										<!-- --------- -->

										<!-- update guest concern -->
										<?php 
										    // Retrieve all concerns related to the current query reference
										    $check_raise_concern = DB::table('quote_raise_concern')
										        ->where('query_reference', (int)$query->query_reference)
										        ->get();

										    // Retrieve pending concerns (status = 0) for the current query reference
										    $pending = DB::table('quote_raise_concern')
										        ->where([
										            ['query_reference', (int)$query->query_reference],
										            ['status', 0]
										        ])->get();

										    // Retrieve open concerns (status = 1) for the current query reference
										    $open = DB::table('quote_raise_concern')
										        ->where([
										            ['query_reference', (int)$query->query_reference],
										            ['status', 1]
										        ])->get();

										        if (count($pending) > 0) {
											        $btn_class = 'btn-request-pending';
											        $btn_name = 'Pending Requests';
											    } elseif (count($pending) == 0 && count($open) > 0) {
											        $btn_class = 'btn-request-open';
											        $btn_name = 'Active Requests';
											    } else {
											        $btn_class = 'btn-request-closed';
											        $btn_name = 'View Requests';
											    }
										?>

										<!-- Display the button if there are any concerns related to the query reference -->
										@if(count($check_raise_concern) > 0)
										<div class="dashboard-inner-table textCenter">
											<div><u><h5>Guest Requests</h5></u></div>
										    <button class="btn-backend-main {{ $btn_class }} view_raise raise_btn_class{{ (int)$query->query_reference }}" data-id="{{ (int)$query->query_reference }}">
										        {{ $btn_name }}
										    </button>
										</div>
										@endif

										<!-- --------- -->

										<!-- enquiry timeline -->
										<div class="dashboard-inner-table textCenter">
											<div><u><h5>Enquiry Timeline</h5></u></div>
											<button class="btn-backend-main btnInfo view_history" data-id="{{ $query->query_reference }}">View History</button>
										</div>

										<!-- --------- -->

										<!-- last update & user -->

										<!-- Quote last update date & time -->
										<!-- <div class="dashboard-inner-table">
											<u><h5>Last updated at</h5></u>
										<div class="q-box">
											<?php $last_updated_at = date("d M Y, H:i:s", strtotime($query->updated_at)); ?>
											<p class="q-dtls textCenter">{{ date('D',strtotime($query->created_at)) }}, {{ $last_updated_at }}</p>
										</div>
										</div> -->
									</td>

									<!-- ********************** -->

									<!-- payment status -->
									<td id={{ $query->query_reference }}>
										<!-- payment details starts -->
										@if($val=='process_booking' || $val=='payment_follow_up' || $val=='under_cancellation' || $val=='confirmation' || $val=='voucher_issued' || $val=='tour_cancelled' || $val=='refund_issued')
											<?php
												$main_paid=(int)$amount-(int)$due_amount;
											?>
											<div class="dashboard-inner-table">
												<u><h5>Payment Details</h5></u>
												<table>
													<thead>
														<tr>
															<th><u>Description</u></th>
															<th><u>Amount</u></th>
														</tr>
													</thead>
													<tbody>
													<tr>
														<td>Service total</td>
														<td><span class="defaultCurencyPay"></span> {{ $amount }}</td>
													</tr>
													<tr>
														<td style="color: green;">Amt received (-)</td>
														<td style="color: green;"><span class="defaultCurencyPay"></span> <b>{{ $main_paid }}</b></td>
													</tr>
													<tr>
														<td style="color: red;">Amt pending</td>
														<td style="color: red;"><span class="defaultCurencyPay"></span> <b>{{ $due_amount }}</b></td>
													</tr>
													<tr>
														<td style="color: grey;">MDR fees (+)</td>
														<td style="color: grey;"><span class="defaultCurencyPay"></span> {{ $pg_charge }}</td>
													</tr>
													<tr>
														<td>Total received</td>
														<td><span class="defaultCurencyPay"></span> {{ (int)$main_paid+(int)$pg_charge }}</td>
													</tr>
													</tbody>
												</table>
											</div>
										@endif

										<!-- --------- -->

										<!-- refund details -->
										@if($val=='refund_issued')
										<?php  
											$total_refundable_amount = DB::table('refund_create')
									       		->where('quote_ref_no','=',$query->quo_ref)
									       		->sum('refund_amount');

											$refunded_amounts=CustomHelpers::get_refunded_amount($query->quo_ref);
											$cancellation_charge=DB::table('refund_create')
									       		->where('quote_ref_no','=',$query->quo_ref)
									       		->sum('cancellation_charge');
											$due_refund_amount=(int)$total_refundable_amount-(int)$refunded_amounts;
										?>
										<div class="dashboard-inner-table">
											<u><h5>Refund Details</h5></u>
											<table>
												<thead>
													<tr>
														<th><u>Description</u></th>
														<th><u>Amount</u></th>
													</tr>
												</thead>
												<tbody>
												<tr>
													<td>Service total</td>
													<td><span class="defaultCurencyPay"></span> {{ $amount }}</td>
												</tr>
												<tr>
													<td style="color: green;">Cancellation charges (-)</td>
													<td style="color: green;"><span class="defaultCurencyPay"></span> <b>{{ $cancellation_charge }}</b></td>
												</tr>
												<tr>
													<td>Refundable Amount</td>
													<td><span class="defaultCurencyPay"></span> {{ $total_refundable_amount }}</td>
												</tr>
												<tr>
													<td style="color: grey;">Amt refunded (-)</td>
													<td style="color: grey;"><span class="defaultCurencyPay"></span> <b>{{ $refunded_amounts }}</b></td>
												</tr>
												<!-- <tr>
													<td style="color: grey;">MDR fees (NRF)</td>
													<td style="color: grey;"><span class="defaultCurencyPay"></span> {{ $pg_charge }}</td>
												</tr> -->
												<tr>
													<td style="color: red;">Refund pending</td>
													<td style="color: red;"><span class="defaultCurencyPay"></span> {{ $due_refund_amount }}</td>
												</tr>
												</tbody>
											</table>
										</div>
										@endif

										<!-- --------- -->

										<!-- Add payment/refund -->
										<div class="dashboard-inner-table">
											<div><u><h5>Add Payment</h5></u></div>
											<table>
												<tr>
													<!-- <td><h5>Payment status</h5></td> -->
													<td>
														<select class="q-select quote_no" @if($val==='refund_issued') style="display:none;" @endif>
															<option id="0" quotation_no='0' ref_no='0'>Select Quote</option>
															@if($val==='process_booking' || $val==='payment_follow_up' || $val==='under_cancellation' || $val==='confirmation' || $val==='voucher_issued' || $val==='tour_cancelled'  || $val==='refund_issued')
																<option id="{{CustomHelpers::get_query_field($query->query_reference,'accept_quote_id')}}" selected quotation_no="{{CustomHelpers::get_query_field($query->query_reference,'accept_quote_no')}}" ref_no="{{ $query->query_reference }}">Quote{{CustomHelpers::get_query_field($query->query_reference,'accept_quote_no')}}</option>
															@else
																{{CustomHelpers::get_quotation_option($query->quo_ref)}}
															@endif
														</select>
													</td>
													<td>
													  <div>
														<select class="payment_status q-select">
															@if($val=='quote_sent' || $val=='lead_follow_ups')
																<option value="Unpaid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="") selected @endif> Unpaid</option>

																<option value="Add Payment">Add Payment</option>

															@elseif($val=='process_booking')
																<option value="Partial Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Partial Paid") selected @endif> Partial Paid</option>

																<option value="Full Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid") selected @endif> Full Paid</option>

																<option value="Add Payment"> Add Payment</option>

															@elseif($val=='payment_follow_up')
																<option value="Partial Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Partial Paid") selected @endif> Partial Paid</option>

																<option value="Full Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid") selected @endif> Full Paid</option>
															
																<option value="Add Payment"> Add Payment</option>

															@elseif($val=='under_cancellation')

																<option value="Partial Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Partial Paid") selected @endif> Partial Paid</option>

																<option value="Full Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid") selected @endif> Full Paid</option>

																<option value="Refund Partial Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Partial Paid") selected @endif> Refund Partial Paid</option>

																<option value="Refund Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Paid") selected @endif> Refund Paid</option>

																<option value="Not Applicable" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Not Applicable") selected @endif> Not Applicable</option>

															@elseif($val=='confirmation')

																<option value="Full Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid") selected @endif> Full Paid</option>

															@elseif($val=='voucher_issued')

																<option value="Full Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid") selected @endif> Full Paid</option>

															@elseif($val=='tour_cancelled')

																<option value="Refund Unpaid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Unpaid") selected @endif> Refund Unpaid</option>

															@elseif($val=='refund_issued')
																<?php
																	$refund_status=CustomHelpers::check_refund_status($query->quo_ref,$amount);
																?>
																<option value="Refund Payment" @if($refund_status==0) disabled @endif > Refund Payment</option>
															
																<option value="Refund Partial Paid" @if($refund_status==0) disabled @else @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Partial Paid") selected @endif @endif> Refund Partial Paid</option>

																<option value="Refund Full Paid" @if($refund_status==0) disabled @else @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Full Paid") selected @endif @endif> Refund Full Paid</option>
															
																<option value="Refund Create" @if($refund_status==0) selected @endif > Refund Create</option>
															
															@else
																<option value="Unpaid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="") selected @endif> Unpaid</option>

																<option value="Partial Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Partial Paid") selected @endif> Partial Paid</option>

																<option value="Full Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Full Paid") selected @endif> Full Paid</option>

																<option value="Refund Unpaid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Unpaid") selected @endif> Refund Unpaid</option>

																<option value="Refund Partial Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Partial Paid") selected @endif> Refund Partial Paid</option>

																<option value="Refund Paid" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Refund Paid") selected @endif> Refund Paid</option>

																<option value="Not Applicable" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Not Applicable") selected @endif> Not Applicable</option>

																<option value="Payment Failed" @if(CustomHelpers::get_query_field($query->query_reference,'payment_status')!="N" && CustomHelpers::get_query_field($query->query_reference,'payment_status')=="Payment Failed") selected @endif> Payment Failed</option>
															
															@endif
														</select>
													  </div>
													</td>
												</tr>
												<tr>
												</tr>
											</table>

											<!-- add payment -->
											<button type="button" class="btn-backend-main btnInfo submit_payment_status" data-id="{{ $query->id }}">Add Payment</button>
										</div>
									</td>

									<!-- *************************** -->

									<!-- lead action -->
									<td>
										<!-- view quote -->
										<!-- <input type="hidden" class="unique_code" value="{{ CustomHelpers::custom_encrypt($query->unique_code) }}"> -->
										<a href="{{ url('/quotes/'.$query->unique_code) }}" target="_blank">
											<div class="btnContainer">
												<button type="submit" class="btn-q btn-view-quote" data-id="{{$query->id}}">View Quote</button>
											</div>
										</a>

										<!-- --------- -->

										<!-- WhatsApp copy -->
										<div class="btnContainer">
											<button type="button" class="btn-q btn-whatsapp">WhatsApp</button>
										</div>

										<!-- --------- -->

										<!-- copy quote link -->
										<div class="btnContainer">
											<input type="hidden" value="{{url('/quotes/'.$query->unique_code)}}" id="copy{{$query->id}}">
											<button type="submit" class="btn-q btn-copylink link" link="copy{{$query->id}}">Copy Quote Link</button>
										</div>

										<!-- --------- -->

										<!-- extend validity -->
										<div class="btnContainer">
											<!-- <button type="button" class="btn-q btn-validity open-extendValidityModal" data-id="{{ $query->query_reference }}" data-toggle="modal">Extend Validity</button> -->
											<!-- <button type="button" class="btn-q btn-validity open-extendValidityModal" data-id="" data-toggle="modal" data-target="#extendValidityModal"> -->
											<button type="button" class="btn-q btn-validity open-extendValidityModal" query_id="{{$query->quo_ref}}">Extend Validity</button>
										</div>

										<!-- --------- -->

										<!-- email to supplier -->
										<a href="{{ url('send_supplier_email/'.$query->quo_ref) }}" target="_blank">
											<div class="btnContainer">
												<button type="button" class="btn-q btn-viewlead" query_id="{{ $query->query_reference }}">Email to Supplier</button>
											</div>
										</a>

										<!-- --------- -->

										<!-- voucher upload -->
										@if($val=='voucher_issued')
											<?php 
												$check_uploaded_files=DB::table('lead_voucher')->where('lead_id',$query->query_reference)->get();
											?>
											@if(count($check_uploaded_files)>0)
											<div class="btnContainer">
												<button type="submit" class="btn-q btnSuccess send_voucher" data-id="{{ $query->query_reference }}" data-toggle="modal">Upload Voucher</button>
											</div>
											@endif
										@endif

										<!-- --------- -->

										<!-- add trip service -->
										@if($val=='process_booking' || $val=='payment_follow_up' || $val=='under_cancellation'  || $val=='voucher_issue' || $val=='confirmation'  || $val=='voucher_issued'|| $val=='tour_cancelled' || $val=='refund_issued' )

											 <!-- Service Type Button -->
											<div class="btnContainer">
												<button type="button" class="btn-q btn-editquote service_sype" query_id="{{ $query->query_reference }}">Service Type</button>
											</div>

											<!-- --------- -->

											<!-- Payment History Button -->
											<div class="btnContainer">
												<button type="button" class="btn-q btn-payment-ledger payment_history" query_id="{{$query->quo_ref}}">Payment Ledger</button>
											</div>

										@else

											<!-- Edit Quote Button -->
											<?php
											    $travel_date = $query->tour_date;
											    $today = date('Y-m-d');
											?>

											@if($travel_date >= $today)
												<!-- Edit Quote Button (Active) -->
											    <a href="{{ URL::to('/edit_quation/' . $query->quo_ref . '/' . $query->query_reference) }}">
											        <div class="btnContainer">
											            <button type="button" class="btn-q btn-editquote">Edit Quote</button>
											        </div>
											    </a>
											@else
												<!-- Edit Quote Button (Expired and Disabled) -->
											    <a href="#">
											    	<div class="btnContainer">
											        	<button type="button" class="btn-q btn-trip-expired" disabled>Edit Quote (expired)</button>
											        </div>
											    </a>
											@endif
										@endif

										<!-- --------- -->

										<!-- Add/Edit Guests -->
										<div class="btnContainer">
											<input type="hidden" class="unique_code" value="{{ CustomHelpers::custom_encrypt($query->unique_code) }}">
											<button type="button" class="btn-q btn-viewlead add_edit_passenger" content_action="{{ route('add_edit_passenger') }}">Traveller</button>
										</div>

										<!-- --------- -->

										<!-- view lead -->
										<div class="btnContainer">
											<button type="button" class="btn-q btn-viewlead open-enquiryModal" data-id="{{ $query->query_reference }}" data-toggle="modal">View Lead</button>
										</div>

										<!-- --------- -->

										<!-- delete lead -->
										@if(Sentinel::check())
										@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
											<form style="float: unset !important" action="{{ URL::to('/detele_query/'.$query->id) }}" onsubmit="return confirm('Are you sure, you want to remove this lead?');" method="POST">
												{{csrf_field()}}
												<div class="btnContainer">
													<button type="submit" class="btn-q btn-delete deletePackage">Delete</button>
												</div>
											</form>
										@endif
										@endif

										<!-- --------- -->

										<!-- lead date & time -->
										<div class="dashboard-inner-table">
											<u><h5>Lead Generated</h5></u>
											<?php
												$lead_date_time = date("d M Y, H:i:s", strtotime($query->created_at));
											?>
											<p class="q-dtls textCenter">{{ $lead_date_time }}, ({{ date('D',strtotime($query->created_at)) }})</p>
										</div>									

										<!-- --------- -->

										<!-- lead last update date & time -->
										<div class="dashboard-inner-table">
											<u><h5>Lead Last updated</h5></u>
											<?php
												$last_updated_at = date("d M Y, H:i:s", strtotime($query->updated_at));
											?>
											<p class="q-dtls textCenter">{{ $last_updated_at }}, ({{ date('D',strtotime($query->created_at)) }})</p>
										</div>
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
	</div>

	<form action="{{ URL::to('/send_custom_quote') }}" method="POST" id="send_custom_quote">
		{{ csrf_field() }}
		<input type="hidden" name="quote_id" id="quote_id" value="0">
		<input type="hidden" name="quote_no" id="quote_no" value="0">
		<input type="hidden" name="ref_no" id="ref_no" value="0">
	</form>

	<div class="testing">
		<input type="hidden" value="{{ url('/') }}" name="" id="test">
	</div>

	<!-- Update Lead Status Modal -->
	@include('query.query_modal.modal-popup.lead_follow_up')
	@include('query.query_modal.modal-popup.lead-cancelled')
	@include('query.query_modal.modal-popup.add-payment')
	@include('query.query_modal.modal-popup.service-status')
	@include('query.query_modal.modal-popup.payment_follow_up')
	@include('query.query_modal.modal-popup.refund-payment')
	@include('query.query_modal.modal-popup.tour-cancelled')
	@include('query.query_modal.modal-popup.refund-process')
	@include('query.query_modal.modal-popup.issue-voucher')
	@include('query.query_modal.modal-popup.refund_create')
	@include('query.query_modal.modal-popup.under_cancellation')


	<!-- ******************** -->

	<!-- Lead Action Modal -->

	<!-- open enquiry modal -->
	@include('query.query_modal.modal-popup.action-modal.view-enquiry-details')

	<!-- view lead history modal -->
	@include('query.query_modal.modal-popup.action-modal.view-enquiry-timeline')

	<!-- extend validity modal -->
	@include('query.query_modal.modal-popup.action-modal.extend-validity')

	<!-- view raised concern modal -->
	@include('query.query_modal.modal-popup.action-modal.edit-raised-concern')

	<!-- payment history (ledger) modal -->
	@include('query.query_modal.modal-popup.action-modal.view-payment-history')

	<!-- upload & send voucher modal -->
	@include('query.query_modal.modal-popup.action-modal.upload-send-voucher')

	<!-- voucher list modal -->
	@include('query.query_modal.modal-popup.action-modal.voucher-list')

	<!-- send voucher modal -->
	@include('query.query_modal.modal-popup.action-modal.send-voucher')

	<!-- resend voucher modal -->
	@include('query.query_modal.modal-popup.action-modal.resend-voucher')

@endsection

@section('custom_js_code')

	<!-- page script -->
	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/view-history-view-lead.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/concern-raised.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/extend-validity.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/capture-date-time.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/send-vouchers.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/edit-passengers.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/view-payment-history.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/send-quotation.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/collapsible.js") }}'></script>

	<!-- *********************************************** -->

	<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("click",".details",function() {
			$(this).siblings("form").attr('target', '_blank')
			$(this).siblings("form").submit()
			});
	});
	</script>

	<!-- collapsible script (not working for service type) -->
	<!-- <script type="text/javascript">
	//collapsible button script
		var coll = document.getElementsByClassName("collapsible");
		var i;

		for (i = 0; i < coll.length; i++) {
			coll[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var contents = this.nextElementSibling;
				if (contents.style.maxHeight){
					contents.style.maxHeight = null;
					}
				else {
					contents.style.maxHeight = contents.scrollHeight + "px";
					}
				});
			}
	</script> -->

<!-- <script type="text/javascript">
	/* Collapsible Button Script for Bootstrap Modal */
	$(document).ready(function () {
	    // Get all elements with the class "collapsible"
	    var coll = document.getElementsByClassName("collapsible");
	    var i;

	    // Loop through each collapsible element
	    for (i = 0; i < coll.length; i++) {
	        coll[i].addEventListener("click", function() {
	            // Toggle the "active" class to change button appearance
	            this.classList.toggle("active");

	            // Get the next sibling element which should be the content to show/hide
	            var contents = this.nextElementSibling;

	            // If the content is already expanded, collapse it by setting maxHeight to null
	            if (contents.style.maxHeight) {
	                contents.style.maxHeight = null;
	            } 
	            // Otherwise, expand the content by setting its maxHeight to its scrollHeight
	            else {
	                contents.style.maxHeight = contents.scrollHeight + "px";
	            }
	        });
	    }
	    
	    // Ensure collapsible elements work correctly within Bootstrap modals
	    $('#update_service_status').on('shown.bs.modal', function () {
	        var coll = document.getElementsByClassName("collapsible");
	        for (i = 0; i < coll.length; i++) {
	            var contents = coll[i].nextElementSibling;
	            if (coll[i].classList.contains("active")) {
	                contents.style.maxHeight = contents.scrollHeight + "px";
	            }
	        }
	    });
	});
</script> -->

<!-- <script type="text/javascript">
// Get all elements with the class name "accordion (collapsible)"
//document.addEventListener("DOMContentLoaded", function() {
    // Get all elements with the class name "accordion (collapsible)"
    var coll = document.getElementsByClassName("collapsible");

    // Iterate over each accordion element
    for (var i = 0; i < coll.length; i++) {
        // Add a click event listener to each accordion element
        coll[i].addEventListener("click", function() {
            // Toggle the "active" class on the clicked accordion
            this.classList.toggle("active");

            // Get the next sibling element (the panel) of the clicked accordion
            var contents = this.nextElementSibling;

            // Check if the panel is currently open
            if (contents.style.maxHeight) {
                // If open, close it by setting maxHeight to null
                contents.style.maxHeight = null;
            } else {
                // If closed, open it by setting maxHeight to its scroll height
                contents.style.maxHeight = 'inherit';
            }
        });
    }
//});
</script> -->

	<!-- *********************************************** -->

@endsection