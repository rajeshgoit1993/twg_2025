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


<div id="myModal" class="modal">
	<div class="addGuestInfoCont">
		<div class="addGuestInfoBox">
		<!--Traveller's Information-->
		<div class="boxHeader">
			<div>
				<h1 class="">Add Traveller's Info</h1>
			</div>
			<div class="deleteInfo" style="display: block"><i class="fa-trash" aria-hidden="true"></i>Delete</div>
		</div>
		<div class="infoCont">
			<ul>
				<li><a class="active" href="#basicinfo">BASIC INFO</a></li>
				<li><a href="#passportinfo">PASSPORT</a></li>
			</ul>
		</div>
		<!--Basic Info-->
		<div id="basicinfo" class="paddingTop20">
			<div class="basicInfoBox">
				<h1>Basic Information</h1>
				<h2>Basic info, like your email and number that you use on Personal Profile</h2>
			</div>
			<div class="row">
			<div class="makeflex">
				<div class="guestInputBox">
					<label for="firstname">First Name <span class="requiredcolor">*</span></label>
					<input type="text" name="firstname" placeholder="Enter First Name" required>
				</div>
				<div class="guestInputBox">				
					<label for="lastname">Last Name <span class="requiredcolor">*</span></label>
					<input type="text" name="lastname" placeholder="Enter Last Name" required>
				</div>
			</div>
			<div class="makeflex">
				<div class="guestInputBox">
					<label for="birthday">Birthday</label>
					<!--ADD VALIDATION: BIRTHDAY CANNOT BE GREATER THAN TODAY-->
					<input type="date" name="birthday" placeholder="Enter Date of Birth">
				</div>
				<div class="guestInputBox">
					<label for="gender">Gender</label>
					<select name="gender">
						<option selected disabled>Select</option>
						<option value="male">MALE</option>
						<option value="female">FEMALE</option>
					</select>
				</div>
			</div>
			</div>
		</div>
		<div class="lineSeparator"></div>
		<!--Passport Info-->
		<div id="passportinfo" style="margin-bottom: 275px;">
			<div class="passportInfoBox">
				<h1>Passport Details</h1>
				<h2>Add your Passport details for a faster flight booking experience</h2>
			</div>
			<div class="row">
				<div class="makeflex">
				<div class="guestInputBox">
					<label for="passportnumber">Passport Number</label>
					<input type="text" id="passportnumber" name="passportnumber" placeholder="Enter Passport Number" onkeyup="EnableDisable(this)" />
					<span id='validpassport'></span>
				</div>
				<div class="guestInputBox">
					<label for="passportcountry">Issuing Country</label>
					<!--ADD VALIDATION: SHOW COUNTRY LIST-->
					<select id="passportcountry" name="passportcountry" disabled="disabled">
						<option selected disabled>Select</option>
					</select>
				</div>
				</div>
				<div class="makeflex">
				<div class="guestInputBox">
					<label for="passportexpirydate">Expiry Date</label>
					<!--ADD VALIDATION: EXPIRY DATE CANNOT BE GREATER THAN 10 YEARS, COUNT FROM CURRENT DATE-->
					<input type="date" id="passportexpirydate" name="passportexpirydate" placeholder="Enter Passport Expiry Date" disabled="disabled" />
				</div>
				</div>
			</div>
		</div>
		</div>
		<div class="profile_stickyFooter">
			<div class="profileFooterCont">
				<button type="button" class="btnMain btnCancel appendRight30">Cancel</button>
				<input type="button" id="" name="submit" value="SAVE" class="btnMain btnSave"/>
			</div>
		</div>
	</div>
</div>

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