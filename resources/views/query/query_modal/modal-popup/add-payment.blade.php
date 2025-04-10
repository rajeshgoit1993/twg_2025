<!-- Add Payment Modal -->
<div id="add_payment_modal" class="modal modal_js">
	<div class="modalContent lead-modalbox">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<form class="user" id="update_offline_payments"  method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="query_id" id="query_id_add_payment" value="">
			<input type="hidden" name="quote_no_add_payment" id="quote_no_add_payment" value="">
			<input type="hidden" name="quote_id_add_payment" id="quote_id_add_payment" value="">

			<div class="lead-modalheader make_top_bar_sticky">
				<h2>Add Payment</h2>
			</div>

			<!-- enq ref no and quote ref no -->
            <div class="col-md-12">
				<div class="form-group">
					<!-- enquiry ref no -->
					<i><div class="enq-ref-no">Enquiry Ref No: #<span class="enq_ref_no"></span></div></i>

					<!-- quote ref no -->
					<div class="quote-ref-no">Quote Ref No: #<span class="quote_ref_no"></span></div>
				</div>
			</div>
			
			<!-- Modal body-->
			<div class="lead-modalbody">
				<!--Assigned User-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="assigned_user">Assigned User Name</label>
						<input type="text" class="lead-input-text disabled fullWidth" id="assigned_user_add_payment" name="assigned_user" placeholder="Assigned User" disabled />
					</div>
				</div>
				<!--Booking Reference No-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="booking_reference_no">Booking Reference No</label>
						<input type="text" class="lead-input-text disabled fullWidth" id="booking_reference_no" name="booking_reference_no" placeholder="Booking Reference No" disabled />
					</div>
				</div>
				<!--Guest Name-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="booking_guest_name">Guest Name</label>
						<input type="text" class="lead-input-text disabled fullWidth" id="booking_guest_name" name="booking_guest_name" placeholder="Guest Name" disabled />
					</div>
				</div>
				<!--Guest Mobile No-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="booking_guest_mobile_no">Guest Mobile No</label>
						<input type="text" class="lead-input-text disabled fullWidth" id="booking_guest_mobile_no" name="booking_guest_mobile_no" placeholder="Guest Mobile No" disabled />
					</div>
				</div>
				<!--Guest Email ID-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="booking_guest_email_id">Guest Email ID</label>
						<input type="text" class="lead-input-text disabled fullWidth" id="booking_guest_email_id" name="booking_guest_email_id" placeholder="Guest Email ID" disabled />
					</div>
				</div>
				<!--Total Amount-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="total_amount">Total Amount</label>
						<div class="makeflex">
							<div class="payment-currency-box"><span class="defaultCurencyPay"></span></div>
							<input type="text" class="lead-input-text disabled fullWidth" style="border-radius: 0 4px 4px 0;" id="total_amount" name="total_amount" placeholder="Total Amount" readonly/>
						</div>
					</div>
				</div>
				<!--Due Amount-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="due_amount">Due Amount</label>
						<div class="makeflex">
							<div class="payment-currency-box"><span class="defaultCurencyPay"></span></div>
							<input type="text" class="lead-input-text disabled fullWidth" style="border-radius: 0 4px 4px 0;" id="due_amount" name="due_amount" placeholder="Due Amount" readonly/>
						</div>
					</div>
				</div>
				<!--Payment Type-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="receiving_amount">Select Payment Type</label>
						<select class="lead-input-text fullWidth" id="select_payment_type" name="select_payment_type"></select>
					</div>
				</div>
				<!--Enter Amount-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="receiving_amount">Enter Amount</label>
						<div class="makeflex">
							<div class="payment-currency-box"><span class="defaultCurencyPay"></span></div>
							<input type="text" class="lead-input-text fullWidth" style="border-radius: 0px 4px 4px 0px" id="receiving_amount" name="receiving_amount" placeholder="Enter Amount" required/>
						</div>
					</div>
				</div>
				<!--Payment Method-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="payment_method" class="detailsInput">Payment Method</label>
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
				</div>
				<!--Payment Transaction ID-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="payment_transaction_id" class="detailsInput">Transaction ID / Cheque No</label>
						<input type="text" class="lead-input-text fullWidth" id="payment_transaction_id" name="payment_transaction_id" placeholder="Enter Payment Transaction ID / Cheque No" />
					</div>
				</div>
				<!--Payment Status-->
				<div class="col-md-6">
					<div class="form-group">
						<label for="payment_status" class="detailsInput">Payment Status</label>
						<select class="lead-input-text disabled fullWidth" id="payment_status" name="payment_status">
							<option value="pending">Pending</option>
							<option value="success" selected>Successful</option>
							<option value="failed">Failed</option>
							<option value="aborted">Aborted</option>
						</select>
					</div>
				</div>
				<!--Amount Receive Date & Time-->
				<div class="col-md-6">
					<div class="form-group fullWidth">
						<label for="receiving_amount_datetime" class="detailsInput">Amount Receiving Date & Time</label>
						<div class="makeflex">
							<input type="datetime-local" class="lead-input-text fullWidth" id="receiving_amount_datetime" name="receiving_amount_datetime" />
						</div>
					</div>
				</div>
				<!--Due Payment Follow-up Date & Time-->
				<div class="col-md-6">
					<div class="form-group fullWidth">
						<label for="payment_follow_up_date_time" class="detailsInput">Due Payment Follow-up Date & Time</label>
						<div class="makeflex">
							<input type="datetime-local" class="lead-input-text fullWidth" id="payment_follow_up_date_time" name="payment_follow_up_date_time" />
						</div>
					</div>
				</div>
				<!--User Remarks-->
				<div class="col-md-12">
					<div class="form-group">
						<label for="user_remarks">Remarks</label>
						<!--<label for="additionaletails" style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Additional details</label>-->
						<textarea class="lead-input-text-area fullWidth" type="text" name="user_remarks" placeholder="Ente remarks"></textarea>
					</div>
				</div>
				
				<!--Current Date & Time-->
				<!-- combine date and time capture -->
				<!-- date -->
				<div class="col-md-6">
					<div class="form-group">
						<label for="datetimestamp" class="detailsInput">Current Date</label>
						<!-- input type="date" value="{{date('Y-m-d')}}" class="lead-input-text disabled fullWidth" id="datetimestamp" name="datetimestamp" disabled/> -->
						<input type="text" class="lead-input-text disabled fullWidth date_display" disabled/>
					</div>
				</div>
				<!-- time -->
				<div class="col-md-6">
					<div class="form-group">
						<label for="datetimestamp" class="detailsInput">Current Time</label>
							<!-- <input type="time" value="{{date('H:i')}}" class="current_time lead-input-text disabled fullWidth" id="datetimestamp" name="datetimestamp" disabled/> -->
							
							<!-- <input type="text" class="current_time lead-input-text disabled fullWidth datetimestamp_display" disabled/> -->
							<input type="text" class="lead-input-text disabled fullWidth time_display" disabled/>
					</div>
				</div>
				<input type="hidden" id="datetimestamp" name="datetimestamp" />

				<!-- --------------------------- -->

				<!-- separate date and time capture -->
				<!-- <div class="col-md-6">
					<div class="form-group">
						<label for="date_display" class="detailsInput">Current Date</label>
						<input type="text" class="lead-input-text disabled fullWidth date_display" disabled/>
						<input type="hidden" class="date_hidden" name="date_hidden"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="time_display" class="detailsInput">Current Time</label>
							<input type="text" class="lead-input-text disabled fullWidth time_display" disabled/>
							<input type="hidden" class="time_hidden" name="time_hidden"/>
					</div>
				</div> -->

				<!-- --------------------------- -->
			</div>
			<!-- Modal footer-->
			<!-- <div class="lead-modalfooter make_bottom_bar_sticky">
				<button type="button" class="btn_lead_modal_close btn_lead_modal_close_add_payment" id="btn_lead_modal_close_add_payment">Cancel</button>
				<button type="button" class="btn_lead_modal_link">Payment Link</button>
				<button type="submit" class="btn_lead_modal_update">Update</button>
			</div> -->
			<div class="lead-modalfooter make_bottom_bar_sticky">
				<div class="makeflex">
				<div class="col-md-4">
					<div class="form-group textCenter">
						<button type="button" class="btn_lead_modal_close btn_lead_modal_close_add_payment" id="btn_lead_modal_close_add_payment">Cancel</button>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group textCenter">
						<button type="button" class="btn_lead_modal_link">Payment Link</button>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group textCenter">
						<button type="submit" class="btn_lead_modal_update">Update</button>
					</div>
				</div>
				</div>
			</div>
		 </form>
		<!-- Modal content ends-->
	</div>
</div>

<!-- <script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    function updateCurrentTime() {
        var now = new Date();
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');
        var currentTime = hours + ':' + minutes + ':' + seconds;

        // Update the visible, disabled input
        document.getElementById('datetimestamp_display').value = currentTime;
        // Update the hidden input that will be submitted
        document.getElementById('datetimestamp').value = currentTime;
    }

    // Update the time initially
    updateCurrentTime();

    // Update the time every minute to keep it current
    setInterval(updateCurrentTime, 1000);

    // Update the time right before the form is submitted
    document.getElementById('update_offline_payments').addEventListener('submit', updateCurrentTime);
});
</script> -->

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    function updateCurrentTime() {
        var now = new Date();
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');
        var currentTime = hours + ':' + minutes + ':' + seconds;

        // Update all visible, disabled inputs
        var displayInputs = document.querySelectorAll('.datetimestamp_display');
        displayInputs.forEach(function(input) {
            input.value = currentTime;
        });

        // Update all hidden inputs that will be submitted
        var hiddenInputs = document.querySelectorAll('.datetimestamp');
        hiddenInputs.forEach(function(input) {
            input.value = currentTime;
        });
    }

    // Update the time initially
    updateCurrentTime();

    // Update the time every second to show a live clock
    setInterval(updateCurrentTime, 1000);

    // Update the time right before any form is submitted
    var forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            updateCurrentTime();
        });
    });
});
</script> -->
