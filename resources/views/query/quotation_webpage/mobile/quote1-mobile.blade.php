<!-- Header -->
<div class="mtourQuoteWebHeadCont">
    <p>Dear {{ $data1->name }},</p>
    @if($data1 && $data1->option1_quotation_header != "")
        <?php
            $header_id = $data1->option1_quotation_header;
            $header_data = DB::table('quotation_header')->where('id', $header_id)->first();
        ?>
        @if($header_data)
            {!! $header_data->header_desc !!}
        @endif
    @endif
    @if($data1->accept_status == "0" && $data1->send_option == "1")
        <!-- Empty if block, can add content if needed -->
    @endif
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
    <h4 class="mtourQuoteTitle">{{ $data1->custom_package_name }}</h4>
    <h5 class="mtourQuoteDaysBadge">{{ $data1->duration - 1 }} Nights / {{ $data1->duration }} Days</h5>
    <div class="mtouQuoteBookCont">
        <div>
            <h5 class="mtourQuoteServiceTitle">Included in this package</h5>
        </div>
        <!-- Service Icons -->
        <div class="flexCenter gap20 mobscroll overflowX">
            <?php $package_service = $data1->package_service ? unserialize($data1->package_service) : []; ?>
            @if(is_array($package_service) && !empty($package_service))
                @foreach($package_service as $icon)
                    <div class="m-svc-icon-cont">
                        <div class="m-svc-icon-box">
                            <img src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon, 'rt_icons', 'icon')) }}">
                        </div>
                        <div class="font12 blacktext">{{ $icon }}</div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="tourQuoteDatePricingCont">
    <div class="makeflex">
        <!-- Departure City -->
        <div class="tourQuoteCityBox">
            <h4 class="tourQuoteCityBoxHead">DEPARTURE CITY</h4>
            <?php
                // Fetch city name using sourcecity ID
                $sourceCityId = $data1->sourcecity ?? 0; // Fallback to 0 if null
                $sourceCityName = class_exists('CustomHelpers') 
                    ? CustomHelpers::get_master_table_data('city', 'id', $sourceCityId, 'name') 
                    : 'N/A'; // Fallback to 'N/A' if helper not available or city not found
            ?>
            <h3 class="tourQuoteCityName">{{ $sourceCityName }}</h3>
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
            <h3 class="tourQuoteDepDate">{{ $datefrom_print }}</h3>
            <p class="tourQuoteDateBoxHead appendTop10">TO</p>
            <p class="tourQuoteRetDate">{{ $stop_date_print }}</p>
        </div>

        <!-- Pricing -->
        <div class="tourQuotePriceBox">
            @if(($data1->price_type ?? '') === "Per Person")
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
                            {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_group'] / $total_people)) : round($price_data_first['query_total_group'] / $total_people) }}
                        </p>
                    </div>
                    <div class="tourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceBoxSubHead">Discount (-)</p>
                        <p class="tourQuotePriceValue">
                            <span class="tourQuoteDefaultCurency"> </span>
                            {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_discount_group'] / $total_people)) : round($price_data_first['query_total_discount_group'] / $total_people) }}
                        </p>
                    </div>
                    @if(round($price_data_first['query_total_gst_group'] / $total_people) > 0)
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">GST @if(isset($price_data_first['query_gst_curr']) && $price_data_first['query_gst_curr'] == 2) ({{ $price_data_first['gst_percentage'] ?? 0 }}%) @endif</p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group'] / $total_people)) : round($price_data_first['query_total_gst_group'] / $total_people) }}
                            </p>
                        </div>
                    @endif
                    @if(round($price_data_first['query_total_tcs_group'] / $total_people) > 0)
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">TCS @if(isset($price_data_first['query_tcs_curr']) && $price_data_first['query_tcs_curr'] == 2) ({{ $price_data_first['tcs_percentage'] ?? 0 }}%) @endif</p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group'] / $total_people)) : round($price_data_first['query_total_tcs_group'] / $total_people) }}
                            </p>
                        </div>
                    @endif
                    @if(round($price_data_first['query_total_pg_group'] / $total_people) > 0)
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">PG @if(isset($price_data_first['pg_charges']) && $price_data_first['pg_charges'] == 2) ({{ $price_data_first['pgcharges_percentage'] ?? 0 }}%) @endif</p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group'] / $total_people)) : round($price_data_first['query_total_pg_group'] / $total_people) }}
                            </p>
                        </div>
                    @endif
                    <div class="tourQuotePriceSeparator"></div>
                    <div class="flexBetween">
                        <div>
                            <p class="tourQuotePriceTotal">Grand Total</p>
                            <p class="tourQuotePriceTagline">( {{ $data1->anything ?? 'N/A' }} )</p>
                        </div>
                        <div>
                            <p class="tourQuotePriceTotalValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult'] / $total_people)) : round($price_data_first['query_pricetopay_adult'] / $total_people) }}
                            </p>
                        </div>
                    </div>
                </div>
            @elseif(($data1->price_type ?? '') === "Group Price")
                <div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>
                        <p class="tourQuotePriceValue">
                            <span class="tourQuoteDefaultCurency"> </span>
                            {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency($price_data_first['query_total_group']) : $price_data_first['query_total_group'] }}
                        </p>
                    </div>
                    <div class="tourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceBoxSubHead">Discount (-)</p>
                        <p class="tourQuotePriceValue">
                            <span class="tourQuoteDefaultCurency"> </span>
                            {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']) : $price_data_first['query_total_discount_group'] }}
                        </p>
                    </div>
                    @if(round($price_data_first['query_total_gst_group']) > 0)
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">GST @if(isset($price_data_first['query_gst_curr']) && $price_data_first['query_gst_curr'] == 2) ({{ $price_data_first['gst_percentage'] ?? 0 }}%) @endif</p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group'])) : round($price_data_first['query_total_gst_group']) }}
                            </p>
                        </div>
                    @endif
                    @if(round($price_data_first['query_total_tcs_group']) > 0)
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">TCS @if(isset($price_data_first['query_tcs_curr']) && $price_data_first['query_tcs_curr'] == 2) ({{ $price_data_first['tcs_percentage'] ?? 0 }}%) @endif</p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group'])) : round($price_data_first['query_total_tcs_group']) }}
                            </p>
                        </div>
                    @endif
                    @if(round($price_data_first['query_total_pg_group']) > 0)
                        <div class="tourQuotePriceSeparator"></div>
                        <div class="makeflexCenterBewtween">
                            <p class="tourQuotePriceBoxSubHead">PG @if(isset($price_data_first['pg_charges']) && $price_data_first['pg_charges'] == 2) ({{ $price_data_first['pgcharges_percentage'] ?? 0 }}%) @endif</p>
                            <p class="tourQuotePriceValue">
                                <span class="tourQuoteDefaultCurency"> </span>
                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group'])) : round($price_data_first['query_total_pg_group']) }}
                            </p>
                        </div>
                    @endif
                    <div class="tourQuotePriceSeparator"></div>
                    <div class="makeflexCenterBewtween">
                        <p class="tourQuotePriceTotal">Grand Total</p>
                        <p class="tourQuotePriceTotalValue">
                            <span class="tourQuoteDefaultCurency"> </span>
                            {{ class_exists('CustomHelpers') ? CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult'])) : round($price_data_first['query_pricetopay_adult']) }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Quote Validity -->
    @if(($data1->validity_show_on_frontend ?? 'No') === 'No' && !empty($data1->quote_validaty))
        <div class="tourQuoteValidity">
            QUOTE VALIDITY - {{ date("d M Y", strtotime(str_replace('/', '-', $data1->quote_validaty))) }}
            @if(($data1->validity_time ?? '23:59:59') !== '23:59:59')
                {{ $data1->validity_time }}
            @endif
        </div>
    @else
        <div class="tourQuoteValidity">Pay Immediately</div>
    @endif
</div>

<!-- Transport -->
<?php $flight_detail = $data1->option1_flight ? unserialize($data1->option1_flight) : []; ?>
@if(is_array($flight_detail) && array_key_exists('flightOption', $flight_detail) && $flight_detail['flightOption'] == 1)
    <div class="mtourQuoteFlightCont">
        <h3 class="mtourQuoteFlightHead">FLIGHT DETAILS</h3>
        <div class="">
            <!-- Upward Flight Starts -->
            <div class="mtourQuoteOnwardFlightBox">
                <div class="flexCenter apndBtm10">
                    <div class="apndRt10" style="">
                        @if(is_array($flight_detail) && array_key_exists('origin', $flight_detail) && $flight_detail['origin'] == 0)
                            <span class="mflightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'previous_data') }}</span>
                        @endif
                        <span class="mflightCityName">-</span>
                        @if(is_array($flight_detail) && array_key_exists('dest', $flight_detail) && $flight_detail['dest'] != "")
                            <span class="mflightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'previous_data') }}</span>
                        @endif
                    </div>
                </div>
                <!-- Add more flight details here if needed -->
            </div>
            <!-- Return Flight Starts -->
            <!-- Add return flight details if applicable -->
        </div>
    </div>
@endif

<!-- Transfers -->
@if($data1->transfers != '' && $data1->transfers != 'N;')
    <?php $transfers = $data1->transfers ? unserialize($data1->transfers) : []; ?>
    @if(is_array($transfers) && !empty($transfers) && isset($transfers[0]['mode_title']) && $transfers[0]['mode_title'] != '')
        <div class="mtourQuoteTransferCont">
            <h3 class="mtourQuoteTransferHead">TRANSFERS</h3>
            <?php $a = 0; ?>
            @foreach($transfers as $row => $col)
                @if(array_key_exists('transport_type', $col) && array_key_exists('transfers_type', $col))
                    <?php
                        $transfers_data = DB::table('rt_transfer_list')
                            ->where([['transport_type', '=', $col['transport_type']], ['title', '=', $col['transfers_type']]])
                            ->first();
                    ?>
                    <div class="mtourQuoteTransferBox">
                        <div class="mtourQuoteTransferTitle">{{ $col['mode_title'] }}</div>
                        <div class="mtourQuoteTransferDescBox">
                            <div class="flex-column">
                                <!-- Vehicle Image -->
                                <div class="mtransferImageBox">
                                    @if($transfers_data)
                                        @if($transfers_data->transfer_image != '' && file_exists(public_path('uploads/transfer_image/' . $transfers_data->transfer_image)))
                                            <img class="mtransferImageType" src="{{ url('/public/uploads/transfer_image/' . $transfers_data->transfer_image) }}" loading="lazy">
                                        @elseif($transfers_data->transfer_image != '')
                                            <p>Img loading.....</p>
                                        @else
                                            <p>Image not available</p>
                                        @endif
                                    @else
                                        <p>Image not available</p>
                                    @endif
                                </div>

                                <div>
                                    <!-- Private, Shared or Coach -->
                                    <div class="mtransferDescTopSection">
                                        <h4 class="mtransferTitle">{{ $col['mode_title'] }}</h4>
                                        <h2 class="mtransportType">
                                            @if($transfers_data && $transfers_data->transfer_type != '')
                                                {{ $transfers_data->transfer_type }}
                                            @endif
                                        </h2>
                                    </div>

                                    <!-- Vehicle Type, Duration & Inclusion -->
                                    <div class="flexBetween appendBottom20">
                                        <div class="mtransferVehicleCont">
                                            <h4 class="mtransferHead">VEHICLE TYPE</h4>
                                            <h5 class="mtransferSubHead">
                                                @if($transfers_data && $transfers_data->vehicle_type != '')
                                                    {{ $transfers_data->vehicle_type }}
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="mthumbnailDurationCont">
                                            <h4 class="mtransferHead">DURATION</h4>
                                            <h5 class="mtransferSubHead">
                                                @if($transfers_data && $transfers_data->duration != '')
                                                    {{ $transfers_data->duration }}
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="mtransferHead">INCLUDES</h4>
                                        <h5 class="mtransferSubHead">
                                            @if($transfers_data && $transfers_data->includes != '')
                                                {{ $transfers_data->includes }}
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $a++; ?>
                @endif
            @endforeach
        </div>
    @endif
@endif

<!-- Accommodation -->
<div class="mtourQuoteHotelCont">
    <h4 class="mtourQuoteHotelHead">ACCOMMODATION</h4>
    <?php
        $acco = $data1->option1_accommodation ? unserialize($data1->option1_accommodation) : [];
        $i = 1;
    ?>
    @if(is_array($acco) && !empty($acco))
        @foreach($acco as $acco_data)
            <div class="mtourQuoteHotelBox">
                <div class="mtourQuoteHotelTitle">
                    {{ $acco_data["city"] }}
                    @if($i > 1)
                        <br>
                    @endif
                </div>
                <div class="mtourQuoteHotelDescBox">
                    <div class="flex-column">
                        <!-- Property Image -->
                        <div class="mhotelImageBox">
                            @if(array_key_exists("hotel", $acco_data))
                                @if($acco_data["hotel"] != "" && $acco_data["hotel"] != "other")
                                    <img src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image')) }}" alt="img">
                                @elseif($acco_data["hotel"] == "other")
                                    <img src="{{ url('/public/uploads/no-image.png') }}" alt="img">
                                @endif
                            @else
                                <img src="{{ url('/public/uploads/no-image.png') }}" alt="img">
                            @endif
                        </div>
                        <div class="mhotelDescBox">
                            <div class="mhotelTopSection">
                                <div class="mhotelType">Hotel</div>
                                <!-- Hotel Name -->
                                <div class="mtourHotelDtls">
                                    <h5 class="mhotelName">
                                        @if(array_key_exists("hotel", $acco_data) && $acco_data["hotel"] != "" && $acco_data["hotel"] != "other")
                                            {{ CustomHelpers::getpackagerecord($acco_data["hotel"], 'package_hotel', 'hotelname') }}
                                        @elseif(array_key_exists("other_hotel", $acco_data) && $acco_data["other_hotel"] != "")
                                            {{ $acco_data["other_hotel"] }}
                                        @endif
                                    </h5>
                                </div>
                                <div class="mhotelStarRating">
                                    @if(array_key_exists("star", $acco_data) && $acco_data["star"] != "" && $acco_data["star"] != "other")
                                        {{ CustomHelpers::get_star_rating($acco_data["star"]) }}
                                    @elseif(array_key_exists("star_other", $acco_data) && $acco_data["star_other"] != "")
                                        {{ CustomHelpers::get_star_rating($acco_data["star_other"]) }}
                                    @endif
                                </div>
                                <!-- Destination City Name -->
                                <div class="mhotelCityName">{{ $acco_data["city"] }}</div>
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
                                            @if(array_key_exists("category", $acco_data) && $acco_data["category"] != "")
                                                <p class="mhotelRoomCont_type">{{ $acco_data["category"] }}</p>
                                            @endif
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
                                            <p class="mhotelCheckInCont_date">{{ $checkin_date_print ?? '' }}</p>
                                        </div>
                                        <div class="mhotelCheckOutCont">
                                            <p class="mhotelCheckOutCont_heading">CHECKOUT</p>
                                            <p class="mhotelCheckOutCont_date">{{ $checkout_date_print ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hotel Website -->
                                @if(array_key_exists("hotel_link", $acco_data) && $acco_data["hotel_link"] != "")
                                    <div class="mhotelWebCont">
                                        <p class="mhotelWebCont_heading">HOTEL WEBSITE</p>
                                        <p class="mhotelWebCont_name">{{ $acco_data["hotel_link"] }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            @endforeach
        @endif
    </div>

    <!-- Itinerary -->
    @php
        $itinerary_data = $data1->option1_dayItinerary ? unserialize($data1->option1_dayItinerary) : [];
        $day = 1;
    @endphp
    @if(is_array($itinerary_data) && !empty($itinerary_data) && isset($itinerary_data["day1"]["title"]) && $itinerary_data["day1"]["title"] != "")
        <div class="mtourQuoteItineraryCont">
            <div class="mtourQuoteItineraryHead foldable mfoldableArrow">Tour Itinerary</div>
            <div class="mfoldableContent">
                @foreach($itinerary_data as $itinerary_datas)
                    <div class="mtourQuoteItineraryBox">
                        <div class="makeflex" style="margin-top: 0">
                            <div class="mtourQuoteLeftBorderMarker"></div>
                            <div class="flex-column">
                                <h3 class="mtourQuoteDayPlanHead">Day {{ $day++ }}</h3>
                                <h5 class="mtourQuoteDayPlanSubHead">{{ $itinerary_datas['title'] }}</h5>
                                <h5 class="mtourQuoteDayPlanSubHeadMore">View More</h5>
                            </div>
                        </div>
                        <div class="mtourDtlsCont foldable mSubfoldableArrow">
                            <span class="mtourQuoteItryDtls">Details</span>
                        </div>
                        <div class="mfoldableContent mtourQuoteDtlsDesc">
                            <p>{!! $itinerary_datas['desc'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Inclusions -->
    @if(($data1->quote_inc != '' && $data1->quote_inc != "N;") || $data1->option1_inclusions != '' || ($data1->quote_exc != '' && $data1->quote_exc != "N;") || $data1->option1_exclusions != '')
        <div class="mtourQuoteIncCont">
            <div class="mtourQuoteIncHead foldable mfoldableArrow">Inclusions & Exclusions</div>
            <div class="mfoldableContent mtourQuoteIncBox">
                <!-- Inclusions -->
                @if(($data1->quote_inc != '' && $data1->quote_inc != "N;") || $data1->option1_inclusions != '')
                    <div class="mtourQuoteInclusions">
                        <h4 class="mtourQuoteIncSubHead">Inclusions</h4>
                        <div class="inc-content">
                            <?php $option1_quote_inc = $data1->quote_inc ? unserialize($data1->quote_inc) : []; ?>
                            @if(is_array($option1_quote_inc) && !empty($option1_quote_inc))
                                @foreach($option1_quote_inc as $v)
                                    <ul>
                                        <li>{{ CustomHelpers::get_inclusions($v) }}</li>
                                    </ul>
                                @endforeach
                            @endif
                            <div>{!! $data1->option1_inclusions !!}</div>
                        </div>
                    </div>
                @endif

                <!-- Exclusions -->
                @if(($data1->quote_exc != '' && $data1->quote_exc != "N;") || $data1->option1_exclusions != '')
                    <div class="mtourQuoteExclusions">
                        <h4 class="mtourQuoteExcSubHead">Exclusions</h4>
                        <div class="inc-content">
                            <?php $option1_quote_exc = $data1->quote_exc ? unserialize($data1->quote_exc) : []; ?>
                            @if(is_array($option1_quote_exc) && !empty($option1_quote_exc))
                                @foreach($option1_quote_exc as $v)
                                    <ul>
                                        <li>{{ CustomHelpers::get_exc($v) }}</li>
                                    </ul>
                                @endforeach
                            @endif
                            <div>{!! $data1->option1_exclusions !!}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Overview -->
    @if($data1->option1_description != '' || $data1->option1_highlights != '')
        <div class="mtourQuoteIncCont">
            <h3 class="mtourQuoteIncHead foldable mfoldableArrow">Tour Overview</h3>
            <div class="mfoldableContent mtourQuoteIncBox">
                @if($data1->option1_description != '')
                    <div class="mtourQuoteInclusions">
                        <h4 class="mtourQuoteIncSubHead">Add-On Services</h4>
                        <div style="padding-top:10px">{!! $data1->option1_description !!}</div>
                    </div>
                @endif
                @if($data1->option1_highlights != '')
                    <div class="mtourQuoteExclusions">
                        <h4 class="mtourQuoteExcSubHead">Tour Highlights</h4>
                        <div style="padding-top:10px">{!! $data1->option1_highlights !!}</div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Visa Policy -->
    @if($data1->option1_visa == "1" && $data1->option1_package_visa != '' && $data1->option1_package_visa != "N;")
        <div class="mtourQuoteBookPolicyCont">
            <div class="mtourQuotePolicyHead foldable mfoldableArrow">Visa Policy</div>
            <div class="mfoldableContent mtourQuotePolicyBox">
                <?php $v_policy = $data1->option1_package_visa ? unserialize($data1->option1_package_visa) : []; ?>
                @if(is_array($v_policy) && !empty($v_policy))
                    @foreach($v_policy as $v)
                        <div class="mtourQuotePolicy">
                            <div class="imp-note-content">{!! CustomHelpers::get_visa_policy($v) !!}</div>
                        </div>
                    @endforeach
                @endif
                @if(!empty(trim($data1->option1_visa_policies)))
                    <div class="mtourQuoteAddPolicy">{{ $data1->option1_visa_policies }}</div>
                @endif
            </div>
            <div class="mtourQuotePolicySeparator"></div>
        </div>
    @endif

    <!-- Booking & Cancellation Policy -->
    @if(($data1->option1_package_payment != '' && $data1->option1_package_payment != "N;") || ($data1->option1_package_can != '' && $data1->option1_package_can != "N;"))
        <div class="mtourQuoteBookPolicyCont">
            <div class="mtourQuotePolicyHead foldable mfoldableArrow">Booking Policy</div>
            <div class="mfoldableContent mtourQuotePolicyBox">
                @if($data1->option1_package_payment != '' && $data1->option1_package_payment != "N;")
                    <?php $p_policy = $data1->option1_package_payment ? unserialize($data1->option1_package_payment) : []; ?>
                    @if(is_array($p_policy) && !empty($p_policy))
                        @foreach($p_policy as $v)
                            <div class="mtourQuotePolicy">
                                <h4 class="mTourQtePlcyTtl">Booking Policy</h4>
                                <div class="imp-note-content">{!! CustomHelpers::get_payment_policy($v) !!}</div>
                            </div>
                        @endforeach
                    @endif
                    @if(!empty(trim($data1->option1_payment_policies)))
                        <div class="mtourQuoteAddPolicy">{{ $data1->option1_payment_policies }}</div>
                    @endif
                    <div class="mtourQuotePolicySeparator"></div>
                @endif

                @if($data1->option1_package_can != '' && $data1->option1_package_can != "N;")
                    <?php $c_policy = $data1->option1_package_can ? unserialize($data1->option1_package_can) : []; ?>
                    @if(is_array($c_policy) && !empty($c_policy))
                        @foreach($c_policy as $v)
                            <div class="mtourQuotePolicy">
                                <h4 class="mTourQtePlcyTtl">Cancellation Policy</h4>
                                <div class="imp-note-content">{!! CustomHelpers::get_cancel_policy($v) !!}</div>
                            </div>
                        @endforeach
                    @endif
                    @if(!empty(trim($data1->option1_cancellation)))
                        <div class="mtourQuoteCancelAddPolicy">{{ $data1->option1_cancellation }}</div>
                    @endif
                @endif
            </div>
        </div>
    @endif

    <!-- Important Notes -->
    @if($data1->option1_package_impnotes != '' && $data1->option1_package_impnotes != "N;")
        <div class="mtourQuoteBookPolicyCont">
            <div class="mtourQuotePolicyHead foldable mfoldableArrow">Important</div>
            <div class="mfoldableContent mtourQuotePolicyBox">
                <?php $important_notes = $data1->option1_package_impnotes ? unserialize($data1->option1_package_impnotes) : []; ?>
                @if(is_array($important_notes) && !empty($important_notes))
                    @foreach($important_notes as $v)
                        <div class="mtourQuotePolicy">
                            <h4 class="mTourQtePlcyTtl">Notes</h4>
                            <div class="imp-note-content">{!! CustomHelpers::get_impnotes($v) !!}</div>
                        </div>
                    @endforeach
                @endif
                @if(!empty(trim($data1->option1_extra_imp)))
                    <div class="mtourQuoteAddPolicy">{{ $data1->option1_extra_imp }}</div>
                @endif
            </div>
        </div>
    @endif

    <!-- Why Book with Us -->
    <div class="mtourQuoteBookUsCont">
        <div>
            <h4 class="mtourQuoteBookUsHeading">Why Book with us?</h4>
        </div>
        <div class="flexCenter appendBottom20">
            <div class="mtourQuoteBookUsIconBox">
                <img width="30" height="30" src="{{ url('/resources/assets/frontend/images/icon/iconLetter.png') }}">
            </div>
            <div>
                <h5 class="mtourQuoteBookUsList"><b>Instant</b> confirmation and vouchers sent over sms, email and WhatsApp as soon as your booking is complete</h5>
            </div>
        </div>
        <div class="flexCenter appendBottom20">
            <div class="mtourQuoteBookUsIconBox">
                <img width="30" height="30" src="{{ url('/resources/assets/frontend/images/icon/iconPhone.png') }}">
            </div>
            <div>
                <h5 class="mtourQuoteBookUsList">A <b>dedicated</b> travel expert is assigned to help and guide you during the trip to make your vacation memorable</h5>
            </div>
        </div>
        <div class="flexCenter">
            <div class="mtourQuoteBookUsIconBox">
                <img width="30" height="30" src="{{ url('/resources/assets/frontend/images/icon/iconTicket.png') }}">
            </div>
            <div>
                <h5 class="mtourQuoteBookUsList">You receive the revised vouchers in case of any change/ amendments/ pending confirmation 72 hours before trip starts</h5>
            </div>
        </div>
    </div>

    <!-- Raise Concern or Pay Button -->
    <div class="mtouQuoteBookFooterCont">
        <div class="flexCenter">
            @if(Sentinel::getUser() && (Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor')))
                <?php $previous_raises = DB::table('quote_raise_concern')->where('quotation_ref_no', $data1->quo_ref)->get(); ?>
                <span class="btnRaiseConcern_button">
                    @if(count($previous_raises) > 0)
                        <button type="button" class="btnRaiseConcernMob previous_raise" id="{{ $data1->quo_ref }}">Request Raised</button>
                    @endif
                </span>
            @endif

            <button type="button" class="btnRaiseConcernMob" data-toggle="modal" data-target="#myModal" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}">Request call back</button>
        </div>
    </div>

    <!-- Footer -->
    @if($data1 && $data1->option1_quotation_footer != "")
        <?php
            $footer_id = $data1->option1_quotation_footer;
            $footer_data = DB::table('quotation_footer')->where('id', $footer_id)->first();
        ?>
        <div class="mtourQuoteFooterCont">
            @if($footer_data)
                {!! $footer_data->footer_desc !!}
            @endif
        </div>
    @endif

    <!-- Mobile Pricebar -->
    <div class="mtourQuotePriceBar">
        <div class="mtourQuotePriceBarBox mobscroll overflowX">
            <div class="mtourQuotePriceBoxCont">
                <span class="mtourQuoteValue mtourQuotePriceBarCurency">
                    @if($data1->option1_price_type == "Per Person")
                        {{ round($price_data_first['query_grand_adult'] + $price_data_first['query_grand_exadult'] + $price_data_first['query_grand_childbed'] + $price_data_first['query_grand_childwbed'] + $price_data_first['query_grand_infant'] + $price_data_first['query_grand_single']) }}
                    @elseif($data1->option1_price_type == "Group Price")
                        {{ round($price_data_first['query_pricetopay_adult']) }}
                    @endif
                </span>
                <span class="mtourQuoteValueTagline">
                    @if($data1->option1_price_type == "Per Person") Per person
                    @elseif($data1->option1_price_type == "Group Price") Group Price
                    @endif
                </span>
            </div>
            <div>
                <div class="mtourQuotePriceLine"></div>
                <input type="hidden" name="quote_no" class="quote_no" value="{{ CustomHelpers::custom_encrypt(1) }}">
                <input type="hidden" class="unique_code" value="{{ CustomHelpers::custom_encrypt($data1->unique_code) }}">

                @if(CustomHelpers::get_remaining_amount_second(1, $data1->unique_code) == 0)
                    <button class="btnMain btnBookMob" id="book">Paid</button>
                @else
                    <?php
                        $today = strtotime(date('Y-m-d'));
                        $validity = strtotime(date("Y-m-d", strtotime(str_replace('/', '-', $data1->option1_validaty))));
                    ?>
                    @if($today <= $validity)
                        @if($data1->send_option == 1)
                            <button class="btnMain btnBookMob pay_now" content_action="{{ route('bookingreview') }}">BOOK</button>
                        @else
                            <button class="btnPayBook" style="cursor: not-allowed !important;">BOOK</button>
                        @endif
                    @else
                        <button class="btn-quote-expired" content_action="">Quote expired</button>
                    @endif
                @endif
            </div>
        </div>
    </div>