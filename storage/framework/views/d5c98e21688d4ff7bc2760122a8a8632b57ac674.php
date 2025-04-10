<?php
						$loged_user=Sentinel::getUser();
					?>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="item-container">
									<h5>Header <span class="requiredcolor">*</span></h5>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>
													<label for="emailHeader" class="emailHeader">Email header <span class="requiredcolor">*</span></label> 
													<i class="fa <?php if($loged_user->lock_header_email==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> colorA1 fontSize14 lock_header_icon" aria-hidden="true"></i>
													<br>
													<span class="show_hide morePlus">More+</span>
													<br>
													<textarea name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control ckeditor" <?php if($loged_user->lock_header_email==1): ?> readonly <?php endif; ?>> <?php echo $loged_user->signature_header; ?> </textarea>
												</td>
											</tr>
											<tr>
												<td>
													<label for="webHeader" class="webHeader">Web header <span class="requiredcolor">*</span></label> 
													<i class="fa  <?php if($loged_user->lock_header==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> colorA1 fontSize14 lock_header_icon" aria-hidden="true">
													</i>
													<br>

													<div>
														<input type="hidden" name="quotation_header" class="quotation_header" value="<?php echo e($loged_user->quotation_header); ?>">
														<select name="quotation_header" class="select2 form-control" <?php if($loged_user->lock_header==1): ?> style="cursor:not-allowed" disabled <?php endif; ?>>
															<?php $__currentLoopData = $quotation_header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<option value="<?php echo e($pol->id); ?>" <?php if($loged_user->quotation_header==$pol->id): ?> selected <?php endif; ?>><?php echo e($pol->header); ?> </option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														</select>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="item-container">
									<h5>Signature <span class="requiredcolor">*</span></h5>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>
													<label for="emailFooter" class="emailFooter">Email footer <span class="requiredcolor">*</span></label> 
													<i class="fa  <?php if($loged_user->lock_footer_email==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> colorA1 fontSize14 lock_header_icon" aria-hidden="true">
													</i>
													<br>
													<span class="show_hide morePlus">More+</span>
													<br>
													<textarea name="quotation_footer_extra" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control ckeditor" <?php if($loged_user->lock_footer_email==1): ?> readonly <?php endif; ?>> <?php echo $loged_user->signature; ?> </textarea>
												</td>
											</tr>
											<tr>
												<td>
													<label for="webFooter" class="webFooter">Web footer <span class="requiredcolor">*</span></label>
													<i class="fa  <?php if($loged_user->lock_footer==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> colorA1 fontSize14 lock_header_icon" aria-hidden="true"></i>
													<br>
													<div>
														<input type="hidden" name="quotation_footer" class="quotation_footer" value="<?php echo e($loged_user->quotation_footer); ?>">
														<select name="" class="select2 form-control" <?php if($loged_user->lock_footer==1): ?> style="cursor:not-allowed" disabled <?php endif; ?>>
															<?php $__currentLoopData = $quotation_footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<option value="<?php echo e($pol->id); ?>" <?php if($loged_user->quotation_footer==$pol->id): ?> selected <?php endif; ?>><?php echo e($pol->footer); ?> </option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														</select>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								</div>
							</div>
						</div>
					</div>
					