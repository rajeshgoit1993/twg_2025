<!--Review Photo Modal (add-review-photos) -->
<div id="myModal_review_photo_d" class="modal-add-review-photo mobscroll">
	<div class="modalContent-review-photo modal-add-review-photo-box">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<div class="modalheader-review-photo-box">
			<h2>Attach photos to your review</h2>
		</div>
		<div class="close-modal closeModal_review_photo_d" title="Close">&times;</div>
		<!-- Modal body-->
		
		<div class="modalbody-review-photo-box">
				<!--Tour Images starts-->
				<div class="modal-add-review-photo-box-cont">
					<div class="modal-add-review-photo-box-cont_box">
					<div style="overflow: hidden;">
						<div class="tab-photos">
							<button class="tablinks active" onclick="openTab(event, 'upload-photos-from-pc')">Upload photos</button>
							<button class="tablinks" onclick="openTab(event, 'upload-photos-from-phone')">Photos from phone</button>
						</div>
						<!--Upload Photos from PC-->
						<div id="upload-photos-from-pc" class="tabcontent height-scroll" style="display: block;">
							<div class="upload-from-pc-img-box-cont" onclick="uploadFiles()" style="display: ;">
							<!--upload img from pc message starts-->
							<div class="selectImg-cont">
								<div class="selectImg-wrapper">
									<img src="<?php echo e(asset('public/uploads/frontend-images/add-photo.png')); ?>" alt="Photo">
								</div>
								<div class="selectImg-cont-tag">Drag photos here</div>
								<div class="selectImg-cont-tag">-or-</div>
								<div class="apndTop15">
									<button>Select photos from your computer</button>
								</div>
							</div>
							<!--upload img from pc message ends-->
							<!--upload img from pc starts-->
							<div id="review-img-from-pc" style="display: none;">
								<div class="review-photo-wrapper">
									<div>
										<img src="" alt="Photo">
									</div>
									<div class="upload-from-pc-img-edit-bar">
										<div class="img-edit-bar-content-box">
											<div class="img-edit-button select-none" title="Rotate left" aria-hidden="true" id="editbar-rotate-left">
												<div><i class="fa-rotate-left"></i></div>
											</div>
											<div class="img-edit-button select-none" title="Rotate right" aria-hidden="true" id="editbar-rotate-right">
												<div><i class="fa-rotate-right"></i></div>
											</div>
											<div class="img-edit-button select-none" title="Delete" aria-hidden="true" id="editbar-delete">
												<div><i class="fa-trash"></i></div>
											</div>
										</div>
										<div class="img-caption">image name</div>
									<div class="img-caption-new">Add Caption</div>
									</div>
									<div class="input-img-caption-box">
										<div>
											<span><input id="newImgCaptionInputBox" maxlength="150"></span>
											<div class="input-img-caption-tag">Press Enter to apply or Esc to cancel</div>
										</div>
										<div class="arrow-cont">
											<div class="arrow-one"></div>
											<div class="arrow-two"></div>
										</div>
									</div>
								</div>
								<div class="review-photo-wrapper">
									<div>
										<img src="<?php echo e(asset('public/uploads/frontend-images/add-photo.png')); ?>" alt="Photo">
									</div>
									<div class="upload-from-pc-img-edit-bar">
										<div class="img-edit-bar-content-box">
											<div class="img-edit-button select-none" title="Rotate left" aria-hidden="true" id="editbar-rotate-left">
												<div><i class="fa-rotate-left"></i></div>
											</div>
											<div class="img-edit-button select-none" title="Rotate right" aria-hidden="true" id="editbar-rotate-right">
												<div><i class="fa-rotate-right"></i></div>
											</div>
											<div class="img-edit-button select-none" title="Delete" aria-hidden="true" id="editbar-delete">
												<div><i class="fa-trash"></i></div>
											</div>
										</div>
										<div class="img-caption">screenshot</div>
									<div class="img-caption-new">Add Caption</div>
									</div>
									<div class="input-img-caption-box">
										<div>
											<span><input id="newImgCaptionInputBox" maxlength="999"></span>
											<div class="input-img-caption-tag">Press Enter to apply or Esc to cancel</div>
										</div>
										<div class="arrow-cont">
											<div class="arrow-one"></div>
											<div class="arrow-two"></div>
										</div>
									</div>
								</div>
							</div>
								<!--<div class="review-photo-wrapper">
									<img class="" src="https://www.gstatic.com/images/icons/material/system_gm/2x/add_a_photo_gm_blue_24dp.png" alt="Photo">
									<div class="upload-from-pc-img-delete">&times;</div>
								</div>-->
							<!--upload img from pc ends-->
							</div>
						</div>
						<!--Upload Photos from Phone-->
						<div id="upload-photos-from-phone" class="tabcontent height-scroll" style="display: none;">
							<div class="upload-from-pc-img-box-cont" style="display: ;">
							<!--upload img from pc starts-->
							<div id="review-img-from-pc" style="display: ;">
								<div class="review-photo-wrapper img-selected">
									<div>
										<img src="" alt="Photo">
									</div>
									<div class="upload-from-pc-img-edit-bar">
										<div class="img-edit-bar-content-box">
											<div class="img-edit-button select-none" title="Rotate left" aria-hidden="true" id="editbar-rotate-left">
												<div><i class="fa-rotate-left"></i></div>
											</div>
											<div class="img-edit-button select-none" title="Rotate right" aria-hidden="true" id="editbar-rotate-right">
												<div><i class="fa-rotate-right"></i></div>
											</div>
											<div class="img-edit-button select-none" title="Delete" aria-hidden="true" id="editbar-delete">
												<div><i class="fa-trash"></i></div>
											</div>
										</div>
									</div>
									<div class="img-checkmark">
										<div class="checkmark_circle"></div>
										<div class="checkmark_stem"></div>
										<div class="checkmark_kick"></div>
									</div>
								</div>
								<div class="review-photo-wrapper">
									<div>
										<img src="<?php echo e(asset('public/uploads/frontend-images/add-photo.png')); ?>" alt="Photo">
									</div>
									<div class="upload-from-pc-img-edit-bar">
										<div class="img-edit-bar-content-box">
											<div class="img-edit-button select-none" title="Rotate left" aria-hidden="true" id="editbar-rotate-left">
												<div><i class="fa-rotate-left"></i></div>
											</div>
											<div class="img-edit-button select-none" title="Rotate right" aria-hidden="true" id="editbar-rotate-right">
												<div><i class="fa-rotate-right"></i></div>
											</div>
											<div class="img-edit-button select-none" title="Delete" aria-hidden="true" id="editbar-delete">
												<div><i class="fa-trash"></i></div>
											</div>
										</div>
									</div>
									<div class="img-checkmark">
										<div class="checkmark_circle"></div>
										<div class="checkmark_stem"></div>
										<div class="checkmark_kick"></div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
						<!--<button type="button" class="view_gallery" id="addModal">View Gallery</button>-->
					</div>
				</div>
				<!--Tour Images ends-->
		</div>
		
		<!-- Modal footer-->
		<div class="add-review-photo-footer make_bottom_bar_sticky">
			<div>
				<button class="btn-review-photo-select-disabled">Select</button>
				<button class="btn-review-photo-box-close cancelModal_review_photo_d">Cancel</button>
			</div>
			<div class="post-tag-line">Posting publicly on the Web</div>
			<div>
				<button class="btn-review-photo-more-disabled" onclick="uploadFiles()">
					<img class="review-photo-upload-icon" src="<?php echo e(asset('public/uploads/frontend-images/add-photo.png')); ?>" alt="upload photo"><span>Upload more</span>
				</button>
			</div>
		</div>
		<!-- Modal content ends-->
	</div>
</div>