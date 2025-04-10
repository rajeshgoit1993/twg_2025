<?php $__env->startSection("custom_css_code"); ?>

<style>
.search-container {
    padding: 20px 20px 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f2f2f2;
    margin: 10px;
}
.loading {
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    width: 100px;
    color: #000;
    margin: auto;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    padding-top: 20px;
}
.loading span {
    position: absolute;
    height: 10px;
    width: 84px;
    top: 50px;
    overflow: hidden;
}
.loading span > i {
    position: absolute;
    height: 4px;
    width: 4px;
    border-radius: 50%;
    -webkit-animation: wait 4s infinite;
    -moz-animation: wait 4s infinite;
    -o-animation: wait 4s infinite;
    animation: wait 4s infinite;
}
.loading span > i:nth-of-type(1) {
    left: -28px;
    background: yellow;
}
.loading span > i:nth-of-type(2) {
    left: -21px;
    -webkit-animation-delay: 0.8s;
    animation-delay: 0.8s;
    background: lightgreen;
}

@-webkit-keyframes wait {
    0%   { left: -7px  }
    30%  { left: 52px  }
    60%  { left: 22px  }
    100% { left: 100px }
}
@-moz-keyframes wait {
    0%   { left: -7px  }
    30%  { left: 52px  }
    60%  { left: 22px  }
    100% { left: 100px }
}
@-o-keyframes wait {
    0%   { left: -7px  }
    30%  { left: 52px  }
    60%  { left: 22px  }
    100% { left: 100px }
}
@keyframes  wait {
    0%   { left: -7px  }
    30%  { left: 52px  }
    60%  { left: 22px  }
    100% { left: 100px }
}

/*modal*/
.modal-body {
    position: relative;
    padding: 15px 25px;
}
@media (min-width: 768px) {
    .modal-dialog {
        width: 800px;
    }
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
                		<h3 class="box-title">Sent Items (Supplier)</h3>
                	</div>
                    
                    <!-- Supplier Filter Section -->
                    <div class="search-container makeflex flex-column">
                        <div class="row">
                            <!-- Supplier Dropdown -->
                            <div class="col-md-4">
                            	<div class="form-group">
	                                <label>Select supplier from list</label>
	                                <select id="supplier_email" class="form-control" name="supplier_email">
	                                    <option value='0'>All</option>
	                                    <?php $__currentLoopData = $supplierdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	                                        <option value="<?php echo e($supplier->supplierprimaryemail); ?>"><?php echo e($supplier->suppliercompanyname); ?></option>
	                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	                                </select>
	                            </div>
                            </div>
                            
                            <!-- Find Data Button -->
                            <div class="col-md-2">
                            	<div class="form-group">
	                                <label style="visibility: hidden;">NA</label>
	                                <button class="btn btn-success btn-block find">Search</button>
	                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Box Body -->
                    <div class="box-body">
                        <!-- Success Message Alert -->
                        <?php if(session()->has('success')): ?>
                            <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel">
                                <p><?php echo e(session()->get('success')); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Header Section -->
                        <!-- <div class="row makeflex aligncenter form-group">
                            <div class="col-md-6">
                                <h4 class="box-title">Supplier</h4>
                            </div>
                        </div> -->
                        
                        <!-- Supplier Email Table -->
                        <table id="example2" class="table table-bordered table-striped example2">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Reference No</th>
                                    <th>To</th>
                                    <th>Cc</th>
                                    <th>Bcc</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Content from supplier controller get_supplier_email_list -->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <!-- View Details Modal -->
        <div class="modal fade" id="view_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="border-radius: 5px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <input type="hidden" id="bookId">
                        <h4 class="modal-title">View Details</h4>
                    </div>
                    <div class="modal-body view_modal_body">
                    	<!-- content from supplier controller -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Modal -->
        <div class="modal fade" id="loding_modal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="min-height: 80px;">
                    <div class="modal-body custom_border" id="modal-body" style="font-size: 15px; line-height: 24px;">
                        <div class="loading">
                            <p>Please wait</p>
                            <span><i></i><i></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>



<div class="testing">
<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
</div>
<!-- /.content-wrapper -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--Swal-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection("custom_js_code"); ?>
<script type="text/javascript">
/*$(document).on("click",".view",function(){
	$('#loding_modal').modal('show');
	var id=$(this).attr('id')
		$.ajax({
			type:'get',
			url: APP_URL+'/view_supplier_email',
			// dataType: 'json',
			data: {id:id},
			success:function(data){
			$('#loding_modal').modal('hide');
				$(".view_modal_body").empty();
				$(".view_modal_body").append(data)
				$('#view_modal').modal('show');
				},
			error: function (data) {
				//console.log('Error : '+data);
				}
			});
});*/

// Event listener for the "view" button click
$(document).on("click", ".view", function () {
    // Show loading modal while fetching data
    $('#loding_modal').modal('show');

    // Get the ID attribute of the clicked element
    var id = $(this).attr('id');

    // Perform AJAX request to fetch supplier email details
    $.ajax({
        type: 'GET', // Use GET request
        url: APP_URL + '/view_supplier_email', // API endpoint
        data: { id: id }, // Send the supplier ID as a parameter
        success: function (data) {
            // Hide the loading modal when data is successfully received
            $('#loding_modal').modal('hide');

            // Clear previous modal content
            $(".view_modal_body").empty();

            // Append the new data into the modal body
            $(".view_modal_body").append(data);

            // Show the modal with the fetched details
            $('#view_modal').modal('show');
        },
        error: function (data) {
            // Handle error if AJAX request fails
            console.error('Error fetching data:', data);
        }
    });
});


/**********************/


/*$(document).on("click",".resend",function(){
		var id = $(this).attr('id');
			$('#loding_modal').modal('show');
		$.ajax({
			type:'get',
			url: APP_URL+'/resend_supplier_email',
			// dataType: 'json',
			data: {id:id},
			success:function(data){
				$('#loding_modal').modal('hide');
				swal({
     title: "Done !",
     text: "Successfully Sended.",
     type: "success",
     timer: 2000
     });

				},
			error: function (data) {
				//console.log('Error : '+data);
				}
			});
});*/
// Event listener for the "resend" button click
$(document).on("click", ".resend", function () {
    // Get the ID attribute of the clicked element
    var id = $(this).attr('id');

    // Show loading modal while processing the request
    $('#loding_modal').modal('show');

    // Perform AJAX request to resend supplier email
    $.ajax({
        type: 'GET', // Use GET request
        url: APP_URL + '/resend_supplier_email', // API endpoint
        data: { id: id }, // Send the supplier ID as a parameter
        success: function (data) {
            // Hide the loading modal when request is complete
            $('#loding_modal').modal('hide');

            // Show success message with SweetAlert
            swal({
                title: "Done!",
                text: "Email sent successfully",
                type: "success",
                timer: 2000
            });
        },
        error: function (data) {
            // Handle error if AJAX request fails
            console.error('Error resending email:', data);
        }
    });
});


/**********************/


/*$(document).ready(function(){
	fetch_datas('change')
});

$(document).on("click",".find",function() {
	fetch_datas('change');
});

function fetch_datas($statesave) {
var supplier_email=$("#supplier_email").val()

if ($.fn.DataTable.isDataTable('#example2')) {
   $('#example2').DataTable().destroy()
}
var table = $('#example2').DataTable({
	processing: true,
	serverSide: true,
	stateSave: $statesave,
	ajax: {
		url: "<?php echo e(route('get_supplier_email_list')); ?>",
        data: {supplier_email:supplier_email},
    },
    columns: [
    	{data: 'DT_Row_Index', name: 'DT_Row_Index',orderable: false, },
    	{data: 'quo_ref', name: 'quo_ref'},
    	{data: 'to', name: 'to'},
    	{data: 'cc', name: 'cc'},
    	{data: 'bcc', name: 'bcc'},
    	{data: 'last_update', name: 'last_update'},
    	{data: 'action', name: 'action'},
    	],      
    });
}*/

$(document).ready(function () {
    // Fetch supplier email data when the page loads
    fetch_datas('change');
});

// Event listener for "Find Data" button click
$(document).on("click", ".find", function () {
    fetch_datas('change');
});

/*Function to fetch supplier email data
 * @param  {string} statesave - Determines whether to save the DataTable state*/
function fetch_datas(statesave) {
    var supplier_email = $("#supplier_email").val(); // Get selected supplier email

    // Destroy existing DataTable instance if already initialized
    if ($.fn.DataTable.isDataTable('#example2')) {
        $('#example2').DataTable().destroy();
    }

    // Initialize DataTable with AJAX data loading
    var table = $('#example2').DataTable({
        processing: true,  // Show processing indicator
        serverSide: true,  // Enable server-side processing
        stateSave: statesave,  // Enable state saving
        ajax: {
            url: "<?php echo e(route('get_supplier_email_list')); ?>", // Fetch data from backend
            data: { supplier_email: supplier_email } // Send supplier email as parameter
        },
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false }, // Serial number
            { data: 'quo_ref', name: 'quo_ref' }, // Quote reference
            { data: 'to', name: 'to' }, // To email
            { data: 'cc', name: 'cc' }, // CC email
            { data: 'bcc', name: 'bcc' }, // BCC email
            { data: 'last_update', name: 'last_update' }, // Last updated date
            { data: 'action', name: 'action' } // Action buttons
        ]
    });
}

/**********************/

$(document).on("change","#quote_type",function() {
	get_quote_list()
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>