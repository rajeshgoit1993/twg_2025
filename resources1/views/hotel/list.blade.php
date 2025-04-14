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
              <h3 class="box-title">Hotels Management</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{Session::get('success')}}
                </div>
                @endif
             <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                 <p>Hotel Deleted Successfully.</p>
              </div>
              <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul> 
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <div class="add">
                  <a href="{{{URL::to('/hotel-add')}}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                </div>
                <thead>
                <tr>
                  <th><input class="checkboxcls" value="3" type="checkbox"></th>
                  <!-- <th>#</th> -->
                  <th>Image</th>
                  <th>Name</th>
                  <th>Stars</th>
                  <th>Location</th>
                  <th>Gallery</th>
                  <th>Featured</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hotels as $key=>$hotel) 
                <tr>
                  <td><input class="checkboxcls" value="3" type="checkbox"></td>
                  <td style="width: 10%;"><img class="img-responsive" src="{{ url('/public'.CustomHelpers::get_first_image($hotel->id,'rt_hotel_uploads','image_path','hotel_id')) }}" alt=""></td>
                  <td>{{$hotel->name}}</td>
                  <td>{{$hotel->stars}} Star</td>
                  <td>{{$hotel->country}}</td>
                  <td><a href="{{ URL::to('/hotelUploads/'.$hotel->id) }}">Uploads({{ CustomHelpers::countRows($hotel->id,'rt_hotel_uploads','image_path','hotel_id') }})</a></td>
                  <td>
                    @if ($hotel->featured == 1)
                        <i style="color:green" class="fa fa-check-square" aria-hidden="true"></i>
                    @else  
                        <i class="fa fa-square-o" aria-hidden="true"></i>
                    @endif
                  </td>
                  <td>
                    <span class="btn-group">
                      <a class="btn btn-default btn-xcrud btn btn-warning" href="{{ URL::to('/editHotel/'.$hotel->id) }}">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a class="btn btn-danger deleteHotel" hotel-id="{{$hotel->id}}"  hotel-name="{{$hotel->name}}" href="#"><i class="fa fa-times"></i></a>
                    </span>
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