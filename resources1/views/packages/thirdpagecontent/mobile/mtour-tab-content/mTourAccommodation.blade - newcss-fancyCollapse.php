    <style>
        .collapsible-item {
            background-color: #f1f1f1;
            cursor: pointer;
            padding: 10px;
            border: none;
            text-align: left;
            width: 100%;
            outline: none;
        }
        .collapsible-item:after {
		    font-family: FontAwesome;
		    content: '\f106';
		    color: #008cff;
		    float: right;
		    margin-left: 20px;
		    cursor: pointer;
		    font-size: 28px;
		}
		 .collapsible-item.active:after {
		    content: '\f107';
		}

       .collapsible-item-content {
            padding: 0 18px;
            display: none;
            overflow: hidden;
            background-color: #fff;
            transition: max-height 0.2s ease-out;
        }
       .collapsible-item-sub-content {
            padding: 0 18px;
            display: none;
            overflow: hidden;
            background-color: #fff;
        }
    </style>
<style type="text/css">
.mHtlCont {
	margin: 10px 0 30px;
	}
.mCityCont {
	margin-bottom: 10px;
	}
.mCityCont h4 {
    font-size: 16px;
    line-height: 16px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 0;
	text-transform: uppercase;
	}
.mHtlBox {
	border: 1px solid #e7e7e7;
    border-radius: 5px;
    padding: 15px;
    background: #f7f7f7;
	}
.mHtlImgBox {
	width: 300px;
	height: 175px;
	border-radius: 5px;
	overflow: hidden;
	margin: auto;
	}
.mHtlImgBox img {
	width: 100%;
	height: 175px;
	border-radius: 5px;
	}
.mhotelTopSection {
    margin-bottom: 20px;
	}
.mhotelFooter {
	margin-bottom: 0;
	}
.mHtlDesc {
	margin-top: 10px;
	display: flex;
	flex-direction: column;
	}
.mHtlDesc h4 {
    font-size: 16px;
    line-height: 18px;
    color: #000001;
    font-weight: 600;
    text-align: left;
    margin-bottom: 5px;
    margin-right: 10px;
	}
.mHotelType {
    display: inline-block;
    font-size: 12px;
    line-height: 12px;
    color: #fff;
    font-weight: 600;
    padding: 4px 6px;
    background: #6A11CB;
    border: 1px solid #707070;
    border-radius: 3px;
    text-transform: capitalize;
    margin-bottom: 5px;
	}
.mHtlDescription {
    margin-top: 0;
    margin-bottom: 10px !important;
}
.mHtlDescription img {
    width: 12px;
    margin-top: -5px
}
.mTourHtlDtls {
	margin-top: 10px;
	margin-bottom: 0;
	}
.mTourHtlDtls:last-child {
	margin-bottom: 0;
	}
.mTourHtlDtls h4 {
	font-size: 11px;
	line-height: 12px;
	color: #a1a1a1;
	font-weight: 600;
	text-align: left;
	margin-bottom: 2px;
	margin-right: 0;
	text-transform: uppercase;
	}
.mTourHtlDtls h5 {
	font-size: 12px;
	line-height: 14px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	text-transform: capitalize;
	}
.mhotelWebCont {
    display: flex;
    flex-direction: column;
    border-top: 1px solid #e7e7e7;
    padding-top: 15px;
    margin-top: 15px;
	}
.mhotelRoomCont_heading, .mhotelWebCont_heading {
    font-size: 12px;
    line-height: 14px;
    color: #9B9B9B;
    font-weight: 600;
    text-align: left;
    margin-bottom: 1px;
    text-transform: uppercase;
	}
.mhotelRoomCont_type, .mhotelWebCont_name {
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 600;
    text-align: left;
    margin-bottom: 0;
    text-transform: lowercase;
	}
.mDaySeparator {
	border-bottom: 3px solid #f5f5f5;
	margin-bottom: 10px !important;
	padding-bottom: 15px;
	}
</style>

    <div class="main-item">
        <div class="collapsible-item">Main collapsible-item</div>
        <div class="collapsible-item-content">
            <div class="sub-item">
                <div class="collapsible-item">Sub Item 1</div>
                <div class="collapsible-item-sub-content">
                    <p>Sub Content 1 for Sub Item 1</p>
                </div>
            </div>
            <div class="sub-item">
                <div class="collapsible-item">Sub Item 2</div>
                <div class="collapsible-item-sub-content">
                    <p>Sub Content 1 for Sub Item 2</p>
                </div>
            </div>
            <div class="sub-item">
                <div class="collapsible-item">Sub Item 3</div>
                <div class="collapsible-item-sub-content">
                    <p>Sub Content 1 for Sub Item 3</p>
                </div>
            </div>
        </div>
    </div>


<div class="mTourPkgDesc">
	@if($details->acc_type=="normal_acc" || $details->acc_type=="extra_acc")
	<div class="mTourHgLhts">
		<h2>Tour Accommodation</h2>
		<div class="">
			@if($details->acc_type=="normal_acc")
			<?php
				$acco=unserialize($details->accommodation);
				$i="1";
			?>
			@foreach($acco as $acco_data)
			<!---->
			@if($i=="1")
			<div class="fancy-collapse-panel">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 9px !important">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a class="" style="padding: 5px 35px 5px 5px;" data-toggle="collapse" data-parent="#accordion" href="#{{str_slug($acco_data['city'], '-').$i}}" aria-expanded="true" aria-controls="collapseThree">
									<span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span> {{ $acco_data["city"] }}
								</a>
							</h4>
						</div>
						<div id="{{str_slug($acco_data['city'], '-').$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body" style="padding: 0px;border-top: none">
							<div class="mHtlCont">
								<!--City Name-->
								<div class="mCityCont d-none">
								<?php
									$day1="0";
									$day="0";
								?>
								@if($acco_data!="" && array_key_exists("night",$acco_data))
								<?php $day1=count($acco_data["night"]); ?>
								@endif
								<h4>{{ $acco_data["city"] }}</h4>
								</div>
								<div class="mHtlBox">
									<!--Hotel Image-->
									@if(array_key_exists("hotel",$acco_data))
									<div class="mHtlImgBox">
										@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
											<img src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" alt="Hotel Image">
										@elseif($acco_data["hotel"]=="other")
											<img src="{{ url('/public/uploads/no-image.png') }}" alt="Hotel Image">
										@endif
									</div>
									@endif
									<!--Hotel Description-->
									<div class="mHtlDesc">
										<div class="mhotelTopSection">
											<div class="mHotelType">@if(array_key_exists("propertytype",$acco_data)){{$acco_data["propertytype"]}}@endif</div>
											<div class="">
												<h4 class="htlTtl">
													@if(array_key_exists("hotel",$acco_data))
													@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
													{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
													@elseif($acco_data["hotel"]=="other")
													{{$acco_data["other_hotel"]}}
													@endif
													@endif
												</h4>
												<dl class="mHtlDescription">
													<dt>
													<span class="location" >
													@if(array_key_exists("star",$acco_data))
													@if($acco_data["star"]!="" && $acco_data["star"]!="other")
													{{CustomHelpers::get_star_rating($acco_data["star"])}}
													@elseif($acco_data["star"]=="other")
													{{CustomHelpers::get_star_rating($acco_data["star_other"])}}
													@endif
													@endif
													</span>
													</dt>
												</dl>
											</div>
										</div>
										<div class="mhotelFooter">
											<div class="flexBetween">
											<!--No of Nights-->
											<div class="mTourHtlDtls">
												<h4>No of Nights</h4>
												<h5>
													@if($day1>1)
													<div>{{ $day1 }} Nights</div>
													@else
													<div>{{ $day1 }} Night</div>
													@endif
												</h5>
											</div>
											<!--Room Type-->
											@if($acco_data["category"]!="")
											<div class="mTourHtlDtls">
												<h4 class="textRight">Room Type</h4>
												<h5 class="textRight">{{ $acco_data["category"] }}</h5>
											</div>
											@endif
											</div>
											<!--Hotel Website-->
											@if(array_key_exists("hotel_link",$acco_data))
											<div class="mhotelWebCont">
												<div class="mhotelWebCont_heading">Hotel Website</div>
												<div class="mhotelWebCont_name">{{ $acco_data["hotel_link"] }}</div>
											</div>
											@endif
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="fancy-collapse-panel">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 9px !important">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a class="collapsed" style="padding: 5px 35px 5px 5px;" data-toggle="collapse" data-parent="#accordion" href="#{{str_slug($acco_data['city'], '-').$i}}" aria-expanded="false" aria-controls="collapseThree"><span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span> {{ $acco_data["city"] }}</a>
							</h4>
						</div>
						<div id="{{str_slug($acco_data['city'], '-').$i}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body" style="padding: 0px;border-top: none">
							<div class="mHtlCont">
								<!--City Name-->
								<div class="mCityCont d-none">
								<?php
									$day1="0";
									$day="0";
								?>
								@if($acco_data!="" && array_key_exists("night",$acco_data))
								<?php $day1=count($acco_data["night"]); ?>
								@endif
								<h4>{{ $acco_data["city"] }}</h4>
								</div>
								<div class="mHtlBox">
									<!--Hotel Image-->
									@if(array_key_exists("hotel",$acco_data))
									<div class="mHtlImgBox">
										@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
											<img src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" alt="Hotel Image">
										@elseif($acco_data["hotel"]=="other")
											<img src="{{ url('/public/uploads/no-image.png') }}" alt="Hotel Image">
										@endif
									</div>
									@endif
									<!--Hotel Description-->
									<div class="mHtlDesc">
										<div class="mhotelTopSection">
											<div class="mHotelType">@if(array_key_exists("propertytype",$acco_data)){{$acco_data["propertytype"]}}@endif</div>
											<div class="">
												<h4 class="htlTtl">
													@if(array_key_exists("hotel",$acco_data))
													@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
													{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
													@elseif($acco_data["hotel"]=="other")
													{{$acco_data["other_hotel"]}}
													@endif
													@endif
												</h4>
												<dl class="mHtlDescription">
													<dt>
													<span class="location" >
													@if(array_key_exists("star",$acco_data))
													@if($acco_data["star"]!="" && $acco_data["star"]!="other")
													{{CustomHelpers::get_star_rating($acco_data["star"])}}
													@elseif($acco_data["star"]=="other")
													{{CustomHelpers::get_star_rating($acco_data["star_other"])}}
													@endif
													@endif
													</span>
													</dt>
												</dl>
											</div>
										</div>
										<div class="mhotelFooter">
											<div class="flexBetween">
											<!--No of Nights-->
											<div class="mTourHtlDtls">
												<h4>No of Nights</h4>
												<h5>
													@if($day1>1)
													<div>{{ $day1 }} Nights</div>
													@else
													<div>{{ $day1 }} Night</div>
													@endif
												</h5>
											</div>
											<!--Room Type-->
											@if($acco_data["category"]!="")
											<div class="mTourHtlDtls">
												<h4 class="textRight">Room Type</h4>
												<h5 class="textRight">{{ $acco_data["category"] }}</h5>
											</div>
											@endif
											</div>
											<!--Hotel Website-->
											@if(array_key_exists("hotel_link",$acco_data))
											<div class="mhotelWebCont">
												<div class="mhotelWebCont_heading">Hotel Website</div>
												<div class="mhotelWebCont_name">{{ $acco_data["hotel_link"] }}</div>
											</div>
											@endif
										</div>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endif
			<!---->
			<?php $i++; ?>
			@endforeach
			@elseif($details->acc_type=="extra_acc")
			{!! $details->accommodation_extra !!}
			@endif
		</div>
	</div>
	<div class="custom_padding"></div>
	@endif
</div>

<script>
const collapsibleButtons = document.querySelectorAll('.collapsible-item');

        collapsibleButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                // content.style.maxHeight = 'inherit';
                if (content.style.display === 'block') {
                	content.style.display = 'none';
                	} 
                else {
                    content.style.display = 'block';
                    content.style.maxHeight = 'inherit';
                    // Scroll the sub-content into view
                    const subContent = content.querySelector('.collapsible-item-sub-content');
                    if (subContent) {
                        subContent.scrollIntoView({ behavior: 'smooth' });
                    	}
                	}
                // Scroll the new container into view
     			//content.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    </script>