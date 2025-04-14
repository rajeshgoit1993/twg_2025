@extends('layouts.master')
@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <form action="{{url('/storeRates')}}" method="post">
              {{csrf_field()}}
              <div class="panel-heading">
                <h3 class="panel-title">Manage Room Rates</h3>
              </div>
              <br>
              <div class="col-md-6 form-group">
                <label class="col-md-4 control-label text-left">Room Type</label>
                <div class="col-md-8">
                  <select class="form-control" name="roomType">
                    @foreach($RoomPlan as $key=>$Roomplan) 
                      <option selected value="{{$Roomplan->RatePlanName}}">{{$Roomplan->RatePlanName}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-6 form-group">
                <label class="col-md-4 control-label text-left">Day of Week</label>
                <div class="col-md-8">
   
                    
                  <select  name="daysOfWeek[]" class="form-control select2" multiple="multiple" data-placeholder="Select Day Of Weeks" style="width: 100%;">
                        <option  value="Check All Days">Check All Days</option>
                        <option  value="Uncheck All Days">Uncheck All Days</option>
                        <option  value="Monday">Monday</option>
                        <option  value="Tuesday">Tuesday</option>
                        <option  value="Wednesday">Wednesday</option>
                        <option  value="Thursday">Thursday</option>
                        <option  value="Friday">Friday</option>
                        <option  value="Saturday">Saturday</option>
                        <option  value="Sunday">Sunday</option>
                  </select>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-6 form-group">
                <label class="col-md-4 control-label text-left">Stay Start Date</label>
                <div class='col-md-8'>
                    <div class="form-group"> <!-- Date input -->
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="stayStartDate" class="form-control pull-right datepicker" data-fillr-id="115545" data-fillr="bound" autocomplete="off">
                      </div>
                    </div>
                </div>
              </div>

              <div class="col-md-6 form-group">
                <label class="col-md-4 control-label text-left">Stay End Date</label>
                <div class='col-md-8'>
                    <div class="form-group"> <!-- Date input -->
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="stayEndDate" class="form-control pull-right datepicker" data-fillr-id="115545" data-fillr="bound" autocomplete="off">
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-6 form-group">
                <label class="col-md-4 control-label text-left">Contract Type</label>
                <div class="col-md-8">
                  <select class="form-control" name="ContractType">
                    <option selected value="(Select Contract Type)">(Select Contract Type)</option>
                    <option selected value="B2C">B2C</option>
                    <option selected value="B2B">B2B</option>
                    <option selected value="Mobile App">Mobile App</option>
                    <option selected value="Corporate">Corporate</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 form-group">
                <label class="col-md-4 control-label text-left">Type of Rate</label>
                <div class="col-md-8">
                  <select class="form-control" name="TypeOfRate">
                    <option>Sell Rate</option>
                  </select>
                </div>
              </div>
              <h2>Rate Calculation</h2><hr>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label class="col-md-4 control-label text-left">Commission Offered (%)</label>
                    <div class="col-md-8">
                      <input class="form-control commission" type="text" name="CommissionOffered" placeholder="%">
                    </div>
                  </div>
                  <div class="col-md-6 form-group">
                    <label class="col-md-4 control-label text-left">Overall Tax %</label>
                    <div class="col-md-8">
                      <input class="form-control tax" type="text" name="CommissionOffered" placeholder="%">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-2 control-label text-left"> Declared Rate:</label>
                <div class="col-md-10">
                  <div class="col-md-4">
                    <label style="text-align: center;">Single Rate </label>
                    <input type="text" placeholder="Single Rate" name="Declared[single]" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label style="text-align: center;">Double Rate  </label>
                    <input type="text" placeholder="Double Rate" name="Declared[double]" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label style="text-align: center;">Triple Rate </label>
                    <input type="text" placeholder="Triple Rate" name="Declared[triple]" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-2 control-label text-left"> Commission Offered (%):</label>
                <div class="col-md-10">
                  <div class="col-md-4">
                    <input type="text" placeholder="%" name="commission[single]" class="form-control commissionSingle">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="%" name="commission[double]" class="form-control commissionDouble">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="%" name="commission[triple]" class="form-control commissionTriple">
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-2 control-label text-left"> Sell Rate:</label>
                <div class="col-md-10">
                  <div class="col-md-4">
                    <input type="text" placeholder="Single Rate" name="Sell[single]" class="form-control Single">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="Double Rate" name="Sell[double]" class="form-control Double">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="Triple Rate" name="Sell[triple]" class="form-control Triple">
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-2 control-label text-left"> Net Rate:</label>
                <div class="col-md-10">
                  <div class="col-md-4">
                    <input type="text" placeholder="" name="Net[single]" class="form-control discountSingle" readonly="readonly">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="" name="Net[double]" class="form-control discountDouble" readonly="readonly">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="" name="Net[triple]" class="form-control discountTriple" readonly="readonly">
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-2 control-label text-left"> Extra Charges:</label>
                <div class="col-md-10">
                  <div class="col-md-4">
                    <label style="text-align: center;">Extra Adult Charges  </label>
                    <input type="text" placeholder="Extra Adult" name="ExtraCharge[adult]" class="form-control Extra_Adult">
                  </div>
                  <div class="col-md-4">
                    <label style="text-align: center;">Extra child Charges (Age 6 - 12 years)</label>
                    <input type="text" placeholder="Extra Child" name="ExtraCharge[child]" class="form-control Extra_Child">
                  </div>
                  <div class="col-md-4">
                    <label style="text-align: center;">Infant Charges (Below 6 years)</label>
                    <input type="text" placeholder="Extra Infant" name="ExtraCharge[infrant]" class="form-control Extra_Infant">
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-2 control-label text-left"> Commission Offered (%):</label>
                <div class="col-md-10">
                  <div class="col-md-4">
                    <input type="text" placeholder="%" name="commission1[single]" class="form-control commissionSingle1">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="%" name="commission1[double]" class="form-control commissionDouble1">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="%" name="commission1[triple]" class="form-control commissionTriple1">
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-2 control-label text-left"> Net Extra Charges:</label>
                <div class="col-md-10">
                  <div class="col-md-4">
                    
                    <input type="text" placeholder="" name="NettExtraCharge[adult]" class="form-control Nett_Extra_Adult" readonly="readonly">
                    <label style="text-align: center;">Net Extra Adult Charges </label>
                  </div>
                  <div class="col-md-4">
                    
                    <input type="text" placeholder="" name="NettExtraCharge[child]" class="form-control Nett_Extra_Child" readonly="readonly">
                    <label style="text-align: center;">Net Extra child Charges (Age 6 - 12 years)</label>
                  </div>
                  <div class="col-md-4">
                    
                    <input type="text" placeholder="" name="NettExtraCharge[infrant]" class="form-control Nett_Extra_Infant" readonly="readonly">
                    <label style="text-align: center;">Net Infant Charges (Below 6 years)</label>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-md-offset-3 form-group">
                <input class="btn btn-primary Calculate" value="Calculate net price" type="button">
              </div>
              <div class="clearfix"></div>
              <div class="panel-footer">
                <button type="submit" class="btn btn-primary submitfrm" id="add">Update Rates</button>
              </div>
              </form>
            </div>
          </div>
        </div>



      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


@endsection
