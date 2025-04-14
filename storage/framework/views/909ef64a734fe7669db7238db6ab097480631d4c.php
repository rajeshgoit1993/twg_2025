			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="copyRightCont">
					<div>
						<h4><?php echo e(getWebsiteData('startingYear')); ?> - <?php echo e(date('Y')); ?>, <?php echo e(getWebsiteData('copyRight')); ?></h4>
					</div>
					<div>
						<h4><?php echo e(getWebsiteData('developerName')); ?></h4>
					</div>
				</div>
			</footer>
		</div><!-- ./wrapper -->

		<!-- backend script starts -->
		<?php echo $__env->make('layouts.backend.backend-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!-- backend script ends -->
	</body>
</html>