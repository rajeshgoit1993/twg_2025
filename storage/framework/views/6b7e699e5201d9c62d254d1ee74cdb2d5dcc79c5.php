	<?php 
		// Fetch website-related data from the WebsiteNameHelpers function
		// This retrieves key information like social media links, contact details, etc.
		$websiteData = getWebsiteData();
	 ?>
	<?php $__env->startSection("title", $websiteData['metaTitle_Testimonials']); ?>
	<?php $__env->startSection("keywords", $websiteData['metaKeywords_Testimonials']); ?>
	<?php $__env->startSection("desc", $websiteData['metaDescription_Testimonials']); ?>

<?php $__env->startSection("custom_css"); ?>

<!--testimonial css-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/testimonials.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!--Desktop & Mobile View starts-->
<div class="">
	<div class="dTestMnlsBG mTestMnlsBG">
		<div class="mTestMnlsHead">
			<a href="<?php echo e(route('home')); ?>"><span class="mTestHome"></span></a>
			<h2>TESTIMONIALS</h2>
		</div>
		<div class="container select-none">
			<div class="dBreadCrumpsCont" style="display: none;">
				<ul>
					<li><a href="<?php echo e(route('home')); ?>">Home ></a></li>
					<li class="active">Testimonials</li>
				</ul>
			</div>

			<div class="write-review-cont">
				<div class="testimonial-btn">Testimonials (6)</div>

				<!-- Open The Modal -->
				<div class="select-none">
					<div class="write-review" role="button" id="addModal_review_content_d">
						<i class="fa-pen-line"></i><span>Write a review</span>
					</div>
				</div>

			</div>

			<!--Selected Testimonial-->
			<div class="dTestMnlsCont mTestMnlsCont">
				<div>
					<div class="dTestImgBox mTestImgBox">
						<div>
							<?php 
						    $defaultImage = url('public/uploads/default-img.webp'); // Default image path
						    $userImage = !empty($data1->c_image) ? public_path('uploads/testimonial/' . $data1->c_image) : null;

						    // Check if user image exists, otherwise use the default image
						    $imageSrc = ($userImage && file_exists($userImage)) ? asset('public/uploads/testimonial/' . $data1->c_image) : $defaultImage;
							 ?>
							<img alt="User Image" src="<?php echo e($imageSrc); ?>">
						</div>

						<!--<div class="view-testmonials-gallery" id="addModal_testmonial_gallery_d"><i class="fa-picture-o"></i>View Gallery &#8594;</div>-->
						<div class="view-testmonials-gallery" role="button" id="addModal_testmonial_gallery_d">
							<i class="fa-picture-o"></i>
						</div>
					</div>
				</div>
				<div class="dTestMnlsContent mTestMnlsContent">
					<p><?php echo e($data1->c_exp); ?></p>
					<h4><?php echo e($data1->c_name); ?></h4>
					<div class="guest-rating">
			    	<?php 
			        $customer_rating = floatval($data1->c_rating); // Ensure it's a float
			        $fullStars = floor($customer_rating); // Get the integer part
			        $hasHalfStar = ($customer_rating - $fullStars) >= 0.5; // Check if there's a half star
			        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0); // Remaining empty stars
			    	 ?>

				    
				    <?php for($i = 0; $i < $fullStars; $i++): ?>
				    	<img src="<?php echo e(url('/public/uploads/icons/star1.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
				    <?php endfor; ?>

				    
				    <?php if($hasHalfStar): ?>
				    	<img src="<?php echo e(url('/public/uploads/icons/halfstar.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
				    <?php endif; ?>

				    
				    <?php for($j = 0; $j < $emptyStars; $j++): ?>
				    	<img src="<?php echo e(url('/public/uploads/icons/star2.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
				    <?php endfor; ?>
					</div>

					<?php if(!empty($data1->c_country)): ?>
						<h5><?php echo e($data1->c_country); ?></h5>
					<?php endif; ?>
				</div>
			</div>

			<!--All other Testimonials-->
			<?php $__currentLoopData = $data2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<div class="dTestMnlsCont mTestMnlsCont">
				<div>
					<div class="dTestImgBox mTestImgBox">
						<div>
							<?php 
						    $defaultImage = url('public/uploads/default-img.webp'); // Default image path
						    $userImage = !empty($data->c_image) ? public_path('uploads/testimonial/' . $data->c_image) : null;

						    // Check if user image exists, otherwise use the default image
						    $imageSrc = ($userImage && file_exists($userImage)) ? asset('public/uploads/testimonial/' . $data->c_image) : $defaultImage;
							 ?>
							<img alt="User Image" src="<?php echo e($imageSrc); ?>">
						</div>

						<div class="view-testmonials-gallery" role="button" id="addModal_testmonial_gallery_d">
							<i class="fa-picture-o"></i>
						</div>
					</div>
				</div>

				<div class="dTestMnlsContent mTestMnlsContent">
					<p><?php echo e($data->c_exp); ?></p>
					<h4><?php echo e($data->c_name); ?></h4>
					<div class="guest-rating">
						<?php 
				    	$customer_rating = floatval($data->c_rating); // Ensure it's a float
				    	$fullStars = floor($customer_rating); // Get the integer part
				    	$hasHalfStar = ($customer_rating - $fullStars) >= 0.5; // Check if there's a half star
				    	$emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0); // Remaining empty stars
				     ?>

				    
				    <?php for($i = 0; $i < $fullStars; $i++): ?>
				    	<img src="<?php echo e(url('/public/uploads/icons/star1.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
				    <?php endfor; ?>

				    
				    <?php if($hasHalfStar): ?>
				    	<img src="<?php echo e(url('/public/uploads/icons/halfstar.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
				    <?php endif; ?>

				    
				    <?php for($j = 0; $j < $emptyStars; $j++): ?>
				    	<img src="<?php echo e(url('/public/uploads/icons/star2.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
				    	<?php endfor; ?>
				   </div>

					<?php if(!empty($data->c_country)): ?>
						<h5><?php echo e($data->c_country); ?></h5>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</div>
	</div>
</div>

<!-- gallery modal -->
<?php echo $__env->make('frontend.feedback.service-review.testimonals-image-gallery.testimonials-d-gallery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!--D_Review Tour Gallery Modal starts-->
<?php echo $__env->make('frontend.feedback.service-review.add-review-post', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('frontend.feedback.service-review.add-review-photos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom_js'); ?>

<!-- testimonials -->
<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/testimonials.js")); ?>'></script>

<!-- <script type="text/javascript">
    // Function to dynamically adjust the height of a textarea based on its content
    function calcHeight(value) {
        // Count the number of line breaks in the textarea content
        let numberOfLineBreaks = (value.match(/\n/g) || []).length;

        // Calculate new height:
        // - Base height: 20px
        // - Each line break increases height by 20px
        // - Padding: 12px
        // - Border: 2px
        let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;

        return newHeight;
    }
</script> -->
<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    function adjustHeight(element) {
        let value = element.innerText;  // Get the text content
        let numberOfLineBreaks = (value.match(/\n/g) || []).length;
        
        // Calculate new height based on text
        let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2; 
        element.style.minHeight = newHeight + "px";
    }

    // Placeholder effect for empty `contenteditable`
    document.querySelectorAll(".textarea").forEach(textarea => {
        textarea.addEventListener("focus", function() {
            if (this.innerText.trim() === this.dataset.placeholder) {
                this.innerText = "";
            }
        });

        textarea.addEventListener("blur", function() {
            if (this.innerText.trim() === "") {
                this.innerText = this.dataset.placeholder;
            }
        });

        // Set initial placeholder
        if (textarea.innerText.trim() === "") {
            textarea.innerText = textarea.dataset.placeholder;
        }
    });
});
</script> -->
<!-- 
<script>
function adjustHeight(element) {
    let value = element.innerText;  // Get the text content
    let numberOfLineBreaks = (value.match(/\n/g) || []).length;
    
    // Calculate new height based on text
    let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2; 
    element.style.minHeight = newHeight + "px";
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".textarea").forEach(textarea => {
        textarea.addEventListener("focus", function() {
            if (this.innerText.trim() === this.dataset.placeholder) {
                this.innerText = "";
            }
        });

        textarea.addEventListener("blur", function() {
            if (this.innerText.trim() === "") {
                this.innerText = this.dataset.placeholder;
            }
        });

        // Set initial placeholder
        if (textarea.innerText.trim() === "") {
            textarea.innerText = textarea.dataset.placeholder;
        }
    });
});
</script> -->

<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.masternoindex', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>