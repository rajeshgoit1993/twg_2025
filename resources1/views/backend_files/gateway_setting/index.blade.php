@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content section -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <!-- Box container for payment gateway content -->
                <div class="box">

                    <!-- Box header -->
                    <div class="box-header">
                    	<h3 class="box-title">Payment Gateway List</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- Box body -->
                    <div class="box-body">

                        <!-- Success alert message -->
                        <div class="alert alert-success" id="success-contaier-parent-hotel" style="display: none;">
                            <p>Gateway deleted successfully.</p>
                        </div>

                        <!-- Error alert message -->
                        <div class="alert alert-danger" style="display: none;">
                            <ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
                        </div>

                        <!-- Payment Gateway Table -->
                        <table id="example1" class="table table-bordered table-striped example1">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Gateway Name</th>
                                    <th>Environment</th>
                                    <th>Merchant ID</th>
                                    <th>Merchant Key</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @forelse($data as $datas)
                                    <tr>
                                        <td>
                                        	{{ $count++ }}
                                        </td>

                                        <td class="textCapitalize">
                                        	{{ $datas->gateway_name }}
                                        </td>

                                        <td>
                                            <!-- Environment Status -->
                                            @if($datas->environment == 1)
                                                Live Mode
                                            @else
                                                Test Mode
                                            @endif
                                        </td>

                                        <td>
                                            <!-- Merchant ID based on environment -->
                                            @if($datas->environment == 1)
                                                {{ $datas->prd_merchant_mid }}
                                            @else
                                                {{ $datas->test_merchant_mid }}
                                            @endif
                                        </td>

                                        <td>
                                            <!-- Merchant Key based on environment -->
                                            @if($datas->environment == 1)
                                                {{ $datas->prd_merchant_key }}
                                            @else
                                                {{ $datas->test_merchant_key }}
                                            @endif
                                        </td>

                                        <td>
                                            <!-- Status Indicator -->
                                            @if($datas->status == 1)
                                            	<button class="btn btn-sm btn-success no-event">Enabled</button>
                                            @else
                                            	<button class="btn btn-sm btn-danger no-event">Disabled</button>
                                            @endif
                                        </td>

                                        <td>
                                            <!-- Action buttons for View and Edit -->
                                            <a href="{{ URL::to('/editgatewaysetting/' . $datas->id) }}">
                                            	<button type="button" class="btn btn-sm btn-warning">Edit</button>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-info open-AddBookDialog" data-id="{{ $datas->id }}">View</button>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- No data found message -->
                                    <tr>
                                        <td colspan="7" class="text-center text-danger">Data Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>

        <!-- Modal for Gateway Settings -->
        <div class="modal fade" id="addBookDialog" role="dialog">
            <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 5px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <input type="hidden" id="bookId">
                        <h4 class="modal-title">Gateway Setting</h4>
                    </div>
                    <form action="#" method="post" id="enq_data" name="enq_data">
                        <div class="modal-body custom_border" id="modal-body" style="font-size: 15px; line-height: 24px;">
                            <!-- Dynamic content here -->
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        <!-- /.modal -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@endsection

@section("custom_js_code_second")

<script type="text/javascript">
// Event listener for opening the modal and fetching gateway data
$(document).on('click', '.open-AddBookDialog', function() {

    // Set the hidden input field with the selected gateway ID
    $('#bookId').val($(this).data('id'));
    var id = $(this).data('id');

    // AJAX request to fetch gateway data based on the selected ID
    $.ajax({
        type: 'post',
        url: APP_URL + '/gateway_data',
        // dataType: 'json', // Uncomment if expecting JSON response
        data: { id: id },
        success: function(data) {
            console.log('Success:', data);

            // Clear any existing content in the modal body and append the new data
            $("#modal-body").empty();
            $("#modal-body").append(data);

            // Show the modal after data is loaded
            $('#addBookDialog').modal('show');
        },
        error: function(data) {
            // Log the error if needed
            console.error('Error:', data);
        }
    });
});
</script>

@endsection