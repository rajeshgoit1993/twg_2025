		<!--Mobile Tour Images Starts-->
		<div class="mTourImgCont">
			<div class="mTourImgBox mTourImg-animation-container"> <!--Mobile Tour Image Animation-pagethree.css-->
				<?php $ab = 1; $validImageCount = 0; ?>
				@foreach($images as $img)
					@php
						$imageMain = CustomHelpers::get_image_gallery($img->gallery_id, 'image_main');
					@endphp

					@if($imageMain !== "0")
						@if($ab == 1)
							<img src="{{ $imageMain }}" alt="tourimg">
						@endif
						<?php $validImageCount++; $ab++; ?>
					@endif
				@endforeach
				@if($validImageCount == 0)
					<!-- <img src="{{ URL::to('/public/Uploads/default_profile_image.png') }}" alt="noimage"> -->
					<img src="" alt="noimage">
				@endif

				<!-- image next button -->
				<!--<div class="tourImage_sliders">
					<div class="tourImage_sliderPrevious" onclick="plusSlides(-1)"></div>
					<div class="tourImage_sliderNext" onclick="plusSlides(1)"></div>
				</div>-->

				<!-- theme -->
				<!-- @php
					// Check if package_category is not null or empty
					if (!empty($details->package_category)) {
						$theme = unserialize($details->package_category);
						// Check if unserialized result is an array before counting
						if (is_array($theme)) {
							$theme_count = count($theme);
						} else {
						// Handle the case where unserialization does not return an array
						$theme_count = 0; // or set a default value
						}
					} else {
						$theme_count = 0; // Set to 0 if package_category is empty
					}
				@endphp
				<div class="mTheme_position">
					<ul>
						@for($i = 0; $i < $theme_count; $i++)
							@if($i<="2")
								<li>{{ $theme[$i] }}</li>
							@else @break;
							@endif
						@endfor
					</ul>
				</div>
				<div class="mTheme_position d-none">
					@for($i=0; $i < $theme_count; $i++)
						<span class="theme_element"> {{$theme[$i]}} </span>
					@endfor
				</div> -->

				<!-- image dot -->
				<!-- <div class="dTourImgDot" style="display: ">
				<span class="dot" onclick='currentSlide(1)'></span>
				<span class="dot" onclick='currentSlide(2)'></span>
				<span class="dot" onclick='currentSlide(3)'></span>
				<span class="dot" onclick='currentSlide(4)'></span>
				<span class="dot" onclick='currentSlide(5)'></span>
				<span class="dot" onclick='currentSlide(6)'></span>
				</div> -->
			</div>
			<div class="mBannerCont">
				<a class="mGoToPreviousPage" href="{{ URL::previous() ?? url('/') }}"></a>
				<!-- <a class="mGoToPreviousPage" href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}"></a> -->
			</div>

			<!-- <div class="view_gallery" id="addModal_m_gallery">View Gallery &#8594;</div> -->
			<!-- Show "View Gallery" only when there are more than 1 image -->
			@if($validImageCount > 1)
				<div class="view_gallery" id="addModal_m_gallery">View Gallery &#8594;</div>
			@endif
		</div>
		<!--Mobile Tour Images Ends-->
		<!--Mobile Tour Image Animation-pagethree.js-->
		<!--Modal Script-Image Gallery-Enquiry-get-modal.js-->