@extends('layouts.master')

@section('custom_css_code')

	<!-- lead manager css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/backend/css/lead-manager.css') }}" />

	<!-- enquity timeline CSS -->
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
						<!-- query-enquiry page -->
						@if($val==1)
							<h3 class="box-title">Web Leads</h3>
						@elseif($val==2)
							<h3 class="box-title">Lead Verification</h3>
						@endif
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
							<p>Query Deleted Successfully.</p>
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

									<!-- reference no -->
									<th width="175" style="min-width: 125px;">Reference No</th>

									<!-- guest details -->
									<th>Guest Name,<br>Mobile No & Email id</th>

									<!-- travel date & nationality -->
									<th width="200" style="min-width: 150px;">Travel Date,<br>Guests & Nationality</th>

									<!-- travel destination -->
									<th width="200">Destination & <br>Package Name</th>

									<!-- lead status -->
									<th width="200">Lead Status</th>

									<!-- quote status -->
									<!-- <th style="width: 180px">Quote status</th> -->

									<!-- lead label -->
									<th width="200">Lead Verify</th>

									<!-- action -->
									<th width="100">Action</th>
								</tr>
							</thead>
							<tbody><?php $count="1"; ?>
								@foreach($queries as $key=>$query)
								<tr>
									<!-- s.no. -->
									<td style="display: none">{{ $count++ }}</td>

									<!-- enquiry & quote reference no -->
									<td>
										<div class="dashboard-inner-table">
										    <div><u><h5>Enquiry Reference No</h5></u></div>

										    @if(isset($query->enquiry_ref_no))
										        <p class="q-dtls">#{{ $query->enquiry_ref_no }}</p>
										    @else
										        <p class="q-dtls">No enquiry id available.</p>
										    @endif

										    <p class="q-dtls">{{ $query->service_type ?? 'No service type available.' }}</p>
										    <p class="q-dtls">{{ $query->channel_type ?? 'No channel type available.' }}</p>
										</div>

										<!-- --------- -->

										<!-- quote reference no -->
										@if(!empty($query->quo_ref))
											<div class="dashboard-inner-table">
											    <div><u><h5>Quote Reference No</h5></u></div>
											    <p class="q-dtls">#{{ $query->quo_ref }}</p>
											</div>
										@endif							
									</td>

									<!-- ********************** -->

									<!-- guest details -->
									<td>
										<div class="dashboard-inner-table">
											<div>
												<u><h5>Guest Details</h5></u>
											</div>

											<!-- guest name -->
											<p class="q-dtls">{{ $query->name }}</p>

											<!-- guest mobile & email -->
											<?php $loged_user=Sentinel::getUser(); ?>
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

									<!-- travel date, no of guest & nationality -->
									<td>
										<div class="dashboard-inner-table">
											<div><u><h5>Travel Details</h5></u></div>

											<!-- travel date -->
											<!-- <p class="q-dtls">
												@if($query->date_arrival!="")
												<?php
													$date_arrival = $query->date_arrival;
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
											</p> -->

											<!-- travel date -->
											<p class="q-dtls">
											    @if($query->date_arrival)
											        @php
											            // Replace slashes with dashes and convert to YYYY-MM-DD format
											            $date_arrival = str_replace('/', '-', $query->date_arrival);

											            // Convert to DateTime object and format to "d M Y"
											            $formattedDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date_arrival)->format('d M Y');
											        @endphp
											        {{ $formattedDate }}
											    @endif
											</p>

											<!-- --------- -->

											<!-- no of guests -->
											@if($query->span_value_adult != "" && $query->span_value_adult != "0")
											    @php
											        $adultCount = (int) $query->span_value_adult;
											        $adultText = $adultCount == 1 ? 'Adult' : 'Adults';
											    @endphp
											    <p class="q-dtls">{{ $adultCount }} {{ $adultText }}
											@endif

											@if($query->span_value_child != "" && $query->span_value_child != "0")
											    @php
											        $childCount = (int) $query->span_value_child;
											        $childText = $childCount == 1 ? 'Child (with bed)' : 'Children (with bed)';
											    @endphp
											    + {{ $childCount }} {{ $childText }}
											@endif

											@if($query->span_value_child_without_bed != "" && $query->span_value_child_without_bed != "0")
											    @php
											        $childWithoutBedCount = (int) $query->span_value_child_without_bed;
											        $childWithoutBedText = $childWithoutBedCount == 1 ? 'Child (without bed)' : 'Children (without bed)';
											    @endphp
											    + {{ $childWithoutBedCount }} {{ $childWithoutBedText }}
											@endif

											@if($query->span_value_infant != "" && $query->span_value_infant != "0")
											    @php
											        $infantCount = (int) $query->span_value_infant;
											        $infantText = $infantCount == 1 ? 'Infant' : 'Infants';
											    @endphp
											    + {{ $infantCount }} {{ $infantText }}</p>
											@endif

											<!-- starting city -->
											@if($query->country_of_residence != "")
											    <p class="q-dtls">{{ $query->country_of_residence }}</p>
											@endif

											<!-- --------- -->

											<!-- nationality -->
											@if($query->nationality!="")
												<p class="q-dtls">{{$query->nationality}}</p>
											@endif
										</div>
									</td>

									<!-- ********************** -->

									<!-- destination & package name -->
									<td>
										<!-- destination name -->
										<div class="dashboard-inner-table">

											<!-- destination -->
											@if(is_numeric((int)$query->packageId))
											    <div><u><h5>Destination</h5></u></div>
											    <?php
											        // Fetch cities from the database using the helper function
											        $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$query->packageId, 'city');

											        // If the result is null or not an array, default to an empty array
											        if ($cities === null || !is_array($cities)) {
											            $cities = []; // Default to an empty array if no valid data
											        }
											    ?>

											    @if(!empty($cities))
											        <ul class="q-dtls">
											            @foreach($cities as $tour_city)
											                <li>{{ $tour_city }}</li>
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



											<!-- ************* -->

											<!-- package name -->
											@if(is_numeric((int)$query->packageId))
											    <?php
											        $href_id1 = CustomHelpers::custom_encrypt((int)$query->packageId);
											        $packageName = CustomHelpers::get_package_name((int)$query->packageId);
											        $form_action = url("/holidays/" . str_slug($packageName)) . '?package_id=' . $href_id1;
											    ?>
											    
											    @if(!empty($packageName))
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
									<td id="{{ $query->id }}">
										<div class="dashboard-inner-table textCenter">
											<div><u><h5>Update status</h5></u></div>
											<div>
										    <select class="query_status q-select">
										        <!-- 
										        <option value="0" @if($query->status=="0") selected @endif>Select Status</option>
										        -->
										        @if($val == 1)
										            <option value="interested" @if($query->status == "interested") selected @endif>Interested</option>
										            <option value="add_lead_follow_up" @if($query->status == "add_lead_follow_up") selected @endif>Add Lead Follow-up</option>
										            <option value="lead_cancelled" @if($query->status == "lead_cancelled") selected @endif>Lead Cancelled</option>
										        @else
										            <option value="add_lead_follow_up" @if($query->status == "add_lead_follow_up") selected @endif>Add Lead Follow-up</option>
										            <option value="lead_verify_pending" @if($query->status == "lead_verify_pending") selected @endif>Lead Verify Pending</option>
										            <option value="lead_cancelled" @if($query->status == "lead_cancelled") selected @endif>Lead Cancelled</option>
										        @endif
										    </select>
										    </div>
										    <!-- add lead remarks -->
										    <!-- <button class="btn-backend-main btnInfo submit_status" data-id="{{ $query->id }}">Add Lead Remarks</button> -->
										    @if(isset($query->id))
											    <button class="btn-backend-main btnInfo submit_status" data-id="{{ $query->id }}">Add Lead Remarks</button>
											@else
											    <p>ID not found</p>
											@endif

										</div>

										<!-- --------- -->
										
									    <!-- lead follow-up -->
										@if($query->status == 'add_lead_follow_up')
											<?php 
												$lead_follow_up_data = DB::table('enquiry_lead_follow_up')
									                ->where('enquiry_id', $query->id)
									                ->latest()
									                ->first();
									            $reason = DB::table('lead_dynamic_field')
									                ->where('id', $lead_follow_up_data->reason)
									                ->first();
											?>
											<div class="dashboard-inner-table apndTop7">
												<div><u><h5>Lead follow-up detail</h5></u></div>
												<p class="q-dtls">Next follow-up date: <b>{{ date('d-m-Y', strtotime($lead_follow_up_data->follow_up_date)) }}</b></p>
												<p class="q-dtls">Next follow-up time: <b>{{ $lead_follow_up_data->follow_up_time }} hrs.</b></p>
												<p class="q-dtls">Reason: {{ $reason->field_name }}</p>
											</div>
										@endif

										<!-- --------- -->

										<!-- enquiry timeline -->
										<div class="dashboard-inner-table">
											<div><u><h5>Enquiry Timeline</h5></u></div>
											<button type="button" class="btn-backend-main btnInfo view_history" data-id="{{ $query->id }}">View History</button>
										</div>
									</td>

									<!-- ********************** -->

									<!-- <td id={{$query->id}}>
										<select class="lead_varified" style="width: 100%;border-color: #ccc;border-radius: 3px;height: 34px;padding: 4px">
											<option value="0" @if($query->lead_verified=="0") selected @endif>No</option>
											<option value="1" @if($query->lead_verified=="1") selected @endif>Yes</option>
										</select>
										@if($query->otp_verified==1)
										<p style="color: green;">OTP verified</p>
										@else
										<p style="color: lightgray;">OTP Non-verified</p>
										@endif

										@if($val==2)
										<h5> Booking Label	</h5>
										<select class="booking_label" style="width: 100%;border-color: #ccc;border-radius: 3px;height: 34px;padding: 4px">
												<option value="">--Select--</option>
											@foreach($booking_lavel as $b_label)
										
											<option value="{{$b_label->id}}" @if($query->booking_label==$b_label->id) selected @endif>{{$b_label->field_name}}</option>

											@endforeach
										</select>
										@endif
									</td> -->

									<!-- lead verification & booking label -->
									<td id="{{ $query->id }}">
									@if(Sentinel::check())
										@if(Sentinel::getUser()->inRole('super_admin') ||
											Sentinel::getUser()->inRole('administrator') ||
											Sentinel::getUser()->inRole('supervisor'))								
											<!-- phone verification -->
											<div class="dashboard-inner-table textCenter">
												<div><u><h5>Phone Verification</h5></u></div>
											    <select class="q-select lead_varified">
											        <option value="0" @if($query->lead_verified == "0") selected @endif>No</option>
											        <option value="1" @if($query->lead_verified == "1") selected @endif>Yes</option>
											    </select>
										    </div>

										    @if($val == 2)
												<div class="dashboard-inner-table textCenter">
													<div><u><h5>Lead Label</h5></u></div>
											    	<select class="booking_label q-select">
											    		<option disabled>Select</option>
														@foreach($booking_lavel as $b_label)
															<option value="{{ $b_label->id }}" @if($query->booking_label==$b_label->id) selected @endif>{{ $b_label->field_name }}</option>
														@endforeach
													</select>
												</div>
											@endif

											<!-- online otp verification -->
										    @if($query->otp_verified == 1)
										        <p class="online-otp-verify">OTP verified</p>
										    @else
										        <p class="online-otp-verify disabled">OTP not verified</p>
										    @endif
										@endif
									@endif
									</td>

									<!-- *************************** -->

									<!-- lead action -->
									<td>
										<!-- view lead -->
										<div class="btnContainer">
											<button type="submit" class="btn-q @if($query->view_status == 0) btn-view-quote @else btn-viewed-lead @endif open-editEnquiryModal" data-id="{{ $query->id }}" data-toggle="modal">View Lead</button>
										</div>

										<!-- delete lead -->
										@if(Sentinel::check())
									        @if(Sentinel::getUser()->inRole('administrator') || 
									            Sentinel::getUser()->inRole('super_admin'))
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
							@endforeach
						</tbody>
						</table>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
	</div>

	<div class="testing">
		<input type="hidden" value="{{ url('/') }}" name="" id="test">
	</div>

	<!--Lead Status starts-->
	@include('query.query_modal.modal-popup.lead-follow-up')
	@include('query.query_modal.modal-popup.lead-cancelled')

	<!-- edit enquiry details modal -->
	@include('query.query_modal.modal-popup.action-modal.edit-enquiry-details')

	<!-- view lead history modal -->
	@include('query.query_modal.modal-popup.action-modal.view-enquiry-timeline')

@endsection

@section('custom_js_code')

	<!-- page script -->
	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/edit-lead.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/view-history-view-lead.js") }}'></script>

	<script type="text/javascript" src='{{ asset ("/resources/assets/backend/js/capture-date-time.js") }}'></script>

@endsection