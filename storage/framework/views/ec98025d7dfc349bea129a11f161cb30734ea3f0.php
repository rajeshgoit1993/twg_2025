		<!--modal-popup-img-gallery.css-->
		<!-- Tour Gallery Modal -->
		<div id="myModal_m_gallery" class="modal_img_gallery mobscroll">
			<div class="modalContent_img_gallery modalbox_img_gallery">
				<!-- Modal content starts-->
				<!-- Modal header-->
				<div class="modalheader_img_gallery">
					<h2><?php echo e($details->title); ?></h2>
				</div>
				<div class="btnCloseModal_m_gallery">&times;</div>
				<!-- Modal body-->
				<div class="modalbody_img_gallery">
					<!--Tour Images starts-->
					<div class="modal_img_gallery_cont">
						<div class="modal_img_gallery_cont_box">
							<?php 
								// Filter valid images
								$validImages = [];
								foreach ($images as $img) {
									$imageUrl = CustomHelpers::get_image_gallery($img->gallery_id, 'image_main');
									if (!empty($imageUrl) && $imageUrl != '0') {
										$validImages[] = $imageUrl;
									}
								}
							 ?>

							<?php if(count($validImages) > 0): ?>
								<?php $__currentLoopData = $validImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $imageUrl): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<img class="mySlides" src="<?php echo e($imageUrl); ?>" alt="Image <?php echo e($index + 1); ?>">
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

								<div class="mTourImage_sliders">
									<div class="mTourImage_sliderPrevious" onclick="plusSlides(-1)"></div>
									<div class="mTourImage_sliderNext" onclick="plusSlides(1)"></div>
								</div>
							<?php else: ?>
								<p class="no-images-message">No images available for this tour.</p>
							<?php endif; ?>
						</div>
					</div>
				<!--Tour Images ends-->
				</div>
				<!-- Modal content ends-->
			</div>
		</div>