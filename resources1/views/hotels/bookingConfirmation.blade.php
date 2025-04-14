
@extends('layouts.front.master')
@section('content')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Hotel Booking</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Hotel Booking</li>
        </ul>
    </div>
</div>
@php
                                  


//echo $to = \Carbon\Carbon::createFromFormat('Y-m-d', $xmlpreBookingRes['PreBookingRequest']['PreBooking']['DepartureDate']);
//$from = \Carbon\Carbon::createFromFormat('Y-m-d', $xmlpreBookingRes['PreBookingRequest']['PreBooking']['ArrivalDate']);
//$diff_in_days = $to->diffInDays($from);
//print_r($diff_in_days); 
//$AdultPrice = $allBookingDetail->noOfAdults * $allBookingDetail->TotalAmount;
//$KidsPrice = $allBookingDetail->noOfKids * 0;
//$totalPricE = $allBookingDetail->TotalAmount * $diff_in_days * $allBookingDetail->noOfRooms;

// echo "<pre>";
// print_r($returnValue);
// echo "</pre>";
@endphp
<section id="content" class="gray-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sms-6 col-sm-7 col-md-7">
                <div class="booking-section travelo-box">
                     {{dump($xmlpreBookingRes)}}
                     {{dump($hoteldata)}}
                    {{dump($hotelImage)}}
                    
                        <div class="alert small-box" style="display: none;"></div>
                        <div class="person-information">
                            <h2>Guest Information</h2>
                            <form method="post" name="customerData" action="" id="customerData">
                                   
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Name :</label><input type="text" class="input-text full-width" name="billing_name" value="{{Sentinel::getUser()->first_name.' '.Sentinel::getUser()->last_name }}" Required/>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Address  :</label><input type="text" class="input-text full-width" name="billing_address" value="" Required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing City Name :</label><input type="text" class="input-text full-width" name="billing_city" value="" Required/>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing State Name :</label><input type="text" class="input-text full-width" name="billing_state" value="" Required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Zip Code :</label><input type="text" class="input-text full-width" name="billing_zip" value="" Required/>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Country  :</label><input type="text" class="input-text full-width" name="billing_country" value="" Required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Phone No.    :</label><input type="text" class="input-text full-width" name="billing_tel" value="" Required/>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Email Address    :</label><input type="text" class="input-text full-width" name="billing_email" value="{{Sentinel::getUser()->email }}" Required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="hidden" class="input-text full-width" name="tid" id="tid" readonly />
                                        <input type="hidden" class="input-text full-width" name="merchant_id" value="155984"/>
                                        <input type="hidden" class="input-text full-width" name="order_id" value="{{substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 14)}}"/>
                                        <input type="hidden" class="input-text full-width" name="amount" value=""/>
                                        <input type="hidden" class="input-text full-width" name="currency" value="INR"/>
                                        <input type="hidden" class="input-text full-width" name="redirect_url" value="{{url('/booking-confirmation')}}"/>
                                        <input type="hidden" class="input-text full-width" name="cancel_url" value="{{url('/booking-confirmation')}}"/>
                                        <input type="hidden" class="input-text full-width" name="language" value="EN"/> 
                                        <input type="hidden" class="input-text full-width" name="merchant_param1" value="Rapidex Travels Payment"/>
                                        <input type="hidden" class="input-text full-width" name="merchant_param2" value=""/>
                                        <input type="hidden" class="input-text full-width" name="merchant_param3" value=""/>
                                        <input type="hidden" class="input-text full-width" name="merchant_param4" value=""/>
                                        <input type="hidden" class="input-text full-width" name="merchant_param5" value=""/>
                                        <button TYPE="submit" id="CheckOut" class="full-width btn-large" >CONFIRM BOOKING</button>
                                    </div>
                                </div>
                            </form>
                            <form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
                                <input type='hidden' name='encRequest' id="encRequest" value=''>
                                <input type='hidden' name='access_code' value='AVXO76FC73AS72OXSA'>
                            </form>
                        </div>
                        
                </div>
            </div>
            <div class="sidebar col-sms-6 col-sm-5 col-md-5">
                <div class="booking-details travelo-box">
                    <h4>Booking Details</h4>
                    <article class="image-box hotel listing-style1">
                        <figure class="clearfix">
                            
                            <img class="middle-item" width="270" height="160" alt="" src="{{$hotelImage->Images}}" style="height: 100%;width: 180px;float: left;margin-right: 12px;">
                            <div class="travel-title">
                                <h5 class="box-title">{{$hoteldata->Name}}<small></small></h5>
                               {{$hoteldata->City}},{{$hoteldata->CountryCode}}
                            </div>
                            <div class="feedback">
                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars">
                                            @php
                                           $perStar = 20 * $hoteldata->Rating;
                                            @endphp
                                            <span class="five-stars" style="width: {{$perStar}}%;"></span>
                                    </div>
                                    
                                </div>
                        </figure>
                        <div class="details">
                            
                            <div class="constant-column-3 timing clearfix">
                                <div class="check-in">
                                    <label>Check in</label>
                                    <span>{{$xmlpreBookingRes['PreBookingRequest']['PreBooking']['ArrivalDate']}}</span>
                                </div>
                                <div class="duration text-center">
                                    <i class="soap-icon-clock"></i>
                                   
                                    <span> Nights</span>
                                </div>
                                <div class="check-out">
                                    <label>Check out</label>
                                    <span>{{$xmlpreBookingRes['PreBookingRequest']['PreBooking']['DepartureDate']}}</span>
                                </div>
                            </div>
                            {{--  <div class="guest">
                                @php

                                $totalPeople = $allBookingDetail->noOfAdults + $allBookingDetail->noOfKids;
                                @endphp
                                <small class="uppercase">{{$allBookingDetail->noOfRooms}} {{CustomHelpers::getTableRecordById($allBookingDetail->roomId,'rt_rooms','roomTypeName')}} Room for <span class="skin-color">{{$totalPeople}} Persons</span></small>
                            </div>  --}}
                        </div>
                    </article>
                    
                    <h4>Other Details</h4>
                    <dl class="other-details">
                        <dt class="feature">Room Type:</dt><dd class="value">{{$xmlpreBookingRes['PreBookingRequest']['PreBooking']['RoomDetails']['RoomDetail']['Type']}}</dd>
                        <dt class="feature">No Of Rooms:</dt><dd class="value">{{$xmlpreBookingRes['PreBookingRequest']['PreBooking']['RoomDetails']['RoomDetail']['TotalRooms']}} Rooms</dd>
                        <dt class="feature">Per Night Amount:</dt><dd class="value">&#8377;  / Night</dd>
                        <dt class="feature">No Of Nights:</dt><dd class="value"> Nights</dd>
                        <dt class="feature"> Adults Prices:</dt><dd class="value">&#8377; </dd>
                        <dt class="feature"> Kids Prices:</dt><dd class="value">&#8377; 0</dd>
                        {{--  <dt class="feature">Taxes And Fees:</dt><dd class="value">Not Applicable</dd>  --}}
                        <dt class="feature">Total Price</dt><dd class="value">{{$xmlpreBookingRes['PreBookingRequest']['PreBooking']['RoomDetails']['RoomDetail']['TotalRooms']}} Room x  Nights x &#8377; / Per Room = <span class="total-price-value">&#8377;{{round($xmlpreBookingRes['PreBookingDetails']['BookingAfterPrice'],2)}}</span></dd>
                    </dl>
                </div>

                <div class="travelo-box contact-box">
                    <h4> Coupon Code</h4>
                    <p>the discount will show on invoice page</p>
                    <div class="icon-check">
                        <label>Enter Coupon Code Below</label>
                        <input class="input-text full-width" placeholder="your email" type="text">
                    </div>
                </div>
                
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





