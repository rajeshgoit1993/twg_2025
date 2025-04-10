@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--  {{dump($hotelDetail)}}  --}}
        
            <div class="panel panel-default">
                    <form action="{{url('/addHotel')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$hotelDetail->id }}">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <ul class="nav nav-tabs">
                           <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
                           <li><a href="#tab2" data-toggle="tab">Facilities</a></li>
                           <li><a href="#tab3" data-toggle="tab">Addresses</a></li>
                           <li><a href="#tab4" data-toggle="tab">Policy</a></li>
                           <li><a href="#tab5" data-toggle="tab">Contact</a></li>
                           <li><a href="#tab6" data-toggle="tab">Taxes</a></li>
                           <li><a href="#tab7" data-toggle="tab">Rooms</a></li>
                        </ul>
                     </h3>
                  </div>
                  
                  <div class="panel-body">
                     <div class="tabbable">
                        <div class="tab-content">
							<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                                 <p>Hotel updated Successfully.</p>
                              </div>
                              <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                                <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul> 
                              </div>
                           <div class="tab-pane active" id="tab1">
                              
                              
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Hotel Name</label>
                                 <div class="col-md-4">
                                    <input name="hotelName" placeholder="Hotel Name" class="form-control" value="{{$hotelDetail->name}}" type="text">
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Hotel Description</label>
                                 <div class="col-md-4">
                                          <textarea id="editor1" name="hotelDesc"  rows="2" cols="80" >{{$hotelDetail->description}}
                                          </textarea>
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Star Rating</label>
                                 <div class="col-md-2">
                                    <select data-placeholder="Select" class="form-control" name="hotelStars">
                                       <option value="1" {{$hotelDetail->stars == 1 ? 'selected' : '' }}> 1</option>
                                       <option value="2" {{$hotelDetail->stars == 2 ? 'selected' : '' }}> 2</option>
                                       <option value="3" {{$hotelDetail->stars == 3 ? 'selected' : '' }}> 3</option>
                                       <option value="4" {{$hotelDetail->stars == 4 ? 'selected' : '' }}> 4</option>
                                       <option value="5" {{$hotelDetail->stars == 5 ? 'selected' : '' }}> 5</option>
                                       <option value="6" {{$hotelDetail->stars == 6 ? 'selected' : '' }}> 6</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Hotel Type</label>
                                 <div class="col-md-2">
                                    <select data-placeholder="Select" class="form-control" name="hotelType">

                                    	@foreach($hotelTypes as $key=>$htype) 
	                                         <option value="{{$htype->id}}" {{$hotelDetail->hotel_type == $htype->id ? 'selected' : '' }}>{{$htype->name}}</option>
	                                     @endforeach
                                     

                                    </select>
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Featured</label>
                                 <div class="col-md-2">
                                    <select data-placeholder="Select" class="form-control" name="hotelisfeatured">
                                       <option value="1" {{$hotelDetail->featured == 1 ? 'selected' : '' }}>Yes</option>
                                       <option value="0" {{$hotelDetail->featured == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                 </div>
                              </div>
                              
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Hotel Chain</label>
                                 <div class="col-md-4">
                                    <div>
                                    	
                                       	<select  name="reltatedHotels[]" class="form-control select2" multiple="multiple" data-placeholder="Select Related Hotels" style="width: 100%;">
                                       	@foreach($hotels as $key=>$hotel) 
                                          <option value="{{$hotel->id}}"  {{in_array($hotel->id,$hotelDetail->hotel_group) ? 'selected' : '' }}>{{$hotel->name}}</option>
                                          @endforeach
                                    	</select>


                                       
                                    </div>
                                 </div>
                              </div>
                              <div class="row form-group">
                                  <label class="col-md-2 control-label text-left">Status</label>
                                  <div class="col-md-2">
                                     <select data-placeholder="Select" class="form-control" name="hotelStatus">
                                        <option value="1" {{$hotelDetail->status == 1 ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{$hotelDetail->status == 0 ? 'selected' : '' }}>Disabled</option>
                                     </select>
                                  </div>
                               </div>
                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h3 class="panel-title">Map Address</h3>
                                 </div>
                                 <div class="panel-body" style="background-color:#F5F5F5">
                                    <div class="col-md-6">
                                       <div class="row form-group">
                                          <label class="col-md-12 control-label text-left">Address on Map</label>
                                          <div class="col-md-12">
                                             <input type="text" name="hotelAddress" class="form-control" id="location" value="{{$hotelDetail->map_address}}" readonly="readonly">
                                             <!-- <input type="hidden" name="" value="{{$hotelDetail->map_lat}}" id="editlat">
                                             <input type="hidden" name="" value="{{$hotelDetail->map_long}}" id="editlng"> -->
                                          </div>
                                       </div>
                                       <div class="row form-group">
                                          <label class="col-md-12 control-label text-left">Latitude</label>
                                          <div class="col-md-12">
                                             <input type="text" name="hotelLat" class="form-control" id="lat" value="{{$hotelDetail->map_lat}}" readonly="readonly">
                                          </div>
                                       </div>
                                       <div class="row form-group">
                                          <label class="col-md-12 control-label text-left">Longitude</label>
                                          <div class="col-md-12">
                                             <input type="text" name="hotelLang" class="form-control" id="lng" value="{{$hotelDetail->map_long}}" readonly="readonly" >
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <input id="searchInput" style="width: 60%;    margin-top: 7px;" class="form-control" type="text" placeholder="Enter a location">
                                       <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                           <div class="tab-pane" id="tab2">
                              <div class="add">
                                  <a target="_blank" href="{{{URL::to('/hotel-settings')}}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Facilities</a>
                                </div>
                              
                              <div class="col-md-12">
                                 <div class="checkbox_main">
                                    <input type="checkbox" class="selectall" name=""> <label>Select All</label>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="Select_main">
                                    <ul>
                                        @foreach($hotelAmenities as $key=>$r_amenities) 
                                        <li data-id="{{$r_amenities->id}}">
                                            <input type="checkbox" class="individual" value="{{$r_amenities->id}}" name="amenities[]"  {{in_array($r_amenities->id,$hotelDetail->facilities) ? 'checked' : '' }}> 
                                            <i class="fa {{$r_amenities->icon}}" aria-hidden="true"></i>
                                            <label>{{$r_amenities->name}}</label>
                                        </li>
                                        @endforeach 
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="tab3">
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Nearest Points</label>
                                 <div class="col-md-6">
                                    <textarea name="nearest_point" placeholder="Nearest Points" class="form-control" id="" cols="30" rows="4">{{$hotelDetail->nearest_point}}</textarea>
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Continent</label>
                                 <div class="col-md-4">
                                    <select name="Continent" class="form-control" data-placeholder="Select Continent" style="width: 100%;" id="Continent">
                                       <option value="AS" {{$hotelDetail->continent == 'Asia' ? 'selected' : '' }}>Asia</option>
                                       <option value="AF" {{$hotelDetail->continent == 'Africa' ? 'selected' : '' }}>Africa</option>
                                       <option value="AN" {{$hotelDetail->continent == 'Antarctica' ? 'selected' : '' }}>Antarctica</option>
                                       <option value="OC" {{$hotelDetail->continent == 'Australia' ? 'selected' : '' }}>Australia</option>
                                       <option value="EU" {{$hotelDetail->continent == 'Europe' ? 'selected' : '' }}>Europe</option>
                                       <option value="NA" {{$hotelDetail->continent == 'North_America' ? 'selected' : '' }}>North America</option>
                                       <option value="SA" {{$hotelDetail->continent == 'South_America' ? 'selected' : '' }}>South America</option>
                                        
                                    </select>
                                 </div>
                              </div>
                              <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Country / State / City</label>
                                 <div class="col-md-2">
                                   <select name="Country" class="form-control" data-placeholder="Select Country" style="width: 100%;" id="Country">
                                        <option value="{{$hotelDetail->country}}">
                                            {{CustomHelpers::getTableRecordById($hotelDetail->country,'regions','country')}}  
                                        </option>   
                                  </select>
                                </div>
                                <div class="col-md-2">
                                   
                                   <select name="State" class="form-control" data-placeholder="Select State" style="width: 100%;" id="State">
                                        <option value="{{$hotelDetail->state}}">
                                                {{CustomHelpers::getTableRecordById($hotelDetail->state,'subregions','name')}}  
                                            </option>   
                                     
                                  </select>
                                </div>
                                <div class="col-md-2">
                                   <input name="City" placeholder="City" class="form-control" value="{{$hotelDetail->city}}" type="text">
                                </div>
                             </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Zip Code</label>
                                 <div class="col-md-4">
                                    <input name="Zip" placeholder="Zip Code" class="form-control" value="{{$hotelDetail->zip_code}}" type="text">
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Area Code</label>
                                 <div class="col-md-4">
                                    <input name="AreaCode" placeholder="Area Code" class="form-control" value="{{$hotelDetail->isd_code}}" type="text">
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="tab4">
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Check In</label>
                                 <div class="col-md-2 bootstrap-timepicker">
                                    <div class="input-group">
                                      <input name="checkInTime" type="text" value="{{$hotelDetail->check_in}}" class="form-control timepicker">

                                      <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                      </div>
                                    </div>
                                 </div>
                                 <label class="col-md-2 control-label text-left">Check Out</label>
                                 <div class="col-md-2 bootstrap-timepicker">
                                    <div class="input-group">
                                      <input name="checkOutTime" type="text" value="{{$hotelDetail->check_out}}" class="form-control timepicker">

                                      <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                      </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Payment Options</label>
                                 <div class="col-md-6">
                                    <select name="paymentOption[]" class="form-control select2" multiple="multiple" data-placeholder="Select Payments Options" style="width: 100%;">
						
                                    	@foreach($HotelPaymentMethod as $key=>$htype) 
                                          <option value="{{$htype->id}}"  {{in_array($htype->id,$hotelDetail->paymentOption) ? 'selected' : '' }}>{{$htype->name}}</option>
                                       @endforeach                                       
                                    </select>

                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Policy And Terms</label>
                                 <div class="col-md-8">
                                    <textarea name="policy" placeholder="Policy..." class="form-control" rows="7">{{$hotelDetail->policy}}</textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="tab5">
                              
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Hotel's Email</label>
                                 <div class="col-md-4">
                                    <input name="hotelemail" placeholder="Email" class="form-control " value="{{$hotelDetail->email_id}}" type="text">
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Hotel's Website</label>
                                 <div class="col-md-4">
                                    <input name="hotelwebsite" placeholder="Website" class="form-control " value="{{$hotelDetail->website}}" type="text">
                                 </div>
                              </div>
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">ISD Code</label>
                                 <div class="col-md-4">
                                    <input name="isd" placeholder="ISD Code" class="form-control " value="{{$hotelDetail->isd_code}}" type="text">
                                 </div>
                              </div>
                              
                              <div class="row form-group">
                                 <label class="col-md-2 control-label text-left">Phone</label>
                                 <div class="col-md-4">
                                    <input name="hotelphone" placeholder="Phone" class="form-control" value="{{$hotelDetail->contact_no}}" type="text">
                                 </div>
                              </div>
                              <hr>
                             <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Bank Name</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="bankName" placeholder="Bank Name" value="{{$hotelDetail->bankName}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Bank Account Name</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="bankAcName" placeholder="Bank Account Name" value="{{$hotelDetail->bankAcName}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Account Number</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="acNumber" placeholder="Account Number" value="{{$hotelDetail->acNumber}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Branch Name & Address</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="branchName" placeholder="Branch Name & Address" value="{{$hotelDetail->branchName}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Branch Code</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="branchCode" placeholder="Branch Code" value="{{$hotelDetail->branchCode}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">IFSC Code</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="ifscCode" placeholder="IFSC Code" value="{{$hotelDetail->ifscCode}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Swift Code</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="swiftCode" placeholder="Swift Code" value="{{$hotelDetail->swiftCode}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">PAN Number</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="panNumber" placeholder="PAN Number" value="{{$hotelDetail->panNumber}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Name on the Pan Card</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="nameOnPAN" placeholder="Name on the Pan Card" value="{{$hotelDetail->nameOnPAN}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">GST No.</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="gstNo" placeholder="GST No." value="{{$hotelDetail->gstNo}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">GST Name</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="gstName" placeholder="GST Name" value="{{$hotelDetail->gstName}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">GST Contact Number</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="gstContactNumber" placeholder="GST Contact Number" value="{{$hotelDetail->gstContactNumber}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">GST Address</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="gstAddress" placeholder="GST Address" value="{{$hotelDetail->gstAddress}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">GST Email</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="gstEmail" placeholder="GST Email" value="{{$hotelDetail->gstEmail}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Concerned Person Name / Finance Head</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="financeHead" placeholder="Concerned Person Name / Finance Head" value="{{$hotelDetail->financeHead}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Accounts Dept Contact No.</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="acDeptContactNo" placeholder="Accounts Dept Contact No." value="{{$hotelDetail->acDeptContactNo}}">
                                  </div>
                              </div>

                              <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Accounts Dept Email ID</label>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="acDeptEmailId" placeholder="Accounts Dept Email ID" value="{{$hotelDetail->acDeptEmailId}}">
                                  </div>
                              </div>
                           </div>

                           <div class="tab-pane" id="tab6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="hidden" class="countPolicy" value="{{count($hotelDetail->taxes)}}">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field" style="margin-top: 15px;">
                                                {{--  <button type="button" name="add" id="addTax" class="btn btn-success" style="float:right;">Add New Tax</button><br>  --}}
                                                @php
                                                $taxesKeys =  array_keys($hotelDetail->taxes);
                                               
                                                @endphp
                                                {{--  @for ($i = 1; $i <= count($hotelDetail->taxes); $i++)   --}}
                                                @for ($i = 1; $i < 10; $i++) 
                                                <tr id="row{{$i}}">
                                                    <td>
                                                        <div class="form-group">                                                                            
                                                            <div class="col-md-12">
                                                                <label class="">Tax Name Of No. {{$i}}</label>
                                                                <input class="form-control taxName" type="text" name="tax[t{{$i}}][name]" value="{{$hotelDetail->taxes['t'.$i]['name']}}" placeholder="Tax Type Name">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">                                                                            
                                                            <div class="col-md-12">
                                                                <label class="">Tax Rate Of No. {{$i}}</label>
                                                                <select class="form-control" name="tax[t{{$i}}][rate]">
                                                                    {{--  <option value="0" @if($hotelDetail->taxes['t'.$i]['rate'] == '0') selected="selected" @endif>Select Rate</option>  --}}
                                                                    {{--  <option value="Rack-Rate" @if($hotelDetail->taxes['t'.$i]['rate'] == 'Rack-Rate') selected="selected" @endif>Rack Rate</option>  --}}
                                                                    <option value="Sell-Rate" @if($hotelDetail->taxes['t'.$i]['rate'] == 'Sell-Rate') selected="selected" @endif>Sell Rate</option>
                                                                    {{--  <option value="Flat-Rate" @if($hotelDetail->taxes['t'.$i]['rate'] == 'Flat-Rate') selected="selected" @endif>Flat Rate</option>  --}}
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">                                                                            
                                                            <div class="col-md-12">
                                                                <label class="">Percentage Of No. {{$i}}</label>
                                                                <input class="form-control tax_percentege" type="text" name="tax[t{{$i}}][percentage]" value="{{$hotelDetail->taxes['t'.$i]['percentage']}}" placeholder="Tax Percentage">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    {{--<td>  <button type="button" name="remove" id="{{$i}}" class="btn btn-danger btn_remove">X</button></td>  --}}
                                                </tr>
                                                @endfor
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab7">
                              
                              <div class="col-md-12">
                              <!-- {{dump($rooms)}} -->
                              
                              <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Image</td>
                                  <th>Room Name</th>
                                  <th>No Of Rooms</th>
                                  <th>Hotal Status</th>
                                  <th>Uploads</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @if (count($rooms) =='0')
                                <tr>
                                  <td colspan="5" style="text-align:center;">No Rooms Available</td>
                                </tr>                              
                              @endif
                              @foreach($rooms as $key=>$room) 
                                <tr>
                                  <td>{{++$key}}</td>
                                  <td style="width: 10%;"><img class="img-responsive" src="{{ url('/public'.CustomHelpers::get_first_image($room->id,'rt_room_uploads','image_path','room_id')) }}" alt=""></td>
                                  <td>{{$room->roomTypeName}}</td>
                                  <td>{{$room->noOfRooms}}</td>
                                  <td>{{$room->hotelstatus}}</td>
                                  <td><a  target="_blank" href="{{ URL::to('/roomUploads/'.$room->id) }}">Uploads({{ CustomHelpers::countRows($room->id,'rt_room_uploads','image_path','room_id') }})</a></td>
                  
                                  <td><a class="btn btn-warning btn-sm" target="_blank" href="{{ URL::to('/room-edit/'.$room->id) }}"><i class="fa fa-edit"></i></a> </td>
                                </tr>
                              @endforeach  
                              </tbody>
                            </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel-footer">
                  	<input name="hotelID" value="{{$hotelDetail->id}}" type="hidden">
                    <button class="btn btn-primary submitfrm" >Update</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection