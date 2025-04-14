@extends('layouts.front.master')
 @if(env("WEBSITENAME")==1)
 @section('keywords','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
 @section('desc','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
 @section("title", 'The World Gateway')
 @elseif(env("WEBSITENAME")==0)
 @section('keywords','RapidexTravels, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
 @section('desc','RapidexTravels Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
 @section("title", 'RapidexTravels')
 @endif
 
@section("custom_css")

<!-- trip quote -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/trip-quote.css') }}" />

<style type="text/css">
	footer {
	    display: none;
	}


</style>

@endsection

@section('content')

<section>
	<?php
		$today=strtotime(date('Y-m-d', strtotime("-30 days")));
		$validity=strtotime(date("Y-m-d", strtotime(str_replace('/','-',$data1->option1_validaty))));
	?>
	@if($validity<=$today)
		@if (Sentinel::check())
			@if(Sentinel::getUser()->roles()->first()->slug == 'customer')

				@include("query.quotation_webpage.expired_modal")

			@endif

		@else

			@include("query.quotation_webpage.expired_modal")

		@endif
	@endif

	<!-- Desktop Tabs -->
	<div class="destop_test_exp">
		<div class="tour-quote-container">
			<div class="pageContainer">
				<div class="paddingTop10">
					<div class="tourQuoteRefCont">
						<h3 class="tourQuoteRefHeading">Reference ID #{{ $data1->quo_ref }}</h3>
						<ul class="flexCenter">
							<!-- Desktop Tab Links -->
							<li class="tablinks" id="defaultOpen" data-target="tourQuote1">Tour Quote</li>
						</ul>
					</div>
				</div>
				<div class="tabcontent" id="tourQuote1">
					@include("query.quotation_webpage.desktop.quote1-desktop")
				</div>
			</div>
		</div>
	</div>

	<!-- Mobile Tabs -->
	<div class="mobile_test_exp">
		<div class="m-quote-cont">
			<div class="mtourQuoteRefCont">
				<h3 class="mtourQuoteRefHeading">Reference ID #{{ $data1->quo_ref }}</h3>
			</div>
			<div class="mtourQuoteTabCont">
				<ul class="flexCenter">
					<!-- Mobile Tab Links -->
					<li class="tablinks" id="mdefaultOpen" data-target="mtourQuote1">Tour Quote</li>
				</ul>
			</div>
			<div>
				<div class="tabcontent" id="mtourQuote1">
					@include("query.quotation_webpage.mobile.quote1-mobile")
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ***************** -->

<!-- request raised modal -->
<?php $previous_raises=DB::table('quote_raise_concern')->where('quotation_ref_no',$data1->quo_ref)->get(); ?>
<div class="modal fade" id="previous_raise" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
	   	<!-- Modal content-->
	   	<div class="modal-content modalContent shadow-sm">
	   		<div class="modal-header modalTitle">
	   			<button type="button" class="modalClose" data-dismiss="modal" aria-label="Close">
	   				<span aria-hidden="true">&times;</span>
	   			</button>
	   			<h4 class="modal-title">Request Raised</h4>
	   		</div>
	   		<div class="modal-body">
	    		<ul class="previous_raise_data">
	    			@foreach($previous_raises as $previous_raise)
	    				<li>
	    					{{ $previous_raise->raise_concern }}
	    				</li>
	    			@endforeach
	    		</ul>
	    	</div>
	    </div>
	</div>
</div>

<!-- request call back modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="raiseConcernLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modalContent shadow-sm">
            <div class="modal-header modalHeader relativeCont">
                <h5 class="modal-title modalTitle" id="raiseConcernLabel">Request Call Back</h5>
                <button type="button" class="modalClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="store_raise" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="content_id" value="{{ CustomHelpers::custom_encrypt($data1->id) }}">

                    <!-- Modern styled radio buttons -->
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="priceHigh" name="raise" value="Price is high">
                        <label class="form-check-label" for="priceHigh">Trip price is more than my budget</label>
                    </div>
                   <!--  <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="bookedOther" name="raise" value="Booked with other">
                        <label class="form-check-label" for="bookedOther">Booked with other</label>
                    </div> -->
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="dateChanged" name="raise" value="Date Changed">
                        <label class="form-check-label" for="dateChanged">Trip date is changed</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="tourCancelled" name="raise" value="Tour Cancelled">
                        <label class="form-check-label" for="tourCancelled">Trip is cancelled</label>
                    </div>
                    <!-- <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="tourPostponed" name="raise" value="Tour Postponned">
                        <label class="form-check-label" for="tourPostponed">Trip is postponned</label>
                    </div> -->
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="destinationChanged" name="raise" value="Destination Changed">
                        <label class="form-check-label" for="destinationChanged">Trip destination is changed</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="callBack" name="raise" value="Want call back">
                        <label class="form-check-label" for="callBack">We want to confirm this booking</label>
                    </div>

                    <!-- Submit button -->
                    @if(Sentinel::getUser()->inRole('super_admin')
				        || Sentinel::getUser()->inRole('administrator')
				        || Sentinel::getUser()->inRole('supervisor'))
	                    <div class="btn-request-container">
	                    	<button type="submit" class="btn btn-primary btn-block">Submit</button>
	                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section("custom_js")

<!-- page script -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/tour-web-quote.js") }}'></script>

@endsection