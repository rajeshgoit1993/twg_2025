<div class="dThemeBG">
	<div class="container">
		<!--<h1 class="big-caption"><?php echo e(CustomHelpers::theme_data($theme_name,'theme_para1')); ?></h1>
		<h2 class="med-caption yellow-color"><strong><?php echo e(CustomHelpers::theme_data($theme_name,'theme_para2')); ?></strong></h2>-->
		<div class="dThemeHdCont">
			<h1><?php echo e($theme_name); ?> Holiday Packages</h1>
		</div>
	</div>
	<!--<div class="container">
		<div class="dThemeHdCont">
			<h1><?php echo e($theme_name); ?> Holiday Packages</h1>
		</div>
	</div>-->
</div>
<div class="dThemeContBG">
	<div class="container">
		<div class="dThemeTtlCont">
			<h2>About <?php echo e($theme_name); ?> Packages</h2>
		</div>
		<div class="dThemeWrap">
			<div class="dAbtTheme">
				<p><?php echo CustomHelpers::theme_data($theme_name,'about_theme'); ?></p>
			</div>
			<?php echo $__env->make('packages.seo.seoLinkContent', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<?php
		    // Ensure $theme_data is set before accessing properties
		    $destination_theme_link = isset($theme_data) ? $theme_data->destination_theme_link : '';

		    // Unserialize the link safely
		    $destination_theme_links = !empty($destination_theme_link) ? @unserialize($destination_theme_link) : [];
		?>

		<?php if(!empty($destination_theme_links)): ?>
		    <?php $__currentLoopData = $destination_theme_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		        <?php
		            $destination_search = $col["destination"];
		            $select_theme = $col["theme"];

		            $data = DB::table('rt_packages')
		                ->where('status', '=', '1')
		                ->where('package_category', 'like', '%' . $select_theme . '%')
		                ->where(function ($query) use ($destination_search) {
		                    $query->orWhere('continent', 'like', '%' . $destination_search . '%')
		                          ->orWhere('country', 'like', '%' . $destination_search . '%')
		                          ->orWhere('state', 'like', '%' . $destination_search . '%')
		                          ->orWhere('city', 'like', '%' . $destination_search . '%');
		                })
		                ->limit(4)
		                ->get();
		        ?>

		        <div class="dThemeContnt">
		            <div class="dThemeDestCont">
		                <h2 class="dThemeDestTtl"><?php echo e($col["destination"]); ?> <?php echo e($theme_name); ?> Packages</h2>
		                <a href="<?php echo e(url('/' . $col['link'])); ?>">View All</a>
		            </div>
		            <div class="row">
		                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		                    <?php 
		                        // Safely unserialize city data
		                        $location = @unserialize($package->city);
		                        $location = is_array($location) ? $location : ['Unknown'];
		                     ?>
		                    <div class="col-md-3 col-sm-4 custom_length_demostic">
		                        <div class="TourItem">
		                            <input type="hidden" class="pack_id_list" name="pack_id_list_demostic[]" value="<?php echo e($package->id); ?>">
		                            <?php $gallery_id = CustomHelpers::get_first_galleryid($package->id); ?>
		                            <a href="<?php echo e(url('/Holidays/' . str_slug($package->title) . '?package_id=' . CustomHelpers::custom_encrypt($package->id))); ?>">
		                                <div class="dTourTopSection">
		                                    <div class="dTourImgBox">
		                                        <?php if(CustomHelpers::get_image_gallery($gallery_id, 'thum_medium') != "0"): ?>
		                                            <img src="<?php echo e(CustomHelpers::get_image_gallery($gallery_id, 'thum_medium')); ?>">
		                                        <?php else: ?>
		                                            <img src="<?php echo e(asset('public/uploads/default-img.webp')); ?>">
		                                        <?php endif; ?>
		                                    </div>
		                                    <div class="dTourPrcBox">
		                                        <?php if($package->onrequest == 1 && $package->upcoming == 1): ?>
		                                            <div class="dTourPrcValueBox">
		                                                <p class="dTourPrcValueReq"><span class="dTourDefaultCurency">&nbsp;</span>On Request</p>
		                                            </div>
		                                        <?php elseif($package->onrequest != 1 && $package->upcoming == 1): ?>
		                                            <?php if(CustomHelpers::get_price($package->id) == "On Request"): ?>
		                                                <div class="dTourPrcValueBox">
		                                                    <p class="dTourPrcValueReq"><span class="dTourDefaultCurency">&nbsp;</span>On Request</p>
		                                                </div>
		                                            <?php else: ?>
		                                                <div class="dTourPrcValueBox">
		                                                    <p class="dTourPrcValue"><span class="dTourDefaultCurency">&nbsp;</span><?php echo e(CustomHelpers::get_price($package->id)); ?></p>
		                                                    <p class="dTourPrcTyp"><?php echo e($package->Price_type); ?></p>
		                                                </div>
		                                            <?php endif; ?>
		                                        <?php elseif($package->onrequest == 1 && $package->upcoming != 1): ?>
		                                            <?php if(CustomHelpers::get_up_price($package->id) == "On Request"): ?>
		                                                <div class="dTourPrcValueBox">
		                                                    <p class="dTourPrcValueReq"><span class="dTourDefaultCurency">&nbsp;</span>On Request</p>
		                                                </div>
		                                            <?php else: ?>
		                                                <div class="dTourPrcValueBox">
		                                                    <p class="dTourPrcValue"><span class="dTourDefaultCurency">&nbsp;</span><?php echo e(CustomHelpers::get_up_price($package->id)); ?></p>
		                                                    <p class="dTourPrcTyp"><?php echo e($package->upcoming_type); ?></p>
		                                                </div>
		                                            <?php endif; ?>
		                                        <?php endif; ?>
		                                    </div>
		                                </div>
		                                <div class="TourBtmSection">
		                                    <div class="TourTtlCont">
		                                        <h4><?php echo e($package->title); ?></h4>
		                                    </div>
		                                    <div>
		                                        <div class="LocationCont">
		                                            <i class="fa fa-location-arrow" aria-hidden="true"></i> <?php echo e($location[0]); ?>

		                                        </div>
		                                        <div class="TourDuration"><?php echo e($package->duration); ?> Nights</div>
		                                    </div>
		                                </div>
		                            </a>
		                        </div>
		                    </div>
		                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		            </div>
		        </div>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		<?php endif; ?>

		<!-- seo section -->
		<?php echo $__env->make('packages.seo.seoSection', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>