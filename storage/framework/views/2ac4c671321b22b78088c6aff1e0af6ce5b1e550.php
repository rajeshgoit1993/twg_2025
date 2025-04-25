    <div class="tourQuoteWebHeadCont">
        <p>Dear <?php echo e($data1->name); ?>,</p>
        <?php if($data1!="" && $data1->quote_header!=""): ?>
            <?php 
                $header_id=$data1->quote_header;
                $header_data=DB::table('quotation_header')->where('id',$header_id)->first();
            ?>
            <?php if($header_data!=''): ?>
                <?php echo $header_data->header_desc; ?>

            <?php endif; ?>
        <?php endif; ?>
        <?php if($data1->accept_status=="0" && $data1->send_option=="1"): ?>
        <?php endif; ?>
    </div>

    <!-- Title & Services -->
    <div class="tourQuoteSummaryCont">
        <div>
            <h4 class="tourQuoteTitle"><?php echo e($data1->custom_package_name); ?></h4>
            <h5 class="tourQuoteDaysBadge"><?php echo e($data1->duration-1); ?> Nights / <?php echo e($data1->duration); ?> Days</h5>
        </div>
        <div class="touQuoteBookCont">
            <div>
                <h5 class="tourQuoteServiceTitle">Included in this package</h5>
                <!--Check service icons-->
                <div id="mobscroll" class="mobscroll overflowX"></div>
                
                <!--Check service icons // Remove this-->
                <div class="flexCenter">
                <?php $package_service=unserialize($data1->package_service); ?>
                <?php if(empty($package_service)): ?>
                <?php else: ?>
                    <?php $__currentLoopData = $package_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="tourQteSvcIcns">
                        <div class="tourQteSvcIcnImg">
                            <img src="<?php echo e(url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon'))); ?>" alt="img">
                        </div>
                        <div class="tourQteSvcTtl"><?php echo e($icon); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Accept, Reject or Pay Button -->
            <div>
                <?php echo $__env->make("query.quotation_webpage.accept", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php
                    $price_data_first = CustomHelpers::get_price_part_seperate(
        $data1->price,
        $data1->adult,
        $data1->extra_adult,
        $data1->child_with_bed,
        $data1->child_without_bed,
        $data1->infant,
        $data1->solo_traveller
    );
                ?>
            </div>
        </div>
    </div>

    <!-- Departure City, Tour Date,Pricing & Quote Validity -->
    <div class="tourQuoteDatePricingCont">
        <div class="makeflex">
            <!--Departure City-->
            <div class="tourQuoteCityBox">
                <h4 class="tourQuoteCityBoxHead">DEPARTURE CITY</h4>
                <h3 class="tourQuoteCityName"><?php echo e(CustomHelpers::get_master_table_data('city', 'id',  $data1->sourcecity, 'name')); ?></h3>
            </div>

            <!--Tour Date-->
            <div class="tourQuoteDateBox">
                <h4 class="tourQuoteDateBoxHead">TOUR DATE</h4>
                <?php
                    $originalDate = $data1->tour_date;
                    
                    if($originalDate=="N" || $originalDate==""):
                        $originalDate=date("d-m-Y");
                    endif;
                    
                    $datefrom = str_replace(' ', '', $originalDate);
                    $datefrom=explode("-", $datefrom);
                    
                    $datefrom_year=$datefrom["2"];
                    $datefrom_day=$datefrom["1"];                   
                    $datefrom_month=$datefrom["0"];

                    $datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
                    
                    $datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
                    $stop_date = $datefrom;
                    $date_to=$datefrom;

                    $datefrom_print = date("d M Y", strtotime($datefrom));
                    $day_from = strtotime($datefrom);
                    $day_from = date('D', $day_from);
                    
                    $to_days=$data1->duration-1;
                    
                    $stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
                    $stop_date_print= date("d M Y", strtotime($stop_date));

                    $day_to = strtotime($stop_date);
                    $day_to = date('D', $day_to);
                ?>
                <!-- <h3 class="tourQuoteDepDate"><?php echo "$day_from"; ?>, <?php echo e($datefrom_print); ?></h3> -->
                <h3 class="tourQuoteDepDate"><?php echo e($datefrom_print); ?></h3>
                <p class="tourQuoteDateBoxHead appendTop10">TO</p>
                <!-- <p class="tourQuoteRetDate"><?php echo "$day_to"; ?>, <?php echo e($stop_date_print); ?></p> -->
                <p class="tourQuoteRetDate"><?php echo e($stop_date_print); ?></p>
            </div>

            <!--Pricing-->
            <div class="tourQuotePriceBox">
               
            <?php if($data1->price_type==1): ?>
            <div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>

                    <p class="tourQuotePriceValue defaultCurrency"> <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_group']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))); ?>

                </p>

               

                </div>
                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">Discount (-)</p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
                   

                    <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_discount_group']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))); ?>


                </p>
                </div>
                <?php if(round($price_data_first['query_total_gst_group']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0): ?>

                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">GST <?php if($price_data_first['query_gst_curr']==2): ?>&nbsp;(<?php echo e($price_data_first['gst_percentage']); ?>%) <?php endif; ?></p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
                        <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))); ?>

                       
                </p>
                </div>
                <?php endif; ?>
                <?php if(round($price_data_first['query_total_tcs_group']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0): ?>
                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">TCS <?php if($price_data_first['query_tcs_curr']==2): ?>&nbsp;(<?php echo e($price_data_first['tcs_percentage']); ?>%) <?php endif; ?></p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
                        <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))); ?>

                   
                </p>
                </div>
                <?php endif; ?>
                <?php if(round($price_data_first['query_total_pg_group']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0): ?>
                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">PG  
                        <?php if($price_data_first['pg_charges']==2): ?>&nbsp;(<?php echo e($price_data_first['pgcharges_percentage']); ?>%) <?php endif; ?></p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
                        <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))); ?>

                   
                </p>
                </div>
                <?php endif; ?>
                <div class="tourQuotePriceSeparator"></div>
                <div class="flexBetween">
                    <div>
                        <p class="tourQuotePriceTotal">Grand Total</p>
                        <p class="tourQuotePriceTagline">( <?php echo e($data1->anything); ?> )</p>
                    </div>
                    <div>
                        <p class="tourQuotePriceTotalValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
                            <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult']/($data1->adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))); ?>

                       
                    </p>
                    </div>
                </div>
            </div>
            <?php elseif($data1->price_type==2): ?>
            <div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span> <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_group'])); ?></p>
                </div>
                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">Discount (-)</p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span> <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group'])); ?></p>
                </div>
                <?php if(round($price_data_first['query_total_gst_group'])>0): ?>

                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">GST <?php if($price_data_first['query_gst_curr']==2): ?>&nbsp;(<?php echo e($price_data_first['gst_percentage']); ?>%) <?php endif; ?></p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span> <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group']))); ?></p>
                </div>
                <?php endif; ?>
                <?php if(round($price_data_first['query_total_tcs_group'])>0): ?>
                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">TCS <?php if($price_data_first['query_tcs_curr']==2): ?>&nbsp;(<?php echo e($price_data_first['tcs_percentage']); ?>%) <?php endif; ?></p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group']))); ?></p>
                </div>
                <?php endif; ?>

                <?php if(round($price_data_first['query_total_pg_group'])>0): ?>

                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceBoxSubHead">PG  
                        <?php if($price_data_first['pg_charges']==2): ?> selected 
                  (<?php echo e($price_data_first['pgcharges_percentage']); ?>%)
                   <?php endif; ?></p>
                    <p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span> <?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group']))); ?></p>
                </div>
                <?php endif; ?>
                <div class="tourQuotePriceSeparator"></div>
                <div class="makeflexCenterBewtween">
                    <p class="tourQuotePriceTotal">Grand Total</p>
                    <p class="tourQuotePriceTotalValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php echo e(CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult']))); ?></p>
                </div>
            </div>
            <?php endif; ?>
            <i><!--traveller(s)--></i>
            </div>
        </div>

        <!-- Quote Validity -->
        <?php if($data1->validity_show_on_frontend=='No'): ?>
        <?php if($data1->quote_validity!=""): ?>
            <div class="tourQuoteValidity">QUOTE VALIDITY - <?php echo e(date("d M Y", strtotime(str_replace('/','-',$data1->quote_validity)))); ?>

                <?php if($data1->validity_time!='23:59:59'): ?>
                <?php echo e($data1->validity_time); ?>

                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php else: ?>
            <div class="tourQuoteValidity">
                Pay Immediately
            </div>
        <?php endif; ?>
        <!--Quote Validity ends-->
    </div>

    <!-- Transport -->
    <?php $flight_detail=unserialize($data1->flight); ?>
    <?php if(array_key_exists('flightOption',$flight_detail) && $flight_detail['flightOption']==1): ?> 
        <div class="tourQuoteFlightCont">
            <?php $flight_detail=unserialize($data1->flight); ?>
            <div>
                <h3 class="tourQuoteFlightHead">FLIGHT DETAILS</h3>
            </div>
            <div class="">
                <!--Upward Flight Starts-->
                <div class="tourQuoteOnwardFlightBox">

                    <!--Upward Flight Origin - Destination-->
                    <div class="flexCenter apndBtm10">
                        <div class="appendRight20">
                        <?php if(array_key_exists('origin',$flight_detail) && $flight_detail['origin']==0): ?> 
                            <span class="flightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['origin'],'previous_data')); ?></span>
                        <?php endif; ?>
                            <span class="flightCityName">-</span> 
                        <?php if($flight_detail['dest']!=""): ?>
                            <span class="flightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['dest'],'previous_data')); ?></span>
                        <?php endif; ?>
                        </div>
                        <div>
                        <?php if(array_key_exists('onwarddate',$flight_detail)): ?> <?php if($flight_detail['onwarddate']!=""): ?>
                            <!-- <?php
                                $originalDate_flight = str_replace('/','-',$flight_detail['onwarddate']);
                                $newDate_flight = date("d M Y", strtotime($originalDate_flight));
                            ?>
                            <span class="flightDate"><?php echo e(date('D', strtotime($originalDate_flight))); ?>, <?php echo e($newDate_flight); ?></span> -->
                            <span class="flightDate"><?php echo e(date('d M Y', strtotime($originalDate_flight))); ?></span>
                          <?php endif; ?> 
                          <?php endif; ?>
                        </div>
                    </div>

                    <!--Upward Flight Details-->    
                    <div class="onwardFlightBox">
                        <div class="flexCenter appendBottom15">
                            <?php if(array_key_exists('onwarddate',$flight_detail)): ?> <?php if($flight_detail['onwarddate']!=""): ?>
                            <?php
                                $originalDate_flight = $flight_detail['onwarddate'];
                                $newDate_flight = date("d M Y", strtotime($originalDate_flight));
                            ?>
                            <!--<span class="fontWeight600 font18 color4A"><?php echo e(date('D', strtotime($originalDate_flight))); ?>, <?php echo e($newDate_flight); ?></span>-->
                            <?php endif; ?>
                            <?php endif; ?>
                            <span class="flightStop">
                                <?php if($flight_detail['numberstop']!=""): ?>
                                    <?php echo e($flight_detail['numberstop']); ?> 
                                <?php endif; ?>
                            </span>
                            <div class="classSeparator"></div>
                            <span class="flightClass">
                                <?php if(array_key_exists('cabin',$flight_detail)): ?>
                                    <?php echo e(CustomHelpers::get_flight_class_name($flight_detail['cabin'])); ?>

                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="flexCenter appendLeft20">
                            <div class="appendRight10">
                                <!--<p class="pfwmt fontSize18 lineHeight22 textCenter"><?php if($flight_detail['name']!=""): ?> <?php echo e($flight_detail['name']); ?> <?php endif; ?></p>-->
                                <div class="airlineLogoBox">
                                    <img src="<?php echo e(url('/resources/assets/frontend/images/icon/airlineIndigo.png')); ?>"
                                        onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
                                </div>
                            </div>
                            <div class="appendRight20 W120">
                                <p class="flightName"><?php if($flight_detail['name']!=""): ?> <?php echo e($flight_detail['name']); ?> <?php endif; ?></p>
                                <p class="flightNumber"><?php if($flight_detail['no']!=""): ?> <?php echo e($flight_detail['no']); ?> <?php endif; ?></p>
                            </div>
                            <div class="W100">
                                <p class="flightTiming">
                                    <!-- <?php if($flight_detail['dhours']!=""): ?>
                                        <?php echo e($flight_detail['dhours']); ?> 
                                    <?php endif; ?>
                                    <?php echo e(':'); ?>

                                    <?php if($flight_detail['ddmins']!=""): ?>
                                        <?php if($flight_detail['ddmins']=='0'): ?>00
                                        <?php else: ?>
                                            <?php echo e($flight_detail['ddmins']); ?> 
                                        <?php endif; ?> 
                                    <?php endif; ?> -->
                                    <?php if(!empty($flight_detail['dhours'])): ?>
                                        <?php echo e(str_pad($flight_detail['dhours'], 2, '0', STR_PAD_LEFT)); ?>

                                    <?php endif; ?>
                                    <?php echo e(':'); ?>

                                    <?php if(isset($flight_detail['ddmins'])): ?>
                                        <?php if($flight_detail['ddmins'] === '0' || $flight_detail['ddmins'] === 0): ?>
                                            00
                                        <?php else: ?>
                                            <?php echo e(str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT)); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                </p>
                                
                                <p class="flightCity">
                                    <!-- <?php if($flight_detail['origin']!=""): ?>
                                        <?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['origin'],'last_str')); ?> 
                                    <?php endif; ?> -->

                                    <?php echo e(!empty($flight_detail['origin']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'last_str')) : ''); ?>

                                </p>

                            </div>
                            <div class="flightDurationCont">
                                <!-- <p class="flightDuration"><?php if(array_key_exists('duration_hours',$flight_detail)): ?> <?php echo e($flight_detail['duration_hours']); ?>h <?php endif; ?>
                                <?php if(array_key_exists('duration_dmins',$flight_detail)): ?> <?php echo e($flight_detail['duration_dmins']); ?>m <?php endif; ?></p> -->
                                <p class="flightDuration">
                                <?php echo e(array_key_exists('duration_hours', $flight_detail) ? $flight_detail['duration_hours'] . 'h ' : ''); ?>

                                <?php echo e(array_key_exists('duration_dmins', $flight_detail) ? $flight_detail['duration_dmins'] . 'm' : ''); ?>

                            </p>

                                <div class="flexCenter">
                                    <i class="fa-plane" aria-hidden="true"></i>
                                    <div class="flightPathWay"></div>
                                    <i class="fa-map-marker" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="W100">
                                <p class="flightTiming">
                                    <!-- <?php if($flight_detail['ahours']!=""): ?>
                                        <?php echo e($flight_detail['ahours']); ?> 
                                    <?php endif; ?>:
                                    <?php if($flight_detail['damins']!=""): ?>
                                        <?php if($flight_detail['damins']==0): ?>
                                            00 
                                        <?php else: ?>
                                            <?php echo e($flight_detail['damins']); ?> 
                                        <?php endif; ?> 
                                    <?php endif; ?> -->
                                    <?php if(!empty($flight_detail['ahours'])): ?>
                                        <?php echo e(str_pad($flight_detail['ahours'], 2, '0', STR_PAD_LEFT)); ?>

                                    <?php endif; ?>
                                    <?php echo e(':'); ?>

                                    <?php if(isset($flight_detail['damins'])): ?>
                                        <?php if($flight_detail['damins'] === '0' || $flight_detail['damins'] === 0): ?>
                                            00
                                        <?php else: ?>
                                            <?php echo e(str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT)); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                </p>
                                <p class="flightCity">
                                    <!-- <?php if($flight_detail['dest']!=""): ?>
                                        <?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['dest'],'last_str')); ?> 
                                    <?php endif; ?> -->
                                    <?php echo e(!empty($flight_detail['dest']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'last_str')) : ''); ?>

                                </p>
                            </div>
                        </div>
                        <p class="baggageTitle">Baggage info</p>
                        <div class="flexCenter">
                            <span class="baggageSubTitle color4A">Cabin:&ensp;</span>
                            <!-- <span class="baggageSubTitle">
                                <?php if(array_key_exists('baggage',$flight_detail)): ?>
                                    <?php echo e($flight_detail['baggage']); ?> 
                                <?php endif; ?>
                            </span> -->
                            <span class="baggageSubTitle">
                                <?php echo e($flight_detail['baggage'] ?? ''); ?>

                            </span>

                            <div class="baggageSeparator"></div>
                            <span class="baggageSubTitle color4A">Check in:&ensp;</span>
                            <span class="baggageSubTitle">
                                <?php echo e($flight_detail['cbaggage'] ?? ''); ?>

                            </span>
                        </div>
                    </div>
                </div>
                <!--Upward Flight Ends-->

                <!--Return Flight Starts-->
                <div class="tourQuoteReturnFlightBox">
                    <!--Return Flight Origin - Destination-->
                    <div class="flexCenter apndBtm10">
                        <div class="appendRight20">
                            <?php if($flight_detail['dOrigin']!=""): ?>
                                <span class="flightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'],'previous_data')); ?></span>
                            <?php endif; ?>
                                <span class="flightCityName">-</span> 
                            <?php if($flight_detail['ddest']!=""): ?>
                                <span class="flightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['ddest'],'previous_data')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if(array_key_exists('downwarddate',$flight_detail)): ?> 
                                <?php if($flight_detail['downwarddate']!=""): ?>
                                <!-- <?php
                                    $originalDate_flight_down = str_replace('/','-',$flight_detail['downwarddate']);
                                    $newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
                                ?>
                                <span class="flightDate"><?php echo e(date('D', strtotime($originalDate_flight_down))); ?>, <?php echo e($newDate_flight_down); ?></span> -->
                                <span class="flightDate"><?php echo e(date('d M Y', strtotime($originalDate_flight_down))); ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!--Return Flight Details-->
                    <div class="returnFlightBox">
                        <div class="flexCenter appendBottom15">
                            <!-- <?php if(array_key_exists('downwarddate',$flight_detail)): ?> 
                                <?php if($flight_detail['downwarddate']!=""): ?>
                                <?php
                                    $originalDate_flight_down = $flight_detail['downwarddate'];
                                    $newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
                                ?>
                                <span class="fontWeight600 font18 color4A"><?php echo e(date('D', strtotime($originalDate_flight_down))); ?>, <?php echo e($newDate_flight_down); ?></span>
                                <?php endif; ?> 
                            <?php endif; ?> -->
                            <!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
                            <span class="flightStop">
                                <?php if($flight_detail['numberstop']!=""): ?>
                                    <?php echo e($flight_detail['numberstop']); ?> 
                                <?php endif; ?>
                            </span>
                            <div class="classSeparator"></div>
                            <span class="flightClass">
                                <?php if(array_key_exists('dcabin',$flight_detail)): ?>
                                    <?php echo e(CustomHelpers::get_flight_class_name($flight_detail['dcabin'])); ?> Class 
                                <?php endif; ?>
                            </span>
                          <!--<div style="border-left: 2px solid #ccc;height: 24px;margin-left: 10px;"></div>-->
                        </div>
                        <div class="flexCenter appendLeft20">
                            <div class="appendRight10">
                                <!--<p class="pfwmt fontSize18 lineHeight22 textCenter"><?php if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!=""): ?> <?php echo e($flight_detail['dname']); ?> <?php endif; ?></p>-->
                                <div class="airlineLogoBox">
                                    <img src="<?php echo e(url('/resources/assets/frontend/images/icon/airlineIndigo.png')); ?>"
                                        onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
                                </div>
                            </div>
                            <div class="appendRight20 W120">
                                <p class="flightName">
                                    <?php if($flight_detail['name']!=""): ?>
                                        <?php echo e($flight_detail['name']); ?> 
                                    <?php endif; ?>
                                </p>
                                <p class="flightNumber">
                                    <?php if(array_key_exists("dno", $flight_detail)
                                    && $flight_detail['dno']!=""): ?>
                                        <?php echo e($flight_detail['dno']); ?> 
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="W100">
                                <p class="flightTiming">
                                    <!-- <?php if($flight_detail['ddhours']!=""): ?>
                                        <?php echo e($flight_detail['ddhours']); ?> <?php endif; ?>:<?php if($flight_detail['ddmins']!=""): ?> <?php if($flight_detail['ddmins']=='0'): ?> 00 
                                        <?php else: ?>
                                            <?php echo e($flight_detail['ddmins']); ?> 
                                        <?php endif; ?> 
                                    <?php endif; ?> -->

                                    <?php if(!empty($flight_detail['ddhours'])): ?>
                                        <?php echo e(str_pad($flight_detail['ddhours'], 2, '0', STR_PAD_LEFT)); ?>

                                    <?php endif; ?>
                                    <?php echo e(':'); ?>

                                    <?php if(isset($flight_detail['ddmins'])): ?>
                                        <?php if($flight_detail['ddmins'] === '0' || $flight_detail['ddmins'] === 0): ?>
                                            00
                                        <?php else: ?>
                                            <?php echo e(str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT)); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                </p>

                                <p class="flightCity">
                                    <!-- <?php if(array_key_exists("dOrigin", $flight_detail)
                                    && $flight_detail['dOrigin']!=""): ?>
                                        <?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'],'last_str')); ?> 
                                    <?php endif; ?> -->
                                
                                    <?php echo e(!empty($flight_detail['dOrigin']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'last_str')) : ''); ?>

                                </p>

                            </div>
                            <div class="flightDurationCont">
                                <!-- <p class="flightDuration">
                                    <?php if(array_key_exists('return_duration_hours',$flight_detail)): ?>
                                        <?php echo e($flight_detail['return_duration_hours']); ?>h 
                                    <?php endif; ?>
                                    <?php if(array_key_exists('return_duration_mins',$flight_detail)): ?>
                                        <?php echo e($flight_detail['return_duration_mins']); ?>m 
                                    <?php endif; ?>
                                </p> -->
                                <p class="flightDuration">
                                    <?php echo e(array_key_exists('return_duration_hours', $flight_detail) ? $flight_detail['return_duration_hours'] . 'h ' : ''); ?>

                                    <?php echo e(array_key_exists('return_duration_mins', $flight_detail) ? $flight_detail['return_duration_mins'] . 'm' : ''); ?>

                                </p>

                                <div class="flexCenter">
                                    <i class="fa-plane" aria-hidden="true"></i>
                                    <div class="flightPathWay"></div>
                                    <i class="fa-map-marker" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="W100">
                                <p class="flightTiming">
                                    <!-- <?php if($flight_detail['dahours']!=""): ?>
                                        <?php echo e($flight_detail['dahours']); ?> <?php endif; ?>:
                                        <?php if($flight_detail['damins']!=""): ?> 
                                            <?php if($flight_detail['damins']=='0'): ?> 00 
                                        <?php else: ?> <?php echo e($flight_detail['damins']); ?>

                                        <?php endif; ?>
                                    <?php endif; ?> -->
                                
                                    <?php if(!empty($flight_detail['dahours'])): ?>
                                        <?php echo e(str_pad($flight_detail['dahours'], 2, '0', STR_PAD_LEFT)); ?>

                                    <?php endif; ?>
                                    <?php echo e(':'); ?>

                                    <?php if(isset($flight_detail['damins'])): ?>
                                        <?php if($flight_detail['damins'] === '0' || $flight_detail['damins'] === 0): ?>
                                            00
                                        <?php else: ?>
                                            <?php echo e(str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT)); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                </p>

                                <p class="flightCity">
                                    <!-- <?php if(array_key_exists("ddest", $flight_detail)
                                    && $flight_detail['ddest']!=""): ?>
                                        <?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['ddest'],'last_str')); ?> 
                                    <?php endif; ?> -->

                                    <?php echo e(!empty($flight_detail['ddest']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'last_str')) : ''); ?>

                                </p>

                            </div>
                        </div>
                        <p class="baggageTitle">Baggage info</p>
                        <div class="flexCenter">
                            <span class="baggageSubTitle color4A">Cabin:&ensp;</span>
                            <span class="baggageSubTitle">
                                <?php echo e($flight_detail['baggage'] ?? ''); ?>

                            </span>
                            <div class="baggageSeparator"></div>
                            <span class="baggageSubTitle color4A">Check in:&ensp;</span>
                            <span class="baggageSubTitle">
                                <?php echo e($flight_detail['cbaggage'] ?? ''); ?>

                            </span>
                        </div>
                    </div>
                </div>
                <!--Return Flight Ends-->
            </div>
        </div>
    <?php endif; ?>

    <!-- Transfers -->
    <?php 

    ?>
    <?php if($data1->transfers!=''
        && unserialize($data1->transfers)!='N;' 
        && is_array(unserialize($data1->transfers))): ?> 
        <div class="tourQuoteTransferCont">
            <div>
                <h3 class="tourQuoteTransferHead">TRANSFERS</h3>
            </div>
            <?php 
                $transfers=unserialize($data1->transfers); 

            ?>
            <?php $a=0; ?>
            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php if(array_key_exists('transport_type',$col) && array_key_exists('transfers_type',$col)): ?>
                <?php
                 $transfers_data=DB::table('rt_transfer_list')->where([['transport_type','=',$col['transport_type']],['title','=',$col['transfers_type']]])->first();

                ?>  
                <div class="tourQuoteTransferBox">
                    <div class="tourQuoteTransferTitle"><?php echo e($col['mode_title']); ?></div>
                    <div class="tourQuoteTransferDescBox">
                        <div class="makeflex">
                            <!--Vehicle Image-->
                            <div class="transferImageBox">
                                <!-- <?php if($transfers_data!='' && $transfers_data->transfer_image!=''): ?>
                                <img src="<?php echo e(url('/public/uploads/transfer_image/'.$transfers_data->transfer_image)); ?>" alt="img">  
                                <?php endif; ?> -->

                                <?php if($transfers_data != ''): ?>
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
                                <!--Private, Shared or Coach-->
                                <div class="transferDescTopSection">
                                    <h4 class="transferTitle"><?php echo e($col['mode_title']); ?></h4>
                                    <h2 class="transportType">
                                        <?php if($transfers_data!='' 
                                            && $transfers_data->transfer_type!=''): ?> 
                                            <?php echo e($transfers_data->transfer_type); ?> 
                                        <?php endif; ?>
                                    </h2>
                                </div>
                                <!--Vehicle Type,Duration & Inclusion-->
                                <div class="flexCenter">
                                    <div class="transferVehicleCont">
                                        <h4 class="transferHead">VEHICLE TYPE</h4>
                                        <h5 class="transferSubHead">
                                            <?php if($transfers_data!='' 
                                                && $transfers_data->vehicle_type!=''): ?> 
                                                <?php echo e($transfers_data->vehicle_type); ?> 
                                            <?php endif; ?>
                                        </h5>
                                    </div>
                                    <div class="transferDurationCont">
                                        <h4 class="transferHead">DURATION</h4>
                                        <h5 class="transferSubHead"><?php if($transfers_data!='' 
                                            && $transfers_data->duration!=''): ?> 
                                            <?php echo e($transfers_data->duration); ?> 
                                        <?php endif; ?>
                                    </h5>
                                    </div>
                                    <div>
                                        <h4 class="transferHead">INCLUDES</h4>
                                        <h5 class="transferSubHead">
                                            <?php if($transfers_data!='' 
                                            && $transfers_data->includes!=''): ?> 
                                            <?php echo e($transfers_data->includes); ?> 
                                        <?php endif; ?>
                                    </h5>
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
            $acco=unserialize($data1->accommodation);
            $i="1";
            // dd($acco);
        ?>
        <?php $__currentLoopData = $acco; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acco_data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="tourQuoteHotelBox">
                <div class="tourQuoteHotelTitle"><?php echo e(CustomHelpers::get_master_table_data('city', 'id', $acco_data["city"], 'name')); ?>

                    <?php if($i>1): ?>
                    <br>
                    <?php endif; ?>
                </div>
                <div class="tourQuoteHotelDescBox">
                    <div class="makeflex">
                        <!--Property Image-->
                        <div class="hotelImageBox">
                            <?php if(array_key_exists("hotel",$acco_data)): ?>
                            <?php if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other"): ?>
                                <img src="<?php echo e(url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image'))); ?>" alt="img">
                            <?php elseif($acco_data["hotel"]=="other"): ?>
                                <img src="<?php echo e(url('/public/uploads/no-image.png')); ?>" alt="img">
                            <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('/public/uploads/no-image.png')); ?>" alt="img">
                            <?php endif; ?>
                        </div>
                        <div class="hotelDescBox">
                            <div class="hotelTopSection">
                                <div class="hotelType">Hotel</div>

                                <!--Hotel Name-->
                                <div class="flexCenter">
                                    <div class="tourHotelDtls">
                                    <div>
                                        <h5 class="hotelName">
                                        <?php if(array_key_exists("hotel",$acco_data) && $acco_data["hotel"]!="" && $acco_data["hotel"]!="other"): ?>    <?php echo e(CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')); ?>

                                        <?php echo e(CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')); ?>

                                        <?php elseif(array_key_exists("other_hotel",$acco_data) && $acco_data["other_hotel"]!=""): ?>
                                        <?php echo e($acco_data["other_hotel"]); ?>

                                        <?php endif; ?>
                                        </h5>
                                    </div>
                                    <div class="hotelStarRating">
                                        <?php if(array_key_exists("star",$acco_data) && $acco_data["star"]!="" && $acco_data["star"]!="other"): ?> <?php echo e(CustomHelpers::get_star_rating($acco_data["star"])); ?>

                                        <?php elseif(array_key_exists("star_other",$acco_data) && $acco_data["star_other"]!=""): ?>  <?php echo e(CustomHelpers::get_star_rating($acco_data["star_other"])); ?>

                                        <?php endif; ?>
                                    </div>
                                    </div>
                                </div>

                                <!--Destination City Name-->
                                <div class="hotelCityName"><?php echo e(CustomHelpers::get_master_table_data('city', 'id', $acco_data["city"], 'name')); ?></div>
                            </div>

                            <!--No of Nights & Check-in & Checkout-->
                            <div class="HotelFooter">
                                <?php
                                            $day1 = "0";
                                            $day = "0";
                                        ?>
                                        <?php if($acco_data!="" && array_key_exists("night",$acco_data)): ?>
                                            <?php
                                                $day1 = (int)filter_var($acco_data["night"]["0"], FILTER_SANITIZE_NUMBER_INT);
                                                $day1 = $day1-1;
                                            ?>
                                        <?php endif; ?>
                                        <?php
                                            $datefrom_checkin = "$datefrom_year-$datefrom_day-$datefrom_month";
                                            $checkin_date = date('Y-m-d', strtotime($datefrom_checkin . '+' . $day1 . ' days'));
                                            $checkin_date_print= date("d M Y", strtotime($checkin_date));
                                            $day_checkin = strtotime($checkin_date);
                                            $day_checkin = date('D', $day_checkin);
                                        ?>
                                        <?php if($acco_data!="" && array_key_exists("night",$acco_data)): ?>
                                            <?php $__currentLoopData = $acco_data["night"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <?php $day = (int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php endif; ?>
                                        <?php
                                            $datefrom_checkout = "$datefrom_year-$datefrom_day-$datefrom_month";
                                            $checkout_date = date('Y-m-d', strtotime($datefrom_checkout . ' +'.$day.' days'));
                                            $checkout_date_print = date("d M Y", strtotime($checkout_date));
                                            $day_checkout = strtotime($checkout_date);
                                            $day_checkout = date('D', $day_checkout);
                                        ?>
                                <div class="makeflex appendBottom20">
                                    <!-- No of Nights -->
                                    <div class="hotelDaysBadge">
                                        <h5 class="hoteDaysBadge_heading">NO OF NIGHTS</h5>                                     
                                        <h5 class="hotelDaysBadge_nightCount">
                                            <?php
                                                $date1=date_create($checkin_date);
                                                $date2=date_create($checkout_date);
                                                $diff=date_diff($date1,$date2);
                                            ?>
                                            <?php if($diff->format("%a")>1): ?> <?php echo e($diff->format("%a Nights")); ?> 
                                            <?php else: ?> <?php echo e($diff->format("%a Night")); ?> 
                                            <?php endif; ?>
                                        </h5>
                                    </div>

                                    <!--Check-in & Checkout-->
                                    <div class="hotelCheckInOut">
                                        <div class="hotelCheckInCont">
                                            <p class="hotelCheckInCont_heading">CHECK-IN </p>
                                            <!-- <p class="hotelCheckInCont_date"><?php echo $day_checkin; ?>, <?php echo e($checkin_date_print); ?></p> -->
                                            <p class="hotelCheckInCont_date"><?php echo e($checkin_date_print); ?></p>
                                        </div>
                                        <div class="hotelCheckOutCont">
                                            <p class="hotelCheckOutCont_heading">CHECKOUT </p>
                                            <!-- <p class="hotelCheckOutCont_date"><?php echo $day_checkin; ?>, <?php echo e($checkout_date_print); ?></p> -->
                                            <p class="hotelCheckOutCont_date"><?php echo e($checkout_date_print); ?></p>
                                            </div>
                                    </div>
                                </div>

                                <div class="flexCenter">
                                    <!-- Room Type -->
                                    <div class="hotelRoomCont">
                                        <p class="hotelRoomCont_heading">ROOM TYPE</p>
                                        <?php if($acco_data["category"]!=""): ?>
                                        <p class="hotelRoomCont_type"><?php echo e($acco_data["category"]); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Hotel Website -->
                                    <?php if($acco_data["hotel_link"]!=""): ?>
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
    </div>

    <!-- Itinerary -->
    <?php 
    $itinerary_data=unserialize($data1->day_itinerary); 

    ?>

    <?php if(!empty($itinerary_data['itineraryOption']) && $itinerary_data['itineraryOption'] == 1): ?>
<div class="tourQuoteItineraryCont">
<h3 class="tourQuoteItineraryHead">TOUR ITINERARY</h3>
<?php 

$day_count = count($itinerary_data); ?>
 <?php for($i=1 ; $i<= $day_count ; $i++): ?>
 <?php if(array_key_exists('day' . $i, $itinerary_data)): ?>
<div class="tourQuoteItineraryBox">
                <div class="makeflex">
                    <div class="tourQuoteLeftBorderMarker"></div>
                    <div class="flex-column">
                        <h3 class="tourQuoteDayPlanHead">DAY <?php echo e($i); ?></h3>
                        <h5 class="tourQuoteDayPlanSubHead"><?php echo e($itinerary_data["day$i"]["title"]); ?>"</h5>
                    </div>
                </div>
                <div class="dayDescription appendBottom10">
                    <p><?php echo e($itinerary_data["day$i"]["desc"]); ?></p>
                </div>
            </div>
            <div class="tourQuoteItinerarySeparator"></div>


<?php endif; ?>
                      <?php endfor; ?>


                      </div>
    <?php endif; ?>
    

    <!-- Inclusions -->
    <?php if((($data1->tour_inc!='' && $data1->tour_inc!="N;") || $data1->inclusions!='') || (($data1->tour_exc!='' && $data1->tour_exc!="N;") || $data1->exclusions!='')): ?>
        <div class="tourQuoteItineraryCont">
            <div>
                <h3 class="tourQuoteItineraryHead">INCLUSIONS & EXCLUSIONS</h3>
            </div>
            <div class="tourQuoteIncBox">
                <!--Inclusions-->
                <?php if(($data1->tour_inc!='' && $data1->tour_inc!="N;") || $data1->inclusions!=''): ?>

                <div class="tourQuoteInclusions">
                    <h4 class="tourQuoteInclusionHeading">Inclusions</h4>
                    <div class="paddingTop10">
                    <?php 
                    $option1_quote_inc=unserialize($data1->tour_inc); 

                    ?>
                    <?php if($option1_quote_inc!=''): ?>
                    <?php $__currentLoopData = $option1_quote_inc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="tourQuoteUnlistedItem">
                        <ul>
                            <li><?php echo e(CustomHelpers::get_inclusions($v)); ?></li>
                        </ul>
                    </div>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                    <?php if($data1->inclusions!=''): ?>
                    <div>
                        <?php echo $data1->inclusions; ?>

                    </div>
                    <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <!--Exclusions-->
                <?php if(($data1->tour_exc!='' && $data1->tour_exc!="N;") || $data1->exclusions!=''): ?>

                <div class="tourQuoteExclusions">
                    <h4 class="tourQuoteExclusionHeading">Exclusions</h4>
                    <div class="paddingTop10">
                    <?php $option1_quote_exc=unserialize($data1->tour_exc); ?>
                    <?php if($option1_quote_exc!=''): ?>
                    <?php $__currentLoopData = $option1_quote_exc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="tourQuoteUnlistedItem">
                        <ul>
                            <li><?php echo e(CustomHelpers::get_exc($v)); ?></li>
                        </ul>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                    <?php if($data1->exclusions!=''): ?>
                    <div>
                        <?php echo $data1->exclusions; ?>

                    </div>
                    <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

  <!-- Overview -->
  <?php if($data1->description!='' || $data1->highlights!=''): ?>
      <div class="tourQuoteItineraryCont">
            <div>
                <h3 class="tourQuoteItineraryHead"> Tour Overview</h3>
            </div>
            <div class="tourQuoteOverviewBox">
                <!--Add-on Services-->
                <?php if($data1->description!=''): ?>
                <div class="tourQuoteInclusions">
                    <h4 class="tourQuoteInclusionHeading">Add-On Services</h4>
                    <div class="paddingTop10">
                        <?php echo $data1->description; ?>

                    </div>
                </div>
                <?php endif; ?>
                <!--Tour Highlights-->
                <?php if($data1->highlights!=''): ?>
                <div class="tourQuoteExclusions">
                    <h4 class="tourQuoteExclusionHeading">Tour Highlights</h4>
                    <div class="paddingTop10">
                        <?php echo $data1->highlights; ?>

                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Visa Policy -->
    <?php if($data1->visa=="1"): ?>
    <?php if(empty($data1->visa_p) || $data1->visa_p=="N;"): ?>
    <?php else: ?>
    <div class="tourQuoteVisaPolicyCont">
        <div>
            <h3 class="tourQuoteVisaPolicyHead">VISA POLICY</h3>
        </div>
        <div class="tourQuoteVisaPolicyBox">
            <?php $v_policy=unserialize($data1->visa_p); ?>
            <?php $__currentLoopData = $v_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="tourQuoteVisa">
                <!--<h4 class="tourQuoteVisaHeading">Visas</h4>-->
                <div><?php echo CustomHelpers::get_visa_policy($v); ?></div>
            </div>
            <div class="tourQuoteVisaPolicySeparator"></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

            <!-- additional visa policy content -->
            <?php if(!empty(trim($data1->visa_policies))): ?>
                <div class="tourQuoteVisaAddPolicy"><?php echo e($data1->visa_policies); ?></div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <!-- Booking & Cancellation Policy -->
    <?php if(($data1->payment_p!='' && $data1->payment_p!="N;") || ($data1->can_p!='' && $data1->can_p!="N;")): ?>
        <div class="tourQuoteBookPolicyCont">
            <div>
                <h3 class="tourQuoteBookPolicyHead">BOOKING AND CANCELLATION POLICY</h3>
            </div>
            <div class="tourQuoteBookPolicyBox">
                <!--Tour Booking Policy starts-->
                <?php if($data1->payment_p!='' && $data1->payment_p!="N;"): ?>
            
                    <!--<h3 class="tourQuoteItineraryHead">BOOKING & CANCELLATION</h3>-->
                    <?php $p_policy=unserialize($data1->payment_p); ?>
                    <?php $__currentLoopData = $p_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="tourQuoteBooking">
                        <h4 class="tourQuoteBookHeading">Booking Policy</h4>
                        <div><?php echo CustomHelpers::get_payment_policy($v); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                    <!-- additional booking policy content -->
                    <?php if(!empty(trim($data1->payment_policy))): ?>
                        <div class="tourQuoteBookAddPolicy"><?php echo e($data1->payment_policy); ?></div>
                    <?php endif; ?>
                    <div class="tourQuoteBookPolicySeparator"></div>
                <?php endif; ?>
                <!--Tour Booking Policy ends-->
                <!--Tour Cancellation Policy starts-->
                <?php if($data1->can_p!='' && $data1->can_p!="N;"): ?>
        
                    <?php $c_policy=unserialize($data1->can_p); ?>
                    <?php $__currentLoopData = $c_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="tourQuoteCancellation">
                        <h4 class="tourQuoteCancelHeading">Cancellation Policy</h4>
                        <div><?php echo CustomHelpers::get_cancel_policy($v); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                    <!-- additional booking policy content -->
                    <?php if(!empty(trim($data1->option1_cancellation))): ?>
                        <div class="tourQuoteCancelAddPolicy"><?php echo e($data1->cancel_policy); ?></div>
                    <?php endif; ?>
                <?php endif; ?>
                <!--Tour Cancellation Policy ends-->
            </div>
        </div>
    <?php endif; ?>

    <!-- Important Notes -->
    <?php if(empty($data1->imp_notes) || $data1->imp_notes=="N;"): ?>
    <?php else: ?>
        <div class="tourQuoteImpCont">
            <div>
                <h3 class="tourQuoteImpHead">IMPORTANT NOTES</h3>
            </div>
            <div class="tourQuoteImpBox">
                <?php $important_notes=unserialize($data1->imp_notes); ?>
                <?php $__currentLoopData = $important_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class="tourQuoteImp">
                    <div><?php echo CustomHelpers::get_impnotes($v); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                <!-- additional imp notes content -->
                    <?php if(!empty(trim($data1->imp_notes))): ?>
                        <div class="tourQuoteImpAddPolicy"><?php echo e($data1->extra_notes); ?></div>
                    <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Raise concern or Pay Button -->
    <div class="touQuoteBookFooterCont">
        <?php echo $__env->make("query.quotation_webpage.accept", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <!-- Footer -->
    <?php if($data1!="" && $data1->quote_footer!=""): ?>
    <?php 
        $footer_id=$data1->quote_footer;
        $footer_data=DB::table('quotation_footer')->where('id',$footer_id)->first();
    ?>
    <div class="tourQuoteFooterCont">
        <?php if($footer_data!=''): ?>
            <?php echo $footer_data->footer_desc; ?>

        <?php endif; ?>
    </div>
    <?php endif; ?>