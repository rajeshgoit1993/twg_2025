<!-- Modal for Uploading and Sending Voucher -->
<div class="modal lead-modal fade" id="send_voucher" role="dialog">
    <div class="modal-dialog">
        <!-- Modal Content -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <input type="hidden" name="" value="">
                <h4 class="modal-title">Upload Voucher</h4>
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
            
            <!-- Modal Body -->
            <div class="modal-body custom_border">
                <!-- Form for Uploading and Sending Voucher -->
                <form action="{{ url('/send_voucher_file') }}" enctype="multipart/form-data" method="post" id="voucher_data">
                    {{ csrf_field() }}

                    <!-- Hidden Input for Lead ID -->
                    <input type="hidden" name="lead_id" value="" id="lead_id">
                    
                    <!-- Select File Type -->
                    <div class="form-group">
	                    <label for="filetype">File Type</label>
	                    <select class="form-control" name="file_type" id="filetype" required>
	                        <!-- <option disabled >Select file</option> -->
	                        <option value="0" selected>Reservation Voucher</option>
	                        <option value="1">TCS</option>
	                        <option value="2">Invoice</option>
	                    </select>
	                </div>
                    
                    <!-- Input for Subject -->
                    <div class="form-group">
	                    <label for="subject">Subject</label>
	                    <input type="text" class="form-control" name="subject" id="subject" required placeholder="Subject">
	                </div>
                    
                    <!-- File Upload Input -->
                    <div class="form-group">
	                    <label for="fileInput">Upload File</label>
	                    <input type="file" name="voucher[]" id="fileInput" class="voucher form-control" accept=".pdf" required multiple />
	                </div>
                    
                    <!-- Container for Displaying Selected File Names -->
                    <div id="fileNames"></div>
                    <br>
                    
                    <!-- Submit Button -->
                    <div class="textCenter">
	                    <button type="submit" class="btn_lead_modal_update send_file">Send</button>
	                </div>
                </form>
            </div>
        </div>
    </div>
</div>