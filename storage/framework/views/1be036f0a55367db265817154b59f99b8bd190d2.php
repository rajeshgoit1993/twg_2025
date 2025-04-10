 <!-- Room selection section -->
					        <div class="roomGuests">
					            <label for="roomnumber"><b>No of Rooms</b> <span class="requiredcolor">*</span></label>
					            <select class="form-control select_room" name="no_of_room">
					                <?php for($i = 1; $i <= 10; $i++): ?>
					                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
					                <?php endfor; ?>
					            </select>
					            
					            <!-- Default room description input (readonly) -->
					            <input type="text" class="quote1_pop_passenger_value" 
					                   value="1 Room (2 Adults)" 
					                   placeholder="" 
					                   readonly />
					        </div>
					        
					        <!-- Dynamic room and guest section -->
					        <div class="dynamic_four" id="dynamic_four">
					            <div id="fourrow1">
					                
					                <!-- Room 1 configuration -->
					                <div class="room-container">
					                    <div class="label textUppercase">Room 1</div>
					                    <br>
					                    
					                    <!-- Maximum guests allowed dropdown -->
					                    <div class="makeflex align-center">
					                        <div class="label">Maximum guest allowed <span class="requiredcolor">*</span></div>
					                        <select class="form-control max_passenger" 
					                                name="room[0][max_passenger]" 
					                                style="max-width: 90px; border-radius: 3px;">
					                            <?php for($i = 1; $i <= 10; $i++): ?>
					                                <option value="<?php echo e($i); ?>" <?php if($i == 7): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
					                            <?php endfor; ?>
					                        </select>
					                    </div>
					                    
					                    <!-- Guests selection for Room 1 -->
					                    <div class="guest-room-wrapper mobScroll scrollX">
					                        
					                        <!-- Adult (Twin Sharing +12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][twin_adult_room]" 
					                                       class="twin_adult_room_value" 
					                                       value="2" />
					                                <span class="travellersMinus twin_adult_room_dec">&#8722;</span>
					                                <span class="travellersValue twin_adult_room_result">2</span>
					                                <span class="travellersPlus twin_adult_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Adult<br>(+12yrs)</p>
					                        </div>
					                        
					                        <!-- Extra Adult (+12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][extra_adult_room]" 
					                                       class="extra_adult_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus extra_adult_room_dec">&#8722;</span>
					                                <span class="travellersValue extra_adult_room_result">0</span>
					                                <span class="travellersPlus extra_adult_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
					                        </div>
					                        
					                        <!-- Child (With Bed 2-12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][child_with_bed_room]" 
					                                       class="child_with_bed_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus child_with_bed_room_dec">&#8722;</span>
					                                <span class="travellersValue child_with_bed_room_result">0</span>
					                                <span class="travellersPlus child_with_bed_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
					                        </div>
					                        
					                        <!-- Child (without bed 2-12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][child_without_bed_room]" 
					                                       class="child_without_bed_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus child_without_bed_room_dec">&#8722;</span>
					                                <span class="travellersValue child_without_bed_room_result">0</span>
					                                <span class="travellersPlus child_without_bed_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
					                        </div>
					                        
					                        <!-- Infant (0-2yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][infant_room]" 
					                                       class="span_value_child_with_bed infant_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus infant_room_dec">&#8722;</span>
					                                <span class="travellersValue infant_room_result">0</span>
					                                <span class="travellersPlus infant_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
					                        </div>
					                        
					                        <!-- Single (+12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][single_room]" 
					                                       class="single_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus single_room_dec">&#8722;</span>
					                                <span class="travellersValue single_room_result">0</span>
					                                <span class="travellersPlus single_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Single<br>(+12yrs)</p>
					                        </div>
					                        
					                        <!-- Add more rooms button -->
					                        <div class="text-center">
					                            <button type="button" id="add_certification" class="btn btn-info">
					                                <span class="fa fa-plus"></span> Add more rooms
					                            </button>
					                        </div>
					                    </div> <!-- guest-room-wrapper end -->
					                </div> <!-- room-wrapper end -->
					                
					            </div> <!-- fourrow1 end -->
					        </div> <!-- dynamic_four end -->