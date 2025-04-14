      <!--Mobile Tour Tabs Ends-->
      <!--Main Tab-->
      <div class="tab-container mMainTabCont">
        <div class="overflowX mobscroll">
          <ul class="mMainTabButton">
            <!--Itinerary Tab-->
            <li class="tab-button" data-id="mItinerary">Itinerary</li>

            <!--Inclusion Tab-->
            @if($details->inclusions=="")
            @else
            <li class="tab-button" data-id="mTourInclusions">Inclusions</li>
            @endif

            <!--Visa Tab-->
            @if($details->payment_policy!="")
            @endif
            @if((empty($details->visa_p) || $details->visa_p=="N;"))
            @else
            <li class="tab-button" data-id="mTourVisa">Visa</li>
            @endif

            <!--Policy Tab-->
            @if($details->payment_policy!="")
            @endif
            @if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;"))
            @else
            <li class="tab-button" data-id="mTourPolicies">Terms&nbsp;&#38;&nbsp;Conditions</li>
            @endif

            <!--Destination Tab-->
            <li class="tab-button" data-id="mTourDestinations">Destination</li>

            <!--Similar Tour Tab-->
            @if($details->similar_packages!='' && $details->similar_packages!='N;')
            <li class="tab-button" data-id="mTourExtra">Similar&nbsp;Packages</li>
            @endif

            <!--Tour Pricing Tab-->
            <?php
              $pri=CustomHelpers::get_price($details->id);
              $price_upcoming=CustomHelpers::get_up_price($details->id);
            ?>
            @if(($pri!="On Request" && $details->onrequest!="1") || ($price_upcoming!="On Request" && $details->upcoming!="1"))
            <li class="tab-button" data-id="mTourPriceCalendar">Tour&nbsp;Pricing</li>
            @endif
          </ul>
        </div>
      </div>
      <!--Main & Sub Tab-Content-->
      <div class="tab-content">
        <div class="tab" data-id="mItinerary">
          <!--Sub Tab-->
          <div class="sub-tab-container mSubTabCont">
            <div class="overflowX mobscroll">
              <ul class="mSubTabButton flexCenter">
                <!--Itinerary Tab-content-->
                <!--Tour Itinerary Tab-->
                @if($daywise["day1"]["title"]!="")
                <li class="sub-tab-button" data-id="mDayWisePlan">Day&nbsp;Plan</li>
                @endif

                <!--Description & Highlights Tab-->
                @if($details->description=="" && $details->highlights=="")
                @else
                <li class="sub-tab-button" data-id="mTourOverview">Highlights</li>
                @endif

                <!--Flights Tab-->
                @if($details->flight!='')
                <?php
                  $flight_data=unserialize($details->flight);
                ?>
                @if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1)
                <li class="sub-tab-button" data-id="mTourFlights">Flights</li>
                @endif
                @endif
                
                <!--Accommodation Tab-->
                @if($details->accommodation=="")
                @else
                <li class="sub-tab-button" data-id="mTourAccommodation">Hotel</li>
                @endif

                <!--Transfers Tab-->
                @if($details->transfers!='')
                <?php
                  $transfers=unserialize($details->transfers);
                  $first_key = key($transfers);
                ?>
                @if($transfers[$first_key]['mode_title']!='')
                <li class="sub-tab-button" data-id="mTourTransfers">Transfers</li>
                @endif
                @endif

                <!--Activities Tab-->
                @if($details->tours=="N;")
                @else
                <li class="sub-tab-button" data-id="mTourActivity">Activities</li>
                @endif
              </ul>
            </div>
          </div>
          <!--Sub Tab Content-->
          <div class="sub-tab-content">
            <!--Tour Itinerary Tab-content-->
            @if($daywise["day1"]["title"]!="")
            <div class="sub-tab" data-id="mDayWisePlan">
              @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourItinerary')
            </div>
            @endif

            <!--Description & Highlights Tab-content-->
            @if($details->description=="" && $details->highlights=="")
            @else
            <div class="sub-tab" data-id="mTourOverview">
              @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourOverview')
            </div>
            @endif
            
            <!--Flights Tab-content-->
            @if($details->flight!='')
            <?php
              $flight_data=unserialize($details->flight);
            ?>
            @if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1)
            <div class="sub-tab" data-id="mTourFlights">
              @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourFlights')
            </div>
            @endif
            @endif

            <!--Accommodation Tab-content-->
            @if($details->accommodation=="")
            @else
            <div class="sub-tab" data-id="mTourAccommodation">
              @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourAccommodation')
            </div>
            @endif

            <!--Transfers Tab-content-->
            @if($details->transfers!='')
            <?php
              $transfers=unserialize($details->transfers);
              $first_key = key($transfers);
            ?>
            @if($transfers[$first_key]['mode_title']!='')
            <div class="sub-tab" data-id="mTourTransfers">
              @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourTransfers')
            </div>
            @endif
            @endif
            
            <!--Activities Tab-content-->
            @if($details->tours=="N;")
            @else
            <div class="sub-tab" data-id="mTourActivity">
              @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourActivity')
            </div>
            @endif
          </div>
        </div>
        <!--Main Tab Content-->
        <!--Inclusion Tab-content-->
        @if($details->inclusions=="")
        @else
        <div class="tab" data-id="mTourInclusions">
          @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourInclusions')
        </div>
        @endif

        <!--Visa Tab-content-->
        @if($details->payment_policy!="")
        @endif
        @if((empty($details->visa_p) || $details->visa_p=="N;"))
        @else
        <div class="tab" data-id="mTourVisa">
          @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourVisa')
        </div>
        @endif

        <!--Policy Tab-content-->
        @if($details->payment_policy!="")
        @endif
        @if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;"))
        @else
        <div class="tab" data-id="mTourPolicies">
          @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourPolicies')
        </div>
        @endif

        <!--Destination Tab-content-->
        <div class="tab" data-id="mTourDestinations">
          @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourDestinations')
        </div>

        <!--Similar Tour Tab-content-->
        @if($details->similar_packages!='' && $details->similar_packages!='N;')
        <div class="tab" data-id="mTourExtra">
          @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourExtra')
        </div>
        @endif

        <!--Tour Pricing Tab-content-->
        <?php
          $pri=CustomHelpers::get_price($details->id);
          $price_upcoming=CustomHelpers::get_up_price($details->id);
        ?>
        @if(($pri!="On Request" && $details->onrequest!="1") || ($price_upcoming!="On Request" && $details->upcoming!="1"))
        <div class="tab" data-id="mTourPriceCalendar">
          @include('packages.thirdpagecontent.mobile.mtour-tab-content.mTourPriceCalendar')
        </div>
        @endif
      </div>