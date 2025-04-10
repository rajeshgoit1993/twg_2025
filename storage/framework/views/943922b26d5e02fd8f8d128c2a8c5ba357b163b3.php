									<!--Desktop Tour Tabs-Transfers Starts-->
									<div class="dTourPkgDesc">
										<?php if($details->transfers!=''): ?>
										<div class="dTourDesc">
											<h2>Tour Transfers</h2>
											<?php 
												$transfers=unserialize($details->transfers);
											?>
											<?php $a=0; ?>
											<?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<?php if(array_key_exists('transport_type',$col) && array_key_exists('transfers_type',$col)): ?>
											<?php
												$transfers_data=DB::table('rt_transfer_list')->where([['transport_type','=',$col['transport_type']],['title','=',$col['transfers_type']]])->first();
											 ?>
											<div class="collapsible-container">
												<div class="collapsible-item dItem-box dItem-arrow" id=""><span class="glyphicon glyphicon-map-marker" style="color: #da2128; display: none"></span><?php echo e($col['mode_title']); ?></div>
												
												<!--Collapsible Content-->
												<div class="collapsible-item-content">
													<div class="dTourTransBox">
														<!--<div class="dTourTransTitle"><?php echo e($col['mode_title']); ?></div>-->
														<div class="dTourTransDtlsBox">
															<div class="makeflex fullWidth">
																<!--Vehicle Image-->
																<div class="dTourTransImgBox">
																    <?php 
																        $transferImage = $transfers_data->transfer_image ?? null;
																     ?>

																    <?php if(!empty($transferImage) && file_exists(public_path("uploads/transfer_image/{$transferImage}"))): ?>
																        <img src="<?php echo e(asset('public/uploads/transfer_image/'.$transferImage)); ?>" alt="Transfer-Image">
																    <?php else: ?>
																        <img src="<?php echo e(asset('public/uploads/default-img.webp')); ?>" alt="No-Image">
																    <?php endif; ?>
																</div>

																<div class="dTourTransDescBox">
																	<!--Private, Shared or Coach-->
																	<div class="dTourTransDescTopSection">
																		<h4 class="dTourTransTitle"><?php echo e($col['mode_title']); ?></h4>
																		<h2 class="dTourTransTransportType"><?php if($transfers_data!='' && $transfers_data->transfer_type!=''): ?><?php echo e($transfers_data->transfer_type); ?><?php endif; ?></h2>
																	</div>

																	<!--Vehicle Type, Duration & Inclusion-->
																	<div class="flexBetween">
																		<div class="dTourTransVehicleCont">
																			<h4 class="dTourTransHead text-left">Vehicle Type</h4>
																			<h5 class="dTourTransSubHead text-left"><?php if($transfers_data!='' && $transfers_data->vehicle_type!=''): ?><?php echo e($transfers_data->vehicle_type); ?><?php endif; ?></h5>
																		</div>

																		<div class="dtransferDurationCont">
																			<h4 class="dTourTransHead">Duration</h4>
																			<h5 class="dTourTransSubHead"><?php if($transfers_data!='' && $transfers_data->duration!=''): ?><?php echo e($transfers_data->duration); ?><?php endif; ?></h5>
																		</div>

																		<div>
																			<h4 class="dTourTransHead text-right">Includes</h4>
																			<h5 class="dTourTransSubHead text-right"><?php if($transfers_data!='' && $transfers_data->includes!=''): ?><?php echo e($transfers_data->includes); ?><?php endif; ?></h5>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php $a++; ?>
										<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</div>
										<?php endif; ?>
									</div>
									<!--Desktop Tour Tabs-Transfers Ends-->
									<!--Desktop-Tour-Tab-Collapsible-item-script-pagethree.js-->