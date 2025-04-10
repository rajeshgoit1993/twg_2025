<?php $__env->startSection("custom_css_code"); ?>

<style type="text/css">
@media (max-width: 768px) {
  .modalDialog {
    width: 80%;
    margin: auto;
    border-radius: 5px;
    overflow: hidden;
  }
}
@media (min-width: 768px) {
  .modalDialog {
    width: 1200px;
    margin: 30px auto;
    border-radius: 10px;
    overflow: hidden;
  }
}
.modalBody label {
	font-size: 12px;
	line-height: 14px;
	color: #4a4a4a;
}
.modalBody input {
	font-size: 12px;
	line-height: 14px;
	color: #4a4a4a;
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
        
        <!-- Row for content -->
        <div class="row">
            
            <!-- Full-width column -->
            <div class="col-md-12">
                
                <!-- Box container -->
                <div class="box">
                    
                    <!-- Box header -->
                    <div class="box-header">
                    	<h3 class="box-title">Supplier List</h3>
                        
                        
                    </div>
                    <!-- /.box-header -->
                    
                    <!-- Box body -->
                    <div class="box-body">
                        
                        <!-- Success message container -->
                        <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                            <p>Supplier deleted successfully.</p>
                        </div>
                        
                        <!-- Error message container -->
                        <div class="alert alert-danger error-contaier-parenterror-contaier-parent-hotel" style="display:none">
                            <ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
                        </div>

                        <!-- Check if user is authenticated and has access role -->
                        <?php if(Sentinel::check()): ?>
                            <?php if(Sentinel::getUser()->inRole('administrator') || 
                                Sentinel::getUser()->inRole('supervisor') || 
                                Sentinel::getUser()->inRole('super_admin')): ?>
                                
                                <!-- Add New Supplier button -->
                                <div class="apndBtm10">
                                    <a href="<?php echo e(URL::to('/addsupplier')); ?>" class="btn btn-success" style="margin-right: 20px">
                                        <i class="glyphicon glyphicon-plus-sign"></i> Add New Supplier
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <!-- Suppliers table -->
                        <table id="example1" class="table table-bordered table-striped example1">
                            <thead>
                                <tr>
                                    <th style="width: 70px">S.No.</th>
                                    <th style="width: 110px">Supplier ID</th>
                                    <th>Supplier Name</th>
                                    <th style="width: 150px">Mobile & Email ID</th>
                                    <th style="width: 130px">City</th>
                                    <th style="width: 130px">Country</th>
                                    <th style="width: 110px">Status</th>
                                    <?php if(Sentinel::check()): ?>
	                                    <?php if(Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('administrator')): ?>
	                                    <th style="width: 150px">Actions</th>
	                                    <?php endif; ?>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php $__empty_1 = true; $__currentLoopData = $supplierdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplierdetails): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($count++); ?></td>
                                        <td><?php echo e($supplierdetails->id); ?></td>
                                        <td><?php echo e($supplierdetails->suppliercompanyname); ?></td>
                                        <td><?php echo e($supplierdetails->suppliermobile); ?> & <?php echo e($supplierdetails->supplierprimaryemail); ?></td>
                                        <td><?php echo e($supplierdetails->suppliercity); ?></td>
                                        <td><?php echo e($supplierdetails->suppliercountry); ?></td>
                                        <!-- <td><?php echo e($supplierdetails->supplierstatus); ?></td> -->
                                        <td>
                                        	<?php if($supplierdetails->supplierstatus == 'enabled'): ?>
                                        		<button class="btn btn-sm btn-success">Enabled</button>
                                        	<?php else: ?>
                                        		<button class="btn btn-sm btn-danger">Disabled</button>
                                        	<?php endif; ?>
                                        </td>

                                        <td>                                            
                                            <!-- Action buttons -->
                                            <form action="<?php echo e(URL::to('/delete-supplier/' . $supplierdetails->id)); ?>" onsubmit="return confirm('Are you sure you want to delete this supplier?');" method="POST">
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="hidden" name="id" value=""/>
                                                    
                                                    <?php if(Sentinel::check()): ?>
                                                        <?php if(Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('administrator')): ?>
	                                                    
	                                                    <!-- View button -->
	                                                    <button type="button" class="btn btn-sm btn-success link open-AddBookDialog" data-id="<?php echo e($supplierdetails->id); ?>">View</button>

                                                        <!-- Edit button -->
	                                                    <a href="<?php echo e(URL::to('/editsupplier/' . $supplierdetails->id)); ?>">
	                                                    	<button type="button" class="btn btn-sm btn-warning">Edit</button>
	                                                    </a>
                                                    	<?php endif; ?>
                                                    <?php endif; ?>
                                                    
                                                    <!-- Conditional delete button for specific roles -->
                                                    <?php if(Sentinel::check()): ?>
                                                        <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                                                            <button type="submit" class="btn btn-sm btn-danger deletePackage">Delete</button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-danger">No Data Found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal for Supplier Details -->
<div class="modal fade" id="addBookDialog" role="dialog">
    <div class="modal-dialog modalDialog">
        <!-- Modal Content -->
        <div class="modal-content" style="border-radius: 5px">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <input type="hidden" id="bookId" name="bookId" value="">
                <h4 class="modal-title">Supplier Details</h4>
            </div>

            <!-- Modal Form -->
            <form action="#" method="post" id="enq_data" name="enq_data">
                <!-- Modal Body for Dynamic Content -->
                <div class="modal-body modalBody custom_border" id="modal-body">
                    <!-- Content populated dynamically - suppliercontroller -->
                </div>
            </form>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div> <!-- End of Modal Content -->
    </div> <!-- End of Modal Dialog -->
</div> <!-- End of Modal -->

<div class="testing">
	<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
</div>

<!-- /.content-wrapper -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).on('click', '.open-AddBookDialog', function() {
	$('#bookId').val($(this).data('id'));
	var id = $(this).data('id');

	$.ajax({
		type:'post',
		url: APP_URL+'/supplier_data',
		// dataType: 'json',
		data: {id:id},
		success:function(data){
			console.log('Sucess : '+data,);
			$("#modal-body").empty();
			$("#modal-body").append(data)
			$('#addBookDialog').modal('show');
		},
		error: function (data) {
			//console.log('Error : '+data);
		}
	});
});		
</script>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>