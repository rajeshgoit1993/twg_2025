<!-- Ensure this is wrapped in a layout or has proper HTML structure -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($data1->title ?? 'Quotation'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body>

<?php 
    // Helper function to safely unserialize data
    function safeUnserialize($data) {
        if (!is_string($data) || empty($data) || $data === 'N;') {
            return [];
        }
        $result = @unserialize($data);
        return $result === false ? [] : $result;
    }

    // Simplified get_price_part_seperate function
    function get_price_part_seperate($price, $adult, $extra_adult, $child_with_bed, $child_without_bed, $infant, $solo_traveller) {
        $price_data = safeUnserialize($price);
        $total_travelers = (int)$adult + (int)$extra_adult + (int)$child_with_bed + (int)$child_without_bed + (int)$infant + (int)$solo_traveller;
        $total_travelers = $total_travelers == 0 ? 1 : $total_travelers;

        if (!is_array($price_data) || empty($price_data)) {
            $price = is_numeric($price) ? (float)$price : 0;
            $price_per_traveler = $price / $total_travelers;

            $query_paytotal_adult = round($price_per_traveler * (int)$adult);
            $query_paytotal_exadult = round($price_per_traveler * (int)$extra_adult);
            $query_paytotal_childbed = round($price_per_traveler * (int)$child_with_bed);
            $query_paytotal_childwbed = round($price_per_traveler * (int)$child_without_bed);
            $query_paytotal_infant = round($price_per_traveler * (int)$infant);
            $query_paytotal_single = round($price_per_traveler * (int)$solo_traveller);

            $query_pricetopay_adult = $query_paytotal_adult + $query_paytotal_exadult + $query_paytotal_childbed + $query_paytotal_childwbed + $query_paytotal_infant + $query_paytotal_single;

            return [
                'query_pricetopay_adult' => $query_pricetopay_adult,
                'query_total_group' => $query_pricetopay_adult,
                'query_total_discount_group' => 0,
                'query_total_gst_group' => 0,
                'query_total_tcs_group' => 0,
                'query_total_pg_group' => 0,
            ];
        }
        return $price_data;
    }
 ?>

<div class="tourQuoteWebHeadCont">
    <p>Dear <?php echo e($data1->name ?? 'Customer'); ?>,</p>
    <?php if(!empty($data1->quote_header)): ?>
        <?php
            $header_id = $data1->quote_header;
            $header_data = DB::table('quotation_header')->where('id', $header_id)->first();
        ?>
        <?php if($header_data): ?>
            <?php echo $header_data->header_desc ?? ''; ?>

        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Title & Services -->
<div class="tourQuoteSummaryCont">
    <div>
        <h4 class="tourQuoteTitle"><?php echo e($data1->title ?? 'Unnamed Package'); ?></h4>
        <h5 class="tourQuoteDaysBadge"><?php echo e(($data1->duration ?? 1) - 1); ?> Nights / <?php echo e($data1->duration ?? 1); ?> Days</h5>
    </div>
    <div class="touQuoteBookCont">
        <div>
            <h5 class="tourQuoteServiceTitle">Included in this package</h5>
            <div id="mobscroll" class="mobscroll overflowX"></div>
            <div class="flexCenter">
                <?php $package_service = safeUnserialize($data1->package_service); ?>
                <?php if(!empty($package_service) && is_array($package_service)): ?>
                    <?php $__currentLoopData = $package_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="tourQteSvcIcns">
                            <div class="tourQteSvcIcnImg">
                                <img src="<?php echo e(url('/public/uploads/icons/' . (class_exists('CustomHelpers') ? CustomHelpers::getimagename($icon, 'rt_icons', 'icon') : $icon))); ?>" alt="img" onerror="this.style.display='none';">
                            </div>
                            <div class="tourQteSvcTtl"><?php echo e($icon); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <?php echo $__env->make("query.quotation_webpage.accept", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php
                $price_data_first = get_price_part_seperate(
                    $data1->price ?? 0,
                    $data1->adult ?? 0,
                    $data1->extra_adult ?? 0,
                    $data1->child_with_bed ?? 0,
                    $data1->child_without_bed ?? 0,
                    $data1->infant ?? 0,
                    $data1->solo_traveller ?? 0
                );
            ?>
        </div>
    </div>
</div>

<!-- Departure City, Tour Date, Pricing & Quote Validity -->
<div class="tourQuoteDatePricingCont">
    <div class="makeflex">
        <!-- Departure City -->
        <div class="tourQuoteCityBox">
            <h4 class="tourQuoteCityBoxHead">DEPARTURE CITY</h4>
            <h3 class="tourQuoteCityName"><?php echo e($data1->sourcecity ?? 'N/A'); ?></h3>
        </div>

        <!-- Tour Date -->
        <div class="tourQuoteDateBox">
            <h4 class="tourQuoteDateBoxHead">TOUR DATE</h4>
            <?php
                // Use tour_date directly from quote table, assume YYYY-MM-DD format
                $tourDate = $data1->tour_date ?? date('Y-m-d'); // Fallback to current date if null
                // Ensure it’s a valid date and convert to display format
                $datefrom_print = date("d M Y", strtotime($tourDate));

                // Calculate stop date using duration
                $to_days = ($data1->duration ?? 1) - 1; // Subtract 1 to exclude the start day if duration includes it
                $stop_date = date('Y-m-d', strtotime($tourDate . ' +' . $to_days . ' days'));
                $stop_date_print = date("d M Y", strtotime($stop_date));
            ?>
            <h3 class="tourQuoteDepDate"><?php echo e($datefrom_print); ?></h3>
            <p class="tourQuoteDateBoxHead appendTop10">TO</p>
            <p class="tourQuoteRetDate"><?php echo e($stop_date_print); ?></p>
        </div>

        <!-- Pricing -->
        <div class="tourQuotePriceBox">
            <?php if(($data1->price_type ?? '') === "Per Person"): ?>
                <div>
                    <?php 
                        $total_people = ($data1->adult ?? 0) + ($data1->extra_adult ?? 0) + 
                                       ($data1->child_with_bed ?? 0) + ($data1->child_without_bed ?? 0) + 
                                       ($data1->infant ?? 0) + ($data1->solo_traveller ?? 0); 
                        $total_people = $total_people ?: 1; // Avoid division by zero
                    ?>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>
                        <p class="tourQuotePriceValue defaultCurrency">
                            <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_group'] / $total_people)) : round($price_data_first['query_total_group'] / $total_people)); ?>

                        </p>
                    </div>
                    <div class="tourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceBoxSubHead">Discount (-)</p>
                        <p class="tourQuotePriceValue">
                            <span class="tourQuoteDefaultCurency"> </span>
                            <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_discount_group'] / $total_people)) : round($price_data_first['query_total_discount_group'] / $total_people)); ?>

                        </p>
                    </div>
                    <?php if(round($price_data_first['query_total_gst_group'] / $total_people) > 0): ?>
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">GST <?php if(isset($price_data_first['query_gst_curr']) && $price_data_first['query_gst_curr'] == 2): ?> (<?php echo e($price_data_first['gst_percentage'] ?? 0); ?>%) <?php endif; ?></p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group'] / $total_people)) : round($price_data_first['query_total_gst_group'] / $total_people)); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                    <?php if(round($price_data_first['query_total_tcs_group'] / $total_people) > 0): ?>
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">TCS <?php if(isset($price_data_first['query_tcs_curr']) && $price_data_first['query_tcs_curr'] == 2): ?> (<?php echo e($price_data_first['tcs_percentage'] ?? 0); ?>%) <?php endif; ?></p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group'] / $total_people)) : round($price_data_first['query_total_tcs_group'] / $total_people)); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                    <?php if(round($price_data_first['query_total_pg_group'] / $total_people) > 0): ?>
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">PG <?php if(isset($price_data_first['pg_charges']) && $price_data_first['pg_charges'] == 2): ?> (<?php echo e($price_data_first['pgcharges_percentage'] ?? 0); ?>%) <?php endif; ?></p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group'] / $total_people)) : round($price_data_first['query_total_pg_group'] / $total_people)); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                    <div class="tourQuotePriceSeparator"></div>
                    <div class="flexBetween">
                        <div>
                            <p class="tourQuotePriceTotal">Grand Total</p>
                            <p class="tourQuotePriceTagline">( <?php echo e($data1->anything ?? 'N/A'); ?> )</p>
                        </div>
                        <div>
                            <p class="tourQuotePriceTotalValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult'] / $total_people)) : round($price_data_first['query_pricetopay_adult'] / $total_people)); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php elseif(($data1->price_type ?? '') === "Group Price"): ?>
                <div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>
                        <p class="tourQuotePriceValue">
                            <span class="tourQuoteDefaultCurency"> </span>
                            <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency($price_data_first['query_total_group']) : $price_data_first['query_total_group']); ?>

                        </p>
                    </div>
                    <div class="tourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceBoxSubHead">Discount (-)</p>
                        <p class="tourQuotePriceValue">
                            <span class="tourQuoteDefaultCurency"> </span>
                            <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']) : $price_data_first['query_total_discount_group']); ?>

                        </p>
                    </div>
                    <?php if(round($price_data_first['query_total_gst_group']) > 0): ?>
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">GST <?php if(isset($price_data_first['query_gst_curr']) && $price_data_first['query_gst_curr'] == 2): ?> (<?php echo e($price_data_first['gst_percentage'] ?? 0); ?>%) <?php endif; ?></p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group'])) : round($price_data_first['query_total_gst_group'])); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                    <?php if(round($price_data_first['query_total_tcs_group']) > 0): ?>
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">TCS <?php if(isset($price_data_first['query_tcs_curr']) && $price_data_first['query_tcs_curr'] == 2): ?> (<?php echo e($price_data_first['tcs_percentage'] ?? 0); ?>%) <?php endif; ?></p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group'])) : round($price_data_first['query_total_tcs_group'])); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                    <?php if(round($price_data_first['query_total_pg_group']) > 0): ?>
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">PG <?php if(isset($price_data_first['pg_charges']) && $price_data_first['pg_charges'] == 2): ?> (<?php echo e($price_data_first['pgcharges_percentage'] ?? 0); ?>%) <?php endif; ?></p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group'])) : round($price_data_first['query_total_pg_group'])); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                    <div class="tourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceTotal">Grand Total</p>
                        <p class="tourQuotePriceTotalValue">
                            <span class="tourQuoteDefaultCurency"> </span>
                            <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult'])) : round($price_data_first['query_pricetopay_adult'])); ?>

                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quote Validity -->
    <?php if(($data1->validity_show_on_frontend ?? 'No') === 'No' && !empty($data1->quote_validaty)): ?>
        <div class="tourQuoteValidity">
            QUOTE VALIDITY - <?php echo e(date("d M Y", strtotime(str_replace('/', '-', $data1->quote_validaty)))); ?>

            <?php if(($data1->validity_time ?? '23:59:59') !== '23:59:59'): ?>
                <?php echo e($data1->validity_time); ?>

            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="tourQuoteValidity">Pay Immediately</div>
    <?php endif; ?>
</div>

<!-- Transport -->
<?php $flight_detail = safeUnserialize($data1->flight); ?>
<?php if(is_array($flight_detail) && !empty($flight_detail) && isset($flight_detail['flightOption']) && $flight_detail['flightOption'] == 1): ?>
    <div class="tourQuoteFlightCont">
        <div>
            <h3 class="tourQuoteFlightHead">FLIGHT DETAILS</h3>
        </div>
        <div>
            <!-- Upward Flight -->
            <div class="tourQuoteOnwardFlightBox">
                <div class="flexCenter apndBtm10">
                    <div class="appendRight20">
                        <?php if(isset($flight_detail['origin']) && $flight_detail['origin'] == 0): ?>
                            <span class="flightCityName"><?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'previous_data') : 'N/A'); ?></span>
                        <?php endif; ?>
                        <span class="flightCityName">-</span>
                        <?php if(!empty($flight_detail['dest'])): ?>
                            <span class="flightCityName"><?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'previous_data') : 'N/A'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if(isset($flight_detail['onwarddate']) && !empty($flight_detail['onwarddate'])): ?>
                            <span class="flightDate"><?php echo e(date('d M Y', strtotime(str_replace('/', '-', $flight_detail['onwarddate'])))); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="onwardFlightBox">
                    <div class="flexCenter appendBottom15">
                        <span class="flightStop"><?php echo e($flight_detail['numberstop'] ?? ''); ?></span>
                        <div class="classSeparator"></div>
                        <span class="flightClass"><?php echo e(isset($flight_detail['cabin']) && class_exists('CustomHelpers') ? CustomHelpers::get_flight_class_name($flight_detail['cabin']) : ''); ?></span>
                    </div>
                    <div class="flexCenter appendLeft20">
                        <div class="appendRight10">
                            <div class="airlineLogoBox">
                                <img src="<?php echo e(url('/resources/assets/frontend/images/icon/airlineIndigo.png')); ?>" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '✈');">
                            </div>
                        </div>
                        <div class="appendRight20 W120">
                            <p class="flightName"><?php echo e($flight_detail['name'] ?? ''); ?></p>
                            <p class="flightNumber"><?php echo e($flight_detail['no'] ?? ''); ?></p>
                        </div>
                        <div class="W100">
                            <p class="flightTiming">
                                <?php echo e(!empty($flight_detail['dhours']) ? str_pad($flight_detail['dhours'], 2, '0', STR_PAD_LEFT) : '00'); ?>:<?php echo e(isset($flight_detail['ddmins']) ? str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT) : '00'); ?>

                            </p>
                            <p class="flightCity"><?php echo e(!empty($flight_detail['origin']) && class_exists('CustomHelpers') ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'last_str')) : ''); ?></p>
                        </div>
                        <div class="flightDurationCont">
                            <p class="flightDuration">
                                <?php echo e(isset($flight_detail['duration_hours']) ? $flight_detail['duration_hours'] . 'h ' : ''); ?><?php echo e(isset($flight_detail['duration_dmins']) ? $flight_detail['duration_dmins'] . 'm' : ''); ?>

                            </p>
                            <div class="flexCenter">
                                <i class="fa-plane" aria-hidden="true"></i>
                                <div class="flightPathWay"></div>
                                <i class="fa-map-marker" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="W100">
                            <p class="flightTiming">
                                <?php echo e(!empty($flight_detail['ahours']) ? str_pad($flight_detail['ahours'], 2, '0', STR_PAD_LEFT) : '00'); ?>:<?php echo e(isset($flight_detail['damins']) ? str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT) : '00'); ?>

                            </p>
                            <p class="flightCity"><?php echo e(!empty($flight_detail['dest']) && class_exists('CustomHelpers') ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'last_str')) : ''); ?></p>
                        </div>
                    </div>
                    <p class="baggageTitle">Baggage info</p>
                    <div class="flexCenter">
                        <span class="baggageSubTitle color4A">Cabin: </span>
                        <span class="baggageSubTitle"><?php echo e($flight_detail['baggage'] ?? ''); ?></span>
                        <div class="baggageSeparator"></div>
                        <span class="baggageSubTitle color4A">Check in: </span>
                        <span class="baggageSubTitle"><?php echo e($flight_detail['cbaggage'] ?? ''); ?></span>
                    </div>
                </div>
            </div>

            <!-- Return Flight -->
            <div class="tourQuoteReturnFlightBox">
                <div class="flexCenter apndBtm10">
                    <div class="appendRight20">
                        <?php if(!empty($flight_detail['dOrigin'])): ?>
                            <span class="flightCityName"><?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'previous_data') : 'N/A'); ?></span>
                        <?php endif; ?>
                        <span class="flightCityName">-</span>
                        <?php if(!empty($flight_detail['ddest'])): ?>
                            <span class="flightCityName"><?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'previous_data') : 'N/A'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if(isset($flight_detail['downwarddate']) && !empty($flight_detail['downwarddate'])): ?>
                            <span class="flightDate"><?php echo e(date('d M Y', strtotime(str_replace('/', '-', $flight_detail['downwarddate'])))); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="returnFlightBox">
                    <div class="flexCenter appendBottom15">
                        <span class="flightStop"><?php echo e($flight_detail['numberstop'] ?? ''); ?></span>
                        <div class="classSeparator"></div>
                        <span class="flightClass"><?php echo e(isset($flight_detail['dcabin']) && class_exists('CustomHelpers') ? CustomHelpers::get_flight_class_name($flight_detail['dcabin']) : ''); ?></span>
                    </div>
                    <div class="flexCenter appendLeft20">
                        <div class="appendRight10">
                            <div class="airlineLogoBox">
                                <img src="<?php echo e(url('/resources/assets/frontend/images/icon/airlineIndigo.png')); ?>" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '✈');">
                            </div>
                        </div>
                        <div class="appendRight20 W120">
                            <p class="flightName"><?php echo e($flight_detail['name'] ?? ''); ?></p>
                            <p class="flightNumber"><?php echo e($flight_detail['dno'] ?? ''); ?></p>
                        </div>
                        <div class="W100">
                            <p class="flightTiming">
                                <?php echo e(!empty($flight_detail['ddhours']) ? str_pad($flight_detail['ddhours'], 2, '0', STR_PAD_LEFT) : '00'); ?>:<?php echo e(isset($flight_detail['ddmins']) ? str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT) : '00'); ?>

                            </p>
                            <p class="flightCity"><?php echo e(!empty($flight_detail['dOrigin']) && class_exists('CustomHelpers') ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'last_str')) : ''); ?></p>
                        </div>
                        <div class="flightDurationCont">
                            <p class="flightDuration">
                                <?php echo e(isset($flight_detail['return_duration_hours']) ? $flight_detail['return_duration_hours'] . 'h ' : ''); ?><?php echo e(isset($flight_detail['return_duration_mins']) ? $flight_detail['return_duration_mins'] . 'm' : ''); ?>

                            </p>
                            <div class="flexCenter">
                                <i class="fa-plane" aria-hidden="true"></i>
                                <div class="flightPathWay"></div>
                                <i class="fa-map-marker" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="W100">
                            <p class="flightTiming">
                                <?php echo e(!empty($flight_detail['dahours']) ? str_pad($flight_detail['dahours'], 2, '0', STR_PAD_LEFT) : '00'); ?>:<?php echo e(isset($flight_detail['damins']) ? str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT) : '00'); ?>

                            </p>
                            <p class="flightCity"><?php echo e(!empty($flight_detail['ddest']) && class_exists('CustomHelpers') ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'last_str')) : ''); ?></p>
                        </div>
                    </div>
                    <p class="baggageTitle">Baggage info</p>
                    <div class="flexCenter">
                        <span class="baggageSubTitle color4A">Cabin: </span>
                        <span class="baggageSubTitle"><?php echo e($flight_detail['baggage'] ?? ''); ?></span>
                        <div class="baggageSeparator"></div>
                        <span class="baggageSubTitle color4A">Check in: </span>
                        <span class="baggageSubTitle"><?php echo e($flight_detail['cbaggage'] ?? ''); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Transfers -->
<?php $transfers = safeUnserialize($data1->transfers); ?>
<?php if(!empty($transfers) && is_array($transfers) && isset($transfers[0]['mode_title']) && $transfers[0]['mode_title'] !== ''): ?>
    <div class="tourQuoteTransferCont">
        <div>
            <h3 class="tourQuoteTransferHead">TRANSFERS</h3>
        </div>
        <?php $a = 0; ?>
        <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if(isset($col['transport_type']) && isset($col['transfers_type'])): ?>
                <?php
                    $transfers_data = DB::table('rt_transfer_list')
                        ->where([['transport_type', '=', $col['transport_type']], ['title', '=', $col['transfers_type']]])
                        ->first();
                ?>
                <div class="tourQuoteTransferBox">
                    <div class="tourQuoteTransferTitle"><?php echo e($col['mode_title']); ?></div>
                    <div class="tourQuoteTransferDescBox">
                        <div class="makeflex">
                            <div class="transferImageBox">
                                <?php if($transfers_data && !empty($transfers_data->transfer_image) && file_exists(public_path('uploads/transfer_image/' . $transfers_data->transfer_image))): ?>
                                    <img class="mtransferImageType" src="<?php echo e(url('/public/uploads/transfer_image/' . $transfers_data->transfer_image)); ?>" loading="lazy">
                                <?php else: ?>
                                    <p>Image not available</p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div class="transferDescTopSection">
                                    <h4 class="transferTitle"><?php echo e($col['mode_title']); ?></h4>
                                    <h2 class="transportType"><?php echo e($transfers_data->transfer_type ?? ''); ?></h2>
                                </div>
                                <div class="flexCenter">
                                    <div class="transferVehicleCont">
                                        <h4 class="transferHead">VEHICLE TYPE</h4>
                                        <h5 class="transferSubHead"><?php echo e($transfers_data->vehicle_type ?? ''); ?></h5>
                                    </div>
                                    <div class="transferDurationCont">
                                        <h4 class="transferHead">DURATION</h4>
                                        <h5 class="transferSubHead"><?php echo e($transfers_data->duration ?? ''); ?></h5>
                                    </div>
                                    <div>
                                        <h4 class="transferHead">INCLUDES</h4>
                                        <h5 class="transferSubHead"><?php echo e($transfers_data->includes ?? ''); ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $a++; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </div>
<?php endif; ?>

<!-- Accommodation -->
<div class="tourQuoteHotelCont">
    <h3 class="tourQuoteHotelHead">ACCOMMODATION</h3>
    <?php
        $acco = safeUnserialize($data1->accommodation); 
        $i = 1;
        
        $tourDate = $data1->tour_date ?? '1970-01-01'; 
    ?>
    <?php if(!empty($acco) && is_array($acco)): ?>
        <?php $__currentLoopData = $acco; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acco_data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="tourQuoteHotelBox">
                <div class="tourQuoteHotelTitle">
                    <?php
                        $cityName = class_exists('CustomHelpers') 
                            ? CustomHelpers::get_master_table_data('city', 'id', $acco_data["city"] ?? 0, 'name') 
                            : 'N/A';
                    ?>
                    <?php echo e($cityName); ?>

                    <?php if($i > 1): ?><br><?php endif; ?>
                </div>
                <div class="tourQuoteHotelDescBox">
                    <div class="makeflex">
                        <div class="hotelImageBox">
                            <?php if(isset($acco_data["hotel"]) && !empty($acco_data["hotel"]) && $acco_data["hotel"] !== "other"): ?>
                                <img src="<?php echo e(url('/public/uploads/package_hotel/' . (class_exists('CustomHelpers') ? CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image') : 'default.jpg'))); ?>" alt="img">
                            <?php else: ?>
                                <img src="<?php echo e(url('/public/uploads/no-image.png')); ?>" alt="img">
                            <?php endif; ?>
                        </div>
                        <div class="hotelDescBox">
                            <div class="hotelTopSection">
                                <div class="hotelType">Hotel</div>
                                <div class="flexCenter">
                                    <div class="tourHotelDtls">
                                        <div>
                                            <h5 class="hotelName">
                                                <?php if(isset($acco_data["hotel"]) && !empty($acco_data["hotel"]) && $acco_data["hotel"] !== "other"): ?>
                                                    <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::getpackagerecord($acco_data["hotel"], 'package_hotel', 'hotelname') : 'N/A'); ?>

                                                <?php elseif(isset($acco_data["other_hotel"]) && !empty($acco_data["other_hotel"])): ?>
                                                    <?php echo e($acco_data["other_hotel"]); ?>

                                                <?php endif; ?>
                                            </h5>
                                        </div>
                                        <div class="hotelStarRating">
                                            <?php if(isset($acco_data["star"]) && !empty($acco_data["star"]) && $acco_data["star"] !== "other"): ?>
                                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_star_rating($acco_data["star"]) : 'N/A'); ?>

                                            <?php elseif(isset($acco_data["star_other"]) && !empty($acco_data["star_other"])): ?>
                                                <?php echo e(class_exists('CustomHelpers') ? CustomHelpers::get_star_rating($acco_data["star_other"]) : 'N/A'); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="hotelCityName"><?php echo e($cityName); ?></div>
                            </div>
                            <div class="HotelFooter">
                                <?php
                                    $day1 = 0; // Offset for check-in
                                    $day = 0;  // Offset for check-out
                                    if (isset($acco_data["night"]) && !empty($acco_data["night"]) && is_array($acco_data["night"])) {
                                        // Assuming night[0] is the start offset and the last value is the total nights
                                        $day1 = (int)filter_var($acco_data["night"][0] ?? 0, FILTER_SANITIZE_NUMBER_INT);
                                        $day1 = $day1 - 1; // Adjust for correct offset (if needed)
                                        $day = (int)filter_var(end($acco_data["night"]) ?? 0, FILTER_SANITIZE_NUMBER_INT);
                                    }

                                    // Use tour_date from quote table as the base date
                                    $checkin_date = date('Y-m-d', strtotime($tourDate . '+' . $day1 . ' days'));
                                    $checkin_date_print = date("d M Y", strtotime($checkin_date));
                                    $checkout_date = date('Y-m-d', strtotime($tourDate . '+' . $day . ' days'));
                                    $checkout_date_print = date("d M Y", strtotime($checkout_date));

                                    
                                    $date1 = date_create($checkin_date);
                                    $date2 = date_create($checkout_date);
                                    $diff = date_diff($date1, $date2);
                                ?>
                                <div class="makeflex appendBottom20">
                                    <div class="hotelDaysBadge">
                                        <h5 class="hoteDaysBadge_heading">NO OF NIGHTS</h5>
                                        <h5 class="hotelDaysBadge_nightCount">
                                            <?php if($diff->format("%a") > 1): ?> <?php echo e($diff->format("%a Nights")); ?>

                                            <?php else: ?> <?php echo e($diff->format("%a Night")); ?>

                                            <?php endif; ?>
                                        </h5>
                                    </div>
                                    <div class="hotelCheckInOut">
                                        <div class="hotelCheckInCont">
                                            <p class="hotelCheckInCont_heading">CHECK-IN</p>
                                            <p class="hotelCheckInCont_date"><?php echo e($checkin_date_print); ?></p>
                                        </div>
                                        <div class="hotelCheckOutCont">
                                            <p class="hotelCheckOutCont_heading">CHECKOUT</p>
                                            <p class="hotelCheckOutCont_date"><?php echo e($checkout_date_print); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flexCenterWU">
                                    <div class="hotelRoomCont">
                                        <p class="hotelRoomCont_heading">ROOM TYPE</p>
                                        <?php if(!empty($acco_data["category"])): ?>
                                            <p class="hotelRoomCont_type"><?php echo e($acco_data["category"]); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty($acco_data["hotel_link"])): ?>
                                        <div class="hotelWebCont">
                                            <p class="hotelWebCont_heading">HOTEL WEBSITE</p>
                                            <p class="hotelWebCont_name"><?php echo e($acco_data["hotel_link"]); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    <?php else: ?>
        <p>No accommodation data available.</p>
    <?php endif; ?>
</div>

<!-- Inclusions & Exclusions -->
<?php if((!empty($data1->inclusions) && $data1->inclusions !== "N;") || (!empty($data1->exclusions) && $data1->exclusions !== "N;")): ?>
    <div class="tourQuoteItineraryCont">
        <div>
            <h3 class="tourQuoteItineraryHead">INCLUSIONS & EXCLUSIONS</h3>
        </div>
        <div class="tourQuoteIncBox">
            <!-- Inclusions Section -->
            <?php if(!empty($data1->inclusions) && $data1->inclusions !== "N;"): ?>
                <div class="tourQuoteInclusions">
                    <h4 class="tourQuoteinclusionHeading">Inclusions</h4>
                    <div class="paddingTop10">
                        <?php 
                            $quote_inc = safeUnserialize($data1->inclusions); 
                        ?>
                        <?php if(!empty($quote_inc) && is_array($quote_inc)): ?>
                            <?php $__currentLoopData = $quote_inc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inclusion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <div class="tourQuoteUnlistedItem">
                                    <ul>
                                        <li><?php echo e($inclusion ?? 'Not Specified'); ?></li>
                                    </ul>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php else: ?>
                            <p>No valid inclusions data available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Exclusions Section -->
            <?php if(!empty($data1->exclusions) && $data1->exclusions !== "N;"): ?>
                <div class="tourQuoteExclusions">
                    <h4 class="tourQuoteExclusionHeading">Exclusions</h4>
                    <div class="paddingTop10">
                        <?php 
                            $quote_exc = safeUnserialize($data1->exclusions); 
                        ?>
                        <?php if(!empty($quote_exc) && is_array($quote_exc)): ?>
                            <?php $__currentLoopData = $quote_exc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exclusion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <div class="tourQuoteUnlistedItem">
                                    <ul>
                                        <li><?php echo e($exclusion ?? 'Not Specified'); ?></li>
                                    </ul>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php else: ?>
                            <p>No valid exclusions data available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <p>No inclusions or exclusions data available for this quote.</p>
<?php endif; ?>

<!-- Overview -->
<?php if(!empty($data1->description) || !empty($data1->highlights)): ?>
    <div class="tourQuoteItineraryCont">
        <div>
            <h3 class="tourQuoteItineraryHead">Tour Overview</h3>
        </div>
        <div class="tourQuoteOverviewBox">
            <?php if(!empty($data1->description)): ?>
                <div class="tourQuoteInclusions">
                    <h4 class="tourQuoteinclusionHeading">Add-On Services</h4>
                    <div class="paddingTop10"><?php echo $data1->description; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($data1->highlights)): ?>
                <div class="tourQuoteExclusions">
                    <h4 class="tourQuoteExclusionHeading">Tour Highlights</h4>
                    <div class="paddingTop10"><?php echo $data1->highlights; ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Visa Policy -->
<?php if(($data1->visa ?? 0) == 1 && !empty($data1->visa_p) && $data1->visa_p !== "N;"): ?>
    <div class="tourQuoteVisaPolicyCont">
        <div>
            <h3 class="tourQuoteVisaPolicyHead">VISA POLICY</h3>
        </div>
        <div class="tourQuoteVisaPolicyBox">
            <?php $v_policy = safeUnserialize($data1->visa_p); ?>
            <?php if(!empty($v_policy) && is_array($v_policy)): ?>
                <?php $__currentLoopData = $v_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="tourQuoteVisa">
                        <div><?php echo class_exists('CustomHelpers') ? CustomHelpers::get_visa_policy($v) : $v; ?></div>
                    </div>
                    <div class="tourQuoteVisaPolicySeparator"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
            <?php if(!empty(trim($data1->visa_policies ?? ''))): ?>
                <div class="tourQuoteVisaAddPolicy"><?php echo e($data1->visa_policies); ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Booking & Cancellation Policy -->
<?php if((!empty($data1->payment_p) && $data1->payment_p !== "N;") || (!empty($data1->can_p) && $data1->can_p !== "N;")): ?>
    <div class="tourQuoteBookPolicyCont">
        <div>
            <h3 class="tourQuoteBookPolicyHead">BOOKING AND CANCELLATION POLICY</h3>
        </div>
        <div class="tourQuoteBookPolicyBox">
            <?php if(!empty($data1->payment_p) && $data1->payment_p !== "N;"): ?>
                <?php $p_policy = safeUnserialize($data1->payment_p); ?>
                <?php if(!empty($p_policy) && is_array($p_policy)): ?>
                    <?php $__currentLoopData = $p_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="tourQuoteBooking">
                            <h4 class="tourQuoteBookHeading">Booking Policy</h4>
                            <div><?php echo class_exists('CustomHelpers') ? CustomHelpers::get_payment_policy($v) : $v; ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
                <?php if(!empty(trim($data1->payment_policy ?? ''))): ?>
                    <div class="tourQuoteBookAddPolicy"><?php echo e($data1->payment_policy); ?></div>
                <?php endif; ?>
                <div class="tourQuoteBookPolicySeparator"></div>
            <?php endif; ?>
            <?php if(!empty($data1->can_p) && $data1->can_p !== "N;"): ?>
                <?php $c_policy = safeUnserialize($data1->can_p); ?>
                <?php if(!empty($c_policy) && is_array($c_policy)): ?>
                    <?php $__currentLoopData = $c_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="tourQuoteCancellation">
                            <h4 class="tourQuoteCancelHeading">Cancellation Policy</h4>
                            <div><?php echo class_exists('CustomHelpers') ? CustomHelpers::get_cancel_policy($v) : $v; ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
                <?php if(!empty(trim($data1->cancel_policy ?? ''))): ?>
                    <div class="tourQuoteCancelAddPolicy"><?php echo e($data1->cancel_policy); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Important Notes -->
<?php if(!empty($data1->imp_notes) && $data1->imp_notes !== "N;"): ?>
    <div class="tourQuoteImpCont">
        <div>
            <h3 class="tourQuoteImpHead">IMPORTANT NOTES</h3>
        </div>
        <div class="tourQuoteImpBox">
            <?php $important_notes = safeUnserialize($data1->imp_notes); ?>
            <?php if(!empty($important_notes) && is_array($important_notes)): ?>
                <?php $__currentLoopData = $important_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="tourQuoteImp">
                        <div><?php echo class_exists('CustomHelpers') ? CustomHelpers::get_impnotes($v) : $v; ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
            <?php if(!empty(trim($data1->extra_notes ?? ''))): ?>
                <div class="tourQuoteImpAddPolicy"><?php echo e($data1->extra_notes); ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Raise Concern or Pay Button -->
<div class="touQuoteBookFooterCont">
    <?php echo $__env->make("query.quotation_webpage.accept", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<!-- Footer -->
<?php if(!empty($data1->quote_footer)): ?>
    <?php
        $footer_id = $data1->quote_footer;
        $footer_data = DB::table('quotation_footer')->where('id', $footer_id)->first();
    ?>
    <div class="tourQuoteFooterCont">
        <?php if($footer_data): ?>
            <?php echo $footer_data->footer_desc ?? ''; ?>

        <?php endif; ?>
    </div>
<?php endif; ?>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>