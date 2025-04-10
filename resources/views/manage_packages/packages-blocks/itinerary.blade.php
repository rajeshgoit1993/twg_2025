<?php $itinerary_data=$packagesData->day_itinerary; ?>
                      <div class="row">
                        <div class="col-md-12">
                                  <div >
                                    <label >Add Itinerary</label>
                                    <input type="checkbox"  name="dayItinerary[itineraryOption]" id="add_itinerary" value="1"
                                    {{ !empty($itinerary_data['itineraryOption']) && $itinerary_data['itineraryOption'] == 1 ? 'checked' : '' }}
                                    >
                                  </div>
                                </div>
                      </div>
<?php 

$day_count = count($packagesData->day_itinerary); ?>
                            @for($i=1 ; $i<= $day_count ; $i++)
                            @if(array_key_exists('day' . $i, $packagesData->day_itinerary))
                      <div class="panel-body c_body">
                        <div class="row">
                          <div class="table-responsive">
                            
                            <div class="col-md-12 dayItinerary day1">
                              <div class="item-container">
                                <div class="row">

                                  <!-- day title -->
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="field-required">DAY {{$i}}</label>
                                      <input type="text" class="form-control" name="dayItinerary[day{{$i}}][title]" value="{{$packagesData->day_itinerary["day$i"]["title"]}}">
                                    </div>
                                  </div>
                                
                                  <!-- tour activity -->
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Tour Activity</label>
                                      <select class='select2 form-control dayItineraryactivity custom_days' name="dayItinerary[day{{$i}}][activities][]" multiple>
                                        @foreach($activities as $activity)
                                          <option value="{{$activity->activity}}" @if(!empty($packagesData->day_itinerary["day$i"]["activities"]) && in_array($activity->activity ,
                                        $packagesData->day_itinerary["day$i"]["activities"])) selected='selected' @endif>{{$activity->activity}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <!-- meal plan -->
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Meal Plan (in hotel)</label>
                                      <select name="dayItinerary[day{{$i}}][meal_plan]" class="form-control">
                                        <option value="N" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="N") selected='selected' @endif>No Meal</option>
                                        <option value="EP" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="EP") selected='selected' @endif>Room Only</option>
                                        <option value="CP" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="CP") selected='selected' @endif> Breakfast </option>
                                        <option value="lu" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="lu") selected='selected' @endif>Lunch </option>
                                        <option value="di" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="di") selected='selected' @endif>Dinner </option>
                                        <option value="bd" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bd") selected='selected' @endif> Breakfast & Dinner </option>
                                        <option value="bl" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bl") selected='selected' @endif> Breakfast & Lunch </option>
                                        <option value="ld" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="ld") selected='selected' @endif>Lunch & Dinner </option>
                                        <option value="bld" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bld") selected='selected' @endif> Breakfast & Lunch/Dinner </option>
                                        <option value="bldall" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bldall") selected='selected' @endif>Breakfast, Lunch & Dinner </option>
                                        <option value="apai" @if($packagesData->day_itinerary["day$i"]["meal_plan"]=="apai") selected='selected' @endif>All Inclusive </option>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- tour sightseeing -->
                                  <div class="col-md-4">
                                    <div class="form-group ">
                                    <label>Tour Sightseeing</label>
                                    <select class='select2 form-control dayItinerarytour custom_days' name="dayItinerary[day{{$i}}][tours][]" multiple>
                                      @foreach($PkgTours as $key=>$tour)
                                      @if(array_key_exists("tours",$packagesData->day_itinerary["day$i"]))
                                      <option value="{{$tour->id}}" @if(in_array($tour->id ,
                                      $packagesData->day_itinerary["day$i"]["tours"])) selected='selected' @endif>{{$tour->activity}}</option>
                                      @else
                                      <option value="{{$tour->id}}">{{$tour->activity}}</option>
                                      @endif
                                      @endforeach
                                    </select>
                                    </div>
                                  </div>

                                  <!-- tour day plan -->
                                  <div class="col-md-12 custom_inc_exc">
                                    <div class="form-group">
                                      <label>Day Plan</label>
                                      <br>
                                      <span class="show_hide morePlus">More+</span>
                                      <textarea class="form-control ckeditor" rows="3" name="dayItinerary[day{{$i}}][desc]">{{ $packagesData->day_itinerary["day$i"]["desc"] }}</textarea>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      @endif
                      @endfor