      <!--Mobile Tour Tabs Ends-->
      <!--Main Tab-->
      <div class="tab-container mMainTabCont">
        <div class="overflowX mobscroll">
          <ul class="mMainTabButton">
            <!--Itinerary Tab-->
            <li class="tab-button" data-id="mItinerary">Itinerary</li>

            <!--Inclusion Tab-->
            <?php if($details->inclusions==""): ?>
            <?php else: ?>
            <li class="tab-button" data-id="mTourInclusions">Inclusions</li>
            <?php endif; ?>

            <!--Visa Tab-->
            <?php if($details->payment_policy!=""): ?>
            <?php endif; ?>
            <?php if((empty($details->visa_p) || $details->visa_p=="N;")): ?>
            <?php else: ?>
            <li class="tab-button" data-id="mTourVisa">Visa</li>
            <?php endif; ?>

            <!--Policy Tab-->
            <?php if($details->payment_policy!=""): ?>
            <?php endif; ?>
            <?php if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;")): ?>
            <?php else: ?>
            <li class="tab-button" data-id="mTourPolicies">Terms&nbsp;&#38;&nbsp;Conditions</li>
            <?php endif; ?>

            <!--Destination Tab-->
            <li class="tab-button" data-id="mTourDestinations">Destination</li>

            <!--Similar Tour Tab-->
            <?php if($details->similar_packages!='' && $details->similar_packages!='N;'): ?>
            <li class="tab-button" data-id="mTourExtra">Similar&nbsp;Packages</li>
            <?php endif; ?>

            <!--Tour Pricing Tab-->
            <?php
              $pri=CustomHelpers::get_price($details->id);
              $price_upcoming=CustomHelpers::get_up_price($details->id);
            ?>
            <?php if(($pri!="On Request" && $details->onrequest!="1") || ($price_upcoming!="On Request" && $details->upcoming!="1")): ?>
            <li class="tab-button" data-id="mTourPriceCalendar">Tour&nbsp;Pricing</li>
            <?php endif; ?>
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
                <?php if($daywise["day1"]["title"]!=""): ?>
                <li class="sub-tab-button" data-id="mDayWisePlan">Day&nbsp;Plan</li>
                <?php endif; ?>

                <!--Description & Highlights Tab-->
                <?php if($details->description=="" && $details->highlights==""): ?>
                <?php else: ?>
                <li class="sub-tab-button" data-id="mTourOverview">Highlights</li>
                <?php endif; ?>

                <!--Flights Tab-->
                <?php if($details->flight!=''): ?>
                <?php
                  $flight_data=unserialize($details->flight);
                ?>
                <?php if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1): ?>
                <li class="sub-tab-button" data-id="mTourFlights">Flights</li>
                <?php endif; ?>
                <?php endif; ?>
                
                <!--Accommodation Tab-->
                <?php if($details->accommodation==""): ?>
                <?php else: ?>
                <li class="sub-tab-button" data-id="mTourAccommodation">Hotel</li>
                <?php endif; ?>

                <!--Transfers Tab-->
                <?php if($details->transfers!=''): ?>
                <?php
                  $transfers=unserialize($details->transfers);
                  $first_key = key($transfers);
                ?>
                <?php if($transfers[$first_key]['mode_title']!=''): ?>
                <li class="sub-tab-button" data-id="mTourTransfers">Transfers</li>
                <?php endif; ?>
                <?php endif; ?>

                <!--Activities Tab-->
                <?php if($details->tours=="N;"): ?>
                <?php else: ?>
                <li class="sub-tab-button" data-id="mTourActivity">Activities</li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
          <!--Sub Tab Content-->
          <div class="sub-tab-content">
            <!--Tour Itinerary Tab-content-->
            <?php if($daywise["day1"]["title"]!=""): ?>
            <div class="sub-tab" data-id="mDayWisePlan">
              <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourItinerary', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>

            <!--Description & Highlights Tab-content-->
            <?php if($details->description=="" && $details->highlights==""): ?>
            <?php else: ?>
            <div class="sub-tab" data-id="mTourOverview">
              <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourOverview', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>
            
            <!--Flights Tab-content-->
            <?php if($details->flight!=''): ?>
            <?php
              $flight_data=unserialize($details->flight);
            ?>
            <?php if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1): ?>
            <div class="sub-tab" data-id="mTourFlights">
              <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourFlights', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <!--Accommodation Tab-content-->
            <?php if($details->accommodation==""): ?>
            <?php else: ?>
            <div class="sub-tab" data-id="mTourAccommodation">
              <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourAccommodation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>

            <!--Transfers Tab-content-->
            <?php if($details->transfers!=''): ?>
            <?php
              $transfers=unserialize($details->transfers);
              $first_key = key($transfers);
            ?>
            <?php if($transfers[$first_key]['mode_title']!=''): ?>
            <div class="sub-tab" data-id="mTourTransfers">
              <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourTransfers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            
            <!--Activities Tab-content-->
            <?php if($details->tours=="N;"): ?>
            <?php else: ?>
            <div class="sub-tab" data-id="mTourActivity">
              <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourActivity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <!--Main Tab Content-->
        <!--Inclusion Tab-content-->
        <?php if($details->inclusions==""): ?>
        <?php else: ?>
        <div class="tab" data-id="mTourInclusions">
          <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourInclusions', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php endif; ?>

        <!--Visa Tab-content-->
        <?php if($details->payment_policy!=""): ?>
        <?php endif; ?>
        <?php if((empty($details->visa_p) || $details->visa_p=="N;")): ?>
        <?php else: ?>
        <div class="tab" data-id="mTourVisa">
          <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourVisa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php endif; ?>

        <!--Policy Tab-content-->
        <?php if($details->payment_policy!=""): ?>
        <?php endif; ?>
        <?php if((empty($details->visa_p) || $details->visa_p=="N;") && (empty($details->payment_p) || $details->payment_p=="N;") && (empty($details->can_p) || $details->can_p=="N;") && (empty($details->imp_notes) || $details->imp_notes=="N;")): ?>
        <?php else: ?>
        <div class="tab" data-id="mTourPolicies">
          <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourPolicies', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php endif; ?>

        <!--Destination Tab-content-->
        <div class="tab" data-id="mTourDestinations">
          <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourDestinations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <!--Similar Tour Tab-content-->
        <?php if($details->similar_packages!='' && $details->similar_packages!='N;'): ?>
        <div class="tab" data-id="mTourExtra">
          <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourExtra', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php endif; ?>

        <!--Tour Pricing Tab-content-->
        <?php
          $pri=CustomHelpers::get_price($details->id);
          $price_upcoming=CustomHelpers::get_up_price($details->id);
        ?>
        <?php if(($pri!="On Request" && $details->onrequest!="1") || ($price_upcoming!="On Request" && $details->upcoming!="1")): ?>
        <div class="tab" data-id="mTourPriceCalendar">
          <?php echo $__env->make('packages.thirdpagecontent.mobile.mtour-tab-content.mTourPriceCalendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php endif; ?>
      </div>