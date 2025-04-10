<div class="tab-pane fade tourPkgDesc" id="dTourExtra">
	<div class="tab-pane fade in active tourHgLhts">
		<h2>Similar Tour Packages</h2>
		<div>
			@if($details->similar_packages!='' && $details->similar_packages!='N;')
<?php 
$similar_packages=unserialize($details->similar_packages);
$packages=DB::table('rt_packages')->whereIn('id',$similar_packages)->get();


	?>
@foreach($packages as $package)
	<input type="hidden" class="pack_id_list" name="pack_id_list[]" value="{{$package->id}}">
		<?php
			$country=unserialize($package->country);
			$city=unserialize($package->city);
			$continent=unserialize($package->continent);
			$state=unserialize($package->state);
			?>
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
									<h5 class="nightDays">
										<span>{{$package->duration}} Nights / {{$package->duration + 1}} Days</span>
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
									@if($package->onrequest == 1 && $package->upcoming == 1)
										<div class="itemPriceValueBox">
											<p class="itemPriceRequest"><span class="defaultCurency">&nbsp;</span>On Request</p>
										</div>
									@elseif($package->onrequest != 1 && $package->upcoming == 1)
										@if(CustomHelpers::get_price($package->id)=="On Request")
											<div class="itemPriceValueBox">
												<p class="itemPriceRequest"><span class="defaultCurency">&nbsp;</span>On Request</p>
											</div>
										@else
											<div class="itemPriceValueBox">
												<p class="itemPriceValue"><span class="defaultCurency">&nbsp;</span>{{ CustomHelpers::get_price($package->id) }}</p>
												<p class="itemPriceType">{{ $package->Price_type }}</p>
											</div>
										@endif
									@elseif($package->onrequest == 1 && $package->upcoming != 1)
										@if(CustomHelpers::get_up_price($package->id)=="On Request")
											<div class="itemPriceValueBox">
												<p class="itemPriceRequest"><span class="defaultCurency">&nbsp;</span>On Request</p>
											</div>
										@else
											<div class="itemPriceValueBox">
												<p class="itemPriceValue"><span class="defaultCurency">&nbsp;</span>{{ CustomHelpers::get_up_price($package->id) }}</p>
												<p class="itemPriceType">{{ $package->upcoming_type }}</p>
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
		@endforeach

	       @endif
		</div>
	</div>
</div>








