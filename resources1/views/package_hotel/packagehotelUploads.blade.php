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
                    <div class="box-body">
                        <a href="{{ URL::to('/package_hotel') }}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>

                        <!-- package_hotel -> packagehotelUpoads -->
                        <div class="box-header" style="padding: 10px 0;">
                          <h3 class="box-title">Gallery Management</h3>
                        </div>
                    
                        <!-- <div class="collapse" id="UploadPhotos">
                            <div class="well">
                                <div class="modal-body">
                                    <form action="{{url('/packagehotelfileUploads')}}"   enctype="multipart/form-data" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="package_id" value="{{Request::segment(2)}}">
                                        <div class="row">
                                            <div class="col-md-1">Country: </div>
                                            <div class="col-md-6">
                                                <select class="form-control" onchange="get_states(this)" name="country">
                                                    <option value='0'>Select Country</option>
                                                    @foreach($countries as $cont)
                                                    <option value="{{ $cont->name }}" c_id="{{ $cont->id }}" >{{ $cont->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-1">State: </div>
                                            <div class="col-md-6">
                                                <select class="form-control st_values" id="" onchange="getcitys(this)" name="state">
                                                    <option value='0'>Select State</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-1">City: </div>
                                            <div class="col-md-6">
                                            <select class="form-control ct_values"  name="city">
                                                <option value='0'>Select City</option>
                                            </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-1">Name: </div>
                                            <div class="col-md-6"><input type="text" name="name" placeholder="Image Name" class="form-control"></div>
                                            </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-1">Choose Image: </div>
                                            <div class="col-md-6"><input type="file" name="uploadimage[]" multiple class="form-control"></div>
                                            </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-6"><button class="btn btn-sm btn-danger">Proceed to upload</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->

                        <!-- <a class="btn btn-success" data-toggle="collapse" href="#UploadPhotos" aria-expanded="false" aria-controls="UploadPhotos"><i class="fa fa-photo"></i> Add Photos From Computer</a>

                        <a href="{{URL::to('packagehotel_image_location/'.Request::segment(2))}}"><button class="btn btn-success">Add Photos From Gallery</button></a> -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- Button to toggle photo upload form -->
                                    <a class="btn btn-success" data-toggle="collapse" href="#UploadPhotos" aria-expanded="false" aria-controls="UploadPhotos"><i class="fa fa-photo"></i> Add Photos From System</a>

                                    <!-- Button to add photos from the gallery -->
                                    <a href="{{URL::to('packagehotel_image_location/'.Request::segment(2))}}">
                                        <button class="btn btn-success">Add Photos From Gallery</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Collapse section for uploading photos -->
                        <div class="collapse" id="UploadPhotos">
                            <div class="well">
                                <div class="modal-body">
                                    
                                    <!-- Form for uploading package images -->
                                    <form action="{{url('/packagehotelfileUploads')}}" enctype="multipart/form-data" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="package_id" value="{{Request::segment(2)}}">

                                        <!-- Country selection -->
                                        <div class="row">
@include('manage_packages.country_state_city_insert_tour_gallery') 



                                        

                                            <div class="col-md-12"></div>
                                        
                                            <!-- Image name -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Image Name </label>
                                                    <input type="text" name="name" placeholder="Image Name" class="form-control">
                                                </div>
                                            </div>
                                        
                                            <!-- File upload -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="uploadimage">Select Image</label>
                                                    <input type="file" class="form-control" name="uploadimage[]" id="uploadimage" accept=".jpg,.jpeg,.png,.webp" multiple>
                                                </div>
                                            </div>

                                            <div class="col-md-12"></div>

                                            <!-- Save button -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="100">ID</th>
                                    <th width="200">Image</th>
                                    <th width="250">Country</th>
                                    <th width="250">State</th>
                                    <th width="250">City</th>
                                    <th>Name</th>
                                    <th width="100">Search Order</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <input id="hotelid" value="52" type="hidden">
                            <?php $coun="1" ?>
                            @foreach($HotelUploads  as $image)
                            <tr id="tr_{{$image->id}}">
                                <td>{{$coun++}}</td>
                                <td>
                                <a href="#" rel="">
                                    @if($image->gallery_id!='')
                                    @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'type')=='video')
                                    <div style="max-width:100%;position: relative;" class="video_icon" >
                                        <input type="hidden" name="" class="video_src" value="{{URL::to('/').'/public/uploads/packages/video/'.CustomHelpers::get_imgpath_gallery($image->gallery_id,'image_main') }}">
                                        <i class="fa fa-play play_video" style="position: absolute;
                                        z-index: 1;color: white;left: 50%;top: 25px;border: 1px solid white;padding: 5px;border-radius: 20px;cursor: pointer;"></i>
                                    </div>
                                    @endif
                                    @if(CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')!="0")
                                        <img class="bdrRadius3" src="{{CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')}}" href="#" width="100" height="75" loading="lazy">
                                    @endif
                                    @else
                                        <img src="{{URL::to('/').'/public/'.$image->image_path}}" href="#" class="img-responsive" loading="lazy">
                                    @endif
                                </a>
                                </td>
                                <td>
                                    @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'country')!="0")
                                    <span class="" id="">
                                    {{CustomHelpers::get_master_table_data('countries', 'id', (int)CustomHelpers::get_imgpath_gallery($image->gallery_id,'country'), 'name')}}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'state')!="0")
                                    <span class="" id="">
                                    {{CustomHelpers::get_master_table_data('states', 'id', (int)CustomHelpers::get_imgpath_gallery($image->gallery_id,'state'), 'name')}}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'city')!="0")
                                    <span class="" id="">
                                    {{CustomHelpers::get_master_table_data('city', 'id', (int)CustomHelpers::get_imgpath_gallery($image->gallery_id,'city'), 'name')}}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')!="0")
                                    <span class="" id="">
                                    {{CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')}}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <!-- @if($image->status==1)

                                    <button class="btn btn-sm btn-success">Enabled</button>
                                    @else
                                    <button class="btn btn-sm btn-danger">Disabled</button>
                                    @endif -->

                                    <span class="btn btn-sm btn-default" style="cursor: default;">{{$image->sort}}</span>
                                        <!-- Conditional button for image sorting -->
                                        <?php if($image->sort != 1): ?>
                                            <button type="button" class="btn btn-sm btn-default up" value="{{$image->id}}">Push to up</button>
                                        <?php endif; ?>

                                </td>
                                <td>
                                    @if($image->gallery_id!='')
                                    <a href="{{URL::to('/edit_packagehotel_gallery_image/'.$image->gallery_id.'/'.$image->package_hotel_id.'/'.$image->id)}}">
                                        <button class="btn btn-sm btn-warning">Edit</button>
                                    </a>
                                    @endif
                                    <form style="display: inline;" action="{{URL::to('/packagehotelfiledelete/'.$image->id.'/'.$image->package_hotel_id)}}" onsubmit="return confirm('Are you sure you want to delete this item?');" method="POST">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-sm  btn-danger deleteImg" id="{{$image->id}}">Delete</button>
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

@section("custom_js_code")

<script type="text/javascript">
// Event listener for when the thumbnail number is changed

// Event listener for clicking the 'push to up' button
$(document).on("click", ".up", function() {
    // Get the package ID
    var pak_id = $(this).val();

    // AJAX request to move the image up in order
    $.ajax({
        type: 'get',
        url: APP_URL + '/up_image_package_hotel', // Endpoint for moving the image up
        data: { pak_id: pak_id }, // Data sent to the server
        success: function(data) {
            // Reload the page upon success
            location.reload();
        },
        error: function(data) {
            // Handle any error
            //console.log('Error : '+data);
        }
    });
});
</script>

@endsection