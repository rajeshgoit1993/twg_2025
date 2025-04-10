<style type="text/css">
.zeroPadding {
	padding: 0;
	}
@media (max-width: 992px) {
	/*Mobile Common Starts*/
	.mBG {
		background-color: #f2f2f2;
		}
	.mPageContainer:before, .mPageContainer:after {
		display: table;
		content: " ";
		}
	.mPageContainer:after {
		clear: both;
		}
	.mPageContainer {
		max-width: 992px;
		}
	.mPageContainer {
		padding-left: 13px;
		padding-right: 13px;
		margin-left: auto;
		margin-right: auto;
		}
	/*Mobile Common Ends*/
/**/
	.mTourItemCard {
		border: 1px solid #e7e7e7;
		border-radius: 5px;
		overflow: hidden;
		}
	.mTrItemCard {
		border: 1px solid #e7e7e7;
		border-radius: 5px;
		overflow: hidden;
		}
/**/
/*Mobile Package list starts*/
	.mPageCont {
		margin: 0;
		}
	.mTourItmCont {
		/*margin-top: 25px;*/
		box-shadow: 0px 7px 15px rgb(0 0 0 / 10%);
		/*border: 1px solid #c8c6c7;*/
		border: 1px solid transparent;
		border-radius: 0;
		overflow: hidden;
		}
	.mTourItmCont:hover {
		border: 1px solid #01b7f2;
		/*border: 1px solid #007bff;*/ /*Blue Border*/
		}
	.tourItmLeftSec {
		cursor: default;
		}
	.mTourItemCard {
		margin-bottom: 20px;
		}
	.mTrItemCard {
		margin-bottom: 20px;
		}
	.mTourItemCard a, mTrItemCard a {
		cursor: default;
		margin-bottom: 10px;
		pointer-events: none !important;
		}
	.mTourItmImgBox {
		background-color: #e5e5e5;
		width: 100%;
		height: 225px;
		position: relative;
		}
	.mTourItmImgBox img {
		width: 100%;
		height: 225px;
		object-fit: cover;
		}
	.tourItmRightSec {
		background-color: #fff;
		border-radius: 5px;
    	box-shadow: 0px 2px 10px rgb(0 0 0 / 20%);
    	position: relative;
    	margin: -50px 8px 20px;
		}
	/*.mTourTtlBox {
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
		}*/
	.mTourItmDescCont {
		/*padding: 13px;*/
		padding: 0 13px 13px;
		box-shadow: 0px 2px 10px rgb(0 0 0 / 20%);
		}
	.mTourItemTopSec {
		display: flex;
		align-items: flex-start;
		justify-content: space-between;
		}
	.mTourTtlWrapper {
		/*display: flex;*/
		width: 67%;
		padding: 0;
		}
	.mTourTtlWrapper h3 {
		font-size: 18px;
		line-height: 28px;
		color: #000001;
		font-weight: 600;
		text-align: left;
		margin-bottom: 5px;
	    overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		}
	.mHotel-star-rating {
		/*display: inline-block;*/
		margin-top: 0;
		margin-bottom: 7px;
		}
	.mStart_checked {
		color: #FDB714;
		font-size: 14px;
		line-height: 16px;
		width: 16px;
		}
	.fa-star:before {
		content: "\f005";
		}
	.mDaysBadgeTop {
		position: relative;
		top: -10px;
	    font-size: 12px;
	    line-height: 12px;
	    color: #fff;
	    font-weight: 600;
	    text-align: center;
	    border-radius: 15px;
	    background-color: #001;
	    display: inline-block;
	    padding: 6px 12px;
		}
	.mDaysBadge {
	    font-size: 12px;
	    line-height: 12px;
	    color: #fff;
	    font-weight: 600;
	    text-align: center;
	    border-radius: 3px;
	    background: #26b5a9;
	    display: inline-block;
	    padding: 3px 5px;
	    margin-right: 5px;
		}
	.mTourType {
	    font-size: 12px;
	    line-height: 12px;
	    color: #fff;
	    font-weight: 600;
	    text-align: center;
	    margin-bottom: 0;
	    border-radius: 3px;
	    background-color: #000;
	    display: inline-block;
	    padding: 3px 5px;
	    text-transform: capitalize;
		}
.mItemPriceBoxTop {
		/*background-color: #eaf5ff;
		padding: 10px 5px;*/
		position: relative;
		display: flex;
	    flex-direction: column;
	    justify-content: center;
		}
	.mItemAcutalPrice {
		font-size: 12px;
		line-height: 14px;
		color: #9b9b9b;
		font-weight: 500;
		text-decoration: line-through;
		}
	.mItemPriceType {
		font-size: 10px;
		line-height: 14px;
		color: #000;
		text-align: left;
		font-weight: 500;
		text-transform: capitalize;
		}
	.mItemPriceType_OnRequest {
		font-size: 18px;
		line-height: 20px;
		color: #000;
		text-align: left;
		font-weight: 500;
		text-transform: capitalize;
		}
	.mItemOfferPrice {
		font-size: 18px;
		line-height: 28px;
		color: #001;
		text-align: left;
		font-weight: 900;
		}
	.mItemPriceSubTag {
		font-size: 10px;
		line-height: 12px;
		color: #9b9b9b;
		text-align: left;
		font-weight: 500;
		}
	.dItemOfferTag {
	    border-radius: 2px;
	    background: linear-gradient(247deg, #ff3e5e, #ff6d3f);
	    padding: 3px;
	    font-size: 10px;
	    line-height: 10px;
	    color: #fff;
	    position: absolute;
	    right: 0;
	    top: 0;
	    text-transform: uppercase;
		}

	/*.mTourPriceBox {
		text-align: right;
		display: flex;
		flex-direction: column;
		flex-shrink: 0;
		}*/
	/*.mTourPrice {
		font-size: 18px;
		line-height: 22px;
		color: #000001;
		color: #FDB714;
		font-weight: 500;
		text-align: right;
		margin-bottom: 0;
		}*/
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
		margin-top: 15px;
		margin-bottom: 15px;
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
		/*color: #FDB714;*/
		font-weight: 500;
		text-align: left;
		margin-bottom: 0;
		display: flex;
		align-items: center;
	    flex-wrap: wrap;
		}
	.mitemDestDuration {
	    color: #eb2025;
	    font-size: 15px;
	    line-height: 15px;
	    font-weight: 700;
		}
	.mitemDestName {
	    font-size: 15px;
	    line-height: 15px;
	    font-weight: 900;
	    color: #000001;
	    display: flex;
	    flex-wrap: wrap;
		}
	.mitemDestSepr {
		color: #000001;
		}
	.mTourItemFooter {
		margin-bottom: 10px;
		}
	.mServiceTitle {
	    color: #4A4A4A;
	    font-size: 12px;
	    line-height: 12px;
	    font-weight: 600;
	    margin-bottom: 11px;
		}
	.mSvcIconCont {
		margin-right: 20px;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		}
	.mSvcIconCont:last-child {
		margin-right: 0;
		}
	.mSvcIcon {
		width: 20px;
		height: 20px;
		overflow: hidden;
		}
	.mSvcIcon img {
		width: 20px;
		height: 20px;
		}
	.mSvcTtl {
		font-size: 12px;
		line-height: 14px;
		color: #000001;
		font-weight: 500;
		text-align: center;
		margin-top: 5px;
		}
	.mTourItemPriceBox {
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin-top: 15px;
		margin-bottom: 15px;
		}
	.mTourPriceWrapper {
		max-width: 78px;
		}
	.mTourPriceWrapper h4 {
		font-size: 14px;
		line-height: 18px;
		color: #001;
		font-weight: 500;
		text-align: left;
		margin-bottom: 0;
		}
	.viewItemCont {
		margin-top: 20px;
		}
	.mBtnViewDtls {
		display: inline-block;
		outline: 0;
		text-transform: capitalize;
		background: #01b7f2;
		border: 0;
	    border-radius: 3px;
		padding: 6px 12px;
	    font-size: 16px;
		line-height: 16px;
		color: #fff;
		font-weight: 700;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
    	-ms-touch-action: manipulation;
    	touch-action: manipulation;
    	-webkit-user-select: none;
    	-moz-user-select: none;
    	-ms-user-select: none;
		cursor: default;
		margin-bottom: 0;
		letter-spacing: 0.64px;
		user-select: none;
		width: 100%;
		height: 34px;
		}
	.mBtnViewDtls:hover {
		background: #01b7f2;
		color: #fff;
		}
	/*Scroll Loader*/
	.tourErrorMsgCont {
		padding: 40px 0;
		font-size: 22px;
		line-height: 24px;
		color: #4a4a4a;
		font-weight: 500;
		text-align: center;
		margin-bottom: 0;
		}
	.tourErrorMsgCont h3 {
		font-size: 26px;
		line-height: 28px;
		color: #4a4a4a;
		font-weight: 500;
		text-align: center;
		margin-bottom: 10px;
		}
	.tourErrorMsgCont h4 {
		font-size: 22px;
		line-height: 24px;
		color: #4a4a4a;
		font-weight: 500;
		text-align: center;
		margin-bottom: 0;
		}
	.loaderCont {
		padding: 40px 0;
		background-color: transparent;
		text-align: center;
		margin-bottom: 0;
		}
	.loaderCont span {
		font-size: 22px;
		line-height: 24px;
		color: #01b7f2;
		font-weight: 600;
		text-align: center;
		}
	.loaderCont img {
		width: 50px;
		height: 50px;
		}
	.loaderCont p {
		font-size: 22px;
		line-height: 24px;
		color: #001;
		font-weight: 600;
		text-align: center;
		}
/*Mobile Tour Image Animation*/
.fade-in-cont {
	position: relative;
	}
.fade-in {
	opacity: 0;
	transition: opacity 2s ease-in; /* Adjust the duration for slower animation */
	}
.fade-in.loaded {
	opacity: 1;
	}
/*Mobile Tour Image Animation ends*/
	}
/*Mobile Package list ends*/
/**/
</style>
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
							<!--<article class="mTourItemCard">-->
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
													<h3 title="{{ $package->title }}">{{ $package->title }} {{ $package->title }}</h3>
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
												<!--Price Box starts-->
												<div>
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
												</div>
												<!--Price Box ends-->
											</div>
											<!--<div class="flexBetween">
												<div class="mTourTtlBox">
													<h4 class="mTourTtl">{{$package->title}}</h4>
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
											</div>-->
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
											<!--Guest Rating Starts-->
												@php
													$customer_rating=$package->customer_rating;
												@endphp   
												<!--<div class="flexBetween" style="display: none;">
													<div class="">Guest Rating</div>
													<div class="customer_rating">
														@if($customer_rating=="3.5")
															@for($i=1;$i<=$customer_rating;$i++)
																<img width="14" height="14" src="{{ url('/public/uploads/icons/star1.png') }}" title="{{ $customer_rating }} Star">
															@endfor
															<img width="14" height="14" src="{{ url('/public/uploads/icons/halfstar.png') }}" title="{{ $customer_rating }} Star">
															<img width="14" height="14" src="{{ url('/public/uploads/icons/star2.png') }}" title="{{ $customer_rating }} Star">
														@elseif($customer_rating=="4.5")
														@for($i=1;$i<=$customer_rating;$i++)
															<img width="14" height="14" src="{{ url('/public/uploads/icons/star1.png') }}" title="{{ $customer_rating }} Star">
														@endfor
															<img width="14" height="14" src="{{ url('/public/uploads/icons/halfstar.png') }}" title="{{ $customer_rating }} Star">
														@else
														@for($i=1;$i<=$customer_rating;$i++)
															<img width="14" height="14" src="{{ url('/public/uploads/icons/star1.png') }}" title="{{ $customer_rating }} Star">
														@endfor
														@for($j=5;$j>$customer_rating;$j--)
															<img width="14" height="14" src="{{ url('/public/uploads/icons/star2.png') }}" title="{{ $customer_rating }} Star">
														@endfor
														@endif
													</div>
												</div>-->
											<!--Guest Rating Ends-->
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
<script type="text/javascript">
// Alternate Script of Fade-in  Images (USE ANY ONE TO WORK)

// Select all images with class "fade-in"
const imagesssss = document.querySelectorAll('.fade-innnnnn');

// Loop through each image and add event listener to execute when each image is loaded
for (let i = 0; i < imagesssss.length; i++) {
  imagesssss[i].addEventListener('load', function() {
    // Add the "loaded" class to apply the fade-in transition
    imagesssss[i].classList.add('loaded');
  });
}
</script>