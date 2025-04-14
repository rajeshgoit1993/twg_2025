@extends('layouts.master')
@section('content')
<style type="text/css">
.custom_border .row {
	padding: 5px 0px
	}
table.dataTable thead > tr > th {
    padding-right: 0px;
	}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    }
.custom_border .row {
	padding: 5px 0px
	}
.pfwmt {
	font-weight: 600;
	margin: 0px;
	text-align: left;
	}
.font-size14 {
	font-size: 14px;
	}
.font-weight500 {
	font-weight: 500;
	}
.text-center {
	text-align: center;
	}
.text-capitalize {
	text-transform: capitalize;
	}
.text-lowercase {
	text-transform: lowercase;
	}
.text-uppercase {
	text-transform: uppercase;
	}
.lineHeight14 {
	line-height: 14px;
	}
.lineHeight15 {
	line-height: 15px;
	}
.padding-top10 {
	padding-top: 10px;
	}
.padding-bottom10 {
	padding-bottom: 10px;
	}
.border-top1 {
	border-top: 1px solid #ccc;
	}
.border-bottom1 {
	border-bottom: 1px solid #ccc;
	}
.makeflex {
	display: flex;
	}
.flex110 {
	flex-grow: 1;
    flex-shrink: 1;
    flex-basis: 0%;
	}
.flexcenter {
	display: flex;
	align-items: center;
	}
.flexcenter > li.active, .flexcenter > li.active >a:focus, .flexcenter > li.active > a:hover {
	color: #008cff !important;
	border-bottom-color:#008cff !important;
	}
.flexcenter > li > a.hover {
	color: #008cff !important;
	padding-bottom: 15px;
	border-bottom:2px solid #008cff !important;
	}
.flex-column {
	display: flex;
	flex-direction: column;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box" style="overflow: auto;">
				<div class="box-header">
					<h3 class="box-title">Payment Follow-up</h3>
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
							<th width="140px">Name & Contact Details</th>
							<th width="150px">No of Guests</th>
							<!--<th>Package Name</th>-->
							<th width="150px">Destination & Package</th>
							<th width="100px">Travel Date</th>
							<th width="150px">Payment Status</th>
							<th width="150px">Lead Status</th>
							@if(Sentinel::check())
							@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('supervisor'))
							<th width="120px">Assigned User</th>
							@endif
							@endif
							<th width="60px">Lead<br>Date & Time</th>
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
									<option value="0" @if($query->status=="0") selected @endif disabled>Select Status</option>
									<option value="advance_received" @if($query->status=="advance_received") selected @endif>Advance Received</option>
									<option value="balance_payment" @if($query->status=="balance_payment") selected @endif>Balance Payment</option>
									<option value="full_payment_received" @if($query->status=="full_payment_received") selected @endif>Full Paid</option>
								</select>
								<div style="border: 1px solid #ccc;border-radius: 3px;margin-top: 10px">
									<p class="pfwmt" style="text-align: center;border-bottom: 1px solid #ccc;padding: 5px;">Payment follow-up<br>Date & Time</p>
									<div class="makeflex" style="justify-content: center">
									<span class="pfwmt" style="font-weight: 500;padding: 5px;text-align: center;border-right: 1px solid #ccc">10 Jan 2022</span>
									<span class="pfwmt" style="font-weight: 500;padding: 5px;text-align: center">19:20 hrs</span>
									</div>
								</div>
							</td>
							<td id={{$query->id}}>
								<select class="query_status" style="width: 100%;border-color: #ccc;border-radius: 3px;height: 34px;padding: 4px">
									<option value="0" @if($query->status=="0") selected @endif disabled>Select Status</option>
									<option value="advance_received" @if($query->status=="advance_received") selected @endif>Advance received</option>
									<option value="balance_payment" @if($query->status=="balance_payment") selected @endif>Balance Payment</option>
									<option value="full_payment_received" @if($query->status=="full_payment_received") selected @endif>Full payment received</option>
									<option value="quote_sent" @if($query->status=="quote_sent") selected @endif>Quote sent</option>
									<option value="quote_rejected" @if($query->status=="quote_rejected") selected @endif>Quote rejected</option>
									<option value="booked_with_other" @if($query->status=="booked_with_other") selected @endif>Booked with other</option>
									<option value="tour_cancelled" @if($query->status=="tour_cancelled") selected @endif>Tour cancelled</option>
								</select>
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
								@if(CustomHelpers::check_quote_exist($query->id)!="0")
								<a href="{{url('/quotes/'.CustomHelpers::check_quote_exist($query->id))}}" target="_blank"><button type="submit" class="btn btn-info lineHeight14" style="width: 100%;padding: 4px 10px;border-radius: 3px">View Quote</button></a>
								<input type="hidden"  value="{{url('/quotes/'.CustomHelpers::check_quote_exist($query->id))}}" id="copy{{$query->id}}">
								<button type="submit" class="btn btn-success link lineHeight14" link="copy{{$query->id}}" style="width: 100%;padding: 4px 10px;border-radius: 3px">Copy Link</button>
								<button type="submit" class="btn btn-success link lineHeight14" link="" style="width: 100%;padding: 4px 10px;border-radius: 3px">Payment Link</button>
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
</section>
<!-- /.content -->
</div>
<div class="testing">
<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
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