					<!--Mobile Logo bar starts-->
					@php
						$websiteData = getWebsiteData(); 
					@endphp
					<div class="mLogo">
						<a href="{{ $websiteData['route'] }}" title="{{ $websiteData['name'] }}">
							<img src="{{ $websiteData['logo'] }}" alt="{{ $websiteData['alt'] }}" />
						</a>
					</div>
					<!--Mobile Logo bar ends-->