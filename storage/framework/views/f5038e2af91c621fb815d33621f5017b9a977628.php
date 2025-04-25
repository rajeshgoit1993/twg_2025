		<!--Desktop Search Panel Starts-->
		<?php echo $__env->make('home.desktop.desktopSearchPanelHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('home.desktop.desktopSearchPanelTabContent', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!--Scroll to Top Starts-->
		<?php echo $__env->make('frontend.scroll-to-top.scroll-to-top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!--Scroll to Top Ends-->

		<!--Desktop Search Panel Ends-->