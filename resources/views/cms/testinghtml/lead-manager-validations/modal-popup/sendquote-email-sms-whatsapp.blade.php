<!-- Send Email-SMS-WhatsApp Modal -->
<div id="myModal" class="modal">
	<div class="modalContent lead-modalbox">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<div class="lead-modalheader make_top_bar_sticky">
			<h2>Send Quote</h2>
		</div>
		<!-- Modal body-->
		<div class="lead-modalbody">
			<!--Assigned User-->
			<div class="form-group">
				<label for="assigned_user">Assigned User Name <span class="mandatory-field">*</span></label>
				<input type="text" class="lead-input-text full-width" id="assigned_user" name="assigned_user" placeholder="Assigned User" disabled/>
			</div>
			<!--Reference No-->
			<div class="form-group">
				<label for="booking_reference_no">Reference No</label>
				<input type="text" class="lead-input-text full-width" id="booking_reference_no" name="booking_reference_no" placeholder="Reference No" disabled />
			</div>
			<!--Select Quote-->
			<div class="form-group">
				<label for="lead_cancel_reason">Select Quote <span class="mandatory-field">*</span></label>
				<select class="lead-input-text full-width" id="lead_cancel_reason" name="lead_cancel_reason">
					<option disabled selected>Select Quote</option>
					<option value="quote1">Quote 1</option>
					<option value="quote2">Quote 2</option>
					<option value="quote3">Quote 3</option>
					<option value="quote4">Quote 4</option>
				</select>
			</div>
			<!--Guest Email ID-->
			<div class="form-group">
				<label for="booking_guest_email_id">Guest Email ID</label>
				<input type="text" class="lead-input-text full-width" id="booking_guest_email_id" name="booking_guest_email_id" placeholder="Guest Email ID" />
			</div>
			<div class="form-group right_side">
				<button type="button" class="btn_send_quote">Send Email</button>
			</div>
			<!--Guest Mobile No-->
			<div class="form-group">
				<label for="booking_guest_mobile_no">Guest Mobile No</label>
				<input type="text" class="lead-input-text full-width" id="booking_guest_mobile_no" name="booking_guest_mobile_no" placeholder="Guest Mobile No" />
			</div>
			<div class="form-group right_side">
				<button type="button" class="btn_send_quote">Send SMS</button>
			</div>
			<!--Guest WhatsApp No-->
			<div class="form-group">
				<label for="booking_guest_mobile_no">Guest WhatsApp No</label>
				<input type="text" class="lead-input-text full-width" id="booking_guest_mobile_no" name="booking_guest_mobile_no" placeholder="Guest Mobile No" />
			</div>
			<div class="form-group right_side">
				<button type="button" class="btn_send_quote">Send WhatsApp</button>
			</div>
			<!--Current Date & Time-->
			<div class="form-group full-width">
				<label for="datetimestamp">Today's Date & Time <span class="mandatory-field">*</span></label>
				<div class="makeflex">
					<input type="date" class="lead-input-text full-width" id="datetimestamp" name="datetimestamp" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled/>
					<input type="time" class="lead-input-text full-width" id="datetimestamp" name="datetimestamp" style="border-radius: 0px 4px 4px 0px" disabled/>
				</div>
			</div>
		</div>
		<!-- Modal footer-->
		<div class="lead-modalfooter make_bottom_bar_sticky">
			<button type="button" class="btn_lead_modal_close" data-dismiss="modal">Close</button>
			<button class="btn_lead_modal_update" name="submit">Send All</button>
		</div>
		<!-- Modal content ends-->
	</div>
</div>