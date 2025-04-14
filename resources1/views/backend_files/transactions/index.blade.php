@extends('layouts.master')

@section("custom_css_code")

<style>
.payment_details {
	cursor: pointer;
}
.search-container {
	padding: 20px 20px 10px;
	border: 1px solid #ccc;
	border-radius: 10px;
	background-color: #f2f2f2;
	margin: 10px;
}
</style>

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
					<div class="box-header">
                        <!-- transactions -> index -->
                        <h3 class="box-title">Search Transactions</h3>
                    </div>
					<!-- /.box-header -->
					<div class="search-container makeflex flex-column">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>	Date From</label>
									<input type="date" name="start_date" max="{{date('Y-m-d')}}" class="form-control" id="start_date" value="{{date('Y-m-d', strtotime('-30 days'))}}" >
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>End Date</label>
									<input type="date" name="end_date" max="{{date('Y-m-d')}}" class="form-control" id="end_date" value="{{date('Y-m-d')}}">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Status</label>
									<select id="status" class="form-control " name="status">
										<option value='2'>All</option>
										<option value='1' selected>Completed</option>
										<option value='0'>Pending</option>
									</select>
								</div>
							</div>

							<div class="col-md-1">
								<div class="form-group">
									<label style="visibility: hidden;">Search</label>
									<button class="btn btn-success btn-block find">Search</button>
								</div>
							</div>

							<div class="col-md-12"></div>

						</div>
					</div>

					<div class="box-body">
						<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
							<p>Gateway deleted successfully.</p>
						</div>
						<div class="alert alert-danger error-contaier-parenterror-contaier-parent-hotel" style="display:none">
							<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<h4 class="box-title">Transactions List</h4>
								</div>
							</div>
						</div>

						<table id="example2" class="table table-bordered table-striped example2">
							<thead>
								<tr>
									<th>S.No.</th>
									<th>Date</th>
									<th>Description</th>
									<th>Quote ref no</th>
									<th>Transaction Ref</th>
									<th>Status</th>
									<th>Amount Paid (Cr)</th>
									<th>Amount Received (Dr)</th>
									<th>Payment Mode</th>
									<th>Receipt Link</th>
								</tr>
							</thead>
							<tbody>
								<!-- populate from PackageSettingsController -> transactions_lists-->
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


<!-- Modal -->
<div class="modal fade" id="addBookDialog" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content" style="border-radius: 5px">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<input type="hidden" name="" value="" id="bookId">
				<h4 class="modal-title">Payment Details</h4>
			</div>
			<form action="#" method="post" id="enq_data" name="enq_data">
				<div class="modal-body custom_border" id="modal-body" style="font-size: 15px;line-height: 24px;"></div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>

<!-- /.content-wrapper -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@endsection


@section("custom_js_code")

<script type="text/javascript">
$(document).ready(function() {
	$(document).on("click", ".payment_details", function() {
	    // Get the ID attribute of the clicked element
	    var id = $(this).attr('id');

	    // Make an AJAX request to fetch payment data
	    $.ajax({
	        type: 'get', // HTTP method to send request
	        url: APP_URL + '/gat_payment_data', // Endpoint URL
	        data: { id: id }, // Data to send with the request
	        success: function(data) {
	            console.log('Success:', data); // Log success response to console

	            // Clear and append new content to modal body
	            $("#modal-body").empty();
	            $("#modal-body").append(data);

	            // Show the modal with payment details
	            $('#addBookDialog').modal('show');
	        },
	        error: function(data) {
	            console.log('Error:', data); // Log error response to console (if needed)
	        }
	    });
	});

	// Call the fetch_datas function with 'change' as the argument
	fetch_datas('change')

    // Attach a click event handler to elements with the class 'find'
    $(document).on("click", ".find", function() {
        // Call the fetch_datas function with 'change' as the argument
        fetch_datas('change');
    });
});

function fetch_datas($statesave) {
    // Retrieve the value of the start date input field
    var start_date = $("#start_date").val();
    // If the start date is empty, set it to 'NA'
    if (start_date == '') {
        start_date = 'NA'; 
    }

    // Retrieve the value of the end date input field
    var end_date = $("#end_date").val();
    // If the end date is empty, set it to 'NA'
    if (end_date == '') {
        end_date = 'NA';
    }

    // Retrieve the value of the status input field
    var status = $("#status").val();
    // If the status is empty, set it to 'NA'
    if (status == '') {
        status = 'NA';
    }

    // Check if the DataTable is already initialized
    if ($.fn.DataTable.isDataTable('#example2')) {
        // If it is, destroy the existing DataTable instance
        $('#example2').DataTable().destroy();
    }

    // Initialize a new DataTable instance
    var table = $('#example2').DataTable({
        processing: true, // Show a processing indicator while loading data
        serverSide: true, // Enable server-side processing
        stateSave: $statesave, // Save the state of the table (pagination, filtering, etc.)
        ajax: {
            url: "{{ route('transactions_lists') }}", // URL for the AJAX request
            data: { // Data to be sent to the server
                start_date: start_date,
                end_date: end_date,
                status: status
            },
        },
        columns: [ // Define the columns for the DataTable
            { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false }, // Index column
            { data: 'updated_at', name: 'updated_at' }, // Column for the last updated date
            { data: 'description', name: 'description' }, // Column for transaction description
            { data: 'quote_ref_no', name: 'quote_ref_no' }, // Column for quote reference number
            { data: 'transaction_id', name: 'transaction_id' }, // Column for transaction ID
            { data: 'status', name: 'status' }, // Column for transaction status
            { data: 'amount_cr', name: 'amount_cr' }, // Column for credit amount
            { data: 'amount_dr', name: 'amount_dr' }, // Column for debit amount
            { data: 'payment_mode', name: 'payment_mode' }, // Column for payment mode
            { data: 'link', name: 'link' }, // Column for action links
        ],
    });
}
</script>

@endsection