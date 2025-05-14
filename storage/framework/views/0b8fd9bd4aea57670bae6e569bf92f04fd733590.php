								<!--Desktop Tour Tabs-Visa Starts-->
								<div class="dTourPkgDesc">
									<!--Visa Policies-->
									<?php if($details->visa=="1"): ?>
									<div class="dTourHgLhts visa-separator dVisaBox">
										<h2>Visa Policies</h2>
										<?php if(empty($details->visa_p) || $details->visa_p=="N;"): ?>
										<?php else: ?>
										<?php $v_policy=unserialize($details->visa_p); ?>
										<?php $__currentLoopData = $v_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php echo CustomHelpers::get_visa_policy($v); ?>

										</br>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<?php endif; ?>
										<?php echo e($details->visa_policies); ?>

									</div>
									<!--<div class="custom_padding"></div>-->
									<?php endif; ?>
								</div>
								<!--Desktop Tour Tabs-Visa Ends-->