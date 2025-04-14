  <?php $flight_data=$packagesData->flight; ?>
<div class="row">
  <div class="col-md-12">
                            <div class="flightOption">
                              <label for="flightOption">Flight Required?</label>
                              <!-- <input type="checkbox" name="flight[flightOption]" id="show_flight_options" value="1"
                              @if(array_key_exists('flightOption', $flight_data) && $flight_data['flightOption'] == 1) checked @endif> -->
                              <input type="checkbox" name="flight[flightOption]" id="show_flight_options" value="1" {{ !empty($flight_data['flightOption']) && $flight_data['flightOption'] == 1 ? 'checked' : '' }}>
                            </div>
                          </div>

                          <!-- flight -->
 <div class="col-md-12 flight" style="display: {{ !empty($flight_data['flightOption']) && $flight_data['flightOption'] == 1 ? 'block' : 'none' }};">


                          <!--Onward Flight-->
                            <div class="item-container">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="flightOption">
                                    <label for="onward_required">Onward Flight Required?</label>
                                    <!-- <input type="checkbox" name="flight[onward_required]" id="onward_required" value="1"
                                      @if(array_key_exists('onward_required', $flight_data) && $flight_data['onward_required'] == 1) checked @endif> -->
                                    <input type="checkbox" name="flight[onward_required]" id="onward_required" value="1" {{ !empty($flight_data['onward_required']) && $flight_data['onward_required'] == 1 ? 'checked' : '' }}>

                                  </div>
                                </div>
                                <div class="onwardflight"
                                  @if(array_key_exists('onward_required', $flight_data) && $flight_data['onward_required'] == 1) style="display: block;" @else style="display: none;" @endif>
                                  <div class="col-md-12 appendBottom10">
                                    <p class="flightBoxHeading">ONWARD FLIGHT</p>
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>Airline Name</label>
                                    <!--<input type="text" name="flight[name]" class="form-control flight_name">-->
                                    <select name="flight[name]" class="form-control flight_name">
                                      <option value="0">Select Airline</option>
                                      @foreach($airlines as $airline)
                                        <option value="{{$airline->airline_name}}" @if($flight_data['name']==$airline->airline_name) selected @endif>{{$airline->airline_name}} </option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>Flight No.</label>
                                    <input type="text" name="flight[no]" class="form-control flight_no" placeholder="e.g. 333" value="{{$flight_data['no']}}">
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>No. Of Stop</label>
                                    <select name="flight[numberstop]" class="form-control">
                                      <option value="0" {{ ($flight_data['numberstop'] ?? '') == 0 ? 'selected' : '' }}>Select Stops</option>
                                      <option value="Non-Stop" {{ ($flight_data['numberstop'] ?? '') == "Non-Stop" ? 'selected' : '' }}>Non-Stop</option>
                                      @for($i = 1; $i <= 4; $i++)
                                          <option value="{{ $i }} {{ $i == 1 ? 'Stop' : 'Stops' }}" 
                                              {{ ($flight_data['numberstop'] ?? '') == "$i " . ($i == 1 ? 'Stop' : 'Stops') ? 'selected' : '' }}>
                                              {{ $i }} {{ $i == 1 ? 'Stop' : 'Stops' }}
                                          </option>
                                      @endfor
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Flight Origin</label>
                                    <select name="flight[origin]" class="form-control origin">
                                      <option value="0" {{ ($flight_data['origin'] ?? '') == 0 ? 'selected' : '' }}>Select Origin</option>
                                      @foreach($iatalist as $iata)
                                          @php $val = "{$iata->iata_name} ({$iata->iata_code})"; @endphp
                                          <option value="{{ $val }}" {{ ($flight_data['origin'] ?? '') == $val ? 'selected' : '' }}>
                                              {{ $val }}
                                          </option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Departure Time</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[dhours]" class="form-control dhours" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0" >Hours</option>
                                      @for($i=1;$i<=24;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('dhours',$flight_data) && $flight_data['dhours']==$i) selected @endif>{{ $i }}</option>
                                      @endfor -->
                                      <option value="" disabled>Hours</option>
                                      @for($i=1; $i<=24; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('dhours', $flight_data) && $flight_data['dhours'] == $i) selected @endif>{{ $i }} {{ \Illuminate\Support\Str::plural('hour', $i) }}</option>
                                      @endfor
                                    </select>

                                    <select name="flight[dmins]" class="form-control dmins" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      @for($i=1;$i<=60;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('dmins',$flight_data) && $flight_data['dmins'] == $i) selected @endif>{{ $i }}</option>
                                      @endfor -->
                                      <option value="" disabled>Minutes</option>
                                      @for($i = 0; $i <= 59; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('dmins',$flight_data) && $flight_data['dmins']==$i) selected @endif>{{ $i === 0 ? '00' : $i }} {{ \Illuminate\Support\Str::plural('minute', $i) }}</option>
                                      @endfor
                                    </select>                                    
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Destination</label>
                                    <select name="flight[dest]" class="form-control dest">
                                      <option value="0">Select Destination</option>
                                      @foreach($iatalist as $iata)
                                        <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                        <option value="{{$val}}" @if($flight_data['dest']==$val) selected @endif>{{$val}}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Arrival Time</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[ahours]" class="form-control ahours" style="padding: 5px;max-width: 32%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      @for($i=1;$i<=72;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('ahours',$flight_data) && $flight_data['ahours']==$i) selected @endif>{{ $i }}</option>
                                      @endfor -->
                                      <option value="" disabled>Hours</option>
                                      @for($i=1; $i<=72; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('ahours',$flight_data) && $flight_data['ahours']==$i) selected @endif>{{ $i }} {{ \Illuminate\Support\Str::plural('hour', $i) }}</option>
                                      @endfor
                                    </select>

                                    <select name="flight[amins]" class="form-control amins" style="padding: 5px;max-width: 37%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      @for($i=1;$i<=60;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('amins',$flight_data) && $flight_data['amins']==$i) selected @endif>{{ $i }}</option>
                                      @endfor -->
                                      <option value="" disabled>Minutes</option>
                                      @for($i = 0; $i <= 59; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('amins',$flight_data) && $flight_data['amins'] == $i) selected @endif>{{ $i === 0 ? '00' : $i }} {{ \Illuminate\Support\Str::plural('minute', $i) }}</option>
                                      @endfor
                                    </select>

                                    <select name="flight[adayplus]" class="form-control adayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
                                      <option value="0" @if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==0) selected @endif>+0 Day</option>
                                      <option value="1" @if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==1) selected @endif>+1 Day</option>
                                      <option value="2" @if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==2) selected @endif>+2 Day</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Cabin Class</label>
                                    <select name="flight[cabin]" class="form-control">
                                      <option value="economyclass" @if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='economyclass') selected @endif>Economy</option>
                                      <option value="premiumeconomyclass" @if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='premiumeconomyclass') selected @endif>Premium Economy</option>
                                      <option value="businessclass" @if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='businessclass') selected @endif>Business</option>
                                      <option value="firstclass" @if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='firstclass') selected @endif>First</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Fare Type</label>
                                    <select name="flight[faretype]" class="form-control">
                                      <option value="">Select</option>
                                      <option value="refundable" @if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='refundable') selected @endif>Refundable</option>
                                      <option value="partialrefundable" @if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='partialrefundable') selected @endif>Partial-refundable</option>
                                      <option value="non-refundable" @if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='non-refundable') selected @endif>Non-refundable</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Flight Duration</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[duration_hours]" class="form-control duration_hours" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      @for($i=1;$i<=24;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('duration_hours',$flight_data) && $flight_data['duration_hours']==$i) selected @endif>{{ $i }} hrs </option>
                                      @endfor -->
                                      <option value="" disabled>Hours</option>
                                      @for($i = 1; $i <= 40; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('duration_hours', $flight_data) && $flight_data['duration_hours'] == $i) selected @endif>
                                          {{ $i }} {{ $i === 1 ? 'hour' : 'hours' }}
                                        </option>
                                      @endfor
                                    </select>

                                    <select name="flight[duration_dmins]" class="form-control duration_min" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      @for($i=1;$i<=59;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('duration_dmins',$flight_data) && $flight_data['duration_dmins']==$i) selected @endif>{{ $i }} mins</option>
                                      @endfor -->
                                      <option value="" disabled>Minutes</option>
                                      @for($i = 0; $i <= 59; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('duration_dmins', $flight_data) && $flight_data['duration_dmins'] == $i) selected @endif>
                                      {{ $i === 0 ? '00' : $i }} {{ $i === 1 ? 'minute' : 'minutes' }}</option>
                                      @endfor
                                    </select>
                                  </div>

                                  <div class="col-md-3 apndBtm20">
                                    <div class="makeflex">
                                      <!-- cabin baggage -->
                                      <div class="flexOne">
                                        <label>Cabin Baggage</label>
                                        <select name="flight[baggage]" class="form-control">
                                          <option value="" selected disabled>Cabin Bag</option>
                                          <option value="0 Kg" @if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='0 Kg') selected @endif>0 Kg</option>
                                          <option value="5 Kgs" @if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='5 Kgs') selected @endif>5 Kgs</option>
                                          <option value="7 Kgs" @if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='7 Kgs') selected @endif>7 Kgs</option>
                                          <option value="8 Kgs" @if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='8 Kgs') selected @endif>8 Kgs</option>
                                        </select>
                                      </div>

                                      <!-- check-in baggage -->
                                      <div class="flexOne">
                                        <label>Check-In Baggage</label>
                                        <select name="flight[cbaggage]" class="form-control">
                                          <option selected disabled>Check-In Bag</option>
                                          <option value="0 Kg" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='0 Kg') selected @endif>0 Kg</option>
                                          <option value="10 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='10 Kgs') selected @endif>10 Kgs</option>
                                          <option value="15 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='15 Kgs') selected @endif>15 Kgs</option>
                                          <option value="20 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='20 Kgs') selected @endif>20 Kgs</option>
                                          <option value="23 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='23 Kgs') selected @endif>23 Kgs</option>
                                          <option value="25 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='25 Kgs') selected @endif>25 Kgs</option>
                                          <option value="30 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='30 Kgs') selected @endif>30 Kgs</option>
                                          <option value="35 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='35 Kgs') selected @endif>35 Kgs</option>
                                          <option value="40 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='40 Kgs') selected @endif>40 Kgs</option>
                                          <option value="45 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='45 Kgs') selected @endif>45 Kgs</option>
                                          <option value="50 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='50 Kgs') selected @endif>50 Kgs</option>
                                          <option value="55 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='55 Kgs') selected @endif>55 Kgs</option>
                                          <option value="60 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='60 Kgs') selected @endif>60 Kgs</option>
                                          <option value="1 Piece" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='1 Piece') selected @endif>1 Piece</option>
                                          <option value="2 Pieces" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='2 Pieces') selected @endif>2 Pieces</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              </div>
                            </div>


                            <!--Return Flight-->
                            <div class="item-container">
                              <div class="row">

                                <div class="col-md-12">
                                  <div class="flightOption">
                                    <label for="return_required">Return Flight Required?</label>
                                    <input type="checkbox"  name="flight[return_required]"  id="return_required" value="1"  @if(array_key_exists('return_required',$flight_data) && $flight_data['return_required']==1) checked @endif>
                                  </div>
                                </div>


<div class="returnflight" @if(array_key_exists('return_required',$flight_data) && $flight_data['return_required']==1) style="display: block;" @else style="display: none;" @endif>
                                  <div class="col-md-12 appendBottom10">
                                    <p class="flightBoxHeading">RETURN FLIGHT</p>
                                  </div>
<div class="col-md-4 appendBottom20">
                                    <label>Airline Name</label>
                                    <select name="flight[dname]" class="form-control down_filght">
                                      <option value="0">Select Airline</option>
                                      @foreach($airlines as $airline)
                                        <option value="{{$airline->airline_name}}" @if($flight_data['dname']==$airline->airline_name) selected @endif>{{$airline->airline_name}} </option>
                                      @endforeach
                                    </select>
                                  </div>
 <div class="col-md-4 appendBottom20">
                                    <label>Flight No.</label>
                                    <input type="text" name="flight[dno]" class="form-control down_no" placeholder="e.g. 334" value="{{$flight_data['dno']}}">
                                  </div>
         <div class="col-md-4 appendBottom20">
                                    <label>No. Of Stop</label>
                                    <select name="flight[dnumberstop]" class="form-control">
                                      <option value="0" @if($flight_data['dnumberstop']==0) selected @endif>Select Stopover</option>
                                      <option value="Non-Stop" @if($flight_data['dnumberstop']=="Non-Stop") selected @endif>Non-Stop</option>
                                      @for($i = 1; $i <= 4; $i++)
                                      @if($i == 1)
                                        <option value="{{ $i }} Stop" @if($flight_data['dnumberstop']=="$i Stop") selected @endif>{{ $i }} Stop</option>
                                      @else
                                        <option value="{{ $i }} Stops" @if($flight_data['dnumberstop']=="$i Stops") selected @endif>{{ $i }} Stops</option>
                                      @endif
                                      @endfor
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Flight Origin</label>
                                    <select name="flight[dOrigin]" class="form-control down_origin">
                                      <option value="0" @if($flight_data['dOrigin']==0) selected @endif>Select Origin</option>
                                      @foreach($iatalist as $iata)
                                        <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                        <option value="{{$val}}" @if($flight_data['dOrigin']==$val) selected @endif>{{$val}}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Departure Time</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[ddhours]" class="form-control ddhours" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      @for($i=1;$i<=24;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('ddhours',$flight_data) && $flight_data['ddhours']==$i) selected @endif>{{ $i }}</option>
                                      @endfor -->
                                      <option value="" disabled>Hours</option>
                                      @for($i=1; $i<=24; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('ddhours',$flight_data) && $flight_data['ddhours']==$i) selected @endif>{{ $i }} {{ \Illuminate\Support\Str::plural('hour', $i) }}</option>
                                      @endfor
                                    </select>

                                    <select name="flight[ddmins]" class="form-control ddmins" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      @for($i=1;$i<=60;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('ddmins',$flight_data) && $flight_data['ddmins']==$i) selected @endif>{{ $i }}</option>
                                      @endfor -->
                                      <option value="" disabled>Minutes</option>
                                      @for($i = 0; $i <= 59; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('ddmins',$flight_data) && $flight_data['ddmins']==$i) selected @endif>{{ $i === 0 ? '00' : $i }} {{ \Illuminate\Support\Str::plural('minute', $i) }}</option>
                                      @endfor
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Destination</label>
                                    <select name="flight[ddest]" class="form-control down_dest">
                                      <option value="0">Select Destination</option>
                                      @foreach($iatalist as $iata)
                                      <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                        <option value="{{$val}}" @if(array_key_exists('ddest',$flight_data) &&  $flight_data['ddest']==$val) selected @endif>{{$val}}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Arrival Time</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[dahours]" class="form-control dahours" style="padding: 5px;max-width: 32%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      @for($i=1;$i<=24;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('dahours',$flight_data) && $flight_data['dahours']==$i) selected @endif>{{ $i }}</option>
                                      @endfor -->
                                        <option value="" disabled>Hours</option>
                                        @for($i=1; $i<=24; $i++)
                                          <option value="{{ $i }}" @if(array_key_exists('dahours',$flight_data) && $flight_data['dahours']==$i) selected @endif>{{ $i }} {{ \Illuminate\Support\Str::plural('hour', $i) }}</option>
                                        @endfor
                                    </select>

                                    <select name="flight[damins]" class="form-control damins" style="padding: 5px;max-width: 37%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      @for($i=1;$i<=60;$i++)
                                        <option value="{{ $i }}" @if(array_key_exists('damins',$flight_data) && $flight_data['damins']==$i) selected @endif>{{ $i }}</option>
                                      @endfor -->
                                      <option value="" disabled>Minutes</option>
                                      @for($i = 0; $i <= 59; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('damins',$flight_data) && $flight_data['damins']==$i) selected @endif>{{ $i === 0 ? '00' : $i }} {{ \Illuminate\Support\Str::plural('minute', $i) }}</option>
                                      @endfor
                                    </select>

                                    <select name="flight[dadayplus]" class="form-control dadayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
                                      <option value="0" @if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==0) selected @endif>+0 Day</option>
                                      <option value="1" @if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==1) selected @endif>+1 Day</option>
                                      <option value="2" @if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==2) selected @endif>+2 Day</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3">
                                    <label>Cabin Class</label>
                                    <select name="flight[dcabin]" class="form-control">
                                      <option value="economyclass" @if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='economyclass') selected @endif>Economy</option>
                                      <option value="premiumeconomyclass" @if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='premiumeconomyclass') selected @endif>Premium Economy</option>
                                      <option value="businessclass" @if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='businessclass') selected @endif>Business</option>
                                      <option value="firstclass" @if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='firstclass') selected @endif>First</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Fare Type</label>
                                    <select name="flight[dfaretype]" class="form-control">
                                      <option value="">Select</option>
                                      <option value="refundable" @if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='refundable') selected @endif>Refundable</option>
                                      <option value="partialrefundable" @if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='partialrefundable') selected @endif>Partial-refundable</option>
                                      <option value="non-refundable" @if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='non-refundable') selected @endif>Non-refundable</option>
                                    </select>
                                  </div>
                                   <div class="col-md-3">
                                    <label>Flight Duration</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[return_duration_hours]" class="form-control return_duration_hours" style="max-width: 49%;display: inline-block;">
                                     
                                      <option value="" disabled>Hours</option>
                                      @for($i = 1; $i <= 40; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('return_duration_hours',$flight_data) && $flight_data['return_duration_hours']==$i) selected @endif>
                                            {{ $i }} {{ $i === 1 ? 'hour' : 'hours' }}
                                        </option>
                                      @endfor
                                    </select>

                                    <select name="flight[return_duration_mins]" class="form-control return_duration_min" style="max-width: 49%;display: inline-block;">
                                      
                                      <option value="" disabled>Minutes</option>
                                      @for($i = 0; $i <= 59; $i++)
                                        <option value="{{ $i }}" @if(array_key_exists('return_duration_mins',$flight_data) && $flight_data['return_duration_mins']==$i) selected @endif>
                                            {{ $i === 0 ? '00' : $i }} {{ $i === 1 ? 'minute' : 'minutes' }}</option>
                                       
                                      @endfor
                                    </select>
                                  </div>
                                    <div class="col-md-3 apndBtm20">
                                    <div class="makeflex">
                                      <!-- cabin baggage -->
                                      <div class="flexOne">
                                        <label>Cabin Baggage</label>
                                        <select name="flight[dbaggage]" class="form-control">
                                          <option selected disabled>Cabin Bag</option>
                                          <option value="0 Kg" @if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='0 Kg') selected @endif>0 Kg</option>
                                          <option value="5 Kgs" @if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='5 Kgs') selected @endif>5 Kgs</option>
                                          <option value="7 Kgs" @if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='7 Kgs') selected @endif>7 Kgs</option>
                                          <option value="8 Kgs" @if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='8 Kgs') selected @endif>8 Kgs</option>
                                        </select>
                                      </div>

                                      <!-- check-in baggage -->
                                      <div class="flexOne">
                                        <label>Check-In Baggage</label>
                                        <select name="flight[dcbaggage]" class="form-control">
                                          <option selected disabled>Check-In Bag</option>
                                          <option value="0 Kg" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='0 Kg') selected @endif>0 Kg</option>
                                          <option value="10 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='10 Kgs') selected @endif>10 Kgs</option>
                                          <option value="15 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='15 Kgs') selected @endif>15 Kgs</option>
                                          <option value="20 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='20 Kgs') selected @endif>20 Kgs</option>
                                          <option value="23 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='23 Kgs') selected @endif>23 Kgs</option>
                                          <option value="25 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='25 Kgs') selected @endif>25 Kgs</option>
                                          <option value="30 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='30 Kgs') selected @endif>30 Kgs</option>
                                          <option value="35 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='35 Kgs') selected @endif>35 Kgs</option>
                                          <option value="40 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='40 Kgs') selected @endif>40 Kgs</option>
                                          <option value="45 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='45 Kgs') selected @endif>45 Kgs</option>
                                          <option value="50 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='50 Kgs') selected @endif>50 Kgs</option>
                                          <option value="55 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='55 Kgs') selected @endif>55 Kgs</option>
                                          <option value="60 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='60 Kgs') selected @endif>60 Kgs</option>
                                          <option value="1 Piece" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='1 Piece') selected @endif>1 Piece</option>
                                          <option value="2 Pieces" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='2 Pieces') selected @endif>2 Pieces</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>                       

                                </div>
 </div>

                              </div>

                            </div>
                                </div>