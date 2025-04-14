<!-- Lead Follow-up Modal -->
<div id="lead_follow_up_modal" class="modal">
	<div class="modalContent lead-modalbox">
		<form class="user" id="follow_up" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="query_id" id="query_id_lead_follow_up" value="">

			<!-- Modal content starts-->
			<!-- Modal header-->
			<div class="lead-modalheader">
				<h2>Add Lead Follow-up</h2>
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
					<label for="assigned_user" class="detailsInput">Assigned User Name </label>
					<select class="lead-input-text fullWidth" required id="assign_person" name="assign_person"></select>
				</div>
				<!--Follow-up Reason-->
				<div class="form-group">
					<label for="follow_up_reason" class="detailsInput">Follow-up Reason </label>
					<select class="lead-input-text fullWidth" required id="follow_up_reason" name="follow_up_reason"></select>
				</div>

				<!--Follow-up Date & Time-->
				<div class="form-group fullWidth">
					<label for="follow_up_date_time" class="detailsInput">Follow-up Date & Time </label>
					<div class="makeflex">
						<?php 
							$date=date('Y-m-d');
							$time=date('H:i');
							$date_time=$date.'T'.$time;
						?>
						<input type="datetime-local" id="meeting-time" value="{{$date_time}}" min="{{$date_time}}" class="lead-input-text fullWidth" id="follow_up_date_time" name="follow_up_date" style="border-radius: 4px 0px 0px 4px;" required/>
						<!-- <input type="date" required class="lead-input-text fullWidth" id="follow_up_date_time" name="follow_up_date" style="border-radius: 4px 0px 0px 4px; border-right: none;" />
						<input type="time" required class="lead-input-text fullWidth" id="follow_up_date_time" name="follow_up_time" style="border-radius: 0px 4px 4px 0px" /> -->
					</div>
				</div>

				<!--User Remarks-->
				<div class="form-group">
					<label for="user_remarks">Remarks</label>
					<!--<label for="additionaletails" style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Additional details</label>-->
					<textarea class="lead-input-text-area fullWidth" type="text" required name="remarks" style="" placeholder="Remarks"></textarea>
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
			<div class="lead-modalfooter">
				<button type="button" class="btn_lead_modal_close">Cancel</button>
				<button type="submit" class="btn_lead_modal_update">Update</button>
			</div>
 		</form>
		<!-- Modal content ends-->
	</div>
</div>