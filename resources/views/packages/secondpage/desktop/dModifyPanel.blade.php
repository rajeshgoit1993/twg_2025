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
						        <option value="{{ $destination_search }}" selected>{{ ucfirst($destination_search) }}</option>
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
       
        $options = "<option value=''>All</option>";
        foreach ($total_themes as $theme_d) {
            $selected = (strtolower($theme_name) == strtolower($theme_d)) ? "selected" : "";
            $options .= "<option value='" . htmlspecialchars($theme_d) . "' $selected>" . htmlspecialchars($theme_d) . "</option>";
        }
        echo $options;
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