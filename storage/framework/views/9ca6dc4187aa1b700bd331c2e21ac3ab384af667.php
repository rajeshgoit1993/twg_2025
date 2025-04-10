<?php $__env->startSection("custom_css_code"); ?>

<style type="text/css">
.search-container {
    padding: 20px 20px 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f2f2f2;
    margin: 10px;
}
.typeImage {
    border: 1px solid #ccc;
    width: 100px;
    height: 75px;
    overflow: hidden;
    border-radius: 5px;
    background-color: #f2f2f2;
}
.typeImage img {
    width: 100px;
    height: 75px;
    object-fit: cover;
}
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
                        <!-- package_hotel -> index -->
                        <h3 class="box-title">Tour Hotels</h3>
                    </div>

                    <div class="search-container makeflex flex-column">
                        <div class="row">
                            <!-- Country Selection -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select id="country" class="form-control addcountry" name="choosecountry">
                                        <option value=''>Select Country</option>
                                        <?php $__currentLoopData = $hotels_countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        
                                            <option value="<?php echo e($col); ?>"><?php echo e(CustomHelpers::get_master_table_data('countries', 'id', (int)$col, 'name')); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <!-- State Selection -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select id="state" class="form-control addstate" name="choosestate">
                                        <option value=''>Select State</option>
                                        <!-- States will be populated based on the selected country -->
                                    </select>
                                </div>
                            </div>

                            <!-- City Selection -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select id="city" class="form-control addcity" name="choosecity">
                                        <option value=''>Select City</option>
                                        <!-- Cities will be populated based on the selected state -->
                                    </select>
                                </div>
                            </div>

                            <!-- Find Hotel Button -->
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block find">Search</button>
                                </div>
                            </div>

                            <div class="col-md-12"></div>

                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                            <p>Package Hotel Deleted Successfully.</p>
                        </div>
                        <div class="alert alert-danger error-contaier-parenterror-contaier-parent-hotel" style="display:none">
                            <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
                        </div>

                        <table  id="example2" class="table table-bordered table-striped example2">

                            <?php if(Sentinel::check()): ?>
                                <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                                <div class="add">
                                    <a href="<?php echo e(route('packageHotel')); ?>" class="btn btn-success">
                                        <i class="glyphicon glyphicon-plus-sign"></i> Add Package Hotel
                                    </a>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Property Name</th>
                                    <th>Thumb Image</th>
                                    <th>Property Location</th>
                                    <th>Property Type</th>
                                    <th>Property Rating</th>
                                    <th>Image Upload</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- populate from PackageHotelController -> package_hotels -->
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

<script type="text/javascript">
// Trigger AJAX request on change of the .addcountry dropdown
$(document).on("change", ".addcountry", function () {
    var addcountry = $(this).val();

    // Make an AJAX request to fetch cities based on selected country
    $.ajax({
        type: 'get',
        url: APP_URL + '/add_hotel_country',
        // Send selected country in the request
        data: { addcountry: addcountry },
        success: function (data) {
            // Update the .addcity dropdown with the fetched cities
            $(".addcity").html('').html(data);
        },
        error: function (data) {
            // Log the error (if any) for debugging
            // console.log('Error : ' + data);
        }
    });
});

// Fetch initial data on page load
$(document).ready(function () {
    fetch_datas('change');
});

// Trigger data fetch when the "Find" button is clicked
$(document).on("click", ".find", function () {
    var country = $("#country").val();
        
    // Check if the country is selected
    if (country == '') {
        alert('Kindly select sountry');
    } else {
        // Fetch data if country is selected
        fetch_datas('change');
    }
});

// Function to fetch data with country and city filters
function fetch_datas($statesave) {
    var country = $("#country").val();
    var city = $("#city").val();

    // Set default value if country is not selected
    if (country == '' || country == 0) {
        var country = 'NA';
    }

    // Set default value if city is not selected
    if (city == '' || city == 0) {
        var city = 'NA';
    }

    // Destroy the existing DataTable if it already exists
    if ($.fn.DataTable.isDataTable('#example2')) {
        $('#example2').DataTable().destroy();
    }

    // Initialize DataTable with server-side processing and state saving
    var table = $('#example2').DataTable({
        processing: true,
        serverSide: true,
        stateSave: $statesave,
        ajax: {
            url: "<?php echo e(route('package_hotels')); ?>", // Server route for fetching data
            data: { country: country, city: city }, // Send country and city as filters
        },
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false }, // Index column
            { data: 'hotel_name', name: 'hotel_name' }, // Hotel name column
            { data: 'image', name: 'image' }, // Hotel image column
            { data: 'location', name: 'location' }, // Hotel location column
            { data: 'propertytype', name: 'propertytype' }, // Property type column
            { data: 'rating', name: 'rating' }, // Star rating column
            { data: 'gallery', name: 'gallery' }, // Hotel gallery column
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true // Edit and delete action buttons
            },
        ],
    });
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>