
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
{{--  {{dump($allBookingDetail)}}  --}}
@php

  
$date = new DateTime($allBookingDetail->checkOutDate);
$now = new DateTime($allBookingDetail->checkInDate);

$diff_in_days = $date->diff($now)->format("%d");

//print_r($diff_in_days); 
//$AdultPrice = $allBookingDetail->noOfAdults * $allBookingDetail->TotalAmount;
//$KidsPrice = $allBookingDetail->noOfKids * 0;
$totalPricE = $allBookingDetail->TotalAmount * $diff_in_days * $allBookingDetail->noOfRooms;

$taxeS = unserialize($HotelDetail->taxes);
$taxesKeys =  array_keys($taxeS);
$totalTaxes = array();
foreach ($taxesKeys as $key => $value) {
    $totalTaxes[] = $taxeS[$value]['percentage'];
}
$totalTaxeSum = array_sum($totalTaxes);
$taxAmount = ($totalTaxeSum / 100) * $totalPricE;

$totalAmount = $totalPricE + $taxAmount;

@endphp
<section id="content" class="gray-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sms-6 col-sm-7 col-md-7">
                <div class="booking-section travelo-box">
                    {{--  {{dump($userinfo)}}  --}}
                    {{--  {{dump($allBookingDetail)}}  --}}
                    {{--  {{dump($HotelDetail)}}  --}}
                   {{--   {{dump($images)}}  --}}
                    
                        <div class="alert small-box" style="display: none;"></div>
                        <div class="person-information">
                            <h2>Guest Information</h2>
                            <div class="alert alert-danger feedbckerror" style="display:none;">
                                    <strong>Alert!</strong>&nbsp;Please Fill Below Form before Make payment.
                            </div>
                            <form method="post" name="customerData" action="" id="customerData">
                                   
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                        @if(Sentinel::check())
                                            <label>Billing Name	:</label>
                                            <input type="text" class="input-text full-width billing_name" name="billing_name"  value="{{Sentinel::getUser()->first_name.' '.Sentinel::getUser()->last_name }}"  required/>
                                        @else                                                                              
                                            <label>Billing Name	:</label>
                                            <input type="text" class="input-text full-width billing_name" name="billing_name"  value="" required/>
                                        @endif
                                        </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Address	:</label><input type="text" class="billing_address input-text full-width" name="billing_address" value="" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing City Name :</label><input type="text" class="billing_city input-text full-width" name="billing_city" value="" required/>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing State Name :</label><input type="text" class="billing_state input-text full-width" name="billing_state" value="" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Zip Code	:</label><input type="text" class="billing_zip input-text full-width" name="billing_zip" value="" required/>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Country	:</label><input type="text" class="billing_country input-text full-width" name="billing_country" value="" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                        <label>Billing Phone No.	:</label><input type="text" class="billing_tel input-text full-width" name="billing_tel" value="" required/>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        
                                        @if(Sentinel::check())
                                            <label>Billing Email Address	:</label>
                                            <input type="text" class="billing_email input-text full-width" name="billing_email" value="{{Sentinel::getUser()->email }}" required/>
                                        @else                                                                              
                                            <label>Billing Email Address	:</label>
                                            <input type="text" class="billing_email input-text full-width" name="billing_email" value="" required/>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="hidden" class="input-text full-width" name="tid" id="tid" readonly />
                                        <input type="hidden" class="input-text full-width" name="merchant_id" value="155984"/>
                                        <input type="hidden" class="input-text full-width" name="order_id" value="{{substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 14)}}"/>
                                        <input type="hidden" class="input-text full-width" name="amount" value="{{$totalAmount}}"/>
                                        <input type="hidden" class="input-text full-width" name="currency" value="INR"/>
                                        <input type="hidden" class="input-text full-width" name="redirect_url" value="{{url('/booking-confirmation')}}"/>
                                        <input type="hidden" class="input-text full-width" name="cancel_url" value="{{url('/booking-confirmation')}}"/>
                                        <input type="hidden" class="input-text full-width" name="language" value="EN"/> 
                                        <input type="hidden" class="input-text full-width" name="merchant_param1" value="Rapidex Travels Payment"/>
                                        <input type="hidden" class="input-text full-width" id="customerId" name="merchant_param2" value=""/>
                                        <input type="hidden" class="input-text full-width" name="merchant_param3" value="{{$allBookingDetail->noOfRooms}},{{$allBookingDetail->noOfAdults}},{{$allBookingDetail->noOfKids}},{{$allBookingDetail->hotelId}},{{$allBookingDetail->roomId}}"/>
                                        <input type="hidden" class="input-text full-width" name="merchant_param4" value="{{$allBookingDetail->checkInDate}},{{$allBookingDetail->checkOutDate}},{{$diff_in_days}}"/>
                                        <input type="hidden" class="input-text full-width" name="merchant_param5" value="{{$totalAmount}},0,{{$totalAmount}},{{$taxAmount}}"/>
                                        <button TYPE="submit" id="CheckOut" class="full-width btn-large" >CONFIRM BOOKING</button>
                                    </div>
                                </div>
                            </form>
                            <div class="loading" style="display:none;">Loading....</div>
                            <form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
                                <input type='hidden' name='encRequest' id="encRequest" value=''>
                                <input type='hidden' name='access_code' value='AVXO76FC73AS72OXSA'>
                            </form>
                        </div>
                        
                </div>
                <div class="cancellationPolicies booking-section travelo-box">
                        <h4>Room Cancellation Policies</h4>
                        @php
                        $RoomDetail = CustomHelpers::getRowArrayById($allBookingDetail->roomId,'rt_rooms');
                       // $OrderDetail = CustomHelpers::getRowArrayById($request->order_id,'rt_bookings');
                        
                        $policies = unserialize($RoomDetail->policy);
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
                        
                        @endphp
                        @if($RoomDetail->free_Cancellation_on !='')

                            <p>No Refund if cancelled between  {{$RoomDetail->free_Cancellation_on}} days prior to Check-in Date.</p><hr>
                        @else
                            @foreach($allPolicies as $key=>$value)
                                @if(($value['selectFor']) != '0') 
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
                                @endif
                            @endforeach 
                        @endif
                </div>
            </div>
            <div class="sidebar col-sms-6 col-sm-5 col-md-5">
                <div class="booking-details travelo-box">
                    <h4>Booking Details</h4>
                    <article class="image-box hotel listing-style1">
                        <figure class="clearfix">
                            
                            <img class="middle-item" width="270" height="160" alt="" src="{{ url('/public'.CustomHelpers::get_first_image($HotelDetail->id,'rt_hotel_uploads','image_path','hotel_id')) }}" style="height: 100%;width: 180px;float: left;margin-right: 12px;">
                            <div class="travel-title">
                                <h5 class="box-title">{{$HotelDetail->name}}<small>{{$HotelDetail->map_address}}</small></h5>
                                {{--  <a href="hotel-detailed.php" class="button">EDIT</a>  --}}
                            </div>
                            <div class="feedback">
                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars">
                                            @php
                                            $perStar = 20 * $HotelDetail->stars;
                                            @endphp
                                            <span class="five-stars" style="width: {{$perStar}}%;"></span>
                                    </div>
                                    
                                </div>
                        </figure>
                        <div class="details">
                            
                            <div class="constant-column-3 timing clearfix">
                                <div class="check-in">
                                    <label>Check in</label>
                                    <span>{{date('d-M-Y',strtotime($allBookingDetail->checkInDate))}}</span>
                                </div>
                                <div class="duration text-center">
                                    <i class="soap-icon-clock"></i>
                                   
                                    <span>{{$diff_in_days}} Nights</span>
                                </div>
                                <div class="check-out">
                                    <label>Check out</label>
                                    <span>{{date('d-M-Y',strtotime($allBookingDetail->checkOutDate))}}</span>
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
                        <dt class="feature">Room Type:</dt><dd class="value">{{CustomHelpers::getTableRecordById($allBookingDetail->roomId,'rt_rooms','roomTypeName')}}</dd>
                        <dt class="feature">No Of Rooms:</dt><dd class="value">{{$allBookingDetail->noOfRooms}} Rooms</dd>
                        <dt class="feature">Per Night Amount:</dt><dd class="value">&#8377; {{$allBookingDetail->TotalAmount}} / Night</dd>
                        <dt class="feature">No Of Nights:</dt><dd class="value">{{$diff_in_days}} Nights</dd>
                        <dt class="feature">No Of Adults:</dt><dd class="value">{{$allBookingDetail->noOfAdults}} Adults</dd>
                        <dt class="feature">No Of Childs:</dt><dd class="value">{{$allBookingDetail->noOfKids}} Childs</dd>
                        <dt class="feature">Taxes And Fees:</dt><dd class="value">&#8377; {{$taxAmount}}</dd>
                        <dt class="feature"><b>Trip Total :</b></dt><dd class="value"><span class="total-price-value">&#8377;<b>{{$totalAmount}}</b></span></dd>
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
    <style>
    .js div#preloader { 
        position: fixed; 
        left: 0; 
        top: 0; 
        z-index: 999; 
        width: 100%; 
        height: 100%; 
        overflow: visible; 
        background: #333333f5 url('{{ asset("/resources/assets/frontend/") }}/images/loading.gif') no-repeat center center; }
    </style>
    <div id="preloader" style=" display:none;"></div>
</section>
@endsection