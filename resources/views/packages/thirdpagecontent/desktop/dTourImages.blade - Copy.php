						<!--Desktop Tour Image Starts-->
						<div class="dTourImgCont">
							<div class="dTourImgBox">
								<?php $ab=1;?>
									@foreach($images as $img)
										@if(CustomHelpers::get_image_gallery($img->gallery_id,'image_main')!="0")
											@if($ab==1)
											<img src="{{ CustomHelpers::get_image_gallery($img->gallery_id,'image_main') }}" alt="tourimg">
										@endif
										<!--<div class="mTourImgTag d-none">
											@if(CustomHelpers::get_imgpath_gallery($img->gallery_id,'name')=="")
												<p>Tour Image</p>
											@else
												<p>{{CustomHelpers::get_imgpath_gallery($img->gallery_id,'name')}}</p>
											@endif
										</div>-->
										@endif
								<?php $ab++;?>
										@endforeach

									<!-- image next button -->
									<!--<div class="tourImage_sliders">
										<div class="tourImage_sliderPrevious" onclick="plusSlides(-1)"></div>
										<div class="tourImage_sliderNext" onclick="plusSlides(1)"></div>
									</div>-->

									@php
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

									<!--<div class="dTheme_position">
										<ul>
										@for($i=0;$i<$theme_count;$i++)
										@if($i<="2")
											<li>{{ $theme[$i] }}</li>
										@else @break;
										@endif 
										@endfor
										</ul>
									</div>
									!--<div class="dTheme_position d-none">
										@for($i=0;$i<$theme_count;$i++)
											<span class="theme_element"> {{$theme[$i]}} </span>
										@endfor
									</div>-->
									<!-- <div class="dTourImgDot" style="display: ">
									  <span class="dot" onclick='currentSlide(1)'></span>
									  <span class="dot" onclick='currentSlide(2)'></span>
									  <span class="dot" onclick='currentSlide(3)'></span>
									  <span class="dot" onclick='currentSlide(4)'></span>
									  <span class="dot" onclick='currentSlide(5)'></span>
									  <span class="dot" onclick='currentSlide(6)'></span>
									</div> -->
									<div class="dView_gallery" id="addModal_d_gallery">View Gallery &#8594;</div>
							</div>
							<div class="dTourImgBoxTwo">
								<img src="{{ CustomHelpers::get_image_gallery($img->gallery_id,'image_main') }}" alt="tourimg-two">
							</div>
						</div>
						<!--Desktop Tour Image Ends-->