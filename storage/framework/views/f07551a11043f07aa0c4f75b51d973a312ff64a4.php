  

  <?php $__env->startSection("custom_css_code"); ?>

  <style type="text/css">
    .destination-img-wrapper {
      width: 100%;
      height: 200px;
      border-radius: 5px;
      overflow: hidden;
      /*background-image: var(--default-image);*/
      background-image: url('<?php echo e(asset("public/uploads/default-img.webp")); ?>');
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      border: 1px solid #ccc;
    }
    .destination-img {
      width: 100%;
      height: 200px;
    }
    .custom_border {
      border:1px solid lightgray;
      padding: 10px
    }
    .custom_border .grid-width {
      min-width: 105px;
    }
    .custom_border .dropzone {
      height: 34px;
      min-height: 34px;
      padding: 8px;
      border: 1px solid #d2d6de;
    }
    .custom_border .dz-message {
      display:none;
    }
    .custom_border p {
      pointer-events: none;
    }
    table td {
      vertical-align: middle !important;
    }
  </style>

  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    <?php $__currentLoopData = $img_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
      <div class="row">
        <!-- <div class="col-md-12 form-group"></div> -->

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title1" <?php if($img->row1_title1!=""): ?> value="<?php echo e($img->row1_title1); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc1"  <?php if($img->row1_desc1!=""): ?> value="<?php echo e($img->row1_desc1); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest1" <?php if($img->row1_dest1!=""): ?> value="<?php echo e($img->row1_dest1); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
              <form action="<?php echo e(url('/mid_image_save/row1_image1')); ?>" class="dropzone" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <p>Select Image</p>
              </form>
            </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            <?php if(!empty($img->row1_image1)): ?>
              <img class="destination-img" alt="img" src="<?php echo e(asset('public/'.$img->row1_image1)); ?>">
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-3 custom_border">
                <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <td class="grid-width">Enter Title</td>
                    <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title2" <?php if($img->row1_title2!=""): ?> value="<?php echo e($img->row1_title2); ?>" <?php endif; ?>></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Enter Image Description</td>
                    <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc2" <?php if($img->row1_desc2!=""): ?> value="<?php echo e($img->row1_desc2); ?>" <?php endif; ?>></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Enter Destination</td>
                    <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest2" <?php if($img->row1_dest2!=""): ?> value="<?php echo e($img->row1_dest2); ?>" <?php endif; ?>></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Select Image<br>(300px * 300px)</td>
                    <td>
                    <form action="<?php echo e(url('/mid_image_save/row1_image2')); ?>" class="dropzone" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                      <p>Select Image</p>
                    </form>
                  </td>
                  </tr>
                </tbody>
                </table>
                <div class="destination-img-wrapper">
                  <?php if(!empty($img->row1_image2)): ?>
                    <img class="destination-img" alt="img" src="<?php echo e(asset('public/'.$img->row1_image2)); ?>">
                  <?php endif; ?>
                </div>
        </div>

        <div class="col-md-3 custom_border">
                <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <td class="grid-width">Enter Title</td>
                    <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title3" <?php if($img->row1_title3!=""): ?> value="<?php echo e($img->row1_title3); ?>" <?php endif; ?>></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Enter Image Description</td>
                    <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc3" <?php if($img->row1_desc3!=""): ?> value="<?php echo e($img->row1_desc3); ?>" <?php endif; ?>></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Enter Destination</td>
                    <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest3" <?php if($img->row1_dest3!=""): ?> value="<?php echo e($img->row1_dest3); ?>" <?php endif; ?>></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Select Image<br>(300px * 300px)</td>
                    <td>
                    <form action="<?php echo e(url('/mid_image_save/row1_image3')); ?>" class="dropzone" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                      <p>Select Image</p>
                    </form>
                  </td>
                  </tr>
                </tbody>
                </table>
                <div class="destination-img-wrapper">
                  <?php if(!empty($img->row1_image3)): ?>
                    <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row1_image3); ?>">
                  <?php endif; ?>
                </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title1" <?php if($img->row2_title1!=""): ?> value="<?php echo e($img->row2_title1); ?>" <?php endif; ?> ></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc1" <?php if($img->row2_desc1!=""): ?> value="<?php echo e($img->row2_desc1); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest1" <?php if($img->row2_dest1!=""): ?> value="<?php echo e($img->row2_dest1); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="<?php echo e(url('/mid_image_save/row2_image1')); ?>" class="dropzone" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <p>Select Image</p>
                </form>
              </td>
            </tr>
          </tbody>
          </table>
                <div class="destination-img-wrapper">
          <?php if(!empty($img->row2_image1)): ?>
            <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row2_image1); ?>">
          <?php endif; ?>
          </div>
        </div>

        <div class="col-md-12 form-group"></div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title2" <?php if($img->row2_title2!=""): ?> value="<?php echo e($img->row2_title2); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc2" <?php if($img->row2_desc2!=""): ?> value="<?php echo e($img->row2_desc2); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest2" <?php if($img->row2_dest2!=""): ?> value="<?php echo e($img->row2_dest2); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="<?php echo e(url('/mid_image_save/row2_image2')); ?>" class="dropzone" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                    <p>Select Image</p>
                 </form>

                </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            <?php if(!empty($img->row2_image2)): ?>
              <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row2_image2); ?>">
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title3" <?php if($img->row2_title3!=""): ?> value="<?php echo e($img->row2_title3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc3" <?php if($img->row2_desc3!=""): ?> value="<?php echo e($img->row2_desc3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest3" <?php if($img->row2_dest3!=""): ?> value="<?php echo e($img->row2_dest3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td width="22%" >Select Image<br>(300px * 300px)</td>
              <td>
                <form action="<?php echo e(url('/mid_image_save/row2_image3')); ?>" class="dropzone" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                    <p>Select Image</p>
                 </form>
              </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            <?php if(!empty($img->row2_image3)): ?>
              <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row2_image3); ?>">
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-3 custom_border">
              <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td class="grid-width">Enter Title</td>
                  <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title1" <?php if($img->row3_title1!=""): ?> value="<?php echo e($img->row3_title1); ?>" <?php endif; ?>></td>
                </tr>
                <tr>
                  <td class="grid-width">Enter Image Description</td>
                  <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc1" <?php if($img->row3_desc1!=""): ?> value="<?php echo e($img->row3_desc1); ?>" <?php endif; ?>></td>
                </tr>
                <tr>
                  <td class="grid-width">Enter Destination</td>
                  <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest1" <?php if($img->row3_dest1!=""): ?> value="<?php echo e($img->row3_dest1); ?>" <?php endif; ?>></td>
                </tr>
                <tr>
                  <td class="grid-width">Select Image<br>(300px * 300px)</td>
                  <td>
                    <form action="<?php echo e(url('/mid_image_save/row3_image1')); ?>" class="dropzone" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                        <p>Select Image</p>
                     </form>

                  </td>
                </tr>
              </tbody>
              </table>
              <div class="destination-img-wrapper">
                <?php if(!empty($img->row3_image1)): ?>
                  <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row3_image1); ?>">
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-3 custom_border">
              <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td class="grid-width">Enter Title</td>
                  <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title2" <?php if($img->row3_title2!=""): ?> value="<?php echo e($img->row3_title2); ?>" <?php endif; ?>></td>
                </tr>
                <tr>
                  <td class="grid-width">Enter Image Description</td>
                  <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc2" <?php if($img->row3_desc2!=""): ?> value="<?php echo e($img->row3_desc2); ?>" <?php endif; ?>></td>
                </tr>
                <tr>
                  <td class="grid-width">Enter Destination</td>
                  <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest2" <?php if($img->row3_dest2!=""): ?> value="<?php echo e($img->row3_dest2); ?>" <?php endif; ?>></td>
                </tr>
                <tr>
                  <td class="grid-width">Select Image<br>(300px * 300px)</td>
                  <td>
                    <form action="<?php echo e(url('/mid_image_save/row3_image2')); ?>" class="dropzone" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                        <p>Select Image</p>
                     </form>

                    </td>
                </tr>
              </tbody>
              </table>
              <div class="destination-img-wrapper">
                <?php if(!empty($img->row3_image2)): ?>
                  <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row3_image2); ?>">
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-12 form-group"></div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title3" <?php if($img->row3_title3!=""): ?> value="<?php echo e($img->row3_title3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc3" <?php if($img->row3_desc3!=""): ?> value="<?php echo e($img->row3_desc3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest3" <?php if($img->row3_dest3!=""): ?> value="<?php echo e($img->row3_dest3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image (300px x 300px)</td>
              <td>
                <form action="<?php echo e(url('/mid_image_save/row3_image3')); ?>" class="dropzone" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                    <p>Select Image</p>
                </form>
              </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            <?php if($img->row3_image3==""): ?>
              <img class='destination-img' alt="img" src="<?php echo e(asset('public/uploads/default_profile_image.png')); ?>">
            <?php else: ?>
              <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row3_image3); ?>">
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title1" <?php if($img->row4_title1!=""): ?> value="<?php echo e($img->row4_title1); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc1" <?php if($img->row4_desc1!=""): ?> value="<?php echo e($img->row4_desc1); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest1" <?php if($img->row4_dest1!=""): ?> value="<?php echo e($img->row4_dest1); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="<?php echo e(url('/mid_image_save/row4_image1')); ?>" class="dropzone" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                    <p>Select Image</p>
                 </form>
                </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            <?php if(!empty($img->row4_image1)): ?>
              <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row4_image1); ?>">
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title2" <?php if($img->row4_title2!=""): ?> value="<?php echo e($img->row4_title2); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc2" <?php if($img->row4_desc2!=""): ?> value="<?php echo e($img->row4_desc2); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest2" <?php if($img->row4_dest2!=""): ?> value="<?php echo e($img->row4_dest2); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="<?php echo e(url('/mid_image_save/row4_image2')); ?>" class="dropzone" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                    <p>Select Image</p>
                 </form>
                </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            <?php if(!empty($img->row4_image2)): ?>
              <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row4_image2); ?>">
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title3" <?php if($img->row4_title3!=""): ?> value="<?php echo e($img->row4_title3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc3" <?php if($img->row4_desc3!=""): ?> value="<?php echo e($img->row4_desc3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest3" <?php if($img->row4_dest3!=""): ?> value="<?php echo e($img->row4_dest3); ?>" <?php endif; ?>></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="<?php echo e(url('/mid_image_save/row4_image3')); ?>" class="dropzone" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                    <p>Select Image</p>
                 </form>
              </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            <?php if(!empty($img->row4_image3)): ?>
              <img class='destination-img' alt="img" src="<?php echo e(asset('/public/').$img->row4_image3); ?>">
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>