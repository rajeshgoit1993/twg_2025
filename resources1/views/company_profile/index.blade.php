@extends('layouts.master')
@section('content')
<style type="text/css">
.custom_border .row
{

padding: 5px 0px
}
table.dataTable thead > tr > th {
    padding-right: 0px;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    
    
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
<h3 class="box-title">Company Profile</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
 @if(Sentinel::getUser()->inRole('super_admin'))
@if(count($data)==0)
<div class="add">
<a href="{{URL::to('/Create-Company-Profile	')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Company Profile</a>
</div>
@endif
@endif
<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
<p>Query Deleted Successfully.</p>
</div>
<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">

<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul> 
</div>
@foreach($data as $datas)
<table class="table table-bordered">
	<tbody>
		<tr>
			<td>Company Name</td>
			<td>{{$datas->company_name}}</td>
			<td>Company ID</td>
			<td>{{$datas->company_id}}</td>
		</tr>
			<tr>
			<td>Registered Address</td>
			<td>{{$datas->address}}</td>
			<td>City</td>
			<td>{{$datas->city}}</td>
		</tr>
			<tr>
			<td>State</td>
			<td>{{$datas->state}}</td>
			<td>Country</td>
			<td>{{$datas->country}}</td>
		</tr>
			<tr>
			<td>Pin Code</td>
			<td>{{$datas->pin}}</td>
			<td>Company Type</td>
			<td>{{$datas->company_type}}</td>
		</tr>
			<tr>
			<td>No of Employees</td>
			<td>{{$datas->no_of_emp}}</td>
			<td>Contact Person</td>
			<td>{{$datas->contact_person}}</td>
		</tr>
			<tr>
			<td>Office Landline No</td>
			<td>{{$datas->office_no}}</td>
			<td>Mobile No</td>
			<td>{{$datas->mobile_no}}</td>
		</tr>
			<tr>
			<td>Alternate Mobile No</td>
			<td>{{$datas->alternate_no}}</td>
			<td></td>
			<td></td>
			
		</tr>
			<tr>
            <td>Primary Email ID</td>
			<td>{{$datas->primary_email}}</td>
			<td> Secondary Email ID</td>
			<td>{{$datas->secondary_email}}</td>
			
		</tr>
			<tr>
			<td>Website</td>
			<td>{{$datas->website}}</td>
			<td>Facebook Link</td>
			<td>{{$datas->facebook_link}}</td>
		</tr>
			<tr>
			<td>Twitter Link</td>
			<td>{{$datas->twiter}}</td>
			<td>Instagram Link</td>
			<td>{{$datas->instagram}}</td>
		</tr>

			<tr>
			<td>Other Social Link</td>
			<td>{{$datas->other_social_link}}</td>
			<td>PAN Number</td>
			<td>{{$datas->pan}}</td>
		</tr>
			<tr>
			<td>Name on the PAN Card</td>
			<td>{{$datas->name_of_pan}}</td>
			<td>GST No.</td>
			<td>{{$datas->gst_no}}</td>
		</tr>
			<tr>
			<td>GST Name</td>
			<td>{{$datas->gst_name}}</td>
			<td>GST Email</td>
			<td>{{$datas->gst_email}}</td>
		</tr>
			<tr>
			<td>GST Contact Number</td>
			<td>{{$datas->gst_contact}}</td>
			<td>GST Address</td>
			<td>{{$datas->gst_address}}</td>
		</tr>
			<tr>
			<td>Accounts Dept. Contact No.</td>
			<td>{{$datas->account_dept_no}}</td>
			<td>Accounts Dept. Email ID</td>
			<td>{{$datas->account_dept_email}}</td>
		</tr>
			<tr>
			<td>Logo</td>
			<td>
               @if($datas->logo!="")
            <img src="{{url('/public/uploads/company_profile/'.$datas->logo)}}" style="width: 100px">
               @endif
				</td>
			<td>PAN Card</td>
			<td>@if($datas->pan_card!="")
            <img src="{{url('/public/uploads/company_profile/'.$datas->pan_card)}}" style="width: 100px">
               @endif</td>
		</tr>
			 <tr>
			<td>GST Certificate</td>
			<td>
               @if($datas->gst_certificate!="")
            <img src="{{url('/public/uploads/company_profile/'.$datas->gst_certificate)}}" style="width: 100px">
               @endif
				</td>
			<td>ID Proof</td>
			<td>@if($datas->id_proof!="")
            <img src="{{url('/public/uploads/company_profile/'.$datas->id_proof)}}" style="width: 100px">
               @endif</td>
		</tr>
		<tr>
			<td>Address Proof</td>
			<td>
               @if($datas->address_proof!="")
            <img src="{{url('/public/uploads/company_profile/'.$datas->address_proof)}}" style="width: 100px">
               @endif
				</td>
			<td>Registration Proof</td>
			<td>@if($datas->registration_proof!="")
            <img src="{{url('/public/uploads/company_profile/'.$datas->registration_proof)}}" style="width: 100px">
               @endif</td>
		</tr>
		<tr>
			@if($datas->other_first_name!="" && $datas->other_first_image!="")
			<td>{{$datas->other_first_name}}</td>
			<td>
               @if($datas->other_first_image!="")
            <img src="{{url('/public/uploads/company_profile/'.$datas->other_first_image)}}" style="width: 100px">
               @endif
				</td>
			@endif
			@if($datas->other_second_name!="" && $datas->other_second_image!="")
			<td>{{$datas->other_second_name}}</td>
			<td>@if($datas->other_second_image!="")
            <img src="{{url('/public/uploads/company_profile/'.$datas->other_second_image)}}" style="width: 100px">
               @endif</td>
               @endif
		</tr>
		@if(Sentinel::check())
<!--New Role Start-->
        @if(Sentinel::getUser()->inRole('super_admin'))
		<tr>
			<td colspan="4" style="text-align: center;">
				<a href="{{URL::to('/Edit-Company-Profile/'.$datas->id)}}"><button class="btn btn-success">Edit</button></a>
			</td>
		</tr>
		@endif
		@endif
	</tbody>
</table>
@endforeach
</div>
<!-- /.box-body -->
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


<!-- /.content-wrapper -->
@endsection

