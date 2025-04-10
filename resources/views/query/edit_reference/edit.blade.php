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
.flight
{
display: none;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	background: #ffffff;
	border: none;
	border-bottom:2px solid #008cff;
	color: #08b2ed;
	font-size: 16px !important;
	font-weight: 700;
	}
.btnblue {
	display: inline-block;
	background: #008cff;
    padding: 4px 12px;
    font-size: 16px;
    line-height: 18px;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #008cff;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
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
					<span class="pfwmt font-size18">Create Quote</span>
				</div>
				<!-- /.box-header -->
				<div class="box-body" style="padding-top: 0px">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#option1">Quote 1</a></li>
						<!--<li><a data-toggle="tab" href="#option2">Option 2</a></li>
						<li><a data-toggle="tab" href="#option3">Option 3</a></li>
						<li><a data-toggle="tab" href="#option4">Option 4</a></li>-->
					</ul>
					<br>
					<div class="tab-content">
						@include('query.edit_reference.option1')
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
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