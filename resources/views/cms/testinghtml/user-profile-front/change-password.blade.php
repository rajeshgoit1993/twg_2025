@extends('layouts.front.masternofooter')
@section('content')
<style type="text/css">
.form-group {
	margin-bottom: 10px;
	}
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
	font-Weight: 900;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #008cff;
    }
.btnDisabled {
	display: inline-block;
	background: lightgray;
    /*padding: 4px 12px;*/
    font-size: 16px;
    line-height: 18px;
    color: #fff;
    text-align: center;
    vertical-align: middle;
	 -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
	-webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid lightgray;
    }
.btnColor4A {
	color: #4a4a4a !important;
	}
.btnBackgroundFFF {
	background: #ffffff !important;
	}
.btnRadius5 {
	-webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
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
input.input-text, date, select, input {
    background: white;
    border: 1px solid #9b9b9b;
    border-radius: 4px;
	font-size: 14px;
	line-height: 14px;
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
.showpassword {
	display: block;
	position: relative;
	font-size: 18px;
	color: #bbb;
	top: 0;
	left: 0;
	}
.showpassword > i {
	position: absolute;
	right: 15px;
	bottom: 12px;
	cursor: pointer
	}
</style>

<div class="white-background paddingAllTwenty borderRadius10 fullWidth borderCCC" style="max-width: 510px;margin: 0px auto;">
<section>
	<!--Change Password-->
	<div class="">
		<div class="">
			<div class="form-group">
				<h2 class="appendAllZero fontSize25 blackText fontWeight900">Change Password?</h2>
			</div>
		</div>
	</div>
	<div>
		<div class="">
			<div class="form-group">
				<label for="changePswrdOld" class="labelblackText">Old Password</label>
				<input type="text" class="input-text fullWidth" name="changePswrdOld" placeholder="Enter Old Password">
			</div>
		</div>
		<div class="">
			<div class="form-group">
				<label for="changePswrdNew" class="labelblackText">New Password</label>
				<input type="password" class="active input-text fullWidth paddingRight40" style="width: 100%" id="changePswrdNew" name="changePswrdNew" placeholder="Enter New Password" onkeyup='passwordcheck();' />
				<div class="showpassword"><i id="iconeye" class="fa fa-eye-slash"></i></div>
			</div>
		</div>
		<div class="">
			<div class="form-group">
				<label for="changePswrdConfirm" class="labelblackText">Confirm New Password</label>
				<input type="password" class="active input-text fullWidth paddingRight40" style="width: 100%" id="changePswrdConfirm" name="changePswrdConfirm" placeholder="Confirm New Password" onkeyup='passwordcheck();' />
				<div class="showpassword"><i id="iconeye" class="fa fa-eye-slash"></i></div>
				<span id='pwdmessage'></span>
			</div>
		</div>
		<div class="">
			<div class="form-group">
				<button type="button" data-dismiss="modal" class="btnnormal btnBackgroundFFF fontWeight900 btnColor4A appendRight30">Cancel</button>
				<input type="button" id="btnSubmit" name="submit" value="SUBMIT" class="btnDisabled btnRadius5 fontWeight900 paddingUpDown10 paddingLeftRight40" disabled="disabled"/>
			</div>
		</div>
	</div>
</section>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/gateway.js") }}'></script>
<script type="text/javascript">
//Password Check (User Profile)
function passwordcheck() {
	var newpassword = document.getElementById('changePswrdNew');
	var confirmpassword = document.getElementById('changePswrdConfirm');
	var message = document.getElementById('pwdmessage');
	regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

	if (newpassword.value == confirmpassword.value) {
		message.style.color = '#008cff';
		newpassword.style.borderColor = '#008cff';
		confirmpassword.style.borderColor = '#008cff';
		message.style.fontWeight = '600';
		message.innerHTML = 'Password matched';
		} else {
		message.style.color = 'red';
		newpassword.style.borderColor = 'red';
		confirmpassword.style.borderColor = 'red';
		message.style.fontWeight = '600';
		message.innerHTML = 'Re-enter the New password';
		}
	
	//Reference the Button. Enable Submit Button
	var btnSubmit = document.getElementById("btnSubmit");
	//Verify the TextBox value.
	if (confirmpassword.value == newpassword.value) {
		//Enable the TextBox when TextBox has value.
		btnSubmit.disabled = false;
		btnSubmit.style.backgroundColor = "#008cff";
		btnSubmit.style.borderColor = "#008cff";
		}
	else {
		//Disable the TextBox when TextBox is empty.
		btnSubmit.disabled = true;
		btnSubmit.style.backgroundColor = "lightgray";
		btnSubmit.style.borderColor = "lightgray";
		}														

	//Show Hide Password in text box
	icon = document.getElementById('iconeye');
	
	icon.onclick = function () {
		if(newpassword.className == 'active') {
			newpassword.setAttribute('type', 'text');
			icon.className = 'fa fa-eye';
			newpassword.className = '';
			} 
		else {
			newpassword.setAttribute('type', 'password');
			icon.className = 'fa fa-eye-slash';
			newpassword.className = 'active';
			}
		}
	}
</script>
@endsection