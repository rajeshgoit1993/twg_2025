@if($price_data_first['pricediscountnegative'] == 3 && (int)$price_data_first['coupon_id'] == $coupon->id)
	<label class="couponsOuter active undefined">
@else
	<label class="couponsOuter undefined">
@endif
	
	<div class="couponOfferBox flexOne">
		<div class="spaceBetween flexOne">
			<div class="flexOne">
				<div class="makeflex spaceBetween">
					<div class="flexOne">
						<p class="couponName">{{$coupon->coupon_name}}</p>
					</div>
					<p class="couponPrice">- 
				        	@if($coupon->type == 'Percentage')
				        	<?php
				        		// Calculate after discount amount for percentage coupon
				        		$percentage = $coupon->value;
				        		$divide_val = $percentage + 100;

				        		$total_amount = $price_data_first['query_total_group'];
				        		$after_dis_amount = $total_amount * $percentage / $divide_val;
				        	?>
				        	@else
				        	<?php
				        		// Directly use the value for non-percentage coupons
				        		$after_dis_amount = $coupon->value;
				        	?>
				        	@endif
				        	<span class="defaultCurencyPay"></span><?php CustomHelpers::get_indian_currency($after_dis_amount); ?>
				     </p>
				</div>
	          </div>
	          <div class="makeflex">
		          <div class="flexOne">
		               @if($price_data_first['pricediscountnegative'] == 3 && (int)$price_data_first['coupon_id'] == $coupon->id)
		               	<p class="couponDesc">Coupon applied successfully</p>
		               @else
		                    <p class="couponDesc">{{$coupon->coupon_desc}}</p>
		               @endif
		          </div>
		          
		          <!-- apply coupon starts -->
		          <div>
	            	<?php 
		               // Calculate total received amount using CustomHelpers
		               $total_received_amount = CustomHelpers::get_received_amount($unique_code);
	            	?>
	            	@if($total_received_amount == 0)
	               	<span class="couponBtn textUppercase unique coupon_apply" id="{{CustomHelpers::custom_encrypt($coupon->id)}}">Apply</span>
	            	@else
	               	<span id="{{CustomHelpers::custom_encrypt($coupon->id)}}" class="latoBlack font11 linkText capText unique
		                    @if(CustomHelpers::get_check_payment_status($quote_ref_no) == 1 && (int)$price_data_first['coupon_id'] == $coupon->id)
		                        not_allowed
		                    @elseif(CustomHelpers::get_check_payment_status($quote_ref_no) == 0 && (int)$price_data_first['coupon_id'] == $coupon->id)
		                        coupon_remove
		                    @elseif(CustomHelpers::get_check_payment_status($quote_ref_no) == 1)
		                        not_allowed
		                    @else
		                        coupon_apply
		                    @endif">

		                    @if((int)$price_data_first['coupon_id'] == $coupon->id)
		                        Remove
		                    @else
		                        Apply
		                    @endif
	               	</span>
	          	@endif
	          	<!-- apply coupon ends -->
	          	</div>
	          </div>
        </div>

        <!-- <p class="couponPrice">
        	<span>- 
        		@if($coupon->type == 'Percentage')
                    <?php
                        // Calculate after discount amount for percentage coupon
                        $percentage = $coupon->value;
                        $divide_val = $percentage + 100;

                        $total_amount = $price_data_first['query_total_group'];
                        $after_dis_amount = $total_amount * $percentage / $divide_val;
                    ?>
                    @else
                    <?php
                        // Directly use the value for non-percentage coupons
                        $after_dis_amount = $coupon->value;
                    ?>
               @endif
               <span>₹</span><?php CustomHelpers::get_indian_currency($after_dis_amount); ?>
            </span>
        </p> -->
    </div>
</label>