	<div class="modal lead-modal fade" id="view_payment_history_modal" role="dialog">
		<div class="modal-dialog autoScroll" style="max-width: 1050px;">
			<!-- Modal content-->
			<div class="modal-content autoScroll">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<input type="hidden" name="" value="" id="bookId">
					<h4 class="modal-title">Payment History (Ledger)</h4>
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

				<div class="modal-body">
					<div class="view_payment_history_body">
						<!-- populate from leadDynamicFieldController -> get_payment_history-->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>