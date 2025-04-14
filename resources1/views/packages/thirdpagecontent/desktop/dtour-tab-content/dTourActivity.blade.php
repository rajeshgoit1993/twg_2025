									<!--Desktop Tour Tabs-Activity Starts-->
									<div class="dTourPkgDesc">
										<div class="dTourHgLhts">
											<h2>Tour Activity</h2>
											<div>
												<?php $tourdata=unserialize($details->tours); ?>
												@if(empty($tourdata))
												@else
												@foreach (unserialize($details->tours) as $t)
												@php $tour = CustomHelpers::get_tour_data($t) @endphp
												<div class="dTourActCont">
													<!-- <div class="dTourActImgBox">
														@if($tour->tour_image=="")
															@php
																$image="default_profile_image.png";
															@endphp
														@else
															@php
																$image=$tour->tour_image;
															@endphp
														@endif
														<img src="{{URL::to('/').'/public/uploads/tour_image/'.$image}}" >
													</div> -->
													<div class="dTourActImgBox">
													    @php
													        $tourImage = $tour->tour_image ?? 'default_profile_image.png';
													        $tourImagePath = public_path("uploads/tour_image/{$tourImage}");
													    @endphp

													    <img src="{{ asset(file_exists($tourImagePath) ? 'public/uploads/tour_image/'.$tourImage : 'public/uploads/default-img.webp') }}" alt="Tour-Image">
													</div>

													<div class="dTourActDesc">
														<h4>{{ $tour->activity }}</h4>
														<p>{{ $tour->desc }}</p>
													</div>
												</div>
												@endforeach
												@endif
											</div>
										</div>
									</div>
									<!--Desktop Tour Tabs-Activity Ends-->