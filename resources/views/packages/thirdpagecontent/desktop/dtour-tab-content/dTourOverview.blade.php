									<!--Desktop Tour Tabs-Overview Starts-->
									<div class="dTourPkgDesc">
										@if($details->description!="")
										<!--<div class="dTourDesc" style="display: none;">
											<h2>Tour Description</h2>
											<p>{!!$details->description!!}</p>
										</div>-->
										@endif
										@if($details->description!="" && $details->highlights!="")
										@endif
										@if($details->highlights!="")
										<div class="dTourHgLhts dHgLhtsSeparator">
											<h2>Tour Highlights</h2>
											<p>{!! $details->highlights !!}</p>
										</div>
										@endif
									</div>
									<!--Desktop Tour Tabs-Overview Ends-->