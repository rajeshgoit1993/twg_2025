						<!--Desktop Tour Services Inclusion Starts-->
						<div class="dTourSvcCont">
							<div class="dTourSvcTtlBox">
								<h5>Included in this package</h5>
							</div>
							<div id="mobscroll" class="dServiceScroll">
							    <?php 
							        $package_service = unserialize($details->package_service);
							        $defaultIcon = asset('public/uploads/default-img.webp'); // Default icon
							     ?>

							    <?php if(!empty($package_service)): ?>
							        <?php 
							            $count_package_service = count($package_service);
							            $ico = "";

							            foreach ($icon_data as $icon_data1) {
							                $ico .= $icon_data1->icon_title . ",";
							            }
							            $ico1 = array_unique(explode(",", $ico));
							         ?>

							        <?php for($i = 0; $i < $count_package_service; $i++): ?>
							            <?php if(in_array($package_service[$i], $ico1)): ?>
							                <?php 
							                    $iconName = CustomHelpers::getimagename($package_service[$i], 'rt_icons', 'icon');
							                    $iconTitle = CustomHelpers::getimagename($package_service[$i], 'rt_icons', 'icon_title');
							                    $iconPath = public_path('uploads/icons/' . $iconName);
							                    $iconUrl = file_exists($iconPath) && is_readable($iconPath) 
							                        ? asset('public/uploads/icons/' . $iconName) 
							                        : $defaultIcon; // Use default image if icon doesn't exist
							                 ?>

							                <div class="dTourSvcItemIconBox">
							                    <div class="dTourSvcItemImgBox">
							                        <img src="<?php echo e($iconUrl); ?>" title="<?php echo e($iconTitle); ?>">
							                    </div>
							                    <div class="dTourSvcItemIconName"><?php echo e($iconTitle ?: 'no-title'); ?></div>
							                </div>
							            <?php endif; ?>
							        <?php endfor; ?>
							    <?php endif; ?>
							</div>
						</div>
						
						<!--Tour Description starts-->
						<?php if($details->description!=""): ?>
						<div class="dTourDescriptionCont">
							<p class="dTourDescription">
								<?php echo $details->description; ?>

							</p>
						</div>
						<?php endif; ?>
						<!--Description ends-->
						<!--<div class="dTourSeparator"></div>-->
						<!--Desktop Tour Services Inclusion Ends-->