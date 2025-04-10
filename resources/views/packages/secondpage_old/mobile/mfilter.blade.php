			<!-- Modal -->
			<div id="mobilefilter" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="mModalContent">
						<div class="mStickyBar">
							<div class="mModalHeader">
								<h4 class="mModalTitle">Advance Search</h4>
								<button type="button" class="btnMain mbtnCloseModal" data-dismiss="modal">Close &#10006;</button>
							</div>
						</div>
						<div class="mfilterDescCont">
							<p class="mfilterDesc">Refine your search by cities, themes, duration or budget</p>
						</div>
						<!--Modal body-->
						<div class="mModalBody">
							<!--Covered Places starts-->
							<div class="" style="">
								<!--Destination covered starts-->
								<div class="mfilterBox">
										<p id="place_covered" class="mfilterHeading dropbtn1">Covered Places</p>
										<div class="mFilterContent dropdown1">
											<?php $package_city=""; ?>
											@foreach($data as $package)
												<?php
													$city=unserialize($package->city);
													foreach($city as $cit) {
														$package_city.=$cit.",";
														}
												?>
											@endforeach
												<?php
													$pac_city=(explode(",", $package_city));
													$pac_city=array_unique($pac_city);
												?>
											@foreach($pac_city as $package)
											@if($package!="")
												<div class="mdrop">
													<div class="drop makeflex">
														<label class="mdropLabel"><input type="checkbox" class="mdropCheckBox" name="chk_value" value="{{ $package }}">{{ $package }}</label>
													</div>
												</div>
											@endif
											@endforeach
										</div>
								</div>
								<!--Budget price starts-->
								<div class="mfilterBox">
									<p class="mfilterHeading">Budget <span class="mbudgetSubHeading">per person</span></p>
									<div id="price" class="mFilterContent-budget dropdown2" style="display: block;">
										<div id="price-ranges_mobile" class="mbudgetSlider"></div>
										<!--<div id="price-ranges" class="drop"></div>-->
										<div class="mrangeSection">
											<span class="min-price-label"></span>
											<span class="max-price-label"></span>
										</div>
									</div>
								</div>
								<!--Duration starts-->
								<div class="mfilterBox">
									<p class="mfilterHeading">Duration</p>
									<div id="duration" class="mFilterContent dropdown3">
										<div class="mdrop">
											<div class="drop makeflex">
												<label class="mdropLabel"><input type="checkbox" class="mdropCheckBox" name="duration" value="7">Less than 7 nights</label>
											</div>
										</div>
										<div class="mdrop">
											<div class="drop makeflex">
												<label class="mdropLabel"><input type="checkbox" class="mdropCheckBox" name="duration" value="8">8 to 12 nights</label>
											</div>
										</div>
										<div class="mdrop">
											<div class="drop makeflex">
												<label class="mdropLabel"><input type="checkbox" class="mdropCheckBox" name="duration" value="12">More than 12 Nights</label>
											</div>
										</div>
									</div>
								</div>
								<!--Travel Type starts-->
								<div class="mfilterBox">
									<p class="mfilterHeading dropbtn4">Travel Type</p>
									<div id="travel_type" class="mFilterContent dropdown4">
											<?php $package_transport=""; ?>
											@foreach($data as $package)
											<?php $package_transport.=$package->transport.","; ?>
											@endforeach
											<?php
											$pac_transport=(explode(",", $package_transport));
											$pac_transport=array_unique($pac_transport);
											?>
											@foreach($pac_transport as $package)
											@if($package!="0" && $package!="")
											<div class="mdrop">
												<div class="drop makeflex">
													<label class="mdropLabel"><input type="checkbox" class="mdropCheckBox" name="chk_travel" value="{{ $package }}">{{ $package }}</label>
												</div>
											</div>
											@endif
											@endforeach
										</div>
								</div>
								<!--Theme starts-->
								<div class="mfilterBox">
									<p class="mfilterHeading dropbtn5">Theme</p>
									<div id="more" class="mFilterContent dropdown5">
											<?php $package_theme=""; ?>
												@foreach($data as $package)
											<?php
												$theme=unserialize($package->package_category);
												if(count($theme)!="0"):
													foreach($theme as $the) {
													$package_theme.=$the.",";
													}
												endif;
											?>
											@endforeach
											<?php
												$pac_theme=(explode(",", $package_theme));
												$pac_theme=array_unique($pac_theme);
											?>
											@foreach($pac_theme as $package)
											@if($package!="")
											<div class="mdrop">
												<div class="drop makeflex">
													<label class="mdropLabel"><input type="checkbox" class="mdropCheckBox" name="chk_more" value="{{ $package }}">{{ $package }}</label>
												</div>
											</div>
											@endif
											@endforeach
											</div>
								</div>
								<!--Guest Rating starts-->
								<div class="mfilterBox">
									<p class="mfilterHeading dropbtn dropbtn6">Package Preferences</p>
									<div id="guest_rate" class="mFilterContent dropdown6">
										<?php $guest_rating=""; ?>
										@foreach($data as $package)
										<?php $guest_rating.=$package->customer_rating.","; ?>
										@endforeach
										<?php
											$gue_rating=(explode(",", $guest_rating));
											rsort($gue_rating);
											$gue_rating=array_unique($gue_rating);
										?>
										@foreach($gue_rating as $package)
										@if($package!="0" && $package!="")
										<div class="mdrop">
											<div class="drop makeflex">
												<label class="mdropLabel"><input type="checkbox" class="mdropCheckBox" name="chk_gest" value="{{ $package }}">{{ $package }} Star</label>
											</div>
										</div>
										@endif
										@endforeach
									</div>
								</div>
							</div>
						</div>
						<div class="fixedFooter">
							<div class="modal-footer ">
								<button type="button" class="btnFilterReset" id="refine_mobsearch">Reset</button>
								<button type="button" class="btnFilterApply" data-dismiss="modal">Apply</button>
							</div>
						</div>
					</div>
				</div>
			</div>