<!-- enquiry via OTP -->
<div class="modal fade" id="myModal_destop_otp" role="dialog"> 
    <div class="modal-dialog">
    
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header modalHeader_enquiry">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>{{ $details->title }}</h3>
                <h4>{{ $details->duration }} Nights / {{ $details->duration + 1 }} Days</h4>
            </div>
            <div class="modal-body modalBody_enquiry">
                <!-- Modal body -->
                <div class="modalBody_enq">
                    <input type="hidden" name="packageId" value="{{ $details->id }}" />
                    <input type="hidden" name="package_name" value="{{ $details->title }}" />

                    <!-- OTP Fields -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- OTP -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>OTP has been sent successfully on Mobile & Email-id</p>
                                </div>
                                <label for="enq_otp_value">Enter OTP</label>
                                <div class="user-input-group apndBtm10">
                                    <span class="user-input-group-addon">
                                        <i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" id="enq_otp_value" name="enq_otp_value" value="{{ old('email') }}" placeholder="Enter OTP" required />

                                    <!-- OTP timer & Resend -->
                                    <span class="timer otp-timer" id="timer"></span>
                                    <span id="btn_resendOTP" class="resendOTP" style="display: none;">Resend</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modalFooter_enq">
                <button type="button" class="btnMain submit_otp_enq" name="submit" value="Submit">Continue</button>
                
            </div>
        </div>
        
    </div>
</div>