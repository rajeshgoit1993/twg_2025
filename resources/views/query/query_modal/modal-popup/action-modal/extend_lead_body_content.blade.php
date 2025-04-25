<input type="hidden" name="quote_ref_no" value="{{$data->quo_ref}}">
<div class="row">
                 	<!-- trip date validity -->
                 	<div class="col-md-2">
                 		<label for="quoteValidityDate">Date valid up to</label>
                 		<input type="text" class="form-control datepicker_trip_validity" name="validity" id="quoteValidityDate" value="{{ date('d/m/Y' ,strtotime($data->quote_validity))  }}" />
                 	</div>

                 	<!-- trip time validity -->
                 	<div class="col-md-3">
                 		<label for="quoteValidityTime">Time valid up to</label>
                 		<div class="relativeCont">
                 			<span class="btn-time-reset-cont reset_class">
                                                @if($data->validity_time!='23:59:59')
                                                    <button type="button" class="btn-time-reset">Reset</button>
                                                @endif
                                            </span>
                 		</div>
                 		<input type="time" class="form-control validity_time" value="{{$data->validity_time}}" id="quoteValidityTime" name="validity_time" pattern="^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$" placeholder="HH:MM:SS (24 Hours)" required />
                 	</div>

                 	<!-- pay type -->
                 	<div class="col-md-2">
                 		<label>Pay Immediately</label>
                 		<div class="pay-custom-radio-group makeflex">
                 			<label class="pay-custom-radio flexOne">
                 				<input type="radio" value="Yes" name="validity_show_on_frontend" @if($data->validity_show_on_frontend == 'Yes') checked @endif />
                 				<span class="pay-custom-radio-label">Yes</span>
                 			</label>
                 			<label class="pay-custom-radio flexOne">
                 				<input type="radio" value="No" name="validity_show_on_frontend"  @if($data->validity_show_on_frontend == 'No') checked @endif />
                 				<span class="pay-custom-radio-label">No</span>
                 			</label>
                 		</div>
                 	</div>
                 </div>