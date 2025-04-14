@extends('layouts.master')

@section("custom_css_code")

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
@keyframes wait {
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
@media (max-width: 768px) {
    .modal-dialog {
        max-width: 96% !important; /* Ensures it doesn't exceed 96% */
        margin: 10px auto; /* Adds space around the modal */
    }
}
@media (min-width: 768px) {
    .modal-dialog {
        width: 800px;
        margin: 30px auto; /* Adds space around the modal */
    }
}
</style>

@endsection


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main Content Section -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                	<div class="box-header">
                		<h3 class="box-title">Sent Items</h3>
                	</div>
                    
                    <!-- Card Section -->
                    <!-- <div class="card" style="padding: 20px; background: lightgray; margin-bottom: 10px;"> -->
                    <div class="search-container makeflex flex-column">
                        <div class="row">
                            
                            <!-- Guest List Dropdown -->
                            <div class="col-md-4">
                            	<div class="form-group">
                            	<?php
									$email_data=DB::table('supplier_email_non_lead')->get();
									$emails=[];
									foreach($email_data as $d) {
										if($d->to!='') {
											$to=unserialize($d->to);
											foreach($to as $t) {
												$emails[]=$t;
											}
										}
									}
									$email_s=array_unique($emails);
								?>
                                <label>Select email from list</label>
                                <select id="supplier_email" class="form-control" name="supplier_email">
                                    <option value='0'>All</option>
                                    @if(!empty($email_s))
                                        @foreach($email_s as $email)
                                            <option value="{{ $email }}">{{ $email }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            </div>
                            
                            <!-- search email -->
                            <div class="col-md-2">
                                <label style="visibility: hidden;">NA</label>
                                <button class="btn btn-success btn-block find">Search</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Box Body -->
                    <div class="box-body">
                        
                        <!-- Success Message -->
                        @if(session()->has('success'))
                            <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel">
                                <p>{{ session()->get('success') }}</p>
                            </div>
                        @endif
                        
                        <!-- Compose Email Section -->
                        <div class="row makeflex aligncenter form-group">
                            <div class="col-md-6">
                            	<a href="{{ route('supplierEmailCompose') }}">
                                    <button class="btn btn-success">Compose New Email</button>
                                </a>
                                <!-- <h4 class="box-title">Sent Items</h4> -->
                            </div>
                            <!-- <div class="col-md-6" style="">
                                <a href="{{ route('supplierEmailCompose') }}">
                                    <button class="btn btn-success">Compose Email</button>
                                </a>
                            </div> -->
                        </div>
                        
                        <!-- Email List Table -->
                        <table id="example2" class="table table-bordered table-striped example2">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Reference No</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Cc</th>
                                    <th>Bcc</th>
                                    <th>Attached File</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<!-- Content from supplier controller get_supplier_email_list_non_lead -->
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
                        <input type="hidden" id="bookId" value="">
                        <h4 class="modal-title">View Details</h4>
                    </div>
                    <div class="modal-body view_modal_body">
                    	<!-- content from view supplier email blade -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Loading Modal -->
        <div class="modal fade" id="loading_modal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="min-height: 80px;margin: auto;">
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
	<input type="hidden" value="{{ url('/') }}" name="" id="test">
</div>

<!-- /.content-wrapper -->
<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<!-- /.content-wrapper -->
@endsection


@section("custom_js_code")

<script type="text/javascript">
$(document).on("click", ".view", function () {
    // Show loading modal
    $('#loading_modal').modal('show');

    let id = $(this).attr('id'); // Use `let` for better scope handling

    $.ajax({
        type: 'GET',
        url: APP_URL + '/view_supplier_email_non_lead',
        data: { id: id },
        success: function (data) {
            $('#loading_modal').modal('hide'); // Hide loading modal

            $(".view_modal_body").html(data); // Use .html() instead of empty().append()
            $('#view_modal').modal('show'); // Show modal with fetched data
        },
        error: function (xhr, status, error) {
            console.error('Error:', error); // Log error for debugging
            $('#loading_modal').modal('hide'); // Hide loading modal even on error
            alert("An error occurred. Please try again.");
        }
    });
});


/**********************/


$(document).on("click", ".resend", function () {
    let id = $(this).attr('id'); // Use `let` for better scope handling

    $('#loading_modal').modal('show'); // Show loading modal

    $.ajax({
        type: 'GET',
        url: APP_URL + '/resend_supplier_email_non_lead',
        data: { id: id },
        success: function (data) {
            $('#loading_modal').modal('hide'); // Hide loading modal

            swal({
                title: "Done!",
                text: "Email sent successfully", // Fixed typo
                icon: "success",
                timer: 2000
            });
        },
        error: function (xhr, status, error) {
            console.error('Error:', error); // Log error for debugging
            $('#loading_modal').modal('hide'); // Hide loading modal even on error
            swal({
                title: "Error!",
                text: "Something went wrong. Please try again.",
                icon: "error",
                timer: 3000
            });
        }
    });
});


/**********************/


$(document).on("change","#quote_type",function() {
	get_quote_list();
});


/**********************/

var getSupplierEmailURL = `{!! route('get_supplier_email_list_non_lead') !!}`;

$(document).ready(function () {
    fetch_datas(); // Ensures data loads when the page is ready
});

$(document).on("click", ".find", function () {
    fetch_datas(); // Refreshes data when "Find" button is clicked
});

function fetch_datas() {
    var supplier_email = $("#supplier_email").val();

    console.log("Fetching Data from:", getSupplierEmailURL, "Supplier Email:", supplier_email); // Debugging

    if ($.fn.DataTable.isDataTable('#example2')) {
        $('#example2').DataTable().destroy(); // Destroy old instance before reinitializing
    }

    $('#example2').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true, // Keeping stateSave as true
        ajax: {
            url: getSupplierEmailURL,
            type: "GET", // Explicitly defining method
            data: { supplier_email: supplier_email },
            /*error: function (xhr, status, error) {
                console.error("AJAX Error:", error, xhr.responseText);
            }*/
        },
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false },
            { data: 'quo_ref', name: 'quo_ref' },
            { data: 'from_email_name', name: 'from_email_name' },
            { data: 'to', name: 'to' },
            { data: 'cc', name: 'cc' },
            { data: 'bcc', name: 'bcc' },
            { data: 'attachment', name: 'attachment' },
            { data: 'last_update', name: 'last_update' },
            { data: 'action', name: 'action' },
        ],
    });
}
</script>

@endsection