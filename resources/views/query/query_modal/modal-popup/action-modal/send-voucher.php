<!-- Attach and Send Voucher Modal -->
<div class="modal fade" id="send_voucher" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="border-radius: 3px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
            <div class="modal-body custom_border" style="font-size: 15px; line-height: 24px;">
                <!-- Form to Upload and Send Voucher -->
                <form action="{{url('/send_voucher_file')}}" enctype="multipart/form-data" method="post" id="voucher_data">
                    <!-- CSRF Token for Form Security -->
                    {{csrf_field()}}
                    <!-- Hidden Input to Store Lead ID -->
                    <input type="hidden" name="lead_id" value="" id="lead_id">
                    
                    <!-- Voucher File Upload Field -->
                    <label>Upload Voucher</label>
                    <input type="file" name="voucher[]" class="voucher form-control" 
                           style="padding: 6px; height: 36px; border-radius: 3px;" 
                           required multiple>
                    <br>
                    <!-- Submit Button to Upload and Send Voucher -->
                    <button type="submit" class="send_file btn btn-success">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>