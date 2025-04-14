@extends('layouts.master')
@section('content')
<div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
            <form action="{{url('/storeRooms')}}" method="post">
              {{csrf_field()}}
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
                                                    <input class="form-control" type="text" name="roomTypeName" placeholder="Deluxe etc">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Assigned Hotel Name</label>
                                                <div class="col-md-6">
                                                    <select data-placeholder="Select" class="form-control" name="assignedHotelname">
                                                        <option value="0">Select Hotel Name</option>
                                                    @foreach($hotels as $key=>$hotel) 
                                                        <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Status</label>
                                                <div class="col-md-6">
                                                    <select data-placeholder="Select" class="form-control" name="hotelstatus">
                                                        <option value="Yes">Enabled</option>
                                                        <option value="No">Disabled</option>
                                                    </select>
                                                </div>
                                            </div>

                                            

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Room Description</label>
                                                <div class="col-md-6">                                                    
                                                        <textarea name="roomDescription" rows="10" cols="71"></textarea>                                                    
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Room Size (L x B)</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="roomSize" placeholder="Length">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">No of Rooms</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" name="noOfRooms" placeholder="No of Rooms We Can Book">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Bed Type</label>
                                                <div class="col-md-6">

                                                    <select name="bedType" class="form-control" style="height: 35px; width: 100%;">
                                                        <option value="0">Select Bed Type</option>
                                                        <option value="Twin">Twin</option>
                                                        <option value="King">King</option>
                                                        <option value="Queen">Queen</option>
                                                        <option value="Double">Double</option>
                                                        <option value="Single">Single</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Room View</label>
                                                <div class="col-md-6">

                                                    <select name="roomView" class="form-control" style="height: 35px; width: 100%;">
                                                            <option value="0">Select Room View</option>
                                                            @foreach($RoomViews as $key=>$rv)
                                                                <option value="{{$rv->id}}">{{$rv->name}}</option>
                                                            @endforeach 
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Extra Bed Type</label>
                                                <div class="col-md-6">

                                                    <select name="extraBedType" class="form-control" style="height: 35px; width: 100%;">
                                                        <option value="0">Select Extra Bed Type</option>
                                                        <option value="No_Extra_Bed">No Extra Bed</option>
                                                        <option value="Mattress">Mattress</option>
                                                        <option value="Cot">Cot</option>
                                                        <option value="Sofa_cum_bed">Sofa cum bed</option>
                                                    </select>
                                                </div>
                                            </div>

                                            

                                            
                                            
                                            <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Meal Plan</label>
                                                <div class="col-md-6">
                                                  <select class="form-control" name="mealPlan">
                                                    <option value="0">--Select Meal Plan--</option>
                                                    <option value="Accommodation-Only">Accommodation-Only</option>
                                                    <option value="Free-Breakfast">Free-Breakfast</option>
                                                    <option value="Free-Breakfast-and-Dinner">Free-Breakfast-and-Dinner</option>
                                                    <option value="Free-Cooked-Breakfast">Free-Cooked-Breakfast</option>

                                                  </select>
                                                </div>
                                              </div>
                                              <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Payment Mode</label>
                                                <div class="col-md-6">
                                                  <select class="form-control" name="paymentMode">
                                                    <option value="0">--Select Payment Mode--</option>

                                                    <option value="Pay-Full-Amount">Pay Full Amount</option>
                                                    <option value="Pay@Hotel">Pay@Hotel</option>
                                                    <option value="Pay-Partial-Amount+Pay@Hotel">Pay Partial Amount + Pay@Hotel                                                    </option>
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Tax Included</label>
                                                <div class="col-md-6">
                                                  <select class="form-control" name="taxInclude">
                                                    <option value="0">--Select One--</option>

                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>

                                                  </select>
                                                </div>
                                              </div>
                                              <div class="row form-group">
                                                <label class="col-md-2 control-label text-left">Payment Type</label>
                                                <div class="col-md-6">
                                                  <select class="form-control" name="paymentType">
                                                    <option value="0">--Select Payment Type--</option>

                                                    <option value="Refudnable">Refudnable</option>
                                                    <option value="Non-Refundable">Non-Refundable</option>
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
                                                                    <option value="{{$i}}">{{$i}}</option>
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
                                                                    <option value="{{$i}}">{{$i}}</option>
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
                                                                    <option value="{{$i}}">{{$i}}</option>
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
                                                                    <option value="{{$i}}">{{$i}}</option>
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
                                                                    <option value="{{$i}}">{{$i}}</option>
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
                                                                    <option value="{{$i}}">{{$i}}</option>
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

                                                          <input type="checkbox" class="individual" value="{{$r_amenities->id}}" name="amenities[]"> 

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
                                                        <option  value="Check_All_Days">Check All Days</option>
                                                        <option  value="Uncheck_All_Days">Uncheck All Days</option>
                                                        <option  value="Monday">Monday</option>
                                                        <option  value="Tuesday">Tuesday</option>
                                                        <option  value="Wednesday">Wednesday</option>
                                                        <option  value="Thursday">Thursday</option>
                                                        <option  value="Friday">Friday</option>
                                                        <option  value="Saturday">Saturday</option>
                                                        <option  value="Sunday">Sunday</option>
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
                                                        <input type="text" name="stayStartDate" class="form-control pull-right datepicker" data-fillr-id="115545" data-fillr="bound" autocomplete="off">
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
                                                        <input type="text" name="stayEndDate" class="form-control pull-right datepicker" data-fillr-id="115545" data-fillr="bound" autocomplete="off">
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6 form-group">
                                                <label class="col-md-4 control-label text-left">Contract Type</label>
                                                <div class="col-md-8">
                                                  <select class="form-control" name="ContractType">
                                                    <option  value="0">(Select Contract Type)</option>
                                                    <option  value="B2C">B2C</option>
                                                    <option  value="B2B">B2B</option>
                                                    <option  value="Mobile_App">Mobile App</option>
                                                    <option  value="Corporate">Corporate</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="col-md-6 form-group">
                                                <label class="col-md-4 control-label text-left">Type of Rate</label>
                                                <div class="col-md-8">
                                                  <select class="form-control" name="TypeOfRate">
                                                    <option value="Sell_Rate">Sell Rate</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <h2>Rate Calculation</h2><hr>
                                              <div class="col-md-12">
                                                <div class="row">
                                                  <div class="col-md-6 form-group">
                                                    <label class="col-md-4 control-label text-left">Commission Offered (%)</label>
                                                    <div class="col-md-8">
                                                      <input class="form-control default_commission" type="text" name="defaultCommission" value="10" placeholder="%">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6 form-group">
                                                    <label class="col-md-4 control-label text-left">Overall Tax %</label>
                                                    <div class="col-md-8">
                                                      <input class="form-control default_tax" type="text" name="defaultTax" value="10" placeholder="%">
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-12 form-group">
                                                <label class="col-md-2 control-label text-left"> Declared Rate:</label>
                                                <div class="col-md-10">
                                                  <div class="col-md-4">
                                                    <label style="text-align: center;">Single Rate </label>
                                                    <input type="text" placeholder="Single Rate" name="Declared[single]" class="form-control">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <label style="text-align: center;">Double Rate  </label>
                                                    <input type="text" placeholder="Double Rate" name="Declared[double]" class="form-control">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <label style="text-align: center;">Triple Rate </label>
                                                    <input type="text" placeholder="Triple Rate" name="Declared[triple]" class="form-control">
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              <div class="col-md-12 form-group">
                                                <label class="col-md-2 control-label text-left"> Sell Rate:</label>
                                                <div class="col-md-10">
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="Single Rate" name="Sell[single]" class="form-control Single">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="Double Rate" name="Sell[double]" class="form-control Double">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="Triple Rate" name="Sell[triple]" class="form-control Triple">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-12 form-group">
                                                <label class="col-md-2 control-label text-left"> Commission (%):</label>
                                                <div class="col-md-10">
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="%" name="sellCommission[single]" class="form-control sellCommissionSingle" value="10">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="%" name="sellCommission[double]" class="form-control sellCommissionDouble" value="10">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="%" name="sellCommission[triple]" class="form-control sellCommissionTriple" value="10">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-12 form-group">
                                                <label class="col-md-2 control-label text-left"> Net Rate:</label>
                                                <div class="col-md-10">
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="" name="Net[single]" class="form-control discountSingle" readonly="readonly">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="" name="Net[double]" class="form-control discountDouble" readonly="readonly">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="" name="Net[triple]" class="form-control discountTriple" readonly="readonly">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-12 form-group">
                                                <label class="col-md-2 control-label text-left"> Extra Charges:</label>
                                                <div class="col-md-10">
                                                  <div class="col-md-4">
                                                    <label style="text-align: center;">Extra Adult Charges  </label>
                                                    <input type="text" placeholder="Extra Adult" name="ExtraCharge[adult]" class="form-control Extra_Adult">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <label style="text-align: center;">Extra child Charges (Age 6 - 12 years)</label>
                                                    <input type="text" placeholder="Extra Child" name="ExtraCharge[child]" class="form-control Extra_Child">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <label style="text-align: center;">Infant Charges (Below 6 years)</label>
                                                    <input type="text" placeholder="Extra Infant" name="ExtraCharge[infrant]" class="form-control Extra_Infant">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-12 form-group">
                                                <label class="col-md-2 control-label text-left"> Commission (%):</label>
                                                <div class="col-md-10">
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="%" name="extraCommission[single]" class="form-control extraCommissionAdult" value="10">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="%" name="extraCommission[double]" class="form-control extraCommissionChild" value="10">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <input type="text" placeholder="%" name="extraCommission[triple]" class="form-control extraCommissionInfrant" value="10">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-12 form-group">
                                                <label class="col-md-2 control-label text-left"> Net Extra Charges:</label>
                                                <div class="col-md-10">
                                                  <div class="col-md-4">
                                                    
                                                    <input type="text" placeholder="" name="NettExtraCharge[adult]" class="form-control Nett_Extra_Adult" readonly="readonly">
                                                    <label style="text-align: center;">Net Extra Adult Charges </label>
                                                  </div>
                                                  <div class="col-md-4">
                                                    
                                                    <input type="text" placeholder="" name="NettExtraCharge[child]" class="form-control Nett_Extra_Child" readonly="readonly">
                                                    <label style="text-align: center;">Net Extra child Charges (Age 6 - 12 years)</label>
                                                  </div>
                                                  <div class="col-md-4">
                                                    
                                                    <input type="text" placeholder="" name="NettExtraCharge[infrant]" class="form-control Nett_Extra_Infant" readonly="readonly">
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
                                                          <input class="form-control Free_Cancellation_on" type="text" name="free_Cancellation_on" placeholder="Days from Check-in Date">
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h2 style="text-align:center;">-- OR --</h2>
                                                </div>
                                                <div class="col-md-12">
                                                    <span data-toggle="collapse" class="btn btn-info" data-target="#demo">Create New Policy</span>
                                                    <div id="demo" class="">
                                                    <input type="hidden" class="countPolicy" value="1">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="dynamic_field" style="margin-top: 15px;">
                                                            {{--  <button type="button" name="add" id="add" class="btn btn-success" style="float:right;">Add More Policy</button>  --}}
                                                            @for ($i = 1; $i < 11; $i++)
                                                               
                                                            
                                                            <tr id="row{{$i}}">
                                                                <td>
                                                                    <div class="form-group">                                                                            
                                                                        <div class="col-md-12">
                                                                            <label class="">Percentage Or Days</label>
                                                                            <input class="form-control policy_percentege" type="text" name="policy[p{{$i}}][policy_percentege]" value="" placeholder="Percentage Or Days">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">                                                                            
                                                                        <div class="col-md-12">
                                                                            <label class="">Night / Percentage</label>
                                                                            <select class="form-control" name="policy[p{{$i}}][selectFor]">
                                                                                <option value="0">Select</option>
                                                                                <option value="Night">Night</option>
                                                                                <option value="Percentage">Percentage</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">                                                                            
                                                                        <div class="col-md-12">
                                                                            <label class="">If Cancelled from </label>
                                                                            <select class="form-control" name="policy[p{{$i}}][cancelledFrom]">
                                                                                <option value="0">Select</option>
                                                                                <option value="240" >240</option>
                                                                                <option value="216" >216</option>
                                                                                <option value="168" >168</option>
                                                                                <option value="144" >144</option>
                                                                                <option value="120" >120</option>
                                                                                <option value="96" >96</option>
                                                                                <option value="72" >72</option>
                                                                                <option value="48" >48</option>
                                                                                <option value="24" >24</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">                                                                            
                                                                        <div class="col-md-12">
                                                                            <label class="">If Cancelled To </label>
                                                                            <select class="form-control" name="policy[p{{$i}}][cancelledTo]">
                                                                            <option value="0" >Select</option>
                                                                            <option value="240" >240</option>
                                                                            <option value="216" >216</option>
                                                                            <option value="168" >168</option>
                                                                            <option value="144" >144</option>
                                                                            <option value="120" >120</option>
                                                                            <option value="96" >96</option>
                                                                            <option value="72" >72</option>
                                                                            <option value="48" >48</option>
                                                                            <option value="24" >24</option>
                                                                            <option value="0" >0</option>
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
                                                    </div>
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
