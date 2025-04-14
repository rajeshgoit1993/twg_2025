<div class="dThemeBG">
	<div class="container">
		<!--<h1 class="big-caption">{{ CustomHelpers::theme_data($theme_name,'theme_para1') }}</h1>
		<h2 class="med-caption yellow-color"><strong>{{ CustomHelpers::theme_data($theme_name,'theme_para2') }}</strong></h2>-->
		<div class="dThemeHdCont">
			<h1>{{ $theme_name }} Holiday Packages</h1>
		</div>
	</div>
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
		    // Ensure $theme_data is set before accessing properties
		    $destination_theme_link = isset($theme_data) ? $theme_data->destination_theme_link : '';

		    // Unserialize the link safely
		    $destination_theme_links = !empty($destination_theme_link) ? @unserialize($destination_theme_link) : [];
		?>

		@if(!empty($destination_theme_links))
		    @foreach($destination_theme_links as $row => $col)
		        <?php
		            $destination_search = $col["destination"];
		            $select_theme = $col["theme"];

		            $data = DB::table('rt_packages')
		                ->where('status', '=', '1')
		                ->where('package_category', 'like', '%' . $select_theme . '%')
		                ->where(function ($query) use ($destination_search) {
		                    $query->orWhere('continent', 'like', '%' . $destination_search . '%')
		                          ->orWhere('country', 'like', '%' . $destination_search . '%')
		                          ->orWhere('state', 'like', '%' . $destination_search . '%')
		                          ->orWhere('city', 'like', '%' . $destination_search . '%');
		                })
		                ->limit(4)
		                ->get();
		        ?>

		        <div class="mThemeContnt">
		            <div class="mThemeDestCont">
		                <h2 class="mThemeDestTtl">{{ $col["destination"] }} {{ $theme_name }} Packages</h2>
		                <a href="{{ url('/' . $col['link']) }}">View All</a>
		            </div>
		            <div class="row">
		                @foreach($data as $package)
		                    @php
		                        // Safely unserialize city data
		                        $location = @unserialize($package->city);
		                        $location = is_array($location) ? $location : ['Unknown'];
		                    @endphp
		                    <div class="col-xs-6 col-sm-4 custom_length_demostic">
		                        <div class="mTourItem">
		                            <input type="hidden" class="pack_id_list" name="pack_id_list_demostic[]" value="{{ $package->id }}">
		                            <?php $gallery_id = CustomHelpers::get_first_galleryid($package->id); ?>
		                            <a href="{{ url('/Holidays/' . str_slug($package->title) . '?package_id=' . CustomHelpers::custom_encrypt($package->id)) }}">
		                                <div class="mTourTopSection">
		                                    <div class="mTourImgBox">
		                                        @if(CustomHelpers::get_image_gallery($gallery_id, 'thum_medium') != "0")
		                                            <img src="{{ CustomHelpers::get_image_gallery($gallery_id, 'thum_medium') }}">
		                                        @else
		                                            <img src="{{ asset('public/uploads/default-img.webp') }}">
		                                        @endif
		                                    </div>
		                                    <div class="mTourPrcBox">
		                                        @if($package->onrequest == 1 && $package->upcoming == 1)
		                                            <div class="mTourPrcValueBox">
		                                                <p class="mTourPrcValueReq"><span class="mTourDefaultCurency">&nbsp;</span>On Request</p>
		                                            </div>
		                                        @elseif($package->onrequest != 1 && $package->upcoming == 1)
		                                            @if(CustomHelpers::get_price($package->id) == "On Request")
		                                                <div class="mTourPrcValueBox">
		                                                    <p class="mTourPrcValueReq"><span class="mTourDefaultCurency">&nbsp;</span>On Request</p>
		                                                </div>
		                                            @else
		                                                <div class="mTourPrcValueBox">
		                                                    <p class="mTourPrcValue"><span class="mTourDefaultCurency">&nbsp;</span>{{ CustomHelpers::get_price($package->id) }}</p>
		                                                    <p class="mTourPrcTyp">{{ $package->Price_type }}</p>
		                                                </div>
		                                            @endif
		                                        @elseif($package->onrequest == 1 && $package->upcoming != 1)
		                                            @if(CustomHelpers::get_up_price($package->id) == "On Request")
		                                                <div class="mTourPrcValueBox">
		                                                    <p class="mTourPrcValueReq"><span class="mTourDefaultCurency">&nbsp;</span>On Request</p>
		                                                </div>
		                                            @else
		                                                <div class="mTourPrcValueBox">
		                                                    <p class="mTourPrcValue"><span class="mTourDefaultCurency">&nbsp;</span>{{ CustomHelpers::get_up_price($package->id) }}</p>
		                                                    <p class="mTourPrcTyp">{{ $package->upcoming_type }}</p>
		                                                </div>
		                                            @endif
		                                        @endif
		                                    </div>
		                                </div>
		                                <div class="mTourBtmSection">
		                                    <div class="mTourTtlCont">
		                                        <h4>{{ $package->title }}</h4>
		                                    </div>
		                                    <div>
		                                        <div class="mLocationCont">
		                                            <i class="fa fa-location-arrow" aria-hidden="true"></i> {{ $location[0] }}
		                                        </div>
		                                        <div class="mTourDuration">{{ $package->duration }} Nights</div>
		                                    </div>
		                                </div>
		                            </a>
		                        </div>
		                    </div>
		                @endforeach
		            </div>
		        </div>
		    @endforeach
		@endif

		<!-- seo section -->
		@include('packages.seo.seoSection')
	</div>
</div>