			<!--modal-popup-img-gallery.css-->
			<!-- D-Tour Gallery Modal Starts-->
			<div id="myModal_d_gallery" class="modal_img_gallery mobscroll">
				<div class="modalContent_img_gallery modalbox_img_gallery">
					<!-- Modal content starts-->
					<!-- Modal header-->
					<div class="modalheader_img_gallery">
						<h2><?php echo e($details->title); ?></h2>
					</div>
					<div class="btnCloseModal_d_gallery">&times;</div>
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
							            <!-- <img class="mySlides" src="<?php echo e($imageUrl); ?>" alt="Image <?php echo e($index + 1); ?>"> -->
							            <img class="mySlides" data-src="<?php echo e($imageUrl); ?>" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" alt="Image <?php echo e($index + 1); ?>" style="display: none;">
							        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

							        <div class="tourImage_sliders">
							            <div class="tourImage_sliderPrevious" onclick="plusSlides(-1)"></div>
							            <div class="tourImage_sliderNext" onclick="plusSlides(1)"></div>
							        </div>

							         <!-- Dots -->
			                        <<!-- div class="dots-container">
			                            <?php $__currentLoopData = $validImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $imageUrl): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			                                <span class="dot" onclick="currentSlide(<?php echo e($index + 1); ?>)"></span>
			                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			                        </div> -->
							    <?php else: ?>
							        <p class="no-images-message">No images available for this tour.</p>
							    <?php endif; ?>
							</div>
						</div>
						<!--Tour Images ends-->
					</div>
				</div>
			</div>
			<!-- D-Tour Gallery Modal Ends-->