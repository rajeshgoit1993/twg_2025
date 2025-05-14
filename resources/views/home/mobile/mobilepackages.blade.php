<div class="whiteBG">
	<!--Domestic Packages-->
	<div>
		<div class="col-xs-12 col-sm-12 mTourContBG">
			<div class="mTourCont">
				<h3>Popular</h3>
				<h4>Domestic Packages</h4>
			</div>
		</div>
		<div class="mTourContainer">
		@foreach($packages_domestic as $package)
		@php
		$location =unserialize($package->city);
		@endphp
		<div class="col-xs-6 col-sm-4 custom_length_demostic">
			<div class="row">
			<div class="mTourItem">
				<input type="hidden" class="pack_id_list" name="pack_id_list_demostic[]"  value="{{$package->id}}">
				<?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
				<a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}">
				<div class="mTourTopSection">
					<div class="mTourImgBox">
						@if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
							<img class="lazy-load" data-src="{{CustomHelpers::get_image_gallery($gallery_id,'thum_medium')}}">
						@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
							<img class="lazy-load" data-src="{{URL::to('/').'/public/Uploads/default_profile_image.png'}}">
						@endif
					</div>
					<div class="mTourPrcBox">
						<?php 
$new_price=PackagePriceHelpers::get_new_pricing_data($package->id,date('Y-m-d'));


						?>
@if($new_price=='na')
<div class="mTourPrcValueBox">
								<p class="mTourPrcValueReq"><span class="mTourDefaultCurency">&nbsp;</span>On Request</p>
							</div>
						@else

						<div class="mTourPrcValueBox">
									<p class="mTourPrcValue">
@if($new_price['actual_price']==$new_price['discount_price'])
<span class="mTourDefaultCurency">&nbsp;</span> {{ $new_price['actual_price'] }}
@else
<span class="mTourDefaultCurency">&nbsp;</span> <strike> {{ $new_price['actual_price'] }} </strike>  &nbsp;&nbsp;<span class="mTourDefaultCurency">&nbsp;</span>{{ $new_price['discount_price'] }}
@endif


									</p>
									<p class="mTourPrcTyp"> 
{{PackagePriceHelpers::get_price_type($package->Price_type)}}</p>
								</div>





						@endif




						
					</div>

				</div>
				<div class="mTourBtmSection">
					<div class="mTourTtlCont">
						<h4>{{$package->title}}</h4>
					</div>
					<div>
						<div class="mLocationCont"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$location[0] }}</div>
						<div class="mTourDuration">{{$package->duration}} Nights & {{$package->duration + 1}} Days</div>
					</div>

				</div>
				</a>
			</div>
			</div>
		</div>
		@endforeach
		<div id="dynamic_pkg_add_domestic"></div>
		<div class="col-xs-12 col-sm-12 packages_button demostic_button">
			<button class="PACKAGES add_more_pkg mbtnLoadMore appendTop15 appendBtm20" content_type="demostic_mobile">More Packages</button>
		</div>
		<!---->
		<div id="row_add"></div>
		<!---->
		</div>
	</div>
	<!--International Packages-->
	<div>
		<div class="col-xs-12 col-sm-12 mTourContBG">
			<div class="mTourCont">
				<h3>Popular</h3>
				<h4>International Packages</h4>
			</div>
		</div>
		<div class="mTourContainer">
		@foreach($packages as $package)
		@php
		$location =unserialize($package->city);
		@endphp
		<div class="col-xs-6 col-sm-4 custom_length">
			<div class="row">
			<div class="mTourItem">
				<input type="hidden" class="pack_id_list" name="pack_id_list[]"  value="{{$package->id}}">
				<?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
				<a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}">
				<div class="mTourTopSection">
					<div class="mTourImgBox">
						@if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
							<img class="lazy-load" data-src="{{CustomHelpers::get_image_gallery($gallery_id,'thum_medium')}}">
						@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
							<img class="lazy-load" data-src="{{URL::to('/').'/public/Uploads/default_profile_image.png'}}">
						@endif
					</div>
					<div class="mTourPrcBox">
						<?php 
$new_price=PackagePriceHelpers::get_new_pricing_data($package->id,date('Y-m-d'));


						?>
						@if($new_price=='na')
<div class="mTourPrcValueBox">
								<p class="mTourPrcValueReq"><span class="mTourDefaultCurency">&nbsp;</span>On Request</p>
							</div>
						@else

						<div class="mTourPrcValueBox">
									<p class="mTourPrcValue">
@if($new_price['actual_price']==$new_price['discount_price'])
<span class="mTourDefaultCurency">&nbsp;</span> {{ $new_price['actual_price'] }}
@else
<span class="mTourDefaultCurency">&nbsp;</span> <strike> {{ $new_price['actual_price'] }} </strike>  &nbsp;&nbsp;<span class="mTourDefaultCurency">&nbsp;</span>{{ $new_price['discount_price'] }}
@endif


									</p>
									<p class="mTourPrcTyp"> 

{{PackagePriceHelpers::get_price_type($package->Price_type)}}
										
								</div>





						@endif
					</div>
				</div>
				<div class="mTourBtmSection">
					<div class="mTourTtlCont">
						<h4>{{$package->title}}</h4>
					</div>
					<div>
						<div class="mLocationCont"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$location[0] }}</div>
						<div class="mTourDuration">{{$package->duration}} Nights & {{$package->duration + 1}} Days</div>
					</div>
				</div>
				</a>
			</div>
			</div>
		</div>
		@endforeach
		<div id="dynamic_pkg_add"></div>
		</div>
		<div class="col-xs-12 col-sm-12 packages_button internation_button">
			<button class="PACKAGES add_more_pkg mbtnLoadMore appendTop15 appendBtm20" content_type="international_mobile">More Packages</button>
		</div>
		<!---->
		<div id="row_add"></div>
		<!---->
	</div>
</div>