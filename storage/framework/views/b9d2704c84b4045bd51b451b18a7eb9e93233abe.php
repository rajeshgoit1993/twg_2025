<div class="panelBox">
						<div class="panelContent">
							<div class="item-container">
								<div class="row">
									<!-- trip date validity -->
									<?php
										// Get the current date in the desired format (e.g., YYYY-MM-DD or DD-MM-YYYY)
										$currentDate = date('d-m-Y'); // Format as dd-mm-yyyy or use another format if needed
									?>
									<div class="col-md-2">
									    <label for="quoteValidity">Date valid upto</label>
									    <input type="text" class="form-control datepicker_s" name="validaty" value="<?php echo $currentDate; ?>">
									</div>

									<!-- trip time validity -->
									<div class="col-md-3">
									    <label for="quoteValidity">Time valid upto</label>
									    <div class="relativeCont">
									        <span class="btn-time-reset-cont reset_class"></span>
									    </div>
									    <input type="text" class="form-control validity_time" value="23:59:59" id="timeInput" name="validity_time" pattern="^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$" placeholder="HH:MM:SS (24 Hours)" required />
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
							</div>
						</div>
					</div>