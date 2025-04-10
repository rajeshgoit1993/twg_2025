@extends('layouts.front.master')
@section('content')
<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">{{$HotelDetail->name}}</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">{{CustomHelpers::getContById($HotelDetail->continent,'regions','continent_name') }}</a></li>
                    <li><a href="#">{{CustomHelpers::getTableRecordById($HotelDetail->country,'regions','country') }}</a></li>
                    <li><a href="#">{{CustomHelpers::getTableRecordById($HotelDetail->state,'subregions','name') }}</a></li>
                    <li class="active">{{$HotelDetail->city}}</li>
                </ul>
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-md-9">
                {{--  {{dump($HotelDetail)}}  --}}
                   {{--  {{dump($Rooms)}}  --}}
                    {{--  {{dump($Pricing)}}  --}}
                    {{-- {{dump($images)}} --}}
                        <div class="tab-container style1" id="hotel-main-content">
                            <ul class="tabs">
                                <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
                                <li style="float:right;"><a data-toggle="tab" href="#map-tab">map</a></li>
                                <!-- <li><a data-toggle="tab" href="#calendar-tab">calendar</a></li> -->
                                <!-- <li class="pull-right"><a class="button btn-small yellow-bg white-color" href="#">TRAVEL GUIDE</a></li> -->
                            </ul>
                            <div class="tab-content">
                                <div id="photos-tab" class="tab-pane fade in active">
                                    <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                                        <ul class="slides">
                                        @foreach($images as $key=>$image) 
                                            <li><img src="{{URL::to('/').'/public/'.$image->image_path}}" alt="" /></li>
                                        @endforeach   
                                        </ul>
                                    </div>
                                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                                        <ul class="slides">
                                        @foreach($images as $key=>$image) 
                                            <li><img src="{{URL::to('/').'/public/'.$image->image_path}}" alt="" /></li>
                                        @endforeach    
                                        </ul>
                                    </div>
                                </div>
                                <div id="map-tab" class="tab-pane fade">
                                    <input type="hidden" class="form-control" id="lat" value="{{$HotelDetail->map_lat}}">
                                    <input type="hidden" class="form-control" id="lng" value="{{$HotelDetail->map_long}}">
                                    <input type="hidden" class="form-control" id="map_address" value="{{$HotelDetail->map_address}}">
                                    <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="sidebar col-md-3">
                        <article class="detailed-logo">
                            <figure>
                                <img width="114" height="85" src="{{ url('/public'.CustomHelpers::get_first_image($HotelDetail->id,'rt_hotel_uploads','image_path','hotel_id')) }}" alt="">
                            </figure>
                            <div class="details">
                                <h2 class="box-title">{{$HotelDetail->name}}
                                    <small><i class="soap-icon-departure yellow-color"></i>
                                        <span class="fourty-space">
                                                {{$HotelDetail->city}}, {{CustomHelpers::getTableRecordById($HotelDetail->state,'subregions','name') }}
                                        </span>
                                    </small>
                                </h2>
                                <span class="price clearfix">
                                    <small class="pull-left">avg/night</small>
                                    @php
                                    $roomsAval = CustomHelpers::countRows($HotelDetail->id,'rt_rooms','id','assignedHotelname');

                                    if($roomsAval > 0){
                                    @endphp
                                    <span class="pull-right">{{ CustomHelpers::getRoomPriceByHotel($HotelDetail->id) }}</span>
                                    
                                    @php
                                    }else{
                                    @endphp
                                    <span class="pull-right">Sold Out</span>
                                    @php
                                    }
                                    @endphp
                                    
                                </span>
                                <div class="feedback clearfix">
                                    <div class="five-stars-container">
                                        @php
                                        $perStar = 20 * $HotelDetail->stars;
                                        @endphp
                                    <span class="five-stars" style="width: {{$perStar}}%;"></span>
                                </div>
                                </div>
                                <p class="description">
                                        {{substr($HotelDetail->description,0, 150 )}}...
                                </p>
                                {{--  <a class="button yellow full-width uppercase btn-small">add to wishlist</a>  --}}

                                    <div class="features">
                                        <ul>
                                            <li><label>Country:</label>{{CustomHelpers::getTableRecordById($HotelDetail->country,'regions','country') }}.</li>
                                            <li><label>State:</label>{{CustomHelpers::getTableRecordById($HotelDetail->state,'subregions','name') }}.</li>
                                            <li><label>City:</label>{{$HotelDetail->city}}.</li>
                                            <li><label>Address:</label>{{$HotelDetail->map_address}}.</li>  
                                        </ul>
                                    </div>

                            </div>
                        </article>
                        
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="">
                        <div id="hotel-features" class="tab-container">
                                <ul class="tabs">
                                    <li><a href="#hotel-description" data-toggle="tab">Description</a></li>
                                    <li class="active"><a href="#hotel-availability" data-toggle="tab">Room Availability</a></li>
                                    <li><a href="#hotel-amenities" data-toggle="tab">Amenities</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="hotel-description">
                                        <div class="intro table-wrapper full-width hidden-table-sms">
                                            <div class="col-sm-12 col-lg-12 features">
                                                <ul>
                                                    <li><label>Check In Time :</label>{{$HotelDetail->check_in}}</li>
                                                    <li><label>Check Out Time :</label>{{$HotelDetail->check_out}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="long-description">
                                            <h2>About {{$HotelDetail->name}}</h2>
                                            <p>{{htmlentities($HotelDetail->description)}}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade in active" id="hotel-availability">
                                    <div class="alert alert-danger feedbckerror" style="display:none;">
                                            <strong>Alert!</strong>&nbsp;Please Fill Below Form before filter Rooms.
                                    </div>
              
                                      <form id="roomFilter" action="#">
                                            {{csrf_field()}}
                                        <div class="update-search clearfix">
                                            <div class="col-md-5">
                                                <h4 class="title">When</h4>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label>CHECK IN</label>
                                                        <div class="datepicker-wrap">
                                                                <input type="text" name="date_from" placeholder="mm/dd/yy" class="input-text full-width date_from" value="{{date('m/d/Y H:i:s')}}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label>CHECK OUT</label>
                                                        <div class="datepicker-wrap">
                                                                <input type="text" name="date_to" placeholder="mm/dd/yy" class="input-text full-width date_to" value="{{date('m/d/Y H:i:s', strtotime(' +1 day'))}}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <h4 class="title">Who</h4>
                                                <div class="row">
                                                    
                                                    
                                                    <div class="col-xs-4">
                                                        <label>ROOMS</label>
                                                        <div class="selector">
                                                            <select class="full-width" name="noOfRooms" required>
                                                                <option value="1">01</option>
                                                                <option value="2">02</option>
                                                                <option value="3">03</option>
                                                                <option value="4">04</option>
                                                                <option value="5">05</option>
                                                                <option value="6">06</option>
                                                                <option value="7">07</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <label>ADULTS</label>
                                                        <div class="selector">
                                                            <select class="full-width" name="noOfAdults" required>
                                                                <option value="1">01</option>
                                                                <option value="2" selected>02</option>
                                                                <option value="3">03</option>
                                                                <option value="4">04</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <label>KIDS</label>
                                                        <div class="selector">
                                                            <select class="full-width" name="noOfKids" required>
                                                                <option value="0">0</option>
                                                                <option value="1">01</option>
                                                                <option value="2">02</option>
                                                                <option value="3">03</option>
                                                                <option value="4">04</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <h4 class="visible-md visible-lg">&nbsp;</h4>
                                                <label class="visible-md visible-lg">&nbsp;</label>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <input type="hidden" name="hotelId" value="{{$HotelDetail->id}}" />
                                                        <button data-animation-duration="1" data-animation-type="bounce" id="filterRooms" class="full-width icon-check animated sbmtFeedbck" type="submit">SEARCH NOW</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                        <h2>Rooms</h2><hr>
                                        {{--  {{dump($Rooms)}}  --}}
                                        <div class="room-list listing-style3 hotel" id="ajaxRooms" >
                                            <div style="text-align:center;">
                                                <img src="http://blog.teamtreehouse.com/wp-content/uploads/2015/05/InternetSlowdown_Day.gif">
                                            </div>
                                            
                                            
                                            {{--  {{ App::VERSION() }}  --}}
                                            @foreach($Rooms as $key=>$Room) 
                                            @php 
                                            /*
                                            <article class="box">
                                                    <div class="row">
                                                       <div class="col-md-12 room_name">
                                                           <h2>{{$Room->roomTypeName}} 
                                                                <small>
                                                                    ({{( CustomHelpers::getTableRecordById($Room->roomView,'rt_room_view','name') )}})
                                                                </small>
                                                            </h2>

                                                    </div>
                                                        <figure class="col-sm-2 col-md-2">
                                                           
                                                            <img style="height:120px;" src="{{ url('/public'.CustomHelpers::get_first_image($Room->id,'rt_room_uploads','image_path','room_id')) }}" alt="">
                                                            <div class="row">
                                                               <div class="col-md-12 col-sm-12 line_height">
                                                                   <div class="sq">
                                                                    <b><i class="fa fa-check-circle"></i> Room Size: </b>{{$Room->roomSize}} Sqft
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-12 col-sm-12 line_height">
                                                                   <div class="sq">
                                                                    <b><i class="fa fa-bed"></i> Bed Type: </b>{{$Room->bedType}}
                                                                   </div>
                                                               </div>
                                                            </div>
                                                       </figure>
                                               
                                                        <figure class="col-sm-10 col-md-10">
                                                           <div class="row mar0">
                                                               <div class="col-sm-7">
                                                                   <h3>What’s Included</h3>
                                                               </div>
                                                               <div class="col-sm-1">
                                                                   <div class="Capacity">                        
                                                                   <h3>Capacity</h3>
                                                                   </div>
                                                               </div>
                                                               <div class="col-sm-2">
                                                                   <div class="Price_per">
                                                                       <h3>Price Per Night</h3>
                                                                   </div>
                                                               </div>
                                                               <div class="col-sm-2">
                                                                   <h3>&nbsp;</h3>
                                                               </div>
                                                           </div>
                                               
                                                           <div class="row border_oll">
                                                               <div class="col-sm-7 border-right">
                                                                   <div class="row">
                                                                            @foreach($RoomAmeniies as $key=>$r_amenities) 
                                                                            @php  if(in_array($r_amenities->id,unserialize($Room->amenities))){ @endphp
                                                                               
                                                                                <div class="col-sm-6 line_height"><span><i class="fa {{ CustomHelpers::getTableRecordById($r_amenities->id,'rt_rooms_amenities','icon') }}"></i></span>{{$r_amenities->name}}</div>
                                                                            @php } @endphp
                                                                            @endforeach 
                                                                        <div class="clearfix"></div>
                                                                       <div class="col-sm-6 line_height"><b><span><i class="fa fa-bed"></i></span>Meal Plan: </b>{{$Room->mealPlan}} </div>
                                                                       <div class="col-sm-6 line_height"><b><span><i class="fa fa-bed"></i></span>Payment Mode: </b>{{$Room->paymentMode}}</div>
                                                                   </div>
                                                               </div>
                                                               <div class="col-sm-1 border-right">
                                                                   <div class="Capacity">  
                                                                        @php
    
                                                                        $OBA = $Room->roomOccBaseAdult;
                                                                        $OBC = $Room->roomOccBaseChild;
                 
                                                                        $OMA = $Room->roomOccMaxAdult;
                                                                        $OMC = $Room->roomOccMaxChild;
                 
                                                                        $OEI = $Room->roomOccMaxInfrant;
                                                                        $OIG = $Room->roomOccMaxGuest;
                                                                        @endphp
                                                                       <img src="{{ asset("/resources/assets/frontend/") }}/img/adultKids.jpg" style="width: 47px;">

                                                                       <p>{{$OBA}} Adults,<br>{{$OBC}} Kids</p>
                                                                   </div>
                                                               </div>
                                                               <div class="col-sm-2 border-right">
                                                                   <div class="Price_per">
                                                                       <span style="font-size: 15px;">Rs.</span>{{ CustomHelpers::getRoomPrice($Room->id,'rt_room_rates_plans') }}<br><br>
                                                                       <p class=""> {{$Room->paymentType}}</p>
                                                                    </div>
                                                               </div>
                                                               <div class="col-sm-2">
                                                                   <div class="Our_last">
                                                                       <p>Our last {{$Room->noOfRooms}} room!</p>
                                                                       <a class="button yellow full-width uppercase btn-small sbmtFeedbck">Book</a>
                                                                       <a data-toggle="collapse" data-target="#demo_{{$Room->id}}">Cancellation Policies</a>
                    
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div id="demo_{{$Room->id}}" class="collapse" style="background: #2b2828;color: white;padding: 12px;">
                                                            @php
                                                            $policies = unserialize($Room->policy);
                                                            $policiesKeys =  array_keys($policies);
                                                            $totalPolicies = array();
                                                            $allPolicies = array();
                                                            foreach ($policiesKeys as $key => $value) {
                                                                $totalPolicies['policy_percentege'] = $policies[$value]['policy_percentege'];
                                                                $totalPolicies['selectFor'] = $policies[$value]['selectFor'];
                                                                $totalPolicies['cancelledFrom'] = $policies[$value]['cancelledFrom'];
                                                                $totalPolicies['cancelledTo'] = $policies[$value]['cancelledTo'];
                                                                $allPolicies[] = $totalPolicies;
                                                            }
                                                            // echo '<pre>';
                                                            // print_r($allPolicies);
                                                            // echo '</pre>';
                                                            @endphp
                                                                <p>No Refund if cancelled between  {{$Room->free_Cancellation_on}} days prior to Check-in Date.</p><hr>
                                                                @foreach($allPolicies as $key=>$value) 
                                                                    @php

                                                                    $hoursFrom = $value['cancelledFrom'];
                                                                    $hoursTo = $value['cancelledTo'];
                                                                    $hid = 24;
                                                                    $daysFrom = round($hoursFrom/$hid);
                                                                    $daysTo = round($hoursTo/$hid);
                                                                    @endphp
                                                                    @if(($value['selectFor']) == 'Percentage')

                                                                    <p>{{$value['policy_percentege']}}% of Total Amount will deducted between {{$daysTo}} to {{$daysFrom}} days prior to Check-in Date.</p>
                                                                    
                                                                    @else
                                                                        <p>{{$value['policy_percentege']}} days Amount of Total Amount will deducted between {{$daysTo}} to {{$daysFrom}} days prior to Check-in Date.</p>
                                                                    
                                                                    @endif

                                                                @endforeach 
                                                                
                                                            </div>
                                                       </figure>
                                                    </div>                                 
                                               </article>
                                            */
                                            @endphp
                                            @endforeach 
                                            
                                            
                                               {{--  <a href="#" class="load-more button full-width btn-large fourty-space">LOAD MORE ROOMS</a>  --}}
                                        </div>
                                        
                                    </div>
                                    <div class="tab-pane fade" id="hotel-amenities">
                                        <h2>Amenities</h2>
                                        @php
                                        $facilities = CustomHelpers::comma_separated_to_array($HotelDetail->facilities);
                                        @endphp
                                        <ul class="amenities clearfix style1">
                                            
                                            @foreach($facilities as $key=>$facilitie) 
                                            <li class="col-md-4 col-sm-6 ">
                                                <div class="icon-box style1">
                                                <i class="fa {{ CustomHelpers::getTableRecordById($facilitie,'rt_hotel_facilities','icon') }}" aria-hidden="true"></i>
                                                {{ CustomHelpers::getTableRecordById($facilitie,'rt_hotel_facilities','name') }}
                                                
                                                </div>
                                            </li>
                                            @endforeach   
                                            
                                        </ul>
    
                                    </div>
                                    <!-- <div class="tab-pane fade" id="hotel-things-todo">
                                        <h2>Things to Do</h2>
                                        <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                        <div class="activities image-box style2 innerstyle">
                                            <article class="box">
                                                <figure>
                                                    <a title="" href="#"><img width="250" height="161" alt="" src="http://placehold.it/250x160"></a>
                                                </figure>
                                                <div class="details">
                                                    <div class="details-header">
                                                        <div class="review-score">
                                                            <div class="five-stars-container"><div style="width: 60%;" class="five-stars"></div></div>
                                                            <span class="reviews">25 reviews</span>
                                                        </div>
                                                        <h4 class="box-title">Central Park Walking Tour</h4>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat wisi enim don't look even slightly believable.</p>
                                                    <a class="button" title="" href="#">MORE</a>
                                                </div>
                                            </article>
                                            <article class="box">
                                                <figure>
                                                    <a title="" href="#"><img width="250" height="161" alt="" src="http://placehold.it/250x160"></a>
                                                </figure>
                                                <div class="details">
                                                    <div class="details-header">
                                                        <div class="review-score">
                                                            <div class="five-stars-container"><div style="width: 60%;" class="five-stars"></div></div>
                                                            <span class="reviews">25 reviews</span>
                                                        </div>
                                                        <h4 class="box-title">Museum of Modern Art</h4>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat wisi enim don't look even slightly believable.</p>
                                                    <a class="button" title="" href="#">MORE</a>
                                                </div>
                                            </article>
                                            <article class="box">
                                                <figure>
                                                    <a title="" href="#"><img width="250" height="161" alt="" src="http://placehold.it/250x160"></a>
                                                </figure>
                                                <div class="details">
                                                    <div class="details-header">
                                                        <div class="review-score">
                                                            <div class="five-stars-container"><div style="width: 60%;" class="five-stars"></div></div>
                                                            <span class="reviews">25 reviews</span>
                                                        </div>
                                                        <h4 class="box-title">Crazy Horse Cabaret Show</h4>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat wisi enim don't look even slightly believable.</p>
                                                    <a class="button" title="" href="#">MORE</a>
                                                </div>
                                            </article>
                                        </div>
                                    </div> -->
                                </div>
                            
                            </div>
                </div>
            </div>
        </section>
        @endsection