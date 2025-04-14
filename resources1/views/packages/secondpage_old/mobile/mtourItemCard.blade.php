<?php $msg=""; ?>
<section >
<div class="mPageCont">
	<div id="main">
		<div class="row add-clearfix image-box style1 tour-locations">
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
						<div class="col-sm-6 col-md-4" >
						<!--<article class="mTourItemCard">-->
							<div class="mTrItemCard">
								<a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}" class=" pkg_search">
									<?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
									<div class="mTourItemCardImgBox">
										@if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
											<img src="{{CustomHelpers::get_image_gallery($gallery_id,'thum_medium')}}">
										@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
											<img src="{{URL::to('/').'/public/Uploads/default_profile_image.png'}}">
										@endif
									</div>
								</a>
								<div class="mTourItemCardDesc mWhiteBG details">
									<div class="flexBetween">
										<div class="mTourTtlBox">
											<h4 class="mTourTtl">{{$package->title}}</h4>
											@if($package->customer_rating!='')
								<div class="dHtlDescription">
<span class="dHtlStarRating" >
{{ CustomHelpers::get_star_rating($package->customer_rating) }}
</span>
</div>
@endif

											<h5 class="mTourDuration">{{$package->duration}} Nights / {{$package->duration + 1}} Days</h5>
										</div>
										<div class="mTourPriceBox">



													<?php 

$new_price=PackagePriceHelpers::get_new_pricing_data($package->id,date('Y-m-d', strtotime($date)));
		?>
@if($new_price=='na')
<span class="mTourPrice"><span class="defaultCurency">&nbsp;</span>On Request</span>
						@else

						



@if($new_price['actual_price']==$new_price['discount_price'])

<span class="mTourPrice"><span class="defaultCurency">&nbsp;</span> {{ $new_price['actual_price'] }}</span>
												<span class="mTourPriceType">{{ $package->Price_type }}</span>


@else
<span class="mTourPrice"><span class="defaultCurency">&nbsp;</span> <strike>  {{ $new_price['actual_price'] }} </strike>   &nbsp;&nbsp; <span class="defaultCurency">&nbsp;</span> {{ $new_price['discount_price'] }}



 </span>

<span class="mTourPriceType">{{ $package->Price_type }}</span>


@endif
@endif



											
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
										<h5>Included in this package</h5>
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
											<div style=" margin-right: 5%;">
												<p class="mSvcIcon">
													<img src="{{url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))}}" title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
												</p>
												<p class="mSvcTtl">{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</p>
											</div> 
											@else
											<div style=" margin-right: 5%;">
												<p class="mSvcIcon">
													<img src="{{url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))}}" title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}">
												</p>
												<p class="mSvcTtl">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</p>
											</div> 
											@endif
											@else
											@endif
											@endfor
										</div>
									</div>
									</div>
									<!--Rating--
									@php
									$customer_rating=$package->customer_rating;
									@endphp   
									<div class="row" style="">
										<div class="col-md-5 col-sm-4 col-xs-4">
										<span>Guest Rating</span>
										</div>
										<div class="col-md-7 col-sm-7 col-xs-7 customer_rating">
										@if($customer_rating=="3.5")
										@for($i=1;$i<=$customer_rating;$i++)
										<img src="{{ url('/public/uploads/icons/star1.png') }}" style="width: 9%" title="{{ $customer_rating }} Star">
										@endfor
										<img src="{{ url('/public/uploads/icons/halfstar.png') }}" style="width: 9%" title="{{ $customer_rating }} Star">
										<img src="{{ url('/public/uploads/icons/star2.png') }}" style="width: 9%" title="{{ $customer_rating }} Star">
										@elseif($customer_rating=="4.5")
										@for($i=1;$i<=$customer_rating;$i++)
										<img src="{{ url('/public/uploads/icons/star1.png') }}" style="width: 9%" title="{{ $customer_rating }} Star">
										@endfor
										<img src="{{ url('/public/uploads/icons/halfstar.png') }}" style="width: 9%" title="{{ $customer_rating }} Star">
										@else
										@for($i=1;$i<=$customer_rating;$i++)
										<img src="{{ url('/public/uploads/icons/star1.png') }}" style="width: 9%" title="{{ $customer_rating }} Star">
										@endfor
										@for($j=5;$j>$customer_rating;$j--)
										<img src="{{ url('/public/uploads/icons/star2.png') }}" style="width: 9%" title="{{ $customer_rating }} Star">
										@endfor
										@endif
										</div>
									</div>-->
									@php
									$package_city=unserialize($package->city);
									$package_city_count=count($package_city);
									@endphp 
									@endif
									<div class="row appndTop10 pdngBtm10">
										<div class="col-md-12">
											<a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}">
												<button type="button" class="btnMain mBtnViewDtls">View Details</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<?php $msg="Oops!!! No packages available for the search Destination"; ?>
						@endif 
					@endforeach
			</div>
					@if($msg=="")
					@endif  
				@else
				<div class="col-md-12 textCenter">
					<h1>Oops!!! No packages available for the search Destination, change your destination</h1>
					<h1>{{$msg}}</h1>
				</div>
				@endif  
				<div class="col-md-12 col-sm-12">
					<div class="loader_scroll textCenter"></div>
				</div>
		</div>
	</div>
</div>
</section>