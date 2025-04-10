	<div class="modal lead-modal fade" id="view_history_modal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<input type="hidden" name="" value="" id="bookId">
					<!-- <h4 class="modal-title">View History</h4> -->
					<h2 class="modal-title">View Lead History</h2>
				</div>
				<div class="modal-body enquiry-timeline">
					<div class="col-md-12">
						<h3>Enquiry Timeline</h3>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<!-- enquiry ref no -->
							<i><div class="enq-ref-no">Enquiry Ref No: #<span class="enq_ref_no"></span></div></i>

							<!-- quote ref no -->
							<!-- <div class="quote-ref-no">Quote Ref No: #<span class="quote_ref_no"></span></div> -->
							@if(isset($query->quo_ref) && !empty($query->quo_ref))
							    <div class="quote-ref-no">
							        Quote Ref No: #<span class="quote_ref_no">{{ $query->quo_ref }}</span>
							    </div>
							@endif
						</div>
					</div>
					<div class="enquiry-timeline-wrapper">
						<div class="container_timeline view_history_body">
							<!-- populate from -->
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>