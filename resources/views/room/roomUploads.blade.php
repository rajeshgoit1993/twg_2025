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
                    <h3 class="box-title">Gallery Management</h3>
                    <div class="panel-body">
                        <div class="collapse" id="UploadPhotos">
                          <div class="well well-sm">
                              <div class="modal-body">
                                <div class="bdr_upload">
                                   <form action="{{url('/roomfileUploads')}}" class="dropzone" id="add-image" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="room_id" value="{{Request::segment(2)}}">

                                    </form>
                                </div>
                              </div>
                          </div>
                        </div>
                         <!-- {{dump($images)}}  -->
                        
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                  <th class="col-md-2">
                                    <a class="btn btn-success" data-toggle="collapse" href="#UploadPhotos" aria-expanded="false" aria-controls="UploadPhotos">
                                        <i class="fa fa-photo"></i> Add Photos
                                    </a>
                                    <div class="clearfix"></div>
                                  </th>
                                  <th class="col-md-2 text-center">Thumbnail</th>                                  
                                  <th class="col-md-2 text-center">Image id</th>
                                  <th class="col-md-2 text-center">Hotel ID</th>
                                  <th class="col-md-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <!-- <input id="hotelid" value="52" type="hidden"> -->

                              
                              @foreach($images as $key=>$image) 
                              <tr id="tr_{{$image->id}}">
                                <td>
                                    <a href="#" rel=""> 
                                      <img src="{{URL::to('/').'/public'.$image->image_path}}" href="#" class="img-responsive">
                                    </a>
                                </td>
                                 <td style="padding:35px">
                                    <button class="btn btn-default btn-block btn-md btnthumb" id=""> No </button>
                                </td>
                              
                                <td style="padding:35px">
                                    <span class="" id="">{{$image->id}} </span>
                                </td>
                                <td style="padding:35px">
                                    <span class="" id=""> {{$image->hotel_id}} </span>
                                </td>
                                  <td style="padding:35px">
                                   
                                    <form action="{{url('/deleteRoomImage')}}" method="post" onsubmit="return confirm('Do you really want to delete this.?');">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{$image->id}}">
                                        <input type="hidden" name="RoomId" value="{{$roomId}}">
                                       
                                        <button type="submit" class="btn btn-danger btn-block btn-md deleteImg" id="{{$image->id}}" name=""> Delete </button>
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
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection