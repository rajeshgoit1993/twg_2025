<!-- Refund Create Modal -->
<div id="refund_create_modal" class="modal modal_js">
	<div class="modalContent lead-modalbox">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<form class="user" id="update_refund_create" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="query_id" id="query_id_refund_create" value="">
			<input type="hidden" name="quote_no_refund_create" id="quote_no_refund_create" value="">
			<input type="hidden" name="quote_id_refund_create" id="quote_id_refund_create" value="">

			<div class="lead-modalheader make_top_bar_sticky">
				<h2>Refund Create</h2>
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
				<div class="form-group">
					<label for="assigned_user">Assigned User Name</label>
					<input type="text" class="lead-input-text fullWidth" id="assigned_user_refund_create" name="assigned_user" placeholder="Assigned User" disabled />
				</div>
				<!--Booking Reference No-->
				<div class="form-group">
					<label for="booking_reference_no">Booking Reference No</label>
					<input type="text" class="lead-input-text fullWidth" id="refund_create_reference_no" name="booking_reference_no" placeholder="Booking Reference No" disabled />
				</div>
				<!--Guest Name-->
				<div class="form-group">
					<label for="booking_guest_name">Guest Name</label>
					<input type="text" class="lead-input-text fullWidth" id="refund_create_guest_name" name="booking_guest_name" placeholder="Guest Name" disabled />
				</div>
				<!--Guest Mobile No-->
				<div class="form-group">
					<label for="booking_guest_mobile_no">Guest Mobile No</label>
					<input type="text" class="lead-input-text fullWidth" id="refund_create_guest_mobile_no" name="booking_guest_mobile_no" placeholder="Guest Mobile No" disabled />
				</div>
				<!--Guest Email ID-->
				<div class="form-group">
					<label for="booking_guest_email_id">Guest Email ID</label>
					<input type="text" class="lead-input-text fullWidth" id="refund_create_guest_email_id" name="booking_guest_email_id" placeholder="Guest Email ID" disabled />
				</div>
				
				<!--Total Amount-->
				<div class="form-group">
					<label for="total_amount">Total Quote Amount</label>
					<div class="makeflex">
						<div class="payment-currency-box"><span class="defaultCurencyPay"></span></div>
						<input type="text" class="lead-input-text fullWidth" style="border-radius: 0px 4px 4px 0px;background-color: #f9f9f9" id="total_create_quote_amount" name="total_amount" placeholder="Total Amount" readonly/>
					</div>
				</div>

				<!-- Max refundable amount -->
				<div class="form-group">
					<label for="total_refundable_amount">Max Refundable Amount</label>
					<div class="makeflex">
						<div class="payment-currency-box"><span class="defaultCurencyPay"></span></div>
						<input type="text" class="lead-input-text fullWidth" style="border-radius: 0px 4px 4px 0px;background-color: #f9f9f9" id="total_quote_refundable_amount" name="total_refundable_amount" placeholder="Total Refundable Amount" readonly/>
					</div>
				</div>

				<!-- cancellation charges -->
				<div class="form-group">
					<label for="cancellation_charge">Cancellation Charge</label>
					<div class="makeflex">
						<div class="payment-currency-box"><span class="defaultCurencyPay"></span></div>
						<input type="text" required class="lead-input-text fullWidth" style="border-radius: 0px 4px 4px 0px" id="refund_cancellation_charge" name="cancellation_charge" placeholder="Enter Cancellation Charge" />
					</div>
				</div>

				<!-- Refund due -->
				<div class="form-group">
					<label for="receiving_amount">Due Refund Amount</label>
					<div class="makeflex">
						<div class="payment-currency-box"><span class="defaultCurencyPay"></span></div>
						<input type="text" required class="lead-input-text fullWidth" style="border-radius: 0px 4px 4px 0px" id="refunded_amount" name="refund_amount" placeholder="Due Refund Amount" />
					</div>
				</div>

				<!--Payment Status-->
				<!--Due Payment Follow-up Date & Time-->
				<!-- <div class="form-group fullWidth">
					<label for="payment_follow_up_date_time" class="detailsInput">Due Payment Follow-up </label>
					<div class="makeflex">
						<input type="datetime-local" class="lead-input-text fullWidth" id="payment_follow_up_date_time" name="payment_follow_up_date_time" style="border-radius: 4px 0px 0px 4px; border-right: none;" />
						
					</div>
				</div> -->
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
						<input type="text" class="lead-input-text disabled fullWidth date_display" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled />
						<input type="text" class="lead-input-text disabled fullWidth time_display" style="border-radius: 0px 4px 4px 0px" disabled />
						<input type="hidden" id="datetimestamp" name="datetimestamp" />
					</div>
				</div>
			</div>
			<!-- Modal footer-->
			<div class="lead-modalfooter make_bottom_bar_sticky">
				<button type="button" class="btn_lead_modal_close btn_lead_modal_close_refund_create" id="btn_lead_modal_close_refund_create">Cancel</button>
				<!-- <button type="button" class="btn_lead_modal_link">Payment Link</button> -->
				<button type="submit" class="btn_lead_modal_update submit">Update</button>
			</div>
		 </form>
		<!-- Modal content ends-->
	</div>
</div>