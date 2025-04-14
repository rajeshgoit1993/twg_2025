<!-- Lead Service Status Modal (testimonial-d-gallery) -->
<div id="myModal_testmonial_gallery_d" class="modal_img_gallery mobscroll">
	<div class="modalContent_img_gallery modalbox_img_gallery">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<div class="modalheader_img_gallery">
			<h2>{{ getWebsiteData('name') }}</h2>
		</div>
		<div class="close-review-gallery closeModal_testmonial_gallery_d">&times;</div>
		<!-- Modal body-->
		<div class="modalbody_img_gallery">
			<!--Tour Images starts-->
				<div class="modal_img_gallery_cont">
					<div class="modal_img_gallery_cont_box">
					    @php
					        $defaultImage = asset('public/uploads/default-img.webp');
					        $imagePath = !empty($data->c_image) ? 'public/uploads/testimonial/'.$data->c_image : null;

					        // Check if the image exists on the server
					        $imageSrc = ($imagePath && file_exists(public_path($imagePath))) ? asset($imagePath) : $defaultImage;

					        // Create an array of images (useful for multiple images in the future)
					        $images = [$imageSrc];
					    @endphp

					    @foreach($images as $image)
					        <img class="mySlides" alt="img" src="{{ $image }}">
					    @endforeach

					    @if(count($images) > 1)
					        <div class="tourImage_sliders">
					            <div class="tourImage_sliderPrevious" onclick="plusSlides(-1)"></div>
					            <div class="tourImage_sliderNext" onclick="plusSlides(1)"></div>
					        </div>
					    @endif
					</div>
				</div>
				<!--Tour Images ends-->
		</div>
		<!-- Modal footer-->
		<!--<div class="lead-modalfooter make_bottom_bar_sticky">
			<button class="btn_lead_modal_close">Cancel</button>
			<button class="btn_lead_modal_update">Update</button>
		</div>-->
		<!-- Modal content ends-->
	</div>
</div>