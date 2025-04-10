									<!--Desktop Tour Tabs-Flights Starts-->
									<div class="dTourPkgDesc">
										<?php if($details->flight!=''): ?>
										<?php 
									 		$flight_data=unserialize($details->flight);
									 	?>
									 	<?php if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1): ?>
										<div class="">
											<div class="dTourFlightsCont">
												<?php $flight_detail=unserialize($details->flight); ?>
												<h2>Tour Flight</h2>
												<!--Upward Flight Starts-->
												<div class="dTourFlightBox">

													<!--Upward Flight Details-->
													<div class="dOnwardFlightBox">

													<!--Upward Flight Destination-->
													<div class="flexCenter appendBottom5">
														<div class="appendRight20">
														<?php if(array_key_exists('origin',$flight_detail) && $flight_detail['origin']==0): ?> 
															<!-- <span class="dFlightCityName"><?php echo e($flight_detail['origin']); ?></span> -->
															<span class="dFlightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['origin'],'previous_data')); ?></span>
														<?php endif; ?>
															<span class="dFlightCityName">-</span> 
														<?php if($flight_detail['dest']!=""): ?>
															<!-- <span class="dFlightCityName"><?php echo e($flight_detail['dest']); ?></span> -->
															<span class="dFlightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['dest'],'previous_data')); ?></span>
														<?php endif; ?>
														</div>

														<!-- flight date -->
														<div>
															<?php if(array_key_exists('onwarddate',$flight_detail)): ?> 
																<?php if($flight_detail['onwarddate']!=""): ?>
																	<!-- <?php
																		$originalDate_flight = str_replace('/','-',$flight_detail['onwarddate']);
																		$newDate_flight = date("d M Y", strtotime($originalDate_flight));
																	?>
																	<span class="dFlightDate">
																		<?php echo e(date('D', strtotime($originalDate_flight))); ?>, <?php echo e($newDate_flight); ?>

																	</span> -->
																	<span class="dFlightDate"><?php echo e(date('d M Y', strtotime($originalDate_flight))); ?></span>
																  <?php endif; ?> 
															  <?php endif; ?>
														</div>
													</div>

													<div class="flexCenter appendBottom15">
														<!--Flight Date Starts-->
														<?php if(array_key_exists('onwarddate',$flight_detail)): ?> 
															<?php if($flight_detail['onwarddate']!=""): ?>
																<?php
																	$originalDate_flight = $flight_detail['onwarddate'];
																	$newDate_flight = date("d M Y", strtotime($originalDate_flight));
																?>
																<!--<span class="fontWeight600 font18 color4A"><?php echo e(date('D', strtotime($originalDate_flight))); ?>, <?php echo e($newDate_flight); ?></span>-->
															<?php endif; ?>
														<?php endif; ?>
														<!--Flight Date Ends-->

														<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->

														<!--Flight Stops-Class-->
														<span class="dFlightStops">
															<?php echo e(!empty($flight_detail['numberstop'] ?? '') ? $flight_detail['numberstop'] : 'Non-stop'); ?>

														</span>
														<div class="dFlightDtlsSeparator"></div>
														<span class="dFlightClass">
															<!-- <?php if(array_key_exists('cabin',$flight_detail)): ?>
																<?php echo e($flight_detail['cabin']); ?>

															<?php endif; ?> -->
															<?php if(array_key_exists('cabin',$flight_detail)): ?>
																<?php echo e(CustomHelpers::get_flight_class_name($flight_detail['cabin'])); ?>

															<?php endif; ?>
														</span>
													</div>
													<div class="flexCenter" style="max-width: 600px;">
														<div class="dAirlineDtls">
															<!--<div class="pfwmt fontSize18 lineHeight22 textCenter"><?php if($flight_detail['name']!=""): ?> <?php echo e($flight_detail['name']); ?> <?php endif; ?></div>-->
															<div class="dAirlineLogoBox">
																<img src="" alt="airline" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
															</div>
															<div class="dAirlineName">
																<?php if(!empty($flight_detail['name']) && $flight_detail['name'] !== "0"): ?>
															        <?php echo e($flight_detail['name']); ?>

															    <?php else: ?>
															        Airline
															    <?php endif; ?>
															</div>
															<div class="dFlightNumber">
																<?php if(!empty($flight_detail['no'] ?? '')): ?>
																        <?php echo e($flight_detail['no']); ?>

																<?php else: ?>
																    <span></span>
																<?php endif; ?>
															</div>
														</div>		
														<div class="dflightDepBox">
															<div class="dFlightTime">
																<!-- <?php if($flight_detail['dhours']!=""): ?>
																	<?php echo e($flight_detail['dhours']); ?> 
																<?php endif; ?>:<?php if($flight_detail['ddmins']!=""): ?> 
																<?php if($flight_detail['ddmins']=='0'): ?>00 <?php else: ?> 
																	<?php echo e($flight_detail['ddmins']); ?> 
																<?php endif; ?> 
																<?php endif; ?> -->
																<?php if(!empty($flight_detail['dhours'])): ?>
																	<?php echo e(str_pad($flight_detail['dhours'], 2, '0', STR_PAD_LEFT)); ?>

																<?php endif; ?>
																<?php echo e(':'); ?>

																<?php if(isset($flight_detail['ddmins'])): ?>
																	<?php if($flight_detail['ddmins'] === '0' || $flight_detail['ddmins'] === 0): ?>
																		00
																	<?php else: ?>
																		<?php echo e(str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT)); ?>

																	<?php endif; ?>
																<?php endif; ?>
															</div>
															<div class="dFlightCity">
																<!-- <?php if($flight_detail['origin']!=""): ?>
																	<?php echo e($flight_detail['origin']); ?>

																<?php endif; ?> -->
																<?php echo e(!empty($flight_detail['origin'] ?? '') 
																? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'last_str')) : 'Departure'); ?>

															</div>
														</div>
														<div class="dFlightDurationCont">
															<div class="dFlightDuration">
																<?php echo e(array_key_exists('duration_hours', $flight_detail) ? $flight_detail['duration_hours'] . 'h ' : ''); ?>

																<?php echo e(array_key_exists('duration_dmins', $flight_detail) ? $flight_detail['duration_dmins'] . 'm' : ''); ?>

															</div>
															<div class="flexCenter">
																<i class="fa-plane" aria-hidden="true"></i>
																<div class="dFlightPath"></div>
																<i class="fa-map-marker" aria-hidden="true"></i>
															</div>
														</div>
														<div class="dflightDepBox">
															<div class="dFlightTime">
																<!-- <?php if($flight_detail['ahours']!=""): ?> 
																	<?php echo e($flight_detail['ahours']); ?> 
																<?php endif; ?>:<?php if($flight_detail['damins']!=""): ?> 
																<?php if($flight_detail['damins']==0): ?>00 <?php else: ?> 
																	<?php echo e($flight_detail['damins']); ?>

																<?php endif; ?> 
																<?php endif; ?> -->
																<?php if(!empty($flight_detail['ahours'])): ?>
																	<?php echo e(str_pad($flight_detail['ahours'], 2, '0', STR_PAD_LEFT)); ?>

																<?php endif; ?>
																<?php echo e(':'); ?>

																<?php if(isset($flight_detail['damins'])): ?>
																	<?php if($flight_detail['damins'] === '0' || $flight_detail['damins'] === 0): ?>
																		00
																	<?php else: ?>
																		<?php echo e(str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT)); ?>

																	<?php endif; ?>
																<?php endif; ?>
															</div>
															<div class="dFlightCity">
																<!-- <?php if($flight_detail['dest']!=""): ?> 
																	<?php echo e($flight_detail['dest']); ?> 
																<?php endif; ?> -->
																<?php echo e(!empty($flight_detail['dest'] ?? '') 
																? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'last_str')) : 'Arrival'); ?>

															</div>
														</div>
													</div>

													<!--Baggage Info-->
													<?php if((array_key_exists('baggage',$flight_detail) 
														&& $flight_detail['baggage']!='') 
														|| (array_key_exists('cbaggage',$flight_detail) 
														&& $flight_detail['cbaggage']!='')): ?>
													<div class="dBaggageCont">
														<div class="dFlightBaggageTitle">Baggage info</div>
														<div class="flexCenter">
															<!--Check-in Baggage Info-->
															<?php if(array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!=''): ?>
																<span class="dFlightBaggageSubTitle color4A">Cabin:&ensp;</span>
																<span class="dFlightBaggageSubTitle">
																	<?php if(array_key_exists('baggage',$flight_detail)): ?>
																		<?php echo e($flight_detail['baggage']); ?> 
																	<?php endif; ?>
																</span>
																<div class="dBaggageSeparator"></div>
															<?php endif; ?>
															<!--Cabin Baggage Info-->
															<?php if(array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!=''): ?>
																<span class="dFlightBaggageSubTitle color4A">Check in:&ensp;</span>
																<span class="dFlightBaggageSubTitle">
																	<?php if(array_key_exists('cbaggage',$flight_detail)): ?>
																		<?php echo e($flight_detail['cbaggage']); ?> 
																	<?php endif; ?>
																</span>
															<?php endif; ?>
														</div>
													</div>
													<?php endif; ?>
													</div>
												</div>
												<!--Upward Flight Ends-->

												<!--Return Flight Starts-->
												<div class="dTourFlightBox">

													<!--Return Flight Details-->
													<div class="dReturnFlightBox">

														<!--Return Flight Destination-->
														<div class="flexCenter appendBottom5">
															<div class="appendRight20">
																<!-- <?php if($flight_detail['dOrigin']!=""): ?>
																	<span class="dFlightCityName"><?php echo e($flight_detail['dOrigin']); ?></span>
																<?php endif; ?>
																	<span class="dFlightCityName">-</span> 
																<?php if($flight_detail['ddest']!=""): ?>
																	<span class="dFlightCityName"><?php echo e($flight_detail['ddest']); ?></span>
																<?php endif; ?> -->
																<?php if(array_key_exists('dOrigin',$flight_detail) && $flight_detail['dOrigin']==0): ?> 
																	<!-- <span class="dFlightCityName"><?php echo e($flight_detail['dOrigin']); ?></span> -->
																	<span class="dFlightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'],'previous_data')); ?></span>
																<?php endif; ?>
																	<span class="dFlightCityName">-</span> 
																<?php if($flight_detail['ddest']!=""): ?>
																	<!-- <span class="dFlightCityName"><?php echo e($flight_detail['ddest']); ?></span> -->
																	<span class="dFlightCityName"><?php echo e(CustomHelpers::get_city_seperate_code($flight_detail['ddest'],'previous_data')); ?></span>
																<?php endif; ?>
															</div>
															<div>
																<?php if(array_key_exists('downwarddate',$flight_detail)): ?> 
																	<?php if($flight_detail['downwarddate']!=""): ?>
																	<!-- <?php
																		$originalDate_flight_down = str_replace('/','-',$flight_detail['downwarddate']);
																		$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
																	?>
																	<span class="dFlightDate">
																		<?php echo e(date('D', strtotime($originalDate_flight_down))); ?>, <?php echo e($newDate_flight_down); ?>

																	</span> -->
																	<span class="dFlightDate"><?php echo e(date('d M Y', strtotime($originalDate_flight))); ?></span>
																	<?php endif; ?> 
																<?php endif; ?>
															</div>
														</div>
														<div class="flexCenter appendBottom15">
															<?php if(array_key_exists('downwarddate',$flight_detail)): ?> 
																<?php if($flight_detail['downwarddate']!=""): ?>
																	<?php
																		$originalDate_flight_down = $flight_detail['downwarddate'];
																		$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
																	?>
																	<!--<span class="fontWeight600 font18 color4A"><?php echo e(date('D', strtotime($originalDate_flight_down))); ?>, <?php echo e($newDate_flight_down); ?></span>-->
																<?php endif; ?> 
															<?php endif; ?>
															<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
															<span class="dFlightStops">
																<?php echo e(!empty($flight_detail['numberstop'] ?? '') ? $flight_detail['numberstop'] : 'Non-stop'); ?>

															</span>
															<div class="dFlightDtlsSeparator"></div>
															<span class="dFlightClass">
																<!-- <?php if(array_key_exists('dcabin',$flight_detail)): ?>
																	<?php echo e($flight_detail['dcabin']); ?>

																<?php endif; ?> -->
																<?php if(array_key_exists('dcabin',$flight_detail)): ?>
									                                <?php echo e(CustomHelpers::get_flight_class_name($flight_detail['dcabin'])); ?>

									                            <?php endif; ?>
															</span>
														  <!--<div style="border-left: 2px solid #ccc;height: 24px;margin-left: 10px;"></div>-->
														</div>

														<div class="flexCenter" style="max-width: 600px;">
															<div class="dAirlineDtls">
																<!--<div class="pfwmt fontSize18 lineHeight22 textCenter"><?php if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!=""): ?> <?php echo e($flight_detail['dname']); ?> <?php endif; ?></div>-->
																<div class="dAirlineLogoBox">
																	<img src="" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
																</div>
																<div class="dAirlineName">
																	<?php if(!empty($flight_detail['name']) && $flight_detail['name'] !== "0"): ?>
																        <?php echo e($flight_detail['name']); ?>

																    <?php else: ?>
																        Airline
																    <?php endif; ?>
																</div>
																<div class="dFlightNumber">
																	<?php if(!empty($flight_detail['dno'] ?? '')): ?>
																        <?php echo e($flight_detail['dno']); ?>

																    <?php else: ?>
																        <span></span>
																    <?php endif; ?>
																</div>
															</div>
															<div class="dflightDepBox">
																<div class="dFlightTime">
																	<!-- <?php if($flight_detail['ddhours']!=""): ?>
																		<?php echo e($flight_detail['ddhours']); ?> 
																	<?php endif; ?>:<?php if($flight_detail['ddmins']!=""): ?> 
																	<?php if($flight_detail['ddmins']=='0'): ?>00 <?php else: ?>
																		<?php echo e($flight_detail['ddmins']); ?>

																	<?php endif; ?> 
																	<?php endif; ?> -->
																	<?php if(!empty($flight_detail['ddhours'])): ?>
																		<?php echo e(str_pad($flight_detail['ddhours'], 2, '0', STR_PAD_LEFT)); ?>

																	<?php endif; ?>
																	<?php echo e(':'); ?>

																	<?php if(isset($flight_detail['ddmins'])): ?>
																		<?php if($flight_detail['ddmins'] === '0' || $flight_detail['ddmins'] === 0): ?>
																			00
																		<?php else: ?>
																			<?php echo e(str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT)); ?>

																		<?php endif; ?>
																	<?php endif; ?>
																</div>
																<div class="dFlightCity">
																	<!-- <?php if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!=""): ?>
																		<?php echo e($flight_detail['dOrigin']); ?> 
																	<?php endif; ?> -->
																	<?php echo e(!empty($flight_detail['dOrigin'] ?? '') 
																	? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'last_str')) : 'Departure'); ?>

																</div>
															</div>
															<div class="dFlightDurationCont">
																<div class="dFlightDuration">
																	<!-- <?php if(array_key_exists('return_duration_hours',$flight_detail)): ?>
																		<?php echo e($flight_detail['return_duration_hours']); ?>h 
																	<?php endif; ?>
																	<?php if(array_key_exists('return_duration_mins',$flight_detail)): ?>
																		<?php echo e($flight_detail['return_duration_mins']); ?>m 
																	<?php endif; ?> -->
																	<?php echo e(array_key_exists('return_duration_hours', $flight_detail) ? $flight_detail['return_duration_hours'] . 'h ' : ''); ?>

																	<?php echo e(array_key_exists('return_duration_mins', $flight_detail) ? $flight_detail['return_duration_mins'] . 'm' : ''); ?>

																</div>
																<div class="flexCenter">
																	<i class="fa-plane" aria-hidden="true"></i>
																	<div class="dFlightPath"></div>
																	<i class="fa-map-marker" aria-hidden="true"></i>
																</div>
															</div>
															<div class="dflightDepBox">
																<div class="dFlightTime">
																	<!-- <?php if($flight_detail['dahours']!=""): ?>
																		<?php echo e($flight_detail['dahours']); ?> 
																	<?php endif; ?>:<?php if($flight_detail['damins']!=""): ?> 
																	<?php if($flight_detail['damins']=='0'): ?>00 <?php else: ?> 
																		<?php echo e($flight_detail['damins']); ?> <?php endif; ?> 
																	<?php endif; ?> -->
																	<?php if(!empty($flight_detail['dahours'])): ?>
																		<?php echo e(str_pad($flight_detail['dahours'], 2, '0', STR_PAD_LEFT)); ?>

																	<?php endif; ?>
																	<?php echo e(':'); ?>

																	<?php if(isset($flight_detail['damins'])): ?>
																		<?php if($flight_detail['damins'] === '0' || $flight_detail['damins'] === 0): ?>
																			00
																		<?php else: ?>
																			<?php echo e(str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT)); ?>

																		<?php endif; ?>
																	<?php endif; ?>
																</div>
																<div class="dFlightCity">
																	<!-- <?php if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!=""): ?> 
																		<?php echo e($flight_detail['ddest']); ?> 
																	<?php endif; ?> -->
																	<?php echo e(!empty($flight_detail['ddest'] ?? '') 
																	? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'last_str')) : 'Arrival'); ?>

																</div>
															</div>
														</div>
														<!--Baggage Info-->
														<?php if((array_key_exists('baggage',$flight_detail) 
															&& $flight_detail['baggage']!='') 
															|| (array_key_exists('cbaggage',$flight_detail) 
															&& $flight_detail['cbaggage']!='')): ?>
															<div class="dBaggageCont">
																<div class="dFlightBaggageTitle">Baggage info</div>
																<div class="flexCenter">
																	<!--Check-in Baggage Info-->
																	<?php if(array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!=''): ?> 
																	<span class="dFlightBaggageSubTitle color4A">Cabin:&ensp;</span>
																	<span class="dFlightBaggageSubTitle">
																		<?php if(array_key_exists('baggage',$flight_detail)): ?>
																			<?php echo e($flight_detail['baggage']); ?> 
																		<?php endif; ?>
																	</span>
																	<div class="dBaggageSeparator"></div>
																	<?php endif; ?>

																	<!--Cabin Baggage Info-->
																	<?php if(array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!=''): ?> 
																		<span class="dFlightBaggageSubTitle color4A">Check in:&ensp;</span>
																		<span class="dFlightBaggageSubTitle">
																			<?php if(array_key_exists('cbaggage',$flight_detail)): ?>
																				<?php echo e($flight_detail['cbaggage']); ?>

																			<?php endif; ?>
																		</span>
																	<?php endif; ?>
																</div>
															</div>
														<?php endif; ?>
													</div>
												</div>
												<!--Return Flight Ends-->
											</div>
										</div>
										<?php endif; ?>
										<?php endif; ?>
									</div>
									<!--Desktop Tour Tabs-Flights Ends-->