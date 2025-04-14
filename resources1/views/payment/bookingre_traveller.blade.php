            <div>
                <input type="hidden" name="unique_code" id="unique_code" value="{{ $unique_code }}">
				<h3>Traveller Information</h3>
				<div class="travellerGuestDtls">
					<div class="appendRight30">
						<h5>{{ CustomHelpers::get_seperate_pass_payment_view($data->id, 1, 'na') }}</h5>
					</div>
					<div>
                        @php
                            $roomCount = CustomHelpers::get_seperate_pass_payment_view($data->id, 1, 'room');
                        @endphp

                        <h5>{{ $roomCount }}&nbsp;{{ $roomCount > 1 ? 'Rooms' : 'Room' }}</h5>

					</div>
				</div>
				<!-- Rooming Starts -->
                <?php
                    $rooms=unserialize($data->room);
                ?>
                @if($rooms!='')
                    <?php
                        $m=1;
                    ?>
                    @foreach($rooms as $row=>$col)
                        <?php 
                            $twin_adult_room=$col['twin_adult_room'];
                            $extra_adult_room=$col['extra_adult_room'];
                            $child_with_bed_room=$col['child_with_bed_room'];
                            $child_without_bed_room=$col['child_without_bed_room'];
                            $infant_room=$col['infant_room'];
                            $single_room=$col['single_room'];
                            $x=1;
                            $y=1;
                            $z=1;
                        ?>
                        <div>
                        <div class="roomCountCont">
                            <span class="roomCount">Room - {{ $m }}</span>
                            <span class="flexOne line"></span>
                        </div>
                        @if($twin_adult_room > 0)
                            @for($a = 0; $a < $twin_adult_room; $a++)
                                <?php $pass = 0; ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Adult - {{$x++}}</h4>
                                        <h5>(Twin Sharing +12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[{{$m}}][twin_adult][{{$a}}]" required>
                                            <option value="">select passenger</option>
                                            @if(count($room_passenger) > 0)
                                                @foreach($passengers as $passenger)
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="{{$passenger_id}}" 
                                                    @if(is_array($room_passenger)
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('twin_adult', $room_passenger[$m]) 
                                                        && array_key_exists($a, $room_passenger[$m]['twin_adult']) 
                                                        && $room_passenger[$m]['twin_adult'][$a] == $passenger_id) 
                                                        selected 
                                                    @endif>
                                                    {{$passenger->firstname}} {{$passenger->lastname}}
                                                    </option>
                                                    @if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('twin_adult', $room_passenger[$m]) 
                                                        && array_key_exists($a, $room_passenger[$m]['twin_adult']) 
                                                        && $room_passenger[$m]['twin_adult'][$a] == $passenger_id)
                                                        <?php $pass = 1; ?>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if($pass == 1)
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    @else
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        @endif

                        @if($extra_adult_room>0)
                            @for($b=0;$b<$extra_adult_room;$b++)
                                <?php
                                    $pass=0;
                                ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Adult - {{$x++}}</h4>
                                        <h5>(Extra +12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[{{$m}}][extra_adult][{{$b}}]" required>
                                            <option value="">select passenger</option>
                                            @if(count($room_passenger) > 0)
                                                @foreach($passengers as $passenger)
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="{{$passenger_id}}" 
                                                        @if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) 
                                                            && array_key_exists('extra_adult', $room_passenger[$m]) 
                                                            && array_key_exists($b, $room_passenger[$m]['extra_adult']) 
                                                            && $room_passenger[$m]['extra_adult'][$b] == $passenger_id) 
                                                            selected 
                                                        @endif>
                                                        {{$passenger->firstname}} {{$passenger->lastname}}
                                                    </option>
                                                    @if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('extra_adult', $room_passenger[$m]) 
                                                        && array_key_exists($b, $room_passenger[$m]['extra_adult']) 
                                                        && $room_passenger[$m]['extra_adult'][$b] == $passenger_id)
                                                        <?php $pass = 1; ?>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if($pass == 1)
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    @else
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        @endif

                        @if($single_room>0)
                            @for($c=0;$c<$single_room;$c++)
                                <?php
                                    $pass=0;
                                ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Adult - {{$x++}}</h4>
                                        <h5>(Single +12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[{{$m}}][single][{{$c}}]" required>
                                            <option value="">select passenger</option>
                                            @if(count($room_passenger) > 0)
                                                @foreach($passengers as $passenger)
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="{{$passenger_id}}" 
                                                        @if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) 
                                                            && array_key_exists('single', $room_passenger[$m]) 
                                                            && array_key_exists($c, $room_passenger[$m]['single']) 
                                                            && $room_passenger[$m]['single'][$c] == $passenger_id) 
                                                            selected 
                                                        @endif>
                                                        {{$passenger->firstname}} {{$passenger->lastname}}
                                                    </option>
                                                    @if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('single', $room_passenger[$m]) 
                                                        && array_key_exists($c, $room_passenger[$m]['single']) 
                                                        && $room_passenger[$m]['single'][$c] == $passenger_id)
                                                        <?php $pass = 1; ?>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    @if($pass == 1)
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    @else
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="adult">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        @endif

                        @if($child_with_bed_room > 0)
                            @for($e = 0; $e < $child_with_bed_room; $e++)
                                <?php $pass = 0; ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Child - {{$y++}}</h4>
                                        <h5>(With Bed 2-12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[{{$m}}][child_with_bed][{{$e}}]" required>
                                            <option value="">select passenger</option>
                                            @if(count($room_passenger) > 0)
                                                @foreach($passengers as $passenger)
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="{{$passenger_id}}" 
                                                        @if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) && array_key_exists('child_with_bed', $room_passenger[$m]) 
                                                            && array_key_exists($e, $room_passenger[$m]['child_with_bed']) 
                                                            && $room_passenger[$m]['child_with_bed'][$e] == $passenger_id) 
                                                            selected 
                                                        @endif>
                                                    {{$passenger->firstname}} {{$passenger->lastname}}
                                                    </option>
                                                    @if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('child_with_bed', $room_passenger[$m]) 
                                                        && array_key_exists($e, $room_passenger[$m]['child_with_bed']) 
                                                        && $room_passenger[$m]['child_with_bed'][$e] == $passenger_id)
                                                        <?php $pass = 1; ?>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    @if($pass == 1)
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="child">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    @else
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="child">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        @endif

                        @if($child_without_bed_room > 0)
                            @for($f = 0; $f < $child_without_bed_room; $f++)
                                <?php $pass = 0; ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Child - {{$y++}}</h4>
                                        <h5>(Without Bed 2-12yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[{{$m}}][child_without_bed][{{$f}}]" required>
                                            <option value="">select passenger</option>
                                            @if(count($room_passenger) > 0)
                                                @foreach($passengers as $passenger)
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="{{$passenger_id}}" 
                                                        @if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) 
                                                            && array_key_exists('child_without_bed', $room_passenger[$m]) 
                                                            && array_key_exists($f, $room_passenger[$m]['child_without_bed']) 
                                                            && $room_passenger[$m]['child_without_bed'][$f] == $passenger_id) 
                                                            selected 
                                                        @endif>
                                                        {{$passenger->firstname}} {{$passenger->lastname}}
                                                    </option>
                                                    @if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('child_without_bed', $room_passenger[$m]) 
                                                        && array_key_exists($f, $room_passenger[$m]['child_without_bed']) 
                                                        && $room_passenger[$m]['child_without_bed'][$f] == $passenger_id)
                                                        <?php $pass = 1; ?>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    @if($pass == 1)
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="child">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    @else
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="child">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        @endif

                        @if($infant_room > 0)
                            @for($g = 0; $g < $infant_room; $g++)
                                <?php $pass = 0; ?>
                                <div class="guestDtlsCont">
                                    <div class="guestCountBox">
                                        <h4>Infant - {{$z++}}</h4>
                                        <h5>(0-2yrs)</h5>
                                    </div>
                                    <div class="guestNameBox selectArrow down relativeCont">
                                        <select class="passenger_select" name="passenger[{{$m}}][infant][{{$g}}]" required>
                                            <option value="">select passenger</option>
                                            @if(count($room_passenger) > 0)
                                                @foreach($passengers as $passenger)
                                                    <?php
                                                        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
                                                    ?>
                                                    <option value="{{$passenger_id}}" 
                                                        @if(is_array($room_passenger) 
                                                            && array_key_exists($m, $room_passenger) 
                                                            && is_array($room_passenger[$m]) 
                                                            && array_key_exists('infant', $room_passenger[$m]) 
                                                            && array_key_exists($g, $room_passenger[$m]['infant']) 
                                                            && $room_passenger[$m]['infant'][$g] == $passenger_id) 
                                                            selected 
                                                        @endif>
                                                        {{$passenger->firstname}} {{$passenger->lastname}}
                                                    </option>
                                                    @if(is_array($room_passenger) 
                                                        && array_key_exists($m, $room_passenger) 
                                                        && is_array($room_passenger[$m]) 
                                                        && array_key_exists('infant', $room_passenger[$m]) 
                                                        && array_key_exists($g, $room_passenger[$m]['infant']) 
                                                        && $room_passenger[$m]['infant'][$g] == $passenger_id)
                                                        <?php $pass = 1; ?>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    @if($pass == 1)
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="infant">
                                            <span class="fa-user"></span><span class="appendLeft10">Edit</span>
                                        </div>
                                    @else
                                        <div class="addNewGuest addModal" id="{{uniqid()}}" type="infant">
                                            <span class="fa-user"></span><span class="appendLeft10">Add New</span>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        @endif
                        </div>
                        <?php
                            $m++;
                        ?>
                    @endforeach
                @endif
                <!-- Rooming Ends -->
			</div>

			<!-- Traveller contact information starts -->
			<div class="guestContactDtlsBox">
				<!--<h2>Contact Details</h2>
				<div class="flex-col-md-12">
					<div class="formGroup">
						<div class="font16 fontWeight600 blackText">Please enter details</div>
					</div>
				</div>-->
				<!--Email Id, Mobile No, City, State, Address, Spl Requests-->
				<div class="flex-row-multicolum appendTop10">
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_name">Leading Guest Name</label>
							<input type="text" id="guestcontact_name" name="name" placeholder="Enter full name as per id card" required
                            value="{{$lead_passenger_info->guest_name}}"
							/>
							<span class="error" id="guestcontact_name_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6"></div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_email">Email ID</label>
							<input type="text" id="guestcontact_email" name="guestcontact_email" placeholder="Enter Your Email Id" value="{{$lead_passenger->email}}" required />
							<span class="error" id="guestcontact_email_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
                        <div class="guestInputCont">
                            <label for="guestcontact_mobile">Mobile No</label>

                            <!-- <div class="selectArrow down relativeCont flexOne">
                                    <select name="year" class="byear" style="border-radius: 4px 0 0 4px;border-right: 0;display: inline-block;">
                                        <option selected disabled>YYYY</option>
                                        @for($i=date('Y');$i>=1923;$i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor;
                                    </select>
                                </div> -->
                            <div class="makeflex">
                                <!-- country code -->
                                <?php 
                                    $data = DB::table('countries')->get();
                                ?>
                                <div class="selectArrow down relativeCont" style="width: 35%;margin-right: 5px;">
                                <select name="country_code">
                                    <?php 
                                        foreach($data as $single):
                                            if($single->phonecode == $lead_passenger_info->country_code):
                                                echo "<option value='".$single->phonecode."' selected>".$single->name." (+".$single->phonecode.")</option>";
                                            else:
                                                echo "<option value='".$single->phonecode."'>".$single->name." (+".$single->phonecode.")</option>";
                                            endif;
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                                <!-- enter mobile no -->
                                <div class="flexOne">
                                <input type="text" name="guestcontact_mobile" id="guestcontact_mobile" placeholder="Enter Your Mobile No" maxlength="10" required value="{{$lead_passenger_info->mobile_no}}" />
                            </div>
                            </div>
                            <span class="error" id="guestcontact_mobile_error"></span>
                        </div>
                    </div>
                    <div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_city">City</label>
							<input type="text" id="guestcontact_city" name="guestcontact_city" placeholder="Enter Your City" required value="{{$lead_passenger_info->city}}" />
							<span class="error" id="guestcontact_city_error"></span>
						</div>
					</div>
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="guestcontact_state">State</label>
							<input type="text" name="guestcontact_state" id="guestcontact_state" placeholder="Enter Your State" required value="{{$lead_passenger_info->state}}" />
							<span class="error" id="guestcontact_state_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="guestcontact_address">Address</label>
							<input type="text" name="guestcontact_address" id="guestcontact_address" placeholder="Enter your address" value="{{$lead_passenger_info->address}}" required />
							<span class="error" id="guestcontact_address_error"></span>
						</div>
					</div>
					<div class="flex-col-md-12">
                        <div class="guestInputCont appendTop5">
                            <label for="guest_additionaletails">Special Request&nbsp;<span class="colorA1">(subject to availability)</span></label>
                            <?php
                                $special_request = CustomHelpers::get_run_time_passenger_details($quote_ref_no, 'special_request');
                            ?>
                            @if($special_request != '' && $special_request != 'N;')
                                <?php
                                    $special_request = unserialize($special_request);
                                ?>
                                <div class="addOnDtlsCont mobscroll">
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="earlycheckin" name="special_request[]" value="Early Check-in" @if(in_array('Early Check-in', $special_request)) checked @endif>
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Early Check-in</span>
                                    </label>
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="latecheckout" name="special_request[]" value="Late Checkout" @if(in_array('Late Checkout', $special_request)) checked @endif>
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Late Checkout</span>
                                    </label>
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="honeymoonfreebies" name="special_request[]" value="Honeymoon Freebies" @if(in_array('Honeymoon Freebies', $special_request)) checked @endif>
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Honeymoon Freebies</span>
                                    </label>
                                </div>
                            @else
                                <div class="addOnDtlsCont mobscroll">
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="earlycheckin" name="special_request[]" value="Early Check-in">
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Early Check-in</span>
                                    </label>
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="latecheckout" name="special_request[]" value="Late Checkout">
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Late Checkout</span>
                                    </label>
                                    <label class="checkmarkCont">
                                        <input type="checkbox" id="honeymoonfreebies" name="special_request[]" value="Honeymoon Freebies">
                                        <span class="checkmark addOn-services"></span>
                                        <span class="addOn-services-text">Honeymoon Freebies</span>
                                    </label>
                                </div>
                            @endif
                            <textarea class="formTextarea" type="text" id="guest_additionaletails" name="guest_additionaletails" placeholder="Enter additional requests (if any)">{{CustomHelpers::get_run_time_passenger_details($quote_ref_no, 'guest_additionaletails')}}</textarea>
                        </div>
                    </div>
				</div>
			</div>
			<!-- Traveller contact information ends -->

			<!-- Business Traveller GST information starts -->
            <div class="guestGSTDtlsBox">
    			<div class="reviewFoldable selectArrowHeader down relativeCont">
    				<div class="flex-col-md-12">
    					<div class="guestDtlsHeader">
    						<h2>Enter GST details (optional)</h2>
    					</div>
                    </div>
                </div>
    			<!--GSTIN Details-->
                <div class="mfoldableContent d-none">
    				<div class="flex-row-multicolum">
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_no">GSTIN</label>
    							<input type="text" id="guestGST_no" name="guestGST_no" placeholder="Enter GST Number" maxlength="12" oninput="this.value = this.value.toUpperCase()" @if($passengers_infos!='') value="{{$passengers_infos->guestGST_no}}"  @endif  />
    							<span class="error" id="guestGST_no_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_name">GST Name</label>
    							<input type="text" name="guestGST_name" id="guestGST_name" placeholder="Enter GST Name" oninput="this.value = capitalizeWords(this.value)" @if($passengers_infos!='') value="{{$passengers_infos->guestGST_name}}"  @endif />
    							<span class="error" id="guestGST_name_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_email">GST Email ID</label>
    							<input type="text" id="guestGST_email" name="guestGST_email" placeholder="Enter GST Email" oninput="this.value = this.value.toLowerCase()" @if($passengers_infos!='') value="{{$passengers_infos->guestGST_email}}"  @endif />
    							<span class="error" id="guestGST_email_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_mobile">GST Mobile</label>
    							<input type="text" name="guestGST_mobile" id="guestGST_mobile" placeholder="Enter GST Mobile No" maxlength="10" @if($passengers_infos!='') value="{{$passengers_infos->guestGST_mobile}}"  @endif />
    							<span class="error" id="guestGST_mobile_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6">
    						<div class="guestInputCont">
    							<label for="guestGST_state">GST State</label>
    							<input type="text" name="guestGST_state" id="guestGST_state" placeholder="Enter GST State" @if($passengers_infos!='') value="{{$passengers_infos->guestGST_state}}"  @endif />
    							<span class="error" id="guestGST_state_error"></span>
    						</div>
    					</div>
    					<div class="flex-col-md-6"></div>
    					<div class="flex-col-md-12">
    						<div class="guestInputCont">
    							<label for="guestGST_address">GST Address</label>
    							<input type="text" name="guestGST_address" id="guestGST_address" placeholder="Enter GST address" @if($passengers_infos!='') value="{{$passengers_infos->guestGST_address}}"  @endif/>
    							<span class="error" id="guestGST_address_error"></span>
    						</div>
    					</div>
    				</div>
                </div>
			</div>
            <!--Business Traveller GST information ends-->