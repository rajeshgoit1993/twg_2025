<div class="row">
  <div class="col-md-12 form-group">

                              <!-- listed hotel -->
                              <label for="listed_hotel" class="select-hotel-type">
                                <input type="radio" id="listed_hotel" name="acc_type" checked class="extra_acc" @if($packagesData->acc_type=="normal_acc") checked @endif value="normal_acc">Add Listed Hotel
                              </label>

                              <!-- unlisted hotel -->
                              <label class="select-hotel-type">
                                <input type="radio" name="acc_type" class="extra_acc" class="extra_acc" value="extra_acc" @if($packagesData->acc_type=="extra_acc") checked @endif>Add Unlisted Hotel
                              </label>

                              <!-- hide hotel -->
                              <label class="select-hotel-type">
                                <input type="radio" name="acc_type" class="extra_acc" class="extra_acc" value="hide_acc" @if($packagesData->acc_type=="hide_acc") checked @endif>Hide Hotel&nbsp;<i>(Not visible on the frontend)</i>
                              </label>
                            </div>

                            <!-- content -->
                            <?php
                              $option2_accommodation = unserialize($packagesData->accommodation);
                              if (is_bool($option2_accommodation)) :
                                $option2_accommodation_count = "1";
                              else :
                                $option2_accommodation_count = count($option2_accommodation);
                              endif;
                            ?>
                            <div class="col-md-12">

                              <!-- listed accommodation content -->
                              <div class="accommodation_main" @if($packagesData->acc_type=="normal_acc") style="display: block;" @else style="display: none;" @endif >
                                <?php
                                  $days = $packagesData->duration;
                                  $days = (int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);
                                  $j=0;
                                ?>
                                <div class="dynamic_acc">
                                  <input type="hidden" name="" value="{{$days}}">
                                  @if($packagesData->accommodation!='')
                                  @foreach(unserialize($packagesData->accommodation) as $row=>$col)
                                    @if($j>0)
                                    <hr>
                                    @endif
                                  <div class="item-container field{{ $j }}" id="{{ $j }}">
                                    <div class="row">

                                     
                                      <div class="col-md-6 appendBottom10">
                                        <label class="field-required">Select Duration</label>

                                        <!-- "Select all" checkbox -->
                                        <label class="label-duration">
                                            Select all
                                            <input type="checkbox" class="select_complete_duration"
                                                @if(!empty($col['night']) && count($col['night']) === $days) checked @endif>
                                        </label>

                                        <!-- Multi-select dropdown -->
                                        <select class="form-control select_day select2" name="accommodation[{{ $j }}][night][]" multiple>
                                            @for($i = 1; $i <= $days; $i++)
                                                @php
                                                    $nightLabel = "Night $i";
                                                @endphp
                                                <option value="{{ $nightLabel }}" 
                                                    @if(!empty($col['night']) && in_array($nightLabel, $col['night'])) selected @endif>
                                                    {{ $nightLabel }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- city -->
                                      <div class="col-md-3 appendBottom10 quote_city_class">
                                        <label class="field-required">City</label>
                                        <select class="quote_city form-control" name="accommodation[{{$j}}][city]" >
                                          <option @if(array_key_exists("city",$col)) value="{{$col['city']}}" @endif>@if(array_key_exists("city",$col)) {{CustomHelpers::get_master_table_data('city', 'id', (int)$col['city'], 'name')}} @endif</option>
                                        </select>
                                      </div>

                                      <!-- hotel type -->
                                      <div class="col-md-3 propertytype_class">
                                        <div class="form-group">
                                          <label class="field-required">Hotel Type</label>
                                          <!-- <select class="form-control propertytype" name="accommodation[{{$j}}][propertytype]" id="propertytype">
                                            <option selected disabled>Select</option>
                                            <option value="hotel" @if(array_key_exists('propertytype',$col) && $col['propertytype']=='hotel') selected @endif>Hotel</option>
                                            <option value="resort" @if(array_key_exists('propertytype',$col) && $col['propertytype']=='resort') selected @endif>Resort</option>
                                            <option value="villa" @if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='villa') selected @endif>Villa</option>
                                            <option value="home" @if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='home') selected @endif>Home</option>
                                            <option value="camp" @if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='camp') selected @endif>Camp</option>
                                            <option value="cruise" @if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='cruise') selected @endif>Cruise</option>
                                          </select> -->
                                          <select class="form-control propertytype" name="accommodation[{{$j}}][propertytype]" id="propertytype">
                                            <option selected disabled>Select</option>
                                            @php
                                                $propertyTypes = ['hotel', 'resort', 'villa', 'home', 'camp', 'cruise'];
                                                $selectedType = $col['propertytype'] ?? '';
                                            @endphp
                                            @foreach($propertyTypes as $type)
                                              <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                              </option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <!-- hotel source -->
                                      <div class="col-md-4 appendBottom10 propertysource_class">
                                        <label class="field-required">Hotel Source</label>
                                        <!-- <select class="form-control propertysource" name="accommodation[{{$j}}][trip]" id="propertysource">
                                          <option selected disabled>Select</option>
                                          <option value="packagehoteldatabase" @if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase') selected @endif>Package Hotel Database</option>
                                          <option value="hoteldatabase" @if(array_key_exists('trip',$col) && $col['trip']=='hoteldatabase') selected @endif>Hotel Database</option>
                                          <option value="tripadvisor" @if(array_key_exists('trip',$col) && $col['trip']=='tripadvisor') selected @endif>TripAdvisor</option>
                                          <option value="manual" @if(array_key_exists('trip',$col) && $col['trip']=='manual') selected @endif>Manual</option>
                                        </select> -->
                                        <select class="form-control propertysource" name="accommodation[{{$j}}][trip]" id="propertysource">
                                          <option selected disabled>Select</option>
                                          @php
                                            $tripSources = [
                                              'packagehoteldatabase' => 'Package Hotel Database',
                                              'hoteldatabase' => 'Hotel Database',
                                              'tripadvisor' => 'TripAdvisor',
                                              'manual' => 'Manual'
                                            ];
                                            $selectedTrip = $col['trip'] ?? '';
                                          @endphp
                                          @foreach($tripSources as $value => $label)
                                            <option value="{{ $value }}" {{ $selectedTrip === $value ? 'selected' : '' }}>
                                              {{ $label }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>

                                      <!-- select hotel name -->
                                      <!-- <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" @if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase') style="display: block" @else style="display: none" @endif>
                                        <label class="field-required">Hotel Name</label>
                                        @if(array_key_exists('city',$col) && array_key_exists('propertytype',$col))
                                        <?php $quote_hotel_data=CustomHelpers::get_quotation_hotel_new($col['city'],$col['propertytype']); ?>
                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[{{$j}}][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                          @foreach($quote_hotel_data as $single)
                                          <option value="{{$single->id}}" @if(array_key_exists('hotel',$col) && $col['hotel']==$single->id) selected @endif>{{$single->hotelname}}</option>
                                          @endforeach
                                          </select>
                                          @else
                                          <select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                        </select>
                                        @endif
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" 
                                       style="display: {{ (array_key_exists('trip', $col) && $col['trip'] == 'packagehoteldatabase') ? 'block' : 'none' }};">
                                        <label class="field-required">Hotel Name</label>
                                        
                                        @php
                                          $quote_hotel_data = [];
                                          if(array_key_exists('city', $col) && array_key_exists('propertytype', $col)) {
                                            $quote_hotel_data = CustomHelpers::get_quotation_hotel_new($col['city'], $col['propertytype']);
                                          }
                                          $selectedHotel = $col['hotel'] ?? '';
                                        @endphp

                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[{{$j}}][hotel]">
                                          <option value="0" selected disabled>Select</option>
                                            @foreach($quote_hotel_data as $single)
                                              <option value="{{ $single->id }}" {{ $selectedHotel == $single->id ? 'selected' : '' }}>
                                                {{ $single->hotelname }}
                                              </option>
                                            @endforeach
                                        </select>
                                      </div>



<div class="col-md-4 form-group similar_more" style="display: {{ (array_key_exists('trip', $col) && $col['trip'] == 'packagehoteldatabase') ? 'block' : 'none' }};">
                                          <label >Similar/More</label>
                                          <select class="form-control text-capitalize " name="accommodation[0][similar_more]">
                                            <option value='0' selected='true' disabled='disabled'>Select</option>
                                            <option value="Similar Hotels"

                                            {{ (array_key_exists('similar_more', $col) && $col['similar_more'] == 'Similar Hotels') ? 'selected' : '' }}
                                            >Similar Hotels</option>
                                            <option value="More Options"  {{ (array_key_exists('similar_more', $col) && $col['similar_more'] == 'More Options') ? 'selected' : '' }}>More Options</option>
                                            <!--<option value="other">Unlisted Property</option>-->
                                          </select>
                                        </div>

                                      <!-- select hotel star rating -->
                                      <!-- <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" @if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase') style="display: block" @else style="display: none" @endif>
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[{{$j}}][star]">
                                          <option selected disabled>Select</option>
                                          <option value="1" @if(array_key_exists('star',$col) && $col['star']==1) selected @endif>1 star</option>
                                          <option value="2" @if(array_key_exists('star',$col) && $col['star']==2) selected @endif>2 star</option>
                                          <option value="3" @if(array_key_exists('star',$col) &&  $col['star']==3) selected @endif>3 star</option>
                                          <option value="4" @if(array_key_exists('star',$col) &&  $col['star']==4) selected @endif>4 star</option>
                                          <option value="5" @if(array_key_exists('star',$col) &&  $col['star']==5) selected @endif>5 star</option>
                                        </select>
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" style="display: {{ (array_key_exists('trip', $col) && $col['trip'] == 'packagehoteldatabase') ? 'block' : 'none' }};">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[{{$j}}][star]">
                                          <option selected disabled>Select</option>
                                          @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ (array_key_exists('star', $col) && $col['star'] == $i) ? 'selected' : '' }}>
                                              {{ $i }} star
                                            </option>
                                          @endfor
                                        </select>
                                      </div>


                                      <!-- enter hotel name -->
                                      <!-- <div class="col-md-4 appendBottom10 propertyname" id="propertyname" @if(array_key_exists('trip',$col) && $col['trip']=='manual') style="display: block" @else style="display: none" @endif>
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[{{$j}}][other_hotel]" placeholder="Enter property name" value="{{$col['other_hotel']}}">
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 propertyname" id="propertyname" style="display: {{ (array_key_exists('trip', $col) && $col['trip'] == 'manual') ? 'block' : 'none' }};">
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[{{$j}}][other_hotel]" placeholder="Enter property name" value="{{ $col['other_hotel'] ?? '' }}">
                                      </div>


                                      <!-- select hotel star rating -->
                                      <!-- <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" @if(array_key_exists('trip',$col) && $col['trip']=='manual') style="display: block" @else style="display: none" @endif>
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control" name="accommodation[{{$j}}][star_other]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='1' @if(array_key_exists('star_other',$col) && $col['star_other']==1) selected @endif>1 star</option>
                                          <option value='2' @if(array_key_exists('star_other',$col) && $col['star_other']==2) selected @endif>2 star</option>
                                          <option value='3' @if(array_key_exists('star_other',$col) && $col['star_other']==3) selected @endif>3 star</option>
                                          <option value='4' @if(array_key_exists('star_other',$col) && $col['star_other']==4) selected @endif>4 star</option>
                                          <option value='5' @if(array_key_exists('star_other',$col) && $col['star_other']==5) selected @endif>5 star</option>
                                        </select>
                                      </div> -->

                                      <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" style="display: {{ (array_key_exists('trip', $col) && $col['trip'] == 'manual') ? 'block' : 'none' }};">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control" name="accommodation[{{$j}}][star_other]">
                                            <option selected disabled>Select</option>
                                            @for($i = 1; $i <= 5; $i++)
                                              <option value="{{ $i }}" {{ (array_key_exists('star_other', $col) && $col['star_other'] == $i) ? 'selected' : '' }}>
                                                {{ $i }} star
                                              </option>
                                            @endfor
                                          </select>
                                        </div>

                                      <div class="col-md-12"></div>

                                      <!-- room type -->
                                      <div class="col-md-4 appendBottom10">
                                        <label class="field-required">Room Type</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[{{$j}}][category]" placeholder="Enter room type" value="{{$col['category']}}">
                                      </div>

                                      <!-- hotel website -->
                                      <div class="col-md-4 appendBottom10 hotel_link_class">
                                        <label>Hotel Website</label>
                                        <input type="text" class="form-control text-lowercase hotel_link" name="accommodation[{{$j}}][hotel_link]" placeholder="Enter hotel website" 
@if(array_key_exists('hotel_link',$col))
value="{{$col['hotel_link']}}"
@endif
                                        

                                        >
                                      </div>

                                      <!-- hotel contact no -->
                                      <div class="col-md-4 appendBottom10 hotel_contact_class">
                                        <label>Hotel Contact No</label>
                                        <input type="text" class="form-control text-capitalize hotel_contact" name="accommodation[{{$j}}][contact]" placeholder="Enter hotel contact no" 
                                        @if(array_key_exists('contact',$col))
                                       value="{{$col['contact']}}"
                                          @endif
                                          >
                                      </div>

                                      <!-- meals -->
                                      <!-- <div class="col-md-4 appendBottom10">
                                        <label>Meals</label>
                                        <select class="form-control accommodationMeals" name="accommodation[{{$j}}][meals]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Room Only' @if(array_key_exists('meals',$col) && $col['meals']=='Room Only') selected @endif>Room Only</option>
                                          <option value='Breakfast' @if(array_key_exists('meals',$col) && $col['meals']=='Breakfast') selected @endif>Breakfast</option>
                                          <option value='Half Board' @if(array_key_exists('meals',$col) && $col['meals']=='Half Board') selected @endif>Half Board</option>
                                          <option value='Full Board' @if(array_key_exists('meals',$col) && $col['meals']=='Full Board') selected @endif>Full Board</option>
                                        </select>
                                      </div> -->

                                      <div class="col-md-4 appendBottom10">
                                        <label>Meals</label>
                                        <select class="form-control accommodationMeals" name="accommodation[{{$j}}][meals]">
                                          <option selected disabled>Select</option>
                                          @foreach(['Room Only', 'Breakfast', 'Half Board', 'Full Board'] as $meal)
                                            <option value="{{ $meal }}" {{ (array_key_exists('meals', $col) && $col['meals'] == $meal) ? 'selected' : '' }}>
                                              {{ $meal }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>


                                      <!-- hotel price type -->
                                      @if($j>0)
                                      <div class="col-md-4 appendBottom10" >
                                        <label>Hotel Price Type</label>
                                        <!-- <select class="form-control accommodationFareType" name="accommodation[{{$j}}][faretype]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Refundable' @if(array_key_exists('faretype',$col) && $col['faretype']=='Refundable') selected @endif>Refundable</option>
                                          <option value='Non-refundable' @if(array_key_exists('faretype',$col) &&  $col['faretype']=='Non-refundable') selected @endif>Non-refundable</option>
                                        </select> -->
                                        <select class="form-control accommodationFareType" name="accommodation[{{$j}}][faretype]">
                                          <option selected disabled>Select</option>
                                          @foreach(['Refundable', 'Non-refundable'] as $fareType)
                                              <option value="{{ $fareType }}" {{ (array_key_exists('faretype', $col) && $col['faretype'] == $fareType) ? 'selected' : '' }}>
                                                {{ $fareType }}
                                              </option>
                                          @endforeach
                                        </select>
                                      </div>

                                      <div class="col-md-4 appendTop20">
                                        <button type="button" name="add" id="{{ $j }}" class="remove_acco btn btn-danger">Remove</button>
                                      </div>

                                      @else
                                      <div class="col-md-4 appendBottom10" >
                                        <label>Hotel Price Type</label>
                                       <!--  <select class="form-control accommodationFareType" name="accommodation[{{$j}}][faretype]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Refundable' @if(array_key_exists('faretype',$col) && $col['faretype']=='Refundable') selected @endif>Refundable</option>
                                          <option value='Non-refundable' @if(array_key_exists('faretype',$col) && $col['faretype']=='Non-refundable') selected @endif>Non-refundable</option>
                                        </select> -->
                                        <select class="form-control accommodationFareType" name="accommodation[{{$j}}][faretype]">
                                          <option selected disabled>Select</option>
                                          @foreach(['Refundable', 'Non-refundable'] as $fareType)
                                            <option value="{{ $fareType }}" {{ (!empty($col['faretype']) && $col['faretype'] == $fareType) ? 'selected' : '' }}>
                                              {{ $fareType }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>

                                      <div class="col-md-4"></div>
                                      @endif
                                    </div>
                                  </div>
                                  <?php $j++; ?>
                                  @endforeach

                                  @else
                                  <div class="item-container field0" id="0">
                                    <div class="row">

                                      <!-- select nights -->
                                      <div class="col-md-6 form-group daysel">
                                        <label class="field-required">Select Duration</label>
                                        <label class="label-duration">Select all<input type="checkbox" class="all_days"></label>
                                        <select class="form-control select_day select2" multiple name="accommodation[0][night][]">
                                          @for($i=1; $i<=$days; $i++)
                                            <option value="Night {{$i}}">Night {{$i}}</option>
                                          @endfor
                                        </select>
                                      </div>

                                      <!-- city -->
                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="field-required">City</label>
                                            <select class="quote_city form-control" name="accommodation[0][city]"></select>
                                            <!-- <input type="text" name="accommodation[0][city]" class="form-control query_city" placeholder="City"> -->
                                        </div>
                                      </div>

                                      <!-- hotel type -->
                                      <div class="col-md-3 propertytype_class">
                                        <div class="form-group">
                                          <label class="field-required">Hotel Type</label>
                                          <select class="form-control propertytype" name="accommodation[0][propertytype]" id="propertytype">
                                            <option selected disabled>Select</option>
                                            <option value="hotel">Hotel</option>
                                            <option value="resort">Resort</option>
                                            <option value="villa">Villa</option>
                                            <option value="home">Home</option>
                                            <option value="camp">Camp</option>
                                            <option value="cruise">Cruise</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-12"></div>

                                      <!-- hotel source -->
                                      <div class="col-md-4 appendBottom10 propertysource_class">
                                        <label class="field-required">Hotel Source</label>
                                        <select class="form-control propertysource" name="accommodation[0][trip]" id="propertysource">
                                          <option selected disabled>Select</option>
                                          <option value="packagehoteldatabase">Package Hotel Database</option>
                                          <option value="hoteldatabase">Hotel Database</option>
                                          <option value="tripadvisor">TripAdvisor</option>
                                          <option value="manual">Manual</option>
                                        </select>
                                      </div>

                                      <!-- select hotel name -->
                                      <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" style="display: none">
                                        <label class="field-required">Hotel Name</label>
                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                          <!--<option value="other">Unlisted Property</option>-->
                                        </select>
                                      </div>
<div class="col-md-4 form-group similar_more" style="display: none">
                                          <label >Similar/More</label>
                                          <select class="form-control text-capitalize " name="accommodation[0][similar_more]">
                                            <option value='0' selected='true' disabled='disabled'>Select</option>
                                            <option value="Similar Hotels">Similar Hotels</option>
                                            <option value="More Options">More Options</option>
                                            <!--<option value="other">Unlisted Property</option>-->
                                          </select>
                                        </div>
                                      <!-- select hotel star rating -->
                                      <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" style="display: none">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[0][star]">
                                          <option selected disabled>Select</option>
                                          <option value="1">1 star</option>
                                          <option value="2">2 star</option>
                                          <option value="3">3 star</option>
                                          <option value="4">4 star</option>
                                          <option value="5">5 star</option>
                                        </select>
                                      </div>

                                      <!-- enter hotel name -->
                                      <div class="col-md-4 appendBottom10 propertyname" id="propertyname" style="display: none">
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[0][other_hotel]" placeholder="Enter property name">
                                      </div>

                                      <!-- select hotel star rating -->
                                      <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" style="display: none;">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <!--<input type="text" class="form-control" name="accommodation[0][star_other]" placeholder="Enter hotel star rating">-->
                                        <select class="form-control" name="accommodation[0][star_other]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='1'>1 star</option>
                                          <option value='2'>2 star</option>
                                          <option value='3'>3 star</option>
                                          <option value='4'>4 star</option>
                                          <option value='5'>5 star</option>
                                        </select>
                                      </div>

                                      <div class="col-md-12"></div>

                                      <!-- room type -->
                                      <div class="col-md-4 appendBottom10">
                                        <label class="field-required">Room Type</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[0][category]" placeholder="Enter room type">
                                      </div>

                                      <!-- hotel website -->
                                      <div class="col-md-4 appendBottom10 hotel_link_class">
                                        <label>Hotel Website</label>
                                        <input type="text" class="form-control text-lowercase hotel_link" name="accommodation[0][hotel_link]" placeholder="Enter hotel website">
                                      </div>

                                      <!-- hotel contact no -->
                                      <div class="col-md-4 appendBottom10 hotel_contact_class">
                                        <label>Hotel Contact No</label>
                                        <input type="text" class="form-control text-capitalize hotel_contact" placeholder="Enter hotel contact no" name="accommodation[0][contact]">
                                      </div>

                                      <!-- meals -->
                                      <div class="col-md-4 appendBottom10">
                                        <div class="form-group">
                                          <label>Meals</label>
                                          <select class="form-control accommodationMeals" name="accommodation[0][meals]" id="">
                                            <option selected disabled>Select</option>
                                            <option value='Room Only'>Room Only</option>
                                            <option value='Breakfast'>Breakfast</option>
                                            <option value='Half Board'>Half Board</option>
                                            <option value='Full Board'>Full Board</option>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- hotel price type -->
                                      <div class="col-md-4 appendBottom10">
                                        <div class="form-group">
                                          <label>Hotel Price Type</label>
                                          <select class="form-control accommodationFareType" name="accommodation[0][faretype]" id="">
                                            <option selected disabled>Select</option>
                                            <option value='Refundable'>Refundable</option>
                                            <option value='Non-refundable'>Non-refundable</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-4"></div>

                                    </div>
                                  </div>
                                  @endif
                                </div>

                                <!-- add more hotel -->
                                <div class="row">
                                  <div class="col-md-12">
                                    <!-- <button type="button" name="add" id="add_acco_tours" days="{{ $days }}" class="btn btn-success">Add More</button> -->
                                    <button type="button" name="add" id="add_acco" days="{{ $days }}" class="btn btn-success">(+) Add more hotel</button>
                                  </div>
                                </div>

                              </div>

                              <!-- unlisted accommodation content -->
                              <div class="accommodation_extra item-container" @if($packagesData->acc_type=="extra_acc") style="display: block;" @else style="display: none;" @endif >
                                <label class="field-required">Unlisted Hotel details</label>
                                <textarea class="form-control ckeditor" rows="3" name="accommodation_extra">{!! $packagesData->accommodation_extra !!}</textarea>
                              </div>

                            </div>
</div>

