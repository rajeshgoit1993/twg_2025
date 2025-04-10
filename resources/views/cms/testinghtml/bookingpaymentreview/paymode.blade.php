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
.leftContainer {
	flex: 1;
	padding-right: 30px;
	}
.rightContainer {
	width: 350px;
	}
.pageContainer {
    width: 1200px;
    margin: 0 auto;
}
.flexcenter, .flexCenter {
    display: flex;
    align-items: center;
}
.flex-row-multicolum {
    display: flex;
    flex-flow: row wrap;
}
.fullWidth {
    width: 100%;
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
.formGroup {
    margin-bottom: 10px;
}
.formLabel {
    display: block;
    font-size: 14px;
    line-height: 16px;
    font-weight: 600;
    color: #000001 !important;
    margin-right: 0px !important;
    margin-bottom: 5px;
}
.formInput {
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
}
.error {
    color: red;
}
.appendTop20 {
    margin-top: 20px;
}
</style>
<style type="text/css">
.defaultCurencyPay:before {
	content: '\0020B9';
	font-weight: 500;
	}
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
.paymentWrapperBG {
	background: #f2f2f2;
	}
.paymentWrapper {
	display: flex;
	padding-top: 20px;
	}
.PanCardCont {
	margin-top: 0;
	margin-bottom: 20px;
	}
.PanCardCont h2 {
	font-size: 20px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 3px;
	}
.PanCardCont p {
	font-size: 12px;
	line-height: 18px;
	color: #747474;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.PanCardVerifyBox {
	padding: 25px;
	margin-top: 15px;
	border: 1px solid #CED0D4;
	border-radius: 5px;
	background: #fff;
	}
.panCardLogoBox {
    width: 34px;
    height: auto;
    overflow: hidden;
    margin: 0 10px 20px 0;
    border-radius: 3px;
    display: flex;
    flex-shrink: 0;
	}
.panCardLogo {
    height: 20px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.panCheckBox {
	width: 30px;
	height: 20px;
	margin: 0px 10px 0px 0px !important;
	}
.paymentModeCont {
	margin-top: 0;
	}
.paymentModeCont h2 {
	font-size: 24px;
	line-height: 24px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.paymentModeCont h3 {
	font-size: 14px;
	line-height: 14px;
	color: #9B9B9B;
	font-weight: 600;
	text-align: left;
	margin-bottom: 20px;
	}
.slectPayModeCont {
	padding: 30px;
	border: 1px solid #e7e7e7;
	border-radius: 10px;
	background: #fff;
	}
.paymentBox {
	padding: 20px;
	background: #ffffff;
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	margin-bottom: 20px;
	cursor: pointer;
	display: flex;
	align-items: center;
	justify-content: space-between;
	}
.paymentBox:active {
	background-color: #F2FFFB;
	border-color: #CCEAFF;
	}
.paymentBox:hover {
	background-color: #F2FFFB;
	border-color: #CCEAFF;
	color: #000001;
	}
.payModeLogoBox {
    width: 34px;
    height: auto;
    overflow: hidden;
    margin: 0 10px 0 0;
    border-radius: 3px;
    display: flex;
    flex-shrink: 0;
	}
.payModeLogo {
    height: 20px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.selectPay {
	color: #0061E6;
	font-size: 18px;
	font-weight: 600;
	}
.paymentBox:hover .selectPay {
	/*color: #008cff;*/
	}
.bkngSumryCont {
	border: 1px solid #e7e7e7;
	border-radius: 10px;
	background: #fff;
	margin-bottom: 20px;
	cursor: default;
	}
.bkngSumryContTtl {
	padding: 15px 30px;
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 900;
	text-align: left;
	margin-bottom: 0;
	}
.bkngSumryBox {
	display: flex;
	flex-direction: column;
	padding: 10px 30px 20px;
	border-top: 2px solid #e7e7e7;
	border-bottom: 1px solid #e7e7e7;
	}
.bkngSumryBox h3 {
	font-size: 15px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 20px;
	}
.bkngSumryOrigin {
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.bkngSumryDate {
	font-size: 15px;
	line-height: 18px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.bkngSumryDays {
	font-size: 13px;
	line-height: 14px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	opacity: .75;
	}
.bkngSumryTrvlrsBox {
	display: flex;
	flex-direction: column;
	padding: 10px 30px 20px;
	border-top: 0;
	border-bottom: 0;
	}
.bkngSumryTrvlrsBox h3 {
	font-size: 16px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	}
.bkngSumryTrvlrsBox h4 {
	font-size: 12px;
	line-height: 14px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	text-transform: uppercase;
	}
.bkngSumryTrvlrsBox h5 {
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.bkngSumryTrvlrsBox h6 {
	font-size: 12px;
	line-height: 14px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.fareSumryCont {
	border: 1px solid #e7e7e7;
	border-bottom: 0;
	border-radius: 10px 10px 0 0;
	background: #fff;
	margin-bottom: 0;
	cursor: default;
	}
.fareSumryContTtl {
	padding: 15px 30px;
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 900;
	text-align: left;
	margin-bottom: 0;
	border-bottom: 1px solid #e7e7e7;
	}
.fareSumryBox {
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	padding: 15px 30px;
	border-top: 1px solid #e7e7e7;
	}
.fareSumryBox h3 {
	font-size: 16px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.fareSumryBox h5 {
	font-size: 12px;
	line-height: 20px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.fareSumryBox h2 {
	font-size: 18px;
	line-height: 18px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.amountPayBox {
	border: 1px solid #e7e7e7;
	border-bottom: 0;
	border-radius: 0;
	/*background: #F2FFFB;*/
	background: #fff;
	margin-bottom: 0;
	cursor: default;
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	padding: 20px 30px;
	}
.amountPayBox h2 {
	font-size: 20px;
	line-height: 24px;
	color: #000001;
	font-weight: 900;
	text-align: left;
	margin-bottom: 0;
	}
.amountDueBox {
	border: 1px solid #e7e7e7;
	border-top: 0;
	border-radius: 0 0 10px 10px;
	background: #FFFDF5;
	margin-bottom: 20px;
	cursor: default;
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	padding: 20px 30px;
	}
.amountDueBox h2, .amountPaidBox h2 {
	font-size: 16px;
	line-height: 16px;
	color: #F79F1A;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.amountPaidBox {
	border: 1px solid #e7e7e7;
	border-top: 0;
	border-radius: 10px;
	background: #FFFDF5;
	margin-bottom: 20px;
	cursor: default;
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	padding: 20px 30px;
	}
.priceitemlist {
	font-size: 15px;
	font-weight: 600;
	margin: 0px;
	color: #000001;
	}
.pkgdetails {
	font-size: 12px;
	font-weight: 600;
	color: #a1a1a1;
	text-align: left;
	}
/*Mobile Paymode Page*/
.mreviewCont {
	padding: 15px;
	background: #fff;
	border-top: 1px solid #CED0D4;
	border-bottom: 1px solid #CED0D4;
	display: flex;
	align-items: center;
	}
.mreviewTitle {
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
.mBkngCont {
	padding: 15px;
	background: #F2F2F2;
	}
.mBkngContTtl {
	font-size: 16px;
	line-height: 16px;
	color: #4A4A4A;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	}
.mBkngSumryCont {
	border: 1px solid #e7e7e7;
	border-radius: 10px;
	background: #fff;
	margin-bottom: 20px;
	cursor: default;
	}
.mBkngSumryContTtl {
	padding: 15px;
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 900;
	text-align: left;
	margin-bottom: 0;
	}
.mBkngSumryBox {
	display: flex;
	flex-direction: column;
	padding: 15px;
	border-top: 2px solid #e7e7e7;
	border-bottom: 1px solid #e7e7e7;
	}
.mBkngSumryBox h3 {
	font-size: 16px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 20px;
	}
.mBkngSumryOrigin {
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.mBkngSumryDate {
	font-size: 18px;
	line-height: 18px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.mBkngSumryDays {
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	opacity: .75;
	}
.mBkngSumryTrvlrsBox {
	display: flex;
	flex-direction: column;
	padding: 15px;
	border-top: 0;
	border-bottom: 0;
	}
.mBkngSumryTrvlrsBox h3 {
	font-size: 16px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	}
.mBkngSumryTrvlrsBox h4 {
	font-size: 12px;
	line-height: 14px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	text-transform: uppercase;
	}
.mBkngSumryTrvlrsBox h5 {
	font-size: 14px;
	line-height: 14px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.mBkngSumryTrvlrsBox h6 {
	font-size: 12px;
	line-height: 14px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	}
.mFareSumryCont {
	border: 1px solid #e7e7e7;
	border-bottom: 0;
	border-radius: 10px 10px 0 0;
	background: #fff;
	margin-bottom: 0;
	cursor: default;
	}
.mFareSumryContTtl {
	padding: 15px;
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 900;
	text-align: left;
	margin-bottom: 0;
	border-bottom: 1px solid #e7e7e7;
	}
.mFareSumryBox {
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	padding: 15px;
	border-top: 1px solid #e7e7e7;
	}
.mFareSumryBox h3 {
	font-size: 16px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mFareSumryBox h5 {
	font-size: 12px;
	line-height: 20px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mFareSumryBox h2 {
	font-size: 18px;
	line-height: 18px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mAmountPayBox {
	border: 1px solid #e7e7e7;
	border-bottom: 0;
	border-radius: 0;
	/*background: #F2FFFB;*/
	background: #fff;
	margin-bottom: 0;
	cursor: default;
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	padding: 15px;
	}
.mAmountPayBox h2 {
	font-size: 20px;
	line-height: 24px;
	color: #000001;
	font-weight: 900;
	text-align: left;
	margin-bottom: 0;
	}
.mAmountDueBox {
	border: 1px solid #e7e7e7;
	border-top: 0;
	border-radius: 0 0 10px 10px;
	background: #FFFDF5;
	margin-bottom: 20px;
	cursor: default;
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	padding: 15px;
	}
.mAmountDueBox h2, .mAmountPaidBox h2 {
	font-size: 16px;
	line-height: 16px;
	color: #F79F1A;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mAmountPaidBox {
	border: 1px solid #e7e7e7;
	border-top: 0;
	border-radius: 10px;
	background: #FFFDF5;
	margin-bottom: 20px;
	cursor: default;
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	padding: 15px;
	}
.mPanCardCont {
	margin-top: 0;
	margin-bottom: 20px;
	}
.mPanCardCont h2 {
	font-size: 20px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.mPanCardCont p {
	font-size: 12px;
	line-height: 18px;
	color: #747474;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	}
.mPanCardVerifyBox {
	padding: 25px;
	margin-top: 15px;
	border: 1px solid #CED0D4;
	border-radius: 5px;
	background: #fff;
	}
.mPanCardLogoBox {
    width: 34px;
    height: auto;
    overflow: hidden;
    margin: 0 10px 20px 0;
    border-radius: 3px;
    display: flex;
    flex-shrink: 0;
	}
.mPanCardLogo {
    height: 20px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.mPanCheckBox {
	width: 18px;
	height: 18px;
	margin: 0px 10px 0px 0px !important;
	flex-shrink: 0;
	}
.mPaymentModeCont {
	margin-top: 0;
	}
.mPaymentModeCont h2 {
	font-size: 20px;
	line-height: 20px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.mPaymentModeCont h3 {
	font-size: 14px;
	line-height: 14px;
	color: #9B9B9B;
	font-weight: 600;
	text-align: left;
	margin-bottom: 20px;
	}
.mSlectPayModeCont {
	padding: 20px;
	border: 1px solid #e7e7e7;
	border-radius: 10px;
	background: #fff;
	}
.mPaymentBox {
	padding: 14px;
	background: #fff;
	border: 1px solid #e7e7e7;
	border-radius: 3px;
	margin-bottom: 20px;
	cursor: default;
	display: flex;
	align-items: center;
	justify-content: space-between;
	}
.mPaymentBox:last-child {
	margin-bottom: 0;
	}
.mPaymentBox:active {
	background-color: #F2FFFB;
	border-color: #CCEAFF;
	}
.mPaymentBox:hover {
	background-color: #F2FFFB;
	border-color: #CCEAFF;
	color: #000001;
	}
.mPayModeLogoBox {
    width: 34px;
    height: auto;
    overflow: hidden;
    margin: 0 10px 0 0;
    border-radius: 3px;
    display: flex;
    flex-shrink: 0;
	}
.mPayModeLogo {
    height: 20px;
    width: 100%;
    vertical-align: middle;
    border: 0;
    border-radius: 3px;
    pointer-events: none !important;
    display: flex;
    flex-shrink: 0;
	}
.mPaymentoption {
	color: #747474;
	font-size: 16px;
	font-weight: 600
	}
.mSelectPay {
	color: #0061E6;
	font-size: 18px;
	font-weight: 600;
	}
.mReivewPriceBarCont {
	width: 100%;
	height: 60px;
	background: #000001;
	position: fixed;
	z-index:999;
	bottom: 0;
	}
.mReivewPriceBarBox {
	padding: 10px 20px;
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
	width: 100px;
	height: 36px;
	}
</style>
<style type="text/css">
.reviewstyle {
	padding: 15px 30px;
	background: #000000;
	margin-bottom: 15px;
}
.reviewheading {
	color: #fff;
	margin: 0px;
}
.flexmargin {
	margin: 0px 3% 30px 4%;
	display: flex;
	justify-content: space-between;
}

.flexcenter {
	display: flex;
	align-items: center;
	}
.flexcolumn {
	display: flex;
	flex-direction: column;
	}
.pandetail {
	margin-bottom: 10px;
	font-size: 14px;
	font-weight: bold;
	color: #4a4a4a !important;
	}
.paninput {
	color: #4a4a4a;
	border: 1px solid #A1A1A1 !important;
	border-radius: 5px;
	height: 36px !important;
	background: #ffffff !important;
	width: 350px;
	}
.pancheckbox {
	width: 30px;
	height: 20px;
	margin: 0px 10px 0px 0px !important;
	}
.panlabel {
	font-size: 12px;
	color: #747474 !important;
	font-weight: 600;
	}

.mpaymentbox {
	padding: 15px 20px;
	background: #ffffff;
	border: 1px solid #CED0D4;
	margin-bottom: 20px;
	cursor: pointer;
	}

.mpaymentbox:active {
	background-color: #F2FFFB;
	border-color: #CCEAFF;
	}

.mpaymentbox:hover {
	background-color: #F2FFFB;
	border-color: #CCEAFF;
	}
.paymentoption {
	margin: 0px;
	color: #747474;
	font-size: 18px;
	font-weight: 600
	}

.pkgdetails {
	font-size: 12px;
	font-weight: 600;
	color: #a1a1a1;
	text-align: left;
	}
.priceitemlist {
	font-size: 15px;
	font-weight: 600;
	margin: 0px;
	color: #000001;
	}

</style>

<div class="destop_test_exp">
<div class="reviewCont">
	<div class="pageContainer">
		<h3 class="reviewTitle">Payment</h3>
	</div>
</div>
	<!--<div class="" style="padding: 15px 30px;background: #000000;margin-bottom: 15px;">
		<h3 style="color: #fff;margin: 0px;">Select Payment Mode</h3>
	</div>-->
<section>
<div class="paymentWrapperBG">
<div class="pageContainer">
	<!--Traveller Information-->
	<div class="paymentWrapper">
		<div class="leftContainer">
			<div class="PanCardCont" style="display: ">
			<!--Traveller Pan Card Details starts-->
			<div>
				<h2>PAN Details</h2>
				<p>As per Income Tax Act 1961, the TCS @5% has been added to amount payable for booking overseas tour package. You will be able to claim credit of such TCS amount against Income Tax payable at time of filing return against the PAN shared.</p>
			</div>
			<div class="PanCardVerifyBox">
				<div class="flexCenter">
					<div class="panCardLogoBox">
						<img class="panCardLogo" src="" title="Pan card">
					</div>
					<!--<div>
						<img width="34" height="20" src="" title="Pan Card"style="border-radius: 3px;margin-top: 18px;margin-right: 15px">
					</div>-->
					<div>
						<div class="flex-row-multicolum fullWidth">
							<div class="flex-col-md-6">
								<div class="formGroup">
									<label for="pancardnumber" class="formLabel">Enter PAN Card Number</label>
									<input class="formInput" type="text"  value="" name="pancardnumber" maxlength="10" placeholder="Enter your PAN No" />
									<span class="error" id="pannumber_error"></span>
								</div>
							</div>
							<div class="flex-col-md-6">
								<div class="formGroup">
									<label for="pancardname" class="formLabel">Enter Name on PAN CARD</label>
									<input class="formInput" type="text" value="" name="pancardname" placeholder="Enter name on PAN Card" />
									<span class="error" id="panname_error"></span>
								</div>
							</div>
						</div>
						<div class="flex-col-md-12">
							<div class="makeflex">
								<input type="checkbox" class="panCheckBox" name="panacceptance" value="panacceptance">
								<label for="panacceptance" class="panlabel">Confirm that the PAN Card provided here belongs to the lead passenger of this booking, Incorrect PAN details will delay service confirmation, so please recheck the PAN Number before submission</label>
								<span class="error" id="confirmpancard_error"></span>
							</div>
						</div>
					</div>
					<!--<div>
					<div class="flex-column appendRight20" style="">
						<label class="pandetail">Enter PAN Card Number</label>
						<input class="input-text paninput" type="text"  value="" id="pancardnumber" name="pancardnumber" placeholder="ENTER YOUR PAN NUMBER"   required="required" />
						<span class="error" id="pancardnumber_error"></span>
					</div>
					<div class="flex-column">
						<label class="pandetail">Enter Name on PAN CARD</label>
						<input class="input-text paninput"  type="text" value="" id="pancardname" name="pancardname" placeholder="Enter Name on PAN Card" required="required"/>
						<span class="error" id="pancardname_error"></span>
					</div>
					</div>-->
				</div>
				<!--<div class="flexcenter" style="margin-top: 5px;margin-left: 50px;">
					<input type="checkbox" id="confirmpancard" name="confirmpancard" value="confirmpancard" class="pancheckbox">
					<label for="confirmpancard" class="panlabel">Confirm that the PAN Card provided here belongs to the lead passenger of this booking, Incorrect PAN details will delay service confirmation, so please recheck the PAN Number before submission</label>
				</div>-->
			</div>
			</div>
			<!--Payment gateway options starts-->
			<div class="paymentModeCont">
				<div>
					<h2>Payment Options</h2>
					<h3>Select your payment options</h3>
				</div>
				<div class="slectPayModeCont">
					<div class="paymentBox">
						<div class="flexCenter">
						<div class="payModeLogoBox">
							<img class="payModeLogo" src="" title="">
						</div>
						<div class="paymentoption">UPI</div>
						<!--<div class="flexCenter">
							<i class="fa fa-credit-card" aria-hidden="true" style="margin-right: 20px"></i>
							<span class="paymentoption">UPI</span>
						</div>-->
						</div>
						<div class="selectPay">Select & PAY</div>
					</div>
					<div class="paymentBox">
						<div class="flexCenter">
						<div class="payModeLogoBox">
							<img class="payModeLogo" src="" title="">
						</div>
						<div class="paymentoption">Credit Card</div>
						<!--<div class="flexCenter">
							<i class="fa fa-credit-card" aria-hidden="true" style="margin-right: 20px"></i>
							<span class="paymentoption">UPI</span>
						</div>-->
						</div>
						<div class="selectPay">Select & PAY</div>
					</div>
					<div class="paymentBox">
						<div class="flexCenter">
						<div class="payModeLogoBox">
							<img class="payModeLogo" src="" title="">
						</div>
						<div class="paymentoption">Debit Card</div>
						<!--<div class="flexCenter">
							<i class="fa fa-credit-card" aria-hidden="true" style="margin-right: 20px"></i>
							<span class="paymentoption">UPI</span>
						</div>-->
						</div>
						<div class="selectPay">Select & PAY</div>
					</div>
					<div class="paymentBox">
						<div class="flexCenter">
						<div class="payModeLogoBox">
							<img class="payModeLogo" src="" title="">
						</div>
						<div class="paymentoption">Net Banking</div>
						<!--<div class="flexCenter">
							<i class="fa fa-credit-card" aria-hidden="true" style="margin-right: 20px"></i>
							<span class="paymentoption">UPI</span>
						</div>-->
						</div>
						<div class="selectPay">Select & PAY</div>
					</div>
				</div>
			</div>
			<!--Payment gateway options ends-->
		</div>
		<!--Sidebar starts-->
		<div class="rightContainer">
			<div class="bkngSumryCont">
				<div class="bkngSumryContTtl">Booking Summary</div>
				<div class="bkngSumryBox">
					<div>
						<h3>Dubai Shopping Festival 2021 with - 5 Star Hotel</h3>
					</div>
					<div class="flex-column">
						<div class="bkngSumryOrigin">From New Delhi</div>
						<div class="bkngSumryDate">15 June - 22 June</div>
						<div class="bkngSumryDays" style="">7 Nights / 8 Days</div>
					</div>
				</div>
				<div class="bkngSumryTrvlrsBox">
					<div>
						<h3>Traveler(s)</h3>
					</div>
					<div>
						<h5>2 Adults, 2 Children, 1 Infant</h5>
						<h4>2 Rooms</h4>
					</div>
					<div class="appendTop20">
						<!--<h4>Contact Details</h4>-->
						<!--<p class="pkgdetails" style="margin: 0px 0px 3px 0px;">CONTACT DETAILS</p>-->
						<h6><i class="fa fa-envelope" aria-hidden="true"></i>&ensp; nick.mason@gmail.com</h6>
						<h6><i class="fa fa-phone" aria-hidden="true"></i>&emsp;9810098100</h6>
					</div>
				</div>
			</div>
			<!--Fare summary-->
			<div class="fareSumryCont">
				<div class="fareSumryContTtl">Fare Summary</div>
				<!--<p class="pkgdetails" style="margin: 0px 0px 3px 0px;">FARE SUMMARY</p>-->
				<div class="fareSumryBox">
					<div>
						<h3>Total Basic Cost</h3>
						<h5>2 Adults, 2 Children, 1 Infant</h5>
					</div>
					<div>
						<h3><span class="defaultCurencyPay">&nbsp;18,792</span></h3>
					</div>
				</div>
				<div class="fareSumryBox">
					<div>
						<h3>Discount (-)</h3>
						<!--<h5>Coupon applied</h5>-->
					</div>
					<div>
						<h3><span class="defaultCurencyPay">&nbsp;0</span></h3>
					</div>
				</div>
				<div class="fareSumryBox">
					<div>
						<h2>Total Due</h2>
					</div>
					<div>
						<h2><span class="defaultCurencyPay">&nbsp;18,792</span></h2>
					</div>
				</div>
			</div>
			<div class="amountPayBox">
				<div>
					<h2>Amount Payable Now</h2>
				</div>
				<div>
					<h2><span class="defaultCurencyPay">&nbsp;18,792</span></h2>
				</div>
			</div>
			<div class="amountDueBox">
				<div>
					<h2>Amount Payable Later</h2>
				</div>
				<div>
					<h2><span class="defaultCurencyPay">&nbsp;18,792</span></h2>
				</div>
			</div>
			<div class="amountPaidBox">
				<div>
					<h2>Amount Paid</h2>
				</div>
				<div>
					<h2><span class="defaultCurencyPay">&nbsp;0</span></h2>
				</div>
			</div>
		</div>
		<!--Sidebar ends-->
	</div>
</div>
</div>
</section>
</div>

<div class="mobile_test_exp">
	<div class="mreviewCont">
		<h3 class="fa-arrow-left mreviewTitle">Payment</h3>
	</div>
<section>
	<div class="mBkngCont">
		<div class="mBkngContTtl">BOOKING SUMMARY</div>
			<!--Booking Summary starts-->
			<div style="">
				<div class="mBkngSumryCont">
					<div class="mBkngSumryContTtl">Booking Details</div>
					<div class="mBkngSumryBox">
						<div>
							<h3>Dubai Shopping Festival 2021 with - 5 Star Hotel</h3>
						</div>
						<div class="flex-column">
							<div class="mBkngSumryOrigin">From New Delhi</div>
							<div class="mBkngSumryDate">15 June - 22 June</div>
							<div class="mBkngSumryDays" style="">7 Nights / 8 Days</div>
						</div>
					</div>
					<div class="mBkngSumryTrvlrsBox">
						<div>
							<h3>Traveler(s)</h3>
						</div>
						<div>
							<h5>2 Adults, 2 Children, 1 Infant</h5>
							<h4>2 Rooms</h4>
						</div>
						<div class="appendTop20">
							<h6><i class="fa fa-envelope" aria-hidden="true"></i>&ensp; nick.mason@gmail.com</h6>
							<h6><i class="fa fa-phone" aria-hidden="true"></i>&emsp;9810098100</h6>
						</div>
					</div>
				</div>
				<div class="mFareSumryCont">
					<div class="mFareSumryContTtl">Fare Details</div>
					<div class="mFareSumryBox">
						<div>
							<h3>Total Cost</h3>
							<h5>2 Adults, 2 Children, 1 Infant</h5>
						</div>
						<div>
							<h3><span class="defaultCurencyPay">&nbsp;18,792</span></h3>
						</div>
					</div>
					<div class="mFareSumryBox">
						<div>
							<h3>Discount (-)</h3>
							<!--<h5>Coupon applied</h5>-->
						</div>
						<div>
							<h3><span class="defaultCurencyPay">&nbsp;0</span></h3>
						</div>
					</div>
					<div class="mFareSumryBox">
						<div>
							<h2>Total Due</h2>
						</div>
						<div>
							<h2><span class="defaultCurencyPay">&nbsp;18,792</span></h2>
						</div>
					</div>
				</div>
				<div class="mAmountPayBox">
					<div>
						<h2>Amount Payable Now</h2>
					</div>
					<div>
						<h2><span class="defaultCurencyPay">&nbsp;18,792</span></h2>
					</div>
				</div>
				<div class="mAmountDueBox">
					<div>
						<h2>Amount Payable Later</h2>
					</div>
					<div>
						<h2><span class="defaultCurencyPay">&nbsp;18,792</span></h2>
					</div>
				</div>
				<div class="mAmountPaidBox">
					<div>
						<h2>Amount Paid</h2>
					</div>
					<div>
						<h2><span class="defaultCurencyPay">&nbsp;0</span></h2>
					</div>
				</div>
			</div>
			<!--Booking Summary ends-->
			<!--Traveller Information-->
			<div class="mPanCardCont">
				<!--Traveller Pan Card Details starts-->
				<div>
					<h2>PAN Details</h2>
					<p>As per Income Tax Act 1961, the TCS @5% has been added to amount payable for booking overseas tour package. You will be able to claim credit of such TCS amount against Income Tax payable at time of filing return against the PAN shared.</p>
				</div>
				<div class="mPanCardVerifyBox">
					<div class="flex-row-multicolum fullWidth">
						<div class="flex-col-md-6" style="margin-bottom: 15px;">
							<div class="formGroup">
								<label for="pancardnumber" class="formLabel">Enter PAN Card Number</label>
								<input class="formInput" type="text"  value="" name="pancardnumber" maxlength="10" placeholder="Enter your PAN No" />
								<span class="error" id="pannumber_error"></span>
							</div>
						</div>
						<div class="flex-col-md-6">
							<div class="formGroup">
								<label for="pancardname" class="formLabel">Enter Name on PAN CARD</label>
								<input class="formInput" type="text" value="" name="pancardname" placeholder="Enter name on PAN Card" />
								<span class="error" id="panname_error"></span>
							</div>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="makeflex">
							<input type="checkbox" class="mPanCheckBox" name="panacceptance" maxlength="10" value="panacceptance">
							<label for="panacceptance" class="panlabel">Confirm that the PAN Card provided here belongs to the lead passenger of this booking, Incorrect PAN details will delay service confirmation, so please recheck the PAN Number before submission</label>
							<span class="error" id="confirmpancard_error"></span>
						</div>
					</div>
				</div>
			</div>
			<!--Payment gateway options starts-->
			<div class="mPaymentModeCont">
				<div>
					<h2>Payment Options</h2>
					<h3>Select your payment options</h3>
				</div>
				<div class="mSlectPayModeCont">
					<div class="mPaymentBox">
						<div class="flexCenter">
						<div class="mPayModeLogoBox">
							<img class="mPayModeLogo" src="" title="">
						</div>
						<div class="mPaymentoption">UPI</div>
						</div>
						<div class="mSelectPay">Select</div>
					</div>
					<div class="mPaymentBox">
						<div class="flexCenter">
						<div class="mPayModeLogoBox">
							<img class="mPayModeLogo" src="" title="">
						</div>
						<div class="mPaymentoption">Credit Card</div>
						</div>
						<div class="mSelectPay">Select</div>
					</div>
					<div class="mPaymentBox">
						<div class="flexCenter">
						<div class="mPayModeLogoBox">
							<img class="mPayModeLogo" src="" title="">
						</div>
						<div class="mPaymentoption">Debit Card</div>
						</div>
						<div class="mSelectPay">Select</div>
					</div>
					<div class="mPaymentBox">
						<div class="flexCenter">
						<div class="mPayModeLogoBox">
							<img class="mPayModeLogo" src="" title="">
						</div>
						<div class="mPaymentoption">Net Banking</div>
						</div>
						<div class="mSelectPay">Select</div>
					</div>
				</div>
			</div>
			<!--Payment gateway options ends-->
	</div>
	<!--Mobile Pricebar starts-->
	<div class="mReivewPriceBarCont">
		<div class="mReivewPriceBarBox">
			<div class="mReviewPriceBox">
				<p class="mPayblPrcVal"><span class="defaultCurencyPay">&nbsp;18,792</span></p>
				<p class="mPayblPrcValTag">Payable Now</p>				
			</div>
			<div>
				<div class="mLineSeprtr">|</div>
				<button type="button" class="btnMain btnProceedMob">PAY</button>
			</div>
		</div>
	</div>
	<!--Mobile Pricebar ends-->
		<!--Mobile Pricebar starts--
		<div style="width: 100%;height: 60px;background-color: black;position: fixed;bottom: 0px;z-index:999">
			<div style="padding: 10px 20px;display: flex;align-items: center;justify-content: space-between">
				<div class="" style="padding: 0px">
					<span style="color: white;font-size: 16px;">&#x20B9;</span> <span style="color: white;font-size: 20px;font-weight: 600">2,000</span>
					<span style="color: #CED0D4;font-size: 10px;">Total Payable</span>
				</div>
				<div>
					<div style="border-left: 1px solid white;height: 35px;margin-left: -5%;position: absolute;">|</div>
					<button class="button" style="padding: 0px 50px;height: 40px;border-radius: 25px;font-size: 16px;font-weight: bold;background-color: #08B2ED;" id="pgpage">PAY</button>
				</div>
			</div>
		</div>
	<!--Mobile Pricebar ends-->
</section>
</div>
@endsection
