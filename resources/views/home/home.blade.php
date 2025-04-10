@extends('layouts.front.master')
    
    <!-- websitenamehelpers -->
    @section("title", getWebsiteData('metaTitle_Home'))
    @section("title", getWebsiteData('metaKeywords_Home'))
    @section("title", getWebsiteData('metaDescription_Home'))

@section("custom_css")

<style type="text/css">
/* Ensure the placeholder text color is visible */
.select2-search__field::placeholder {
    color: #aaa;  /* Adjust to your desired color */
    font-style: italic;
    text-transform: none;
}

</style>

<!--holidays -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/holidays.css') }}" /> -->

<!-- mobile search panel -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/mobile-search-panel.css') }}" />

<!-- search panel -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/desktop-search-panel.css') }}" />

<!-- mobile subscription box -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/mobile-subscription.css') }}" />

<!-- search subscription box -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/desktop-subscription.css') }}" />

<!-- mobile home packages -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/mobile-home-packages.css') }}" />

<!-- desktop home packages -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/desktop-home-packages.css') }}" />

<!-- mobile promotion-goa -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/mobile-promotion.css') }}" />

<!-- desktop promotion-goa -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/desktop-promotion.css') }}" />

<!-- travel-insurance -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/travel-insurance.css') }}" />

<!-- carousel for testimonials -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/carousel.css') }}" />

@endsection

@section('header_datepicker_js')

<!-- placed in header tag -->
<!-- <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/date-picker-search-panel.js") }}'></script> -->

@endsection

@section('content')

<section>
	<!-- Home Page Content Starts (home.home desktop & mobile) -->
	<div>
		@include('home.desktop.desktopSearchPanel')
		@include('home.desktop.desktopSubscription')
		@include('home.desktop.desktopMidimage')
		@include('home.desktop.desktopPackages')
		@include('home.desktop.trendingHoneymoon')
		@include('home.desktop.desktopSectionGoa')
		@include('home.desktop.desktopTestimonials')
		<!--<div class="mid_img"></div>-->
	</div>
	<!-- Home Page Content Ends (desktop & mobile) -->

	<div class="testing">
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
		<!-- <input type="hidden" value="{{ url('/') }}" name="" id="testvalue"> -->
		<input type="hidden" id="APP_URL" value="{{ url('/') }}">
		<input type="hidden" id="SEARCH_DESTINATION_URL" value="{{ route('searchDestination') }}">
		<input type="hidden" id="SEARCH_THEME_URL" value="{{ route('searchTheme') }}">
	</div>
</section>

@endsection

@section("custom_js")
<!-- home page js starts -->

<!-- sticky web header -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/web-header.js") }}'></script>

<!-- search panel date picker -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/date-picker-search-panel.js") }}'></script>    

<!--page one script -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/pageone.js") }}'></script>

<!-- destination search -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/destination-search.js") }}'></script>

<!-- insurance guest box -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/insurance-guest-input.js") }}'></script>

<!-- home page js ends -->

@endsection