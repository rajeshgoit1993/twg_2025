									<!--Desktop Tour Tabs-Transfers Starts-->
									<div class="dTourPkgDesc">
										@if($details->transfers!='')
										<div class="dTourDesc">
											<h2>Tour Transfers</h2>
											<?php 
												$transfers=unserialize($details->transfers);
											?>
											<?php $a=0; ?>
											@foreach($transfers as $row=>$col)
											@if(array_key_exists('transport_type',$col) && array_key_exists('transfers_type',$col))
											<?php
												$transfers_data=DB::table('rt_transfer_list')->where([['transport_type','=',$col['transport_type']],['title','=',$col['transfers_type']]])->first();
											 ?>
											<div class="collapsible-container">
												<div class="collapsible-item dItem-box dItem-arrow" id=""><span class="glyphicon glyphicon-map-marker" style="color: #da2128; display: none"></span>{{ $col['mode_title'] }}</div>
												
												<!--Collapsible Content-->
												<div class="collapsible-item-content">
													<div class="dTourTransBox">
														<!--<div class="dTourTransTitle">{{$col['mode_title']}}</div>-->
														<div class="dTourTransDtlsBox">
															<div class="makeflex fullWidth">
																<!--Vehicle Image-->
																<div class="dTourTransImgBox">
																    @php
																        $transferImage = $transfers_data->transfer_image ?? null;
																    @endphp

																    @if(!empty($transferImage) && file_exists(public_path("uploads/transfer_image/{$transferImage}")))
																        <img src="{{ asset('public/uploads/transfer_image/'.$transferImage) }}" alt="Transfer-Image">
																    @else
																        <img src="{{ asset('public/uploads/default-img.webp') }}" alt="No-Image">
																    @endif
																</div>

																<div class="dTourTransDescBox">
																	<!--Private, Shared or Coach-->
																	<div class="dTourTransDescTopSection">
																		<h4 class="dTourTransTitle">{{ $col['mode_title'] }}</h4>
																		<h2 class="dTourTransTransportType">@if($transfers_data!='' && $transfers_data->transfer_type!=''){{$transfers_data->transfer_type}}@endif</h2>
																	</div>

																	<!--Vehicle Type, Duration & Inclusion-->
																	<div class="flexBetween">
																		<div class="dTourTransVehicleCont">
																			<h4 class="dTourTransHead text-left">Vehicle Type</h4>
																			<h5 class="dTourTransSubHead text-left">@if($transfers_data!='' && $transfers_data->vehicle_type!=''){{ $transfers_data->vehicle_type }}@endif</h5>
																		</div>

																		<div class="dtransferDurationCont">
																			<h4 class="dTourTransHead">Duration</h4>
																			<h5 class="dTourTransSubHead">@if($transfers_data!='' && $transfers_data->duration!=''){{ $transfers_data->duration }}@endif</h5>
																		</div>

																		<div>
																			<h4 class="dTourTransHead text-right">Includes</h4>
																			<h5 class="dTourTransSubHead text-right">@if($transfers_data!='' && $transfers_data->includes!=''){{ $transfers_data->includes }}@endif</h5>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php $a++; ?>
										@endif
										@endforeach
										</div>
										@endif
									</div>
									<!--Desktop Tour Tabs-Transfers Ends-->
									<!--Desktop-Tour-Tab-Collapsible-item-script-pagethree.js-->