<!--Add Traveller Info (Desktop-Mobile)-popup-->
<form id="save_traveller" name="save_traveller" method="post">
	{{csrf_field()}}
	<input type="hidden" name="trav_id" class="trav_id" value="">
	<input type="hidden" name="unique_code" id="unique_code" value="{{$unique_code}}">
	<div id="myModal" class="modal-save-traveller">
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
					<ul class="inftoTab">
						<li class="tablinks" id="defaultOpen" onclick="openInfo(event, 'basicinfo')">BASIC INFO</li>
						<li class="tablinks" onclick="openInfo(event, 'passportinfo')">PASSPORT</li>
					</ul>
				</div>
				<!--Basic Info-->
				<div id="basicinfo" class="tabContent paddingTop20" style="margin-bottom: 275px;">
					<div class="basicInfoBox">
						<h1>Basic Information</h1>
						<h2>Basic info, like your name and nationality that you use on Personal Profile</h2>
					</div>
					<div class="row">
					<div class="makeflex">
						<div class="guestInputBox">
							<label for="firstname">First Name <span class="requiredcolor">*</span></label>
							<input type="text" name="firstname" placeholder="Enter First Name" class="traveller_firstname" required>
						</div>
						<div class="guestInputBox">				
							<label for="lastname">Last Name <span class="requiredcolor">*</span></label>
							<input type="text" name="lastname" placeholder="Enter Last Name" class="traveller_lastname" required>
						</div>
					</div>
					<div class="makeflex">
						<div class="guestInputBox">
							<label for="birthday">Birthday</label>
							<!--ADD VALIDATION: BIRTHDAY CANNOT BE GREATER THAN TODAY-->
							<!--<input type="date" name="birthday" placeholder="Enter Date of Birth">-->
							<!--Drop Down Box-->
							<div class="makeflex ">
								<div class="clearfix"></div>
								<div class="select-arrow down-arrow relativeCont flexOne">
					                <select name="year" class="byear" style="border-radius: 4px 0 0 4px;border-right: 0;display: inline-block;">
										<option selected disabled>YYYY</option>
										@for($i=date('Y');$i>=1923;$i--)
											<option value="{{ $i }}">{{ $i }}</option>
										@endfor;
									</select>
					            </div>

								<!-- <select name="year" class="byear select-arrow" style="border-radius: 4px 0 0 4px;border-right: 0;max-width: 33.33%;display: inline-block;" >
									<option selected disabled>YYYY</option>
									@for($i=date('Y');$i>=1923;$i--)
										<option value="{{ $i }}">{{ $i }}</option>
									@endfor;
								</select> -->
								<div class="select-arrow down-arrow relativeCont flexOne">
					                <select name="month" class="bmonth" style="border-radius: 0;border-right: 0;display: inline-block;">
										<option selected disabled>MM</option>
									</select>
					            </div>
								<!-- <select name="month" class="bmonth" style="border-radius: 0;border-right: 0;max-width: 33.33%;display: inline-block;">
									<option selected disabled>MM</option>
								</select> -->

								<div class="select-arrow down-arrow relativeCont flexOne">
					                <select name="day" class="bday" style="border-radius: 0 4px 4px 0;display: inline-block;">
										<option selected disabled>DD</option>
									</select>
					            </div>
								<!-- <select name="day" class="bday" style="border-radius: 0 4px 4px 0;max-width: 33.33%;display: inline-block;">
									<option selected disabled>DD</option>
								</select> -->
							</div>
						</div>
						<div class="guestInputBox">
							<label for="gender">Gender</label>
							<div class="select-arrow down-arrow relativeCont">
								<select name="gender" class="traveller_gender" required>
									<option disabled>Select</option>
									<option value="male" selected>MALE</option>
									<option value="female">FEMALE</option>
								</select>
							</div>
						</div>
					</div>
					<div class="makeflex">
						<div class="guestInputBox">
							<label for="nationality">Nationality <span class="requiredcolor">*</span></label>
							<!-- <input type="text" name="nationality" placeholder="Select Nationality" class="traveller_nationality" required> -->
							<div class="select-arrow down-arrow relativeCont">
							<select required class="formSelect traveller_nationality" name="nationality">
								<?php
									use App\countries; // Assuming 'countries' is your model class

									$data = countries::all(); // Fetch all countries data from the 'countries' table

									echo "<option value='0'>Select Code</option>"; // Default option for selection

									// Loop through each country data
									foreach ($data as $single):
									    // Check if the phone code is '91'; if true, select this option
									    if ($single->phonecode == 91):
									        echo "<option value='" . $single->name . "' selected>" . $single->name . "</option>";
									    else:
									        echo "<option value='" . $single->name . "'>" . $single->name . "</option>";
									    endif;
									endforeach;
								?>
							</select>
						</div>
						</div>
						<div class="guestInputBox">				
							<label for="pancard">Pan Card</label>
							<input type="text" name="pancard" class="traveller_pancard" placeholder="Enter Pan Card Number" maxlength="10" pattern="[a-zA-Z0-9]+" oninput="this.value = this.value.toUpperCase()">
						</div>
					</div>
					</div>
				</div>
				<!--<div class="lineSeparator"></div>-->
				<!--Passport Info-->
				<div id="passportinfo" class="tabContent paddingTop20" style="margin-bottom: 275px;">
					<div class="passportInfoBox">
						<h1>Passport Details</h1>
						<h2>Add your Passport details for a faster booking experience</h2>
					</div>
					<div class="row">
						<div class="makeflex">
						<div class="guestInputBox">
						    <label for="passportnumber">Passport Number</label>
						    <input type="text" id="passportnumber" class="traveller_passportnumber" name="passportnumber" maxlength="10" placeholder="Enter Passport Number" />
						    <span id='validpassport'></span>
						</div>
						<?php
							$data=DB::table('countries')->get();
						?>
						<div class="guestInputBox">
							<label for="passportcountry">Issuing Country</label>
							<!--ADD VALIDATION: SHOW COUNTRY LIST-->
							<select id="passportcountry" name="passportcountry">
							<?php
							foreach($data as $single):
								if($single->name=='India'):
									echo "<option value='".$single->name."' selected>".$single->name."</option>";
								else:
									echo "<option value='".$single->name."' >".$single->name."</option>";
								endif;
							endforeach;
							?>
							</select>
						</div>
						</div>
						<div class="makeflex">
						<!-- <div class="guestInputBox" style="display: none">
							<label for="passportexpirydate">Expiry Date</label>
							!--ADD VALIDATION: EXPIRY DATE CANNOT BE GREATER THAN 10 YEARS, COUNT FROM CURRENT DATE--
							<input type="date" id="" name="" placeholder="Enter Passport Expiry Date" disabled="disabled" />
						</div> -->
						<!-- Passport Issue Date -->
						<div class="guestInputBox">
						    <label for="passportissuedate">Issue Date</label>
						    <div class="makeflex">
						        <div class="clearfix"></div>
						        <div class="select-arrow down-arrow relativeCont flexOne">
							        <select name="iyear" id="iyear" style="border-radius: 4px 0 0 4px;border-right: 0;display: inline-block;">
							            <option selected disabled>YYYY</option>
							            <option value="2022">2022</option>
							            @for($i = 2021; $i >= 2002; $i--)
							                <option value="{{ $i }}">{{ $i }}</option>
							            @endfor
							        </select>
							    </div>
							    <div class="select-arrow down-arrow relativeCont flexOne">
							        <select name="imonth" id="imonth" style="border-radius: 0;border-right: 0;display: inline-block;">
							            <option selected disabled>MM</option>
							        </select>
							    </div>
							    <div class="select-arrow down-arrow relativeCont flexOne">
							        <select name="iday" id="iday" style="border-radius: 0 4px 4px 0;display: inline-block;">
							            <option selected disabled>DD</option>
							        </select>
							    </div>
						    </div>
						</div>
						<!-- Passport Expiry Date -->
						<div class="guestInputBox">
						    <label for="passportexpirydate">Expiry Date</label>
						    <div class="makeflex">
						        <div class="clearfix"></div>
						        <div class="select-arrow down-arrow relativeCont flexOne">
							        <select name="eyear" id="eyear" style="border-radius: 4px 0 0 4px;border-right: 0;display: inline-block;">
							            <option selected disabled>YYYY</option>
							            <!-- <option value="2022">2022</option> -->
							            @for($i = 2022; $i <= 2043; $i++)
							                <option value="{{ $i }}">{{ $i }}</option>
							            @endfor
							        </select>
							    </div>
							    <div class="select-arrow down-arrow relativeCont flexOne">
							        <select name="emonth" id="emonth" style="border-radius: 0;border-right: 0;display: inline-block;">
							            <option selected disabled>MM</option>
							            <!-- <option value="1">Jan</option> -->
							        </select>
							    </div>
							    <div class="select-arrow down-arrow relativeCont flexOne">
							        <select name="eday" id="eday" style="border-radius: 0 4px 4px 0;display: inline-block;">
							            <option selected disabled>DD</option>
							        </select>
							    </div>
						    </div>
						</div>
						</div>
					</div>
				</div>
				<div class="profile_stickyFooter">
					<div class="profileFooterCont">
						<button type="button" class="btnMain btnCancel appendRight30">Cancel</button>
						<input type="submit" id="" name="submit" value="SAVE" class="btnMain btnSave"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
function openInfo(evt, profileInfo) {
  var i, tabContent, tablinks;
  tabContent = document.getElementsByClassName("tabContent");
  for (i = 0; i < tabContent.length; i++) {
    tabContent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(profileInfo).style.display = "block";
  evt.currentTarget.className += " active";
}

// Auto-click on the element with id="defaultOpen"
var defaultOpen = document.getElementById("defaultOpen");
if (defaultOpen) {
	defaultOpen.click();
}

//Enables or disables passport country and expiry date fields based on passport number input
document.addEventListener('DOMContentLoaded', function() {

    // Initial call to manage passport fields based on initial value
    ManagePassportFields(passportInput);

    // Attach event listener to passport number input
    var passportInput = document.getElementById('passportnumber');
    passportInput.addEventListener('keyup', function() {
        ManagePassportFields(this);
    });

    // Passport Fields Management Function
    function ManagePassportFields(passportnumber) {
        var psptnumber = passportnumber.value.trim();
        var iyear = document.getElementById("iyear");
        var imonth = document.getElementById("imonth");
        var iday = document.getElementById("iday");
        var eyear = document.getElementById("eyear");
        var emonth = document.getElementById("emonth");
        var eday = document.getElementById("eday");
        var psptcountry = document.getElementById("passportcountry");
        var validpsptmsg = document.getElementById('validpassport');

        // Regular expression to check for alphanumeric and length between 6 to 10 characters
        var passportRegex = /^[a-zA-Z0-9]{6,10}$/;

        if (passportRegex.test(psptnumber)) {
            // Enable fields when Passport Number is valid
            iyear.disabled = false;
            imonth.disabled = false;
            iday.disabled = false;
            eyear.disabled = false;
            emonth.disabled = false;
            eday.disabled = false;
            psptcountry.disabled = false;

            // Example border color change for visibility
            iyear.style.borderColor = 'red';
            imonth.style.borderColor = 'red';
            iday.style.borderColor = 'red';
            eyear.style.borderColor = 'red';
            emonth.style.borderColor = 'red';
            eday.style.borderColor = 'red';
            psptcountry.style.borderColor = 'red';

            // Reset validation message
            validpsptmsg.innerHTML = '';
        } else {
            // Disable all fields when Passport Number is invalid or too long
            iyear.disabled = true;
            imonth.disabled = true;
            iday.disabled = true;
            eyear.disabled = true;
            emonth.disabled = true;
            eday.disabled = true;
            psptcountry.disabled = true;

            // Reset border color
            iyear.style.borderColor = '#9b9b9b';
            imonth.style.borderColor = '#9b9b9b';
            iday.style.borderColor = '#9b9b9b';
            eyear.style.borderColor = '#9b9b9b';
            emonth.style.borderColor = '#9b9b9b';
            eday.style.borderColor = '#9b9b9b';
            psptcountry.style.borderColor = '#9b9b9b';

            // Show validation message for invalid passport number
            if (psptnumber.length > 0) {
                validpsptmsg.innerHTML = 'Please enter a valid passport number';
                validpsptmsg.style.color = 'red';
            } else {
                validpsptmsg.innerHTML = '';
            }
        }
    }
});
</script>