<!-- Header -->
<div class="mtourQuoteWebHeadCont">
    <p>Dear <?php echo e($data1->name); ?>,</p>
    <?php if($data1 && $data1->option1_quotation_header != ""): ?>
        <?php
            $header_id = $data1->option1_quotation_header;
            $header_data = DB::table('quotation_header')->where('id', $header_id)->first();
        ?>
        <?php if($header_data): ?>
            <?php echo $header_data->header_desc; ?>

        <?php endif; ?>
    <?php endif; ?>
    <?php if($data1->accept_status == "0" && $data1->send_option == "1"): ?>
        <!-- Empty if block, can add content if needed -->
    <?php endif; ?>
</div>

<!-- Title & Services -->
<?php
    $price_data_first = CustomHelpers::get_price_part_seperate(
        $data1->option1_price,
        $data1->quote1_number_of_adult,
        $data1->extra_adult,
        $data1->child_with_bed,
        $data1->child_without_bed,
        $data1->infant,
        $data1->solo_traveller
    );
?>
<div class="mtourQuoteSummaryCont">
    <h4 class="mtourQuoteTitle"><?php echo e($data1->custom_package_name); ?></h4>
    <h5 class="mtourQuoteDaysBadge"><?php echo e($data1->duration - 1); ?> Nights / <?php echo e($data1->duration); ?> Days</h5>
    <div class="mtouQuoteBookCont">
        <div>
            <h5 class="mtourQuoteServiceTitle">Included in this package</h5>
        </div>
        <!-- Service Icons -->
        <div class="flexCenter gap20 mobscroll overflowX">
            <?php $package_service = $data1->package_service ? unserialize($data1->package_service) : []; ?>
            <?php if(is_array($package_service) && !empty($package_service)): ?>
                <?php $__currentLoopData = $package_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="m-svc-icon-cont">
                        <div class="m-svc-icon-box">
                            <img src="<?php echo e(url('/public/uploads/icons/'.CustomHelpers::getimagename($icon, 'rt_icons', 'icon'))); ?>">
                        </div>
                        <div class="font12 blacktext"><?php echo e($icon); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Departure City, Tour Date, Pricing & Quote Validity -->
<div class="mtourQuoteDatePricingCont">
    <div class="flex-column">
        <!-- Departure City -->
        <div class="mtourQuoteCityBox">
            <h4 class="mtourQuoteCityBoxHead">Starting City</h4>
            <h3 class="mtourQuoteCityName"><?php echo e($data1->sourcecity); ?></h3>
        </div>

        <!-- Tour Date -->
        <div class="mtourQuoteDateBox">
            <h4 class="mtourQuoteDateBoxHead">Tour Date</h4>
            <?php
                $originalDate = $data1->tour_date;
                if ($originalDate == "N" || $originalDate == "") {
                    $originalDate = date("d-m-Y");
                }

                $datefrom = str_replace(' ', '', $originalDate);
                $datefrom = explode("-", $datefrom);

                $datefrom_year = $datefrom[2];
                $datefrom_day = $datefrom[1];
                $datefrom_month = $datefrom[0];
                $datefrom = "$datefrom_year-$datefrom_month-$datefrom_day";
                $datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
                $stop_date = $datefrom;
                $date_to = $datefrom;
                $datefrom_print = date("d M Y", strtotime($datefrom));
                $day_from = date('D', strtotime($datefrom));

                $to_days = $data1->duration - 1;
                $stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
                $stop_date_print = date("d M Y", strtotime($stop_date));
                $day_to = date('D', strtotime($stop_date));
            ?>
            <h3 class="mtourQuoteDepDate"><?php echo e($datefrom_print); ?></h3>
            <p class="mtourQuoteDateBoxHead appendTop10">To</p>
            <p class="mtourQuoteRetDate"><?php echo e($stop_date_print); ?></p>
        </div>

        <!-- Pricing -->
        <div class="mtourQuotePriceBox">
            <?php if($data1->option1_price_type == "Per Person"): ?>
                <div>
                    <div class="makeflexCenterBewtween">
                        <p class="mtourQuotePriceBoxSubHead">Total Basic Cost</p>
                        <p class="mtourQuotePriceValue">
                            <span class="mtourQuoteDefaultCurency"> </span>
                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_adult'] + $price_data_first['query_total_exadult'] + $price_data_first['query_total_childbed'] + $price_data_first['query_total_childwbed'] + $price_data_first['query_total_infant'] + $price_data_first['query_total_single'])); ?>

                        </p>
                    </div>
                    <div class="mtourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="mtourQuotePriceBoxSubHead">Discount (-)</p>
                        <p class="mtourQuotePriceValue">
                            <span class="mtourQuoteDefaultCurency"> </span>
                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_discount_minus_adult'] + $price_data_first['query_discount_minus_exadult'] + $price_data_first['query_discount_minus_childbed'] + $price_data_first['query_discount_minus_childwbed'] + $price_data_first['query_discount_minus_infant'] + $price_data_first['query_discount_minus_single'])); ?>

                        </p>
                    </div>

                    <?php if(round($price_data_first['query_total_gst_group'] / ($data1->quote1_number_of_adult + $data1->extra_adult + $data1->child_with_bed + $data1->child_without_bed + $data1->infant + $data1->solo_traveller)) > 0): ?>
                        <div class="mtourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="mtourQuotePriceBoxSubHead">GST
                                <?php if($price_data_first['query_gst_curr'] == 2): ?>
                                    (<?php echo e($price_data_first['gst_percentage']); ?>%)
                                <?php endif; ?>
                            </p>
                            <p class="mtourQuotePriceValue">
                                <span class="mtourQuoteDefaultCurency"> </span>
                                <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_gst_adult'] + $price_data_first['query_gst_exadult'] + $price_data_first['query_gst_childbed'] + $price_data_first['query_gst_childwbed'] + $price_data_first['query_gst_infant'] + $price_data_first['query_gst_single']))); ?>

                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if(round($price_data_first['query_total_tcs_group'] / ($data1->quote1_number_of_adult + $data1->extra_adult + $data1->child_with_bed + $data1->child_without_bed + $data1->infant + $data1->solo_traveller)) > 0): ?>
                        <div class="mtourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="mtourQuotePriceBoxSubHead">TCS
                                <?php if($price_data_first['query_tcs_curr'] == 2): ?>
                                    (<?php echo e($price_data_first['tcs_percentage']); ?>%)
                                <?php endif; ?>
                            </p>
                            <p class="mtourQuotePriceValue">
                                <span class="mtourQuoteDefaultCurency"> </span>
                                <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_tcs_adult'] + $price_data_first['query_tcs_exadult'] + $price_data_first['query_tcs_childbed'] + $price_data_first['query_tcs_childwbed'] + $price_data_first['query_tcs_infant'] + $price_data_first['query_tcs_single']))); ?>

                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if(round($price_data_first['query_total_pg_group'] / ($data1->quote1_number_of_adult + $data1->extra_adult + $data1->child_with_bed + $data1->child_without_bed + $data1->infant + $data1->solo_traveller)) > 0): ?>
                        <div class="mtourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="mtourQuotePriceBoxSubHead">PG
                                <?php if($price_data_first['pg_charges'] == 2): ?>
                                    (<?php echo e($price_data_first['pgcharges_percentage']); ?>%)
                                <?php endif; ?>
                            </p>
                            <p class="mtourQuotePriceValue">
                                <span class="mtourQuoteDefaultCurency"> </span>
                                <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_pgcharges_adult'] + $price_data_first['query_pgcharges_exadult'] + $price_data_first['query_pgcharges_childbed'] + $price_data_first['query_pgcharges_childwbed'] + $price_data_first['query_pgcharges_infant'] + $price_data_first['query_pgcharges_single']))); ?>

                            </p>
                        </div>
                    <?php endif; ?>

                    <div class="mtourQuotePriceSeparator"></div>
                    <div class="flexBetween">
                        <div>
                            <p class="mtourQuotePriceTotal">Grand Total</p>
                            <p class="mtourQuotePriceTagline">( <?php echo e($data1->anything); ?> )</p>
                        </div>
                        <div>
                            <p class="mtourQuotePriceTotalValue">
                                <span class="mtourQuoteDefaultCurency"> </span>
                                <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_grand_adult'] + $price_data_first['query_grand_exadult'] + $price_data_first['query_grand_childbed'] + $price_data_first['query_grand_childwbed'] + $price_data_first['query_grand_infant'] + $price_data_first['query_grand_single']))); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php elseif($data1->option1_price_type == "Group Price"): ?>
                <div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>
                        <p class="mtourQuotePriceValue">
                            <span class="mtourQuoteDefaultCurency"> </span>
                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_group'])); ?>

                        </p>
                    </div>
                    <div class="mtourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="mtourQuotePriceBoxSubHead">Discount (-)</p>
                        <p class="mtourQuotePriceValue">
                            <span class="mtourQuoteDefaultCurency"> </span>
                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group'])); ?>

                        </p>
                    </div>

                    <?php if(round($price_data_first['query_total_gst_group']) > 0): ?>
                        <div class="mtourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="mtourQuotePriceBoxSubHead">GST
                                <?php if($price_data_first['query_gst_curr'] == 2): ?>
                                    (<?php echo e($price_data_first['gst_percentage']); ?>%)
                                <?php endif; ?>
                            </p>
                            <p class="mtourQuotePriceValue">
                                <span class="mtourQuoteDefaultCurency"> </span>
                                <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group']))); ?>

                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if(round($price_data_first['query_total_tcs_group']) > 0): ?>
                        <div class="mtourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="mtourQuotePriceBoxSubHead">TCS
                                <?php if($price_data_first['query_tcs_curr'] == 2): ?>
                                    (<?php echo e($price_data_first['tcs_percentage']); ?>%)
                                <?php endif; ?>
                            </p>
                            <p class="mtourQuotePriceValue">
                                <span class="mtourQuoteDefaultCurency"> </span>
                                <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group']))); ?>

                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if(round($price_data_first['query_total_pg_group']) > 0): ?>
                        <div class="mtourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="mtourQuotePriceBoxSubHead">PG
                                <?php if($price_data_first['pg_charges'] == 2): ?>
                                    (<?php echo e($price_data_first['pgcharges_percentage']); ?>%)
                                <?php endif; ?>
                            </p>
                            <p class="mtourQuotePriceValue">
                                <span class="mtourQuoteDefaultCurency"> </span>
                                <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group']))); ?>

                            </p>
                        </div>
                    <?php endif; ?>

                    <div class="mtourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="mtourQuotePriceTotal">Grand Total</p>
                        <p class="mtourQuotePriceTotalValue">
                            <span class="mtourQuoteDefaultCurency"> </span>
                            <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult']))); ?>

                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quote Validity -->
    <?php if($data1->validity_show_on_frontend == 'No'): ?>
        <?php if($data1->option1_validaty != ""): ?>
            <div class="mtourQuoteValidity">
                Quote validity - <?php echo e(date("d M Y", strtotime(str_replace('/', '-', $data1->option1_validaty)))); ?>

            </div>
            <?php if($data1->validaty_time != '23:59:59'): ?>
                <?php echo e($data1->validaty_time); ?>

            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <div class="mtourQuoteValidity">Pay Immediately</div>
    <?php endif; ?>
</div>

<!-- Transport -->
<?php $flight_detail = $data1->option1_flight ? unserialize($data1->option1_flight) : []; ?>
<?php if(is_array($flight_detail) && array_key_exists('flightOption', $flight_detail) && $flight_detail['flightOption'] == 1): ?>
    <div class="mtourQuoteFlightCont">
        <h3 class="mtourQuoteFlightHead">FLIGHT DETAILS</h3>
        <div class="">
            <!-- Upward Flight Starts -->
            <div class="mtourQuoteOnwardFlightBox">
                <div class="flexCenter apndBtm10">
                    <div class="apndRt10" style="">
                        <?php if(is_array($flight_detail) && array_key_exists('origin', $flight_detail) && $flight_detail['origin'] == 0): ?>
                            <span class="mflightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'previous_data')); ?></span>
                        <?php endif; ?>
                        <span class="mflightCityName">-</span>
                        <?php if(is_array($flight_detail) && array_key_exists('dest', $flight_detail) && $flight_detail['dest'] != ""): ?>
                            <span class="mflightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'previous_data')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Add more flight details here if needed -->
            </div>
            <!-- Return Flight Starts -->
            <!-- Add return flight details if applicable -->
        </div>
    </div>
<?php endif; ?>

<!-- Transfers -->
<?php if($data1->transfers != '' && $data1->transfers != 'N;'): ?>
    <?php $transfers = $data1->transfers ? unserialize($data1->transfers) : []; ?>
    <?php if(is_array($transfers) && !empty($transfers) && isset($transfers[0]['mode_title']) && $transfers[0]['mode_title'] != ''): ?>
        <div class="mtourQuoteTransferCont">
            <h3 class="mtourQuoteTransferHead">TRANSFERS</h3>
            <?php $a = 0; ?>
            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php if(array_key_exists('transport_type', $col) && array_key_exists('transfers_type', $col)): ?>
                    <?php
                        $transfers_data = DB::table('rt_transfer_list')
                            ->where([['transport_type', '=', $col['transport_type']], ['title', '=', $col['transfers_type']]])
                            ->first();
                    ?>
                    <div class="mtourQuoteTransferBox">
                        <div class="mtourQuoteTransferTitle"><?php echo e($col['mode_title']); ?></div>
                        <div class="mtourQuoteTransferDescBox">
                            <div class="flex-column">
                                <!-- Vehicle Image -->
                                <div class="mtransferImageBox">
                                    <?php if($transfers_data): ?>
                                        <?php if($transfers_data->transfer_image != '' && file_exists(public_path('uploads/transfer_image/' . $transfers_data->transfer_image))): ?>
                                            <img class="mtransferImageType" src="<?php echo e(url('/public/uploads/transfer_image/' . $transfers_data->transfer_image)); ?>" loading="lazy">
                                        <?php elseif($transfers_data->transfer_image != ''): ?>
                                            <p>Img loading.....</p>
                                        <?php else: ?>
                                            <p>Image not available</p>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p>Image not available</p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <!-- Private, Shared or Coach -->
                                    <div class="mtransferDescTopSection">
                                        <h4 class="mtransferTitle"><?php echo e($col['mode_title']); ?></h4>
                                        <h2 class="mtransportType">
                                            <?php if($transfers_data && $transfers_data->transfer_type != ''): ?>
                                                <?php echo e($transfers_data->transfer_type); ?>

                                            <?php endif; ?>
                                        </h2>
                                    </div>

                                    <!-- Vehicle Type, Duration & Inclusion -->
                                    <div class="flexBetween appendBottom20">
                                        <div class="mtransferVehicleCont">
                                            <h4 class="mtransferHead">VEHICLE TYPE</h4>
                                            <h5 class="mtransferSubHead">
                                                <?php if($transfers_data && $transfers_data->vehicle_type != ''): ?>
                                                    <?php echo e($transfers_data->vehicle_type); ?>

                                                <?php endif; ?>
                                            </h5>
                                        </div>
                                        <div class="mthumbnailDurationCont">
                                            <h4 class="mtransferHead">DURATION</h4>
                                            <h5 class="mtransferSubHead">
                                                <?php if($transfers_data && $transfers_data->duration != ''): ?>
                                                    <?php echo e($transfers_data->duration); ?>

                                                <?php endif; ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="mtransferHead">INCLUDES</h4>
                                        <h5 class="mtransferSubHead">
                                            <?php if($transfers_data && $transfers_data->includes != ''): ?>
                                                <?php echo e($transfers_data->includes); ?>

                                            <?php endif; ?>
                                        </h5>
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
<?php endif; ?>

<!-- Accommodation -->
<div class="mtourQuoteHotelCont">
    <h4 class="mtourQuoteHotelHead">ACCOMMODATION</h4>
    <?php
        $acco = $data1->option1_accommodation ? unserialize($data1->option1_accommodation) : [];
        $i = 1;
    ?>
    <?php if(is_array($acco) && !empty($acco)): ?>
        <?php $__currentLoopData = $acco; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acco_data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="mtourQuoteHotelBox">
                <div class="mtourQuoteHotelTitle">
                    <?php echo e($acco_data["city"]); ?>

                    <?php if($i > 1): ?>
                        <br>
                    <?php endif; ?>
                </div>
                <div class="mtourQuoteHotelDescBox">
                    <div class="flex-column">
                        <!-- Property Image -->
                        <div class="mhotelImageBox">
                            <?php if(array_key_exists("hotel", $acco_data)): ?>
                                <?php if($acco_data["hotel"] != "" && $acco_data["hotel"] != "other"): ?>
                                    <img src="<?php echo e(url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image'))); ?>" alt="img">
                                <?php elseif($acco_data["hotel"] == "other"): ?>
                                    <img src="<?php echo e(url('/public/uploads/no-image.png')); ?>" alt="img">
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('/public/uploads/no-image.png')); ?>" alt="img">
                            <?php endif; ?>
                        </div>
                        <div class="mhotelDescBox">
                            <div class="mhotelTopSection">
                                <div class="mhotelType">Hotel</div>
                                <!-- Hotel Name -->
                                <div class="mtourHotelDtls">
                                    <h5 class="mhotelName">
                                        <?php if(array_key_exists("hotel", $acco_data) && $acco_data["hotel"] != "" && $acco_data["hotel"] != "other"): ?>
                                            <?php echo e(CustomHelpers::getpackagerecord($acco_data["hotel"], 'package_hotel', 'hotelname')); ?>

                                        <?php elseif(array_key_exists("other_hotel", $acco_data) && $acco_data["other_hotel"] != ""): ?>
                                            <?php echo e($acco_data["other_hotel"]); ?>

                                        <?php endif; ?>
                                    </h5>
                                </div>
                                <div class="mhotelStarRating">
                                    <?php if(array_key_exists("star", $acco_data) && $acco_data["star"] != "" && $acco_data["star"] != "other"): ?>
                                        <?php echo e(CustomHelpers::get_star_rating($acco_data["star"])); ?>

                                    <?php elseif(array_key_exists("star_other", $acco_data) && $acco_data["star_other"] != ""): ?>
                                        <?php echo e(CustomHelpers::get_star_rating($acco_data["star_other"])); ?>

                                    <?php endif; ?>
                                </div>
                                <!-- Destination City Name -->
                                <div class="mhotelCityName"><?php echo e($acco_data["city"]); ?></div>
                            </div>

                            <div class="mhotelFooter">
                                <div>
                                    <?php
                                        $day1 = "0";
                                        $day = "0";
                                        if (array_key_exists("night", $acco_data) && is_array($acco_data["night"]) && !empty($acco_data["night"])) {
                                            $day1 = (int) filter_var($acco_data["night"][0], FILTER_SANITIZE_NUMBER_INT);
                                            $day1 = $day1 - 1;
                                            $datefrom_checkin = "$datefrom_year-$datefrom_day-$datefrom_month";
                                            $checkin_date = date('Y-m-d', strtotime($datefrom_checkin . ' +'.$day1.' days'));
                                            $checkin_date_print = date("d M Y", strtotime($checkin_date));
                                            $day_checkin = date('D', strtotime($checkin_date));

                                            foreach ($acco_data["night"] as $accday) {
                                                $day = (int) filter_var($accday, FILTER_SANITIZE_NUMBER_INT);
                                            }
                                            $datefrom_checkout = "$datefrom_year-$datefrom_day-$datefrom_month";
                                            $checkout_date = date('Y-m-d', strtotime($datefrom_checkout . ' +'.$day.' days'));
                                            $checkout_date_print = date("d M Y", strtotime($checkout_date));
                                            $day_checkout = date('D', strtotime($checkout_date));
                                        }
                                    ?>
                                    <div class="flexBetween appendBottom20">
                                        <!-- Room Type -->
                                        <div class="mhotelRoomCont">
                                            <p class="mhotelRoomCont_heading">ROOM TYPE</p>
                                            <?php if(array_key_exists("category", $acco_data) && $acco_data["category"] != ""): ?>
                                                <p class="mhotelRoomCont_type"><?php echo e($acco_data["category"]); ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- No of Nights -->
                                        <div>
                                            <p class="mhotelDaysBadge_heading">NO OF NIGHTS</p>
                                            <p class="mhotelDaysBadge_nightCount">
                                                <?php
                                                    if ($day1 !== "0" && $day !== "0") {
                                                        $date1 = date_create($checkin_date);
                                                        $date2 = date_create($checkout_date);
                                                        $diff = date_diff($date1, $date2);
                                                        echo $diff->format("%a") > 1 ? $diff->format("%a Nights") : $diff->format("%a Night");
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Check-in & Checkout -->
                                    <div class="mhotelCheckInOut">
                                        <div class="mhotelCheckInCont">
                                            <p class="mhotelCheckInCont_heading">CHECK-IN</p>
                                            <p class="mhotelCheckInCont_date"><?php echo e($checkin_date_print ?? ''); ?></p>
                                        </div>
                                        <div class="mhotelCheckOutCont">
                                            <p class="mhotelCheckOutCont_heading">CHECKOUT</p>
                                            <p class="mhotelCheckOutCont_date"><?php echo e($checkout_date_print ?? ''); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hotel Website -->
                                <?php if(array_key_exists("hotel_link", $acco_data) && $acco_data["hotel_link"] != ""): ?>
                                    <div class="mhotelWebCont">
                                        <p class="mhotelWebCont_heading">HOTEL WEBSITE</p>
                                        <p class="mhotelWebCont_name"><?php echo e($acco_data["hotel_link"]); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>
    </div>

    <!-- Itinerary -->
    <?php 
        $itinerary_data = $data1->option1_dayItinerary ? unserialize($data1->option1_dayItinerary) : [];
        $day = 1;
     ?>
    <?php if(is_array($itinerary_data) && !empty($itinerary_data) && isset($itinerary_data["day1"]["title"]) && $itinerary_data["day1"]["title"] != ""): ?>
        <div class="mtourQuoteItineraryCont">
            <div class="mtourQuoteItineraryHead foldable mfoldableArrow">Tour Itinerary</div>
            <div class="mfoldableContent">
                <?php $__currentLoopData = $itinerary_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itinerary_datas): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="mtourQuoteItineraryBox">
                        <div class="makeflex" style="margin-top: 0">
                            <div class="mtourQuoteLeftBorderMarker"></div>
                            <div class="flex-column">
                                <h3 class="mtourQuoteDayPlanHead">Day <?php echo e($day++); ?></h3>
                                <h5 class="mtourQuoteDayPlanSubHead"><?php echo e($itinerary_datas['title']); ?></h5>
                                <h5 class="mtourQuoteDayPlanSubHeadMore">View More</h5>
                            </div>
                        </div>
                        <div class="mtourDtlsCont foldable mSubfoldableArrow">
                            <span class="mtourQuoteItryDtls">Details</span>
                        </div>
                        <div class="mfoldableContent mtourQuoteDtlsDesc">
                            <p><?php echo $itinerary_datas['desc']; ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Inclusions -->
    <?php if(($data1->quote_inc != '' && $data1->quote_inc != "N;") || $data1->option1_inclusions != '' || ($data1->quote_exc != '' && $data1->quote_exc != "N;") || $data1->option1_exclusions != ''): ?>
        <div class="mtourQuoteIncCont">
            <div class="mtourQuoteIncHead foldable mfoldableArrow">Inclusions & Exclusions</div>
            <div class="mfoldableContent mtourQuoteIncBox">
                <!-- Inclusions -->
                <?php if(($data1->quote_inc != '' && $data1->quote_inc != "N;") || $data1->option1_inclusions != ''): ?>
                    <div class="mtourQuoteInclusions">
                        <h4 class="mtourQuoteIncSubHead">Inclusions</h4>
                        <div class="inc-content">
                            <?php $option1_quote_inc = $data1->quote_inc ? unserialize($data1->quote_inc) : []; ?>
                            <?php if(is_array($option1_quote_inc) && !empty($option1_quote_inc)): ?>
                                <?php $__currentLoopData = $option1_quote_inc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <ul>
                                        <li><?php echo e(CustomHelpers::get_inclusions($v)); ?></li>
                                    </ul>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                            <div><?php echo $data1->option1_inclusions; ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Exclusions -->
                <?php if(($data1->quote_exc != '' && $data1->quote_exc != "N;") || $data1->option1_exclusions != ''): ?>
                    <div class="mtourQuoteExclusions">
                        <h4 class="mtourQuoteExcSubHead">Exclusions</h4>
                        <div class="inc-content">
                            <?php $option1_quote_exc = $data1->quote_exc ? unserialize($data1->quote_exc) : []; ?>
                            <?php if(is_array($option1_quote_exc) && !empty($option1_quote_exc)): ?>
                                <?php $__currentLoopData = $option1_quote_exc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <ul>
                                        <li><?php echo e(CustomHelpers::get_exc($v)); ?></li>
                                    </ul>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                            <div><?php echo $data1->option1_exclusions; ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Overview -->
    <?php if($data1->option1_description != '' || $data1->option1_highlights != ''): ?>
        <div class="mtourQuoteIncCont">
            <h3 class="mtourQuoteIncHead foldable mfoldableArrow">Tour Overview</h3>
            <div class="mfoldableContent mtourQuoteIncBox">
                <?php if($data1->option1_description != ''): ?>
                    <div class="mtourQuoteInclusions">
                        <h4 class="mtourQuoteIncSubHead">Add-On Services</h4>
                        <div style="padding-top:10px"><?php echo $data1->option1_description; ?></div>
                    </div>
                <?php endif; ?>
                <?php if($data1->option1_highlights != ''): ?>
                    <div class="mtourQuoteExclusions">
                        <h4 class="mtourQuoteExcSubHead">Tour Highlights</h4>
                        <div style="padding-top:10px"><?php echo $data1->option1_highlights; ?></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Visa Policy -->
    <?php if($data1->option1_visa == "1" && $data1->option1_package_visa != '' && $data1->option1_package_visa != "N;"): ?>
        <div class="mtourQuoteBookPolicyCont">
            <div class="mtourQuotePolicyHead foldable mfoldableArrow">Visa Policy</div>
            <div class="mfoldableContent mtourQuotePolicyBox">
                <?php $v_policy = $data1->option1_package_visa ? unserialize($data1->option1_package_visa) : []; ?>
                <?php if(is_array($v_policy) && !empty($v_policy)): ?>
                    <?php $__currentLoopData = $v_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="mtourQuotePolicy">
                            <div class="imp-note-content"><?php echo CustomHelpers::get_visa_policy($v); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
                <?php if(!empty(trim($data1->option1_visa_policies))): ?>
                    <div class="mtourQuoteAddPolicy"><?php echo e($data1->option1_visa_policies); ?></div>
                <?php endif; ?>
            </div>
            <div class="mtourQuotePolicySeparator"></div>
        </div>
    <?php endif; ?>

    <!-- Booking & Cancellation Policy -->
    <?php if(($data1->option1_package_payment != '' && $data1->option1_package_payment != "N;") || ($data1->option1_package_can != '' && $data1->option1_package_can != "N;")): ?>
        <div class="mtourQuoteBookPolicyCont">
            <div class="mtourQuotePolicyHead foldable mfoldableArrow">Booking Policy</div>
            <div class="mfoldableContent mtourQuotePolicyBox">
                <?php if($data1->option1_package_payment != '' && $data1->option1_package_payment != "N;"): ?>
                    <?php $p_policy = $data1->option1_package_payment ? unserialize($data1->option1_package_payment) : []; ?>
                    <?php if(is_array($p_policy) && !empty($p_policy)): ?>
                        <?php $__currentLoopData = $p_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <div class="mtourQuotePolicy">
                                <h4 class="mTourQtePlcyTtl">Booking Policy</h4>
                                <div class="imp-note-content"><?php echo CustomHelpers::get_payment_policy($v); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                    <?php if(!empty(trim($data1->option1_payment_policies))): ?>
                        <div class="mtourQuoteAddPolicy"><?php echo e($data1->option1_payment_policies); ?></div>
                    <?php endif; ?>
                    <div class="mtourQuotePolicySeparator"></div>
                <?php endif; ?>

                <?php if($data1->option1_package_can != '' && $data1->option1_package_can != "N;"): ?>
                    <?php $c_policy = $data1->option1_package_can ? unserialize($data1->option1_package_can) : []; ?>
                    <?php if(is_array($c_policy) && !empty($c_policy)): ?>
                        <?php $__currentLoopData = $c_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <div class="mtourQuotePolicy">
                                <h4 class="mTourQtePlcyTtl">Cancellation Policy</h4>
                                <div class="imp-note-content"><?php echo CustomHelpers::get_cancel_policy($v); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                    <?php if(!empty(trim($data1->option1_cancellation))): ?>
                        <div class="mtourQuoteCancelAddPolicy"><?php echo e($data1->option1_cancellation); ?></div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Important Notes -->
    <?php if($data1->option1_package_impnotes != '' && $data1->option1_package_impnotes != "N;"): ?>
        <div class="mtourQuoteBookPolicyCont">
            <div class="mtourQuotePolicyHead foldable mfoldableArrow">Important</div>
            <div class="mfoldableContent mtourQuotePolicyBox">
                <?php $important_notes = $data1->option1_package_impnotes ? unserialize($data1->option1_package_impnotes) : []; ?>
                <?php if(is_array($important_notes) && !empty($important_notes)): ?>
                    <?php $__currentLoopData = $important_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="mtourQuotePolicy">
                            <h4 class="mTourQtePlcyTtl">Notes</h4>
                            <div class="imp-note-content"><?php echo CustomHelpers::get_impnotes($v); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
                <?php if(!empty(trim($data1->option1_extra_imp))): ?>
                    <div class="mtourQuoteAddPolicy"><?php echo e($data1->option1_extra_imp); ?></div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Why Book with Us -->
    <div class="mtourQuoteBookUsCont">
        <div>
            <h4 class="mtourQuoteBookUsHeading">Why Book with us?</h4>
        </div>
        <div class="flexCenter appendBottom20">
            <div class="mtourQuoteBookUsIconBox">
                <img width="30" height="30" src="<?php echo e(url('/resources/assets/frontend/images/icon/iconLetter.png')); ?>">
            </div>
            <div>
                <h5 class="mtourQuoteBookUsList"><b>Instant</b> confirmation and vouchers sent over sms, email and WhatsApp as soon as your booking is complete</h5>
            </div>
        </div>
        <div class="flexCenter appendBottom20">
            <div class="mtourQuoteBookUsIconBox">
                <img width="30" height="30" src="<?php echo e(url('/resources/assets/frontend/images/icon/iconPhone.png')); ?>">
            </div>
            <div>
                <h5 class="mtourQuoteBookUsList">A <b>dedicated</b> travel expert is assigned to help and guide you during the trip to make your vacation memorable</h5>
            </div>
        </div>
        <div class="flexCenter">
            <div class="mtourQuoteBookUsIconBox">
                <img width="30" height="30" src="<?php echo e(url('/resources/assets/frontend/images/icon/iconTicket.png')); ?>">
            </div>
            <div>
                <h5 class="mtourQuoteBookUsList">You receive the revised vouchers in case of any change/ amendments/ pending confirmation 72 hours before trip starts</h5>
            </div>
        </div>
    </div>

    <!-- Raise Concern or Pay Button -->
    <div class="mtouQuoteBookFooterCont">
        <div class="flexCenter">
            <?php if(Sentinel::getUser() && (Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor'))): ?>
                <?php $previous_raises = DB::table('quote_raise_concern')->where('quotation_ref_no', $data1->quo_ref)->get(); ?>
                <span class="btnRaiseConcern_button">
                    <?php if(count($previous_raises) > 0): ?>
                        <button type="button" class="btnRaiseConcernMob previous_raise" id="<?php echo e($data1->quo_ref); ?>">Request Raised</button>
                    <?php endif; ?>
                </span>
            <?php endif; ?>

            <button type="button" class="btnRaiseConcernMob" data-toggle="modal" data-target="#myModal" content_id="<?php echo e(CustomHelpers::custom_encrypt($data1->id)); ?>">Request call back</button>
        </div>
    </div>

    <!-- Footer -->
    <?php if($data1 && $data1->option1_quotation_footer != ""): ?>
        <?php
            $footer_id = $data1->option1_quotation_footer;
            $footer_data = DB::table('quotation_footer')->where('id', $footer_id)->first();
        ?>
        <div class="mtourQuoteFooterCont">
            <?php if($footer_data): ?>
                <?php echo $footer_data->footer_desc; ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Mobile Pricebar -->
    <div class="mtourQuotePriceBar">
        <div class="mtourQuotePriceBarBox mobscroll overflowX">
            <div class="mtourQuotePriceBoxCont">
                <span class="mtourQuoteValue mtourQuotePriceBarCurency">
                    <?php if($data1->option1_price_type == "Per Person"): ?>
                        <?php echo e(round($price_data_first['query_grand_adult'] + $price_data_first['query_grand_exadult'] + $price_data_first['query_grand_childbed'] + $price_data_first['query_grand_childwbed'] + $price_data_first['query_grand_infant'] + $price_data_first['query_grand_single'])); ?>

                    <?php elseif($data1->option1_price_type == "Group Price"): ?>
                        <?php echo e(round($price_data_first['query_pricetopay_adult'])); ?>

                    <?php endif; ?>
                </span>
                <span class="mtourQuoteValueTagline">
                    <?php if($data1->option1_price_type == "Per Person"): ?> Per person
                    <?php elseif($data1->option1_price_type == "Group Price"): ?> Group Price
                    <?php endif; ?>
                </span>
            </div>
            <div>
                <div class="mtourQuotePriceLine"></div>
                <input type="hidden" name="quote_no" class="quote_no" value="<?php echo e(CustomHelpers::custom_encrypt(1)); ?>">
                <input type="hidden" class="unique_code" value="<?php echo e(CustomHelpers::custom_encrypt($data1->unique_code)); ?>">

                <?php if(CustomHelpers::get_remaining_amount_second(1, $data1->unique_code) == 0): ?>
                    <button class="btnMain btnBookMob" id="book">Paid</button>
                <?php else: ?>
                    <?php
                        $today = strtotime(date('Y-m-d'));
                        $validity = strtotime(date("Y-m-d", strtotime(str_replace('/', '-', $data1->option1_validaty))));
                    ?>
                    <?php if($today <= $validity): ?>
                        <?php if($data1->send_option == 1): ?>
                            <button class="btnMain btnBookMob pay_now" content_action="<?php echo e(route('bookingreview')); ?>">BOOK</button>
                        <?php else: ?>
                            <button class="btnPayBook" style="cursor: not-allowed !important;">BOOK</button>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="btn-quote-expired" content_action="">Quote expired</button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>