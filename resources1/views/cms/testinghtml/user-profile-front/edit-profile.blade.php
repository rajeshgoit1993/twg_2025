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
</style>
<div class="white-background paddingAllTwenty borderRadius10 fullWidth borderCCC" style="max-width: 510px;margin: 0px auto;">
<section>
	<!--Profile Details-->
	<div class="">
		<div class="">
			<div class="form-group">
				<h2 class="blackText fontWeight900">Edit Profile</h2>
			</div>
		</div>
	</div>
	<div class="appendTop15">
		<div class="">
			<div class="form-group">
				<label for="firstname" class="labelblackText">First Name <span class="requiredcolor">*</span></label>
				<input type="text" class="input-text full-width textCapitalize" name="firstname" placeholder="Enter First Name" required>
			</div>
		</div>
		<div class="">
			<div class="form-group">
				<label for="lastname" class="labelblackText">Last Name <span class="requiredcolor">*</span></label>
				<input type="text" class="input-text full-width textCapitalize" name="lastname" placeholder="Enter Last Name" required>
			</div>
		</div>
		<div class="">
			<div class="form-group">
				<label for="birthday" class="labelblackText">Birthday</label>
				<input type="date" class="input-text full-width textLowercase" name="birthday" placeholder="Enter Date of Birth">
			</div>
		</div>
		<div class="">
			<div class="form-group">
				<label for="gender" class="labelblackText">Gender</label>
				<select class="full-width" name="gender">
					<option selected disabled>Select</option>
					<option value="male">MALE</option>
					<option value="female">FEMALE</option>
				</select>
			</div>
		</div>
		<div class=""></div>
		<div class="">
			<div class="form-group">
				<label for="maritalstatus" class="labelblackText">Marital Status</label>
				<select class="full-width" name="maritalstatus" id="maritalstatus" onchange="ShowHideAnniversary()">
					<option selected disabled>Select</option>
					<option value="married">MARRIED</option>
					<option value="vouchered">SINGLE</option>
				</select>
			</div>
		</div>
		<div class="" id="anniversarydate" style="display: none">
			<div class="form-group">
				<label for="anniversary" class="labelblackText">Anniversary</label>
				<input type="date" class="input-text full-width" name="anniversary" placeholder="Enter Anniversary Date">
			</div>
		</div>
	</div>
	<div class="makeflex alignitemsCenter justifycontentEnd appendTop15 appendBottom15">
		<button type="button" data-dismiss="modal" class="btnnormal btnBackgroundFFF fontWeight900 btnColor4A appendRight30">Cancel</button>
		<input type="button" name="save" value="SAVE" class="btnblueSend fontWeight900 btnRadius5 paddingUpDown10 paddingLeftRight40" />
	</div>
</section>
</div>
<script type="text/javascript">
//showhide div element script
function ShowHideAnniversary() 
	//Anniversary Date
	{
	var maritalstatus = document.getElementById("maritalstatus");
	var anniversarydate = document.getElementById("anniversarydate");
	anniversarydate.style.display = maritalstatus.value == "married" ? "block" : "none";
    }
</script>
@endsection