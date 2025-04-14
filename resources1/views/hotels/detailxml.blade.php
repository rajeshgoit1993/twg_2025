@extends('layouts.front.master')
@section('content')

 <div class="page-title-container">
         <div class="container">
            <div class="page-title pull-left">
               <h2 class="entry-title">{{$xmlHubHotels['Hotels']['Hotel']['Name']}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
               <li><a href="#">HOME</a></li>
               <li class="active">Hotel Detailed</li>
            </ul>
         </div>
      </div>
      <section id="content">
         {{dump($xmlHubHotels)}}
         <div class="container">
            <div class="row">
               <div id="main" class="col-md-9">
                  <div class="tab-container style1" id="hotel-main-content">
                     <ul class="tabs">
                        <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
                        <li><a data-toggle="tab" href="#map-tab">map</a></li>
                       
                        <li class="pull-right"><a class="button btn-small yellow-bg white-color" href="#">TRAVEL GUIDE</a></li>
                     </ul>
                     <div class="tab-content">
                        <div id="photos-tab" class="tab-pane fade in active">
                           <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                              <ul class="slides">
                                 @if($xmlHubHotels['Hotels']['Hotel']['ThumbImages'] != null)
                                 
                                 <li><img src="{{$xmlHubHotels['Hotels']['Hotel']['ThumbImages']}}" alt="" /></li>
                                
                                 @endif
                              </ul>
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
                              <h2>About </h2>
                              <p>
                               @php echo $overview->Desc @endphp
                             
                              </p>
                           </div>
                        </div>
                        <div class="tab-pane fade in active" id="hotel-availability">
                           
                           <h2>Available Rooms</h2>
                           <div class="room-list listing-style3 hotel">
                           {{dump($xmlHubHotels['Hotels']['Hotel']['RoomDetails'])}}
                        
                            @foreach($xmlHubHotels['Hotels']['Hotel']['RoomDetails']['RoomDetail'] as $rooms)
                             @if($rooms != null)
                              <article class="box">
                                 <!-- <figure class="col-sm-4 col-md-3">
                                    <a class="hover-effect popup-gallery" href="ajax/slideshow-popup.html" title=""><img width="230" height="160" src="img/Family_Room.jpg" alt=""></a>
                                 </figure> -->
                                 <div class="details col-xs-12 col-sm-12 col-md-12">
                                    <div>
                                       <div>
                                          <div class="box-title">
                                             <h4 class="title">{{$rooms['Type']}}</h4>
                                             <dl class="description">
                                                <dt>Description:</dt>
                                                <dd>{{$rooms['RoomDescription']}}</dd>
                                             </dl>
                                             <dl class="description">
                                                <dt>Meal Basis:</dt>
                                                <dd>{{$rooms['BoardBasis']}}</dd>
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
                                          <span class="price">&#x20b9;{{round($rooms['TotalRate'],2)}}</span>
                                        

                                        @if(Sentinel::check())
                                        <form action="{{URL::to('/pre-booking')}}" method="POST"> 
                                            {{csrf_field()}}
                                            <input type="hidden" name="pre_request" value="{{serialize($xmlHubHotels)}}"/>
                                            <input type="hidden" name="room_detail" value="{{serialize($rooms)}}"/>

                                            <button  class="button btn-small full-width text-center checkAvailableRoom">Pre Booking</button>
                                        </form>
                                        @else
                                        <a href="#travelo-login" class="soap-popupbox button yellow full-width uppercase btn-small" disabled>Reserve</a>
                                        @endif
                                        
                                       


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
                          
                           <p>
                            {{$aminities->RoomAmenities}}
                           </p>
                           <!--<ul class="amenities clearfix style1">
                         
                               <li class="col-md-4 col-sm-6">
                                 <div class="icon-box style1"><i class="soap-icon-check-1"></i></div>
                              </li>
                       
                              
                           
                            
                            
                           </ul>-->
                         
                        </div>
                       
                     </div>
                  </div>
               </div>
               <div class="sidebar col-md-3">
                  <article class="detailed-logo">
                     <figure>
                        <img width="114" height="85" src="{{$xmlHubHotels['Hotels']['Hotel']['ThumbImages']}}" alt="">
                     </figure>
                     <div class="details">
                        <h2 class="box-title">{{$xmlHubHotels['Hotels']['Hotel']['Name']}}<small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space">{{$overview->City}},{{$overview->CountryCode}} </span></small></h2>
                      
                        <div class="feedback clearfix">
                        @if($xmlHubHotels['Hotels']['Hotel']['Rating'] == 5)
                          <div title="5 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 100%;"></span></div>
                           
                        @elseif($xmlHubHotels['Hotels']['Hotel']['Rating'] == 4)
                          <div title="5 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 80%;"></span></div>
                         
                        @elseif($xmlHubHotels['Hotels']['Hotel']['Rating'] == 3)
                          <div title="5 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 60%;"></span></div>
                         
                        @elseif($xmlHubHotels['Hotels']['Hotel']['Rating'] == 2)
                          <div title="5 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 40%;"></span></div>
                         
                        @endif

                           <span class="review pull-right">270 reviews</span>
                        </div>
                        <p class="description">@php echo ' ' @endphp</p>
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
                  
                  
               </div>
            </div>
         </div>
      </section>
@endsection