@extends('layouts.master')
@section('content')
<div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
            {{--  {{dump($Room)}}  --}}
            <form action="{{url('/storeRooms')}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{$Room->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default box">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Room Amenities</a></li>
                                    {{--  <li><a href="#tab3" data-toggle="tab">Room Rates</a></li>  --}}
                                    <li><a href="#tab4" data-toggle="tab">Cancellation Policy</a></li> 
                                    <li><a href="#tab5" data-toggle="tab">Room Inventory</a></li>                        
                                  </ul>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class="tabbable">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Room Type Name</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="roomTypeName" placeholder="Deluxe etc" value="{{$Room->roomTypeName}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Assigned Hotel Name</label>
                                                <div class="col-md-6">
                                                    <select data-placeholder="Select" class="form-control" name="assignedHotelname">
                                                        <option value="0">Select Hotel Name</option>
                                                    @foreach($hotels as $key=>$hotel) 
                                                        <option value="{{$hotel->id}}" @if($hotel->id == $Room->assignedHotelname) selected="selected" @endif>{{$hotel->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Status</label>
                                                <div class="col-md-6">
                                                    <select data-placeholder="Select" class="form-control" name="hotelstatus">
                                                        <option value="Yes" @if($Room->hotelstatus == 'Yes') selected="selected" @endif>Enabled</option>
                                                        <option value="No" @if($Room->hotelstatus == 'No') selected="selected" @endif>Disabled</option>
                                                    </select>
                                                </div>
                                            </div>

                                            

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Room Description</label>
                                                <div class="col-md-6">                                                    
                                                        <textarea name="roomDescription" rows="10" cols="71">{{$Room->roomDescription}}</textarea>                                                    
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Room Size (L x B)</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="roomSize" placeholder="Length" value="{{$Room->roomSize}}">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">No of Rooms</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="noOfRooms" value="{{$Room->noOfRooms}}" placeholder="No of Rooms We Can Book">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Bed Type</label>
                                                <div class="col-md-6">
                                                    <select name="bedType" class="form-control" style="height: 35px; width: 100%;">
                                                        <option value="0" @if($Room->bedType == '0') selected="selected" @endif>Select Bed Type</option>
                                                        <option value="Twin" @if($Room->bedType == 'Twin') selected="selected" @endif>Twin</option>
                                                        <option value="King" @if($Room->bedType == 'King') selected="selected" @endif>King</option>
                                                        <option value="Queen" @if($Room->bedType == 'Queen') selected="selected" @endif>Queen</option>
                                                        <option value="Double" @if($Room->bedType == 'Double') selected="selected" @endif>Double</option>
                                                        <option value="Single" @if($Room->bedType == 'Single') selected="selected" @endif>Single</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                            <label class="col-md-2 control-label text-left">Room View</label>
                                            <div class="col-md-6">
                                                
                                                <select name="roomView" class="form-control" style="height: 35px; width: 100%;">
                                                    @foreach($RoomViews as $key=>$rv)
                                                        <option value="{{$rv->id}}" @if($Room->roomView == $rv->id) selected="selected" @endif >{{$rv->name}}</option>
                                                    @endforeach 
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="col-md-2 control-label text-left">Extra Bed Type</label>
                                            <div class="col-md-6">
                                                <select name="extraBedType" class="form-control" style="height: 35px; width: 100%;">
                                                    <option value="0" @if($Room->extraBedType == '0') selected="selected" @endif>Select Extra Bed Type</option>
                                                    <option value="No_Extra_Bed" @if($Room->extraBedType == 'No_Extra_Bed') selected="selected" @endif>No Extra Bed</option>
                                                    <option value="Mattress" @if($Room->extraBedType == 'Mattress') selected="selected" @endif>Mattress</option>
                                                    <option value="Cot" @if($Room->extraBedType == 'Cot') selected="selected" @endif>Cot</option>
                                                    <option value="Sofa_cum_bed" @if($Room->extraBedType == 'Sofa_cum_bed') selected="selected" @endif>Sofa cum bed</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="row form-group">
                                            <label class="col-md-2 control-label text-left">Meal Plan</label>
                                            <div class="col-md-6">
                                              <select class="form-control" name="mealPlan">
                                                <option value="0" @if($Room->mealPlan == '0') selected="selected" @endif>--Select Meal Plan--</option>
                                                <option value="Accommodation-Only" @if($Room->mealPlan == 'Accommodation-Only') selected="selected" @endif>Accommodation-Only</option>
                                                <option value="Free-Breakfast" @if($Room->mealPlan == 'Free-Breakfast') selected="selected" @endif>Free-Breakfast</option>
                                                <option value="Free-Breakfast-and-Dinner" @if($Room->mealPlan == 'Free-Breakfast-and-Dinner') selected="selected" @endif>Free-Breakfast-and-Dinner</option>
                                                <option value="Free-Cooked-Breakfast" @if($Room->mealPlan == 'Free-Cooked-Breakfast') selected="selected" @endif>Free-Cooked-Breakfast</option>

                                              </select>
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <label class="col-md-2 control-label text-left">Payment Mode</label>
                                            <div class="col-md-6">
                                              <select class="form-control" name="paymentMode">
                                                <option value="0" @if($Room->paymentMode == '0') selected="selected" @endif>--Select Payment Mode--</option>
                                                <option value="Pay-Full-Amount" @if($Room->paymentMode == 'Pay-Full-Amount') selected="selected" @endif>Pay Full Amount</option>
                                                <option value="Pay@Hotel" @if($Room->paymentMode == 'Pay@Hotel') selected="selected" @endif>Pay@Hotel</option>
                                                <option value="Pay-Partial-Amount+Pay@Hotel" @if($Room->paymentMode == 'Pay-Partial-Amount+Pay@Hotel') selected="selected" @endif>Pay Partial Amount + Pay@Hotel                                                    </option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <label class="col-md-2 control-label text-left">Tax Included</label>
                                            <div class="col-md-6">
                                              <select class="form-control" name="taxInclude">
                                                <option value="0" @if($Room->taxInclude == '0') selected="selected" @endif>--Select One--</option>
                                                <option value="Yes" @if($Room->taxInclude == 'Yes') selected="selected" @endif>Yes</option>
                                                <option value="No" @if($Room->taxInclude == 'No') selected="selected" @endif>No</option>

                                              </select>
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <label class="col-md-2 control-label text-left">Payment Type</label>
                                            <div class="col-md-6">
                                              <select class="form-control" name="paymentType">
                                                <option value="0" @if($Room->paymentType == '0') selected="selected" @endif>--Select Payment Type--</option>
                                                <option value="Refudnable" @if($Room->paymentType == 'Refudnable') selected="selected" @endif>Refudnable</option>
                                                <option value="Non-Refundable" @if($Room->paymentType == 'Non-Refundable') selected="selected" @endif>Non-Refundable</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Room Occupancy</h3>
                                            </div>
                                            <div class="panel-body">

                                                <div class="col-md-6">
                                                    <div class="row form-group">
                                                        <label class="col-md-3 control-label text-left">Adults (Base)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="roomOccBaseAdult">
                                                                <option value="0">Select Adults</option>
                                                                @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{$i}}" @if($Room->roomOccBaseAdult == $i) selected="selected" @endif>{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row form-group">
                                                        <label class="col-md-3 control-label text-left">Child (Base)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="roomOccBaseChild">
                                                                <option value="0">Select Child</option>
                                                                @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{$i}}" @if($Room->roomOccBaseChild == $i) selected="selected" @endif>{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row form-group">
                                                        <label class="col-md-3 control-label text-left">Adults (Max)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="roomOccMaxAdult">
                                                                <option value="0">Select Adults</option>
                                                                @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{$i}}" @if($Room->roomOccMaxAdult == $i) selected="selected" @endif>{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row form-group">
                                                        <label class="col-md-3 control-label text-left">Child (Max)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="roomOccMaxChild">
                                                                <option value="0">Select Child</option>
                                                                @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{$i}}" @if($Room->roomOccMaxChild == $i) selected="selected" @endif>{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row form-group">
                                                        <label class="col-md-3 control-label text-left">Infant (Max)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="roomOccMaxInfrant">
                                                                <option value="0">Select Infant</option>
                                                                @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{$i}}" @if($Room->roomOccMaxInfrant == $i) selected="selected" @endif>{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row form-group">
                                                        <label class="col-md-3 control-label text-left">Guest (Max)</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="roomOccMaxGuest">
                                                                <option value="0">Select Guests</option>
                                                                @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{$i}}" @if($Room->roomOccMaxGuest == $i) selected="selected" @endif>{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="col-md-12">
                                            <div class="checkbox_main">
                                                <input type="checkbox" name="">
                                                <label>Select All</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="Select_main">
                                                <ul>
                                                 @foreach($Roomsamenities as $key=>$r_amenities) 
                                                   <li data-id="{{$r_amenities->id}}">

                                                      <input type="checkbox" class="individual" value="{{$r_amenities->id}}" name="amenities[]"  {{in_array($r_amenities->id,$Room->amenities) ? 'checked' : '' }}> 

                                                     <i class="fa {{$r_amenities->icon}}" aria-hidden="true"></i>
                                                     <label>{{$r_amenities->name}}</label>
                                                   </li>
                                                 @endforeach 
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    {{--  <div class="tab-pane" id="tab3">
                                        <div class="col-md-6 form-group">
                                            <label class="col-md-4 control-label text-left">Day of Week</label>
                                            <div class="col-md-8">
                               
                                                
                                              <select  name="daysOfWeek[]" class="form-control select2" multiple="multiple" data-placeholder="Select Day Of Weeks" style="width: 100%;">
                                                    <option  value="Check_All_Days" @if(in_array('Check_All_Days',$Room->daysOfWeek)) selected="selected" @endif>Check All Days</option>
                                                    <option  value="Uncheck_All_Days" @if(in_array('Uncheck_All_Days',$Room->daysOfWeek)) selected="selected" @endif>Uncheck All Days</option>
                                                    <option  value="Monday" @if(in_array('Monday',$Room->daysOfWeek)) selected="selected" @endif>Monday</option>
                                                    <option  value="Tuesday" @if(in_array('Tuesday',$Room->daysOfWeek)) selected="selected" @endif>Tuesday</option>
                                                    <option  value="Wednesday" @if(in_array('Wednesday',$Room->daysOfWeek)) selected="selected" @endif>Wednesday</option>
                                                    <option  value="Thursday" @if(in_array('Thursday',$Room->daysOfWeek)) selected="selected" @endif>Thursday</option>
                                                    <option  value="Friday" @if(in_array('Friday',$Room->daysOfWeek)) selected="selected" @endif>Friday</option>
                                                    <option  value="Saturday" @if(in_array('Saturday',$Room->daysOfWeek)) selected="selected" @endif>Saturday</option>
                                                    <option  value="Sunday" @if(in_array('Sunday',$Room->daysOfWeek)) selected="selected" @endif>Sunday</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="col-md-6 form-group">
                                            <label class="col-md-4 control-label text-left">Stay Start Date</label>
                                            <div class='col-md-8'>
                                                <div class="form-group"> <!-- Date input -->
                                                  <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="stayStartDate" class="form-control pull-right datepicker" value="{{$Room->stayStartDate}}">
                                                  </div>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6 form-group">
                                            <label class="col-md-4 control-label text-left">Stay End Date</label>
                                            <div class='col-md-8'>
                                                <div class="form-group"> <!-- Date input -->
                                                  <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="stayEndDate" class="form-control pull-right datepicker" value="{{$Room->stayEndDate}}">
                                                  </div>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6 form-group">
                                            <label class="col-md-4 control-label text-left">Contract Type</label>
                                            <div class="col-md-8">
                                              <select class="form-control" name="ContractType">
                                                <option  value="0" @if($Room->ContractType == '0') selected="selected" @endif>(Select Contract Type)</option>
                                                <option  value="B2C" @if($Room->ContractType == 'B2C') selected="selected" @endif>B2C</option>
                                                <option  value="B2B" @if($Room->ContractType == 'B2B') selected="selected" @endif>B2B</option>
                                                <option  value="Mobile_App" @if($Room->ContractType == 'Mobile_App') selected="selected" @endif>Mobile App</option>
                                                <option  value="Corporate" @if($Room->ContractType == 'Corporate') selected="selected" @endif>Corporate</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-6 form-group">
                                            <label class="col-md-4 control-label text-left">Type of Rate</label>
                                            <div class="col-md-8">
                                              <select class="form-control" name="TypeOfRate">
                                                <option value="Sell_Rate" @if($Room->TypeOfRate == 'Sell_Rate') selected="selected" @endif>Sell Rate</option>
                                              </select>
                                            </div>
                                          </div>
                                          <h2>Rate Calculation</h2><hr>
                                          <div class="col-md-12">
                                            <div class="row">
                                              <div class="col-md-6 form-group">
                                                <label class="col-md-4 control-label text-left">Commission Offered (%)</label>
                                                <div class="col-md-8">
                                                  <input class="form-control default_commission" type="text" name="defaultCommission" value="{{$Room->defaultCommission}}" placeholder="%">
                                                </div>
                                              </div>
                                              <div class="col-md-6 form-group">
                                                <label class="col-md-4 control-label text-left">Overall Tax %</label>
                                                <div class="col-md-8">
                                                  <input class="form-control default_tax" type="text" name="defaultTax" value="{{$Room->defaultTax}}" placeholder="%">
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 form-group">
                                            <label class="col-md-2 control-label text-left"> Declared Rate:</label>
                                            <div class="col-md-10">
                                              <div class="col-md-4">
                                                <label style="text-align: center;">Single Rate </label>
                                                <input type="text" placeholder="Single Rate" name="Declared[single]" class="form-control" value="{{$Room->Declared['single']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <label style="text-align: center;">Double Rate  </label>
                                                <input type="text" placeholder="Double Rate" name="Declared[double]" class="form-control" value="{{$Room->Declared['double']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <label style="text-align: center;">Triple Rate </label>
                                                <input type="text" placeholder="Triple Rate" name="Declared[triple]" class="form-control" value="{{$Room->Declared['triple']}}">
                                              </div>
                                            </div>
                                          </div>
                                          
                                          <div class="col-md-12 form-group">
                                            <label class="col-md-2 control-label text-left"> Sell Rate:</label>
                                            <div class="col-md-10">
                                              <div class="col-md-4">
                                                <input type="text" placeholder="Single Rate" name="Sell[single]" class="form-control Single" value="{{$Room->Sell['single']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" placeholder="Double Rate" name="Sell[double]" class="form-control Double" value="{{$Room->Sell['double']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" placeholder="Triple Rate" name="Sell[triple]" class="form-control Triple" value="{{$Room->Sell['triple']}}">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 form-group">
                                            <label class="col-md-2 control-label text-left"> Commission (%):</label>
                                            <div class="col-md-10">
                                              <div class="col-md-4">
                                                <input type="text" placeholder="%" name="sellCommission[single]" class="form-control sellCommissionSingle" value="{{$Room->sellCommission['single']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" placeholder="%" name="sellCommission[double]" class="form-control sellCommissionDouble" value="{{$Room->sellCommission['double']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" placeholder="%" name="sellCommission[triple]" class="form-control sellCommissionTriple" value="{{$Room->sellCommission['triple']}}">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 form-group">
                                            <label class="col-md-2 control-label text-left"> Net Rate:</label>
                                            <div class="col-md-10">
                                              <div class="col-md-4">
                                                <input type="text" placeholder="" name="Net[single]" class="form-control discountSingle" readonly="readonly" value="{{$Room->Net['single']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" placeholder="" name="Net[double]" class="form-control discountDouble" readonly="readonly" value="{{$Room->Net['double']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" placeholder="" name="Net[triple]" class="form-control discountTriple" readonly="readonly" value="{{$Room->Net['triple']}}">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 form-group">
                                            <label class="col-md-2 control-label text-left"> Extra Charges:</label>
                                            <div class="col-md-10">
                                              <div class="col-md-4">
                                                <label style="text-align: center;">Extra Adult Charges  </label>
                                                <input type="text" placeholder="Extra Adult" name="ExtraCharge[adult]" class="form-control Extra_Adult" value="{{$Room->ExtraCharge['adult']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <label style="text-align: center;">Extra child Charges (Age 6 - 12 years)</label>
                                                <input type="text" placeholder="Extra Child" name="ExtraCharge[child]" class="form-control Extra_Child" value="{{$Room->ExtraCharge['child']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <label style="text-align: center;">Infant Charges (Below 6 years)</label>
                                                <input type="text" placeholder="Extra Infant" name="ExtraCharge[infrant]" class="form-control Extra_Infant" value="{{$Room->ExtraCharge['infrant']}}">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 form-group">
                                            <label class="col-md-2 control-label text-left"> Commission (%):</label>
                                            <div class="col-md-10">
                                              <div class="col-md-4">
                                                <input type="text" placeholder="%" name="extraCommission[single]" class="form-control extraCommissionAdult" value="{{$Room->extraCommission['single']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" placeholder="%" name="extraCommission[double]" class="form-control extraCommissionChild" value="{{$Room->extraCommission['double']}}">
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" placeholder="%" name="extraCommission[triple]" class="form-control extraCommissionInfrant" value="{{$Room->extraCommission['triple']}}">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 form-group">
                                            <label class="col-md-2 control-label text-left"> Net Extra Charges:</label>
                                            <div class="col-md-10">
                                              <div class="col-md-4">
                                                
                                                <input type="text" placeholder="" name="NettExtraCharge[adult]" class="form-control Nett_Extra_Adult" readonly="readonly" value="{{$Room->NettExtraCharge['adult']}}">
                                                <label style="text-align: center;">Net Extra Adult Charges </label>
                                              </div>
                                              <div class="col-md-4">
                                                
                                                <input type="text" placeholder="" name="NettExtraCharge[child]" class="form-control Nett_Extra_Child" readonly="readonly" value="{{$Room->NettExtraCharge['child']}}">
                                                <label style="text-align: center;">Net Extra child Charges (Age 6 - 12 years)</label>
                                              </div>
                                              <div class="col-md-4">
                                                
                                                <input type="text" placeholder="" name="NettExtraCharge[infrant]" class="form-control Nett_Extra_Infant" readonly="readonly" value="{{$Room->NettExtraCharge['infrant']}}">
                                                <label style="text-align: center;">Net Infant Charges (Below 6 years)</label>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 col-md-offset-3 form-group">
                                            <input class="btn btn-primary Calculate" value="Calculate net price" type="button">
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="panel-footer">
                                            <button type="submit" class="btn btn-primary submitfrm" id="addRate">Update Rates</button>
                                          </div>
                                    </div>  --}}
                                    <div class="tab-pane" id="tab4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="row">
                                                  <div class="col-md-12 form-group">
                                                    <label class="col-md-3 control-label text-left">Free Cancellation On or Before</label>
                                                    <div class="col-md-3">
                                                      <input class="form-control Free_Cancellation_on" type="text" name="free_Cancellation_on" placeholder="Days from Check-in Date" value="{{$Room->free_Cancellation_on}}">
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h2 style="text-align:center;">-- OR --</h2>
                                            </div>
                                            <div class="col-md-12">
                                                <!-- <span data-toggle="collapse" class="btn btn-info" data-target="#demo">Create New Policy</span> -->
                                                
                                                <input type="hidden" class="countPolicy" value="{{count($Room->policy)}}">
                                                <!-- <div id="demo" class="collapse"> -->
                                                    
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dynamic_field" style="margin-top: 15px;">
                                                        {{--  <button type="button" name="add" id="add" class="btn btn-success" style="float:right;">Add More Policy</button>  --}}
                                                            @for ($i = 1; $i < 11; $i++)
                                                               
                                                            
                                                            <tr id="row{{$i}}">
                                                                <td>
                                                                    <div class="form-group">                                                                            
                                                                        <div class="col-md-12">
                                                                            <label class="">Percentage Or Days</label>
                                                                            <input class="form-control policy_percentege" type="text" name="policy[p{{$i}}][policy_percentege]" value="{{$Room->policy['p'.$i]['policy_percentege']}}" placeholder="Percentage Or Days">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">                                                                            
                                                                        <div class="col-md-12">
                                                                            <label class="">Night / Percentage</label>
                                                                            <select class="form-control" name="policy[p{{$i}}][selectFor]">
                                                                                <option value="0" @if($Room->policy['p'.$i]['selectFor'] == '0') selected="selected" @endif>Select</option>
                                                                                <option value="Night" @if($Room->policy['p'.$i]['selectFor'] == 'Night') selected="selected" @endif>Night</option>
                                                                                <option value="Percentage" @if($Room->policy['p'.$i]['selectFor'] == 'Percentage') selected="selected" @endif>Percentage</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">                                                                            
                                                                        <div class="col-md-12">
                                                                            <label class="">If Cancelled from </label>
                                                                            <select class="form-control" name="policy[p{{$i}}][cancelledFrom]">
                                                                                <option value="0" @if($Room->policy['p'.$i]['cancelledFrom'] == '0') selected="selected" @endif>Select</option>
                                                                                <option value="240" @if($Room->policy['p'.$i]['cancelledFrom'] == '240') selected="selected" @endif>240</option>
                                                                                <option value="216" @if($Room->policy['p'.$i]['cancelledFrom'] == '216') selected="selected" @endif>216</option>
                                                                                <option value="168" @if($Room->policy['p'.$i]['cancelledFrom'] == '168') selected="selected" @endif>168</option>
                                                                                <option value="144" @if($Room->policy['p'.$i]['cancelledFrom'] == '144') selected="selected" @endif>144</option>
                                                                                <option value="120" @if($Room->policy['p'.$i]['cancelledFrom'] == '120') selected="selected" @endif>120</option>
                                                                                <option value="96" @if($Room->policy['p'.$i]['cancelledFrom'] == '96') selected="selected" @endif>96</option>
                                                                                <option value="72" @if($Room->policy['p'.$i]['cancelledFrom'] == '72') selected="selected" @endif>72</option>
                                                                                <option value="48" @if($Room->policy['p'.$i]['cancelledFrom'] == '48') selected="selected" @endif>48</option>
                                                                                <option value="24" @if($Room->policy['p'.$i]['cancelledFrom'] == '24') selected="selected" @endif>24</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">                                                                            
                                                                        <div class="col-md-12">
                                                                            <label class="">If Cancelled To </label>
                                                                            <select class="form-control" name="policy[p{{$i}}][cancelledTo]">
                                                                                <option value="0" @if($Room->policy['p'.$i]['cancelledTo'] == '0') selected="selected" @endif>Select</option>
                                                                                <option value="240" @if($Room->policy['p'.$i]['cancelledTo'] == '240') selected="selected" @endif>240</option>
                                                                                <option value="216" @if($Room->policy['p'.$i]['cancelledTo'] == '216') selected="selected" @endif>216</option>
                                                                                <option value="168" @if($Room->policy['p'.$i]['cancelledTo'] == '168') selected="selected" @endif>168</option>
                                                                                <option value="144" @if($Room->policy['p'.$i]['cancelledTo'] == '144') selected="selected" @endif>144</option>
                                                                                <option value="120" @if($Room->policy['p'.$i]['cancelledTo'] == '120') selected="selected" @endif>120</option>
                                                                                <option value="96" @if($Room->policy['p'.$i]['cancelledTo'] == '96') selected="selected" @endif>96</option>
                                                                                <option value="72" @if($Room->policy['p'.$i]['cancelledTo'] == '72') selected="selected" @endif>72</option>
                                                                                <option value="48" @if($Room->policy['p'.$i]['cancelledTo'] == '48') selected="selected" @endif>48</option>
                                                                                <option value="24" @if($Room->policy['p'.$i]['cancelledTo'] == '24') selected="selected" @endif>24</option>
                                                                                <option value="0" @if($Room->policy['p'.$i]['cancelledTo'] == '0') selected="selected" @endif>0</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                {{--  <button type="button" name="remove" id="{{$i}}" class="btn btn-danger btn_remove">X</button></td>  --}}
                                                            </tr>
                                                            @endfor
                                                        </table>
                                                    </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                    @php
                                                        $fieldCheckIn = array();
                                                        $array = array();
                                                    @endphp
                                                    {{--  {{dump($RoomBooking)}}  --}}
                                                    @foreach($RoomBooking as $key=>$booking)
                                                        @php 
                                                            $fieldCheckIn['roomId']=$booking->roomId;
                                                            $fieldCheckIn['date']=$booking->checkInDate;
                                                            $fieldCheckIn['rooms']=$booking->noOfBookedRooms;
                                                            $fieldCheckIn['totalRooms']=CustomHelpers::getTableRecordById($booking->roomId,'rt_rooms','noOfRooms');
                                                            $array[]= $fieldCheckIn;
                                                        @endphp
                                                      @endforeach
                                                    @php 
                                                    $result = array();
                                                    foreach ($array as $val) {
                                                        if (!isset($result[$val['date']]))
                                                            $result[$val['date']] = $val;
                                                        else
                                                            $result[$val['date']]['rooms'] += $val['rooms'];
                                                    }
                                                    $result = array_values($result); // reindex array
                                                    @endphp
                                                <table id="example1" class="table table-bordered table-striped example1 ">
                                                <thead>
                                                    <tr>
                                                        <th>Booked Date</th>
                                                        <th>Booked Rooms</th>
                                                        <th>Remaining Rooms</th>
                                                        <th>Customer Name / Booking Ref No.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($result as $booking)
                                                        <tr>
                                                            <td><b>{{ date('d-M-Y',strtotime($booking['date'])) }}</b></td>
                                                            <td><b>{{$booking['rooms']}}</b> Rooms</td>
                                                            <td><b>{{$booking['totalRooms'] - $booking['rooms']}}</b> Rooms</td>
                                                            <td>
                                                            @php
                                                            $CustDetail = CustomHelpers::getCustomerInRoomInventory($booking['date'],$booking['roomId']);
                                                            @endphp
                                                            @foreach($CustDetail as $key=>$cd)
                                                                <b>Customer Name {{++$key}} :</b> {{$cd->cca_billingName}}<br>
                                                                <b>Booking Ref No. :</b> 
                                                                <a target="_blank" href="{{ URL::to('/viewBooking/'.$cd->id) }}">{{$cd->cca_order_id}}</a>
                                                                <br><br>
                                                            @endforeach
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Booked Date</th>
                                                        <th>Booked Rooms Booked</th>
                                                        <th>Remaining Rooms</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                          </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary submitfrm" id="add">Submit</button>
                    </div>
                </div>

            </div>
    </div>
</form>
</section>
    
@endsection
