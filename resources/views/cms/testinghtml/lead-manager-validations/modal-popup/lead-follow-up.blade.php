<!-- Lead Follow-up Modal -->
<div id="myModal" class="modal">
	<div class="modalContent lead-modalbox">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<div class="lead-modalheader">
			<h2>Add Lead Follow-up</h2>
		</div>
		<!-- Modal body-->
		<div class="lead-modalbody">
			<!--Assigned User-->
			<div class="form-group">
				<label for="assigned_user" class="detailsInput">Assigned User Name </label>
				<input type="text" class="lead-input-text fullWidth" id="assigned_user" name="assigned_user" placeholder="Assigned User" disabled/>
			</div>
			<!--Follow-up Reason-->
			<div class="form-group">
				<label for="follow_up_reason" class="detailsInput">>Follow-up Reason </label>
				<select class="lead-input-text fullWidth" id="follow_up_reason" name="follow_up_reason">
						<option disabled selected>Select reason</option>
						<option value="call_later">Call Later</option>
						<option value="coupon_issued">Coupon Issued</option>
						<option value="lead_cancelled">Lead Cancelled</option>
						<option value="no_response">No Response</option>
						<option value="phone_not_reachable">Phone Not Reachable</option>
						<option value="price_negotiation">Price Negotiation</option>
						<option value="other_reason">Other Reason</option>
						<option value="tour_cancelled">Tour Cancelled</option>
						<option value="wrong_number">Wrong Number</option>
					</select>
			</div>
			<!--Follow-up Date & Time-->
			<div class="form-group fullWidth">
				<label for="follow_up_date_time" class="detailsInput">Follow-up Date & Time </label>
				<div class="makeflex">
					<input type="date" class="lead-input-text fullWidth" id="follow_up_date_time" name="follow_up_date_time" style="border-radius: 4px 0px 0px 4px; border-right: none;" />
					<input type="time" class="lead-input-text fullWidth" id="follow_up_date_time" name="follow_up_date_time" style="border-radius: 0px 4px 4px 0px" />
				</div>
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
			<button class="btn_lead_modal_update">Update</button>
		</div>
		<!-- Modal content ends-->
	</div>
</div>