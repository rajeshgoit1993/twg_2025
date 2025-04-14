	<!--Popular International Tour Packages Starts-->
	<div class="mBG">
		<div class="dPageContainer">
			<div class="dTrendingDestTtlBox">
				<h2>Popular International Tour Packages</h2>
				<p>Grab Upto 45% Off!</p>
			</div>
			<div class="ditemSlider dItemCardGap mobscroll scrollX" id="dynamic_pkg_add">
				@foreach($packages as $package)
					@php
						$location =unserialize($package->city);
					@endphp
					<div class="dItemCard">
						<input type="hidden" class="pack_id_list" name="pack_id_list[]"  value="{{ $package->id }}">
						@php
							$gallery_id = CustomHelpers::get_first_galleryid($package->id);
						    $packageUrl = url('/holidays/' . \Illuminate\Support\Str::slug($package->title) . '?package_id=' . CustomHelpers::custom_encrypt($package->id));

						    // Fetch the image URL
						    $imageUrl = CustomHelpers::get_image_gallery($gallery_id, 'thum_medium');

						    // Convert the URL to a correct relative file path
						    $relativePath = str_replace(url('public/'), '', $imageUrl); // Remove the 'public/' prefix correctly
						    $relativePath = str_replace(asset('/'), '', $relativePath); // Remove asset() URL
						    $relativePath = ltrim($relativePath, '/'); // Ensure no leading slash

						    // Correct the file path for checking existence
						    $imagePath = public_path($relativePath);
						    
						    // Check if the file exists, otherwise use the default image
						    $imageSrc = (!empty($imageUrl) && $imageUrl !== "0" && file_exists($imagePath)) ? $imageUrl : asset('public/uploads/default-img.webp');
						@endphp

						<!-- check the file existence and path -->
						<!-- <pre>
						    Image URL: {{ $imageUrl }}
						    Relative Path: {{ $relativePath }}
						    Image Path: {{ $imagePath }}
						    File Exists: {{ file_exists($imagePath) ? 'Yes' : 'No' }}
						</pre> -->

						<a href="{{ $packageUrl }}" target="_blank">
						    <div class="dItemCardImgCont">
						        <img class="lazy-load" data-src="{{ $imageSrc }}" alt="{{ isset($package->title) ? e($package->title) : 'Package Image' }}">
						    </div>

							<div class="dItemCardFooter">
								<div class="dItemCardTitle">
									<div class="dItemCardHeading">
										<h3>{{ $package->title }}</h3>
									</div>
									<div class="dDaysBadge">{{ $package->duration }}N / {{ $package->duration + 1 }}D</div>
								</div>

								<!-- destination wise duration -->
								<div class="dDestinationWrapper">
								    <div class="flexCenter scrollContainer">
								    	<?php
											// Unserialize city and days data safely
											$city1 = unserialize($package->city);
											$days = unserialize($package->days);

											// Check if both are valid arrays
											if (is_array($city1) && is_array($days)) {
											    $city1_count = count($city1);
											    $i = 0;

											    foreach ($city1 as $row => $col) {
											        // Escape output for security
											        $dayCount = htmlspecialchars($days[$row]);
											        $cityName = htmlspecialchars($city1[$row]);

											        echo "<span class='dDestNights'>{$dayCount}N&nbsp;</span>";
											        echo "<span class='dCityName'>{$cityName}</span>";

											        // Add arrow if it's not the last city
											        if ($i < ($city1_count - 1)) {
											            echo "<span class='dDestSpaceIcon'>&nbsp;&rarr;&nbsp;</span>";
											        }

											        // Add line break every 3 items for better structure
											        if (($i + 1) % 3 === 0) {
											            echo "<br>";
											        }

											        $i++;
											    }
											} else {
											    echo "Duration loading...";
											}
										?>
								    </div>
								</div>

								<div class="dPriceWrapper">
									<div>
										<p class="dPriceHead">Package</p>
										<p class="dPriceHead">Starting Price</p>
									</div>

									<!--Price Box Starts-->
									@php
										$new_price = PackagePriceHelpers::get_new_pricing_data($package->id, date('Y-m-d'));
									@endphp

									@if($new_price === 'na')
									    <div>
									        <p class="dItemPriceType_OnRequest"><span class="defaultCurrency">&nbsp;</span>On Request</p>
									    </div>
									@elseif(is_array($new_price) && isset($new_price['actual_price'], $new_price['discount_price']))
									    <div class="dItemValueWrapper">
									        @if($new_price['actual_price'] == $new_price['discount_price'])
									            <div class="flexCenter">
									                <p class="dItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
									                <p class="dItemPriceType">
									                	<span class="dItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $package->Price_type }}
									                </p>
									            </div>
									        @else
									            <div>
									                <p class="dItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
									                <p class="dItemPriceType">
									                	<span class="dItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $package->Price_type }}
									                </p>
									                <p class="dItemPriceSubTag">*Excluding applicable taxes</p>
									                <span class="dItemOfferTag">
									                <!-- <?php
									                    $tourdiscount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
									                    $percentage = $tourdiscount / $new_price['actual_price'] * 100;
									                ?> -->

									                <!-- Prevent Division by Zero in Discount Calculation -->
									                <?php
													    $tourdiscount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
													    $percentage = ($new_price['actual_price'] > 0) ? ($tourdiscount / $new_price['actual_price'] * 100) : 0;
													?>
													{{ round($percentage) }}% Off
									                </span>
									            </div>
									        @endif
									    </div>
									@else
									    <p class="error">Price data unavailable</p>
									@endif
									<!--Price Box Ends-->
								</div>
							</div>
						</a>
					</div>
				@endforeach
			</div>
			<div ></div>

			<!-- <div class="load-more-packages international-packages textCenter">
			    <button type="button" class="PACKAGES add_more_pkg btn-desktop-load-more appendTop15 appendBtm20" content_type="international">See more International Tour Packages</button>
			</div> -->

			<div class="textCenter apndTop15 apndBtm20">
			    <button type="button" class="add_more_pkg btn-desktop-load-more" content_type="international">See more International Tour Packages</button>
			</div>

			<!---->
			<div id="row_add">
				<!-- more content from frontcontroller -> add_package -->
			</div>
			<!---->

		</div>
	</div>
	<!--Popular International Tour Packages Ends-->