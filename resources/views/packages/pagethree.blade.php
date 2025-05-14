@extends('layouts.front.masternofooter')

@if(env("WEBSITENAME")==1)
	@section('keywords',$details->meta_keyword)
	@section('desc',$details->meta_desc)
	@section("title", $details->meta_title)
@elseif(env("WEBSITENAME")==0)
	@section('keywords',$details->rapidex_meta_keyword)
	@section('desc',$details->rapidex_meta_desc)
	@section("title", $details->rapidex_meta_title)
@endif

<!-- section('custom_second_page_js') -->
<!-- <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery.noconflict.js") }}'></script> -->
<!-- endsection -->

@section("custom_css")

<!--pagethree css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/pagethree.css') }}" />

<!-- Image Gallery Modal Popup CSS -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/modal-popup-img-gallery.css') }}" />

<!--calender css start--third page-->
<link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/fullcalendar.min.css') }}" />

<!---->
<!--<link rel="stylesheet" href="{{ asset('/resources/assets/slick/css/slick.css') }}" />-->
<!--<link rel="stylesheet" href="{{ asset('/resources/assets/slick/css/slick-theme.css') }}" />-->
<!-- <link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style_nex.css') }}" /> -->
<!--<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/pagetwo.css') }}" />-->

<!-- Search Inputs Modal Popup CSS -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/modal-popup-search-inputs.css') }}" />

@endsection

@section('content')
<?php
$input_date = date('Y-m-d', strtotime('+60 days'));
if (Session::has('filtered_tour_date')) {
	$i_date = Session::get('filtered_tour_date');
    $input_date = date('Y-m-d', strtotime($i_date));
          }


?>

<section>
	<?php 

	$new_price=PackagePriceHelpers::get_new_pricing_data($details->id,$input_date); 

	?>
	<input type="hidden" name="" id="package_value" value="{{$id}}">

	@if($new_price!='na')
		<?php $new_second_price=PackagePriceHelpers::get_new_pricing_data($details->id,date('Y-m-d',$new_price['date'])); ?>
		<input type="hidden" id="given_year" name="" value="{{date('Y',$new_price['date'])}}">
		<input type="hidden" id="given_month" name="" value="{{date('m',$new_price['date'])}}">
		<input type="hidden" id="given_date" name="" value="{{date('d',$new_price['date'])}}">

		<input type="hidden" id="given_end_year" name="" value="{{date('Y',$new_price['end_date'])}}">
		<input type="hidden" id="given_end_month" name="" value="{{date('m',$new_price['end_date'])}}">
		<input type="hidden" id="given_end_date" name="" value="{{date('d',$new_price['end_date'])}}">

	@else

		<?php 
			$new_second_price=PackagePriceHelpers::get_new_pricing_data($details->id,$input_date);
			$futureDate=date('Y-m-d', strtotime('+1 year'));
		?>

		<input type="hidden" id="given_year" name="" value="{{date('Y', strtotime($input_date))}}">
		<input type="hidden" id="given_month" name="" value="{{date('m' , strtotime($input_date))}}">
		<input type="hidden" id="given_date" name="" value="{{date('d' , strtotime($input_date))}}">

		<input type="hidden" id="given_end_year" name="" value="{{date('Y',strtotime($futureDate))}}">
		<input type="hidden" id="given_end_month" name="" value="{{date('m',strtotime($futureDate))}}">
		<input type="hidden" id="given_end_date" name="" value="{{date('d',strtotime($futureDate))}}">

	@endif

	<!--Desktop Page-->
	<div class="destop_test_exp">
		<div class="dBGColor">

			@include('packages.thirdpagecontent.desktop.dTourDatePanel')

			<div class="dPageContainer">
				<div class="dTourDtlsCont">
					<!-- @if(session()->has('message'))
						<div class="alert alert-success">
							{{ session()->get('message') }}
						</div>
					@endif -->

					@include('packages.thirdpagecontent.desktop.dTourName')

					<div class="makeflex">
						<div class="dLeftContainer">
							@include('packages.thirdpagecontent.desktop.dTourImages')
							@include('packages.thirdpagecontent.desktop.dTourDetails')
							@include('packages.thirdpagecontent.desktop.dTourTabs')
						</div>

						<div class="dRightContainer">
							@include('packages.thirdpagecontent.desktop.dTourSidebar')
						</div>

					</div>
				</div>

				<!--D_Tour Gallery Modal starts-->
				@include('packages.thirdpagecontent.tour-gallery-popup.d-tour-gallery')

				<!--D_Tour Enquiry Modal ends-->
				@include('packages.thirdpagecontent.desktop.dTourEnquiry')
			</div>
		</div>
	</div>

	<!-- ***************** -->

	<!--Mobile Page-->
	<div class="mobile_test_exp">
		<div>
			<!-- @if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif -->

			@include('packages.thirdpagecontent.mobile.mTourImages')

			<div class="mContainer select-none">
				@include('packages.thirdpagecontent.mobile.mTourDetails')
				@include('packages.thirdpagecontent.mobile.mTourTabs')
			</div>

			@include('packages.thirdpagecontent.mobile.mPriceBar')

		</div>

		<!--M_Tour Gallery Modal starts-->
		@include('packages.thirdpagecontent.tour-gallery-popup.m-tour-gallery')
		<!--M_Tour Gallery Modal ends-->

		<!--M_Tour Search Inputs Modal starts-->
		@include('packages.thirdpagecontent.search-inputs-popup.m-tour-search-inputs')
		<!--M_Tour Search Inputs Modal ends-->

		@include('packages.thirdpagecontent.mobile.mTourEnquiry')

	</div>

	<!--Common Calendar Tour Enquiry and OTP-->
	@include('packages.thirdpagecontent.desktop.calendartourenquiry')
	@include('packages.thirdpagecontent.desktop.otp')

</section>
 
<div class="testing">
		<input type="hidden" id="test" name="" value="{{ url('/') }}">
		<input type="hidden" id="APP_URL" value="{{ url('/') }}">
	</div>

@endsection

@section('custom_js')

<!--Page Three-->
<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/pagethree.js") }}'></script>

<!--Get Modal-->
<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/get-modal.js") }}'></script>

<!--Image-slider-->
<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/content-slider.js") }}'></script>

<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery-ui.1.10.4.min.js") }}'></script>

<!-- Mobile Search Inputs Modal Popup JS -->
<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/modal-popup-search-inputs.js") }}'></script>

<!--Enquiry-->
<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/enquiry.js") }}'></script>

<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/moment.min.js") }}'></script>

<!--<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery.min.js") }}'></script>-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/fullcalendar.js") }}'></script>

<!--<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/gcal.js") }}'></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src='{{ asset("/resources/assets/slick/js/slick.js") }}'></script>-->

<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/pagethree_1.js") }}'></script>

@endsection