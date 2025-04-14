	<!--Desktop Tour Name Starts-->
	<div class="dPageContainer">
		<div class="dTourTitleCont">
			<h1>{{ $destination_search }}</h1>
			<input type="hidden" id="destination" value="{{ $destination_search }}">
			<div class="dTourCount">{{ count($data) }}<span class="font12">/{{ count($data) }}</span> Tour Packages</div>
		</div>
	</div>
	<!--Desktop Tour Name Ends-->