		<div class="rightContainer">
			<div class="priceValueBox">
				<h4>GRAND TOTAL</h4>
				<h3><span class="defaultCurencyPay"></span>&nbsp; <span class="custom_grand_second">{{CustomHelpers::get_indian_currency($amount)}}</span></h3>
				<h5>(inclusive of all taxes)</h5>
			</div>
			<?php 
                $price_data_first=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
               $adult=$data->quote1_number_of_adult;
               $extra_adult=$data->extra_adult;
               $child_with_bed=$data->child_with_bed;
               $child_without_bed=$data->child_without_bed;
               $infant=$data->infant;
               $solo_traveller=$data->solo_traveller;
               
            ?>
			<div class="paymentDetails">
				<div class="PaxWiseBox">
                    @if($adult>0)
					<div class="paxValueBox">
						<div><span class="defaultCurencyPay"></span>&nbsp;{{$price_data_first['query_total_adult']}} x {{$adult}} <span class="fontSize14 colorA1">adults</span></div>
						<div><span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($price_data_first['query_total_adult']*$adult)}}</div>
					</div>
                    @endif
                     @if($extra_adult>0)
                    <div class="paxValueBox">
                        <div><span class="defaultCurencyPay"></span>&nbsp;{{$price_data_first['query_total_exadult']}} x {{$extra_adult}} <span class="fontSize14 colorA1">Extra adults</span></div>
                        <div><span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($price_data_first['query_total_exadult']*$extra_adult)}}</div>
                    </div>
                    @endif
                     @if($solo_traveller>0)
                    <div class="paxValueBox">
                        <div><span class="defaultCurencyPay"></span>&nbsp;{{$price_data_first['query_total_single']}} x {{$solo_traveller}} <span class="fontSize14 colorA1">Solo Traveller</span></div>
                        <div><span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($price_data_first['query_total_single']*$solo_traveller)}}</div>
                    </div>
                    @endif
                    @if($child_without_bed>0)
					<div class="paxValueBox">
						<div><span class="defaultCurencyPay"></span>&nbsp;{{$price_data_first['query_total_childwbed']}} x {{$child_without_bed}} <span class="fontSize14 colorA1">children</span></div>
						<div><span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($price_data_first['query_total_childwbed']*$child_without_bed)}}</div>
					</div>
                     @endif
                     @if($child_with_bed>0)
					<div class="paxValueBox">
						<div><span class="defaultCurencyPay"></span>&nbsp;{{$price_data_first['query_total_childbed']}} x {{$child_with_bed}} <span class="fontSize14 colorA1">children with bed</span></div>
						<div><span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($price_data_first['query_total_childbed']*$child_with_bed)}}</div>
					</div>
                    @endif
                    @if($infant>0)
					<div class="paxValueBox">
						<div><span class="defaultCurencyPay"></span>&nbsp;{{$price_data_first['query_total_infant']}} x {{$infant}} <span class="fontSize14 colorA1">infant</span></div>
						<div><span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($price_data_first['query_total_infant']*$infant)}}</div>
					</div>
                    @endif
				</div>
				<!--Price Section-->
				<div class="totalCostBox">
					<!--Grand Total Section-->
					<div class="totalBasicCostBox">
						<div class="Font600">Total Basic Cost</div>
						<div class="Font600"><span class="defaultCurencyPay"></span>&nbsp;<?php CustomHelpers::get_indian_currency($price_data_first['query_total_group']); ?></div>
					</div>
					<!--Coupon Discount Section-->
					<div class="couponDiscount" style="display: none">
						<div class="makeflex">
							<div class="flexOne">
								<p class="fontBold">Coupon Discount</p>
							</div>
							<div class="noShrink">&#8211;&nbsp;<span class="defaultCurencyPay"></span>&nbsp;<span class="custom_discount_coupn"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']); ?></span></div>
						</div>
						
						<div class="makeflex appendTop10 custom_offer_show">
						<!-- 	<div class="flexOne">
								<p class="CouponColor capText flexCenter">GRANDOFFER
									<a href="javascript:void(0)" class="pointer">
										<span class="deleteIcon apndLeft5" style="margin-top: -8px;">x</span>
									</a>
								</p>
								<p class="offerTag colorA1">Online Only Offer - Use This Coupon and Get Upto 25% Off!!</p>
							</div>
							<div class="font12 noShrink CouponColor"><span class="defaultCurencyPay"></span>&nbsp;18,792</div> -->
						</div>
					</div>
					<!--Coupon Discount OLD Section-->
					<div class="couponDiscount" style="display: ">
						<div class="makeflex">
							<div class="flexOne">
								<p class="fontBold">Coupon Discount</p>
							</div>
							<div class="couponDiscountPrice noShrink">&#8211;&ensp;<span class="defaultCurencyPay"></span>&nbsp;<span class="custom_discount_coupn">	<?php CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']); ?></span></div>
						</div>
						
						<div class="makeflex appendTop10 custom_offer_show">
							@if($price_data_first['pricediscountnegative']==3)
							<?php 

$coupon_data=DB::table('quote_coupon')->where('id',(int)$price_data_first['coupon_id'])->first();

							
							?>
	
            <div class="flexOne">
                                <p class="CouponColor capText flexCenter">
                                	@if($coupon_data!='')
                                	{{$coupon_data->coupon_name}}
                                        @else
NA
                                        @endif
                                    <a href="#" class="pointer">
                                        <span class="deleteIcon apndLeft5 
           @if(CustomHelpers::get_check_payment_status($quote_ref_no)==1)     
       not_allowed
            @else
       coupon_remove
            @endif

                                        " style="margin-top: -8px;" >x</span>
                                    </a>
                                </p>
                                <p class="offerTag colorA1">
                                	@if($coupon_data!='')
                                	{{$coupon_data->coupon_desc}}
                                        @else
NA
                                        @endif
                                        </p>
                            </div>
                            <div class="font12 noShrink CouponColor"><span class="defaultCurencyPay"></span>&nbsp;{{number_format($price_data_first['query_total_discount_group'],0)}}</div>
                
							@endif
						<!-- 	<div class="flexOne">
								<p class="CouponColor flexCenter">Grandoffer
									<a href="javascript:void(0)" class="pointer">
										<span class="deleteIcon apndLeft5" style="margin-top: -8px;">&#x2715;</span>
									</a>
								</p>
								<p class="offerTag colorA1">Online Only Offer - Use This Coupon and Get Upto 25% Off!!</p>
							</div>
							<div class="font12 noShrink CouponColor"><span class="defaultCurencyPay"></span>&nbsp;18,792</div> -->
						</div>
						
						<!--Coupon Discount old Section-->
						<div style="display: none;">
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
						</div>
					</div>
					<!--Fees & Taxes Section-->
					<div class="taxesCont" @if(($price_data_first['query_total_gst_group']+$price_data_first['query_total_tcs_group']+$price_data_first['query_total_pg_group'])>0) @else style="display:none;" @endif>
						<div class="flexCenterBetween">
							<div class="taxesContHead">Fees & Taxes</div>
							<div class="taxesPrice">&#43;&ensp;<span class="defaultCurencyPay"></span>&nbsp; <span class="fee_taxes custom_fee_taxes">	<?php CustomHelpers::get_indian_currency($price_data_first['query_total_gst_group']+$price_data_first['query_total_tcs_group']+$price_data_first['query_total_pg_group']); ?></span></div>
						</div>
						<!--Taxes Chart-->
						<div class="feesTaxesWrap feesTaxesExpandedSec" >
							<div class="feesTaxesBox ">
								<div class="feesTaxesBoxRow" @if($price_data_first['query_total_gst_group']>0) @else style="display:none;" @endif>
									<div class="makeflex flexOne">
										<!--<span class="taxesChartNumber">1</span>-->
										<div class="font11 flexOne">
											<p>GST @if($price_data_first['query_gst_curr']==2)
                                          ({{$price_data_first['gst_percentage']}}%)
                                            @endif
                                            </p>
										</div>
									</div>
									<span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp;  <span class="custom_gst"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_gst_group']); ?> </span>   </span>
								</div>
								
								<div class="feesTaxesBoxRow" @if($price_data_first['query_total_tcs_group']>0) @else style="display:none;" @endif>
									<div class="makeflex flexOne">
										<!--<span class="taxesChartNumber">2</span>-->
										<div class="font11 flexOne">
											<p>TCS @if($price_data_first['query_tcs_curr']==2)
                                          ({{$price_data_first['tcs_percentage']}}%)
                                            @endif<span class="tcsInfo apndLeft5" style="margin-top: ;">i</span></p>
											<p class="greyText">*100% Credit available against tax payable</p>
										</div>
									</div>
									<span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp;  <span class="custom_tcs"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_tcs_group']); ?> </span>   </span>
								</div>
								<div class="feesTaxesBoxRow" @if($price_data_first['query_total_pg_group']>0) @else style="display:none;" @endif>
									<div class="makeflex flexOne">
										<!--<span class="taxesChartNumber">3</span>-->
										<div class="font11 flexOne">
											<p>Booking fees @if($price_data_first['pg_charges']==2)
                                          ({{$price_data_first['pgcharges_percentage']}}%)
                                            @endif</p>
										</div>
									</div>
									<span class="bnplPrice"><span class="defaultCurencyPay"></span>&nbsp;  <span class="custom_pg"><?php CustomHelpers::get_indian_currency($price_data_first['query_total_pg_group']); ?></span>    </span>
								</div>
							</div>
						</div>
					</div>
					<!--Fees & Taxes Old Section-->
					<div style="display: none">
					<!--GST-->
					<div class="totalBasicCostBox" style="display: none">
						<div>
							<p class="basicCostItem">GST (5%)</p>
						</div>
						<div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
					</div>
					<!--TCS-->
					<div class="totalBasicCostBox" style="display: none">
						<div>
							<p class="basicCostItem">TCS (5%) <span class="tcsInfo apndLeft5" style="margin-top: ;">i</span></p>
								<p class="tcsInfoText appendRight15">*100% Credit available against tax payable</p>
							
						</div>
						<div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
					</div>
					<!--PG-->
					<div class="totalBasicCostBox" style="display: none">
						<div>
							<p class="basicCostItem">PG (5%)</p>
						</div>
						<div class="basicCostItem"><span class="defaultCurencyPay"></span> 18,792</div>
					</div>
					</div>
				</div>
			</div>
			<!--Grand Total-->
			<div class="grandTotalCostBox">
				<div class="grTtlCostBox">
					<div class="Font600">Grand Total</div>
					<div class="fontBold"><span class="defaultCurencyPay"></span>&nbsp;  <span class="custom_grand_pay"><?php CustomHelpers::get_indian_currency($price_data_first['query_pricetopay_adult']); ?></span>    </div>
				</div>
			</div>
		
		
			<!--OLD Enter part payment - Manual-->
		

		
			
			<!--Coupons & Offers-->
			<div class="offersSection appendTop20 appendBottom20" id="coupon">
				<p class="couponsHead">Payments History </p>
				
				<div class="padding15">
				@foreach($payments_histories as $payments_historie)
				<div class="totalBasicCostBox">
						<div class="Font600">{{$payments_historie->created_at}}</div>
						<div class="Font600"><span class="defaultCurencyPay"></span>&nbsp; {{$payments_historie->amount}}</div>
					</div>
                @endforeach
					

					<div class="couponsList">

						