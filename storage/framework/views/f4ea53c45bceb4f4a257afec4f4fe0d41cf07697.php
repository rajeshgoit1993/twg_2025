<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Add Review</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="<?php echo e(URL::to('/store_reviews')); ?>" id="store_reviews" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo e($testimonial_id); ?>">
            <?php echo e(csrf_field()); ?>

            <br>
            <div class="row">
              <!-- <div class="col-md-6">
              <div class="form-group" style="margin-top: 10px;">
              <label>Enter Name:</label>
              <input type="text" name="c_name" class="form-control" placeholder="Enter  Name">
              </div>
              </div>  -->
              <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="image">Add Photo & Videos:</label>
                  <input type="file" name="c_image[]" class="form-control" multiple>
                </div>
              </div>
              <!--  <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                <label  for="email">Enter Email Id</label>
                <input type="email" name="c_email" class="form-control" placeholder="Enter  Email Id">
                </div>
                </div> -->
                <!--  <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                <label  for="mobile">Enter Mobile No</label>
                <input type="number" name="c_mobile" class="form-control" placeholder="Enter Mobile No">
                </div>
                </div> -->
                <!--  <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                <label  for="state">Enter Country</label>
                <input type="text" name="c_country" class="form-control" placeholder="Enter  Country">
                </div>
                </div> -->
              <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="state">Choose Rating</label>
                  <select name="c_rating" class="form-control">
                    <option value="1" <?php if($testimonial_data->c_rating==1): ?> selected <?php endif; ?>>1 Star </option>
                    <option value="2" <?php if($testimonial_data->c_rating==2): ?> selected <?php endif; ?>>2 Star </option>
                    <option value="3" <?php if($testimonial_data->c_rating==3): ?> selected <?php endif; ?>>3 Star </option>
                    <option value="3.5" <?php if($testimonial_data->c_rating==3.5): ?> selected <?php endif; ?>>3.5 Star </option>
                    <option value="4" <?php if($testimonial_data->c_rating==4): ?> selected <?php endif; ?>>4 Star  </option>
                    <option value="4.5" <?php if($testimonial_data->c_rating==4.5): ?> selected <?php endif; ?>>4.5 Star  </option>
                    <option value="5" <?php if($testimonial_data->c_rating==5): ?> selected <?php endif; ?>>5 Star </option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="state">Enter About Package</label>
                  <textarea name="c_exp" class="form-control" rows="3" placeholder="Enter About Package"><?php echo e($testimonial_data->c_exp); ?></textarea>
                </div>
              </div>
              <div class="col-md-12 textCenter">
                <button type="submit" name="add" id="remove" class="btn btn-danger btn-sm">Save <i class="fa  fa-arrow-right"></i></button>
              </div>
            </div>
        </div>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
</div>
</div>
<!--</div>-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js'); ?>

<script type="text/javascript">
$("#store_reviews").submit(function(e) {
  e.preventDefault()
  var APP_URL=$("#APP_URL").val();
  var form_data = new FormData($('#store_reviews')[0]);
  $.ajax( {
    url:APP_URL+'/store_reviews',
    data:form_data,
    type:'post',
    contentType: false,
    processData: false,
    success:function(data) {
      if(data=='success') {
        swal({
          title: 'Done !',
          text: 'Thank you! Reviews submitted successfully',
          icon: 'success',
          timer: 1000,
          buttons: false,
        })
        .then(() => {
          window.location.href = APP_URL;
          })
        }
      else {
        swal("Error", data, "error");
        }
      },
      error:function(data) {

      }
    })
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>