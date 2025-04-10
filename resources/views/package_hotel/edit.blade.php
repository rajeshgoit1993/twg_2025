@extends('layouts.master')

@section('custom_css_code')

<!-- custom select2 css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/backend/css/select2-css.css') }}" />

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ URL::to('/package_hotel') }}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
              <div class="box-header" style="padding: 10px 0;">
                <h3 class="box-title">Edit Package Hotel</h3>
              </div>

              <div class="well">
                <div class="modal-body">
                  <form action="{{URL::to('/update_packagehotel/'.$data->id)}}" method="post" enctype="multipart/form-data" />
                    <input type="hidden" name="type" value="Private Tour"/>
                    {{csrf_field()}}
                    <div class="row">                
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertyid">Property ID <span class="requiredcolor">*</span></label>
                            <input type="text" class="form-control" id="propertyid" name="propertyid" value="{{$data->id}}" placeholder="Enter Property ID" readonly>
                        </div>
                      </div>

                      <div class="col-md-12"></div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="location">City <span class="requiredcolor">*</span></label>
                          <select class="quote_city form-control" id="location" name="location" required>
                            <option value="{{$data->id}}" selected>{{CustomHelpers::get_master_table_data('city', 'id', (int)$data->location, 'name')  }}</option>
                          </select>
                            <!-- <input type="text" class="form-control" id="location" name="location" value="{{$data->location}}" placeholder="Select City Name" required> -->
                        </div>
                        <span class="error">{{ $errors->first("rate")}}</span>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertycountry">Country <span class="requiredcolor">*</span></label>
                          <select class="form-control" id="propertycountry" name="propertycountry" required>
                            <option value="">--Select Country--</option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}" @if($country->id==$data->propertycountry) selected @endif>{{$country->name}}</option>
                            @endforeach
                          </select>
                          <!-- <input type="text" class="form-control text-capitalize" id="propertycountry" name="propertycountry" placeholder="Enter country name" value="{{$data->propertycountry}}"> -->
                        </div>
                      </div>

                      <div class="col-md-12"></div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertytype">Accommodation Type <span class="requiredcolor">*</span></label>
                            <select class="form-control" name="propertytype" id="propertytype" required>
                              <option value="" selected disabled>Select</option>
                              <option value="hotel" @if($data->propertytype=='hotel') selected='selected' @endif>Hotel</option>
                              <option value="resort" @if($data->propertytype=='resort') selected='selected' @endif>Resort</option>
                              <option value="villa" @if($data->propertytype=='villa') selected='selected' @endif>Villa</option>
                              <option value="home" @if($data->propertytype=='home') selected='selected' @endif>Home</option>
                              <option value="camp" @if($data->propertytype=='camp') selected='selected' @endif>Camp</option>
                              <option value="cruise" @if($data->propertytype=='cruise') selected='selected' @endif>Cruise</option>
                            </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="star_rating">Star Rating <span class="requiredcolor">*</span></label>
                          <select name="star_rating" class="form-control" required>
                            <option value="" selected disabled>Select</option>
                            <option value="1" @if($data->star_rating=="1") selected="selected" @endif>1 Star</option>
                            <option value="2" @if($data->star_rating=="2") selected="selected" @endif>2 Star</option>
                            <option value="3" @if($data->star_rating=="3") selected="selected" @endif>3 Star</option>
                            <option value="4" @if($data->star_rating=="4") selected="selected" @endif>4 Star</option>
                            <option value="5" @if($data->star_rating=="5") selected="selected" @endif>5 Star</option>
                          </select>
                        </div>
                        <span class="error">{{ $errors->first("rate")}}</span>
                      </div>

                      <div class="col-md-12"></div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="hotelname">Name <span class="requiredcolor">*</span></label>
                            <input type="text" class="form-control text-capitalize" id="hotelname" name="hotelname" value="{{$data->hotelname}}" placeholder="Enter Property Name" required>
                        </div>
                        <span class="error">{{ $errors->first("currency")}}</span>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertyaddress">Address <span class="requiredcolor">*</span></label>
                            <input type="text" class="form-control text-capitalize" name="propertyaddress" id="propertyaddress" placeholder="Enter property address" value="{{$data->propertyaddress}}">
                            <!--<textarea class="form-control" name="address" placeholder="Registered Address"></textarea>-->
                        </div>
                      </div>

                      <div class="col-md-12"></div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertyphone">Phone No</label>
                            <input type="text" class="form-control" id="propertyphone" name="propertyphone" placeholder="Enter Contact Number" multiple value="{{$data->propertyphone}}">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertymobile">Mobile No <span class="requiredcolor">*</span></label>
                            <input type="text" class="form-control" id="propertymobile" name="propertymobile" placeholder="Enter Mobile Number" multiple value="{{$data->propertymobile}}">
                        </div>
                      </div>

                      <div class="col-md-12"></div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertyemail">Email ID <span class="requiredcolor">*</span></label>
                            <input type="email" class="form-control text-lowercase" id="propertyemail" name="propertyemail" placeholder="Enter email id" multiple value="{{$data->propertyemail}}">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertywebsite">Website Name</label>
                            <input type="text" class="form-control text-lowercase" id="propertywebsite" name="link" placeholder="Enter website name" value="{{$data->link}}">
                        </div>
                      </div>

                      <div class="col-md-12"></div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertymaplocation">Map Location</label>
                            <input type="text" class="form-control text-lowercase" id="propertymaplocation" name="propertymaplocation" placeholder="Enter map location" value="{{$data->propertymaplocation}}">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="propertystatus">Status <span class="requiredcolor">*</span></label>
                            <select class="form-control" name="propertystatus" id="propertystatus" required>
                              <option value="" selected disabled>Select</option>
                              <option value="1" @if($data->propertystatus=="1") selected="selected" @endif>Enabled</option>
                              <option value="0" @if($data->propertystatus=="0") selected="selected" @endif>Disabled</option>
                            </select>
                        </div>
                      </div>

                      <div class="col-md-12"></div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="hotel_image">Hotel Image (200 x 200) <span class="requiredcolor">*</span></label>
                          <input type="hidden" name="hotel_image_value" value="{{$data->hotel_image}}">
                          <input type="file" class="form-control appendBottom20" id="hotel_image" name="hotel_image" accept=".jpg, .jpeg, .webp">
                          <span>
                            @if($data->hotel_image!="")
                              <img class="bdrRadius3" width="150" height="100" src="{{ URL::to('/').'/public/uploads/package_hotel/'.$data->hotel_image }}" loading="lazy">
                            @else
                              <img class="bdrRadius3" width="150" height="100" src="{{ URL::to('/').'/public/uploads/package_hotel/default_profile_image.png' }}" loading="lazy">
                            @endif
                          </span>
                          </div>
                        <span class="error">{{ $errors->first("rate")}}</span>
                      </div>

                      <div class="col-md-12"></div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <button type="submit" name="add" id="remove" class="btn btn-sm btn-danger location_add" onclick="return Upload()"><b>Proceed to Update</b> <i class="fa fa-arrow-right"></i></button>
                        </div>
                      </div>

                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="testing">
  <input type="hidden" value="{{url('/')}}" name="" id="test">
</div>

@endsection

@section('custom_js_code')

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src='{{ asset ("/resources/assets/admin-lte/dist/js/select2.js") }}' type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function() {

  // Initialize the select2 for city selection
  $('.quote_city').select2({
    placeholder: "To",
    allowClear: true,
    ajax: {
      url: $("#APP_URL").val() + '/search_city_with_country', // URL to fetch cities
      type: "get",
      dataType: 'json',
      delay: 250, // Delay for the request
      data: function(params) {
        return {
          searchTerm: params.term // Pass the search term
        };
      },
      processResults: function(response) {
        return {
          results: response // Return the results from the server
        };
      },
      cache: true // Enable caching
    }
  });
});

// Event listener for location input changes
$("#location").on("keyup change", function() { 
  var city = $(this).val(); // Get the city input value

  $.ajax({
    type: 'post',
    url: APP_URL + '/city_country_data', // URL to fetch country data
    data: { city: city }, // Send city data
    success: function(data) {
      // Populate the propertycountry select element with the returned data
      $("#propertycountry").html("").html(data);
    },
    error: function(data) {
      // Handle error
      console.log('Error: ' + data);
    }
  });
});

// JavaScript Validation for Height & Width of Image
function Upload() {
  // Get reference to the hotel image input
  var hotel_image = document.getElementById("hotel_image");

  // Check whether the file is a valid image
  var regex = new RegExp("([a-zA-Z0-9\\s_\\.-:])+(.jpg|.jpeg|.webp)$");

  if (regex.test(hotel_image.value.toLowerCase())) {

    // Check whether HTML5 is supported
    if (typeof (hotel_image.files) != "undefined") {

      // Initiate the FileReader object
      var reader = new FileReader();

      // Read the contents of the image file
      reader.readAsDataURL(hotel_image.files[0]);

      reader.onload = function(e) {

        // Initiate the JavaScript Image object
        var image = new Image();

        // Set the Base64 string return from FileReader as source
        image.src = e.target.result;

        // Validate the File Height and Width
        image.onload = function() {
          var height = this.height;
          var width = this.width;
          if (height > 200 || width > 200) {
            alert("Height and Width must not exceed 200px."); // Update message for clarity
            return false;
          }
          alert("Uploaded image has valid Height and Width.");
          return true;
        };
      };
    } else {
      alert("This browser does not support HTML5.");
      return false;
    }
  } else {
    alert("Please upload a valid image file (jpg, jpeg, webP)."); // Alert for invalid file type
  }
}
</script>

@endsection