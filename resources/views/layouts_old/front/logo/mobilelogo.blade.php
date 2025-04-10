					<!--Mobile Logo bar starts-->
					<div class="mLogo">
						@if(env("WEBSITENAME")=="1")
							<a href="{{ URL::to('/') }}" title="The World Gateway">
								<img src="{{ url('/public/uploads/twg.png') }}" alt="The World Gateway" />
							</a>
						@elseif(env("WEBSITENAME")=="0")
							<a href="{{ URL::to('/') }}" title="Rapidex Travels">
								<img src="{{ url('/public/uploads/logo.png') }}" alt="Rapidex Travels" />
							</a>
						@endif
					</div>
					<!--Mobile Logo bar ends-->
