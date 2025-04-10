<!-- Room selection section -->
							<div class="roomGuests">
								<label for="roomnumber"><b>No of Rooms</b> <span class="requiredcolor">*</span></label>
								<select class="form-control select_room" name="no_of_room">
									@for($i = 1; $i <= 10; $i++)
										<option value="{{ $i }}" @if($i==$packagesData->no_of_room) selected @endif>{{ $i }}</option>
									@endfor
								</select>

								<input type="text" class="quote1_pop_passenger_value" 
										value="{{ CustomHelpers::get_seperate_pass($packagesData->id,1) }}" 
										placeholder="" 
										readonly />
							</div>

							<!-- Dynamic room and guest section -->
							<div class="dynamic_four" id="dynamic_four">
							<?php 
								
						       	$rooms=unserialize($packagesData->room);

						    ?>
						    @if($rooms!='')
								<?php
									$m=1;
									$k=0;
								?>
								@foreach($rooms as $row=>$col)
									@if($m>1)
										<div id="fourrow{{ $i }}">

										    <!-- Room 1 configuration -->
										    <div class="room-container">
										        <div class="label textUppercase">Room {{ $m }}</div>
										        <br>
										        <!-- Maximum guests allowed dropdown -->
										        <div class="makeflex align-center">
										            <div class="label">Maximum guest allowed <span class="requiredcolor">*</span></div>
										            <select class="form-control max_passenger" 
										                    name="room[{{ $k }}][max_passenger]" 
										                    style="max-width: 90px; border-radius: 3px;">
										                @for($i = 1; $i <= 10; $i++)
										                    <option value="{{ $i }}" @if($i==$col['max_passenger']) selected @endif>{{ $i }}</option>
										                @endfor
										            </select>
										        </div>

										        <!-- Guests selection for Room 1 -->
										        <div class="guest-room-wrapper">

										            <!-- Adult (Twin Sharing +12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][twin_adult_room]" class="twin_adult_room_value" value="{{$col['twin_adult_room']}}" />
										                    <span class="travellersMinus twin_adult_room_dec">&#8722;</span>
										                    <span class="travellersValue twin_adult_room_result">{{$col['twin_adult_room']}}</span>
										                    <span class="travellersPlus twin_adult_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Adult<br>(+12yrs)</p>
										            </div>

										            <!-- Extra Adult (+12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][extra_adult_room]" class="extra_adult_room_value" value="{{$col['extra_adult_room']}}" />
										                    <span class="travellersMinus extra_adult_room_dec">&#8722;</span>
										                    <span class="travellersValue extra_adult_room_result">{{$col['extra_adult_room']}}</span>
										                    <span class="travellersPlus extra_adult_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
										            </div>

										            <!-- Child (With Bed 2-12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][child_with_bed_room]" class="child_with_bed_room_value" value="{{$col['child_with_bed_room']}}" />
										                    <span class="travellersMinus child_with_bed_room_dec">&#8722;</span>
										                    <span class="travellersValue child_with_bed_room_result">{{$col['child_with_bed_room']}}</span>
										                    <span class="travellersPlus child_with_bed_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
										            </div>

										            <!-- Child (without bed 2-12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][child_without_bed_room]" class="child_without_bed_room_value" value="{{$col['child_without_bed_room']}}" />
										                    <span class="travellersMinus child_without_bed_room_dec">&#8722;</span>
										                    <span class="travellersValue child_without_bed_room_result">{{$col['child_without_bed_room']}}</span>
										                    <span class="travellersPlus child_without_bed_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
										            </div>

										            <!-- Infant (0-2yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][infant_room]" class="span_value_child_with_bed infant_room_value" value="{{$col['infant_room']}}">
										                    <span class="travellersMinus infant_room_dec">&#8722;</span>
										                    <span class="travellersValue infant_room_result">{{$col['infant_room']}}</span>
										                    <span class="travellersPlus infant_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
										            </div>

										            <!-- Single (+12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][single_room]" class="single_room_value" value="{{$col['single_room']}}">
										                    <span class="travellersMinus single_room_dec">&#8722;</span>
										                    <span class="travellersValue single_room_result">{{$col['single_room']}}</span>
										                    <span class="travellersPlus single_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Single (+12yrs)</p>
										            </div>

										            <!-- Remove rooms button -->
										            <div class="text-center">
										                <button type="button" name="remove" id="{{ $i }}" class="btn btn-danger btn_remove_four">x Remove </button>
										            </div>
										        </div>
										    </div>
										</div>
									@else
										<div id="fourrow{{ $i }}">

										    <!-- Room 1 configuration -->
										    <div class="room-container">
										        <div class="label textUppercase">Room {{ $m }}</div>
										        <br>
										        
										        <!-- Maximum guests allowed dropdown -->
										        <div class="makeflex align-center">
										            <div class="label">Maximum guest allowed <span class="requiredcolor">*</span></div>
										            <select class="form-control max_passenger" name="room[{{ $k }}][max_passenger]" style="max-width: 90px; border-radius: 3px;">
										                @for($i = 1; $i <= 10; $i++)
										                    <option value="{{ $i }}" @if($i==$col['max_passenger']) selected @endif>{{ $i }}</option>
										                @endfor
										            </select>
										        </div>

										        <!-- Guests selection for Room 1 -->
										        <div class="guest-room-wrapper">
										            
										            <!-- Adult (Twin Sharing +12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][twin_adult_room]" class="twin_adult_room_value" value="{{$col['twin_adult_room']}}" />
										                    <span class="travellersMinus twin_adult_room_dec">&#8722;</span>
										                    <span class="travellersValue twin_adult_room_result">{{$col['twin_adult_room']}}</span>
										                    <span class="travellersPlus twin_adult_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Adult (Twin Sharing +12yrs)</p>
										            </div>

										            <!-- Extra Adult (+12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][extra_adult_room]" class="extra_adult_room_value" value="{{$col['extra_adult_room']}}" />
										                    <span class="travellersMinus extra_adult_room_dec">&#8722;</span>
										                    <span class="travellersValue extra_adult_room_result">{{$col['extra_adult_room']}}</span>
										                    <span class="travellersPlus extra_adult_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Extra Adult (+12yrs)</p>
										            </div>

										            <!-- Child (With Bed 2-12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][child_with_bed_room]" class="child_with_bed_room_value" value="{{$col['child_with_bed_room']}}" />
										                    <span class="travellersMinus child_with_bed_room_dec">&#8722;</span>
										                    <span class="travellersValue child_with_bed_room_result">{{$col['child_with_bed_room']}}</span>
										                    <span class="travellersPlus child_with_bed_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Child (With Bed 2-12yrs)</p>
										            </div>

										            <!-- Child (without bed 2-12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][child_without_bed_room]" class="child_without_bed_room_value" value="{{$col['child_without_bed_room']}}" />
										                    <span class="travellersMinus child_without_bed_room_dec">&#8722;</span>
										                    <span class="travellersValue child_without_bed_room_result">{{$col['child_without_bed_room']}}</span>
										                    <span class="travellersPlus child_without_bed_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Child (without bed 2-12yrs)</p>
										            </div>

										            <!-- Infant (0-2yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][infant_room]" class="span_value_child_with_bed infant_room_value" value="{{$col['infant_room']}}">
										                    <span class="travellersMinus infant_room_dec">&#8722;</span>
										                    <span class="travellersValue infant_room_result">{{$col['infant_room']}}</span>
										                    <span class="travellersPlus infant_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Infant (0-2yrs)</p>
										            </div>

										            <!-- Single (+12yrs) -->
										            <div>
										                <div class="addTravellerValue">
										                    <input type="hidden" id="travellers" name="room[{{$k}}][single_room]" class="single_room_value" value="{{$col['single_room']}}">
										                    <span class="travellersMinus single_room_dec">&#8722;</span>
										                    <span class="travellersValue single_room_result">{{$col['single_room']}}</span>
										                    <span class="travellersPlus single_room_inc">&#43;</span>
										                </div>
										                <p class="itemBottomHeading">Single (+12yrs)</p>
										            </div>

										            <!-- Add more rooms button -->
										            <div class="text-center">
										                <button type="button" id="add_certification" class="btn btn-info">
										                    <span class="fa fa-plus"></span> Add more rooms
										                </button>
										            </div>

										        </div>
										    </div>
										</div>
									@endif
									<?php
										$m++;
										$k++;
									?>
								@endforeach
							@else
							<div id="fourrow1">

							    <!-- Room 1 configuration -->
							    <div class="room-container">
							        <div class="label textUppercase">Room {{ $m }}</div>
							        <br>

							        <!-- Maximum guests allowed dropdown -->
							        <div class="makeflex align-center">
							            <div class="label">Maximum guest allowed <span class="requiredcolor">*</span></div>
							            <select class="form-control max_passenger" name="room[0][max_passenger]" style="max-width: 90px; border-radius: 3px;">
							                @for($i = 1; $i <= 10; $i++)
							                    <option value="{{ $i }}" @if($i==7) selected @endif>{{ $i }}</option>
							                @endfor
							            </select>
							        </div>

							        <!-- Guests selection for Room 1 -->
							        <div class="guest-room-wrapper">

							            <!-- Adult (Twin Sharing +12yrs) -->
							            <div>
							                <div class="addTravellerValue">
							                    <input type="hidden" id="travellers" name="room[0][twin_adult_room]" class="twin_adult_room_value" value="2" />
							                    <span class="travellersMinus twin_adult_room_dec">&#8722;</span>
							                    <span class="travellersValue twin_adult_room_result">2</span>
							                    <span class="travellersPlus twin_adult_room_inc">&#43;</span>
							                </div>
							                <p class="itemBottomHeading">Adult (Twin Sharing +12yrs)</p>
							            </div>

							            <!-- Extra Adult (+12yrs) -->
							            <div>
							                <div class="addTravellerValue">
							                    <input type="hidden" id="travellers" name="room[0][extra_adult_room]" class="extra_adult_room_value" value="0" />
							                    <span class="travellersMinus extra_adult_room_dec">&#8722;</span>
							                    <span class="travellersValue extra_adult_room_result">0</span>
							                    <span class="travellersPlus extra_adult_room_inc">&#43;</span>
							                </div>
							                <p class="itemBottomHeading">Extra Adult (+12yrs)</p>
							            </div>

							            <!-- Child (With Bed 2-12yrs) -->
							            <div>
							                <div class="addTravellerValue">
							                    <input type="hidden" id="travellers" name="room[0][child_with_bed_room]" class="child_with_bed_room_value" value="0" />
							                    <span class="travellersMinus child_with_bed_room_dec">&#8722;</span>
							                    <span class="travellersValue child_with_bed_room_result">0</span>
							                    <span class="travellersPlus child_with_bed_room_inc">&#43;</span>
							                </div>
							                <p class="itemBottomHeading">Child (With Bed 2-12yrs)</p>
							            </div>

							            <!-- Child (without bed 2-12yrs) -->
							            <div>
							                <div class="addTravellerValue">
							                    <input type="hidden" id="travellers" name="room[0][child_without_bed_room]" class="child_without_bed_room_value" value="0" />
							                    <span class="travellersMinus child_without_bed_room_dec">&#8722;</span>
							                    <span class="travellersValue child_without_bed_room_result">0</span>
							                    <span class="travellersPlus child_without_bed_room_inc">&#43;</span>
							                </div>
							                <p class="itemBottomHeading">Child (without bed 2-12yrs)</p>
							            </div>

							            <!-- Infant (0-2yrs) -->
							            <div>
							                <div class="addTravellerValue">
							                    <input type="hidden" id="travellers" name="room[0][infant_room]" class="span_value_child_with_bed infant_room_value" value="0">
							                    <span class="travellersMinus infant_room_dec">&#8722;</span>
							                    <span class="travellersValue infant_room_result">0</span>
							                    <span class="travellersPlus infant_room_inc">&#43;</span>
							                </div>
							                <p class="itemBottomHeading">Infant (0-2yrs)</p>
							            </div>

							            <!-- Single (+12yrs) -->
							            <div>
							                <div class="addTravellerValue">
							                    <input type="hidden" id="travellers" name="room[0][single_room]" class="single_room_value" value="0">
							                    <span class="travellersMinus single_room_dec">&#8722;</span>
							                    <span class="travellersValue single_room_result">0</span>
							                    <span class="travellersPlus single_room_inc">&#43;</span>
							                </div>
							                <p class="itemBottomHeading">Single (+12yrs)</p>
							            </div>

							            <!-- Add more rooms button -->
							            <div class="text-center">
							                <button id="add_certification" class="btn btn-info"><span class="fa fa-plus"></span> Add more rooms</button>
							            </div>
							        </div>
							    </div>
							</div>
							@endif
							</div>
							