@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{Session::get('success')}}
                </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab1">Contract Type</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab2">Rooms Views</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab3">Amenities</a>
                            </li>
                           
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                        <div class="add">
                                                <button class="btn btn-primary" data-target="#squarespaceModal" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i> Add Contract Type</button>
                                                <div aria-hidden="true" aria-labelledby="modalLabel" class="modal fade" id="squarespaceModal" role="dialog" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form action="{{url('/storeContarctTppe')}}" method="post" id="addContractType">
                                                            {{csrf_field()}}
                                                            <div class="modal-header">
                                                                <button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                                <h3 class="modal-title" id="lineModalLabel">Add Contract Type</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- content goes here -->
                                                               
                                                                    <div class="row form-group">
                                                                        <label class="col-md-3 control-label text-left">Contract Type Name</label>
                                                                        <div class="col-md-8">
                                                                            <input class="form-control" name="cTName" id="cTName" placeholder="Name" type="text" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                            <label class="col-md-3 control-label text-left">Description</label>
                                                                            <div class="col-md-8">
                                                                                <textarea class="form-control" name="cTDesc" id="cTDesc" placeholder="Description"  required></textarea>
                                                                            </div>
                                                                        </div>
                                                                    <div class="row form-group">
                                                                        <label class="col-md-3 control-label text-left">Status</label>
                                                                        <div class="col-md-8">
                                                                            <select class="form-control" id="" name="CTStatus">
                                                                                <option value="1">Enable</option>
                                                                                <option value="0">Disable</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div aria-label="group button" class="btn-group btn-group-justified" role="group">
                                                                    <div class="btn-group" role="group">
                                                                        <input type="hidden" name="id" id="ctValue" value="">
                                                                        <button class="btn btn-primary" type="submit" data-action="save" id="saveImage" role="button" type="button">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-bordered table-striped example1" id="example1">
                                                <thead>
                                                    <tr>
                                                        {{--  <th>
                                                            <input class="checkboxcls" type="checkbox" value="3">
                                                        </th>  --}}
                                                      

                                                        <th class="data_id">#</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th class="data_action">Status</th>
                                                        <th class="data_action">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        
                                                @foreach($Contract as $key=>$ct)
                                                <tr id="cType-{{$ct->id}}">
                                                        {{--  <td>
                                                            <input class="checkboxcls" type="checkbox" value="3">
                                                        </td>  --}}
                                                        <td>{{++$key}}</td>
                                                        <td class="typename">{{$ct->name}}</td>
                                                        <td class="typedesc">{{$ct->description}}</td>
                                                        <td class="status">
                                                            @if ($ct->status === 1)
                                                            <span status="{{$ct->status}}" class="label label-success">Enable</span>
                                                            @else
                                                            <span status="{{$ct->status}}" class="label label-danger">Disable</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-warning ctEdit" href="#" data-id="{{$ct->id}}" data-target="#squarespaceModal" data-toggle="modal"><i class="fa fa-edit"></i></a> 
                                                            <a class="btn btn-danger" href="#"><i class="fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach   
                                                </tbody>
                                            </table>
                                </div>
                                <div class="tab-pane" id="tab2">
                                            <div class="add">
                                                <button class="btn btn-primary" data-target="#squarespaceModal1" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i> Add Room View</button>
                                                <div aria-hidden="true" aria-labelledby="modalLabel" class="modal fade" id="squarespaceModal1" role="dialog" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form action="{{url('/storeRoomView')}}" method="post"  id="addRoomView">
                                                            {{csrf_field()}}
                                                            <div class="modal-header">
                                                                <button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                                <h3 class="modal-title" id="lineModalLabel">Add Room View</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row form-group">
                                                                    <label class="col-md-3 control-label text-left">Room View Name</label>
                                                                    <div class="col-md-8">
                                                                        <input class="form-control" id="rvName" name="roomViewName" placeholder="Name" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label class="col-md-3 control-label text-left">Status</label>
                                                                    <div class="col-md-8">
                                                                        <select class="form-control" id="" name="roomViewStatus">
                                                                            <option value="1">Enable</option>
                                                                            <option value="0">Disable</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div aria-label="group button" class="btn-group btn-group-justified" role="group">
                                                                    
                                                                    <div class="btn-group" role="group">
                                                                        <input type="hidden" name="id" id="rvValue" value="">
                                                                        <button class="btn btn-primary" type="submit" data-action="save" id="saveImage" role="button" type="button">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-bordered table-striped example1" id="example1">
                                                <thead>
                                                    <tr>
                                                        {{--  <th>
                                                            <input class="checkboxcls" type="checkbox" value="3">
                                                        </th>  --}}
                                                        <th class="data_id">#</th>
                                                        <th>Name</th>
                                                        <th class="data_action">Status</th>
                                                        <th class="data_action">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($RoomViews as $key=>$rv)
                                                <tr id="rV-{{$rv->id}}">
                                                        {{--  <td>
                                                            <input class="checkboxcls" type="checkbox" value="3">
                                                        </td>  --}}
                                                        <td>{{++$key}}</td>
                                                        <td class="typename">{{$rv->name}}</td>
                                                        <td class="status">
                                                            @if ($rv->status === 1)
                                                            <span status="{{$rv->status}}" class="label label-success">Enable</span>
                                                            @else
                                                            <span status="{{$rv->status}}" class="label label-danger">Disable</span>
                                                            @endif      
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-warning rvEdit" href="#" data-id="{{$rv->id}}" data-target="#squarespaceModal1" data-toggle="modal">
                                                                <i class="fa fa-edit"></i>
                                                            </a> 
                                                            <a class="btn btn-danger" href="#"><i class="fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach 
                                                </tbody>
                                            </table>
                                </div>
                                <div class="tab-pane" id="tab3">
                                        
                                          
                                             <div class="add">
                                                <button data-toggle="modal" data-target="#addRoomAminities" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add Room Amenities</button>
                                                <div class="modal fade" id="addRoomAminities" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                   <div class="modal-dialog">
                                                      <div class="modal-content">
                                                            <form action="{{url('/storeRoomAminities')}}" method="post" id="addRoomAminities">
                                                                {{csrf_field()}}
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                                <h3 class="modal-title" id="lineModalLabel">Add Room Amenities</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row form-group">
                                                                    <label class="col-md-3 control-label text-left">Name</label>
                                                                    <div class="col-md-8">
                                                                        <input name="aminiName" id="aminiName" class="form-control" placeholder="Name" value="" type="text" required />
                                                                    </div>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label class="col-md-3 control-label text-left">Icon</label>
                                                                    <div class="col-md-8">
                                                                        <input name="aminiIcon" id="aminiIcon" class="form-control" placeholder="Icon" value="" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label class="col-md-3 control-label text-left">Description</label>
                                                                    <div class="col-md-8">
                                                                        <textarea name="aminiDesc" id="aminiDesc" class="form-control" placeholder="Description" ></textarea> 
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
                                                                    
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                                    <div class="btn-group" role="group">
                                                                        <input type="hidden" name="id" id="raValue" value="">
                                                                        <button  id="saveRoomAmi" type="submit" class="btn btn-primary" data-action="save" role="button">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <table class="table table-bordered table-striped example1">
                                             <thead>
                                                <tr>
                                                   {{--  <th class="data_id"><input class="checkboxcls" value="3" type="checkbox"></th>  --}}
                                                   <th class="data_id">#</th>
                                                   <th class="data_id">Icon</th>
                                                   <th>Name</th>
                                                   <th>Description</th>
                                                   <th class="data_action">Status</th>
                                                   <th class="data_action">&nbsp;</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                @foreach($Roomsamenities as $key=>$r_amenities)
                                                <tr id="editroomamenities-{{$r_amenities->id}}">
                                                   {{--  <td class="center"><input class="checkboxcls" value="3" type="checkbox"></td>  --}}
                                                   <td class="center">{{++$key}}</td>
                                                   <td class="amenitiesIcon center">
                                                      <div class="style_prevu_kit"  id="Aicon" >
                                                         <i lang="{{$r_amenities->icon}}" class="fa {{$r_amenities->icon}}" aria-hidden="true"></i>
                                                      </div>
                                                   </td>
                                                   <td  class="amenitiesName">{{$r_amenities->name}}</td>
                                                   <td  class="amenitiesDesc">{{$r_amenities->desc}}</td>
                                                   <td class="amenitiesStatus center">
                                                    @if ($r_amenities->status == 1)
                                                       <span status="{{$r_amenities->status}}" class="label label-success">Enable</span>  
                                                      @else
                                                      <span status="{{$r_amenities->status}}" class="label label-danger">Disable</span>
                                                      @endif
                                                     <input  type="hidden" id="status" name="status" value="{{$r_amenities->status}}"></td>
                                                     <input  type="hidden" id="desc" name="desc" value="{{$r_amenities->desc}}"></td>
                                                   
                                                    <td class="center">
                                                                                                             
                                                   <form action="{{URL::to('/deleteRoomAmenities')}}" method="post" id="deleteRoomAmenities{{$r_amenities->id}}">
                                                   {{csrf_field()}} 
                                                   <input type="hidden" name="id" value="{{$r_amenities->id}}"/>
                                                    <a class="btn btn-warning raEdit" data-id="{{$r_amenities->id}}" data-toggle="modal"  data-target="#addRoomAminities" href="#"><i class="fa fa-edit"></i></a> 
                                                   <a href="#" data-id="{{$r_amenities->id}}" class="btn btn-danger deleteRoomAmenities"><i class="fa fa-times"></i></a>
                                                   </form>
                                                   </td>
                                                </tr>
                                                  @endforeach
                                             </tbody>
                                          </table>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input id="slug" type="hidden" value="">
                        <input name="submittype" type="hidden" value="add">
                        <input name="hotelid" type="hidden" value="">
                        <button class="btn btn-primary submitfrm" id="add">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection