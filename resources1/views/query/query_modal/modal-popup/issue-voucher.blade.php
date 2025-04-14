<!-- Issue Voucher Modal -->
<div id="issue_voucher_modal" class="modal">
	<div class="modalContent lead-modalbox">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<form class="user" id="enquiry_issue_voucher" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="query_id" id="query_id_issue_voucher" value="">
			
			<div class="lead-modalheader">
				<h2>Tour Vouchers Issued</h2>
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
					<label for="assigned_user" class="detailsInput">Assigned User Name</label>
					<select class="lead-input-text fullWidth" required id="assign_person_issue_voucher" name="assign_person"></select>
				</div>
				<!--Lead Cancelled Reason-->
				
				<!--User Remarks-->
				<div class="form-group">
					<label for="user_remarks">Remarks</label>
					<!--<label for="additionaletails" style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Additional details</label>-->
					<textarea class="lead-input-text-area fullWidth" type="text" name="remarks" style="" required placeholder="Remarks"></textarea>
				</div>

				<!--Current Date & Time-->
				<div class="form-group">
					<label for="datetimestamp" class="detailsInput">Current Date & Time </label>
					<div class="makeflex">
						<input type="text" class="lead-input-text disabled fullWidth date_display" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled />
						<input type="text" class="lead-input-text disabled fullWidth time_display" style="border-radius: 0px 4px 4px 0px" disabled />
						<input type="hidden" id="datetimestamp" name="datetimestamp" />
					</div>
				</div>
			</div>
			
			<!-- Modal footer-->
			<div class="lead-modalfooter">
				<button type="button" class="btn_lead_modal_close btn_tour_modal_issue_voucher" id="btn_tour_modal_issue_voucher">Cancel</button>
				<!-- <button type="button" class="btn_lead_modal_link">Add Lead</button> -->
				<button type="submit" class="btn_tour_modal_update">Update</button>
			</div>
		</form>
		<!-- Modal content ends-->
	</div>
</div>