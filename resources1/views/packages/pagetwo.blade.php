@extends('layouts.front.master')

@if(count($data1) > 0)
    @php
        $seo = $data1->first(); // Use only the first entry
    @endphp
    @section('keywords', $seo->keywords)
    @section('desc', $seo->description)
    @section('title', $seo->title)
@else
    @section('keywords', getWebsiteData('keyword'))
    @section('desc', getWebsiteData('description'))
    @section('title', getWebsiteData('title'))
@endif

<!-- @if(count($data1) == 0)
    @section('keywords', getWebsiteData('keyword'))
    @section('desc', getWebsiteData('description'))
    @section('title', getWebsiteData('title'))
@else
    @foreach($data1 as $seo)
        @section('keywords', $seo->keywords)
        @section('desc', $seo->description)
        @section('title', $seo->title)
    @endforeach
@endif -->


@section('custom_second_page_js')

	<!-- <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery.noconflict.js") }}'></script> -->

	<!--second page (load content on scroll)-->
	<!--<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery-ui.1.10.4.min.js") }}'></script>-->

@endsection

@section("custom_css")

	<!--pagetwo css-->
	<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/pagetwo.css') }}" />

	<!-- Search Inputs Modal Popup CSS -->
	<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/modal-popup-search-inputs.css') }}" />

@endsection

@section('content')

	<?php
		use App\Icons;
		use App\Gtags;
		use App\Suitable;
		$icons = Icons::all();
		$generals = Gtags::all();
		$suitables = Suitable::all();
	?>

	<!-- loading more pacakges -->
	<div id="overlay"></div>

	<!--Desktop Page-->
	<div class="destop_test_exp">
		@include('packages.secondpage.desktop.dModifyPanel')
		@include('packages.secondpage.desktop.dTourName')
		@include('packages.secondpage.desktop.dFilterSorting')
		@include('packages.secondpage.desktop.dTourItemCard')
	</div>

	<!--Mobile Page-->
	<div class="mobile_test_exp">
		<div class="mBG">
			@include('packages.secondpage.mobile.mSorting')
			
			@include('packages.secondpage.mobile.mtourItemCard')
		</div>

		<!--Mobile Filter Starts-->
		@include('packages.secondpage.mobile.mFilterModal')
		<!--Mobile Filter Ends-->

		<!--Mobile Modify Search Starts-->
		@include('packages.secondpage.mobile.mModifySearchModal')
		<!--Mobile Modify Search Ends-->
	</div>

	<div class="testing">
		<!-- <input type="hidden" id="testvalue" name="" value="{{ url('/') }}"> -->
		<!-- <input type="hidden" id="APP_URL" value="{{ url('/') }}"> -->
		<input type="hidden" id="ROOT_URL" value="{{ route('home') }}">
		<input type="hidden" id="SEARCH_DESTINATION_URL" value="{{ route('searchDestination') }}">
		<input type="hidden" id="SEARCH_THEME_URL" value="{{ route('searchTheme') }}">
		<input type="hidden" id="LOAD_MORE_ITEM_URL" value="{{ route('loadMoreItem') }}">
	</div>

	<!-- placed in header tag -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
	<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->

@endsection

@section("custom_js")

	<!--Page Two-->
	<!-- <script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/pagetwo_1.js") }}'></script> -->
	<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/pagetwo.js") }}'></script>

	<!-- destination search (when enabled coming two boxes)-->
	<!-- <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/destination-search.js") }}'></script> -->

	<!--Filter Second Page-->
	<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/filter.js") }}'></script>

@endsection