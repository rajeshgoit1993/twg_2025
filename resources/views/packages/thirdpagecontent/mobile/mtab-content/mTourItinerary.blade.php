<div class="tab-pane fade mTourPkgDesc" id="mTourItinerary">
	<div class="tab-pane fade in active mTourDesc">
		<h2>Tour Plan</h2>
		<?php $day_value="1"; ?> 
		@foreach($daywise as $day)
			<article class="box">
				<div class="row mDaySeparator">
					<div class="col-md-12 col-xs-12 details">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="mDayPlan">
									<h3><?php echo "Day&nbsp;$day_value&nbsp;"; ?></h3>
									<h4>{{$day['title']}}</h4>
								</div>
							</div>
						</div> 
						<div class="mDayDesc">
							<p>{!!$day['desc']!!}</p>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
							<div class="mMealPlan">
								@if($day['meal_plan']=="N")
									@elseif($day['meal_plan']=="EP")
										<h3>Meal Included</h3>
										<h4>Room only</h4>
									@elseif($day['meal_plan']=="CP")
										<h3>Meal Included</h3>
										<h4>Breakfast</h4>
									@elseif($day['meal_plan']=="lu")
										<h3>Meal Included</h3>
										<h4>Lunch</h4>
									@elseif($day['meal_plan']=="di")
										<h3>Meal Included</h3>
										<h4>Dinner</h4>
									@elseif($day['meal_plan']=="bd")
										<h3>Meal Included</h3>
										<h4>Breakfast & Dinner</h4>
									@elseif($day['meal_plan']=="ld")
										<h3>Meal Included</h3>
										<h4>Lunch & Dinner</h4>
									@elseif($day['meal_plan']=="bld")
										<h3>Meal Included</h3>
										<h4>Breakfast & Lunch or Dinner</h4>
									@elseif($day['meal_plan']=="bldall")
										<h3>Meal Included</h3>
										<h4>Breakfast, Lunch & Dinner</h4>
									@elseif($day['meal_plan']=="MAP")
										<h3>Meal Included</h3>
										<h4>Breakfast & Lunch or Dinner</h4>
								@endif
							</div>
							</div>
						</div>
						<div class="row">
							@if(array_key_exists("tours",$day))
							<div class="col-md-12 col-xs-12">
							<div class="mTourInc">
								<h3>Tour Included</h3>
								<div class="makeflex">
								@foreach($day['tours'] as $tour)
									<h4>{{CustomHelpers::get_tour_name($tour)}} &nbsp;&nbsp;&nbsp;&nbsp;</h4>
								@endforeach
								</div>
							</div>
							</div>
							@endif
						</div>
					</div>
				</div>
			</article>
			<?php $day_value++; ?> 
		@endforeach
	</div>
</div>   
