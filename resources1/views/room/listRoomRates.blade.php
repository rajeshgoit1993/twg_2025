@extends('layouts.master')
@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Room Rates</h3>
              </div>
             
                        <!-- /.box-header -->
                        <div class="box-body">
                          
                          <a href="{{{URL::to('/room-rate-create')}}}" class="btn btn-warning" style="margin-bottom: 15px; " type="button">Add Room Rate</a>

                          <table class="table table-bordered table-striped" id="example1">
                            <thead>
                              <tr>
                                <th><input class="checkboxcls" type="checkbox" value="3"></th>
                                <th>#</th>
                                <th>Room Type Name</th>
                                <th>Contract Type</th>
                                <th>Commission Offered</th>
                                <th>&nbsp;</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($RoomRates as $key=>$Roomrate) 
                              <tr>
                                <td><input class="checkboxcls" type="checkbox" value="3"></td>
                                <td>{{++$key}}</td>
                                <td>{{$Roomrate->room_Type}}</td>
                                <td>{{$Roomrate->contract_Type}}</td>
                                <td>{{$Roomrate->commission_Offered}}%</td>
                                <td>

                                  <form action="{{url('/deleteRoomRates')}}" method="post" onsubmit="return confirm('Do you really want to delete this.?');">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{$Roomrate->id}}">
                                    <a class="btn btn-warning btn-sm" href="{{ URL::to('/rr-edit/'.$Roomrate->id) }}"><i class="fa fa-edit"></i></a> 
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                  </form>



                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div><!-- /.box-body -->
                
              <div class="panel-footer">
                <input id="slug" type="hidden" value=""> <input name="submittype" type="hidden" value="add"> <input name="hotelid" type="hidden" value=""> <button class="btn btn-primary submitfrm" id="add">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

@endsection