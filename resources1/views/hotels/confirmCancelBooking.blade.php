
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
    <section id="content">
        <div class="container">
            <div class="row">
                {{--  {{dump($request)}}  --}}
                <div class="col-sm-8 col-sm-offset-2">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Confirmation For Cancel The Bookings.</div>
                            <div class="panel-body">
                                <h4>Room Cancellation Policies</h4>
                                    @php
                                    $RoomDetail = CustomHelpers::getRowArrayById($request->room_id,'rt_rooms');
                                    $OrderDetail = CustomHelpers::getBookingArrayById($request->order_id,'rt_bookings');
                                    // echo "<pre>";
                                    // print_r($OrderDetail);
                                    // echo "</pre>";
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
                                    $today = date('Y-m-d H:i:s');
                                    $remainingHours = round((strtotime($OrderDetail->checkInDate) - strtotime($today))/3600, 1);
                                    $CancellationPercent=0; 
                                    $classNew='';
                                    @endphp
                                    {{--  {{dump($allPolicies)}}  --}}
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


                                                if($remainingHours <= $hoursFrom && $remainingHours >= $hoursTo){
                                                    $CancellationPercent= $value['policy_percentege'];
                                                    $classNew = 'policySelected';
                                                }else{
                                                    $classNew = '';
                                                }
                                                @endphp
                                                @if(($value['selectFor']) == 'Percentage')
                                                    <p class="{{$classNew}}">{{$value['policy_percentege']}}% of Total Amount will deducted between {{$daysTo}} to {{$daysFrom}} days prior to Check-in Date.</p>
                                                @else
                                                    <p class="{{$classNew}}">{{$value['policy_percentege']}} days Amount of Total Amount will deducted between {{$daysTo}} to {{$daysFrom}} days prior to Check-in Date.</p>            
                                                @endif
                                            @endif
                                        @endforeach 
                                    @endif
                                    <hr>
                                    <style>
                                    th, td {padding: 12px !important;}
                                    </style>
                                    @php
                                    $deductedAmount = ($CancellationPercent / 100) * $OrderDetail->cca_paidAmount;
                                    $refundAmount = $OrderDetail->cca_paidAmount - $deductedAmount;
                                    @endphp
                                    <h4>Room Cancellation Details :</h4>
                                    <table class="table table-bordered">
                                    {{--  <thead>
                                        <tr><th>Total Paid Amount</th><th>Cancellation Charges</th><th>Refund Amount</th></tr>
                                    </thead>  --}}
                                    <tbody>
                                        <tr>
                                            <td><b>Booking Ref No. :</b></td>
                                            <td>{{$OrderDetail->cca_order_id}}</td>
                                        <tr>
                                        <tr>
                                            <td><b>CheckIn & CheckOut Date :</b></td>
                                            <td>{{date('d-M-Y',strtotime($OrderDetail->checkInDate))}} - {{date('d-M-Y',strtotime($OrderDetail->checkOutDate))}}</td>
                                        <tr>
                                        <tr>
                                            <td><b>Booking Date & Time :</b></td>
                                            <td>{{$OrderDetail->cca_transactionDate}}</td>
                                        <tr>
                                        <tr>
                                            <td><b>Booking Cancellation Date & Time :</b></td>
                                            <td>{{date('d/m/Y H:i:s')}}</td>
                                        <tr>

                                        <tr>
                                            <td><b>Booking Amount :</b></td>
                                            <td>{{$OrderDetail->cca_paidAmount}} Rs</td>
                                        <tr>

                                        <tr>
                                            <td><b>Cancellation Charges :</b></td>
                                            @if($remainingHours >= 241)
                                                <td style="color:green;">Free Cancellation</td>
                                            @else
                                                <td>{{$CancellationPercent}}% Amount Will be Charged.</td>
                                            @endif
                                            
                                        <tr>
                                        @if($remainingHours <= 240)
                                            <tr>
                                                <td><b>Deducted Amount :</b></td>
                                                <td>{{$deductedAmount}} Rs</td>
                                            <tr>
                                        @endif
                                        

                                        <tr>
                                            <td><b>Refund Amount :</b></td>
                                            <td><h4>{{$refundAmount}} Rs</h4></td>
                                        <tr>

                                        
                                        
                                    </tbody>
                                    </table> 
                                    <form action="{{url('cancelBooking')}}" method="post" >
                                        <input type="hidden" name="order_id" value="{{$request->order_id}}">
                                        <input type="hidden" name="customer_id" value="{{$request->customer_id}}">
                                        <input type="hidden" name="room_id" value="{{$request->room_id}}">
                                        <input type="hidden" name="hotel_id" value="{{$request->hotel_id}}">
                                        <input type="hidden" name="refundAmount" value="{{$refundAmount}}">
                                        <input type="hidden" name="deductedAmount" value="{{$deductedAmount}}">
                                        <input type="hidden" name="cancelDate" value="{{date('Y-m-d H:i:s')}}">
                                       
                                        <button class="btn-large status cancel pull-right" onclick="return confirm('Are you sure you want to Cancel Booking?');">Cancel Booking</button>
                                    </form>
                                    <a href="{{ URL::previous() }}" class="button btn-mini status cancel pull-left"  onclick="return confirm('Are you sure you want to Back...?');">Back to Profile</a>
                                    
                            </div>
                        </div>

                    

                </div>
                
            </div>
        </div>
    </section>
@endsection