			<!--Mobile Filter Modal Starts-->
				<div id="mFilterModal" class="mFilterModalCont">
					<div class="mFilter_ModalContent">
						<div class="mFilter_Sticky">
							<div class="mFilter_Header">
								<h4>Filters</h4>
								<!--<button type="button" class="mFilter_Close" data-dismiss="modal">Close &#10006;</button>-->
								<span class="mFilter_Close" id="btn_close_mFilterModal">Close &#10006;</span>
							</div>
						</div>
						<!--Filter Modal body-->
						<div class="mFilter_ModalBody">
							<div class="mFilter_DescTag">Refine your search by cities, themes, duration or budget</div>
							<div>
								<!--Destination covered starts-->
								<div class="mFilter_ItemBox">
									<h4 id="place_covered" class="dropbtn1">Covered Places</h4>
									<div class="mFilter_ItemContent dropdown1">
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
												<?php
													$city_data=DB::table('rt_packages')
													->where([['city', 'like', '%' . $package . '%'],['status', '=', '1'],])
													->get();
												?>
												<label class="mFilter_DropLabel">
													<input type="checkbox" class="mdropCheckBox" name="chk_value" value="{{ $package }}">
													<span class="mFilter_CheckMark"></span>
													<div class="fullWidth">
														<div>{{ $package }} <span class="mItemCount">({{ count($city_data) }})</span></div>
													</div>
												</label>
											@endif
										@endforeach
									</div>
								</div>
								<!--Budget price starts-->
								<div class="mFilter_ItemBox">
									<h4>Budget <i class="mFilter_ItemSubHead">per person</i></h4>
									<div id="price" class="mFilter_ItemContent-budget dropdown2" style="display: block;">
										<div id="price-ranges_mobile" class="mbudgetSlider"></div>
										<!--<div id="price-ranges" class="drop"></div>-->
										<div class="mrangeSection">
											<span class="min-price-label"></span>
											<span class="max-price-label"></span>
										</div>
									</div>
								</div>
								<!--Duration starts-->
								<div class="mFilter_ItemBox">
									<h4 class="">Duration <span class="mFilter_ItemSubHead">in Nights</span></h4>
									<div id="duration" class="mFilter_ItemContent dropdown3">
										<!--<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel">
													<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="7">Less than 7 nights
												</label>
											</div>
										</div>-->
										<label class="mFilter_DropLabel">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="7">
											<span class="mFilter_CheckMark"></span>
											<div class="fullWidth">
												<div>Less than 7 nights <span class="mItemCount"></span></div>
											</div>
										</label>
										<!--<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel">
													<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="8">8 to 12 nights
												</label>
											</div>
										</div>-->
										<label class="mFilter_DropLabel">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="8">
											<span class="mFilter_CheckMark"></span>
											<div class="fullWidth">
												<div>8 to 12 nights <span class="mItemCount"></span></div>
											</div>
										</label>
										<!--<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="12">More than 12 Nights</label>
											</div>
										</div>-->
										<label class="mFilter_DropLabel">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="12">
											<span class="mFilter_CheckMark"></span>
											<div class="fullWidth">
												<div>More than 12 Nights <span class="mItemCount"></span></div>
											</div>
										</label>
									</div>
								</div>
								<!--Travel Type starts-->
								<div class="mFilter_ItemBox">
									<h4 class="dropbtn4">Travel Type</h4>
									<div id="travel_type" class="mFilter_ItemContent dropdown4">
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
											<!--<div class="mFilter_Drop">
												<div class="drop makeflex">
													<label class="mFilter_DropLabel">
														<input type="checkbox" class="mFilter_DropCheckBox" name="chk_travel" value="{{ $package }}">{{ $package }}
													</label>
												</div>
											</div>-->
											<label class="mFilter_DropLabel">
												<input type="checkbox" class="mFilter_DropCheckBox" name="chk_travel" value="{{ $package }}">
												<span class="mFilter_CheckMark"></span>
												<div class="fullWidth">
													<div>{{ $package }} <span class="mItemCount"></span></div>
												</div>
											</label>
										@endif
									@endforeach
								</div>
								</div>
								<!--Theme starts-->
								<div class="mFilter_ItemBox">
									<h4 class="dropbtn5">Theme</h4>
									<div id="more" class="mFilter_ItemContent dropdown5">
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
											<!--<div class="mFilter_Drop">
												<div class="drop makeflex">
													<label class="mFilter_DropLabel">
														<input type="checkbox" class="mFilter_DropCheckBox" name="chk_more" value="{{ $package }}">{{ $package }}
													</label>
												</div>
											</div>-->
											<label class="mFilter_DropLabel">
												<input type="checkbox" class="mFilter_DropCheckBox" name="chk_more" value="{{ $package }}">
												<span class="mFilter_CheckMark"></span>
												<div class="fullWidth">
													<div>{{ $package }} <span class="mItemCount"></span></div>
												</div>
											</label>
											@endif
										@endforeach
									</div>
								</div>
								<!--Guest Rating starts-->
								<div class="mFilter_ItemBox">
									<h4 class="dropbtn dropbtn6">Package Preferences</h4>
									<div id="guest_rate" class="mFilter_ItemContent dropdown6">
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
										<!--<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="chk_gest" value="{{ $package }}">{{ $package }} Star</label>
											</div>
										</div>-->
										<label class="mFilter_DropLabel">
											<input type="checkbox" class="mFilter_DropCheckBox" name="chk_gest" value="{{ $package }}">
											<span class="mFilter_CheckMark"></span>
											<div class="fullWidth">
												<div>{{ $package }} Star<span class="mItemCount"></span></div>
											</div>
										</label>
										@endif
										@endforeach
									</div>
								</div>
							</div>
						</div>
						<div class="fixedFooter">
							<div class="mFilter_Footer">
								<div class="mTourCount">1<i class="font12">/1</i> Packages</div>
								<div>
								<button type="button" class="btnFilterReset" id="refine_mobsearch">Reset</button>
								<button type="button" class="btnFilterApply">Apply</button>
								<!--<button type="button" class="btnFilterApply" data-dismiss="modal">Apply</button>-->
								</div>
							</div>
						</div>
					</div>
		    	</div>
		    	<!--Mobile Filter Modal Ends-->