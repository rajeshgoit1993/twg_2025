@extends('layouts.master')
@section('content')
<style type="text/css">
.custom_border .row
{
padding: 5px 0px
}
.btnBack {
	display: inline-block;
    padding: 7px 12px;
    margin-bottom: 0;
    font-size: 14px;
    line-height: 20px;
    color: #fff;
	font-weight: 400;
    text-align: center;
	background: #00a65a;
	background-image: none;
	white-space: nowrap;
	touch-action: manipulation;
	user-select: none;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #00a65a;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
	height: 34px;
	}
.btnBack:hover {
    color: #fff;
	background: #008d4c;
	}
.appendBottom10 {
	margin-bottom: 10px;
	}
</style>
<div class="content-wrapper">
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box">
			
			<div class="box-body">
				<div class="flexCenter">
					<a href="{{URL::to('/query')}}" class=" btnBack"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
					<div class="box-header">
				<h3 class="box-title">Create (Import) Quote</h3>
			</div>
				</div>
				@if (\Session::has('warning'))
				<div class="alert alert-danger">
					<ul>
						<li>{!! \Session::get('warning') !!}</li>
					</ul>
				</div>
				@endif
				<div class="panel-body">
					<!--Quote Lead Details Starts-->
					@include('query.enquiryDetails.quoteLeadDetails')
					<!--Quote Lead Details Ends-->
					<br>
					<div class="row">
					<form action="{{URL::to('/copy_reference/'.$data->id)}}" method="post" >
					{{csrf_field()}}
						<div class="col-md-5">
							<label>Choose Copy Type</label>
							<select name="select_type" class="form-control">
								<option value="1">Quotation Reference No.</option>
								<option value="2">Package Name</option>
							</select>
						</div>
						<div class="col-md-5">
							<label>Enter Quotation Reference Number or Package Name</label>
							<input type="text" class="form-control" required="" name="q_reference_no">
							<br>
						</div>
						<div class="col-md-2">
							<input type="submit" value="Submit" class="btn btn-info form-control" name="" style="margin-top: 20px">
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
</div>
<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"></script>
@endsection