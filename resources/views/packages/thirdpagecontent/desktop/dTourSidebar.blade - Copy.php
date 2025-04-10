<style type="text/css">
/*Side Bar*/
/*Desktop Tab event_stricky*/
.dNavBarStricky {
	background: #fff;;
	width: 58%;
	padding-bottom: 20px;
	border-bottom: 0;
	z-index: 11;
	float: left;
    display: block;
	}
.dNavBarStricky_remove {
	background: #fff;
	width: 58%;
	padding: 10px 0;
	border-bottom: 0;
	z-index: 11;
	float: left;
    display: block;
	}


.dSideNav {
	display: flex;
	flex-direction: column;
	flex-grow: 1;
	width: 300px;
	background: #fff;
	overflow-y: auto;
	}

	
.dSideBar {
	background: #fff;;
	width: 300px;
	z-index: 11;
	float: left;
    display: block;
	}
.dSideBar_remove {
	background: #fff;
	width: 300px;
	z-index: 11;
	float: left;
    display: block;
	}
.sticky1 {
	position: fixed;
	top: 0;
	}
.nightCountTag {
	display: inline-block;
    padding: 4px 6px;
	background: #26b5a9;
    border-radius: 3px;
	font-size: 13px;
	line-height: 14px;
	font-weight: 600;
	color: #fff;
	margin-right: 5px;
	}
.sideBarCont {
	display: flex;
	flex-direction: column;
	width: 300px;
	top: 0;
	}
.sidebarPriceCont {
	background: #ffff;
    border: 1px solid #e7e7e7;
    border-radius: 5px;
	margin-bottom: 30px;
    padding: 15px;
	}
.tourItemPriceBox {
	background: #F0F6FF;
    margin: 0;
    border-radius: 0;
	display: flex;
	flex-direction: column;
	flex-shrink: 0;
	flex-grow: 1;
	}
.tourItemPriceHeader {
	text-transform: capitalize;
    color: #9B9B9B;
	font-size: 14px;
    line-height: 20px;
    font-weight: 900;
    text-align: center;
    padding: 15px 0;
    letter-spacing: .64px;
	}
.tourItemPriceSection {
    height: 85px;
	display: flex;
    align-items: end;
    justify-content: center;
	margin-bottom: 20px;
	}
.tourItemPriceValueBox {
    display: flex;
    flex-direction: column;
    align-items: end;
	}
.tourDefaultCurency:before {
	content: '\0020B9';
	font-size: 20px;
	font-weight: 500;
	}
.tourItemPriceRequest {
	color: #000001;
	font-size: 18px;
	line-height: 20px;
	margin-bottom: 0;
	text-align: center;
	}
.tourItemPriceValue {
	color: #000001;
	font-size: 24px;
	line-height: 26px;
	font-weight: 600;
	margin-bottom: 0;
	text-align: right;
	}
.tourItemPriceType {
	font-size: 12px;
	line-height: 12px;
	color: #9b9b9b;
	font-weight: 500;
	text-align: right;
	margin-bottom: 0px;
	}
.tourItemPriceFooter {
	display: flex;
	align-items: flex-end;
	justify-content: center;
	padding-bottom: 13px;
	}
.btnViewDtls {
    flex-shrink: 0;
    outline: 0;
    text-transform: capitalize;
    background: #fff;
    border: 1px solid #cccccc;
    border-radius: 5px;
    padding: 12px 20px;
    font-size: 14px;
    line-height: 14px;
    color: #000001;
    font-weight: 700;
    cursor: pointer;
	width: 140px;
	height: 40px;
    text-align: center;
	white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
	letter-spacing: 0.64px;
	margin-bottom: 0;
	}
.btnViewDtls:hover {
	background-color: #fff;
	color: #000001;
	}


</style>
	<div class="dSideNav">
		<div id="sidebar_custom">
			<!--New Bar-->
			<div class="sidebarPriceCont">
				<!--Price section starts-->
				<div class="tourItemPriceBox" style="height: 220px;">
					<div class="tourItemPriceHeader">
						@if($details->tour_type=='')
Customized Tour
						@else
{{$details->tour_type}}
						@endif
						
					</div>
						<div class="tourItemPriceSection get_update_price">

                           @if($new_price!='na')
@if($new_price['actual_price']==$new_price['discount_price'])
<div class="tourItemPriceValueBox">
										<p class="tourItemPriceValue"><span class="tourDefaultCurency">&nbsp;</span>{{ $new_price['actual_price'] }}</p>
										<p class="tourItemPriceType">{{ $details->Price_type }}</p>
									</div>
@else

<div class="tourItemPriceValueBox">
										<p class="tourItemPriceValue">
											<span class="tourDefaultCurency"></span>
											<strike> {{ $new_price['actual_price'] }} </strike>

&nbsp;&nbsp;<span class="tourDefaultCurency"></span>
<?php 
$dicount=(int)$new_price['actual_price']-(int)$new_price['discount_price'];
$percentage=$dicount/$new_price['actual_price']*100;
?>
											 {{ $new_price['discount_price'] }}      ({{round($percentage)}})%


										</p>
										<p class="tourItemPriceType">{{ $details->Price_type }}</p>
									</div>


@endif

                           @else
<div class="tourItemPriceValueBox">
									<p class="tourItemPriceRequest"><span class="tourDefaultCurency">&nbsp;</span>On Request</p>
								</div>
                           @endif


							
						</div>
						<!--Price ends-->
						<div class="tourItemPriceFooter">
							<!--<button type="button" class="btnMain btnViewDtls" data-toggle="modal" data-target="#queryHandler" id="book">BOOK</button>-->
							<button type="button" class="btnMain btnViewDtls" id="addModal_destop">BOOK</button>
						</div>					
				</div>
				<!--Price section ends-->
			</div>
			<!--Why Book with us-->
		<div class="tourBookUsCont">
			<div>
				<h4 class="tourBookUsHeading">Why Book with us?</h4>
			</div>
			<div class="makeflex appendBottom20">
				<div class="tourBookUsIconBox">
					<i class="fa fa-support fontSize15"></i>
				</div>
				<div>
					<h5 class="tourBookUsSubHeading">Excellent Support</h5>
					<p class="tourBookUsContent">We have dedicated team to provide the support</p>
				</div>
			</div>
			<div class="makeflex appendBottom20">
				<div class="tourBookUsIconBox">
					<i class="fa fa-money fontSize15"></i>
				</div>
				<div>
					<h5 class="tourBookUsSubHeading">Low Rates & Savings</h5>
					<p class="tourBookUsContent">Contracted rates with the Hotels help to minimize the cost to Tour Packages</p>
				</div>
			</div>
			<div class="makeflex">
				<div class="tourBookUsIconBox">
					<i class="fa fa-bars fontSize15"></i>
				</div>
				<div>
					<h5 class="tourBookUsSubHeading">Variety of Tour Itineraries</h5>
					<p class="tourBookUsContent">Our experts work on the Tour itineraries to be offered </p>
				</div>
			</div>
		</div>
		</div>
	</div>
