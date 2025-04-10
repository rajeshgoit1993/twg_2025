@extends('layouts.front.masternofooter')
@section('content')
 
<style type="text/css">
.fullWidth {
	width: 100%;
	}
.pfwmt {
	font-weight: 600;
	margin: 0px;
	text-align: left;
	}
.requiredcolor {
	color: #E12D2D;
	}
.blackText{
	color: #000000;
	}
.color008 {
	color: #008cff;
	}
.borderRadius10 {
	border-radius: 10px;
	}
.fontSize15 {
	font-size: 15px;
	}
.fontSize25 {
	font-size: 25px;
	}
.fontWeight500 {
	font-weight: 500;
	}
.fontWeight900 {
	font-weight: 900;
	}
.height40 {
	height: 40px;
	}
.paddingLeftRight40 {
	padding-left: 40px;
	padding-right: 40px;
	}
.makeflex {
	display: flex !important;
	display: -ms-flexbox !important;
	}
.alignitemsCenter {
	-ms-flex-align: center !important;
	align-items: center !important;
	}
.justifycontentEnd {
	-ms-flex-pack: end !important;
	justify-content: flex-end !important;
	}
.btnblueSend {
	display: inline-block;
	background: #008cff;
    /*padding: 4px 12px;*/
    font-size: 16px;
    line-height: 18px;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #008cff;
    }
.btnColor4A {
	color: #4a4a4a !important;
	}
.btnBackgroundFFF {
	background: #ffffff !important;
	}
.btnRadius25 {
	-webkit-border-radius: 25px;
    -moz-border-radius: 25px;
    border-radius: 25px;
	}
.btnnormal {
	display: inline-block;
    margin-bottom: 0;
    font-size: 14px;
    line-height: 16px;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
	}
.btnnormal:hover {
	border-color: #008cff;
	}
input.input-text, date, select {
    background: white;
    border: 1px solid #9b9b9b;
    border-radius: 4px;
    padding: 12px 16px;
    outline: 0;
	height: auto;
	}
input.input-text:focus{
    box-shadow: none;
	}
.labelblackText {
	color: #000001 !important;
	}
.appendTop15 {
	margin-top: 15px;
	}
.resendOTP {
	font-family: 'lato';
	max-width: 90px;
    text-decoration: underline;
    position: absolute;
    top: 55%;
    transform: translateY(-50%);
    right: 25px;
    cursor: pointer;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
.resendOTP .disabled {
    color: #c2c2c2 !important;
    opacity: 0.6;
    pointer-events: none;
    text-decoration-color: #c2c2c2 !important;
	}

</style>
<div class="white-background paddingAllTwenty borderRadius10 fullWidth borderCCC" style="max-width: 510px;margin: 0px auto;">
<section>
	<!--Verify Email ID-->
	<div class="">
		<div class="">
			<div class="form-group">
				<h4 class="appendAllZero fontSize12 color008 fontWeight900">BACK</h4>
			</div>
		</div>
		<div class="">
			<div class="form-group">
				<h2 class="appendAllZero fontSize25 blackText fontWeight900">Delete Mobile Number</h2>
				<p class="pfwmt fontWeight500">OTP has been sent to MOBILE</p>
			</div>
		</div>
	</div>
	<div class="appendTop15">
		<div class="" style="position: relative">
			<div class="form-group">
				<label for="firstname" class="labelblackText">OTP</label>
				<span class="resendOTP fontSize12 color008">Resend OTP</span>
				<input type="text" class="input-text full-width textCapitalize" name="firstname" placeholder="Enter OTP">
			</div>
		</div>
	</div>
	<div class="appendTop15 appendBottom15">
		<button type="button" data-dismiss="modal" class="btnnormal btnBackgroundFFF fontWeight900 btnColor4A appendRight30">Cancel</button>
		<input type="button" name="verify" value="VERIFY" class="btnblueSend fontWeight900 btnRadius5 paddingUpDown10 paddingLeftRight40" />
	</div>
</section>
</div>
@endsection