<div class="item-container">
                          <div class="row">

                            <!-- tour duration -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="duration">Tour Duration <span class="requiredcolor">&#42;</span></label>
                                <select name="duration" id="package_durations" class="form-control val">
                                  @for ($i = 1; $i <= 30; $i++)
                                    <option value="{{ $i }}" 
                                    {{ isset($packagesData->duration) && $i == $packagesData->duration ? 'selected' : '' }}>
                                    {{ $i }} Night / {{ $i + 1 }} Days
                                  </option>
                                  @endfor
                                </select>
                              </div>
                            </div>

                            <!-- tour title -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_name" class="field-required">Tour Title</label>
                                <input type="text" placeholder="Enter tour name" value="{{$packagesData->title}}" name="package_name" class="form-control package_name">
                                <span class="package_availibility"> </span>
                              </div>
                            </div>

                           <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="package_code" class="field-required">Package Code</label>
                                      <input type="text" placeholder="Package Code" value="{{$packagesData->package_code}}" name="package_code" class="form-control package_code"    @if($action_type=='quote' || $action_type=='quote_edit') readonly @else required @endif>
                                      <span class="package_code_availibility"> </span>
                                    </div>
                                  </div>

                            <!-- departure city -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Departure City</label>
                                <select class="quote_city form-control" name="sourcecity">
                                <option value="{{$packagesData->sourcecity }}" selected>
                                  {{CustomHelpers::get_master_table_data('city', 'id', (int)$packagesData->sourcecity, 'name')  }}

                                 
                                </option>
                                </select>
                              </div>
                            </div>

                            <!-- tour type -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Type</label>
                                <select class="form-control" name="tour_type">
                                  <option value="">Select tour type</option>
                                  @foreach($tourtypes as $tourtype)
                                    <option value="{{ $tourtype->id }}" 
                                      {{ isset($packagesData->tour_type) && $packagesData->tour_type == $tourtype->id ? 'selected' : '' }}>
                                      {{ $tourtype->tour_type }}
                                    </option>
                                  @endforeach
                                </select>

                              </div>
                            </div>

                            <!-- tour category -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Category</label>
                                <select class="form-control" name="tour_category">
                                  <option value="">Select Tour Category</option>
                                  @foreach($tourcategories as $tourcategory)
                                    <option value="{{ $tourcategory->id }}" 
                                      {{ (isset($packagesData->tour_category) && $packagesData->tour_category == $tourcategory->id) || old('tour_category') == $tourcategory->id ? 'selected' : '' }}>
                                      {{ $tourcategory->tour_category }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <!-- tour star rating -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Star Rating <i>(use to display hotel rating on frontend)</i></label>
                                <select class="form-control" name="select_star_rating">
                                  <option value="">Select Star</option>
                                  @foreach ([5, 4, 3, 2, 1] as $star)
                                    <option value="{{ $star }} Star" 
                                    {{ old('select_star_rating', $packagesData->select_star_rating ?? '') == "$star Star" ? 'selected' : '' }}>
                                    {{ $star }} Star
                                  </option>
                                  @endforeach
                                </select>
                              </div>

                            </div>

                            <!-- services included -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_location" class="field-required">Tour Services Included</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    @if(count($icons) > 0)
                                      @php
                                        // Ensure package_service is an array
                                        $selectedServices = is_array($packagesData->package_service) 
                                        ? $packagesData->package_service 
                                        : explode(',', $packagesData->package_service);
                                      @endphp
                                      @foreach($icons as $icon)
                                        <option value="{{ $icon->icon_title }}" 
                                          {{ in_array($icon->icon_title, old('package_service', $selectedServices) ?? []) ? 'selected' : '' }}>
                                          {{ $icon->icon_title }}
                                        </option>
                                      @endforeach
                                    @else
                                      <option value="">No Result Found</option>
                                    @endif
                                  </select>
                                </div>
                              </div>
                            </div>

                            <!-- suitable for -->
                           @if($action_type == 'quote' || $action_type == 'quote_edit')
                           <div class="col-md-12">
                           
                       <label for="admin_remarks">Trip Remarks</label>
                  <input type="text" class="form-control" value="{{$packagesData->admin_remarks}}" name="admin_remarks" id="admin_remarks" placeholder="Enter Remarks (if any)..." />
                                    
                                    
                           </div>

                          <div class="col-md-12">
                  <label for="tour_date">Travel Date</label>
                  <input type="date" name="tour_date" value="{{$packagesData->tour_date}}" id="tour_date" class="form-control tour_date" value="" placeholder="Tour Date" />
                </div>

                           @else
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_suitables">Suitable For</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_suitables[]" id="package_suitables" class="form-control select2" multiple    >
                                    @if(count($suitables)>0)
                                          @foreach($suitables as $suit)
                                            <option value="{{$suit->icon_title}}" @if(is_array($packagesData->package_suitables) && in_array($suit->icon_title,$packagesData->package_suitables )) selected @endif>{{$suit->icon_title}} </option>
                                          @endforeach
                                          @else
                                            <option value="No Result Found">No Result Found</option>
                                          @endif
                                  </select>
                                </div>
                              </div>

                            </div>

                            <!-- general tag -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_tags">General Tags</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_tags[]" id="package_tags" class="form-control select2" multiple>
                                    @if(count($generals) > 0)
                                     

                                      @foreach($generals as $general)
                                        <option value="{{ $general->icon_title }}"
                                        @if(is_array($packagesData->package_tags) && in_array($general->icon_title,$packagesData->package_tags )) selected @endif>
                                        {{ $general->icon_title }}
                                        </option>
                                      @endforeach
                                      @else
                                      <option value="">No Result Found</option>
                                    @endif
                                  </select>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="clearfix"></div> -->

                            <!-- theme -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_category">Theme</label>
                                <select name="package_category[]" id="package_category" class="select2 form-control" multiple>
                                  @php
                                    // Convert package_category to an array if it is a string
                                    $selectedCategories = is_array($packagesData->package_category) 
                                      ? $packagesData->package_category 
                                      : explode(',', $packagesData->package_category);
                                  @endphp
                                  
                                  @foreach($types as $typ)
                                    <option value="{{ $typ->name }}" 
                                      {{ in_array($typ->name, old('package_category', $selectedCategories) ?? []) ? 'selected' : '' }}>
                                      {{ $typ->name }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <!-- holiday type -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="package_holiday">Holiday Type</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                 

                                  <select name="package_holiday[]" id="package_holiday" class="form-control select2" multiple>
                                   
                                    @if(count($holidays) > 0)
                                      @foreach($holidays as $holiday)
                                        <option value="{{ $holiday->icon_title }}" 
                                          @if(is_array($packagesData->package_holiday) && in_array($holiday->icon_title,$packagesData->package_holiday )) selected @endif >
                                            {{ $holiday->icon_title }}
                                          </option>
                                      @endforeach
                                    @else
                                      <option value="">No Result Found</option>
                                    @endif
                                  </select>
                                </div>
                              </div>
                            </div>

                            @endif
                          </div>

                          <!-- city wise duration -->
                                                  
                          <label for="">Duration By City</label>

                          <div class="col-md-12">
                            <div class="row" id="dynamic_field_package">
                              <?php 
                               $a = 0; 

                              ?>
                              @foreach($packagesData->continent ?? [] as $row => $col)
                            <?php
              $days_duration = $packagesData->duration ?? ''; 
                             
  if (isset($packagesData->continent[$row])) {
    $countries = DB::table('countries')->where('continent_id', $packagesData->continent[$row])->get();
  }
  else
  {
    $countries = DB::table('countries')->all();
  }

$states = DB::table('states')->where('country_id', $packagesData->country[$row])->get();
$cities = DB::table('city')->where('state_id', $packagesData->state[$row])->get();
           
 $days = $packagesData->days[$row] ?? '';          

                            ?>
                              <div class="item-container remove dfp dfp-1">

                                      <!-- continent -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="continent">Continent</label>
                                          <select name="continent[{{$a}}]" id="package_continent" class="form-control package_continent">
                                           <option value="">--Select Continent--</option>

                                           @foreach($continents as $cont)
    <option value="{{ $cont->id }}" 
        @if(isset($packagesData->continent[$row]) && $packagesData->continent[$row] == $cont->id) 
            selected 
        @endif>
        {{ $cont->continent_name }}
    </option>
@endforeach
                                          </select>
                                        </div>
                                      </div>

                                      <!-- country -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="country" class="field-required">Country</label>
                                          <select name="country[{{$a}}]" id="package_dest_countries{{$a}}" class="form-control package_dest_country" >
                                            <option value='0'>Select Country</option>
                                            
                                       @foreach($countries as $country)
                                              <option value="{{ $country->id }}" @if($packagesData->country[$row]==$country->id) selected @endif>{{ $country->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>

                                      <!-- state -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="state" class="field-required">State</label>
                                          <select name="state[{{$a}}]" id="package_dest_state{{$a}}" class="form-control package_dest_state" >
                                           @foreach($states as $state)
                                              <option value="{{ $state->id }}" @if($packagesData->state[$row]==$state->id) selected @endif>{{ $state->name }}</option>
                                            @endforeach 
                                          </select>
                                        </div>
                                      </div>

                                      <!-- city -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="city" class="field-required">City</label>
                                          <select name="city[{{$a}}]" id="package_dest_city{{$a}}" class="package_dest_cities form-control city_package_dest_countries min-select" >
                                             @foreach($cities as $city)
                                              <option value="{{ $city->id }}" @if($packagesData->city[$row]==$city->id) selected @endif>{{ $city->name }}</option>
                                            @endforeach 
                                          </select>
                                        </div>
                                      </div>

                                      <!-- duration city wise -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="city" class="field-required">Duration</label>
                                          <select name="days[{{$a}}]" id="package_dest_days" class="form-control package_dest_days ">
                                           @for($day_value = 1; $day_value <= $days_duration; $day_value++)
    <option value="{{ $day_value }}" {{ $day_value == $days ? 'selected' : '' }}>
        {{ $day_value }} Night / {{ $day_value + 1 }} Days
    </option>

    @if($day_value == $days)
        @php break; @endphp
    @endif
@endfor

                                          </select>
                                        </div>
                                      </div>
                                      @if($a!=0)
                                <div class="col-md-2">
                                  <div class='form-group'>
                                    <button type='button' name='add-continent' id='remove-continent-row' class='btn btn-danger remove-continent-row' style='margin:18px 10px 0px 0px'>Remove</button>
                                  </div>
                                </div>
                                @endif
                                    </div>
                                     <?php $a++;?>
                                      @endforeach
                            </div>
                          </div>

                          <!-- add more city & duration -->
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <button type="button" name="add-continent" id="add-continent-row" class="btn btn-success">(+) Add more city
                                  <!-- more content from package.js -->
                                </button>
                              </div>
                            </div>
                          </div>

                        </div>
                        