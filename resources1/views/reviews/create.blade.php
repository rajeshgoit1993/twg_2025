@extends('layouts.master')
@section('content')
<style>

.panel-default>.panel-heading {
color: #333;
background-color: #fff;
border-color: #e4e5e7;
padding: 0;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}

.panel-default>.panel-heading a {
display: block;
padding: 10px 15px;
}

.panel-default>.panel-heading a:after {
content: "";
position: relative;
top: 1px;
display: inline-block;
font-family: 'Glyphicons Halflings';
font-style: normal;
font-weight: 400;
line-height: 1;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
float: right;
transition: transform .25s linear;
-webkit-transition: -webkit-transform .25s linear;
}

.panel-default>.panel-heading a[aria-expanded="true"] {
background-color: #eee;
}

.panel-default>.panel-heading a[aria-expanded="true"]:after {
content: "\2212";
-webkit-transform: rotate(180deg);
transform: rotate(180deg);
}

.panel-default>.panel-heading a[aria-expanded="false"]:after {
content: "\002b";
-webkit-transform: rotate(90deg);
transform: rotate(90deg);
}
.accordion-option {
width: 100%;
float: left;
clear: both;
margin: 15px 0;
}

.accordion-option .title {
font-size: 20px;
font-weight: bold;
float: left;
padding: 0;
margin: 0;
}

.accordion-option .toggle-accordion {
float: right;
font-size: 16px;
color: #6a6c6f;
}
.dayItinerary{
border-bottom: 1px solid darkgray;
margin-bottom: 14px;
border-radius: 23px;
}
span.select2.select2-container {
width: 100% !important;
}
</style>
<div class="content-wrapper">

<section class="content">
<div class="row">
<div class="col-md-12">

<div class="panel panel-primary">
<div class="panel-heading">Reviews -> Create Review</div>
<div class="panel-body">
  
<div class="modal-body_main">
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form action="{{URL::to('/testimonials-store')}}" method="POST">
{{csrf_field()}}
<div class="col-md-12">
<div class="col-md-6">
<div class="form-group">
<label for="package">Package</label>
<select class="form-control select2" name="package_id" id="">
<option value=" ">Select Package</option>
@foreach($packages as $pak)
<option value="{{$pak->id}}">{{$pak->title}}</option>
@endforeach
</select>
</div>
<div class="form-group">
<label for="package">User Exprience</label>
<textarea name="user_exp" class="form-control" cols="30" rows="5"></textarea>
</div>

</div>
<div class="col-md-6">
<div class="form-group">
<label for="package">User Name</label>
<select class="form-control select2" name="user_id" id="">
<option value=" ">Select User</option>
@foreach($users as $user)
<option value="{{$user->id}}">{{$user->first_name.' '.$user->last_name}}</option>
@endforeach
</select>
</div>
<div class="form-group">
<label for="package">User Rating</label>
<select class="form-control select2" name="user_rating" id="">
<option value=" ">Select Rating</option>
<option value="1">1 Star</option>
<option value="2">2 Star</option>
<option value="3">3 Star</option>
<option value="4">4 Star</option>
</select>
</div>
<div class="form-group">
<label for="package">Status</label>
<select class="form-control select2" name="status" id="">
<option value="1">Enable</option>
<option value="0">Disable</option>
</select>
</div>
<div class="form-group">

<input type="submit" value="Save" class="btn btn-success"/>
</div>
</div>

</div>
</form>

</div>

</div>
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
@endsection