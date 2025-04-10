@extends('layouts.master')
@section('content')
<style type="text/css">
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
.flight,.flight1,.flight2,.flight3 {
	display: none;
	}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	background: #08b2ed;
	border:1px solid #08b2ed;
	color: #fff
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
				<h3 class="box-title">Create & Edit Quote</h3>
			</div>
			<div class="box-body">
				<div class="add">
					<a href="{{URL::to('/quotation')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
				</div>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#option1">Quote 1</a></li>
					@if($reference_data->status=="1")
					<li><a data-toggle="tab" href="#option2">Quote 2</a></li>
					@endif
					@if($reference_data->status=="1" && $reference_data2->status=="1" )
					<li><a data-toggle="tab" href="#option3">Quote 3</a></li>
					@endif
					@if($reference_data->status=="1" && $reference_data2->status=="1" && $reference_data3->status=="1")
					<li><a data-toggle="tab" href="#option4">Quote 4</a></li>
					@endif
				</ul>
				<br>
				<div class="tab-content">
					@include('query.quotationedit.option1')
					@include('query.quotationedit.option2')
					@include('query.quotationedit.option3')
					@include('query.quotationedit.option4')
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
<script type="text/javascript">
</script>
@endsection