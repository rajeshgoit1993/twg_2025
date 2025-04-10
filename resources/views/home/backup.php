@extends('layouts.front.master')
@section('content')
 <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">My Account</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">My Account</li>
                </ul>
            </div>
        </div>
        <section id="content" class="gray-area">
            <div class="container">
                <div id="main">
                    <div class="tab-container full-width-style arrow-left dashboard">
                        <ul class="tabs">
                            <li  class="active"><a data-toggle="tab" href="#booking"><i class="soap-icon-businessbag circle"></i>Bookings</a></li>
                            <li class=""><a data-toggle="tab" href="#profile"><i class="soap-icon-user circle"></i>Profile</a></li>
                            <li class=""><a data-toggle="tab" href="#settings"><i class="soap-icon-settings circle"></i>Settings</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="booking" class="tab-pane fade in active">
                                    <h1 class="no-margin skin-color">Hi {{Sentinel::getUser()->first_name}}, Welcome to Rapidex Travels!</h1>
                                    <p>All your trips booked with us will appear here and you’ll be able to manage everything!</p>
                                    <br /> 
                                    @if(Session::has('success'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        {{Session::get('success')}}
                                        </div>
                                    @endif                              
                                <div class="booking-history">
                                    @php
                                    $bookings=array();
                                    $bookingsOrderIds=array();
                                    foreach($myBookings as $key=>$booking){
                                        $bookings['cca_order_id'] = $booking->cca_order_id;
                                        $bookingsOrderIds[]=$bookings; 
                                    }
                                    $orderIds = array();
                                    $myarray = array_filter($bookingsOrderIds, function($el) use (&$orderIds) {
                                        if (in_array($el['cca_order_id'], $orderIds)) { // if the id has already been seen
                                            return false; // remove it
                                        }else{
                                            $orderIds[] = $el['cca_order_id']; // the id has now been seen
                                            return true; // but keep the first occurrence of it
                                        }
                                    });
                                    $AllbookingData = array();
                                    @endphp
                                    @foreach($orderIds as $key=>$id)
                                        @php
                                            $bookingData = CustomHelpers::getBookingArrayById($id);
                                            $AllbookingData[]=$bookingData;
                                        @endphp
                                    @endforeach
                                    {{--  {{dump($AllbookingData)}}  --}}
                                    @foreach($AllbookingData as $key=>$booking)
                                    @php
                                        $CI_dateValue = date('Y-m-d',strtotime($booking->checkInDate));
                                        $CI_year = date('Y',strtotime($CI_dateValue));
                                        $CI_month = date('F',strtotime($CI_dateValue));
                                        $CI_date = date('d',strtotime($CI_dateValue));
                                        $CO_dateValue = date('Y-m-d',strtotime($booking->checkOutDate));
                                        $CO_year = date('Y',strtotime($CO_dateValue));
                                        $CO_month = date('F',strtotime($CO_dateValue));
                                        $CO_date = date('d',strtotime($CO_dateValue));
                                    @endphp
                                    <div class="booking-info clearfix">
                                        <div class="date">                                            
                                            <span class="month">{{$CI_month}}</span>
                                            <span class="date">{{$CI_date}}</span>
                                            <span class="day">{{$CI_year}}</span>
                                        </div>
                                        <div class="date">
                                            <span class="month">{{$CO_month}}</span>
                                            <span class="date">{{$CO_date}}</span>
                                            <span class="day">{{$CO_year}}</span>
                                        </div>
                                        <h4 class="box-title"><i class="icon soap-icon-hotel blue-color circle"></i>
                                            {{CustomHelpers::getTableRecordById($booking->hotelId,'rt_hotels','name')}}<span style="font-size:12px;">({{CustomHelpers::getTableRecordById($booking->roomId,'rt_rooms','roomTypeName')}})</span>
                                            <small>{{$booking->noOfAdults}} Adults,{{$booking->noOfChilds}} Childs Staying</small>
                                        </h4>
                                        <dl class="info">
                                            <dt>ORDER ID</dt>
                                            <dd>{{$booking->cca_order_id}}</dd>
                                            <dt>Amount</dt>
                                            <dd>{{$booking->cca_paidAmount}}</dd>
                                            {{--  <dd>  <button class="btn-mini status complete"><i class="fa fa-print"></i></button>
                                                <button class="btn-mini status complete"><i class="fa fa-download"></i></button>
                                            </dd>  --}}
                                        </dl>
                                        @php
                                        $date_now = date("Y-m-d H:i:s"); // this format is string comparable
                                        if ($date_now > date('Y-m-d H:i:s',strtotime($booking->checkOutDate))) { 
                                            $status = 'Booking Completed';
                                            $class = 'complete';
                                        }else{
                                            $status = 'Upcoming';
                                            $class = 'upcoming';
                                        }
                                        
                                        $today = date('Y-m-d H:i:s');
                                        $remainingHours = round((strtotime($booking->checkInDate) - strtotime($today))/3600, 1);
                                        @endphp
                                        @if($booking->bookingStatus =='cancelled')

                                        <button class="btn-mini status cancelled">Booking Cancelled</button>

                                        @elseif($class == 'complete')

                                        <button class="btn-mini status complete">Booking Completed</button>
                                        
                                        @elseif($date_now > date('Y-m-d H:i:s',strtotime($booking->checkInDate)) && $date_now < date('Y-m-d H:i:s',strtotime($booking->checkOutDate)))

                                        <button class="btn-mini status complete">On Going</button>

                                        @elseif($remainingHours >= 0)
                                        <form action="{{url('/ConfirmCancelBooking')}}" method="post">
                                            <input type="hidden" name="order_id" value="{{$booking->cca_order_id}}">
                                            <input type="hidden" name="customer_id" value="{{$booking->customerId}}">
                                            <input type="hidden" name="room_id" value="{{$booking->roomId}}">
                                            <input type="hidden" name="hotel_id" value="{{$booking->hotelId}}">

                                            <button class="btn-mini status cancel" onclick="return confirm('Are you sure you want to Cancel Booking?');">Cancel</button>
                                        </form>
                                        <button class="btn-mini status {{$class}}">{{$status}}</button>
                                        @endif
                                            
                                        
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="profile" class="tab-pane fade">
                                <div id="success_message" style="display: none;">
                                   <div class="alert alert-success" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong>Success!</strong> Indicates a successful or positive action.
                                    </div>
                                </div>
                                <div class="view-profile">
                                    <article class="image-box style2 box innerstyle personal-details">
                                       
                                        <figure>
                                            <a title="" href="#"><img width="270" height="263" alt="" src="{{URL::to('/').'/public/'.$userifo[0]->profile_image}}"></a>
                                            <a href="#" class="label label-info edit-image-btn">Change Image <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </figure>
                                        <div class="details">
                                            <a href="#editmyprofile" class="button btn-mini pull-right edit-profile-btn">EDIT PROFILE</a>
                                            <h2 class="box-title fullname">{{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}}</h2>
                                            <dl class="term-description">
                                                <dt>Email Id:</dt><dd>{{Sentinel::getUser()->email}}</dd>
                                                <dt>first name:</dt><dd>{{Sentinel::getUser()->first_name}}</dd>
                                                <dt>last name:</dt><dd>{{Sentinel::getUser()->last_name}}</dd>
                                                <dt>phone number:</dt><dd>{{$userifo[0]->phone_no}}</dd>
                                                <dt>Date of birth:</dt><dd>{{$userifo[0]->dob}}</dd>
                                                <dt>Street Address and number:</dt><dd>{{$userifo[0]->streetname}}</dd>
                                                <dt>Town / City:</dt><dd>{{$userifo[0]->city}}</dd>
                                                <dt>ZIP code:</dt><dd>{{$userifo[0]->zipcode}}</dd>
                                                <dt>Country:</dt><dd>{{$userifo[0]->country}}</dd>
                                            </dl>
                                        </div>
                                    </article>
                                    <hr>
                                    <h2>About You</h2>
                                        <div class="intro">
                                        <p>{{$userifo[0]->about}}</p>
                                    </div>
                                    <hr>
                                    
                                </div>
                                <div class="edit-image"  style="display: none;">
                                    <h2>Profile Image</h2>
                                      <div class="row form-group">
                                        <form action="{{url('/image-update')}}" class="dropzone" id="add-image" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="hidden" name="user_id" value="{{Sentinel::getUser()->id}}">

                                        </form>
                                    </div>
                                    <button class="btn-medium col-sms-6 col-sm-4" id="save-profile-image" type="button">Save Image</button>                                   
                                </div>
                                <div class="edit-profile">
                                    <form id="edit-profile-form"  method="post" >
                                    	{{csrf_field()}}
                                        <h2>Personal Details</h2>
                                        <div class="col-sm-9 no-padding no-float">
                                            <div class="row form-group">
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>First Name</label>
                                                    <input type="text" name="first_name" id="profile-fname" value="{{Sentinel::getUser()->first_name}}" class="input-text full-width" placeholder="">
                                                </div>
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Last Name</label>
                                                    <input type="text" name="last_name" id="profile-lname" value="{{Sentinel::getUser()->last_name}}" class="input-text full-width" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Email Address</label>
                                                    <input type="text" name="email" id="profile-email" value="{{Sentinel::getUser()->email}}" class="input-text full-width" placeholder="">
                                                </div>
                                               <div class="col-sms-6 col-sm-6">
                                                    <label>Phone Number</label>
                                                    <input type="text" name="phone" id="profile-phone" class="input-text full-width" placeholder="" value="{{$userifo[0]->phone_no}}">
                                                </div> 
                                            </div>
                                            <div class="row form-group">
                                             
                                                
                                                <div class="col-sms-6 col-sm-6">
                                                   <label>Date of Birth</label>
                                                     <div class="bfh-datepicker" value="{{$userifo[0]->dob}}" data-format="y-m-d" data-date="today">
													</div>
                                                </div>
                                            </div>
                                            
                                           
                                            <hr>
                                            <h2>Contact Details</h2>
                                            <div class="row form-group">
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Street Name</label>
                                                    <input type="text" name="streetname" id="profile-streetname" class="input-text full-width" value="{{$userifo[0]->streetname}}">
                                                </div>
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Address</label>
                                                    <input type="text" name="address" value="{{$userifo[0]->address}}" id="profile-address" class="input-text full-width">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                
                                                <div class="col-sms-4 col-sm-4">
                                                    <label>Country</label>
                                                    <div class="selector" id="profile-country">
                                                      	<div id="countries_states2" class="bfh-selectbox bfh-countries full-width" data-country="IN">
														</div>
                                                        <!-- <select id="countries_states1" name="country"  class="full-width form-control bfh-countries" data-country="IN"></select> -->
                                                    </div>
                                                </div>
                                                 <div class="col-sms-4 col-sm-4">
                                                    <label>Region State</label>
                                                    <div class="selector">
                                                       <div class="bfh-selectbox bfh-states full-width" data-country="countries_states2" data-state="DE">
														</div>
                                                       <!--  <select name="state" class=" full-width form-control bfh-states" data-country="countries_states1"></select> -->
                                                    </div>
                                                </div>
                                                 <div class="col-sms-4 col-sm-4">
                                                    <label>City</label>
                                                    <div class="selector">
                                                    	 <input type="text" value="{{$userifo[0]->city}}" name="city" id="profile-city" class="input-text full-width">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="row form-group">
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Zip Code</label>
                                                    <input type="text" name="zipcode" value="{{$userifo[0]->zipcode}}" id="profile-zipcode" class="input-text full-width">
                                                </div>
                                               
                                            </div>
                                            <!-- <h2>Upload Profile Photo</h2>
                                            <div class="row form-group">
                                                <div class="col-sms-12 col-sm-6 no-float">
                                                    <div class="fileinput full-width">
                                                        <input type="file" class="input-text" name="dp" id="profile-dp" data-placeholder="select image/s">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <hr>
                                            <h2>Describe Yourself</h2>
                                            <div class="form-group">
                                                <textarea rows="5" class="input-text full-width" name="about" id="profile-about" placeholder="please tell us about you">{{$userifo[0]->about}}</textarea>
                                            </div>
                                            <div class="from-group">
                                              <button type="submit" class="btn-medium col-sms-6 col-sm-4">UPDATE SETTINGS</button>
                                               
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div id="settings" class="tab-pane fade">
                                <h2>Account Settings</h2>
                                <h5 class="skin-color">Change Your Password</h5>
                                <form>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Old Password</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Enter New Password</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Confirm New password</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-medium">UPDATE PASSWORD</button>
                                    </div>
                                </form>
                                <hr>
                                <h5 class="skin-color">Change Your Email</h5>
                                <form>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Old email</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Enter New Email</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Confirm New Email</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-medium">UPDATE EMAIL ADDRESS</button>
                                    </div>
                                </form>
                                <hr>
                                <h5 class="skin-color">Change Your Name & Phone</h5>
                                <form>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Frist Name</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Last Name</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Phone Number</label>
                                            <input type="numbers" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-medium">UPDATE EMAIL ADDRESS</button>
                                    </div>
                                </form>
                                <hr>
                                <h5 class="skin-color">Send Me Emails When</h5>
                                <form>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Travelo has periodic offers and deals on really cool destinations.
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Travelo has fun company news, as well as periodic emails.
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I have an upcoming reservation.
                                        </label>
                                    </div>
                                    <button class="btn-medium uppercase">Update All Settings</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
@endsection