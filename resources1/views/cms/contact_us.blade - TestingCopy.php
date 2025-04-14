@extends('layouts.front.masternoindex')
@section('content')
<style type="text/css">

.enqryTtlCont {
	display: flex;
	flex-direction: column;
	align-items: center;
	margin-bottom: 30px;
	}
.enqryTtlCont h2 {
	font-size: 24px;
	line-height: 26px;
	color: #000001;
	font-weight: 600;
	text-align: center;
	margin-bottom: 10px;
	text-transform: capitalize;
	}
.enqryTtlCont h3 {
	font-size: 16px;
	line-height: 18px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: center;
	margin-bottom: 0;
	text-transform: none;
	}
.guestInputCont {
	margin-bottom: 20px;
	}
.guestInputCont label {
    display: inline-block;
    font-size: 14px;
    line-height: 16px;
    font-weight: 600;
    color: #000001;
    margin-right: 0px !important;
    margin-bottom: 5px;
	}
.guestInputCont input[type=text] {
    padding: 6px 12px;
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 500;
    border: 1px solid #c8c8c8;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    cursor: text;
    height: 36px;
    background: #fff;
    text-transform: none;
    width: 100%;
    outline: 0;
	}
.guestInputCont select, .guestInputCont input[type=date] {
    padding: 6px 10px;
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 500;
    border: 1px solid #c8c8c8;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    cursor: default;
    height: 36px;
    background: #fff;
    text-transform: capitalize;
    width: 100%;
    outline: 0;
	}
.guestInputCont input[type=text]:focus, .guestInputCont .formTextarea:focus, .guestInputCont select:focus, .guestInputCont input[type=date]:focus {
	border-color: #4a4a4a;
	box-shadow: none;
	}
.formTextarea {
    padding: 6px 12px;
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 500;
    border: 1px solid #c8c8c8;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    cursor: text;
    height: auto;
    background: #fff;
    text-transform: none;
    width: 100%;
    overflow: auto;
    outline: 0;
	}
.inputError {
    color: red;
	font-size: 12px;
	line-height: 14px;
	}
.hotelPref, .flightPref {
    display: flex;
    align-items: center;
    column-gap: 15px;
	}
.hotelPref label,  .flightPref label {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 500;
    margin-bottom: 0;
    border: 1px solid #e7e7e7;
    border-radius: 5px;
    padding: 8px 10px;
    /*text-align: center;*/
    display: flex;
    align-items: center;
    justify-content: center;
	/*flex-shrink: 0;
	flex-grow: 1;*/
	height: 40px;
	width: 80px;
	}
.hotelPref input[type=radio], .flightPref input[type=radio] {
	height: 13px;
    width: 11px;
    margin-right: 5px;
    margin-top: 0;
	}
.hotelPref label:last-child, .flightPref label:last-child {
	margin-right: 0 !important;
	}
.guestMinus, .guestPlus {
    font-size: 26px;
    line-height: 15px;
    color: #9B9B9B;
    padding: 12px;
    font-weight: 900;
    cursor: pointer;
    user-select: none;
	}
.guestValue {
    font-size: 20px;
    line-height: 20px;
    color: #000001;
    font-weight: 900;
    padding: 10px 12px;
    user-select: none;
	}

/*Addition Requests*/
.addOnDtlsCont {
	display: flex;
	align-items: center;
	column-gap: 10px;
	}
.addOnDtlsCont label {
	border: 1px solid #e7e7e7;
    padding: 5px 10px;
    border-radius: 3px;
    color: #4a4a4a;
    font-size: 12px;
    line-height: 13px;
    font-weight: 600;
    display: flex;
    align-items: end;
	flex-shrink: 0;
	margin-bottom: 5px;
	}
.addOnDtlsCont input[type=checkbox] {
	margin-top: 0;
	margin-right: 5px;
	}

/*Enquiry Main*/
.dAcceptTerms {
	display: -webkit-inline-box;
    /*align-items: baseline;
	margin-bottom: 2px;*/
	}
.dAcceptTerms input[type=checkbox] {
	margin-top: 2px;
	}
.dAcceptTerms h5 {
	font-size: 14px;
    line-height: 18px;
    color: #000001;
    font-weight: 500;
    margin: 0;
    margin-left: 25px;
	}
.btnCont {
	text-align: center;
	margin-top: 25px;
	margin-bottom: 20px;
	}
.btnSubmitEnq {
	flex-shrink: 0;
	outline: 0;
	text-transform: none;
	background: #08B2ED;
	border: 0;
	box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    border-radius: 35px;
	padding: 12px;
    font-size: 17px;
	line-height: 17px;
	color: #fff;
	font-weight: 900;
	cursor: pointer;
	width: 225px;
	white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
	letter-spacing: 0.64px;
	margin-bottom: 0;
	height: auto;
	}
.btnSubmitEnq:hover {
	background: #08B2ED;
	color: #fff;
	}
.mapCont {
	width: 100%;
	height: 350px;
	}
.mapCont iframe {
	width: 100%;
	height: 350px;
	}

/*Budget*/
.budgetPriceBarBox {
    border: 1px solid #c8c8c8;
    border-radius: 4px;
	background: #fff;
	padding: 10px 15px 10px;
	width: 100%;
	position: absolute;
	z-index: 1;
	margin-top: 1px;
	}
.budgetSlider, .mbudgetSlider {
	margin: 20px 15px 15px;
	}
.rangeSection {
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 6px;
	margin-top: 10px;
	}
.defaulCurrency_slider:before {
	content: '\0020B9';
	font-size: 15px;
	line-height: 15px;
	font-weight: 500;
	}

/*custom checkmark*/
.checkmark.addOn-services {
	width: 15px;
	height: 14px;
	border: 1px solid #4a4a4a;
	border-radius: 2px;
	background-color: #fff;
	position: absolute;
	top: 7px;
	margin-left: 10px;
	}
.addOn-services-text {
	font-size: 12px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	margin: 0;
	margin-left: 20px;
	white-space: nowrap;
	}

/* 7.1. UI Slider ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
.ui-slider {
  position: relative;
  text-align: left;
  }
.ui-slider.ui-slider-horizontal {
  height: 4px;
  }
.ui-slider.ui-slider-horizontal .ui-slider-range {
  height: 100%;
  }
.ui-slider.ui-slider-horizontal .ui-slider-handle {
  /*margin-left: -10px;
  top: -7px;*/
  margin-left: 0;
  top: -5px;
  }
.ui-slider.ui-widget-content {
  -webkit-border-radius: 5px 5px 5px 5px;
  -moz-border-radius: 5px 5px 5px 5px;
  -ms-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  /*background: #434a54;*/
  background: #e9e9e9;
  }
.ui-slider .ui-slider-range {
  display: block;
  position: absolute;
  z-index: 1;
  border: none;
  background: #08B2ED;
  /*background: #b51319;*/
  -webkit-border-radius: 5px 5px 5px 5px;
  -moz-border-radius: 5px 5px 5px 5px;
  -ms-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  }
.ui-slider.slider-color-yellow .ui-slider-range {
  background: #fdb714;
  }
.ui-slider.slider-color-blue .ui-slider-range {
  background: #08B2ED;
  }
.ui-slider.slider-color-green .ui-slider-range {
  background: #FDB714;
  }
.ui-slider .ui-slider-handle {
  /*cursor: default;*/
  cursor: grab;
  position: absolute;
  z-index: 2;
  width: 14px !important;
  height: 14px !important;
  /*width: 20px;
  height: 20px;*/
  -webkit-border-radius: 50% 50% 50% 50%;
  -moz-border-radius: 50% 50% 50% 50%;
  -ms-border-radius: 50% 50% 50% 50%;
  border-radius: 50% 50% 50% 50%;
  /*background: #2d3e52;
  border: 2px solid #fff;*/
  background: #fff;
  border: 1px solid #bcbcbc;
  box-shadow: none;
  transform: translateX(-50%);
  touch-action: pan-x;
  }

/*Sweet Alert*/
.swal-button {
	background-color:#08B2ED;
	height: 36px;
	width: 60px;
	padding: 2px 10px;
	}
.swal-text {
	text-align: center;
	}
</style>

<style type="text/css">
@media (min-width: 0px) {
/* The checkmarkCont */
  .checkmarkCont {
    display: block;
    position: relative;
    cursor: default;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }
  /* Hide the browser's default checkbox */
  .checkmarkCont input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
    left: -999px;
    }
  /* Create a custom checkbox */
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    }
  .checkmark.signup-acceptance {
    width: 15px;
    height: 14px;
    border: 1px solid #4a4a4a;
    border-radius: 2px;
    background-color: #fff;
    position: absolute; /*can be removed*/
    top: 2px;
    }
  /* On mouse-over, add a grey background color */
  .checkmarkCont:hover input ~ .checkmark {
    background-color: #fff;
    }
  /* When the checkbox is checked, add a blue background */
  .checkmarkCont input:checked ~ .checkmark {
    background-color: #08B2ED;
    border-color: #08B2ED;
    }
  /* Create the checkmark/indicator (hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
    }
  /* Show the checkmark when checked */
  .checkmarkCont input:checked ~ .checkmark:after {
    display: block;
    }
  /* Style the checkmark/indicator */
  .checkmarkCont .checkmark:after {
    left: 4px;
    top: 0;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    }
  .acceptance-cont p {
    padding-left: 20px;
    font-size: 12px;
    line-height: 18px;
    color: #4a4a4a;
    font-weight: 500;
    text-align: left;
    margin: 0;
    }
}

/* Hide the default radio button */
.custom-selection input[type="radio"] {
	display: none;
	}

/* Style the custom selection button */
.custom-selection {
	display: inline-block;
	padding: 10px;
	border: 1px solid #ccc;
	border-radius: 5px;
	cursor: pointer;
	transition: background-color 0.0s;
	}

/* Define the class for the selected label */
.selected-item, .custom-selection:hover {
	background-color: #fff;
	color: #08B2ED !important;
	border-color: #08B2ED !important;
	font-weight: 600 !important;
	}
.custom-selection:hover {
	/*background-color: #08B2ED;
	color: #fff;*/
	}



/*----hotel selection------*/

/* Hide the default radio button */
.hotel-selection input[type="radio"] {
	display: none;
	}

/* Style the custom selection button */
.hotel-selection {
	display: inline-block;
	padding: 10px;
	border: 1px solid #ccc;
	border-radius: 5px;
	cursor: pointer;
	transition: background-color 0.0s;
	}

/* Define the class for the selected label */
.selected-item, .hotel-selection:hover {
	background-color: #fff;
	color: #08B2ED !important;
	border-color: #08B2ED !important;
	font-weight: 600 !important;
	}
.hotel-selection:hover {
	/*background-color: #08B2ED;
	color: #fff;*/
	}




/*----flight booking selection------*/

/* Hide the default radio button */
.flight-booking-selection input[type="radio"] {
	display: none;
	}

/* Style the custom selection button */
.flight-booking-selection {
	display: inline-block;
	padding: 10px;
	border: 1px solid #ccc;
	border-radius: 5px;
	cursor: pointer;
	transition: background-color 0.0s;
	}

/* Define the class for the selected label */
.selected-item, .flight-booking-selection:hover {
	background-color: #fff;
	color: #08B2ED !important;
	border-color: #08B2ED !important;
	font-weight: 600 !important;
	}
.flight-booking-selection:hover {
	/*background-color: #08B2ED;
	color: #fff;*/
	}
</style>

<style>
@media (max-width: 992px) {
	.whiteBG {
	    box-shadow: 0 1px 7px 0 rgba(0, 0, 0, 0.2);
	    background-color: #fff;
	    position: relative;
	    z-index: 13;
	    position: sticky;
	    top: 0;
	    }
	.breadCrumpsCont {
		display: none;
		}
	.quickEnqCon {
		margin-top: 20px;
		margin-bottom: 0;
	}
}
@media (min-width: 992px) {
.breadCrumpsCont {
	background: #f2f2f2;
	}
.pageContainer {
	width: 1200px;
	margin: 0 auto;
	}
.breadCrumpsCont ul li {
	display: inline-block;
    padding: 15px 0px;
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 500;
	}
.breadCrumpsCont ul li a:hover {
	color: #008cff;
	}
.breadCrumpsCont ul .active {
	color: #008cff;
	font-size: 16px;
	line-height: 16px;
	text-transform: none;
	}
.centerBlock {
	display: block;
    margin-right: auto;
    margin-left: auto;
	}
.noPadding {
	padding: 0 !important;
	}
.noFloat {
    float: none !important;
	}
.dEnqFormCont {
	border: 1px solid #ccc;
	border-radius: 10px;
	padding: 20px 20px;
	}
.quickEnqCon {
	margin-top: 20px;
	margin-bottom: 25px;
	}
}
</style>

<style type="text/css">
.guestInputCont .select-arrow.down {
	position: relative;
	}
.guestInputCont select {
	appearance: none;
	}
.guestInputCont select::-ms-expand {
	display: none;
	}
.guestInputCont input:focus, .guestInputCont select:focus{
	box-shadow: none;
	border-color: #001;
	}
.guestInputCont .select-arrow:before {
	display: inline-block;
	padding: 3px;
	content: '';
	border: solid #757575;
	border-width: 0 2px 2px 0;
	transform: rotate(45deg);
	-webkit-transform: rotate(45deg);
	vertical-align: top;
	margin-left: 8px;
	transition: all 0.3s ease-in-out;
	position: relative;
	top: 1px;
	pointer-events: none;
	}
.guestInputCont .select-arrow.down:before {
	position: absolute;
	/*top: 34px;
	right: 30px;*/
	top: 13px;
	right: 10px;
	z-index: 1;
	}
.icon-input-group {
	/* position: relative; */
	display: flex;
	border-collapse: separate;
	height: 36px;
	border: 1px solid #c8c8c8;
	border-radius: 4px;
	overflow: hidden;
	width: 100%;
	}
.icon-input-group-addon {
	padding: 6px 15px;
	font-size: 14px;
	font-weight: 400;
	line-height: 1;
	color: #555;
	text-align: center;
	background-color: #f9f9f9;
	width: 35px;
	white-space: nowrap;
	vertical-align: middle;
	display: table-cell;
	height: auto;
	border-right: 1px solid #c8c8c8;
	}
.rupee-container::before {
	content: "₹";
	font-family: Arial, sans-serif;
	font-size: 18px;
	color: black;
	position: absolute;
	top: 9px;
	left: 13px;
}
/* custom select */
.custom-select {
	position: relative;
  	}
.custom-select.open{
  	/*display: block;*/
	}
.custom-select .selected, .custom-select .option {
	padding: 10px;
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 500;
    border: 1px solid #c8c8c8;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    height: 36px;
    background-color: #fff;
    text-transform: none;
    width: 100%;
    outline: 0;
    cursor: pointer;
	}
.custom-select .option {
	padding: 7px 10px;
	cursor: pointer;
	border: none;
	height: auto;
	}
.custom-select .options {
	display: none;
	position: absolute;
	z-index: 2;
	top: 100%;
	left: 0;
	right: 0;
	background-color: #fff;
	border: 1px solid #ccc;
	max-height: 345px;
	overflow: auto;
	border-radius: 4px;
    margin-top: 1px;
	}
.custom-select .option:hover, .custom-select .option.selected {
	background-color: #f0f0f0;
	}


.custom-select .options.active {
	display: block !important;
}




/*budget-slider*/
.budget-slider-container {
	margin-bottom: 20px;
	}
.selected-budget {
	width: 80px;
	text-align: center;
	margin-top: 5px;
	}
/* Styles for the slider track */
.budgetSlider {
	-webkit-appearance: none;
	appearance: none;
	width: 100%;
	height: 6px;
	border-radius: 5px;
	background: #d3d3d3;
	outline: none;
	opacity: 0.7;
	-webkit-transition: .2s;
	transition: opacity .2s;
	padding: 0;
	margin: 0;
    margin-top: 10px;
    border: none;
    /*background-color: #08B2ED;*/
	}

/* Styles for the slider thumb */
.budgetSlider::-webkit-slider-thumb {
	-webkit-appearance: none;
	appearance: none;
	width: 20px;
	height: 20px;
	border-radius: 50%;
	background: #08B2ED;
	cursor: grab;
	box-shadow: 0 0 6px 0 rgba(0, 0, 0, .2) !important;
    border-width: 0 !important;
	}

.budgetSlider::-moz-range-thumb {
	width: 20px;
	height: 20px;
	border-radius: 50%;
	background: #08B2ED;
	cursor: grab;
	box-shadow: 0 0 6px 0 rgba(0, 0, 0, .2) !important;
    border-width: 0 !important;
	}
</style>

<!--Breadcrumps-->
<div class="breadCrumpsCont">
	<div class="pageContainer">
		<div class="row">
			<div class="col-md-12">
				<div>
					<ul>
						<li><a href="{{ url('/') }}">Home /</a></li>
						<li class="active">Contact us</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!--Quick Enquiry-->
<section class="mWhiteBG">
	<div class="pageContainer">
		<div class="quickEnqCon">
			<div class="col-md-9 noFloat centerBlock dEnqFormCont">
			<div class="enqryTtlCont">
				<h2>Start Planning Your Trip</h2>
				<h3>Get The Best Quote, Guranteed!</h3>
			</div>
			<form action="#" method="Post" id="enquiry_form" name="enquiry_form">
			{{csrf_field()}}
				@if(session()->has('message'))
					<div class="alert alert-success">
					{{ session()->get('message') }}
					</div>
				@endif
				<div class="flex-row-multicolum appendTop10">
					<!-- service type -->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="service_type">Service</label>
							<!-- HTML structure for custom select options -->
							<input type="hidden" id="service_type" name="service_type" value="Tour Package" required>
							<div class="select-arrow down custom-select" id="service_type_select" data-hidden-input="service_type">
							    <div class="selected">Select Service</div>
							    <div class="options">
							        <div class="option" data-value="Tour Package">Tour Package</div>
							        <div class="option" data-value="Accommodation">Hotels, Resorts & Villa</div>
							        <div class="option" data-value="Visa">Visa</div>
							        <div class="option" data-value="Cruise">Cruise</div>
							        <div class="option" data-value="Travel_Insurance">Travel Insurance</div>
							    </div>
							</div>
							<span class="inputError" id="service_type_error"></span>
						</div>
					</div>
					<!-- channel type -->
					<div class="flex-col-md-6">
					    <div class="guestInputCont">
					        <label for="channel_type_select">Channel</label>
					        <div class="select-arrow down custom-select" id="channel_type_select" data-hidden-input="service_type">
					            <div class="selected">Select channel type</div>
					            <div class="options">
					                <div class="option" data-value="B2C">B2C</div>
					                <div class="option" data-value="B2B">B2B</div>
					                <div class="option" data-value="Corporate">Corporate</div>
					            </div>
					        </div>
					        <input type="hidden" id="channel_type" name="channel_type" value="B2C">
					        <span class="inputError" id="channel_type_error"></span>
					    </div>
					</div>
					<!--Name-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="name">Name</label>
							<input type="text" id="name" name="name" placeholder="Enter your full name" tabindex="0" />
							<span class="inputError" id="name_error"></span>
						</div>
					</div>
					<!--Email-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="email">Email ID</label>
							<input type="text" id="email" name="email" placeholder="Enter your email id" tabindex="0"/>
							<span class="inputError" id="email_error"></span>
						</div>
					</div>
					<!--Mobile-->
					<div class="flex-col-md-6">
					    <div class="guestInputCont">
					        <label for="mobile">Mobile No</label>
					        <div class="makeflex">
					            <div class="select-arrow down" id="country_code_select_container" style="width: 40%; margin-right: 5px; position: relative;">
					                <select id="country_code" name="country_code"></select>
					            </div>
					            <input type="text" name="mobile" id="mobile" placeholder="Enter Your Mobile No" maxlength="10" style="width: 55%;" />
					        </div>
					        <span class="inputError" id="mobile_error"></span>
					    </div>
					</div>
					<!-- connect time -->
					<div class="flex-col-md-6">
					    <div class="guestInputCont">
					        <label for="time_call_select">Connect Time</label>
					        <div id="time_call_select" class="select-arrow down custom-select" tabindex="0">
					            <div class="selected">Select time to call</div>
					            <div class="options">
					                <div class="option" data-value="09 - 11 AM">Between 09 - 11 AM</div>
									<div class="option" data-value="11 - 01 PM">Between 11 - 01 PM</div>
									<div class="option" data-value="01 - 03 PM">Between 01 - 03 PM</div>
									<div class="option" data-value="03 - 05 PM">Between 03 - 05 PM</div>
									<div class="option" data-value="05 - 07 PM">Between 05 - 07 PM</div>
									<div class="option" data-value="07 - 09 PM">Between 07 - 09 PM</div>
					            </div>
					        </div>
					        <input type="hidden" id="time_call" name="time_call" value="">
					        <span class="inputError" id="time_call_error"></span>
					    </div>
					</div>
					<!-- Nationality -->
					<div class="flex-col-md-6">
					    <div class="guestInputCont">
					        <label for="country_of_residence">Nationality</label>
					        <div class="select-arrow down custom-select" id="country_of_residence_select" tabindex="0">
					            <div class="selected">Select nationality</div>
					            <div class="options">
					                <!-- Options will be dynamically populated here -->
					            </div>
					        </div>
					        <!-- Original select element -->
					        <select class="formSelect" id="country_of_residence" name="country_of_residence" style="display: none;"></select>
					        <span class="inputError" id="country_of_residence_error"></span>
					    </div>
					</div>
					<!--Destination-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="destinations">Destination</label>
							<input type="text" id="destinations" name="destinations" placeholder="Enter destination" />
							<span class="inputError" id="destinations_error"></span>
						</div>
					</div>
					<!--Travel Date-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="date_arrival">Travel Date</label>
							<input type="date" id="date_arrival" name="date_arrival" placeholder="Enter Travel Date" />
							<!--<div class="bfh-datepicker date_arrival" id="date_arrival"  data-format="d/ m/ y" data-name="date_arrival"  data-placeholder="Choose Arrival Date" data-date="" style="border-style: none;"></div>-->
							<span class="inputError" id="date_arrival_error"></span>
						</div>
					</div>
					<!--Departure From-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="city_of_residence">Starting City</label>
							<input type="text" id="city_of_residence" name="city_of_residence" placeholder="Enter departure city" />
							<span class="inputError" id="city_of_residence_error"></span>
						</div>
					</div>
					<!--Duration-->
					<!-- <div class="flex-col-md-6" id="displayDuration">
						<div class="guestInputCont">
							<label for="duration">Tour Duration</label>
							!--<input type="text" id="duration" name="duration" placeholder="Enter duration" />--
							<select id="duration" name="duration">
								<option value="0">Select Duration</option>
								@for($i=1;$i<=20;$i++)
									@if($i==1)
									<option value="{{ $i+1 }} days">{{ $i }} Night / {{ $i+1 }} Days</option>
									@else
									<option value="{{ $i+1 }} days">{{ $i }} Nights / {{ $i+1 }} Days</option>
									@endif
								@endfor;
							</select>
							<span class="inputError" id="duration_error"></span>
						</div>
					</div> -->
					<!-- <div class="flex-col-md-6 appendBottom20" id="displayDuration">
						<div class="guestInputCont" style="margin: 0;">
							<label for="duration">Duration</label>
							<input type="hidden" id="duration" name="duration">
							<div class="select-arrow down custom-select" required tabindex="0">
								<div class="selected">Select Duration</div>
								<div class="options">
									!-- Options will be added dynamically using JavaScript --
								</div>
							</div>
							<span class="inputError" id="duration_error"></span>
						</div>
					</div> -->

					<!-- <div class="flex-col-md-6 appendBottom20" id="displayDuration">
					    <div class="guestInputCont" style="margin: 0;">
					        <label for="duration">Duration</label>
					        <input type="hidden" id="duration" name="duration">
					        <div class="select-arrow down custom-select" required tabindex="0">
					            <div class="selected" onclick="toggleDropdown()">Select Duration</div>
					            <div class="options" id="durationOptions">
					                !-- Options will be added dynamically using JavaScript --
					            </div>
					        </div>
					        <div id="customDurationInput" style="display:none; margin-top: 10px;">
					            <label for="customDurationDays">Enter Custom Duration (Days):</label>
					            <input type="number" id="customDurationDays" name="customDurationDays" min="1" placeholder="Number of Days" onchange="updateDuration()">
					        </div>
					        <span class="inputError" id="duration_error"></span>
					    </div>
					</div> -->

					<div class="flex-col-md-6 appendBottom20" id="displayDuration">
					    <div class="guestInputCont" style="margin: 0;">
					        <label for="duration">Duration</label>
					        <input type="hidden" id="duration" name="duration">
					        <!-- <div class="select-arrow down custom-select" required tabindex="0"> -->
					        	<div class="select-arrow down custom-select" id="service_type_select" data-hidden-input="service_type" required tabindex="0">
					            <div class="selected">Select Duration</div>
					            <div class="options" id="durationOptions">
					                <!-- Options will be added dynamically using JavaScript -->
					            </div>
					        </div>
					        <span class="inputError" id="duration_error"></span>
					    </div>
					</div>


					<!-- expected budget -->
					<!-- <div class="flex-col-md-6" id="displayBudget">
						<div class="relativeCont appendBottom20">
							<div class="guestInputCont" style="margin-bottom: 0;">
								<label for="budget">Budget&nbsp;<span class="font12 fontItalic">per person</span></label>
								<input type="text" id="budget" name="budget" placeholder="Enter Your Budget" />
								<span class="inputError" id="budget_error"></span>
							</div>
							<div class="budgetPriceBarBox" style="display: none">
								<div id="price-ranges" class="budgetSlider"></div>
								<div class="rangeSection">
									<span class="min-price-label defaulCurrency_slider"></span>
									<span class="max-price-label defaulCurrency_slider"></span>
								</div>
							</div>
							<div class="budget-slider-container" id="budgetContainer">
							    <input type="range" min="5000" max="100000" value="5000" class="budget-slider" id="budgetRange">
							    <input type="text" id="selectedBudget" class="selected-budget" value="$5,000">
							</div>
						</div>
					</div> -->
					<!-- expected budget -->
					<div class="flex-col-md-6" id="displayBudget">
					    <div class="relativeCont appendBottom20">
					        <div class="guestInputCont" style="margin-bottom: 0;">
					            <label for="exp_budget">Budget&nbsp;<span class="font12 fontItalic">per person</span></label>
					            <div class="select-arrow down" tabindex="0">
					            	<div class="icon-input-group">
										<span class="icon-input-group-addon rupee-container" aria-hidden="true"></span>
										<input type="text" id="exp_budget" name="exp_budget" placeholder="Select your budget" style="border: none;" readonly/>
									</div>
					        	</div>
					        </div>
					        <span class="inputError" id="budget_error"></span>
					        <div class="budgetPriceBarBox" id="budgetSliderContainer" style="display: none;">
					            <input type="range" min="3000" max="300000" value="3000" class="budgetSlider" id="budgetSlider">
					            <div class="rangeSection">
                					<span class="min-price-label defaulCurrency_slider">&nbsp;3,000</span>
                					<span class="max-price-label defaulCurrency_slider">&nbsp;300,000</span>
					            </div>
					        </div>
					    </div>
					</div>

					<!-- Cruise Lines -->
					<div class="flex-col-md-6 d-none" id="displayCruiseLine">
					    <div class="guestInputCont">
					        <label for="cruiseline_select">Cruise Lines</label>
					        <div id="cruiseline_select" class="select-arrow down custom-select">
					            <div class="selected">Select Cruise Lines</div>
					            <div class="options">
					                <div class="option" data-value="">Select Cruise Lines</div>
					                <div class="option" data-value="Any">Any</div>
					                <div class="option" data-value="Cordeila">Cordeila Cruises</div>
					                <div class="option" data-value="Resort World">Resort World Cruises</div>
					                <div class="option" data-value="Royal Caribbean">Royal Caribbean Cruises</div>
					                <div class="option" data-value="Celebrity">Celebrity Cruises</div>
					                <div class="option" data-value="Azamara Club">Azamara Club Cruises</div>
					                <div class="option" data-value="Norwegian">Norwegian Cruise Line</div>
					            </div>
					        </div>
					        <input type="hidden" id="cruiseline" name="cruiseline" value="">
					        <span class="inputError" id="cruiseline_error"></span>
					    </div>
					</div>
					<!-- Cruise Cabin Type -->
					<div class="flex-col-md-6 d-none" id="displayCruiseCabin">
					    <div class="guestInputCont">
					        <label for="cruisecabin_select">Cruise Cabin</label>
					        <div id="cruisecabin_select" class="select-arrow down custom-select">
					            <div class="selected">Select Cabin Type</div>
					            <div class="options">
					                <div class="option" data-value="">Select Cabin Type</div>
					                <div class="option" data-value="Any">Any</div>
					                <div class="option" data-value="Interior">Interior</div>
					                <div class="option" data-value="Oceanview">Oceanview</div>
					                <div class="option" data-value="Balcony">Balcony</div>
					                <div class="option" data-value="Suite">Suite</div>
					            </div>
					        </div>
					        <input type="hidden" id="cruisecabin" name="cruisecabin" value="">
					        <span class="inputError" id="cruisecabin_error"></span>
					    </div>
					</div>

					<!-- Visa Type -->
					<div class="flex-col-md-6 d-none" id="displayVisaType">
					    <div class="guestInputCont">
					        <label for="visatype_select">Visa Type</label>
					        <div id="visatype_select" class="select-arrow down custom-select">
					            <div class="selected">Select Visa</div>
					            <div class="options">
					                <div class="option" data-value="">Select Visa</div>
					                <div class="option" data-value="Tourist">Tourist</div>
					                <div class="option" data-value="Business">Business</div>
					                <div class="option" data-value="Student" disabled>Student</div>
					                <div class="option" data-value="Transit">Transit</div>
					            </div>
					        </div>
					        <input type="hidden" id="visatype" name="visatype" value="">
					        <span class="inputError" id="visatype_error"></span>
					    </div>
					</div>
					<!-- Visa Entry -->
					<div class="flex-col-md-6 d-none" id="displayVisaEntry">
					    <div class="guestInputCont">
					        <label for="visaentry_select">Visa Entry</label>
					        <div id="visaentry_select" class="select-arrow down custom-select">
					            <div class="selected">Select Entry Type</div>
					            <div class="options">
					                <div class="option" data-value="">Select Entry Type</div>
					                <div class="option" data-value="Single Entry">Single Entry</div>
					                <div class="option" data-value="Multiple Entry">Multiple Entry</div>
					            </div>
					        </div>
					        <input type="hidden" id="visaentry" name="visaentry" value="">
					        <span class="inputError" id="visaentry_error"></span>
					    </div>
					</div>
					<!-- Visa Express Service -->
					<div class="flex-col-md-6 d-none" id="displayVisaService">
					    <div class="guestInputCont">
					        <label for="visaservice_select">Visa Service</label>
					        <div id="visaservice_select" class="select-arrow down custom-select">
					            <div class="selected">Select Service</div>
					            <div class="options">
					                <div class="option" data-value="">Select Service</div>
					                <div class="option" data-value="Normal">Normal Service</div>
					                <div class="option" data-value="Express">Express Service</div>
					            </div>
					        </div>
					        <input type="hidden" id="visaservice" name="visaservice" value="">
					        <span class="inputError" id="visaservice_error"></span>
					    </div>
					</div>

					<!--hotel preference-->
					<div class="flex-col-md-6 d-none" id="displayhtlpref">
						<div class="guestInputCont">
							<label for="hotelpreference">Hotel Preference</label>
							<div class="hotelPref">
								<label class="hotel-selection" tabindex="0">
									<input type="radio" value="3" name="hotel_pre" tabindex="0">3 Star
								</label>
								<label class="hotel-selection" tabindex="0">
									<input type="radio" value="4" name="hotel_pre" tabindex="0">4 Star
								</label>
								<label class="hotel-selection" tabindex="0">
									<input type="radio" value="5" name="hotel_pre" tabindex="0">5 Star
								</label>
							</div>
							<span class="inputError" id="hotelpreference_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6"></div>

					<!-- Flight Booking -->
					<div class="flex-col-md-6" id="displayfltbkngpref">
						<div class="guestInputCont">
							<label for="flightbookingpreference">Have you booked the flight tickets?</label>
							<div class="flightPref">
								<label class="flight-booking-selection" tabindex="0">
									<input type="radio" value="0" name="flight_booking" tabindex="0">Yes
								</label>
								<label class="flight-booking-selection" tabindex="0">
									<input type="radio" value="1" name="flight_booking" tabindex="0">No
								</label>
							</div>
						</div>
					</div>
					<div class="flex-col-md-6"></div>

					<!-- Additional Request Textarea -->
					<!-- <textarea class="formTextarea" type="text" id="additionaletails" name="additionaletails" placeholder="Enter additional requests (if any)"></textarea> -->
					<!-- Flight Booking -->
					<!-- <div class="flex-col-md-12">
					    <div class="guestInputCont">
					        <label for="flightBooked">Have you booked the flight?</label>
					        <div id="flightBooked" class="flight-booking-options">
					            <button type="button" class="flight-booking-option" data-value="yes">Yes</button>
					            <button type="button" class="flight-booking-option" data-value="no">No</button>
					        </div>
					        <input type="hidden" id="flightBookedValue" name="flightBookedValue" value="">
					        <span class="inputError" id="flightBooked_error"></span>
					    </div>
					</div> -->

					<!-- <div class="flex-col-md-6"></div> -->
					<!-- No of Traveller -->
					<!-- <div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="travellers">No of Traveller(s)</label>
							<div class="flexCenter mobscroll" style="overflow-x: auto;" tabindex="0">
								<div class="flex-column-center appendRight20">
									<input type="hidden" id="travellers" name="span_value_adult" class="span_value_adult1" value="2" tabindex="0" />
									<div class="flexCenter">
										<span class="guestMinus span_des_adult">&#8722;</span>
										<span class="guestValue span_value_adult">2</span>
										<span class="guestPlus span_inc_adult">&#43;</span>
									</div>
									<div class="guestType textCenter" id="adult">Adult<br>(+12yrs)</div>
								</div>
								<div class="flex-column-center appendRight20">
									<input type="hidden" id="travellers" name="span_value_child" class="span_value_child1" value="0" tabindex="0" />
									<div class="flexCenter">
										<span class="guestMinus span_des_child">&#8722;</span>
										<span class="guestValue span_value_child">0</span>
										<span class="guestPlus span_inc_child">&#43;</span>
									</div>
									<div class="guestType textCenter" id="childwithbed">Child with bed<br>(2-12yrs)</div>
								</div>
								<div class="flex-column-center appendRight20">
									<input type="hidden" id="travellers" name="span_value_child_without_bed" class="span_value_child2" value="0" tabindex="0" />
									<div class="flexCenter">
										<span class="guestMinus span_des_child_without_bed">&#8722;</span>
										<span class="guestValue span_value_child_without_bed">0</span>
										<span class="guestPlus span_inc_child_without_bed">&#43;</span>
									</div>
									<div class="guestType textCenter" id="childwithoutbed">Child without bed<br>(2-12yrs)</div>
								</div>
								<div class="flex-column-center">
									<input type="hidden" id="travellers" name="span_value_infant" class="span_value_infant1" value="0" tabindex="0" />
									<div class="flexCenter">
										<span class="guestMinus span_des_infant">&#8722;</span>
										<span class="guestValue span_value_infant">0</span>
										<span class="guestPlus span_inc_infant">&#43;</span>
									</div>
									<div class="guestType textCenter" id="infant">Infant<br>(0-2yrs)</div>
								</div>
							</div>
							<span class="inputError" id="travellers_error"></span>
						</div>
					</div> -->
					<!-- No of Traveller -->
					<div class="flex-col-md-12">
					    <div class="guestInputCont">
					        <label for="travellers">No of Traveller(s)</label>
					        <div class="flexCenter mobscroll" style="overflow-x: auto;" tabindex="0">
					            <div class="flex-column-center appendRight20" id="adlt_traveller">
					                <input type="hidden" name="span_value_adult" class="span_value_adult1" value="2" tabindex="0" />
					                <div class="flexCenter">
					                    <span class="guestMinus span_des_adult">&#8722;</span>
					                    <span class="guestValue span_value_adult">2</span>
					                    <span class="guestPlus span_inc_adult">&#43;</span>
					                </div>
					                <div class="guestType textCenter" id="adult">Adult<br>(+12yrs)</div>
					            </div>
					            <div class="flex-column-center appendRight20" id="cwb_traveller">
					                <input type="hidden" name="span_value_child" class="span_value_child1" value="0" tabindex="0" />
					                <div class="flexCenter">
					                    <span class="guestMinus span_des_child">&#8722;</span>
					                    <span class="guestValue span_value_child">0</span>
					                    <span class="guestPlus span_inc_child">&#43;</span>
					                </div>
					                <div class="guestType textCenter" id="childwithbed">Child with bed<br>(2-12yrs)</div>
					            </div>
					            <div class="flex-column-center appendRight20" id="cwob_traveller">
					                <input type="hidden" name="span_value_child_without_bed" class="span_value_child2" value="0" tabindex="0" />
					                <div class="flexCenter">
					                    <span class="guestMinus span_des_child_without_bed">&#8722;</span>
					                    <span class="guestValue span_value_child_without_bed">0</span>
					                    <span class="guestPlus span_inc_child_without_bed">&#43;</span>
					                </div>
					                <div class="guestType textCenter" id="childwithoutbed">Child without bed<br>(2-12yrs)</div>
					            </div>
					            <div class="flex-column-center" id="infnt_traveller">
					                <input type="hidden" name="span_value_infant" class="span_value_infant1" value="0" tabindex="0" />
					                <div class="flexCenter">
					                    <span class="guestMinus span_des_infant">&#8722;</span>
					                    <span class="guestValue span_value_infant">0</span>
					                    <span class="guestPlus span_inc_infant">&#43;</span>
					                </div>
					                <div class="guestType textCenter" id="infant">Infant<br>(0-2yrs)</div>
					            </div>
					        </div>
					        <span class="inputError" id="travellers_error"></span>
					    </div>
					</div>
					<!--additional Requests-->
					<div class="flex-col-md-12">
						<div class="guestInputCont appendTop5 appendBtm20">
							<label for="additionaldetails">Additional Request&nbsp;<span class="colorA1 d-none">(subject to availability)</span></label>
							<div id="tourAdtnlDtls">
								<div class="addOnDtlsCont mobscroll scrollX">
									<!-- <label for="flightbooked" id="displayflightbooked" style="display: none">
										<input type="checkbox" id="flightbooked" name="flightbooked" class="additional_details" value="Flight Ticket Booked">Flights Booked
									</label> -->
									<label class="checkmarkCont">
										<!-- <input type="checkbox" id="flightbooked" name="flightbooked" class="additional_details" value="Business Trip"> -->
										<input type="checkbox" class="additional_details" value="Business Tour">
										<span class="checkmark addOn-services"></span>
										<span class="addOn-services-text">Business Tour</span>
									</label>

									<!-- <label for="childbed" id="displaychildbed" style="display: none">
										<input type="checkbox" class="additional_details" id="childbed" name="childbed" value="1 Extra Bed Required for Child">Child Extra Bed
									</label> -->
									<label class="checkmarkCont">
										<!-- <input type="checkbox" class="additional_details" id="childbed" name="childbed" value="Family Trip"> -->
										<input type="checkbox" class="additional_details" value="Family Tour">
										<span class="checkmark addOn-services"></span>
										<span class="addOn-services-text">Family Tour</span>
									</label>
									<!-- <label for="leisure" id="displayleisure" style="display: none">
										<input type="checkbox" class="additional_details" id="leisure" name="leisure" value="Family Trip">Family Trip
									</label> -->
									<label class="checkmarkCont">
										<!-- <input type="checkbox" class="additional_details" id="leisure" name="leisure" value="Leisure Trip"> -->
										<input type="checkbox" class="additional_details" value="Leisure Tour">
										<span class="checkmark addOn-services"></span>
										<span class="addOn-services-text">Leisure Tour</span>
									</label>

									<!-- <label for="honeymoon" id="displayhoneymoon" style="display: none">
									<input type="checkbox" class="additional_details" id="honeymoon" name="honeymoon" value="Honeymoon Trip">Honeymoon
									</label> -->
									<label class="checkmarkCont">
										<!-- <input type="checkbox" class="additional_details" id="honeymoon" name="honeymoon" value="Honeymoon Trip"> -->
										<input type="checkbox" class="additional_details" value="Honeymoon Tour">
										<span class="checkmark addOn-services"></span>
										<span class="addOn-services-text">Honeymoon Tour</span>
									</label>
								</div>
							</div>
							<textarea class="formTextarea" type="text" id="additionaldetails" name="message" placeholder="Enter additional requests (if any)"></textarea>
						</div>
					</div>
					<!--Accept Privacy Policy-->
					<div class="flex-col-md-12">
						<div class="dAcceptTerms">
							<label class="checkmarkCont">
								<input type="checkbox" value="0" id="accept_value" name="accept_value" />
								<span class="checkmark signup-acceptance"></span>
								<h5>I here by accept the <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank"><span style="color: #08B2ED;"><b>Privacy Policy</b></span></a> and authorize @if(env("WEBSITENAME")==1)The World Gateway @elseif(env("WEBSITENAME")==0)Rapidex Travels @endif team to contact me.</h5>
							</label>
							<!-- <input type="checkbox" value="0" id="accept_value" name="accept_value" /> -->
							<!-- <h5>I here by accept the <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank"><span class="color008 fontWeight600">Privacy Policy</span></a> and authorize @if(env("WEBSITENAME")==1)The World Gateway @elseif(env("WEBSITENAME")==0)Rapidex Travels @endif team to contact me.</h5> -->
						</div>
						<div>
							<span class="inputError" id="accept_value_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="btnCont">
							<button type="submit" name="submit" id="form_submit" class="btnSubmitEnq">Get a Free Quote</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--Contact Details-->
<!-- <section class="mWhiteBG">
	<div class="global-map-area section contact-details parallax d-none" data-stellar-background-ratio="0.5">
		<div class="container ">
			<div class="row">
				<div class="col-sm-4">
					<div class="icon-box style10 phone ">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<small>We are on 24/7</small>
						<h4 class=" contact_info">+91 9650731717-HELLO</h4>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="icon-box style10 email">
						<i class="fa fa-envelope-o" aria-hidden="true"></i>
						<small>Send us email on</small>
						<h4 class=" contact_info">
						@if(env("WEBSITENAME")==1)
							theworldgateway@gmail.com
						@elseif(env("WEBSITENAME")==0)
							info@rapidextravels.com
						@endif
						</h4>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="icon-box style10 address">
						<i class="fa fa-home" aria-hidden="true"></i>
						<small>Meet us now</small>
						<h4 class="box-title" style="margin-bottom: 9px;margin-top: 10px">S 207, Pocket B, Sector 16, Ganga Shopping Complex, Vasundhara, Delhi-NCR Region(INDIA)</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->

<!-- google location map -->
<section class="mapCont">
	@if(env("WEBSITENAME")==1)
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.208970999417!2d77.35142401442873!3d28.65346098240954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfb2eb76f031f%3A0xa11086f8388220c4!2sThe+World+Gateway+(theworldgateway.com)!5e0!3m2!1sen!2sin!4v1538112314411" width="" height="" frameborder="0" style="border:0" allowfullscreen></iframe>
	@elseif(env("WEBSITENAME")==0)
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.2055317245763!2d77.35164931442873!3d28.653563982409544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfac0abc518bb%3A0x1702ec46d823bbe4!2sRapidex%20Travels!5e0!3m2!1sen!2sin!4v1568192236563!5m2!1sen!2sin" width="" height="" frameborder="0" style="border:0" allowfullscreen></iframe>
	@endif
</section>

@endsection

@section('custom_js')

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<!-- <script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    var select = document.getElementById("service_type_select");
    var selectedOption = select.querySelector(".selected");
    var optionsContainer = select.querySelector(".options");
    var hiddenInput = document.getElementById("service_type");

    // Toggle options display
    selectedOption.addEventListener("click", function() {
        optionsContainer.classList.toggle("active");
    });

    // Select option
    optionsContainer.addEventListener("click", function(e) {
        if (e.target.classList.contains("option")) {
            var value = e.target.dataset.value;
            selectedOption.textContent = e.target.textContent;
            hiddenInput.value = value;
            optionsContainer.classList.remove("active");
        }
    });

    // Close options when clicking outside
    window.addEventListener("click", function(e) {
        if (!select.contains(e.target)) {
            optionsContainer.classList.remove("active");
        }
    });
});
</script> -->

<!-- <script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    // Service Type Select
    initCustomSelect("service_type_select", "service_type");

    // Channel Type Select
    initCustomSelect("channel_type_select", "channel_type");

    // Channel Type Select
    initCustomSelect("time_call_select", "time_call");

    initCustomSelect("cruiseline_select", "cruiseline");
    initCustomSelect("cruisecabin_select", "cruisecabin");
    initCustomSelect("visatype_select", "visatype");
    initCustomSelect("visaentry_select", "visaentry");
    initCustomSelect("visaservice_select", "visaservice");

    // Country Code Select
    setupCountryCodeSelect();

    function initCustomSelect(selectId, hiddenInputId) {
        var select = document.getElementById(selectId);
        var selectedOption = select.querySelector(".selected");
        var optionsContainer = select.querySelector(".options");
        var hiddenInput = document.getElementById(hiddenInputId);

        // Toggle options display
        selectedOption.addEventListener("click", function() {
            optionsContainer.classList.toggle("active");
        });

		/*// Select option using event delegation
		optionsContainer.addEventListener("click", function(e) {
		    var option = e.target.closest(".option");
		    if (option) {
		        var value = option.dataset.value;
		        selectedOption.textContent = option.textContent;
		        hiddenInput.value = value;
		        optionsContainer.classList.remove("active");

		        // Calculate the offset of the selected option relative to the options container
		        var optionOffsetTop = option.offsetTop - optionsContainer.offsetTop;

		        // Scroll the options container to bring the selected option into view
		        optionsContainer.scrollTop = optionOffsetTop - (optionsContainer.offsetHeight / 2);
		    }
		});*/

		// Select option using event delegation
		optionsContainer.addEventListener("click", function(e) {
		    var option = e.target.closest(".option");
		    if (option) {
		        var value = option.dataset.value;
		        var displayText = option.textContent; // Use the text content of the clicked option
		        selectedOption.textContent = displayText;
		        hiddenInput.value = value;
		        optionsContainer.classList.remove("active");
		    }
		});

        // Close options when clicking outside
        window.addEventListener("click", function(e) {
            if (!select.contains(e.target)) {
                optionsContainer.classList.remove("active");
            }
        });

        // Close options when pressing Esc key
        window.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                optionsContainer.classList.remove("active");
            }
        });

        // Handle keyboard navigation for accessibility
        select.addEventListener("keydown", function(e) {
            var activeOption = optionsContainer.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    optionsContainer.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    optionsContainer.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });
    }

    function setupCountryCodeSelect() {
	    var selectElement = document.getElementById("country_code");

	    // Function to transform the select element into a custom select
	    function createCustomSelect() {
	        var container = document.getElementById("country_code_select_container");
	        var customSelect = document.createElement("div");
	        customSelect.id = "country_code_select";
	        customSelect.classList.add("custom-select");

	        var selectedOption = document.createElement("div");
	        selectedOption.classList.add("selected");
	        selectedOption.textContent = selectElement.options[selectElement.selectedIndex].textContent;

	        var optionsContainer = document.createElement("div");
	        optionsContainer.classList.add("options");

	        Array.from(selectElement.options).forEach(option => {
	            var customOption = document.createElement("div");
	            customOption.classList.add("option");
	            customOption.dataset.value = option.value;
	            customOption.textContent = option.textContent;

	            // Check if the option should be disabled
	            if (option.value === "0") {
	                customOption.classList.add("disabled");
	                customOption.setAttribute("disabled", "disabled");
	            }

	            optionsContainer.appendChild(customOption);

	            // Mark the initially selected option
	            if (option.selected) {
	                customOption.classList.add("selected");
	            }
	        });

	        customSelect.appendChild(selectedOption);
	        customSelect.appendChild(optionsContainer);
	        container.appendChild(customSelect);

	        // Hide the original select element
	        selectElement.style.display = "none";

	        // Initialize the custom select functionality
	        initCustomSelect("country_code_select", "country_code");

	        // Scroll the selected option into view when the box is clicked
	        customSelect.addEventListener("click", function() {
	            var selected = optionsContainer.querySelector(".option.selected");
	            if (selected) {
	                selected.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
	            }
	        });

	        // Highlight the selected option

	        /*optionsContainer.addEventListener("click", function(e) {
			    var option = e.target.closest(".option");
			    if (option && !option.classList.contains("disabled")) {
			        // Ensure that the option is not disabled
			        if (!option.hasAttribute("disabled")) {
			            var selectedOption = optionsContainer.querySelector(".option.selected");
			            if (selectedOption) {
			                selectedOption.classList.remove("selected");
			            }
			            option.classList.add("selected");
			        }
			    }
			});*/

	        // Highlight the selected option
	        optionsContainer.addEventListener("click", function(e) {
			    var option = e.target.closest(".option");
			    if (option && option.classList.contains("disabled")) {
			        alert("Please select a valid country code.");
			        return;
			    }

			    // Continue with the selection logic
			    if (option) {
			        var selectedOption = optionsContainer.querySelector(".option.selected");
			        if (selectedOption) {
			            selectedOption.classList.remove("selected");
			        }
			        option.classList.add("selected");
			    }
			});

	    }

	    // Check if options are already populated
	    if (selectElement.options.length > 0) {
	        createCustomSelect();
	    } else {
	        // Use MutationObserver to wait for options to be populated
	        var observer = new MutationObserver(function(mutations) {
	            if (selectElement.options.length > 0) {
	                observer.disconnect();
	                createCustomSelect();
	            }
	        });

	        observer.observe(selectElement, { childList: true });
	    }
	}
});
</script> -->

<!-- duration new function
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
	    const durationOptions = document.getElementById('durationOptions');
	    const hiddenDurationInput = document.getElementById('duration');
	    const customDurationInput = document.getElementById('customDurationInput');
	    const selectedDuration = document.querySelector('.selected');
	    
	    // Populate options dynamically
	    for (let i = 1; i <= 20; i++) {
	        const optionDiv = document.createElement('div');
	        optionDiv.className = 'option';
	        optionDiv.dataset.value = `${i + 1} days`;
	        optionDiv.innerText = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
	        optionDiv.onclick = function() {
	            selectDuration(optionDiv.dataset.value, optionDiv.innerText);
	        };
	        durationOptions.appendChild(optionDiv);
	    }
	    
	    // Add custom duration option
	    const customOptionDiv = document.createElement('div');
	    customOptionDiv.className = 'option';
	    customOptionDiv.dataset.value = 'custom';
	    customOptionDiv.innerText = 'Custom Duration';
	    customOptionDiv.onclick = function() {
	        selectCustomDuration();
	    };
	    durationOptions.appendChild(customOptionDiv);
	    
	    // Toggle dropdown visibility
	    window.toggleDropdown = function() {
	        durationOptions.style.display = (durationOptions.style.display === 'block') ? 'none' : 'block';
	    };

	    // Select duration
	    function selectDuration(value, text) {
	        selectedDuration.innerText = text;
	        hiddenDurationInput.value = value;
	        customDurationInput.style.display = 'none';
	        durationOptions.style.display = 'none';
	    }

	    // Select custom duration
	    function selectCustomDuration() {
	        selectedDuration.innerText = 'Custom Duration';
	        hiddenDurationInput.value = '';
	        customDurationInput.style.display = 'block';
	        durationOptions.style.display = 'none';
	    }

	    // Update hidden input with custom duration
	    window.updateDuration = function() {
	        const customDurationDays = document.getElementById('customDurationDays').value;
	        hiddenDurationInput.value = `${customDurationDays} days`;
	    }

	    // Close the dropdown if clicked outside
	    document.addEventListener('click', function(event) {
	        const isClickInside = durationOptions.contains(event.target) || selectedDuration.contains(event.target);
	        if (!isClickInside) {
	            durationOptions.style.display = 'none';
	        }
	    });
	});
</script> -->


<!-- <script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    // Initialize custom selects
    initCustomSelect("time_call_select", "time_call");
    initCustomSelect("service_type_select", "service_type");
    initCustomSelect("channel_type_select", "channel_type");
    initCustomSelect("cruiseline_select", "cruiseline");
    initCustomSelect("cruisecabin_select", "cruisecabin");
    initCustomSelect("visatype_select", "visatype");
    initCustomSelect("visaentry_select", "visaentry");
    initCustomSelect("visaservice_select", "visaservice");
    setupCountryCodeSelect();
    setupCountryOfResidenceSelect();

    //*******************

    // Set default selected option and value for service type
    var defaultServiceType = "Tour Package";
    var serviceTypeSelect = document.getElementById("service_type_select");
    var serviceTypeHiddenInput = document.getElementById("service_type");

    // Set initial text content of the selected option and mark it as selected
    var options = serviceTypeSelect.querySelectorAll(".option");
    for (var i = 0; i < options.length; i++) {
        if (options[i].textContent === defaultServiceType) {
            options[i].classList.add("selected");
        } else {
            options[i].classList.remove("selected");
        }
    }
    serviceTypeSelect.querySelector(".selected").textContent = defaultServiceType;

    // Set value of the hidden input field
    serviceTypeHiddenInput.value = defaultServiceType;


    //*******************

    // Set default selected option and value for channel type
    var defaultChannelType = "B2C";
    var channelTypeSelect = document.getElementById("channel_type_select");
    var channelTypeHiddenInput = document.getElementById("channel_type");

    // Set initial text content of the selected option and mark it as selected
    var options = channelTypeSelect.querySelectorAll(".option");
    for (var i = 0; i < options.length; i++) {
        if (options[i].dataset.value === defaultChannelType) {
            options[i].classList.add("selected");
        } else {
            options[i].classList.remove("selected");
        }
    }
    channelTypeSelect.querySelector(".selected").textContent = defaultChannelType;

    // Set value of the hidden input field
    channelTypeHiddenInput.value = defaultChannelType;

    //*******************

    function initCustomSelect(selectId, hiddenInputId) {
	    var select = document.getElementById(selectId);
	    var selectedOption = select.querySelector(".selected");
	    var optionsContainer = select.querySelector(".options");
	    var hiddenInput = document.getElementById(hiddenInputId);

	    // Toggle options display
	    selectedOption.addEventListener("click", function(e) {
	        e.stopPropagation(); // Prevent click event from bubbling up
	        optionsContainer.classList.toggle("active");
	    });

	    // Select option using event delegation
	    optionsContainer.addEventListener("click", function(e) {
	        var option = e.target.closest(".option");
	        if (option) {
	            var value = option.dataset.value;
	            var displayText = option.textContent; // Use the text content of the clicked option
	            selectedOption.textContent = displayText;
	            hiddenInput.value = value;
	            
	            // Remove 'selected' class from previously selected option
	            var previouslySelected = optionsContainer.querySelector(".option.selected");
	            if (previouslySelected) {
	                previouslySelected.classList.remove("selected");
	            }

	            // Add 'selected' class to the newly selected option
	            option.classList.add("selected");
	            
	            optionsContainer.classList.remove("active");
	        }
	    });

	    // Close options when clicking outside
	    window.addEventListener("click", function(e) {
	        if (!select.contains(e.target)) {
	            optionsContainer.classList.remove("active");
	        }
	    });

	    // Close options when pressing Esc key
	    window.addEventListener("keydown", function(e) {
	        if (e.key === "Escape") {
	            optionsContainer.classList.remove("active");
	        }
	    });

	    // Handle keyboard navigation for accessibility
	    select.addEventListener("keydown", function(e) {
	        var activeOption = optionsContainer.querySelector(".option:focus");
	        if (e.key === "ArrowDown") {
	            e.preventDefault();
	            if (activeOption && activeOption.nextElementSibling) {
	                activeOption.nextElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option").focus();
	            }
	        } else if (e.key === "ArrowUp") {
	            e.preventDefault();
	            if (activeOption && activeOption.previousElementSibling) {
	                activeOption.previousElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option:last-child").focus();
	            }
	        } else if (e.key === "Enter" && activeOption) {
	            e.preventDefault();
	            activeOption.click();
	        }
	    });
	}

    function setupCountryCodeSelect() {
        var selectElement = document.getElementById("country_code");

        function createCustomSelect() {
            var container = document.getElementById("country_code_select_container");
            var customSelect = document.createElement("div");
            customSelect.id = "country_code_select";
            customSelect.classList.add("custom-select");

            var selectedOption = document.createElement("div");
            selectedOption.classList.add("selected");
            selectedOption.textContent = selectElement.options[selectElement.selectedIndex].textContent;

            var optionsContainer = document.createElement("div");
            optionsContainer.classList.add("options");

            Array.from(selectElement.options).forEach(option => {
                var customOption = document.createElement("div");
                customOption.classList.add("option");
                customOption.dataset.value = option.value;
                customOption.textContent = option.textContent;

                // Check if the option should be disabled
                if (option.value === "0") {
                    customOption.classList.add("disabled");
                    customOption.setAttribute("disabled", "disabled");
                }

                optionsContainer.appendChild(customOption);

                // Mark the initially selected option
                if (option.selected) {
                    customOption.classList.add("selected");
                }
            });

            customSelect.appendChild(selectedOption);
            customSelect.appendChild(optionsContainer);
            container.appendChild(customSelect);

            // Hide the original select element
            selectElement.style.display = "none";

            // Initialize the custom select functionality
            initCustomSelect("country_code_select", "country_code");

            // Scroll the selected option into view when the box is clicked
            customSelect.addEventListener("click", function() {
                var selected = optionsContainer.querySelector(".option.selected");
                if (selected) {
                    selected.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
                }
            });

            // Highlight the selected option
            optionsContainer.addEventListener("click", function(e) {
                var option = e.target.closest(".option");
                if (option && option.classList.contains("disabled")) {
                    alert("Please select a valid country code.");
                    return;
                }

                // Continue with the selection logic
                if (option) {
                    var selectedOption = optionsContainer.querySelector(".option.selected");
                    if (selectedOption) {
                        selectedOption.classList.remove("selected");
                    }
                    option.classList.add("selected");
                }
            });
        }

        // Check if options are already populated
        if (selectElement.options.length > 0) {
            createCustomSelect();
        } else {
            // Use MutationObserver to wait for options to be populated
            var observer = new MutationObserver(function(mutations) {
                if (selectElement.options.length > 0) {
                    observer.disconnect();
                    createCustomSelect();
                }
            });

            observer.observe(selectElement, { childList: true });
        }
    }

    function setupCountryOfResidenceSelect() {
	    console.log("Setting up country of residence select...");
	    var selectElement = document.getElementById("country_of_residence");
	    console.log("Select element:", selectElement);

	    if (!selectElement) {
	        console.error("Country of residence select element not found.");
	        return;
	    }

	    function createCustomSelect() {
	        var customSelectContainer = document.getElementById("country_of_residence_select");
	        var selectedOption = customSelectContainer.querySelector(".selected");
	        var optionsContainer = customSelectContainer.querySelector(".options");

	        // Clear existing options
	        optionsContainer.innerHTML = '';

	        Array.from(selectElement.options).forEach(option => {
	            var customOption = document.createElement("div");
	            customOption.classList.add("option");
	            customOption.dataset.value = option.value;
	            customOption.textContent = option.textContent;

	            optionsContainer.appendChild(customOption);

	            // Mark the initially selected option
	            if (option.selected) {
	                selectedOption.textContent = option.textContent;
	                customOption.classList.add("selected");

	                // Scroll the selected option into view after a slight delay
	                setTimeout(function() {
	                    customOption.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
	                }, 100);
	            }
	        });

	        // Initialize the custom select functionality
	        initCustomSelect("country_of_residence_select", "country_of_residence");

	        // Highlight the selected option
	        optionsContainer.addEventListener("click", function(e) {
	            var option = e.target.closest(".option");
	            if (option) {
	                var selectedOption = optionsContainer.querySelector(".option.selected");
	                if (selectedOption) {
	                    selectedOption.classList.remove("selected");
	                }
	                option.classList.add("selected");

	                // Scroll the selected option into view after a slight delay
	                setTimeout(function() {
	                    option.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
	                }, 100);
	            }
	        });
	    }

	    // Check if options are already populated
	    if (selectElement.options && selectElement.options.length > 0) {
	        createCustomSelect();
	    } else {
	        // Use MutationObserver to wait for options to be populated
	        var observer = new MutationObserver(function(mutations) {
	            if (selectElement.options && selectElement.options.length > 0) {
	                observer.disconnect();
	                createCustomSelect();
	            }
	        });

	        observer.observe(selectElement, { childList: true });
	    }
	}
});
</script> -->

<!-- <script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    // Initialize custom selects
    initCustomSelect("time_call_select", "time_call");
    initCustomSelect("service_type_select", "service_type");
    initCustomSelect("channel_type_select", "channel_type");
    initCustomSelect("cruiseline_select", "cruiseline");
    initCustomSelect("cruisecabin_select", "cruisecabin");
    initCustomSelect("visatype_select", "visatype");
    initCustomSelect("visaentry_select", "visaentry");
    initCustomSelect("visaservice_select", "visaservice");
    setupCountryCodeSelect();
    setupCountryOfResidenceSelect();
    setupDurationSelect();  // Initialize custom duration select

    // Add event listener to the service type select dropdown
    var serviceTypeSelect = document.getElementById("service_type_select");
    serviceTypeSelect.addEventListener("click", function() {
        var selectedOption = serviceTypeSelect.querySelector(".selected");
        var selectedServiceType = selectedOption.textContent.trim();

        // Check if the selected service type is "Visa"
        if (selectedServiceType === "Visa") {
            // Update duration options for visa services
            updateVisaDurationOptions();
        } else {
            // Revert to default duration options
            revertToDefaultDurationOptions();
        }
    });

    //*******************

    // Set default selected option and value for service type
    var defaultServiceType = "Tour Package";
    var serviceTypeSelect = document.getElementById("service_type_select");
    var serviceTypeHiddenInput = document.getElementById("service_type");

    // Set initial text content of the selected option and mark it as selected
    var options = serviceTypeSelect.querySelectorAll(".option");
    for (var i = 0; i < options.length; i++) {
        if (options[i].textContent === defaultServiceType) {
            options[i].classList.add("selected");
        } else {
            options[i].classList.remove("selected");
        }
    }
    serviceTypeSelect.querySelector(".selected").textContent = defaultServiceType;

    // Set value of the hidden input field
    serviceTypeHiddenInput.value = defaultServiceType;


    //*******************

    // Set default selected option and value for channel type
    var defaultChannelType = "B2C";
    var channelTypeSelect = document.getElementById("channel_type_select");
    var channelTypeHiddenInput = document.getElementById("channel_type");

    // Set initial text content of the selected option and mark it as selected
    var options = channelTypeSelect.querySelectorAll(".option");
    for (var i = 0; i < options.length; i++) {
        if (options[i].dataset.value === defaultChannelType) {
            options[i].classList.add("selected");
        } else {
            options[i].classList.remove("selected");
        }
    }
    channelTypeSelect.querySelector(".selected").textContent = defaultChannelType;

    // Set value of the hidden input field
    channelTypeHiddenInput.value = defaultChannelType;

    //*******************

    function initCustomSelect(selectId, hiddenInputId) {
	    var select = document.getElementById(selectId);
	    var selectedOption = select.querySelector(".selected");
	    var optionsContainer = select.querySelector(".options");
	    var hiddenInput = document.getElementById(hiddenInputId);

	    // Toggle options display
	    selectedOption.addEventListener("click", function(e) {
	        e.stopPropagation(); // Prevent click event from bubbling up
	        optionsContainer.classList.toggle("active");
	    });

	    // Select option using event delegation
	    optionsContainer.addEventListener("click", function(e) {
	        var option = e.target.closest(".option");
	        if (option) {
	            var value = option.dataset.value;
	            var displayText = option.textContent; // Use the text content of the clicked option
	            selectedOption.textContent = displayText;
	            hiddenInput.value = value;
	            
	            // Remove 'selected' class from previously selected option
	            var previouslySelected = optionsContainer.querySelector(".option.selected");
	            if (previouslySelected) {
	                previouslySelected.classList.remove("selected");
	            }

	            // Add 'selected' class to the newly selected option
	            option.classList.add("selected");
	            
	            optionsContainer.classList.remove("active");
	        }
	    });

	    // Close options when clicking outside
	    window.addEventListener("click", function(e) {
	        if (!select.contains(e.target)) {
	            optionsContainer.classList.remove("active");
	        }
	    });

	    // Close options when pressing Esc key
	    window.addEventListener("keydown", function(e) {
	        if (e.key === "Escape") {
	            optionsContainer.classList.remove("active");
	        }
	    });

	    // Handle keyboard navigation for accessibility
	    select.addEventListener("keydown", function(e) {
	        var activeOption = optionsContainer.querySelector(".option:focus");
	        if (e.key === "ArrowDown") {
	            e.preventDefault();
	            if (activeOption && activeOption.nextElementSibling) {
	                activeOption.nextElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option").focus();
	            }
	        } else if (e.key === "ArrowUp") {
	            e.preventDefault();
	            if (activeOption && activeOption.previousElementSibling) {
	                activeOption.previousElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option:last-child").focus();
	            }
	        } else if (e.key === "Enter" && activeOption) {
	            e.preventDefault();
	            activeOption.click();
	        }
	    });
	}

    function setupCountryCodeSelect() {
        var selectElement = document.getElementById("country_code");

        function createCustomSelect() {
            var container = document.getElementById("country_code_select_container");
            var customSelect = document.createElement("div");
            customSelect.id = "country_code_select";
            customSelect.classList.add("custom-select");

            var selectedOption = document.createElement("div");
            selectedOption.classList.add("selected");
            selectedOption.textContent = selectElement.options[selectElement.selectedIndex].textContent;

            var optionsContainer = document.createElement("div");
            optionsContainer.classList.add("options");

            Array.from(selectElement.options).forEach(option => {
                var customOption = document.createElement("div");
                customOption.classList.add("option");
                customOption.dataset.value = option.value;
                customOption.textContent = option.textContent;

                // Check if the option should be disabled
                if (option.value === "0") {
                    customOption.classList.add("disabled");
                    customOption.setAttribute("disabled", "disabled");
                }

                optionsContainer.appendChild(customOption);

                // Mark the initially selected option
                if (option.selected) {
                    customOption.classList.add("selected");
                }
            });

            customSelect.appendChild(selectedOption);
            customSelect.appendChild(optionsContainer);
            container.appendChild(customSelect);

            // Hide the original select element
            selectElement.style.display = "none";

            // Initialize the custom select functionality
            initCustomSelect("country_code_select", "country_code");

            // Scroll the selected option into view when the box is clicked
            customSelect.addEventListener("click", function() {
                var selected = optionsContainer.querySelector(".option.selected");
                if (selected) {
                    selected.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
                }
            });

            // Highlight the selected option
            optionsContainer.addEventListener("click", function(e) {
                var option = e.target.closest(".option");
                if (option && option.classList.contains("disabled")) {
                    alert("Please select a valid country code.");
                    return;
                }

                // Continue with the selection logic
                if (option) {
                    var selectedOption = optionsContainer.querySelector(".option.selected");
                    if (selectedOption) {
                        selectedOption.classList.remove("selected");
                    }
                    option.classList.add("selected");
                }
            });
        }

        // Check if options are already populated
        if (selectElement.options.length > 0) {
            createCustomSelect();
        } else {
            // Use MutationObserver to wait for options to be populated
            var observer = new MutationObserver(function(mutations) {
                if (selectElement.options.length > 0) {
                    observer.disconnect();
                    createCustomSelect();
                }
            });

            observer.observe(selectElement, { childList: true });
        }
    }

    function setupCountryOfResidenceSelect() {
	    console.log("Setting up country of residence select...");
	    var selectElement = document.getElementById("country_of_residence");
	    console.log("Select element:", selectElement);

	    if (!selectElement) {
	        console.error("Country of residence select element not found.");
	        return;
	    }

	    function createCustomSelect() {
	        var customSelectContainer = document.getElementById("country_of_residence_select");
	        var selectedOption = customSelectContainer.querySelector(".selected");
	        var optionsContainer = customSelectContainer.querySelector(".options");

	        // Clear existing options
	        optionsContainer.innerHTML = '';

	        Array.from(selectElement.options).forEach(option => {
	            var customOption = document.createElement("div");
	            customOption.classList.add("option");
	            customOption.dataset.value = option.value;
	            customOption.textContent = option.textContent;

	            optionsContainer.appendChild(customOption);

	            // Mark the initially selected option
	            if (option.selected) {
	                selectedOption.textContent = option.textContent;
	                customOption.classList.add("selected");

	                // Scroll the selected option into view after a slight delay
	                setTimeout(function() {
	                    customOption.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
	                }, 100);
	            }
	        });

	        // Initialize the custom select functionality
	        initCustomSelect("country_of_residence_select", "country_of_residence");

	        // Highlight the selected option
	        optionsContainer.addEventListener("click", function(e) {
	            var option = e.target.closest(".option");
	            if (option) {
	                var selectedOption = optionsContainer.querySelector(".option.selected");
	                if (selectedOption) {
	                    selectedOption.classList.remove("selected");
	                }
	                option.classList.add("selected");

	                // Scroll the selected option into view after a slight delay
	                setTimeout(function() {
	                    option.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
	                }, 100);
	            }
	        });
	    }

	    // Check if options are already populated
	    if (selectElement.options && selectElement.options.length > 0) {
	        createCustomSelect();
	    } else {
	        // Use MutationObserver to wait for options to be populated
	        var observer = new MutationObserver(function(mutations) {
	            if (selectElement.options && selectElement.options.length > 0) {
	                observer.disconnect();
	                createCustomSelect();
	            }
	        });

	        observer.observe(selectElement, { childList: true });
	    }
	}

    function setupDurationSelect() {
        const durationSelectContainer = document.getElementById("displayDuration");
        const durationOptions = durationSelectContainer.querySelector(".options");
        const hiddenDurationInput = document.getElementById("duration");
        const customDurationInput = document.getElementById("customDurationInput");
        const selectedDuration = durationSelectContainer.querySelector(".selected");

        // Populate options dynamically
        for (let i = 1; i <= 20; i++) {
            const optionDiv = document.createElement('div');
            optionDiv.className = 'option';
            optionDiv.dataset.value = `${i + 1} days`;
            optionDiv.innerText = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
            optionDiv.onclick = function() {
                selectDuration(optionDiv.dataset.value, optionDiv.innerText);
            };
            durationOptions.appendChild(optionDiv);
        }

        // Add custom duration option
        const customOptionDiv = document.createElement('div');
        customOptionDiv.className = 'option';
        customOptionDiv.dataset.value = 'custom';
        customOptionDiv.innerText = 'Custom Duration';
        customOptionDiv.onclick = function() {
            selectCustomDuration();
        };
        durationOptions.appendChild(customOptionDiv);

        // Toggle dropdown visibility
        selectedDuration.addEventListener("click", function(e) {
            e.stopPropagation();
            durationOptions.classList.toggle("active");
        });

        // Select duration
        function selectDuration(value, text) {
            selectedDuration.innerText = text;
            hiddenDurationInput.value = value;
            customDurationInput.style.display = 'none';
            durationOptions.classList.remove("active");
        }

        // Select custom duration
        function selectCustomDuration() {
            selectedDuration.innerText = 'Custom Duration';
            hiddenDurationInput.value = '';
            customDurationInput.style.display = 'block';
            durationOptions.classList.remove("active");
        }

        // Update hidden input with custom duration
        window.updateDuration = function() {
            const customDurationDays = document.getElementById('customDurationDays').value;
            hiddenDurationInput.value = `${customDurationDays} days`;
        }

        // Close the dropdown if clicked outside
        window.addEventListener("click", function(e) {
            if (!durationSelectContainer.contains(e.target)) {
                durationOptions.classList.remove("active");
            }
        });

        // Close options when pressing Esc key
        window.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                durationOptions.classList.remove("active");
            }
        });

        // Handle keyboard navigation for accessibility
        durationSelectContainer.addEventListener("keydown", function(e) {
            var activeOption = durationOptions.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });
    }

    // Function to update duration options for visa services
    function updateVisaDurationOptions() {
        var durationOptionsContainer = document.getElementById("displayDuration").querySelector(".options");
        durationOptionsContainer.innerHTML = ""; // Clear existing options

        // Define visa duration options in the specified format
        var visaDurations = [
            { value: "15 days", text: "15 days" },
            { value: "30 days", text: "30 days" },
            { value: "60 days", text: "60 days" },
            { value: "90 days", text: "90 days" },
            { value: "180 days", text: "180 days" },
            { value: "365 days", text: "365 days" },
            { value: "730 days", text: "730 days" },
            { value: "1825 days", text: "1825 days" }
        ];

        // Populate duration options for visa services
        visaDurations.forEach(function(duration) {
            var optionDiv = document.createElement("div");
            optionDiv.className = "option";
            optionDiv.dataset.value = duration.value;
            optionDiv.textContent = duration.text; // Use textContent to set the text
            optionDiv.onclick = function() {
                selectDuration(duration.value, duration.text); // Pass the value and text directly
            };
            durationOptionsContainer.appendChild(optionDiv);
        });
    }

    // Function to revert to default duration options
    function revertToDefaultDurationOptions() {
        // Re-populate duration options with default values
        // You can use the existing setupDurationSelect function for this purpose
        setupDurationSelect();
    }
});
</script> -->

<!-- improved version -->
<!-- <script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const customSelectIds = [
        { selectId: "service_type_select", hiddenInputId: "service_type" },
        { selectId: "channel_type_select", hiddenInputId: "channel_type" },
        { selectId: "time_call_select", hiddenInputId: "time_call" },
        { selectId: "cruiseline_select", hiddenInputId: "cruiseline" },
        { selectId: "cruisecabin_select", hiddenInputId: "cruisecabin" },
        { selectId: "visatype_select", hiddenInputId: "visatype" },
        { selectId: "visaentry_select", hiddenInputId: "visaentry" },
        { selectId: "visaservice_select", hiddenInputId: "visaservice" }
    ];

    customSelectIds.forEach(({ selectId, hiddenInputId }) => {
        initCustomSelect(selectId, hiddenInputId);
    });

    setupCountryCodeSelect();
    setupCountryOfResidenceSelect();
    setupDurationSelect();

    handleServiceTypeChange();

    setDefaultOption("service_type_select", "Tour Package");
    setDefaultOption("channel_type_select", "B2C");

    function initCustomSelect(selectId, hiddenInputId) {
        const select = document.getElementById(selectId);
        const selectedOption = select.querySelector(".selected");
        const optionsContainer = select.querySelector(".options");
        const hiddenInput = document.getElementById(hiddenInputId);

        selectedOption.addEventListener("click", (e) => {
            e.stopPropagation();
            optionsContainer.classList.toggle("active");
        });

        optionsContainer.addEventListener("click", (e) => {
            const option = e.target.closest(".option");
            if (option) {
                const value = option.dataset.value;
                const displayText = option.textContent;
                selectedOption.textContent = displayText;
                hiddenInput.value = value;

                const previouslySelected = optionsContainer.querySelector(".option.selected");
                if (previouslySelected) {
                    previouslySelected.classList.remove("selected");
                }
                option.classList.add("selected");
                optionsContainer.classList.remove("active");
            }
        });

        window.addEventListener("click", () => optionsContainer.classList.remove("active"));
        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                optionsContainer.classList.remove("active");
            }
        });

        select.addEventListener("keydown", (e) => {
            const activeOption = optionsContainer.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    optionsContainer.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    optionsContainer.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });
    }

    function setupCountryCodeSelect() {
        const selectElement = document.getElementById("country_code");

        function createCustomSelect() {
            const container = document.getElementById("country_code_select_container");
            const customSelect = document.createElement("div");
            customSelect.id = "country_code_select";
            customSelect.classList.add("custom-select");

            const selectedOption = document.createElement("div");
            selectedOption.classList.add("selected");
            selectedOption.textContent = selectElement.options[selectElement.selectedIndex].textContent;

            const optionsContainer = document.createElement("div");
            optionsContainer.classList.add("options");

            Array.from(selectElement.options).forEach(option => {
                const customOption = document.createElement("div");
                customOption.classList.add("option");
                customOption.dataset.value = option.value;
                customOption.textContent = option.textContent;

                if (option.value === "0") {
                    customOption.classList.add("disabled");
                    customOption.setAttribute("disabled", "disabled");
                }

                optionsContainer.appendChild(customOption);

                if (option.selected) {
                    customOption.classList.add("selected");
                }
            });

            customSelect.appendChild(selectedOption);
            customSelect.appendChild(optionsContainer);
            container.appendChild(customSelect);
            selectElement.style.display = "none";

            initCustomSelect("country_code_select", "country_code");

            customSelect.addEventListener("click", () => {
                const selected = optionsContainer.querySelector(".option.selected");
                if (selected) {
                    selected.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
                }
            });

            optionsContainer.addEventListener("click", (e) => {
                const option = e.target.closest(".option");
                if (option && option.classList.contains("disabled")) {
                    alert("Please select a valid country code.");
                }
            });
        }

        if (selectElement.options.length > 0) {
            createCustomSelect();
        } else {
            const observer = new MutationObserver(() => {
                if (selectElement.options.length > 0) {
                    observer.disconnect();
                    createCustomSelect();
                }
            });
            observer.observe(selectElement, { childList: true });
        }
    }

    function setupCountryOfResidenceSelect() {
        const selectElement = document.getElementById("country_of_residence");

        if (!selectElement) {
            console.error("Country of residence select element not found.");
            return;
        }

        function createCustomSelect() {
            const customSelectContainer = document.getElementById("country_of_residence_select");
            const selectedOption = customSelectContainer.querySelector(".selected");
            const optionsContainer = customSelectContainer.querySelector(".options");

            optionsContainer.innerHTML = '';

            Array.from(selectElement.options).forEach(option => {
                const customOption = document.createElement("div");
                customOption.classList.add("option");
                customOption.dataset.value = option.value;
                customOption.textContent = option.textContent;

                optionsContainer.appendChild(customOption);

                if (option.selected) {
                    selectedOption.textContent = option.textContent;
                    customOption.classList.add("selected");
                    setTimeout(() => customOption.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" }), 100);
                }
            });

            initCustomSelect("country_of_residence_select", "country_of_residence");

            optionsContainer.addEventListener("click", (e) => {
                const option = e.target.closest(".option");
                if (option) {
                    const selectedOption = optionsContainer.querySelector(".option.selected");
                    if (selectedOption) {
                        selectedOption.classList.remove("selected");
                    }
                    option.classList.add("selected");
                    setTimeout(() => option.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" }), 100);
                }
            });
        }

        if (selectElement.options.length > 0) {
            createCustomSelect();
        } else {
            const observer = new MutationObserver(() => {
                if (selectElement.options.length > 0) {
                    observer.disconnect();
                    createCustomSelect();
                }
            });
            observer.observe(selectElement, { childList: true });
        }
    }

    function setupDurationSelect() {
        const durationSelectContainer = document.getElementById("displayDuration");
        const durationOptions = durationSelectContainer.querySelector(".options");
        const hiddenDurationInput = document.getElementById("duration");
        const customDurationInput = document.getElementById("customDurationInput");
        const selectedDuration = durationSelectContainer.querySelector(".selected");

        for (let i = 1; i <= 20; i++) {
            const optionDiv = document.createElement('div');
            optionDiv.className = 'option';
            optionDiv.dataset.value = `${i + 1} days`;
            optionDiv.innerText = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
            optionDiv.onclick = () => selectDuration(optionDiv.dataset.value, optionDiv.innerText);
            durationOptions.appendChild(optionDiv);
        }

        const customOptionDiv = document.createElement('div');
        customOptionDiv.className = 'option';
        customOptionDiv.dataset.value = 'custom';
        customOptionDiv.innerText = 'Custom Duration';
        customOptionDiv.onclick = selectCustomDuration;
        durationOptions.appendChild(customOptionDiv);

        selectedDuration.addEventListener("click", (e) => {
            e.stopPropagation();
            durationOptions.classList.toggle("active");
        });

        function selectDuration(value, text) {
            selectedDuration.innerText = text;
            hiddenDurationInput.value = value;
            customDurationInput.style.display = 'none';
            durationOptions.classList.remove("active");
        }

        function selectCustomDuration() {
            selectedDuration.innerText = 'Custom Duration';
            hiddenDurationInput.value = '';
            customDurationInput.style.display = 'block';
            durationOptions.classList.remove("active");
        }

        window.updateDuration = function() {
            const customDurationDays = document.getElementById('customDurationDays').value;
            hiddenDurationInput.value = `${customDurationDays} days`;
        };

        window.addEventListener("click", (e) => {
            if (!durationSelectContainer.contains(e.target)) {
                durationOptions.classList.remove("active");
            }
        });

        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                durationOptions.classList.remove("active");
            }
        });

        durationSelectContainer.addEventListener("keydown", (e) => {
            const activeOption = durationOptions.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });
    }

    function handleServiceTypeChange() {
        const serviceTypeSelect = document.getElementById("service_type_select");
        serviceTypeSelect.addEventListener("click", () => {
            const selectedOption = serviceTypeSelect.querySelector(".selected");
            const selectedServiceType = selectedOption.textContent.trim();
            if (selectedServiceType === "Visa") {
                updateVisaDurationOptions();
            } else {
                revertToDefaultDurationOptions();
            }
        });
    }

    function setDefaultOption(selectId, defaultOptionText) {
        const selectElement = document.getElementById(selectId);
        const hiddenInput = document.getElementById(selectElement.getAttribute("data-hidden-input"));
        const options = selectElement.querySelectorAll(".option");
        options.forEach(option => {
            if (option.textContent.trim() === defaultOptionText) {
                option.classList.add("selected");
            } else {
                option.classList.remove("selected");
            }
        });
        selectElement.querySelector(".selected").textContent = defaultOptionText;
        hiddenInput.value = defaultOptionText;
    }

    function updateVisaDurationOptions() {
        const durationOptionsContainer = document.getElementById("displayDuration").querySelector(".options");
        durationOptionsContainer.innerHTML = "";

        const visaDurations = [
            { value: "15 days", text: "15 days" },
            { value: "30 days", text: "30 days" },
            { value: "60 days", text: "60 days" },
            { value: "90 days", text: "90 days" },
            { value: "180 days", text: "180 days" },
            { value: "365 days", text: "365 days" },
            { value: "730 days", text: "730 days" },
            { value: "1825 days", text: "1825 days" }
        ];

        visaDurations.forEach(duration => {
            const optionDiv = document.createElement("div");
            optionDiv.className = "option";
            optionDiv.dataset.value = duration.value;
            optionDiv.textContent = duration.text;
            optionDiv.onclick = () => selectDuration(duration.value, duration.text);
            durationOptionsContainer.appendChild(optionDiv);
        });
    }

    function revertToDefaultDurationOptions() {
        setupDurationSelect();
    }
});
</script> -->

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const customSelectIds = [
        { selectId: "service_type_select", hiddenInputId: "service_type" },
        { selectId: "channel_type_select", hiddenInputId: "channel_type" },
        { selectId: "time_call_select", hiddenInputId: "time_call" },
        { selectId: "cruiseline_select", hiddenInputId: "cruiseline" },
        { selectId: "cruisecabin_select", hiddenInputId: "cruisecabin" },
        { selectId: "visatype_select", hiddenInputId: "visatype" },
        { selectId: "visaentry_select", hiddenInputId: "visaentry" },
        { selectId: "visaservice_select", hiddenInputId: "visaservice" }
    ];

    customSelectIds.forEach(({ selectId, hiddenInputId }) => {
        initCustomSelect(selectId, hiddenInputId);
    });

    /*// Initialize the event listeners
    handleFlightPreference();
    handleAdditionalDetailsChange();*/

    // Initialize the event listeners and reset functions
    const flightPreferenceHandlers = handleFlightPreference();
    const additionalDetailsHandlers = handleAdditionalDetailsChange();

    /*setupFlightBooking();*/
    capitalizeInput('name');
    capitalizeInput('destinations');
    capitalizeInput('city_of_residence')
    lowercaseInput('email');

    setupCountryCodeSelect();
    setupCountryOfResidenceSelect();
    setupDurationSelect();
    addTravellers();
    budgetSlider();
    showHideService();
    handleServiceTypeChange();
    

    setDefaultOption("channel_type_select", "B2C"); // keep this first
    setDefaultOption("service_type_select", "Tour Package"); // keep this second

    /*function capitalizeInput() {
    	const nameInput = document.getElementById('name');
    	nameInput.addEventListener('input', function() {
    		this.value = this.value.replace(/\b\w/g, function(char) {
    			return char.toUpperCase();
    		});
    	});
    }*/

    /*function setupFlightBooking() {
        const flightBookingRadios = document.querySelectorAll("input[name='flight_booking']");
        const flightBookingLabels = document.querySelectorAll(".custom-selection");

        flightBookingRadios.forEach(radio => {
            radio.addEventListener("change", () => {
                // Clear the previously selected radio button highlight
                flightBookingLabels.forEach(label => label.classList.remove("selected"));

                // Highlight the selected radio button
                if (radio.checked) {
                    radio.parentElement.classList.add("selected");
                }

                // Clear any error messages
                document.getElementById("flightBooked_error").innerHTML = "";
            });
        });
    }*/

    function capitalizeInput(inputId) {
		const input = document.getElementById(inputId);
			input.addEventListener('input', function() {
				this.value = this.value.replace(/\b\w/g, function(char) {
				return char.toUpperCase();
			});
		});
	}

	function lowercaseInput(inputId) {
		const input = document.getElementById(inputId);
		input.addEventListener('input', function() {
		this.value = this.value.toLowerCase();
		});
	}

    /*function initCustomSelect(selectId, hiddenInputId) {
        const select = document.getElementById(selectId);
        const selectedOption = select.querySelector(".selected");
        const optionsContainer = select.querySelector(".options");
        const hiddenInput = document.getElementById(hiddenInputId);

        selectedOption.addEventListener("click", (e) => {
            e.stopPropagation();
            optionsContainer.classList.toggle("active");
        });

        optionsContainer.addEventListener("click", (e) => {
            const option = e.target.closest(".option");
            if (option) {
                const value = option.dataset.value;
                const displayText = option.textContent;
                selectedOption.textContent = displayText;
                hiddenInput.value = value;

                const previouslySelected = optionsContainer.querySelector(".option.selected");
                if (previouslySelected) {
                    previouslySelected.classList.remove("selected");
                }
                option.classList.add("selected");
                optionsContainer.classList.remove("active");
            }
        });

        window.addEventListener("click", () => optionsContainer.classList.remove("active"));
        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                optionsContainer.classList.remove("active");
            }
        });

        select.addEventListener("keydown", (e) => {
            const activeOption = optionsContainer.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    optionsContainer.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    optionsContainer.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });
    }*/

    /*function initCustomSelect(selectId, hiddenInputId) {
	    const select = document.getElementById(selectId);
	    const selectedOption = select.querySelector(".selected");
	    const optionsContainer = select.querySelector(".options");
	    const hiddenInput = document.getElementById(hiddenInputId);

	    selectedOption.addEventListener("click", (e) => {
	        e.stopPropagation();
	        optionsContainer.classList.toggle("active");
	    });

	    optionsContainer.addEventListener("click", (e) => {
	        const option = e.target.closest(".option");
	        if (option) {
	            const value = option.dataset.value;
	            const displayText = option.textContent;
	            selectedOption.textContent = displayText;
	            hiddenInput.value = value;

	            const previouslySelected = optionsContainer.querySelector(".option.selected");
	            if (previouslySelected) {
	                previouslySelected.classList.remove("selected");
	            }
	            option.classList.add("selected");
	            optionsContainer.classList.remove("active");

	            // Clear error message
	            const errorId = hiddenInput.id + "_error";
	            document.getElementById(errorId).innerHTML = "";
	        }
	    });

	    window.addEventListener("click", () => optionsContainer.classList.remove("active"));
	    window.addEventListener("keydown", (e) => {
	        if (e.key === "Escape") {
	            optionsContainer.classList.remove("active");
	        }
	    });

	    select.addEventListener("keydown", (e) => {
	        const activeOption = optionsContainer.querySelector(".option:focus");
	        if (e.key === "ArrowDown") {
	            e.preventDefault();
	            if (activeOption && activeOption.nextElementSibling) {
	                activeOption.nextElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option").focus();
	            }
	        } else if (e.key === "ArrowUp") {
	            e.preventDefault();
	            if (activeOption && activeOption.previousElementSibling) {
	                activeOption.previousElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option:last-child").focus();
	            }
	        } else if (e.key === "Enter" && activeOption) {
	            e.preventDefault();
	            activeOption.click();
	        }
	    });

	    // Add tabindex for focusability
	    select.setAttribute('tabindex', '0');

	    // Handle focus and blur events for accessibility
	    select.addEventListener('focus', () => {
	        select.classList.add('focus');
	    });

	    select.addEventListener('blur', () => {
	        select.classList.remove('focus');
	        const errorId = hiddenInput.id + "_error";
	        document.getElementById(errorId).innerHTML = ""; // Clear error message
	    });
	}*/
	/*function initCustomSelect(selectId, hiddenInputId) {
	    const select = document.getElementById(selectId);
	    const selectedOption = select.querySelector(".selected");
	    const optionsContainer = select.querySelector(".options");
	    const hiddenInput = document.getElementById(hiddenInputId);

	    // Function to toggle the options container
	    function toggleOptions() {
	        optionsContainer.classList.toggle("active");
	    }

	    selectedOption.addEventListener("click", (e) => {
	        e.stopPropagation();
	        toggleOptions();
	    });

	    optionsContainer.addEventListener("click", (e) => {
	        const option = e.target.closest(".option");
	        if (option) {
	            const value = option.dataset.value;
	            const displayText = option.textContent;
	            selectedOption.textContent = displayText;
	            hiddenInput.value = value;

	            const previouslySelected = optionsContainer.querySelector(".option.selected");
	            if (previouslySelected) {
	                previouslySelected.classList.remove("selected");
	            }
	            option.classList.add("selected");
	            optionsContainer.classList.remove("active");

	            // Clear error message
	            const errorId = hiddenInput.id + "_error";
	            document.getElementById(errorId).innerHTML = "";
	        }
	    });

	    window.addEventListener("click", () => optionsContainer.classList.remove("active"));
	    window.addEventListener("keydown", (e) => {
	        if (e.key === "Escape") {
	            optionsContainer.classList.remove("active");
	        }
	    });

	    select.addEventListener("keydown", (e) => {
	        const activeOption = optionsContainer.querySelector(".option:focus");
	        if (e.key === "ArrowDown") {
	            e.preventDefault();
	            if (activeOption && activeOption.nextElementSibling) {
	                activeOption.nextElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option").focus();
	            }
	        } else if (e.key === "ArrowUp") {
	            e.preventDefault();
	            if (activeOption && activeOption.previousElementSibling) {
	                activeOption.previousElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option:last-child").focus();
	            }
	        } else if (e.key === "Enter" && activeOption) {
	            e.preventDefault();
	            activeOption.click();
	        } else if (e.key === " " || (e.key === "ArrowDown" && e.altKey)) {
	            e.preventDefault();
	            toggleOptions();
	        }
	    });

	    // Add tabindex for focusability
	    select.setAttribute('tabindex', '0');

	    // Handle focus and blur events for accessibility
	    select.addEventListener('focus', () => {
	        select.classList.add('focus');
	    });

	    select.addEventListener('blur', () => {
	        select.classList.remove('focus');
	        const errorId = hiddenInput.id + "_error";
	        document.getElementById(errorId).innerHTML = ""; // Clear error message
	    });
	}*/

	function initCustomSelect(selectId, hiddenInputId) {
	    const select = document.getElementById(selectId);
	    const selectedOption = select.querySelector(".selected");
	    const optionsContainer = select.querySelector(".options");
	    const hiddenInput = document.getElementById(hiddenInputId);

	    // Function to close all select options
	    function closeAllSelects() {
	        document.querySelectorAll('.custom-select .options.active').forEach(container => {
	            container.classList.remove('active');
	        });
	    }

	    // Function to toggle the options container
	    function toggleOptions() {
	        closeAllSelects();
	        optionsContainer.classList.toggle("active");
	    }

	    selectedOption.addEventListener("click", (e) => {
	        e.stopPropagation();
	        toggleOptions();
	    });

	    optionsContainer.addEventListener("click", (e) => {
	        const option = e.target.closest(".option");
	        if (option) {
	            const value = option.dataset.value;
	            const displayText = option.textContent;
	            selectedOption.textContent = displayText;
	            hiddenInput.value = value;

	            const previouslySelected = optionsContainer.querySelector(".option.selected");
	            if (previouslySelected) {
	                previouslySelected.classList.remove("selected");
	            }
	            option.classList.add("selected");
	            optionsContainer.classList.remove("active");

	            // Clear error message
	            const errorId = hiddenInput.id + "_error";
	            const errorElement = document.getElementById(errorId);
	            if (errorElement) {
	            	errorElement.innerHTML = ""; // Clear error message
	        	}
	        }
	    });

	    window.addEventListener("click", (e) => {
	        if (!select.contains(e.target)) {
	            closeAllSelects();
	        }
	    });

	    window.addEventListener("keydown", (e) => {
	        if (e.key === "Escape") {
	            closeAllSelects();
	        }
	    });

	    select.addEventListener("keydown", (e) => {
	        const activeOption = optionsContainer.querySelector(".option:focus");
	        if (e.key === "ArrowDown") {
	            e.preventDefault();
	            if (e.altKey) {
	                // Alt + Down Arrow to open the options container
	                toggleOptions();
	            } else {
	                // Navigate options
	                if (activeOption && activeOption.nextElementSibling) {
	                    activeOption.nextElementSibling.focus();
	                } else {
	                    optionsContainer.querySelector(".option").focus();
	                }
	            }
	        } else if (e.key === "ArrowUp") {
	            e.preventDefault();
	            if (activeOption && activeOption.previousElementSibling) {
	                activeOption.previousElementSibling.focus();
	            } else {
	                optionsContainer.querySelector(".option:last-child").focus();
	            }
	        } else if (e.key === "Enter" && activeOption) {
	            e.preventDefault();
	            activeOption.click();
	        } else if (e.key === " ") {
	            e.preventDefault();
	            toggleOptions();
	        }
	    });

	    // Add tabindex for focusability
	    select.setAttribute('tabindex', '0');

	    // Handle focus and blur events for accessibility
	    select.addEventListener('focus', () => {
	        select.classList.add('focus');
	    });

	    select.addEventListener('blur', () => {
	        select.classList.remove('focus');
	        const errorId = hiddenInput.id + "_error";
	        const errorElement = document.getElementById(errorId);
	        if (errorElement) {
	        	errorElement.innerHTML = ""; // Clear error message
	        }
	    });
	}

    function setupCountryCodeSelect() {
        const selectElement = document.getElementById("country_code");

        function createCustomSelect() {
            const container = document.getElementById("country_code_select_container");
            const customSelect = document.createElement("div");
            customSelect.id = "country_code_select";
            customSelect.classList.add("custom-select");

            const selectedOption = document.createElement("div");
            selectedOption.classList.add("selected");
            selectedOption.textContent = selectElement.options[selectElement.selectedIndex].textContent;

            const optionsContainer = document.createElement("div");
            optionsContainer.classList.add("options");

            Array.from(selectElement.options).forEach(option => {
                const customOption = document.createElement("div");
                customOption.classList.add("option");
                customOption.dataset.value = option.value;
                customOption.textContent = option.textContent;

                if (option.value === "0") {
                    customOption.classList.add("disabled");
                    customOption.setAttribute("disabled", "disabled");
                }

                optionsContainer.appendChild(customOption);

                if (option.selected) {
                    customOption.classList.add("selected");
                }
            });

            customSelect.appendChild(selectedOption);
            customSelect.appendChild(optionsContainer);
            container.appendChild(customSelect);
            selectElement.style.display = "none";

            initCustomSelect("country_code_select", "country_code");

            customSelect.addEventListener("click", () => {
                const selected = optionsContainer.querySelector(".option.selected");
                if (selected) {
                    selected.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
                }
            });

            optionsContainer.addEventListener("click", (e) => {
                const option = e.target.closest(".option");
                if (option && option.classList.contains("disabled")) {
                    alert("Please select a valid country code.");
                }
            });
        }

        if (selectElement.options.length > 0) {
            createCustomSelect();
        } else {
            const observer = new MutationObserver(() => {
                if (selectElement.options.length > 0) {
                    observer.disconnect();
                    createCustomSelect();
                }
            });
            observer.observe(selectElement, { childList: true });
        }
    }

    function setupCountryOfResidenceSelect() {
        const selectElement = document.getElementById("country_of_residence");

        if (!selectElement) {
            console.error("Country of residence select element not found.");
            return;
        }

        function createCustomSelect() {
            const customSelectContainer = document.getElementById("country_of_residence_select");
            const selectedOption = customSelectContainer.querySelector(".selected");
            const optionsContainer = customSelectContainer.querySelector(".options");

            optionsContainer.innerHTML = '';

            Array.from(selectElement.options).forEach(option => {
                const customOption = document.createElement("div");
                customOption.classList.add("option");
                customOption.dataset.value = option.value;
                customOption.textContent = option.textContent;

                optionsContainer.appendChild(customOption);

                if (option.selected) {
                    selectedOption.textContent = option.textContent;
                    customOption.classList.add("selected");
                    setTimeout(() => customOption.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" }), 100);
                }
            });

            initCustomSelect("country_of_residence_select", "country_of_residence");

            optionsContainer.addEventListener("click", (e) => {
                const option = e.target.closest(".option");
                if (option) {
                    const selectedOption = optionsContainer.querySelector(".option.selected");
                    if (selectedOption) {
                        selectedOption.classList.remove("selected");
                    }
                    option.classList.add("selected");
                    setTimeout(() => option.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" }), 100);
                }
            });
	    }

        if (selectElement.options.length > 0) {
            createCustomSelect();
        } else {
            const observer = new MutationObserver(() => {
                if (selectElement.options.length > 0) {
                    observer.disconnect();
                    createCustomSelect();
                }
            });
            observer.observe(selectElement, { childList: true });
        }
    }

    function setupDurationSelect() {
        const durationSelectContainer = document.getElementById("displayDuration");
        const durationOptions = durationSelectContainer.querySelector(".options");
        const hiddenDurationInput = document.getElementById("duration");
        const selectedDuration = durationSelectContainer.querySelector(".selected");
        const durationError = document.getElementById("duration_error"); // Reference to the duration error element

        function selectDuration(value, text) {
            selectedDuration.innerText = text;
            hiddenDurationInput.value = value;
            durationOptions.classList.remove("active");

            // Clear the duration error message
            if (durationError) {
            	durationError.innerHTML = "";
            }
        }

        function populateDurationOptions() {
	        durationOptions.innerHTML = '';
	        for (let i = 1; i <= 20; i++) {
	            const optionDiv = document.createElement('div');
	            optionDiv.className = 'option';
	            optionDiv.dataset.value = `${i + 1} days`;
	            optionDiv.innerText = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
	            optionDiv.addEventListener("click", () => selectDuration(optionDiv.dataset.value, optionDiv.innerText));
	            durationOptions.appendChild(optionDiv);
	        }
	    }

        selectedDuration.addEventListener("click", (e) => {
            e.stopPropagation();
            durationOptions.classList.add("active");
        });

        window.addEventListener("click", (e) => {
            if (!durationSelectContainer.contains(e.target)) {
                durationOptions.classList.remove("active");
            }
        });

        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                durationOptions.classList.remove("active");
            }
        });

        durationSelectContainer.addEventListener("keydown", (e) => {
            const activeOption = durationOptions.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });

        // Populate the duration options initially
        populateDurationOptions();
    }

    function resetDurationSelect() {
    	const selectedDuration = document.getElementById("displayDuration").querySelector(".selected");
    	const hiddenDurationInput = document.getElementById("duration");
    	selectedDuration.innerText = "Select Duration";
    	hiddenDurationInput.value = "";
    }

    function resetTravellers() {
	    // Reset traveller counts
	    $(".span_value_adult").html(1);
	    $(".span_value_adult1").val(1);

	    $(".span_value_child").html(0);
	    $(".span_value_child1").val(0);

	    $(".span_value_child_without_bed").html(0);
	    $(".span_value_child2").val(0);

	    $(".span_value_infant").html(0);
	    $(".span_value_infant1").val(0);
	}

	function addTravellers() {
	    // Remove existing event listeners
	    $(".span_inc_adult, .span_des_adult, .span_inc_child, .span_des_child, .span_inc_child_without_bed, .span_des_child_without_bed, .span_inc_infant, .span_des_infant").off();

	    // Adult
	    $(".span_inc_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        $(".span_value_adult").html(parseInt(span_value_adult) + 1);
	        $(".span_value_adult1").val(parseInt(span_value_adult) + 1);
	    });
	    $(".span_des_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        if (span_value_adult >= 2) {
	            $(".span_value_adult").html(parseInt(span_value_adult) - 1);
	            $(".span_value_adult1").val(parseInt(span_value_adult) - 1);
	        }
	    });

	    // Child with bed
	    $(".span_inc_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        $(".span_value_child").html(parseInt(span_value_child) + 1);
	        $(".span_value_child1").val(parseInt(span_value_child) + 1);
	    });
	    $(".span_des_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        if (span_value_child >= 1) {
	            $(".span_value_child").html(parseInt(span_value_child) - 1);
	            $(".span_value_child1").val(parseInt(span_value_child) - 1);
	        }
	    });

	    // Child without bed
	    $(".span_inc_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) + 1);
	        $(".span_value_child2").val(parseInt(span_value_child_without_bed) + 1);
	    });
	    $(".span_des_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        if (span_value_child_without_bed >= 1) {
	            $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) - 1);
	            $(".span_value_child2").val(parseInt(span_value_child_without_bed) - 1);
	        }
	    });

	    // Infant
	    $(".span_inc_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        $(".span_value_infant").html(parseInt(span_value_infant) + 1);
	        $(".span_value_infant1").val(parseInt(span_value_infant) + 1);
	    });
	    $(".span_des_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        if (span_value_infant >= 1) {
	            $(".span_value_infant").html(parseInt(span_value_infant) - 1);
	            $(".span_value_infant1").val(parseInt(span_value_infant) - 1);
	        }
	    });
	}

	/*
		// Ensure showHideService is called initially to set the correct initial state
		document.addEventListener("DOMContentLoaded", showHideService);*/

		/*--------*/

		/*// hotel preference selection (separate working code)

	    // Select all radio buttons (working code)
	    const radioButtons = document.querySelectorAll('.custom-selection input[type="radio"]');

	    // Function to handle change event for radio buttons
	    function handleRadioChange() {
	        // Remove the selected-item class from all labels
	        radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

	        // Add the selected-item class to the selected label
	        if (this.checked) {
	            this.parentElement.classList.add('selected-item');
	        }
	    }

	    // Function to handle keypress event for radio buttons
	    function handleRadioKeypress(event) {
	        if (event.key === "Enter") {
	            this.click(); // Simulate click when Enter key is pressed
	        }
	    }

	    // Add event listeners for change and keypress events to each radio button
	    radioButtons.forEach(radio => {
	        radio.addEventListener('change', handleRadioChange);
	        radio.addEventListener('keypress', handleRadioKeypress);
	    });

	    // Trigger change event for pre-checked radio button to apply styles on page load
	    document.querySelector('.custom-selection input[type="radio"]:checked').dispatchEvent(new Event('change'));*/

	    /*--------*/

	    /*// Add event listeners to input fields to clear error messages when they lose focus
	    var inputFields = form.querySelectorAll("input");
	    inputFields.forEach(function(input) {
	        input.addEventListener("blur", function() {
	            var errorId = input.id + "_error";
	            document.getElementById(errorId).innerHTML = ""; // Clear error message
	        });
	    });

	    // Add event listener for Tab key press to allow field navigation
	    form.addEventListener("keydown", function(event) {
	        if (event.key === "Tab") {
	            // Allow tab navigation
	            return;
	        }
	    });*/

	    /*--------*/

	/*function budgetSlider() {
	    var budgetInput = document.getElementById("exp_budget");
	    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
	    var budgetSlider = document.getElementById("budgetSlider");

	    // Function to round the budget value to the nearest 50
	    function roundToNearest50(x) {
	                return Math.round(x / 500) * 500;
	    }

	    // Function to add commas to the budget value for better readability
	    function numberWithCommas(x) {
	        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	    }

	    // Function to update slider track color dynamically based on thumb position
	    function updateSliderTrackColor() {
	        var percentage = (budgetSlider.value - budgetSlider.min) / (budgetSlider.max - budgetSlider.min);
	        var color = 'linear-gradient(90deg, #08B2ED ' + percentage * 100 + '%, #d3d3d3 ' + percentage * 100 + '%)';
	        budgetSlider.style.background = color;
	    }

	    // Hide the budget slider container initially
	    budgetSliderContainer.style.display = "none";

	    // Add click event listener to the budget input
	    budgetInput.addEventListener("click", function(event) {
	    budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
	    event.stopPropagation(); // Prevent the click event from propagating to the document body
	    });

	    // Add input event listener to the budget slider
	    budgetSlider.addEventListener("input", function() {
		    // Round the slider value to the nearest 50
		    var roundedValue = roundToNearest50(budgetSlider.value);
		    // Update the slider value
		    budgetSlider.value = roundedValue;
		    // Update the input value with commas
		    budgetInput.value = numberWithCommas(roundedValue);
		    // Update slider track color
		    updateSliderTrackColor();
	    });

	    // Add click event listener to the document body
	    document.body.addEventListener("click", function() {
		    budgetSliderContainer.style.display = "none";
	        });

	    // Prevent the budget slider container from closing when clicking inside of it
	    budgetSliderContainer.addEventListener("click", function(event) {
	        event.stopPropagation(); // Prevent the click event from propagating to the document body
	    	});

	    // Update slider track color initially
	    updateSliderTrackColor();
	}*/

	function budgetSlider() {
	    var budgetInput = document.getElementById("exp_budget");
	    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
	    var budgetSlider = document.getElementById("budgetSlider");
	    var budgetError = document.getElementById("budget_error");

	    // Function to round the budget value to the nearest 50
	    function roundToNearest50(x) {
	        return Math.round(x / 500) * 500;
	    }

	    // Function to add commas to the budget value for better readability
	    function numberWithCommas(x) {
	        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	    }

	    // Function to update slider track color dynamically based on thumb position
	    function updateSliderTrackColor() {
	        var percentage = (budgetSlider.value - budgetSlider.min) / (budgetSlider.max - budgetSlider.min);
	        var color = 'linear-gradient(90deg, #08B2ED ' + percentage * 100 + '%, #d3d3d3 ' + percentage * 100 + '%)';
	        budgetSlider.style.background = color;
	    }

	    // Hide the budget slider container initially
	    budgetSliderContainer.style.display = "none";

	    // Add click event listener to the budget input
	    budgetInput.addEventListener("click", function(event) {
	        budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
	        event.stopPropagation(); // Prevent the click event from propagating to the document body
	    });

	    // Add input event listener to the budget slider
	    budgetSlider.addEventListener("input", function() {
	        // Round the slider value to the nearest 50
	        var roundedValue = roundToNearest50(budgetSlider.value);
	        // Update the slider value
	        budgetSlider.value = roundedValue;
	        // Update the input value with commas
	        budgetInput.value = numberWithCommas(roundedValue);
	        // Update slider track color
	        updateSliderTrackColor();

	        // Clear budget error message
	        budgetError.innerHTML = "";
	    });

	    // Add click event listener to the document body
	    document.body.addEventListener("click", function() {
	        budgetSliderContainer.style.display = "none";
	    });

	    // Prevent the budget slider container from closing when clicking inside of it
	    budgetSliderContainer.addEventListener("click", function(event) {
	        event.stopPropagation(); // Prevent the click event from propagating to the document body
	    });

	    // Update slider track color initially
	    updateSliderTrackColor();
	}

    function handleServiceTypeChange() {
	    const serviceTypeSelect = document.getElementById("service_type_select");
	    const selectedOption = serviceTypeSelect.querySelector(".selected");

	    serviceTypeSelect.addEventListener("click", () => {
	        const selectedServiceType = selectedOption.textContent.trim();

	        if (selectedServiceType === "Visa") {
	            updateVisaDurationOptions();
	            updateVisaAgeLabels();
	        } else if (selectedServiceType === "Cruise") {
	            updateCruiseDurationOptions();
	            resetAgeLabels(); // Reset age labels for other service types
	        } else if (selectedServiceType === "Travel Insurance") {
	            updateInsuranceAgeLabels();
	        } else {
	            revertToDefaultDurationOptions();
	            resetAgeLabels(); // Reset age labels for other service types
	        }
	        // Reset duration options on service type change
	        setDefaultOption("displayDuration", "Select Duration");
	        showHideService();  // Call the function to show/hide fields based on service type
	    });
	}

	/*--------*/

    function setDefaultOption(selectId, defaultOptionText) {
	    const selectElement = document.getElementById(selectId);
	    const hiddenInputId = selectElement.getAttribute("data-hidden-input");
	    const hiddenInput = document.getElementById(hiddenInputId);
	    const options = selectElement.querySelectorAll(".option");

	    options.forEach(option => {
	        if (option.textContent.trim() === defaultOptionText) {
	            option.classList.add("selected");
	            hiddenInput.value = option.dataset.value;  // Ensure value is set correctly
	        } else {
	            option.classList.remove("selected");
	        }
	    });

	    // Update the selected option text even if it's not found (for cases like page load)
	    selectElement.querySelector(".selected").textContent = defaultOptionText;
	}

    function updateVisaDurationOptions() {
        const durationSelectContainer = document.getElementById("displayDuration");
        const durationOptions = durationSelectContainer.querySelector(".options");
        const selectedDuration = durationSelectContainer.querySelector(".selected");
        const hiddenDurationInput = document.getElementById("duration");

        function selectDuration(value, text) {
            selectedDuration.innerText = text;
            hiddenDurationInput.value = value;
            durationOptions.classList.remove("active");
        }

        durationOptions.innerHTML = "";

        const visaDurations = [
            { value: "15 days", text: "15 days" },
            { value: "30 days", text: "30 days" },
            { value: "60 days", text: "60 days" },
            { value: "90 days", text: "3 months" },
            { value: "180 days", text: "6 months" },
            { value: "365 days", text: "1 year" },
            { value: "730 days", text: "2 years" },
            { value: "1825 days", text: "5 years" },
            { value: "3650 days", text: "10 years" }
        ];

        visaDurations.forEach(duration => {
            const optionDiv = document.createElement("div");
            optionDiv.className = "option";
            optionDiv.dataset.value = duration.value;
            optionDiv.textContent = duration.text;
            optionDiv.addEventListener("click", () => selectDuration(duration.value, duration.text));
            durationOptions.appendChild(optionDiv);
        });

        selectedDuration.addEventListener("click", (e) => {
            e.stopPropagation();
            durationOptions.classList.add("active");
        });

        window.addEventListener("click", (e) => {
            if (!durationSelectContainer.contains(e.target)) {
                durationOptions.classList.remove("active");
            }
        });

        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                durationOptions.classList.remove("active");
            }
        });

        durationSelectContainer.addEventListener("keydown", (e) => {
            const activeOption = durationOptions.querySelector(".option:focus");
            if (e.key === "ArrowDown") {
                e.preventDefault();
                if (activeOption && activeOption.nextElementSibling) {
                    activeOption.nextElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option").focus();
                }
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                if (activeOption && activeOption.previousElementSibling) {
                    activeOption.previousElementSibling.focus();
                } else {
                    durationOptions.querySelector(".option:last-child").focus();
                }
            } else if (e.key === "Enter" && activeOption) {
                e.preventDefault();
                activeOption.click();
            }
        });
    }

    function updateCruiseDurationOptions() {
	    const durationSelectContainer = document.getElementById("displayDuration");
	    const durationOptions = durationSelectContainer.querySelector(".options");
	    const selectedDuration = durationSelectContainer.querySelector(".selected");
	    const hiddenDurationInput = document.getElementById("duration");

	    function selectDuration(value, text) {
	        selectedDuration.innerText = text;
	        hiddenDurationInput.value = value;
	        durationOptions.classList.remove("active");
	    }

	    durationOptions.innerHTML = "";

	    for (let i = 2; i <= 20; i++) {
	        const optionDiv = document.createElement('div');
	        optionDiv.className = 'option';
	        optionDiv.dataset.value = `${i} night`;
	        optionDiv.innerText = (i === 1) ? `${i} Night / ${i + 1} Days` : `${i} Nights / ${i + 1} Days`;
	        optionDiv.onclick = () => selectDuration(optionDiv.dataset.value, optionDiv.innerText);
	        durationOptions.appendChild(optionDiv);
	    }

	    selectedDuration.addEventListener("click", (e) => {
	        e.stopPropagation();
	        durationOptions.classList.add("active");
	    });

	    window.addEventListener("click", (e) => {
	        if (!durationSelectContainer.contains(e.target)) {
	            durationOptions.classList.remove("active");
	        }
	    });

	    window.addEventListener("keydown", (e) => {
	        if (e.key === "Escape") {
	            durationOptions.classList.remove("active");
	        }
	    });

	    durationSelectContainer.addEventListener("keydown", (e) => {
	        const activeOption = durationOptions.querySelector(".option:focus");
	        if (e.key === "ArrowDown") {
	            e.preventDefault();
	            if (activeOption && activeOption.nextElementSibling) {
	                activeOption.nextElementSibling.focus();
	            } else {
	                durationOptions.querySelector(".option").focus();
	            }
	        } else if (e.key === "ArrowUp") {
	            e.preventDefault();
	            if (activeOption && activeOption.previousElementSibling) {
	                activeOption.previousElementSibling.focus();
	            } else {
	                durationOptions.querySelector(".option:last-child").focus();
	            }
	        } else if (e.key === "Enter" && activeOption) {
	            e.preventDefault();
	            activeOption.click();
	        }
	    });
	}

	function updateVisaAgeLabels() {
	    document.getElementById("adult").innerHTML = "Adult<br>(+18yrs)";
	    document.getElementById("childwithbed").innerHTML = "Child<br>(2-18yrs)";
	    document.getElementById("childwithoutbed").innerHTML = "Traveller<br>(61-70yrs)"; // disabled in visa through showhideservice
	    document.getElementById("infant").innerHTML = "Infant<br>(0-2yrs)";
	}

	function updateInsuranceAgeLabels() {
	    document.getElementById("adult").innerHTML = "Traveller<br>(0-40yrs)";
	    document.getElementById("childwithbed").innerHTML = "Traveller<br>(41-60yrs)";
	    document.getElementById("childwithoutbed").innerHTML = "Traveller<br>(61-70yrs)";
	    document.getElementById("infant").innerHTML = "Traveller<br>(+71yrs)";
	}

	function resetAgeLabels() {
	    document.getElementById("adult").innerHTML = "Adult<br>(+12yrs)";
	    document.getElementById("childwithbed").innerHTML = "Child with bed<br>(2-12yrs)";
	    document.getElementById("childwithoutbed").innerHTML = "Child without bed<br>(2-12yrs)";
	    document.getElementById("infant").innerHTML = "Infant<br>(0-2yrs)";
	}

	function revertToDefaultDurationOptions() {
		setupDurationSelect();
	}

	/*--------*/

	// The showHideService function
	function showHideService() {
	    // Get the selected service type from the hidden input
	    const serviceType = document.getElementById("service_type").value;

	    // Elements to show/hide
	    const displayhtlpref = document.getElementById("displayhtlpref");
	    const displayfltbkngpref = document.getElementById("displayfltbkngpref");
	    /*const displayfamilytrip = document.getElementById("displayfamilytrip");
	    const displayleisuretrip = document.getElementById("displayleisuretrip");
	    const displayhoneymoontrip = document.getElementById("displayhoneymoontrip");
	    const displaybusinesstrip = document.getElementById("displaybusinesstrip");*/

	    const tourAdtnlDtls = document.getElementById("tourAdtnlDtls");

	    const displayBudget = document.getElementById("displayBudget");
	    const displayVisaType = document.getElementById("displayVisaType");
	    const displayVisaEntry = document.getElementById("displayVisaEntry");
	    const displayVisaService = document.getElementById("displayVisaService");
	    const displayCruiseLine = document.getElementById("displayCruiseLine");
	    const displayCruiseCabin = document.getElementById("displayCruiseCabin");
	    const cwobTraveller = document.getElementById("cwob_traveller");

	    // Conditions for specific services
	    const isTourPackage = (serviceType === "Tour Package");
	    const isAccommodation = (serviceType === "Accommodation");
	    const isCruise = (serviceType === "Cruise");
	    const isVisa = (serviceType === "Visa");

	    /*----------*/

	    // Show/Hide fields based on service type
	    if (isTourPackage) {
	    	displayfltbkngpref.classList.remove("d-none");
	        /*displayfamilytrip.classList.remove("d-none");
	        displaybusinesstrip.classList.remove("d-none");
	        displayleisuretrip.classList.remove("d-none");
	        displayhoneymoontrip.classList.remove("d-none");*/
	        tourAdtnlDtls.classList.remove("d-none");
	        displayBudget.classList.remove("d-none");
	    } else {
	    	displayfltbkngpref.classList.add("d-none");
	        /*displayfamilytrip.classList.add("d-none");
	        displaybusinesstrip.classList.add("d-none");
	        displayleisuretrip.classList.add("d-none");
	        displayhoneymoontrip.classList.add("d-none");*/
	        tourAdtnlDtls.classList.add("d-none")
	    }

	    // Show/Hide fields based on service type
	    if (isAccommodation) {
	        // Hide fields specific to Accommodation
	        /*displayfamilytrip.classList.add("d-none");
	        displaybusinesstrip.classList.add("d-none");
	        displayleisuretrip.classList.add("d-none");
	        displayhoneymoontrip.classList.add("d-none");*/
	        tourAdtnlDtls.classList.add("d-none")
	    }

	    // Show/Hide fields based on service type
	    if (isTourPackage || isAccommodation) {
	        displayhtlpref.classList.remove("d-none");
	    } else {
	        displayhtlpref.classList.add("d-none");
	    }

	    /*----------*/

	    // Handle Visa
	    if (isVisa) {
	        displayVisaType.classList.remove("d-none");
	        displayVisaEntry.classList.remove("d-none");
	        displayVisaService.classList.remove("d-none");
	        cwobTraveller.classList.add("d-none");
	    } else {
	        displayVisaType.classList.add("d-none");
	        displayVisaEntry.classList.add("d-none");
	        displayVisaService.classList.add("d-none");
	        cwobTraveller.classList.remove("d-none");
	    }

	    /*----------*/

	    // Handle Cruise
	    if (isCruise) {
	        displayCruiseLine.classList.remove("d-none");
	        displayCruiseCabin.classList.remove("d-none");
	        displayBudget.classList.remove("d-none"); // Ensure displayBudget is shown
	    } else {
	        displayCruiseLine.classList.add("d-none");
	        displayCruiseCabin.classList.add("d-none");
	    }

	    // Handle Budget for all relevant service types
	    if (isTourPackage || isAccommodation || isCruise) {
	        displayBudget.classList.remove("d-none");
	    } else {
	        displayBudget.classList.add("d-none");
	    }

	    /*----------*/

	    // Call the hotel preference handler
    	handleHotelPreference();
    	/*handleFlightPreference();
    	handleAdditionalDetailsChange();*/
    	flightPreferenceHandlers.reset();
        additionalDetailsHandlers.reset();

    	/*// Reset the Connect Time custom select input (also in form validation, both are mandatory if two different dom)
    	resetConnectTime();

    	// Reset travellers
    	resetTravellers();*/

    	resetFields();

	    /*----------*/
	}

	function resetConnectTime() {
	    const timeCallSelect = document.getElementById("time_call_select");
	    const selectedOption = timeCallSelect.querySelector(".selected");
	    const hiddenInput = document.getElementById("time_call");

	    selectedOption.textContent = "Select time to call"; // Reset display text
	    hiddenInput.value = ""; // Reset hidden input value
	}

	// Function to handle hotel preference radio buttons
	function handleHotelPreference() {
	    const radioButtons = document.querySelectorAll('.hotel-selection input[type="radio"]');
	    const defaultHotelPreference = 4; // Default hotel preference value

	    // Function to handle change event for radio buttons
	    function handleRadioChange() {
	        // Remove the selected-item class from all labels
	        radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

	        // Add the selected-item class to the selected label
	        if (this.checked) {
	            this.parentElement.classList.add('selected-item');
	        }
	    }

	    // Function to handle keypress event for radio buttons
	    function handleRadioKeypress(event) {
	        if (event.key === "Enter") {
	            this.click(); // Simulate click when Enter key is pressed
	        }
	    }

	    // Add event listeners for change and keypress events to each radio button
	    radioButtons.forEach(radio => {
	        radio.addEventListener('change', handleRadioChange);
	        radio.addEventListener('keypress', handleRadioKeypress);
	    });

	    // Initialize hotel preference radio buttons based on service type
	    const serviceType = document.getElementById("service_type").value;
	    const isTourPackage = (serviceType === "Tour Package");
	    const isAccommodation = (serviceType === "Accommodation");

	    if (isTourPackage || isAccommodation) {
	        // Reset radio buttons
	        radioButtons.forEach(radio => {
	            radio.checked = false;
	            radio.parentElement.classList.remove('selected-item');
	        });

	        // Check the radio button with value 4 by default
	        const defaultRadioButton = document.querySelector(`.hotel-selection input[type="radio"][value="${defaultHotelPreference}"]`);
	        if (defaultRadioButton) {
	            defaultRadioButton.checked = true;
	            defaultRadioButton.dispatchEvent(new Event('change'));
	        }
	        /*// Check the first radio button by default
	        const firstRadioButton = document.querySelector('.hotel-selection input[type="radio"]');
	        if (firstRadioButton) {
	            firstRadioButton.checked = true;
	            firstRadioButton.dispatchEvent(new Event('change'));
	        }*/
	    } else {
	        // Uncheck all radio buttons if not Tour Package or Accommodation
	        radioButtons.forEach(radio => {
	            radio.checked = false;
	            radio.parentElement.classList.remove('selected-item');
	        });
	    }
	}

	// Function to handle flight preference radio buttons
	/*function handleFlightPreference() {
	    const radioButtons = document.querySelectorAll('.flight-booking-selection input[type="radio"]');
	    const defaultFlightPreference = 3; // Default flight preference value

	    // Function to handle change event for radio buttons
	    function handleRadioChange() {
	        // Remove the selected-item class from all labels
	        radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

	        // Add the selected-item class to the selected label
	        if (this.checked) {
	            this.parentElement.classList.add('selected-item');
	        }
	    }

	    // Function to handle keypress event for radio buttons
	    function handleRadioKeypress(event) {
	        if (event.key === "Enter") {
	            this.click(); // Simulate click when Enter key is pressed
	        }
	    }

	    // Add event listeners for change and keypress events to each radio button
	    radioButtons.forEach(radio => {
	        radio.addEventListener('change', handleRadioChange);
	        radio.addEventListener('keypress', handleRadioKeypress);
	    });

	    // Initialize hotel preference radio buttons based on service type
	    const serviceType = document.getElementById("service_type").value;
	    const isTourPackage = (serviceType === "Tour Package");
	    const isAccommodation = (serviceType === "Accommodation");

	    if (isTourPackage) {
	        // Reset radio buttons
	        radioButtons.forEach(radio => {
	            radio.checked = false;
	            radio.parentElement.classList.remove('selected-item');
	        });

	        // Check the radio button with value 4 by default
	        const defaultRadioButton = document.querySelector(`.flight-booking-selection input[type="radio"][value="${defaultFlightPreference}"]`);
	        if (defaultRadioButton) {
	            defaultRadioButton.checked = true;
	            defaultRadioButton.dispatchEvent(new Event('change'));
	        }
	    } else {
	        // Uncheck all radio buttons if not Tour Package or Accommodation
	        radioButtons.forEach(radio => {
	            radio.checked = false;
	            radio.parentElement.classList.remove('selected-item');
	        });
	    }
	}*/
    /*function handleFlightPreference() {
        const radioButtons = document.querySelectorAll('.flight-booking-selection input[type="radio"]');

        // Function to handle change event for radio buttons
        function handleRadioChange() {
            // Remove the selected-item class from all labels
            radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

            // Add the selected-item class to the selected label
            if (this.checked) {
                this.parentElement.classList.add('selected-item');
            }
        }

        // Function to handle keypress event for radio buttons
        function handleRadioKeypress(event) {
            if (event.key === "Enter") {
                this.click(); // Simulate click when Enter key is pressed
            }
        }

        // Add event listeners for change and keypress events to each radio button
        radioButtons.forEach(radio => {
            radio.addEventListener('change', handleRadioChange);
            radio.addEventListener('keypress', handleRadioKeypress);
        });
    }*/

    // Function to handle flight preference radio buttons
    /*function handleFlightPreference() {
        const radioButtons = document.querySelectorAll('.flight-booking-selection input[type="radio"]');
        const additionalDetailsTextarea = document.getElementById('additionaldetails');

        // Ensure the textarea exists
        if (!additionalDetailsTextarea) {
            console.error('Textarea with id "additionaldetails" not found');
            return;
        }

        // Function to handle change event for radio buttons
        function handleRadioChange() {
            // Remove the selected-item class from all labels
            radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

            // Add the selected-item class to the selected label
            if (this.checked) {
                this.parentElement.classList.add('selected-item');
                updateAdditionalDetails(this.value);
            }
        }

        // Function to handle keypress event for radio buttons
        function handleRadioKeypress(event) {
            if (event.key === "Enter") {
                this.click(); // Simulate click when Enter key is pressed
            }
        }

        // Function to update the additional request textarea
        function updateAdditionalDetails(value) {
            let message = '';
            if (value === 'yes') {
                message = 'Flight ticket booked: Yes';
            } else if (value === 'no') {
                message = 'Flight ticket booked: No';
            }
            additionalDetailsTextarea.value = message;
        }

        // Add event listeners for change and keypress events to each radio button
        radioButtons.forEach(radio => {
            radio.addEventListener('change', handleRadioChange);
            radio.addEventListener('keypress', handleRadioKeypress);
        });
    }*/


   /* // Function to handle flight preference radio buttons
    function handleFlightPreference() {
        const radioButtons = document.querySelectorAll('.flight-booking-selection input[type="radio"]');
        const additionalDetailsTextarea = document.getElementById("additionaldetails");

        // Function to handle change event for radio buttons
        function handleRadioChange() {
            // Remove the selected-item class from all labels
            radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

            // Add the selected-item class to the selected label
            if (this.checked) {
                this.parentElement.classList.add('selected-item');
            }

            // Update the additional requests textarea
            updateAdditionalDetails();
        }

        // Add event listeners for change events to each radio button
        radioButtons.forEach(radio => {
            radio.addEventListener('change', handleRadioChange);
        });
    }

    // Function to handle checkbox changes for additional details
    function handleAdditionalDetailsChange() {
        const checkboxes = document.querySelectorAll('.additional_details');
        const additionalDetailsTextarea = document.getElementById("additionaldetails");

        // Add event listeners for change events to each checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateAdditionalDetails);
        });
    }

    // Function to update the additional requests textarea
    function updateAdditionalDetails() {
        const radioButtons = document.querySelectorAll('.flight-booking-selection input[type="radio"]');
        const checkboxes = document.querySelectorAll('.additional_details');
        const additionalDetailsTextarea = document.getElementById("additionaldetails");
        let details = [];

        // Add flight booking preference to the details array
        radioButtons.forEach(radio => {
            if (radio.checked) {
                details.push(`Flight ticket booked: ${radio.value === "0" ? "Yes" : "No"}`);
            }
        });

        // Add additional details from checkboxes to the details array
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                details.push(checkbox.value);
            }
        });

        // Join the details array into a string and update the textarea
        additionalDetailsTextarea.value = details.join(', ');
    }*/


function handleFlightPreference() {
        const radioButtons = document.querySelectorAll('.flight-booking-selection input[type="radio"]');
        const additionalDetailsTextarea = document.getElementById("additionaldetails");

        // Function to handle change event for radio buttons
        function handleRadioChange() {
            // Remove the selected-item class from all labels
            radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

            // Add the selected-item class to the selected label
            if (this.checked) {
                this.parentElement.classList.add('selected-item');
            }

            // Update the additional requests textarea
            updateAdditionalDetails();
        }

        // Add event listeners for change events to each radio button
        radioButtons.forEach(radio => {
            radio.addEventListener('change', handleRadioChange);
        });

        // Function to reset flight preference radio buttons
        function resetFlightPreference() {
            radioButtons.forEach(radio => {
                radio.checked = false;
                radio.parentElement.classList.remove('selected-item');
            });
        }

        return {
            reset: resetFlightPreference
        };
    }

    // Function to handle checkbox changes for additional details
    function handleAdditionalDetailsChange() {
        const checkboxes = document.querySelectorAll('.additional_details');
        const additionalDetailsTextarea = document.getElementById("additionaldetails");

        // Add event listeners for change events to each checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateAdditionalDetails);
        });

        // Function to reset additional details checkboxes
        function resetAdditionalDetails() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateAdditionalDetails(); // Update textarea to reflect reset state
        }

        return {
            reset: resetAdditionalDetails
        };
    }

    // Function to update the additional requests textarea
    function updateAdditionalDetails() {
        const radioButtons = document.querySelectorAll('.flight-booking-selection input[type="radio"]');
        const checkboxes = document.querySelectorAll('.additional_details');
        const additionalDetailsTextarea = document.getElementById("additionaldetails");
        let details = [];

        // Add flight booking preference to the details array
        radioButtons.forEach(radio => {
            if (radio.checked) {
                details.push(`Flight ticket booked: ${radio.value === "0" ? "Yes" : "No"}`);
            }
        });

        // Add additional details from checkboxes to the details array
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                details.push(checkbox.value);
            }
        });

        // Join the details array into a string and update the textarea
        additionalDetailsTextarea.value = details.join(', ');
    }




	function resetFields() {
	    const fields = [
	    	{ selectId: "visatype_select", hiddenInputId: "visatype", defaultText: "Select Visa Type" },
	        { selectId: "visaentry_select", hiddenInputId: "visaentry", defaultText: "Select Visa Entry" },
	        { selectId: "visaservice_select", hiddenInputId: "visaservice", defaultText: "Select Visa Service" },
	        { selectId: "cruiseline_select", hiddenInputId: "cruiseline", defaultText: "Select Cruise Lines" },
	        { selectId: "cruisecabin_select", hiddenInputId: "cruisecabin", defaultText: "Select Cruise Cabins" },
	        { selectId: "time_call_select", hiddenInputId: "time_call", defaultText: "Select time to calls" },
	        { selectId: "displayDuration", hiddenInputId: "duration", defaultText: "Select Duration" }
	    ];

	    fields.forEach(field => {
	        const selectElement = document.getElementById(field.selectId);
	        const hiddenInputElement = document.getElementById(field.hiddenInputId);
	        if (selectElement && hiddenInputElement) {
	            selectElement.querySelector(".selected").innerText = field.defaultText;
	            hiddenInputElement.value = "";
	        }
	    });

	    // Reset traveller counts
	    $(".span_value_adult").html(1);
	    $(".span_value_adult1").val(1);

	    $(".span_value_child").html(0);
	    $(".span_value_child1").val(0);

	    $(".span_value_child_without_bed").html(0);
	    $(".span_value_child2").val(0);

	    $(".span_value_infant").html(0);
	    $(".span_value_infant1").val(0);
	}

	/*function showHideService() {
	    // Get the selected service type
	    const serviceTypeSelect = document.getElementById("service_type_select");
	    const selectedOption = serviceTypeSelect.querySelector(".selected");
	    const serviceType = selectedOption ? selectedOption.textContent.trim() : "";

	    // Tour Package & Hotels
	    const displayhtlpref = document.getElementById("displayhtlpref");
	    const displaychildbed = document.getElementById("displaychildbed");
	    const displayleisure = document.getElementById("displayleisure");
	    const displayhoneymoon = document.getElementById("displayhoneymoon");
	    const displayflightbooked = document.getElementById("displayflightbooked");

	    const tourPackageOrHotel = (serviceType === "Tour Package" || serviceType === "Hotels");

	    displayhtlpref.style.display = tourPackageOrHotel ? "block" : "none";
	    displaychildbed.style.display = tourPackageOrHotel ? "block" : "none";
	    displayflightbooked.style.display = tourPackageOrHotel ? "block" : "none";
	    displayleisure.style.display = tourPackageOrHotel ? "block" : "none";
	    displayhoneymoon.style.display = tourPackageOrHotel ? "block" : "none";

	    // Visa
	    const displayVisaType = document.getElementById("displayVisaType");
	    const displayVisaValidity = document.getElementById("displayVisaValidity");
	    const displayVisaEntry = document.getElementById("displayVisaEntry");
	    const displayVisaService = document.getElementById("displayVisaService");

	    const visaSelected = (serviceType === "Visa");

	    displayVisaType.style.display = visaSelected ? "block" : "none";
	    displayVisaValidity.style.display = visaSelected ? "block" : "none";
	    displayVisaEntry.style.display = visaSelected ? "block" : "none";
	    displayVisaService.style.display = visaSelected ? "block" : "none";

	    // Debug logs to confirm visibility changes
	    console.log("Visa Fields Visibility:");
	    console.log("displayVisaType:", displayVisaType.style.display);
	    console.log("displayVisaValidity:", displayVisaValidity.style.display);
	    console.log("displayVisaEntry:", displayVisaEntry.style.display);
	    console.log("displayVisaService:", displayVisaService.style.display);

	    // Cruise
	    const displayCruiseLine = document.getElementById("displayCruiseLine");
	    const displayCruiseCabin = document.getElementById("displayCruiseCabin");

	    const cruiseSelected = (serviceType === "Cruise");

	    displayCruiseLine.style.display = cruiseSelected ? "block" : "none";
	    displayCruiseCabin.style.display = cruiseSelected ? "block" : "none";

	    // Debug logs to confirm visibility changes for Cruise
	    console.log("Cruise Fields Visibility:");
	    console.log("displayCruiseLine:", displayCruiseLine.style.display);
	    console.log("displayCruiseCabin:", displayCruiseCabin.style.display);
	}*/

	/*function showHideService() {
	    // Get the selected service type
	    const serviceTypeSelect = document.getElementById("service_type_select");
	    const selectedOption = serviceTypeSelect.querySelector(".selected");
	    const serviceType = selectedOption ? selectedOption.textContent.trim() : "";

	    // Tour Package & Accommodation
	    const displayhtlpref = document.getElementById("displayhtlpref");
	    const displaychildbed = document.getElementById("displaychildbed");
	    const displayleisure = document.getElementById("displayleisure");
	    const displayhoneymoon = document.getElementById("displayhoneymoon");
	    const displayflightbooked = document.getElementById("displayflightbooked");

	    const tourPackageOrAccommodation = (serviceType === "Tour Package" || serviceType === "Accommodation");

	    displayhtlpref.style.display = tourPackageOrAccommodation ? "block" : "none";
	    displaychildbed.style.display = tourPackageOrAccommodation ? "block" : "none";
	    displayflightbooked.style.display = tourPackageOrAccommodation ? "block" : "none";
	    displayleisure.style.display = tourPackageOrAccommodation ? "block" : "none";
	    displayhoneymoon.style.display = tourPackageOrAccommodation ? "block" : "none";

	    // Visa
	    const displayVisaType = document.getElementById("displayVisaType");
	    const displayVisaEntry = document.getElementById("displayVisaEntry");
	    const displayVisaService = document.getElementById("displayVisaService");

	    const visaSelected = (serviceType === "Visa");

	    displayVisaType.style.display = visaSelected ? "block" : "none";
	    displayVisaEntry.style.display = visaSelected ? "block" : "none";
	    displayVisaService.style.display = visaSelected ? "block" : "none";

	    // Cruise
	    const displayCruiseLine = document.getElementById("displayCruiseLine");
	    const displayCruiseCabin = document.getElementById("displayCruiseCabin");

	    const cruiseSelected = (serviceType === "Cruise");

	    displayCruiseLine.style.display = cruiseSelected ? "block" : "none";
	    displayCruiseCabin.style.display = cruiseSelected ? "block" : "none";

	    // Travel Insurance (if needed)
	    // Add your logic here for Travel Insurance if you want to show/hide specific fields for this service type

	    // Debug logs to confirm visibility changes
	    console.log("Service Type:", serviceType);
	    console.log("Tour Package or Accommodation Fields Visibility:");
	    console.log("displayhtlpref:", displayhtlpref.style.display);
	    console.log("displaychildbed:", displaychildbed.style.display);
	    console.log("displayleisure:", displayleisure.style.display);
	    console.log("displayhoneymoon:", displayhoneymoon.style.display);
	    console.log("displayflightbooked:", displayflightbooked.style.display);

	    console.log("Visa Fields Visibility:");
	    console.log("displayVisaType:", displayVisaType.style.display);
	    console.log("displayVisaEntry:", displayVisaEntry.style.display);
	    console.log("displayVisaService:", displayVisaService.style.display);

	    console.log("Cruise Fields Visibility:");
	    console.log("displayCruiseLine:", displayCruiseLine.style.display);
	    console.log("displayCruiseCabin:", displayCruiseCabin.style.display);
	}*/

	/*function showHideService() {
	    // Get the selected service type from the hidden input
	    const serviceType = document.getElementById("service_type").value;

	    // Tour Package & Accommodation
	    const displayhtlpref = document.getElementById("displayhtlpref");
	    const displaychildbed = document.getElementById("displaychildbed");
	    const displayleisure = document.getElementById("displayleisure");
	    const displayhoneymoon = document.getElementById("displayhoneymoon");
	    const displayflightbooked = document.getElementById("displayflightbooked");
	    const displayBudget = document.getElementById("displayBudget");

	    const tourPackageOrAccommodation = (serviceType === "Tour Package" || serviceType === "Accommodation");

	    if (tourPackageOrAccommodation) {
	        displayhtlpref.classList.remove("d-none");
	        displaychildbed.classList.remove("d-none");
	        displayflightbooked.classList.remove("d-none");
	        displayleisure.classList.remove("d-none");
	        displayhoneymoon.classList.remove("d-none");
	        displayBudget.classList.remove("d-none");
	    } else {
	        displayhtlpref.classList.add("d-none");
	        displaychildbed.classList.add("d-none");
	        displayflightbooked.classList.add("d-none");
	        displayleisure.classList.add("d-none");
	        displayhoneymoon.classList.add("d-none");
	        displayBudget.classList.add("d-none");
	    }

	    // Visa
	    const displayVisaType = document.getElementById("displayVisaType");
	    const displayVisaEntry = document.getElementById("displayVisaEntry");
	    const displayVisaService = document.getElementById("displayVisaService");

	    const visaSelected = (serviceType === "Visa");

	    if (visaSelected) {
	        displayVisaType.classList.remove("d-none");
	        displayVisaEntry.classList.remove("d-none");
	        displayVisaService.classList.remove("d-none");
	    } else {
	        displayVisaType.classList.add("d-none");
	        displayVisaEntry.classList.add("d-none");
	        displayVisaService.classList.add("d-none");
	    }

	    // Cruise
	    const displayCruiseLine = document.getElementById("displayCruiseLine");
	    const displayCruiseCabin = document.getElementById("displayCruiseCabin");

	    const cruiseSelected = (serviceType === "Cruise");

	    if (cruiseSelected) {
	        displayCruiseLine.classList.remove("d-none");
	        displayCruiseCabin.classList.remove("d-none");
	    } else {
	        displayCruiseLine.classList.add("d-none");
	        displayCruiseCabin.classList.add("d-none");
	    }

	    // Travel Insurance (if needed)
	    // Add your logic here for Travel Insurance if you want to show/hide specific fields for this service type

	    // Debug logs to confirm visibility changes
	    console.log("Service Type:", serviceType);
	    console.log("Tour Package or Accommodation Fields Visibility:");
	    console.log("displayhtlpref:", displayhtlpref.classList.contains("d-none") ? "hidden" : "visible");
	    console.log("displaychildbed:", displaychildbed.classList.contains("d-none") ? "hidden" : "visible");
	    console.log("displayleisure:", displayleisure.classList.contains("d-none") ? "hidden" : "visible");
	    console.log("displayhoneymoon:", displayhoneymoon.classList.contains("d-none") ? "hidden" : "visible");
	    console.log("displayflightbooked:", displayflightbooked.classList.contains("d-none") ? "hidden" : "visible");

	    console.log("Visa Fields Visibility:");
	    console.log("displayVisaType:", displayVisaType.classList.contains("d-none") ? "hidden" : "visible");
	    console.log("displayVisaEntry:", displayVisaEntry.classList.contains("d-none") ? "hidden" : "visible");
	    console.log("displayVisaService:", displayVisaService.classList.contains("d-none") ? "hidden" : "visible");

	    console.log("Cruise Fields Visibility:");
	    console.log("displayCruiseLine:", displayCruiseLine.classList.contains("d-none") ? "hidden" : "visible");
	    console.log("displayCruiseCabin:", displayCruiseCabin.classList.contains("d-none") ? "hidden" : "visible");
	}*/

	/*document.querySelectorAll("#service_type_select .option").forEach(option => {
	    option.addEventListener("click", () => {
	        const hiddenInput = document.getElementById("service_type");
	        hiddenInput.value = option.getAttribute("data-value");

	        const selected = document.querySelector("#service_type_select .selected");
	        selected.textContent = option.textContent.trim();

	        showHideService(); // Call the function to show/hide fields based on the selected service type
	    });
	});*/


	/*// The event listener for service type selection
	document.querySelectorAll("#service_type_select .option").forEach(option => {
	    option.addEventListener("click", () => {
	        const hiddenInput = document.getElementById("service_type");
	        hiddenInput.value = option.getAttribute("data-value");

	        const selected = document.querySelector("#service_type_select .selected");
	        selected.textContent = option.textContent.trim();

	        showHideService(); // Call the function to show/hide fields based on the selected service type
	    });
	});*/

	/*});



	document.addEventListener("DOMContentLoaded", function() {*/

	/*form validation*/
	/*function resetConnectTime() {
	    const timeCallSelect = document.getElementById("time_call_select");
	    const selectedOption = timeCallSelect.querySelector(".selected");
	    const hiddenInput = document.getElementById("time_call");

	    selectedOption.textContent = "Select time to call"; // Reset display text
	    hiddenInput.value = ""; // Reset hidden input value
	}

    function resetTravellers() {
	    // Reset traveller counts
	    $(".span_value_adult").html(1);
	    $(".span_value_adult1").val(1);

	    $(".span_value_child").html(0);
	    $(".span_value_child1").val(0);

	    $(".span_value_child_without_bed").html(0);
	    $(".span_value_child2").val(0);

	    $(".span_value_infant").html(0);
	    $(".span_value_infant1").val(0);
	}*/

	/*form validation*/
    var form = document.getElementById("enquiry_form");
    var submitButton = document.getElementById("form_submit");

    /*// Add event listener for form submission
    form.addEventListener("submit", function(event) {*/
    // Function to handle form submission
    function handleSubmit(event) {
        event.preventDefault(); // Prevent default form submission behavior

        console.log("Form submission started");

        // Your validation logic here
        var service_type = document.enquiry_form.service_type.value;
        var channel_type = document.enquiry_form.channel_type.value;
        var name = document.enquiry_form.name.value;
        var email = document.enquiry_form.email.value;
        var mobile = document.enquiry_form.mobile.value;
        var time_call = document.enquiry_form.time_call.value;
        var country_of_residence = document.enquiry_form.country_of_residence.value;
        var destinations = document.enquiry_form.destinations.value;
        var date_arrival = document.enquiry_form.date_arrival.value;
        var city_of_residence = document.enquiry_form.city_of_residence.value;
        /*var duration = document.enquiry_form.duration.value;*/
        var accept_value = document.enquiry_form.accept_value.checked;
        var patt_name = /^[A-Za-z]{1,}[A-Za-z .]{2,}$/;
        var patt_mail = /^[A-Za-z0-9]{1}[A-Za-z0-9_.]{0,}\@[A-Za-z0-9]{1,}[A-Za-z0-9.-]{1,}\.[A-Za-z]{1,}[A-Za-z.]{1,}$/;

        /*// Validate service_type
        if (service_type == "0") {
            document.querySelector("#service_type_error").innerHTML = "Select service";
            document.enquiry_form.service_type.focus();
            return false;
        } else {
            document.querySelector("#service_type_error").innerHTML = "";
        }

        // Validate channel_type
        if (channel_type == "0") {
            document.querySelector("#channel_type_error").innerHTML = "Select channel";
            document.enquiry_form.channel_type.focus();
            return false;
        } else {
            document.querySelector("#channel_type_error").innerHTML = "";
        }*/

        // Validate name
        if (name.trim() === "") {
            document.querySelector("#name_error").innerHTML = "Enter full name";
            document.enquiry_form.name.focus();
            return false;
        } else if (!patt_name.test(name)) {
            document.querySelector("#name_error").innerHTML = "Enter valid name";
            document.enquiry_form.name.focus();
            return false;
        } else {
            document.querySelector("#name_error").innerHTML = "";
        }

        // Validate email
        if (email.trim() === "" || !patt_mail.test(email)) {
            document.querySelector("#email_error").innerHTML = "Enter valid email id";
            document.enquiry_form.email.focus();
            return false;
        } else {
            document.querySelector("#email_error").innerHTML = "";
        }

        // Validate mobile
        if (mobile.trim() === "" || isNaN(mobile)) {
            document.querySelector("#mobile_error").innerHTML = "Enter valid Contact Number";
            document.enquiry_form.mobile.focus();
            return false;
        } else {
            document.querySelector("#mobile_error").innerHTML = "";
        }

        // Validate time_call
        /*if (time_call == "0") {
            document.querySelector("#time_call_error").innerHTML = "Select best time to call";
            document.enquiry_form.time_call.focus();
            return false;
        } else {
            document.querySelector("#time_call_error").innerHTML = "";
        }*/

        // Validate time_call
        if (time_call.trim() === "") {
	        document.querySelector("#time_call_error").innerHTML = "Select best time to call";
	        document.getElementById("time_call_select").focus();
	        return false;
	    } else {
	        document.querySelector("#time_call_error").innerHTML = "";
	    }

        /*// Validate country_of_residence
        if (country_of_residence == "0") {
            document.querySelector("#country_of_residence_error").innerHTML = "Select country of residence";
            document.enquiry_form.country_of_residence.focus();
            return false;
        } else {
            document.querySelector("#country_of_residence_error").innerHTML = "";
        }*/

        // Validate destinations
        if (destinations.trim() === "" || !patt_name.test(destinations)) {
            document.querySelector("#destinations_error").innerHTML = "Enter Destination";
            document.enquiry_form.destinations.focus();
            return false;
        } else {
            document.querySelector("#destinations_error").innerHTML = "";
        }

        // Validate date_arrival
        if (date_arrival.trim() === "") {
            document.querySelector("#date_arrival_error").innerHTML = "Select Date of Travel";
            document.enquiry_form.date_arrival.focus();
            return false;
        } else {
            document.querySelector("#date_arrival_error").innerHTML = "";
        }

        // Validate city_of_residence (starting city)
        if (city_of_residence.trim() === "" || !patt_name.test(city_of_residence)) {
            document.querySelector("#city_of_residence_error").innerHTML = "Enter City of Residence";
            document.enquiry_form.city_of_residence.focus();
            return false;
        } else {
            document.querySelector("#city_of_residence_error").innerHTML = "";
        }

        // Validate duration
		// Since you're using a custom select element, we need to check the selected option
		var selectedDuration = document.querySelector("#displayDuration .selected").innerText.trim();
		if (selectedDuration === "Select Duration") {
		    document.querySelector("#duration_error").innerHTML = "Select service duration";
		    /*document.querySelector("#displayDuration .selected").style.borderColor = "red";*/
		    return false;
		} else {
		    document.querySelector("#duration_error").innerHTML = "";
		    /*document.querySelector("#displayDuration .selected").style.borderColor = ""; // Reset border color*/
		}

		/*// Validate hotel preference only if service type is "Tour Package" or "Accommodation"
        if (service_type === "Tour Package" || service_type === "Accommodation") {
            var hotelPreferenceValid = validateHotelPreference();
            var budgetValid = validateBudgetField();
	        if (!budgetValid) {
	            // Validation failed, do not submit the form
	            return;
	        }
        }*/

        // Validate budget for "Tour Package," "Accommodation," and "Cruise"
        /*if (service_type === "Tour Package" || service_type === "Accommodation" || service_type === "Cruise") {
            console.log("Validating budget for service type: ", service_type);
            var expectedBudget = document.getElementById("exp_budget").value;
            var expectedBudgetError = document.getElementById("budget_error");
            if (!expectedBudget) {
                console.log("Budget not selected");
                expectedBudgetError.innerHTML = "Please select your budget";
                document.getElementById("exp_budget").focus();
                return false;
            } else {
                expectedBudgetError.innerHTML = "";
            }
        }*/

        var budget = document.getElementById("exp_budget").value;
        var budgetError = document.getElementById("budget_error");

        // Validate budget for "Tour Package," "Accommodation," and "Cruise"
        if (service_type === "Tour Package" || service_type === "Accommodation" || service_type === "Cruise") {
            if (!budget || budget.trim() === "") {
                budgetError.innerHTML = "Please select your budget";
                document.getElementById("exp_budget").focus();
                return false;
            } else {
                budgetError.innerHTML = "";
            }
        }


        /*---------*/

		// Validate cruise fields only if service type is "Cruise"
		/*var service_type = document.getElementById("service_type").value;*/
        if (service_type === "Cruise") {
            var cruiseFieldsValid = validateCruiseFields();
            if (!cruiseFieldsValid) {
                // Validation failed, do not submit the form
                return;
            }
        }

	    // Function to handle validation for cruise-related fields
	    function validateCruiseFields() {
	        var cruiseline = document.getElementById("cruiseline").value;
	        var cruisecabin = document.getElementById("cruisecabin").value;

	        if (cruiseline === null || cruiseline === "") {
	            document.getElementById("cruiseline_error").innerHTML = "Select Cruise Lines";
	            document.getElementById("cruiseline").focus();
	            return false;
	        } else {
	            document.getElementById("cruiseline_error").innerHTML = "";
	        }

	        if (cruisecabin === null || cruisecabin === "") {
	            document.getElementById("cruisecabin_error").innerHTML = "Select Cabin Type";
	            document.getElementById("cruisecabin").focus();
	            return false;
	        } else {
	            document.getElementById("cruisecabin_error").innerHTML = "";
	        }

	        return true; // Validation passed
	    }

	    // Add event listeners to trigger validation on change for cruise-related fields
	    document.getElementById("cruiseline").addEventListener("change", validateCruiseFields);
	    document.getElementById("cruisecabin").addEventListener("change", validateCruiseFields);

	    /*---------*/

        // Validate visa fields only if service type is "Visa"
        if (service_type === "Visa") {
            var visaFieldsValid = validateVisaFields();
            if (!visaFieldsValid) {
                // Validation failed, do not submit the form
                return;
            }
        }

	    // Function to handle validation for visa-related fields
	    function validateVisaFields() {
	        var visatype = document.getElementById("visatype").value;
	        var visaentry = document.getElementById("visaentry").value;
	        var visaservice = document.getElementById("visaservice").value;

	        if (visatype === null || visatype === "") {
	            document.getElementById("visatype_error").innerHTML = "Select Visa Type";
	            document.getElementById("visatype").focus();
	            return false;
	        } else {
	            document.getElementById("visatype_error").innerHTML = "";
	        }

	        if (visaentry === null || visaentry === "") {
	            document.getElementById("visaentry_error").innerHTML = "Select Visa Entry";
	            document.getElementById("visaentry").focus();
	            return false;
	        } else {
	            document.getElementById("visaentry_error").innerHTML = "";
	        }

	        if (visaservice === null || visaservice === "") {
	            document.getElementById("visaservice_error").innerHTML = "Select Visa Service";
	            document.getElementById("visaservice").focus();
	            return false;
	        } else {
	            document.getElementById("visaservice_error").innerHTML = "";
	        }

	        return true; // Validation passed
	    }

	    // Add event listeners to trigger validation on change for visa-related fields
	    document.getElementById("visatype").addEventListener("change", validateVisaFields);
	    document.getElementById("visaentry").addEventListener("change", validateVisaFields);
	    document.getElementById("visaservice").addEventListener("change", validateVisaFields);

	    /*---------*/

        /*// Validate hotel preference only if service type is "Tour Package" or "Accommodation"
        if (service_type === "Tour Package" || service_type === "Accommodation") {
            var hotelPreferenceValid = validateHotelPreference();
            if (!hotelPreferenceValid) {
                // Validation failed, do not submit the form
                return;
            }
        }*/

        /*--------*/

        // Validate accept_value
        if (!accept_value) {
            document.querySelector("#accept_value_error").innerHTML = "Please accept Terms and Conditions!";
            document.enquiry_form.accept_value.focus();
            return false;
        } else {
            document.querySelector("#accept_value_error").innerHTML = "";
        }

        // Ensure the submit button is disabled and shows "Please wait..." text
        submitButton.disabled = true;
        submitButton.innerText = "Please wait...";

        // Once all validations pass, proceed with form submission
        var app_url_custom = $("#APP_URL").val();
        var form_data = new FormData($('#enquiry_form')[0]);
        $.ajax({
            url: app_url_custom + '/saveQuery',
            data: form_data,
            type: 'post',
            contentType: false,
            processData: false,

            success: function(data) {
                $("#overlay").fadeOut(300);
                if (data == 'success') {
                    swal("Thank you!", 'One of our travel experts will contact you shortly', "success");
                    // Reset the form
                    form.reset();
                    // Reset the custom select for Connect Time & Travellers
            		/*resetTravellers();*/
            		/*resetConnectTime();
            		resetDurationSelect();*/
            		resetFields();
            		handleHotelPreference();
            		/*handleFlightPreference();*/
            		flightPreferenceHandlers.reset();
        			additionalDetailsHandlers.reset();
                } else {
                    swal("Error", data, "error");
                }
                // Re-enable the submit button and change its text back to the original text
                submitButton.disabled = false;
                submitButton.innerText = "Get a Free Quote";
            },
            error: function(data) {
                // Re-enable the submit button and change its text back to the original text
                submitButton.disabled = false;
                submitButton.innerText = "Get a Free Quote";
            }
        });
    }

    // Add event listener for form submission
    form.addEventListener("submit", handleSubmit);

	/*--------*/

   /*// Function to handle validation for budget field
    function validateBudgetField() {
        var budget = document.getElementById("exp_budget").value;
        var budgetError = document.getElementById("budget_error");

        if (!budget) {
            budgetError.innerHTML = "Please select your budget";
            document.getElementById("exp_budget").focus();
            return false;
        } else {
            budgetError.innerHTML = "";
            return true;
        }
    }*/

    /*// Add event listeners to trigger validation on change for budget-related fields
    document.getElementById("exp_budget").addEventListener("input", validateBudgetField);

    // Budget slider functionality
    var budgetInput = document.getElementById("exp_budget");
    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
    var budgetSlider = document.getElementById("budgetSlider");

    // Function to round the budget value to the nearest 50
    function roundToNearest50(x) {
        return Math.round(x / 500) * 500;
    }

    // Function to add commas to the budget value for better readability
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Function to update slider track color dynamically based on thumb position
    function updateSliderTrackColor() {
        var percentage = (budgetSlider.value - budgetSlider.min) / (budgetSlider.max - budgetSlider.min);
        var color = 'linear-gradient(90deg, #08B2ED ' + percentage * 100 + '%, #d3d3d3 ' + percentage * 100 + '%)';
        budgetSlider.style.background = color;
    }

    // Hide the budget slider container initially
    budgetSliderContainer.style.display = "none";

    // Add click event listener to the budget input
    budgetInput.addEventListener("click", function(event) {
        budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });

    // Add input event listener to the budget slider
    budgetSlider.addEventListener("input", function() {
        // Round the slider value to the nearest 50
        var roundedValue = roundToNearest50(budgetSlider.value);
        // Update the slider value
        budgetSlider.value = roundedValue;
        // Update the input value with commas
        budgetInput.value = numberWithCommas(roundedValue);
        // Update slider track color
        updateSliderTrackColor();
    });

    // Add click event listener to the document body
    document.body.addEventListener("click", function() {
        budgetSliderContainer.style.display = "none";
    });

    // Prevent the budget slider container from closing when clicking inside of it
    budgetSliderContainer.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });

    // Update slider track color initially
    updateSliderTrackColor();*/

    

    /*// Function to check if at least one radio button is checked for hotel preference
    function validateHotelPreference() {
        var radioButtons = document.querySelectorAll('#displayhtlpref input[type="radio"]');
        var isChecked = false;
        radioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                isChecked = true;
            }
        });
        if (!isChecked) {
            document.getElementById("hotelpreference_error").innerHTML = "Select a hotel preference";
            radioButtons[0].focus(); // Focus on the first radio button for better user experience
            return false;
        } else {
            document.getElementById("hotelpreference_error").innerHTML = "";
            return true; // Validation passed
        }
    }*/
	
	/*--------*/

    /*// hotel preference selection
    // Select all radio buttons
    const radioButtons = document.querySelectorAll('.custom-selection input[type="radio"]');

    // Function to handle change event for radio buttons
    function handleRadioChange() {
        // Remove the selected-item class from all labels
        radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));

        // Add the selected-item class to the selected label
        if (this.checked) {
            this.parentElement.classList.add('selected-item');
        }
    }

    // Function to handle keypress event for radio buttons
    function handleRadioKeypress(event) {
        if (event.key === "Enter") {
            this.click(); // Simulate click when Enter key is pressed
        }
    }

    // Add event listeners for change and keypress events to each radio button
    radioButtons.forEach(radio => {
        radio.addEventListener('change', handleRadioChange);
        radio.addEventListener('keypress', handleRadioKeypress);
    });

    // Trigger change event for pre-checked radio button to apply styles on page load
    document.querySelector('.custom-selection input[type="radio"]:checked').dispatchEvent(new Event('change'));*/

    /*--------*/

	/*// add travellers
	// adult
	$(".span_inc_adult").click(function(){
		var span_value_adult=$(".span_value_adult").html();
		$(".span_value_adult").html("").html(parseInt(span_value_adult) + 1)
		$(".span_value_adult1").val("").val(parseInt(span_value_adult) + 1)
		//alert(span_value_adult)
		})
	$(".span_des_adult").click(function(){
		var span_value_adult=$(".span_value_adult").html();
		if(span_value_adult>=2) {
			$(".span_value_adult").html("").html(parseInt(span_value_adult) - 1)
			$(".span_value_adult1").val("").val(parseInt(span_value_adult) - 1)
			}
		})
	// child with bed
	$(".span_inc_child").click(function(){
		var span_value_child=$(".span_value_child").html();
		$(".span_value_child").html("").html(parseInt(span_value_child) + 1)
		$(".span_value_child1").val("").val(parseInt(span_value_child) + 1)
		//alert(span_value_child)
		})
	$(".span_des_child").click(function(){
		var span_value_child=$(".span_value_child").html();
		if(span_value_child>=1) {
			$(".span_value_child").html("").html(parseInt(span_value_child) - 1)
			$(".span_value_child1").val("").val(parseInt(span_value_child) - 1)
			}
		})
	// child without bed
	$(".span_inc_child_without_bed").click(function(){
		var span_value_child_without_bed=$(".span_value_child_without_bed").html();
		$(".span_value_child_without_bed").html("").html(parseInt(span_value_child_without_bed) + 1)
		$(".span_value_child2").val("").val(parseInt(span_value_child_without_bed) + 1)
		//alert(span_value_child_without_bed)
	})
	$(".span_des_child_without_bed").click(function(){
		var span_value_child_without_bed=$(".span_value_child_without_bed").html();
		if(span_value_child_without_bed>=1) {
			$(".span_value_child_without_bed").html("").html(parseInt(span_value_child_without_bed) - 1)
			$(".span_value_child2").val("").val(parseInt(span_value_child_without_bed) - 1)
		}
	})
	// infant
	$(".span_inc_infant").click(function(){
		var span_value_infant=$(".span_value_infant").html();
		$(".span_value_infant").html("").html(parseInt(span_value_infant) + 1)
		$(".span_value_infant1").val("").val(parseInt(span_value_infant) + 1)
		//alert(span_value_infant)
		})
	$(".span_des_infant").click(function(){
		var span_value_infant=$(".span_value_infant").html();
		if(span_value_infant>=1) {
			$(".span_value_infant").html("").html(parseInt(span_value_infant) - 1)
			$(".span_value_infant1").val("").val(parseInt(span_value_infant) - 1)
			}
		})*/

	// Add event listeners to input fields to clear error messages when they lose focus
    var inputFields = form.querySelectorAll("input");
    inputFields.forEach(function(input) {
        input.addEventListener("blur", function() {
            var errorId = input.id + "_error";
            /*document.getElementById(errorId).innerHTML = ""; // Clear error message*/
            var errorElement = document.getElementById(errorId);
	        if (errorElement) {
	            errorElement.innerHTML = ""; // Clear error message
	        }
        });
    });

    // Add event listener for Tab key press to allow field navigation
    form.addEventListener("keydown", function(event) {
        if (event.key === "Tab") {
            // Allow tab navigation
            return;
        }
    });

    /*--------*/

    //Country Code
    var APP_URL=$("#APP_URL").val();
    var url=APP_URL+'/country_code';
    var data={
    	_token:"{{ csrf_token() }}"
    	};
    $.post(url,data,function(rdata) {
        $("#country_code").html("").html(rdata);
    })
	
	/*--------*/

	//Nationality
	var APP_URL=$("#APP_URL").val();
	var url=APP_URL+'/country_query_s';
	var data={
		_token:"{{ csrf_token() }}"
		};
	$.post(url,data,function(rdata) {
		$("#country_of_residence").html("").html(rdata);
		})

	// Call setupCountryOfResidenceSelect after options are populated
    /*setupCountryOfResidenceSelect();*/

    /*--------*/

    /*additional details*/
    /*$(document).on("change",".additional_details",function() {
	$("#additionaldetails").val('')
	$(".additional_details").each(function() {
		if($(this).is(":checked")) {
			var txt = $(this).val();
			var additionaldetails = $("#additionaldetails");
			additionaldetails.val(additionaldetails.val() + txt + ', ');
			}
		});
	})*/

	/*acceptance*/
	$("#accept_value").click(function(){
		var accept_value1=$(this).val()
		if(accept_value1=="0") {
			$("#accept_value").val("").val(1)
			}
		else if(accept_value1=="1") {
			$("#accept_value").val("").val(0)
			}
		})
});
</script>



<!-- <script type="text/javascript">
/*budger slider - round of to 500 (working-separate functioality)*/
document.addEventListener("DOMContentLoaded", function() {
    var budgetInput = document.getElementById("exp_budget");
    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
    var budgetSlider = document.getElementById("budgetSlider");

    // Function to round the budget value to the nearest 50
    function roundToNearest50(x) {
                return Math.round(x / 500) * 500;
    }

    // Function to add commas to the budget value for better readability
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Function to update slider track color dynamically based on thumb position
    function updateSliderTrackColor() {
        var percentage = (budgetSlider.value - budgetSlider.min) / (budgetSlider.max - budgetSlider.min);
        var color = 'linear-gradient(90deg, #08B2ED ' + percentage * 100 + '%, #d3d3d3 ' + percentage * 100 + '%)';
        budgetSlider.style.background = color;
    }

    // Hide the budget slider container initially
    budgetSliderContainer.style.display = "none";

    // Add click event listener to the budget input
    budgetInput.addEventListener("click", function(event) {
    budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
    event.stopPropagation(); // Prevent the click event from propagating to the document body
    });

    // Add input event listener to the budget slider
    budgetSlider.addEventListener("input", function() {
    // Round the slider value to the nearest 50
    var roundedValue = roundToNearest50(budgetSlider.value);
    // Update the slider value
    budgetSlider.value = roundedValue;
    // Update the input value with commas
    budgetInput.value = numberWithCommas(roundedValue);
    // Update slider track color
    updateSliderTrackColor();
    });

    // Add click event listener to the document body
    document.body.addEventListener("click", function() {
	    budgetSliderContainer.style.display = "none";
        });

    // Prevent the budget slider container from closing when clicking inside of it
    budgetSliderContainer.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    	});

    // Update slider track color initially
    updateSliderTrackColor();
});
</script> -->

<script type="text/javascript">
/*add traveller*/
	/*$(document).ready(function() {
		// adult
		$(".span_inc_adult").click(function() {
			var span_value_adult=$(".span_value_adult").html();
			$(".span_value_adult").html("").html(parseInt(span_value_adult) + 1)
			$(".span_value_adult1").val("").val(parseInt(span_value_adult) + 1)
			//alert(span_value_adult)
		})
		$(".span_des_adult").click(function() {
			var span_value_adult=$(".span_value_adult").html();
			if(span_value_adult>=2) {
				$(".span_value_adult").html("").html(parseInt(span_value_adult) - 1)
				$(".span_value_adult1").val("").val(parseInt(span_value_adult) - 1)
				}
		})
		// child with bed
		$(".span_inc_child").click(function() {
			var span_value_child=$(".span_value_child").html();
			$(".span_value_child").html("").html(parseInt(span_value_child) + 1)
			$(".span_value_child1").val("").val(parseInt(span_value_child) + 1)
			//alert(span_value_child)
		})
		$(".span_des_child").click(function() {
			var span_value_child=$(".span_value_child").html();
			if(span_value_child>=1) {
				$(".span_value_child").html("").html(parseInt(span_value_child) - 1)
				$(".span_value_child1").val("").val(parseInt(span_value_child) - 1)
				}
		})
		// child without bed
		$(".span_inc_child_without_bed").click(function() {
			var span_value_child_without_bed=$(".span_value_child_without_bed").html();
			$(".span_value_child_without_bed").html("").html(parseInt(span_value_child_without_bed) + 1)
			$(".span_value_child2").val("").val(parseInt(span_value_child_without_bed) + 1)
			//alert(span_value_child_without_bed)
		})
		$(".span_des_child_without_bed").click(function() {
			var span_value_child_without_bed=$(".span_value_child_without_bed").html();
			if(span_value_child_without_bed>=1) {
				$(".span_value_child_without_bed").html("").html(parseInt(span_value_child_without_bed) - 1)
				$(".span_value_child2").val("").val(parseInt(span_value_child_without_bed) - 1)
			}
		})
		// infant
		$(".span_inc_infant").click(function(){
			var span_value_infant=$(".span_value_infant").html();
			$(".span_value_infant").html("").html(parseInt(span_value_infant) + 1)
			$(".span_value_infant1").val("").val(parseInt(span_value_infant) + 1)
			//alert(span_value_infant)
			})
		$(".span_des_infant").click(function(){
			var span_value_infant=$(".span_value_infant").html();
			if(span_value_infant>=1) {
				$(".span_value_infant").html("").html(parseInt(span_value_infant) - 1)
				$(".span_value_infant1").val("").val(parseInt(span_value_infant) - 1)
				}
			})
	})*/
	/*// Add travellers
	$(document).ready(function() {
	    // Adult
	    $(".span_inc_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        $(".span_value_adult").html(parseInt(span_value_adult) + 1);
	        $(".span_value_adult1").val(parseInt(span_value_adult) + 1);
	    });
	    $(".span_des_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        if (span_value_adult >= 2) {
	            $(".span_value_adult").html(parseInt(span_value_adult) - 1);
	            $(".span_value_adult1").val(parseInt(span_value_adult) - 1);
	        }
	    });

	    // Child with bed
	    $(".span_inc_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        $(".span_value_child").html(parseInt(span_value_child) + 1);
	        $(".span_value_child1").val(parseInt(span_value_child) + 1);
	    });
	    $(".span_des_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        if (span_value_child >= 1) {
	            $(".span_value_child").html(parseInt(span_value_child) - 1);
	            $(".span_value_child1").val(parseInt(span_value_child) - 1);
	        }
	    });

	    // Child without bed
	    $(".span_inc_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) + 1);
	        $(".span_value_child2").val(parseInt(span_value_child_without_bed) + 1);
	    });
	    $(".span_des_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        if (span_value_child_without_bed >= 1) {
	            $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) - 1);
	            $(".span_value_child2").val(parseInt(span_value_child_without_bed) - 1);
	        }
	    });

	    // Infant
	    $(".span_inc_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        $(".span_value_infant").html(parseInt(span_value_infant) + 1);
	        $(".span_value_infant1").val(parseInt(span_value_infant) + 1);
	    });
	    $(".span_des_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        if (span_value_infant >= 1) {
	            $(".span_value_infant").html(parseInt(span_value_infant) - 1);
	            $(".span_value_infant1").val(parseInt(span_value_infant) - 1);
	        }
	    });
	});*/


	/*$(document).ready(function() {
	    // Adult
	    $(".span_inc_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        console.log("Adult value before increment: " + span_value_adult);
	        $(".span_value_adult").html(parseInt(span_value_adult) + 1);
	        $(".span_value_adult1").val(parseInt(span_value_adult) + 1);
	        console.log("Adult value after increment: " + $(".span_value_adult").html());
	    });
	    $(".span_des_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        console.log("Adult value before decrement: " + span_value_adult);
	        if (span_value_adult >= 2) {
	            $(".span_value_adult").html(parseInt(span_value_adult) - 1);
	            $(".span_value_adult1").val(parseInt(span_value_adult) - 1);
	        }
	        console.log("Adult value after decrement: " + $(".span_value_adult").html());
	    });

	    // Child with bed
	    $(".span_inc_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        console.log("Child with bed value before increment: " + span_value_child);
	        $(".span_value_child").html(parseInt(span_value_child) + 1);
	        $(".span_value_child1").val(parseInt(span_value_child) + 1);
	        console.log("Child with bed value after increment: " + $(".span_value_child").html());
	    });
	    $(".span_des_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        console.log("Child with bed value before decrement: " + span_value_child);
	        if (span_value_child >= 1) {
	            $(".span_value_child").html(parseInt(span_value_child) - 1);
	            $(".span_value_child1").val(parseInt(span_value_child) - 1);
	        }
	        console.log("Child with bed value after decrement: " + $(".span_value_child").html());
	    });

	    // Child without bed
	    $(".span_inc_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        console.log("Child without bed value before increment: " + span_value_child_without_bed);
	        $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) + 1);
	        $(".span_value_child2").val(parseInt(span_value_child_without_bed) + 1);
	        console.log("Child without bed value after increment: " + $(".span_value_child_without_bed").html());
	    });
	    $(".span_des_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        console.log("Child without bed value before decrement: " + span_value_child_without_bed);
	        if (span_value_child_without_bed >= 1) {
	            $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) - 1);
	            $(".span_value_child2").val(parseInt(span_value_child_without_bed) - 1);
	        }
	        console.log("Child without bed value after decrement: " + $(".span_value_child_without_bed").html());
	    });

	    // Infant
	    $(".span_inc_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        console.log("Infant value before increment: " + span_value_infant);
	        $(".span_value_infant").html(parseInt(span_value_infant) + 1);
	        $(".span_value_infant1").val(parseInt(span_value_infant) + 1);
	        console.log("Infant value after increment: " + $(".span_value_infant").html());
	    });
	    $(".span_des_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        console.log("Infant value before decrement: " + span_value_infant);
	        if (span_value_infant >= 1) {
	            $(".span_value_infant").html(parseInt(span_value_infant) - 1);
	            $(".span_value_infant1").val(parseInt(span_value_infant) - 1);
	        }
	        console.log("Infant value after decrement: " + $(".span_value_infant").html());
	    });
	});*/

	/*$(document).ready(function() {
	    // Remove existing event listeners
	    $(".span_inc_adult, .span_des_adult, .span_inc_child, .span_des_child, .span_inc_child_without_bed, .span_des_child_without_bed, .span_inc_infant, .span_des_infant").off();

	    // Adult
	    $(".span_inc_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        console.log("Adult value before increment: " + span_value_adult);
	        $(".span_value_adult").html(parseInt(span_value_adult) + 1);
	        $(".span_value_adult1").val(parseInt(span_value_adult) + 1);
	        console.log("Adult value after increment: " + $(".span_value_adult").html());
	    });
	    $(".span_des_adult").click(function() {
	        var span_value_adult = $(".span_value_adult").html();
	        console.log("Adult value before decrement: " + span_value_adult);
	        if (span_value_adult >= 2) {
	            $(".span_value_adult").html(parseInt(span_value_adult) - 1);
	            $(".span_value_adult1").val(parseInt(span_value_adult) - 1);
	        }
	        console.log("Adult value after decrement: " + $(".span_value_adult").html());
	    });

	    // Child with bed
	    $(".span_inc_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        console.log("Child with bed value before increment: " + span_value_child);
	        $(".span_value_child").html(parseInt(span_value_child) + 1);
	        $(".span_value_child1").val(parseInt(span_value_child) + 1);
	        console.log("Child with bed value after increment: " + $(".span_value_child").html());
	    });
	    $(".span_des_child").click(function() {
	        var span_value_child = $(".span_value_child").html();
	        console.log("Child with bed value before decrement: " + span_value_child);
	        if (span_value_child >= 1) {
	            $(".span_value_child").html(parseInt(span_value_child) - 1);
	            $(".span_value_child1").val(parseInt(span_value_child) - 1);
	        }
	        console.log("Child with bed value after decrement: " + $(".span_value_child").html());
	    });

	    // Child without bed
	    $(".span_inc_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        console.log("Child without bed value before increment: " + span_value_child_without_bed);
	        $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) + 1);
	        $(".span_value_child2").val(parseInt(span_value_child_without_bed) + 1);
	        console.log("Child without bed value after increment: " + $(".span_value_child_without_bed").html());
	    });
	    $(".span_des_child_without_bed").click(function() {
	        var span_value_child_without_bed = $(".span_value_child_without_bed").html();
	        console.log("Child without bed value before decrement: " + span_value_child_without_bed);
	        if (span_value_child_without_bed >= 1) {
	            $(".span_value_child_without_bed").html(parseInt(span_value_child_without_bed) - 1);
	            $(".span_value_child2").val(parseInt(span_value_child_without_bed) - 1);
	        }
	        console.log("Child without bed value after decrement: " + $(".span_value_child_without_bed").html());
	    });

	    // Infant
	    $(".span_inc_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        console.log("Infant value before increment: " + span_value_infant);
	        $(".span_value_infant").html(parseInt(span_value_infant) + 1);
	        $(".span_value_infant1").val(parseInt(span_value_infant) + 1);
	        console.log("Infant value after increment: " + $(".span_value_infant").html());
	    });
	    $(".span_des_infant").click(function() {
	        var span_value_infant = $(".span_value_infant").html();
	        console.log("Infant value before decrement: " + span_value_infant);
	        if (span_value_infant >= 1) {
	            $(".span_value_infant").html(parseInt(span_value_infant) - 1);
	            $(".span_value_infant1").val(parseInt(span_value_infant) - 1);
	        }
	        console.log("Infant value after decrement: " + $(".span_value_infant").html());
	    });
	});*/


	//Country Code
    /*var APP_URL=$("#APP_URL").val();
    var url=APP_URL+'/country_code';
    var data={
    	_token:"{{ csrf_token() }}"
    	};
    $.post(url,data,function(rdata) {
        $("#country_code").html("").html(rdata);
    })*/
	
	/*--------*/

	/*//Nationality
	var APP_URL=$("#APP_URL").val();
	var url=APP_URL+'/country_query_s';
	var data={
		_token:"{{ csrf_token() }}"
		};
	$.post(url,data,function(rdata) {
		$("#country_of_residence").html("").html(rdata);
		})*/


    /*--------*/

    /*additional details*/
    /*$(document).on("change",".additional_details",function() {
	$("#additionaletails").val('')
	$(".additional_details").each(function() {
		if($(this).is(":checked")) {
			var txt = $(this).val();
			var additionaletails = $("#additionaletails");
			additionaletails.val(additionaletails.val() + txt + ', ');
			}
		});
	})*/
</script>
@endsection