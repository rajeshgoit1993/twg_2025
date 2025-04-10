<!--calender start-->
<div class="tab-pane fade mTourPkgDesc" id="mTourPriceCalendar">
	<div class="tab-pane fade in active">
		<div class="mTourDesc">
			<h2>Pricing Calender</h2>
		</div>
		<div class="row">
		<div class="container mWhiteBG pdngUD10 appendBtm10">
			<div class="col-md-9 col-sm-7 col-xs-6"></div>
			<div class="col-md-3 col-sm-5 col-xs-6 mCaldrPref">
				<label>Preference</label>
				<?php
					$pri=CustomHelpers::get_price($details->id);
					$price_upcoming=CustomHelpers::get_up_price($details->id);
				?>
				@if(($pri!="On Request" && $details->onrequest!="1"))
				<?php
					$price_count=count($price);
					$package_type="";
					for($i=0;$i<$price_count;$i++) {
						$package_type.=$price[$i]["package_rating"].",";
						}
						$package_array=array_unique(explode(",",$package_type));
						$package_array=implode(" ",$package_array);
						$package_array=explode(" ",$package_array);
						$package_array_count=(count($package_array)-1);
				?>
					<input type="hidden" value="{{$price_count}}" id="hidden_value">
					<input type="hidden" value="normal"  name="" class="pkg_type">
					<input type="hidden" value="{{ $id }}" id="package_value">
					<select id="package_type">
						@for($j=0;$j<$package_array_count;$j++)
							<option value="{{ $package_array[$j] }}" pkg_date="<?php  echo date('Y-m-d'); ?>">
								{{ CustomHelpers::getTableRecordById($package_array[$j],'rt_pkg_rating_type','name') }}
							</option>
						@endfor
						</select>
				@elseif(($price_upcoming!="On Request" && $details->upcoming!="1"))
				<?php
					$price_up=unserialize($details->upcoming_pricing);
					$price_up_count=count($price_up);
					$package_type="";
					for($i=0;$i<$price_up_count;$i++) {
						$package_type.=$price_up[$i]["package_rating"].",";
						}
						$package_array=array_unique(explode(",",$package_type));
						$package_array=implode(" ",$package_array);
						$package_array=explode(" ",$package_array);
						$package_array_count=(count($package_array)-1);
				?>
					<input type="hidden" value="{{$price_up_count}}" id="hidden_value">
					<input type="hidden" value="{{ $id }}"  id="package_value">
					<input type="hidden" value="upcoming"  name="" class="pkg_type">
					<select id="package_type">
						@for($j=0;$j<$package_array_count;$j++)
							<option value="{{ $package_array[$j] }}" pkg_date={{CustomHelpers::get_pkg_type_record($package_array[$j],$id)}}>
							{{ CustomHelpers::getTableRecordById($package_array[$j],'rt_pkg_rating_type','name') }}
							</option>
						@endfor
					</select>
				@endif
			</div>
		</div>
		<div class="col-md-12">
			<div id="calendar_parrent">
				<div id="calendar"></div>
			</div>
		</div>
		</div>
	</div>
</div>
<!--calender end-->