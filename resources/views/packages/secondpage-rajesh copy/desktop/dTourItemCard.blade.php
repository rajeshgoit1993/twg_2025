	<!--Desktop Tour Item Starts-->
	<?php $msg=""; ?>
	<section>
		<div class="dBackground">
			<div class="dPageContainer">
				<!--<div class="addClearfix tour-locations">-->
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
							<!--Tour Item Starts-->
							<a href="{{ url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id)) }}" target="_blank">
								<div class="tourItmCont">
									<div class="tourItmLeftSec">
										<?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
										<div class="tourImage_focusInOut pkg_search tourItmImgBox">
											@if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
												<img src="{{ CustomHelpers::get_image_gallery($gallery_id,'thum_medium') }}" class=" tourImage_zoom_image fade-in" alt="tourimage">
												@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
													<img src="{{ URL::to('/').'/public/Uploads/default_profile_image.png' }}" class="img-responsive tourImage_focus tourImage_zoom_image fade-in" alt="noimage">
											@endif
										</div>
										<div class="tourItmDescCont">
											<div class="tourItemTopSec">
												<div class="dTourTtlWrapper">
													<h3>{{ $package->title }}</h3>
													<div class="dHotel-star-rating">
														@if($package->select_star_rating!='')
															<?php 
																$select_star_rating=(float)$package->select_star_rating;
															?>
															@for($i=1;$i<=$select_star_rating;$i++)
															<div class="fa fa-star dStar_checked"></div>
															@endfor
														@endif
													</div>
												</div>
												<h5>{{ $package->duration }} Nights / {{ $package->duration + 1 }} Days
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
												<h5>Included in this package</h5>
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
													<div class="makeflex">
														@for($i=0;$i<$count_package_service;$i++)
															@if(in_array($package_service[$i], $ico1))
																@if($i=="4")
																	<div class="dSvcIconCont">
																		<div class="dSvcIcon">
																			<img src="{{url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))}}" title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
																		</div>
																		<div class="dSvcTtl">{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</div>
																	</div>
																	@else
																		<div class="dSvcIconCont">
																			<div class="dSvcIcon">
																				<img src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon')) }}" title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
																			</div>
																			<div class="dSvcTtl">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</div>
																		</div>
																@endif
																@else
															@endif
														@endfor
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
									<div class="tourItmRightSec">
										<!--Holiday Type-->
										<div class="dTourType">{{ $package->tour_type }}</div>
										<!--Price Box starts-->
										<?php
											$new_price=PackagePriceHelpers::get_new_pricing_data($package->id,date('Y-m-d', strtotime($date)));
										?>
										@if($new_price!='na')
											@if($new_price['actual_price']==$new_price['discount_price'])
												<div class="dItemPriceBoxTop flexCenter">
													<p class="dItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
													<p class="dItemPriceType"><span id="" class="dItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $package->Price_type }}</p>
												</div>
												@else
												<div class="dItemPriceBoxTop">
													<p class="dItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
													<p class="dItemPriceType"><span id="" class="dItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $package->Price_type }}</p>
													<p class="dItemPriceSubTag">*Excluding applicable taxes</p>
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
											<div class="dItemPriceBoxTop flexCenter">
												<p class="dItemPriceType_OnRequest"><span class="defaultCurrency"></span> On Request</p>
											</div>
										@endif
										<!--Price Box ends-->
										<div  class="dItemPriceBoxBottom">
											<button type="button" class="btnViewItemDtl">View Details</button>
										</div>
									</div>
								</div>
							</a>
							<!--Tour Item Ends-->
							@else
							<?php $msg=""; ?>
						@endif
					@endforeach
				</div>
				<!--Tour Error Message-->
				@if($msg=="")
					<!--<div class="" style="">
					<a href="#" class="button btn-large ">More Packages</a>  
					</div>-->
				@endif
				@else
					<div class="tourErrorMsgCont">
						<h3>Oops!</h3>
						<h4>No tour packages available, change your destination</h4>
						<!--<h4>{{$msg}}</h4>-->
					</div>
				@endif
				<!--<div class="col-md-12 textCenter">
					<h1>{{$msg}}</h1>
				</div>-->
				<!--Tour Loader-->
				<div class="loader_scroll loaderCont"></div>
			</div>
		</div>
	</section>
	<!--Desktop Tour Item Ends-->