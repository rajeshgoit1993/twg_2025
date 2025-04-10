@extends('layouts.master')

@section("custom_css_code")

<style>
.panel-default > .panel-heading {
    color: #333;
    background-color: #fff;
    border-color: #e4e5e7;
    padding: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.panel-default > .panel-heading a {
    display: block;
    padding: 10px 15px;
}
.panel-default > .panel-heading a:after {
    content: "";
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    float: right;
    transition: transform .25s linear;
    -webkit-transition: -webkit-transform .25s linear;
}
.panel-default > .panel-heading a[aria-expanded="true"] {
    background-color: #eee;
}
.panel-default > .panel-heading a[aria-expanded="true"]:after {
    content: "\2212";
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
}
.panel-default > .panel-heading a[aria-expanded="false"]:after {
    content: "\002b";
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
}
.accordion-option {
    width: 100%;
    float: left;
    clear: both;
    margin: 15px 0;
}
.accordion-option .title {
    font-size: 20px;
    font-weight: bold;
    float: left;
    padding: 0;
    margin: 0;
}
.accordion-option .toggle-accordion {
    float: right;
    font-size: 16px;
    color: #6a6c6f;
}
.dayItinerary {
    border-bottom: 1px solid darkgray;
    margin-bottom: 14px;
    border-radius: 23px;
}
span.select2.select2-container {
    width: 100% !important;
}
</style>

@endsection

@section('content')

<div class="content-wrapper">
  <section class="content">
    <div class="row">

      <!-- Back Button -->
      <div class="col-md-12">
        <div class="box">
          <!-- Box Body -->
          <div class="box-body">
            <a href="{{URL::to('/package-locations')}}" class="btn btn-success" style="margin-bottom: 10px"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>      

            <!-- Header -->
            <div class="box-header" style="padding: 10px 0;">
              <h3 class="box-title">Edit Destination</h3>
            </div>
      
            <div class="well">
                <div class="modal-body_main modal-body">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                    </div>
                  @endif

                  <form action="{{ route('saveDestination') }}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$locData->id}}"/>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="package">Continent</label>
                              <select class="form-control continent" name="continent" id="continent">
                                  <option value="">Select Continent</option>
                                  
                                   @foreach($continent as $cont)
                                  <option value="{{ $cont->id }}" @if($cont->id==$locData->continent) selected @endif>{{ $cont->continent_name }}</option>
                              @endforeach

                                     
                              </select>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="package">Country</label>
                           <select class="form-control country" name="country" id="country" >
                         @foreach($countries as $country)
        <option value="{{ $country->id }}" {{ $locData->country == $country->id ? 'selected' : '' }}>
            {{ $country->name }}
        </option>
    @endforeach    
                        </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="package">State</label>
                             <select class="form-control states" name="state" id="state" >
                                 <option value="">Select State</option>
                          @foreach($states as $state)
        <option value="{{ $state->id }}" {{ $locData->state == $state->id ? 'selected' : '' }}>
            {{ $state->name }}
        </option>
    @endforeach
                        </select>
                        </div>
                      </div>

                      <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="package">City</label>
                            <select class="form-control city" name="location" id="city">
                          <option value="">Select City</option>
                          @foreach($cities as $city)
        <option value="{{ $city->id }}" {{ $locData->location == $city->id ? 'selected' : '' }}>
            {{ $city->name }}
        </option>
    @endforeach
                        </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="currency">Currency</label>
                          <input type="text" class="form-control" name="currency" value="{{ old('currency', $locData->currency) }}" placeholder="Enter currency">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="overview">Overview</label>
                            <textarea name="overview" id="overview" class="form-control ckeditor" cols="30" rows="5">{{ old('overview', $locData->overview) }}</textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="best_time_to_visit">Best Time To Visit</label>
                          <select class="form-control select2" name="best_time_to_visit[]" id="best_time_to_visit" multiple>
                            <option value="">Select Month</option>
                              @php
                                  $selectedMonths = is_array($locData->best_time_to_visit) ? $locData->best_time_to_visit : explode(',', $locData->best_time_to_visit);
                                  $months = [
                                      1 => "January", 2 => "February", 3 => "March", 4 => "April", 
                                      5 => "May", 6 => "June", 7 => "July", 8 => "August", 
                                      9 => "September", 10 => "October", 11 => "November", 12 => "December"
                                  ];
                              @endphp
                              @foreach($months as $key => $month)
                                  <option value="{{ $key }}" @if(in_array($key, $selectedMonths)) selected @endif>{{ $month }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="best_time_desc">Best Time Description</label>
                            <textarea name="best_time_desc" id="best_time_desc" class="form-control ckeditor" cols="30" rows="5">{{ $locData->best_time_desc }}</textarea>
                        </div>
                      </div>


                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" {{ $locData->status == 1 ? 'selected' : '' }}>Enable</option>
                                <option value="0" {{ $locData->status == 0 ? 'selected' : '' }}>Disable</option>
                            </select>
                        </div>
                      </div>

                      <div class="col-md-12 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>

                    </div>
                  </form>

                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- /.content -->
</div>
@endsection