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
/*Mobile Filter Starts*/
.mFilter_ModalContent {
    position: relative;
    background: #f2f2f2;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #999;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    outline: 0;
	}
.mFilter_Sticky {
    position: sticky;
    top: 0;
    z-index: 11;
    background: #fff;
	}
.mFilter_Header {
    padding: 15px;
    box-shadow: 0px 2px 10px rgb(0 0 0 / 10%);
    /*border-bottom: 1px solid #e5e5e5;*/
    display: flex;
    align-items: center;
    justify-content: space-between;
	}
.mFilter_Header h4 {
	font-size: 16px;
	line-height: 16px;
	color: #001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.mFilter_Close {
	display: inline-block;
    outline: 0;
    text-transform: capitalize;
    background: #fff;
    border: 0;
    padding: 6px;
    font-size: 12px;
    line-height: 12px;
    color: #848889;
    font-weight: 700;
    cursor: default;
    text-align: center;
	white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
	}
.mFilter_Close:hover {
    color: #848889;
    background: #fff;
	}
.mFilter_DescBox {
    background: #EAF5FF;
    padding: 13px;
    font-size: 14px;
    line-height: 17px;
    font-weight: 500;
    margin: 0;
    color: #0084FF;
    text-align: center;
	}
.mFilter_ModalBody {
	position: relative;
	padding: 0px;
	}
.mFilter_ItemBox {
    padding: 13px;
    background: #ffff;
    margin-bottom: 10px;
	}
.mFilter_ItemBox h4 {
    color: #333;
    font-size: 12px;
    line-height: 16px;
    text-align: left;
    margin-bottom: 15px;
    text-transform: uppercase;
	cursor: default;
	}
.mFilter_ItemContent {
    background: #fff;
	box-shadow: none !important;
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    position: relative;
	}
.mFilter_Drop {
    margin-right: 10px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
	}
.mFilter_DropLabel {
    font-size: 14px;
    line-height: 16px;
    color: #000001 !important;
    margin-bottom: 0;
    margin-right: 0 !important;
    font-weight: 500;
    padding: 6px 10px;
    border: 1px solid #e7e7e7;
    border-radius: 20px;
    min-width: 110px;
    display: flex;
    align-items: center;
	}
.mFilter_DropCheckBox {
    margin: 0 8px 0 0 !important;
    width: 12px;
    height: 16px;
	}
.mbudgetSubHeading {
    font-size: 12px;
    color: #9B9B9B;
    font-style: italic;
    text-transform: lowercase;
	}
.mrangeSection {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 10px;
	}
.mbudgetSlider {
	margin: 20px 15px;
	}
.mTopBar {
	position: sticky;
	top: 0px;
	z-index:11;
	background: #fff;
	}

.mBtnCls {
	flex-shrink: 0;
	outline: 0;
	text-transform: capitalize;
	background: #fff;
	border: 0;
    border-radius: 3px;
	padding: 6px;
    font-size: 14px;
	line-height: 14px;
	color: #a1a1a1;
	font-weight: 500;
	cursor: default;
	margin-bottom: 0;
	}
.mBtnCls:hover {
	background: #fff;
	color: #a1a1a1;
	}
.mFltrTag {
	padding: 5px 0;
	background: #EAF5FF;
	}
.mFltrTag p {
	font-size: 14px;
	line-height: 16px;
	color: #0084FF;
	font-weight: 500;
	text-align: center;
	margin-bottom: 0;
	font-family: lato;
	}
.btnFilterApply {
	flex-shrink: 0;
	outline: 0;
	text-transform: capitalize;
	font-size: 14px;
    line-height: 14px;
	color: #fff;
	font-weight: 900;
	cursor: default;
	padding: 8px 20px;
	border: none;
	border-radius: 5px;
	background: #01b7f2;
	height: 34px;
	white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    letter-spacing: 0.64px;
    margin-bottom: 0;
	}
.btnFilterApply:hover {
	color: #fff;
	background: #01b7f2;
	}
.btnFilterReset {
    cursor: default;
	flex-shrink: 0;
	outline: 0;
	text-transform: none;
	/*color: #848889;*/
	font-size: 14px;
    line-height: 14px;
	color: #fff;
	font-weight: 500;
	cursor: default;
	padding: 0 5px;
	background: #fff;
	height: 34px;
	white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    letter-spacing: 0.64px;
    margin-bottom: 0;
	}
.btnFilterReset:hover {
	background-color: #fff;
	color: #fff;
	}
.btnFilterReset-active {
    cursor: default;
	flex-shrink: 0;
	outline: 0;
	text-transform: none;
	color: #01b7f2;
	font-weight: 600;
	padding: 8px 20px;
	border: 1px solid #01b7f2;
	border-radius: 5px;
	background: #fff;
	}
.fixedFooter {
    width: 100%;
    height: 60px;
    background-color: #fff;
    position: sticky;
    bottom: 0px;
    z-index: 1;
	}
/*Mobile Filter Ends*/

/*Checkbox Starts*/
.mFilter_DropLabelNew input[type="checkbox"] {
	position: absolute;
	opacity: 0;
	cursor: pointer;
	height: 0;
	width: 0;
	}
.mFilter_CheckMark {
	position: absolute;
	top: 0;
	left: 0;
	height: 15px;
	width: 15px;
	/*background-color: #eee;*/
	background-color: #fff;
	border: 2px solid #9b9b9b;
	border-radius: 3px;
	}
/* On mouse-over, add a background color */
.mFilter_DropLabelNew:hover input ~ .mFilter_CheckMark {
	/*background-color: #ccc;*/
	background-color: #fff;
	}
/* When the checkbox is checked, add a background */
.mFilter_DropLabelNew input:checked ~ .mFilter_CheckMark {
	/*background-color: #2196F3;*/
	background-color: #01b7f2;
	border: 0;
	}
/* Create the mFilter_CheckMark/indicator (hidden when not checked) */
.mFilter_CheckMark:after {
	content: "";
	position: absolute;
	display: none;
	}
/* Show the mFilter_CheckMark when checked */
.mFilter_DropLabelNew input:checked ~ .mFilter_CheckMark:after {
	display: block;
	}
/* Style the mFilter_CheckMark/indicator */
.mFilter_DropLabelNew .mFilter_CheckMark:after {
	left: 5px;
	top: 2px;
	width: 5px;
	height: 10px;
	border: solid white;
	border-width: 0 3px 3px 0;
	-webkit-transform: rotate(45deg);
	-ms-transform: rotate(45deg);
	transform: rotate(45deg);
	}
/*Checkbox Ends*/

</style>

			<!--Filter Modal-->
			<div id="mobilefilter" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!--Filter Modal Content-->
					<div class="mFilter_ModalContent">
						<div class="mFilter_Sticky">
							<div class="mFilter_Header">
								<h4>Advance Search</h4>
								<button type="button" class="mFilter_Close" data-dismiss="modal">Close &#10006;</button>
							</div>
						</div>
						<div class="mFilter_DescBox">Refine your search by cities, themes, duration or budget</div>
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
													<div class="mFilter_Drop">
														<div class="drop makeflex">
															<label class="mFilter_DropLabel">
																<input type="checkbox" class="mFilter_DropCheckBox mdropCheckBox" name="chk_value" value="{{ $package }}">{{ $package }}
															</label>
														</div>
													</div>
												@endif
											@endforeach
										</div>
								</div>
								<!--Budget price starts-->
								<div class="mFilter_ItemBox">
									<h4 class="">Budget <span class="mbudgetSubHeading">per person</span></h4>
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
										<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="7">Less than 7 nights</label>
											</div>
										</div>
										<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="8">8 to 12 nights</label>
											</div>
										</div>
										<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="12">More than 12 Nights</label>
											</div>
										</div>
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
											<div class="mFilter_Drop">
												<div class="drop makeflex">
													<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="chk_travel" value="{{ $package }}">{{ $package }}</label>
												</div>
											</div>
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
											<div class="mFilter_Drop">
												<div class="drop makeflex">
													<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="chk_more" value="{{ $package }}">{{ $package }}</label>
												</div>
											</div>
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
										<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="chk_gest" value="{{ $package }}">{{ $package }} Star</label>
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