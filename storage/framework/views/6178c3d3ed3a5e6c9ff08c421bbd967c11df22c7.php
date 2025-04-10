										<!-- Desktop Tour Tabs-Policy Starts -->
										<div class="dTourPkgDesc">
										    <!-- Tour Booking Policies -->
										    <?php if(!empty($details->payment_p) && $details->payment_p != "N;"): ?>
										        <div class="dTourPolicy">
										            <h2>Tour Booking Policies</h2>
										            <?php $p_policy = unserialize($details->payment_p); ?>
										            <?php $__currentLoopData = $p_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										                <?php echo CustomHelpers::get_payment_policy($v); ?><br>
										            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										            <?php echo e($details->payment_policy); ?>

										        </div>
										    <?php endif; ?>

										    <!-- Tour Cancellation Policies -->
										    <?php if(!empty($details->can_p) && $details->can_p != "N;"): ?>
										        <div class="dTourPolicy">
										            <h2>Tour Cancellation Policies</h2>
										            <?php $c_policy = unserialize($details->can_p); ?>
										            <?php $__currentLoopData = $c_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										                <?php echo CustomHelpers::get_cancel_policy($v); ?><br>
										            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										            <?php echo e($details->cancel_policy); ?>

										        </div>
										    <?php endif; ?>

										    <!-- Important Notes -->
										    <?php if(!empty($details->imp_notes) && $details->imp_notes != "N;"): ?>
										        <div class="dTourPolicy">
										            <h2>Important Notes</h2>
										            <?php $important_notes = unserialize($details->imp_notes); ?>
										            <?php $__currentLoopData = $important_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										                <?php echo CustomHelpers::get_impnotes($v); ?><br>
										            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										            <?php echo e($details->extra_notes); ?>

										        </div>
										    <?php endif; ?>
										</div>
										<!-- Desktop Tour Tabs-Policy Ends -->