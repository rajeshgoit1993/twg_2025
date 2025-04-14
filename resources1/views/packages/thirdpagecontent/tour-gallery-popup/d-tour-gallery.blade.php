			<!--modal-popup-img-gallery.css-->
			<!-- D-Tour Gallery Modal Starts-->
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
							    @php
							        // Filter valid images
							        $validImages = [];
							        foreach ($images as $img) {
							            $imageUrl = CustomHelpers::get_image_gallery($img->gallery_id, 'image_main');
							            if (!empty($imageUrl) && $imageUrl != '0') {
							                $validImages[] = $imageUrl;
							            }
							        }
							    @endphp

							    @if (count($validImages) > 0)
							        @foreach ($validImages as $index => $imageUrl)
							            <!-- <img class="mySlides" src="{{ $imageUrl }}" alt="Image {{ $index + 1 }}"> -->
							            <img class="mySlides" data-src="{{ $imageUrl }}" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" alt="Image {{ $index + 1 }}" style="display: none;">
							        @endforeach

							        <div class="tourImage_sliders">
							            <div class="tourImage_sliderPrevious" onclick="plusSlides(-1)"></div>
							            <div class="tourImage_sliderNext" onclick="plusSlides(1)"></div>
							        </div>

							         <!-- Dots -->
			                        <<!-- div class="dots-container">
			                            @foreach ($validImages as $index => $imageUrl)
			                                <span class="dot" onclick="currentSlide({{ $index + 1 }})"></span>
			                            @endforeach
			                        </div> -->
							    @else
							        <p class="no-images-message">No images available for this tour.</p>
							    @endif
							</div>
						</div>
						<!--Tour Images ends-->
					</div>
				</div>
			</div>
			<!-- D-Tour Gallery Modal Ends-->