<div class="item-container">
                          <div class="row">

                            <!-- select destination -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="destinations">Choose City</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="sp_city[]" id="sp_city" class="form-control sp_city" multiple>
                                    @if($packagesData->sp_city!="")
                                        @foreach($packagesData->sp_city as $spcity)
                       <?php 
 $matchingCityIds = DB::table('city')->where('id',$spcity)->first();
 $matching_state =  DB::table('states')->where('id',$matchingCityIds->state_id)->first();
 $matching_country =  DB::table('countries')->where('id',$matching_state->country_id)->first();
                       ?>                 
                                          <option value="{{$spcity}}" selected>
                                            @if($matching_state!='' && $matching_state->country_id=='101')
{{$matchingCityIds->name}} ({{$matching_state->name}}, {{$matching_country->name}} )
                                            @else
{{$matchingCityIds->name}} ({{$matching_country->name}} )
                                            @endif
                                          
                                          </option>
                                        @endforeach
                                        @endif
                                  </select>
                                </div>
                              </div>
                            </div>

                            <!-- select similar tour -->
                            <div class="spkgs-box">
                              <div class="col-md-12">
                                <div class="form-group ">
                                  <label for="destinations">Choose Similar Package(s)</label>
                                  <div class="input-group pdngBtm5">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <select name="similar_packages[]" id="similar_packages" class="form-control select2" multiple>
                                      @if (!empty($packagesData->similar_packages))
    @php
        
        $packageIds = $packagesData->similar_packages;

        $packageDetails = DB::table('rt_packages')
            ->whereIn('id', $packageIds)
            ->get()
            ->keyBy('id');

      
        $given_city_list = is_array($packagesData->sp_city) ? $packagesData->sp_city : [];
    @endphp

    @foreach ($packageDetails as $pkgs => $data_check)
        @php
           
            $city_list = @unserialize($data_check->city) ?: [];
            $result = array_intersect($given_city_list, $city_list);
            $output = count($result) > 0 ? count($result) : '';
        @endphp

        <option value="{{ $pkgs }}" city="{{ $output }}" selected>
            {{ $data_check->title }}
        </option>
    @endforeach
@endif
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>