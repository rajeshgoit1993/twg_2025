<div class="col-md-12 item-container">
                          <div class="row">

                            <!-- hotel star rating -->
                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="field-required">
                                    Star Rating 
                                    <span class="color74">(The highest star rating hotel featured in this tour)</span>
                                </label>
                                <select class="form-control" name="customer_rating">
                                  @foreach([1, 2, 3, 4, 5, 7] as $rating)
                                    <option value="{{ $rating }}" {{ isset($packagesData->customer_rating) && $packagesData->customer_rating == $rating ? 'selected' : '' }}>
                                      {{ $rating }} Star
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <!-- tour sightseeing -->
                            <div class="col-md-7">                              
                              <div class="form-group select-container">
                                <label>Tour Sightseeing</label>
                                <select class="select2 form-control" name="tours[]" multiple id="tour_add">
                                    @foreach($PkgTours as $tour)
                                      <option value="{{ $tour->id }}" 
                                        @if(!empty($packagesData->tours) && in_array($tour->activity, $packagesData->tours)) selected @endif>
                                        {{ $tour->activity }}
                                      </option>
                                    @endforeach
                                </select>
                              </div>

                            </div>

                            <!-- add new sightseeing -->
                            <div class="col-md-2">
                              <div class="form-group">
                                <div class="custom_tour_parent">
                                  <button data-toggle="modal" data-target="#packagetour_custom " type="button" class="btn-success btn-sm custom_tour appendTop20">Add new sightseeing</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                          <div class="row">

                            <!-- tour inclusions -->
                            <div class="col-md-12 custom_inc_exc">
                              <div class="form-group item-container">
                                <label>Tour Inclusions</label>
                                
                                @php 

                                    $tour_inc = !empty($packagesData->tour_inc) ? $packagesData->tour_inc : []; 

                                @endphp

                                <select name="quote_inc[]" class="select2 form-control quote_inc" multiple>
                                    @foreach($inclusions as $pol)
                                      <option value="{{ $pol->id }}" {{ in_array($pol->id, $tour_inc) ? 'selected' : '' }}>
                                        {{ $pol->name }}
                                      </option>
                                    @endforeach
                                </select>

                                <br>
                                <span class="show_hide morePlus">More+</span>

                                <textarea class="form-control ckeditor" name="inclusions" cols="30" rows="5">
                                    {{ old('inclusions', $packagesData->inclusions ?? '') }}
                                </textarea>
                              </div>
                            </div>

                            <!-- tour exclusions -->
                            <div class="col-md-12 custom_inc_exc">
                              <div class="form-group item-container">
                                <label>Tour Exclusions</label>
                                
                                @php 
                               
                                    $tour_exc = !empty($packagesData->tour_exc) ? $packagesData->tour_exc : []; 
                                @endphp

                                <select name="quote_exc[]" class="select2 form-control quote_exc" multiple>
                                    @foreach($exclusions as $pol)
                                      <option value="{{ $pol->id }}" {{ in_array($pol->id, $tour_exc) ? 'selected' : '' }}>
                                        {{ $pol->name }}
                                      </option>
                                    @endforeach
                                </select>

                                <br>
                                <span class="show_hide morePlus">More+</span>

                                <textarea class="form-control ckeditor" name="exclusions" cols="30" rows="5">
                                  {{ old('exclusions', $packagesData->exclusions ?? '') }}
                                </textarea>
                              </div>
                            </div>
                          </div> 