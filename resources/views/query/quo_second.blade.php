@extends('layouts.master')
@section('content')
<style type="text/css">
.custom_border .row {
	padding: 5px 0px
	}
.pfwmt {
	font-weight: 600;
	margin: 0px;
	text-align: left;
	}
.font-size10 {
	font-size: 10px;
	}
.font-size12 {
	font-size: 12px;
	}
.font-size14 {
	font-size: 14px;
	}
.font-size16 {
	font-size: 16px;
	}
.font-size18 {
	font-size: 18px;
	}
.font-size20 {
	font-size: 20px;
	}
.font-size22 {
	font-size: 22px;
	}
.color8cff {
	color: #008cff;
}
.color4a {
	color: #4a4a4a;
}
.colorf2 {
	color: #f2f2f2;
}
.colorf9 {
	color: #f9f9f9;
}
.colorced {
	color: #CED0D4;
}
.requiredcolor {
	color: #E12D2D;
}
.font-weight500 {
	font-weight: 500;
	}
.font-weight600 {
	font-weight: 600;
	}
.text-center {
	text-align: center;
	}
.text-capitalize {
	text-transform: capitalize;
	}
.text-lowercase {
	text-transform: lowercase;
	}
.text-uppercase {
	text-transform: uppercase;
	}
.lineHeight14 {
	line-height: 14px;
	}
.lineHeight15 {
	line-height: 15px;
	}
.padding10 {
	padding: 10px;
	}
.padding-top10 {
	padding-top: 10px;
	}
.padding-bottom10 {
	padding-bottom: 10px;
	}
.appendTop5 {
	margin-top: 5px;
	}
.appendTop10 {
	margin-top: 10px;
	}
.appendTop15 {
	margin-top: 15px;
	}
.appendTop20 {
	margin-top: 20px;
	}
.appendBottom5 {
	margin-bottom: 5px;
	}
.appendBottom10 {
	margin-bottom: 10px;
	}
.appendBottom15 {
	margin-bottom: 15px;
	}
.appendBottom20 {
	margin-bottom: 20px;
	}
.border1 {
	border: 1px solid #ccc;
	}
.border-top1 {
	border-top: 1px solid #ccc;
	}
.border-bottom1 {
	border-bottom: 1px solid #ccc;
	}
.borderradius2 {
	border-radius: 2px;
	}
.borderradius3 {
	border-radius: 3px;
	}
.borderradius4 {
	border-radius: 4px;
	}
.borderradius5 {
	border-radius: 5px;
	}
.borderradius10 {
	border-radius: 10px;
	}
.makeflex {
	display: flex;
	}
.flex110 {
	flex-grow: 1;
    flex-shrink: 1;
    flex-basis: 0%;
	}
.flexcenter {
	display: flex;
	align-items: center;
	}
.aligncenter {
	align-items: center;
	}
.flexcenter > li.active, .flexcenter > li.active >a:focus, .flexcenter > li.active > a:hover {
	color: #008cff !important;
	border-bottom-color:#008cff !important;
	}
.flexcenter > li > a.hover {
	color: #008cff !important;
	padding-bottom: 15px;
	border-bottom:2px solid #008cff !important;
	}
.flex-column {
	display: flex;
	flex-direction: column;
	}
.priceitemlist {
	font-size: 15px;
	font-weight: 600;
	margin: 0px;
	color: #000001;
	}
.minwidth100 {
	min-width: 100px !important;
	}
.minwidth100 {
	min-width: 100px !important;
	}
.minwidth135 {
	min-width: 135px !important;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="makeflex aligncenter padding10">
					<a href="{{ URL::to('/query') }}" class="btn btn-success" style="margin-right: 20px"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
					<span class="pfwmt font-size18">Create Quotation</span>
				</div>
				<!-- /.box-header -->
				@if (\Session::has('warning'))
					<div class="alert alert-danger">
						<ul>
							<li>{!! \Session::get('warning') !!}</li>
						</ul>
					</div>
				@endif
				<div class="panel-body" style="padding: 0px">
					<!-- /.box-header -->
					<div class="box-body" style="padding-top: 0px">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label>Primary Guest Name</label>
									<input type="text" class="form-control text-capitalize" name="" readonly="" placeholder="Mr., Ms., Mrs., Blank" value="{{$data->name}}"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Guest Email Address</label>
									<input type="text" class="form-control text-lowercase" name="" value="{{$data->email}}" readonly="" placeholder="Email Address"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Guest Contact No</label>
									<input type="text" class="form-control" name="" readonly="" value="{{$data->mobile}}" placeholder="Contact No"> 
								</div>
								<div class="col-md-4"></div>
							</div>
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label>Tour Name</label>
									@if(is_numeric($data->packageId))
										<input type="text" class="form-control" name="package_name" value="{{CustomHelpers::get_package_name($data->packageId)}}" placeholder="Package Name" readonly>
									@else
										<input type="text" class="form-control" name="package_name" value="{{$data->packageId}}" placeholder="Package Name" style="text-transform: capitalize" readonly>
									@endif
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Tour Destination</label>
									<input type="text" class="form-control text-capitalize" value="{{$data->destinations}}" name="" readonly="" placeholder="Package Destination"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Tour Duration</label>
									<?php $day_night=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT); ?>
									<input type="text" class="form-control text-capitalize" value="{{$day_night-1}} Nights & {{$day_night}} Days" name="duration" readonly="" placeholder="Package Destination"> 
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label>No of Adult (+12 yrs)</label>
									<input type="text" class="form-control" name="" value="{{$data->span_value_adult}}" readonly="" placeholder="Enter No of Adults (+12 yrs)"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>No of Children (5 - 12 yrs)</label>
									<input type="text" class="form-control" name="" value="{{$data->span_value_child}}" readonly="" placeholder="Enter No of Children"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>No of Infant (0 - 2 yrs)</label>
									<input type="text" class="form-control" name="" value="{{$data->span_value_infant}}" readonly="" placeholder="Enter No of Infant (0-5 yrs)"> 
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label>Guest Nationality</label>
									<input type="text" class="form-control text-capitalize" name="" value="{{$data->country_of_residence}}" readonly="" placeholder="Nationality"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Best time to Call</label>
									<input type="text" class="form-control" name="" value="{{$data->time_call}}" readonly="" placeholder="Best time to Call"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Departure Date</label>
									<input type="text" class="form-control" name="" value="{{$data->date_arrival}}" readonly="" placeholder="Arrival Date">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label>Additional Information</label>
									<input type="text" class="form-control text-capitalize" name="" value="{{$data->remarks}}" readonly="" placeholder="Additional information shared by Guest">  
								</div>
							</div>
						</div>
					</div>
					<div style="padding: 0px 10px">
						<form action="{{URL::to('/copy_reference/'.$data->id)}}" method="post" >
						{{csrf_field()}} 
							<div class="col-md-5 appendBottom20">
								<label>Select Copy Source</label>
								<select name="select_type" class="form-control">
									<option value="1">Quotation Reference No.</option>
									<option value="2">Package Name</option>
								</select>
							</div>
							<div class="col-md-4">
								<label>Quotation Reference No. / Tour Package Name</label>
								<input type="text" class="form-control" name="q_reference_no" placeholder="Enter Reference No / Tour Package Name" required>
							</div>
							<div class="col-md-2">
								<input type="submit" value="IMPORT" class="btn btn-success form-control appendTop20" name="">		
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</div>
<!---->
</section>
<!-- /.content -->
</div>
<div class="testing">
<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
<!-- /.content-wrapper -->
@endsection