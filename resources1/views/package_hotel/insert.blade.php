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

            <!-- package_hotel -> insert -->
            <div class="box-header" style="padding: 10px 0;">
              <h3 class="box-title">Add Package Hotel</h3>
            </div>
            
            <div class="well">
              <div class="modal-body">
                <form action="{{ URL::to('/store_packagehotel') }}" method="post" enctype="multipart/form-data" >
                  <input type="hidden" name="type" value="Private Tour"/>
                  {{ csrf_field() }}
                  <div class="row">

                    <!-- <div class="col-md-4">
                      <div class="form-group">
                        <label >Continent</label>
                        <select name="Continent" class="form-control" data-placeholder="Select Continent" style="width: 100%;" id="Continent">
                          <option value="AS">Asia</option>
                          <option value="AF">Africa</option>
                          <option value="AN">Antarctica</option>
                          <option value="OC">Australia</option>
                          <option value="EU">Europe</option>
                          <option value="NA">North America</option>
                          <option value="SA">South America</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Country</label>
                        <select name="Country" class="form-control" data-placeholder="Select Country" id="Country"></select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>State</label>
                        <select name="State" class="form-control" data-placeholder="Select State" id="State"></select>
                      </div>
                    </div> -->

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="location">City <span class="requiredcolor">*</span></label>
                        <select class="quote_city form-control" id="location" name="location" required></select>
                        <!-- <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" placeholder="Select City Name" required> -->
                      </div>
                      <span class="error">{{ $errors->first("rate")}}</span>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertycountry">Country <span class="requiredcolor">*</span></label>
                        <select class="form-control" id="propertycountry" name="propertycountry" required>
                          <option value="">Select Country</option>
                        </select>
                        <!-- <input type="text" class="form-control text-capitalize" id="propertycountry" name="propertycountry" placeholder="Enter country name" readonly> -->
                      </div>
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertytype">Accommodation Type <span class="requiredcolor">*</span></label>
                        <select class="form-control" name="propertytype" id="propertytype" required>
                          <option value="" selected disabled>Select</option>
                          <option value="hotel">Hotel</option>
                          <option value="resort">Resort</option>
                          <option value="villa">Villa</option>
                          <option value="home">Home</option>
                          <option value="camp">Camp</option>
                          <option value="cruise">Cruise</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="star_rating">Star Rating <span class="requiredcolor">*</span></label>
                        <select name="star_rating" class="form-control" required>
                          <option value="" selected disabled>Select</option>
                          <option value="1">1 Star</option>
                          <option value="2">2 Star</option>
                          <option value="3">3 Star</option>
                          <option value="4">4 Star</option>
                          <option value="5">5 Star</option>
                        </select>
                      </div>
                      <span class="error">{{ $errors->first("rate")}}</span>
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="hotelname">Name <span class="requiredcolor">*</span></label>
                        <input type="text" class="form-control" id="hotelname" name="hotelname" value="{{ old('hotelname') }}" placeholder="Enter Property Name" required>
                      </div>
                      <span class="error">{{ $errors->first("currency")}}</span>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertyaddress">Address <span class="requiredcolor">*</span></label>
                        <input type="text" class="form-control text-capitalize" name="propertyaddress" id="propertyaddress" placeholder="Enter property address">
                        <!--<textarea class="form-control" name="address" placeholder="Registered Address"></textarea>-->
                      </div>
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertymobile">Mobile No <span class="requiredcolor">*</span></label>
                        <input type="text" class="form-control" id="propertymobile" name="propertymobile" placeholder="Enter Mobile Number" multiple>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertyphone">Phone No</label>
                        <input type="text" class="form-control" id="propertyphone" name="propertyphone" placeholder="Enter Contact Number" multiple>
                      </div>
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertyemail">Email ID <span class="requiredcolor">*</span></label>
                        <input type="email" class="form-control text-lowercase" id="propertyemail" name="propertyemail" placeholder="Enter email id" multiple>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertywebsite">Website Name</label>
                        <input type="text" class="form-control text-lowercase" id="propertywebsite" name="link" placeholder="Enter Website Name">
                      </div>
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertymaplocation">Map Location</label>
                        <input type="text" class="form-control text-lowercase" id="propertymaplocation" name="propertymaplocation" placeholder="Enter map location">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="propertystatus">Status <span class="requiredcolor">*</span></label>
                        <select class="form-control" name="propertystatus" id="propertystatus" required>
                          <option value="" selected disabled>Select</option>
                          <option value="1">Enabled</option>
                          <option value="0">Disabled</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="hotel_image">Hotel Image (200 x 200) <span class="requiredcolor">*</span></label>
                        <input type="file" class="form-control" id="hotel_image" name="hotel_image" value="{{ old('hotel_image') }}" accept=".jpg, .jpeg, .webp">
                      </div>
                      <span class="error">{{ $errors->first("rate")}}</span>
                    </div>

                    <div class="col-md-12"></div>

                    <!-- sumbit -->
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" name="add" id="remove" class="btn btn-sm btn-danger location_add" onclick="return Upload()"><b>Proceed to Save</b> <i class="fa fa-arrow-right"></i></button>
                      </div>
                    </div>

                  </div>
                  
                  <!-- <div class="modal-footer"> -->
                  <!-- <div class="appendBottom20">
                    <button type="submit" name="add" id="remove" class="btn btn-sm btn-info location_add" onclick="return Upload()">SUBMIT</button>
                  </div> -->
                </form>
              </div>
              <!-- </div> -->
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="testing">
  <input type="hidden" value="{{ url('/') }}" name="" id="test">
</div>

@endsection

@section('custom_js_code')

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src='{{ asset ("/resources/assets/admin-lte/dist/js/select2.js") }}'></script>

<script type="text/javascript">

// Initialize Select2 for the 'quote_city' dropdown when the document is ready
$(document).ready(function() {
  
  // Initialize Select2 for the 'City' dropdown with AJAX search functionality
  $('.quote_city').select2({
    placeholder: "To",  // Placeholder text for the dropdown
    allowClear: true,   // Allows the option to clear the selection
    ajax: {
      url: $("#APP_URL").val() + '/search_city_with_country',  // Fetch city data with country via AJAX
      type: "get",
      dataType: 'json',  // Data type expected from the server
      delay: 250,  // Delay to avoid sending requests too frequently
      data: function (params) {
        return {
          searchTerm: params.term  // Send the search term to the server for filtering
        };
      },
      processResults: function (response) {
        return {
          results: response  // Process and return the results to the Select2 dropdown
        };
      },
      cache: true  // Cache the results for efficiency and faster load times
    }
  });

  // Event listener for 'keyup' and 'change' events on the #location input field
  $("#location").on("keyup change", function() {
    // Get the current value of the #location input field
    var city = $(this).val();

    // Make an AJAX POST request to fetch city and country data
    $.ajax({
      type: 'post',  // Use the POST method for the request
      url: APP_URL + '/city_country_data',  // URL to send the request to
      data: { city: city },  // Send the city data as part of the request

      // On successful response, update the #propertycountry element with the new data
      success: function(data) {
        $("#propertycountry").html("").html(data);  // Clear and update the HTML content
      },

      // Handle any errors that occur during the request
      error: function(data) {
        // Optional: You can log the error or display an error message here
        // console.log('Error: ' + data);
      }
    });
  });

  //JavaScript Validation for Height & Width of Image
  function Upload() {
    // Get reference to the hotel_image input element
    var hotel_image = document.getElementById("hotel_image");

    // Regular expression to validate file extensions (jpg, jpeg, webP)
    var regex = new RegExp("([a-zA-Z0-9\\s_\\.-:])+(.jpg|.jpeg|.webp)$");

    // Check whether the selected file is a valid image
    if (regex.test(hotel_image.value.toLowerCase())) {
          
    // Check if HTML5 File API is supported by the browser
    if (typeof (hotel_image.files) != "undefined") {
              
      // Create a FileReader object to read the image
      var reader = new FileReader();
              
      // Read the contents of the image file
      reader.readAsDataURL(hotel_image.files[0]);
              
      // Once the file is loaded, execute this function
      reader.onload = function(e) {
                  
        // Create a new Image object
        var image = new Image();
                  
        // Set the image source to the Base64 string from FileReader
        image.src = e.target.result;
                  
        // Validate the File Height and Width
        image.onload = function() {
          var height = this.height;
          var width = this.width;
                      
          // Check if the image exceeds the maximum allowed dimensions (200x200px)
          if (height > 200 || width > 200) {
            alert("Height and Width must not exceed 200px."); // Update message for clarity
            return false;
          }
          alert("Uploaded image has valid Height and Width.");
            return true;
          };
        };
              
      } else {
        // If the browser does not support HTML5 File API
        alert("This browser does not support HTML5.");
        return false;
      }
    } else {
      // If the selected file is not a valid image type
      alert("Please upload a valid image file (jpg, jpeg, webP)."); // Alert for invalid file type
      return false;
    }
  }
});
</script>

@endsection