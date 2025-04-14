<div class="modal fade my-profile-modal" id="profile_modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content cont">
			<div class="make-sticky-header whitebg" style="border-radius: 5px 5px 0 0;">
				<div class="modal-header wrapper">
					<button type="button" class="close close-my-profile-modal" data-dismiss="modal">&times;</button>
					<h4>Edit Profile</h4>
				</div>
			</div>
			<div class="modal-body box">
				<!--Profile Details-->
			 	<form action="{{ url('update_user_profile') }}" method="post">
			 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			 		<div class="Cont">
					<!-- first name -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="first_name" class="mandatoryField">First Name</label>
							<input type="text" id="first_name" name="firstname" placeholder="Enter first name" maxlength="20" pattern="[a-zA-Z]{1,20}" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '').replace(/\b\w/g, function(char) { return char.toUpperCase(); })" value="{{ Sentinel::getUser()->first_name }}" required>
						</div>
					</div>
					<!-- last name -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="last_name" class="mandatoryField">Last Name</label>
							<input type="text" id="last_name" name="lastname" placeholder="Enter last name" maxlength="25" pattern="[a-zA-Z ]{1,25}" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/\b\w/g, function(char) { return char.toUpperCase(); })" value="{{ Sentinel::getUser()->last_name }}" required>
						</div>
					</div>
					<!-- birthday -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="datepicker_dob">Birthday</label>
							<!-- <input type="date" name="birthday" placeholder="Enter Date of Birth" @if($user_details!='' && $user_details->dob!='') value="{{ $user_details->dob }}" @endif> -->
							<input type="text" id="datepicker_dob" name="birthday" placeholder="Enter Date of Birth" @if($user_details!='' && $user_details->dob!='') value="{{ date('d-m-Y', strtotime($user_details->dob)) }}" @endif>
						</div>
					</div>
					<!-- gender -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="gender">Gender</label>
							<div class="select-arrow down">
								<select id="gender" name="gender">
									<option selected disabled>Select</option>
									<option value="male" @if($user_details!='' && $user_details->gender!='' && $user_details->gender=='male') selected @endif>MALE</option>
									<option value="female" @if($user_details!='' && $user_details->gender!='' && $user_details->gender=='female') selected @endif>FEMALE</option>
								</select>
							</div>
						</div>
					</div>
					<!-- pan card -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="user_pancard">Pan Card</label>
							<input type="text" id="user_pancard" name="user_pancard" placeholder="Enter your pan card" maxlength="10" pattern="[a-zA-Z0-9]+" oninput="this.value = this.value.toUpperCase()" value="{{ Sentinel::getUser()->user_pancard }}" required>
						</div>
					</div>
					<!-- marital status -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="maritalstatus">Marital Status</label>
							<div class="select-arrow down">
								<select id="maritalstatus" name="maritalstatus" onchange="ShowHideAnniversary()">
									<option selected disabled>Select</option>
									<option value="married" @if($user_details!='' && $user_details->marital_status!='' && $user_details->marital_status=='married') selected @endif>MARRIED</option>
									<option value="single" @if($user_details!='' && $user_details->marital_status!='' && $user_details->marital_status=='single') selected @endif>SINGLE</option>
								</select>
							</div>
						</div>
					</div>
					<!-- anniversary date -->
					<div id="anniversarydate" @if($user_details!='' && $user_details->marital_status!='' && $user_details->marital_status=='married') style="display: block" @else style="display: none" @endif>
						<div class="col-md-6">
							<div class="form-group">
								<label for="anniversarydate">Anniversary Date</label>
								<input type="date" id="anniversarydate" name="anniversary" placeholder="Enter anniversary date" @if($user_details!='' && $user_details->anniversary!='') value="{{ $user_details->anniversary }}" @endif>
							</div>
						</div>
					</div>
					<div class="col-md-12"></div>
					<!-- city -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="city">City</label>
							<input type="text" id="city" name="city" placeholder="Enter your city" maxlength="20" pattern="[a-zA-Z0-9\-]{1,20}" oninput="this.value = this.value.replace(/[^a-zA-Z0-9\-]/g, '').replace(/\b\w/g, function(char) { return char.toUpperCase(); })" value="{{ Sentinel::getUser()->city }}" required>
						</div>
					</div>
					<!-- state -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="state">State</label>
							<input type="text" id="state" name="state" placeholder="Enter your state" maxlength="20" pattern="[a-zA-Z0-9\- ]{1,20}" oninput="this.value = this.value.replace(/[^a-zA-Z0-9\- ]/g, '').replace(/\b\w/g, function(char) { return char.toUpperCase(); })" value="{{ Sentinel::getUser()->state }}" required>
						</div>
					</div>
					<!-- zip code -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="zipcode">Pin Code</label>
							<!-- <input type="text" id="zipcode" name="pincode" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Enter your pin code" value="{{ Sentinel::getUser()->zipcode }}" required> -->
							<input type="text" id="zipcode" name="pincode" maxlength="10" pattern="[a-zA-Z0-9\-]{1,10}" oninput="this.value = this.value.replace(/[^a-zA-Z0-9\-]/g, '')" placeholder="Enter your pin code" value="{{ Sentinel::getUser()->zipcode }}" required>
						</div>
					</div>
					<!-- country -->
					<div class="col-md-6">
						<div class="form-group">
							<label for="country">Country</label>
							<input type="text" id="country" name="country" placeholder="Enter your country" maxlength="25" pattern="[a-zA-Z0-9\- ]{1,25}" oninput="this.value = this.value.replace(/[^a-zA-Z0-9\- ]/g, '').replace(/\b\w/g, function(char) { return char.toUpperCase(); })" value="{{ Sentinel::getUser()->country }}" required>
						</div>
					</div>
					<!-- address -->
					<div class="col-md-12">
						<div class="form-group">
							<label for="address">Address</label>
							<input type="text" id="address" name="address" placeholder="Enter your address" maxlength="100" pattern="[a-zA-Z0-9\- ]{1,100}" oninput="this.value = this.value.replace(/[^a-zA-Z0-9\- ]/g, '').replace(/\b\w/g, function(char) { return char.toUpperCase(); })" value="{{ Sentinel::getUser()->address }}" required>
						</div>
					</div>
					</div>
					<!-- footer -->
					<div class="make-sticky-footer">
						<div class="modal-footer wrapper">
							<button type="button" class="btn-main cancel" data-dismiss="modal">Cancel</button>
							<!-- <input type="submit" name="save" value="SAVE" class="btnblueSend"> -->
							<button type="submit" name="save" class="btn-main save">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>