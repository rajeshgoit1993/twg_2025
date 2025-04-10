<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header"></div>
				<!-- /.box-header -->
				<div class="box-body">
					<a href="<?php echo e(URL::to('/img_gallery')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
					<div class="box-header" style="padding: 10px 0;">
						<h3 class="box-title">Add Video In Gallery</h3>
					</div>
					<div class="well">
						<div class="modal-body">
							<form action="<?php echo e(URL::to('/store_video_image_gallery/')); ?>" enctype="multipart/form-data" method="POST" >
								<?php echo e(csrf_field()); ?>


								<div class="row">
									<!-- Country selection -->			
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
											<input type="text" class="form-control" name="name" placeholder="Image Name" required>
										</div>
									</div>

									<!-- Thumb File upload -->
									<div class="col-md-2">
										<div class="form-group">
											<label for="image_thumb">Select Video Thumb</label>
											<input type="file" class="form-control" name="image_thumb" id="image_thumb" accept="" required>
										</div>
									</div>

									<!-- Video File upload -->
									<div class="col-md-2">
										<div class="form-group">
											<label for="upload_video">Select Video</label>
											<input type="file" class="form-control" name="uploadvideo" id="upload_video" accept="" required>
										</div>
									</div>

									<div class="col-md-12"></div>

									<!-- Save button -->
									<div class="col-md-4">
										<div class="form-group">
										<button class="btn btn-success">Proceed to add video</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>