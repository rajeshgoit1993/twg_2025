<div class="dThemeBG">
	<div class="container">
		<!--<h1 class="big-caption">{{ CustomHelpers::theme_data($theme_name,'theme_para1') }}</h1>
		<h2 class="med-caption yellow-color"><strong>{{ CustomHelpers::theme_data($theme_name,'theme_para2') }}</strong></h2>-->
		<div class="dThemeHdCont">
			<h1>{{ $theme_name }} Holiday Packages</h1>
		</div>
	</div>
	<!--<div class="container">
		<div class="dThemeHdCont">
			<h1>{{ $theme_name }} Holiday Packages</h1>
		</div>
	</div>-->
</div>
<div class="dThemeContBG">
	<div class="container">
		<div class="dThemeTtlCont">
			<h2>About {{ $theme_name }} Packages</h2>
		</div>
		<div class="dThemeWrap">
			<div class="dAbtTheme">
				<p>{!! CustomHelpers::theme_data($theme_name,'about_theme') !!}</p>
			</div>
			@include('packages.seo.seoLinkContent')
		</div>
		<?php
			$destination_theme_link=$theme_data->destination_theme_link;
		?>
		@if($destination_theme_link!='')
		<?php
			$destination_theme_links=unserialize($theme_data->destination_theme_link);
      
		?>
         @foreach($destination_theme_links as $row=>$col)
		 <?php
			$destination_search=$col["destination"];
			$select_theme=$col["theme"];
			
			$data=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->limit(4)->get();

		?>
		<div class="dThemeContnt">
			<div class="dThemeDestCont">
				<h2 class="dThemeDestTtl">{{$col["destination"]}} {{ $theme_name }} Packages</h2>
				<a href="{{url('/'.$col['link'])}}">View All</a>
			</div>
			<div class="row">
			@foreach($data as $package)
			@php
			$location=unserialize($package->city);
			@endphp
			<div class="col-md-3 col-sm-4 custom_length_demostic ">
				<div class="TourItem">
					<input type="hidden" class="pack_id_list" name="pack_id_list_demostic[]"  value="{{ $package->id }}">
					<?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
					<a href="{{ url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id)) }}">
					<div class="dTourTopSection">
						<div class="dTourImgBox">
							@if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
								<img src="{{ CustomHelpers::get_image_gallery($gallery_id,'thum_medium') }}">
							@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
								<img src="{{ URL::to('/').'/public/Uploads/default_profile_image.png'}}">
							@endif
						</div>
						<div class="dTourPrcBox">
							@if($package->onrequest == 1 && $package->upcoming == 1)
								<div class="dTourPrcValueBox">
									<p class="dTourPrcValueReq"><span class="dTourDefaultCurency">&nbsp;</span>On Request</p>
								</div>
							@elseif($package->onrequest != 1 && $package->upcoming == 1)
								@if(CustomHelpers::get_price($package->id)=="On Request")
									<div class="dTourPrcValueBox">
										<p class="dTourPrcValueReq"><span class="dTourDefaultCurency">&nbsp;</span>On Request</p>
									</div>
								@else
									<div class="dTourPrcValueBox">
										<p class="dTourPrcValue"><span class="dTourDefaultCurency">&nbsp;</span>{{ CustomHelpers::get_price($package->id) }}</p>
										<p class="dTourPrcTyp">{{ $package->Price_type }}</p>
									</div>
								@endif
							@elseif($package->onrequest == 1 && $package->upcoming != 1)
								@if(CustomHelpers::get_up_price($package->id)=="On Request")
									<div class="dTourPrcValueBox">
										<p class="dTourPrcValueReq"><span class="dTourDefaultCurency">&nbsp;</span>On Request</p>
									</div>
								@else
									<div class="dTourPrcValueBox">
										<p class="dTourPrcValue"><span class="dTourDefaultCurency">&nbsp;</span>{{ CustomHelpers::get_up_price($package->id) }}</p>
										<p class="dTourPrcTyp">{{ $package->upcoming_type }}</p>
									</div>
								@endif
							@endif
						</div>
						<!--<div class="prise">
							@if($package->onrequest == 1 && $package->upcoming == 1)
							<a href="#">On Request </a>
							@elseif($package->onrequest != 1 && $package->upcoming == 1)
							@if(CustomHelpers::get_price($package->id)=="On Request")
							<a href="#"> {{ CustomHelpers::get_price($package->id)  }}</a>
							@else
							<a href="#">&#x20B9 {{ CustomHelpers::get_price($package->id)  }}</a>
							@endif
							@elseif($package->onrequest == 1 && $package->upcoming != 1)
							@if(CustomHelpers::get_up_price($package->id)=="On Request")
							<a href="#"> {{ CustomHelpers::get_up_price($package->id)  }}</a>
							@else
							<a href="#">&#x20B9 {{ CustomHelpers::get_up_price($package->id)  }}</a>
							@endif
							@endif
						</div>-->
						<!--<div class="DETAILS">
						!--   <form action="{{url('/Holidays/'.str_slug($package->title))}}" method="get">
						<input type="hidden" name="package_id" value="{{CustomHelpers::custom_encrypt($package->id)}}">
						</form> -->
						<!--<a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}">DETAILS</a>
						</div>-->
					</div>
					<div class="TourBtmSection">
						<div class="TourTtlCont">
							<h4>{{$package->title}}</h4>
						</div>
						<div>
							<div class="LocationCont"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$location[0] }}</div>
							<!--<div class="TourDuration">{{$package->duration}} Nights/{{$package->duration + 1}} Days</div>-->
							<div class="TourDuration">{{$package->duration}} Nights</div>
						</div>
						<!--<div class="pro_text">
							<div class="row">
								<div class="col-md-6 col-xs-6">DETAILS</div>
								<div class="col-md-6 col-xs-6">{{$package->duration}} N /{{$package->duration + 1}} D</div>
							</div>
						</div>-->
					</div>
					</a>
				</div>
			</div>
			@endforeach
			</div>
			<!--Load more packages-->
			<!--<div id="dynamic_theme_add"></div>
			<div class="col-md-12" id="">
				<div class="packages_button">
					<button class="PACKAGES" id="add_more_theme">Load More Packages</button>
				</div>
			</div>-->
			<!---->
		</div>
		@endforeach
		@endif
		
		@include('packages.seo.seoSection')
	</div>
</div>