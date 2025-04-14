@extends('layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      {{--  {{dump($RoomRatesRegular)}}   --}}
    <section class="content">
      <div class="row">
        <div class="col-md-12">
                    <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-table" aria-hidden="true"></i> Price Manager</h3>
              <div class="add">
                 <br>
                <a href="{{{URL::to('/room-rate-plans-create')}}}" class="btn btn-primary">
                  <i class="glyphicon glyphicon-plus-sign"></i> Add Room Rate
                </a>
              </div>
              @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
              </div>
              @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Hotel Name</th>
                  <th>Room Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($RoomRatesRegular as $key=>$RoomRateRegular) 
                <tr>
                  <td>{{++$key}}</td> 
                  <td>{{CustomHelpers::getTableRecordById($RoomRateRegular->hotel_Id,'rt_hotels','name')}}</td>      
                  <td>{{CustomHelpers::getTableRecordById($RoomRateRegular->room_Id,'rt_rooms','roomTypeName')}}</td>
                  
                  <td>
                    <form action="{{url('/deleteRoomRatePlans')}}" method="post" onsubmit="return confirm('Do you really want to delete this.?');">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="hotel_Id" value="{{$RoomRateRegular->hotel_Id}}">
                      <input type="hidden" name="room_Id" value="{{$RoomRateRegular->room_Id}}">
                      <a class="btn btn-warning" href="{{ URL::to('/room-rates-plan-edit/'.$RoomRateRegular->hotel_Id.'/'.$RoomRateRegular->room_Id) }}"><i class="fa fa-edit"></i>Edit</a> 
                      <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
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