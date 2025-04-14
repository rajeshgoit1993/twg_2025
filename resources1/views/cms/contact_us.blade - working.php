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
    text-transform: capitalize;
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
.hotelPref {
    display: flex;
    align-items: center;
    column-gap: 15px;
	}
.hotelPref label {
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
.hotelPref input[type=radio] {
	height: 13px;
    width: 11px;
    margin-right: 5px;
    margin-top: 0;
	}
.hotelPref label:last-child {
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
	}
.icon-input-group {
	/* position: relative; */
	display: table;
	border-collapse: separate;
	height: auto;
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
	top: 11px;
	left: 12px;
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
    text-transform: capitalize;
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
	z-index: 1;
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
.custom-select .option:hover {
	background-color: #f0f0f0;
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
				<h2>Send enquiry</h2>
				<h3>Enter your details and get a best quote suiting all your requirements</h3>
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
							<div class="select-arrow down">
								<select id="service_type" name="service_type" onchange="showHideService()" required>
									<option value="Tour Package" selected>Tour Package</option>
									<option value="Accommodation">Hotels, Resorts & Villa</option>
									<option value="Visa">Visa</option>
									<option value="Cruise">Cruise</option>
									<option value="Travel_Insurance">Travel Insurance</option>
								</select>
							</div>
							<span class="inputError" id="service_type_error"></span>
						</div>
					</div>
					<!-- channel type -->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="channel_type">Channel</label>
							<div class="select-arrow down">
								<select id="channel_type" name="channel_type">
									<!-- <option value="0" disabled>Select Channel</option> -->
									<option value="B2C" selected>B2C</option>
									<option value="B2B">B2B</option>
									<option value="Corporate">Corporate</option>
								</select>
							</div>
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
							<input type="text" id="email" name="email" placeholder="Enter Your Email Id" tabindex="0"/>
							<span class="inputError" id="email_error"></span>
						</div>
					</div>
					<!--Mobile-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="mobile">Mobile No</label>
							<div class="makeflex">
								<div class="select-arrow down" style="width: 40%;margin-right: 5px;">
									<select id="country_code" name="country_code"></select>
				                </div>
								<!-- <select style="width: 40%;margin-right: 5px;" id="country_code" name="country_code"></select> -->
								<input type="text" name="mobile" id="mobile" placeholder="Enter Your Mobile No" />
							</div>
							<span class="inputError" id="mobile_error"></span>
						</div>
					</div>
					<!--Connect Time-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="time_call">Connect Time</label>
							<div class="select-arrow down">			                
							<select id="time_call" name="time_call">
								<option value="0" selected disabled>Select Time To Call</option>
								<option value="09 - 11 AM">Between 09 - 11 AM</option>
								<option value="11 - 01 PM">Between 11 - 01 PM</option>
								<option value="01 - 03 PM">Between 01 - 03 PM</option>
								<option value="03 - 05 PM">Between 03 - 05 PM</option>
								<option value="05 - 07 PM">Between 05 - 07 PM</option>
								<option value="07 - 09 PM">Between 07 - 09 PM</option>
							</select>
							</div>
							<span class="inputError" id="time_call_error"></span>
						</div>
					</div>
					<!--Nationality-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="country_of_residence">Nationality</label>
							<!-- <select id="country_of_residence" name="country_of_residence">
								<option value="0" selected disabled>Select Nationality</option>
								<option value="India">India</option>
								<option value="Nepal">Nepal</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Foreigner">Foreigner</option>
							</select> -->
							<div class="select-arrow down">
								<select class="formSelect" id="country_of_residence" name="country_of_residence"></select>
							</div>
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
									<option value="{{ $i+1 }} Days">{{ $i }} Night / {{ $i+1 }} Days</option>
									@else
									<option value="{{ $i+1 }} Days">{{ $i }} Nights / {{ $i+1 }} Days</option>
									@endif
								@endfor;
							</select>
							<span class="inputError" id="duration_error"></span>
						</div>
					</div> -->
					<div class="flex-col-md-6 appendBottom20" id="displayDuration">
						<div class="guestInputCont" style="margin: 0;">
							<label for="duration">Duration</label>
							<input type="hidden" id="duration" name="duration">
							<div class="select-arrow down custom-select" required tabindex="0">
								<div class="selected">Select Duration</div>
								<div class="options">
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
					            <input type="range" min="3000" max="100000" value="3000" class="budgetSlider" id="budgetSlider">
					            <div class="rangeSection">
                					<span class="min-price-label defaulCurrency_slider"> 3,000</span>
                					<span class="max-price-label defaulCurrency_slider"> 100,000</span>
					            </div>
					        </div>
					    </div>
					</div>
					<!--Cruise Lines-->
					<div class="flex-col-md-6 d-none" id="displayCruiseLine">
						<div class="guestInputCont">
							<label for="cruiseline">Cruise Lines</label>
							<div class="select-arrow down">
								<select id="cruiseline" name="cruiseline">
									<option value="" selected disabled>Select Cruise Lines</option>
									<option value="Any">Any</option>
									<option value="Cordeila">Cordeila Cruises</option>
									<option value="Resort World">Resort World Cruises</option>
									<option value="Royal Caribbean">Royal Caribbean Cruises</option>
									<option value="Celebrity">Celebrity Cruises</option>
									<option value="Azamara Club">Azamara Club Cruises</option>
									<option value="Norwegian">Norwegian Cruise Line</option>
								</select>
							</div>
							<span class="inputError" id="cruiseline_error"></span>
						</div>
					</div>
					<!--Cruise Cabin Type-->
					<div class="flex-col-md-6 d-none" id="displayCruiseCabin">
						<div class="guestInputCont">
							<label for="cruisecabin">Cruise Cabin</label>
							<div class="select-arrow down">
								<select id="cruisecabin" name="cruisecabin">
									<option value="" selected disabled>Select Cabin Type</option>
									<option value="Any">Any</option>
									<option value="Interior">Interior</option>
									<option value="Oceanview">Oceanview</option>
									<option value="Balcony">Balcony</option>
									<option value="Suite">Suite</option>
								</select>
							</div>
							<span class="inputError" id="cruisecabin_error"></span>
						</div>
					</div>
					<!--Visa Type-->
					<div class="flex-col-md-6 d-none" id="displayVisaType">
						<div class="guestInputCont">
							<label for="visatype">Visa Type</label>
							<div class="select-arrow down">
								<select id="visatype" name="visatype">
									<option value="" selected disabled>Select Visa</option>
									<option value="Tourist">Tourist</option>
									<option value="Business">Business</option>
									<option value="Student" disabled>Student</option>
									<option value="Transit">Transit</option>
								</select>
							</div>
							<span class="inputError" id="visatype_error"></span>
						</div>
					</div>
					<!--Visa Validity (duration is working) -->
					<!-- <div class="flex-col-md-6 d-none" id="displayVisaValidity">
						<div class="guestInputCont">
							<label for="visavalidity">Visa Validity</label>
							<div class="select-arrow down">
								<select id="visavalidity" name="visavalidity">
									<option value="" selected disabled>Select Duration</option>
									<option value="15 Days">15 Days</option>
									<option value="30 Days">30 Days</option>
									<option value="3 Months">3 Months</option>
									<option value="6 Months">6 Months</option>
								</select>
							</div>
							<span class="inputError" id="visavalidity_error"></span>
						</div>
					</div> -->
					<!--Visa Entry-->
					<div class="flex-col-md-6 d-none" id="displayVisaEntry">
						<div class="guestInputCont">
							<label for="visaentry">Visa Entry</label>
							<div class="select-arrow down">
								<select id="visaentry" name="visaentry">
									<option value="" selected disabled>Select Entry Type</option>
									<option value="Single Entry">Single Entry</option>
									<option value="Multiple Entry">Multiple Entry</option>
								</select>
							</div>
							<span class="inputError" id="visaentry_error"></span>
						</div>
					</div>
					<!--Visa Express Service-->
					<div class="flex-col-md-6 d-none" id="displayVisaService">
						<div class="guestInputCont">
							<label for="visaservice">Visa Service</label>
							<div class="select-arrow down">
								<select id="visaservice" name="visaservice">
									<option value="" selected disabled>Select Service</option>
									<option value="Normal">Normal Service</option>
									<option value="Express">Express Service</option>
								</select>
							</div>
							<span class="inputError" id="visaservice_error"></span>
						</div>
					</div>
					<!--hotel preference-->
					<div class="flex-col-md-6 d-none" id="displayhtlpref">
						<div class="guestInputCont">
							<label for="hotelpreference">Hotel Preference</label>
							<div class="hotelPref">
								<label class="custom-selection" tabindex="0">
									<input type="radio" value="3" name="hotel_pre" tabindex="0">3 Star
								</label>
								<label class="custom-selection" tabindex="0">
									<input type="radio" value="4" name="hotel_pre" tabindex="0" checked="checked">4 Star
								</label>
								<label class="custom-selection" tabindex="0">
									<input type="radio" value="5" name="hotel_pre" tabindex="0">5 Star
								</label>
							</div>
							<span class="inputError" id="hotelpreference_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6"></div>
					<!--No of Traveller-->
					<div class="flex-col-md-12">
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
					</div>
					<!--additional Requests-->
					<div class="flex-col-md-12">
						<div class="guestInputCont appendTop5 appendBtm20">
							<label for="additionaletails">Additional Request&nbsp;<span class="colorA1 d-none">(subject to availability)</span></label>
							<div class="addOnDtlsCont mobscroll scrollX">
								<!-- <label for="flightbooked" id="displayflightbooked" style="display: none">
									<input type="checkbox" id="flightbooked" name="flightbooked" class="additional_details" value="Flight Ticket Booked">Flights Booked
								</label> -->
								<label class="checkmarkCont" id="displayflightbooked" style="display: none">
									<input type="checkbox" id="flightbooked" name="flightbooked" class="additional_details" value="Flight Ticket Booked">
									<span class="checkmark addOn-services"></span>
									<span class="addOn-services-text">Flights Booked</span>
								</label>

								<!-- <label for="childbed" id="displaychildbed" style="display: none">
									<input type="checkbox" class="additional_details" id="childbed" name="childbed" value="1 Extra Bed Required for Child">Child Extra Bed
								</label> -->
								<label class="checkmarkCont" id="displaychildbed" style="display: none">
									<input type="checkbox" class="additional_details" id="childbed" name="childbed" value="1 Extra Bed Required for Child">
									<span class="checkmark addOn-services"></span>
									<span class="addOn-services-text">Child Extra Bed</span>
								</label>

								<!-- <label for="leisure" id="displayleisure" style="display: none">
									<input type="checkbox" class="additional_details" id="leisure" name="leisure" value="Family Trip">Family Trip
								</label> -->
								<label class="checkmarkCont" id="displayleisure" style="display: none">
									<input type="checkbox" class="additional_details" id="leisure" name="leisure" value="Family Trip">
									<span class="checkmark addOn-services"></span>
									<span class="addOn-services-text">Family Trip</span>
								</label>

								<!-- <label for="honeymoon" id="displayhoneymoon" style="display: none">
									<input type="checkbox" class="additional_details" id="honeymoon" name="honeymoon" value="Honeymoon Trip">Honeymoon
								</label> -->
								<label class="checkmarkCont" id="displayhoneymoon" style="display: none">
									<input type="checkbox" class="additional_details" id="honeymoon" name="honeymoon" value="Honeymoon Trip">
									<span class="checkmark addOn-services"></span>
									<span class="addOn-services-text">Honeymoon</span>
								</label>
							</div>
							<textarea class="formTextarea" type="text" id="additionaletails" name="additionaletails" placeholder="Enter additional requests (if any)"></textarea>
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
<script>
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

/*------------*/


/*// JavaScript
document.querySelector('.custom-select').addEventListener('click', function() {
  this.querySelector('.options').style.display = 'block';
});

document.querySelectorAll('.option').forEach(function(el) {
  el.addEventListener('click', function() {
    var text = this.innerText;
    var select = this.closest('.custom-select');
    select.querySelector('.selected').innerText = text;
    select.querySelector('.options').style.display = 'none';
  });
});

// Add options dynamically
var options = [];
for (var i = 1; i <= 20; i++) {
  options.push(i == 1 ? i + " Night / " + (i + 1) + " Days" : i + " Nights / " + (i + 1) + " Days");
}

var optionsContainer = document.querySelector('.options');
for (var i = 0; i < options.length; i++) {
  var option = document.createElement("div");
  option.classList.add("option");
  option.innerText = options[i];
  optionsContainer.appendChild(option);
}*/

/*------------*/

function showHideService() {
    //Enquiry Form Visa part
	{
	var service_type = document.getElementById("service_type");
	
	// tour package
	/*var displayDuration = document.getElementById("displayDuration");*/
	var displayBudget = document.getElementById("displayBudget");
	var displayhtlpref = document.getElementById("displayhtlpref");
	var displaychildbed = document.getElementById("displaychildbed");
	var displayleisure = document.getElementById("displayleisure");
	var displayhoneymoon = document.getElementById("displayhoneymoon");
	var displayflightbooked = document.getElementById("displayflightbooked");
	
	displaychildbed.style.display = service_type.value == "Tour Package" ? "block" : "none";
	displayflightbooked.style.display = service_type.value == "Tour Package" ? "block" : "none";
	displayleisure.style.display = service_type.value == "Tour Package" ? "block" : "none";
	displayhoneymoon.style.display = service_type.value == "Tour Package" ? "block" : "none";

	// hotel, resorts & villas
	displayhtlpref.style.display = (service_type.value == "Tour Package" || service_type.value == "Accommodation") ? "block" : "none";	

	// visa
	var displayVisaType = document.getElementById("displayVisaType");
	/*var displayVisaValidity = document.getElementById("displayVisaValidity");*/
	var displayVisaEntry = document.getElementById("displayVisaEntry");
	var displayVisaService = document.getElementById("displayVisaService");
	displayVisaType.style.display = service_type.value == "Visa" ? "block" : "none";
	/*displayVisaValidity.style.display = service_type.value == "Visa" ? "block" : "none";*/
	displayVisaEntry.style.display = service_type.value == "Visa" ? "block" : "none";
	displayVisaService.style.display = service_type.value == "Visa" ? "block" : "none";
	
	// cruise
	var displayCruiseLine = document.getElementById("displayCruiseLine");
	var displayCruiseCabin = document.getElementById("displayCruiseCabin");
	displayCruiseLine.style.display = service_type.value == "Cruise" ? "block" : "none";
	displayCruiseCabin.style.display = service_type.value == "Cruise" ? "block" : "none";

	//travel insurance

	function toggleDisplay() {
	    displayhtlpref.style.display = (service_type.value == "Tour Package" || service_type.value == "Accommodation") ? "block" : "none";
	    displayBudget.style.display = (service_type.value == "Tour Package" || service_type.value == "Accommodation" || service_type.value == "Cruise") ? "block" : "none";
	}

	// Initial call to toggle display based on default value of service_type dropdown
	toggleDisplay();

	// Event listener to toggle display when service_type dropdown value changes
	service_type.addEventListener("change", toggleDisplay);

    }

    /*--------*/

	// Function to handle changes based on service type (Travel_Insurance)
	function visaTravellerAgeChange() {
	    var service_type = document.getElementById("service_type").value;

	    // Reset to default values for other service types
	    if (service_type !== "Travel_Insurance") {
	        // Reset text for guest types to their original values
	        document.getElementById("adult").innerHTML = "Adult<br>(+12yrs)";
	        document.getElementById("childwithbed").innerHTML = "Child with bed<br>(2-12yrs)";
	        document.getElementById("childwithoutbed").innerHTML = "Child without bed<br>(2-12yrs)";
	        document.getElementById("infant").innerHTML = "Infant<br>(0-2yrs)";
	    }

	    // If service type is "Visa", modify the guest types accordingly
	    if (service_type === "Travel_Insurance") {
	        // Update text for guest types
	        document.getElementById("adult").innerHTML = "Adult<br>(0-40yrs)";
	        document.getElementById("childwithbed").innerHTML = "Adult<br>(41-60yrs)";
	        document.getElementById("childwithoutbed").innerHTML = "Adult<br>(61-70yrs)";
	        document.getElementById("infant").innerHTML = "Adult<br>(+71yrs)";
	    }
	}

	// Add event listener to the service type dropdown to call the function when its value changes
	document.getElementById("service_type").addEventListener("change", visaTravellerAgeChange);

	// Call the function initially to set up the initial state based on the default service type
	visaTravellerAgeChange();

	/*--------*/

    // Get the duration element
    var duration = document.querySelector("#displayDuration .options");

    // Clear all existing options
    while (duration.firstChild) {
        duration.removeChild(duration.firstChild);
    }

    // Define the options based on the selected service type
    var options;
    if (service_type.value == "Visa") {
        options = [
            {value: "15 days", text: "15 days"},
            {value: "30 days", text: "30 days"},
            {value: "60 days", text: "1 month"},
            {value: "90 days", text: "2 months"},
            {value: "180 days", text: "6 months"},
            {value: "365 days", text: "1 year"},
            {value: "730 days", text: "2 years"},
            {value: "1825 days", text: "5 years"}
        ];
    } else if (service_type.value == "Travel_Insurance") {
        options = [];
        for (var i = 3; i <= 20; i++) {
            options.push({value: i + " days", text: i + " Days"});
        }
    } else {
        options = [];
        for (var i = 1; i <= 20; i++) {
            options.push({value: (i + 1) + " days", text: i == 1 ? i + " Night / " + (i + 1) + " Days" : i + " Nights / " + (i + 1) + " Days"});
        }
    }

    // Add the new options to the duration dropdown
    for (var i = 0; i < options.length; i++) {
        var option = document.createElement("div");
        option.classList.add("option");
        option.dataset.value = options[i].value;
        option.innerText = options[i].text;
        duration.appendChild(option);
    }

    // Add click event listeners to the options
    document.querySelectorAll('.option').forEach(function(el) {
        el.addEventListener('click', function() {
            var text = this.innerText;
            var value = this.dataset.value;
            var select = this.closest('.custom-select');
            select.querySelector('.selected').innerText = text;
            // Update the value of the hidden input field
            document.getElementById('duration').value = value;
            // Close the dropdown
            select.querySelector('.options').style.display = 'none';
        });
    });
}


// Use DOMContentLoaded event to ensure the HTML is fully loaded before running your JS code
document.addEventListener("DOMContentLoaded", function() {
    // Get the service_type element
    var service_type = document.getElementById("service_type");

    // Add an event listener for the change event
    service_type.addEventListener("change", showHideService);

    // Call showHideService once to display the correct elements based on the default selected service
    showHideService();
});

// Add click event listener to the document to close the dropdown when clicking outside of it
document.addEventListener('click', function(event) {
    var select = document.querySelector('.custom-select');
    if (!select.contains(event.target)) {
        select.querySelector('.options').style.display = 'none';
    }
});

// Add click event listener to the selected element to open the dropdown
document.querySelector("#displayDuration .selected").addEventListener('click', function() {
    this.nextElementSibling.style.display = 'block';
});
</script>

<!-- <script type="text/javascript">
//working code
// Define showHideService in the global scope
function showHideService() {
    //Enquiry Form Visa part
	{
	var service_type = document.getElementById("service_type");
	
	//Tour Package & Hotels
	/*var displayDuration = document.getElementById("displayDuration");
	var displayBudget = document.getElementById("displayBudget");*/
	var displayhtlpref = document.getElementById("displayhtlpref");
	var displaychildbed = document.getElementById("displaychildbed");
	var displayleisure = document.getElementById("displayleisure");
	var displayhoneymoon = document.getElementById("displayhoneymoon");
	var displayflightbooked = document.getElementById("displayflightbooked");
	
	/*displayDuration.style.display = service_type.value == "Tour Package" ? "block" : "none";
	displayBudget.style.display = service_type.value == "Tour Package" ? "block" : "none";*/
	displayhtlpref.style.display = service_type.value == "Tour Package" ? "block" : "none";
	displaychildbed.style.display = service_type.value == "Tour Package" ? "block" : "none";
	displayflightbooked.style.display = service_type.value == "Tour Package" ? "block" : "none";
	displayleisure.style.display = service_type.value == "Tour Package" ? "block" : "none";
	displayhoneymoon.style.display = service_type.value == "Tour Package" ? "block" : "none";
	//Hotel
	
	//Visa
	var displayVisaType = document.getElementById("displayVisaType");
	var displayVisaValidity = document.getElementById("displayVisaValidity");
	var displayVisaEntry = document.getElementById("displayVisaEntry");
	var displayVisaService = document.getElementById("displayVisaService");
	displayVisaType.style.display = service_type.value == "Visa" ? "block" : "none";
	displayVisaValidity.style.display = service_type.value == "Visa" ? "block" : "none";
	displayVisaEntry.style.display = service_type.value == "Visa" ? "block" : "none";
	displayVisaService.style.display = service_type.value == "Visa" ? "block" : "none";
	
	//Cruise
	var displayCruiseLine = document.getElementById("displayCruiseLine");
	var displayCruiseCabin = document.getElementById("displayCruiseCabin");
	displayCruiseLine.style.display = service_type.value == "Cruise" ? "block" : "none";
	displayCruiseCabin.style.display = service_type.value == "Cruise" ? "block" : "none";
    }

    // Get the duration element
    var duration = document.getElementById("duration");

    // Clear all existing options
    while (duration.firstChild) {
        duration.removeChild(duration.firstChild);
    }

    // Define the options based on the selected service type
    var options;
    if (service_type.value == "Visa") {
        options = [
            {value: "15 days", text: "15 days"},
            {value: "30 days", text: "30 days"},
            {value: "60 days", text: "1 month"},
            {value: "90 days", text: "2 months"},
            {value: "180 days", text: "6 months"},
            {value: "365 days", text: "1 year"},
            {value: "730 days", text: "2 years"},
            {value: "1825 days", text: "5 years"}
        ];
    } else if (service_type.value == "Travel_Insurance") {
        options = [];
        for (var i = 3; i <= 180; i++) {
            options.push({value: i + " days", text: i + " Days"});
        }
    } else {
        options = [];
        for (var i = 1; i <= 20; i++) {
            options.push({value: (i + 1) + " days", text: i == 1 ? i + " Night / " + (i + 1) + " Days" : i + " Nights / " + (i + 1) + " Days"});
        }
    }

    // Add the new options to the duration dropdown
    for (var i = 0; i < options.length; i++) {
        var option = document.createElement("option");
        option.value = options[i].value;
        option.text = options[i].text;
        duration.appendChild(option);
    }

}

// Use DOMContentLoaded event to ensure the HTML is fully loaded before running your JS code
document.addEventListener("DOMContentLoaded", function() {
    // Get the service_type element
    var service_type = document.getElementById("service_type");

    // Add an event listener for the change event
    service_type.addEventListener("change", showHideService);

    // Call showHideService once to display the correct elements based on the default selected service
    showHideService();
});
</script> -->

<script type="text/javascript">
/*add traveller*/
/*$(document).ready(function() {
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
		})
})*/

/*acceptance*/
/*$("#accept_value").click(function(){
	var accept_value1=$(this).val()
	if(accept_value1=="0") {
		$("#accept_value").val("").val(1)
		}
	else if(accept_value1=="1") {
		$("#accept_value").val("").val(0)
		}
	})*/

//working code form submission
/*document.addEventListener("DOMContentLoaded", function() {
document.enquiry_form.onsubmit=function() {
	var service_type=document.enquiry_form.service_type.value;
	var channel_type=document.enquiry_form.channel_type.value;
	var name=document.enquiry_form.name.value;
	var email=document.enquiry_form.email.value;
	var mobile=document.enquiry_form.mobile.value;
	var time_call=document.enquiry_form.time_call.value;
	var country_of_residence=document.enquiry_form.country_of_residence.value;
	var destinations=document.enquiry_form.destinations.value;
	var date_arrival=document.enquiry_form.date_arrival.value;
	var city_of_residence=document.enquiry_form.city_of_residence.value;
	var duration=document.enquiry_form.duration.value;
	var accept_value=document.enquiry_form.accept_value.value;
	var patt_name=/^[A-Za-z]{1,}[A-Za-z .]{2,}$/;
	var patt_mail=/^[A-Za-z0-9]{1}[A-Za-z0-9_.]{0,}\@[A-Za-z0-9]{1,}[A-Za-z0-9.-]{1,}\.[A-Za-z]{1,}[A-Za-z.]{1,}$/;
	
	if(service_type=="0") {
		document.querySelector("#service_type_error").innerHTML="Select service";
		document.enquiry_form.service_type.focus();
		return false;
		} else {
		    // Clear error message for service_type
		    document.querySelector("#service_type_error").innerHTML = "";
		}
	if(channel_type=="0") {
		document.querySelector("#channel_type_error").innerHTML="Select channel";
		document.enquiry_form.channel_type.focus();
		document.querySelector("#service_type_error").innerHTML="";
		return false;
		}
	else if(name.trim()=="") {
		document.querySelector("#name_error").innerHTML="Enter full name";
		document.enquiry_form.name.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		return false;
		}
	else if(patt_name.test(name)==false) {
		document.querySelector("#name_error").innerHTML="Enter valid name";
		document.enquiry_form.name.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		return false;
		}
	else if(email.trim()=="" || patt_mail.test(email)==false) {
		document.querySelector("#email_error").innerHTML="Enter valid  email id";
		document.enquiry_form.email.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		return false;
		}
	else if(mobile.trim()=="" || isNaN(mobile)) {
		document.querySelector("#mobile_error").innerHTML="Enter valid Contact Number";
		document.enquiry_form.mobile.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		document.querySelector("#email_error").innerHTML="";
		return false;
		}
	else if(time_call=="0") {
		document.querySelector("#time_call_error").innerHTML="Select best time to call";
		document.enquiry_form.time_call.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		document.querySelector("#email_error").innerHTML="";
		document.querySelector("#mobile_error").innerHTML="";
		return false;
		}
	else if(country_of_residence=="0") {
		document.querySelector("#country_of_residence_error").innerHTML="Select best time to call";
		document.enquiry_form.time_call.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		document.querySelector("#email_error").innerHTML="";
		document.querySelector("#mobile_error").innerHTML="";
		document.querySelector("#time_call_error").innerHTML="";
		return false;
		}
	else if(destinations.trim()=="" || patt_name.test(destinations)==false) {
		document.querySelector("#destinations_error").innerHTML="Enter Destination";
		document.enquiry_form.destinations.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		document.querySelector("#email_error").innerHTML="";
		document.querySelector("#mobile_error").innerHTML="";
		document.querySelector("#time_call_error").innerHTML="";
		document.querySelector("#country_of_residence_error").innerHTML="";
		return false;
		}
	else if(date_arrival.trim()=="") {
		document.querySelector("#date_arrival_error").innerHTML="Select Date of Travel";
		document.enquiry_form.date_arrival.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		document.querySelector("#email_error").innerHTML="";
		document.querySelector("#mobile_error").innerHTML="";
		document.querySelector("#country_of_residence_error").innerHTML="";
		document.querySelector("#time_call_error").innerHTML="";
		document.querySelector("#destinations_error").innerHTML="";
		return false;
		}
	else if(city_of_residence.trim()=="" || patt_name.test(city_of_residence)==false) {
		document.querySelector("#city_of_residence_error").innerHTML="Enter Destination";
		document.enquiry_form.city_of_residence.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		document.querySelector("#email_error").innerHTML="";
		document.querySelector("#mobile_error").innerHTML="";
		document.querySelector("#country_of_residence_error").innerHTML="";
		document.querySelector("#time_call_error").innerHTML="";
		document.querySelector("#destinations_error").innerHTML="";
		document.querySelector("#date_arrival_error").innerHTML="";
		return false;
		}
	*else if(duration=="0") {*
	else if(document.querySelector("#displayDuration .selected").innerText == "Select Duration") {
		document.querySelector("#duration_error").innerHTML="Select duration";
		document.enquiry_form.duration.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		document.querySelector("#email_error").innerHTML="";
		document.querySelector("#mobile_error").innerHTML="";
		document.querySelector("#country_of_residence_error").innerHTML="";
		document.querySelector("#time_call_error").innerHTML="";
		document.querySelector("#destinations_error").innerHTML="";
		document.querySelector("#date_arrival_error").innerHTML="";
		document.querySelector("#displayDuration .selected").style.borderColor = "red";
		return false;
		}
	else if(accept_value=="0") {
		document.querySelector("#accept_value_error").innerHTML="Please accept Terms and Conditions!";
		document.enquiry_form.accept_value.focus();
		document.querySelector("#service_type_error").innerHTML="";
		document.querySelector("#channel_type_error").innerHTML="";
		document.querySelector("#name_error").innerHTML="";
		document.querySelector("#email_error").innerHTML="";
		document.querySelector("#mobile_error").innerHTML="";
		document.querySelector("#country_of_residence_error").innerHTML="";
		document.querySelector("#time_call_error").innerHTML="";
		document.querySelector("#city_of_residence_error").innerHTML="";
		document.querySelector("#destinations_error").innerHTML="";
		document.querySelector("#date_arrival_error").innerHTML="";
		document.querySelector("#duration_error").innerHTML="";
		return false;
		}
	else {
		// Get a reference to the submit button
	    var submitButton = document.getElementById("form_submit");

	    // Disable the submit button and change its text to "Processing..."
	    submitButton.disabled = true;
	    submitButton.innerText = "Please wait...";

		var app_url_custom=$("#APP_URL").val();
		var form_data = new FormData($('#enquiry_form')[0]);
		$.ajax( {
			url: app_url_custom + '/saveQuery',
			data: form_data,
			type: 'post',
			contentType: false,
			processData: false,

			success:function(data) {
				$("#overlay").fadeOut(300);
				if(data=='success') {
					swal("Thank you!", 'One of our travel expect will contact you shortly', "success");
					// Reset the form
                    document.enquiry_form.reset();
					}
				else {
					swal("Error", data, "error");
					}
					// Re-enable the submit button and change its text back to the original text
            		submitButton.disabled = false;
                	submitButton.innerText = "Get a Free Quote";
				},
			error:function(data) {
				// Re-enable the submit button and change its text back to the original text
	            submitButton.disabled = false;
                submitButton.innerText = "Get a Free Quote";
				}
			})
		return false;
		}
	}
});*/
/*----------------*/

/*form validation*/
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("enquiry_form");
    var submitButton = document.getElementById("form_submit");

    /*// Add event listener for form submission
    form.addEventListener("submit", function(event) {*/
    // Function to handle form submission
    function handleSubmit(event) {
        event.preventDefault(); // Prevent default form submission behavior

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

        // Validate service_type
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
        }

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
        if (time_call == "0") {
            document.querySelector("#time_call_error").innerHTML = "Select best time to call";
            document.enquiry_form.time_call.focus();
            return false;
        } else {
            document.querySelector("#time_call_error").innerHTML = "";
        }

        // Validate country_of_residence
        if (country_of_residence == "0") {
            document.querySelector("#country_of_residence_error").innerHTML = "Select country of residence";
            document.enquiry_form.country_of_residence.focus();
            return false;
        } else {
            document.querySelector("#country_of_residence_error").innerHTML = "";
        }

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

        // Validate city_of_residence
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
		    document.querySelector("#displayDuration .selected").style.borderColor = "red";
		    return false;
		} else {
		    document.querySelector("#duration_error").innerHTML = "";
		    document.querySelector("#displayDuration .selected").style.borderColor = ""; // Reset border color
		}

		// Validate hotel preference only if service type is "Tour Package" or "Accommodation"
        if (service_type === "Tour Package" || service_type === "Accommodation") {
            var hotelPreferenceValid = validateHotelPreference();
            var budgetValid = validateBudgetField();
	        if (!budgetValid) {
	            // Validation failed, do not submit the form
	            return;
	        }
        }        

		// Validate cruise fields only if service type is "Cruise"
        var service_type = document.getElementById("service_type").value;
        if (service_type === "Cruise") {
            var cruiseFieldsValid = validateCruiseFields();
            if (!cruiseFieldsValid) {
                // Validation failed, do not submit the form
                return;
            }
        }

        // Validate visa fields only if service type is "Visa"
        if (service_type === "Visa") {
            var visaFieldsValid = validateVisaFields();
            if (!visaFieldsValid) {
                // Validation failed, do not submit the form
                return;
            }
        }

        // Validate hotel preference only if service type is "Tour Package" or "Accommodation"
        if (service_type === "Tour Package" || service_type === "Accommodation") {
            var hotelPreferenceValid = validateHotelPreference();
            if (!hotelPreferenceValid) {
                // Validation failed, do not submit the form
                return;
            }
        }

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

	/*--------*/

   // Function to handle validation for budget field
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
    }

    // Add event listeners to trigger validation on change for budget-related fields
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
    updateSliderTrackColor();

    /*---------*/

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

    // Function to check if at least one radio button is checked for hotel preference
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
    }
	
	/*--------*/

    // hotel preference selection
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
    document.querySelector('.custom-selection input[type="radio"]:checked').dispatchEvent(new Event('change'));

    /*--------*/

	// add travellers
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
		})

	// Add event listeners to input fields to clear error messages when they lose focus
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
    });

    /*--------*/

    /*additional details*/
    $(document).on("change",".additional_details",function() {
	$("#additionaletails").val('')
	$(".additional_details").each(function() {
		if($(this).is(":checked")) {
			var txt = $(this).val();
			var additionaletails = $("#additionaletails");
			additionaletails.val(additionaletails.val() + txt + ', ');
			}
		});
	})

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




/*// Add event listener to service type dropdown to trigger validation on change
    document.getElementById("service_type").addEventListener("change", function() {
        var service_type = document.getElementById("service_type").value;
        if (service_type === "Cruise") {
            validateCruiseFields();
        } else if (service_type === "Visa") {
            validateVisaFields();
        }
    });*/



/*budget*/
/*document.addEventListener("DOMContentLoaded", function() {
    var budgetInput = document.getElementById("exp_budget");
    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
    var budgetSlider = document.getElementById("budgetSlider");

    // Function to add commas to the budget value for better readability
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Function to toggle slider visibility
    function toggleSliderVisibility() {
        budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
    }

    // Add focus and click event listeners to the budget input
    budgetInput.addEventListener("focus", function(event) {
        budgetSliderContainer.style.display = "block";
        event.stopPropagation(); // Prevent the focus event from propagating to the document body
    });

    budgetInput.addEventListener("click", function(event) {
        toggleSliderVisibility();
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });

    // Add input event listener to the budget slider
    budgetSlider.addEventListener("input", function() {
        *budgetInput.value = "₹" + numberWithCommas(budgetSlider.value);*
        budgetInput.value = numberWithCommas(budgetSlider.value);
    });

    // Add click event listener to the document body
    document.body.addEventListener("click", function() {
        budgetSliderContainer.style.display = "none";
    });

    // Prevent the budget slider container from closing when clicking inside of it
    budgetSliderContainer.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });
});*/

/*document.addEventListener("DOMContentLoaded", function() {
    var budgetInput = document.getElementById("exp_budget");
    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
    var budgetSlider = document.getElementById("budgetSlider");

    // Function to add commas to the budget value for better readability
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Function to remove commas from the budget value
    function removeCommas(x) {
        return x.replace(/,/g, '');
    }

    // Hide the budget slider container initially
    budgetSliderContainer.style.display = "none";

    // Function to toggle slider visibility
    function toggleSliderVisibility() {
        budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
    }

    // Add focus and click event listeners to the budget input
    budgetInput.addEventListener("focus", function(event) {
        budgetSliderContainer.style.display = "block";
        event.stopPropagation(); // Prevent the focus event from propagating to the document body
    });

    budgetInput.addEventListener("click", function(event) {
        toggleSliderVisibility();
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });

    // Add input event listener to the budget slider
    budgetSlider.addEventListener("input", function() {
        budgetInput.value = numberWithCommas(budgetSlider.value);
    });

    // Add input event listener to the budget input
    budgetInput.addEventListener("input", function() {
        var value = removeCommas(budgetInput.value);
        if (!isNaN(value) && value >= budgetSlider.min && value <= budgetSlider.max) {
            budgetSlider.value = value;
        }
    });

    // Add click event listener to the document body
    document.body.addEventListener("click", function() {
        budgetSliderContainer.style.display = "none";
    });

    // Prevent the budget slider container from closing when clicking inside of it
    budgetSliderContainer.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });
});*/

/*document.addEventListener("DOMContentLoaded", function() {
    var budgetInput = document.getElementById("exp_budget");
    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
    var budgetSlider = document.getElementById("budgetSlider");

    // Function to add commas to the budget value for better readability
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Function to remove commas from the budget value
    function removeCommas(x) {
        return x.replace(/,/g, '');
    }

    // Hide the budget slider container initially
    budgetSliderContainer.style.display = "none";

    // Function to toggle slider visibility
    function toggleSliderVisibility() {
        budgetSliderContainer.style.display = budgetSliderContainer.style.display === "none" ? "block" : "none";
    }

    // Add focus and click event listeners to the budget input
    budgetInput.addEventListener("focus", function(event) {
        budgetSliderContainer.style.display = "block";
        event.stopPropagation(); // Prevent the focus event from propagating to the document body
    });

    budgetInput.addEventListener("click", function(event) {
        toggleSliderVisibility();
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });

    // Add input event listener to the budget slider
    budgetSlider.addEventListener("input", function() {
        budgetInput.value = numberWithCommas(budgetSlider.value);
    });

    // Add input event listener to the budget input
    budgetInput.addEventListener("input", function() {
        var value = removeCommas(budgetInput.value);
        if (!isNaN(value) && value >= budgetSlider.min && value <= budgetSlider.max) {
            budgetSlider.value = value;
        }
    });

    // Add change event listener to the budget input
    budgetInput.addEventListener("change", function() {
        var value = removeCommas(budgetInput.value);
        if (!isNaN(value) && value >= budgetSlider.min && value <= budgetSlider.max) {
            budgetSlider.value = value;
        }
    });

    // Add click event listener to the document body
    document.body.addEventListener("click", function() {
        budgetSliderContainer.style.display = "none";
    });

    // Prevent the budget slider container from closing when clicking inside of it
    budgetSliderContainer.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });
});*/

/*document.addEventListener("DOMContentLoaded", function() {
    var budgetInput = document.getElementById("exp_budget");
    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
    var budgetSlider = document.getElementById("budgetSlider");

    // Function to add commas to the budget value for better readability
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
        budgetInput.value = numberWithCommas(budgetSlider.value);
    });

    // Add click event listener to the document body
    document.body.addEventListener("click", function() {
        budgetSliderContainer.style.display = "none";
    });

    // Prevent the budget slider container from closing when clicking inside of it
    budgetSliderContainer.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });
});*/

/*round of to 50*/
/*document.addEventListener("DOMContentLoaded", function() {
    var budgetInput = document.getElementById("exp_budget");
    var budgetSliderContainer = document.getElementById("budgetSliderContainer");
    var budgetSlider = document.getElementById("budgetSlider");

    // Function to round the budget value to the nearest 500
    function roundToNearest50(x) {
        return Math.round(x / 500) * 500;
    }

    // Function to add commas to the budget value for better readability
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
    });

    // Add click event listener to the document body
    document.body.addEventListener("click", function() {
        budgetSliderContainer.style.display = "none";
    });

    // Prevent the budget slider container from closing when clicking inside of it
    budgetSliderContainer.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document body
    });
});*/



/*budger slider*/
/*document.addEventListener("DOMContentLoaded", function() {
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
        });*/


/*--------*/

/*hotel preference selection (working)*/
/*document.addEventListener('DOMContentLoaded', function() {
	// Select all radio buttons
	const radioButtons = document.querySelectorAll('.custom-selection input[type="radio"]');

	radioButtons.forEach(radio => {
		radio.addEventListener('change', function() {
			// Remove the selected-radio class from all labels
			radioButtons.forEach(r => r.parentElement.classList.remove('selected-item'));
				//radioButtons.forEach(r => {
				//r.parentElement.style.backgroundColor = '';
				//r.parentElement.style.color = '';
			//});

			// Add the selected-item class to the selected label
			if (this.checked) {
				this.parentElement.classList.add('selected-item');
				//this.parentElement.style.backgroundColor = '#08B2ED';
				//this.parentElement.style.color = 'white';
			}
		});
	});

	// Trigger change event for pre-checked radio button to apply styles on page load
	document.querySelector('.custom-selection input[type="radio"]:checked').dispatchEvent(new Event('change'));
});*/

/*OR*/ 

/*hotel preference radio button (working)*/
/*document.addEventListener('DOMContentLoaded', function() {
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
    document.querySelector('.custom-selection input[type="radio"]:checked').dispatchEvent(new Event('change'));
});*/

/*error*/
/*document.addEventListener('DOMContentLoaded', function() {
    const errorId = "errorId"; // Replace with the actual ID of the error message element

    // Log the value of errorId
    console.log("errorId:", errorId);

    // Retrieve the error message element
    const errorMessage = document.getElementById(errorId);

    // Log the retrieved element
    console.log("errorMessage:", errorMessage);

    // Clear the error message if the element exists
    if (errorMessage) {
        errorMessage.innerHTML = "";
    }
});*/

/*--------*/

/*county code & natonality*/
/*document.addEventListener("DOMContentLoaded", function() {
    //Country Code
    var APP_URL=$("#APP_URL").val();
    var url=APP_URL+'/country_code';
    var data={
    	_token:"{{ csrf_token() }}"
    	};
    $.post(url,data,function(rdata) {
        $("#country_code").html("").html(rdata);
    })
	//Nationality
	var APP_URL=$("#APP_URL").val();
	var url=APP_URL+'/country_query_s';
	var data={
		_token:"{{ csrf_token() }}"
		};
	$.post(url,data,function(rdata) {
		$("#country_of_residence").html("").html(rdata);
		})
	});*/
</script>
@endsection