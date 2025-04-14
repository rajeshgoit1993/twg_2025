	<!--Desktop Tour Destination-midimage Starts-->
	@if(env("WEBSITENAME")==1)
		<section class="mBG">
			<div class="dPopularDestCont">
				<div class="dPopularDestTtl">
					<h2>World Popular Destinations</h2>
				</div>
			</div>
			<div class="dPageContainer">
				@foreach($img_data as $img)
					<div class="dItemCont">
						<div class="dTourItemCard">
							<a href="@if($img->row1_dest1!=''){{url('/Holidays/')}}/{{str_slug($img->row1_dest1)}}-tour-packages @endif" target="_blank">
								<div class="dTourItemCardImgCont">
									@if($img->row1_image1=="")
										<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
									@else
										<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row1_image1))}}" alt="img">
									@endif
								</div>
								<div>
									@if($img->row1_title1!="")
										<h4>{{$img->row1_title1}}</h4>
									@endif
									@if($img->row1_desc1!="")
										<!--<p>{{ $img->row1_desc1 }} <span>...Read More</span></p>-->
									@endif
								</div>
							</a>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row1_dest2!=''){{url('/Holidays/')}}/{{str_slug($img->row1_dest2)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row1_image2=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row1_image2))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row1_title2!="")
									<h4>{{$img->row1_title2}}</h4>
								@endif
								@if($img->row1_desc2!="")
									<!--<p>{{ $img->row1_desc2 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row1_dest3!=''){{url('/Holidays/')}}/{{str_slug($img->row1_dest3)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row1_image3=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row1_image3))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row1_title3!="")
									<h4>{{$img->row1_title3}}</h4>
								@endif
								@if($img->row1_desc3!="")
									<!--<p>{{ $img->row1_desc3 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row2_dest1!=''){{url('/Holidays/')}}/{{str_slug($img->row2_dest1)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row2_image1=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row2_image1))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row2_title1!="")
									<h4>{{$img->row2_title1}}</h4>
								@endif
								@if($img->row2_desc1!="")
									<!--<p>{{ $img->row2_desc1 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row2_dest2!=''){{url('/Holidays/')}}/{{str_slug($img->row2_dest2)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row2_image2=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row2_image2))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row2_title2!="")
									<h4>{{$img->row2_title2}}</h4>
								@endif
								@if($img->row2_desc2!="")
									<!--<p>{{ $img->row2_desc2 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row2_dest3!=''){{url('/Holidays/')}}/{{str_slug($img->row2_dest3)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row2_image3=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row2_image3))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row2_title3!="")
									<h4>{{$img->row2_title3}}</h4>
								@endif
								@if($img->row2_desc3!="")
									<!--<p>{{ $img->row2_desc3 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row3_dest1!=''){{url('/Holidays/')}}/{{str_slug($img->row3_dest1)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row3_image1=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row3_image1))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row3_title1!="")
									<h4>{{$img->row3_title1}}</h4>
								@endif
								@if($img->row3_desc1!="")
									<!--<p>{{ $img->row3_desc1 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row3_dest2!=''){{url('/Holidays/')}}/{{str_slug($img->row3_dest2)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row3_image2=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row3_image2))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row3_title2!="")
									<h4>{{$img->row3_title2}}</h4>
								@endif
								@if($img->row3_desc2!="")
									<!--<p>{{ $img->row3_desc2 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row3_dest3!=''){{url('/Holidays/')}}/{{str_slug($img->row3_dest3)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row3_image3=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row3_image3))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row3_title3!="")
									<h4>{{$img->row3_title3}}</h4>
								@endif
								@if($img->row3_desc3!="")
									<!--<p>{{ $img->row3_desc3 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row4_dest1!=''){{url('/Holidays/')}}/{{str_slug($img->row4_dest1)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row4_image1=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row4_image1))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row4_title1!="")
									<h4>{{$img->row4_title1}}</h4>
								@endif
								@if($img->row4_desc1!="")
									<!--<p>{{ $img->row4_desc1 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row4_dest2!=''){{url('/Holidays/')}}/{{str_slug($img->row4_dest2)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row4_image2=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row4_image2))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row4_title2!="")
									<h4>{{$img->row4_title2}}</h4>
								@endif
								@if($img->row4_desc2!="")
									<!--<p>{{ $img->row4_desc2 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row4_dest3!=''){{url('/Holidays/')}}/{{str_slug($img->row4_dest3)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row4_image3=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row4_image3))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row4_title3!="")
									<h4>{{$img->row4_title3}}</h4>
								@endif
								@if($img->row4_desc3!="")
									<!--<p>{{ $img->row4_desc3 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</section>
		@elseif(env("WEBSITENAME")==0)
		<section class="mBG">
			<div class="dPopularDestCont">
				<div class="dPopularDestTtl">
					<h2>Popular World Destinations</h2>
				</div>
			</div>
			<div class="dPageContainer">
				@foreach($img_data as $img)
					<div class="dItemCont">
						<div class="dTourItemCard">
							<a href="@if($img->row1_dest1!=''){{url('/Holidays/')}}/{{str_slug($img->row1_dest1)}}-tour-packages @endif" target="_blank">
								<div class="dTourItemCardImgCont">
									@if($img->row1_image1=="")
										<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
									@else
										<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row1_image1))}}" alt="img">
									@endif
								</div>
								<div>
									@if($img->row1_title1!="")
										<h4>{{$img->row1_title1}}</h4>
									@endif
									@if($img->row1_desc1!="")
										<!--<p>{{ $img->row1_desc1 }} <span>...Read More</span></p>-->
									@endif
								</div>
							</a>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row1_dest2!=''){{url('/Holidays/')}}/{{str_slug($img->row1_dest2)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row1_image2=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row1_image2))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row1_title2!="")
									<h4>{{$img->row1_title2}}</h4>
								@endif
								@if($img->row1_desc2!="")
									<!--<p>{{ $img->row1_desc2 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row1_dest3!=''){{url('/Holidays/')}}/{{str_slug($img->row1_dest3)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row1_image3=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row1_image3))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row1_title3!="")
									<h4>{{$img->row1_title3}}</h4>
								@endif
								@if($img->row1_desc3!="")
									<!--<p>{{ $img->row1_desc3 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row2_dest1!=''){{url('/Holidays/')}}/{{str_slug($img->row2_dest1)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row2_image1=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row2_image1))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row2_title1!="")
									<h4>{{$img->row2_title1}}</h4>
								@endif
								@if($img->row2_desc1!="")
									<!--<p>{{ $img->row2_desc1 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row2_dest2!=''){{url('/Holidays/')}}/{{str_slug($img->row2_dest2)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row2_image2=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row2_image2))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row2_title2!="")
									<h4>{{$img->row2_title2}}</h4>
								@endif
								@if($img->row2_desc2!="")
									<!--<p>{{ $img->row2_desc2 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row2_dest3!=''){{url('/Holidays/')}}/{{str_slug($img->row2_dest3)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row2_image3=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row2_image3))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row2_title3!="")
									<h4>{{$img->row2_title3}}</h4>
								@endif
								@if($img->row2_desc3!="")
									<!--<p>{{ $img->row2_desc3 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row3_dest1!=''){{url('/Holidays/')}}/{{str_slug($img->row3_dest1)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row3_image1=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row3_image1))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row3_title1!="")
									<h4>{{$img->row3_title1}}</h4>
								@endif
								@if($img->row3_desc1!="")
									<!--<p>{{ $img->row3_desc1 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row3_dest2!=''){{url('/Holidays/')}}/{{str_slug($img->row3_dest2)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row3_image2=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row3_image2))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row3_title2!="")
									<h4>{{$img->row3_title2}}</h4>
								@endif
								@if($img->row3_desc2!="")
									<!--<p>{{ $img->row3_desc2 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row3_dest3!=''){{url('/Holidays/')}}/{{str_slug($img->row3_dest3)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row3_image3=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row3_image3))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row3_title3!="")
									<h4>{{$img->row3_title3}}</h4>
								@endif
								@if($img->row3_desc3!="")
									<!--<p>{{ $img->row3_desc3 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row4_dest1!=''){{url('/Holidays/')}}/{{str_slug($img->row4_dest1)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row4_image1=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row4_image1))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row4_title1!="")
									<h4>{{$img->row4_title1}}</h4>
								@endif
								@if($img->row4_desc1!="")
									<!--<p>{{ $img->row4_desc1 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row4_dest2!=''){{url('/Holidays/')}}/{{str_slug($img->row4_dest2)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row4_image2=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row4_image2))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row4_title2!="")
									<h4>{{$img->row4_title2}}</h4>
								@endif
								@if($img->row4_desc2!="")
									<!--<p>{{ $img->row4_desc2 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
						<div class="dTourItemCard">
							<div class="dTourItemCardImgCont">
							<a href="@if($img->row4_dest3!=''){{url('/Holidays/')}}/{{str_slug($img->row4_dest3)}}-tour-packages @endif" target="_blank">
							<div class="dTourItemCardImgCont">
								@if($img->row4_image3=="")
									<img class="lazy-load" data-src="{{ asset("/public/uploads/") }}/d.png" alt="img" >
								@else
									<img class="lazy-load" data-src="{{CustomHelpers::get_base64_image(url('/public'.$img->row4_image3))}}" alt="img">
								@endif
							</div>
							<div>
								@if($img->row4_title3!="")
									<h4>{{$img->row4_title3}}</h4>
								@endif
								@if($img->row4_desc3!="")
									<!--<p>{{ $img->row4_desc3 }} <span>...Read More</span></p>-->
								@endif
							</div>
							</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</section>
	@endif
	<!--Desktop Tour Destination-midimage Ends-->