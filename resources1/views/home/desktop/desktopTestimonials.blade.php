	<!--Desktop Testimonials Starts-->
	<div class="mBG">
		<div class="dTestCont">
			<div class="dTestContTtl">
				<h3>Testimonials</h3>
			</div>
		</div>
		<div class="testSliderCont">
			<div class="dPageContainer">
				<div class="relativeCont">
					<div class="carousel" id="">
						@foreach($testimonial as $test_data)
							<div class="dTestItemCard">
								<!-- <div class="dTestItemImgBox">
									@if($test_data->c_image=="")
										<img class="lazy-load" data-src="{{ asset('/public/uploads/') }}/default-img.webp" alt="guestImg" loading="img">
									@else
										<img class="lazy-load" data-src="{{ env('IMAGESRC').'/public/uploads/testimonial/'.$test_data->c_image }}" alt="img" loading="lazy">
									@endif
								</div> -->

								<!-- @php
								    $defaultImg = asset('public/uploads/default-img.webp');
								    $imagePath  = '';

								    if (!empty($test_data->c_image)) {
								        $imageUrl = env('IMAGESRC') . '/public/uploads/testimonial/' . $test_data->c_image;

								        // Convert the URL to a relative path for checking file existence
								        $relativePath = str_replace(url('public/'), '', $imageUrl);
								        $relativePath = str_replace(asset('/'), '', $relativePath);
								        $relativePath = ltrim($relativePath, '/');

								        // Get the absolute path
								        $imagePath = public_path($relativePath);
								    }

								    // Determine the final image source
								    $imageSrc = (!empty($imageUrl) && file_exists($imagePath)) ? $imageUrl : $defaultImg;
								@endphp

								<div class="dTestItemImgBox">
								    <img class="lazy-load" data-src="{{ $imageSrc }}" alt="guestImg" loading="lazy">
								</div> -->

								@php
								    $defaultImg = asset('public/uploads/default-img.webp');
								    $imageSrc  = $defaultImg; // Default image as fallback

								    if (!empty($test_data->c_image)) {
								        $baseUrl = rtrim(getWebsiteData('website_address'), '/'); // Ensure no trailing slash
								        $imageUrl = $baseUrl . '/public/uploads/testimonial/' . $test_data->c_image;

								        // Debug the generated image URL
								        // dd($imageUrl);

								        // Get the absolute server path
								        $imagePath = public_path('uploads/testimonial/' . $test_data->c_image);

								        // Set the final image source only if the file exists
								        if (file_exists($imagePath)) {
								            $imageSrc = $imageUrl;
								        }
								    }
								@endphp

								<div class="dTestItemImgBox">
								    <img class="lazy-load" data-src="{{ $imageSrc }}" alt="guestImg" loading="lazy">
								</div>

								<!-- <div class="dTestItemFooter">
									<div class="dTestItemContent">
									    @if(strlen($test_data->c_exp) > 200) 
									       !-- If the content length exceeds 200 characters --
									        
									        !-- Display the first 210 characters of the content followed by "..." --
									        {{ substr($test_data->c_exp, 0, 210) }}...
									        
									        !-- Add a "Read more" link that opens the full testimonial in a new tab --
									        <a href="{{ url('/Testimonial-Detail/' . CustomHelpers::custom_encrypt($test_data->id)) }}" target="_blank">
									            <span class="dTestItemContentReadMore">Read more</span>
									        </a>
									    @else
									        !-- If the content length is 200 characters or less, display the full content --
									        {{ $test_data->c_exp }}
									    @endif
									</div>

									<div class="dTestGuestName">
										<h5>{{ $test_data->c_name }}</h5>
									</div>
								</div> -->

								<div class="dTestItemFooter">
								    <div class="dTestItemContent">
								        @if(!empty($test_data->c_exp) && \Illuminate\Support\Str::length($test_data->c_exp) > 200) 
								            {{ \Illuminate\Support\Str::limit(e($test_data->c_exp), 210) }}
								            <a href="{{ route('testimonials', ['id' => CustomHelpers::custom_encrypt($test_data->id)]) }}" target="_blank">
								            	<span class="dTestItemContentReadMore">Read more</span>
								            </a>
								        @else
								            {{ e($test_data->c_exp) }}
								        @endif
								    </div>

								    <div class="dTestGuestName">
								        <h5>{{ e($test_data->c_name) }}</h5>
								    </div>
								</div>

							</div>
						@endforeach
					</div>	
				</div>
			</div>
		</div>
	</div>
	<!--Desktop Testimonials Ends-->