@extends('layouts.front.master')
@if(env("WEBSITENAME")==1)
@section('keywords','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
@section('desc','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
@section("title", 'The World Gateway')
@elseif(env("WEBSITENAME")==0)
@section('keywords','RapidexTravels, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
@section('desc','RapidexTravels Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
@section("title", 'RapidexTravels')
@endif
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Add Review</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{URL::to('/store_reviews')}}" id="store_reviews" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$testimonial_id}}">
            {{csrf_field()}}
            <br>
            <div class="row">
              <!-- <div class="col-md-6">
              <div class="form-group" style="margin-top: 10px;">
              <label>Enter Name:</label>
              <input type="text" name="c_name" class="form-control" placeholder="Enter  Name">
              </div>
              </div>  -->
              <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="image">Add Photo & Videos:</label>
                  <input type="file" name="c_image[]" class="form-control" multiple>
                </div>
              </div>
              <!--  <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                <label  for="email">Enter Email Id</label>
                <input type="email" name="c_email" class="form-control" placeholder="Enter  Email Id">
                </div>
                </div> -->
                <!--  <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                <label  for="mobile">Enter Mobile No</label>
                <input type="number" name="c_mobile" class="form-control" placeholder="Enter Mobile No">
                </div>
                </div> -->
                <!--  <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                <label  for="state">Enter Country</label>
                <input type="text" name="c_country" class="form-control" placeholder="Enter  Country">
                </div>
                </div> -->
              <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="state">Choose Rating</label>
                  <select name="c_rating" class="form-control">
                    <option value="1" @if($testimonial_data->c_rating==1) selected @endif>1 Star </option>
                    <option value="2" @if($testimonial_data->c_rating==2) selected @endif>2 Star </option>
                    <option value="3" @if($testimonial_data->c_rating==3) selected @endif>3 Star </option>
                    <option value="3.5" @if($testimonial_data->c_rating==3.5) selected @endif>3.5 Star </option>
                    <option value="4" @if($testimonial_data->c_rating==4) selected @endif>4 Star  </option>
                    <option value="4.5" @if($testimonial_data->c_rating==4.5) selected @endif>4.5 Star  </option>
                    <option value="5" @if($testimonial_data->c_rating==5) selected @endif>5 Star </option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="state">Enter About Package</label>
                  <textarea name="c_exp" class="form-control" rows="3" placeholder="Enter About Package">{{$testimonial_data->c_exp}}</textarea>
                </div>
              </div>
              <div class="col-md-12" style="text-align: center;">
                <button type="submit" name="add" id="remove" class="btn btn-danger btn-lg">Save<i class="fa  fa-arrow-right"></i></button>
              </div>
            </div>
        </div>
          </form>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
</div>
</div>
<!--</div>-->
@endsection
@section('custom_js')
<script type="text/javascript">
$("#store_reviews").submit(function(e) {
  e.preventDefault()
  var APP_URL=$("#APP_URL").val();
  var form_data = new FormData($('#store_reviews')[0]);
  $.ajax( {
    url:APP_URL+'/store_reviews',
    data:form_data,
    type:'post',
    contentType: false,
    processData: false,
    success:function(data) {
      if(data=='success') {
        swal({
          title: 'Done !',
          text: 'Thank you! Reviews submitted successfully',
          icon: 'success',
          timer: 1000,
          buttons: false,
        })
        .then(() => {
          window.location.href = APP_URL;
          })
        }
      else {
        swal("Error", data, "error");
        }
      },
      error:function(data) {

      }
    })
  })
</script>
@endsection