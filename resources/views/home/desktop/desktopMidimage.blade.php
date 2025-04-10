		<!--Desktop Tour Destination-midimage Starts-->
		<section class="mBG">
			<div class="dPageContainer">
				<div class="dPopularDestCont">
					<div class="dPopularDestTtl">
						<h2>World Popular Destination</h2>
					</div>
				</div>
				@foreach($img_data as $img)
					<div class="dItemCont">
						<div class="dTourItemCard">
							@php
							    // Default Image Path
							    $defaultImage = asset('public/uploads/default-img.webp'); 
							    $imageSrc = $defaultImage; // Set default image initially

							    if (!empty($img->row1_image1)) {
							        $imagePath = public_path(ltrim($img->row1_image1, '/')); // Ensure correct path formatting

							        if (file_exists($imagePath) && is_file($imagePath)) {
							            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row1_image1));
							        }
							    }

							    // Generate URL Safely
							    $destinationUrl = !empty($img->row1_dest1) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row1_dest1) . '-tour-packages') : '#';
							@endphp

							<a href="{{ $destinationUrl }}" target="_blank">
							    <div class="dTourItemCardImgCont">
							        <!-- <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img"> -->
							        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="{{ e($img->row1_title1 ?? 'img') }}">
							    </div>
							    <div>
							        @if(!empty($img->row1_title1))
							            <h4>{{ e($img->row1_title1) }}</h4>
							        @endif

							        @if(!empty($img->row1_desc1))
							            <!--<p>{{ e($img->row1_desc1) }} <span>...Read More</span></p>-->
							        @endif
							    </div>
							</a>
						</div>

						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row1_image2)) {
								        $imagePath = public_path(ltrim($img->row1_image2, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row1_image2));
								        }
								    }

								    // Generate URL Safely using full namespace for Str::slug()
								    $destinationUrl = !empty($img->row1_dest2) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row1_dest2) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row1_title2))
								            <h4>{{ e($img->row1_title2) }}</h4>
								        @endif

								        @if(!empty($img->row1_desc2))
								            <!--<p>{{ e($img->row1_desc2) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row1_image3)) {
								        $imagePath = public_path(ltrim($img->row1_image3, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row1_image3));
								        }
								    }

								    // Generate URL Safely using full namespace for Str::slug()
								    $destinationUrl = !empty($img->row1_dest3) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row1_dest3) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row1_title3))
								            <h4>{{ e($img->row1_title3) }}</h4>
								        @endif

								        @if(!empty($img->row1_desc3))
								            <!--<p>{{ e($img->row1_desc3) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row2_image1)) {
								        $imagePath = public_path(ltrim($img->row2_image1, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row2_image1));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row2_dest1) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row2_dest1) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row2_title1))
								            <h4>{{ e($img->row2_title1) }}</h4>
								        @endif

								        @if(!empty($img->row2_desc1))
								            <!--<p>{{ e($img->row2_desc1) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row2_image2)) {
								        $imagePath = public_path(ltrim($img->row2_image2, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row2_image2));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row2_dest2) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row2_dest2) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row2_title2))
								            <h4>{{ e($img->row2_title2) }}</h4>
								        @endif

								        @if(!empty($img->row2_desc2))
								            <!--<p>{{ e($img->row2_desc2) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row2_image3)) {
								        $imagePath = public_path(ltrim($img->row2_image3, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row2_image3));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row2_dest3) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row2_dest3) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row2_title3))
								            <h4>{{ e($img->row2_title3) }}</h4>
								        @endif

								        @if(!empty($img->row2_desc3))
								            <!--<p>{{ e($img->row2_desc3) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row3_image1)) {
								        $imagePath = public_path(ltrim($img->row3_image1, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row3_image1));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row3_dest1) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row3_dest1) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row3_title1))
								            <h4>{{ e($img->row3_title1) }}</h4>
								        @endif

								        @if(!empty($img->row3_desc1))
								            <!--<p>{{ e($img->row3_desc1) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row3_image2)) {
								        $imagePath = public_path(ltrim($img->row3_image2, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row3_image2));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row3_dest2) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row3_dest2) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row3_title2))
								            <h4>{{ e($img->row3_title2) }}</h4>
								        @endif

								        @if(!empty($img->row3_desc2))
								            <!--<p>{{ e($img->row3_desc2) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row3_image3)) {
								        $imagePath = public_path(ltrim($img->row3_image3, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row3_image3));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row3_dest3) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row3_dest3) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row3_title3))
								            <h4>{{ e($img->row3_title3) }}</h4>
								        @endif

								        @if(!empty($img->row3_desc3))
								            <!--<p>{{ e($img->row3_desc3) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row4_image1)) {
								        $imagePath = public_path(ltrim($img->row4_image1, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row4_image1));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row4_dest1) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row4_dest1) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row4_title1))
								            <h4>{{ e($img->row4_title1) }}</h4>
								        @endif

								        @if(!empty($img->row4_desc1))
								            <!--<p>{{ e($img->row4_desc1) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row4_image2)) {
								        $imagePath = public_path(ltrim($img->row4_image2, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row4_image2));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row4_dest2) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row4_dest2) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row4_title2))
								            <h4>{{ e($img->row4_title2) }}</h4>
								        @endif

								        @if(!empty($img->row4_desc2))
								            <!--<p>{{ e($img->row4_desc2) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
								@php
								    // Default Image Path
								    $defaultImage = asset('public/uploads/default-img.webp'); 
								    $imageSrc = $defaultImage; // Set default image initially

								    if (!empty($img->row4_image3)) {
								        $imagePath = public_path(ltrim($img->row4_image3, '/')); // Ensure correct path formatting

								        if (file_exists($imagePath) && is_file($imagePath)) {
								            $imageSrc = CustomHelpers::get_base64_image(asset('public' . $img->row4_image3));
								        }
								    }

								    // Generate URL safely using Str::slug()
								    $destinationUrl = !empty($img->row4_dest3) ? url('/holidays/' . \Illuminate\Support\Str::slug($img->row4_dest3) . '-tour-packages') : '#';
								@endphp

								<a href="{{ $destinationUrl }}" target="_blank">
								    <div class="dTourItemCardImgCont">
								        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="img">
								    </div>
								    <div>
								        @if(!empty($img->row4_title3))
								            <h4>{{ e($img->row4_title3) }}</h4>
								        @endif

								        @if(!empty($img->row4_desc3))
								            <!--<p>{{ e($img->row4_desc3) }} <span>...Read More</span></p>-->
								        @endif
								    </div>
								</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</section>