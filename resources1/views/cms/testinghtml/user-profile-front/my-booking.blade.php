@extends('layouts.front.masternofooter')
 @if(env("WEBSITENAME")==1)
 @section("title", 'The World Gateway')
 @elseif(env("WEBSITENAME")==0)
 @section("title", 'RapidexTravels')
 @endif

 @section('content')
<style type="text/css">
.myBookingBG {
	background: #f9f9f9;
	}
.myBookingBreadCrumpCont {
	padding-top: 20px;
	background-image: linear-gradient(261deg,#7dbfcc,#5ee7cd);
	height: 200px;
	margin-bottom: 40px;
	}
.myBookingBreadCrump {
	font-size: 15px;
	line-height: 17px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	display: flex;
    align-items: center;
	}
.rightArrow {
	border-width: 2px 2px 0 0;
	transition: all .3s linear;
	width: 7px;
    height: 7px;
	border-top: 2px solid #00000099;
    border-right: 2px solid #00000099;
	/*border-color: #fff;*/
    display: inline-block;
    padding: 3px;
	transform: rotate(45deg) skew(7deg,7deg);
	margin-left: 5px;
	margin-right: 5px;
	}
.tripHeading {
	background: #ffffff;
	padding: 30px 20px 40px 30px;
	box-shadow: 0 3px 30px 0 rgb(0 0 0 / 10%);
	border-radius: 5px 5px 0px 0px;
	font-size: 16px;
	line-height: 16px;
	position: sticky;
	top: 0;
	margin-top: -155px;
	z-index: 1;
	}
.tripHeading > ul > div > li.active {
  color: #008cff;
  padding-bottom: 25px;
  border-bottom: 4px solid #008cff;
  }
.tripHeading > ul > li:hover, ul > li:focus {
  color: #008cff;
  }
.tripStatus {
	margin: 0 30px 0 0;
	color: #A1A1A1;
	font-weight: 900;
	padding-bottom: 15px;
	cursor: pointer;
	}
.findBooking {
	width: 250px;
	}
.findBooking input[type=text] {
    background: #fff;
    border: 1px solid #9b9b9b;
    border-radius: 4px;
	font-size: 14px;
	line-height: 14px;
    padding: 12px 16px;
    outline: 0;
	height: auto;
	width: 100%;
	}
.findBooking input:focus {
    box-shadow: none;
	}
.myBookingCont {
	padding: 40px 30px 30px 45px;
	border-radius: 0px 0px 10px 10px;
	box-shadow: 0 3px 30px 0 rgb(0 0 0 / 10%);
    background-color: #fff;
	margin-bottom: 350px;
	}
.myBookingList {
    box-shadow: 0 1px 6px 0 #00000033;
    background-color: #fff;
    padding: 40px 50px 20px;
    position: relative;
	}
.myBookingList > .myBkngServiceIcon {
    width: 54px;
    height: 54px;
    background-color: #fff;
    border: 3px solid #f1f1f1;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
	}
.myBkngServiceIcon {
    position: absolute;
    left: -31px;
    top: 18px;
	}
.myBkngSummary {
    box-shadow: 0 1px 6px 0 #00000033;
    background-color: #fff;
    padding: 40px 50px 20px;
    position: relative;
	}
.myBkngSummaryBox {
	display: flex;
	justify-content: space-between;
	align-items: flex-end;
	}
	
.summaryLeftPart {
	position: relative;
	display: flex;
	align-items: flex-end;
	justify-content: space-between;
	width: 580px;
	}
.travelDtls, .bkngDtls {
	display: flex;
    flex-direction: column;
    align-items: flex-start;
	}
.travelDtlsHead {
	font-size: 14px;
	line-height: 18px;
	color: #a1a1a1;
	font-weight: 500;
	text-align: left;
	margin-bottom: 10px;
	}
.travelDtlsDate {
	font-size: 16px;
	line-height: 16px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 10px;
	}
.travelDtlsCity {
	font-size: 14px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.summaryRightPart {
	overflow: hidden;
	font-size: 14px;
    line-height: 16px;
	color: #008cff;
	font-weight: 600;
	display: flex;
	flex-direction: column;
	align-items: flex-start;
	width: 190px;
	}
.myBookingTitle {
    font-size: 22px;
    font-weight: 900;
    color: #202e4a;
    max-width: 515px;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    white-space: nowrap;
	margin: 0px;
	}
.myBookingUpcomingDays_tag {
    border-radius: 4px;
    padding: 5px 8px;
    background-color: #d6f6f3;
	color: #1a7971;
    margin-left: 10px;
    flex-shrink: 0;
	font-size: 11px;
	line-height: 11px;
	font-weight: 700;
	}
.myBookingRefId {
	font-size: 14px;
	line-height: 18px;
	color: #747474;
	font-weight: 500;
	text-align: left;
	margin-top: 5px;
	margin-bottom: 0;
	}
.manageBkngBox {
	width: 190px;
    display: flex;
    align-items: flex-start;
	}
.btnManageBooking {
	flex-shrink: 0;
	outline: 0;
	text-transform: uppercase;
	background: #008cff;
	border: 0;
    border-radius: 20px;
	padding: 10px 12px;
    font-size: 16px;
	line-height: 18px;
	color: #fff;
	font-weight: 700;
	cursor: pointer;
	margin-bottom: 0;
	width: 100%;
	}
.btnManageBooking:hover {
	background: #008cff;
	color: #fff;
	}
.btnTripPlan {
	flex-shrink: 0;
	outline: 0;
	text-transform: uppercase;
	background: #008cff;
	border: 0;
    border-radius: 20px;
	padding: 10px 12px;
    font-size: 16px;
	line-height: 18px;
	color: #fff;
	font-weight: 700;
	cursor: pointer;
	margin-bottom: 0;
	width: 140px;
	}
.btnTripPlan:hover {
	background: #008cff;
	color: #fff;
	}
.fa-cog:before {
	content: "\f013";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
	color: #4a4a4a;
	font-size: 15px;
	line-height: 1;
	cursor: unset;
	width: 18px;
	}
.bkngDtlsDuration {
	font-size: 14px;
	line-height: 18px;
	color: #008cff;
	font-weight: 600;
	text-align: left;
	margin-bottom: 5px;
	margin-left: 10px;
	}
.travellerIcon {
	display: flex;
	flex-direction: column;
	align-items: center;
	flex-shrink: 0;
	}
.travellerIcon > .bigFace {
	text-align: center;
	margin: 0px;
	border: 1px solid #4a4a4a;
	padding: 2px;
	border-radius: 50%;
	}
.travellerIcon > .bigBody {
	text-align: center;
	border: 1px solid #4a4a4a;
	padding: 2px;
	border-radius: 3px 3px 0px 0px;
	border-bottom: none !important;
	width: 10px;
	}
.travellerIcon > .smallFace {
	text-align: center;
	margin: 0px;
	border: 1px solid #4a4a4a;
	padding: 1px;
	border-radius: 50%;
	}
.travellerIcon > .smallBody {
	text-align: center;
	border: 1px solid #4a4a4a;
	padding: 2px;
	border-radius: 3px 3px 0px 0px;
	border-bottom: none !important;
	width: 8px;
	}
.bkngDtlsGuest {
	font-size: 14px;
	line-height: 18px;
	color: #4a4a4a;
	font-weight: 600;
	text-align: left;
	margin-bottom: 0;
	margin-left: 10px;
	}
.emptyTripBucket {
	background: #fff;
	display: flex;
	justify-content: space-between;
	padding: 60px 20px 70px 40px;
	box-shadow: 0 3px 30px 0 rgb(0 0 0 / 10%);
	border-radius: 0px 0px 5px 5px;
	font-size: 16px;
	line-height: 16px;
	margin-bottom: 350px;
	}
.emptyTripBucket > .bucketContainer {
	display: flex;
	align-items: center !important;
	padding: 40px 30px 30px 45px
	}
.bucketTitle {
	font-size: 20px;
	line-height: 24px;
	color: #000001;
	font-weight: 600;
	text-align: left;
	margin-bottom: 15px;
	}
.bucketSubTitle {
	font-size: 14px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 0;
	}
.fa-suitcase:before {
	content: "\f0f2";
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
	color: #4a4a4a;
	font-size: 60px;
	line-height: 1;
	cursor: unset;
	}
.upcomingSuitcase {
	font-size: 60px;
	color: #4a4a4a;
	}
</style>
<style type="text/css">
.makeflex {
	display: flex !important;
	}
.flexBetween {
	display: flex;
	justify-content: space-between;
	}
.flex-column {
    display: flex;
    flex-direction: column;
	}
.appendBottom10 {
	margin-bottom: 10px;
	}
.appendBottom20 {
	margin-bottom: 20px;
	}
.appendLeft40 {
	margin-left: 40px;
	}
.tabcontent {
  display: none;
  }
</style>
<section>
<div class="myBookingBG">
	<div class="myBookingBreadCrumpCont"> 
		<div class="pageContainer">
			<h5 class="myBookingBreadCrump">My Account&nbsp;<span class="rightArrow"></span>&nbsp;My Booking</h5>
		</div>
	</div>
	<div class="pageContainer">
		<div class="tripHeading">
			<ul class="flexBetween">
				<div class="makeflex">
					<li class="tablinks active tripStatus" id="defaultOpen" onclick="openTab(event, 'upcoming')">UPCOMING</li>
					<li class="tablinks tripStatus" onclick="openTab(event, 'cancelled')">CANCELLED</li>
					<li class="tablinks tripStatus" onclick="openTab(event, 'completed')">COMPLETED</li>
					<li class="tablinks tripStatus" onclick="openTab(event, 'failed')">FAILED</li>
				</div>
				<div class="findBooking">
					<input type="text" name="search" placeholder="Search Booking" />
				</div>
			</ul>
		</div>
		<div class="tabcontent" id="upcoming">
			<!--<div class="emptyTripBucket">
				<div class="bucketContainer">
					<div class="fa-suitcase"></div>
					<div class="appendLeft40">
					<div class="appendBottom20">
						<p class="bucketTitle">You have no upcoming booking</p>
						<p class="bucketSubTitle">When you make a booking, you will see the details here.</p>
					</div>
					<a href="#"><button type="button" name="plantrip" id="" class="btnMain btnTripPlan">PLAN A TRIP</button></a>
					</div>
				</div>
			</div>-->
			<div class="myBookingCont">
				<div class="myBookingList">
					<div class="myBkngServiceIcon"></div>
					<div class="flexBetween">
						<div class="flex-column">
							<div class="flexCenter">
								<div>
									<h2 class="myBookingTitle">Dubai Shopping Tour - with Abu Dhabi Dubai Shopping Tour - with Abu Dhabi</h2>
								</div>
								<div>
									<span class="myBookingUpcomingDays_tag">In 10 days</span>
								</div>
							</div>
							<div class="myBookingRefId">
								<span>Booking ID&nbsp;-&nbsp;#9876543210</span>
							</div>
						</div>
						<div class="manageBkngBox">
							<button type="button" name="managebooking" class="btnMain btnManageBooking">MANAGE BOOKING</button>
						</div>
					</div>
				</div>
				<div class="myBkngSummary">
					<div class="myBkngSummaryBox">
						<div class="summaryLeftPart">
							<div class="travelDtls">
								<p class="travelDtlsHead">DEPARTURE</p>
								<p class="travelDtlsDate">Fri, 01 April'22</p>
								<p class="travelDtlsCity">New Delhi</p>
							</div>
							<div class="travelDtls">
								<p class="travelDtlsHead">RETURN</p>
								<p class="travelDtlsDate">Tue, 05 April'22</p>
								<p class="travelDtlsCity">Sharjah</p>
							</div>
							<div class="bkngDtls">
								<div class="fa-cog appendBottom10"><span class="bkngDtlsDuration">2 Room(s), 4 Nights - 5 Days</span></div>
								<div class="flexCenter">
									<div class="makeflex alignitemsEnd" style="width: ">
										<div class="travellerIcon">
											<span class="bigFace"></span>
											<span class="bigBody"></span>
										</div>
										<div class="travellerIcon">
											<span class="smallFace"></span>
											<span class="smallBody"></span>
										</div>
									</div>
									<div class="bkngDtlsGuest">Sandeep Kumar + 4</div>
								</div>
							</div>
						</div>
						<div class="summaryRightPart">
							<div class="appendBottom10 cursorPointer">Cancel Booking</div>
							<div class="cursorPointer">Change Tour Dates</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tabcontent" id="cancelled">
			<div class="emptyTripBucket">
				<div class="bucketContainer">
					<div class="fa-suitcase"></div>
					<div class="appendLeft40">
						<div class="appendBottom20">
							<p class="bucketTitle">You have no cancelled booking</p>
							<p class="bucketSubTitle">Great! Looks like you have no cancelled booking.</p>
						</div>
						<a href="#"><button type="button" name="plantrip" id="" class="btnMain btnTripPlan">PLAN A TRIP</button></a>
					</div>
				</div>
			</div>
		</div>
		<div class="tabcontent" id="completed">
			<div class="emptyTripBucket">
				<div class="bucketContainer">
					<div class="fa-suitcase"></div>
					<div class="appendLeft40">
						<div class="appendBottom20">
							<p class="bucketTitle">You have no completed booking</p>
							<p class="bucketSubTitle">Looks like you don't have any completed trip.</p>
						</div>
						<a href="#"><button type="button" name="plantrip" id="" class="btnMain btnTripPlan">PLAN A TRIP</button></a>
					</div>
				</div>
			</div>
		</div>
		<div class="tabcontent" id="failed">
			<div class="emptyTripBucket">
				<div class="bucketContainer">
					<div class="fa-suitcase"></div>
					<div class="appendLeft40">
						<div class="appendBottom20">
							<p class="bucketTitle">You have no failed booking</p>
							<p class="bucketSubTitle">Great! Looks like you have no failed booking.</p>
						</div>
						<a href="#"><button type="button" name="plantrip" id="" class="btnMain btnTripPlan">PLAN A TRIP</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript">
//<!--tabs button script-->
function openTab(evt, contentName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(contentName).style.display = "block";
  evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
@endsection