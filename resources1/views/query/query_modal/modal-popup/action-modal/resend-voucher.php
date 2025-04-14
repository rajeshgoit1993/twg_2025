<!-- quotation -->

<!-- Resend Voucher Modal -->
<div class="modal fade" id="resend_voucher" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="border-radius: 3px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Resend Voucher</h4>
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
                <!-- Form to Resend Voucher -->
                <form action="{{url('/resend_voucher_file')}}" enctype="multipart/form-data" method="post" id="resend_voucher_file">
                    <!-- CSRF Token for Form Security -->
                    {{csrf_field()}}
                    <!-- Hidden Input to Store Resend Lead ID -->
                    <input type="hidden" name="lead_id" value="" id="resend_lead_id">
                    
                    <!-- Voucher File Type -->
                    <div class="file_type"></div>
                    <br>
                    <!-- Submit Button to Upload and Send Voucher -->
                    <input type="submit" value="Upload & Send" class="send_file btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>