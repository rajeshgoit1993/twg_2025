<div class="modal fade my-profile-modal" id="email_verify_modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content cont">
			<div class="make-sticky-header whitebg" style="border-radius: 5px 5px 0 0;">
		        <div class="modal-header wrapper">
		          <button type="button" class="close close-my-profile-modal" data-dismiss="modal">&times;</button>
		          <h4>Verify Email Id</h4>
		        </div>
		      </div>
			<div class="modal-body box">
				<div class="flex-column" style="row-gap: 10px;">
					<!-- email verification otp -->
					<div class="col-md-12">
						<div class="form-group">
							<p class="">OTP has been sent on registered email id</p>
						</div>
					</div>
					<!-- enter otp -->
					<div class="col-md-12 relativeCont">
						<div class="form-group">
							<label for="otp" class="labelblackText">OTP</label>
							<input type="text" class="otp_value" name="otp" maxlength="8" placeholder="Enter OTP">
						</div>
						<!-- resend otp -->
						<span class="resendmobileOTP resend-OTP disabled">Resend OTP</span>
					</div>
					<!-- footer -->
		          	<div class="make-sticky-footer">
		            	<div class="modal-footer wrapper">
		              		<button type="button" class="btn-main cancel" data-dismiss="modal">Cancel</button>
		              		<button type="button" name="verify" class="email_verify_button btn-main save">Submit</button>
		            	</div>
		          	</div>
				</div>
			</div>
		</div>
	</div>
</div>