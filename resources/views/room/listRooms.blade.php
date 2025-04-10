@extends('layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rooms Management</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped example1">
                <div class="add">
                  <a href="{{{URL::to('/room-create')}}}" class="btn btn-success">
                    <i class="glyphicon glyphicon-plus-sign"></i> Add Room
                  </a>
                </div>
                <thead>
                <tr>
                  <th><input class="checkboxcls" value="3" type="checkbox"></th>
                  <th>#</th>
                  <th>Image</th>
                  <th>Room Name</th>
                  <th>Assigned Hotel Name</th>
                  <th>No Of Rooms</th>
                  <th>Availability</th>
                  <th>Gallery</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Rooms as $key=>$Room) 
                <tr>
                  <td><input class="checkboxcls" value="3" type="checkbox"></td>
                  <td>{{++$key}}</td>
                  <td style="width: 10%;"><img class="img-responsive" src="{{ url('/public'.CustomHelpers::get_first_image($Room->id,'rt_room_uploads','image_path','room_id')) }}" alt=""></td>
                  <td>{{$Room->roomTypeName}}</td>
                  <td>{{CustomHelpers::getTableRecordById($Room->assignedHotelname,'rt_hotels','name')}}</td>
                  <td>{{$Room->noOfRooms}}</td>
                  <td>{{$Room->hotelstatus}}</td>
                  <td><a href="{{ URL::to('/roomUploads/'.$Room->id) }}">Uploads({{ CustomHelpers::countRows($Room->id,'rt_room_uploads','image_path','room_id') }})</a></td>
                  <td>
                  <form action="{{url('/deleteRoom')}}" method="post" onsubmit="return confirm('Do you really want to delete this.?');">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id" value="{{$Room->id}}">
                      <a class="btn btn-warning btn-sm" href="{{ URL::to('/room-edit/'.$Room->id) }}"><i class="fa fa-edit"></i></a> 
                      <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
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
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
@endsection