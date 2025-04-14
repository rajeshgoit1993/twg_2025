          <!--Mobile Tour Tabs-Policy Starts-->
          <div class="mTourPkgDesc">
            <!--Booking Policies-->
            @if(empty($details->payment_p) || $details->payment_p=="N;")
            @else
            <div class="mTourPolicy">
              <h2>Booking Policies</h2>
              <?php $p_policy=unserialize($details->payment_p); ?>
              @foreach($p_policy as $v)
              {!!CustomHelpers::get_payment_policy($v)!!}</br>
              @endforeach
              {{$details->payment_policy}}
            </div>
            @endif
            <!--Cancellation Policies-->
            @if(empty($details->can_p) || $details->can_p=="N;")
            @else
            <div class="mTourPolicy">
              <h2>Cancellation Policies</h2>
              <?php $c_policy=unserialize($details->can_p); ?>
              @foreach($c_policy as $v)
              {!!CustomHelpers::get_cancel_policy($v)!!}</br>
              @endforeach
              {{$details->cancel_policy}}
            </div>
            @endif
            <!--Important Notes-->
            @if((empty($details->can_p) || $details->can_p=="N;") || (empty($details->imp_notes) || $details->imp_notes=="N;"))
            @else
            @endif
            @if(empty($details->imp_notes) || $details->imp_notes=="N;")
            @else
            <div class="mTourPolicy">
              <h2>Important Notes</h2>
              <?php $important_notes=unserialize($details->imp_notes); ?>
              @foreach($important_notes as $v)
              {!!CustomHelpers::get_impnotes($v)!!}</br>
              @endforeach
              {{$details->extra_notes}}
            </div>
            @endif
          </div>
          <!--Mobile Tour Tabs-Policy Ends-->