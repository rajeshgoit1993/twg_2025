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

<section class="content">
{{--  {{dump($RoomBookings)}}  --}}
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-12">

<a href="{{URL::to('/enquiry')}}">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-question"></i></span>

<div class="info-box-content">
<span class="info-box-text">Leads</span>
</div>
</a>
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->


<!-- /.col -->
<div class="col-md-4 col-sm-6 col-xs-12">
<a href="{{URL::to('/tours')}}">
<div class="info-box">
<span class="info-box-icon bg-red"><i class="fa fa-briefcase"></i></span>

<div class="info-box-content">
<span class="info-box-text">Tour Packages</span>
</div>
<!-- /.info-box-content -->
</div>
</a>
<!-- /.info-box -->
</div>
<!-- /.col -->
</div>

<div class="row">
<div class="col-md-12">
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

<th>Status</th>
<th>Lead Verified</th>
<th width="150px">Leads Date & Time</th>


</tr>
</thead>
<tbody>
  <?php
$count="1";
  ?>
@foreach($queries as $key=>$query) 
 @if($query->lead_verified!="1")
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

@if($query->span_value_child_without_bed!="" && $query->span_value_child_without_bed!="0")  
{{$query->span_value_child_without_bed}}CWB 
@endif

@if($query->span_value_infant!="" && $query->span_value_infant!="0")  
{{$query->span_value_infant}}F
@endif
</td>

<td>
  @if(is_numeric($query->packageId))
  <?php 
$href_id1=CustomHelpers::custom_encrypt($query->id);
    $form_action=url("/Holidays/".str_slug(CustomHelpers::get_package_name($query->packageId))).'?package_id='.$href_id1;
   ?>
  <a href="{{$form_action}}" target="_blank">{{CustomHelpers::get_package_name($query->packageId)}}
  </a>
  @else
  {{$query->packageId}}
  @endif
</td>

<td>
    



<!-- destination -->
                    @if(is_numeric((int)$query->packageId))
                        <div><u><h5>Destination</h5></u></div>
                        <?php
                            $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$query->packageId, 'city');
                            Log::info('Cities from helper:', ['cities' => $cities]);

                            if ($cities === false || $cities === null || !is_string($cities)) {
                                Log::error('Invalid serialized data from helper function.');
                                $cities = [];
                            } else {
                                try {
                                    $cities = unserialize($cities);
                                    if ($cities === false && $cities !== 'b:0;') {
                                        Log::error('Unserialize returned false for non-empty data.');
                                        $cities = [];
                                    }
                                } catch (Exception $e) {
                                    Log::error('Unserialize error: ' . $e->getMessage());
                                    $cities = [];
                                }
                            }
                            if (!is_array($cities)) {
                                Log::error('Unserialized data is not an array.');
                                $cities = [];
                            }
                        ?>

                        @if(!empty($cities))
                            <ul class="q-dtls">
                                @foreach($cities as $tour_city)
                                    <li>{{ $tour_city }}</li>
                                @endforeach
                            </ul>
                        @elseif(!empty($query->destinations))
                            <ul class="q-dtls">
                              <li>{{ $query->destinations }}</li>
                            </ul>
                        @else
                            <p class="q-dtls">No destination available</p>
                        @endif

                    @else
                        @if(!empty($query->destinations))
                            <p class="q-dtls">{{ $query->destinations }}</p>
                        @else
                            <p class="q-dtls">No destinations available.</p>
                        @endif
                    @endif

                    <!-- ************* -->
 

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
  <select class="query_status" style="width: 100px">
    <option value="0" @if($query->status=="0") selected @endif>--Choose Status--</option>

<option value="interested" @if($query->status=="interested") selected @endif>Interested</option>
<option value="not_interested" @if($query->status=="not_interested") selected @endif>Not interested</option>
<option value="call_later" @if($query->status=="call_later") selected @endif>Call later</option>
<option value="phone_not_reachable" @if($query->status=="phone_not_reachable") selected @endif>Phone not reachable</option>
<option value="wrong_number" @if($query->status=="wrong_number") selected @endif>Wrong number</option>
<option value="destination_changed" @if($query->status=="destination_changed") selected @endif>Destination changed</option>
<option value="booked_with_other" @if($query->status=="booked_with_other") selected @endif>Booked with other</option>
<option value="tour_cancelled" @if($query->status=="tour_cancelled") selected @endif>Tour cancelled</option>


  </select>
</td>
<td id={{$query->id}}>
  <select class="lead_varified">

    <option value="0" @if($query->lead_verified=="0") selected @endif>No</option>
    <option value="1" @if($query->lead_verified=="1") selected @endif>Yes</option>
  </select>
</td>
<td><?php
  $newDate_flight = date("d M Y H:i", strtotime($query->created_at));
  ?>
 {{$newDate_flight}}
  <br>
  <span class="btn-group" style="display: inline-flex;">


<button type="submit" class="btn btn-default btn-xcrud btn btn-warning open-AddBookDialog" data-id="{{$query->id}}" data-toggle="modal" ><i class="fa fa-eye"></i></button>

@if(Sentinel::check())
@if(Sentinel::getUser()->roles()->first()->slug != 'employee')
<form action="{{URL::to('/detele_query/'.$query->id)}}" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
<span class="btn-group">
{{csrf_field()}}



<button type="submit" class="btn btn-danger deletePackage" ><i class="fa fa-times"></i></button>
</span>
</form>

@endif
@endif


</span>
  </td>


</tr>
@endif
@endforeach
</tbody>
</table>
</div>
</div>

 
</section>
<!-- /.content -->
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

<!-- /.content-wrapper -->
<!-- Create Sale Modal -->

<!-- Create Sale MOdal Ends Here-->
<!-- Edit Sale Modal -->
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