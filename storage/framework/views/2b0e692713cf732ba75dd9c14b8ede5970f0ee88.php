<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Currency Conversion</h3>
			</div>
			<div class="box-body">
				<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
					<p>Currency Deleted Successfully</p>
				</div>
				<div class="alert alert-danger error-contaier-parenterror-contaier-parent-hotel" style="display:none">
					<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
				</div>
				<table id="example1" class="table table-bordered table-striped">
				<?php if(Sentinel::check()): ?>
				<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
				<div class="add">
					<a href="<?php echo e(URL::to('/add-currency')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Currency</a>
				</div>
				<?php endif; ?>
				<?php endif; ?>
				<thead>
					<tr>
						<th>#</th>
						<th>Currency Type</th>
						<th>Rates</th>
						<th>Updated At</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
				<tr>
					<td><?php echo e($single->id); ?></td>
					<td><?php echo e($single->currency); ?></td>
					<td><?php echo e($single->rate); ?></td>
					<td><?php echo e($single->updated_at); ?></td>
					<td>
						<form action="<?php echo e(URL::to('/delete-currency/'.$single->id)); ?>" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
							<span class="btn-group">
							<?php echo e(csrf_field()); ?>

							<input type="hidden" name="id" value=""/>
							<?php if(Sentinel::check()): ?>
							<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
							<a class="btn btn-default btn-xcrud btn btn-warning" href="<?php echo e(URL::to('/editcurrency/'.$single->id)); ?>"><i class="fa fa-edit"> Edit</i></a>
							<?php endif; ?>
							<?php endif; ?>
							<?php if(Sentinel::check()): ?>
							<?php if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin')): ?>
							<button type="submit" class="btn btn-danger deletePackage"><i class="fa fa-times"></i> Delete</button>
							<?php endif; ?>
							<?php endif; ?>
							</span>
						</form>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
				<tr>
					<th colspan="6" class="text-center text-danger">Currency Conversion list not found</th>
				</tr>
				<?php endif; ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!--Transport Managed-->
<?php if(Sentinel::check()): ?>
<?php if(Sentinel::getUser()->inRole('super_admin')): ?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
			<h3 class="box-title">Transport List</h3>
			</div>
			<div class="box-body">
				<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
					<p>Transport Deleted Successfully</p>
				</div>
				<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
					<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
				</div>
				<table id="example1" class="table table-bordered table-striped">
					<div class="add">
						<a href="<?php echo e(URL::to('/add-transport')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Transport</a>
					</div>
					<thead>
						<tr>
							<th>ID</th>
							<th>Transport</th>
							<th>Updated At</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $__empty_1 = true; $__currentLoopData = $data_transport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single1): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
						<tr>
							<td><?php echo e($single1->id); ?></td>
							<td><?php echo e($single1->name); ?></td>
							<td><?php echo e($single1->updated_at); ?></td>
							<td>
								<form action="<?php echo e(URL::to('/delete-transport/'.$single1->id)); ?>" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
								<span class="btn-group">
								<?php echo e(csrf_field()); ?>

								<input type="hidden" name="id" value=""/>
								<a class="btn btn-default btn-xcrud btn btn-warning" href="<?php echo e(URL::to('/edittransport/'.$single1->id)); ?>">
								<i class="fa fa-edit"> Edit</i>
								</a>
								<button type="submit" class="btn btn-danger deletePackage" ><i class="fa fa-times"></i> Delete</button>
								</span>
								</form>
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
						<tr>
							<th colspan="6" class="text-center text-danger">Transport list not found</th>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>
<!--transport management end-->
<!--icon management start-->
<?php if(Sentinel::check()): ?>
<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Icon List</h3>
			</div>
			<div class="box-body">
				<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
					<p>Icon Deleted Successfully</p>
				</div>
				<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
					<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
				</div>
				<table id="example1" class="table table-bordered table-striped">
					<div class="add">
						<a href="<?php echo e(URL::to('/add-icon')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Icon</a>
					</div>
					<thead>
						<tr>
							<th>ID</th>
							<th>Icon</th>
							<th>Icon Title</th>
							<th>Updated At</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $__empty_1 = true; $__currentLoopData = $data_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single1): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
						<tr>
							<td><?php echo e($single1->id); ?></td>
							<td>
								<?php if($single1->icon==""): ?>
								<?php   $image="noimage.jpg";   ?>
								<?php else: ?>
								<?php   $image=$single1->icon;   ?>
								<?php endif; ?>
								<img width="35" height="35" src="<?php echo e(URL::to('/').'/public/uploads/icons/'.$single1->icon); ?>">
							</td>
							<td><?php echo e($single1->icon_title); ?></td>
							<td><?php echo e($single1->updated_at); ?></td>
							<td>
								<form action="<?php echo e(URL::to('/delete-icon/'.$single1->id)); ?>" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
									<span class="btn-group">
										<?php echo e(csrf_field()); ?>

										<input type="hidden" name="id" value=""/>
										<a class="btn btn-default btn-xcrud btn btn-warning" href="<?php echo e(URL::to('/editicon/'.$single1->id)); ?>"><i class="fa fa-edit"> Edit</i></a>
										<button type="submit" class="btn btn-danger deletePackage" ><i class="fa fa-times"></i> Delete</button>
									</span>
								</form>
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
						<tr>
							<th colspan="6" class="text-center text-danger">Icons List no found</th>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>
<!--icon management end-->
<!--Tour Taxes start-->
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tour Taxes (GST & TCS & PG)</h3>
            </div>
            <div class="box-body">
              <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                <p>Tour Taxes Deleted Successfully</p>
              </div>
              <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <div class="add">
                  <a href="<?php echo e(URL::to('/addtourtaxes')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Tax</a>
                </div>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Charge Type</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Valid From Latest</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $data_quote_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single1): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
                  <?php 
$data_history=DB::table('quote_charges_dynamic_data')->where('quote_charges_id',$single1->id)->orderBy('valid_from_date_tmestamp','DESC')->first();

?>
                  <tr>
                    <td><?php echo e($single1->id); ?></td>
                    <td><?php echo e($single1->charges_type); ?></td>
                    <td><?php echo e($single1->name); ?></td>
                    <td>
                <?php if($data_history!=''): ?>
<?php echo e($data_history->value); ?>

<?php else: ?>
<?php echo e($single1->value); ?>

<?php endif; ?></td>
                    <td>

<?php if($data_history!=''): ?>
<?php echo e(date('d-m-Y', strtotime($data_history->valid_from_date))); ?>

<?php else: ?>
Valid From Blank
<?php endif; ?>

                    </td>
                     <td><?php if($single1->status=='1'): ?>
						 <button class="btn btn-sm btn-info enable">Enable</button>
					 <?php else: ?>
						 <button class="btn btn-sm btn-danger disable">Disable</button>
					 <?php endif; ?>
                     </td>
                    <td>
                      <form action="<?php echo e(URL::to('/delete-tourtaxes/'.$single1->id)); ?>" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
                        <span class="btn-group">
                          <?php echo e(csrf_field()); ?>

                          <input type="hidden" name="id" value="" />
                          <a class="btn btn-default btn-xcrud btn btn-warning" href="<?php echo e(URL::to('/edittourtaxes/'.$single1->id)); ?>">
                            <i class="fa fa-edit"> Edit</i>
                          </a>
                            <a class="btn btn-default btn-xcrud btn btn-primary" href="<?php echo e(URL::to('/addvalidfrom/'.$single1->id)); ?>">
                            <i class="fa fa-edit"> Add/Edit Valid From</i>
                          </a>

                          <button type="submit" class="btn btn-danger deletePackage"><i class="fa fa-times"></i> Delete</button>
                        </span>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
                  <tr>
                    <th colspan="6" class="text-center text-danger"> Transport No Found</th>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--Tour Taxes end-->

      <!--Tour Taxes start-->
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tour Discounts</h3>
            </div>
            <div class="box-body">
              <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                <p>Tour Discounts Deleted Successfully</p>
              </div>
              <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <div class="add">
                  <a href="<?php echo e(URL::to('/addtourdiscounts')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Discounts</a>
                </div>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Discount Type</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $data_quote_discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single1): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td><?php echo e($single1->id); ?></td>
                    <td><?php echo e($single1->charges_type); ?></td>
                    <td><?php echo e($single1->name); ?></td>
                    <td><?php echo e($single1->value); ?></td>
                     <td><?php if($single1->status=='1'): ?>
						 <button class="btn btn-sm btn-info enable">Enable</button>
					 <?php else: ?>
						 <button class="btn btn-sm btn-danger disable">Disable</button>
					 <?php endif; ?>
                     </td>
                    <td>
                      <form action="<?php echo e(URL::to('/delete-tourdiscounts/'.$single1->id)); ?>" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
                        <span class="btn-group">
                          <?php echo e(csrf_field()); ?>

                          <input type="hidden" name="id" value="" />
                          <a class="btn btn-default btn-xcrud btn btn-warning" href="<?php echo e(URL::to('/edittourdiscounts/'.$single1->id)); ?>">
                            <i class="fa fa-edit"> Edit</i>
                          </a>
                          <button type="submit" class="btn btn-danger deletePackage"><i class="fa fa-times"></i> Delete</button>
                        </span>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
                  <tr>
                    <th colspan="6" class="text-center text-danger"> Transport No Found</th>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--Tour Taxes end-->

</section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>