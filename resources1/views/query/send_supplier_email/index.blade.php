@extends('layouts.master')

@section("custom_css_code")


<style type="text/css">
.btnSendEmail {
	width: 200px;
    height: 40px;
    font-weight: 600;
    text-transform: UPPERCASE;
}
</style>

@endsection


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			<div class="box-header">
				<h3 class="box-title">Email To Supplier</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			<form action="{{ URL::to('/supplier_email_submit') }}" method="post" enctype="multipart/form-data">
			    {{ csrf_field() }}
			    <input type="hidden" name="quo_ref" value="{{ $quo_ref }}">
			    <input type="hidden" name="query_id" value="{{ $query_id }}">
			    <div class="row">
			    	<!-- email To -->
			        <div class="col-md-12">
			            <div class="form-group">
			                <label for="to">To <span class="requiredcolor">*</span></label>
			                <input type="text" class="form-control" id="to" name="to" value="" placeholder="To" required>
			                <div id="to_email_list"></div>
			            </div>
			        </div>

			        <!-- email Cc -->
			        <div class="col-md-12">
			            <div class="form-group">
			                <label for="cc">Cc</label>
			                <input type="text" class="form-control" id="cc" name="cc" value="" placeholder="CC">
			            </div>
			        </div>

			        <!-- email Bcc -->
			        <div class="col-md-12">
			            <div class="form-group">
			                <label for="bcc">Bcc</label>
			                <input type="text" class="form-control" id="bcc" name="bcc" value="" placeholder="BCC">
			            </div>
			        </div>

			        <!-- email subject -->
			        <div class="col-md-12">
			            <div class="form-group">
			                <label for="subject">Subject <span class="requiredcolor">*</span></label>
			                <input type="text" value="Enquiry Ref. No. #{{ $data->enquiry_ref_no }} // Quote" class="form-control" id="subject" name="subject" placeholder="Subject" required>
			            </div>
			        </div>

			        <div class="col-md-12">
			            <div class="form-group">
			                <label for="description">Description <span class="requiredcolor">*</span></label>
			                <?php
			                	$day_s = (int) filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);
			                ?>
			                <textarea class="form-control ckeditor" id="description" name="description">
			                	<h4>Hello Team,</h4>
				                <br><br>
				                <h5>We have requirement of following quote, kindly share the best offer.</h5>
				                <br><br>

				                <!-- guest name -->
			                    <!-- Name: {{ $data->name }}<br> -->

			                    <!-- contact number -->
			                    Contact Number: {{ $data->mobile }}<br>
			                    Email Id: {{ $data->email }}<br>
			                    
			                    <!-- destination -->
			                    Destination: {{ $data->destinations }} <br>

			                    <!-- travel date -->
			                    Travel Date: {{ date('d-m-Y', strtotime($data->date_arrival)) }} <br>

			                    <!-- duration -->
			                    Duration: {{ $day_s - 1}} Nights / {{ $day_s }} Days<br>

			                    <!-- starting city -->
			                    Starting City: {{ $data->city_of_residence }} <br>

			                    <!-- nationality -->
			                    Nationality: {{ $data->country_of_residence }} <br>

			                    <!-- Travellers: {{ $data->span_value_adult }} Adults, {{ $data->span_value_child }} Child, {{ $data->span_value_child_without_bed }} Child Without Bed, {{ $data->span_value_infant }} Infants <br> -->

			                    <!-- No of Travellers -->
								Travellers:
								@if($data->span_value_adult > 0)
								    {{ $data->span_value_adult }} {{ $data->span_value_adult > 1 ? 'Adults' : 'Adult' }}
								@endif
								@if($data->span_value_child > 0)
								    @if($data->span_value_adult > 0), @endif
								    {{ $data->span_value_child }} {{ $data->span_value_child > 1 ? 'Children' : 'Child' }}
								@endif
								@if($data->span_value_child_without_bed > 0)
								    @if($data->span_value_adult > 0 || $data->span_value_child > 0), @endif
								    {{ $data->span_value_child_without_bed }} {{ $data->span_value_child_without_bed > 1 ? 'Children Without Bed' : 'Child Without Bed' }}
								@endif
								@if($data->span_value_infant > 0)
								    @if($data->span_value_adult > 0 || $data->span_value_child > 0 || $data->span_value_child_without_bed > 0), @endif
								    {{ $data->span_value_infant }} {{ $data->span_value_infant > 1 ? 'Infants' : 'Infant' }}
								@endif
								<br>

								<!-- hotel preference -->
			                    Hotel Preference: {{ $data->hotel_pre }} Star <br><br>

			                    <!-- expected budget -->
			                    <!-- Expected Budget: {{ $data->exp_budget }} <br> -->

			                    <!-- connect time -->
			                    <!-- Best Time To Call: {{ $data->time_call }} <br> -->

			                    <!-- remarks -->
			                    Additional Info:<br>
			                    {{ $data->message }}

			                    <!-- package name -->
			                    <!-- Package Name: {{ $package_name }} -->
			                </textarea>
			            </div>
			        </div>

			        <!-- signature -->
			        <div class="col-md-12">
			            <div class="form-group">
			                <label for="email_footer">Signature <span class="requiredcolor">*</span></label>
			                <select class="select2 form-control" name="email_footer">
			                    @foreach($quotation_footer as $pol)
			                        <option value="{{ $pol->id }}">{{ $pol->footer }}</option>
			                    @endforeach
			                </select>
			            </div>
			        </div>

			        <!-- send email -->
			        <div class="col-md-12">
			            <div class="text-center appendBottom20">
			                <button type="submit" name="submit" class="btnMain btnSendEmail">Send</button>
			            </div>
			        </div>
			    </div>
			</form>
			</div>
			<!-- /.box-body -->
			</div>
		</div>
	</div>
</section>
</div>

<div class="testing">
	<input type="hidden" value="{{ url('/') }}" name="" id="test">
</div>

<!-- page script -->
<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

@endsection