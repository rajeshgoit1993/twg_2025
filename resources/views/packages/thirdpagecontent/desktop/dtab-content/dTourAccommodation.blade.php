<div class="tab-pane fade tourPkgDesc" id="dTourAccommodation">
	@if($details->acc_type=="normal_acc" || $details->acc_type=="extra_acc")
	<div class="tab-pane fade in active tourHgLhts">
		<h2>Tour Accommodation</h2>
		<div class="room-list listing-style3 hotel">
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
								<a class="" style="padding: 5px 35px 5px 5px;" data-toggle="collapse" data-parent="#accordion" href="#{{ str_slug($acco_data['city'], '-').$i }}" aria-expanded="true" aria-controls="collapseThree">
									<span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span> {{ $acco_data["city"] }}
								</a>
							</h4>
						</div>
						<div id="{{ str_slug($acco_data['city'], '-').$i }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body" style="padding: 0px;">
							<!--Hotel Details-->
							<article class="box" style="margin-top: 10px;">
								@if(array_key_exists("hotel",$acco_data))
								<figure class="col-xs-12 col-sm-3 col-md-3">
									@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
									<div>
										<img src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" alt="Hotel Image">
									</div>
									@elseif($acco_data["hotel"]=="other")
									<img style="flex-shrink: 0;width: 160px;" src="{{ url('/public/uploads/no-image.png') }}" alt="Hotel Image">
									@endif
								</figure>
								@endif
								<div class="details col-xs-12 col-sm-9 col-md-9">
								<div>
									<div>
											<div class="hotelType">@if(array_key_exists("propertytype",$acco_data))
												{{$acco_data["propertytype"]}}
											@endif</div>
									<div class="flexCenter">

										<h4 class="htlTtl">
											@if(array_key_exists("hotel",$acco_data))
											@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
											{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
											@elseif($acco_data["hotel"]=="other")
											{{$acco_data["other_hotel"]}}
											@endif
											@endif
										</h4>
										<dl class="description">
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
									<!--City Name-->
									<div class="cityName">
										<?php
											$day1="0";
											$day="0";
										?>
										@if($acco_data!="" && array_key_exists("night",$acco_data))
										<?php $day1=count($acco_data["night"]); ?>
										@endif
										<h4>{{ $acco_data["city"] }}</h4>
									</div>
									<!--No of Nights-->
									<div class="tourHtlDtls">
										<h4>NO OF NIGHTS</h4>
										<h5>
											@if($day1>1)
												{{ $day1 }} Nights 
											@else 
												{{ $day1 }} Night 
											@endif
										</h5>
									</div>
									<!--Room Type-->
									@if($acco_data["category"]!="")
									<div class="tourHtlDtls">
										<h4>ROOM TYPE</h4>
										<h5>
											{{$acco_data["category"]}}
										</h5>
									</div>
									@endif
									<!---->
									@if(array_key_exists("hotel_link",$acco_data))
											<div class="tourHtlDtls">
										<h4>HOTEL LINK</h4>
										<h5>
											{{$acco_data["hotel_link"]}}
										</h5>
									</div>
											@endif

								
									<!---->
									</div>
								</div>
								</div>
							</article>
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
								<a class="collapsed" style="padding: 5px 35px 5px 5px;" data-toggle="collapse" data-parent="#accordion" href="#{{ str_slug($acco_data['city'], '-').$i }}" aria-expanded="false" aria-controls="collapseThree">
									<span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span> {{ $acco_data["city"] }}
								</a>
							</h4>
						</div>
						<div id="{{ str_slug($acco_data['city'], '-').$i }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body" style="padding: 0px;">
							<!--Hotel Details-->
							<article class="box" style="margin-top: 10px;">
								@if(array_key_exists("hotel",$acco_data))
								<figure class="col-xs-12 col-sm-3 col-md-3">
									@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
									<div>
										<img src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" alt="Hotel Image">
									</div>
									@elseif($acco_data["hotel"]=="other")
										<img style="flex-shrink: 0;width: 160px;" src="{{ url('/public/uploads/no-image.png') }}" alt="Hotel Image">
									@endif
								</figure>
								@endif
								<div class="details col-xs-12 col-sm-9 col-md-9">
								<div>
									<div>
										<div class="hotelType">@if(array_key_exists("propertytype",$acco_data))
												{{$acco_data["propertytype"]}}
											@endif</div>

									<div class="flexCenter">
										<h4 class="htlTtl">
											@if(array_key_exists("hotel",$acco_data))
											@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
											{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
											@elseif($acco_data["hotel"]=="other")
											{{$acco_data["other_hotel"]}}
											@endif
											@endif
										</h4>
										<dl class="description">
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
									<!--City Name-->
									<div class="cityName">
										<?php
											$day1="0";
											$day="0";
										?>
										@if($acco_data!="" && array_key_exists("night",$acco_data))
										<?php $day1=count($acco_data["night"]); ?>
										@endif
										<h4>{{ $acco_data["city"] }}</h4>
									</div>
									<!--No of Nights-->
									<div class="tourHtlDtls">
										<h4>NO OF NIGHTS</h4>
										<h5>
											@if($day1>1)
												{{ $day1 }} Nights 
											@else 
												{{ $day1 }} Night 
											@endif
										</h5>
									</div>
									<!--Room Type-->
									@if($acco_data["category"]!="")
									<div class="tourHtlDtls">
										<h4>ROOM TYPE</h4>
										<h5>
											{{$acco_data["category"]}}
										</h5>
									</div>
									@endif
									<!---->
										@if(array_key_exists("hotel_link",$acco_data))
											<div class="tourHtlDtls">
										<h4>HOTEL LINK</h4>
										<h5>
											{{$acco_data["hotel_link"]}}
										</h5>
									</div>
											@endif

								
									<!---->
									</div>
								</div>
								</div>
							</article>
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