		<!--Mobile Sorting Starts-->
		<div class="mSearch_Sticky">
			<div class="mFilterCont">
				<div class="mPageContainer">
					<div class="flexCenter flexBetween">
						<div class="mTourTitle">
							<h2>
								<a class="mHomeArrow" href="<?php echo e(route('home')); ?>"></a>
								<span><?php echo e($destination_search); ?> Tour Packages</span>
								<input type="hidden" id="destination" value="<?php echo e($destination_search); ?>">
							</h2>
						</div>
						
						<!--Filter Modal Starts-->
						<div class="mFltrTtl" id="btn_get_mFilterModal">
							<span class="fa fa-filter">&nbsp;</span>Filter
						</div>
					    <!--Filter Modal Ends-->

					    <!--Bootstrap Filter Modal Starts-->
						<!--<div class="mFltrTtl" id="filter" data-toggle="modal" data-target="#mobilefilter"><span class="fa fa-filter">&nbsp;</span>Filter</div>-->
						<!--Bootstrap Filter Modal Ends-->
					</div>
				</div>
			</div>
		</div>
		<!--Mobile Sorting Ends-->

		<!--Mobile Tour Search Edit starts-->
		<div class="mEditSearch_Sticky">
			<div class="mEditSearchCont">
				<div class="mEditSearchBox mobscroll">
					<div class="mEditSearchItem"><?php echo e(ucfirst($destination_search)); ?></div>
					
					<div class="mEditSearchItem mSpaceIcon"><?php echo e($date); ?></div>
					<div class="mEditSearchItem mSpaceIcon"><?php echo e(count($data)); ?><span class="font12">/<?php echo e(count($data)); ?></span> Packages</div>
				</div>
				<!--<div class="mSearchInput_edit" id="btn_getModal_searchInputs">Edit</div>-->
				<div class="mSearchInput_edit" id="btn_get_mSearchModal">Edit</div>
			</div>
		</div>
		<!--Mobile Tour Search Edit ends-->

		<!--Mobile Sorting Starts-->
		<div class="mSortingCont">
			<div class="mPageContainer">
				<!--<div class="mItemSearchBoxWrapper">
					<label for="search_item">Search by:</label>
					<input type="text" id="search_item" placeholder="Enter tour package name" />
				</div>-->
				<div class="mItemSortingWrapper">
					<label for="sort_filter">Sorted by:</label>
					<div class="mSortingBox sortingArrow">
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
		</div>
		<!--Mobile Sorting Ends-->