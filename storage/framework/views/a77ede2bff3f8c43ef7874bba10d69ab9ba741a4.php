
            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php $location = unserialize($package->city); ?>
                
                <?php if($content_type == 'domestic'): ?>
                    <div class="dItemCard">
                        <input type="hidden" class="pack_id_list" name="pack_id_list_demostic[]" value="<?php echo e($package->id); ?>">

                        <?php 
                            $gallery_id = CustomHelpers::get_first_galleryid($package->id);
                            $packageUrl = url('/holidays/' . \Illuminate\Support\Str::slug($package->title) . '?package_id=' . CustomHelpers::custom_encrypt($package->id));

                            // Fetch the image URL
                            $imageUrl = CustomHelpers::get_image_gallery($gallery_id, 'thum_medium');

                            // Convert the URL to a correct relative file path
                            $relativePath = str_replace(url('public/'), '', $imageUrl); // Remove 'public/' prefix correctly
                            $relativePath = str_replace(asset('/'), '', $relativePath); // Remove asset() URL
                            $relativePath = ltrim($relativePath, '/'); // Ensure no leading slash

                            // Correct the file path for checking existence
                            $imagePath = public_path($relativePath);

                            // Check if the file exists, otherwise use the default image
                            $imageSrc = (!empty($imageUrl) && $imageUrl !== "0" && file_exists($imagePath)) 
                                ? $imageUrl 
                                : asset('public/uploads/default-img.webp');
                         ?>

                        <!-- check the file existence and path -->
                        <!-- <pre>
                            Image URL: <?php echo e($imageUrl); ?>

                            Relative Path: <?php echo e($relativePath); ?>

                            Image Path: <?php echo e($imagePath); ?>

                            File Exists: <?php echo e(file_exists($imagePath) ? 'Yes' : 'No'); ?>

                        </pre> -->

                        <a href="<?php echo e($packageUrl); ?>" target="_blank">
                            <div class="dItemCardImgCont">
                                <!-- <img class="lazy-load" data-src="<?php echo e($imageSrc); ?>" src="<?php echo e(asset('public/uploads/default-img.webp')); ?>" alt="<?php echo e($package->title ?? 'Package Image'); ?>"> -->
                                <img class="lazy-load" src="<?php echo e($imageSrc); ?>" alt="<?php echo e($package->title ?? 'Package Image'); ?>">
                            </div>

                            <div class="dItemCardFooter">
                                <div class="dItemCardTitle">
                                    <div class="dItemCardHeading">
                                        <h3><?php echo e($package->title); ?></h3>
                                    </div>
                                    <div class="dDaysBadge"><?php echo e($package->duration); ?>N / <?php echo e($package->duration + 1); ?>D</div>
                                </div>

                                <!-- duration wise destination -->
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
                                    <?php 
                                        $new_price = PackagePriceHelpers::get_new_pricing_data($package->id, date('Y-m-d'));
                                     ?>

                                    <?php if($new_price === 'na'): ?>
                                        <div>
                                            <p class="dItemPriceType_OnRequest"><span class="defaultCurrency">&nbsp;</span>On Request</p>
                                        </div>
                                    <?php elseif(is_array($new_price) && isset($new_price['actual_price'], $new_price['discount_price'])): ?>
                                        <div class="dItemValueWrapper">
                                            <?php if($new_price['actual_price'] == $new_price['discount_price']): ?>
                                                <div class="flexCenter">
                                                    <p class="dItemAcutalPrice defaultCurrency"><?php echo e($new_price['actual_price']); ?></p>
                                                    <p class="dItemPriceType">
                                                        <span class="dItemOfferPrice defaultCurrency"><?php echo e($new_price['discount_price']); ?></span> <?php echo e($package->Price_type); ?>

                                                    </p>
                                                </div>
                                            <?php else: ?>
                                                <div>
                                                    <p class="dItemAcutalPrice defaultCurrency"><?php echo e($new_price['actual_price']); ?></p>
                                                    <p class="dItemPriceType">
                                                        <span class="dItemOfferPrice defaultCurrency"><?php echo e($new_price['discount_price']); ?></span> <?php echo e($package->Price_type); ?>

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
                                                    <?php echo e(round($percentage)); ?>% Off
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="error">Price data unavailable</p>
                                    <?php endif; ?>
                                    <!--Price Box Ends-->

                                </div>
                            </div>
                        </a>
                    </div>

                    <?php elseif($content_type=='international'): ?>

                    <div class="dItemCard">
                        <input type="hidden" class="pack_id_list" name="pack_id_list[]"  value="<?php echo e($package->id); ?>">
                        <?php 
                            $gallery_id = CustomHelpers::get_first_galleryid($package->id);
                            $packageUrl = url('/holidays/' . \Illuminate\Support\Str::slug($package->title) . '?package_id=' . CustomHelpers::custom_encrypt($package->id));

                            // Fetch the image URL
                            $imageUrl = CustomHelpers::get_image_gallery($gallery_id, 'thum_medium');

                            // Convert the URL to a correct relative file path
                            $relativePath = str_replace(url('public/'), '', $imageUrl); // Remove 'public/' prefix correctly
                            $relativePath = str_replace(asset('/'), '', $relativePath); // Remove asset() URL
                            $relativePath = ltrim($relativePath, '/'); // Ensure no leading slash

                            // Correct the file path for checking existence
                            $imagePath = public_path($relativePath);

                            // Check if the file exists, otherwise use the default image
                            $imageSrc = (!empty($imageUrl) && $imageUrl !== "0" && file_exists($imagePath)) 
                                ? $imageUrl 
                                : asset('public/uploads/default-img.webp');
                         ?>

                        <!-- check the file existence and path -->
                        <!-- <pre>
                            Image URL: <?php echo e($imageUrl); ?>

                            Relative Path: <?php echo e($relativePath); ?>

                            Image Path: <?php echo e($imagePath); ?>

                            File Exists: <?php echo e(file_exists($imagePath) ? 'Yes' : 'No'); ?>

                        </pre> -->

                        <a href="<?php echo e($packageUrl); ?>" target="_blank">
                            <div class="dItemCardImgCont">
                                <!-- <img class="lazy-load" data-src="<?php echo e($imageSrc); ?>" src="<?php echo e(asset('public/uploads/default-img.webp')); ?>" alt="<?php echo e($package->title ?? 'Package Image'); ?>"> -->
                                <img class="lazy-load" src="<?php echo e($imageSrc); ?>" alt="<?php echo e($package->title ?? 'Package Image'); ?>">
                            </div>

                            <div class="dItemCardFooter">
                                <div class="dItemCardTitle">
                                    <div class="dItemCardHeading">
                                        <h3><?php echo e($package->title); ?></h3>
                                    </div>
                                    <div class="dDaysBadge"><?php echo e($package->duration); ?>N / <?php echo e($package->duration + 1); ?>D</div>
                                </div>

                                <!-- duration wise destination -->
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
                                    <?php 
                                        $new_price = PackagePriceHelpers::get_new_pricing_data($package->id, date('Y-m-d'));
                                     ?>

                                    <?php if($new_price === 'na'): ?>
                                        <div>
                                            <p class="dItemPriceType_OnRequest"><span class="defaultCurrency">&nbsp;</span>On Request</p>
                                        </div>
                                    <?php elseif(is_array($new_price) && isset($new_price['actual_price'], $new_price['discount_price'])): ?>
                                        <div class="dItemValueWrapper">
                                            <?php if($new_price['actual_price'] == $new_price['discount_price']): ?>
                                                <div class="flexCenter">
                                                    <p class="dItemAcutalPrice defaultCurrency"><?php echo e($new_price['actual_price']); ?></p>
                                                    <p class="dItemPriceType">
                                                        <span class="dItemOfferPrice defaultCurrency"><?php echo e($new_price['discount_price']); ?></span> <?php echo e($package->Price_type); ?>

                                                    </p>
                                                </div>
                                            <?php else: ?>
                                                <div>
                                                    <p class="dItemAcutalPrice defaultCurrency"><?php echo e($new_price['actual_price']); ?></p>
                                                    <p class="dItemPriceType">
                                                        <span class="dItemOfferPrice defaultCurrency"><?php echo e($new_price['discount_price']); ?></span> <?php echo e($package->Price_type); ?>

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
                                                    <?php echo e(round($percentage)); ?>% Off
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="error">Price data unavailable</p>
                                    <?php endif; ?>
                                    <!--Price Box Ends-->

                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>