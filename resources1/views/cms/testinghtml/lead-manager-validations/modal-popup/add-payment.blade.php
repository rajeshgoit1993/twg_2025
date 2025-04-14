<!-- Add Payment Modal -->
<div id="myModal" class="modal">
	<div class="modalContent lead-modalbox">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<div class="lead-modalheader make_top_bar_sticky">
			<h2>Add Payment</h2>
		</div>
		<!-- Modal body-->
		<div class="lead-modalbody">
			<!--Assigned User-->
			<div class="form-group">
				<label for="assigned_user">Assigned User Name</label>
				<input type="text" class="lead-input-text fullWidth" id="assigned_user" name="assigned_user" placeholder="Assigned User" disabled />
			</div>
			<!--Booking Reference No-->
			<div class="form-group">
				<label for="booking_reference_no">Booking Reference No</label>
				<input type="text" class="lead-input-text fullWidth" id="booking_reference_no" name="booking_reference_no" placeholder="Booking Reference No" disabled />
			</div>
			<!--Guest Name-->
			<div class="form-group">
				<label for="booking_guest_name">Guest Name</label>
				<input type="text" class="lead-input-text fullWidth" id="booking_guest_name" name="booking_guest_name" placeholder="Guest Name" disabled />
			</div>
			<!--Guest Mobile No-->
			<div class="form-group">
				<label for="booking_guest_mobile_no">Guest Mobile No</label>
				<input type="text" class="lead-input-text fullWidth" id="booking_guest_mobile_no" name="booking_guest_mobile_no" placeholder="Guest Mobile No" disabled />
			</div>
			<!--Guest Email ID-->
			<div class="form-group">
				<label for="booking_guest_email_id">Guest Email ID</label>
				<input type="text" class="lead-input-text fullWidth" id="booking_guest_email_id" name="booking_guest_email_id" placeholder="Guest Email ID" disabled />
			</div>
			<!--Total Amount-->
			<div class="form-group">
				<label for="total_amount">Total Amount</label>
				<div class="makeflex">
					<div class="payment-currency-box">&#8377;</div>
					<input type="text" class="lead-input-text fullWidth" style="border-radius: 0px 4px 4px 0px;background-color: #f9f9f9" id="total_amount" name="total_amount" placeholder="Total Amount" readonly/>
				</div>
			</div>
			<!--Due Amount-->
			<div class="form-group">
				<label for="due_amount">Due Amount</label>
				<div class="makeflex">
					<div class="payment-currency-box">&#8377;</div>
					<input type="text" class="lead-input-text fullWidth" style="border-radius: 0px 4px 4px 0px;background-color: #f9f9f9" id="due_amount" name="due_amount" placeholder="Due Amount" readonly/>
				</div>
			</div>
			<!--Enter Amount-->
			<div class="form-group">
				<label for="receiving_amount">Enter Amount</label>
				<div class="makeflex">
					<div class="payment-currency-box">&#8377;</div>
					<input type="text" class="lead-input-text fullWidth" style="border-radius: 0px 4px 4px 0px" id="receiving_amount" name="receiving_amount" placeholder="Enter Amount" />
				</div>
			</div>
			<!--Payment Method-->
			<div class="form-group">
				<label for="payment_method" class="detailsInput">Payment Method </label>
				<select class="lead-input-text fullWidth" id="payment_method" name="payment_method">
					<option disabled selected>Select</option>
					<option value="cash">Cash</option>
					<option value="cheque">Cheque</option>
					<option value="upi">Bhim UPI</option>
					<option value="debit_card">Debit Card</option>
					<option value="credit_card">Credit Card</option>
					<option value="bank_transfer">Bank Transfer</option>
					<option value="online_payment_gateway">Payment Gateway</option>
				</select>
			</div>
			<!--Payment Transaction ID-->
			<div class="form-group">
				<label for="payment_transaction_id" class="detailsInput">Transaction ID / Cheque No </label>
				<input type="text" class="lead-input-text fullWidth" id="payment_transaction_id" name="payment_transaction_id" placeholder="Enter Payment Transaction ID / Cheque No" />
			</div>
			<!--Payment Status-->
			<div class="form-group">
				<label for="payment_status" class="detailsInput">>Payment Status </label>
				<select class="lead-input-text fullWidth" id="payment_status" name="payment_status">
					<option value="pending" selected>Pending</option>
					<option value="success">Successful</option>
					<option value="failed">Failed</option>
					<option value="aborted">Aborted</option>
				</select>
			</div>
			<!--Amount Receive Date & Time-->
			<div class="form-group fullWidth">
				<label for="receiving_amount_datetime" class="detailsInput">Amount Receiving Date & Time </label>
				<div class="makeflex">
					<input type="date" class="lead-input-text fullWidth" id="receiving_amount_datetime" name="receiving_amount_datetime" style="border-radius: 4px 0px 0px 4px; border-right: none;" />
					<input type="time" class="lead-input-text fullWidth" id="receiving_amount_datetime" name="receiving_amount_datetime" style="border-radius: 0px 4px 4px 0px" />
				</div>
			</div>
			<!--Due Payment Follow-up Date & Time-->
			<div class="form-group fullWidth">
				<label for="payment_follow_up_date_time" class="detailsInput">Due Payment Follow-up </label>
				<div class="makeflex">
					<input type="date" class="lead-input-text fullWidth" id="payment_follow_up_date_time" name="payment_follow_up_date_time" style="border-radius: 4px 0px 0px 4px; border-right: none;" />
					<input type="time" class="lead-input-text fullWidth" id="payment_follow_up_date_time" name="payment_follow_up_date_time" style="border-radius: 0px 4px 4px 0px" />
				</div>
			</div>
			<!--User Remarks-->
			<div class="form-group">
				<label for="user_remarks">Remarks</label>
				<!--<label for="additionaletails" style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Additional details</label>-->
				<textarea class="lead-input-text-area fullWidth" type="text" name="user_remarks" style="" placeholder="Ente remarks"></textarea>
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
		<div class="lead-modalfooter make_bottom_bar_sticky">
			<button class="btn_lead_modal_close">Cancel</button>
			<button class="btn_lead_modal_link">Payment Link</button>
			<button class="btn_lead_modal_update">Update</button>
		</div>
		<!-- Modal content ends-->
	</div>
</div>