<?php $msg=""; ?>
<section>
<div class="mBG">
<div class="container">
	<div>
	
		<div class="add-clearfix image-box style1 tour-locations">
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
				<a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}">
					<div class="tourItmCont">
						<div class="tourItmLeftSec">
							<?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
							<div class="nicdark_focus nicdark_fadeinout nicdark_overflow pkg_search tourItmImgBox">
								@if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
									<img src="{{CustomHelpers::get_image_gallery($gallery_id,'thum_medium')}}" class="img-responsive nicdark_focus nicdark_zoom_image small_img">
								@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
									<img src="{{URL::to('/').'/public/Uploads/default_profile_image.png'}}" class="img-responsive nicdark_focus nicdark_zoom_image small_img">
								@endif
							</div>
							<div class="tourItmDescCont">
								<div class="tourItemTopSec">
									<h3>{{$package->title}}</h3>
@if($package->customer_rating!='')
								<div class="dHtlDescription">
<span class="dHtlStarRating" >
{{ CustomHelpers::get_star_rating($package->customer_rating) }}
</span>
</div>
@endif
									<h5 class="nightDays">
											<span class="sp1">{{$package->duration}} Nights / {{$package->duration + 1}} Days</span>

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
											foreach($city1 as $row=>$col)
											{
											
												
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
						<div class="itemPriceBox">
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
				<?php $msg="Oops!!! No packages available for the search Destination, change your destination"; ?>
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
</div>
</section>