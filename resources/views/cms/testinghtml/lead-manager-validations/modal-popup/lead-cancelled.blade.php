<!-- Lead Cancelled Modal -->
<div id="myModal" class="modal">
	<div class="modalContent lead-modalbox">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<div class="lead-modalheader">
			<h2>Lead Cancelled</h2>
		</div>
		<!-- Modal body-->
		<div class="lead-modalbody">
			<!--Assigned User-->
			<div class="form-group">
				<label for="assigned_user" class="detailsInput">Assigned User Name </label>
				<input type="text" class="lead-input-text fullWidth" id="assigned_user" name="assigned_user" placeholder="Assigned User" disabled/>
			</div>
			<!--Lead Cancelled Reason-->
			<div class="form-group">
				<label for="lead_cancel_reason" class="detailsInput">Reason </label>
				<select class="lead-input-text fullWidth" id="lead_cancel_reason" name="lead_cancel_reason">
					<option disabled selected>Select Reason</option>
					<option value="destination_changed">Destination Changed</option>
					<option value="program_cancelled">Program Cancelled</option>
					<option value="program_postponned">Postponned</option>
					<option value="booked_with_other">Booked With Other</option>
					<option value="other_reason">Other Reason</option>
				</select>
			</div>
			<!--User Remarks-->
			<div class="form-group">
				<label for="user_remarks">Remarks</label>
				<!--<label for="additionaletails" style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Additional details</label>-->
				<textarea class="lead-input-text-area fullWidth" type="text" name="user_remarks" style="" placeholder="Remarks"></textarea>
			</div>
			<!--Current Date & Time-->
			<div class="form-group fullWidth">
				<label for="datetimestamp" class="detailsInput">Current Date & Time </label>
				<div class="makeflex">
					<input type="date" class="lead-input-text fullWidth" id="datetimestamp" name="datetimestamp" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled/>
					<input type="time" class="lead-input-text fullWidth" id="datetimestamp" name="datetimestamp" style="border-radius: 0px 4px 4px 0px" disabled/>
				</div>
			</div>
		</div>
		<!-- Modal footer-->
		<div class="lead-modalfooter">
			<button class="btn_lead_modal_close">Cancel</button>
			<button class="btn_lead_modal_link">Add Lead</button>
			<button class="btn_lead_modal_update">Update</button>
		</div>
		<!-- Modal content ends-->
	</div>
</div>