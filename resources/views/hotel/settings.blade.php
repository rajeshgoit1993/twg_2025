@extends('layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3 class="panel-title">
                              <ul class="nav nav-tabs">
                                 <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
                                 <li><a href="#tab2" data-toggle="tab">Hotels Types</a></li>
                                 <li><a href="#tab3" data-toggle="tab">Rooms Types</a></li>
                                 <li><a href="#tab4" data-toggle="tab">Payment Methods</a></li>
                                 <li><a href="#tab5" data-toggle="tab">Hotels Amenities</a></li>
                              </ul>
                           </h3>
                        </div>
                        <div class="panel-body">
                           <div class="tabbable">
                              <div class="tab-content">
                                 <div class="tab-pane active generalSetting" id="tab1">
                                    <!-- <div class="row form-group">
                                       <label class="col-md-2 control-label text-left">Target</label>
                                       <div class="col-md-4">
                                          <select class="form-control" name="target">
                                             <option value="_self" selected="">Self</option>
                                             <option value="_blank">Blank</option>
                                          </select>
                                       </div>
                                    </div> -->
                                   <?php
                                   //dump($HotelGeneralSetting);
                                   ?>
                                       @foreach($HotelGeneralSetting as $key=>$rtype)           
                                                
                                    <div class="alert alert-success" id="success-contaier-parent-general" style="display:none">
                                          <p>General Setting updated Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent-general" style="display:none">
                                      <ul id="error-contaier-general"> </ul> 
                                   </div>  
                                    <div class="row form-group">
                                       <div class="col-md-12 form-group">
                                          <label class="col-md-2 control-label text-left">Header Title</label>
                                          <div class="col-md-10 form-group">
                                             <input name="headertitle" class="form-control headertitle" placeholder="title" value="{{$rtype->header_title}}" type="text">
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <label class="col-md-2 control-label text-left">Home Featured Hotels</label>
                                          <div class="col-md-10">
                                             <input class="form-control noFeatured" placeholder="" name="home" value="{{$rtype->no_of_featured_hotels}}" type="text">
                                          </div>
                                       </div>
                                       

                                       
                                       <!-- <label class="col-md-2 control-label text-left">Display Order</label>
                                       <div class="col-md-3">
                                          <select class="form-control" name="homeorder">
                                             <option value="ol" label="By Order Given">By Order Given</option>
                                             <option value="newf" label="By Latest First" selected="">By Latest First</option>
                                             <option value="oldf" label="By Oldest First">By Oldest First</option>
                                             <option value="az" label="Ascending Order (A-Z)">Ascending Order (A-Z)</option>
                                             <option value="za" label="Descending  Order (Z-A)">Descending  Order (Z-A)</option>
                                          </select>
                                       </div> -->
                                    </div>
                                    <!-- <div class="row form-group">
                                       <label class="col-md-2 control-label text-left">Listings Hotels</label>
                                       <div class="col-md-2">
                                          <input class="form-control" placeholder="" name="listings" value="8" type="text">
                                       </div>
                                       <label class="col-md-2 control-label text-left">Display Order</label>
                                       <div class="col-md-3">
                                          <select class="form-control" name="listingsorder">
                                             <option value="ol" label="By Order Given">By Order Given</option>
                                             <option value="newf" label="By Latest First" selected="">By Latest First</option>
                                             <option value="oldf" label="By Oldest First">By Oldest First</option>
                                             <option value="az" label="Ascending Order (A-Z)">Ascending Order (A-Z)</option>
                                             <option value="za" label="Descending  Order (Z-A)">Descending  Order (Z-A)</option>
                                          </select>
                                       </div>
                                    </div> -->
                                    <!-- <div class="row form-group">
                                       <label class="col-md-2 control-label text-left">Search Result Hotels</label>
                                       <div class="col-md-2">
                                          <input class="form-control" placeholder="" name="searchresult" value="6" type="text">
                                       </div>
                                       <label class="col-md-2 control-label text-left">Display Order</label>
                                       <div class="col-md-3">
                                          <select class="form-control" name="searchorder">
                                             <option value="ol" label="By Order Given">By Order Given</option>
                                             <option value="newf" label="By Latest First" selected="">By Latest First</option>
                                             <option value="oldf" label="By Oldest First">By Oldest First</option>
                                             <option value="az" label="Ascending Order (A-Z)">Ascending Order (A-Z)</option>
                                             <option value="za" label="Descending  Order (Z-A)">Descending  Order (Z-A)</option>
                                          </select>
                                       </div>
                                    </div> -->
                                    <!-- <div class="row form-group">
                                       
                                    </div> -->
                                    <!-- <hr>
                                    <h3>Search Settings</h3>
                                    <div class="row form-group">
                                       <label class="col-md-2 control-label text-left">Minimum Price</label>
                                       <div class="col-md-2">
                                          <input class="form-control" placeholder="" name="minprice" value="50" type="text">
                                       </div>
                                       <label class="col-md-2 control-label text-left">Maximum Price</label>
                                       <div class="col-md-2">
                                          <input class="form-control" placeholder="" name="maxprice" value="500" type="text">
                                       </div>
                                    </div> -->
                                    <hr>
                                    <h4>Default Check-Time</h4>
                                    <hr>
                                    <div class="row form-group">
                                       <div class="col-md-12 form-group">
                                          <label class="col-md-2 control-label text-left">Check In</label>
                                          <div class="col-md-10">
                                             <input class="form-control checkin" placeholder="" name="checkin" value="{{$rtype->check_in_time}}" type="text">
                                          </div>
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="col-md-2 control-label text-left">Check Out</label>
                                          <div class="col-md-10">
                                             <input class="form-control checkout" placeholder="" name="checkout" value="{{$rtype->check_out_time}}" type="text">
                                          </div>
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row form-group">
                                       <div class="col-md-2 col-md-offset-10">
                                          <button type="button" id="saveGeneralSetting" class="btn btn-primary" data-action="save" role="button">Save Changes</button>
                                       </div>
                                       
                                    </div>
                                    @endforeach
                                 </div>                                 
                                 <div class="tab-pane" id="tab2">
                                    <div class="box">
                                       <div class="box-header">
                                       </div>
                                       <!-- /.box-header -->
                                       <div class="box-body">
                                          <table id="example1" class="table table-bordered table-striped example1">
                                             <div class="add">
                                                <button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add Hotel Type</button>

                                                <div class="modal fade hotelType" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                   <div class="modal-dialog">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                            <h3 class="modal-title" id="lineModalLabel">Add Hotel Type</h3>
                                                         </div>
                                                         <div class="modal-body">
                                                            <!-- content goes here -->
                                                            <form>
                                                               <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                                                  <p>Type Added Successfully.</p>
                                                              </div>
                                                               <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                                              <ul id="error-contaier"> 
                                                              </ul>
                                                            </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Type Name</label>
                                                                  <div class="col-md-8">
                                                                     <input name="name" class="form-control hotelTypeName" placeholder="Name" value="" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Status</label>
                                                                  <div class="col-md-8">
                                                                     <select name="statusopt" class="form-control hotelTypeStatus" id="">
                                                                        <option value="1">Enable</option>
                                                                        <option value="0">Disable</option>
                                                                     </select>
                                                                  </div>
                                                               </div>

                                                            </form>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                               </div>
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" id="saveHotelTypes" class="btn btn-primary" data-action="save" role="button">Add</button>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                                <div class="modal fade editHotelType" id="editHotelTypeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                               <h3 class="modal-title" id="lineModalLabel">Edit Hotel Type</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                               <!-- content goes here -->
                                                               <form>
                                                                   <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                                                     <p>User Added Successfully.</p>
                                                                 </div>
                                                                  <div class="alert alert-danger" id="error-contaier-parent1" style="display:none">
                                                                 <ul id="error-contaier1"> 
                                                                 </ul>
                                                               </div>
                                                                  <input type="hidden" value="" class="edittypeid"/>
                                                                  <div class="row form-group">
                                                                     <label class="col-md-3 control-label text-left">Type Name</label>
                                                                     <div class="col-md-8">
                                                                        <input name="name" class="form-control hotelTypeName" placeholder="Name" value="" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="row form-group">
                                                                     <label class="col-md-3 control-label text-left">Status</label>
                                                                     <div class="col-md-8">
                                                                        <select name="statusopt" class="form-control hotelTypeStatus" id="">
                                                                           <option value="1">Enable</option>
                                                                           <option value="0">Disable</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                               <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                                  <div class="btn-group" role="group">
                                                                     <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                                  </div>
                                                                  <div class="btn-group" role="group">
                                                                     <button type="button" id="updateHotelTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                </div>
                                             </div>
                                             <thead>
                                                <tr>
                                                   <th class="data_id"><input class="checkboxcls" value="3" type="checkbox"></th>
                                                   <th class="data_id">#</th>
                                                   <th>Name</th>
                                                   <th class="data_action">Status</th>
                                                   <th class="data_action">&nbsp;</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                
                                              @foreach($hotelTypes as $key=>$type)           
                                                <tr id="edittype_{{$type->id}}">
                                                   <td class="center"><input class="checkboxcls" value="3" type="checkbox"></td>
                                                   <td class="center">{{++$key}}</td>
                                                   <td class="typename">{{$type->name}}</td>
                                                   <td class="typestatus center">
                                                       @if ($type->status == 1)
                                                       <label class="label label-success">Enable</label>  
                                                      @else
                                                      <label class="label label-danger">Disable</label>
                                                      @endif
                                                     <input  type="hidden" name="status" value="{{$type->status}}">
                                                   </td>
                                                   <td class="center">
                                                     
                                                   <form action="{{URL::to('/deleteHotelType')}}" method="post" id="deleteHotelType{{$type->id}}">
                                                   {{csrf_field()}} 
                                                   <input type="hidden" name="id" value="{{$type->id}}"/>
                                                    <a class="btn btn-warning edit_hotelType" data-id="{{$type->id}}" data-toggle="modal"  data-target="#editHotelTypeModal" href="#"><i class="fa fa-edit"></i></a> 
                                                   <a href="#" data-id="{{$type->id}}" class="btn btn-danger deleteHotelType"><i class="fa fa-times"></i></a>
                                                   </form>




                                                   </td>
                                                </tr>
                                              @endforeach
                                              
                                             </tbody>
                                          </table>
                                       </div>
                                       <!-- /.box-body -->
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="tab3">
                                    <div class="box">
                                       <div class="box-header">
                                       </div>
                                       <!-- /.box-header -->
                                       <div class="box-body">
                                          <table id="example1" class="table table-bordered table-striped example1">
                                             <div class="add">
                                                <button data-toggle="modal" data-target="#squarespaceModal1" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add Room Type</button>
                                                <div class="modal fade roomType" id="squarespaceModal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                   <div class="modal-dialog">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                            <h3 class="modal-title" id="lineModalLabel">Add Room Type</h3>
                                                         </div>
                                                         <div class="modal-body">
                                                            <!-- content goes here -->
                                                            <form>
                                                               <div class="alert alert-success" id="success-contaier-parent-room" style="display:none">
                                                                  <p>Room Type Added Successfully.</p>
                                                                 </div>
                                                                  <div class="alert alert-danger" id="error-contaier-parent-room" style="display:none">
                                                                 <ul id="error-contaier-room"> 
                                                                 </ul>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Type Name</label>
                                                                  <div class="col-md-8">
                                                                     <input name="name" class="form-control roomTypeName" placeholder="Name" value="" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Status</label>
                                                                  <div class="col-md-8">
                                                                     <select name="statusopt" class="form-control roomTypeStatus" id="">
                                                                        <option value="1">Enable</option>
                                                                        <option value="0">Disable</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                            </form>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                               </div>
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" id="saveRoomTypes" class="btn btn-primary" data-action="save" role="button">Add</button>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal fade editRoomType" id="editRoomTypeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                               <h3 class="modal-title" id="lineModalLabel">Edit Room Type</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                               <!-- content goes here -->
                                                               <form>
                                                                   <div class="alert alert-success" id="success-contaier-parent-edit-room" style="display:none">
                                                                     <p>Room Type updated Successfully.</p>
                                                                 </div>
                                                                  <div class="alert alert-danger" id="error-contaier-parent-edit-room" style="display:none">
                                                                 <ul id="error-contaier-edit-room"> 
                                                                 </ul>
                                                               </div>
                                                                  <input type="hidden" value="" class="edittypeid"/>
                                                                  <div class="row form-group">
                                                                     <label class="col-md-3 control-label text-left">Type Name</label>
                                                                     <div class="col-md-8">
                                                                        <input name="name" class="form-control roomTypeName" placeholder="Name" value="" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="row form-group">
                                                                     <label class="col-md-3 control-label text-left">Status</label>
                                                                     <div class="col-md-8">
                                                                        <select name="statusopt" class="form-control roomTypeStatus" id="">
                                                                           <option value="1">Enable</option>
                                                                           <option value="0">Disable</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                               <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                                  <div class="btn-group" role="group">
                                                                     <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                                  </div>
                                                                  <div class="btn-group" role="group">
                                                                     <button type="button" id="updateRoomTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                </div>
                                             </div>
                                             <thead>
                                                <tr>
                                                   <th class="data_id"><input class="checkboxcls" value="3" type="checkbox"></th>
                                                   <th class="data_id">#</th>
                                                   <th>Name</th>
                                                   <th class="data_action">Status</th>
                                                   <th class="data_action">&nbsp;</th>
                                                </tr>
                                             </thead>
                                             <tbody>

                                                  @foreach($RoomsType as $key=>$rtype)           
                                                <tr id="roomedittype_{{$rtype->id}}">
                                                   <td class="center"><input class="checkboxcls" value="3" type="checkbox"></td>
                                                   <td class="center">{{++$key}}</td>
                                                   <td class="typename">{{$rtype->name}}</td>
                                                   <td class="typestatus center">
                                                       @if ($rtype->status == 1)
                                                       <label class="label label-success">Enable</label>  
                                                      @else
                                                      <label class="label label-danger">Disable</label>
                                                      @endif
                                                     <input  type="hidden" name="status" value="{{$rtype->status}}">
                                                   </td>
                                                   <td class="center">
                                                     
                                                   <form action="{{URL::to('/deleteRoomType')}}" method="post" id="deleteRoomType{{$rtype->id}}">
                                                   {{csrf_field()}} 
                                                   <input type="hidden" name="id" value="{{$rtype->id}}"/>
                                                   <a 
                                                      class="btn btn-warning edit_roomType" 
                                                      data-id="{{$rtype->id}}" 
                                                      data-toggle="modal"  
                                                      data-target="#editRoomTypeModal" 
                                                      href="#">
                                                      <i class="fa fa-edit"></i>
                                                   </a> 
                                                   
                                                   <a 
                                                      href="#" 
                                                      data-id="{{$rtype->id}}" 
                                                      class="btn btn-danger deleteRoomType">
                                                      <i class="fa fa-times"></i>
                                                   </a>
                                                   </form>
                                                   </td>
                                                </tr>
                                              @endforeach
                                             </tbody>
                                          </table>
                                       </div>
                                       <!-- /.box-body -->
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="tab4">
                                    <div class="box">
                                       <div class="box-header">
                                       </div>
                                       <!-- /.box-header -->
                                       <div class="box-body">
                                          <table id="example1" class="table table-bordered table-striped example1">
                                             <div class="add">
                                                <button data-toggle="modal" data-target="#squarespaceModal18" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add Payment Type</button>
                                                <div class="modal fade PaymentMethod" id="squarespaceModal18" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                   <div class="modal-dialog">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                            <h3 class="modal-title" id="lineModalLabel">Add Payment Type</h3>
                                                         </div>
                                                         <div class="modal-body">
                                                            <!-- content goes here -->
                                                            <form>
                                                               <div class="alert alert-success" id="success-contaier-parent-Payment" style="display:none">
                                                                  <p>Payment Type Added Successfully.</p>
                                                                 </div>
                                                                  <div class="alert alert-danger" id="error-contaier-parent-Payment" style="display:none">
                                                                 <ul id="error-contaier-Payment"> 
                                                                 </ul>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Payment Type Name</label>
                                                                  <div class="col-md-8">
                                                                     <input name="name" class="form-control PaymentMethodName" placeholder="Name" value="" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Status</label>
                                                                  <div class="col-md-8">
                                                                     <select name="statusopt" class="form-control PaymentMethodStatus" id="">
                                                                        <option value="1">Enable</option>
                                                                        <option value="0">Disable</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                            </form>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                               </div>
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" id="savePaymentMethod" class="btn btn-primary" data-action="save" role="button">Add Payment Type</button>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal fade editPaymentMethod" id="editPaymentMethod" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                               <h3 class="modal-title" id="lineModalLabel">Edit Payment Type</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                               <!-- content goes here -->
                                                               <form>
                                                                   <div class="alert alert-success" id="success-contaier-parent-edit-Payment" style="display:none">
                                                                     <p>Payment Type updated Successfully.</p>
                                                                 </div>
                                                                  <div class="alert alert-danger" id="error-contaier-parent-edit-Payment" style="display:none">
                                                                 <ul id="error-contaier-edit-Payment"> 
                                                                 </ul>
                                                               </div>
                                                                  <input type="hidden" value="" class="edittypeid"/>
                                                                  <div class="row form-group">
                                                                     <label class="col-md-3 control-label text-left">Payment Type Name</label>
                                                                     <div class="col-md-8">
                                                                        <input name="name" class="form-control PaymentMethodName" placeholder="Name" value="" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="row form-group">
                                                                     <label class="col-md-3 control-label text-left">Status</label>
                                                                     <div class="col-md-8">
                                                                        <select name="statusopt" class="form-control PaymentMethodStatus" id="">
                                                                           <option value="1">Enable</option>
                                                                           <option value="0">Disable</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                               <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                                  <div class="btn-group" role="group">
                                                                     <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                                  </div>
                                                                  <div class="btn-group" role="group">
                                                                     <button type="button" id="updatePaymentMethod" class="btn btn-primary" data-action="save" role="button">Update</button>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                </div>
                                             </div>
                                             <thead>
                                                <tr>
                                                   <th class="data_id"><input class="checkboxcls" value="3" type="checkbox"></th>
                                                   <th class="data_id">#</th>
                                                   <th>Payment Type Name</th>
                                                   <th class="data_action">Status</th>
                                                   <th class="data_action">&nbsp;</th>
                                                </tr>
                                             </thead>
                                             <tbody>      
                                                @foreach($HotelPaymentMethod as $key=>$rtype) 

                                                <tr id="PaymentMethod_{{$rtype->id}}">
                                                   <td class="center"><input class="checkboxcls" value="3" type="checkbox"></td>
                                                   <td class="center">{{++$key}}</td>
                                                   <td class="typename">{{$rtype->name}}</td>
                                                   <td class="typestatus center">
                                                       @if ($rtype->status == 1)
                                                       <label class="label label-success">Enable</label>  
                                                      @else
                                                      <label class="label label-danger">Disable</label>
                                                      @endif
                                                     <input  type="hidden" name="status" value="{{$rtype->status}}">
                                                   </td>
                                                   <td class="center">
                                                     
                                                   <form action="{{URL::to('/deletePaymentMethod')}}" method="post" id="deletePaymentMethod{{$rtype->id}}">
                                                   {{csrf_field()}} 
                                                      <input type="hidden" name="id" value="{{$rtype->id}}"/>
                                                      <a 
                                                         class="btn btn-warning edit_PaymentMethod" 
                                                         data-id="{{$rtype->id}}" 
                                                         data-toggle="modal"  
                                                         data-target="#editPaymentMethod" 
                                                         href="#">
                                                         <i class="fa fa-edit"></i>
                                                      </a> 
                                                   
                                                      <a 
                                                         href="#" 
                                                         data-id="{{$rtype->id}}" 
                                                         class="btn btn-danger deletePaymentMethod">
                                                         <i class="fa fa-times"></i>
                                                      </a>
                                                   </form>
                                                   </td>
                                                </tr>
                                              @endforeach
                                             </tbody>
                                          </table>
                                       </div>
                                       <!-- /.box-body -->
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="tab5">
                                    <div class="box">
                                       <div class="box-header">
                                       </div>
                                       <!-- /.box-header -->
                                       <div class="box-body">
                                          <table id="amenitiesTable" class="table table-bordered table-striped example1">
                                             <div class="add">
                                                <button data-toggle="modal" data-target="#addAminities" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add Amenities</button>
                                                <div class="modal fade" id="addAminities" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                   <div class="modal-dialog">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                            <h3 class="modal-title" id="lineModalLabel">Add Hotel Amenities</h3>
                                                         </div>
                                                         <div class="modal-body">
                                                            <!-- content goes here -->
                                                            <form>
                                                               <div class="alert alert-success" id="success-contaier-parent-ame" style="display:none">
                                                                  <p>Amenities Added Successfully.</p>
                                                              </div>
                                                               <div class="alert alert-danger" id="error-contaier-parent-ame" style="display:none">
                                                              <ul id="error-contaier-ame"> 
                                                              </ul>
                                                            </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Name</label>
                                                                  <div class="col-md-8">
                                                                     <input name="name" id="aminiName" class="form-control" placeholder="Name" value="" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Icon</label>
                                                                  <div class="col-md-8">
                                                                     <input name="icon" id="aminiIcon" class="form-control" placeholder="Icon" value="" type="text">
                                                                  </div>
                                                               </div>
                                                                <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Description</label>
                                                                  <div class="col-md-8">
                                                                     <textarea name="desc" id="aminiDesc" class="form-control" placeholder="Description" ></textarea> 
                                                                  </div>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Status</label>
                                                                  <div class="col-md-8">
                                                                     <select name="statusopt" class="form-control" id="aminiStatus">
                                                                        <option value="1">Enable</option>
                                                                        <option value="0">Disable</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                            </form>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                               </div>
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" id="saveHotelAmi" class="btn btn-primary" data-action="save" role="button">Save</button>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>

                                                <!-- Edit Amenities -->
                                                <div class="modal fade" id="editAminities" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                   <div class="modal-dialog">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                            <h3 class="modal-title" id="lineModalLabel">Edit Hotel Amenities</h3>
                                                         </div>
                                                         <div class="modal-body">
                                                            <!-- content goes here -->
                                                            <form>
                                                                <input type="hidden" value="" class="editAmenutiesid"/>
                                                               <div class="alert alert-success" id="success-contaier-parent-ame1" style="display:none">
                                                                  <p>Amenities Updated Successfully.</p>
                                                              </div>
                                                               <div class="alert alert-danger" id="error-contaier-parent-ame1" style="display:none">
                                                              <ul id="error-contaier-ame1"> 
                                                              </ul>
                                                            </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Name</label>
                                                                  <div class="col-md-8">
                                                                     <input name="name" id="aminiName" class="form-control" placeholder="Name" value="" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Icon</label>
                                                                  <div class="col-md-8">
                                                                     <input name="icon" id="aminiIcon" class="form-control" placeholder="Icon" value="" type="text">
                                                                  </div>
                                                               </div>
                                                                <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Description</label>
                                                                  <div class="col-md-8">
                                                                     <textarea name="desc" id="aminiDesc" class="form-control" placeholder="Description" ></textarea> 
                                                                  </div>
                                                               </div>
                                                               <div class="row form-group">
                                                                  <label class="col-md-3 control-label text-left">Status</label>
                                                                  <div class="col-md-8">
                                                                     <select name="statusopt" class="form-control" id="aminiStatus">
                                                                        <option value="1">Enable</option>
                                                                        <option value="0">Disable</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                            </form>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                               </div>
                                                               <div class="btn-group" role="group">
                                                                  <button type="button" id="UpdateHotelAmi" class="btn btn-primary" data-action="save" role="button">Update</button>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <thead>
                                                
                                                <tr>
                                                   <th class="data_id"><input class="checkboxcls" value="3" type="checkbox"></th>
                                                   <th class="data_id">#</th>
                                                   <th class="data_id">Icon</th>
                                                   <th>Name</th>
                                                   <th>Description</th>
                                                   <th class="data_action">Status</th>
                                                   <th class="data_action">&nbsp;</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                @foreach($hotelAmenities as $key=>$amenities)
                                                <tr id="editamenities-{{$amenities->id}}">
                                                   <td class="center"><input class="checkboxcls" value="3" type="checkbox"></td>
                                                   <td class="center">{{++$key}}</td>
                                                   <td class="amenitiesIcon center">
                                                      <div class="style_prevu_kit">
                                                         <i id="Aicon" lang="{{$amenities->icon}}" class="fa {{$amenities->icon}}" aria-hidden="true"></i>
                                                      </div>
                                                   </td>
                                                   <td  class="amenitiesName">{{$amenities->name}}</td>
                                                   <td  class="amenitiesDesc">{{$amenities->desc}}</td>
                                                   <td class="amenitiesStatus center">
                                                    @if ($amenities->status == 1)
                                                       <label class="label label-success">Enable</label>  
                                                      @else
                                                      <label class="label label-danger">Disable</label>
                                                      @endif
                                                     <input  type="hidden" id="status" name="status" value="{{$amenities->status}}"></td>
                                                     <input  type="hidden" id="desc" name="desc" value="{{$amenities->desc}}"></td>
                                                   
                                                    <td class="center">
                                                     
                                                   <form action="{{URL::to('/deleteHotelAmenities')}}" method="post" id="deleteHotelAmenities{{$amenities->id}}">
                                                   {{csrf_field()}} 
                                                   <input type="hidden" name="id" value="{{$amenities->id}}"/>
                                                    <a class="btn btn-warning edit_hotelAmenities" data-id="{{$amenities->id}}" data-toggle="modal"  data-target="#editAminities" href="#"><i class="fa fa-edit"></i></a> 
                                                   <a href="#" data-id="{{$amenities->id}}" class="btn btn-danger deleteHotelAmenities"><i class="fa fa-times"></i></a>
                                                   </form>




                                                   </td>
                                                </tr>
                                                  @endforeach
                                               
                                             </tbody>
                                          </table>
                                       </div>
                                       <!-- /.box-body -->
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>
                        <div class="panel-footer">
                           <!-- <input id="slug" value="" type="hidden">
                           <input name="submittype" value="add" type="hidden">
                           <input name="hotelid" value="" type="hidden"> -->
                          <!--  <button class="btn btn-primary submitfrm" id="add">Submit</button> -->
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
@endsection
