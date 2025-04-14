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
<div class="box">
<div class="box-header">
<h3 class="box-title">Deleted Leads</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
 @if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('employee') )
<div class="add">
<a href="{{URL::to('/add_customer')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Lead</a>
</div>
@endif
@endif
<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
<p>Query Deleted Successfully.</p>
</div>
<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">

<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul> 
</div>
<table id="example1" class="table table-bordered table-striped example1">

<thead>
<tr>

<!-- <th>#</th> -->
<th>S.No.</th>
<th>Name</th>
<th >Email</th>

<th>Package Name</th>


<th>Destination</th>
<th width="100px">Travel Date</th>


<th width="150px">Leads Date & Time</th>


</tr>
</thead>
<tbody>
  <?php
$count="1";
  ?>
@foreach($queries as $key=>$query) 

<tr >


<td>{{$count++}}</td>
<td>{{$query->name}}
@if($query->country_of_residence!="")
  <br>
  <hr style="margin: 0px; border-top: 1px solid #fff;">
{{$query->country_of_residence}}
  @endif
@if($query->mobile!="")
  <br>
  <hr style="margin: 0px;border-top: 1px solid #fff;">
{{$query->mobile}}
  @endif

</td>
<td >{{$query->email}} 
  <br>
  <hr style="margin: 0px;border-top: 1px solid #fff;">
@if($query->span_value_adult!="" && $query->span_value_adult!="0")  
{{$query->span_value_adult}}A 
@endif
@if($query->span_value_child!="" && $query->span_value_child!="0")  
{{$query->span_value_child}}C 
@endif
@if($query->span_value_infant!="" && $query->span_value_infant!="0")  
{{$query->span_value_infant}}F
@endif
</td>

<td>
  @if(is_numeric($query->packageId))
  <a href="{{url('/Holidays/'.str_slug(CustomHelpers::get_package_name($query->packageId)).'?package_id='.CustomHelpers::custom_encrypt($query->packageId))}}" target="_blank">{{CustomHelpers::get_package_name($query->packageId)}}
  </a>
  @else
  {{$query->packageId}}
  @endif
</td>

<td>{{$query->destinations}}</td>
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


<td><?php
  $newDate_flight = date("d M Y H:i", strtotime($query->created_at));
  ?>
 {{$newDate_flight}}
  <br>
  <span class="btn-group" style="display: inline-flex;">


<button type="submit" class="btn btn-default btn-xcrud btn btn-warning open-AddBookDialog" data-id="{{$query->id}}" data-toggle="modal" ><i class="fa fa-eye"></i></button>
<button type="submit" class="btn btn-success btn-xcrud btn btn-success restore" data-id="{{$query->id}}" data-toggle="modal" ><i class="fa fa-undo"></i></button>
@if(Sentinel::check())
@if(Sentinel::getUser()->roles()->first()->slug != 'employee')
<form action="{{URL::to('/detele_quotation/'.$query->id)}}" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
<span class="btn-group">
{{csrf_field()}}



<button type="submit" class="btn btn-danger deletePackage" ><i class="fa fa-times"></i></button>
</span>
</form>

@endif
@endif


</span>
@if(CustomHelpers::check_quote_exist($query->id)!="0")
<br>
<a href="{{url('/quotes/'.CustomHelpers::check_quote_exist($query->id))}}" target="_blank"><button type="submit" class="btn  btn-info "  >View Quote</button></a>
<input type="hidden"  value="{{url('/quotes/'.CustomHelpers::check_quote_exist($query->id))}}" id="copy{{$query->id}}">
<button type="submit" class="btn btn-success link" link="copy{{$query->id}}">Link</button>
@endif
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

<!-- Modal -->
<div class="modal fade" id="addBookDialog" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<input type="hidden" name="" value="" id="bookId">
<h4 class="modal-title">Customer Detail</h4>
</div>
<div class="modal-body custom_border" id="modal-body" style="font-size: 15px;
line-height: 24px;">

<!---->

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

$(document).ready(function () {
  //
$(document).on('click','.restore',function(){
var id = $(this).data('id');
var r=confirm("Are you sure Recover This Lead ?")
if (r==true)
{
  $.ajax({
type:'post',
url: APP_URL+'/recover_lead',
// dataType: 'json',
data: {id:id},

success:function(data){
//console.log('Sucess : '+data,);

location.reload();


},    

error: function (data) {
//console.log('Error : '+data);

}
});
}
else
{

}
})

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
//

});
</script>
<!-- /.content-wrapper -->
@endsection

