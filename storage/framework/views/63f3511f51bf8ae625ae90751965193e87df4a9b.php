                            <div class="priceValueBox">
                                <h4>GRAND TOTAL</h4>
                                <h3 class="defaultCurencyPay">
                                    <span class="custom_grand_second"><?php echo e(CustomHelpers::get_indian_currency($amount)); ?></span>
                                </h3>
                                <h5>(inclusive of all taxes)</h5>
                            </div>
                            <?php 
                                $price_data_first=CustomHelpers::get_price_part_seperate($data->price,$data->adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
                               $adult=$data->adult;
                               $extra_adult=$data->extra_adult;
                               $child_with_bed=$data->child_with_bed;
                               $child_without_bed=$data->child_without_bed;
                               $infant=$data->infant;
                               $solo_traveller=$data->solo_traveller;
                            ?>
                            <div class="paymentDetails">
                                <div class="PaxWiseBox">
                                    <?php if($adult>0): ?>
                                    <div class="paxValueBox">
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_adult'])); ?> x <?php echo e($adult); ?>

                                            <span class="fontSize14 colorA1"><?php echo e($adult == 1 ? 'adult' : 'adults'); ?></span>
                                        </div>
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_adult']*$adult)); ?>

                                        </div>
                                    </div>
                                    <?php endif; ?>
                                     <?php if($extra_adult>0): ?>
                                    <div class="paxValueBox">
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_exadult'])); ?> x <?php echo e($extra_adult); ?>

                                            <span class="fontSize14 colorA1">Extra bed</span>
                                        </div>
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_exadult']*$extra_adult)); ?>

                                        </div>
                                    </div>
                                    <?php endif; ?>
                                     <?php if($solo_traveller>0): ?>
                                    <div class="paxValueBox">
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_single'])); ?> x <?php echo e($solo_traveller); ?>

                                            <span class="fontSize14 colorA1">Single</span>
                                        </div>
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_single']*$solo_traveller)); ?>

                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($child_with_bed>0): ?>
                                    <div class="paxValueBox">
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_childbed'])); ?> x <?php echo e($child_with_bed); ?>

                                            <span class="fontSize14 colorA1"><?php echo e($child_with_bed == 1 ? 'child with bed' : 'children with bed'); ?></span>
                                        </div>
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_childbed']*$child_with_bed)); ?>

                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($child_without_bed>0): ?>
                                    <div class="paxValueBox">
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_childwbed'])); ?> x <?php echo e($child_without_bed); ?>

                                            <span class="fontSize14 colorA1"><?php echo e($child_without_bed == 1 ? 'child without bed' : 'children without bed'); ?></span>
                                        </div>
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_childwbed']*$child_without_bed)); ?>

                                        </div>
                                    </div>
                                     <?php endif; ?>
                                    <?php if($infant>0): ?>
                                    <div class="paxValueBox">
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_infant'])); ?> x <?php echo e($infant); ?>

                                            <span class="fontSize14 colorA1">infant</span>
                                        </div>
                                        <div class="defaultCurencyPay">&nbsp;
                                            <?php echo e(CustomHelpers::get_indian_currency($price_data_first['query_total_infant']*$infant)); ?>

                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <!--Price Section-->
                                <div class="totalCostBox">
                                    <!--Grand Total Section-->
                                    <div class="totalBasicCostBox">
                                        <div class="fontBold">Total Basic Cost</div>
                                        <div class="fontBold"><span class="defaultCurencyPay"></span>&nbsp;<?php CustomHelpers::get_indian_currency($price_data_first['query_total_group']); ?></div>
                                    </div>
                                    <!--Coupon Discount Section-->
                                    <!-- <div class="couponDiscount" style="display: none">
                                        <div class="makeflex">
                                            <div class="flexOne">
                                                <p class="fontBold">Coupon Discount</p>
                                            </div>
                                            <div class="noShrink">&#8211;&nbsp;<span class="defaultCurencyPay"></span>&nbsp;<span class="custom_discount_coupn"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']); ?></span></div>
                                        </div>
                                        
                                        <div class="makeflex appendTop10 custom_offer_show">
                                        !-- <div class="flexOne">
                                                <p class="CouponColor capText flexCenter">GRANDOFFER
                                                    <a href="javascript:void(0)" class="pointer">
                                                        <span class="deleteIcon apndLeft5" style="margin-top: -8px;">x</span>
                                                    </a>
                                                </p>
                                                <p class="offerTag colorA1">Online Only Offer - Use This Coupon and Get Upto 25% Off!!</p>
                                            </div>
                                            <div class="font12 noShrink CouponColor"><span class="defaultCurencyPay"></span>&nbsp;18,792</div> --
                                        </div>
                                    </div> -->
                                    <!-- Promo Coupon Discount Section-->
                                    <div class="couponDiscount">
                                        <div class="makeflex">
                                            <div class="flexOne">
                                                <p class="fontBold">Promo Discount</p>
                                            </div>
                                            <div class="couponDiscountPrice noShrink">&#8211;&ensp;
                                                <span class="defaultCurencyPay"></span>
                                                <span class="custom_discount_coupn"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']); ?></span>
                                            </div>
                                        </div>                      
                                        <div class="makeflex appendTop10 custom_offer_show">
                                            <!-- Check if pricediscountnegative equals 3 -->
                                            <?php if($price_data_first['pricediscountnegative']==3): ?>
                                                <?php 
                                                    // Fetch coupon data from the database based on coupon_id
                                                    $coupon_data=DB::table('quote_coupon')->where('id',(int)$price_data_first['coupon_id'])->first();
                                                ?>
                                                <div class="flexOne">
                                                    <!-- Display coupon name or 'NA' if not found -->
                                                    <p class="CouponColor capText flexCenter">
                                                        <?php if($coupon_data!=''): ?>
                                                            <?php echo e($coupon_data->coupon_name); ?>

                                                        <?php else: ?>
                                                            NA
                                                        <?php endif; ?>
                                                        <a href="#" class="pointer">
                                                            <span class="deleteIcon apndLeft5 
                                                                <?php if(CustomHelpers::get_check_payment_status($quote_ref_no)==1): ?>     
                                                                    not_allowed
                                                                <?php else: ?>
                                                                    coupon_remove
                                                                <?php endif; ?>
                                                            " style="margin-top: -8px;">x</span>
                                                        </a>
                                                    </p>
                                                    
                                                    <!-- Display coupon description or 'NA' if not found -->
                                                    <p class="offerTag colorA1">
                                                        <?php if($coupon_data!=''): ?>
                                                            <?php echo e($coupon_data->coupon_desc); ?>

                                                        <?php else: ?>
                                                            NA
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                                
                                                <!-- Display total discount amount -->
                                                <div class="font12 noShrink CouponColor">
                                                    <span class="defaultCurencyPay"></span>&nbsp;<?php echo e(number_format($price_data_first['query_total_discount_group'],0)); ?>

                                                </div>                          
                                            <?php endif; ?>
                                            <!-- Uncommented code for additional offers (commented out in original) -->
                                            <!--
                                            <div class="flexOne">
                                                <p class="CouponColor flexCenter">Grandoffer
                                                    <a href="javascript:void(0)" class="pointer">
                                                        <span class="deleteIcon apndLeft5" style="margin-top: -8px;">&#x2715;</span>
                                                    </a>
                                                </p>
                                                <p class="offerTag colorA1">Online Only Offer - Use This Coupon and Get Upto 25% Off!!</p>
                                            </div>
                                            <div class="font12 noShrink CouponColor">
                                                <span class="defaultCurencyPay"></span>&nbsp;18,792
                                            </div>
                                            -->
                                        </div>
                                        <!-- coupon discount section (for later) -->
                                        <!-- <div style="display: none;">
                                        <div class="appendTop20 appendBottom10 applyCpn">
                                            <p class="relative width225 apply-coupon-container">
                                                <input type="text" placeholder="Have a coupon code?" disabled="" value="GRANDOFFER">
                                                <span class="applyCpn-trigger ">
                                                    <span class="applyBtn"><span class="font12 LatoBold"> Remove</span>
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="appendBottom13 font11 linkText appendTop13">
                                            <a href="javascript:void(0)">1 More  Coupon  Available <span class="arrowPaymentdetails down"></span></a>
                                        </div>
                                        <div class="couponList paddingB10">
                                            <ul class="offersAppliedList">
                                                <li>
                                                    <span class="radioOuter makeflex">
                                                        <input type="radio" id="CITITRAVEL" name="radio-group-coupon">
                                                        <label for="CITITRAVEL">
                                                            <span class="makeflex column appendLeft10">
                                                            <span class="darkText appendBottom5">CITITRAVEL</span>
                                                            <span class="font11 greyText lineHeight14">Grab upto 35% Off* with CITI BANK Credit &amp; Debit Cards</span>
                                                            </span>
                                                        </label>
                                                    </span>
                                                    <span class="amount darkText textRight noShrink">-₹29,927</span>
                                                </li>
                                                <li>
                                                    <span class="radioOuter makeflex">
                                                        <input type="radio" id="GRANDOFFER" name="radio-group-coupon" checked="">
                                                        <label for="GRANDOFFER">
                                                            <span class="makeflex column appendLeft10"><span class="darkText appendBottom5">GRANDOFFER</span><span class="font11 greyText lineHeight14">Online Only Offer - Use This Coupon and Get Upto 25% Off!!</span></span>
                                                        </label>
                                                    </span>
                                                    <span class="amount darkText textRight noShrink">-₹23,752</span></li>
                                            </ul>
                                        </div>
                                        </div> -->
                                    </div>

                                    <!--Fees & Taxes Section-->
                                    <div class="taxesCont" <?php if(($price_data_first['query_total_gst_group']+$price_data_first['query_total_tcs_group']+$price_data_first['query_total_pg_group'])>0): ?> <?php else: ?> style="display:none;" <?php endif; ?>>
                                        <div class="makeflex align-center space-between">
                                            <div class="taxesContHead">Fees & Taxes</div>
                                            <div class="taxesPrice">&#43;&ensp;<span class="defaultCurencyPay"></span>&nbsp; <span class="fee_taxes custom_fee_taxes">  <?php CustomHelpers::get_indian_currency($price_data_first['query_total_gst_group']+$price_data_first['query_total_tcs_group']+$price_data_first['query_total_pg_group']); ?></span></div>
                                        </div>
                                        <!--Taxes Chart-->
                                        <div class="feesTaxesWrap feesTaxesExpandedSec" >
                                            <div class="feesTaxesBox ">
                                                <div class="feesTaxesBoxRow" <?php if($price_data_first['query_total_gst_group']>0): ?> <?php else: ?> style="display:none;" <?php endif; ?>>
                                                    <div class="makeflex flexOne">
                                                        <!--<span class="taxesChartNumber">1</span>-->
                                                        <div class="font11 flexOne">
                                                            <p>GST <?php if($price_data_first['query_gst_curr']==2): ?>
                                                          (<?php echo e($price_data_first['gst_percentage']); ?>%)
                                                            <?php endif; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp;  <span class="custom_gst"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_gst_group']); ?> </span>   </span>
                                                </div>
                                                <div class="feesTaxesBoxRow" <?php if($price_data_first['query_total_tcs_group']>0): ?> <?php else: ?> style="display:none;" <?php endif; ?>>
                                                    <div class="makeflex flexOne">
                                                        <!--<span class="taxesChartNumber">2</span>-->
                                                        <div class="font11 flexOne">
                                                            <p>TCS <?php if($price_data_first['query_tcs_curr']==2): ?>
                                                                (<?php echo e($price_data_first['tcs_percentage']); ?>%)
                                                            <?php endif; ?><span class="tcsInfo apndLeft5 i-box">i</span></p>
                                                            <p class="greyText">*100% Credit available against tax payable</p>
                                                        </div>
                                                    </div>
                                                    <span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp;  <span class="custom_tcs"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_tcs_group']); ?> </span>   </span>
                                                </div>
                                                <div class="feesTaxesBoxRow" <?php if($price_data_first['query_total_pg_group']>0): ?> <?php else: ?> style="display:none;" <?php endif; ?>>
                                                    <div class="makeflex flexOne">
                                                        <!--<span class="taxesChartNumber">3</span>-->
                                                        <div class="font11 flexOne">
                                                            <p>Booking fees <?php if($price_data_first['pg_charges']==2): ?>
                                                                (<?php echo e($price_data_first['pgcharges_percentage']); ?>%)
                                                            <?php endif; ?></p>
                                                        </div>
                                                    </div>
                                                    <span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp;  <span class="custom_pg"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_pg_group']); ?></span>    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Fees & Taxes Old Section-->
                                    <!-- <div style="display: none">
                                        !--GST--
                                        <div class="totalBasicCostBox" style="display: none">
                                            <div>
                                                <p class="basicCostItem">GST (5%)</p>
                                            </div>
                                            <div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
                                        </div>
                                        !--TCS--
                                        <div class="totalBasicCostBox" style="display: none">
                                            <div>
                                                <p class="basicCostItem">TCS (5%) <span class="tcsInfo apndLeft5" style="margin-top: ;">i</span></p>
                                                    <p class="tcsInfoText appendRight15">*100% Credit available against tax payable</p>
                                                
                                            </div>
                                            <div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
                                        </div>
                                        !--PG--
                                        <div class="totalBasicCostBox" style="display: none">
                                            <div>
                                                <p class="basicCostItem">PG (5%)</p>
                                            </div>
                                            <div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                            <!--Grand Total-->
                            <div class="grandTotalCostBox">
                                <div class="grTtlCostBox">
                                    <div class="fontBold">Grand Total</div>
                                    <div class="fontBold"><span class="defaultCurencyPay"></span>&nbsp;<span class="custom_grand_pay"><?php CustomHelpers::get_indian_currency($price_data_first['query_pricetopay_adult']); ?></span></div>
                                </div>
                            </div>

                            <!--Pay Full Amount-->
                            <div class="payFullCostBox">
                                <label class="pay-custom-radio pay-label">
                                    <div>
                                        <input type="radio" checked name="amount" value="fullamt">
                                        <span class="paytype-btn"></span>
                                        <span class="text">Pay Full Amount</span>
                                    </div>
                                    <div class="payFullItem makeflex fontBold defaultCurencyPay">&nbsp;<span class="custom_remaining">
                                        <?php CustomHelpers::get_indian_currency($remaining_amount); ?></span>
                                    </div>
                                </label>
                            </div>

                            <!--OLD Enter part payment - Manual-->
                            <!-- <div class="payPartBox" style="display: none;">
                                <label class="pay-custom-radio pay-label">
                                    <div>
                                        <input type="radio" name="amount" value="part_amount">
                                        <span class="paytype-btn"></span>
                                        <span class="text fontBold">Enter Amount</span>
                                    </div>
                                    <div class="payFullItem fontBold defaultCurencyPay">&nbsp;
                                        <input type="text" name="custom_pay" id="custom_pay" class="form-control" style="width: 50% !important;display: inline-block !important;background: white !important;color: black !important;" value="0">
                                    </div>
                                </label>
                            </div> -->

                            <!-- Book Now Pay Later (bnpl) -->
                            <?php if($data->partPayment==1): ?>
                                <?php 
                                    // Unserialize part payments data
                                    $part_payments = unserialize($data->part_payments);
                                    // Calculate part payments sections
                                    $part_payments_sec = CustomHelpers::part_payments($data->part_payments, $price_data_first['query_pricetopay_adult']);
                                ?>
                                <!-- Check if the remaining amount is greater than 0 -->
                                <?php if($remaining_amount > 0): ?>
                                    <?php
                                        // Define part payment amounts
                                        $adv_amount = $part_payments_sec['adv_amount'];
                                        $first_part_amount = $part_payments_sec['first_part_amount'];
                                        $second_part_amount = $part_payments_sec['second_part_amount'];
                                        
                                        // Get total received amount
                                        $total_received_amount = CustomHelpers::get_received_amount($unique_code);
                                        
                                        // Calculate the amount to show
                                        if($total_received_amount < $adv_amount) {
                                            $show_amount = (float)$adv_amount - (float)$total_received_amount;
                                        } elseif($total_received_amount == $adv_amount) {
                                            $show_amount = (float)$first_part_amount;
                                        } elseif($total_received_amount > $adv_amount && $total_received_amount < ((float)$adv_amount + (float)$first_part_amount)) {
                                            $show_amount = (float)$first_part_amount - ((float)$total_received_amount - (float)$adv_amount);    
                                        } elseif($total_received_amount > $adv_amount && $total_received_amount == ((float)$adv_amount + (float)$first_part_amount)) {
                                            $show_amount = (float)$second_part_amount;
                                        } else {
                                            $show_amount = (float)$second_part_amount - ((float)$total_received_amount - (float)$adv_amount - (float)$first_part_amount);    
                                        }
                                    ?>
                                    <!-- <div class="payPartBox" style="background: #eaf5ff; ">
                                        <div class="makeflex align-center space-between">
                                            <div class="custom_radio fullWidth">
                                                <label>
                                                    <div class="flexCenter">
                                                        <input type="radio" name="amount" value="part">
                                                        <span></span>Book Now Pay Later 
                                                        !--<div style="display: none;">
                                                            <p class="blackText fontBold">Book Now Pay Later</p>
                                                            <p class="apndTop5 FontSize12 LightGray Font500 d-none">Amount you pay now to reserve</p>
                                                        </div>--
                                                    </div>
                                                    <div class="payFullItem flexCenter">
                                                        <div class="defaultCurencyPay"></div>&nbsp; 
                                                        <span class="custom_last" style="border-style:none;"><?php echo e($show_amount); ?></span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        !--Pay Later Chart--
                                        <div class="bnplWrapper bnplExpandedSec">
                                            <div class="bnplBox">
                                                <?php if($part_payments_sec['adv_amount']!=0): ?>
                                                    <div class="bnplBoxRow">
                                                        <div class="makeflex flexOne">
                                                            <span class="chartNumber">1</span>
                                                            <div class="font11 flexOne">
                                                                <p>Pay to Book</p>
                                                                <p class="greyText">
                                                                    <?php 
                                                                    // Check if no amount has been received
                                                                    if ($total_received_amount == 0) {
                                                                        echo "Amount to pay now to reserve";    
                                                                    }
                                                                    // Check if the received amount is less than the advance amount
                                                                    elseif ($total_received_amount < $adv_amount) {
                                                                        echo 'You Paid:' . $total_received_amount;
                                                                    }
                                                                    // Otherwise, the amount has been paid in full
                                                                    else {
                                                                        echo "Paid";
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp; <span class="custom_first_installment">    <?php echo e($part_payments_sec['adv_amount']); ?></span></span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if($part_payments_sec['first_part_amount']!=0): ?>
                                                    <div class="bnplBoxRow">
                                                        <div class="makeflex flexOne">
                                                            <span class="chartNumber">2</span>
                                                            <div class="font11 flexOne">
                                                                <p>Before <?php echo e($part_payments_sec['first_part_date']); ?></p>
                                                                <p class="greyText">
                                                                    <?php 
                                                                    // Check if the total received amount is greater than the advance amount but less than the sum of the advance amount and the first part amount
                                                                    if ($total_received_amount > $adv_amount && $total_received_amount < ((float)$adv_amount + (float)$first_part_amount)) {
                                                                        $show_second_amount = ((float)$total_received_amount - (float)$adv_amount);    
                                                                        if ($show_second_amount > 0) {
                                                                            echo 'You Paid:' . $show_second_amount;
                                                                        }
                                                                    }

                                                                    // Check if the total received amount is greater than the advance amount and is greater than or equal to the sum of the advance amount and the first part amount
                                                                    if ($total_received_amount > $adv_amount && $total_received_amount >= ((float)$adv_amount + (float)$first_part_amount)) {
                                                                        $show_second_amount = ((float)$total_received_amount - (float)$adv_amount);    
                                                                        if ($show_second_amount > 0) {
                                                                            echo 'Paid';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp; <span class="custom_second_installment">   <?php echo e($part_payments_sec['first_part_amount']); ?></span></span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if($part_payments_sec['second_part_amount']!=0): ?>
                                                    <div class="bnplBoxRow">
                                                        <div class="makeflex flexOne">
                                                            <span class="chartNumber">3</span>
                                                            <div class="font11 flexOne">
                                                                <p>Before <?php echo e($part_payments_sec['second_part_date']); ?></p>
                                                                <p class="greyText">
                                                                    <?php 
                                                                    // Check if the total received amount is greater than the sum of the advance amount and the first part amount
                                                                    if ($total_received_amount > $adv_amount && $total_received_amount > ((float)$adv_amount + (float)$first_part_amount)) {
                                                                        // Calculate the third amount paid
                                                                        $show_third_amount = ((float)$total_received_amount - (float)$adv_amount - (float)$first_part_amount);    
                                                                        // If the third amount paid is greater than 0, echo the amount paid
                                                                        if ($show_third_amount > 0) {
                                                                            echo 'You Paid:' . $show_third_amount;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp; <span class="custom_third_installment">    <?php echo e($part_payments_sec['second_part_amount']); ?></span></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="payPartBox" style="background-color: #eaf5ff;">
                                        <label class="pay-custom-radio pay-label">
                                            <div>
                                                <input type="radio" name="amount" value="part">
                                                <span class="paytype-btn"></span>
                                                <span class="text fontBold">Book Now Pay Later</span>
                                            </div>
                                            <div class="payFullItem makeflex fontBold defaultCurencyPay">&nbsp;
                                                <span class="custom_last">
                                                    <?php echo e($show_amount); ?>

                                                </span>
                                            </div>
                                        </label>
                                        <!--Pay Later Chart-->
                                        <div class="bnplWrapper bnplExpandedSec">
                                            <div class="bnplBox">
                                                <?php if($part_payments_sec['adv_amount']!=0): ?>
                                                    <div class="bnplBoxRow">
                                                        <div class="makeflex flexOne">
                                                            <span class="chartNumber">1</span>
                                                            <div class="font11 flexOne">
                                                                <p>Pay to Book</p>
                                                                <p class="greyText">
                                                                    <?php 
                                                                    // Check if no amount has been received
                                                                    if ($total_received_amount == 0) {
                                                                        echo "Amount to pay now to reserve";    
                                                                    }
                                                                    // Check if the received amount is less than the advance amount
                                                                    elseif ($total_received_amount < $adv_amount) {
                                                                        echo 'You Paid:' . $total_received_amount;
                                                                    }
                                                                    // Otherwise, the amount has been paid in full
                                                                    else {
                                                                        echo "Paid";
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp;<span class="custom_first_installment"><?php echo e($part_payments_sec['adv_amount']); ?></span></span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if($part_payments_sec['first_part_amount']!=0): ?>
                                                    <div class="bnplBoxRow">
                                                        <div class="makeflex flexOne">
                                                            <span class="chartNumber">2</span>
                                                            <div class="font11 flexOne">
                                                                <p>Before <?php echo e($part_payments_sec['first_part_date']); ?></p>
                                                                <p class="greyText">
                                                                    <?php 
                                                                    // Check if the total received amount is greater than the advance amount but less than the sum of the advance amount and the first part amount
                                                                    if ($total_received_amount > $adv_amount && $total_received_amount < ((float)$adv_amount + (float)$first_part_amount)) {
                                                                        $show_second_amount = ((float)$total_received_amount - (float)$adv_amount);    
                                                                        if ($show_second_amount > 0) {
                                                                            echo 'You Paid:' . $show_second_amount;
                                                                        }
                                                                    }

                                                                    // Check if the total received amount is greater than the advance amount and is greater than or equal to the sum of the advance amount and the first part amount
                                                                    if ($total_received_amount > $adv_amount && $total_received_amount >= ((float)$adv_amount + (float)$first_part_amount)) {
                                                                        $show_second_amount = ((float)$total_received_amount - (float)$adv_amount);    
                                                                        if ($show_second_amount > 0) {
                                                                            echo 'Paid';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <span class="bnplPrice defaultCurencyPay"></span>&nbsp;<span class="custom_second_installment"><?php echo e($part_payments_sec['first_part_amount']); ?></span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if($part_payments_sec['second_part_amount']!=0): ?>
                                                    <div class="bnplBoxRow">
                                                        <div class="makeflex flexOne">
                                                            <span class="chartNumber">3</span>
                                                            <div class="font11 flexOne">
                                                                <p>Before <?php echo e($part_payments_sec['second_part_date']); ?></p>
                                                                <p class="greyText">
                                                                    <?php 
                                                                    // Check if the total received amount is greater than the sum of the advance amount and the first part amount
                                                                    if ($total_received_amount > $adv_amount && $total_received_amount > ((float)$adv_amount + (float)$first_part_amount)) {
                                                                        // Calculate the third amount paid
                                                                        $show_third_amount = ((float)$total_received_amount - (float)$adv_amount - (float)$first_part_amount);    
                                                                        // If the third amount paid is greater than 0, echo the amount paid
                                                                        if ($show_third_amount > 0) {
                                                                            echo 'You Paid:' . $show_third_amount;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp;<span class="custom_third_installment"><?php echo e($part_payments_sec['second_part_amount']); ?></span></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <!--part payment Original-->
                            <!-- <div class="payPartBox" style="display: none;">
                                <label>
                                    <div class="makeflex align-center space-between">
                                        <div class="flexCenter">
                                        <input type="radio" name="amount" value="fullamt">
                                        <div>
                                            <p class="blackText fontBold">Book Now Pay Later</p>
                                            <p class="apndTop5 FontSize12 LightGray Font500 d-none">Amount you pay now to reserve</p>
                                        </div>
                                        </div>
                                    
                                    <div class="payFullItem"><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
                                    </div>

                                    **********
                                !--<label>
                                    <div class="flexCenter" style="width: 200px"><input type="radio" name="partamt" value="partamt">Balance 45 days before departure</div>
                                    <div class="payFullItem"><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
                                </label>--

                                    **********
                                <div class="payPartFlow">
                                    <p class="apndTop5 FontSize12 LightGray Font500" style="padding-left: 18px;width: 65%;">Amount you pay now to reserve</p>
                                </div>
                                <div class="payPartBalanceBox">
                                    <div class="flexCenter">
                                        <div class="payPartBalance">1</div>
                                        <div class="payPartBalanceInfo">Before 15 June 2022</div>
                                    </div>
                                    <div class="payPartBalanceItem"><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
                                </div>
                                <div class="payPartFlow"></div>
                                <div class="payPartBalanceBox">
                                    <div class="flexCenter">
                                        <div class="payPartBalance">2</div>
                                        <div class="payPartBalanceInfo">Before 28 June 2022</div>
                                    </div>
                                    <div class="payPartBalanceItem"><span class="defaultCurencyPay"></span>&nbsp;18,792</div>
                                </div>
                                </label>
                            </div> -->

                            <!-- You Pay Now -->
                            <div class="guestPayCont">
                                <div class="guestPayBox">
                                    <div>
                                        <p class="guestPayItem">You Pay Now</p>
                                    </div>
                                    <div class="guestPayItem">
                                        <span class="defaultCurencyPay"></span>&nbsp;<span id="you_pay"><?php CustomHelpers::get_indian_currency($remaining_amount); ?></span>
                                    </div>
                                </div>
                                <div class="guestPayBox">
                                    <div>
                                        <p class="guestDueItem">Amount Due Later</p>
                                    </div>
                                    <div class="guestDueItem"><span class="defaultCurencyPay"></span>&nbsp;<span id="due_amount">0</span></div>
                                </div>
                                <div class="guestConfBox">
                                    <h3>Acknowledgement</h3>
                                        <div class="makeflex">
                                        <label class="checkmarkCont">
                                            <input type="checkbox" name="acknowledgement" id="acknowledgement" value="1" />
                                            <span class="checkmark paymtAck"></span>
                                        </label>
                                        <p class="paymtAck-service-text">By proceeding, I confirm that I have read the <a href="<?php echo e(URL::to('/Privacy-Policy')); ?>" class="link-color" target="_blank">Privacy Policy</a> and <a href="<?php echo e(URL::to('/User-Agreement')); ?>" class="link-color" target="_blank">User Agreement</a> of <?php if(env("WEBSITENAME")==1): ?> The World Gateway <?php elseif(env("WEBSITENAME")==0): ?> Rapidex Travels <?php endif; ?>.</p>
                                    </div>
                                        <!-- <input type="checkbox" name="acknowledgement" id="acknowledgement" value="1"> -->
                                        <!-- <p>By proceeding, I confirm that I have read the <a>User Agreement, Terms of Service</a> and <a>Privacy Policy</a> of TheWorldGateway</p> -->
                                    <!-- <div class="addOnDtlsCont">
                                        <label class="checkmarkCont">
                                            <input type="checkbox" class="additional_details" value="Business Tour">
                                            <span class="checkmark addOn-services"></span>
                                            <span class="addOn-services-text">Business Tour</span>
                                        </label>
                                    </div> -->
                                </div>
                                <div class="payBtn">
                                    <button type="submit" class="btnMain btnProceed" id="btnProceed">Proceed to Payments</button>
                                </div>
                            </div>

                            <!--Coupons & Offers-->
                            <div class="offersSection appendTop20 appendBottom20" id="coupon">
                                <p class="couponsHead">Coupons &amp; Offers </p>
                                <!-- <div class="emiOptions">
                                    <span class="emiIcon"><span>₹</span>EMI</span>
                                    <div class="flexOne">
                                        <p class="emiText">No cost EMI @ ₹2,667</p>
                                        <p class="emiTextDesc">Book your holidays with Easy <span class="linkText font11 emi-option-link">EMI options</span>.</p>
                                    </div>
                                </div> -->
                                <div class="padding15">
                                    <div class="couponsInput appendBottom10">
                                        <input type="text" placeholder="Have a Coupon Code?" value="" class="coupon_value">
                                        <!-- <span class="ctaCoupon couponBtn apply_custom_coupon">Apply</span> -->
                                        <span class="ctaCoupon latoBold font12 linkText 
                                            <?php if(CustomHelpers::get_check_payment_status($quote_ref_no) == 1): ?> 
                                                not_allowed 
                                            <?php else: ?> 
                                                apply_custom_coupon 
                                            <?php endif; ?> ">Apply
                                        </span>
                                        <small class="latoBold font11 couponStatusNotify"></small>
                                    </div>
                                    <p class="couponSep"><span class="couponSepText">OR</span></p>
                                    <div class="couponsList">
                                        <!-- <label class="couponsOuter active undefined">
                                            <span class="reviewSprite greenTick"></span>
                                            <div class="couponOfferBox flexOne">
                                                <div class="makeflex spaceBetween flexOne">
                                                    <div class="flexOne">
                                                        <p class="couponName">GRANDOFFER</p>
                                                        <p class="couponDesc description">Coupon applied successfully</p>
                                                    </div>
                                                    <span class="latoBlack font11 linkText capText unique">Remove</span>
                                                </div>
                                                <p class="couponPrice"><span>- ₹18,756</span></p>
                                            </div>
                                        </label> -->
                                        <span class="coupon_class">
                                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <?php if($coupon->applicable_for == 1): ?>
                                                    <?php 
                                                    $check = DB::table('coupon_include_exclude')->where([['coupon_id', $coupon->id], ['ref_id', "quote_" . $quote_ref_no]])->first();
                                                    ?>
                                                    <?php if($check == ''): ?>
                                                        <?php echo $__env->make('payment.coupon_loop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                    <?php endif; ?>
                                                <?php elseif($coupon->applicable_for == 2): ?>
                                                    <?php 
                                                    $check = DB::table('coupon_include_exclude')->where([['coupon_id', $coupon->id], ['ref_id', "quote_" . $quote_ref_no]])->first();
                                                    ?>
                                                    <?php if($check == ''): ?>
                                                        <?php echo $__env->make('payment.coupon_loop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                    <?php endif; ?>
                                                <?php elseif($coupon->applicable_for == 4): ?>
                                                    <?php 
                                                    $check = DB::table('coupon_include_exclude')->where([['coupon_id', $coupon->id], ['ref_id', "quote_" . $quote_ref_no]])->first();
                                                    ?>
                                                    <?php if($check != ''): ?>
                                                        <?php echo $__env->make('payment.coupon_loop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </span>

                                        <?php echo $__env->make('payment.paid_amount', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        
                                        <?php echo $__env->make('payment.pay_at_hotel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>