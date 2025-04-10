          <!--Mobile Tour Tabs-Similar Tour Starts-->
          <div class="mTourPkgDesc">
            <div class="mTourHgLhts">
              <h2>Similar Tour Packages</h2>
              <div>
              @if($details->similar_packages!='' && $details->similar_packages!='N;')
              <?php 
                $similar_packages=unserialize($details->similar_packages);
                $packages=DB::table('rt_packages')->whereIn('id',$similar_packages)->get();
              ?>
              @foreach($packages as $package)
              <input type="hidden" class="pack_id_list" name="pack_id_list[]" value="{{$package->id}}">
              <?php
                $country=unserialize($package->country);
                $city=unserialize($package->city);
                $continent=unserialize($package->continent);
                $state=unserialize($package->state);
              ?>
              <!--Mobile View-->
              <div class="makeflex mobscroll scrollX">
                <div class="mSimilarTourCont">
                  <a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}" class="pkg_search">
                    <div class="mSimilarItemCont">
                      <div class="mSimilarItemImgBox">
                        <?php $gallery_id=CustomHelpers::get_first_galleryid($package->id); ?>
                        @if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0")
                          <img src="{{CustomHelpers::get_image_gallery($gallery_id,'thum_medium')}}" alt="tour-image">
                        @elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0")
                          <img src="{{URL::to('/').'/public/Uploads/default_profile_image.png'}}" alt="no-mage">
                        @endif
                      </div>
                      <div class="mSimilarItemDesc">
                        <div class="mSimilarItemDaysBadge">{{ $package->duration }}N / {{ $package->duration + 1 }}D</div>
                        <div class="mSimilarItemDescHeadSection">
                          <div class="mSimilarItemDescHeadingBox">
                            <h3 class="mSimilarItemDescHeading">{{ $package->title }}</h3>
                          </div>
                        </div>
                        <div class="mSimilarItemDuration">
                          <?php
                            $city1=unserialize($package->city);
                            $days=unserialize($package->days);
                            $city1_count=count($city1);
                            $i=0;
                            foreach($city1 as $row=>$col) {
                              echo "<span class='mitemDestDuration'>$days[$row]N&nbsp;</span><span class='mitemDestName'>$city1[$row]</span>";
                                if($i<($city1_count-1)):
                                  echo "<span class='mitemDestSepr'>&nbsp;&rarr;&nbsp;</span>";
                                endif;
                                $a=$i+1;
                                if($a%3=="0"):
                                  echo "</span>";
                                endif;
                                $i++;
                              }
                            ?>
                        </div>
                        <!--Services included starts-->
                        <div class="mSimilarItemFooter">
                          <div class="mSimilarItemFooterServiceIconsCont">
                            <div class="mitemServiceTitle">Included in this package</div>
                            <div id="mobscroll" class="mitemServicIconScroll mobscroll">
                              @php
                                $package_service=unserialize($package->package_service);
                              @endphp
                              @if(empty($package_service))
                              @else
                                <?php $count_package_service=count($package_service); ?>
                                <?php
                                  $ico="";
                                  foreach ($icon_data as $icon_data1) {
                                    $ico.=$icon_data1->icon_title.",";
                                    }
                                  $ico1=array_unique(explode(",",$ico));
                                ?>       
                                  @for($i=0;$i<$count_package_service;$i++) 
                                    @if(in_array($package_service[$i], $ico1))
                                    <div class="mitemSvcCont">
                                      <div class="mitemSvcIconBox">
                                        <img src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon')) }}" title="{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}" alt="Tour Icon">
                                      </div>
                                      <div class="mitemSvcIconName">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</div>
                                    </div>
                                    @else
                                    @endif
                                  @endfor
                              @endif
                              @php
                                $customer_rating=$package->customer_rating;
                              @endphp
                            </div>
                          </div>
                          <!--<div class="mBtnCont">
                            <button type="button" class="btnMain btnViewDtls_mobile">View Details</button>
                          </div>-->
                          <!-- Price starts -->
                          <div class="mSimilarItemDescPriceSection">
                            @if($package->onrequest == 1 && $package->upcoming == 1)
                              <span class="priceRequest"><span class="defaultCurrency mTourSimilarCurrency">&nbsp;</span>On Request</span>
                            @elseif($package->onrequest != 1 && $package->upcoming == 1)
                              @if(CustomHelpers::get_price($package->id)=="On Request")
                                <span class="priceRequest"><span class="defaultCurrency mTourSimilarCurrency">&nbsp;</span>On Request</span>
                              @else
                                <span class="priceValue"><span class="defaultCurrency mTourSimilarCurrency">&nbsp;</span>{{CustomHelpers::get_price($package->id) }}</span>
                                <span class="priceType">{{ $package->Price_type }}</span>
                              @endif
                            @elseif($package->onrequest == 1 && $package->upcoming != 1)
                              @if(CustomHelpers::get_up_price($package->id)=="On Request")
                                <span class="priceRequest"><span class="defaultCurrency mTourSimilarCurrency">&nbsp;</span>On Request</span>
                              @else
                                <span class="priceValue"><span class="defaultCurrency mTourSimilarCurrency">&nbsp;</span>{{ CustomHelpers::get_up_price($package->id) }}</span>
                                <span class="priceType">{{ $package->upcoming_type }}</span>
                              @endif
                            @endif
                          </div>
                          <!-- Price ends -->
                        </div>
                        <!--Services included ends-->             
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              @endforeach
              @endif
              </div>
            </div>
          </div>
          <!--Mobile Tour Tabs-Similar Tour Ends-->