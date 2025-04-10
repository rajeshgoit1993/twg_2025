<style type="text/css">
.mTrItemCard {
    margin-bottom: 20px;
}
.mTourItemCardImgBox {
    width: auto;
    height: auto;
    cursor: default;
}
.mTourItemCardImgBox img {
    width: 100%;
    height: 225px;
}
.mTourItemCardDesc {
    padding: 10px 10px 0;
}
.mTourTtlBox {
    width: 60%;
}
.mTourTtl {
    font-size: 18px;
    line-height: 24px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 5px;
    width: unset;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.mTourDuration {
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 600;
    text-align: left;
    margin-bottom: 0;
}
.mTourPriceBox {
    text-align: right;
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
}
.mTourPrice {
    font-size: 18px;
    line-height: 22px;
    color: #000001;
    /* color: #FDB714; */
    font-weight: 500;
    text-align: right;
    margin-bottom: 0;
}
.defaultCurency:before {
    content: '\0020B9';
    font-size: 16px;
    font-weight: 500;
}
.mTourPriceType {
    font-size: 10px;
    line-height: 12px;
    color: #9b9b9b;
    font-weight: 500;
    text-align: right;
    margin-bottom: 0px;
    text-transform: capitalize;
}
.mcity_nights {
    margin: 15px 0;
    padding: 0;
    border-top: 1px solid #e7e7e7;
    border-bottom: 1px solid #e7e7e7;
    min-height: 61px;
    display: flex;
}
.mcity_nights p {
    padding: 5px 0;
    font-size: 14px;
    line-height: 22px;
    color: #000001;
    /* color: #FDB714; */
    font-weight: 500;
    text-align: left;
    margin-bottom: 0;
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
.mTourItemFooter {
    margin-bottom: 10px;
}
.mTourItemFooter h5 {
    color: #4A4A4A;
    font-size: 12px;
    line-height: 12px;
    font-weight: 600;
    margin-bottom: 11px;
}
.mSvcIcon, .mSvcTtl {
    font-size: 12px;
    line-height: 16px;
    color: #000001;
    font-weight: 500;
    text-align: center;
    margin-bottom: 5px;
}
.mSvcIcon img {
    width: 26px;
    height: 26px;
}
.mSvcIcon, .mSvcTtl {
    font-size: 12px;
    line-height: 16px;
    color: #000001;
    font-weight: 500;
    text-align: center;
    margin-bottom: 5px;
}
.mBtnViewDtls {
    flex-shrink: 0;
    outline: 0;
    text-transform: capitalize;
    background: #01b7f2;
    border: 0;
    border-radius: 3px;
    padding: 6px;
    font-size: 16px;
    line-height: 16px;
    color: #fff;
    font-weight: 700;
    cursor: default;
    margin-bottom: 0;
    width: 100%;
}
</style>

<div class="tab-pane fade tourPkgDesc" id="mTourExtra">
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
	<!--Mobile View-->
	<div class="col-sm-6 col-md-4" >
		<div class="mTrItemCard">
				<a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}" class="pkg_search">
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
							<h5 class="mTourDuration">{{$package->duration}} Nights / {{$package->duration + 1}} Days</h5>
						</div>
						<div class="mTourPriceBox">
							@if($package->onrequest == 1 && $package->upcoming == 1)
								<span class="mTourPrice"><span class="defaultCurency">&nbsp;</span>On Request</span>
							@elseif($package->onrequest != 1 && $package->upcoming == 1)
								@if(CustomHelpers::get_price($package->id)=="On Request")
									<span class="mTourPrice"><span class="defaultCurency">&nbsp;</span>On Request</span>
								@else
									<span class="mTourPrice"><span class="defaultCurency">&nbsp;</span>{{CustomHelpers::get_price($package->id) }}</span>
									<span class="mTourPriceType">{{ $package->Price_type }}</span>
								@endif
							@elseif($package->onrequest == 1 && $package->upcoming != 1)
								@if(CustomHelpers::get_up_price($package->id)=="On Request")
									<span class="mTourPrice"><span class="defaultCurency">&nbsp;</span>On Request</span>
								@else
									<span class="mTourPrice"><span class="defaultCurency">&nbsp;</span>{{ CustomHelpers::get_up_price($package->id) }}</span>
									<span class="mTourPriceType">{{ $package->upcoming_type }}</span>
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
								for($i=0;$i<$city1_count;$i++)
								{
								$day=$days[$i]+1;
								echo "<span class='mitemDestDuration'>$days[$i]N&nbsp;</span><span class='mitemDestName'>$city1[$i]</span>";
								if($i<($city1_count-1)):
									echo "<span class='mitemDestSepr'>&nbsp;&rarr;&nbsp;</span>";
								endif;
								$a=$i+1;
								if($a%3=="0"):
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
	@endforeach

	       @endif
		</div>
	</div>
</div>








