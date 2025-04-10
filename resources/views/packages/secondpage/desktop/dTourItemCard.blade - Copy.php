<style type="text/css">
	.clearfix::after {
		content: "";
		clear: both;
		display: table;
		}
/*Desktop Tour Item Starts*/
	.tourItmCont {
		margin-top: 25px;
		box-shadow: 0px 7px 15px rgb(0 0 0 / 20%);
		/*border: 1px solid #c8c6c7;*/
		border-radius: 5px;
		overflow: hidden;
		width: 100%;
		display: flex;
		}
	.tourItmCont:hover .itemPriceBox {
		background: #f0f6ff;
		}
	.tourItmCont:hover {
		border-color: #a1a1a1;
		}
	.tourItmLeftSec {
		flex-grow: 1;
		background-color: #fff;
		width: 100%;
		padding: 15px;
		display: flex;
		}
	.tourItmRightSec {
		min-width: 200px;
		height: auto;
		background-color: #e9e9e9;
		}
	.tourItmImgBox {
		background-color: #f2f2f2;
		margin-right: 15px;
	    max-width: 275px;
		height: 225px;
	    overflow: hidden;
	    border-radius: 5px;
	    min-width: 225px;
	    flex: 1;
		}
	.tourItmImgBox img {
	    width: 275px;
	    height: 225px;
	    object-fit: cover;
		}
	.tourImage_fadeinout:hover .tourImage_zoom_image {
		-webkit-transform: rotate(3deg) scale(1.2, 1.2);
		-o-transform: rotate(3deg) scale(1.2, 1.2);
		transform: rotate(3deg) scale(1.2, 1.2);
		}

	.tourImage_fadeinout .tourImage_zoom_image {
		-webkit-transition: all 3000ms;
		-o-transition: all 500ms;
		transition: all 3000ms;
		}
	.tourImage_relative {
		height: 100% !important;
		width: 100% !important;
		overflow: hidden !important;
		}

	.tourImage_fadeinout:hover .DETAILS {
		display: block;
		z-index: 999999;
		}
	.tourItmDescCont {
		/*width: 100%;*/
	    padding-left: 15px;
	    border-left: 1px solid #e7e7e7;
	    display: flex;
	    flex-direction: column;
		flex-grow: 1;
		flex-shrink: 1;
		}
	.tourItemTopSec {
		display: flex;
		flex-direction: column;
		}
	.tourItemTopSec h3 {
		font-size: 18px;
		line-height: 20px;
		color: #000001;
		font-weight: 600;
		text-align: left;
		margin-bottom: 5px;
		}
	.tourItemTopSec h5 {
		font-size: 15px;
		line-height: 17px;
		color: #000001;
		font-weight: 500;
		text-align: left;
		margin-bottom: 0;
		}
	.city_nights {
		margin: 20px 0;
		padding: 10px 0;
		border-top: 1px solid #e7e7e7;
		border-bottom: 1px solid #e7e7e7;
		height: 62px;
		display: flex;
		}
	.city_nights div {
		line-Height: 24px;
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		}
	.itemDestDuration {
	    color: #eb2025;
	    font-size: 15px;
	    line-height: 15px;
	    font-weight: 700;
		}
	.itemDestName {
	    font-size: 15px;
	    line-height: 15px;
	    font-weight: 900;
	    color: #000001;
	    display: flex;
	    flex-wrap: wrap;
		}
	.itemDestSepr {
		color: #000001;
		}
	.tourItemFooter {
	    margin-top: 0;
		}
	.dSvcIcon {
		font-size: 12px;
		line-height: 16px;
		color: #000001;
		font-weight: 500;
		text-align: center;
		margin-bottom: 5px;
		}
	.dSvcTtl {
		font-size: 12px;
		line-height: 16px;
		color: #000001;
		font-weight: 500;
		text-align: center;
		margin-bottom: 0;
		}
	.dSvcIcon img {
		width: 26px;
		height: 26px;
		}
	.tourItemSvcTtl {
	    color: #4A4A4A;
	    font-size: 12px;
	    line-height: 12px;
	    font-weight: 600;
	    margin-bottom: 11px;
		}
	.serviceIconCont {
		margin-right: 35px;
		}
	.serviceTitle {
		color: #4A4A4A;
	    font-size: 12px;
	    line-height: 12px;
	    font-weight: 600;
		margin-bottom: 15px;
		}
	.itemPriceBox {
	    width: 200px;
	    height: auto;
	    background: #e9e9e9;
	    float: right;
	    margin: 0px;
	    /*border-radius: 0px 5px 5px 0px;
	    border-left: 1px solid #e7e7e7;*/
	    display: flex;
	    flex-direction: column;
	    flex-shrink: 0;
	    flex-grow: 1;
		}
	.itemPriceHeader {
	    text-transform: capitalize;
	    color: #9B9B9B;
	    font-size: 14px;
	    line-height: 20px;
	    font-weight: 900;
	    text-align: center;
	    height: 80px;
	    padding: 15px 0;
	    letter-spacing: .64px;
		}
	.itemPriceSection {
	    padding-bottom: 20px;
	    height: 105px;
	    display: flex;
	    align-items: end;
	    justify-content: center;
	    padding-bottom: 13px;
		}
	.itemPriceValueBox {
	    display: flex;
	    flex-direction: column;
	    align-items: end;
	    /* margin-right: 50px; */
		}
	.itemPriceValue {
		color: #000001;
		font-size: 24px;
		line-height: 26px;
		font-weight: 600;
		margin-bottom: 0px;
		text-align: right;
		}
	.itemPriceType {
		font-size: 12px;
		line-height: 12px;
		color: #9b9b9b;
		font-weight: 500;
		text-align: right;
		margin-bottom: 0px;
		}
	.itemPriceRequest {
	    color: #000001;
	    font-size: 18px;
	    line-height: 20px;
	    margin-bottom: 0px;
	    text-align: center;
		}
	.itemPriceSectionFooter {
	    display: flex;
	    align-items: flex-end;
	    justify-content: center;
	    padding-bottom: 13px;
	    height: 70px;
		}
	.btnViewDtls {
	    flex-shrink: 0;
	    outline: 0;
	    text-transform: capitalize;
	    background: #fff;
	    border: 1px solid #cccccc;
	    border-radius: 5px;
	    padding: 12px 20px;
	    font-size: 14px;
	    line-height: 14px;
	    color: #000001;
	    font-weight: 700;
	    cursor: pointer;
	    width: 140px;
	    /* margin: auto; */
	    height: 40px;
	    text-align: center;
		}
	.btnViewDtls:hover {
		background: #fff;
	    color: #000001;
		}
/*Desktop Tour Item Ends*/
</style>
<?php $msg=""; ?>
<section>
<div class="mBG">
	<div class="dPageContainer">
		<!--<div class="add-clearfix image-box style1 tour-locations">-->
		<div class="clearfix">
			<div class="dynamic_data">
				@if(count($data)!="0")
				@foreach($packages as $package)
					<input type="hidden" class="pack_id_list" name="pack_id_list[]"  value="{{$package->id}}">
					<?php
						$country=unserialize($package->country);
						$city=unserialize($package->city);
						$continent=unserialize($package->continent);
						$state=unserialize($package->state);
					?>
					@if(in_array($destination_search,$continent) || in_array($destination_search,$country) || in_array($destination_search,$state) || in_array($destination_search,$city))
						<!-- New Design Starts here -->
						<a href="{{ url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id)) }}">
							<div class="tourItmCont">
								<div class="tourItmLeftSec">
									<?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
									<div class="tourImage_fadeinout pkg_search tourItmImgBox">
										@if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
											<img src="{{ CustomHelpers::get_image_gallery($gallery_id,'thum_medium') }}" class=" tourImage_zoom_image">
											@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
												<img src="{{ URL::to('/').'/public/Uploads/default_profile_image.png' }}" class="img-responsive tourImage_focus tourImage_zoom_image">
										@endif
									</div>
									<div class="tourItmDescCont">
										<div class="tourItemTopSec">
											<h3>{{ $package->title }}</h3>
											<h5 class="nightDays">
												<span class="sp1">{{ $package->duration }} Nights / {{ $package->duration + 1 }} Days</span>
												<?php
													$new_price=PackagePriceHelpers::get_new_pricing_data($package->id,date('Y-m-d', strtotime($date)));
												?>
												@if($new_price=='na')
													<span class="sp2">On Request</span>
													@else
														@if($new_price['actual_price']==$new_price['discount_price'])
														<span class="sp2">&#8377; {{ $new_price['actual_price'] }}</span>
														@else
														<span class="sp2">&#8377; <strike> {{ $new_price['actual_price'] }} </strike></span>
														&nbsp;&nbsp;
														<span class="sp2">&#8377; {{ $new_price['discount_price'] }}</span>
														@endif
												@endif
											</h5>
										</div>
										<div class="city_nights">
											<div class="flexCenter">
												<?php
													$city1=unserialize($package->city);
													$days=unserialize($package->days);
													$city1_count=count($city1);
		                                            $i=0;
													foreach($city1 as $row=>$col) {
														echo "<span class='itemDestDuration'>$days[$row]N&nbsp;</span><span class='itemDestName'>$city1[$row]</span>";
														if($i<($city1_count-1)):
															echo "<span class='itemDestSepr'>&nbsp;&rarr;&nbsp;</span>";
														endif;
														$a=$i+1;
														if($a%3=="0"):
															echo "</span>";
														endif;
														$i++;
														}
												?>
												</div>
										</div>
										<div class="tourItemFooter">
											<h5 class="serviceTitle">Included in this package</h5>
											@php
												$package_service=unserialize($package->package_service);
												@endphp
												@if(empty($package_service))
												@else
												<?php $count_package_service=count($package_service); ?>
												<?php
													$ico="";
													foreach ($icon_data as $icon_data1)
													{
													$ico.=$icon_data1->icon_title.",";
													}
													$ico1=array_unique(explode(",",$ico));
											?>
											<div class="row">
												<div class="col-md-12 makeflex">
												@for($i=0;$i<$count_package_service;$i++)
													@if(in_array($package_service[$i], $ico1))
														@if($i=="4")
															<div class="serviceIconCont">
																<p class="dSvcIcon">
																	<img src="{{url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))}}" title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
																</p>
																<p class="dSvcTtl">{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</p>
															</div>
																@else
																<div class="serviceIconCont">
																	<p class="dSvcIcon">
																		<img src="{{url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))}}" title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
																	</p>
																	<p class="dSvcTtl">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</p>
																</div>
														@endif
														@else
													@endif
												@endfor
												</div>
											</div>
											@endif
										</div>
										@php
										$customer_rating=$package->customer_rating;
										@endphp
										<!--Guest Rating-->
										<!--<div class="row" style="padding-top: 4px">
												<div class="col-md-3 col-sm-3 col-xs-4">
												<span>Guest Rating</span>
												</div>
												<div class="col-md-9 col-sm-9 col-xs-6 customer_rating center_dt">
												@if($customer_rating=="3.5")
												@for($i=1;$i<=$customer_rating;$i++)
												<img src="{{ url('/public/uploads/icons/star1.png') }}" style="width: 4%" title="{{ $customer_rating }} Star">
												@endfor
												<img src="{{ url('/public/uploads/icons/halfstar.png') }}" style="width: 4%" title="{{ $customer_rating }} Star">
												<img src="{{ url('/public/uploads/icons/star2.png') }}" style="width: 4%" title="{{ $customer_rating }} Star">
												@elseif($customer_rating=="4.5")
												@for($i=1;$i<=$customer_rating;$i++)
												<img src="{{ url('/public/uploads/icons/star1.png') }}" style="width: 4%" title="{{ $customer_rating }} Star">
												@endfor
												<img src="{{ url('/public/uploads/icons/halfstar.png') }}" style="width: 4%" title="{{ $customer_rating }} Star">
												@else
												@for($i=1;$i<=$customer_rating;$i++)
												<img src="{{ url('/public/uploads/icons/star1.png') }}" style="width: 4%" title="{{ $customer_rating }} Star">
												@endfor
												@for($j=5;$j>$customer_rating;$j--)
												<img src="{{ url('/public/uploads/icons/star2.png') }}" style="width: 4%" title="{{ $customer_rating }} Star">
												@endfor
												@endif
												</div>
											</div>-->
										<!---->
									</div>
								</div>
								<div class="tourItmRightSec itemPriceBo">
									<div class="itemPriceHeader">Customized Holidays</div>
										<div class="itemPriceSection">
										<?php
											$new_price=PackagePriceHelpers::get_new_pricing_data($package->id,date('Y-m-d', strtotime($date)));
										?>
										@if($new_price=='na')
											<div class="itemPriceValueBox">
											<p class="itemPriceRequest"><span class="defaultCurency">&nbsp;</span>On Request</p>
											</div>
											@else
											@if($new_price['actual_price']==$new_price['discount_price'])
												<div class="itemPriceValueBox">
													<p class="itemPriceValue"><span class="defaultCurency">&nbsp;</span>{{ $new_price['actual_price'] }}</p>
													<p class="itemPriceType">{{ $package->Price_type }}</p>
												</div>
												@else
												<div class="itemPriceValueBox">
													<p class="itemPriceValue"><span class="defaultCurency">&nbsp;</span><strike> {{ $new_price['actual_price'] }} </strike>&nbsp; <span class="defaultCurency"></span> {{ $new_price['discount_price'] }}</p>
													<p class="itemPriceType">{{ $package->Price_type }}</p>
												</div>
											@endif
										@endif
										</div>
										<!--Price ends-->
										<div class="itemPriceSectionFooter">
											<button type="button" class="btnMain btnViewDtls">View Details</button>
										</div>
								</div>
								<!--Price section starts-->
							</div>
						</a>
						@else
						<?php
							$msg="Oops!!! No packages available for the search Destination, change your destination";
						?>
					@endif
				@endforeach
			</div>
			@if($msg=="")
				<div class="col-md-12" style="text-align: center;">
				<!--<a href="#" class="button btn-large ">More Packages</a>  -->
				</div>
			@endif
			@else
				<div class="col-md-12 textCenter">
					<h1>Oops!!! No packages available for the search Destination</h1>
					<h1>{{$msg}}</h1>
				</div>
			@endif
			<div class="col-md-12 textCenter">
				<h1>{{$msg}}</h1>
			</div>
			<div class="col-md-12">
				<div class="loader_scroll textCenter"></div>
			</div>
		</div>
	</div>
</div>
</section>