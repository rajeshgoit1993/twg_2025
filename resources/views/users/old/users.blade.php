@extends('layouts.master')
@section('content')
<style>
.lineHeight14 {
	line-height: 14px !important;
	}
.borderRadius3 {
	border-radius: 3px !important;
	}
.example1 a.btn {
	font-size: 14px !important;
	padding: 4px 12px !important;
	}
.pfwmt {
	font-weight: 600;
	margin: 0px;
	text-align: left;
	}
.fontWeight500 {
	font-weight: 500;
	}
.fontWeight700 {
	font-weight: 700;
	}
.textCenter {
	text-align: center;
	}
.textCapitalize {
	text-transform: capitalize;
	}
.textLowercase {
	text-transform: lowercase;
	}
.textUppercase {
	text-transform: uppercase;
	}
.lineHeight15 {
	line-height: 15px;
	}
.paddingBottom10 {
	padding-bottom: 10px;
	}
.borderBottomCCC {
	border-bottom: 1px solid #ccc;
	}
.paddingTop10 {
	padding-top: 10px;
	}
.borderRadius3 {
	border-radius: 3px;
	}
.paddingAllFour {
	padding: 4px;
	}
.fullWidth {
	width: 100%;
	}
.height34 {
	height: 34px !important; /*voucher*/
	}
.appendRight20 {
	margin-right: 20px;
	}
.appendBottom5 {
	margin-bottom: 5px;
	}
</style>

<style type="text/css">
.dashboard-outer-table {
  display: inline-block;
  border: 1px solid #eee;
  border-radius: 10px;
  overflow: hidden;
  width: 100%;
}
.dashboard-outer-table table tbody tr td, .dashboard-outer-table table thead th {
	font-size: 12px;
  line-height: 18px;
  padding: 10px;
  padding-right: 10px;
  text-align: center;
  white-space: nowrap;
  vertical-align: top;
}
.dashboard-inner-table {
	border: 1px solid #ccc;
	border-radius: 3px;
	padding: 7px;
	margin-bottom: 5px;
}
.dashboard-inner-table h5 {
	font-size: 12px;
	line-height: 14px;
	color: #000001;
	text-align: center;
	font-weight: 600;
	margin-top: 0;
	margin-bottom: 5px;
}
.q-dtls {
  font-size: 12px;
  line-height: 16px;
  color: #333;
  font-weight: 500;
  text-align: center;
  margin-bottom: 0;
  padding: 7px 0 7px;
  border-bottom: 1px solid #ccc;
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!--<section class="content-header">
		<h1> Users </h1>
		{{-- <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		</ol> --}}
	</section>-->
	<!-- Main content -->
	<section class="content" id="content">
		<div class="row">
			<div class="">
				<div class="box">
					@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') )
					<!--<div class="box-header">
						<a href="{{URL::to('/user-create')}}" class="btn btn-success" ><i class="glyphicon glyphicon-plus-sign"></i> Add New User</a>
					</div>-->
					<div class="box-header">
						<a href="{{ URL::to('/user-create') }}" class="btn btn-success appendRight20"><i class="glyphicon glyphicon-plus-sign"></i> Add New User</a>
						<h3 class="box-title">Manage Users</h3>
					</div>
					@endif
					<!-- /.box-header -->
					<div class="box-body">
						@if(Session::has('success'))
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							{{Session::get('success')}}
						</div>
						@endif
						<table id="example1" class="table table-bordered table-striped example1">
							<thead>
								<tr>
									<!-- <th style="width: 200px">Name</th>
									<th style="width: 140px">Contact Details</th>
									<th style="width: 100px">Assigned Role</th>
									<th style="width: 100px">Category</th>
									<th style="width: 150px">Subscription</th>
									<th style="width: 80px">Status</th>
									<th style="width: 30px">Online Status</th>
									<th style="width: 80px">Last Login</th>
									<th style="width: 70px">Actions</th> -->
									<th>Name</th>
									<th>Contact Details</th>
									<th>Assigned Role</th>
									<th>Category</th>
									<th>Subscription</th>
									<th>Status</th>
									<th>Online Status</th>
									<th>Last Login</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								<tr id="role_{{$user->id}}">
									<td class="first_name"><span>{{$user->first_name}} {{$user->last_name}}</span></td>
									<td>
										<!-- <div>
											<p class="pfwmt fontWeight500 textlowercase lineHeight15 paddingBottom10 borderBottomCCC">{{$user->email}}</p>
											<p class="pfwmt fontWeight500 textCapitalize lineHeight15 paddingBottom10 paddingTop10">{{$user->mobile}}</</p>
										</div> -->
										<th>
											<p class="pfwmt fontWeight500 textlowercase lineHeight15 paddingBottom10 borderBottomCCC">{{$user->email}}</p>
											<p class="pfwmt fontWeight500 textCapitalize lineHeight15 paddingBottom10 paddingTop10">{{$user->mobile}}</</p>
										</th>
									</td>
									<td class="user_role">
										<!--<span><label for="" class="label label-success">{{CustomHelpers::get_user_role($user->id)}}</label></span>-->
										<p class="pfwmt fontWeight500 textCenter borderCCC borderRadius3 fullWidth paddingAllFour textCapitalize">{{CustomHelpers::get_user_role($user->id)}}
										</p>
									</td>
									<td>
										<p class="pfwmt fontWeight500 textCenter borderCCC borderRadius3 fullWidth paddingAllFour textCapitalize">{{$user->usercategory}}</p>
									</td>
									<td>
										<p class="pfwmt fontWeight500">
										<select class="borderCCC borderRadius3 fullWidth paddingAllFour textCapitalize subscription" id="{{$user->id}}" >
											<option value="subscribed" @if($user->subscription=='subscribed') selected @endif>Subscribed</option>
											<option value="partialsubscribed" @if($user->subscription=='partialsubscribed') selected @endif disabled>Partial Subscribed</option>
											<option value="unsubscribed" @if($user->subscription=='unsubscribed') selected @endif>Unsubscribed</option>
										</select>
										</p>
									</td>
									<td>
										<p class="pfwmt fontWeight500 appendBottom5">
										<select class="borderCCC borderRadius3 fullWidth paddingAllFour textCapitalize" readonly>
											<option value="enabled">Enabled</option>
											<option value="disabled">Disabled</option>
										</select>
										</p>
										<?php
										$sevtinel_activated=Sentinel::findById($user->id);
										if ($activation = Activation::completed($sevtinel_activated))
										{
										echo "<p style='background:green;color:white;padding:2px 5px;text-align:center;border-radius: 2px'>Activated</p>";
										}
										else
										{
										echo "<p style='background:#dd4b39;color:white;padding:2px 5px;text-align:center;border-radius: 2px'>Not Activated</p>";
										}
										?>
									</td>
									<td>
										@if($user->login_status=="1")
										<span class="textUppercase fontWeight700" style="color: green">Online</span>
										@else
										<span class="textUppercase fontWeight700" style="color: red">Offline</span>
										@endif
									</td>
									<td>
										<?php
										$date=date_create($user->last_login);
										echo date_format($date,"<p style='margin-bottom: 5px;font-weight: 700'>d M Y</p><p> H:i:s</p>");
										?>
									</td>
									<td>
										<form action="{{URL::to('/deleteuser')}}" method="post" onsubmit="return confirm('Are you sure, you want to delete this user?');">
										{{csrf_field()}}
											<input type="hidden" name="id" value="{{$user->id}}"/>
											@if((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin'))
											@elseif(Sentinel::getUser()->inRole('employee') && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin' || CustomHelpers::get_user_role($user->id)=='supervisor'))
											@elseif(Sentinel::getUser()->inRole('agent') && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin' || CustomHelpers::get_user_role($user->id)=='supervisor' || CustomHelpers::get_user_role($user->id)=='employee'))
											@else
											<a href="{{URL::to('/edit-user/'.$user->id)}}" class="btn btn-warning fontSize14 lineHeight14 borderRadius3 fullWidth">Edit</a>
											@endif
											@if(Sentinel::getUser()->id==$user->id)
											|
											<a href="" class="btn btn-success">Logged Admin</a>
											@else
											@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin') )
											<button type="submit" class="btn btn-danger deletePackage lineHeight14 borderRadius3 fullWidth">Delete</button>
											@endif
											@endif
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('custom_js_code')
<script type="text/javascript">
$(document).on('change','.subscription',function(){
	
var value=$(this).val()
var id=$(this).attr('id')

  $.ajax({
        type: 'get',
        url: APP_URL + '/change_subscription',
        // dataType: 'json',
        data: {id:id,value:value},
        success: function (data) {
         
        },
        error: function (data) {
            //console.log('Error : '+data);
          
        }
    });


})

</script>
@endsection
