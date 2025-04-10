<?php $__env->startSection('content'); ?>
<style type="text/css">
.custom_border .row
{

padding: 5px 0px
}
table.dataTable thead > tr > th {
    padding-right: 0px;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    
    
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="box" style="overflow: auto;">
<div class="box-header">
<h3 class="box-title">Company Profile</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
 <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
<?php if(count($data)==0): ?>
<div class="add">
<a href="<?php echo e(URL::to('/Create-Company-Profile	')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Company Profile</a>
</div>
<?php endif; ?>
<?php endif; ?>
<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
<p>Query Deleted Successfully.</p>
</div>
<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">

<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul> 
</div>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datas): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<table class="table table-bordered">
	<tbody>
		<tr>
			<td>Company Name</td>
			<td><?php echo e($datas->company_name); ?></td>
			<td>Company ID</td>
			<td><?php echo e($datas->company_id); ?></td>
		</tr>
			<tr>
			<td>Registered Address</td>
			<td><?php echo e($datas->address); ?></td>
			<td>City</td>
			<td><?php echo e($datas->city); ?></td>
		</tr>
			<tr>
			<td>State</td>
			<td><?php echo e($datas->state); ?></td>
			<td>Country</td>
			<td><?php echo e($datas->country); ?></td>
		</tr>
			<tr>
			<td>Pin Code</td>
			<td><?php echo e($datas->pin); ?></td>
			<td>Company Type</td>
			<td><?php echo e($datas->company_type); ?></td>
		</tr>
			<tr>
			<td>No of Employees</td>
			<td><?php echo e($datas->no_of_emp); ?></td>
			<td>Contact Person</td>
			<td><?php echo e($datas->contact_person); ?></td>
		</tr>
			<tr>
			<td>Office Landline No</td>
			<td><?php echo e($datas->office_no); ?></td>
			<td>Mobile No</td>
			<td><?php echo e($datas->mobile_no); ?></td>
		</tr>
			<tr>
			<td>Alternate Mobile No</td>
			<td><?php echo e($datas->alternate_no); ?></td>
			<td></td>
			<td></td>
			
		</tr>
			<tr>
            <td>Primary Email ID</td>
			<td><?php echo e($datas->primary_email); ?></td>
			<td> Secondary Email ID</td>
			<td><?php echo e($datas->secondary_email); ?></td>
			
		</tr>
			<tr>
			<td>Website</td>
			<td><?php echo e($datas->website); ?></td>
			<td>Facebook Link</td>
			<td><?php echo e($datas->facebook_link); ?></td>
		</tr>
			<tr>
			<td>Twitter Link</td>
			<td><?php echo e($datas->twiter); ?></td>
			<td>Instagram Link</td>
			<td><?php echo e($datas->instagram); ?></td>
		</tr>

			<tr>
			<td>Other Social Link</td>
			<td><?php echo e($datas->other_social_link); ?></td>
			<td>PAN Number</td>
			<td><?php echo e($datas->pan); ?></td>
		</tr>
			<tr>
			<td>Name on the PAN Card</td>
			<td><?php echo e($datas->name_of_pan); ?></td>
			<td>GST No.</td>
			<td><?php echo e($datas->gst_no); ?></td>
		</tr>
			<tr>
			<td>GST Name</td>
			<td><?php echo e($datas->gst_name); ?></td>
			<td>GST Email</td>
			<td><?php echo e($datas->gst_email); ?></td>
		</tr>
			<tr>
			<td>GST Contact Number</td>
			<td><?php echo e($datas->gst_contact); ?></td>
			<td>GST Address</td>
			<td><?php echo e($datas->gst_address); ?></td>
		</tr>
			<tr>
			<td>Accounts Dept. Contact No.</td>
			<td><?php echo e($datas->account_dept_no); ?></td>
			<td>Accounts Dept. Email ID</td>
			<td><?php echo e($datas->account_dept_email); ?></td>
		</tr>
			<tr>
			<td>Logo</td>
			<td>
               <?php if($datas->logo!=""): ?>
            <img src="<?php echo e(url('/public/uploads/company_profile/'.$datas->logo)); ?>" style="width: 100px">
               <?php endif; ?>
				</td>
			<td>PAN Card</td>
			<td><?php if($datas->pan_card!=""): ?>
            <img src="<?php echo e(url('/public/uploads/company_profile/'.$datas->pan_card)); ?>" style="width: 100px">
               <?php endif; ?></td>
		</tr>
			 <tr>
			<td>GST Certificate</td>
			<td>
               <?php if($datas->gst_certificate!=""): ?>
            <img src="<?php echo e(url('/public/uploads/company_profile/'.$datas->gst_certificate)); ?>" style="width: 100px">
               <?php endif; ?>
				</td>
			<td>ID Proof</td>
			<td><?php if($datas->id_proof!=""): ?>
            <img src="<?php echo e(url('/public/uploads/company_profile/'.$datas->id_proof)); ?>" style="width: 100px">
               <?php endif; ?></td>
		</tr>
		<tr>
			<td>Address Proof</td>
			<td>
               <?php if($datas->address_proof!=""): ?>
            <img src="<?php echo e(url('/public/uploads/company_profile/'.$datas->address_proof)); ?>" style="width: 100px">
               <?php endif; ?>
				</td>
			<td>Registration Proof</td>
			<td><?php if($datas->registration_proof!=""): ?>
            <img src="<?php echo e(url('/public/uploads/company_profile/'.$datas->registration_proof)); ?>" style="width: 100px">
               <?php endif; ?></td>
		</tr>
		<tr>
			<?php if($datas->other_first_name!="" && $datas->other_first_image!=""): ?>
			<td><?php echo e($datas->other_first_name); ?></td>
			<td>
               <?php if($datas->other_first_image!=""): ?>
            <img src="<?php echo e(url('/public/uploads/company_profile/'.$datas->other_first_image)); ?>" style="width: 100px">
               <?php endif; ?>
				</td>
			<?php endif; ?>
			<?php if($datas->other_second_name!="" && $datas->other_second_image!=""): ?>
			<td><?php echo e($datas->other_second_name); ?></td>
			<td><?php if($datas->other_second_image!=""): ?>
            <img src="<?php echo e(url('/public/uploads/company_profile/'.$datas->other_second_image)); ?>" style="width: 100px">
               <?php endif; ?></td>
               <?php endif; ?>
		</tr>
		<?php if(Sentinel::check()): ?>
<!--New Role Start-->
        <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
		<tr>
			<td colspan="4" style="text-align: center;">
				<a href="<?php echo e(URL::to('/Edit-Company-Profile/'.$datas->id)); ?>"><button class="btn btn-success">Edit</button></a>
			</td>
		</tr>
		<?php endif; ?>
		<?php endif; ?>
	</tbody>
</table>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</div>
<!-- /.box-body -->
</div>
</div>
</div>

  
<!---->
</section>
<!-- /.content -->
</div>
<div class="testing">
      <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
   </div>


<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>