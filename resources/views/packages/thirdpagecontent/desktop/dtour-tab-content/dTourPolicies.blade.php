										<!-- Desktop Tour Tabs-Policy Starts -->
										<div class="dTourPkgDesc">
										    <!-- Tour Booking Policies -->
										    @if(!empty($details->payment_p) && $details->payment_p != "N;")
										        <div class="dTourPolicy">
										            <h2>Tour Booking Policies</h2>
										            <?php $p_policy = unserialize($details->payment_p); ?>
										            @foreach($p_policy as $v)
										                {!! CustomHelpers::get_payment_policy($v) !!}<br>
										            @endforeach
										            {{ $details->payment_policy }}
										        </div>
										    @endif

										    <!-- Tour Cancellation Policies -->
										    @if(!empty($details->can_p) && $details->can_p != "N;")
										        <div class="dTourPolicy">
										            <h2>Tour Cancellation Policies</h2>
										            <?php $c_policy = unserialize($details->can_p); ?>
										            @foreach($c_policy as $v)
										                {!! CustomHelpers::get_cancel_policy($v) !!}<br>
										            @endforeach
										            {{ $details->cancel_policy }}
										        </div>
										    @endif

										    <!-- Important Notes -->
										    @if(!empty($details->imp_notes) && $details->imp_notes != "N;")
										        <div class="dTourPolicy">
										            <h2>Important Notes</h2>
										            <?php $important_notes = unserialize($details->imp_notes); ?>
										            @foreach($important_notes as $v)
										                {!! CustomHelpers::get_impnotes($v) !!}<br>
										            @endforeach
										            {{ $details->extra_notes }}
										        </div>
										    @endif
										</div>
										<!-- Desktop Tour Tabs-Policy Ends -->