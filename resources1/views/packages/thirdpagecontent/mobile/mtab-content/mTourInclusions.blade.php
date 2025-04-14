<div class="tab-pane fade mTourPkgDesc" id="mTourInclusions">
	@if($details->inclusions!="")
	<div class="tab-pane fade in active mTourHgLhts"> 
		<h2>Inclusions</h2>
		<p>{!!$details->inclusions!!}</p>
	</div>
	<div class="custom_padding"></div>
	@endif
	@if($details->exclusions!="")
	<div class="tab-pane fade in active mTourHgLhts" id="description">
		<h2>Exclusions</h2>
		<p>{!!$details->exclusions!!}</p>
	</div>
	@endif
</div>