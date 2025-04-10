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

<section class="">
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
				<div class="tabcontent" id="tourQuote1" style="">
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

	<!-- raised concern -->
	<?php
		$previous_raises=DB::table('quote_raise_concern')->where('quotation_ref_no',$data1->quo_ref)->get();
	?>
	<div class="modal fade" id="previous_raise" role="dialog">
	    <div class="modal-dialog modal-dialog-centered" role="document">
	    	<!-- Modal content-->
	    	<div class="modal-content modalContent shadow-sm">
	    		<div class="modal-header modalTitle">
	    			<button type="button" class="modalClose" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	    			<h4 class="modal-title">Raised Concern</h4>
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

<!-- Raise Concern Modal -->
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


</section>

@endsection

@section("custom_js")

<!-- page script -->
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/tour-web-quote.js") }}'></script>

<script type="text/javascript">
	
if (jQuery(window).width() >= 992) {
    jQuery(".mobile_test_exp").html("");
} else {
    jQuery(".destop_test_exp").html("");
}

/*********/

// $(document).ready(function() {
//     $(".flightTiming").each(function() {
//         var mystring = $(this).html();
//         var new_string = mystring.replaceAll(' ', '');
//         $(this).html('').html(new_string);
//     });

//     $(".mflightTiming").each(function() {
//         var mystring = $(this).html();
//         var new_string = mystring.replaceAll(' ', '');
//         $(this).html('').html(new_string);
//     });
// });

// /*********/

// $(document).ready(function() {
// 	$(document).on("click", ".previous_raise", function() {
// 	    var quotation_ref_no = $(this).attr('id');
// 	    var APP_URL = $("#APP_URL").val();
	    
// 	    $.ajax({
// 	        url: APP_URL + '/get_previous_raise',
// 	        data: { quotation_ref_no: quotation_ref_no },
// 	        type: 'get',
// 	        // contentType: false,
// 	        // processData: false,

// 	        success: function(data) {
// 	            $(".previous_raise_data").html('').html(data);
// 	            $('#previous_raise').modal('toggle');
// 	        },
// 	        error: function(data) {
// 	            // Handle the error here
// 	        }
// 	    });
// 	});

// 	// *******

// 	$(document).on("submit", "#store_raise", function(event) {
// 	    event.preventDefault();

// 	    $('#myModal').modal('hide');

// 	    var form_data = new FormData($("#store_raise")[0]);
// 	    var APP_URL = $("#APP_URL").val();

// 	    $.ajax({
// 	        url: APP_URL + '/store_raise',
// 	        data: form_data,
// 	        type: 'post',
// 	        contentType: false,
// 	        processData: false,

// 	        success: function(data) {
// 	            $('#add_item_modal').modal('hide');
	            
// 	            if (data.message == 'success') {
// 	                swal({
// 	                    title: "Done !",
// 	                    text: "Successfully Submitted.",
// 	                    type: "success",
// 	                    timer: 2000
// 	                });

// 	                $(".btnRaiseConcern_button").html('').html(
// 	                    '<button type="button" class="btnMain btnRaiseConcern previous_raise" id="' + data.ref_no + '">&#x1F6C8;</button>'
// 	                );
// 	                // alert(data)
// 	                // location.reload()
// 	            } else {
// 	                swal({
// 	                    title: "Error !",
// 	                    text: data.message,
// 	                    type: "error",
// 	                    timer: 2000
// 	                });
// 	            }
// 	        },
// 	        error: function(data) {
// 	            // Handle the error here
// 	        }
// 	    });
// 	});

// 	// *******

//     // Disable quote_no input
//     $(".quote_no").attr("disabled", true);

//     $(document).on("click", ".pay_now", function() {
//         var unique_code = $(this).siblings(".unique_code").val();
//         var quote_no = $(this).siblings(".quote_no").val();
//         var token = jQuery('input[name="_token"]').val();
//         var content_action = jQuery(this).attr("content_action");

//         // Create form element
//         var form = document.createElement("form");
//         form.setAttribute("method", "post");
//         form.setAttribute("action", content_action);
//         form.setAttribute("target", "");

//         // Create and append token input
//         var hiddenField = document.createElement("input");
//         hiddenField.setAttribute("type", "hidden");
//         hiddenField.setAttribute("name", "_token");
//         hiddenField.setAttribute("value", token);
//         form.appendChild(hiddenField);

//         // Create and append quote_no input
//         var second_field = document.createElement("input");
//         second_field.setAttribute("type", "hidden");
//         second_field.setAttribute("name", "quote_no");
//         second_field.setAttribute("value", quote_no);
//         form.appendChild(second_field);

//         // Create and append unique_code input
//         var third_field = document.createElement("input");
//         third_field.setAttribute("type", "hidden");
//         third_field.setAttribute("name", "unique_code");
//         third_field.setAttribute("value", unique_code);
//         form.appendChild(third_field);

//         // Append form to body and submit
//         document.body.appendChild(form);
//         form.submit();
//     });
// });

// /*********/

// jQuery(document).ready(function() {
//     jQuery(document).on("click", ".user_quote_accept", function(e) {
//         e.preventDefault();

//         var token = jQuery('input[name="_token"]').val();
//         var content_id = jQuery(this).attr("content_id");
//         var content_action = jQuery(this).attr("content_action");

//         // Create form element
//         var form = document.createElement("form");
//         form.setAttribute("method", "post");
//         form.setAttribute("action", content_action);
//         form.setAttribute("target", "");

//         // Create and append token input
//         var hiddenField = document.createElement("input");
//         hiddenField.setAttribute("type", "hidden");
//         hiddenField.setAttribute("name", "_token");
//         hiddenField.setAttribute("value", token);
//         form.appendChild(hiddenField);

//         // Create and append quote_id input
//         var second_field = document.createElement("input");
//         second_field.setAttribute("type", "hidden");
//         second_field.setAttribute("name", "quote_id");
//         second_field.setAttribute("value", content_id);
//         form.appendChild(second_field);

//         // Append form to body and submit
//         document.body.appendChild(form);
//         // window.open('', 'view');
//         // window.open('','view');
//         form.submit();
//     });

//     // rejection reason
//     jQuery(".rejectionReasonCont").css('display', "none");
// });

// /*********/

// // foldable script
// document.addEventListener('DOMContentLoaded', function() {
//     const collapsibleButtons = document.querySelectorAll('.foldable');

//     collapsibleButtons.forEach(button => {
//         button.addEventListener('click', function() {
//             this.classList.toggle('active');
//             const content = this.nextElementSibling;
//             if (content.style.display === 'block') {
//                 content.style.display = 'none';
//                 content.style.maxHeight = '0';
//             } else {
//                 content.style.display = 'block';
//                 content.style.maxHeight = 'inherit';
//                 // Scroll the sub-content into view
//                 // const subContent = content.querySelector('.sub-content');
//                 // if (subContent) {
//                 // 	subContent.scrollIntoView({ behavior: 'smooth' });
//                 // }
//             }
//         });
//     });
// });

// tabs button script
// document.addEventListener('DOMContentLoaded', function () {
//     // Get all tablinks and add event listeners
//     var tablinks = document.getElementsByClassName("tablinks");

//     for (var i = 0; i < tablinks.length; i++) {
//         tablinks[i].addEventListener('click', function (event) {
//             var contentName = this.getAttribute('data-target');  // Use data-target to find content
//             openTab(event, contentName);
//         });
//     }

//     // Automatically click the default tab on load
//     var defaultTab = document.getElementById('defaultOpen');
//     var mdefaultTab = document.getElementById('mdefaultOpen');

//     if (defaultTab) {
//         defaultTab.click(); // Trigger click on the default tab (Desktop)
//     }

//     if (mdefaultTab) {
//         mdefaultTab.click(); // Trigger click on the default tab (Mobile)
//     }
// });

// function openTab(evt, contentName) {
//     var i, tabcontent, tablinks;
    
//     // Hide all tab content
//     tabcontent = document.getElementsByClassName("tabcontent");
//     for (i = 0; i < tabcontent.length; i++) {
//         tabcontent[i].style.display = "none";
//     }

//     // Remove "active" class from all tab links
//     tablinks = document.getElementsByClassName("tablinks");
//     for (i = 0; i < tablinks.length; i++) {
//         tablinks[i].className = tablinks[i].className.replace(" active", "");
//     }

//     // Show the clicked tab's content and add the "active" class to the tab
//     document.getElementById(contentName).style.display = "block";
//     evt.currentTarget.className += " active";
// }
</script>
@endsection