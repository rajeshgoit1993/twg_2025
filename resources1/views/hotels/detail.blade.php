@extends('layouts.front.master')
@section('content')

 <div class="page-title-container">
         <div class="container">
            <div class="page-title pull-left">
               <h2 class="entry-title">{{$HotelDetail->HOTEL_NAME_FIELD}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
               <li><a href="#">HOME</a></li>
               <li class="active">Hotel Detailed</li>
            </ul>
         </div>
      </div>
      <section id="content">
         {{dump($HotelDetail)}}
         <div class="container">
            <div class="row">
               <div id="main" class="col-md-9">
                  <div class="tab-container style1" id="hotel-main-content">
                     <ul class="tabs">
                        <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
                        <li><a data-toggle="tab" href="#map-tab">map</a></li>
                        <li><a data-toggle="tab" href="#calendar-tab">calendar</a></li>
                        <li class="pull-right"><a class="button btn-small yellow-bg white-color" href="#">TRAVEL GUIDE</a></li>
                     </ul>
                     <div class="tab-content">
                        <div id="photos-tab" class="tab-pane fade in active">
                           <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                              <ul class="slides">
                                 @if($HotelDetail->HOTEL_IMAGES_TABLE != null)
                                  @foreach($HotelDetail->HOTEL_IMAGES_TABLE as $image)
                                 <li><img src="{{$image->IMAGE_PATH_FIELD}}" alt="" /></li>
                                 @endforeach
                                 @endif
                              </ul>
                           </div>
                           <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                              <ul class="slides">

                                 @if($HotelDetail->HOTEL_IMAGES_TABLE != null)
                                  @foreach($HotelDetail->HOTEL_IMAGES_TABLE as $image)
                                 <li><img src="{{$image->IMAGE_PATH_FIELD}}" alt="" /></li>
                                 @endforeach
                                 @endif
                                
                             </ul>
                           </div>
                        </div>
                        <div id="map-tab" class="tab-pane fade">
                           {{trim($HotelDetail->HOTEL_LATTITUDE_FIELD)}},{{trim($HotelDetail->HOTEL_LONGITUDE_FIELD)}}
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.205531724577!2d77.35164931465387!3d28.653563982409516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfac0abc518bb%3A0x1702ec46d823bbe4!2sRapidex+Travels!5e0!3m2!1sen!2sin!4v1507898156419" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <div id="calendar-tab" class="tab-pane fade">
                           <label>SELECT MONTH</label>
                           <div class="col-sm-6 col-md-4 no-float no-padding">
                              <div class="selector">
                                 <select class="full-width" id="select-month">
                                    <option value="2014-6">June 2014</option>
                                    <option value="2014-7">July 2014</option>
                                    <option value="2014-8">August 2014</option>
                                    <option value="2014-9">September 2014</option>
                                    <option value="2014-10">October 2014</option>
                                    <option value="2014-11">November 2014</option>
                                    <option value="2014-12">December 2014</option>
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-8">
                                 <div class="calendar"></div>
                                 <div class="calendar-legend">
                                    <label class="available">available</label>
                                    <label class="unavailable">unavailable</label>
                                    <label class="past">past</label>
                                 </div>
                              </div>
                              <div class="col-sm-4">
                                 <p class="description">
                                    The calendar is updated every five minutes and is only an approximation of availability.
                                    <br /><br />
                                    Some hosts set custom pricing for certain days on their calendar, like weekends or holidays. The rates listed are per day and do not include any cleaning fee or rates for extra people the host may have for this listing. Please refer to the listing's Description tab for more details.
                                    <br /><br />
                                    We suggest that you contact the host to confirm availability and rates before submitting a reservation request.
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="hotel-features" class="tab-container">
                     <ul class="tabs">
                        <li><a href="#hotel-description" data-toggle="tab">Description</a></li>
                        <li class="active"><a href="#hotel-availability" data-toggle="tab">Availability</a></li>
                        <li><a href="#hotel-amenities" data-toggle="tab">Amenities</a></li>
                       
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane fade" id="hotel-description">
                           
                           <div class="long-description">
                              <h2>About {{$HotelDetail->HOTEL_NAME_FIELD}}</h2>
                              <p>
                                
                              @php echo $HotelDetail->HOTEL_DESCRIPTION_FIELD @endphp
                              </p>
                           </div>
                        </div>
                        <div class="tab-pane fade in active" id="hotel-availability">
                           
                           <h2>Available Rooms</h2>
                           <div class="room-list listing-style3 hotel">
                           {{dump($Rooms)}}
                           {{dump($hotelrequest)}}
                             @foreach($Rooms as $rooms)
                             @if($rooms != null)
                              <article class="box">
                                 <!-- <figure class="col-sm-4 col-md-3">
                                    <a class="hover-effect popup-gallery" href="ajax/slideshow-popup.html" title=""><img width="230" height="160" src="img/Family_Room.jpg" alt=""></a>
                                 </figure> -->
                                 <div class="details col-xs-12 col-sm-12 col-md-12">
                                    <div>
                                       <div>
                                          <div class="box-title">
                                             <h4 class="title">{{$rooms->ROOM_CATEGORY_FIELD}}</h4>
                                             <dl class="description">
                                                <dt>Category:</dt>
                                                <dd>{{$rooms->ROOM_CATEGORY_FIELD}}</dd>
                                             </dl>
                                             <dl class="description">
                                                <dt>Meal Basis:</dt>
                                                <dd>{{$rooms->ROOM_MEAL_BASIS_NAME_FIELD}}</dd>
                                             </dl>
                                             
                                          </div>
                                          <!-- <div class="amenities">
                                             <i class="soap-icon-wifi circle"></i>
                                             <i class="soap-icon-fitnessfacility circle"></i>
                                             <i class="soap-icon-fork circle"></i>
                                             <i class="soap-icon-television circle"></i>
                                          </div> -->
                                       </div>
                                       <div class="price-section">
                                          <span class="price">&#x20b9; {{ $rooms->ROOM_PRICE_FIELD}}</span>
                                         
                                        
                                         <form class="checkAvailableRoomData">
                                         {{csrf_field()}}
                                          <input type="hidden" name="HOTEL_ID_FIELD" value="{{$HotelDetail->HOTEL_ID_FIELD}}"/>
                                          <input type="hidden" name="HOTEL_COUNTRY_CODE_FIELD" value="{{$hotelrequest['HOTEL_COUNTRY_CODE_FIELD']}}"/>
                                          <input type="hidden" name="HOTEL_CITY_CODE_FIELD" value="{{$hotelrequest['HOTEL_CITY_CODE_FIELD']}}"/>
                                          <input type="hidden" name="HOTEL_CHECK_IN_DATE_FIELD" value="{{$hotelrequest['HOTEL_CHECK_IN_DATE_FIELD']}}"/>
                                          <input type="hidden" name="HOTEL_CHECK_OUT_DATE_FIELD" value="{{$hotelrequest['HOTEL_CHECK_OUT_DATE_FIELD']}}"/>
                                          <input type="hidden" name="HOTEL_NAME_FIELD" value="{{$HotelDetail->HOTEL_NAME_FIELD}}"/>
                                          
                                          <input type="hidden" name="HOTEL_PRIMARY_CURRENCY_FIELD" value="{{$hotelrequest['HOTEL_PRIMARY_CURRENCY_FIELD']}}"/>

                                          <input type="hidden" name="FLD_NATIONALITY_FIELD" value="{{$hotelrequest['FLD_NATIONALITY_FIELD']}}"/>
                                          <input type="hidden" name="Fld_USERID_FIELD" value="{{$hotelrequest['Fld_USERID_FIELD']}}"/>
                                          <input type="hidden" name="ROOM_TOKEN_FIELD" value="{{$rooms->ROOM_TOKEN_FIELD}}"/>
                                          <input type="hidden" name="NO_OF_ADULT_FIELD" value="{{$hotelrequest['NO_OF_ADULT_FIELD']}}"/>
                                          </form>
                                         
                                         <button  class="button btn-small full-width text-center checkAvailableRoom">Check Availability</button>
                                       </div>
                                    </div>
                                    <div>
                                      
                                    </div>
                                 </div>
                              </article>
                              @endif
                              @endforeach
                             
                              </div>
                        </div>
                        <div class="tab-pane fade" id="hotel-amenities">
                           <h2>Amenities</h2>
                           <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                           <ul class="amenities clearfix style1">
                           @forelse($HotelDetail->HOTEL_AMENITIES_TABLE as $amenities)
                               <li class="col-md-4 col-sm-6">
                                 <div class="icon-box style1"><i class="soap-icon-check-1"></i>{{$amenities->AMINITY_NAME_FIELD}}</div>
                              </li>
                            @empty
                               No Amenities
                            @endforelse
                            
                            
                           </ul>
                         
                        </div>
                       
                     </div>
                  </div>
               </div>
               <div class="sidebar col-md-3">
                  <article class="detailed-logo">
                     <figure>
                        <img width="114" height="85" src="{{$HotelDetail->HOTEL_THUMB_IMAGE_FIELD}}" alt="">
                     </figure>
                     <div class="details">
                        <h2 class="box-title">{{$HotelDetail->HOTEL_NAME_FIELD}}<small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space">{{$HotelDetail->HOTEL_LOCATION_NAME_FIELD}}, {{$HotelDetail->HOTEL_CITY_NAME_FIELD}} </span></small></h2>
                      
                        <div class="feedback clearfix">
                        @if($HotelDetail->HOTEL_STAR_FIELD == 5)
                          <div title="5 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 100%;"></span></div>
                           
                        @elseif($HotelDetail->HOTEL_STAR_FIELD == 4)
                          <div title="5 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 80%;"></span></div>
                         
                        @elseif($HotelDetail->HOTEL_STAR_FIELD == 3)
                          <div title="5 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 60%;"></span></div>
                         
                        @elseif($HotelDetail->HOTEL_STAR_FIELD == 2)
                          <div title="5 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 40%;"></span></div>
                         
                        @endif

                           <span class="review pull-right">270 reviews</span>
                        </div>
                        <p class="description">@php echo $HotelDetail->HOTEL_ADDRESS_FIELD @endphp</p>
                          </div>
                  </article>
                  <div class="travelo-box contact-box">
                     <h4>Need Travelo Help?</h4>
                     <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                     <address class="contact-details">
                        <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                        <br>
                        <a class="contact-email" href="#">help@travelo.com</a>
                     </address>
                  </div>
                  <div class="travelo-box">
                     <h4>Similar Listings</h4>
                     <div class="image-box style14">
                        <article class="box">
                           <figure>
                              <a href="#"><img src="img/park_central.jpg" alt="" /></a>
                           </figure>
                           <div class="details">
                              <h5 class="box-title"><a href="#">Plaza Tour Eiffel</a></h5>
                              <label class="price-wrapper">
                              <span class="price-per-unit">$170</span>avg/night
                              </label>
                           </div>
                        </article>
                        <article class="box">
                           <figure>
                              <a href="#"><img src="img/sultan_gardens.jpg" alt="" /></a>
                           </figure>
                           <div class="details">
                              <h5 class="box-title"><a href="#">Sultan Gardens</a></h5>
                              <label class="price-wrapper">
                              <span class="price-per-unit">$620</span>avg/night
                              </label>
                           </div>
                        </article>
                        <article class="box">
                           <figure>
                              <a href="#"><img src="img/plaza_tour_eiffel.jpg" alt="" /></a>
                           </figure>
                           <div class="details">
                              <h5 class="box-title"><a href="#">Park Central</a></h5>
                              <label class="price-wrapper">
                              <span class="price-per-unit">$322</span>avg/night
                              </label>
                           </div>
                        </article>
                     </div>
                  </div>
                  <div class="travelo-box book-with-us-box">
                     <h4>Why Book with us?</h4>
                     <ul>
                        <li>
                           <i class="soap-icon-hotel-1 circle"></i>
                           <h5 class="title"><a href="#">135,00+ Hotels</a></h5>
                           <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                        <li>
                           <i class="soap-icon-savings circle"></i>
                           <h5 class="title"><a href="#">Low Rates &amp; Savings</a></h5>
                           <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                        <li>
                           <i class="soap-icon-support circle"></i>
                           <h5 class="title"><a href="#">Excellent Support</a></h5>
                           <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection