<?php $__env->startSection('custom_css_code'); ?>

<style>
.link-web-container {
	padding: 20px;
	border-radius: 5px;
	box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
	border: 1px solid #e9e9e9;
}
</style>

<!-- custom select2 css -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/backend/css/select2-css.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">

					<?php if(Session::has('message')): ?>
						<div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
					<?php endif; ?>

					<div class="box-body">
						<a href="<?php echo e(route('themeList')); ?>" class="btn btn-success">
							<i class="glyphicon glyphicon-arrow-left"></i> Back
						</a>
						<br><br>

						<div class="box-header" style="padding: 10px 0;">
							<h3 class="box-title">Add New Theme</h3>
						</div>
						<div class="well">
							<div class="modal-body">
								<form action="<?php echo e(route('saveTheme')); ?>" method="post" enctype="multipart/form-data">
									<input type="hidden" name="type" value="Private Tour"/>
									<?php echo e(csrf_field()); ?>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="themeName" class="control-label">Select Theme</label>
												<select class="form-control" name="theme_name" id="themeName">
													<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typ): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($typ->name); ?>"><?php echo e($typ->name); ?>  </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</select>
												<span class="error"><?php echo e($errors->first("theme_name")); ?></span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="themeImage" class="control-label">Choose Image(1920*350)</label>
												<input type="file" name="theme_image" class="form-control" id="themeImage" accept=".jpg, .jpeg, .png, .webp">
												<span class="error"><?php echo e($errors->first("theme_image")); ?></span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="themePara1" class="control-label">Content 1</label>
												<input type="text" name="theme_para1" class="form-control" id="themePara1" placeholder="Enter Content 1" value="<?php echo e(old('theme_para1')); ?>">
												<span class="error"><?php echo e($errors->first("theme_para1")); ?></span>
											</div>	
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="themePara2" class="control-label">Content 2</label>
												<input type="text" name="theme_para2" class="form-control" id="themePara2" placeholder="Enter Content 2" value="<?php echo e(old('theme_para2')); ?>">
												<span class="error"><?php echo e($errors->first("theme_para2")); ?></span>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="themeAbout" class="control-label">About (Front End)</label>
												<textarea class="form-control ckeditor" name="about_theme" id="themeAbout" placeholder="Enter About Theme(Front End)" ><?php echo e(old('about_theme')); ?></textarea>
												<span class="error"><?php echo e($errors->first("about_theme")); ?></span>
											</div>
										</div>

										<?php if(Sentinel::check()): ?>
											<?php if(Sentinel::getUser()->inRole('super_admin')): ?>
											<div class="col-md-12">
												<div class="form-group">
													<label for="thmeTitle" class="control-label">Title (SEO)</label>
													<input type="text" name="theme_title" class="form-control" id="thmeTitle" placeholder="Enter Theme Title(SEO)" value="<?php echo e(old('theme_title')); ?>">
													<span class="error"><?php echo e($errors->first("theme_title")); ?></span>
												</div>							
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="themeKeywords" class="control-label">Keywords (SEO)</label>
													<input type="text" name="theme_key" class="form-control" id="themeKeywords" placeholder="Enter Theme Key(SEO)" value="<?php echo e(old('theme_key')); ?>">
													<span class="error"><?php echo e($errors->first("theme_key")); ?></span>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="themeDesc" class="control-label">Description (SEO)</label>
													<textarea class="form-control" name="theme_desc" id="themeDesc" placeholder="Enter Theme Description(SEO)" rows="4"><?php echo e(old('theme_desc')); ?></textarea>
													<span class="error"><?php echo e($errors->first("theme_desc")); ?></span>
												</div>
											</div>
											<?php endif; ?>
										<?php endif; ?>

										<div class="col-md-12">
											<div class="form-group link-web-container">
												<div id="add_dynamic" class="add_dynamic">
													<div id="thirdrow1">
														<div class="row">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="themeDestination" class="required">Destination</label>
																	<select class="select_theme_add_destination form-control" name="dynamic[0][destination]" id="themeDestination" required></select>
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="themeType" class="required">Theme</label>
																	<select class="select_theme_type form-control" name="dynamic[0][theme]" id="themeType" required></select>
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="packageLink" class="required">Link</label>
																	<input type="text" name="dynamic[0][link]" class="form-control" id="packageLink" placeholder="Link">
																</div>
															</div>
														</div>
													</div>
												</div>
												<button id="add_more" class="btn btn-sm btn-success" style="margin-top: 5px"><span class="fa fa-plus"></span> Add More</button>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" name="add" id="remove" class="btn btn-sm btn-danger"><b>Proceed to Save</b> <i class="fa fa-arrow-right"></i></button>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code_second'); ?>

<script type="text/javascript">

// Initialize Select2 for the 'Destination' and 'Theme' dropdowns when the document is ready
$(document).ready(function() {
    // Initialize Select2 for the 'Destination' dropdown
    $('.select_theme_add_destination').select2({
        placeholder: "To",  // Placeholder text
        allowClear: true,   // Allows clearing the selected option
        ajax: {
            url: $("#APP_URL").val() + '/search-destination',  // Fetch destination data via AJAX
            type: "get",
            dataType: 'json',
            delay: 250,  // Delay to avoid multiple rapid requests
            data: function (params) {
                return {
                    searchTerm: params.term  // Send the search term to the server
                };
            },
            processResults: function (response) {
                return {
                    results: response  // Process and return the results to the Select2 dropdown
                };
            },
            cache: true  // Cache the results for performance optimization
        }
    });

    // Initialize Select2 for the 'Theme' dropdown
    $('.select_theme_type').select2({
        placeholder: "Theme",  // Placeholder text
        allowClear: true,   // Allows clearing the selected option
        ajax: {
            url: $("#APP_URL").val() + '/select_theme_type',  // Fetch theme data via AJAX
            type: "get",
            dataType: 'json',
            delay: 250,  // Delay to avoid multiple rapid requests
            data: function (params) {
                return {
                    searchTerm: params.term  // Send the search term to the server
                };
            },
            processResults: function (response) {
                return {
                    results: response  // Process and return the results to the Select2 dropdown
                };
            },
            cache: true  // Cache the results for performance optimization
        }
    });
});

// Add more rows dynamically when the 'Add More' button is clicked
$('#add_more').click(function(e) {
    e.preventDefault();  // Prevent the default form submission behavior
    
    // Get the last dynamic row's ID, extract the count, and increment it for the new row
    var name_count1 = $(".add_dynamic").children("div:last").attr("id").slice(8);
    var name_count = parseInt(name_count1) - 1;
    name_count1++;
    name_count++;
    
    // Append a new row with dynamic destination, theme, and link inputs, and a remove button
    $(".add_dynamic").append(
        '<div id="thirdrow' + name_count1 + '">' +
            '<div class="row">' +
                // Destination field
                '<div class="col-md-4">' +
                    '<div class="form-group">' +
                        '<label for="" class="required">Destination</label>' +
                        '<select class="select_theme_add_destination form-control" name="dynamic[' + name_count + '][destination]"></select>' +
                    '</div>' +
                '</div>' +
                
                // Theme field
                '<div class="col-md-4">' +
                    '<div class="form-group">' +
                        '<label for="" class="">Theme</label>' +
                        '<select class="select_theme_type form-control" name="dynamic[' + name_count + '][theme]"></select>' +
                    '</div>' +
                '</div>' +
                
                // Link input
                '<div class="col-md-3">' +
                    '<div class="form-group">' +
                        '<label for="" class="required">Link</label>' +
                        '<input type="text" name="dynamic[' + name_count + '][link]" class="form-control" placeholder="Link">' +
                    '</div>' +
                '</div>' +
                
                // Remove button
                '<div class="col-md-1">' +
                    '<label for="" class="required" style="visibility:hidden">Share</label>' +
                    '<button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_third" style="display:block">- Remove</button>' +
                '</div>' +
            '</div>' +
        '</div>'
    );
    
    // Initialize Select2 for the new 'Destination' dropdown
    $('.select_theme_add_destination').select2({
        placeholder: "To",
        allowClear: true,
        ajax: {
            url: $("#APP_URL").val() + '/search-destination',  // Fetch destination data via AJAX
            type: "get",
            dataType: 'json',
            delay: 250,  // Delay to prevent spamming the server
            data: function (params) {
                return {
                    searchTerm: params.term  // Send the search term to the server
                };
            },
            processResults: function (response) {
                return {
                    results: response  // Process and display the search results
                };
            },
            cache: true  // Cache the results for efficiency
        }
    });

    // Initialize Select2 for the new 'Theme' dropdown
    $('.select_theme_type').select2({
        placeholder: "Theme",
        allowClear: true,
        ajax: {
            url: $("#APP_URL").val() + '/select_theme_type',  // Fetch theme data via AJAX
            type: "get",
            dataType: 'json',
            delay: 250,  // Delay to prevent spamming the server
            data: function (params) {
                return {
                    searchTerm: params.term  // Send the search term to the server
                };
            },
            processResults: function (response) {
                return {
                    results: response  // Process and display the search results
                };
            },
            cache: true  // Cache the results for efficiency
        }
    });
});

// Event listener to remove a dynamically added row when the 'Remove' button is clicked
$(document).on('click', '.btn_remove_third', function() {
    // Get the ID of the button that was clicked
    var button_id = $(this).attr("id");
    
    // Remove the corresponding row with the matching ID
    $('#thirdrow' + button_id).remove();
});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>