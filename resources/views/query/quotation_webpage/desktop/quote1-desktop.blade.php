<!-- Ensure this is wrapped in a layout or has proper HTML structure -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data1->title ?? 'Quotation' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@php
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
@endphp

<div class="tourQuoteWebHeadCont">
    <p>Dear {{ $data1->name ?? 'Customer' }},</p>
    @if(!empty($data1->quote_header))
        <?php
            $header_id = $data1->quote_header;
            $header_data = DB::table('quotation_header')->where('id', $header_id)->first();
        ?>
        @if($header_data)
            {!! $header_data->header_desc ?? '' !!}
        @endif
    @endif
</div>

<!-- Title & Services -->
<div class="tourQuoteSummaryCont">
    <div>
        <h4 class="tourQuoteTitle">{{ $data1->title ?? 'Unnamed Package' }}</h4>
        <h5 class="tourQuoteDaysBadge">{{ ($data1->duration ?? 1) - 1 }} Nights / {{ $data1->duration ?? 1 }} Days</h5>
    </div>
    <div class="touQuoteBookCont">
        <div>
            <h5 class="tourQuoteServiceTitle">Included in this package</h5>
            <div id="mobscroll" class="mobscroll overflowX"></div>
            <div class="flexCenter">
                <?php $package_service = safeUnserialize($data1->package_service); ?>
                @if(!empty($package_service) && is_array($package_service))
                    @foreach($package_service as $icon)
                        <div class="tourQteSvcIcns">
                            <div class="tourQteSvcIcnImg">
                                <img src="{{ url('/public/uploads/icons/' . (class_exists('CustomHelpers') ? CustomHelpers::getimagename($icon, 'rt_icons', 'icon') : $icon)) }}" alt="img" onerror="this.style.display='none';">
                            </div>
                            <div class="tourQteSvcTtl">{{ $icon }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div>
            @include("query.quotation_webpage.accept")
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
            <h3 class="tourQuoteCityName">{{ $data1->sourcecity ?? 'N/A' }}</h3>
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
<?php $flight_detail = safeUnserialize($data1->flight); ?>
@if(is_array($flight_detail) && !empty($flight_detail) && isset($flight_detail['flightOption']) && $flight_detail['flightOption'] == 1)
    <div class="tourQuoteFlightCont">
        <div>
            <h3 class="tourQuoteFlightHead">FLIGHT DETAILS</h3>
        </div>
        <div>
            <!-- Upward Flight -->
            <div class="tourQuoteOnwardFlightBox">
                <div class="flexCenter apndBtm10">
                    <div class="appendRight20">
                        @if(isset($flight_detail['origin']) && $flight_detail['origin'] == 0)
                            <span class="flightCityName">{{ class_exists('CustomHelpers') ? CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'previous_data') : 'N/A' }}</span>
                        @endif
                        <span class="flightCityName">-</span>
                        @if(!empty($flight_detail['dest']))
                            <span class="flightCityName">{{ class_exists('CustomHelpers') ? CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'previous_data') : 'N/A' }}</span>
                        @endif
                    </div>
                    <div>
                        @if(isset($flight_detail['onwarddate']) && !empty($flight_detail['onwarddate']))
                            <span class="flightDate">{{ date('d M Y', strtotime(str_replace('/', '-', $flight_detail['onwarddate']))) }}</span>
                        @endif
                    </div>
                </div>
                <div class="onwardFlightBox">
                    <div class="flexCenter appendBottom15">
                        <span class="flightStop">{{ $flight_detail['numberstop'] ?? '' }}</span>
                        <div class="classSeparator"></div>
                        <span class="flightClass">{{ isset($flight_detail['cabin']) && class_exists('CustomHelpers') ? CustomHelpers::get_flight_class_name($flight_detail['cabin']) : '' }}</span>
                    </div>
                    <div class="flexCenter appendLeft20">
                        <div class="appendRight10">
                            <div class="airlineLogoBox">
                                <img src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '✈');">
                            </div>
                        </div>
                        <div class="appendRight20 W120">
                            <p class="flightName">{{ $flight_detail['name'] ?? '' }}</p>
                            <p class="flightNumber">{{ $flight_detail['no'] ?? '' }}</p>
                        </div>
                        <div class="W100">
                            <p class="flightTiming">
                                {{ !empty($flight_detail['dhours']) ? str_pad($flight_detail['dhours'], 2, '0', STR_PAD_LEFT) : '00' }}:{{ isset($flight_detail['ddmins']) ? str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT) : '00' }}
                            </p>
                            <p class="flightCity">{{ !empty($flight_detail['origin']) && class_exists('CustomHelpers') ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'last_str')) : '' }}</p>
                        </div>
                        <div class="flightDurationCont">
                            <p class="flightDuration">
                                {{ isset($flight_detail['duration_hours']) ? $flight_detail['duration_hours'] . 'h ' : '' }}{{ isset($flight_detail['duration_dmins']) ? $flight_detail['duration_dmins'] . 'm' : '' }}
                            </p>
                            <div class="flexCenter">
                                <i class="fa-plane" aria-hidden="true"></i>
                                <div class="flightPathWay"></div>
                                <i class="fa-map-marker" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="W100">
                            <p class="flightTiming">
                                {{ !empty($flight_detail['ahours']) ? str_pad($flight_detail['ahours'], 2, '0', STR_PAD_LEFT) : '00' }}:{{ isset($flight_detail['damins']) ? str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT) : '00' }}
                            </p>
                            <p class="flightCity">{{ !empty($flight_detail['dest']) && class_exists('CustomHelpers') ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'last_str')) : '' }}</p>
                        </div>
                    </div>
                    <p class="baggageTitle">Baggage info</p>
                    <div class="flexCenter">
                        <span class="baggageSubTitle color4A">Cabin: </span>
                        <span class="baggageSubTitle">{{ $flight_detail['baggage'] ?? '' }}</span>
                        <div class="baggageSeparator"></div>
                        <span class="baggageSubTitle color4A">Check in: </span>
                        <span class="baggageSubTitle">{{ $flight_detail['cbaggage'] ?? '' }}</span>
                    </div>
                </div>
            </div>

            <!-- Return Flight -->
            <div class="tourQuoteReturnFlightBox">
                <div class="flexCenter apndBtm10">
                    <div class="appendRight20">
                        @if(!empty($flight_detail['dOrigin']))
                            <span class="flightCityName">{{ class_exists('CustomHelpers') ? CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'previous_data') : 'N/A' }}</span>
                        @endif
                        <span class="flightCityName">-</span>
                        @if(!empty($flight_detail['ddest']))
                            <span class="flightCityName">{{ class_exists('CustomHelpers') ? CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'previous_data') : 'N/A' }}</span>
                        @endif
                    </div>
                    <div>
                        @if(isset($flight_detail['downwarddate']) && !empty($flight_detail['downwarddate']))
                            <span class="flightDate">{{ date('d M Y', strtotime(str_replace('/', '-', $flight_detail['downwarddate']))) }}</span>
                        @endif
                    </div>
                </div>
                <div class="returnFlightBox">
                    <div class="flexCenter appendBottom15">
                        <span class="flightStop">{{ $flight_detail['numberstop'] ?? '' }}</span>
                        <div class="classSeparator"></div>
                        <span class="flightClass">{{ isset($flight_detail['dcabin']) && class_exists('CustomHelpers') ? CustomHelpers::get_flight_class_name($flight_detail['dcabin']) : '' }}</span>
                    </div>
                    <div class="flexCenter appendLeft20">
                        <div class="appendRight10">
                            <div class="airlineLogoBox">
                                <img src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '✈');">
                            </div>
                        </div>
                        <div class="appendRight20 W120">
                            <p class="flightName">{{ $flight_detail['name'] ?? '' }}</p>
                            <p class="flightNumber">{{ $flight_detail['dno'] ?? '' }}</p>
                        </div>
                        <div class="W100">
                            <p class="flightTiming">
                                {{ !empty($flight_detail['ddhours']) ? str_pad($flight_detail['ddhours'], 2, '0', STR_PAD_LEFT) : '00' }}:{{ isset($flight_detail['ddmins']) ? str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT) : '00' }}
                            </p>
                            <p class="flightCity">{{ !empty($flight_detail['dOrigin']) && class_exists('CustomHelpers') ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'last_str')) : '' }}</p>
                        </div>
                        <div class="flightDurationCont">
                            <p class="flightDuration">
                                {{ isset($flight_detail['return_duration_hours']) ? $flight_detail['return_duration_hours'] . 'h ' : '' }}{{ isset($flight_detail['return_duration_mins']) ? $flight_detail['return_duration_mins'] . 'm' : '' }}
                            </p>
                            <div class="flexCenter">
                                <i class="fa-plane" aria-hidden="true"></i>
                                <div class="flightPathWay"></div>
                                <i class="fa-map-marker" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="W100">
                            <p class="flightTiming">
                                {{ !empty($flight_detail['dahours']) ? str_pad($flight_detail['dahours'], 2, '0', STR_PAD_LEFT) : '00' }}:{{ isset($flight_detail['damins']) ? str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT) : '00' }}
                            </p>
                            <p class="flightCity">{{ !empty($flight_detail['ddest']) && class_exists('CustomHelpers') ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'last_str')) : '' }}</p>
                        </div>
                    </div>
                    <p class="baggageTitle">Baggage info</p>
                    <div class="flexCenter">
                        <span class="baggageSubTitle color4A">Cabin: </span>
                        <span class="baggageSubTitle">{{ $flight_detail['baggage'] ?? '' }}</span>
                        <div class="baggageSeparator"></div>
                        <span class="baggageSubTitle color4A">Check in: </span>
                        <span class="baggageSubTitle">{{ $flight_detail['cbaggage'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Transfers -->
<?php $transfers = safeUnserialize($data1->transfers); ?>
@if(!empty($transfers) && is_array($transfers) && isset($transfers[0]['mode_title']) && $transfers[0]['mode_title'] !== '')
    <div class="tourQuoteTransferCont">
        <div>
            <h3 class="tourQuoteTransferHead">TRANSFERS</h3>
        </div>
        <?php $a = 0; ?>
        @foreach($transfers as $col)
            @if(isset($col['transport_type']) && isset($col['transfers_type']))
                <?php
                    $transfers_data = DB::table('rt_transfer_list')
                        ->where([['transport_type', '=', $col['transport_type']], ['title', '=', $col['transfers_type']]])
                        ->first();
                ?>
                <div class="tourQuoteTransferBox">
                    <div class="tourQuoteTransferTitle">{{ $col['mode_title'] }}</div>
                    <div class="tourQuoteTransferDescBox">
                        <div class="makeflex">
                            <div class="transferImageBox">
                                @if($transfers_data && !empty($transfers_data->transfer_image) && file_exists(public_path('uploads/transfer_image/' . $transfers_data->transfer_image)))
                                    <img class="mtransferImageType" src="{{ url('/public/uploads/transfer_image/' . $transfers_data->transfer_image) }}" loading="lazy">
                                @else
                                    <p>Image not available</p>
                                @endif
                            </div>
                            <div>
                                <div class="transferDescTopSection">
                                    <h4 class="transferTitle">{{ $col['mode_title'] }}</h4>
                                    <h2 class="transportType">{{ $transfers_data->transfer_type ?? '' }}</h2>
                                </div>
                                <div class="flexCenter">
                                    <div class="transferVehicleCont">
                                        <h4 class="transferHead">VEHICLE TYPE</h4>
                                        <h5 class="transferSubHead">{{ $transfers_data->vehicle_type ?? '' }}</h5>
                                    </div>
                                    <div class="transferDurationCont">
                                        <h4 class="transferHead">DURATION</h4>
                                        <h5 class="transferSubHead">{{ $transfers_data->duration ?? '' }}</h5>
                                    </div>
                                    <div>
                                        <h4 class="transferHead">INCLUDES</h4>
                                        <h5 class="transferSubHead">{{ $transfers_data->includes ?? '' }}</h5>
                                    </div>
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

<!-- Accommodation -->
<div class="tourQuoteHotelCont">
    <h3 class="tourQuoteHotelHead">ACCOMMODATION</h3>
    <?php
        $acco = safeUnserialize($data1->accommodation); 
        $i = 1;
        
        $tourDate = $data1->tour_date ?? '1970-01-01'; 
    ?>
    @if(!empty($acco) && is_array($acco))
        @foreach($acco as $acco_data)
            <div class="tourQuoteHotelBox">
                <div class="tourQuoteHotelTitle">
                    <?php
                        $cityName = class_exists('CustomHelpers') 
                            ? CustomHelpers::get_master_table_data('city', 'id', $acco_data["city"] ?? 0, 'name') 
                            : 'N/A';
                    ?>
                    {{ $cityName }}
                    @if($i > 1)<br>@endif
                </div>
                <div class="tourQuoteHotelDescBox">
                    <div class="makeflex">
                        <div class="hotelImageBox">
                            @if(isset($acco_data["hotel"]) && !empty($acco_data["hotel"]) && $acco_data["hotel"] !== "other")
                                <img src="{{ url('/public/uploads/package_hotel/' . (class_exists('CustomHelpers') ? CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image') : 'default.jpg')) }}" alt="img">
                            @else
                                <img src="{{ url('/public/uploads/no-image.png') }}" alt="img">
                            @endif
                        </div>
                        <div class="hotelDescBox">
                            <div class="hotelTopSection">
                                <div class="hotelType">Hotel</div>
                                <div class="flexCenter">
                                    <div class="tourHotelDtls">
                                        <div>
                                            <h5 class="hotelName">
                                                @if(isset($acco_data["hotel"]) && !empty($acco_data["hotel"]) && $acco_data["hotel"] !== "other")
                                                    {{ class_exists('CustomHelpers') ? CustomHelpers::getpackagerecord($acco_data["hotel"], 'package_hotel', 'hotelname') : 'N/A' }}
                                                @elseif(isset($acco_data["other_hotel"]) && !empty($acco_data["other_hotel"]))
                                                    {{ $acco_data["other_hotel"] }}
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="hotelStarRating">
                                            @if(isset($acco_data["star"]) && !empty($acco_data["star"]) && $acco_data["star"] !== "other")
                                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_star_rating($acco_data["star"]) : 'N/A' }}
                                            @elseif(isset($acco_data["star_other"]) && !empty($acco_data["star_other"]))
                                                {{ class_exists('CustomHelpers') ? CustomHelpers::get_star_rating($acco_data["star_other"]) : 'N/A' }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="hotelCityName">{{ $cityName }}</div>
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
                                            @if($diff->format("%a") > 1) {{ $diff->format("%a Nights") }}
                                            @else {{ $diff->format("%a Night") }}
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="hotelCheckInOut">
                                        <div class="hotelCheckInCont">
                                            <p class="hotelCheckInCont_heading">CHECK-IN</p>
                                            <p class="hotelCheckInCont_date">{{ $checkin_date_print }}</p>
                                        </div>
                                        <div class="hotelCheckOutCont">
                                            <p class="hotelCheckOutCont_heading">CHECKOUT</p>
                                            <p class="hotelCheckOutCont_date">{{ $checkout_date_print }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flexCenterWU">
                                    <div class="hotelRoomCont">
                                        <p class="hotelRoomCont_heading">ROOM TYPE</p>
                                        @if(!empty($acco_data["category"]))
                                            <p class="hotelRoomCont_type">{{ $acco_data["category"] }}</p>
                                        @endif
                                    </div>
                                    @if(!empty($acco_data["hotel_link"]))
                                        <div class="hotelWebCont">
                                            <p class="hotelWebCont_heading">HOTEL WEBSITE</p>
                                            <p class="hotelWebCont_name">{{ $acco_data["hotel_link"] }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; ?>
        @endforeach
    @else
        <p>No accommodation data available.</p>
    @endif
</div>

<!-- Inclusions & Exclusions -->
@if((!empty($data1->inclusions) && $data1->inclusions !== "N;") || (!empty($data1->exclusions) && $data1->exclusions !== "N;"))
    <div class="tourQuoteItineraryCont">
        <div>
            <h3 class="tourQuoteItineraryHead">INCLUSIONS & EXCLUSIONS</h3>
        </div>
        <div class="tourQuoteIncBox">
            <!-- Inclusions Section -->
            @if(!empty($data1->inclusions) && $data1->inclusions !== "N;")
                <div class="tourQuoteInclusions">
                    <h4 class="tourQuoteinclusionHeading">Inclusions</h4>
                    <div class="paddingTop10">
                        <?php 
                            $quote_inc = safeUnserialize($data1->inclusions); 
                        ?>
                        @if(!empty($quote_inc) && is_array($quote_inc))
                            @foreach($quote_inc as $inclusion)
                                <div class="tourQuoteUnlistedItem">
                                    <ul>
                                        <li>{{ $inclusion ?? 'Not Specified' }}</li>
                                    </ul>
                                </div>
                            @endforeach
                        @else
                            <p>No valid inclusions data available.</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Exclusions Section -->
            @if(!empty($data1->exclusions) && $data1->exclusions !== "N;")
                <div class="tourQuoteExclusions">
                    <h4 class="tourQuoteExclusionHeading">Exclusions</h4>
                    <div class="paddingTop10">
                        <?php 
                            $quote_exc = safeUnserialize($data1->exclusions); 
                        ?>
                        @if(!empty($quote_exc) && is_array($quote_exc))
                            @foreach($quote_exc as $exclusion)
                                <div class="tourQuoteUnlistedItem">
                                    <ul>
                                        <li>{{ $exclusion ?? 'Not Specified' }}</li>
                                    </ul>
                                </div>
                            @endforeach
                        @else
                            <p>No valid exclusions data available.</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@else
    <p>No inclusions or exclusions data available for this quote.</p>
@endif

<!-- Overview -->
@if(!empty($data1->description) || !empty($data1->highlights))
    <div class="tourQuoteItineraryCont">
        <div>
            <h3 class="tourQuoteItineraryHead">Tour Overview</h3>
        </div>
        <div class="tourQuoteOverviewBox">
            @if(!empty($data1->description))
                <div class="tourQuoteInclusions">
                    <h4 class="tourQuoteinclusionHeading">Add-On Services</h4>
                    <div class="paddingTop10">{!! $data1->description !!}</div>
                </div>
            @endif
            @if(!empty($data1->highlights))
                <div class="tourQuoteExclusions">
                    <h4 class="tourQuoteExclusionHeading">Tour Highlights</h4>
                    <div class="paddingTop10">{!! $data1->highlights !!}</div>
                </div>
            @endif
        </div>
    </div>
@endif

<!-- Visa Policy -->
@if(($data1->visa ?? 0) == 1 && !empty($data1->visa_p) && $data1->visa_p !== "N;")
    <div class="tourQuoteVisaPolicyCont">
        <div>
            <h3 class="tourQuoteVisaPolicyHead">VISA POLICY</h3>
        </div>
        <div class="tourQuoteVisaPolicyBox">
            <?php $v_policy = safeUnserialize($data1->visa_p); ?>
            @if(!empty($v_policy) && is_array($v_policy))
                @foreach($v_policy as $v)
                    <div class="tourQuoteVisa">
                        <div>{!! class_exists('CustomHelpers') ? CustomHelpers::get_visa_policy($v) : $v !!}</div>
                    </div>
                    <div class="tourQuoteVisaPolicySeparator"></div>
                @endforeach
            @endif
            @if(!empty(trim($data1->visa_policies ?? '')))
                <div class="tourQuoteVisaAddPolicy">{{ $data1->visa_policies }}</div>
            @endif
        </div>
    </div>
@endif

<!-- Booking & Cancellation Policy -->
@if((!empty($data1->payment_p) && $data1->payment_p !== "N;") || (!empty($data1->can_p) && $data1->can_p !== "N;"))
    <div class="tourQuoteBookPolicyCont">
        <div>
            <h3 class="tourQuoteBookPolicyHead">BOOKING AND CANCELLATION POLICY</h3>
        </div>
        <div class="tourQuoteBookPolicyBox">
            @if(!empty($data1->payment_p) && $data1->payment_p !== "N;")
                <?php $p_policy = safeUnserialize($data1->payment_p); ?>
                @if(!empty($p_policy) && is_array($p_policy))
                    @foreach($p_policy as $v)
                        <div class="tourQuoteBooking">
                            <h4 class="tourQuoteBookHeading">Booking Policy</h4>
                            <div>{!! class_exists('CustomHelpers') ? CustomHelpers::get_payment_policy($v) : $v !!}</div>
                        </div>
                    @endforeach
                @endif
                @if(!empty(trim($data1->payment_policy ?? '')))
                    <div class="tourQuoteBookAddPolicy">{{ $data1->payment_policy }}</div>
                @endif
                <div class="tourQuoteBookPolicySeparator"></div>
            @endif
            @if(!empty($data1->can_p) && $data1->can_p !== "N;")
                <?php $c_policy = safeUnserialize($data1->can_p); ?>
                @if(!empty($c_policy) && is_array($c_policy))
                    @foreach($c_policy as $v)
                        <div class="tourQuoteCancellation">
                            <h4 class="tourQuoteCancelHeading">Cancellation Policy</h4>
                            <div>{!! class_exists('CustomHelpers') ? CustomHelpers::get_cancel_policy($v) : $v !!}</div>
                        </div>
                    @endforeach
                @endif
                @if(!empty(trim($data1->cancel_policy ?? '')))
                    <div class="tourQuoteCancelAddPolicy">{{ $data1->cancel_policy }}</div>
                @endif
            @endif
        </div>
    </div>
@endif

<!-- Important Notes -->
@if(!empty($data1->imp_notes) && $data1->imp_notes !== "N;")
    <div class="tourQuoteImpCont">
        <div>
            <h3 class="tourQuoteImpHead">IMPORTANT NOTES</h3>
        </div>
        <div class="tourQuoteImpBox">
            <?php $important_notes = safeUnserialize($data1->imp_notes); ?>
            @if(!empty($important_notes) && is_array($important_notes))
                @foreach($important_notes as $v)
                    <div class="tourQuoteImp">
                        <div>{!! class_exists('CustomHelpers') ? CustomHelpers::get_impnotes($v) : $v !!}</div>
                    </div>
                @endforeach
            @endif
            @if(!empty(trim($data1->extra_notes ?? '')))
                <div class="tourQuoteImpAddPolicy">{{ $data1->extra_notes }}</div>
            @endif
        </div>
    </div>
@endif

<!-- Raise Concern or Pay Button -->
<div class="touQuoteBookFooterCont">
    @include("query.quotation_webpage.accept")
</div>

<!-- Footer -->
@if(!empty($data1->quote_footer))
    <?php
        $footer_id = $data1->quote_footer;
        $footer_data = DB::table('quotation_footer')->where('id', $footer_id)->first();
    ?>
    <div class="tourQuoteFooterCont">
        @if($footer_data)
            {!! $footer_data->footer_desc ?? '' !!}
        @endif
    </div>
@endif

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>