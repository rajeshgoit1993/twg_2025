@extends('layouts.front.masternoindex')

@section("custom_css")

<!-- contact-us-enquiry css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/contact-us-enquiry.css') }}" />

<!-- ui datepicker css -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/ui-datepicker.css') }}" /> -->

<!-- contact-us-enquiry css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/ui-datepicker-new-contact-us.css') }}" />

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> -->

<!-- <style type="text/css">
@media (max-width: 992px) {
	.ui-datepicker {
		width: 100% !important;
		left: 0 !important;
		top: 855px !important;
		height: auto;
 }
 @media (min-width: 992px) {
	.ui-datepicker {
		left: 545px !important;
		top: 620px !important;
 }
</style> -->

@endsection

@section('content')

<!--Breadcrumps-->
<div class="breadCrumpsCont">
	<div class="pageContainer">
		<div class="row">
			<div class="col-md-12">
				<div>
					<ul>
						<li><a href="{{ route('home') }}">Home /</a></li>
						<li class="active">Contact us</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- quick service enquiry starts -->
<!-- include('frontend.quickenquiry.quick-service-enquiry') -->
<!-- quick service enquiry ends -->

<!-- Quick Service Enquiry -->
<section class="mWhiteBG">
	<div class="pageContainer">
		<div class="quickEnqCon">
			<div class="col-md-9 noFloat centerBlock dEnqFormCont">
			<div class="enqryTtlCont">
				<h2>Start Planning Your Trip</h2>
				<h3>Get The Best Quote, Guranteed!</h3>
			</div>


			<form action="#" method="Post" id="enquiry_form" name="enquiry_form">
				{{ csrf_field() }}
				<!--@if(session()->has('message'))
					<div class="alert alert-success">
					{{ session()->get('message') }}
					</div>
				@endif -->
				@include('cms.form-contact')
				
			</form>
			</div>
		</div>
	</div>
</section>

<!--Contact Details-->
<!-- removed -->

<!-- google location map -->
<!-- <section class="mapCont">
	@if(env("WEBSITENAME")==1)
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.208970999417!2d77.35142401442873!3d28.65346098240954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfb2eb76f031f%3A0xa11086f8388220c4!2sThe+World+Gateway+(theworldgateway.com)!5e0!3m2!1sen!2sin!4v1538112314411" width="" height="" frameborder="0" style="border:0" allowfullscreen></iframe>
	@elseif(env("WEBSITENAME")==0)
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.2055317245763!2d77.35164931442873!3d28.653563982409544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfac0abc518bb%3A0x1702ec46d823bbe4!2sRapidex%20Travels!5e0!3m2!1sen!2sin!4v1568192236563!5m2!1sen!2sin" width="" height="" frameborder="0" style="border:0" allowfullscreen></iframe>
	@endif
</section> -->

@if(getWebsiteData('googlemap'))
	<section class="mapCont">
		{!! getWebsiteData('googlemap') !!}
	</section>
@endif


@endsection

@section('custom_js')

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<!-- Include jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- Include jQuery UI CSS -->
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/ui-datepicker.css') }}" /> -->
<!-- Include jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- contact-us-enquiry js -->
<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/contact-us-enquiry.js") }}'></script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
@endsection 