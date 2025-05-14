          <!--Mobile Tour Tabs-Destination Starts-->
          <div class="mTourPkgDesc">
            <div class="mTourHgLhts">
              <h2>Tour Destination</h2>
              <div>
              <?php
                $destinations=$details->destinations;
                if($destinations!='' && $destinations!='N;') {
                  $city1=unserialize($details->destinations);
                  $city_data=array_unique($city1);
                  }
                else {
                  $city1=unserialize($details->city);
                  $city_data=array_unique($city1);
                  }
              ?>
              @foreach($city_data as $data)
                @if(CustomHelpers::get_destination_data($data,'status')=="1")
                <?php
                  $best_time=CustomHelpers::get_destination_data($data,'best_time_desc');
                  $overview=CustomHelpers::get_destination_data($data,'overview');
                ?>
                <div class="collapsible-container">
                  <div class="collapsible-item mItem-box mItem-arrow"><span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;{{ CustomHelpers::get_master_table_data('city', 'id', (int)$data, 'name') }},&nbsp;{{ CustomHelpers::get_master_table_data('countries', 'id', (int)CustomHelpers::get_destination_data($data,'country'), 'name') }}</div>
                  <!--Collapsible Content-->
                  <div class="collapsible-item-content" id="mob{{ str_slug($data, '-') }}">
                    <div class="collapsible-item-content-cont mDestCont">
                      <div class="collapsible-item-content-box mDestBox">
                      @if($overview!="")
                        <h3>About City</h3>
                        <p>{!! $overview !!}</p>
                      @endif
                      @if($best_time!="")
                        <h3>Best Time To Visit</h3>
                        <p>{!! $best_time !!}</p>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endif
              @endforeach
              </div>
            </div>
          </div>
          <!--Mobile Tour Tabs-Destination Ends-->
          <!--Mobile-Tour-Tab-Collapsible-item-script-pagethree.js-->