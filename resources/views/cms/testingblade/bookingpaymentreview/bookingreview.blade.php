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
@section('content')
<style type="text/css">
/*Desktop Booking & Payment Review Page*/
.reviewCont {
	background: #0a223d;
	height: 65px;
	display: flex;
	align-items: center;
	}
.reviewTitle {
	font-size: 22px;
	line-height: 22px;
	color: #fff;
	font-weight: 900;
	text-align: left;
	margin-bottom: 0;
	text-transform: capitalize;
	}
.reviewTourDtlsCont {
	padding-top: 15px;
	display: flex;
	justify-content: space-between;
	}
.reviewTourBox {
	padding: 0px 25px 25px 0px;
	}
.reviewTourTitle {
	font-size: 22px;
	line-height: 22px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	text-transform: none;
	}
.reviewTourDuration {
	font-size: 18px;
	line-height: 20px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 25px;
	text-transform: none;
	}
.reviewTourSubTitle {
	font-size: 14px;
	line-height: 20px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	text-transform: none;
	}
.tourDepartureBox {
    padding: 25px;
    border-radius: 5px;
	box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
    /*box-shadow: 0px 3px 6px lightgrey;*/
	width: 300px;
	min-height: 175px;
    margin-right: 1%;
	}
.tourTravelDateBox {
    padding: 25px;
    border-radius: 5px;
	box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
    /*box-shadow: 0px 3px 6px lightgrey;*/
	width: 300px;
	min-height: 175px;
	}
.tourDepartureBox h4, .tourTravelDateBox h4 {
	font-size: 14px;
	line-height: 14px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	text-transform: uppercase;
	}
.tourDepartureBox h5, .tourTravelDateBox h5 {
	font-size: 17px;
	line-height: 19px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	text-transform: capitalize;
	}
.reviewTourSeparator {
	border-top: 2px solid #e7e7e7;
	margin-top: 20px;
	margin-bottom: 25px;
	}
.leftContainer {
	flex: 1;
	padding-right: 30px;
	}
.travellerHead {
	font-size: 22px;
	line-height: 22px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	text-transform: capitalize;
	}
.travellerGuestDtls {
	font-size: 16px;
	line-height: 16px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: left;
	margin-bottom: 5px;
	text-transform: none;
	}
.roomCountCont {
	display: flex;
	align-items: center;
	margin: 30px 0;
	}
.roomCount {
	font-size: 16px;
	font-height: 16px;
	color: #4a4a4a;
	font-weight: 900;
	text-transform: uppercase;
	flex-shrink: 0;
	margin-right: 50px;
	}
.flexOne {
	display: flex;
    flex: 1;
	}
.line {
    background: #e2e2e2;
    height: 1px;
    margin: 6px 0 0px 0;
	}
.guestDtlsCont {
	display: flex;
	align-items: center;
	margin-bottom: 15px;
	}
.guestCountBox {
	width: 100px;
	margin-right: 5px;
	}
.guestCountBox h4 {
	font-size: 16px;
	line-height: 16px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	text-transform: uppercase;
	}
.guestCountBox h5 {
	font-size: 12px;
	line-height: 12px;
	color: #9b9b9b;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.guestNameBox {
	width: 410px;
	margin-right: 20px;
	}
.guestNameBox input[type=text] {
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	border-radius: 5px;
    border: 1px solid #b3b3b3;
	width: 100%;
	cursor: default;
	}
.guestNameBox input:focus {
	border-color: #000001;
	}
.fa-user:before {
	content: "\f007";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
	color: #9b9b9b;
	font-size: 16px;
	line-height: 1;
	cursor: pointer;
	}
.addNewGuest {
	font-size: 12px;
	line-height: 14px;
	color: #9b9b9b;
	font-weight: 900;
	text-align: left;
	cursor: pointer;
	padding: 10px;
	}
.addNewGuest:hover, .addNewGuest:hover .fa-user:before {
	color: #008cff;
	}
.guestContactDtlsBox, .guestGSTDtlsBox {
	margin-top: 25px;
    padding: 20px 15px 30px 20px;
    border-radius: 5px;
    box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
	}
.guestContactDtlsBox h2 {
	font-size: 16px;
	line-height: 16px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 20px;
	}
/*Flex Row*/
.flex-row {
   display: flex;
   flex-direction: row;
   }
.flex-col {
	padding: 15px;
	margin: 0 15px;
	background: #ddd;
	}
.flex-row-multicolum {
	display: flex;
	flex-flow: row wrap;
	}
.flex-col-md-12, .flex-col-md-11, .flex-col-md-10, .flex-col-md-9, .flex-col-md-8, .flex-col-md-7, .flex-col-md-6, .flex-col-md-5, .flex-col-md-4, .flex-col-md-3, .flex-col-md-2, .flex-col-md-1 {
	margin: 0 auto;
	/*margin: 0 15px 15px;*/
	width: 100%;
	}
@media (min-width: 992px) {
.flex-col-md-12, .flex-col-md-11, .flex-col-md-10, .flex-col-md-9, .flex-col-md-8, .flex-col-md-7, .flex-col-md-6, .flex-col-md-5, .flex-col-md-4, .flex-col-md-3, .flex-col-md-2, .flex-col-md-1 {
	/*margin: 0 15px 15px;*/
	padding-left: 15px;
	padding-right: 15px;
	}
}
@media (min-width: 992px) {
.flex-col-md-12 {
	width: 100%;
	}
  .flex-col-md-11 {
    width: 91.66666667%;
  }
  .flex-col-md-10 {
    width: 83.33333333%;
  }
  .flex-col-md-9 {
    width: 75%;
  }
  .flex-col-md-8 {
    width: 66.66666667%;
  }
  .flex-col-md-7 {
    width: 58.33333333%;
  }
  .flex-col-md-6 {
    width: 50%;
  }
  .flex-col-md-5 {
    width: 41.66666667%;
  }
  .flex-col-md-4 {
    width: 33.33333333%;
  }
  .flex-col-md-3 {
    width: 25%;
  }
  .flex-col-md-2 {
    width: 16.66666667%;
  }
  .flex-col-md-1 {
    width: 8.33333333%;
  }
}
.panInfoCont {
    margin-top: 25px;
    padding: 20px 35px;
    border-radius: 5px;
    background: #d3d3d3;
    border: 1px solid #d3d3d3;
	}
.panCardImageBox {
    width: 54px;
    height: auto;
    overflow: hidden;
    margin: 0 10px 0 0;
    border-radius: 3px;
    display: flex;
    flex-shrink: 0;
	}
.panCardImage {
    height: 38px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.panInfo h4 {
    font-size: 14px;
	line-height: 16px;
	color: #000001;
    font-weight: 600;
	text-align: left;
    margin-bottom: 15px;
	}
.panInfo p {
    font-size: 13px;
	line-height: 21px;
	color: #000001;
    font-weight: 500;
	text-align: left;
    margin-bottom: 0;
	}
.impInfoBox {
	margin: 25px 0px 30px;
    padding: 7px;
    background: #FFEDD1;
    border: 1px solid #d3d3d3;
	}
.impInfoBox h5 {
    font-size: 12px;
	line-height: 12px;
    font-weight: 700;
    color: #FF664B;
	text-align: center;
	margin-bottom: 0;
	}
.rightContainer {
	width: 350px;
	}
.priceValueBox {
    border: 1px solid #e0dfdf;
    border-radius: 4px 4px 0 0;
    padding: 20px;
    background-color: #f2f9ff;
	}
.priceValueBox .grandTtlTag {
    font-size: 11px;
    line-height: 11px;
	color: #a1a1a1;
	font-weight: 500;
    text-align: left;
	margin-bottom: 3px;
	}
.priceValueBox .grandTtlValue {
    font-size: 26px;
    line-height: 26px;
	color: #000001;
	font-weight: 600;
    text-align: left;
	margin-bottom: 3px;
	}
.defaultCurencyPay:before {
	content: '\0020B9';
	font-weight: 500;
	}
.gstTag {
    font-size: 12px;
    line-height: 12px;
	color: #a1a1a1;
	font-weight: 500;
    text-align: left;
	margin-bottom: 0;
	}
.paymentDetails {
	border: 1px solid #e0dfdf;
	border-top: 0;
	box-shadow: 0 4px 8px 0 #8a6a7614;
	}
.PaxWiseBox {
	padding: 25px 20px 10px;
	border-bottom: 1px solid #f1f1f1;
	}
.paxValueBox {
	margin-bottom: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
	}
.paxValueBox:last-child {
	margin-bottom: 0;
	}
.paymentPaxValue {
	font-size: 14px;
    line-height: 14px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.totalCostBox {
	padding: 0 20px;
	background: #f9f9f9;
	}
.totalBasicCostBox {
	padding: 20px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
	border-bottom: 1px solid #f1f1f1;
	}
.totalBasicCostBox:last-child {
	border-bottom: 0;
	}
.basicCostItem {
	font-size: 14px;
    line-height: 14px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.fontBold {
	font-weight: 600 !important;
	}
.grandTotalCostBox {
	padding: 0 20px;
	background: #fff;
	border: 1px solid #e0dfdf;
	border-top: 0;
	box-shadow: 0 4px 8px 0 #8a6a7614;
	}
.payFullCostBox {
	padding: 0 20px;
	background: #fffdf5;
	border: 1px solid #e0dfdf;
	border-top: 0;
	box-shadow: 0 4px 8px 0 #8a6a7614;
	}
.payFullBox {
	/*padding: 20px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
	border-bottom: 1px solid #f1f1f1;*/
	}
.payFullCostBox label {
	padding: 20px 0;
	font-size: 16px;
    line-height: 16px;
    color: #000001 !important;
    font-weight: 600 !important;
	text-align: left;
	margin-bottom: 0;
	display: flex;
    align-items: center;
    justify-content: space-between;
    margin-right: 0 !important;
	}
.payFullCostBox input[type=radio], .payPartBox input[type=radio] {
	width: 18px;
	height: 18px;
	margin: 0 10px 0 0;
	}
.payFullItem {
	padding: 0;
    font-size: 18px;
    line-height: 18px;
    color: #000001 !important;
    font-weight: 600 !important;
    text-align: right;
	flex-shrink: 0;
	}
.payPartBox {
	padding: 0 20px 20px;
	background: #fff;
	border: 1px solid #e0dfdf;
	border-top: 0;
	box-shadow: 0 4px 8px 0 #8a6a7614;
	}
.payPartBox label {
	padding: 20px 0 0;
	font-size: 16px;
    line-height: 16px;
    color: #4a4a4a !important;
    font-weight: 600 !important;
	text-align: left;
	margin-bottom: 0;
	display: flex;
    align-items: center;
    justify-content: space-between;
    margin-right: 0 !important;
	}
.payPartBalanceBox {
	display: flex;
    align-items: center;
    justify-content: space-between;
	}
.payPartBalance {
	border: 2px solid #4a4a4a;
    width: 21px;
    height: 22px;
    border-radius: 50%;
    margin: 0px 10px 0px 0px;
    display: flex;
    justify-content: center;
    flex-shrink: 0;
    align-items: center;
    /*padding: 3px 6px;
    text-align: center;*/
	}
.payPartBalanceInfo {
	font-size: 14px;
    line-height: 14px;
    color: #4a4a4a;
    font-weight: 500;
	text-align: left;
	}
.payPartFlow {
	border-left: 2px solid #9b9b9b;
	height: 35px;
	margin-left: 9px;
	}
.payPartBalanceItem {
	padding: 0;
    font-size: 15px;
    line-height: 15px;
    color: #9b9b9b;
    font-weight: 600;
	flex-shrink: 0;
	}
.guestPayCont {
	padding: 20px;
	background: #f2f9ff;
	border: 1px solid #e0dfdf;
	border-top: 0;
	border-radius: 0 0 4px 4px;
	box-shadow: 0 4px 8px 0 #8a6a7614;
	}
.guestPayItem {
	font-size: 18px;
    line-height: 18px;
    color: #000001;
    font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.guestPayBox {
	padding: 0 0 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
	}
.guestDueItem {
	font-size: 16px;
    line-height: 16px;
    color: #9b9b9b;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.guestConfBox {
    margin-top: 20px;
    border: 1px solid #F0E7CD;
    padding: 12px 20px;
    background-color: #FFFDF5;
    display: flex;
    align-items: center;
	margin-bottom: 25px;
	}
.guestAcceptance {
	font-size: 10px;
    line-height: 15px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	margin-left: 10px;
	}
.btnProceed {
	flex-shrink: 0;
	outline: 0;
	text-transform: uppercase;
	background: #CED0D4;
	border: 0;
    border-radius: 35px;
	padding: 15px;
    font-size: 14px;
	line-height: 14px;
	color: #fff;
	font-weight: 700;
	cursor: pointer;
	width: 100%;
	}
.btnProceed:hover {
	background: #CED0D4;
	color: #fff;
	}
.btnProceed_enabled {
	flex-shrink: 0;
	outline: 0;
	text-transform: uppercase;
	background: #008cff;
	border: 0;
    border-radius: 35px;
	padding: 15px;
    font-size: 14px;
	line-height: 14px;
	color: #fff;
	font-weight: 700;
	cursor: pointer;
	width: 100%;
	}
/*Desktop Booking Review Page Ends*/
</style>
<style type="text/css">
/*already in css file*/
/*Modal Starts*/
.btnCloseModal {
    flex-shrink: 0;
    outline: 0;
    text-transform: uppercase;
    background: #fff;
    border: 0;
    padding: 6px;
    font-size: 12px;
    line-height: 12px;
    color: #848889;
    font-weight: 700;
    cursor: pointer;
    text-align: center;
	text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
	-webkit-appearance: none;
	}
.btnCloseModal:hover {
	background-color: #fff;
	color: #4a4a4a;
	opacity: .4;
	}
.modalBody_enq {
	position: relative;
	padding: 15px 15px 0;
	}
/*Modal Dialog with Js*/
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 999; /* Sit on top */
  padding-top: 0; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
  }
@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
  }
/*Modal Ends*/
</style>
<style type="text/css">
/*Add Traveller Info (Desktop-Mobile)-popup*/
.appendB275 {
	margin-bottom: 275px;
	}
.addGuestInfoCont {
	width: 690px;
	margin: 0 auto;
	}
.addGuestInfoBox {
	padding: 20px;
	background: #fff;
	}
.boxHeader {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 10px;
	}
.boxHeader h1 {
	font-size: 25px;
	line-height: 25px;
	color: #000001;
	font-weight: 900;
	text-align: left;
	margin-bottom: 0;
	}
.deleteInfo {
	font-size: 16px;
	line-height: 16px;
	color: #eb2026;
	font-Weight: 900;
	cursor: pointer;
	}
.fa-trash:before {
	content: "\f014";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
	color: #eb2026;
	font-size: 18px;
	cursor: unset;
	margin-top: 0;
	margin-right: 5px;
	}
.infoCont {
	position: sticky;
	position: -webkit-sticky;
    top: 0;
    z-index: 2;
    background: #fff;
    /*border-radius: 10px 10px 0 0;*/
	border-bottom: 1px solid #ccc;
	padding-bottom: 0;
	}
.infoCont ul {
	display: flex;
	align-items: center;
	padding-top: 15px;
	}
.infoCont ul li {
	font-size: 16px;
	line-height: 16px;
	color: #000001;
	font-weight: 900;
	cursor: pointer;
	text-align: left;
	padding-bottom: 20px;
	margin-right: 30px;
	}
.infoCont a.active {
  color: #008cff;
  padding-bottom: 18px;
  border-bottom: 3px solid #008cff;
  }
.infoCont a:hover, a:focus {
  color: #008cff;
  }
.basicInfoBox, .passportInfoBox {
	margin-bottom: 20px;
	}
.basicInfoBox h1, .passportInfoBox h1 {
	font-size: 18px;
	line-height: 18px;
	color: #000001;
	font-weight: 900;
	text-align: left;
	margin-bottom: 5px;
	}
.basicInfoBox h2, .passportInfoBox h2 {
	font-size: 14px;
	line-height: 14px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.guestInputBox {
	width: 50%;
	padding-left: 15px;
	padding-right: 15px;
	margin-bottom: 10px;
	}
.guestInputBox label {
	color: #000001 !important;
	font-size: 14px !important;
	line-height: 14px !important;
	}
.guestInputBox input[type="text"], .guestInputBox select, .guestInputBox input[type=date] {
	width: 100%;
	text-transform: capitalize;
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	background: #fff;
    border: 1px solid #9b9b9b;
    border-radius: 4px;
	height: 43px;
	outline: none
	}
.guestInputBox input:focus, .guestInputBox select:focus {
	border-color: #008cff;
	box-shadow: none;
	}
.lineSeparator {
	border-bottom: 4px solid #f0f0f0;
	margin-top: 15px;
	margin-bottom: 20px;
	}
.profile_stickyFooter {
	position: sticky;
	z-index: 1009;
	background: #fff;
	border-radius: 0 0 10px 10px;
	bottom: 0;
	}
.profileFooterCont {
	padding: 10px 20px;
    border-top: 1px solid #CED0D4;
    display: flex;
    align-items: center;
    justify-content: flex-end;
	}
.btnCancel {
    cursor: pointer;
	flex-shrink: 0;
	outline: 0;
	text-transform: none;
	color: #4a4a4a;
	font-weight: 500;
	padding: 6px 12px;
	font-size: 14px;
    line-height: 20px;
	border: 1px solid #fff;
	border-radius: 4px;
	background: #fff;
	}
.btnCancel:hover {
	background: #fff;
	color: #4a4a4a;
	}
.btnSave {
    cursor: pointer;
	flex-shrink: 0;
	outline: 0;
	text-transform: uppercase;
	color: #fff;
	font-weight: 900;
	padding: 6px 12px;
	font-size: 18px;
    line-height: 20px;
	border: 1px solid #fff;
	border-radius: 20px;
	background: #008cff;
	width: 120px;
    height: 40px;
	}
.btnSave:hover {
	background: #008cff;
	color: #fff;
	}
/*Add Traveller Info (Desktop-Mobile)-popup ENDS*/
</style>
<section>
<div class="destop_test_exp">
<div class="reviewCont">
	<div class="pageContainer">
		<h3 class="reviewTitle">Review Package</h3>
	</div>
</div>
<div class="pageContainer">
	<div class="reviewTourDtlsCont">
		<div class="reviewTourBox">
			<h2 class="reviewTourTitle">Dubai Shopping Festival 2021 with - 5 Star hotel</h2>
			<h3 class="reviewTourDuration">3 Nights / 4 Days</h3>
			<h5 class="reviewTourSubTitle">Included in this package</h5>
			<div id="mobscroll" class="mobscroll overflowX">
				@php
					/* $package_service=unserialize($details->package_service); */
				@endphp
					@if(empty($package_service))
					@else
					<?php $count_package_service=count($package_service); ?>  
						<?php
							$ico="";
							foreach ($icon_data as $icon_data1) {
							$ico.=$icon_data1->icon_title.",";
							}
							$ico1=array_unique(explode(",",$ico));
						?>
					@for($i=0;$i<$count_package_service;$i++)
						@if(in_array($package_service[$i], $ico1))
							<!--<div style="margin-right: 5%;">
								<p style="text-align: center;margin-bottom: 5px;">
									<img width= "28" height="28" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon')) }}"  title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}"></p>
								<p style="font-size: 12px;margin-bottom: 0px;text-align: center;">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</p>
							</div>-->
							<div class="mitemServiceIcons">
								<div class="mitemServiceIconsImage">
									<img class="mitemServiceImage" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon')) }}" title="{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
								</div>
								<div class="mitemServiceIconsTitle">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</div>
							</div>
						@else
						@endif
					@endfor
					@endif
			</div>
		</div>
		<div class="tourDepartureBox">
			<h4>DEPARTURE CITY</h4>
			<h5>New Delhi</h5>
		</div>
		<div class="tourTravelDateBox">
			<h4>TOUR DATE</h4>
			<h5>Sunday, 27 December 2021</h5>
			<h4>TO</h4>
			<h5>Thursday, 31 December 2021</h5>
		</div>
	</div>
	<div class="reviewTourSeparator"></div>
	<!--Traveller Information-->
	<div class="makeflex">
		<div class="leftContainer">
			<!--Traveller information starts-->
			<div>
				<div>
					<h3 class="travellerHead">Traveller Information</h3>
				</div>
				<div class="makeflex">
					<div>
						<h5 class="travellerGuestDtls">4 Adults, 1 Child, 1 Infant</h5>
					</div>
					<div class="makeflex appendLeft40">
						<h5 class="travellerGuestDtls">No of Rooms:</h5>
						<h5 class="travellerGuestDtls appendLeft20">2</h5>
					</div>
				</div>
				<!--Rooming-->
				<div>
					<div class="roomCountCont">
						<span class="roomCount">Room - 1</span>
						<span class="flexOne line"></span>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - 1</h4>
							<h5>(age >18yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest" id="addModal"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - 2</h4>
							<h5>(age >18yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Child - 1</h4>
							<h5>(age 2 to 12yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
				</div>
				<!--Rooming-->
				<div>
					<div class="roomCountCont">
						<span class="roomCount">Room - 2</span>
						<span class="flexOne line"></span>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - 1</h4>
							<h5>(age >18yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - 2</h4>
							<h5>(age >18yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Child - 1</h4>
							<h5>(age 2 to 12yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Infant - 1</h4>
							<h5>(age 0 to 2yrs)</h5>
						</div>
						<div class="guestNameBox">
							<input type="text" value="" placeholder="Enter full name as per id card" />
						</div>
						<div class="addNewGuest"><span class="fa-user"></span><span class="appendLeft10">Add New</span></div>
					</div>
				</div>
			</div>
			<!--Traveller information ends-->
			<!--Traveller contact information starts-->
			<div class="guestContactDtlsBox">
				<!--<h2>Contact Details</h2>-->
				<div class="flex-col-md-12">
					<div class="formGroup">
						<div class="font16 fontWeight600 blackText">Please enter details</div>
					</div>
				</div>
				<!--Email Id, Mobile No, City, State, Address, Spl Requests-->
				<div class="flex-row-multicolum appendTop20">
					<div class="flex-col-md-6">
						<div class="formGroup">
							<label for="email" class="formLabel">Email ID</label>
							<input class="formInput" type="email"  value="" id="email" name="email" placeholder="Enter Your Email Id" />
							<span class="error" id="email_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="formGroup">
							<label for="mobile" class="formLabel">Mobile No</label>
							<input class="formInput" type="text"  value="" name="mobile" id="mobile" placeholder="Enter Your Mobile No" />
							<span class="error" id="mobile_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="formGroup">
							<label for="city" class="formLabel">City</label>
							<input class="formInput" type="text"  value="" id="city" name="city" placeholder="Enter Your City" />
							<span class="error" id="city_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="formGroup">
							<label for="state" class="formLabel">State</label>
							<input class="formInput" type="text"  value="" name="state" id="state" placeholder="Enter Your State" />
							<span class="error" id="state_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="formGroup">
							<label for="address" class="formLabel">Address</label>
							<input class="formInput" type="text"  value="" name="address" id="address" placeholder="Enter your address" />
							<span class="error" id="address_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="formGroup appendTop20">
							<label for="additionaletails" class="formLabel">Special Request <span class="font14">(subject to availability)</span></label>
							<div class="addOnDtlsCont">
								<label for="earlycheckin"><input type="checkbox" id="earlycheckin" name="earlycheckin" value="Early Check-in">Early Check-in</label>
								<label for="latecheckout"><input type="checkbox" id="latecheckout" name="latecheckout" value="Early Check-in">Late Checkout</label>
								<label for="honeymoonfreebies"><input type="checkbox" id="honeymoonfreebies" name="honeymoonfreebies" value="Honeymoon Freebies">Honeymoon Freebies</label>
							</div>
							<textarea class="formTextarea" type="text" id="formTextarea" name="message" placeholder="Enter additional requests (if any)"></textarea>
						</div>
					</div>
				</div>
			</div>
		
			<!--Traveller contact information ends-->
			<!--Business Traveller GST information starts-->
			<div class="guestGSTDtlsBox">
				<div class="flex-col-md-12">
					<div class="formGroup">
						<div class="font16 fontWeight600 blackText">Enter GST details (optional)</div>
					</div>
				</div>
				<!--GSTIN Details-->
				<div class="flex-row-multicolum appendTop20">
					<div class="flex-col-md-6">
						<div class="formGroup">
							<label for="email" class="formLabel">GSTIN</label>
							<input class="formInput" type="email"  value="" id="email" name="email" placeholder="Enter Your Email Id" />
							<span class="error" id="email_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="formGroup">
							<label for="mobile" class="formLabel">GST Name</label>
							<input class="formInput" type="text"  value="" name="mobile" id="mobile" placeholder="Enter Your Mobile No" />
							<span class="error" id="mobile_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="formGroup">
							<label for="city" class="formLabel">GST Email ID</label>
							<input class="formInput" type="text"  value="" id="city" name="city" placeholder="Enter Your City" />
							<span class="error" id="city_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="formGroup">
							<label for="state" class="formLabel">GST Mobile No</label>
							<input class="formInput" type="text"  value="" name="state" id="state" placeholder="Enter Your State" />
							<span class="error" id="state_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="formGroup">
							<label for="address" class="formLabel">GST Address</label>
							<input class="formInput" type="text"  value="" name="address" id="address" placeholder="Enter your address" />
							<span class="error" id="address_error"></span>
						</div>
					</div>
				</div>
				<!--Business Traveller GST information ends-->
			</div>
			<!--Traveller contact information ends-->
			<!--Traveller Pan Card information starts-->
			<div class="panInfoCont">
				<div class="makeflex alignitemsBaseline">
				<div class="panCardImageBox">
					<img class="panCardImage" src="" title="Pan card">
				</div>
				<div class="panInfo">
					<h4>Please keep your PAN card hand, for the next steps</h4>
					<p>"As per Income Tax Act, 1961, the TCS@5% has been added to the amount payable for booking overseas package. In case PAN is not provided TCS@10% will be applicable. You will be able to take the credit of such TCS against Income Tax payable or by claimaint refund at the time of filing Income tax return."
					<br>
					<br>
					Howeever as per RBI guidelines, collection of PAN card details has been mandatory for all international bookings. So, please share your PAN card details in next steps to proceed with the booking.
					</p>
				</div>
				</div>
			</div>
			<!--Traveller Pan Card information ends-->
			<div class="impInfoBox">
				<h5>Please make sure you read all the Terms & Conditions, Booking and Cancellation Policy for this booking.</h5>
			</div>
		</div>
		<!--Sidebar starts-->
		<div class="rightContainer">
			<div class="priceValueBox">
				<p class="grandTtlTag">GRAND TOTAL</p>
				<p class="grandTtlValue"><span class="defaultCurencyPay"></span>12,457</p>
				<p class="gstTag">(inclusive of all taxes)</p>
			</div>
			<div class="paymentDetails">
			<div class="PaxWiseBox">
				<div class="paxValueBox">
					<div>
						<p class="paymentPaxValue"><span class="defaultCurencyPay"></span> 4,698 x 4 <span class="fontSize14 colorA1">adults</span></p>
					</div>
					<div class="paymentPaxValue"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
				<div class="paxValueBox">
					<div>
						<p class="paymentPaxValue"><span class="defaultCurencyPay"></span> 2,698 x 2 <span class="fontSize14 colorA1">children</span></p>
					</div>
					<div class="paymentPaxValue"><span class="defaultCurencyPay"></span> 5,396</div>
				</div>
				<div class="paxValueBox">
					<div>
						<p class="paymentPaxValue"><span class="defaultCurencyPay"></span> 1,698 x 1 <span class="fontSize14 colorA1">infant</span></p>
					</div>
					<div class="paymentPaxValue"><span class="defaultCurencyPay"></span> 1,698</div>
				</div>
			</div>
			<div class="totalCostBox">
				<div class="totalBasicCostBox">
					<div>
						<p class="basicCostItem fontBold">Total Basic Cost</p>
					</div>
					<div class="basicCostItem fontBold"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
				<div class="totalBasicCostBox">
					<div>
						<p class="basicCostItem">Discount (-)</p>
					</div>
					<div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
				<div class="totalBasicCostBox">
					<div>
						<p class="basicCostItem">GST (5%)</p>
					</div>
					<div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
				<div class="totalBasicCostBox">
					<div>
						<p class="basicCostItem">TCS (5%)</p>
					</div>
					<div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
				<div class="totalBasicCostBox">
					<div>
						<p class="basicCostItem">PG (5%)</p>
					</div>
					<div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
			</div>
			</div>
			<div class="grandTotalCostBox">
				<div class="totalBasicCostBox">
					<div>
						<p class="basicCostItem fontBold">Grand Total</p>
					</div>
					<div class="basicCostItem fontBold"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
			</div>
			<div class="payFullCostBox">
				<label>
					<div class="flexCenter"><input type="radio" id="" name="fullamt" value="fullamt">Pay Full Amount</div>
					<div class="payFullItem fontBold"><span class="defaultCurencyPay"></span> 18,792</div>
				</label>
			</div>
			<div class="payPartBox">
				<label>
					<div class="flexCenter"><input type="radio" id="" name="amount" value="fullamt">Book now pay later</div>
					<div class="payFullItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</label>
				<!--<label>
					<div class="flexCenter" style="width: 200px"><input type="radio" id="" name="partamt" value="partamt">Balance 45 days before departure</div>
					<div class="payFullItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</label>-->
				<div class="payPartFlow"></div>
				<div class="payPartBalanceBox">
					<div class="flexCenter">
						<div class="payPartBalance">1</div>
						<div class="payPartBalanceInfo">Before 15 June 2022</div>
					</div>
					<div class="payPartBalanceItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
				<div class="payPartFlow"></div>
				<div class="payPartBalanceBox">
					<div class="flexCenter">
						<div class="payPartBalance">2</div>
						<div class="payPartBalanceInfo">Before 28 June 2022</div>
					</div>
					<div class="payPartBalanceItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
			</div>
			<div class="guestPayCont">
				<div class="guestPayBox">
					<div>
						<p class="guestPayItem">You Pay</p>
					</div>
					<div class="guestPayItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
				<div class="guestPayBox">
					<div>
						<p class="guestDueItem">Amount Due Later</p>
					</div>
					<div class="guestDueItem"><span class="defaultCurencyPay"></span> 18,792</div>
				</div>
				<div class="guestConfBox">
					<span><i class="fa fa-check" aria-hidden="true"></i></span>
					<p class="guestAcceptance">By proceeding, I confirm that I have read the Cancellation Policy, User Agreement, Terms of Service and Privacy Policy of TheWorldGateway</p>
				</div>
			<div>
				<button type="button" class="btnMain btnProceed" id="">Proceed to Payments</button>
			</div>
			</div>
		</div>
		<!--Sidebar ends-->
	</div>
</div>
</section>
<!--Add Traveller Info Starts-->
@include('cms.testingblade.bookingpaymentreview.addtraveller')
<!--Add Traveller Info Ends-->
<script type="text/javascript">
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("addModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("btnCloseModal")[0];
var span = document.getElementsByClassName("btnCancel")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script type="text/javascript">
//Add Passport No Validation-Pop up
function EnableDisable(passportnumber) {
	var psptnumber = document.getElementById("passportnumber");
	var psptcountry = document.getElementById("passportcountry");
	var psptexpirydate = document.getElementById("passportexpirydate");
	var validpsptmsg = document.getElementById('validpassport');
	
	if (psptnumber.value.trim() != "") {
		//Enable the TextBox when TextBox has value.
		psptcountry.disabled = false;
		psptexpirydate.disabled = false;
		psptcountry.style.borderColor = 'red';
		psptexpirydate.style.borderColor = 'red';
		<!--ADD VALIDATION: IF DATA LENGTH LESS THAN 2 CHARACTERS THEN ONLY MESSAGE APPEARED AND VICE VERSA-->
		validpsptmsg.innerHTML = 'Please enter a valid passport number';
		validpsptmsg.style.color = 'red';
		} else {
			//Disable the TextBox when TextBox is empty.
			psptcountry.disabled = true;
			psptexpirydate.disabled = true;
			psptcountry.style.borderColor = '#9b9b9b';
			psptexpirydate.style.borderColor = '#9b9b9b';
			validpsptmsg.innerHTML = '';
			}
    };
</script>
@endsection