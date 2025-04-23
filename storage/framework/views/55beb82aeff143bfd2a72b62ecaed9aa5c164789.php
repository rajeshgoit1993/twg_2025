<div class="panelBox">
						<div class="panelContent">
							<div class="item-container">
								<div class="row">
									<!-- trip date validity -->
									<div class="col-md-2">
										<label for="quoteValidity">Quote Validity Date</label>
										<input type="text" class="
										datepicker_s form-control" name="validity" value="<?php echo e(date('d/m/Y' ,strtotime($packagesData->quote_validity))); ?>">
									</div>

									<!-- trip time validity -->
									<div class="col-md-3">
										<label for="quoteValidity">Quote Validity Time</label>
										<div class="relativeCont">
											<span class="btn-time-reset-cont reset_class">
												<?php if($packagesData->validity_time!='23:59:59'): ?>
													<button type="button" class="btn-time-reset">Reset</button>
												<?php endif; ?>
											</span>
										</div>
										<input type="text" class="validity_time form-control" value="<?php echo e($packagesData->validity_time); ?>" id="timeInput" name="validity_time" pattern="^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$" placeholder="HH:MM:SS (24 Hours)" required />
									</div>
									
									<!-- pay now -->
									<div class="col-md-2">
									    <label>Pay Immediately</label>
									    <div class="pay-custom-radio-group makeflex">
									        <label class="pay-custom-radio flexOne">
									            <input type="radio" value="Yes" name="validity_show_on_frontend" 
									                <?php if($packagesData->validity_show_on_frontend == 'Yes'): ?> checked <?php endif; ?> />
									            <span class="pay-custom-radio-label">Yes</span>
									        </label>
									        <label class="pay-custom-radio flexOne">
									            <input type="radio" value="No" name="validity_show_on_frontend" 
									                <?php if($packagesData->validity_show_on_frontend == 'No'): ?> checked <?php endif; ?> />
									            <span class="pay-custom-radio-label">No</span>
									        </label>
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>