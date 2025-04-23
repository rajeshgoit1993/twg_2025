@extends('layouts.master')

@section('custom_css_code')
<!-- lead manager css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/backend/css/lead-manager.css') }}" />

<!-- Lead Modal CSS -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/enquiry-timeline.css') }}" />

<!-- Lead Modal CSS -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/lead-validation.css') }}" />

<!-- js modal pop-up -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/modal-popup.css') }}" />

@endsection

<!-- *********************************************** -->

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
					<!-- savedquote-quotation page -->
					<h3 class="box-title">Quote Saved</h3>
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

								<!-- lead label -->
								<th style="width: 220px">Lead Label</th>

								<!-- action -->
								<th width="70px">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $count="1"; ?>
							@foreach($data as $key=>$query)
							<tr>
								<!-- s.no. -->
								<td style="display: none">{{ $count++ }}</td>
								
								<!-- enquiry & quote reference no -->
								<td>
									<!-- enquiry reference no -->
									<div class="dashboard-inner-table">
									    <div><u><h5>Enquiry Reference No</h5></u></div>

									    @if(isset($query->enquiry_ref_no))
									        <p class="q-dtls">{{ $query->enquiry_ref_no }}</p>
									    @else
									        <p class="q-dtls">No enquiry id available.</p>
									    @endif

									    <p class="q-dtls">{{ $query->service_type ?? 'No service type available.' }}</p>
									    <p class="q-dtls">{{ $query->channel_type ?? 'No channel type available.' }}</p>
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

									<!-- Quote last update date & time -->
									<div class="dashboard-inner-table">
										<u><h5>Quote Last updated</h5></u>
										<?php
											$last_updated_at = date("d M Y, H:i:s", strtotime($query->updated_at));
										?>
										<p class="q-dtls textCenter">{{ $last_updated_at }}, ({{ date('D',strtotime($query->created_at)) }})</p>
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
										<?php 
											$loged_user=Sentinel::getUser();

										?>
										@if($loged_user->lock_before_quote_send=='')
											@if($query->mobile!="")
												<p class="q-dtls">{{ $query->mobile }}</p>
											@endif
											<p class="q-dtls">{{ $query->email }}</p>
										@else
											@if($query->mobile!="")
											<p class="q-dtls">{{CustomHelpers::mask_mobile_no($query->mobile)}}</p>
											@endif

											<p class="q-dtls">{{CustomHelpers::partiallyHideEmail($query->email)}}</p>
										@endif
									</div>
								</td>

								<!-- ********************** -->

								<!-- travel date, guest & nationality -->
								<td>
									<div class="dashboard-inner-table">
										<div><u><h5>Travel Date</h5></u></div>
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
									<p class="q-dtls">{{CustomHelpers::get_tour_date($query->tour_date)}}</p>

									<!-- --------- -->

									<!-- no of guests -->
									<p class="q-dtls">
										<?php
										    $adult = 0;
										    $child_with_bed = 0;
										    $child_without_bed = 0;
										    $infant = 0;

										    if ($query->adult != '' && $query->adult != 0) {
										        $adult += (int) $query->adult;
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
										    <i>+ {{$child_with_bed}} {{$childWithBedText}}</i>
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
									<!--  -->
									</div>
								</td>

								<!-- ********************** -->

								<!-- destination & package name -->
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
										@if(is_numeric((int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId')))
										    @php
										        $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
										        $packageName = $query->title;
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

									<!-- <td>

										@if(is_numeric((int)$query->query_reference))
										    <?php  
										    $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)CustomHelpers::get_query_field((int)$query->query_reference, 'packageId'), 'city');

										    // Log the retrieved data for debugging
										    \Log::info("Retrieved cities data: ", ['cities' => $cities]);

										    // Initialize the citiesArray variable
										    $citiesArray = false;

										    // Check if the data is a valid serialized string
										    if (is_string($cities) && !empty($cities)) {
										        \Log::info("Cities data before unserialization: ", ['cities' => $cities]);
										        $citiesArray = @unserialize($cities);

										        // If unserialization fails, log the error
										        if ($citiesArray === false) {
										            \Log::error("Unserialization failed for cities data: ", ['cities' => $cities]);
										        } else {
										            \Log::info("Unserialization successful. Cities array: ", ['citiesArray' => $citiesArray]);
										        }
										    } else {
										        \Log::warning("Cities data is not a valid string or is empty.");
										    }
										    ?>

										    @if ($citiesArray !== false && is_array($citiesArray))
										        <ul class="q-dtls">
										            @foreach($citiesArray as $c)
										                <li>{{ $c }}</li>
										            @endforeach
										        </ul>
										    @else
										        <p class="pfwmt text-capitalize lineHeight15 padding-bottom10">{{ $query->destinations }}</p>
										    @endif
										@else
										    <p class="pfwmt text-capitalize lineHeight15 padding-bottom10">{{ $query->destinations }}</p>
										@endif

										
										@if(CustomHelpers::get_query_field((int)$query->query_reference,'packageId')!="N" && CustomHelpers::get_query_field((int)$query->query_reference,'packageId')!="" && is_numeric((int)CustomHelpers::get_query_field((int)$query->query_reference,'packageId')))
										
											<p class="pfwmt text-capitalize lineHeight15 padding-top10"><a href="{{url('/Holidays/'.str_slug($query->title).'?package_id='.CustomHelpers::custom_encrypt((int)CustomHelpers::get_query_field($query->query_reference,'packageId')))}}" target="_blank">
											{{$query->title}}
											</a></p>
										@endif
									</td> -->

								<!-- ********************** -->

								<!-- lead status -->
								<td id={{ $query->query_reference }}>
									<div class="dashboard-inner-table textCenter">
										<div><u><h5>Update status</h5></u></div>
										<select class="query_status q-select" disabled>
											<!-- <option value="0">Quote Preview</option> -->
											<option value="0" @if($query->status=="0") selected @endif>Quote Preview</option>
										</select>
										<button class="btn-backend-main btnInfo submit_status" data-id="{{ $query->id }}" disabled>Add Lead Remarks</button>
									</div>

									<!-- --------- -->

									<!-- send quote -->
		               				<div class="dashboard-inner-table textCenter apndTop5">
		               					<div><u><h5>Send Quote</h5></u></div>
										<?php
											$travel_date=$query->tour_date;
											$today=date('Y-m-d');
										?>
										@if($travel_date>=$today)
											<!-- <select class="q-select">
												<option id="0" quotation_no='0' ref_no='0'>Select Quote</option>
												{{ CustomHelpers::get_quotation_option($query->quo_ref) }}
											</select> -->
											<button class="btn-backend-main btn-send-quote send_quote" data-id="{{ $query->id }}">Email Quote</button>
											@else
											<a href="#">
												<button class="btn-backend-main btnInfo btn-danger">Date Expired</button>
											</a>
										@endif	
									</div>									

									<!-- --------- -->

									<!-- assigned user -->
									<?php
										$user_data = DB::table('users')
											->where('id', $query->assign_id)
											->first();
									?>
									@if($user_data)
										<div class="dashboard-inner-table textCenter">
											<div><u><h5>Assigned User</h5></u></div>
											<p class="q-user-name">{{ $user_data->first_name }} {{ $user_data->last_name }}</p>
										</div>
									@endif
								</td>

								<!-- ********************** -->	

								<!-- quote status -->
								<td>
									<!-- quote view -->
									<div class="dashboard-inner-table">
										<u><h5>Quote Viewed</h5></u>
										<table>
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

									<!-- enquiry timeline -->
									<div class="dashboard-inner-table textCenter">
										<div><u><h5>Enquiry Timeline</h5></u></div>
										<button class="btn-backend-main btnInfo view_history" data-id="{{ $query->query_reference }}">View History</button>
									</div>

								<!-- ********************** -->

								<!-- lead label -->
								<td id="{{ $query->query_reference }}">

									@if(Sentinel::check())
										@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('supervisor'))

										<div class="dashboard-inner-table textCenter">
												<div><u><h5>Assign Consultant</h5></u></div>
											    <select class="user_assign q-select">
													<option @if($query->assign_id=="0") selected @endif value="0">Unassigned</option>
													@foreach($employee as $employees)
													   <option value="{{ $employees->id }}" @if($query->assign_id==$employees->id) selected @endif >{{ $employees->first_name }} {{ $employees->last_name }}</option>
													@endforeach
												</select>
											</div>
											@endif
										@endif

									<!-- booking label -->
									<div class="dashboard-inner-table">
										<table>
											<tr>
												<td><label>Lead Label</label></td>
												<td>
													<select class="q-select booking_label">
													  @foreach($booking_lavel as $b_label)
													  	<option value="{{$b_label->id}}"
													  		@if($query->booking_label==$b_label->id) 
													  		selected 
													  		@endif>
													  		{{ $b_label->field_name }}
													  	</option>
													  @endforeach
													</select>
												</td>
											</tr>
										</table>
									</div>
								</td>

								<!-- ********************** -->

								<!-- lead action -->
								<td>
									<!-- view quote -->
									<input type="hidden" class="unique_code" value="{{ CustomHelpers::custom_encrypt($query->unique_code) }}">
									<a href="{{url('/quotes/'.$query->unique_code)}}" target="_blank">
										<div class="btnContainer">
											<button type="submit" class="btn-q btn-view-quote" data-id="{{$query->id}}">View Quote</button>
										</div>
									</a>

									<!-- ----- -->

									<!-- edit quote -->
									<?php
									    $travel_date = $query->tour_date;
									    $today = date('Y-m-d');
									?>

									@if($travel_date >= $today)
									    <a href="{{ URL::to('/edit_quation/' . $query->quo_ref . '/' . $query->query_reference) }}">
									        <div class="btnContainer">
									            <button class="btn-q btn-editquote">Edit Quote</button>
									        </div>
									    </a>
									@else
									    <a href="#">
									        <button class="btn-q btn-delete" disabled>Edit Quote (expired)</button>
									    </a>
									@endif

									<!-- ----- -->

									<!-- view lead -->
									<div class="btnContainer">
										<button class="btn-q btn-viewlead open-enquiryModal" data-id="{{ $query->query_reference }}" data-toggle="modal">View Lead</button>
									</div>

									<!-- ----- -->

									<!-- delete lead -->
									@if(Sentinel::check())
									@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
										<form style="float: unset !important" action="{{URL::to('/detele_query/'.$query->id)}}" onsubmit="return confirm('Are you sure, you want to remove this lead?');" method="POST">
											<span>
											{{csrf_field()}}
											<div class="btnContainer">
												<button type="submit" class="btn-q btn-delete deletePackage">Delete</button>
											</div>
											</span>
										</form>
									@endif
									@endif

									<!-- ----- -->

									<!-- Lead date & time -->

									<!-- date style-I -->
									<div class="dashboard-inner-table">
										<u><h5>Lead Generated</h5></u>
										<?php $lead_date_time = date("d M Y, H:i:s", strtotime($query->created_at)); ?>
										<p class="q-dtls textCenter">{{ $lead_date_time }}, ({{ date('D',strtotime($query->created_at)) }})</p>
									</div>

									<!-- date style-II -->
									<!-- <div class="dashboard-inner-table">
										<u><h5>Lead Generated</h5></u>
										<?php $newDate_flight = date("d M Y, H:i:s", strtotime($query->created_at)); ?>
										<p class="q-dtls textCenter">{{date('D', strtotime($query->created_at))}}, {{$newDate_flight}}</p>
									</div> -->
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>

<!-- send quote -->
<!-- <form action="{{ URL::to('/send_custom_quote') }}" method="POST" id="send_custom_quote">
	{{csrf_field()}}
	<input type="hidden" name="quote_id" id="quote_id" value="0">
	<input type="hidden" name="quote_no" id="quote_no" value="0">
	<input type="hidden" name="ref_no" id="ref_no" value="0">
</form> -->

<div class="testing">
	<input type="hidden" value="{{ url('/') }}" name="" id="test">
</div>

<!--Lead Status starts-->
@include('query.query_modal.modal-popup.lead-follow-up')
@include('query.query_modal.modal-popup.lead-cancelled')

<!--Lead Action starts-->
<!-- enquiry details modal -->
@include('query.query_modal.modal-popup.action-modal.view-enquiry-details')

<!-- view lead history modal -->
@include('query.query_modal.modal-popup.action-modal.view-enquiry-timeline')

@endsection

<!-- *********************************************** -->

@section('custom_js_code')
<!-- page script -->
<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/view-history-view-lead.js") }}'></script>

<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/capture-date-time.js") }}'></script>

<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/send-saved-quotation.js") }}'></script>
@endsection