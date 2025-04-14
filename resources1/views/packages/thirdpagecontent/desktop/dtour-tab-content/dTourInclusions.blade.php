								<!--Desktop Tour Tabs-Inclusions Starts-->
								<div class="dTourPkgDesc">
									@if($details->inclusions!="")
									<div class="dTourInclusions"> 
										<h2>Tour Inclusions</h2>
										<p>{!!$details->inclusions!!}</p>
									</div>
									<!--<div class="custom_padding"></div>-->
									@endif
									@if($details->exclusions!="")
									<div class="dTourInclusions" id="description">
										<h2>Tour Exclusions</h2>
										<p>{!!$details->exclusions!!}</p>
									</div>
									@endif
								</div>
								<!--Desktop Tour Tabs-Inclusions Ends-->