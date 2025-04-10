<!-- Extend Validity Modal -->
<div id="extendValidityModal" class="modal">
    <div class="modalContent lead-modalbox">
        <form id="extend_trip_validity" method="POST" enctype="multipart/form-data">

            <!-- Modal header-->
            <div class="lead-modalheader">
                <h2>Extend Quote Validity</h2>
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

            	<!-- Trip Quote Validity Section -->
            	<div class="row">
                 	<!-- trip date validity -->
                 	<div class="col-md-2">
                 		<label for="quoteValidityDate">Date valid up to</label>
                 		<input type="text" class="form-control datepicker_trip_validity" name="validaty" id="quoteValidityDate" value="" />
                 	</div>

                 	<!-- trip time validity -->
                 	<div class="col-md-3">
                 		<label for="quoteValidityTime">Time valid up to</label>
                 		<div class="relativeCont">
                 			<span class="btn-time-reset-cont reset_class"></span>
                 		</div>
                 		<input type="time" class="form-control validity_time" value="" id="quoteValidityTime" name="validity_time" pattern="^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$" placeholder="HH:MM:SS (24 Hours)" required />
                 	</div>

                 	<!-- pay type -->
                 	<div class="col-md-2">
                 		<label>Pay Immediately</label>
                 		<div class="pay-custom-radio-group makeflex">
                 			<label class="pay-custom-radio flexOne">
                 				<input type="radio" value="Yes" name="validity_show_on_frontend" />
                 				<span class="pay-custom-radio-label">Yes</span>
                 			</label>
                 			<label class="pay-custom-radio flexOne">
                 				<input type="radio" value="No" name="validity_show_on_frontend" checked />
                 				<span class="pay-custom-radio-label">No</span>
                 			</label>
                 		</div>
                 	</div>
                 </div>
                <!-- End of Trip Quote Validity Section -->
            </div>

            <!-- Modal footer -->
            <div class="lead-modalfooter">
                <button type="button" class="btn_lead_modal_close btn-close-extendValidityModal">Cancel</button>
                <button type="submit" class="btn_lead_modal_update btn-update-extend-validity">Update</button>
            </div>
        </form>
    </div>
</div>

