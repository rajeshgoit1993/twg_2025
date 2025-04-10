          <!--Mobile Tour Tabs-Inclusions Starts-->
          <div class="mTourPkgDesc">
            @if($details->inclusions!="")
            <div class="mTourInclusions"> 
              <h2>Inclusions</h2>
              <p>{!!$details->inclusions!!}</p>
            </div>
            @endif
            @if($details->exclusions!="")
            <div class="mTourInclusions" id="description">
              <h2>Exclusions</h2>
              <p>{!!$details->exclusions!!}</p>
            </div>
            @endif
          </div>
          <!--Mobile Tour Tabs-Inclusions Ends-->