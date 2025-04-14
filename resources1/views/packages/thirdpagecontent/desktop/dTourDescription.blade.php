<div class="tab-pane fade in active tourPkgDesc" id="dTourDescription">
	@if($details->description!="")
	<div class="tab-pane fade in active tourDesc">
		<h2>Tour Description</h2>
		<p>{!!$details->description!!}</p>
	</div>
	@endif
	@if($details->description!="" && $details->highlights!="")
	<div class="custom_padding"></div>
	@endif
	@if($details->highlights!="")
	<div class="tab-pane fade in active tourHgLhts">
		<h2>Tour Highlights</h2>
		<p>{!! $details->highlights !!}</p>
	</div>
	@endif
</div>
