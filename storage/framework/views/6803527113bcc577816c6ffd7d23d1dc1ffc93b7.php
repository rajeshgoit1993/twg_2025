<?php $__env->startSection("custom_css_code"); ?>

<style type="text/css">
/*list blade*/
.custom_sor .dt-buttons {
	display: none;
}
.search-container {
    padding: 20px 20px 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f2f2f2;
    margin: 10px;
}
.list-item-image {
    width: 125px;
    height: 70px;
    border-radius: 3px;
    overflow: hidden;
    background-color: #f2f2f2;
}
.list-item-image img {
    width: 125px;
    height: 70px;
    object-fit: cover;
}
.btn-action {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
/*table tbody tr td {
    text-align: center;
}*/
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <!-- manage_pacakge -> list -->
                        <h3 class="box-title">Search Tour Package</h3>
                    </div>
                    <div class="search-container makeflex flex-column">
                        <div class="row">
                                <!-- Country Selection -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <select class="form-control addcountry" name="choosecountry">
                                    <!-- <select id="package_country" class="form-control" name="choosecountry"> -->
                                        <option value=''>Select Country</option>
                                        <?php $__currentLoopData = $countries_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                    </div>
                                </div>

                                <!-- State Selection -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <select  class="form-control addstate" name="choosestate">
                                        <option value=''>Select State</option>
                                        <!-- States will be populated based on the selected country -->
                                    </select>
                                    </div>
                                </div>

                                <!-- City Selection -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <select  class="form-control addcity" name="choosecity">
                                    <!-- <select id="city" class="form-control" name="choosecity"> -->
                                        <option value=''>Select City</option>
                                        <!-- Cities will be populated based on the selected state -->
                                    </select>
                                    </div>
                                </div>

                                <!-- Find Package Button -->
                                <div class="col-md-1">
                                    <div class="form-group">
                                    <button class="btn btn-success btn-block find">Search</button>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>
                        </div>
                    </div>

                    <div class="box-header">
                        <h3 class="box-title">Tour Package Management</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body custom_sor">
                        <!-- Success message container -->
                        <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                            <p>Package Deleted Successfully.</p>
                        </div>
                        
                        <!-- Error message container -->
                        <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                            <ul class="error-contaier-hotel" id="error-contaier-hotel"></ul> 
                        </div>

                        <!-- Package table -->
                        <table id="example2" class="table table-bordered table-striped example2">
                            <thead>
                                <tr>
                                    <th width="40" class="text-center">S. No.</th>
                                    <th width="100" class="text-center">Image</th>
                                    <th class="text-center">Package Name</th>

                                    <?php if(Sentinel::check()): ?>
                                        <?php if(Sentinel::getUser()->inRole('administrator') ||
                                            Sentinel::getUser()->inRole('supervisor') ||
                                            Sentinel::getUser()->inRole('super_admin')): ?>
                                            <th width="100" class="text-center">Search Order</th>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <th width="250" class="text-center">Duration & Destination</th>
                                    
                                    <?php if(Sentinel::check()): ?>
                                        <?php if(Sentinel::getUser()->inRole('administrator') ||
                                            Sentinel::getUser()->inRole('supervisor') ||
                                            Sentinel::getUser()->inRole('super_admin')): ?>
                                            <th width="75" class="text-center">Price Update</th>
                                            <th width="45" class="text-center">Image Upload</th>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php if(Sentinel::check()): ?>
                                        <?php if(Sentinel::getUser()->inRole('administrator') ||
                                        Sentinel::getUser()->inRole('super_admin')): ?>
                                            <th width="45" class="text-center">Search Status</th>
                                            <th width="45" class="text-center">Package Status</th>
                                            <th width="45" class="text-center">Home Package Status</th>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <th width="160" class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <?php use App\Helpers\CustomHelpers; $i="1"; ?>
                            <tbody>
                                <!-- data populate from function packagemanagecontroller -> package_lists -->
                            </tbody>
                        </table>
                    </div>

                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js_code"); ?>

<!-- page script -->
<script type="text/javascript">
$(document).ready(function () {
    // Reset dropdowns to their default state on page load
    resetDropdowns();

    // Fetch data
    fetch_datas('change');
});

// Function to reset dropdowns to their default state
function resetDropdowns() {
    $("#country").val(''); // Reset country dropdown
    $("#state").val('');   // Reset state dropdown
    $("#city").val('');    // Reset city dropdown

    // Optionally, trigger change events if necessary
    $("#country").trigger('change');
    $("#state").trigger('change');
    $("#city").trigger('change');
}

// Find package based on country and state
$(document).on("click", ".find", function () {
    // Get the selected country value
    var country = $(".addcountry").val();

    // Check if the country is not selected
    if (country == '' || country == 0) {
        alert('Kindly Select Country');
    } else {
        // Fetch data if a country is selected
        fetch_datas('change');
    }
});

function fetch_datas($statesave) {
    // Get selected values from the country, state, and city dropdowns
    var country = $(".addcountry").val();
    if (country == '' || country == 0) {
        country = ''; // Set default value if no country is selected
    }

    var state = $(".addstate").val();
    if (state == '' || state == 0) {
        state = ''; // Set default value if no state is selected
    }

    var city = $(".addcity").val();
    if (city == '' || city == 0) {
        city = ''; // Set default value if no city is selected
    }

    // Destroy existing DataTable if it is already initialized
    if ($.fn.DataTable.isDataTable('#example2')) {
        $('#example2').DataTable().destroy();
    }

    // Initialize DataTable with new data
    var table = $('#example2').DataTable({
        processing: true,      // Show processing indicator
        serverSide: true,      // Enable server-side processing
        stateSave: $statesave, // Save the state of the table
        ajax: {
            url: "<?php echo e(route('package_lists')); ?>", // URL for fetching data
            data: { country: country, city: city, state: state }, // Send selected values
        },
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false }, // Row index
            { data: 'image', name: 'image' }, // Image column
            { data: 'package_name', name: 'title' }, // Package name
            { data: 'push_to_up', name: 'title'}, // Push to up
            { data: 'duration_and_destination', name: 'country' }, // Destination
            { data: 'price_and_update', name: 'price_update' }, // Supplier name
            { data: 'image_upload', name: 'image_upload' }, // Image upload
            { data: 'search_status', name: 'search_status' }, // Search status
            { data: 'package_status', name: 'package_status' }, // Package status
            { data: 'front_show', name: 'front_show' }, // Front show status
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true // Actions column
            },
        ],
    });
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>