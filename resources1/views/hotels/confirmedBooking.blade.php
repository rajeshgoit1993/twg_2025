
@extends('layouts.front.master')
@section('content')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Hotel Booking</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Booking Information</li>
        </ul>
    </div>
</div>

{{--  <section id="content" class="gray-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sms-12 col-sm-12 col-md-12">
                <div class="booking-section travelo-box">
                    
                </div>
            </div>

        </div>
    </div>
</section>  --}}
{{--  {{dump($hotelBookingDetail)}}  --}}
<section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <h3 class="alert alert-success">Thanks. The booking has been "{{$hotelBookingDetail['cca_order_status']}}".</h3>
                    </div>
                </div>
            <div class="col-md-8 col-md-offset-2" style="border:1px solid #08B2ED; margin-bottom: 30px;">
                <div class="row">
                <div class="invoice">
                    <style type="text/css">
                        .invoice-right {float: right;}
                        .invoice-right p {text-align: left; color: #545151;font-size: 13px;}
                        .top-invoice  {padding-top: 20px;}
                        .alert.alert-success  {background: #5e891b;}
                        .invoice p {color: #545151;}
                        .panel-heading {border-radius: 0px !important;}
                        .panel {margin-bottom: 0; border-radius: 0px !important; border:0;}
                        p,li {font-size: 13px;color: #333;}
                    </style>
                    <div class="top-invoice">
                    <div class="col-md-4">
                        <div class="invoice_address"><!-- 
                            <h4 style="text-align: left;">Rapidex Travels</h4> -->
                            <p style="text-align: left;">Shop No. 206 - 207, Ganga Shopping Complex, Sector 16 B, Vasundhra, Pin – 201012 Delhi - NCR Region (INDIA)</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="invoice_logo">
                                <img src="{{ asset("/resources/assets/frontend/") }}/images/logo.png">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="invoice_address">
                            <ul>
                                <li>Phone: +91 120 4103400</li>
                                <li>Cell: +91 9650731717</li>
                                <li>WhatsApp: +91 9818433636</li>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>

            <div class="col-md-12" style="background-color: #fff;padding-top: 17px; border-bottom:1px solid #08B2ED; border-top:1px solid #08B2ED; margin-top: 10px;">
                
                <div class="col-md-6">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="invoice">
                                 <p><b>Booking Ref No:</b></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-right">
                                <p>{{$hotelBookingDetail['cca_order_id']}}</p>
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="invoice">
                                 <p><b>Check In:</b></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-right">
                                <p>{{date('D, d-M-Y',strtotime($hotelBookingDetail['checkInDate']))}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice">
                                 <p><b>Check Out:</b></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-right">
                                <p>{{date('D, d-M-Y',strtotime($hotelBookingDetail['checkOutDate']))}}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="invoice">
                                 <p><b>Booking Status:</b></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-right">
                                <p style="color: green;">{{$hotelBookingDetail['cca_order_status']}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice">
                                 <p><b>No Of Room:</b></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-right">
                                <p>{{$hotelBookingDetail['noOfBookedRooms']}} Rooms.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice">
                                 <p><b>No Of Nights:</b></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-right">
                                <p>{{$hotelBookingDetail['noOfNights']}} Nights.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="background-color: #fff; padding: 0; border-bottom:1px solid #08B2ED;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hotel Details</h3>
                    </div>
                    <div class="panel-body">
                      
                <div class="col-md-4">
                    <div class="invoice">
                        <img src="{{ url('/public'.CustomHelpers::get_first_image($hotelBookingDetail['hotelId'],'rt_hotel_uploads','image_path','hotel_id')) }}">
                    </div>
                </div>
                <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice">
                                    <p><b>{{CustomHelpers::getTableRecordById($hotelBookingDetail['hotelId'],'rt_hotels','name') }}</b></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="invoice">
                                    <p>{{CustomHelpers::getTableRecordById($hotelBookingDetail['hotelId'],'rt_hotels','map_address') }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="invoice">
                                    <p>{{CustomHelpers::getTableRecordById($hotelBookingDetail['hotelId'],'rt_hotels','contact_no') }}</p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="background-color: #fff; padding: 0; border-bottom:1px solid #08B2ED;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Room Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="invoice">
                                        <p><b>Room Name:</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice-right">
                                        <p>{{CustomHelpers::getTableRecordById($hotelBookingDetail['roomId'],'rt_rooms','roomTypeName') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice">
                                        <p><b>Bed Type:</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice-right">
                                        <p>{{CustomHelpers::getTableRecordById($hotelBookingDetail['roomId'],'rt_rooms','bedType') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="invoice">
                                        <p><b>No Of Adults:</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice-right">
                                        <p>{{$hotelBookingDetail['noOfAdults']}} Adults</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice">
                                        <p><b>No Of Childs:</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice-right">
                                        <p>{{$hotelBookingDetail['noOfChilds']}} Childs</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="background-color: #fff; padding: 0; border-bottom:1px solid #08B2ED;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Customer Details</h3>
                    </div>
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                    <div class="invoice">
                        <p><b>Name: </b>  {{$hotelBookingDetail['cca_billingName']}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="invoice">
                        <p><b>Email: </b>  {{$hotelBookingDetail['cca_billingEmail']}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="invoice">
                        <p><b>Phone: </b>  {{$hotelBookingDetail['cca_billingTel']}}</p>
                    </div>
                </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="background-color: #E6EDF6;padding-top: 30px;padding-left: 0;padding-right: 0;">
                <div class="col-md-6">
                    <div class="invoice">
                        <p>{{CustomHelpers::getTableRecordById($hotelBookingDetail['roomId'],'rt_rooms','roomTypeName') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="invoice-right">
                        @php
                        $RoomRate = $hotelBookingDetail['cca_paidAmount']-$hotelBookingDetail['taxAmount'];
                        $perRoom = ($RoomRate/$hotelBookingDetail['noOfBookedRooms'])/$hotelBookingDetail['noOfNights'];
                        @endphp
                        <p>{{$hotelBookingDetail['noOfBookedRooms']}} Room x 
                            {{$hotelBookingDetail['noOfNights']}} Nights x 
                            &#8377; {{$perRoom}}/ Per Room = &#8377; {{$RoomRate}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="invoice">
                        <p>Taxes & Fees</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="invoice-right">
                        <p>&#8377; {{$hotelBookingDetail['taxAmount']}}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="invoice">
                        <p style="font-size: 24px;">Total Price</p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="invoice-right">
                        <p>
                            <span  style="font-size: 24px;">
                                &#8377; {{$hotelBookingDetail['cca_paidAmount']}}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Booking Notes</h3>
                    </div>
                    <div class="panel-body">
                    <p>Booking payable as per reservation details; Please collect all extras directly from clients prior to departure. </p>
                    <p>All vouchers issued are on the condition that all arrangements operated by person or bodies are made as agents only and
                    that they shall not be responsible or any damage, loss, injury ,delay or inconvenience caused to passengers as a result of
                    any such arrangements. We will not accept any responsibility for additional expenses due to the changes or delays in air,
                    road, rail, sea or indeed any other causes, all such expenses will have to be borne by passengers.</p>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nationality & Domicile</h3>
                    </div>
                    <div class="panel-body">
                    <p>Passenger travelling to destination where guest is holding a local residency; Booking should be searched with Country of
                    Residence as Nationality in order to avail the valid rates. (i.e. Indian National holding UAE Residence Permit should select
                    Emirati as nationality for search). In case of wrong residency or nationality selected by user at the time of booking; the
                    supplement charges may be applicable and need to be paid directly to the hotel by guest on check in/check out.</p>
                    <p>Additional supplement charges may be charged by the Hotel (which the Guest have to pay directly at the hotel) If the lead
                    guest’s Nationality is different than the Nationality of the other accompanied guests. For more details you can reach out to
                    our operation Team for clarification.
                    </p>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Check In/Check Out Timings & Policies :</h3>
                    </div>
                    <div class="panel-body">
                    <ul style="padding-left: 15px;">
                        <li style="list-style: outside; padding-bottom: 10px;">The usual check-in time is 14:00 hours. Rooms may not be available for early check-ins, unless specifically required in advance. However, luggage may be deposited at the hotel reception and collected once the room is allotted</li>
                        <li style="list-style: outside; padding-bottom: 10px;">Note that reservation may be cancelled automatically after 18:00 hours if hotel is not informed about the approximate time of late arrivals.</li>
                        <li style="list-style: outside; padding-bottom: 10px;">Official checkout time is at 12:00 hours. Any late checkout may involve additional charges. Please check with the hotel reception in advance. </li>
                    </ul>
                    <hr>
                    <h4>Check your Reservation details carefully and inform us immediately if you have any queries.</h4>
                    </div>
                </div>
                </div>
                </div>
        </div>
            </div>
            </div>
            </div>
        </div>
    </section>
@endsection