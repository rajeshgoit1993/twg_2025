								<!--Desktop Tour Tabs-Visa Starts-->
								<div class="dTourPkgDesc">
									<!--Visa Policies-->
									@if($details->visa=="1")
									<div class="dTourHgLhts visa-separator dVisaBox">
										<h2>Visa Policies</h2>
										@if(empty($details->visa_p) || $details->visa_p=="N;")
										@else
										<?php $v_policy=unserialize($details->visa_p); ?>
										@foreach($v_policy as $v)
										{!!CustomHelpers::get_visa_policy($v)!!}
										</br>
										@endforeach
										@endif
										{{ $details->visa_policies }}
									</div>
									<!--<div class="custom_padding"></div>-->
									@endif
								</div>
								<!--Desktop Tour Tabs-Visa Ends-->