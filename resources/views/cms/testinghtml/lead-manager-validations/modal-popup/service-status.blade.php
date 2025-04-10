<!-- Lead Service Status Modal -->
<div id="myModal" class="modal">
	<div class="modalContent lead-modalbox">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<div class="lead-modalheader make_top_bar_sticky">
			<h2>Service Status</h2>
		</div>
		<!-- Modal body-->
		<div class="lead-modalbody">
			<!--Assigned User-->
			<div class="form-group">
				<label for="assigned_user" class="detailsInput">Assigned User Name </label>
				<input type="text" class="lead-input-text fullWidth" id="assigned_user" name="assigned_user" placeholder="Assigned User" disabled/>
			</div>
			<!--Services-->
			<div class="form-group">
				<label for="service_type" class="detailsInput">Services Included</label>
				<select class="lead-input-text fullWidth" id="service_type" name="service_type">
					<option disabled selected>Select Service</option>
					<option value="flights">Flights</option>
					<option value="hotels">Hotel</option>
					<option value="activity">Activity</option>
					<option value="meals">Meals</option>
					<option value="cruise">Cruise</option>
					<option value="other_services">Others</option>
				</select>
			</div>
			<!--Service Details-->
			<div class="apndBtm5">
				<div class="service_category detailsInput collapsible">Flights</div>
				<div class="contents">
					<div class="service_category_dtls">
					<!--Current Status-->
					<div class="service_category_dtls_part form-group fullWidth">
						<label for="lead_current_status" class="detailsInput">Current Status</label>
						<div>
							<select class="lead-input-text fullWidth" id="lead_current_status" name="lead_current_status">
								<option selected>Pending</option>
								<option value="under_process">Under Process</option>
								<option value="services_blocked">Services Blocked</option>
								<option value="confirmed">Confirmed</option>
								<option value="released">Released</option>
								<option value="aborted">Aborted</option>
								<option value="un-confirmed">Un-Confirmed</option>
								<option value="cancelled">Cancelled</option>
								<option value="voucher_pending">Voucher Pending</option>
								<option value="vouchered">Vouchered</option>
								<option value="not_applicable">Not Applicable</option>
							</select>
						</div>
					</div>
					<!--Supplier Name-->
					<div class="service_category_dtls_part form-group fullWidth">
						<label for="supplier_name" class="detailsInput">Supplier Name</label>
						<div>
							<select class="lead-input-text fullWidth" id="supplier_name" name="supplier_name">
								<option selected disabled>Select</option>
								<option value="">Nexcen IT Services</option>
							</select>
						</div>
					</div>
					<!--Supplier Reference No-->
					<div class="service_category_dtls_part form-group fullWidth">
						<label for="supplier_reference_no" class="detailsInput">Reference No</label>
						<div>
							<input type="text" class="lead-input-text fullWidth" id="supplier_reference_no" name="supplier_reference_no" placeholder="Enter Supplier Reference No" />
						</div>
					</div>
					<!--Cancellation Deadline-->
					<div class="service_category_dtls_part form-group fullWidth">
						<label for="service_cancellation_deadline" class="detailsInput">Cancellation Deadline</label>
						<div class="makeflex">
							<input type="date" class="lead-input-text fullWidth" id="service_cancellation_deadline" name="service_cancellation_deadline" style="border-radius: 4px 0px 0px 4px; border-right: none;" />
							<input type="time" class="lead-input-text fullWidth" id="service_cancellation_deadline" name="service_cancellation_deadline" style="border-radius: 0px 4px 4px 0px;flex-basis: 70%;" />
						</div>
					</div>
				</div>
				<!--User Remarks-->
				<div class="form-group">
					<button onclick="showhide()" id="btn_remarks" class="btn_add_remarks">Add Remarks</button>
					<span id="add_remarks"></span>
					<span id="add_content">
						<textarea class="lead-input-text-area fullWidth" type="text" name="user_remarks" style="" placeholder="Remarks"></textarea>
					</span>
				</div>
				</div>
			</div>
			<!--Current Date & Time-->
			<div class="form-group">
				<label for="datetimestamp" class="detailsInput">Current Date & Time </label>
				<div class="makeflex">
					<input type="date" class="lead-input-text fullWidth" id="datetimestamp" name="datetimestamp" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled/>
					<input type="time" class="lead-input-text fullWidth" id="datetimestamp" name="datetimestamp" style="border-radius: 0px 4px 4px 0px" disabled/>
				</div>
			</div>
		</div>
		<!-- Modal footer-->
		<div class="lead-modalfooter make_bottom_bar_sticky">
			<button class="btn_lead_modal_close">Cancel</button>
			<button class="btn_lead_modal_update">Update</button>
		</div>
		<!-- Modal content ends-->
	</div>
</div>
<script>
function showhide() {
	var addRemarks = document.getElementById("add_remarks");
	var btnText = document.getElementById("btn_remarks");
	var moreText = document.getElementById("add_content");

	if (addRemarks.style.display === "none") {
		addRemarks.style.display = "block";
		btnText.innerHTML = "Add Remarks(+)";
		moreText.style.display = "none";
		} 
	else {
		addRemarks.style.display = "none";
		btnText.innerHTML = "Hide Remarks(-)";
		moreText.style.display = "block";
		}
	}
</script>