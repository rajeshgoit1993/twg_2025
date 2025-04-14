@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            <div class="col-md-12">                
                <div class="box">                    
                    <!-- Box Header with Title -->
                    <div class="box-header">
                        <h3 class="box-title">Tour Destination</h3>
                    </div>
                    <!-- /.box-header -->
                    
                    <div class="box-body">                        
                        <!-- Success Alert for Session Messages -->
                        @if(Session::has('success'))
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        
                        <!-- Destination Table -->
                        <table class="table table-bordered table-striped">
                            
                            <!-- Row for Add New Destination Button and Search Field -->
                            <div class="row">                                
                                <!-- Add New Destination Button -->
                                <div class="col-md-8">
                                    @if(Sentinel::check())
                                        @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
                                            <div class="add">
                                                <a href="{{ URL::to('/package-locations-create') }}" class="btn btn-success">
                                                    <i class="glyphicon glyphicon-plus-sign"></i> Add New Destination
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                
                                <!-- Search Field -->
                                <div class="col-md-4">
                                    <input type="text" id="location_searchs" class="form-control" placeholder="Search... By City or Country">
                                </div>                                
                            </div>
                            
                            <!-- Table Head -->
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <!-- <th>#</th> -->
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Currency</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            <!-- PHP Counter for Serial Numbers -->
                            <?php $count = "1"; ?>
                            
                            <!-- Table Body -->
                            <tbody id="location_dynamic_data">
                              @foreach($locations as $key => $loc)
                                <tr>
                                  <td>{{ $count++ }}</td>
                                 <td>{{ $loc->country_list->name ?? $loc->country . '(old)' }}</td>
<td>{{ $loc->state_list->name ?? $loc->state . '(old)' }}</td>
<td>{{ $loc->city_list->name ?? $loc->location . '(old)' }}</td>
                                  <td>{{ $loc->currency }}</td>
                                        
                                  <!-- Status Toggle Button -->
                                  <!-- <td>
                                    @if($loc->status == 1)
                                      <button type="button" class="btn btn-success location_btn_enable" value="{{ $loc->id }}">Disable</button>
                                    @else
                                      <button type="button" class="btn btn-danger location_btn_enable" value="{{ $loc->id }}">Enable</button>
                                    @endif
                                    </td> -->

                                    <td>
                                      @if($loc->status == 1)
                                        <button type="button" class="btn btn-sm btn-success location_btn_enable" value="{{ $loc->id }}">Enabled</button>
                                      @else
                                        <button type="button" class="btn btn-sm btn-danger location_btn_enable" value="{{ $loc->id }}">Disabled</button>
                                      @endif
                                    </td>
                                        
                                    <!-- Action Buttons (Edit/Delete) -->
                                    <td>
                                      @if(Sentinel::check())
                                      @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
                                        <!-- Delete Form -->
                                        <form action="{{ URL::to('/location-delete') }}" id="packagedel{{ $loc->id }}" method="POST">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="id" value="{{ $loc->id }}"/>
                                        </form>
                                      @endif
                                      @endif
                                            
                                      <!-- Button Group for Edit/Delete -->
                                      <span>
                                        <!-- Edit Button -->
                                        <a href="{{ URL::to('/package-locations-edit/' . $loc->id) }}">
                                            <button class="btn btn-sm btn-warning">Edit</button>
                                        </a>

                                        <!-- Delete Button -->
                                        @if(Sentinel::check())
                                        @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
                                          <button id="packagedel{{ $loc->id }}" class="btn btn-sm btn-danger deletePackage">Delete</button>
                                        @endif
                                        @endif
                                      </span>
                                    </td>
                                  </tr>
                                @endforeach
                                
                                <!-- Pagination Row -->
                                <tr>
                                    <td colspan="7">
                                        <div class="location_list_paginate text-center">
                                            {{ $locations->links() }}
                                        </div>
                                    </td>
                                </tr>                                
                            </tbody>                            
                        </table>
                        <!-- /.table -->                        
                    </div>
                    <!-- /.box-body -->
                    
                </div>                
            </div>
        </div>
        
    </section>
    <!-- /.content -->
    
</div>
<!-- /.content-wrapper -->

@endsection

@section("custom_js_code")

<script type="text/javascript">

// Handle delete button click event
$(document).on("click", ".deletePackage", function(e) {
  e.preventDefault(); // Prevent default action

  // Confirm the user's choice
  var user_choice = window.confirm('Would you like to continue?');
  var delete_id = $(this).attr("id"); // Get the ID of the button

  // If the user confirms, submit the delete form
  if (user_choice == true) {
    document.getElementById(delete_id).submit();
  } else {
    return false; // If not, do nothing
  }
});

// Handle pagination click event
$(document).on("click", ".location_list_paginate .pagination a", function(e) {
  e.preventDefault(); // Prevent default pagination behavior

  // Extract the page number from the URL
  var page = $(this).attr('href').split('page=')[1];
  fetch_datas(page); // Fetch data for the clicked page
});

// Fetch paginated data function
function fetch_datas(page) {
  // Show loading animation
  $("#location_dynamic_data").html("").html('<div class="loading"></div>');
       
  var APP_URL = $('#baseurl').val(); // Get the base URL
  var key = $("#location_searchs").val(); // Get the search input value
     
  // Send AJAX request to fetch filtered data
  $.ajax({
    type: 'get',
    url: APP_URL + "/location_list_filter_data?page=" + page,
    data: { key: key },
    cache: false,          
    success: function(data) {
      $("#location_dynamic_data").html("").html(data); // Update the table data with the result
    },
    error: function() {
      // Handle error case (optional)
    }
  });
}

// Handle search field input event
$(document).on("keyup", "#location_searchs", function() {
  fetch_data(); // Call fetch_data when a key is pressed in the search field
});

// Fetch data function (for search input)
function fetch_data() {
  // Show loading animation
  $("#location_dynamic_data").html("").html('<div class="loading"></div>');
       
  var APP_URL = $('#baseurl').val(); // Get the base URL
  var key = $("#location_searchs").val(); // Get the search input value

  // Send AJAX request to fetch filtered data
  $.ajax({
    type: 'get',
    url: APP_URL + "/location_list_filter_data",
    data: { key: key },
    cache: false,       
    success: function(data) {
      $("#location_dynamic_data").html("").html(data); // Update the table data with the result
    },
    error: function() {
      // Handle error case (optional)
    }
  });
}

</script>

@endsection