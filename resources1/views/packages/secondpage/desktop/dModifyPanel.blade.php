	<!--Desktop Modify Date Panel Starts-->
	<div class="dPosition_Sticky">
		<div class="dDatePanelCont" id="modify">
			<div class="mobscroll scrollX">
			<div class="dPageContainer">
				<form action="{{ route('productList') }}" method="post" autocomplete="off" id="search3" name="search3">
					<input type="hidden" name="_token" value="{{ Session::token() }}"/>
					<div class="flexCenter">

						<!--Tour Destination-->
						<div class="dSearchModifyBox tourCityBox_update pointer" onclick="let sel = this.querySelector('select'); sel.focus(); if ($(sel).data('select2')) { $(sel).select2('open'); }">
						    <label for="destination_search">Destination</label>
						    <select class="select3 package_service" id="destination_search" name="destination_search" required>
						        <option value="{{ $destination_search }}" selected>{{ $destination_search }}</option>
						    </select>
						</div>
						
						<div class="dSearchModifyBox tourDateBox_update pointer" onclick="this.querySelector('input').focus();">
						    <label for="datepicker_modify">Travel Date</label>
						    <input type="text" id="datepicker_modify" name="datepicker" value="{{ $date }}" placeholder="Select Date" />
						</div>


						<!--Package Type-->
						<div class="dSearchModifyBox themeBox_update dSearchInputArrow2 pointer" onclick="let sel = this.querySelector('select'); sel.focus(); if ($(sel).data('select2')) { $(sel).select2('open'); }">
							<label for="select_theme">Theme</label>
							<select id="select_theme" name="select_theme" class="select2">
							<?php
								// Get the search theme
								$search_theme = $destination_search;

								// Initialize a function to process themes
								function processThemes($data)
								{
								    $categories = [];
								    foreach ($data as $item) {
								        if (!empty($item->package_category) && $item->package_category !== 'N;') {
								            $unserialized = @unserialize($item->package_category);
								            if (is_array($unserialized)) {
								                $categories = array_merge($categories, $unserialized);
								            } else {
								                Log::warning('Invalid package_category data:', ['data' => $item->package_category]);
								            }
								        }
								    }
								    $categories = array_unique($categories);

								    // Generate HTML options
								    $options = "<option value=''>All</option>";
								    foreach ($categories as $category) {
								        if ($category) {
								            $options .= "<option value='" . htmlspecialchars($category) . "'>" . htmlspecialchars($category) . "</option>";
								        }
								    }
								    return $options;
								}

								// Query database for city, country, or state matches
								$data = DB::table('rt_packages')
								    ->where([['city', 'like', '%' . $search_theme . '%'], ['status', '=', '1']])
								    ->orWhere([['country', 'like', '%' . $search_theme . '%'], ['status', '=', '1']])
								    ->orWhere([['state', 'like', '%' . $search_theme . '%'], ['status', '=', '1']])
								    ->get();

								// Process themes for city, country, or state matches
								$theme_show = processThemes($data);

								// Check if no themes were found; perform a continent search
								if ($theme_show === "<option value=''>All</option>") {
								    $data = DB::table('rt_packages')
								        ->where([['continent', 'like', '%' . $search_theme . '%'], ['status', '=', '1']])
								        ->get();

								    // Process themes for continent matches
								    $theme_show .= processThemes($data);
								}

								// Output the final options
								echo $theme_show;
							?>
							</select>
						</div>

						<!--Update-->
						<button class="dSearchModifyBox btnSearchUpdate">Update</button>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>
	<!--Desktop Modify Date Panel Ends-->