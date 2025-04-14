<!--Review Modal (add-review-post) -->
<div id="myModal_review_content_d" class="modal-review-post mobscroll">
	<div class="modalContent-review-post modal-review-box">
		<!-- Review Modal content starts-->
		<!-- Review Tour Modal header-->
		<div class="modalheader_review-box">
			<h2>{{ getWebsiteData('name') }}</h2>
		</div>
		<!--<div class="close-modal">&times;</div>-->
		<!--Review Modal body-->
		<div class="modalbody-review-box">
				<!--Tour Images starts-->
				<div class="modal-review-box-cont">
					<div class="modal-review-box-cont_box">
					<!--Review User Details-->
					<div class="flexCenter">
						<!-- <?php
							$defaultImage = url('public/uploads/user_profiles/default-user.png'); // Default image path
							$userImage = ''; // Replace with actual user image path

							// Check if user image exists, otherwise use the default image
							$imageSrc = (!empty($userImage) && file_exists($userImage)) ? $userImage : $defaultImage;
						?>
						<div class="user-pic-container">
						    <img class="user-pic" src="<?= $imageSrc; ?>" alt="">
						</div> -->

						<?php
							$defaultImage = url('public/uploads/user_profiles/default-user.png'); // Default image URL
							$userImage = ''; // Replace with actual user image path

							// Get the absolute server path
							$userImagePath = public_path($userImage);

							// Check if user image exists, otherwise use the default image
							$imageSrc = (!empty($userImage) && file_exists($userImagePath)) ? url($userImage) : $defaultImage;
						?>
						<div class="user-pic-container">
						    <img class="user-pic" src="<?= e($imageSrc); ?>" alt="User Profile">
						</div>

						<div class="flex-column" style="padding-left: 10px;">
							<!-- user name -->
							<div class="user-name">User</div>

							<div class="review-post-type">Posting Publicly</div>
						</div>
					</div>
					<!--Review Star Rating-->
					<div class="makeflex" style="justify-content: center;padding: 16px">
						<div class="flex-reverse-center rate">
							<input type="radio" id="star5" name="rate" value="5" />
							<label for="star5" title="5 star">5 stars</label>
							<input type="radio" id="star4" name="rate" value="4" />
							<label for="star4" title="4 star">4 stars</label>
							<input type="radio" id="star3" name="rate" value="3" />
							<label for="star3" title="3 star">3 stars</label>
							<input type="radio" id="star2" name="rate" value="2" />
							<label for="star2" title="2 star">2 stars</label>
							<input type="radio" id="star1" name="rate" value="1" />
							<label for="star1" title="1 star">1 star</label>
						</div>
					</div>
					<!--Review Text Area-->
					<div class="flexCenter">
						<span class="textarea" role="textbox" contenteditable oninput="adjustHeight(this)" data-placeholder=""></span>
					</div>
					<p class="font13 colorA1 apndTop5" id="charCount">0 / 1250 (maximum allowed characters)</p> <!-- Character counter -->
					<!--Uploaded Photos start-->
					<div>
						<div class="add-photo-cont">
							<div class="btn-add-photo-">
								<button type="button" class="btn-add-photo" id="addModal_review_photo_d">
									<img class="add-photo-icon" src="{{ asset('public/uploads/frontend-images/add-photo.png') }}" alt="add photo"><span>Add photos</span>
								</button>
							</div>
						</div>
						<div class="review-post-img-box-cont" style="display: none;">
							<div class="review-post-img-box">
								<img class="" src="{{ asset('public/uploads/frontend-images/add-photo.png') }}" alt="Photo">
								<div class="review-post-img-box-close">&times;</div>
							</div>
							<div class="review-post-img-box">
								<img class="" src="{{ asset('public/uploads/frontend-images/add-photo.png') }}" alt="Photo">
								<div class="review-post-img-box-close">&times;</div>
							</div>
						</div>
					</div>
					<!--Uploaded Photos ends-->
					<!--<button type="button" class="view_gallery" id="addModal">View Gallery</button>-->
					</div>
				</div>
				<!--Tour Images ends-->
		</div>
		<!--Review Post Modal footer-->
		<div class="lead-modalfooter make_bottom_bar_sticky">
			<button class="btn-review-post-modal-close closeModal_review_content_d">Cancel</button>
			<button class="btn-review-post-modal-update">Post</button>
		</div>
		<!-- Modal content ends-->
	</div>
</div>