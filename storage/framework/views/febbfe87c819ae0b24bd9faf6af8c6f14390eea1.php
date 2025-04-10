<?php $__env->startSection('content'); ?>

<style type="text/css">
  .typeImage {
    border: 1px solid #ccc;
    width: 100px;
    height: 75px;
    overflow: hidden;
    border-radius: 5px;
    background-color: #f2f2f2;
  }
  .typeImage img {
    width: 100px;
    height: 75px;
    object-fit: cover;
  }
</style>

<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Tour Theme</h3>
				</div>
				<div class="box-body">
					<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
						<p>Theme Data Deleted Successfully.</p>
					</div>
					<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
						<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
					</div>

					<table id="example1" class="example1 table table-bordered table-striped">
						<?php if(Sentinel::check()): ?>
						<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
						<div class="add">
							<a href="<?php echo e(route('newTheme')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Theme</a>
						</div>
						<?php endif; ?>
						<?php endif; ?>
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Image</th>
								<th width="100">Theme</th>
								<th width="100">Paragraph 1</th>
								<th width="100">Paragraph 2</th>
								<th width="100">About(Front End)</th>
								<th width="200">Title(SEO)</th>
								<th width="200">Key(SEO)</th>
								<th width="200">Description(SEO)</th>
								<th width="100">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php $i="1"; ?>
						<?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
							<tr>
								<td><?php echo e($i++); ?></td>
								<td>
									<div class="typeImage">
							    	<?php 
							        // Define the default image file name
							        $defaultImage = 'uploads/default-img.webp';
							        $imagePath = public_path('uploads/theme/' . $single->theme_image);

							        // Check if the image exists; otherwise, use the default image
							        $image = (!empty($single->theme_image) && file_exists($imagePath)) 
							                 ? 'uploads/theme/' . $single->theme_image 
							                 : $defaultImage;
							    	 ?>
							    <img src="<?php echo e(asset('public/' . $image)); ?>" alt="img">
							    <input type="hidden" name="edit_img_value" class="edit_img_value" value="<?php echo e($image); ?>">
								</div>

								</td>
								<td><?php echo e($single->theme_name); ?></td>
								<td><?php echo e($single->theme_para1); ?></td>
								<td><?php echo e($single->theme_para2); ?></td>
								<td><?php echo substr($single->about_theme,0,50); ?> <?php if(strlen($single->about_theme)>50): ?> ... <?php endif; ?></td>
								<td><?php echo e($single->title); ?></td>
								<td><?php echo e($single->theme_key); ?></td>
								<td><?php echo e(substr($single->theme_desc,0,50)); ?> <?php if(strlen($single->theme_desc)>50): ?> ... <?php endif; ?></td>
								<td>
									<form action="<?php echo e(route('deleteTheme', $single->id)); ?> " onsubmit="return confirm('Are you sure, you want to delete this theme?');" method="post">
										<?php echo e(csrf_field()); ?>

										<input type="hidden" name="id" value=""/>
											<a class="" href="<?php echo e(route('editTheme', $single->id)); ?>">
												<button type="button" class="btn btn-sm btn-warning">Edit</button>
											</a>
										<?php if(Sentinel::check()): ?>
										<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
											<button type="submit" class="btn btn-sm btn-danger deletePackage">Delete</button>
										<?php endif; ?>
										<?php endif; ?>
									</form>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
							<tr>
								<th colspan="9" class="text-center text-danger">Theme not available</th>
							</tr>
						<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>