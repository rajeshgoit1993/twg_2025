<style type="text/css">
/*Hotel Tab-content Search Starts*/
	.searchContainer {
		display: flex;
		justify-content: flex-start;
		}
	.searchFlightContainer {
		margin-bottom: 15px;
		}
	.dHotelPanel {
	    padding: 30px 30px 70px;
		}
	.tripTypeCont {
	    margin-bottom: 10px;
		}
	.tripTypeCont h4 {
	    padding: 6px 0px;
	    font-size: 16px;
	    line-height: 20px;
	    font-weight: 600;
	    color: #A1A1A1;
	    text-align: left;
	    margin-bottom: 0;
		}
	.dHotelPanelBox {
	    border: 1px solid #e7e7e7;
	    border-radius: 10px;
	    overflow: hidden;
	    display: flex;
	    justify-content: center;
		}
/*Hotel Tab-content Search Ends*/
</style>
  				<div class="tab">
					<form action="{{ URL::to('/search-hotel') }}" method="post" autocomplete="off" name="" id="">
					<input type="hidden" name="_token" value="{{ Session::token() }}"/>
						<div class="dHotelPanel">
							<div class="tripTypeCont">
								<h4>Book Domestic and International Hotels</h4>
							</div>
							<div class="searchContainer searchHotelContainer">
								<div class="searchBox hotelCityBox">
									<label for="destination_search" class="searchBoxLabel">CITY / HOTEL</label>
									<input type="text" class="searchContainer_inputBox" id="" name="" value="Delhi" placeholder="Enter City" required />
									<div id="response" style="position: relative;z-index: 11"></div>
								</div>
								<div class="searchBox checkinDateBox">
									<label for="departure" class="searchBoxLabel">CHECK-IN</label>
									<input type="text" id="" name="departure" class="searchContainer_inputBox" value="20 Mar 2022">
									<p class="departureDate">
										<span class="font30 fontWeight900 letterSpaceOne">6</span>
										<span>Mar</span>
										<span>'22</span>
									</p>
								</div>
								<div class="searchBox checkoutDateBox">
									<label for="return" class="searchBoxLabel">CHECK-OUT</label>
									<input type="text" id="" name="return" class="searchContainer_inputBox" value="20 Mar 2022">
									<p id="" class="departureDate" style="display: none">
										<span class="colorA1">Add Return</span>
									</p>
									<p id="" class="departureDate">
										<span class="font30 fontWeight900 letterSpaceOne">7</span>
										<span>Mar</span>
										<span>'22</span>
									</p>
								</div>
								<div class="searchBox hotelRoomBox">
									<label for="travellers" class="searchBoxLabel">ROOMS & GUESTS</label>
									<input type="text" id="" name="travellers" class="searchContainer_inputBox" value="0 Infant, 0 Children, 1 Adult ">
									<p class="departureDate">
										<span class="font30 fontWeight900 letterSpaceOne">1</span>
										<span>Room</span>
										<span class="font30 fontWeight900 letterSpaceOne">2</span>
										<span>Guests</span>
									</p>
								</div>
								<div class="hotelRoomGuests" style="display: ;">
									<div class="roomGuestTopSection appendBottom20">
										<div>
											<h4 class="roomGuestHeading">Room 1</h4>
										</div>
										<div class="makeflexCenterBewtween ">
											<div>
												<p class="pfwmt font16">Adult 
												<span class="pmt font12 colorA1">(Above 12yrs)</span></p>
											</div>
											<div class="makeflex alignitemsCenter">
												<input type="hidden" id="travellers" name="" class="" value="1" />
												<span class="travellersMinus">&#8722;</span>
												<span class="travellersValue">1</span>
												<span class="travellersPlus">&#43;</span>
											</div>
										</div>
										<div class="makeflexCenterBewtween appendBottom10">
											<div>
												<p class="pfwmt font16">Child 
												<span class="pmt font12 colorA1">(Below 12yrs)</span></p>
											</div>
											<div class="makeflex alignitemsCenter">
												<input type="hidden" id="travellers" name="" class="" value="0" />
												<span class="travellersMinus">&#8722;</span>
												<span class="travellersValue">4</span>
												<span class="travellersPlus">&#43;</span>
											</div>
										</div>
										<div class="makeflex">
											<div class="childAge appendRight25">
												<p class="ageHeading">CHILD-1 (Age)</p>
												<label class="labelAge">
												<select class="">
													<option>1</option>
												</select>
												</label>
											</div>
											<div class="childAge appendRight25">
												<p class="ageHeading">CHILD-2 (Age)</p>
												<label class="labelAge">
												<select class="">
													<option>1</option>
												</select>
												</label>
											</div>
											<div class="childAge appendRight25">
												<p class="ageHeading">CHILD-3 (Age)</p>
												<label class="labelAge">
												<select class="">
													<option>1</option>
												</select>
												</label>
											</div>
											<div class="childAge appendRight25">
												<p class="ageHeading">CHILD-4 (Age)</p>
												<label class="labelAge">
												<select class="">
													<option>1</option>
												</select>
												</label>
											</div>
										</div>
									</div>
									<div class="roomGuestBottomSection">
										<button type="button" class="btnMain btnAddRoom" name="submit">+ Add Another Room</button>
										<button type="button" class="btnMain btnApply" name="submit">Apply</button>
									</div>
								</div>
							</div>
						</div>
						<div class="dSrchBtnCont">
							<button type="submit" class="btnMain btnSearchWeb">Search</button>
						</div>
						<!--<div class="makeflex justifycontentCenter">
							<button class="btnMain btnSearchWeb"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</button>
						</div>-->
					</form>
				</div>