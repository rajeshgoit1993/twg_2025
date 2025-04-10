        <!-- backend -->
        <!-- Main Backend Header -->
        <?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Left side column. contains the logo and sidebar -->
        <?php echo $__env->make('layouts.sidemenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Content Wrapper. Contains page content -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- /.content-wrapper -->
        
        <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>