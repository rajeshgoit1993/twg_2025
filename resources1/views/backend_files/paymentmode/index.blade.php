@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="">
                            <a href="{{ route('add_payment_mode') }}" class="btn btn-success" style="margin-right: 20px">
                                <i class="glyphicon glyphicon-plus-sign"></i> Add New Payment Mode
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="alert alert-success success-container-parent-hotel" id="success-container-parent-hotel" style="display:none">
                            <p>Gateway deleted successfully.</p>
                        </div>
                        <div class="alert alert-danger error-container-parent-hotel" style="display:none">
                            <ul class="error-container-hotel" id="error-container-hotel"></ul>
                        </div>

                        <div class="row makeflex aligncenter form-group">
                            <div class="col-md-6">
                                <h4 class="box-title">Payment Mode List</h4>
                            </div>
                        </div>

                        <table id="example1" class="table table-bordered table-striped example1">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Mode</th>
                                    <th>Gateway</th>
                                    <th>MDR</th>
                                    <th>GST on MDR</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($data as $datas)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $datas->mode }}</td>
                                    <td>
                                        {{ CustomHelpers::get_master_table_data('gateway_settings', 'id', $datas->gateway_id, 'gateway_name') }}
                                    </td>
                                    <td>{{ $datas->mdr }}%</td>
                                    <td>{{ $datas->gst_on_mdr }}%</td>
                                    <td>
                                    	<button type="button" class="btn btn-sm {{ $datas->status == 1 ? 'btn-success' : 'btn-danger' }} no-event">
                                    		{{ $datas->status == 1 ? 'Enabled' : 'Disabled' }}
                                    	</button>
                                    </td>

                                    <td>
                                        <a href="{{ URL::to('/editpaymentmode/'.$datas->id) }}">
                                        	<button type="button" class="btn btn-sm btn-warning">Edit</button>
                                        </a>
                                        <!-- Delete (Uncomment if needed) -->
                                        <!-- <a href="{{ URL::to('/deletepaymentmode/'.$datas->id) }}" onclick="return confirm('Are you sure?')">
                                        		<button class="btn btn-danger" style="padding: 4px 10px">Delete</button>
                                        </a> -->
                                    </td>
                                </tr>
                                @endforeach
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
				<h4 class="modal-title">Gateway Setting</h4>
			</div>
			<form action="#" method="post" id="enq_data" name="enq_data">
				<div class="modal-body custom_border" id="modal-body" style="font-size: 15px; line-height: 24px;"></div>
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
	$(document).on('click', '.open-AddBookDialog', function() {
	    // Get the ID from the clicked element's data attribute
	    var id = $(this).data('id');
	    $('#bookId').val(id); // Set the hidden input value

	    // AJAX request to fetch gateway data
	    $.ajax({
	        type: 'POST', // Changed to POST as intended
	        url: APP_URL + '/gateway_data', // Your endpoint
	        data: { id: id }, // Sending the ID to the server
	        success: function(data) {
	            console.log('Success:', data); // Log the success response
	            $("#modal-body").empty(); // Clear previous content
	            $("#modal-body").append(data); // Append new data to modal
	            $('#addBookDialog').modal('show'); // Show the modal
	        },
	        error: function(data) {
	            //console.error('Error:', data); // Log any error response
	        }
	    });
	});
});		
</script>

@endsection