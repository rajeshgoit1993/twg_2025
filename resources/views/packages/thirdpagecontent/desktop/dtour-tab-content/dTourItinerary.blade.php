									<!--Desktop Tour Tabs-Day Plan Starts-->
									<div class="dTourPkgDesc">
										<div class="dTourDesc">
											<h2>Tour Plan</h2>
											<?php 
											$day_value="1"; 
											$inc_date = 0;
$given_date = $input_date;
											?> 
											@foreach($daywise as $day)
												<div class="dDayPlanBox">
													<div class="dDayPlan">
														<h3><?php echo "Day&nbsp;$day_value&nbsp;"; ?> (<span class="dynamic_day_{{$day_value}}">{{date('d M Y', strtotime("+$inc_date days", strtotime($given_date)))}}</span>)</h3>
														<h4>{{$day['title']}}</h4>
													</div>
													<div class="dDayDesc">
														<p>{!!$day['desc']!!}</p>
													</div>
													<div class="dMealPlan">
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
													@if(array_key_exists("tours",$day))
													<div class="dTourActivity">
														<h3>Tour Included</h3>
														<div class="makeflex">
														@foreach($day['tours'] as $tour)
															<h4>{{CustomHelpers::get_tour_name($tour)}} &nbsp;&nbsp;&nbsp;&nbsp;</h4>
														@endforeach
														</div>
													</div>
													@endif
												</div>
												<?php 
												$day_value++;
												$inc_date++;

												 ?> 
											@endforeach
										</div>
									</div>
									<!--Desktop Tour Tabs-Day Plan Ends-->