<style type="text/css">
/*Flight Tab-content Search Starts*/
	.searchContainer {
		display: flex;
		justify-content: flex-start;
		}
	.searchFlightContainer {
		margin-bottom: 15px;
		}
	.dFlightPanel {
	    padding: 15px 30px;
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
	.dFlightPanelBox {
	    border: 1px solid #e7e7e7;
	    border-radius: 10px;
	    overflow: hidden;
	    display: flex;
	    justify-content: center;
		}
	.searchBox {
		border: 1px solid #ccc;
		padding: 10px 15px;
		height: 99px;
		}
	.searchBox:hover {
		background-color: #eaf5ff;
		}
	.searchBoxLabel {
		display: block;
		color: #000001 !important;
		margin-right: 0 !important;
		margin-bottom: 10px !important;
		font-size: 14px;
		line-height: 14px;
		font-weight: 600;
		letter-spacing: .64px;
		text-transform: none;
		}
	.searchContainer_inputBox, .searchContainer_selectBox {
		border: 0;
	    outline: 0;
	    background: none;
	    cursor: pointer;
		padding: 0;
		text-transform: capitalize;
		font-family: "Lato", sans-serif;
		font-size: 26px;
		line-height: 30px;
		font-weight: 900;
		color: #000001;
		width: 100%;
		height: auto;
		}
	.tripTypeContainer {
		display: flex;
		align-items: center;
		margin-bottom: 10px;
		}
	.tripTypeContainer, .mtripTypeContainer {
		display: flex;
		align-items: center;
		white-space: nowrap;
		/*width: 50px;*/
		overflow: hidden;
		text-overflow: ellipsis;
		margin-bottom: 10px;
		}
	.tripType {
		display: inline-flex;
		align-items: flex-start;
		padding: 8px 15px;
		background: #ffffff;
		color: #A1A1A1 !important;
		border: 1px solid #e9e9e9;
		border-radius: 25px;
		cursor: pointer;
		margin-right: 10px;
		}
	.mtripType {
		display: inline-flex;
		align-items: flex-start;
		padding: 6px;
		background: #ffffff;
		color: #A1A1A1 !important;
		border: 1px solid #e9e9e9;
		border-radius: 25px;
		cursor: pointer;
		margin-right: 10px;
		}
	.tripTypeContainer > ul > li input[type=radio], .mtripTypeContainer > ul > li input[type=radio] {
		margin-top: 0px;
		cursor: pointer;
		height: 14px;
		width: 14px;
		}
	.routeName {
		display: block;
	    margin-right: 0px !important;
		margin-bottom: 0px;
		margin-left: 5px;
	    color: #a1a1a1 !important;
		font-size: 14px;
		line-height: 14px;
		font-weight: 600;
		}
	.routeType {
		display: flex;
		/*align-items: flex-end;*/
		background: #ffffff;
		margin-right: 20px;
		cursor: pointer;
		}
	.mrouteType {
		display: flex;
		align-items: center;
		background: #ffffff;
		margin-right: 20px;
		}
	.routeType input[type=checkbox], .mrouteType input[type=checkbox] {
		margin: 0;
		width: 14px;
		height: 14px;
		margin-right: 5px;
		}
	.routeTypeName {
		display: block;
	    margin-right: 0px !important;
		margin-bottom: 0px;
	    color: #A1A1A1 !important;
		font-size: 14px;
		line-height: 14px;
		font-weight: 600;
		}
	.mrouteTypeName {
		display: block;
	    margin-right: 0px !important;
		margin-bottom: 0px;
	    color: #A1A1A1 !important;
		font-size: 14px;
		line-height: 14px;
		font-weight: 600;
		}
	.departureCityBox {
		border-radius: 5px 0px 0px 5px;
		border-right: 0;
		width: 25%;
		}
	.destinationCityBox {
		border-radius: 0px;
		border-right: 0;
		width: 25%;
		}
	.departureDateBox {
		border-radius: 0px;
		border-right: 0;
		min-width: 150px;
		width: 15%;
		}
	.returnDateBox {
		border-radius: 0px;
		border-right: 0;
		min-width: 150px;
		width: 15%;
		position: relative;
		}
	.travellerBox {
		border-radius: 0px 5px 5px 0px;
		width: 20%;
		cursor: pointer;
		}
	.guestTotalValue {
		font-size: 30px;
		font-weight: 900;
		letter-spacing: 1px;
		}
	.cabinName {
		font-size: 16px;
		/*line-height: 14px;*/
		color: #A1A1A1;
		}
	/*.mdepartureCityBox, .mdestinationCityBox {
		border-radius: 3px;
		margin-bottom: 5px;
		background: #f9f9f9;
		}*/
	.mdepartureDateBox, .mreturnDateBox {
		/*border-radius: 3px;
		margin-bottom: 5px;
		background: #f9f9f9;*/
		width: 49%;
		}
	/*.mtravellerBox {
		border-radius: 3px;
		margin-bottom: 10px;
		background: #f9f9f9;
		}*/
	.mguestTotalValue {
		font-size: 26px;
		font-weight: 900;
		letter-spacing: 1px;
		}
	.mcabinName {
		font-size: 16px;
		/*line-height: 14px;*/
		color: #A1A1A1;
		}
	.departureDateBox .searchBoxLabel:after, .returnDateBox .searchBoxLabel:after, .travellerBox .searchBoxLabel:after, .tourDateBox .searchBoxLabel:after, .themeBox .searchBoxLabel:after, .checkinDateBox .searchBoxLabel:after, .checkoutDateBox .searchBoxLabel:after, .hotelRoomBox .searchBoxLabel:after {
		content: "";
		display: inline-block;
		border: solid #01b7f2;
	    border-width: 0 2px 2px 0;
	    padding: 4px;
	    transform: rotate(46deg);
	    -webkit-transform: rotate(46deg);
	    vertical-align: top;
	    margin: 0px 0 0 10px;
	    transition: all 0.4s ease-in-out;
		}
	.departureDateBox input, .returnDateBox input, .travellerBox input, .checkinDateBox input, .checkoutDateBox input, .hotelRoomBox input, .tourDateBox input {
		position: absolute;
		opacity: 0 !important;
		z-index: -1;
	    /*width: 100%;
	    height: 100%;
	    font-size: 0;
	    top: 0;
	    left: 0;*/
		}
	.mdepartureDateBox input, .mreturnDateBox input, .mtravellerBox input, .mcheckinDateBox input, .mcheckoutDateBox input, .mhotelRoomBox input, .mtourDateBox input  {
		position: absolute;
		opacity: 0 !important;
		z-index: -1;
		}
	.departureDate, .tourDate {
		font-size: 20px;
		line-height: 30px;
		text-align: left;
		margin: 0px;
		color: #000001;
		font-weight: 500;
		}
	.mdepartureDate, .mreturnDate, .mtourDate {
		font-size: 20px;
		line-height: 20px;
		text-align: left;
		margin: 0px;
		color: #000001;
		font-weight: 500;
		}
	.letterSpaceOne {
		letter-spacing: 1px
		}
	.returnClose {
	    position: absolute;
	    top: 5px;
	    right: 10px;
	    z-index: 1;
	    cursor: pointer;
		background: #e2e2e2;
		padding: 5px 6px;
		border-radius: 50%;
		/*content: "\2716";*/
		font-size: 14px;
		line-height: 14px;
		font-family: "Segoe UI Symbol", "-apple-system";
		}
	.mreturnClose {
	    position: absolute;
	    top: 5px;
	    right: 10px;
	    z-index: 1;
		background: #e2e2e2;
		padding: 5px 6px;
		border-radius: 50%;
		/*content: "\2716";*/
		font-size: 14px;
		line-height: 14px;
		font-family: "Segoe UI Symbol", "-apple-system";
		}
	.fareTypeContainer {
		display: flex;
		align-items: center;
		justify-content: flex-end;
		margin-bottom: 20px;
		}
	.mfareTypeContainer {
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		margin-bottom: 32px;
		}
	.stopType, .mstopType {
		display: flex;
		align-items: flex-end;
		background: #ffffff;
		border: 1px solid #A1A1A1;
		border-radius: 25px;
		padding: 5px 10px;
		}
	.stopType {
		cursor: pointer;
		}
	.mstopType {
		margin-bottom: 20px;
		}
	.stopType input[type=checkbox], .mstopType input[type=checkbox] {
		opacity: 0;
		}
	.stopTypeName, .mstopTypeName {
		display: block;
	    margin-right: 0px !important;
		margin-bottom: 0px;
	    color: #A1A1A1 !important;
		font-size: 14px;
		line-height: 14px;
		font-weight: 600;
		}
	.stopTypeName {
		cursor: pointer;
		}
	.stopType:hover, .stopTypeName:hover, .stopType.active, .stopTypeName.active, .mstopType.active, .mstopTypeName.active {
		background: #01b7f2;
	    color: #ffffff !important;
		border-color: #01b7f2;
		}
		
	/*IATA SEARCH*/
	.airportListPopup, .holidayListPopup {
	    border-radius: 4px;
	    background-color: #ffffff;
	    box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
	    width: 309px;
	    position: absolute;
	    /*left: 25px;*/
	    top: 130px;
	    min-height: 309px;
	    overflow: hidden;
	    z-index: 999;
		}
	.mairportListPopup {
	    border-radius: 4px;
	    background-color: #ffffff;
	    box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
	    width: 90%;
	    position: absolute;
	    /*left: 25px;*/
	    top: 125px;
	    min-height: 370px;
	    overflow: hidden;
	    z-index: 999;
		}
	.airportListPopup input, .mairportListPopup input, .holidayListPopup input {
		background: #ffffff;
		box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
		padding: 11px 10px 11px 30px;
		outline: 0;
		border: 0;
		width: 100%;
		font-size: 16px;
		color: #000000;
		font-weight: 700;
		}
	.popularAirportList, .trendingHolidayDest {
		position: relative;
		width: 100%;
		height: calc(100vh - 60px);
		overflow-y: auto;
		margin: 0;
		padding: 15px;
		font-size: 16px;
		z-index: 2;
		max-height: 280px;
		}
	.boxTitle {
		text-transform: uppercase;
		padding: 10px;
		}
	.boxTitleHeading {
		font-size: 12px;
		line-height: 12px;
		font-weight: 900;
		color: #9B9B9B;
		margin: 0px;
		text-align: left;
		}
	.suggestionList li {
		padding: 15px 10px;
		cursor: pointer;
		}
	.suggestionList li:hover {
		background: #f9f9f9;
		border-radius: 2px;
		}
	.iataCity, .holidayDest {
		font-size: 14px;
		line-height: 14px;
		color: #000001;
		margin: 0px;
		}
	.iataCode, .destCountry {
		margin-left: auto;
		font-size: 14px;
		line-height: 14px;
		color: #9B9B9B;
		font-weight: 700;
		}
	.calc60 {
		width: calc(100% - 60px);
		}
	.leftSection {
		width: 300px;
		}
	.sectionHeading {
		font-size: 15px;
		line-height: 15px;
		color: #9B9B9B;
		font-weight: 600;
		margin-bottom: 15px;
		}
	.cabinClass {
		font-size: 15px;
		line-height: 15px;
		}
	.cabinClassType {
		display: flex;
		align-items: center;
		padding: 12px 12px 12px 0px;
		}
	.mcabinClassType {
		display: flex;
		align-items: center;
		padding: 10px 0px;
		}
	.cabinClassType > input[type=radio], .mcabinClassType > input[type=radio] {
		margin: 0px;
		height: 14px;
		width: 14px;
		}
	.cabinClassType > label, .mcabinClassType > label {
		display: block;
		font-size: 14px;
		line-height: 14px;
		font-weight: 500;
		color: #000001 !important;
		margin-left: 10px;
		margin-right: 0px !important;
		margin-bottom: 0px;	
		}
	.rightSection {
		width: 200px;
		}
	.travellersMinus {
		font-size: 26px;
	    line-height: 5px;
	    color: #9B9B9B;
	    padding: 12px;
	    font-weight: 900;
		cursor: pointer
		}
	.travellersValue {
		font-size: 20px;
		line-height: 20px;
		color: #01b7f2;
		font-weight: 900;
		padding: 12px
		}
	.travellersPlus {
		font-size: 26px;
	    line-height: 5px;
	    color: #9B9B9B;
	    padding: 12px;
	    font-weight: 900;
		cursor: pointer
		}
	.searchContainer_selectBox {
		font-size: 24px;
		}
	.selectBox_travellers {
		font-size: 18px;
		line-height: 18px;
		}
	.travellers {
	    border-radius: 4px;
	    background-color: #ffffff;
	    box-shadow: 0 1px 6px 0 rgb(0 0 0 / 20%);
	    position: absolute;
	    right: 26px;
	    top: 132px;
	    padding: 25px 20px 20px 25px;
	    z-index: 1;
		}
	.btnApply {
		flex-shrink: 0;
		outline: 0;
		text-transform: uppercase;
		color: #ffffff;
		font-weight: 900;
		cursor: pointer;
		padding: 8px 20px;
		border: none;
		border-radius: 25px;
		background-color: #01b7f2;
		}
	/*Flight Search Ends*/
	</style>
	<style type="text/css">
	.makeflex {
		display: flex;
		}
	.justifycontentEvenly {
		justify-content: space-evenly;
		}
	.makeflexCenterEvenly {
		display: flex;
		align-items: center;
		justify-content: space-evenly;
		}
	.makeflexCenterBewtween {
		display: flex;
		align-items: center;
		justify-content: space-between;
		}

	.makeflex {
		display: flex;
		}
	.flexRow {
		flex-direction: row !important;
		}
	.flexColumn {
		flex-direction: column !important;
		}
	.flexRowReverse {
		flex-direction: row-reverse !important;
		}
	.flexColumnReverse {
		flex-direction: column-reverse !important;
		}
	.flexWrap {
		flex-wrap: wrap !important;
		}
	.flexNowrap {
		flex-wrap: nowrap !important;
		}
	.flex-wrap-reverse {
		flex-wrap: wrap-reverse !important;
		}
	.makeflexInline {
		display: inline-flex !important;
		}
	.justifycontentStart {
		justify-content: flex-start !important;
		}
	.justifycontentEnd {
		justify-content: flex-end !important;
		}
	.justifycontentCenter {
		justify-content: center !important;
		}
	.justifycontentBetween {
		justify-content: space-between !important;
		}
	.justifycontentAround {
		justify-content: space-around !important;
		}
	.justifycontentEvenly {
		justify-content: space-evenly !important;
		}
	.alignitemsStart {
		align-items: flex-start !important;
		}
	.alignitemsEnd {
		align-items: flex-end !important;
		}
	.alignitemsCenter {
		align-items: center !important;
		}
	.alignitemsBaseline {
		align-items: baseline !important;
		}
	.alignitemsStretch {
		align-items: stretch !important;
		}
	.flex1 {
		flex: 1;
		}
	.flex110 {
		flex-grow: 1;
	    flex-shrink: 1;
	    flex-basis: 0%;
		}
	.aligncenter {
		align-items: center;
		}
	.flexBetween {
		display: flex;
		justify-content: space-between;
		}
	.flexcenter, .flexCenter {
		display: flex;
		align-items: center;
		}
/*Flight Tab-content Search Starts*/
</style>
  				<div class="tab">
				<form action="{{ URL::to('/') }}" method="post" autocomplete="off" name="" >
					<input type="hidden" name="_token" value="{{ Session::token() }}"/>
					<div class="dFlightPanel">
						<div class="tripTypeCont">
							<h4>Book Domestic and International Flights</h4>
						</div>
						<div class="tripTypeContainer">
							<ul>
								<li class="tripType">
									<input type="radio" id="oneway" name="oneway" value="oneway" checked="checked" >
									<label for="oneway" class="routeName">ONEWAY</label>
								</li>
								<li class="tripType">
									<input type="radio" id="return" name="return" value="return">
									<label for="return" class="routeName">RETURN</label>
								</li>
								<li class="tripType">
									<input type="radio" id="multicity" name="multicity" value="multicity">
									<label for="multicity" class="routeName">MULTICITY</label>
								</li>
							</ul>
						</div>
						<div class="searchContainer searchFlightContainer">
							<div class="searchBox departureCityBox">
								<label for="destination_search" class="searchBoxLabel">FROM</label>
								<input type="text" class="searchContainer_inputBox" id="" name="" value="Delhi (DEL)" placeholder="Enter Source" required />
								<div class="airportListPopup" role="combobox" style="display: none;">
									<input type="text" autocomplete="off" aria-autocomplete="list" placeholder="From" value="">
									<div class="popularAirportList" role="listbox">
										<div class="boxTitle">
											<p class="boxTitleHeading">TRENDING CITIES</p>
										</div>
										<ul class="suggestionList" role="listbox">
											<li role="option" aria-selected="">
												<div class="makeflexCenterEvenly">
													<div class="calc60">
														<p class="iataCity">Delhi, India</p>
													</div>
													<div class="iataCode">DEL</div>
												</div>
											</li>
											<li role="option" aria-selected="">
												<div class="makeflexCenterEvenly">
													<div class="calc60">
														<p class="iataCity">Mumbai, India</p>
													</div>
													<div class="iataCode">BOM</div>
												</div>
											</li>
											<li role="option" aria-selected="">
												<div class="makeflexCenterEvenly">
													<div class="calc60">
														<p class="iataCity">Chennai, India</p>
													</div>
													<div class="iataCode">MAA</div>
												</div>
											</li>
											<li role="option" aria-selected="">
												<div class="makeflexCenterEvenly">
													<div class="calc60">
														<p class="iataCity">Chennai, India</p>
													</div>
													<div class="iataCode">MAA</div>
												</div>
											</li>
										</ul>
									
									</div>
								</div>
							</div>
							<div class="searchBox destinationCityBox">
								<label for="destination_search" class="searchBoxLabel">TO</label>
								<input type="text" class="searchContainer_inputBox" name="" value="Mumbai (BOM)" placeholder="Enter Destination" required />
								<div class="airportListPopup" role="combobox" style="display: none;">
									<input type="text" autocomplete="off" aria-autocomplete="list" placeholder="To" value="">
									<div class="popularAirportList" role="listbox">
										<div class="boxTitle">
											<p class="boxTitleHeading">TRENDING CITIES</p>
										</div>
										<ul class="suggestionList" role="listbox">
											<li role="option" aria-selected="">
												<div class="makeflexCenterEvenly">
													<div class="calc60">
														<p class="iataCity">Delhi, India</p>
													</div>
													<div class="iataCode">DEL</div>
												</div>
											</li>
											<li role="option" aria-selected="">
												<div class="makeflexCenterEvenly">
													<div class="calc60">
														<p class="iataCity">Mumbai, India</p>
													</div>
													<div class="iataCode">BOM</div>
												</div>
											</li>
											<li role="option" aria-selected="">
												<div class="makeflexCenterEvenly">
													<div class="calc60">
														<p class="iataCity">Chennai, India</p>
													</div>
													<div class="iataCode">MAA</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="searchBox departureDateBox">
								<label for="departure" class="searchBoxLabel">DEPARTURE</label>
								<input type="text" name="departure" class="searchContainer_inputBox" value="20 Mar 2022">
								<p class="departureDate">
									<span class="font30 fontWeight900 letterSpaceOne">6</span>
									<span>Mar</span>
									<span>'22</span>
								</p>
							</div>
							<div class="searchBox returnDateBox">
								<label for="return" class="searchBoxLabel">RETURN</label>
								<input type="text" name="return" class="searchContainer_inputBox" value="20 Mar 2022">
								<p class="departureDate">
									<span class="colorA1">Add Return</span>
								</p>
								<p class="departureDate" style="display: none">
									<span class="font30 fontWeight900 letterSpaceOne">7</span>
									<span>Mar</span>
									<span>'22</span>
								</p>
								<span class="returnClose">&#x2716;</span>
							</div>
							<div class="searchBox travellerBox">
								<label for="travellers" class="searchBoxLabel">TRAVELLER & CLASS</label>
								<input type="text" name="travellers" class="searchContainer_inputBox" value="0 Infant, 0 Children, 1 Adult ">
								<p class="departureDate">
									<span class="guestTotalValue">4</span>
									<span style="display: none">Traveller</span>
									<span>Travellers</span>
									<span class="cabinName"> - Economy</span>
								</p>
							</div>
							<div class="travellers" style="display: none;">
								<div class="makeflex justifycontentBetween appendBottom15">
									<div class="leftSection">
										<div>
											<h4 class="sectionHeading">Select Cabin Class</h4>
										</div>
										<div class="cabinClassType">
											<input type="radio" name="economy_class">
											<label for="economy_class">Economy / Premium Economy</label>
										</div>
										<div class="cabinClassType">
											<input type="radio" name="premium_economy_class">
											<label for="premium_economy_class">Premium Economy</label>
										</div>
										<div class="cabinClassType">
											<input type="radio" name="business_class">
											<label for="business_class">Business</label>
										</div>
										<div class="cabinClassType">
											<input type="radio" name="first_class">
											<label for="first_class">First</label>
										</div>
									</div>
									<div class="rightSection">
										<div>
											<h4 class="sectionHeading">Select Travellers</h4>
										</div>
										<div class="makeflexCenterEvenly appendBottom10">
											<div>
												<p class="pfwmt font16 appendBottom5">Adult</p>
												<p class="pmt font12 colorA1">( + 12yrs)</p>
											</div>
											<div class="makeflex alignitemsCenter">
												<input type="hidden" id="travellers" value="1" />
												<span class="travellersMinus">&#8722;</span>
												<span class="travellersValue">1</span>
												<span class="travellersPlus">&#43;</span>
											</div>
										</div>
										<div class="makeflexCenterEvenly appendBottom10">
											<div>
												<p class="pfwmt font16 appendBottom5">Child</p>
												<p class="pmt font12 colorA1">(2 - 12yrs)</p>
											</div>
											<div class="makeflex alignitemsCenter">
												<input type="hidden" id="travellers" value="0" />
												<span class="travellersMinus">&#8722;</span>
												<span class="travellersValue">0</span>
												<span class="travellersPlus">&#43;</span>
											</div>
										</div>
										<div class="makeflexCenterEvenly">
											<div>
												<p class="pfwmt font16 appendBottom5">Infant</p>
												<p class="pmt font12 colorA1">(0 - 2yrs)</p>
											</div>
											<div class="makeflex alignitemsCenter">
												<span class="travellersMinus">&#8722;</span>
												<span class="travellersValue">0</span>
												<span class="travellersPlus">&#43;</span>
											</div>
										</div>
									</div>
								</div>
								<div>
									<input class="btnApply font14 floatRight" type="submit" name="submit" value="Apply" />
								</div>
							</div>
						</div>
							<!--<div class="searchBox travellerBox">
								<label for="travellers" class="searchBoxLabel">TRAVELLER & CLASS</label>
								<select name="travellers" class="searchContainer_selectBox" >
									<option class="selectBox_travellers">Select (optional)</option>
									<option class="selectBox_travellers" selected>1 Traveller</option>
								</select>
							</div>-->
						<div class="fareTypeContainer justifycontentBetween">
							<ul class="makeflex">
								<li class="routeType">
									<input type="checkbox" name="direct">
									<label for="direct" class="routeTypeName">ARMED FORCES</label>
								</li>
								<li class="routeType">
									<input type="checkbox" name="direct">
									<label for="direct" class="routeTypeName">SENIOR CITIZEN</label>
								</li>
								<li class="routeType">
									<input type="checkbox" name="direct">
									<label for="direct" class="routeTypeName">STUDENT</label>
								</li>
								<li class="routeType">
									<input type="checkbox" name="direct">
									<label for="direct" class="routeTypeName">SPECIAL FARE</label>
								</li>
							</ul>
							<ul class="makeflex">
								<li class="stopType">
									<!--<input type="checkbox" name="direct">-->
									<label for="nonstop" class="stopTypeName">NON-STOP</label>
								</li>
							</ul>
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