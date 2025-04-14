@extends('layouts.front.masternoindex')
@section("title", 'Booking Review')
@section('content')
<!--payment review page css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/payme.css') }}" />
<!--Modal Dialog with Js-->
<style type="text/css">
.basicCostItem {
	font-size: 14px;
    line-height: 14px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.requiredcolor {
    color: #E12D2D;
	}
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
<!--Add Traveller Info (Desktop-Mobile)-popup-->
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
	outline: none;
	padding: 12px 16px;
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
<style type="text/css">
#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url({{url('resources/assets/Processing.gif')}}) no-repeat center center;
  z-index: 10000;
}
.tourQuoteServiceTitle {
    color: #4A4A4A;
    font-size: 12px;
    line-height: 12px;
    font-weight: 600;
    margin-bottom: 11px;
    text-align: left;
}
.appendTop10 {
	margin-top: 10px;
}
.serviceIcons {
    margin-right: 35px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.serviceIconsImage {
    margin-bottom: 5px;
    flex-shrink: 0;
}
.serviceImage {
    width: 28px;
    height: 28px;
    flex-shrink: 0;
    vertical-align: middle;
    border: 0;
    pointer-events: none !important;
}

.flexOne {
	/*display: flex;*/
    flex: 1;
	}
	

</style>

<!--Coupon Section-->
<style>
/*Coupon Section*/
.appendTop10 {
    margin-top: 10px !important;
}
.CouponColor {
	color: #00A19C !important;
	/*font-weight: 600 !important;*/
	}
.pointer {
    cursor: pointer;
}
.noShrink {
    flex-shrink: 0;
}
.couponDiscount {
    padding: 20px 0;
    border-bottom: 1px solid #f1f1f1;
}
.couponDiscount p {
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
}
.couponDiscountPrice {
    font-size: 14px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
}
.capText {
	text-transform: uppercase;
	}
.apndLeft5 {
	margin-left: 5px;
	}
.deleteIcon {
    width: 14px;
    height: 15px;
    background: #E12D2D;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 8px;
    font-weight: 700;
    position: absolute;
}
.offerTag {
	font-size: 12px !important;
	line-height: 16px !important;
	margin-right: 20px;
	font-weight: 500 !important;
	color: #a1a1a1 !important;
	}
.relative {
    position: relative;
}
.width225 {
    width: 225px;
}
.applyCpn .apply-coupon-container {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}
.applyCpn .apply-coupon-container .applyCpn-trigger {
    position: static;
}
.applyCpn .apply-coupon-container input {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.applyCpn input[type=text] {
    border: 1px solid #cdcdcd;
    font-size: 11px;
    padding: 8px 10px;
    width: 100%;
    color: #9a9a9a;
    border-radius: 2px;
    text-transform: uppercase;
}
.applyCpn-trigger {
    position: absolute;
    right: 0;
    color: #fff;
    cursor: pointer;
}
.applyBtn {
    border-radius: 2px;
    background: #008cff;
    padding: 9px 10px;
    text-align: center;
    display: inline-block;
    width: 65px;
}
.font11 {
    font-size: 11px;
    line-height: 11px;
}
.appendBottom13 {
    margin-bottom: 13px;
}
.appendTop13 {
    margin-top: 10px;
}
.linkText {
    color: #008cff;
}
.down {
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
}
.arrowPaymentdetails {
    border: solid #0084ff;
    border-width: 0 1px 1px 0;
    display: inline-block;
    padding: 2px;
    margin: 0 0 2px 8px;
}
.paddingB10 {
    padding-bottom: 10px;
}
.offersAppliedList {
    margin-top: 10px;
}
.offersAppliedList li {
    display: flex;
    padding: 8px 0;
    justify-content: space-between;
}

.makeflex.column {
    flex-direction: column;
}
.appendLeft10 {
    margin-left: 10px;
}
.appendBottom5 {
    margin-bottom: 5px;
}
.darkText {
    color: #4a4a4a;
}
.greyText {
    color: #9b9b9b;
}
.lineHeight14 {
    line-height: 14px !important;
}

.offersAppliedList li span.amount {
    width: 80px;
    margin-left: 20px;
}

</style>
<!--TCS Info-->
<style>
.tcsInfo {
    width: 14px;
    height: 15px;
    background: #a1a1a1;
    color: #fff;
    border-radius: 50%;
    font-size: 9px;
    font-weight: 700;
    position: absolute;
	text-align: center;
}
.tcsInfoText {
    color: #9b9b9b;
    font-size: 12px;
	line-height: 16px;
    margin-top: 5px;
	margin-bottom: 0;
	width: 200px;
	text-align: left;
}
html[dir='ltr'] .appendRight15 {
    margin-right: 15px;
}
/*TCS Info*/
.appendTop20 {
    margin-top: 20px;
}
.tcsInfoWrapper {
    padding: 25px 20px;
    border-radius: 4px;
    border: solid 1px rgba(215,215,215,.19);
    background-image: linear-gradient(36deg, rgba(221, 214, 243, 0.19), rgba(251, 172, 168, 0.19));
}
.latoBlack {
    font-weight: 900;
}
.font16 {
    font-size: 16px;
    line-height: 16px;
}
.appendBottom25 {
    margin-bottom: 25px;
}
.tcsIcons {
    width: 33px;
    height: 36px;
    margin-right: 5px;
}
.holidaySprite13 {
    background: url(/images/common/Tcs/holidaySprite.png) no-repeat;
    display: inline-block;
    background-size: 480px 480px;
    font-size: 0px;
    flex-shrink: 0;
}
.font14 {
    font-size: 14px;
    line-height: 14px;
}
.subDesc {
    color: #666660;
}
.claimCreditIcon {
    width: 24px;
    height: 27px;
    margin-right: 14px;
}
.holidaySprite13 {
    background: url(/images/common/Tcs/holidaySprite.png) no-repeat;
    display: inline-block;
    background-size: 480px 480px;
    font-size: 0px;
    flex-shrink: 0;
}
.recieveIcon {
    width: 32px;
    height: 27px;
    margin-right: 6px;
}
.holidaySprite13 {
    background: url(/images/common/Tcs/holidaySprite.png) no-repeat;
    display: inline-block;
    background-size: 480px 480px;
    font-size: 0px;
    flex-shrink: 0;
}
</style>
<!--custom radio-->
<style>
.custom_radio {
    display: flex;
    align-items: center;
    flex-direction: row;
    /*padding-right: 12px;
    margin-right: 15px;*/
}
.custom_radio input {
    display: none;
}
.custom_radio input:checked~span {
    border: solid 2px #008cff;
    display: flex;
    border-radius: 10px;
    height: 18px;
    width: 18px;
    margin-top: -2px;
    margin-right: 15px;
}
.custom_radio span {
    border: solid 2px #4a4a4a;
    display: flex;
    border-radius: 10px;
    height: 18px;
    width: 18px;
    margin-top: -2px;
    margin-right: 15px;
    align-items: center;
}
.custom_radio input:checked~span:after {
    content: "";
    background-color: #008cff;
    display: flex;
    border-radius: 10px;
    height: 12px;
    width: 12px;
    margin-left: 1px;
}
</style>
<!--Book Now Pay later-->
<style>
/*Book Now Pay later*/
.bnplWrapper {
    padding: 10px 15px 1px;
    border-radius: 5px;
}
.bnplExpandedSec {
    background: #d4e9fa;
}
.bnplBox {
    position: relative;
    border-left: 1px dotted #aaa;
    margin-left: 6px;
    margin-top: 7px;
}
.bnplBoxRow {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-left: 20px;
}
.chartNumber {
    background: #a9d4f6;
    border-radius: 30px;
    width: 16px;
    font-size: 11px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    position: absolute;
    left: -8px;
}
.font11 {
    font-size: 11px;
    line-height: 11px;
}
.appendBottom3 {
    margin-bottom: 3px;
}
.bnplBox p {
	font-size: 12px;
	line-height: 13px;
	text-align: left;
	margin-bottom: 5px;
}
.bnplPrice {
    font-size: 13px;
    line-height: 15px;
	width: 70px;
    text-align: right;
}
</style>
<!--Fees & Taxes Box-->
<style>
/*Fees & Taxes Box*/
.taxesCont {
	padding: 20px 0;
}
.taxesContHead {
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
}
.taxesPrice {
    padding: 0;
    font-size: 14px;
    line-height: 14px;
    color: #000001 !important;
    font-weight: 600 !important;
    text-align: right;
    flex-shrink: 0;
}
.feesTaxesWrap {
    padding: 10px 15px 1px;
    margin-top: 10px;
    border-radius: 5px;
}
.feesTaxesExpandedSec {
    /*background: #d4e9fa;*/
	background: #f5f5f5;
}
.feesTaxesBox {
    position: relative;
    /*border-left: 1px dotted #aaa;
    margin-left: 6px;*/
    margin-top: 7px;
}
.feesTaxesBoxRow {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    /*padding-left: 20px;*/
}
.taxesChartNumber {
    background: #a9d4f6;
    border-radius: 30px;
    width: 16px;
    font-size: 11px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    position: absolute;
    left: -8px;
}
.font11 {
    font-size: 11px;
    line-height: 11px;
}
.appendBottom3 {
    margin-bottom: 3px;
}
.feesTaxesBox p {
	font-size: 12px;
	line-height: 13px;
	text-align: left;
	margin-bottom: 5px;
}
.bnplPrice {
    font-size: 13px;
    line-height: 15px;
	width: 70px;
    text-align: right;
}
</style>
<!--coupons and offers-->
<style>
/*coupons and offers*/
.offersSection {
    background: #fff;
    border-radius: 4px;
	padding: 0;
    border: solid 1px #e9e9e9;
}
.couponsHead {
	padding: 20px;
    font-size: 18px;
	line-height: 18px;
	color: #000001;
    font-weight: 900;
	text-align: left;
	margin-bottom: 0;
}
.emiOptions {
    background: #f9f9f9;
    padding: 20px 20px;
    display: flex;
    align-items: center;
}
.offersSection .emiOptions .emiIcon {
    background-position: unset;
    height: 16px;
}
.emiIcon {
    background: linear-gradient(225deg, #667eea 4.42%, #764ba2 100%);
    border-radius: 20px;
    padding: 0 3px;
    color: #fff;
    width: 34px;
    font-size: 8px;
    font-weight: 900;
    height: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}
.emiIcon {
    background-position: -62px -264px;
    width: 35px;
    height: 26px;
    vertical-align: middle;
}
.emiIcon span {
    margin-right: 2px;
    color: #fff;
    font-size: 7px;
    font-weight: 900;
    border: 1px solid rgba(255,255,255,.7);
    border-radius: 30px;
    width: 9px;
    height: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.emiText {
    font-size: 14px;
    line-height: 16px;
    color: #000001;
    font-weight: 700;
    text-align: left;
    margin-bottom: 1px;
}
.emiTextDesc {
    font-size: 11px;
    line-height: 11px;
    color: #9b9b9b;
    font-weight: 400;
    text-align: left;
    margin-bottom: 0;
}
.latoBold {
    font-weight: 700;
}
.emi-option-link {
    cursor: pointer;
}
.linkText {
    color: #008cff;
    cursor: pointer;
    font-weight: 900;
}
.padding15 {
    padding: 15px;
}
.couponsInput {
    position: relative;
}
.appendBottom10 {
    margin-bottom: 10px;
}
.couponsInput .reviewSprite {
    font-size: 0px;
    flex-shrink: 0;
}
.couponsInput i::before {
    content: "!";
}
i::before, i::after {
    content: '';
    box-sizing: border-box;
}
.couponsInput input {
    background: #fff;
    border: 1px solid #cbcbcb;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 12px 10px 12px 30px;
    width: 100%;
    outline: none;
}
.ctaCoupon.disable {
    opacity: .5;
    cursor: default;
    pointer-events: none;
}
.ctaCoupon {
    position: absolute;
    right: 9px;
    top: 14px;
    cursor: pointer;
}
.couponsInput .couponStatusNotify {
    display: none;
    margin-bottom: 4px;
}
.couponSep {
    border-bottom: 1px solid #ddd;
    position: relative;
    margin: 30px 0;
}
.couponSepText {
    width: 24px;
    height: 24px;
    background: #e7e7e7;
    font-size: 11px;
	line-height: 13px;
    font-weight: 900;
    border: 1px solid #ddd;
    position: absolute;
    top: -11px;
    border-radius: 30px;
    left: 45%;
    padding: 4px 3px;
    color: #9b9b9b;
}
.couponsOuter.active {
    background: #d1f8e6;
    border: 1px solid #6fd7bb;
    padding-left: 5px;
}
.couponsOuter {
    display: flex;
    width: 100%;
    background: #f2f2f2;
    border: 1px solid #d8d8d8;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 12px 12px 12px 45px;
    margin-top: 10px;
    position: relative;
    cursor: pointer;
    height: 100px;
    box-sizing: border-box;
}
.couponsOuter.active .reviewSprite.greenTick {
    width: 30px;
    height: 30px;
    background-position: -260px -78px;
    margin-right: 10px;
}
.reviewSprite {
    background: url(/holidays/node/images/dynamicReview/spriteReview3.png) no-repeat top left;
    background-size: 293px 269px;
    display: inline-block;
}
.makeFlex.spaceBetween {
    justify-content: space-between;
}
.makeFlex.column {
    flex-direction: column;
}
.capText {
    text-transform: uppercase;
}
.couponPrice {
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 900;
	text-align: left;
    margin-bottom: 0;
}
.couponsOuter.active .couponName {
    border-bottom: dashed 1px #000;
}
.couponsOuter .couponName {
    margin-bottom: 4px;
    display: inline-block;
    padding-bottom: 2px;
    border-bottom: dashed 1px rgba(0,0,0,0);
}
.flexSpaceBetween {
	display: flex;
    justify-content: space-between;
}
.font10 {
    font-size: 10px;
    line-height: 10px;
}
.couponName {
	font-size: 12px;
	line-height: 12px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 4px;
}
.couponDesc {
	font-size: 10px;
	line-height: 12px;
	color: #4a4a4a;
	font-weight: 400;
	text-align: left;
	margin-bottom: 0;
	width: 80%;
}
.couponOfferBox {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
}
</style>
<!--paymentreview.css-->
<style>
@media (max-width: 992px) {
/*Mobile bottom display*/
.mBar {
	display:none;
	}
.reviewCont {
	margin-bottom: 40px;
	}
.reviewbox {
	padding: 15px;
	background: #fff;
	border-top: 1px solid #CED0D4;
	border-bottom: 2px solid #CED0D4;
	display: flex;
	align-items: center;
	}
.reviewTitle {
	font-size: 18px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	text-transform: capitalize;
	}
.fa-arrow-left:before {
	content: "\f060";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
	color: #A1A1A1;
	font-size: 18px;
	line-height: 1;
	cursor: unset;
	margin-right: 20px;
	}
.reviewTourBox {
	padding: 15px 15px 25px;
	display: flex;
	flex-direction: column;
	}
.reviewTourBox h2 {
	font-size: 18px;
	line-height: 22px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	text-transform: none;
	}
.reviewTourBox h3 {
	font-size: 16px;
	line-height: 18px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 25px;
	text-transform: none;
	}
.reviewTourBox h5 {
	font-size: 12px;
	line-height: 12px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	text-transform: none;
	}
.tourDepartureBox {
    padding: 15px;
	/*box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);*/
	border-top: 1px solid #CED0D4;
	border-bottom: 1px solid #CED0D4;
	min-height: 110px;
	}
.tourTravelDateBox {
    padding: 15px;
	/*box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);*/
	border-top: 0;
	border-bottom: 1px solid #CED0D4;
	min-height: 150px;
	}
.tourDepartureBox h4, .tourTravelDateBox h4 {
	font-size: 14px;
	line-height: 14px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 8px;
	text-transform: uppercase;
	}
.tourDepartureBox h5, .tourTravelDateBox h5 {
	font-size: 16px;
	line-height: 18px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	text-transform: capitalize;
	}
.mtourContBox {
	display: flex;
	flex-direction: column;
	}
.mtourContBox h3 {
	font-size: 22px;
	line-height: 22px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	text-transform: capitalize;
	}
.leftContainer {
	padding: 15px;
	border-top: 0;
	border-bottom: 1px solid #CED0D4;
	}
.travellerGuestDtls {
	display: flex;
	flex-wrap: wrap;
	}
.travellerGuestDtls h5 {
	font-size: 16px;
	line-height: 16px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: left;
	margin-bottom: 5px;
	text-transform: none;
	}
/*Rooming*/
.roomCountCont {
	display: flex;
	align-items: center;
	margin: 30px 0;
	}
.roomCount {
	font-size: 16px;
	line-height: 16px;
	color: #4a4a4a;
	font-weight: 900;
	text-transform: uppercase;
	flex-shrink: 0;
	margin-right: 20px;
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
	min-width: 80px;
	margin-right: 5px;
	}
.guestCountBox h4 {
	font-size: 12px;
	line-height: 14px;
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
	min-width: 170px;
	margin-right: 10px;
	flex: 1;
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
	height: auto;
	padding: 12px 16px;
    outline: 0;
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
	padding: 5px;
	display: flex;
	align-items: center;
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
	
.guestInputCont {
	margin-bottom: 25px;
	}
.guestInputCont label {
    display: block;
    font-size: 13px;
    line-height: 13px;
    font-weight: 600;
    color: #747474 !important;
    margin-right: 0px !important;
    margin-bottom: 10px;
	}
.guestInputCont input[type=text], .guestInputCont select {
    padding: 0;
    font-size: 14px;
    line-height: 16px;
    color: #000001;
    font-weight: 500;
	border: 0;
	border-radius: 0;
    border-bottom: 1px solid #c8c8c8;
    cursor: text;
    height: 36px;
    background: #fff;
    text-transform: none;
    width: 100%;
    outline: 0;
	}
.guestInputCont input[type=text]:focus, .formTextarea:focus, .guestInputCont select:focus {
	border-bottom-color: #4a4a4a;
	box-shadow: none;
	}
.formTextarea {
    padding: 6px 12px;
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 500;
    border-bottom: 1px solid #c8c8c8;
    border-radius: 0;
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
.guestContactDtlsBox, .guestGSTDtlsBox {
	margin-top: 15px;
    padding: 10px 15px 15px;
    border-radius: 5px;
    box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
	}
.guestGSTDtlsBox h2 {
	font-size: 16px;
	line-height: 16px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	text-transform: uppercase;
	}
.guestContactDtlsBox h2 {
	font-size: 16px;
	line-height: 16px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 20px;
	}
.addOnDtlsCont {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
    margin-top: 10px;
    overflow-x: auto;
	}
.addOnDtlsCont label {
    border: 1px solid #d7d7d7;
    padding: 5px 10px;
    border-radius: 20px;
    color: #4a4a4a !important;
    margin-bottom: 0;
    font-size: 12px;
    line-height: 13px;
    font-weight: 600;
    display: flex;
    align-items: end;
    flex-shrink: 0;
	margin-right: 5px !important;
	}
.addOnDtlsCont label:last-child {
	margin-right: 0px !important;
	}
.addOnDtlsCont input[type=checkbox] {
    margin-top: 0;
    margin-right: 5px;
	}
.panInfoCont {
    padding: 10px 15px;
    border-radius: 5px;
    background: #d3d3d3;
    border: 1px solid #e7e7e7;
	margin-top: 30px;
	}
.panCardImageBox {
    width: 44px;
    height: auto;
    overflow: hidden;
    margin: 0 10px 0 0;
    border-radius: 3px;
    display: flex;
    flex-shrink: 0;
	margin-right: 5px;
	}
.panCardImage {
    height: 28px;
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
	margin: 25px 0px;
    padding: 7px;
    background: #FFEDD1;
    border: 1px solid #d3d3d3;
	}
.impInfoBox h5 {
    font-size: 12px;
	line-height: 16px;
    font-weight: 700;
    color: #FF664B;
	text-align: center;
	margin-bottom: 0;
	}
.rightContainer {
	width: 100%;
	}
.priceValueBox {
    border-bottom: 1px solid #e0dfdf;
    border-radius: 0;
    padding: 20px;
    background-color: #f2f9ff;
	}
.priceValueBox h4 {
    font-size: 11px;
    line-height: 11px;
	color: #a1a1a1;
	font-weight: 500;
    text-align: left;
	margin-bottom: 3px;
	}
.priceValueBox h3 {
    font-size: 26px;
    line-height: 26px;
	color: #000001;
	font-weight: 600;
    text-align: left;
	margin-bottom: 3px;
	}
.priceValueBox h5 {
    font-size: 12px;
    line-height: 12px;
	color: #a1a1a1;
	font-weight: 500;
    text-align: left;
	margin-bottom: 0;
	}
.paymentDetails {
	border: 0;
	box-shadow: none;
	}
.PaxWiseBox {
	padding: 25px 20px 10px;
	border-bottom: 1px solid #e0dfdf;
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
.paxValueBox div {
	font-size: 14px;
    line-height: 14px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.totalCostBox {
	padding: 0 20px;
	background: #E7E7E7;
	border-bottom: 1px solid #e0dfdf;
	}
.totalBasicCostBox {
	padding: 20px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
	border-bottom: 1px solid #CED0D4;
	}
.totalBasicCostBox:last-child {
	border-bottom: 0;
	}
.totalBasicCostBox div {
	font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.grandTotalCostBox {
	padding: 0 20px;
	background: #fff;
	border-bottom: 1px solid #e0dfdf;
	}
.grTtlCostBox {
	padding: 20px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
	border-bottom: 0;
	}
.grTtlCostBox div {
	font-size: 18px;
    line-height: 18px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.payFullCostBox {
	padding: 10px 15px;
	background: #f2f2f2;
	border: 0;
	border-top: 0;
	box-shadow: none;
	}
.payFullBox {
	/*padding: 20px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
	border-bottom: 1px solid #f1f1f1;*/
	}
.payFullCostBox label {
	padding: 25px 20px;
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
	background: #fff;
	width: 100%;
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
	/*padding: 5px 15px 10px;*/
	padding: 0 20px 20px;
	background: #f2f2f2;
	border-bottom: 1px solid #e0dfdf;
	}
.mPayPartBoxInner {
	padding: 25px 20px;
	background: #fff;
	}
.payPartBox label {
	padding: 20px 0;
	font-size: 16px;
    line-height: 16px;
    color: #000001 !important;
    /*font-weight: 600 !important;*/
	text-align: left;
	margin-bottom: 0;
	/*display: flex;
    align-items: center;
    justify-content: space-between;*/
    margin-right: 0 !important;
	width: 100%;
	display: flex;
    align-items: center;
    justify-content: space-between;
	}
	
.guestPayCont {
	padding: 20px;
	background: #f2f9ff;
	border-bottom: 1px solid #e0dfdf;
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
    padding: 10px 15px;
    background: #fff;
	margin-bottom: 25px;
	}
.guestConfBox h3 {
	font-size: 16px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.guestConfBox p {
	font-size: 12px;
	line-height: 16px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.guestConfBox a {
	color: #008cff;
	font-weight: 600;
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
.guestConfBox [type=checkbox] {
	width: 20px;
	height: 20px;
	margin: 0px 10px 0px 0px !important;
	}
.mReivewPriceBarCont {
	width: 100%;
	height: 65px;
	background: #000001;
	position: fixed;
	z-index:999;
	bottom: 0;
	}
.mReivewPriceBarBox {
	padding: 15px 20px;
	display: flex;
	align-items: center;
	justify-content: space-between;
	position: relative;
	}
.mReviewPriceBox {
	display: flex;
	align-items: flex-end;
	}
.mPayblPrcVal {
    font-size: 20px;
    line-height: 20px;
	color: #fff;
	font-weight: 600;
    text-align: left;
	margin-bottom: 0;
	}
.mPayblPrcValTag {
    font-size: 10px;
    line-height: 11px;
	color: #CED0D4;
	font-weight: 600;
    text-align: left;
	margin-bottom: 0;
	margin-left: 5px;
	}
.mLineSeprtr {
	border-left: 1px solid #fff;
	height: 35px;
	margin-left: -5%;
	position: absolute;
	}
.btnProceedMob {
	flex-shrink: 0;
	outline: 0;
	background: #01b7f2;
	border: 1px solid #08B2ED;
    border-radius: 20px;
	padding: 4px 12px;
    font-size: 16px;
    line-height: 18px;
	color: #fff;
	font-weight: 600;
	cursor: default;
	/*width: 100px;*/
	height: 34px;
	text-transform: uppercase;
	}
.payBtn, .mFooter {
	display: none;
	}
}

@media (min-width: 992px) {
/*Desktop Booking & Payment Review Page*/
.reviewCont {
	padding-bottom: 30px;
	background: #f2f2f2;
	}
.reviewbox {
	background: #0a223d;
	height: 65px;
	display: flex;
	align-items: center;
	position: sticky;
    top: 0px;
    z-index: 3;
	}
.pageContainer {
    width: 1200px;
    margin: 0 auto;
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
	margin-top: 20px;
    /* padding-top: 15px; */
	border-radius: 7px;
    padding: 30px;
    background: #fff;
	display: flex;
    justify-content: space-between;
	}
.reviewTourBox {
	/*padding: 0px 25px 25px 0px;*/
	width: 80%;
	}
.reviewTourBox h2 {
	font-size: 22px;
	line-height: 22px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	text-transform: none;
	}
.reviewTourBox h3 {
	font-size: 18px;
	line-height: 20px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 25px;
	text-transform: none;
	}
.reviewTourBox h5 {
	font-size: 14px;
	line-height: 20px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	text-transform: none;
	}
.fa-arrow-left:before {
	display: none;
	}
.tourDepartureBox {
    padding: 25px;
    border-radius: 5px;
    box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
    /* box-shadow: 0px 3px 6px lightgrey; */
    min-width: 250px;
    min-height: 175px;
    margin-right: 1%;
	}
.tourTravelDateBox {
    padding: 25px;
    border-radius: 5px;
    box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
    /* box-shadow: 0px 3px 6px lightgrey; */
    min-width: 250px;
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
	width: 850px;
	border-radius: 7px;
    /* padding-right: 30px; */
    /* flex: 1; */
    box-shadow: 0px 2px 30px rgb(0 0 0 / 10%);
    padding: 30px;
    background: #fff;
	}
.mtourContBox {
    display: flex;
	flex-direction: row;
	justify-content: space-between;
	}
.mtourContBox h3 {
	font-size: 22px;
	line-height: 22px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	text-transform: capitalize;
	}
.travellerGuestDtls {
	display: flex;
	flex-wrap: wrap;
	}
.travellerGuestDtls h5 {
	font-size: 16px;
	line-height: 16px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: left;
	margin-bottom: 5px;
	text-transform: none;
	}
/*Rooming*/
.roomCountCont {
	display: flex;
	align-items: center;
	margin: 30px 0;
	}
.roomCount {
	font-size: 16px;
	line-height: 16px;
	color: #4a4a4a;
	font-weight: 900;
	text-transform: uppercase;
	flex-shrink: 0;
	margin-right: 50px;
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
	height: auto;
	padding: 12px 16px;
    outline: 0;
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
.guestContactDtlsBox, .guestGSTDtlsBox {
	margin-top: 25px;
    padding: 20px 15px 30px 20px;
    border-radius: 5px;
    box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
	}
.guestGSTDtlsBox h2 {
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	text-transform: capitalize;
	}
.guestContactDtlsBox h2 {
	font-size: 16px;
	line-height: 16px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 20px;
	}
.guestInputCont {
	margin-bottom: 20px;
	}
.guestInputCont label {
    display: block;
    font-size: 14px;
    line-height: 16px;
    font-weight: 600;
    color: #000001 !important;
    margin-right: 0px !important;
    margin-bottom: 8px;
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
.guestInputCont select {
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
    width: 50%;
    outline: 0;
	}
.guestInputCont input[type=text]:focus, .formTextarea:focus, .guestInputCont select:focus {
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
.error {
    color: red;
	}
.addOnDtlsCont {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
    margin-top: 10px;
	}
.addOnDtlsCont label {
    border: 1px solid #d7d7d7;
    padding: 5px 10px;
    border-radius: 20px;
    color: #4a4a4a !important;
    margin-bottom: 0;
    font-size: 12px;
    line-height: 13px;
    font-weight: 600;
    display: flex;
    align-items: end;
	margin-right: 10px !important;
	}
.addOnDtlsCont label:last-child {
	margin-right: 0px !important;
	}
.addOnDtlsCont input[type=checkbox] {
    margin-top: 0;
    margin-right: 5px;
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
	width: 325px;
	flex-shrink: 1;
    /*flex-basis: 30%;*/
	}
.priceValueBox {
    border-bottom: 1px solid #e0dfdf;
    padding: 25px;
    background-color: #f2f9ff;
    box-shadow: 0px 2px 30px rgb(0 0 0 / 10%);
    border-radius: 7px 7px 0 0;
    position: sticky;
    top: 65px;
    z-index: 3;
	}
.priceValueBox h4 {
    font-size: 11px;
    line-height: 11px;
	color: #a1a1a1;
	font-weight: 500;
    text-align: left;
	margin-bottom: 8px;
	}
.priceValueBox h3 {
    font-size: 26px;
    line-height: 26px;
	color: #000001;
	font-weight: 900;
    text-align: left;
	margin-bottom: 4px;
	}
.priceValueBox h5 {
    font-size: 12px;
    line-height: 12px;
	color: #a1a1a1;
	font-weight: 500;
    text-align: left;
	margin-bottom: 0;
	}
.paymentDetails {
    /*border: 1px solid #e0dfdf;
    border-top: 0;/*
    /*box-shadow: 0 4px 8px 0 #8a6a7614;*/
    box-shadow: 0px 2px 30px rgb(0 0 0 / 10%);
	}
.PaxWiseBox {
	padding: 25px 20px 10px;
	border-bottom: 1px solid #f1f1f1;
	background: #fff;
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
.paxValueBox div {
	font-size: 14px;
    line-height: 14px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.totalCostBox {
	padding: 0 20px;
	background: #fff;
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
.totalBasicCostBox div {
	font-size: 14px;
    line-height: 14px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.grandTotalCostItem {
	font-size: 18px;
    line-height: 18px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.grandTotalCostBox {
    padding: 0 20px;
    background: #fff;
    /*border: 1px solid #e0dfdf;*/
    border-top: 0;
    /*box-shadow: 0 4px 8px 0 #8a6a7614;*/
    box-shadow: 0px 2px 30px rgb(0 0 0 / 10%);
	}
.grTtlCostBox {
	padding: 20px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
	border-bottom: 0;
	}
.grTtlCostBox div {
	font-size: 14px;
    line-height: 14px;
    color: #000001;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.payFullItem {
	padding: 0;
    font-size: 14px;
    line-height: 18px;
    color: #000001 !important;
    font-weight: 600 !important;
    text-align: right;
	flex-shrink: 0;
	}
.payFullCostBox {
    padding: 0 20px;
    background: #fffdf5;
    /*border: 1px solid #e0dfdf;*/
    border-top: 0;
    /*box-shadow: 0 4px 8px 0 #8a6a7614;*/
    box-shadow: 0px 2px 30px rgb(0 0 0 / 10%);
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
	font-size: 14px;
    line-height: 16px;
    color: #000001 !important;
    font-weight: 600 !important;
	text-align: left;
	margin-bottom: 0;
	display: flex;
    align-items: center;
    justify-content: space-between;
    margin-right: 0 !important;
	width: 100%;
	}
.payFullCostBox input[type=radio], .payPartBox input[type=radio] {
	width: 18px;
	height: 18px;
	margin: 0 10px 0 0;
	}
.payFullItem {
	padding: 0;
    font-size: 14px;
    line-height: 16px;
    color: #000001 !important;
    font-weight: 600 !important;
    text-align: right;
	flex-shrink: 0;
	}
.payPartBox {
	/*padding: 0 20px 20px;*/
	padding: 0 20px 20px;
	background: #fff;
	/*border: 1px solid #e0dfdf;*/
	border-top: 0;
	box-shadow: 0 4px 8px 0 #8a6a7614;
	}
.payPartBox label {
	padding: 20px 0;
	font-size: 14px;
    line-height: 16px;
    color: #000001 !important;
    font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	display: flex;
    align-items: center;
    justify-content: space-between;
    margin-right: 0 !important;
	width: 100%;
	display: flex;
    align-items: center;
    justify-content: space-between;
	}
.guestPayCont {
    padding: 20px;
    background: #f2f9ff;
    /*border: 1px solid #e0dfdf;*/
    border-top: 0;
    border-radius: 0 0 4px 4px;
    /*box-shadow: 0 4px 8px 0 #8a6a7614;*/
    box-shadow: 0px 2px 30px rgb(0 0 0 / 10%);
	position: sticky;
    top: 176px;
    z-index: 3;
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
	margin-bottom: 25px;
	}
.guestConfBox h3 {
	font-size: 16px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.guestConfBox p {
	font-size: 12px;
	line-height: 16px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.guestConfBox a {
	color: #008cff;
	font-weight: 600;
	}
.guestConfBox [type=checkbox] {
	width: 20px;
	height: 20px;
	margin: 0px 10px 0px 0px !important;
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
	padding: 13px;
    font-size: 14px;
	line-height: 14px;
	color: #fff;
	font-weight: 700;
	cursor: pointer;
	width: 100%;
	height: 40px;
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
.mReivewPriceBarCont, .dFooter {
	display: none;
	}
}
</style>
<section>
	<div id="loader"></div>
<div class="reviewCont">
<div class="reviewbox">
	<div class="pageContainer">
		<h3 class="fa-arrow-left reviewTitle">Review Package</h3>
	</div>
</div>
<!-- <form action="{{url('/save_booking_details')}}"  method="post"> -->
    <form  id="save_booking_details" name="save_booking_details" method="post">
	{{csrf_field()}}
<div class="pageContainer">
	<div class="reviewTourDtlsCont">
		<div class="reviewTourBox">
			<h2>{{CustomHelpers::get_package_name($query->packageId)}}</h2>
			<h3><?php $day_night=(int)filter_var($query->duration, FILTER_SANITIZE_NUMBER_INT); ?> {{$day_night-1}} Nights / {{$day_night}} Days</h3>
			<h5>Included in this package</h5>
			<?php
			$package_service=unserialize($data->package_service);
			?>
				@if(empty($package_service))
				@else
				<div class="flexCenter">
				@foreach($package_service as $icon)
					<div class="serviceIcons appendTop10">
						<div class="serviceIconsImage">
							<img class="serviceImage" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon')) }}" title="{{ CustomHelpers::getimagename($icon,'rt_icons','icon_title') }}" >
						</div>
						<div class="serviceIconsTitle">{{ CustomHelpers::getimagename($icon,'rt_icons','icon_title') }}</div>
					</div>
					@endforeach
				</div>
				@endif
		</div>
		<div class="tourDepartureBox">
			<h4>DEPARTURE CITY</h4>
			<h5>{{ $data->sourcecity }}</h5>
		</div>
		<div class="tourTravelDateBox">
			<?php
					// $originalDate = CustomHelpers::get_query_field($data->query_reference,'date_arrival');
                    $originalDate = $data->tour_date;
					if($originalDate=="N" || $originalDate==""):
					$originalDate=date("Y-m-d");
					endif;
					$datefrom = str_replace(' ', '', $originalDate);
					$datefrom=explode("-", $datefrom);
					$datefrom_year=$datefrom["2"];
					$datefrom_day=$datefrom["1"];
					$datefrom_month=$datefrom["0"];
					$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
					$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
					$stop_date = $datefrom;
					$date_to=$datefrom;
					$datefrom_print = date("d M Y", strtotime($datefrom));
					$day_from = strtotime($datefrom);
					$day_from = date('D', $day_from);
					$to_days=$data->duration-1;
					$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
					$stop_date_print= date("d M Y", strtotime($stop_date));
					$day_to = strtotime($stop_date);
					$day_to = date('D', $day_to);
				?>
			<h4>FROM</h4>
			<h5><?php echo "$day_from"; ?>, {{$datefrom_print}}</h5>
			<h4>TO</h4>
			<h5><?php echo "$day_to"; ?>, {{ $stop_date_print}}</h5>
		</div>
	</div>
	<div class="reviewTourSeparator"></div>
	<!--Traveller Information-->
	<div class="mtourContBox">
		<div class="leftContainer">
			<!--Traveller information starts-->
			<div>
				<h3>Traveller Information</h3>
				<div class="travellerGuestDtls">
					<div class="appendRight40">
						<h5>{{CustomHelpers::get_seperate_pass_payment_view($data->id,1,'na')}}</h5>
					</div>
					<div>
						<h5>No of Rooms:&nbsp;<span>{{CustomHelpers::get_seperate_pass_payment_view($data->id,1,'room')}}</span></h5>
					</div>
				</div>
				<!--Rooming None-->
                <?php 
                    $rooms=unserialize($data->room);
                   
                    ?>
                  @if($rooms!='')
                     <?php 
                          $m=1;
                       
                        ?>
                        @foreach($rooms as $row=>$col)
                        <?php 
$twin_adult_room=$col['twin_adult_room'];
$extra_adult_room=$col['extra_adult_room'];
$child_with_bed_room=$col['child_with_bed_room'];
$child_without_bed_room=$col['child_without_bed_room'];
$infant_room=$col['infant_room'];
$single_room=$col['single_room'];
$x=1;
$y=1;
$z=1;
                        ?>
				<div style="display: ">
					<div class="roomCountCont">
						<span class="roomCount">Room - {{$m}}</span>
						<span class="flexOne line"></span>
					</div>
                    @if($twin_adult_room>0)
                    @for($a=0;$a<$twin_adult_room;$a++)
                    <?php 
                $pass=0;
                    ?>
					<div class="guestDtlsCont">
						<div class="guestCountBox">
							<h4>Adult - {{$x++}}</h4>
							<h5>(Twin Sharing +12yrs)</h5>
						</div>
						<div class="guestNameBox">
                            @if(count($room_passenger)>0)
                             @foreach($passengers as $passenger)
                  <?php
$passenger_id=CustomHelpers::custom_encrypt($passenger->id);

                  ?>

            @if(is_array($room_passenger) && array_key_exists($m,$room_passenger) && is_array($room_passenger[$m]) && array_key_exists('twin_adult',$room_passenger[$m]) && array_key_exists($a,$room_passenger[$m]['twin_adult']) && $room_passenger[$m]['twin_adult'][$a]==$passenger_id) 

            {{$passenger->firstname}} {{$passenger->lastname}} 


            @endif


      <option value="{{$passenger_id}}" ></option>

    


                             @endforeach
                             @endif
							
						</div>
						
                            
                    
					</div>
                    @endfor
                    @endif
                       @if($extra_adult_room>0)
                    @for($b=0;$b<$extra_adult_room;$b++)
                     <?php 
                $pass=0;
                    ?>
                    <div class="guestDtlsCont">
                        <div class="guestCountBox">
                            <h4> Adult - {{$x++}}</h4>
                            <h5> (Extra +12yrs)</h5>
                        </div>
                        <div class="guestNameBox">
                           @if(count($room_passenger)>0)
                             @foreach($passengers as $passenger)
                  <?php
$passenger_id=CustomHelpers::custom_encrypt($passenger->id);

                  ?>

                   @if(is_array($room_passenger) && array_key_exists($m,$room_passenger) && is_array($room_passenger[$m]) && array_key_exists('extra_adult',$room_passenger[$m]) && array_key_exists($b,$room_passenger[$m]['extra_adult']) && $room_passenger[$m]['extra_adult'][$b]==$passenger_id) 

                   {{$passenger->firstname}} {{$passenger->lastname}}

                    @endif



                             @endforeach
                             @endif
                        </div>
                     
                        
                    </div>
                    @endfor
                    @endif
                       @if($single_room>0)
                    @for($c=0;$c<$single_room;$c++)
                     <?php 
                $pass=0;
                    ?>
                    <div class="guestDtlsCont">
                        <div class="guestCountBox">
                            <h4>Adult - {{$x++}}</h4>
                            <h5>(Single +12yrs)</h5>
                        </div>
                        <div class="guestNameBox">
                            @if(count($room_passenger)>0)
                             @foreach($passengers as $passenger)
                  <?php
$passenger_id=CustomHelpers::custom_encrypt($passenger->id);

                  ?>
                 @if(is_array($room_passenger) && array_key_exists($m,$room_passenger) && is_array($room_passenger[$m]) && array_key_exists('single',$room_passenger[$m]) && array_key_exists($c,$room_passenger[$m]['single']) && $room_passenger[$m]['single'][$c]==$passenger_id) 

                 {{$passenger->firstname}} {{$passenger->lastname}}

                  @endif

      
 

                             @endforeach
                             @endif
                        </div>

                  

                        
                    </div>
                    @endfor
                    @endif
                       @if($child_with_bed_room>0)
                    @for($e=0;$e<$child_with_bed_room;$e++)
                     <?php 
                $pass=0;
                    ?>
                    <div class="guestDtlsCont">
                        <div class="guestCountBox">
                            <h4>Child  - {{$y++}}</h4>
                            <h5>(With Bed 2-12yrs)</h5>
                        </div>
                        <div class="guestNameBox">
                        @if(count($room_passenger)>0)
                             @foreach($passengers as $passenger)
                  <?php
$passenger_id=CustomHelpers::custom_encrypt($passenger->id);

                  ?>
                @if(is_array($room_passenger) && array_key_exists($m,$room_passenger) && is_array($room_passenger[$m]) && array_key_exists('child_with_bed',$room_passenger[$m]) && array_key_exists($e,$room_passenger[$m]['child_with_bed']) && $room_passenger[$m]['child_with_bed'][$e]==$passenger_id) 

                {{$passenger->firstname}} {{$passenger->lastname}}

                 @endif

   

                             @endforeach
                             @endif
                        </div>

                          

                       
                    </div>
                    @endfor
                    @endif
                       @if($child_without_bed_room>0)
                    @for($f=0;$f<$child_without_bed_room;$f++)
                     <?php 
                $pass=0;
                    ?>
                    <div class="guestDtlsCont">
                        <div class="guestCountBox">
                            <h4>Child  - {{$y++}}</h4>
                            <h5>(without bed 2-12yrs)</h5>
                        </div>
                        <div class="guestNameBox">
                             <select class="form-control passenger_select" name="passenger[{{$m}}][child_without_bed][{{$f}}]" required>
                            <option value="">select passenger</option>  
                             @if(count($room_passenger)>0)
                             @foreach($passengers as $passenger)
                  <?php
$passenger_id=CustomHelpers::custom_encrypt($passenger->id);

                  ?>
        @if(is_array($room_passenger) && array_key_exists($m,$room_passenger) && is_array($room_passenger[$m]) && array_key_exists('child_without_bed',$room_passenger[$m]) && array_key_exists($f,$room_passenger[$m]['child_without_bed']) && $room_passenger[$m]['child_without_bed'][$f]==$passenger_id) 

        {{$passenger->firstname}} {{$passenger->lastname}}

         @endif

     
                             @endforeach
                             @endif
                            </select>
                        </div>

                       

                        
                    </div>
                    @endfor
                    @endif

                        @if($infant_room>0)
                    @for($g=0;$g<$infant_room;$g++)
                     <?php 
                $pass=0;
                    ?>
                    <div class="guestDtlsCont">
                        <div class="guestCountBox">
                            <h4>Infant  - {{$z++}}</h4>
                            <h5>(0-2yrs)</h5>
                        </div>
                        <div class="guestNameBox">
                             <select class="form-control passenger_select" name="passenger[{{$m}}][infant][{{$g}}]" required>
                            <option value="">select passenger</option>  
                           @if(count($room_passenger)>0)
                             @foreach($passengers as $passenger)
                  <?php
$passenger_id=CustomHelpers::custom_encrypt($passenger->id);

                  ?>
            @if(is_array($room_passenger) && array_key_exists($m,$room_passenger) && is_array($room_passenger[$m]) && array_key_exists('infant',$room_passenger[$m]) && array_key_exists($g,$room_passenger[$m]['infant']) && $room_passenger[$m]['infant'][$g]==$passenger_id) 

            {{$passenger->firstname}} {{$passenger->lastname}}

             @endif


     

                             @endforeach
                             @endif
                            </select>
                        </div>

                          

                      
                    </div>
                    @endfor
                    @endif

					
				</div>
                <?php
                     $m++;
                  
                     ?>
                     @endforeach
                     @endif
				<!--Rooming None-->
			
			</div>
			<!--Traveller information ends-->
			<!--Traveller contact information starts-->
			<div class="guestContactDtlsBox">
				<!--<h2>Contact Details</h2>
				<div class="flex-col-md-12">
					<div class="formGroup">
						<div class="font16 fontWeight600 blackText">Please enter details</div>
					</div>
				</div>-->
				<!--Email Id, Mobile No, City, State, Address, Spl Requests-->
				<div class="flex-row-multicolum appendTop10">
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_name">Leading Guest Name</label>
							@if($lead_passenger_info!='')
                            {{$lead_passenger_info->guest_name}}
                            @endif
						</div>
					</div>
					<div class="flex-col-md-6"></div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_email">Email ID</label>
							{{$lead_passenger->email}}
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_mobile">Mobile No</label>
							<div class="makeflex">
								 @if($lead_passenger_info!='')
                               {{$lead_passenger_info->mobile_no}}
                                 @endif
							</div>
							<span class="error" id="guestcontact_mobile_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_city">City</label>
							@if($lead_passenger_info!='')

{{$lead_passenger_info->city}}
 @endif
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_state">State</label>
							@if($lead_passenger_info!='')
                             {{$lead_passenger_info->state}}
                               @endif
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="guestcontact_address">Address</label>
							@if($lead_passenger_info!='')
                           $lead_passenger_info->address

                              @endif
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="guestInputCont appendTop5">
								<label for="guest_additionaletails">Special Request&nbsp;<span class="colorA1">(subject to availability)</span></label>
							<?php

                        $special_request=CustomHelpers::get_run_time_passenger_details($quote_ref_no,'special_request');

							 ?>
						@if($special_request!='' && $special_request!='N;')
						<?php
                        $special_request=unserialize($special_request);
						?>
							<div class="addOnDtlsCont mobscroll" style="display: block;">

                                 @if(in_array('Early Check-in',$special_request)) 
                                 <p>Early Check-in</p>
                                  @endif 
                                  
                                    @if(in_array('Late Checkout',$special_request)) 
                                    <p>Late Checkout</p>
                                     @endif 
                               
                               @if(in_array('Honeymoon Freebies',$special_request)) 
                               <p>Honeymoon Freebies</p>
                                @endif

								
							</div>
                        
                         @endif
							{{CustomHelpers::get_run_time_passenger_details($quote_ref_no,'guest_additionaletails')}}
						</div>
					</div>
				</div>
			</div>
			<!--Traveller contact information ends-->
			<!--Business Traveller GST information starts-->
			<div class="guestGSTDtlsBox">
				<div class="flex-col-md-12">
					<div class="formGroup">
						<h2>Enter GST details (optional)</h2>
					</div>
				</div>
				<!--GSTIN Details-->
				<div class="flex-row-multicolum appendTop20">
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_no">GSTIN</label>
							@if($passengers_infos!='') 

                            {{$passengers_infos->guestGST_no}}

                            @endif
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_name">GST Name</label>
							@if($passengers_infos!='') 

                            {{$passengers_infos->guestGST_name}}
                              @endif
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_email">GST Email ID</label>
							@if($passengers_infos!='') 

                            {{$passengers_infos->guestGST_email}}

                              @endif
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_mobile">GST Mobile</label>
							@if($passengers_infos!='') 
                            {{$passengers_infos->guestGST_mobile}}

                             @endif
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestGST_state">GST State</label>
							@if($passengers_infos!='') 
                            {{$passengers_infos->guestGST_state}}  
                            @endif

						</div>
					</div>
					<div class="flex-col-md-6"></div>
					<div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="guestGST_address">GST Address</label>
							@if($passengers_infos!='') 
                            {{$passengers_infos->guestGST_address}} 
                            @endif

						</div>
					</div>
				</div>
				<!--Business Traveller GST information ends-->
			</div>
			<!--Traveller contact information ends-->
			<!--Traveller Pan Card information starts-->
            <?php
            $package_id=$query->packageId;
            $package=DB::table('rt_packages')->where('id',(int)$package_id)->first();
            $country=unserialize($package->country);
        ?>
            @if(in_array('India',$country) || in_array('Nepal',$country) || in_array('Bhutan',$country))
          @else
			<div class="panInfoCont">
				<div class="d-flex-baseline">
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
            @endif
			<!--Traveller Pan Card information ends-->
			<div class="impInfoBox">
				<h5>Please make sure you read all the Terms & Conditions, Booking and Cancellation Policy for this booking.</h5>
			</div>
		</div>
		<!--Sidebar starts-->
@include('home.right_part')




					</div>
				</div>
			</div>			
			<!--TCS Info-->
             @if(in_array('India',$country) || in_array('Nepal',$country) || in_array('Bhutan',$country))
          @else
			<div class="appendTop20">
			<div class="tcsInfoWrapper">
				<p class="font16 latoBlack darkText appendBottom25">Get 100% Credit of TCS Amount?</p>
				<div class="makeflex appendBottom25">
					<span class="holidaySprite13 tcsIcons noShrink"></span><div class="font14 darkText"><p class="font16 latoBold darkText appendBottom5">TCS is collected </p><p class="lineHeight20 font14 subDesc">TCS credit would reflect in your Form 26AS on quarterly basis. You may also request TCS certificate from us. </p></div>
				</div>
				<div class="makeflex appendBottom25">
					<span class="holidaySprite13 claimCreditIcon noShrink"></span><div class="font14 darkText"><p class="font16 latoBold darkText appendBottom5">Claiming your credit</p><p class="lineHeight20 font14 subDesc">TCS collected can be claimed against the tax payable at the time of filing the tax return or payment of advance tax.</p></div>
				</div>
				<div class="makeflex">
					<span class="holidaySprite13 recieveIcon noShrink"></span>
					<div class="font14 darkText"><p class="font16 latoBold darkText  appendBottom5">Receiving tax refund</p><p class="lineHeight20 font14 subDesc">In case there is no tax payable, you can claim the refund of TCS amount at the time of filing income tax return.</p></div>
				</div>
			</div>
			</div>
            @endif
		</div>
		<!--Sidebar ends-->
	</div>
	<!--Mobile Pricebar starts-->
	<div class="mReivewPriceBarCont">
		<div class="mReivewPriceBarBox">
			<div class="mReviewPriceBox">
				<p class="mPayblPrcVal"><span class="defaultCurencyPay">&nbsp;18,792</span></p>
				<p class="mPayblPrcValTag">Total Payable</p>
			</div>
			<div>
				<div class="mLineSeprtr">|</div>
				<button type="submit" class="btnMain btnProceedMob">Proceed</button>
			</div>
		</div>
	</div>
	<!--Mobile Pricebar ends-->
</div>
</form>
</div>
</section>
<!--Add Traveller Info Starts-->

<!--Add Traveller Info Ends-->
@endsection
@section("custom_js")
<script type="text/javascript">
$(document).on("keyup change","#custom_pay",function(){
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
})
$(document).ready(function(){
//
   var APP_URL=jQuery("#base_url").val();
var url=APP_URL+'/country_code';
		var data={_token:"{{ csrf_token() }}"};
		$.post(url,data,function(rdata) {
			$("#country_code").html("").html(rdata);
			})
//
 $('#acknowledgement').change(function() {
        if($(this).is(":checked")) {
            $("#btnProceed").css("background", "green");
        }
        else
        {
        	$("#btnProceed").css("background", "#CED0D4");
        }
    });
    //
	$("#custom_pay").prop('disabled', true);
	$('input[type=radio][name=amount]').change(function() {
    if (this.value == 'fullamt') {
    	$("#custom_pay").val('').val(0)
    	$("#custom_pay").prop('disabled', true);
   var APP_URL=jQuery("#base_url").val();
    $.ajax({
        url: APP_URL+'/get_full_pay_calculation',
        data: {amount:'NA'},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
        	$("#you_pay").html('').html(Number(data).toString())
            $("#due_amount").html('').html(0)
            },
        error: function (xhr, status, error) {
            }
        });
    }
    else if (this.value == 'part_amount') {
    	$("#custom_pay").prop('disabled', false);
    }
});
//
$(document).on("keyup","#custom_pay",function(){
var amount=$(this).val()
   var APP_URL=jQuery("#base_url").val();
    $.ajax({
        url: APP_URL+'/get_custom_pay_calculation',
        data: {amount:amount},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
        	if(data<0)
        	{
        		alert('Please Check your amount cannot be greater than total amount')
          $("#you_pay").html('').html(Number(amount).toString())
          $("#due_amount").html('').html(data)
        	}
        	else
        	{
        	$("#you_pay").html('').html(Number(amount).toString())
            $("#due_amount").html('').html(data)
        	}
            },
        error: function (xhr, status, error) {
            }
        });
})
})
$('input[type=radio][name=amount]').change(function() {
    
    var amount_type=$(this).val()
    var APP_URL=jQuery("#base_url").val();
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: APP_URL+'/part_payment_type',
        data: {amount_type:amount_type},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
         
             $("#you_pay").html('').html(data.pay_now)
             $("#due_amount").html('').html(data.due_amount)
              // console.log(data.coupn_output)
          spinner.hide(); 
        
        },
        error: function (xhr, status, error) {
        }
        });
   
});
$(document).on("click",".not_allowed",function(){
alert('You can not change coupon once you applied')
})
//coupon_apply
$(document).on("click",".coupon_apply",function(){
var id=$(this).attr('id')
var type='coupon'
var amount_type=$("input[name='amount']:checked").val()

coupon_apply(id,type,amount_type)
})
$(document).on("click",".coupon_remove",function(){
var id=$(this).attr('id')
var type='coupon_remove'
var amount_type=$("input[name='amount']:checked").val()

coupon_apply(id,type,amount_type)
})

function coupon_apply(id,type,amount_type)
{
  var APP_URL=jQuery("#base_url").val();
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: APP_URL+'/coupon_apply',
        data: {id:id,type:type,amount_type:amount_type},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
            $(".coupon_class").html('').html(data.coupn_output)
            $(".custom_fee_taxes").html('').html(data.total_fee_taxes)
            $(".custom_gst").html('').html(data.gst_amount)
            $(".custom_tcs").html('').html(data.tcs_amount)
            $(".custom_pg").html('').html(data.booking_amount)
            $(".custom_grand_pay").html('').html(data.grand_total)
            $(".custom_grand_second").html('').html(data.grand_total)
            $(".custom_discount_coupn").html('').html(data.custom_discount_coupn)
            $(".custom_offer_show").html('').html(data.custom_offer_show)
            $(".custom_remaining").html('').html(data.custom_remaining)
            $(".custom_last").html('').html(data.custom_last)
            $(".custom_first_installment").html('').html(data.custom_first_installment)
            $(".custom_second_installment").html('').html(data.custom_second_installment)
            $(".custom_third_installment").html('').html(data.custom_third_installment)
             $("#you_pay").html('').html(data.pay_now)
             $("#due_amount").html('').html(data.due_amount)
              // console.log(data.coupn_output)
          spinner.hide(); 
        
        },
        error: function (xhr, status, error) {
        }
        });
}
// save_booking_details
$(document).on("submit", "#save_booking_details", function (e) {
	e.preventDefault()
	if($('#acknowledgement').is(':checked'))
	{
		var form = $('#save_booking_details')[0];
   var data = new FormData(form);
         var APP_URL=jQuery("#base_url").val();
    var spinner = $('#loader');
	spinner.show();
    $.ajax({
        url: APP_URL+'/save_booking_details',
        data: data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
        	  console.log(data)
          spinner.hide();
        var amount_type=$("input[name='amount']:checked").val()

       var token =  jQuery('input[name="_token"]').val()
		var content_action=APP_URL+'/payment-option';
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
		second_field.setAttribute("name", "amount_type");
		second_field.setAttribute("value", amount_type);
		form.appendChild(second_field);
		document.body.appendChild(form);
		document.body.appendChild(form);
		//window.open('', 'view');
		//window.open('','view' );
		form.submit();
		},
		error: function (xhr, status, error) {
		}
		});
		}
	else
	{
		alert('Pls Check Acknowledgement')
	}
})
//Add GSTIN Validation
function gstDetails(guestGST_no) {
	var gstnumber = document.getElementById("guestGST_no");
	var gstname = document.getElementById("guestGST_name");
	var gstemail = document.getElementById("guestGST_email");
	var gstmobile = document.getElementById("guestGST_mobile");
	var gststate = document.getElementById('guestGST_state');
	var gstaddress = document.getElementById('guestGST_address');
	var gstnumber_error = document.getElementById('guestGST_no_error');
	if (gstnumber.value.trim() != "") {
		//Enable the TextBox when TextBox has value.
		gstname.disabled = false;
		gstemail.disabled = false;
		gstmobile.disabled = false;
		gststate.disabled = false;
		gstaddress.disabled = false;
		gstname.style.borderColor = 'red';
		gstemail.style.borderColor = 'red';
		gstmobile.style.borderColor = 'red';
		gststate.style.borderColor = 'red';
		gstaddress.style.borderColor = 'red';
		<!--ADD VALIDATION: IF DATA LENGTH LESS THAN 2 CHARACTERS THEN ONLY MESSAGE APPEARED AND VICE VERSA-->
		gstnumber_error.innerHTML = 'Please enter a valid GST number';
		gstnumber_error.style.color = 'red';
		} else {
			//Disable the TextBox when TextBox is empty.
			gstname.disabled = true;
			gstemail.disabled = true;
			gstmobile.disabled = true;
			gststate.disabled = true;
			gstaddress.disabled = true;
			gstname.style.borderColor = '#9b9b9b';
			gstemail.style.borderColor = '#9b9b9b';
			gstmobile.style.borderColor = '#9b9b9b';
			gststate.style.borderColor = '#9b9b9b';
			gstaddress.style.borderColor = '#9b9b9b';
			gstnumber_error.innerHTML = '';
			}
    };
</script>
<script type="text/javascript">
    //
    $(document).on("change",".byear",function(){
         

        var year_val=$(this).val()
        year(year_val,'bmonth','bday');
    })
      $(document).on("change",".iyear",function(){
        var year_val=$(this).val()
        year(year_val,'imonth','iday');
    })
       $(document).on("change",".eyear",function(){
        var year_val=$(this).val()
        year(year_val,'emonth','eday');
    })
    function year(year_val,type,day)
    {
        var path= sessionStorage.getItem("path")
        var traveller_type=$("#"+path).attr('type')

        var type=type
        var year_val=year_val
         var day=day
           var APP_URL=jQuery("#base_url").val();
       
         var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: APP_URL+'/get_month',
        data: {type:type,year_val:year_val,traveller_type:traveller_type},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
              
            spinner.hide();
           $("."+type).html('').html(data)
           $("."+day).html('').html('<option selected disabled>DD</option>')
       console.log(data)
      
        },
        error: function (xhr, status, error) {
        }
        });

    }
     $(document).on("change",".bmonth",function(){
        var month_val=$(this).val()
        var year_val=$(".byear").val()
        month(year_val,month_val,'bday','a');
    })
     $(document).on("change",".imonth",function(){
        var month_val=$(this).val()
        var year_val=$(".iyear").val()
        month(year_val,month_val,'iday','a');
    })
     $(document).on("change",".emonth",function(){
        var month_val=$(this).val()
        var year_val=$(".eyear").val()
        month(year_val,month_val,'eday','b');
    })
        function month(year_val,month_val,day,type)
    {
        var month_val=month_val
        var year_val=year_val
         var day=day
         var type=type
           var APP_URL=jQuery("#base_url").val();
       var path= sessionStorage.getItem("path")
        var traveller_type=$("#"+path).attr('type')
         var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: APP_URL+'/get_day',
        data: {year_val:year_val,month_val:month_val,type:type,traveller_type:traveller_type},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
              
            spinner.hide();
        
           $("."+day).html('').html(data)
       console.log(data)
      
        },
        error: function (xhr, status, error) {
        }
        });

    }
    //deleteInfo
 
     $(document).on("click", ".deleteInfo", function (e) {
    e.preventDefault()
   var trav_id=$(".trav_id").val()
       
         var APP_URL=jQuery("#base_url").val();
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: APP_URL+'/delete_traveller',
        data: {trav_id:trav_id},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
              console.log(data)
          spinner.hide();
           var modal = document.getElementById("myModal");
        modal.style.display = "none";
       var path= sessionStorage.getItem("path")
      $("#"+path).siblings('.guestNameBox').children('.passenger_select').html('').html(data)
      $("#"+path).html('').html('<span class="fa-user"> </span> &nbsp;&nbsp;Add New')
        },
        error: function (xhr, status, error) {
        }
        });
     
   
})

    $(document).on("click", ".addModal", function () {
         $(".traveller_firstname").val('')
            $(".traveller_lastname").val('')
            $('.traveller_gender option[value=""]').prop('selected', true)
            
            $(".traveller_nationality").val('')
            $(".traveller_pancard").val('')
            $(".traveller_passportnumber").val('')
      var type=$(this).attr('type')
      const d = new Date();
      let year = d.getFullYear();
      if(type=='adult')
      {
        var output='';
        output +="<option value=''>YYYY</option>";
        for (let i = year-19; i >year-100; i--) {
       output +="<option value='"+i+"'>"+ i + "</option>";
             }
         $(".byear").html('').html(output)
      }
      else if(type=='child')
      {
         var output='';
        output +="<option value=''>YYYY</option>";
        for (let i = year-3; i >year-13; i--) {
       output +="<option value='"+i+"'>"+ i + "</option>";
             }
         $(".byear").html('').html(output)
      }
      else if(type=='infant')
      {
         var output='';
        output +="<option value=''>YYYY</option>";
        for (let i = year; i >year-3; i--) {
       output +="<option value='"+i+"'>"+ i + "</option>";
             }
         $(".byear").html('').html(output)
      }
 
      sessionStorage.setItem("path", $(this).attr('id'));
        $(".trav_id").val('')
        var selected_item=$(this).siblings('.guestNameBox').children('.passenger_select').val()
       if(selected_item!='')
       {
       $(".trav_id").val('').val(selected_item)
        var APP_URL=jQuery("#base_url").val();
        var button=$(this)
         var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: APP_URL+'/get_passenger_detail',
        data: {selected_item:selected_item},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
              console.log(data)
            spinner.hide();
            $(".traveller_firstname").val('').val(data.firstname)
            $(".traveller_lastname").val('').val(data.lastname)
            $('.traveller_gender option[value="'+data.gender+'"]').prop('selected', true)
            
            $(".traveller_nationality").val('').val(data.nationality)
            $(".traveller_pancard").val('').val(data.pancard)
            $(".traveller_passportnumber").val('').val(data.passportnumber)
       // console.log(data)
      
        },
        error: function (xhr, status, error) {
        }
        });
       }


   var modal = document.getElementById("myModal"); 
  modal.style.display = "block";
    })
// Get the modal
   var modal = document.getElementById("myModal"); 
// Get the button that opens the modal
// var btn = document.getElementById("addModal");
var btn = document.getElementsByClassName("addModal");
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
//
$(document).on("submit", "#save_traveller", function (e) {
    e.preventDefault()
   
        var form = $('#save_traveller')[0];
   var data = new FormData(form);
         var APP_URL=jQuery("#base_url").val();
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: APP_URL+'/save_traveller',
        data: data,
        type: 'post',
        contentType: false,
        processData: false,
        success: function (data) {
              console.log(data)
          spinner.hide();
           var modal = document.getElementById("myModal");
        modal.style.display = "none";
       var path= sessionStorage.getItem("path")
      $("#"+path).siblings('.guestNameBox').children('.passenger_select').html('').html(data)
      $("#"+path).html('').html('<span class="fa-user"> </span> &nbsp;&nbsp; Edit')
        },
        error: function (xhr, status, error) {
        }
        });
     
   
})
//passenger_select
$(document).on("click", ".passenger_select", function (e) {
    e.preventDefault()
   var select_item = $(this).find(":selected").val();
  if(select_item=='')
  {
    $(this).parent().siblings('.addNewGuest').html('').html('<span class="fa-user"> </span> &nbsp;&nbsp;Add New')
    select_item=0;
  }
  else
  {
    $(this).parent().siblings('.addNewGuest').html('').html('<span class="fa-user"> </span> &nbsp;&nbsp;Edit')
  }  
  var options = $('.passenger_select option:selected');

var values = $.map(options ,function(option) {
    return option.value;
})

      var button=$(this)
         var APP_URL=jQuery("#base_url").val();
  
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: APP_URL+'/get_passenger_select',
        data: {select_item:select_item,values:values},
        type: 'get',
        // contentType: false,
        // processData: false,
        success: function (data) {
              console.log(data)
          spinner.hide();
       button.html('').html(data)
       
        },
        error: function (xhr, status, error) {
        }
        });
     
   
})

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