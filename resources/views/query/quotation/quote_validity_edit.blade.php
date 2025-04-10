<div class="panelBox">
						<div class="panelContent">
							<div class="item-container">
								<div class="row">
									<!-- trip date validity -->
									<div class="col-md-2">
										<label for="quoteValidity">Quote Validity Date</label>
										<input type="text" class="
										datepicker_s form-control" name="validaty" value="{{ date('d/m/Y' ,strtotime($packagesData->quote_validaty))  }}">
									</div>

									<!-- trip time validity -->
									<div class="col-md-3">
										<label for="quoteValidity">Quote Validity Time</label>
										<div class="relativeCont">
											<span class="btn-time-reset-cont reset_class">
												@if($packagesData->validity_time!='23:59:59')
													<button type="button" class="btn-time-reset">Reset</button>
												@endif
											</span>
										</div>
										<input type="text" class="validity_time form-control" value="{{$packagesData->validity_time}}" id="timeInput" name="validity_time" pattern="^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$" placeholder="HH:MM:SS (24 Hours)" required />
									</div>
									
									<!-- pay now -->
									<div class="col-md-2">
									    <label>Pay Immediately</label>
									    <div class="pay-custom-radio-group makeflex">
									        <label class="pay-custom-radio flexOne">
									            <input type="radio" value="Yes" name="validity_show_on_frontend" 
									                @if($packagesData->validity_show_on_frontend == 'Yes') checked @endif />
									            <span class="pay-custom-radio-label">Yes</span>
									        </label>
									        <label class="pay-custom-radio flexOne">
									            <input type="radio" value="No" name="validity_show_on_frontend" 
									                @if($packagesData->validity_show_on_frontend == 'No') checked @endif />
									            <span class="pay-custom-radio-label">No</span>
									        </label>
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>