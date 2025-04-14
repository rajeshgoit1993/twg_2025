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
  <a href="{{URL::to('/hotel_image_location/'.Request::segment(2))}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
 
<h3 class="box-title">Add Photos From Gallery <span style="font-size: 14px">( 
	@if($country!="" && $country!="0" && $state=="0" && ($city=="Select City" ||  $city=="0") )
{{$country}}  &rarr; 
     @elseif($country!="" && $country!="0" && $state!="0" && ($city=="Select City" ||  $city=="0"))
{{$country}} &rarr; {{$state}} &rarr; 
     @elseif($country!="" && $country!="0" && $state!="0" && $city!="Select City" && $city!="0")
{{$country}} &rarr; {{$state}} &rarr;  {{$city}} &rarr; 
     @endif

{{CustomHelpers::get_hotel_title(Request::segment(2))}})</span></h3>


<form action="{{URL::to('/hotel_image_save/'.Request::segment(2))}}" method="post" >

{{csrf_field()}}
<br>
<div class="row">
@foreach($data as $datavalue) 
<div class="col-md-4" style="margin-bottom: 20px">

       @if($datavalue->type=='video')
 <div style="max-width:100%" class="video_icon">
  <input type="hidden" name="" class="video_src"  value="{{URL::to('/').'/public/uploads/packages/video/'.$datavalue->image_main }}">
   <i class="fa fa-play play_video" style="position: absolute;
    z-index: 1;
    color: white;
    left: 50%;
    top: 25%;
    border: 1px solid white;
    padding: 10px;
    border-radius: 20px;cursor: pointer;"></i>
 </div>
 @endif
  @if($datavalue->thum_medium!="")
 <img src="{{URL::to('/').'/public/uploads/packages/thum_medium/'.$datavalue->thum_medium }}" style="max-width: 100%;height: 200px;min-width: 100%;"><br>
 @else
<img src="{{URL::to('/').'/public/'.$datavalue->image_path }}" style="max-width: 100%;height: 200px"><br>
 @endif

 

 <input type="checkbox" name="image_from_gallery[]" value="{{$datavalue->id}}" @if(CustomHelpers::get_data_condition1($datavalue->id,Request::segment(2))=="1") checked  @endif> 
 

 
 <span class="pull-right" style="font-size: 12px;font-weight: bold;">{{$datavalue->name}}</span>
</div>

@endforeach                
</div> 
<button type="submit" class="btn btn-success">Submit</button>                
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