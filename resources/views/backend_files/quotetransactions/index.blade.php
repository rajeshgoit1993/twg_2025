@extends('layouts.master')

@section('content')

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


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">

					<div class="box-header">
						<!-- quotetransactions -> index -->
						<h3 class="box-title">Search Transaction</h3>
					</div>
					<!-- /.box-header -->

					<div class="search-container makeflex flex-column">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label>	Quote Type</label>
									<select id="quote_type" class="form-control " name="quote_type">
										<option value='1'>All</option>
										<option value='2'>Pre-Tour</option>
										<option value='3'>Post-Tour</option>
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Select Quote</label>
									<select id="select_quote" class="form-control " name="select_quote">
										<option value=''>--Select Quote--</option>
									</select>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label>Status</label>
									<select id="status" class="form-control " name="status">
										<option value='2' selected>All</option>
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
						</div>
					</div>

					<div class="box-body">
						<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
							<p>Gateway deleted successfully.</p>
						</div>
						<div class="alert alert-danger error-contaier-parenterror-contaier-parent-hotel" style="display:none">
							<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
						</div>
						<div class="row makeflex aligncenter form-group">
							<div class="col-md-6">
								<h4 class="box-title">Transactions List</h4>
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
									<th>Amount Received (Dr)</th>
									<th>Amount Paid (Cr)</th>
									<th>Payment Mode</th>
									<th>Receipt Link</th>
								</tr>
							</thead>
							<tbody>
								<!-- populate from PackageSettingsController -> quote_transactions_lists --> 
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

<!-- /.content-wrapper -->
@endsection


@section("custom_js_code")

<script type="text/javascript">

$(document).ready(function () {
    // Initial fetch for quote list
    get_quote_list(); 
    fetch_datas('change'); // Initial fetch for other data

    // Click event for payment details
    $(document).on("click", ".payment_details", function () {
        var id = $(this).attr('id');

        $.ajax({
            type: 'GET',
            url: APP_URL + '/gat_payment_data',
            data: { id: id },
            success: function (data) {
                console.log('Success: ', data);
                $("#modal-body").empty().append(data); // Clear and append data to modal body
                $('#addBookDialog').modal('show'); // Show the modal
            },
            error: function (xhr) {
                console.error('Error: ', xhr); // Log error
            }
        });
    });

    // Change event for quote type
    $(document).on("change", "#quote_type", function () {
        get_quote_list(); // Call function on change
    });

    // Click event for find button
    $(document).on("click", ".find", function () {
        fetch_datas('change'); // Fetch data on button click
    });
});

// Function to get the quote list
function get_quote_list() {
    var quote_type = $("#quote_type").val();
    setTimeout(function() {
        $.ajax({
            type: 'GET',
            url: APP_URL + '/get_quote_list',
            data: { quote_type: quote_type },
            success: function(data) {
                console.log('Quote Type: ', quote_type);
                console.log('Success: ', data);
                $("#select_quote").html(data); // Update the select_quote with new options
            },
            error: function(xhr) {
                console.error('Error: ', xhr); // Log error
            }
        });
    }, 1000); // 1 second delay
}

// Function to fetch additional data
function fetch_datas(stateSave) {
    var select_quote = $("#select_quote").val() || 'NA'; // Default to 'NA' if empty
    var status = $("#status").val() || 'NA'; // Default to 'NA' if empty

    if ($.fn.DataTable.isDataTable('#example2')) {
        $('#example2').DataTable().destroy(); // Destroy existing DataTable instance
    }

    var table = $('#example2').DataTable({
        processing: true,
        serverSide: true,
        stateSave: stateSave,
        ajax: {
            url: "{{ route('quote_transactions_lists') }}", // Ensure this is defined in your routes
            data: { select_quote: select_quote, status: status },
        },
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'description', name: 'description' },
            { data: 'quote_ref_no', name: 'quote_ref_no' },
            { data: 'transaction_id', name: 'transaction_id' },
            { data: 'status', name: 'status' },
            { data: 'amount_dr', name: 'amount_dr' },
            { data: 'amount_cr', name: 'amount_cr' },
            { data: 'payment_mode', name: 'payment_mode' },
            { data: 'link', name: 'link' },
        ],
    });
}
</script>

@endsection