@extends('layouts.master')
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
</div>
<!-- /.box-header -->
<div class="box-body">
  <a href="{{URL::to('/hotelUploads/'.Request::segment(3))}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
<h3 class="box-title">Choose Country And City</h3>


<form action="{{URL::to('/hotel_image_gallery_edit/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4))}}"  >

{{csrf_field()}}
<br>
<div class="row">
 <div class="col-md-1">
 	Choose Country
 </div>   
 <div class="col-md-2">
 

 	<select class="form-control" onchange="get_states(this)" name="country_name">
 			<option value='0'>Select Country</option>
                @foreach($countries as $cont)
    <option value="{{ $cont->name }}" @if(CustomHelpers::get_gallery_country(Request::segment(2))==$cont->name) selected="selected" @endif c_id="{{ $cont->id }}" >{{ $cont->name }} 
    </option>
                @endforeach   
</select>

 </div>  
 <div class="col-md-1">
 	Choose State
 </div>   
 <div class="col-md-2">
 	<select class="form-control st_values" id="" onchange="getcitys(this)" name="state_name">
 		<option value='0'>Select State</option>
                 @foreach($state as $cont)
 			    <option value="{{ $cont->name }}" @if(CustomHelpers::get_gallery_state(Request::segment(2))==$cont->name) selected="selected" @endif s_id="{{ $cont->id }}" >{{ $cont->name }} </option>
                 @endforeach   
 			    
 	</select>
 </div>  
 <div class="col-md-1">
 	Choose City
 </div>   
 <div class="col-md-2">
 	
 	<select class="form-control ct_values"  name="city_name">
 			    <option value='0'>Select City</option>
          @foreach($city as $cont)
                <option value="{{ $cont->name }} " @if(CustomHelpers::get_galler_city(Request::segment(2))==$cont->name) selected="selected" @endif>{{ $cont->name }} </option>
          @endforeach   
 			    
	</select>
 </div>  
 <div class="col-md-2">
 	<button type="submit" class="btn btn-success">Submit</button>
 </div>               
</div>                 
</form>

</div>
<!-- /.box-body -->
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection