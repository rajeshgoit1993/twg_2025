<!-- Main Header -->
<?php echo $__env->make('layouts.front.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<!-- Content Wrapper. Contains page content -->
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->yieldContent('content2'); ?>
<?php echo $__env->yieldContent('content3'); ?>
<?php echo $__env->yieldContent('content4'); ?>
<!-- /.content-wrapper -->
<?php echo $__env->make('layouts.front.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>