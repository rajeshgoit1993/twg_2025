<?php $__env->startSection("custom_css_code"); ?>

<style type="text/css">
#overlay {
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
  height: 100%;
  display: none;
  background-color: rgba(0,0,0,0.6);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes  sp-anime {
  100% {
    transform: rotate(360deg);
  }
}
.is-hide{
  display:none;
}

.list-item-image {
  width: 125px;
  height: 70px;
  border-radius: 3px;
  overflow: hidden;
  background-color: #f2f2f2;
}
.list-item-image img, .list-item-image video {
  width: 125px;
  height: 70px;
  object-fit: cover;
}
.list-item-image .videoSize {
  position: absolute;
  top: 5px;
  right: 5px;
  z-index: 1;
  color: #fff;
  font-size: 12px;
  line-height: 15px;
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
        
        <!-- Overlay for loading spinner -->
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        
        <!-- Testimonial Management Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Testimonial</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        <!-- Success and Error Messages -->
                        <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                            <p>Testimonial Deleted Successfully.</p>
                        </div>
                        <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                            <ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
                        </div>
                        
                        <!-- Add Testimonial Button -->
                        <?php if(Sentinel::check() && (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))): ?>
                            <div class="add">
                                <a href="<?php echo e(URL::to('/add_testimonial')); ?>" class="btn btn-success">
                                    <i class="glyphicon glyphicon-plus-sign"></i> Add Testimonial
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Testimonial Table -->
                        <table id="example1" class="table table-bordered table-striped example1">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Guest Name</th>
                                    <th>Email Id</th>
                                    <th>Mobile</th>
                                    <th>Country</th>
                                    <th>Review</th>
                                    <th>Rating</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
                                      <tr>
                                        <td><?php echo e($single->id); ?></td>
                                        <td>
                                          <?php
                                            $testimonialImg = DB::table('testimonial_images')
                                            ->where([['testimonial_id', '=', $single->id], ['default', 1]])
                                            ->first();
                                          ?>
                                          <div class="list-item-image relativeCont">
                                            <?php if($testimonialImg && $testimonialImg->type != ""): ?>
                                              <?php if($testimonialImg->type == 'image'): ?>
                                                <?php 
                                                  // Define default image
                                                  $defaultImage = 'uploads/default-img.webp';
                                                  $imagePath = public_path('uploads/testimonial/thumb/' . $testimonialImg->image_thumb);

                                                  // Check if image exists, otherwise use default image
                                                  $imageSrc = (!empty($testimonialImg->image_thumb) && file_exists($imagePath)) 
                                                              ? 'uploads/testimonial/thumb/' . $testimonialImg->image_thumb 
                                                              : $defaultImage;
                                                 ?>
                                                <img src="<?php echo e(asset('public/' . $imageSrc)); ?>" alt="img">
                                              <?php else: ?>
                                                <?php 
                                                  // Check if the video file exists before displaying
                                                  $videoPath = public_path('uploads/testimonial/' . $testimonialImg->image_or_video);
                                                  $videoExists = (!empty($testimonialImg->image_or_video) && file_exists($videoPath));

                                                  // Get video size in MB
                                                  $videoSize = $videoExists ? round(filesize($videoPath) / 1048576, 2) : 0; // Convert bytes to MB
                                                 ?>

                                                <?php if($videoExists): ?>
                                                  <p class="videoSize"><?php echo e($videoSize); ?> MB</p>
                                                  <video controls>
                                                    <source src="<?php echo e(url('public/uploads/testimonial/'.$testimonialImg->image_or_video)); ?>" type="video/mp4">
                                                    <source src="<?php echo e(url('public/uploads/testimonial/'.$testimonialImg->image_or_video)); ?>" type="video/ogg">
                                                    Your browser does not support the video tag.
                                                  </video>
                                                <?php else: ?>
                                                  <img src="<?php echo e(asset('public/' . $defaultImage)); ?>" alt="Default Image">
                                                <?php endif; ?>
                                              <?php endif; ?>
                                            <?php else: ?>
                                              <?php 
                                                // Define the default image file name
                                                $defaultImage = 'uploads/default-img.webp';
                                                $imagePath = public_path('uploads/testimonial/thumb/' . $single->c_image);

                                                // Check if the image exists in the server; otherwise, use the default image
                                                $imageSrc = (!empty($single->c_image) && file_exists($imagePath)) 
                                                            ? 'uploads/testimonial/thumb/' . $single->c_image 
                                                            : $defaultImage;
                                               ?>
                                              <img src="<?php echo e(asset('public/' . $imageSrc)); ?>" alt="img">
                                            <?php endif; ?>
                                          </div>
                                        </td>
                                        <td><?php echo e($single->c_name); ?></td>
                                        <td><?php echo e($single->c_email); ?></td>
                                        <td><?php echo e($single->c_mobile); ?></td>
                                        <td><?php echo e($single->c_country); ?></td>
                                        <td><?php echo e(substr($single->c_exp, 0, 50)); ?></td>
                                        <td><?php echo e($single->c_rating); ?> star</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm uploads" id="<?php echo e($single->id); ?>">Uploads</button>
                                        </td>
                                        <td>
                                            <?php if($single->status == 1): ?>
                                              <button type="button" class="btn btn-success btn-sm">Enabled</button>
                                            <?php else: ?>
                                              <button type="button" class="btn btn-danger btn-sm">Disabled</button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <!-- <form action="<?php echo e(URL::to('/delete_testimonial/'.$single->id)); ?>" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
                                              <span class="btn-group">
                                              <?php echo e(csrf_field()); ?>

                                              <input type="hidden" name="id" value=""/>
                                              <?php if(Sentinel::check()): ?>
                                              <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                                                <a class="btn btn-default btn-xcrud btn btn-warning" href="<?php echo e(URL::to('/edit_testimonial/'.$single->id)); ?>">
                                                <i class="fa fa-edit"> Edit</i>
                                                </a>
                                                <input type="hidden" value="<?php echo e(url('/user-review/'.CustomHelpers::custom_encrypt($single->id))); ?>" id="copy<?php echo e(CustomHelpers::custom_encrypt($single->id)); ?>">
                                                <button type="button" class="btn btn-success link" link="copy<?php echo e(CustomHelpers::custom_encrypt($single->id)); ?>">Copy Link</button>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                              <?php if(Sentinel::check()): ?>
                                              <?php if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')): ?>
                                                <button type="submit" class="btn btn-danger deletePackage" ><i class="fa fa-times"></i> Delete</button>
                                              <?php endif; ?>
                                              <?php endif; ?>
                                              </span>
                                            </form> -->

                                            <?php if(Sentinel::check() 
                                              && (Sentinel::getUser()->inRole('administrator') 
                                              || Sentinel::getUser()->inRole('supervisor') 
                                              || Sentinel::getUser()->inRole('super_admin'))): ?>

                                              <!-- edit -->
                                              <a href="<?php echo e(URL::to('/edit_testimonial/'.$single->id)); ?>">
                                                <button class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</button>
                                              </a>

                                              <!-- copy link -->
                                              <input type="hidden" value="<?php echo e(url('/user-review/'.CustomHelpers::custom_encrypt($single->id))); ?>" id="copy<?php echo e(CustomHelpers::custom_encrypt($single->id)); ?>">
                                              <button type="button" class="btn btn-success btn-sm link" link="copy<?php echo e(CustomHelpers::custom_encrypt($single->id)); ?>">Copy Link</button>
                                            <?php endif; ?>

                                            <!-- delete -->
                                            <form action="<?php echo e(URL::to('/delete_testimonial/'.$single->id)); ?>" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
                                              <?php echo e(csrf_field()); ?>

                                              <input type="hidden" name="id" value=""/>
                                              <?php if(Sentinel::check() 
                                                && (Sentinel::getUser()->inRole('administrator') 
                                                || Sentinel::getUser()->inRole('super_admin'))): ?>
                                                <button type="submit" class="btn btn-danger btn-sm deletePackage">Delete</button>
                                              <?php endif; ?>
                                            </form>
                                        </td>
                                      </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <th colspan="9" class="text-center text-danger">No Testimonial Found</th>
                                    </tr>
                                  <?php endif; ?>
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

<!-- Upload Modal -->
<div class="modal fade" id="uploads" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Images</h4>
      </div>
      <form method="post" action="#" id="uploads_image" name="uploads_image" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="id" value="" id="item_id">
        <input type="hidden" name="image_type" value="0">
        <div class="modal-body">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Item Images</label>
              <input type="file" name="images[]" id="images" class="form-control" required multiple>
            </div>
          </div>
          <div class="col-lg-12 uploads_body"></div>
            <div align="center">
              <button type="button" class="btn btn-info btn-lg">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>
<script type="text/javascript">
/*$(document).on("click",".delete_image",function(e) {
  e.preventDefault()
  var id =$(this).attr('id')
  var button=$(this)
  var result = confirm("Want to delete?");
  if (result) {
  var APP_URL=$("#APP_URL").val();
  $.ajax({
    url:APP_URL+'/delete_item_image',
    data:{id:id},
    type:'post',
    // contentType: false,
    // processData: false,
    success:function(data) {
      button.parent().parent().css("display","none")
    },
    error:function(data) {
    }
  })
  }
});*/

$(document).on("click", ".delete_image", function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var button = $(this);
    var result = confirm("Want to delete?");
    
    if (result) {
        var APP_URL = $("#APP_URL").val();
        $.ajax({
            url: APP_URL + '/delete_item_image',
            type: 'POST',
            data: {
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function (data) {
                // Remove the image container smoothly
                button.closest(".image-container").fadeOut(300, function () {
                    $(this).remove();
                });
            },
            error: function (xhr, status, error) {
                alert("Failed to delete the image. Please try again.");
                console.error(xhr.responseText);
            }
        });
    }
});

/**********************/

/*$(document).on("click",".uploads",function() {
  var id=$(this).attr('id')
  $('#images').val('')
  $("#item_id").val("").val(id)
  //
  var APP_URL=$("#APP_URL").val();
  $.ajax({
    url:APP_URL+'/get_item_image',
    data:{id:id,image_type:0},
    type:'post',
    // contentType: false,
    // processData: false,
    success:function(data) {
      console.log(data)
      $(".uploads_body").html('').html(data)
    },
    error:function(data) {
    }
  })
  $('#uploads').modal('toggle');
});*/

$(document).on("click", ".uploads", function () {
    var id = $(this).attr('id');

    // Clear file input and set item ID
    $('#images').val('');
    $("#item_id").val(id);

    var APP_URL = $("#APP_URL").val();
    
    $.ajax({
        url: APP_URL + '/get_item_image',
        type: 'POST',
        data: {
            id: id,
            image_type: 0,
            _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        beforeSend: function () {
            $(".uploads_body").html('<p class="text-center">Loading...</p>'); // Show loading message
        },
        success: function (data) {
            $(".uploads_body").html(data); // Insert received content
        },
        error: function (xhr, status, error) {
            $(".uploads_body").html('<p class="text-danger text-center">Failed to load images. Please try again.</p>');
            console.error(xhr.responseText);
        }
    });

    $('#uploads').modal('toggle');
});


/**********************/

/*$('#btn_login_details').click(function() {
  $('#uploads').modal('hide');
  $("#overlay").fadeIn(300);
  var form_data = new FormData($("#uploads_image")[0]);
  var APP_URL=$("#APP_URL").val();
  $.ajax({
    url:APP_URL+'/uploads_list_image',
    data:form_data,
    type:'post',
    contentType: false,
    processData: false,
    success:function(data) {
      $("#overlay").fadeOut(300);
      if(data=='success') {
      // swal("Done !", 'Successfully Images Uploaded', "success");
      // get_data('nochange')
      // var url=APP_URL+'/Utensil-List';
      // window.location.href = url;
      location.reload('/')
      } else {
      swal("Error", data, "error");
      }
    },
    error:function(data) {
    }
  })
});*/


$('#btn_login_details').click(function() {
    $('#uploads').modal('hide'); // Hide modal
    $("#overlay").fadeIn(300); // Show overlay loader

    var form_data = new FormData($("#uploads_image")[0]);
    var APP_URL = $("#APP_URL").val();

    // Add CSRF token
    form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url: APP_URL + '/uploads_list_image',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        beforeSend: function() {
            swal({
                title: "Uploading...",
                text: "Please wait while we upload your images.",
                icon: "info",
                buttons: false,
                timer: 3000
            });
        },
        success: function(response) {
            $("#overlay").fadeOut(300); // Hide overlay

            if (response === 'success') {
                swal("Success!", "Images uploaded successfully.", "success").then(() => {
                    location.reload(); // Refresh page
                });
            } else {
                swal("Error", response, "error");
            }
        },
        error: function(xhr) {
            $("#overlay").fadeOut(300); // Hide overlay on error
            swal("Error", "Something went wrong! Please try again.", "error");
            console.error(xhr.responseText);
        }
    });
});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>