@extends('layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <style type="text/css">
        #singleBooking .invoice-right {float: right !important;}
        #singleBooking .invoice-right p {text-align: left !important; color: #545151 !important;font-size: 13px !important;}
        #singleBooking .top-invoice  {padding-top: 20px !important;}
        #singleBooking .alert.alert-success  {background: #5e891b !important;}
        #singleBooking .invoice p {color: #545151 !important;}
        #singleBooking .panel-heading {border-radius: 0px !important;}
        #singleBooking .panel {margin-bottom: 0 !important; border-radius: 0px !important; border:0 !important;}
        #singleBooking p,li {font-size: 13px !important;color: #333 !important;}
    </style>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>Booking Ref No:</b> {{$bookingDetail['cca_order_id']}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="singleBooking">
             {{--  {{dump($bookingDetail)}}  --}}
             <section class="content1">
                    <div class="row">
                      <div class="col-md-121">
                        
                        <div class="panel panel-default">
                          <div class="panel-body">
                            <div id="content">
                              <div id="my-tab-content" class="tab-content">
                                <div class="tab-pane active" id="red">
                                  <h3 class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Booking Status : <b>{{$bookingDetail['cca_order_status']}}</b>.  <br><span class="glyphicon glyphicon-ok"></span>  Tracking Id :  <b>{{$bookingDetail['cca_tracking_id']}}</b></h3>
                                  <div class="row">
                                    <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">Booking Ref No:
                                    </label>
                                    <div class="col-md-9">
                                      <input placeholder="Booking Ref No:" name="refNo" class="form-control" type="text" value="{{$bookingDetail['cca_order_id']}}">
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">PNR No.:
                                    </label>
                                    <div class="col-md-9">
                                      <input placeholder="Booking PNR No" name="pnrNo" class="form-control" type="text">
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">Check In:
                                    </label>
                                    <div class="col-md-9">
                                            <div class="form-group">
                                                <!-- Date input -->
                                                <div class="date" id="">
                                                    <input name="dateTo" class="form-control datepicker" type="text" value="{{date('m/d/Y',strtotime($bookingDetail['checkInDate']))}}">
                                                </div>
                                            </div>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">Check Out:
                                    </label>
                                    <div class="col-md-9">
                                            <div class="form-group">
                                                <!-- Date input -->
                                                <div class=" date" id="">
                                                    <input name="dateTo" class="form-control datepicker" type="text" value="{{date('m/d/Y',strtotime($bookingDetail['checkOutDate']))}}">
                                                </div>
                                            </div>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">No Of Room:
                                    </label>
                                    <div class="col-md-9">
                                      <input placeholder="4" name="" class="form-control" type="text" value="{{$bookingDetail['noOfBookedRooms']}}">
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">No Of Nights:
                                    </label>
                                    <div class="col-md-9">
                                        @php

                                        $checkInDate = new DateTime($bookingDetail['checkInDate']);
                                        $checkOutDate = new DateTime($bookingDetail['checkOutDate']);
                                        

                                        $diff_in_days = $checkOutDate->diff($checkInDate)->format("%d");

                                        @endphp
                                      <input placeholder="3" name="" class="form-control" type="text" value="{{$diff_in_days}}" disabled>
                                    </div>
                                    </div>
                                  </div>
                                  </div>
          
          
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Room Detail</h3>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                    <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">Room Name:
                                    </label>
                                    <div class="col-md-9">
                                      <input placeholder="Name" name="" class="form-control" type="text" value="{{CustomHelpers::getTableRecordById($bookingDetail['roomId'],'rt_rooms','roomTypeName') }}" disabled>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">No Of Adults:
                                    </label>
                                    <div class="col-md-9">
                                      <input placeholder="Adults" name="" class="form-control" type="text" value="{{$bookingDetail['noOfAdults']}}" disabled> 
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">Bed Type:
                                    </label>
                                    <div class="col-md-9">
                                      <input placeholder="Bed Type" name="" class="form-control" type="text" value="{{CustomHelpers::getTableRecordById($bookingDetail['roomId'],'rt_rooms','bedType') }}" disabled>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <div class="row">
                                      <label class="col-md-3">No Of Childs:
                                    </label>
                                    <div class="col-md-9">
                                      <input placeholder="Childs" name="" class="form-control" type="text" value="{{$bookingDetail['noOfChilds']}}" disabled>
                                    </div>
                                    </div>
                                  </div>
                                  </div>
                                    </div>
                                  </div>
          
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Customer Detail</h3>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                    <div class="col-md-4 form-group">
                                    <div class="row">
                                      <label class="col-md-2">Name:
                                    </label>
                                    <div class="col-md-10">
                                      <input placeholder="Name" name="" class="form-control" type="text" value="{{$bookingDetail['cca_billingName']}}" disabled>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 form-group">
                                    <div class="row">
                                      <label class="col-md-2">Email:
                                    </label>
                                    <div class="col-md-10">
                                      <input placeholder="Email" name="" class="form-control" type="text" value="{{$bookingDetail['cca_billingEmail']}}" disabled>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 form-group">
                                    <div class="row">
                                      <label class="col-md-2">Phone:
                                    </label>
                                    <div class="col-md-10">
                                      <input placeholder="Phone:" name="" class="form-control" type="text" value="{{$bookingDetail['cca_billingTel']}}" disabled>
                                    </div>
                                    </div>
                                  </div>
                                  </div>
                                    </div>
                                  </div>
          
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Hotel Details</h3>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                    <div class="col-md-3">
                                      <div class="Hotel_Detail_img">
                                        <img class="img-responsive" src="{{ url('/public'.CustomHelpers::get_first_image($bookingDetail['hotelId'],'rt_hotel_uploads','image_path','hotel_id')) }}">
                                      </div>
                                    </div>
                                    <div class="col-md-9">
                                      <div class="Hotel_Detail_info">
                                        <p><b>{{CustomHelpers::getTableRecordById($bookingDetail['hotelId'],'rt_hotels','name') }}</b></p>
                                        <p><b>{{CustomHelpers::getTableRecordById($bookingDetail['hotelId'],'rt_hotels','map_address') }}</b></p>
                                        <p><b>{{CustomHelpers::getTableRecordById($bookingDetail['hotelId'],'rt_hotels','contact_no') }}</b></p>
                                      </div>
                                    </div>
                                  </div>
                                    </div>
                                  </div>
          
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Room Rates</h3>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-md-4 form-group">
                                          <div class="row">
                                            <label class="col-md-4">Room Rates:
                                          </label>
                                          <div class="col-md-8">
                                            <div class="input-group">
                                              <span class="input-group-addon" id="basic-addon1">&#8377;</span>
                                              @php
                                            $RoomRate = $bookingDetail['cca_paidAmount']-$bookingDetail['taxAmount'];

                                            @endphp
                                              <input class="form-control" value="{{$RoomRate}}" placeholder="" aria-describedby="basic-addon1" type="text" disabled>
                                            </div>
                                          </div>
                                          </div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                          <div class="row">
                                            <label class="col-md-4">Taxes And Fees
                                          </label>
                                          <div class="col-md-8">
                                            <div class="input-group">
                                              <span class="input-group-addon" id="basic-addon1">&#8377;</span>
                                              <input class="form-control" value="{{$bookingDetail['taxAmount']}}" placeholder="" aria-describedby="basic-addon1" type="text" disabled>
                                            </div>
                                          </div>
                                          </div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                          <div class="row">
                                            <label class="col-md-4">Total Price:
                                          </label>
                                          <div class="col-md-8">
                                            <div class="input-group">
                                              <span class="input-group-addon" id="basic-addon1">&#8377;</span>
                                            <input class="form-control" value="{{$bookingDetail['cca_paidAmount']}}" placeholder="" aria-describedby="basic-addon1" type="text" disabled>
                                            </div>
                                          </div>
                                          </div>
                                        </div>
                                      </div>
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
            @php /*
             <section id="content">
                    <div class="container" >
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="row">
                                    <h3 class="alert alert-success">Thanks. The booking has been "{{$bookingDetail['cca_order_status']}}".</h3>
                                </div>
                            </div>
                        <div class="col-md-8 col-md-offset-2" style="border:1px solid #08B2ED; margin-bottom: 30px;">
                            <div class="row">
                            <div class="invoice">
                                
                                <div class="top-invoice">
                                <div class="col-md-4">
                                    <div class="invoice_address"><!-- 
                                        <h4 style="text-align: left;">Rapidex Travels</h4> -->
                                        <p style="text-align: left;">Shop No. 206 - 207, Ganga Shopping Complex, Sector 16 B, Vasundhra, Pin – 201012 Delhi - NCR Region (INDIA)</p>
                                    </div>
                                </div>
            
                                <div class="col-md-4">
                                    <div class="invoice_logo">
                                            <img class="img-responsive" src="{{ asset("/resources/assets/frontend/") }}/images/logo.png">
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
                                            <p>{{$bookingDetail['cca_order_id']}}</p>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="invoice">
                                             <p><b>Check In:</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice-right">
                                            <p>{{date('D, d-M-Y',strtotime($bookingDetail['checkInDate']))}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice">
                                             <p><b>Check Out:</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice-right">
                                            <p>{{date('D, d-M-Y',strtotime($bookingDetail['checkOutDate']))}}</p>
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
                                            <p style="color: green;">{{$bookingDetail['cca_order_status']}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice">
                                             <p><b>No Of Room:</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice-right">
                                            <p>{{$bookingDetail['noOfBookedRooms']}} Rooms.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice">
                                             <p><b>No Of Nights:</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice-right">
                                            @php

                                            $checkInDate = new DateTime($bookingDetail->checkInDate);
                                            $checkOutDate = new DateTime($bookingDetail->checkOutDate);
                                            

                                            $diff_in_days = $checkOutDate->diff($checkInDate)->format("%d");

                                            @endphp
                                            <p>{{$diff_in_days}} Nights.</p>
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
                                    <img src="{{ url('/public'.CustomHelpers::get_first_image($bookingDetail['hotelId'],'rt_hotel_uploads','image_path','hotel_id')) }}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="invoice">
                                                <p><b>{{CustomHelpers::getTableRecordById($bookingDetail['hotelId'],'rt_hotels','name') }}</b></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="invoice">
                                                <p>{{CustomHelpers::getTableRecordById($bookingDetail['hotelId'],'rt_hotels','map_address') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="invoice">
                                                <p>{{CustomHelpers::getTableRecordById($bookingDetail['hotelId'],'rt_hotels','contact_no') }}</p>
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
                                                    <p>{{CustomHelpers::getTableRecordById($bookingDetail['roomId'],'rt_rooms','roomTypeName') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="invoice">
                                                    <p><b>Bed Type:</b></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="invoice-right">
                                                    <p>{{CustomHelpers::getTableRecordById($bookingDetail['roomId'],'rt_rooms','bedType') }}</p>
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
                                                    <p>{{$bookingDetail['noOfAdults']}} Adults</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="invoice">
                                                    <p><b>No Of Childs:</b></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="invoice-right">
                                                    <p>{{$bookingDetail['noOfChilds']}} Childs</p>
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
                                    <p><b>Name: </b>  {{$bookingDetail['cca_billingName']}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="invoice">
                                    <p><b>Email: </b>  {{$bookingDetail['cca_billingEmail']}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="invoice">
                                    <p><b>Phone: </b>  {{$bookingDetail['cca_billingTel']}}</p>
                                </div>
                            </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="background-color: #E6EDF6;padding-top: 30px;padding-left: 0;padding-right: 0;">
                            <div class="col-md-6">
                                <div class="invoice">
                                    <p>{{CustomHelpers::getTableRecordById($bookingDetail['roomId'],'rt_rooms','roomTypeName') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-right">
                                    <p>&#8377; {{$bookingDetail['cca_paidAmount']}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice">
                                    <p>Tax</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-right">
                                    <p>&#8377; 0.00</p>
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
                                {{$bookingDetail['noOfBookedRooms']}} Room x {{$diff_in_days}} Nights x &#8377; {{$bookingDetail['totalAmount']}}/ Per Room = <span  style="font-size: 24px;">&#8377; {{$bookingDetail['cca_paidAmount']}}</span></p>
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
            
            </div>
            */
            @endphp

            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection