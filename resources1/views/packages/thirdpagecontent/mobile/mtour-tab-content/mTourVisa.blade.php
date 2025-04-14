          <!--Mobile Tour Tabs-Visa Ends-->
          <div class="mTourPkgDesc">
            <!--Visa Policies-->
            @if($details->visa=="1")
            <div class="mTourHgLhts visa-separator mVisaBox">
              <h2>Visa Policies</h2>
              @if(empty($details->visa_p) || $details->visa_p=="N;")
              @else
              <?php $v_policy=unserialize($details->visa_p); ?>
              @foreach($v_policy as $v)
              {!!CustomHelpers::get_visa_policy($v)!!}
              </br>
              @endforeach
              @endif
              {{$details->visa_policies}}
            </div>
            <!--<div class="custom_padding"></div>-->
            @endif
          </div>
          <!--Mobile Tour Tabs-Visa Ends-->