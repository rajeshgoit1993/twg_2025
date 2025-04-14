@extends('layouts.master')
@section('content')

@include("query.query_modal.query_modal_css")

<!-- Tour Vouchers -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box" style="overflow: auto;">
					<div class="box-header">
						<h3 class="box-title">Tour Vouchers</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						@if(Sentinel::check())
						@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('employee') )
						<div class="add">
							<a href="{{URL::to('/add_customer')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Lead</a>
						</div>
						@endif
						@endif
						@if (\Session::has('message'))
						<div class="alert alert-success">
							<ul>
								<li>{!! \Session::get('message') !!}</li>
							</ul>
						</div>
						@endif
						<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
							<p>Query Deleted Successfully</p>
						</div>
						<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
							<ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
						</div>
						<table id="example1" class="table table-bordered table-striped example1">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Name & Contact Details</th>
								<th width="150px">No of Guests</th>
								<!--<th>Package Name</th>-->
								<th>Destination & Package</th>
								<th width="100px">Travel Date</th>
								<th style="min-width:120px">Lead Status</th>
								@if(Sentinel::check())
								@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('supervisor'))
								<th style="min-width:120px">Assigned User</th>
								@endif
								@endif
								<th width="70px">Lead<br>Date & Time</th>
							</tr>
						</thead>
						<tbody>
							<?php $count="1"; ?>
							@foreach($queries as $key=>$query)
							<tr>
								<td>{{$count++}}</td>
								<td>
									<p class="pfwmt text-capitalize lineHeight15 padding-bottom10 border-bottom1">{{$query->name}}</p>
									@if($query->mobile!="")
									<p class="pfwmt font-weight500 lineHeight15 padding-top10 padding-bottom10 border-bottom1">{{$query->mobile}}</p>
									@endif
									<p class="pfwmt font-weight500 text-lowercase lineHeight15 padding-bottom10 padding-top10">{{$query->email}}</p>
								</td>
								<td>
									@if($query->span_value_adult!="" && $query->span_value_adult!="0")
									<p class="pfwmt font-weight500 lineHeight15 padding-bottom10">{{$query->span_value_adult}} <span class="font-size14">A </span>
									@endif
									@if($query->span_value_child!="" && $query->span_value_child!="0")
									+ {{$query->span_value_child}} <span class="font-size14">C </span>
									@endif
									@if($query->span_value_infant!="" && $query->span_value_infant!="0")
									+ {{$query->span_value_infant}} <span class="font-size14">Infant</span></p>
									@endif
									@if($query->country_of_residence!="")
									<p class="pfwmt font-weight500 text-capitalize lineHeight15 padding-top10 padding-bottom10 border-top1">{{$query->country_of_residence}}</p>
									@endif
								</td>
								<td>
									<p class="pfwmt text-capitalize lineHeight15 padding-bottom10">{{$query->destinations}}</p>
									@if(is_numeric($query->packageId))
									<p class="pfwmt text-capitalize lineHeight15 border-top1 padding-top10"><a href="{{url('/packages-detail/'.Crypt::encrypt(['id'=>$query->packageId]))}}" target="_blank">{{CustomHelpers::get_package_name($query->packageId)}}</a>
									@else
										{{$query->packageId}}</p>
									@endif	
								</td>
								<td>
									@if($query->date_arrival!="")
									<?php
										$date_arrival = $query->date_arrival;
										$date_arrival = str_replace('/', '-', $date_arrival);
										//Explode the string into an array.
										$exploded = explode("-", $date_arrival);
										//Reverse the order.
										$exploded = array_reverse($exploded);
										$newFormat = array_map('trim', $exploded);
										//Convert it back into a string.
										$newFormat = implode("-", $newFormat);
										$newFormat = date("d M Y", strtotime($newFormat));
										//Print it out.
										echo $newFormat;
									?>
									@endif
								</td>
								<td id={{$query->id}}>
									<select class="query_status" style="width: 100%;border-color: #ccc;border-radius: 3px;height: 34px;padding: 4px">
										<option value="full_payment_received" @if($query->status=="full_payment_received") selected @endif>Tour Confirmation</option>
										<option value="issue_vouchers" @if($query->status=="issue_vouchers") selected @endif>Issue vouchers</option>
										<option value="vouchers_issued" @if($query->status=="vouchers_issued") selected @endif>Vouchers Issued</option>
										<option value="tour_completed" @if($query->status=="tour_completed") selected @endif>Tour completed</option>
										<option value="reviews" @if($query->status=="reviews") selected @endif disabled>Reviews</option>
										<option value="any_refund" @if($query->status=="any_refund") selected @endif>Any Refund</option>
									</select>
									<div style="border: 1px solid #ccc;border-radius: 3px;margin-top: 10px">
										<p class="pfwmt" style="text-align: center;border-bottom: 1px solid #ccc;padding: 5px;">Issued Vouchers</p>
										<div class="makeflex" style="padding: 5px;justify-content: space-between">
											<button class="btn btn-info voucher_list" data-id="{{$query->id}}" data-toggle="modal">Voucher List</button>
											<button class="btn btn-success resend" data-id="{{$query->id}}" data-toggle="modal">Resend</button>									
										</div>
									</div>
								</td>
								@if(Sentinel::check())
								@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('supervisor'))
								<td id={{$query->id}}>
										<select class="role_assign" style="width: 100%;border-color: #ccc;border-radius: 3px;height: 34px;padding: 4px">
										<option @if($query->assign_id=="0") selected @endif value="0">Unassigned</option>
										@foreach($employee as $employees)
										   <option value="{{ $employees->id }}" @if($query->assign_id==$employees->id) selected @endif >{{ $employees->first_name }} {{ $employees->last_name }}</option>
										@endforeach
										  </select>
									</td>
								@endif
								@endif
								<td>
									<button type="submit" class="btn btn-success btn-xcrud lineHeight14 send_voucher" data-id="{{$query->id}}" data-toggle="modal" style="width: 100%;padding: 4px 10px;border-radius: 3px">Upload Voucher</button>
									<!--<button type="submit" class="btn btn-success btn-xcrud btn btn-success send_voucher" data-id="{{$query->id}}" data-toggle="modal" >Send Voucher<i class="fa fa-send"></i></button>-->
									@if(CustomHelpers::check_quote_exist($query->id)!="0")
									<a href="{{url('/quotes/'.CustomHelpers::check_quote_exist($query->id))}}" target="_blank"><button type="submit" class="btn btn-info lineHeight14" style="width: 100%;padding: 4px 10px;border-radius: 3px">View Quote</button></a>
									<input type="hidden"  value="{{url('/quotes/'.CustomHelpers::check_quote_exist($query->id))}}" id="copy{{$query->id}}">
									<button type="submit" class="btn btn-success link lineHeight14" link="copy{{$query->id}}" style="width: 100%;padding: 4px 10px;border-radius: 3px">Copy Link</button>
									@endif
										<!--<button type="submit" class="btn btn-default btn-xcrud btn btn-warning open-AddBookDialog" data-id="{{$query->id}}" data-toggle="modal" style="border-radius: 3px;margin-right: 10px"><i class="fa fa-eye"></i></button>-->
										<button type="submit" class="btn btn-default btn-xcrud btn btn-warning open-AddBookDialog lineHeight14" data-id="{{$query->id}}" data-toggle="modal" style="width: 100%;padding: 4px 10px;border-radius: 3px">View Lead</button>
										@if(Sentinel::check())
											@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
											<form style="float: unset !important" action="{{URL::to('/detele_query/'.$query->id)}}" onsubmit="return confirm('Are you sure you want to delete this lead?');" method="POST">
												{{csrf_field()}}
												<!--<button type="submit" class="btn btn-danger deletePackage" style="border-radius: 3px;"><i class="fa fa-times"></i></button>-->
												<button type="submit" class="btn btn-danger deletePackage lineHeight14" style="width: 100%;padding: 4px 10px;border-radius: 3px">Delete</button>
											</form>
											@endif
										@endif
									<div style="border: 1px solid #ccc;border-radius: 3px;">
										<?php $newDate_flight = date("d M Y H:i", strtotime($query->created_at)); ?>
										<p class="pfwmt font-weight500 text-center">{{$newDate_flight}}</p>
									</div>
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
		<!--Lead Details starts-->
		<!-- Modal -->
		<div class="modal fade" id="addBookDialog" role="dialog">
			<div class="modal-dialog">
			<!-- Modal content-->
				<div class="modal-content" style="border-radius: 5px">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<input type="hidden" name="" value="" id="bookId">
							<h4 class="modal-title">Enquiry Details</h4>
					</div>
					<div class="modal-body custom_border" id="modal-body" style="font-size: 15px;line-height: 24px;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!--Voucher List Start-->
		<!-- Modal -->
		<div class="modal fade" id="voucher_lists" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content" style="border-radius: 3px">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Voucher List</h4>
					</div>
					<div class="modal-body custom_border" id="voucher_list_body" style="font-size: 15px;line-height: 24px;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!--Voucher List End-->
		<!--Attach and Send Voucher-->
		<!-- Modal -->
		<div class="modal fade" id="send_voucher" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content" style="border-radius: 3px">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<input type="hidden" name="" value="" >
						<h4 class="modal-title">Upload and Send Voucher</h4>
					</div>
					<div class="modal-body custom_border" style="font-size: 15px;line-height: 24px;">
						<form action="{{url('/send_voucher_file')}}" enctype="multipart/form-data" method="post" id="voucher_data">
						{{csrf_field()}}
						<input type="hidden" name="lead_id" value="" id="lead_id">
						<label>Upload Voucher</label>
						<input type="file" name="voucher[]" class="voucher form-control" style="padding: 6px;height: 36px;border-radius: 3px" required multiple accept=".pdf">
						<br>
						<input type="submit" value="Upload  Send" name="" class="send_file btn btn-success">
						</form>
					</div>
				</div>
			</div>
		</div>
		<!---->
	</section>
	<!-- /.content -->
</div>

<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
// send voucher
$(document).ready(function () {
	$(document).on('click', '.send_voucher', function() {
		var id = $(this).data('id');
		$("#lead_id").val("").val(id)
		$('#send_voucher').modal('show');
		});
	// $(document).on('click', '.send_file', function(e){
	// e.preventDefault()

	// var myform = document.getElementById("voucher_data");
	// var fd = new FormData(myform);
	//   $.ajax({
	//         url: APP_URL+'/send_voucher_file',
	//         data: fd,
	//         cache: false,
	//         processData: false,
	//         contentType: false,
	//         type: 'get',
	//         success: function (data) {
	//           console.log(data)
	//         }
	//     });
	// })

	$(document).on('click', '.resend', function() {
		var id = $(this).data('id');
		$(".resend").css("display","none");
		$.ajax({
			type:'get',
			url: APP_URL+'/resend',
			// dataType: 'json',
			data: {id:id},
			success:function(data){
				alert(data)
				setTimeout(function () {
					location.reload();
					}, 300)
				},
			error: function (data) {
			}
		});
	});

	// voucher list
	$(document).on('click', '.voucher_list', function() {
		var id = $(this).data('id');
		$.ajax({
			type:'post',
			url: APP_URL+'/voucherlist',
			// dataType: 'json',
			data: {id:id},
			success:function(data){
				$("#voucher_list_body").empty();
				$("#voucher_list_body").append(data)
				$('#voucher_lists').modal('show');
				},
			error: function (data) {
				//console.log('Error : '+data);
			}
		});
	});

	//
	$(document).on('click', '.open-AddBookDialog', function() {
		$('#bookId').val($(this).data('id'));
		var id = $(this).data('id');
		$.ajax({
			type:'post',
			url: APP_URL+'/enq_data',
			// dataType: 'json',
			data: {id:id},
			success:function(data){
				console.log('Sucess : '+data,);
				$("#modal-body").empty();
				$("#modal-body").append(data)
				$('#addBookDialog').modal('show');
				},
			error: function (data) {
				//console.log('Error : '+data);
			}
		});
	});
});
</script>
@endsection