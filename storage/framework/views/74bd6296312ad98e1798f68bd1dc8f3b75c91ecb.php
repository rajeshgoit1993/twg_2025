						<!--Desktop Tour Image Starts-->
						<div class="dTourImgCont">

							<!-- image box-I -->
						    <div class="dTourImgBox">
						    	
						    	
						    	<?php if(count($images)>0): ?>
						    
						    	 <img src="<?php echo e(CustomHelpers::get_image_gallery($images[0]['gallery_id'], 'image_main')); ?>" alt="tourimg">
                                    <?php else: ?>
                                    <img src="" alt="noimage">
						    	<?php endif; ?>
						        
						    </div>

						    <!-- image box-II -->
						    <div class="dTourImgBoxTwo">
						      

                              <?php if(count($images)>1): ?>
						    	
						    	 <img src="<?php echo e(CustomHelpers::get_image_gallery($images[1]['gallery_id'], 'image_main')); ?>" alt="tourimg">
                                   <?php else: ?>
                                   <img src="" alt="noimage"> 
						    	<?php endif; ?>

						        
						    </div>

						    <!-- Show "View Gallery" only when there are more than 1 image -->
						    <?php if(count($images) > 1): ?>
						        <div class="dView_gallery" id="addModal_d_gallery">View Gallery &#8594;</div>
						    <?php endif; ?>
						</div>						
						<!--Desktop Tour Image Ends-->