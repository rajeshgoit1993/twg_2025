@extends('layouts.master')
@section('content')
<style>
.error{color: red}
.bor_cen {
border-top:1px solid lightgray;
border-bottom:1px solid lightgray;
padding: 5px 10px
}
.bor {
border:1px solid lightgray;
padding: 5px 10px;
cursor: pointer;
}
.checkbox_spn {
margin-right: 10px;
position: relative;
top: -1px;
margin-left: 4px;
}
.btnblue {
display: inline-block;
background: #008cff;
padding: 4px 12px;
font-size: 16px;
line-height: 18px;
color: #fff;
text-align: center;
vertical-align: middle;
cursor: pointer;
border: 1px solid #008cff;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
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
.requiredcolor {
color: #E12D2D;
}
.font-weight600 {
font-weight: 600;
}
.color9B {
color: #9B9B9B;
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
<div>
<a href="{{route('payment_mode')}}" class="btn btn-success" style="margin-right: 20px"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
<h3 class="box-title">Edit Payment Mode</h3>
</div>
</div>
<!-- /.box-header -->
<div class="box-body" >
<form action="{{URL::to('/update_payment_mode')}}" method="Post" id="supplierform" enctype="multipart/form-data">
<input type="hidden" name="id" value="{{$payment_mode_data->id}}">
{{csrf_field()}}
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="supplierid">Payment Mode Name<span class="requiredcolor">*</span></label>
<input type="text" class="form-control" id="mode" name="mode" value="{{$payment_mode_data->mode}}" placeholder="Payment Mode Name" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="suppliercompanytype">Gateway <span class="requiredcolor">*</span></label>
<select class="form-control" id="gateway_id" name="gateway_id" required>
<option value="" selected disabled>Select Gateway</option>
@foreach($data as $datas)
<option value="{{$datas->id}}" @if($payment_mode_data->gateway_id==$datas->id) selected @endif>{{$datas->gateway_name}}</option>
@endforeach
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="supplierpincode">MDR (%)<span class="requiredcolor">*</span></label>
<input type="number" min="0" class="form-control" id="mdr" name="mdr" placeholder="MDR" required value="{{$payment_mode_data->mdr}}">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="supplierpincode">GST on MDR (%) <span class="requiredcolor">*</span></label>
<input type="number" min="0" class="form-control" id="gst_on_mdr" name="gst_on_mdr" placeholder="GST on MDR" required value="{{$payment_mode_data->gst_on_mdr}}">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="suppliercompanytype">Status<span class="requiredcolor">*</span></label>
<select class="form-control" id="status" name="status">
<option value="" selected disabled>Select</option>
<option value="1" @if($payment_mode_data->status==1) selected @endif>Enable</option>
<option value="0" @if($payment_mode_data->status==0) selected @endif>Disable</option>
</select>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<div class="text-center appendBottom20">
<button type="submit" name="submit" id="form_submit" class="btnblue font-weight600 location_add" style="width: 20%;height: 30px">Update</button>
</div>
</form>
</div>
<!-- /.box-body -->
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<!-- /.content-wrapper -->
@endsection