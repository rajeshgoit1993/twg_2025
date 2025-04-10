              <!--Mobile Tour Tabs-Activity Starts-->
              <div class="mTourPkgDesc">
                <div class="mTourHgLhts">
                  <h2>Tour Activity</h2>
                  <div>
                    <?php $tourdata=unserialize($details->tours); ?>
                    @if(empty($tourdata))
                    @else
                    @foreach (unserialize($details->tours) as $t)
                    @php $tour = CustomHelpers::get_tour_data($t) @endphp
                    <div class="mTourActCont">
                      <div class="mTourActImgBox">
                        @if($tour->tour_image=="")
                          @php
                            $image="default_profile_image.png";
                          @endphp
                        @else
                          @php
                            $image=$tour->tour_image;
                          @endphp
                        @endif
                        <img src="{{URL::to('/').'/public/uploads/tour_image/'.$image}}" >
                      </div>
                      <div class="mTourActDesc">
                        <h4>{{$tour->activity}}</h4>
                        <p>{{$tour->desc}}</p>
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
              </div>
              <!--Mobile Tour Tabs-Activity Ends-->