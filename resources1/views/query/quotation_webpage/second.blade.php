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
/*Desktop Quote Page*/
.tourQuoteRefCont {
    background-color: #fff;
    border: 1px solid #CED0D4;
    border-radius: 10px 10px 0px 0px;
    padding: 20px 0px 0px 25px;
    margin: 0px;
	}
.tourQuoteRefHeading {
    font-size: 20px;
    line-height: 20px;
    color: #4A4A4A;
    font-weight: 600;
    margin-bottom: 20px;
	}
.tourQuoteRefCont > ul > li {
    background: #fff;
    font-size: 18px;
    line-height: 18px;
    font-weight: 600;
    color: #CED0D4;
    text-transform: capitalize;
    padding: 20px 25px;
    cursor: pointer;
    flex-shrink: 0;
    outline: 0;
	}
.tourQuoteRefCont > ul > li.active, .tourQuoteRefCont > ul > li:hover {
	color: #008cff;
	border-bottom: 2px solid #008cff;
	}
.tabcontent {
	display: none;
	}
.tourQuoteWebHeadCont {
	border: 1px solid #CED0D4;
    border-top: 0;
    padding: 25px 25px 0;
    border-radius: 0px 0px 10px 10px;
    background: #ffffff;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 26px;
    color: #000001;
    font-weight: 500;
	}
/*Tour Quote Summary*/
.tourQuoteSummaryCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #ffffff;
    margin-bottom: 10px;
	}
.tourQuoteTitle {
    font-size: 24px;
    line-height: 26px;
    color: #000000;
    font-weight: 600;
    text-align: left;
	margin-bottom: 15px;
	}
.tourQuoteDaysBadge {
    font-size: 18px;
    line-height: 20px;
    color: #9B9B9B;
	font-weight: 600;
    text-align: left;
    margin-bottom: 25px;
	}
.touQuoteBookCont {
	display: flex;
	align-items: flex-end;
	justify-content: space-between;
	}
.touQuoteBookFooterCont {
	margin: 20px 0;
	display: flex;
	align-items: center;
	justify-content: end;
	}
.tourQuoteServiceTitle {
    color: #4A4A4A;
    font-size: 12px;
    line-height: 12px;
    font-weight: 600;
    margin-bottom: 11px;
	text-align: left
	}
.btnRaiseConcern {
	flex-shrink: 0;
	outline: 0;
	text-transform: uppercase;
	background: transparent;
	border: 0;
    border-radius: 35px;
	padding: 12px;
    font-size: 17px;
	line-height: 21px;
	color: #CED0D4;
	font-weight: 600;
	cursor: pointer;
	margin-bottom: 0;
	margin-right: 20px;
	}
.btnRaiseConcern:hover {
	background-color: transparent;
	color: #CED0D4;
	}
.rejectionReasonCont {
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	display: inline-block;
	}
.rejectionReasonCont > ul > li {
	display: flex;
    align-items: center;
    padding: 10px 15px;
	}
.rejectionReasonCont > ul > li:hover {
	background-color: #f2f2f2;
	}
.rejectionLabel {
	font-size: 14px;
    line-height: 14px;
    color: #4a4a4a !important;
    font-weight: 600;
    display: flex;
    align-items: center;
	margin-right: 0px !important;
	margin-bottom: 0px !important;
	}
.rejectionInput {
	width: 13px;
    height: 13px;
    margin-right: 5px !important;
    margin-top: 0px !important;
	}
.btnPayBook {
	flex-shrink: 0;
	outline: 0;
	text-transform: uppercase;
	background: #008cff;
	border: 0;
    border-radius: 25px;
	padding: 0 40px;
    font-size: 18px;
	line-height: 20px;
	color: #fff;
	font-weight: 900;
	cursor: pointer;
	height: 44px;
	}
.btnPayBook:hover {
	background-color: #008cff;
	color: #fff;
	}
/*Tour Quote Pricing Section*/
.tourQuoteDatePricingCont {
    border: 1px solid #CED0D4;
    padding: 25px 40px;
    border-radius: 10px;
    background: #fff;
    margin-bottom: 10px;
	}
.tourQuoteCityBox {
	padding: 25px;
	border-radius: 5px;
	box-shadow: 0px 3px 6px #CED0D4;
	margin-right: 40px;
	width: 360px;
	max-height: 235px;
	display: flex;
    flex-direction: column;
    align-items: flex-start;
    flex-grow: 1;
	flex-shrink: 1;
	}
.tourQuoteCityBoxHead {
	font-size: 14px;
	line-height: 14px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.tourQuoteCityName {
	font-size: 18px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.tourQuoteDateBox {
	padding: 25px;
	border-radius: 5px;
	box-shadow: 0px 3px 6px #CED0D4;
	margin-right: 40px;
	width: 360px;
	max-height: 235px;
	display: flex;
    flex-direction: column;
    align-items: flex-start;
    flex-grow: 1;
	flex-shrink: 1;
	}
.tourQuoteDateBoxHead {
	font-size: 14px;
	line-height: 14px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.tourQuoteDepDate, .tourQuoteRetDate {
	font-size: 18px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.tourQuotePriceBox {
	padding: 25px;
	border-radius: 5px;
	box-shadow: 0px 3px 6px #CED0D4;
	width: 400px;
	display: flex;
    flex-direction: column;
    align-items: stretch;
    flex-grow: 1;
	flex-shrink: 1;
	}
.tourQuoteDefaultCurency:before {
	content: '\0020B9';
	font-size: 14px;
	line-height: 1px;
	font-weight: 500;
	}
.tourQuotePriceBoxSubHead {
    font-size: 15px;
    line-height: 15px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 0;
	}	
.tourQuotePriceValue {
    font-size: 18px;
    line-height: 20px;
    color: #000001;
    font-weight: 600;
    text-align: right;
    margin-bottom: 0;
	}
.tourQuotePriceSeparator {
	border-top: 1px solid #ccc;
	margin: 20px 0;
	}
.tourQuotePriceTotal {
    font-size: 18px;
    line-height: 20px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 5px;
	}
.tourQuotePriceTagline {
    font-size: 11px;
    line-height: 12px;
    color: #9b9b9b;
    font-weight: 500;
    text-align: left;
    margin-bottom: 0;
	}
.tourQuotePriceTotalValue {
    font-size: 21px;
    line-height: 23px;
    color: #000001;
    font-weight: 600;
    text-align: right;
    margin-bottom: 0;
	}
.tourQuoteValidity {
    font-size: 12px;
    line-height: 12px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: right;
	margin-top: 10px;
    text-transform: uppercase;
	display: flex;
	justify-content: flex-end;
	}
/*Tour Flight*/
.tourQuoteFlightCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #ffffff;
    margin-bottom: 10px;
	}
.tourQuoteFlightHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.tourQuoteOnwardFlightBox {
	margin: 0 15px 25px;
	}
.tourQuoteReturnFlightBox, .tourQuoteTransportBox {
	margin: 0 15px 0;
	}
.flightCityName {
	font-size: 14px;
	line-height: 17px;
	color: #4a4a4a;
	font-weight: 600;
	margin-bottom: 0;
	text-align: left;
	}
.transportDesc {
	font-size: 16px;
	line-height: 24px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.onwardFlightBox, .returnFlightBox {
    border: 1px solid #e7e7e7;
    padding: 15px 25px 20px;
    border-radius: 5px;
    background: #F9F9F9;
	}
.airlineLogoBox {
    width: 42px;
    height: auto;
    overflow: hidden;
    margin: 0;
    border-radius: 3px;
    display: flex;
    flex-shrink: 0;
	}
.airlineLogo {
    height: 42px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.flightName {
	font-size: 14px;
	line-height: 17px;
	color: #4a4a4a;
	font-weight: 600;
	margin-bottom: 0;
	text-align: left;
	}
.flightNumber {
	font-size: 14px;
	line-height: 17px;
	color: #4a4a4a;
	font-weight: 500;
	margin-bottom: 0;
	text-align: left;
	}
.flightDate {
	font-size: 18px;
	line-height: 18px;
	color: #000001;
	font-weight: 600;
	}
.flightStop, .flightClass {
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 400;
	}
.flightTiming {
	font-size: 18px;
	line-height: 22px;
	color: #000001;
	font-weight: 600;
	margin-bottom: 0;
	text-align: center;
	}
.flightCity {
	font-size: 14px;
	line-height: 17px;
	color: #000001;
	font-weight: 600;
	margin-bottom: 0;
	text-align: center;
	}
.flightDurationCont {
	margin: 0 30px;
	}
.flightDuration {
	font-size: 12px;
	line-height: 12px;
	color: #4a4a4a;
	font-weight: 400;
	text-align: center;
	margin-bottom: 0;
	}
.flightPathWay {
	margin: 6px 5px;
	border-top: 1px solid #ccc;
	width: 225px;
	}
.fa-plane:before {
	content: "\f072";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
	color: #4a4a4a;
	font-size: 18px;
	cursor: unset;
	margin-top: 3px;
	margin-right: 0;
	transform: rotate(45deg)
	}
.fa-map-marker:before {
	content: "\f041";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
	color: #4a4a4a;
	font-size: 18px;
	cursor: unset;
	}
.baggageTitle {
	font-size: 14px;
	line-height: 17px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	border-top: 1px solid #E7E7E7;
	margin: 20px 0px 5px;
	padding-top: 15px;
	}
.baggageSubTitle {
	font-size: 12px;
	line-height: 12px;
	font-weight: 600;
	margin-bottom: 0;
	text-align: left;
	}
.classSeparator {
	border-right: 2px solid #ccc;
	height: 18px;
	margin: 0px 10px;
	}
.baggageSeparator {
	border-right: 2px solid #ccc;
	height: 16px;
	margin: 0px 5px;
	}
/*Tour Transfers*/
.tourQuoteTransferCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #ffffff;
    margin-bottom: 10px;
	}
.tourQuoteTransferHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.tourQuoteTransferBox {
	margin: 0 15px 25px;
	}
.tourQuoteTransferBox:last-child {
	margin-bottom: 0;
	}
.tourQuoteTransferTitle {
	font-size: 16px;
	line-height: 17px;
	color: #4A4A4A;
	font-weight: 600;
	margin-bottom: 10px;
	}
.tourQuoteTransferDescBox {
    border: 1px solid #e7e7e7;
    padding: 25px;
    border-radius: 5px;
    background: #F9F9F9;
	}
.transferImageBox {
    width: 270px;
    height: auto;
    overflow: hidden;
    margin: 0;
    border-radius: 5px;
    display: flex;
    flex-shrink: 0;
	margin-right: 25px;
	}
.transferImageType {
    height: 140px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.transferDescTopSection {
	margin-bottom: 55px;
	}
.transferTitle {
	font-size: 15px;
	line-height: 15px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 10px;
	}
.transportType {
	font-size: 20px;
	line-height: 24px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.transferVehicleCont, .transferDurationCont {
	width: 150px;
	margin-right: 40px;
	}
.transferHead {
	font-size: 12px;
	line-height: 17px;
	color: #9B9B9B;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.transferSubHead {
	font-size: 14px;
	line-height: 17x;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
/*Tour Accommodation*/
.tourQuoteHotelCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #ffffff;
    margin-bottom: 10px;
	}
.tourQuoteHotelHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.tourQuoteHotelDescBox {
    border: 1px solid #e7e7e7;
    padding: 25px;
    border-radius: 5px;
    background: #F9F9F9;
	}
.tourQuoteHotelTitle {
    font-size: 16px;
    line-height: 17px;
    color: #4A4A4A;
    font-weight: 600;
    margin-bottom: 10px;
	}
.tourQuoteHotelBox {
    margin: 0 15px 25px;
	}
.tourQuoteHotelBox:last-child {
	margin-bottom: 0;
	}
.tourQuoteHotelDescBox {
    border: 1px solid #e7e7e7;
    padding: 25px;
    border-radius: 5px;
    background: #F9F9F9;
	}
.hotelImageBox {
    width: 220px;
    height: auto;
    overflow: hidden;
    margin: 0;
    border-radius: 5px;
    display: flex;
    flex-shrink: 0;
    margin-right: 25px;
	}
.hotelImageType {
    height: 180px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.hotelDescBox {
    display: flex;
    flex-direction: column;
    flex-shrink: 1;
    flex-grow: 0;
	}
.hotelTopSection {
    margin-bottom: 25px;
	}
.hotelType {
    display: inline-block;
    font-size: 12px;
    line-height: 12px;
    color: #fff;
    font-weight: 600;
    padding: 4px 6px;
    background: #6A11CB;
    border: 1px solid #707070;
    border-radius: 3px;
    text-transform: capitalize;
    margin-bottom: 5px;
	}
.hotelName {
    font-size: 20px;
    line-height: 22px;
    color: #000000;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
    margin-right: 5px;
	}
.hotelFooter {
    margin-bottom: 0;
	}
.hotelDaysBadge, .hotelRoomCont {
	width: 150px;
	margin-right: 200px;
    display: flex;
    flex-direction: column;
	}
.hotelWebCont {
    display: flex;
    flex-direction: column;
	}
.hoteDaysBadge_heading, .hotelRoomCont_heading, .hotelWebCont_heading {
    font-size: 12px;
    line-height: 14px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: left;
	margin-bottom: 3px;
	}
.hotelDaysBadge_nightCount, .hotelRoomCont_type, .hotelWebCont_name {
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 600;
    text-align: left;
	margin-bottom: 0;
	}
.hotelCheckInOut {
    display: flex;
    flex-direction: column;
	}
.hotelCheckInCont {
    display: flex;
	margin-bottom: 3px;
	}
.hotelCheckOutCont {
    display: flex;
	}	
.hotelCheckInCont_heading, .hotelCheckOutCont_heading {
    font-size: 12px;
    line-height: 14px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: left;
	margin-bottom: 1px;
	width: 70px;
	margin-right: 10px;
	}
.hotelCheckInCont_date, .hotelCheckOutCont_date {
    font-size: 14px;
    line-height: 14px;
    color: #4a4a4a;
    font-weight: 600;
    text-align: left;
    margin-bottom: 0;
	}
.hotelRoomDtls {
    display: flex;
    flex-direction: column;
	}
/*Tour Itinerary*/
.tourQuoteItineraryCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #ffffff;
    margin-bottom: 10px;
	}
.tourQuoteItineraryHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.tourQuoteItineraryBox {
    margin: 0 15px;
	display: flex;
	flex-direction: column;
	}
.tourQuoteLeftBorderMarker {
    margin-right: 10px;
    border-left: 2px solid #33D18F;
    height: 45px;
	}
.tourQuoteDayPlanHead {
    font-size: 16px;
    line-height: 19px;
    color: #000001;
    font-weight: 600;
    margin-bottom: 3px;
    text-align: left;
	}
.tourQuoteDayPlanSubHead {
    font-size: 14px;
    line-height: 17px;
    color: #707070;
    font-weight: 500;
    margin-bottom: 5px;
    text-align: left;
	}
.tourQuoteItinerarySeparator {
	margin: 10px 15px 20px;
	border-top: 5px solid #f9f9f9;
	}
.tourQuoteItinerarySeparator:last-child {
	margin: 0;
	border-top: 0;
	}
/*Tour Inclusions & Exclusions*/
.tourQuoteIncBox, .tourQuoteOverviewBox {
    margin: 0 15px;
	font-size: 14px;
    line-height: 20px;
    color: #4a4a4a;
    font-weight: 500;
    text-align: left;
	display: flex;
	flex-direction: column;
	}
.tourQuoteInclusionHeading, .tourQuoteExclusionHeading {
    font-size: 16px;
    line-height: 19px;
    color: #000001;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	padding-bottom: 10px;
    border-bottom: 1px solid #e7e7e7;
	}
.tourQuoteUnlistedItem ul {
	list-style: inside;
	}
.tourQuoteUnlistedItem ul li {
	margin-top: 0 !important;
    border-top: 0 !important;
    padding-top: 0 !important;
	}
	
.tourQuoteInclusions {
    margin-top: 0;
	}
.tourQuoteExclusions {
    margin-top: 25px;
	}
.tourQuoteInclusions ul, .tourQuoteExclusions ul {
    list-style: inside;
	}
.tourQuoteInclusions ul li:first-child, .tourQuoteExclusions ul li:first-child {
    margin-top: 0;
    border-top: 0;
    padding-top: 0;
	}
/*Tour Visa*/
.tourQuoteVisaPolicyCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #ffffff;
    margin-bottom: 10px;
	}
.tourQuoteVisaPolicyHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.tourQuoteVisaPolicyBox {
    margin: 0 15px;
	font-size: 14px;
    line-height: 20px;
    color: #4a4a4a;
    font-weight: 500;
    text-align: left;
	display: flex;
	flex-direction: column;
	}
.tourQuoteVisaHeading{
    font-size: 16px;
    line-height: 19px;
    color: #000001;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	}
.tourQuoteVisa {
    margin-top: 0;
	}
.tourQuoteVisa ul {
    list-style: inside;
	}
.tourQuoteVisa ul li:first-child {
    margin-top: 10px;
    border-top: 1px solid #e7e7e7;
    padding-top: 10px;
	}
.tourQuoteVisaAddPolicy {
	margin: 15px 0 0;
	padding: 5px 10px;
	font-size: 14px;
	line-height: 20px;
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	}
.tourQuoteVisaPolicySeparator {
	margin: 20px 0;
	border-top: 5px solid #f9f9f9;
	}
.tourQuoteVisaPolicySeparator:last-child {
	margin: 0;
	border-top: 0;
	}
/*Tour Booking & Cancellation*/
.tourQuoteBookPolicyCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #ffffff;
    margin-bottom: 10px;
	}
.tourQuoteBookPolicyHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.tourQuoteBookPolicyBox {
    margin: 0 15px;
	font-size: 14px;
    line-height: 20px;
    color: #4a4a4a;
    font-weight: 500;
    text-align: left;
	display: flex;
	flex-direction: column;
	}
.tourQuoteBookHeading, .tourQuoteCancelHeading {
    font-size: 16px;
    line-height: 19px;
    color: #000001;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	}
.tourQuoteBooking {
    margin-top: 0;
	}
.tourQuoteCancellation {
    margin-top: 25px;
	}
.tourQuoteBooking ul, .tourQuoteCancellation ul {
    list-style: inside;
	}
.tourQuoteBooking ul li:first-child, .tourQuoteCancellation ul li:first-child {
    margin-top: 10px;
    border-top: 1px solid #e7e7e7;
    padding-top: 10px;
	}
.tourQuoteBookAddPolicy, .tourQuoteCancelAddPolicy {
	margin: 15px 0 0;
	padding: 5px 10px;
	font-size: 14px;
	line-height: 20px;
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	}
.tourQuoteBookPolicySeparator {
	margin: 10px 0;
	border-top: 5px solid #f9f9f9;
	display: none;
	}
/*Tour Imp Notes*/
.tourQuoteImpCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #ffffff;
    margin-bottom: 10px;
	}
.tourQuoteImpHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.tourQuoteImpBox {
    margin: 0 15px;
	display: flex;
	flex-direction: column;
	}
.tourQuoteImpHeading {
    font-size: 16px;
    line-height: 19px;
    color: #000001;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	}
.tourQuoteImp {
    margin-top: 0;
	font-size: 14px;
    line-height: 20px;
    color: #4a4a4a;
    font-weight: 500;
    text-align: left;
	}
.tourQuoteImp ul {
    list-style: inside;
	}
.tourQuoteImp ul li:first-child {
    margin-top: 10px;
    border-top: 1px solid #e7e7e7;
    padding-top: 10px;
	}
.tourQuoteImpAddPolicy {
	margin: 15px 0 0;
	padding: 5px 10px;
	font-size: 14px;
	line-height: 20px;
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	}
.tourQuoteImpSeparator {
	margin: 10px 0;
	border-top: 5px solid #f9f9f9;
	display: none;
	}
/*Footer*/
.tourQuoteFooterCont {
    border: 1px solid #CED0D4;
    padding: 25px;
    border-radius: 10px;
    background: #fff;
	}

/*Mobile Page*/
/*Quote Page*/
.paddingTop3 {
	padding-top: 3px;
	}
.mtourQuoteRefCont {
    background-color: #fff;
    /*border-bottom: 1px solid #CED0D4;*/
    padding: 15px;
	}
.mtourQuoteRefHeading {
    font-size: 20px;
    line-height: 20px;
    color: #4A4A4A;
    font-weight: 600;
    margin-bottom: 0;
	}
.mtourQuoteTabCont {
	background-color: #fff;
    border-bottom: 1px solid #CED0D4;
    /* padding: 20px 0px 0px 25px; */
    /* margin: 0 15px; */
    padding: 0 15px;
	}
.mtourQuoteTabCont > ul > li {
    background: #fff;
    font-size: 18px;
    line-height: 18px;
    font-weight: 600;
    color: #CED0D4;
    text-transform: capitalize;
    padding: 15px;
    flex-shrink: 0;
    outline: 0;
	}
.mtourQuoteTabCont > ul > li.active, .tourQuoteRefCont > ul > li:hover {
	color: #008cff;
	border-bottom: 2px solid #008cff;
	}
.tabcontent {
	display: none;
	}
.mtourQuoteWebHeadCont {
    padding: 15px 15px 0;
    background: #fff;
    font-size: 14px;
    line-height: 20px;
    color: #000001;
    font-weight: 500;
	margin-bottom: 10px;
	}
/*Mobile Tour Quote Summary*/
.mtourQuoteSummaryCont {
    padding: 15px;
    background: #fff;
	margin-bottom: 10px;
	}
.mtourQuoteTitle {
    font-size: 24px;
    line-height: 26px;
    color: #000000;
    font-weight: 600;
    text-align: left;
	margin-bottom: 10px;
	}
.mtourQuoteDaysBadge {
    font-size: 16px;
    line-height: 20px;
    color: #4a4a4a;
	font-weight: 600;
    text-align: left;
    margin-bottom: 25px;
	}
.mtouQuoteBookCont {
	display: flex;
	flex-direction: column;
	}
.mtourQuoteServiceTitle {
    color: #4A4A4A;
    font-size: 12px;
    line-height: 12px;
    font-weight: 600;
	text-align: left
	margin-bottom: 10px;
	}
/*Tour Quote Pricing Section*/
.mtourQuoteDatePricingCont {
    padding: 15px;
    background: #fff;
    margin-bottom: 10px;
	}
.mtourQuoteCityBox {
	padding: 25px;
	border-radius: 5px;
	box-shadow: 0px 3px 6px #CED0D4;
	width: 100%;
	min-height: 120px;
	display: flex;
    flex-direction: column;
    align-items: flex-start;
    flex-grow: 1;
	flex-shrink: 1;
	margin-bottom: 10px;
	}
.mtourQuoteCityBoxHead {
	font-size: 14px;
	line-height: 14px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.mtourQuoteCityName {
	font-size: 18px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mtourQuoteDateBox {
	padding: 25px;
	border-radius: 5px;
	box-shadow: 0px 3px 6px #CED0D4;
	margin-right: 40px;
	width: 100%;
	min-height: 120px;
	display: flex;
    flex-direction: column;
    align-items: flex-start;
    flex-grow: 1;
	flex-shrink: 1;
	margin-bottom: 10px;
	}
.mtourQuoteDateBoxHead {
	font-size: 14px;
	line-height: 14px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.mtourQuoteDepDate, .mtourQuoteRetDate {
	font-size: 18px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mtourQuotePriceBox {
	padding: 25px;
	border-radius: 5px;
	box-shadow: 0px 3px 6px #CED0D4;
	width: 100%;
	min-height: 120px;
	display: flex;
    flex-direction: column;
    align-items: stretch;
    flex-grow: 1;
	flex-shrink: 1;
	margin-bottom: 0;
	}
.mtourQuoteDefaultCurency:before {
	content: '\0020B9';
	font-size: 14px;
	line-height: 1px;
	font-weight: 500;
	}
.mtourQuotePriceBoxSubHead {
    font-size: 15px;
    line-height: 15px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 0;
	}	
.mtourQuotePriceValue {
    font-size: 18px;
    line-height: 20px;
    color: #000001;
    font-weight: 600;
    text-align: right;
    margin-bottom: 0;
	}
.mtourQuotePriceSeparator {
	border-top: 1px solid #ccc;
	margin: 20px 0;
	}
.mtourQuotePriceTotal {
    font-size: 18px;
    line-height: 20px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 5px;
	}
.mtourQuotePriceTagline {
    font-size: 11px;
    line-height: 12px;
    color: #9b9b9b;
    font-weight: 500;
    text-align: left;
    margin-bottom: 0;
	}
.mtourQuotePriceTotalValue {
    font-size: 21px;
    line-height: 23px;
    color: #000001;
    font-weight: 600;
    text-align: right;
    margin-bottom: 0;
	}
.mtourQuoteValidity {
    font-size: 12px;
    line-height: 12px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: right;
	margin-top: 10px;
    text-transform: uppercase;
	display: flex;
	justify-content: flex-end;
	}
/*Tour Flight*/
.mtourQuoteFlightCont {
    padding: 15px;
    background: #fff;
    margin-bottom: 10px;
	}
.mtourQuoteFlightHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.mtourQuoteOnwardFlightBox {
	margin: 0 0 20px;
	}
.mtourQuoteReturnFlightBox, .mtourQuoteTransportBox {
	margin: 0;
	}
.mflightCityName {
	font-size: 15px;
	line-height: 17px;
	color: #4a4a4a;
	font-weight: 600;
	margin-bottom: 0;
	text-align: left;
	}
.mtransportDesc {
	font-size: 16px;
	line-height: 24px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.monwardFlightBox, .mreturnFlightBox {
    border: 1px solid #e7e7e7;
    padding: 15px;
    border-radius: 5px;
    background: #F9F9F9;
	}
.mairlineLogoCont {
	display: flex;
	flex-direction: column;
	align-items: center;
	margin-right: 5%;
	}
.mairlineLogoBox {
    width: 32px;
    height: auto;
    overflow: hidden;
    margin: 0;
    border-radius: 3px;
    display: flex;
    flex-shrink: 0;
	/*margin-right: 5px;*/
	}
.mairlineLogo {
    height: 32px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.mflightDtlsBox {
	display: flex;
	flex-direction: column;
	}
.mflightName {
	font-size: 11px;
	line-height: 13px;
	color: #4a4a4a;
	font-weight: 600;
	margin-bottom: 0;
	text-align: left;
	}
.mflightNumber {
	font-size: 11px;
	line-height: 13px;
	color: #4a4a4a;
	font-weight: 500;
	margin-bottom: 0;
	text-align: left;
	}
.mflightDepBox, .mflightArrBox {
	width: 80px;
	}
.mflightTiming {
	font-size: 18px;
	line-height: 22px;
	color: #000001;
	font-weight: 600;
	margin-bottom: 0;
	text-align: center;
	}
.mflightCity {
	font-size: 14px;
	line-height: 17px;
	color: #000001;
	font-weight: 600;
	margin-bottom: 0;
	text-align: center;
	}
.mflightDate {
	font-size: 18px;
	line-height: 18px;
	color: #000001;
	font-weight: 600;
	}
.mflightStop, .mflightClass {
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 400;
	}
.mclassSeparator {
	border-right: 2px solid #ccc;
	height: 18px;
	margin: 0px 10px;
	}
.mflightDurationCont {
	margin: 0 5%;
	width: 100%;
	}
.mflightDuration {
	font-size: 12px;
	line-height: 12px;
	color: #4a4a4a;
	font-weight: 400;
	text-align: center;
	margin-bottom: 0;
	}
.mflightPathWay {
	margin: 6px 5px;
	border-top: 1px solid #ccc;
	width: 70px;
	flex-grow: 1;
	}
.fa-plane:before {
	content: "\f072";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
	color: #4a4a4a;
	font-size: 18px;
	cursor: unset;
	margin-top: 3px;
	margin-right: 0;
	transform: rotate(45deg)
	}
.fa-map-marker:before {
	content: "\f041";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
	color: #4a4a4a;
	font-size: 18px;
	cursor: unset;
	}
.mbaggageTitle {
	font-size: 14px;
	line-height: 17px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	border-top: 1px solid #E7E7E7;
	margin: 10px 0px 5px;
	padding-top: 10px;
	}
.mbaggageSubTitle {
	font-size: 12px;
	line-height: 12px;
	font-weight: 600;
	margin-bottom: 0;
	text-align: left;
	}
.mbaggageSeparator {
	border-right: 2px solid #ccc;
	height: 16px;
	margin: 0px 5px;
	}
/*Mobile Tour Transfers*/
.mtourQuoteTransferCont {
    padding: 15px;
    background: #fff;
    margin-bottom: 10px;
	}
.mtourQuoteTransferHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.mtourQuoteTransferBox {
	margin: 0;
	}
.mtourQuoteTransferBox:last-child {
	margin-bottom: 0;
	}
.mtourQuoteTransferTitle {
	font-size: 16px;
	line-height: 17px;
	color: #4A4A4A;
	font-weight: 600;
	margin-bottom: 10px;
	}
.mtourQuoteTransferDescBox {
    border: 1px solid #e7e7e7;
    padding: 15px;
    border-radius: 5px;
    background: #F9F9F9;
	}
.mtransferImageBox {
    width: 100%;
    height: auto;
    overflow: hidden;
    border-radius: 5px;
	margin-bottom: 10px;
	}
.mtransferImageType {
    height: 140px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
	}
.mtransferDescTopSection {
	margin-bottom: 20px;
	}
.mtransferTitle {
	font-size: 15px;
	line-height: 15px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 5px;
	}
.mtransportType {
	font-size: 20px;
	line-height: 24px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.mtransferVehicleCont, .mtransferDurationCont {
	margin-right: 0;
	}
.mtransferHead {
	font-size: 12px;
	line-height: 17px;
	color: #9B9B9B;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mtransferSubHead {
	font-size: 14px;
	line-height: 17x;
	color: #4a4a4a;
	font-weight: 600;
	text-align: right;
	margin-bottom: 0;
	}
/*Mobile Tour Accommodation*/
.mtourQuoteHotelCont {
    padding: 15px;
    background: #fff;
    margin-bottom: 10px;
	}
.mtourQuoteHotelHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.mtourQuoteHotelDescBox {
    border: 1px solid #e7e7e7;
    padding: 25px;
    border-radius: 5px;
    background: #F9F9F9;
	}
.mtourQuoteHotelTitle {
    font-size: 16px;
    line-height: 17px;
    color: #4A4A4A;
    font-weight: 600;
    margin-bottom: 7px;
	}
.mtourQuoteHotelBox {
    margin-bottom: 15px;
	}
.mtourQuoteHotelBox:last-child {
	margin-bottom: 0;
	}
.mtourQuoteHotelDescBox {
    border: 1px solid #e7e7e7;
    padding: 15px;
    border-radius: 5px;
    background: #fff;
	}
.mhotelImageBox {
    /*width: 100%;*/
    height: auto;
    overflow: hidden;
    margin: 0;
    border-radius: 5px;
    display: flex;
    flex-shrink: 0;
	margin-bottom: 10px;
	}
.mhotelImageType {
    height: 180px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.mhotelDescBox {
    display: flex;
    flex-direction: column;
    flex-shrink: 1;
    flex-grow: 0;
	}
.mhotelTopSection {
    margin-bottom: 20px;
	}
.mhotelType {
    display: inline-block;
    font-size: 12px;
    line-height: 12px;
    color: #fff;
    font-weight: 600;
    padding: 4px 8px;
    background: #6A11CB;
    border: 1px solid #707070;
    border-radius: 3px;
    text-transform: capitalize;
    margin-bottom: 5px;
	}
.mtourHotelDtls {
    margin-bottom: 0;
	}
.mhotelName {
    font-size: 18px;
    line-height: 20px;
    color: #000001;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	}
.mhotelStarRating {
    margin-bottom: 10px;
	}
.mhotelStarRating img {
    margin-top: 0 !important;
    width: 14px !important;
    height: 14px;
    margin-right: 3px;
    vertical-align: middle;
    border: 0;
    pointer-events: none !important;
	}
.mhotelCityName {
    font-size: 14px;
    line-height: 16px;
	color: #4a4a4a;
    font-weight: 600;
	}
.mhotelFooter {
    margin-bottom: 0;
	}
.mhotelDaysBadge, .mhotelRoomCont {
    display: flex;
    flex-direction: column;
	}
.mhotelWebCont {
    display: flex;
    flex-direction: column;
	border-top: 1px solid #e7e7e7;
	padding-top: 15px;
	margin-top: 15px;
	}
.mhotelDaysBadge_heading {
    font-size: 12px;
    line-height: 14px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: right;
	margin-bottom: 1px;
	}
.mhotelRoomCont_heading, .mhotelWebCont_heading {
    font-size: 12px;
    line-height: 14px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: left;
	margin-bottom: 1px;
	}
.mhotelDaysBadge_nightCount {
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 600;
    text-align: right;
	margin-bottom: 0;
	}
.mhotelRoomCont_type, .mhotelWebCont_name {
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 600;
    text-align: left;
	margin-bottom: 0;
	}
.mhotelCheckInOut {
    display: flex;
    justify-content: space-between;
	}
.mhotelCheckInCont {
    display: flex;
	flex-direction: column;
	margin-bottom: 3px;
	}
.mhotelCheckOutCont {
    display: flex;
	flex-direction: column;
	}	
.mhotelCheckInCont_heading {
    font-size: 12px;
    line-height: 14px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: left;
	margin-bottom: 1px;
	}
.mhotelCheckOutCont_heading {
    font-size: 12px;
    line-height: 14px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: right;
	margin-bottom: 1px;
	}
.mhotelCheckInCont_date, .mhotelCheckOutCont_date {
    font-size: 14px;
    line-height: 14px;
    color: #4a4a4a;
    font-weight: 600;
    text-align: left;
    margin-bottom: 0;
	}
.mhotelCheckOutCont_date {
    font-size: 14px;
    line-height: 14px;
    color: #4a4a4a;
    font-weight: 600;
    text-align: right;
    margin-bottom: 0;
	}
.mhotelRoomDtls {
    display: flex;
    flex-direction: column;
	}
/*Mobile Tour Itinerary*/
.mtourQuoteItineraryCont {
    padding: 20px 15px 0 15px;
    background: #fff;
    margin-bottom: 0;
	border-bottom: 1px solid #e7e7e7;
	}
.mtourQuoteItineraryHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    padding-bottom: 20px;
	display: flex;
	align-items: center;
	}
.mtourQuoteItineraryBox {
    margin-left: 10px;
	/*display: flex;
	flex-direction: column;*/
	}
.mtourQuoteLeftBorderMarker {
    margin-right: 10px;
    border-left: 2px solid #33D18F;
    height: 60px;
	}
.mtourQuoteDayPlanHead {
    font-size: 16px;
    line-height: 19px;
    color: #000001;
    font-weight: 600;
    margin-bottom: 3px;
    text-align: left;
	}
.mtourQuoteDayPlanSubHead {
    font-size: 14px;
    line-height: 17px;
    color: #707070;
    font-weight: 500;
    margin-bottom: 5px;
    text-align: left;
	}
.mtourQuoteDayPlanSubHeadMore {
    font-size: 12px;
    line-height: 15px;
    color: #008cff;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	}
.mtourQuoteItryDtls {
    font-size: 14px;
    line-height: 16px;
    color: #008cff;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	}
.mtourDtlsCont {
	display: flex;
	align-items: center;
	padding: 10px 0 20px 12px;
	}
.mfoldableArrow:after {
	font-family: FontAwesome;
	content: '\f106';
	color: #008cff;
	float: right;
	font-size: 28px;
	}
.mfoldableArrow:after {
	position: absolute;
    right: 15px;
	}
.mfoldableArrow.active:after {
	content: "\f107";
	}
.mfoldableContent {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
	}
.mtourQuoteDtlsDesc {
	margin-left: 10px;
	margin-right: 0;
	}
.mtourQuoteDtlsDesc > p {
    border-top: 1px solid #e7e7e7;
	font-size: 14px;
    line-height: 19px;
    color: #4a4a4a;
    padding: 10px 0 20px;
	margin-bottom: 0;
	}
.mtourQuoteDtlsDescSeparator {
	margin: 0 0 15px;
	border-top: 2px solid #f2f2f2;
	}
/*Mobile Tour Inclusions & Exclusions*/
.mtourQuoteIncCont {
    padding: 20px 15px 0 15px;
    background: #fff;
    margin-bottom: 0;
	border-bottom: 1px solid #e7e7e7;
	}
.mtourQuoteIncHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    padding-bottom: 20px;
	display: flex;
	align-items: center;
	}
.mtourQuoteIncSubHead, .mtourQuoteExcSubHead {
    font-size: 16px;
    line-height: 19px;
    color: #4a4a4a;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	}
.mtourQuoteIncBox {
    margin-left: 10px;
	}
.mtourQuoteInclusions {
    margin-top: 0;
	}
.mtourQuoteExclusions {
    margin-top: 25px;
	margin-bottom: 15px;
	}
.mtourQuoteInclusions ul, .mtourQuoteExclusions ul {
    list-style: inside;
	}
.mtourQuoteInclusions ul li:first-child, .mtourQuoteExclusions ul li:first-child {
    margin-top: 10px;
    border-top: 1px solid #e7e7e7;
    padding-top: 10px;
	}
/*Mobile Tour Booking & Cancellation*/
.mtourQuoteBookPolicyCont {
    padding: 20px 15px 0 15px;
    background: #fff;
    margin-bottom: 0;
	border-bottom: 1px solid #e7e7e7;
	}
.tourQuoteBookPolicyHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 20px;
	}
.mtourQuoteBookPolicyBox {
    margin-left: 10px;
	}
.mtourQuoteBookHead, .mtourQuoteCanHead {
    font-size: 16px;
    line-height: 19px;
    color: #4a4a4a;
    font-weight: 600;
    margin-bottom: 0;
    text-align: left;
	}
.mtourQuoteBkngPolicy {
    margin-bottom: 10px;
	}
.mtourQuoteCnclPolicy {
	margin-bottom: 10px;
	}
.mtourQuoteBkngPolicy ul, .mtourQuoteCnclPolicy ul {
    list-style: inside;
	}
.mtourQuoteBkngPolicy ul li:first-child, .mtourQuoteCnclPolicy ul li:first-child {
    margin-top: 10px;
    border-top: 1px solid #e7e7e7;
    padding-top: 10px;
	}
.mtourQuoteBookAddPolicy, .mtourQuoteCancelAddPolicy {
	margin: 15px 0 15px;
	padding: 5px 10px;
	font-size: 14px;
	line-height: 20px;
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	}
.mtourQuoteBookPolicySeparator {
	margin: 10px 0;
	border-top: 5px solid #f9f9f9;
	display: none;
	}
/*Mobile Tour Policy*/
.mtourQuotePolicyHead {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    padding-bottom: 20px;
	display: flex;
	align-items: center;
	}
.mtourQuotePolicyBox {
    margin-left: 10px;
	}
.mtourQuotePolicy {
    margin-bottom: 10px;
	}
.mtourQuotePolicy ul {
    list-style: inside;
	}
.mtourQuotePolicy ul li:first-child {
    margin-top: 10px;
    border-top: 1px solid #e7e7e7;
    padding-top: 10px;
	}
.mtourQuoteAddPolicy {
	margin: 15px 0 15px;
	padding: 5px 10px;
	font-size: 14px;
	line-height: 20px;
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	}	
.mtourQuotePolicySeparator {
	margin: 10px 0;
	border-top: 5px solid #f9f9f9;
	display: none;
	}
/*Why Book with Us*/
.mtourQuoteBookUsCont {
    background: #ffff;
    margin-bottom: 0;
    padding: 15px;
	}
.mtourQuoteBookUsHeading {
    font-size: 18px;
    line-height: 22px;
    color: #070700;
    font-weight: 500;
    text-align: left;
    margin-bottom: 20px;
	}
.mtourQuoteBookUsIconBox {
    width: 34px;
    height: 34px;
    background: #fff;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
	flex-shrink: 0;
    padding: 0;
    margin-right: 10px;
	overflow: hidden;
	}
.mtourQuoteBookUsList {
    font-size: 14px;
    line-height: 18px;
    color: #4a4a4a;
    font-weight: 500;
    margin-bottom: 0;
	}
/*Mobile Footer*/
.mtourQuoteFooterCont {
    padding: 15px;
    background: #fff;
	}
.mtourQuotePriceBar {
    width: 100%;
    background: #000001;
    position: fixed;
    bottom: 0;
    z-index: 999;
	padding: 20px;
	}
.mtourQuotePriceBarBox {
	display: flex;
	justify-content: space-between;
	align-items: baseline;
	}
.mtourQuotePriceBoxCont {
	display: flex;
	align-items: baseline;
	flex-shrink: 0;
	}
.mtourQuoteValue {
    font-size: 20px;
    line-height: 24px;
    color: #fff;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	margin-right: 5px;
	}
.mtourQuotePriceBarCurency:before {
	content: '\0020B9';
	font-size: 18px;
	line-height: 1px;
	font-weight: 500;
	}
.mtourQuoteValueTagline {
    font-size: 10px;
    line-height: 12px;
    color: #CED0D4;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mtourQuotePriceLine {
    border-left: 1px solid #fff;
    height: 40px;
	position: absolute;
	margin-left: -5%;
	}
.btnBookMob {
	flex-shrink: 0;
	outline: 0;
	text-transform: uppercase;
	background: #01b7f2;
	border: 0;
    border-radius: 25px;
	padding: 10px 30px;
    font-size: 20px;
	line-height: 20px;
	color: #fff;
	font-weight: 900;
	cursor: unset;
	margin-bottom: 0;
	width: 100%;
	}
.mtouQuoteBookFooterCont {
	margin-bottom: 0;
	display: flex;
	align-items: center;
	justify-content: end;
	}
.mrejectionReasonCont {
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	display: inline-block;
	}
.mrejectionReasonCont > ul > li {
	display: flex;
    align-items: center;
    padding: 10px 15px;
	}
.mrejectionReasonCont > ul > li:hover {
	background-color: #f2f2f2;
	}
.btnRaiseConcernMob {
    flex-shrink: 0;
    outline: 0;
    text-transform: capitalize;
    background: transparent;
    border: 0;
    border-radius: 35px;
    padding: 12px;
    font-size: 14px;
    line-height: 16px;
    color: #CED0D4;
    font-weight: 500;
    cursor: unset;
    margin-bottom: 0;
    margin-right: 20px;
	}
.btnRaiseConcernMob:hover {
	background-color: unset;
	color: #CED0D4;
	}
</style>

<section class="backgroundColorF9F">
<div class="destop_test_exp">
	<div class="pageContainer">
		<div class="paddingTop10">
			<div class="tourQuoteRefCont">
				<h3 class="tourQuoteRefHeading">Reference ID #{{ $data1->quo_ref }}</h3>
				<ul class="flexcenter">
					<li class="tablinks" onclick="openTab(event, 'tourQuote1')">Quote 1</li>
					<li class="tablinks" id="defaultOpen" onclick="openTab(event, 'tourQuote2')">Quote 2</li>
				</ul>
			</div>
		</div>
		<div class="tabcontent" id="tourQuote1">
			@include("query.quotation_webpage.desktop.quote1-desktop")
		</div>
		<div class="tabcontent" id="tourQuote2">
			@include("query.quotation_webpage.desktop.quote2-desktop")
		</div>
	</div>
</div>
<div class="mobile_test_exp">
	<div class="paddingTop3">
		<div class="mtourQuoteRefCont">
			<h3 class="mtourQuoteRefHeading">Reference ID #{{ $data1->quo_ref }}</h3>
		</div>
		<div class="mtourQuoteTabCont">
			<ul class="flexcenter">
				<li class="tablinks" onclick="openTab(event, 'mtourQuote1')">Quote 1</li>
				<li class="tablinks" id="mdefaultOpen" onclick="openTab(event, 'mtourQuote2')">Quote 2</li>
			</ul>
		</div>
	</div>
	<div>
		<div class="tabcontent" id="mtourQuote1">
			@include("query.quotation_webpage.mobile.quote1-mobile")
		</div>
		<div class="tabcontent" id="mtourQuote2">
			@include("query.quotation_webpage.mobile.quote2-mobile")
		</div>
	</div>
</div>
</section>
@endsection

@section("custom_js")
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery(document).on("click",".user_quote_accept",function(e) {
		e.preventDefault()
		var token =  jQuery('input[name="_token"]').val()
		var content_id=jQuery(this).attr("content_id");
		var content_action=jQuery(this).attr("content_action");
		var form = document.createElement("form");
		form.setAttribute("method", "post");
		form.setAttribute("action", content_action);
		form.setAttribute("target", "");
		var hiddenField = document.createElement("input");
		hiddenField.setAttribute("type", "hidden");
		hiddenField.setAttribute("name", "_token");
		hiddenField.setAttribute("value", token);
		form.appendChild(hiddenField);
		var second_field = document.createElement("input");
		second_field.setAttribute("type", "hidden");
		second_field.setAttribute("name", "quote_id");
		second_field.setAttribute("value", content_id);
		form.appendChild(second_field);
		document.body.appendChild(form);
		//window.open('', 'view');
		//window.open('','view');
		form.submit();
		})
	})
</script>

<!--collapsible button script-->
<script type="text/javascript">
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
	coll[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var content = this.nextElementSibling;
		if (content.style.maxHeight){
			content.style.maxHeight = null;
			}
		else {
			content.style.maxHeight = content.scrollHeight + "px";
			}
		});
	}
</script>
@endsection