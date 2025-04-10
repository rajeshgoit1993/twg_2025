@extends('layouts.master')


@section("custom_css_code")

<style type="text/css">
.list-item-image {
    width: 125px;
    height: 70px;
    border-radius: 3px;
    object-fit: cover;
    background-color: #f2f2f2;
}
</style>

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                
                <!-- Panel for package gallery management -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                        <!-- Back button -->
                        <a href="{{URL::to('/tours')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
                        
                        <!-- manage_package -> packageUploads -->
                        <div class="box-header" style="padding: 10px 0;">
                            <h3 class="box-title">Tour Gallery Management</h3>
                            <h3 class="box-title">({{ CustomHelpers::get_package_title(Request::segment(2)) }})</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- Button to toggle photo upload form -->
                                    <a class="btn btn-success" data-toggle="collapse" href="#UploadPhotos" aria-expanded="false" aria-controls="UploadPhotos"><i class="fa fa-photo"></i> Add Photos From System</a>

                                    <!-- Button to add photos from the gallery -->
                                    <a href="{{URL::to('package_image_location/'.Request::segment(2))}}">
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
                                    <form action="{{ url('/packagefile_upload') }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="package_id" value="{{ Request::segment(2) }}">

                                        <!-- Country selection -->
                                        <div class="row">

                                          @include('manage_packages.country_state_city_insert_tour_gallery')  

                                            

                                            <div class="col-md-12"></div>
                                        
                                            <!-- Image name -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Image Name </label>
                                                    <input type="text" class="form-control"  name="name" placeholder="Image Name" required>
                                                </div>
                                            </div>
                                        
                                            <!-- File upload -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="uploadimage">Select Image</label>
                                                    <input type="file" class="form-control" name="uploadimage[]" id="uploadimage" accept=".jpg,.jpeg,.png,.webp" multiple required>
                                                </div>
                                            </div>

                                            <div class="col-md-12"></div>

                                            <!-- Save button -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button class="btn btn-success">Proceed to add photo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="clearfix"></div> -->

                        <!-- Table displaying uploaded images -->
                        <table class="table table-bordered table-striped example2 table-hover">
                            <thead>
                                <tr>
                                    <th width="50">ID</th>
                                    <th width="150">Image</th>
                                    <th width="300">Country</th>
                                    <th width="150">State</th>
                                    <th width="150">City</th>
                                    <th width="300">Name</th>
                                    <th width="150">Search Order</th>
                                    <th width="200">Thumb No.</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Hidden field to hold hotel ID -->
                                <input id="hotelid" value="52" type="hidden">

                                <!-- Counter for image rows -->
                                <?php $coun="1"; ?>

                                <!-- Loop through the uploaded images -->
                                @foreach($packageUpload as $image)
                                <tr id="tr_{{$image->id}}">
                                    <td>{{$coun++}}</td>
                                    <td>
                                        <a href="#" rel="">
                                            <!-- Check if thumbnail exists -->
                                            

                                            @if(CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')!="0")
                                            <?php 
                                           
$path=CustomHelpers::get_image_gallery($image->gallery_id,'thum_small');
                                            ?>
                                                <img src="{{$path}}" class="list-item-image">
                                            @endif
                                        </a>
                                    </td>

                                    <!-- Display country name if available -->
                                    

                                    <td>
                                        @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'country')!="0")
                                            <span>{{CustomHelpers::get_master_table_data('countries', 'id', (int)CustomHelpers::get_imgpath_gallery($image->gallery_id,'country'), 'name')}}</span>
                                        @endif
                                    </td>

                                    <!-- Display state name if available -->
                                    <td>
                                        @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'state')!="0")
                                            <span>{{CustomHelpers::get_master_table_data('states', 'id', (int)CustomHelpers::get_imgpath_gallery($image->gallery_id,'state'), 'name')}}</span>
                                        @endif
                                    </td>

                                    <!-- Display city name if available -->
                                    <td>
                                        @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'city')!="0")
                                            <span>{{CustomHelpers::get_master_table_data('city', 'id', (int)CustomHelpers::get_imgpath_gallery($image->gallery_id,'city'), 'name')}}</span>
                                        @endif
                                    </td>

                                    <!-- Display image name if available -->
                                    <td>
                                        @if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')!="0")
                                            <span>{{CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')}}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="btn btn-sm btn-default" style="cursor: default;">{{$image->sort}}</span>
                                        <!-- Conditional button for image sorting -->
                                        <?php if($image->sort != 1): ?>
                                            <button type="button" class="btn btn-sm btn-default up" value="{{$image->id}}">Push to up</button>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Thumbnail number dropdown -->
                                    <td>
                                        <input type="hidden" class="thumb_id" value="{{$image->id}}">
                                        <select id="thumb_no" class="form-control thumb_no">
                                            <option value="">Select Thumb No</option>
                                            <option value="1" @if($image->thumb_no==1) selected @endif>Thumb 1</option>
                                            <option value="2" @if($image->thumb_no==2) selected @endif>Thumb 2</option>
                                            <option value="3" @if($image->thumb_no==3) selected @endif>Thumb 3</option>
                                            <option value="4" @if($image->thumb_no==4) selected @endif>Thumb 4</option>
                                            <option value="5" @if($image->thumb_no==5) selected @endif>Thumb 5</option>
                                        </select>
                                    </td>

                                    <!-- Action buttons for editing or deleting images -->
                                    <td>
                                        <a href="{{URL::to('/edit_package_gallery_image/'.$image->gallery_id.'/'.$image->package_id.'/'.$image->id)}}">
                                            <button class="btn btn-sm btn-success">Edit</button>
                                        </a>
                                        <form style="display: inline;" action="{{URL::to('/packagefiledelete/'.$image->id.'/'.$image->package_id)}}" onsubmit="return confirm('Do you really want to delete this?');" method="POST">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-sm btn-danger deleteImg" id="{{$image->id}}">Delete</button>
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
$(document).on("change", ".thumb_no", function() {
    // Get the thumbnail ID and selected thumbnail number
    var thumb_id = $(this).siblings(".thumb_id").val();
    var thumb_no = $(this).val();

    // AJAX request to update the thumbnail number
    $.ajax({
        type: 'get',
        url: APP_URL + '/change_thumb_no', // Endpoint for changing the thumbnail number
        data: { thumb_no: thumb_no, thumb_id: thumb_id }, // Data sent to the server
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

// Event listener for clicking the 'push to up' button
$(document).on("click", ".up", function() {
    // Get the package ID
    var pak_id = $(this).val();

    // AJAX request to move the image up in order
    $.ajax({
        type: 'get',
        url: APP_URL + '/up_image', // Endpoint for moving the image up
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