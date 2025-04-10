<!--Testimonials starts-->
<div class="mtestimonialsContainer">
	<div class="mtestimonialsHead">
		<span class="mtestimonialsTab">TESTIMONIALS</span>
	</div>
	<div class="mtestmonialsSliderContainer">
		<div class="mobscroll mslider">
			@foreach($testimonial as $test_data)
			<div class="mtestimonialsCard">
				<div class="mtestimonialsImageContainer">
					@if($test_data->c_image=="")
						<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/default_profile_image.png" alt="image">
					@else
						<img class="lazy-load" data-src="{{ env('IMAGESRC').'/public/uploads/testimonial/'.$test_data->c_image }}" alt="image">
					@endif
				</div>
				<div class="mtestimonialsFooter">
					<div class="mtestimonialsContent">{{ substr($test_data->c_exp,0,190) }}...
						@if((strlen($test_data->c_exp))>="190")
							<a class="mreadMore" href="{{ url('/testimonials/'.CustomHelpers::custom_encrypt($test_data->id)) }}">read more</a>
						@endif
					</div>
					<div class="mtestimonialsName">
						<span>{{ $test_data->c_name }}</span>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>