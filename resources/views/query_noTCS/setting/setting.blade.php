@extends('layouts.master')
@section('content')
<style type="text/css">
.small_class
{
  height: 30px;
  overflow:hidden;
  
 
}
.big_class 
{
    height: auto;

 
    
}
.nav-tabs > li {
    float: left;
    margin-bottom: -1px;
    width: 12% !important;
    text-align: center;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">
<ul class="nav nav-tabs">
<!-- <li class="active"><a href="#tab1" data-toggle="tab">General</a></li> -->


<li class="active"><a href="#tab8" data-toggle="tab">Quotation Header</a></li>

<li ><a href="#tab9" data-toggle="tab">Quotation Footer</a></li>


</ul>
</h3>
</div>
<div class="panel-body">
<div class="tabbable">
<div class="tab-content">
@if(Session::has('success'))
<div class="alert alert-warning alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif


<!--quotation header-->
<div class="tab-pane active" id="tab8">
<div class="box">
<div class="box-header">
</div>
<!-- /.box-header -->
<div class="box-body">
<table  class="table table-bordered table-striped example1">
<div class="add">
<button data-toggle="modal" data-target="#addquotationheader" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add </button>
<div class="modal fade" id="addquotationheader" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
<h3 class="modal-title" id="lineModalLabel">Add Quotation Header</h3>
</div>
<div class="modal-body">
<!-- content goes here -->
<form action="{{URL::to('/save-quotationheader')}}" method="POST">
{{csrf_field()}}

<div class="row form-group">
<label class="col-md-3 control-label text-left"> Header Name</label>
<div class="col-md-8">
<textarea class="form-control"  name="quotationheader" id="quotationheader" cols="70" rows="1" required></textarea>
</div>
</div>

<div class="row form-group">
<label class="col-md-12 control-label text-left"> Header Description</label>
<div class="col-md-11">
<textarea class="form-control ckeditor" name="header_desc" id="header_desc" cols="50" rows="2" required></textarea>
</div>
</div>





<div class="row form-group">
<label class="col-md-3 control-label text-left">Status</label>
<div class="col-md-8">
<select name="quotation_header_status" class="form-control quotation_header_status" id="">
<option value="1">Enable</option>
<option value="0">Disable</option>
</select>
</div>
</div>

</div>
<div class="modal-footer">
<div class="btn-group btn-group-justified" role="group" aria-label="group button">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
</div>
<div class="btn-group" role="group">
<button type="submit" id="savePackageTypes" class="btn btn-primary" data-action="save" role="button">Add</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="modal fade edit_quotationheader" id="edit_quotationheader" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
<h3 class="modal-title" id="lineModalLabel">Edit Quotation Header</h3>
</div>
<div class="modal-body">
<!-- content goes here -->
<form action="{{URL::to('/save-quotationheader')}}" method="POST">
{{csrf_field()}}
<input type="hidden" value="" name="id" class="edittypeid"/>
<div class="row form-group">
<label class="col-md-3 control-label text-left">Header Name</label>
<div class="col-md-8">
<textarea class="form-control notes_name" name="quotationheader" id="quotationheader" cols="70" rows="1" required></textarea>

</div>
</div>

<div class="row form-group">
<label class="col-md-12 control-label text-left"> Header Description</label>
<div class="col-md-11">
<textarea class="form-control ckeditor" name="header_desc" id="header_desc" cols="50" rows="2" required></textarea>
</div>
</div>





<div class="row form-group">
<label class="col-md-3 control-label text-left">Status</label>
<div class="col-md-8">
<select name="quotation_header_status" class="form-control pkgPayPolicyStatus" id="">
<option value="1">Enable</option>
<option value="0">Disable</option>
</select>
</div>
</div>

</div>
<div class="modal-footer">
<div class="btn-group btn-group-justified" role="group" aria-label="group button">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
</div>
<div class="btn-group" role="group">
<button type="submit" id="updatePkgTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<thead>
<tr>
<th><input class="checkboxcls" value="3" type="checkbox"></th>
<th>#</th>
<th>Header Name</th>
<th style="width: 406px;">Header Description</th>
<th>Status</th>
<th style="width: 70px;">Action</th>
</tr>
</thead>
<tbody>
@foreach($quotation_header as $key=>$pol)   
<tr id="editquoheader_{{$pol->id}}">
<td><input class="checkboxcls" value="3" type="checkbox"></td>
<td class="center">{{++$key}}</td>
<td class="quo_header">{{$pol->header}}</td>
<td class="quo_desc">
<input type="hidden" name="" value="{{$pol-> header_desc}}">
<div class="wrap_small">
<div class="small_class">
  {!! $pol-> header_desc !!}
</div>
<a href="" id="show_more">Show More</a>

</div>
</td>
<td class="quo_status center">
@if ($pol->status == 1)
<label class="label label-success">Enable</label>  
@else
<label class="label label-danger">Disable</label>
@endif
<input  type="hidden" name="status" value="{{$pol->status}}">
</td>
<td>


<form action="{{URL::to('/delete_quotationheader')}}" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
{{csrf_field()}} 
<input type="hidden" name="id" value="{{$pol->id}}"/>
<a class="btn btn-warning editquotationheader" data-id="{{$pol->id}}" data-toggle="modal"  data-target="#edit_quotationheader" href="#" style="display: inline;padding: 2px 6px !important;">Edit</a> 
<!--<a href="#" data-id="{{$pol->id}}" class="btn btn-danger deletePkgType"><i class="fa fa-times"></i></a>-->
<button class="btn-danger" style="display: inline;;border-radius: 5px;padding-top: 0px">Delete</button>



</form>
</td>
</tr>
@endforeach

</tbody>
</table>
</div>
<!-- /.box-body -->
</div>
</div>


<!--quotation_footer-->
<div class="tab-pane " id="tab9">
<div class="box">
<div class="box-header">
</div>
<!-- /.box-header -->
<div class="box-body">
<table  class="table table-bordered table-striped example1">
<div class="add">
<button data-toggle="modal" data-target="#addquotationfooter" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add </button>
<div class="modal fade" id="addquotationfooter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
<h3 class="modal-title" id="lineModalLabel">Add Quotation Footer</h3>
</div>
<div class="modal-body">
<!-- content goes here -->
<form action="{{URL::to('/save-quotationfooter')}}" method="POST">
{{csrf_field()}}

<div class="row form-group">
<label class="col-md-3 control-label text-left"> Footer Name</label>
<div class="col-md-8">
<textarea class="form-control"  name="quotationfooter" id="quotationfooter" cols="70" rows="1" required></textarea>
</div>
</div>

<div class="row form-group">
<label class="col-md-12 control-label text-left"> Footer Description</label>
<div class="col-md-11">
<textarea class="form-control ckeditor" name="footer_desc" id="footer_desc" cols="50" rows="2" required></textarea>
</div>
</div>





<div class="row form-group">
<label class="col-md-3 control-label text-left">Status</label>
<div class="col-md-8">
<select name="quotation_footer_status" class="form-control quotation_footer_status" id="">
<option value="1">Enable</option>
<option value="0">Disable</option>
</select>
</div>
</div>

</div>
<div class="modal-footer">
<div class="btn-group btn-group-justified" role="group" aria-label="group button">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
</div>
<div class="btn-group" role="group">
<button type="submit" id="savePackageTypes" class="btn btn-primary" data-action="save" role="button">Add</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="modal fade edit_quotationfooter" id="edit_quotationfooter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
<h3 class="modal-title" id="lineModalLabel">Edit Quotation Footer</h3>
</div>
<div class="modal-body">
<!-- content goes here -->
<form action="{{URL::to('/save-quotationfooter')}}" method="POST">
{{csrf_field()}}
<input type="hidden" value="" name="id" class="edittypeid"/>
<div class="row form-group">
<label class="col-md-3 control-label text-left">Footer Name</label>
<div class="col-md-8">
<textarea class="form-control notes_name" name="quotationfooter" id="quotationfooter" cols="70" rows="1" required></textarea>

</div>
</div>

<div class="row form-group">
<label class="col-md-12 control-label text-left"> Footer Description</label>
<div class="col-md-11">
<textarea class="form-control ckeditor" name="footer_desc" id="footer_desc" cols="50" rows="2" required></textarea>
</div>
</div>





<div class="row form-group">
<label class="col-md-3 control-label text-left">Status</label>
<div class="col-md-8">
<select name="quotation_footer_status" class="form-control quotation_footer_status" id="">
<option value="1">Enable</option>
<option value="0">Disable</option>
</select>
</div>
</div>

</div>
<div class="modal-footer">
<div class="btn-group btn-group-justified" role="group" aria-label="group button">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
</div>
<div class="btn-group" role="group">
<button type="submit" id="updatePkgTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<thead>
<tr>
<th><input class="checkboxcls" value="3" type="checkbox"></th>
<th>#</th>
<th>Footer Name</th>
<th style="width: 406px;">Footer Description</th>
<th>Status</th>
<th style="width: 70px;">Action</th>
</tr>
</thead>
<tbody>
@foreach($quotation_footer as $key=>$pol)   
<tr id="editquofooter_{{$pol->id}}">
<td><input class="checkboxcls" value="3" type="checkbox"></td>
<td class="center">{{++$key}}</td>
<td class="quo_footer">{{$pol->footer}}</td>
<td class="quo_desc">
<input type="hidden" name="" value="{{$pol-> footer_desc}}">
<div class="wrap_small">
<div class="small_class">
  {!! $pol-> footer_desc !!}
</div>
<a href="" id="show_more">Show More</a>

</div>
</td>
<td class="quo_status center">
@if ($pol->status == 1)
<label class="label label-success">Enable</label>  
@else
<label class="label label-danger">Disable</label>
@endif
<input  type="hidden" name="status" value="{{$pol->status}}">
</td>
<td>


<form action="{{URL::to('/delete_quotationfooter')}}" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
{{csrf_field()}} 
<input type="hidden" name="id" value="{{$pol->id}}"/>
<a class="btn btn-warning editquotationfooter" data-id="{{$pol->id}}" data-toggle="modal"  data-target="#edit_quotationfooter" href="#" style="display: inline;padding: 2px 6px !important;">Edit</a> 
<!--<a href="#" data-id="{{$pol->id}}" class="btn btn-danger deletePkgType"><i class="fa fa-times"></i></a>-->
<button class="btn-danger" style="display: inline;;border-radius: 5px;padding-top: 0px">Delete</button>



</form>
</td>
</tr>
@endforeach

</tbody>
</table>
</div>
<!-- /.box-body -->
</div>
</div>
<!---->          





</div>
</div>
</div>

</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection