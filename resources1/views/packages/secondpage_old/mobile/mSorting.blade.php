<div class="mSortingCont">
	<div class="container">
		<div class="row flexCenter">
			<div class="col-md-10 col-xs-10">
				<p class="mTourTitle"><a href="{{url('/')}}"><span class="mTourHome"></span></a> {{$destination_search}} Tour Packages</p>
				<input type="hidden" id="destination" value="{{ $destination_search }}">
			</div>
			<div class="col-md-2 col-xs-2">
				<span class="mFltrTtl" data-toggle="modal" data-target="#mobilefilter" id="filter"><span class="fa fa-filter">&nbsp;</span>Filter</span>
			</div>
		</div>
	</div>
</div>
<div class="container mWhiteBG pdngUD10">
	<div class="row">
		<div class="col-md-9 col-sm-7 "></div>
		<div class="col-md-3 col-sm-5 sortingPkg">
			<label>Sorted by:</label>
			<select id="sort_filter" class="sort_filter">
				<option value="SEL">Popular</option>
				<option value="PLH">Price - Low to High</option>
				<option value="PHL">Price - High to Low</option>
				<option value="DLH">Duration - Low to High</option>
				<option value="DHL">Duration - High to Low</option>
			</select>
		</div>
	</div>
</div>