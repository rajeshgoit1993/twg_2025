<!--modal-popup-img-gallery.css-->
<!-- Tour Gallery Modal -->
<div id="myModal_d_gallery" class="modal_img_gallery mobscroll">
	<div class="modalContent_img_gallery modalbox_img_gallery">
		<!-- Modal content starts-->
		<!-- Modal header-->
		<div class="modalheader_img_gallery">
			<h2>{{ $details->title }}</h2>
		</div>
		<div class="btnCloseModal_d_gallery">&times;</div>
		<!-- Modal body-->
		<div class="modalbody_img_gallery">
		<!--Tour Images starts-->
				<div class="modal_img_gallery_cont">
					<div class="modal_img_gallery_cont_box">
						<?php $ab=1;?>
						@foreach($images as $img)
						@if(CustomHelpers::get_image_gallery($img->gallery_id,'image_main')!="0")
							<img class="mySlides" src="{{ CustomHelpers::get_image_gallery($img->gallery_id,'image_main') }}" alt="TourImage">
						@endif
						<?php $ab++;?>
						@endforeach
						<div class="tourImage_sliders">
							<div class="tourImage_sliderPrevious" onclick="plusSlides(-1)"></div>
							<div class="tourImage_sliderNext" onclick="plusSlides(1)"></div>
						</div>
					</div>
					<!--<div class="tourImageBoxTwo">
						<img class="tourImageTwo" src="{{ CustomHelpers::get_image_gallery($img->gallery_id,'image_main') }}" alt="TourImage">
					</div>-->
				</div>
				<!--Tour Images ends-->
		</div>
	</div>
</div>