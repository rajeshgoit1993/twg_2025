<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Subscriber List</h3>
					</div>
					<div class="box-body">
						<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none"></div>
						<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
							<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
						</div>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
								<th>ID</th>
								<th>Subscriber Email Id</th>
								<th>Subscribtion Date</th>
								<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
								<tr>
									<td><?php echo e($single->id); ?></td>
									<td><?php echo e($single->sub_email); ?></td>
									<td><?php echo e($single->created_at); ?></td>
									<td>
										<form action="<?php echo e(URL::to('/delete_sub/'.$single->id)); ?>" onsubmit="return confirm('Are you sure you want to delete this?');" method="post">
											<span class="btn-group">
											<?php echo e(csrf_field()); ?>

											<button type="submit" class="btn btn-danger deletePackage"><i class="fa fa-times"></i> Delete</button>
											</span>
										</form>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
								<tr>
									<th colspan="9" class="text-center text-danger">No Record Found</th>
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