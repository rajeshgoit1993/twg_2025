		<!--Mobile Tour Price Bottom Bar Starts-->
		<div class="mPriceBarCont">
			<div class="mPriceBarBox">
				<!--Price Box-->
				<div class="get_update_price">
					@if($new_price!='na')
					@if($new_price['actual_price']==$new_price['discount_price'])
					<div class="mSideItemBoxTop">
						<p class="mSlashedPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
						<p class="mPriceTag">
							<span id="" class="mActualPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $details->Price_type }}
						</p>
					</div>
					@else
					<div class="mSideItemBoxTop">
						<p class="mSlashedPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
						<p class="mPriceTag">
							<span id="" class="mActualPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $details->Price_type }}
						</p>
						<!--<p class="mPriceSubTag" style="display: none;">*Excluding applicable taxes</p>-->
						<span class="mPkgOfferTag">
							<?php
								$tourdiscount=(int)$new_price['actual_price']-(int)$new_price['discount_price'];
								$percentage=$tourdiscount/$new_price['actual_price']*100;
							?>
							{{ round($percentage) }}% Off
						</span>
					</div>
					@endif
					@else
					<div class="mSideItemBoxTop">
						<p class="mPriceTag_OnRequest">
							<span class="defaultCurrency"></span> On Request
						</p>
					</div>
					@endif
				</div>
				<div class="mBookBtnBox">
					<div class="mPriceBarSepr"></div>
					<button type="button" class="mBtnQuery" id="addEnquiryModal_mobile">Send Query</button>
				</div>
			</div>
		</div>
		<!--Mobile Tour Price Bottom Bar Ends-->