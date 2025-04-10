<?php $__env->startSection("custom_css_code"); ?>

<style type="text/css">
.list-item-image {
    width: 125px;
    height: 70px;
    border-radius: 3px;
    object-fit: cover;
    background-color: #f2f2f2;
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
                        <a href="<?php echo e(URL::to('/tours')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
                        
                        <!-- manage_package -> packageUploads -->
                        <div class="box-header" style="padding: 10px 0;">
                            <h3 class="box-title">Tour Gallery Management</h3>
                            <h3 class="box-title">(<?php echo e(CustomHelpers::get_package_title(Request::segment(2))); ?>)</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- Button to toggle photo upload form -->
                                    <a class="btn btn-success" data-toggle="collapse" href="#UploadPhotos" aria-expanded="false" aria-controls="UploadPhotos"><i class="fa fa-photo"></i> Add Photos From System</a>

                                    <!-- Button to add photos from the gallery -->
                                    <a href="<?php echo e(URL::to('package_image_location/'.Request::segment(2))); ?>">
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
                                    <form action="<?php echo e(url('/packagefile_upload')); ?>" enctype="multipart/form-data" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="package_id" value="<?php echo e(Request::segment(2)); ?>">

                                        <!-- Country selection -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <select class="form-control" name="country" id="country" onchange="get_states(this)" required >
                                                        <option value="">Select Country</option>
                                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                            <option value="<?php echo e($cont->name); ?>" c_id="<?php echo e($cont->id); ?>"><?php echo e($cont->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <!-- State selection -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <select class="form-control st_values" name="state" id="state" onchange="getcitys(this)" required >
                                                        <option value="">Select State</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <!-- City selection -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <select class="form-control ct_values" name="city" id="city" required >
                                                        <option value="">Select City</option>
                                                    </select>
                                                </div>
                                            </div>

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
                                <?php $__currentLoopData = $packageUpload; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr id="tr_<?php echo e($image->id); ?>">
                                    <td><?php echo e($coun++); ?></td>
                                    <td>
                                        <a href="#" rel="">
                                            <!-- Check if thumbnail exists -->
                                            <?php if(CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')!="0"): ?>
                                                <img src="<?php echo e(CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')); ?>" class="list-item-image">
                                            <?php endif; ?>
                                        </a>
                                    </td>

                                    <!-- Display country name if available -->
                                    <td>
                                        <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'country')!="0"): ?>
                                            <span><?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'country')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Display state name if available -->
                                    <td>
                                        <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'state')!="0"): ?>
                                            <span><?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'state')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Display city name if available -->
                                    <td>
                                        <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'city')!="0"): ?>
                                            <span><?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'city')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Display image name if available -->
                                    <td>
                                        <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')!="0"): ?>
                                            <span><?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <span class="btn btn-sm btn-default" style="cursor: default;"><?php echo e($image->sort); ?></span>
                                        <!-- Conditional button for image sorting -->
                                        <?php if($image->sort != 1): ?>
                                            <button type="button" class="btn btn-sm btn-default up" value="<?php echo e($image->id); ?>">Push to up</button>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Thumbnail number dropdown -->
                                    <td>
                                        <input type="hidden" class="thumb_id" value="<?php echo e($image->id); ?>">
                                        <select id="thumb_no" class="form-control thumb_no">
                                            <option value="">Select Thumb No</option>
                                            <option value="1" <?php if($image->thumb_no==1): ?> selected <?php endif; ?>>Thumb 1</option>
                                            <option value="2" <?php if($image->thumb_no==2): ?> selected <?php endif; ?>>Thumb 2</option>
                                            <option value="3" <?php if($image->thumb_no==3): ?> selected <?php endif; ?>>Thumb 3</option>
                                            <option value="4" <?php if($image->thumb_no==4): ?> selected <?php endif; ?>>Thumb 4</option>
                                            <option value="5" <?php if($image->thumb_no==5): ?> selected <?php endif; ?>>Thumb 5</option>
                                        </select>
                                    </td>

                                    <!-- Action buttons for editing or deleting images -->
                                    <td>
                                        <a href="<?php echo e(URL::to('/edit_package_gallery_image/'.$image->gallery_id.'/'.$image->package_id.'/'.$image->id)); ?>">
                                            <button class="btn btn-sm btn-success">Edit</button>
                                        </a>
                                        <form style="display: inline;" action="<?php echo e(URL::to('/packagefiledelete/'.$image->id.'/'.$image->package_id)); ?>" onsubmit="return confirm('Do you really want to delete this?');" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                            <button type="submit" class="btn btn-sm btn-danger deleteImg" id="<?php echo e($image->id); ?>">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js_code"); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>