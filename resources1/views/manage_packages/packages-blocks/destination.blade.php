<div class="item-container">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="destinations">Select Tour Destination(s)</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                   <select name="destinations[]" id="destinations" class="form-control destinations" multiple>

                                     @if($packagesData->destinations!="")
                                        @foreach($packagesData->destinations as $loc)
                                        <?php 
$destination_data = DB::table('rt_locations')
    ->leftJoin('countries', 'rt_locations.country', '=', 'countries.id')
    ->leftJoin('states', 'rt_locations.state', '=', 'states.id')
    ->leftJoin('city', 'rt_locations.location', '=', 'city.id')
    ->where('rt_locations.id', '=', $loc)
    ->select('rt_locations.*', 'countries.name as country_name', 'states.name as state_name', 'city.name as city_name')
    ->first();
    
                                        ?>
                                          <option value="{{$loc}}" selected>
                                            @if($destination_data->country_name!='' && $destination_data->country_name=='India')
{{$destination_data->state_name}}, {{$destination_data->country_name}}
                                            @else
{{$destination_data->country_name}}
                                            @endif
                                          
                                          </option>
                                        @endforeach
                                        @endif
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>