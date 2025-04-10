@extends('layouts.master')
@section('content')
<style type="text/css">
.custom_border .row
{

padding: 5px 0px
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
<div class="box-header">
<h3 class="box-title">Quotation Management</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
	<div class="add">
<a href="{{URL::to('/query')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
</div>
@if (\Session::has('warning'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('warning') !!}</li>
        </ul>
    </div>
@endif
<div class="panel-body">
<div class="row">

<!--
	<div class="col-md-2">
<p>Quotaion Reference No.</p>
</div>
<div class="col-md-4">
<input type="text" class="form-control" name="" readonly="" placeholder="Quotaion Reference No.">  
</div>-->
</div>
<div class="row">
<div class="col-md-4">
<label>Leading Guest Name</label>
<input type="text" class="form-control" name="" readonly="" placeholder="Mr., Ms., Mrs., Blank" value="{{$data->name}}"> 
</div>


<div class="col-md-4">
<label>Contact No</label>
<input type="text" class="form-control" name="" readonly="" value="{{$data->mobile}}" placeholder="Contact No"> 
</div>
<div class="col-md-4">
<label>Email Address</label>
<input type="text" class="form-control" name="" value="{{$data->email}}" readonly="" placeholder="Email Address"> 
</div>
<div class="col-md-4">

</div>
</div>
<div class="row">
<div class="col-md-4">
<label>Package Name</label>
<input type="text" class="form-control" name="" readonly="" value="{{CustomHelpers::get_package_name($data->packageId)}}" placeholder="Package Name"> 
</div>
<div class="col-md-4">
<label>Package Destination</label>
<input type="text" class="form-control" value="{{$data->destinations}}" name="" readonly="" placeholder="Package Destination"> 
</div>
<div class="col-md-4">
<label>Package Duration</label>
<?php

 $day_night=(int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);
      

?>
<input type="text" class="form-control" value="{{$day_night-1}} Nights & {{$day_night}} Days" name="duration" readonly="" placeholder="Package Destination"> 
</div>
</div>

<div class="row">
<div class="col-md-4">
<label>No of Adults (+12 yrs)</label>
<input type="text" class="form-control" name="" value="{{$data->span_value_adult}}" readonly="" placeholder="No of Adults (+12 yrs)"> 
</div>
<div class="col-md-4">
<label>No of Child (5-12 yrs)</label>
<input type="text" class="form-control" name="" value="{{$data->span_value_child}}" readonly="" placeholder="No of Child (5-12 yrs)"> 
</div>
<div class="col-md-4">
<label>No of Child (0-5 yrs)</label>
<input type="text" class="form-control" name="" value="{{$data->span_value_infant}}" readonly="" placeholder="No of Child (0-5 yrs)"> 
</div>
</div>

<div class="row">
<div class="col-md-4">
<label>Nationality</label>
<input type="text" class="form-control" name="" value="{{$data->country_of_residence}}" readonly="" placeholder="Nationality"> 
</div>
<div class="col-md-4">
<label>Best time to Call</label>
<input type="text" class="form-control" name="" value="{{$data->time_call}}" readonly="" placeholder="Best time to Call"> 
</div>
<div class="col-md-4">
<label>Arrival Date</label>
<input type="text" class="form-control" name="" value="{{$data->date_arrival}}" readonly="" placeholder="Arrival Date">
</div>
</div>
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

