@extends('layouts.master')

@section('custom_css_code')

<style>
.link-web-container {
	padding: 20px;
	border-radius: 5px;
	box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
	border: 1px solid #e9e9e9;
}
</style>

<!-- custom select2 css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/backend/css/select2-css.css') }}" />

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					
					@if (Session::has('message'))
						<div class="alert alert-info">{{ Session::get('message') }}</div>
					@endif

					<div class="box-body">
						<a href="{{ route('themeList') }}" class="btn btn-success">
							<i class="glyphicon glyphicon-arrow-left"> </i> Back
						</a>

						<div class="box-header">
							<h3 class="box-title">Edit Theme</h3>
						</div>
						<div class="well">
							<div class="modal-body">
								<form action="{{ route('updateTheme', $data_value->id) }}" method="POST">
									<input type="hidden" name="type" value="Private Tour"/>
									{{csrf_field()}}
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="">Select Theme</label>
												<select class="form-control" name="theme_name">
													@foreach($data as $typ)
													<option value="{{$typ->name}}" @if($data_value->theme_name == $typ->name) selected="selected" @endif>{{$typ->name}}</option>
													@endforeach
												</select>
												<span class="error">{{ $errors->first("theme_name")}}</span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="">Select Image(1920*350)</label>
												<input type="file" class="form-control" id="theme_image"  name="theme_image" value="{{$data_value->theme_image}}" accept=".jpg, .jpeg, .png, .webp">

												<img class="apndTop5 bdrRadius3" src="{{URL::to('/').'/public/uploads/theme/'.$data_value->theme_image }}" width="100" height="50" loading="lazy">
												<input type="hidden" name="theme_image_value" value="{{$data_value->theme_image}}">
												<span class="error">{{ $errors->first("theme_image")}}</span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="">Content 1</label>
												<input type="text" name="theme_para1" class="form-control" placeholder="Enter Content 1" value="{{ $data_value->theme_para1 }}">
												<span class="error">{{ $errors->first("theme_para1")}}</span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="">Content 2</label>
												<input type="text" name="theme_para2" class="form-control" placeholder="Enter Content 2" value="{{ $data_value->theme_para2 }}">
												<span class="error">{{ $errors->first("theme_para2")}}</span>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="">About (Front End)</label>
												<textarea class="form-control ckeditor" rows="5" placeholder="Enter About Theme(Front End)" name="about_theme">{{ $data_value->about_theme }}</textarea>
												<span class="error">{{ $errors->first("about_theme")}}</span>
											</div>
										</div>

										@if(Sentinel::check())
										@if(Sentinel::getUser()->inRole('super_admin'))
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="">Title (SEO)</label>
												<input type="text" name="theme_title" class="form-control" placeholder="Enter Theme Title(SEO)" value="{{ $data_value->title }}">
												<span class="error">{{ $errors->first("theme_title")}}</span>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="">Keywords (SEO)</label>
												<input type="text" name="theme_key" class="form-control" placeholder="Enter Theme Key(SEO)" value="{{ $data_value->theme_key }}">
												<span class="error">{{ $errors->first("theme_key")}}</span>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="">Description (SEO)</label>
												<textarea class="form-control" name="theme_desc" placeholder="Enter Theme Description(SEO)" rows="4">{{ $data_value->theme_desc }}</textarea>
												<span class="error">{{ $errors->first("theme_desc")}}</span>
											</div>
										</div>
										@endif
										@endif

										<div class="col-md-12">
											<div class="form-group link-web-container">
											<div id="add_dynamic" class="add_dynamic">
											@if($data_value->destination_theme_link!='')
											<?php
												$dynamic_details=unserialize($data_value->destination_theme_link);
												$a=0;
												$b=1;
											?>
											@foreach($dynamic_details as $rows=>$col)
												@if($b>1)
													<div id="thirdrow{{$b}}">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label for="" class="required">Destination</label>
																	<select class="select_theme_add_destination form-control" name="dynamic[{{$a}}][destination]" required>
																		<option value="{{$col['destination']}}" selected>{{$col["destination"]}}</option>
																	</select>
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="" class="required">Theme</label>
																	<select class="select_theme_type form-control" name="dynamic[{{$a}}][theme]" required>
																		<option value="{{$col['theme']}}" selected>{{$col["theme"]}}</option>
																	</select>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="" class="required">Link</label>
																	<input type="text" name="dynamic[{{$a}}][link]" value="{{$col['link']}}" class="form-control" placeholder="Link">
																</div>
															</div>

															<div class="col-md-1">
																<label for="" class="required" style="visibility:hidden">Share</label>
																<button type="button" name="remove" id="{{$b}}" class="btn btn-danger btn_remove_third" style="display:block">Remove</button>
															</div>
														</div>
													</div>
												@else
													<div id="thirdrow{{$b}}">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label for="" class="required">Destination</label>
																	<select class="select_theme_add_destination form-control" name="dynamic[{{$a}}][destination]" required>
																		<option value="{{$col['destination']}}" selected>{{$col["destination"]}}</option>
																	</select>
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="" class="required">Theme</label>
																	<select class="select_theme_type form-control" name="dynamic[{{$a}}][theme]" required>
																		<option value="{{$col['theme']}}" selected>{{$col["theme"]}}</option>
																	</select>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="" class="required">Link</label>
																	<input type="text" name="dynamic[{{$a}}][link]" value="{{$col['link']}}" class="form-control" placeholder="Link">
																</div>
															</div>
														</div>
													</div>
												@endif
											<?php
												$a++;
												$b++;
											?>
											@endforeach
											@else
												<div id="thirdrow1">
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label for="" class="required">Destination</label>
																<select class="select_theme_add_destination form-control" name="dynamic[0][destination]" required></select>
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="" class="required">Theme</label>
																<select class="select_theme_type form-control" name="dynamic[0][theme]" required></select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="" class="required">Link</label>
																<input type="text" name="dynamic[0][link]" class="form-control" placeholder="Link">
															</div>
														</div>
													</div>
												</div>
											@endif
											</div>
											<button id="add_more" class="btn btn-success btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Add More</button>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" name="add" id="remove" class="btn btn-sm btn-danger"><b>Proceed to Update</b> <i class="fa fa-arrow-right"></i></button>
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
</div>

@endsection

@section('custom_js_code_second')

<script type="text/javascript">
$(document).ready(function() {

    // Initialize the select2 dropdown for selecting destination
    $('.select_theme_add_destination').select2({
        placeholder: "To", // Placeholder text for the select dropdown
        allowClear: true,  // Allow clearing of the selection
        ajax: {
            url: $("#APP_URL").val() + '/search-destination', // AJAX URL to fetch destination data
            type: "get",       // HTTP method type (GET request)
            dataType: 'json',  // Data type expected from the server (JSON format)
            delay: 250,        // Delay in milliseconds before processing the request (for debouncing)
            data: function(params) {
                return {
                    searchTerm: params.term // Search term entered by the user
                };
            },
            processResults: function(response) {
                return {
                    results: response // Processing and returning the server's response as results
                };
            },
            cache: true // Enable caching of the results for efficiency
        }
    });

    // Initialize the select2 dropdown for selecting theme
    $('.select_theme_type').select2({
        placeholder: "Theme",  // Placeholder text for the select dropdown
        allowClear: true,      // Allow clearing of the selection
        ajax: {
            url: $("#APP_URL").val() + '/select_theme_type', // AJAX URL to fetch theme data
            type: "get",         // HTTP method type (GET request)
            dataType: 'json',    // Data type expected from the server (JSON format)
            delay: 250,          // Delay in milliseconds before processing the request (for debouncing)
            data: function(params) {
                return {
                    searchTerm: params.term // Search term entered by the user
                };
            },
            processResults: function(response) {
                return {
                    results: response // Processing and returning the server's response as results
                };
            },
            cache: true // Enable caching of the results for efficiency
        }
    });



	// Add more rows dynamically when the 'Add More' button is clicked
	$('#add_more').click(function(e) {
	    e.preventDefault(); // Prevent the default form submission behavior
	    
	    // Get the last dynamically added div's ID and extract the count value
	    var name_count1 = $(".add_dynamic").children("div:last").attr("id").slice(8);
	    var name_count = parseInt(name_count1) - 1;
	    name_count1++;  // Increment the count for new ID
	    name_count++;   // Increment the count for new name attribute

	    // Append a new dynamic row with select2 fields for destination and theme
	    $(".add_dynamic").append(
	        '<div id="thirdrow' + name_count1 + '">' +
	            '<div class="row">' +
	                '<div class="col-md-4">' +
	                    '<div class="form-group">' +
	                        '<label for="" class="required">Destination</label>' +
	                        '<select class="select_theme_add_destination form-control" name="dynamic[' + name_count + '][destination]"></select>' +
	                    '</div>' +
	                '</div>' +
	                '<div class="col-md-4">' +
	                    '<div class="form-group">' +
	                        '<label for="" class="">Theme</label>' +
	                        '<select class="select_theme_type form-control" name="dynamic[' + name_count + '][theme]"></select>' +
	                    '</div>' +
	                '</div>' +
	                '<div class="col-md-3">' +
	                    '<div class="form-group">' +
	                        '<label for="" class="required">Link</label>' +
	                        '<input type="text" name="dynamic[' + name_count + '][link]" class="form-control" placeholder="Link">' +
	                    '</div>' +
	                '</div>' +
	                '<div class="col-md-1">' +
	                    '<label for="" class="required" style="visibility:hidden">Share</label>' +
	                    '<button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_third" style="display:block">Remove</button>' +
	                '</div>' +
	            '</div>' +
	        '</div>'
	    );

	    // Reinitialize the select2 plugin for the new dynamically added destination field
	    $('.select_theme_add_destination').select2({
	        placeholder: "To", // Placeholder text for the select dropdown
	        allowClear: true,  // Allow clearing the selection
	        ajax: {
	            url: $("#APP_URL").val() + '/search-destination', // AJAX URL to fetch destination data
	            type: "get",      // HTTP method type (GET request)
	            dataType: 'json', // Expected response data type (JSON format)
	            delay: 250,       // Delay before making the request (debouncing)
	            data: function(params) {
	                return {
	                    searchTerm: params.term // User's input search term
	                };
	            },
	            processResults: function(response) {
	                return {
	                    results: response // Return the search results
	                };
	            },
	            cache: true // Enable caching for better performance
	        }
	    });

	    // Reinitialize the select2 plugin for the new dynamically added theme field
	    $('.select_theme_type').select2({
	        placeholder: "Theme", // Placeholder text for the select dropdown
	        allowClear: true,     // Allow clearing the selection
	        ajax: {
	            url: $("#APP_URL").val() + '/select_theme_type', // AJAX URL to fetch theme data
	            type: "get",       // HTTP method type (GET request)
	            dataType: 'json',  // Expected response data type (JSON format)
	            delay: 250,        // Delay before making the request (debouncing)
	            data: function(params) {
	                return {
	                    searchTerm: params.term // User's input search term
	                };
	            },
	            processResults: function(response) {
	                return {
	                    results: response // Return the search results
	                };
	            },
	            cache: true // Enable caching for better performance
	        }
	    });
	});


	// Event delegation for dynamically added elements with the class 'btn_remove_third'
	$(document).on('click', '.btn_remove_third', function() {
	    // Get the ID of the clicked button
	    var button_id = $(this).attr("id");
	    
	    // Remove the parent div with the ID 'thirdrow' followed by the button's ID
	    $('#thirdrow' + button_id).remove();
	});

});
</script>

@endsection