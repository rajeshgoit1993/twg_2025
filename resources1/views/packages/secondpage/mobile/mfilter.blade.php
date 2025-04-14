<style type="text/css">
.mFltrTtl {
	cursor: default;
	font-size: 14px;
	line-height: 14px;
	color: #08b2ed;
	font-weight: 600;
	display: flex;
	align-items: baseline;
	flex-shrink: 0;
	justify-content: flex-end;
	}

</style>

			<!--Mobile Filter Modal Starts-->
			<div id="mobilefilter" class="modal fade" role="dialog">
				<div class="modal-dialog" style="height: 100%;">
					<!--Filter Modal Content-->
					<div class="mFilter_ModalContent">
						<div class="mFilter_Sticky">
							<div class="mFilter_Header">
								<h4>Filters</h4>
								<button type="button" class="mFilter_Close" data-dismiss="modal">Close &#10006;</button>
							</div>
						</div>
						<div class="mFilter_DescTag">Refine your search by cities, themes, duration or budget</div>
						<!--Filter Modal body-->
						<div class="mFilter_ModalBody">
							<!--Covered Places starts-->
							<div class="" style="">
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
												<label class="mFilter_DropLabelNew">
													<input type="checkbox" class="mdropCheckBox" name="chk_value" value="{{ $package }}">
													<span class="mFilter_CheckMark"></span>
													<div class="">{{ $package }}</div>
												</label>
											@endif
										@endforeach
									</div>
								</div>
								<!--Budget price starts-->
								<div class="mFilter_ItemBox">
									<h4>Budget <span class="mbudgetSubHeading">per person</span></h4>
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
									<h4 class="">Duration</h4>
									<div id="duration" class="mFilter_ItemContent dropdown3">
										<label class="mFilter_DropLabelNew">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="7">
											<span class="mFilter_CheckMark"></span><div class="">Less than 7 nights</div>
										</label>
										<label class="mFilter_DropLabelNew">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="8">
											<span class="mFilter_CheckMark"></span><div class="">8 to 12 nights</div>
										</label>
										<label class="mFilter_DropLabelNew">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="12">
											<span class="mFilter_CheckMark"></span><div class="">More than 12 Nights</div>
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
											<label class="mFilter_DropLabelNew">
												<input type="checkbox" class="mFilter_DropCheckBox" name="chk_travel" value="{{ $package }}">
												<span class="mFilter_CheckMark"></span><div class="">{{ $package }}</div>
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
											<label class="mFilter_DropLabelNew">
												<input type="checkbox" class="mFilter_DropCheckBox" name="chk_more" value="{{ $package }}">
												<span class="mFilter_CheckMark"></span><div class="">{{ $package }}</div>
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
										<label class="mFilter_DropLabelNew">
											<input type="checkbox" class="mFilter_DropCheckBox" name="chk_gest" value="{{ $package }}">
											<span class="mFilter_CheckMark"></span><div class="">{{ $package }} Star</div>
										</label>
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
			<!--Mobile Filter Modal Ends-->