		<!--Mobile Tour Item Card Starts-->
		<?php $msg=""; ?>
		<section>
			<div class="mBG">
				<div class="mPageCont">
				<div id="main">
					<!--<div class="row add-clearfix image-box style1 tour-locations">-->
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
									<!--Mobile View-->
									<a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}" class="pkg_search">
										<div class="mTourItmCont">
											<div class="tourItmLeftSec">
												<div class="mTourItmImgBox">
													<?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
													@if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
														<img class="fade-in" src="{{ CustomHelpers::get_image_gallery($gallery_id,'thum_medium') }}">
													@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
														<img class="fade-in" src="{{ URL::to('/').'/public/Uploads/default_profile_image.png' }}">
													@endif
												</div>
											</div>
											<div class="tourItmRightSec">
												<div class="mTourItmDescCont">
													<!--<div class="mTourItmDescCont details">-->
													<div class="mDaysBadgeTop">{{ $package->duration }}N / {{ $package->duration + 1 }}D</div>
													<div class="mTourItemTopSec">
														<div class="mTourTtlWrapper">
															<h3 title="{{ $package->title }}">{{ $package->title }}</h3>
															<div class="mHotel-star-rating">
																@if($package->select_star_rating!='')
																	<?php 
																		$select_star_rating=(float)$package->select_star_rating;
																	?>
																	@for($i=1;$i<=$select_star_rating;$i++)
																		<div class="fa fa-star mStart_checked"></div>
																	@endfor
																@endif
																</div>
															<!--<div class="mDaysBadge">{{ $package->duration }}N / {{ $package->duration + 1 }}D</div>-->
															<!--Holiday Type-->
															<div class="mTourType">{{ $package->tour_type }}</div>
														</div>
													</div>
													<div class="mcity_nights">
														<p>
														<?php
															$city1=unserialize($package->city);
															$days=unserialize($package->days);
															$city1_count=count($city1);
				                                            $i=0;
															foreach($city1 as $row=>$col)
															{
															$i++;
															echo "<span class='itemDestDuration'>$days[$row]N&nbsp;</span><span class='itemDestName'>$city1[$row]</span>";
															if($i<($city1_count-1)):
															echo "<span class='itemDestSepr'>&nbsp;&rarr;&nbsp;</span>";
															endif;
															$a=$i+1;
															if($a%3=="0"):
															echo "</span>";
															endif;
															}
														?>
														</p>
													</div>
													<div class="mTourItemFooter">
														<h5 class="mServiceTitle">Included in this package</h5>
														@php
															$package_service=unserialize($package->package_service);
														@endphp
														@if(empty($package_service))
															@else
															<?php
																$count_package_service=count($package_service);
															?>  
															<?php
																$ico="";
																foreach ($icon_data as $icon_data1) {
																	$ico.=$icon_data1->icon_title.",";
																	}
																	$ico1=array_unique(explode(",",$ico));
															?>     
															<div class="mobscroll scrollX">
																<div class="makeflex">
																	@for($i=0;$i<$count_package_service;$i++) 
																		@if(in_array($package_service[$i], $ico1))
																			@if($i=="4")
																				<div class="mSvcIconCont">
																					<div class="mSvcIcon">
																						<img src="{{url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))}}" title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
																					</div>
																					<div class="mSvcTtl">{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</div>
																				</div> 
																				@else
																				<div class="mSvcIconCont">
																					<div class="mSvcIcon">
																						<img src="{{url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))}}" title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
																					</div>
																					<div class="mSvcTtl">{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</div>
																				</div>
																			@endif
																			@else
																		@endif
																	@endfor
																</div>
															</div>
													</div>
													<div class="mTourItemPriceBox">
														<div class="mTourPriceWrapper">
															<h4 title="{{ $package->title }}">Starting Tour Price</h4>
															<!--<div class="mDaysBadge">{{ $package->duration }}N / {{ $package->duration + 1 }}D</div>-->
														</div>
														<!--Price Box starts-->
														<?php
															$new_price=PackagePriceHelpers::get_new_pricing_data($package->id,date('Y-m-d', strtotime($date)));
														?>
														@if($new_price!='na')
															@if($new_price['actual_price']==$new_price['discount_price'])
																<div class="mItemPriceBoxTop flexCenter">
																	<p class="mItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
																	<p class="mItemPriceType"><span id="" class="mItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $package->Price_type }}</p>
																</div>
																@else
																<div class="mItemPriceBoxTop">
																	<p class="mItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
																	<p class="mItemPriceType"><span id="" class="mItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $package->Price_type }}</p>
																	<p class="mItemPriceSubTag">*Excluding applicable taxes</p>
																	<span class="dItemOfferTag">
																		<?php
																			$tourdiscount=(int)$new_price['actual_price']-(int)$new_price['discount_price'];
																			$percentage=$tourdiscount/$new_price['actual_price']*100;
																		?>
																		{{ round($percentage) }}% Off
																	</span>
																</div>
															@endif
															@else
															<div class="mItemPriceBoxTop flexCenter">
																<p class="mItemPriceType_OnRequest"><span class="defaultCurrency"></span> On Request</p>
															</div>
														@endif
														<!--Price Box ends-->
													</div>
													@php
														$package_city=unserialize($package->city);
														$package_city_count=count($package_city);
													@endphp
													@endif
													<div class="viewItemCont">
														<button type="button" class="mBtnViewDtls">View Details</button>
													</div>
												</div>
											</div>
										</div>
									</a>
									@else
									<?php $msg=""; ?>
								@endif 
							@endforeach
							</div>
							@if($msg=="")
							@endif  
							@else
							<div class="tourErrorMsgCont">
								<h3>Oops!</h3>
								<h4>No tour packages available, change your destination</h4>
								<!--<h4>{{$msg}}</h4>-->
							</div>
						@endif  
						<!--Tour Loader-->
						<div class="loader_scroll loaderCont"></div>
				</div>
				</div>
			</div>
		</section>
		<!--Mobile Tour Item Card Ends-->


<script type="text/javascript">
/*Mobile Tour Image Animation-script-pagethree.js*/
// Select all images with class "fade-in"
const images = document.querySelectorAll('.fade-in');

// Loop through each image and add event listener to execute when each image is loaded
images.forEach(function(image) {
  image.addEventListener('load', function() {
    // Add the "loaded" class to apply the fade-in transition
    image.classList.add('loaded');
  });
});
/*Animation-script Ends*/

/*------------------------------------------------------------------*/
</script>