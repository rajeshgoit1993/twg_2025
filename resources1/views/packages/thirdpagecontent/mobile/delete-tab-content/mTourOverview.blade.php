<div class="tab-pane fade in mTourPkgDesc" id="mTourOverview">
	@if($details->description!="")
	<div class="tab-pane fade in active mTourDesc">
		<h2>Description</h2>
		<p>{!!$details->description!!}</p>
	</div>
	@endif
	@if($details->description!="" && $details->highlights!="")
	<div class="custom_padding"></div>
	@endif
	@if($details->highlights!="")
	<div class="tab-pane fade in active mTourHgLhts">
		<h2>Tour Highlights</h2>
		<p>{!! $details->highlights !!}</p>
	</div>
	@endif
</div>
