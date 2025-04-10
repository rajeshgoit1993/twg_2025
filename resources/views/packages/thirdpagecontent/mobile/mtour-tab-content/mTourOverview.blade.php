              <!--Mobile Tour Tabs-Overview Starts-->
              <div class="mTourPkgDesc">
                @if($details->description!="")
                <div class="mTourDesc">
                  <h2>Description</h2>
                  <p>{!!$details->description!!}</p>
                </div>
                @endif
                @if($details->description!="" && $details->highlights!="")
                @endif
                @if($details->highlights!="")
                <div class="mTourHgLhts mHgLhtsSeparator">
                  <h2>Tour Highlights</h2>
                  <p>{!! $details->highlights !!}</p>
                </div>
                @endif
              </div>
              <!--Mobile Tour Tabs-Overview Ends-->