								<!--Desktop Tour Tabs-Destination Starts-->
								<div class="dTourPkgDesc">
									<div class="dTourHgLhts">
										<h2>Tour Destination</h2>
										<div>
										<?php
											$destinations=$details->destinations;
											if($destinations!='' && $destinations!='N;') {
												$city1=unserialize($details->destinations);
												$city_data=array_unique($city1);
												}
											else {
												$city1=unserialize($details->city);
												$city_data=array_unique($city1);
												}
										?>
										@foreach($city_data as $data)
											@if(CustomHelpers::get_destination_data($data,'status')=="1")
											<?php
												$best_time=CustomHelpers::get_destination_data($data,'best_time_desc');
												$overview=CustomHelpers::get_destination_data($data,'overview');
											?>
											<div class="collapsible-container">
												<div class="collapsible-item dItem-box dItem-arrow">
													<span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;{{ $data }},&nbsp;{{ CustomHelpers::get_destination_data($data,'country') }}
												</div>
												<!--Collapsible Content-->
												<div class="collapsible-item-content" id="mob{{ str_slug($data, '-') }}">
													<div class="dDest-content-box">
														@if($overview!="")
														<div class="dDest-content-box-overview">
															<h3>About City</h3>
															<p>{!! $overview !!}</p>
														</div>
														@endif
														@if($best_time!="")
														<div class="dDest-content-box-best-time">
															<h3>Best Time To Visit</h3>
															<p>{!! $best_time !!}</p>
														</div>
														@endif
													</div>
												</div>
											</div>
											@endif
										@endforeach
										</div>
									</div>
								</div>
								<!--Desktop Tour Tabs-Destination Ends-->
								<!--Desktop-Tour-Tab-Collapsible-item-script-pagethree.js-->