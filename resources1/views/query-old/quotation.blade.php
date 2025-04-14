@extends('layouts.master')
@section('content')
<style type="text/css">
.custom_border .row
{

padding: 5px 0px
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
<h3 class="box-title">Quotation Management</h3>
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
@if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
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
<th >S.No.</th>
<th>Reference No</th>
<th>Name</th>

<th>Package Name</th>


<th>Destination</th>
<th width="100px">Travel Date</th>
<th>Status</th>
<th>Quote status</th>
<th>Quote Date & Time</th>
<th>Quotation Send</th>


</tr>
</thead>
<tbody>
  <?php
$count="1";
  ?>
@foreach($data as $key=>$query) 

@if(CustomHelpers::get_query_field($query->query_reference,'status')=='' || CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent")
<tr>


<td>{{$count++}}</td>
<td>{{$query->quo_ref}}</td>
<td>{{$query->name}}
  @if($query->nationality!="")

<p style="margin: 0px;border-top: .5px solid #908282;">{{$query->nationality}}</p>
@endif
@if($query->email!="")

<p style="margin: 0px;border-top: .5px solid #908282;">{{$query->email}}</p>
@endif
@if($query->mobile!="")

<p style="margin: 0px;border-top: .5px solid #908282;">{{$query->mobile}}</p>
@endif
<p style="margin: 0px;border-top: .5px solid #908282;">
  @if($query->adult!="" && $query->adult!="0")  
{{$query->adult}}A 
@endif
@if($query->child!="" && $query->child!="0")  
+ {{$query->child}}C 
@endif
@if($query->infant!="" && $query->infant!="0")  
+ {{$query->infant}}F
@endif
</p>
<hr style="margin:5px">
<a href="{{url('/quotes/'.$query->unique_code)}}" target="_blank"><button type="submit" class="btn  btn-info " data-id="{{$query->id}}"  >View Quote</button></a>
<br>
 <a href="{{URL::to('/edit_quation/'.$query->quo_ref.'/'.$query->query_reference)}}"><button  class="btn  btn-warning " >Edit</button></a>
<input type="hidden"  value="{{url('/quotes/'.$query->unique_code)}}" id="copy{{$query->id}}">
<button type="submit" class="btn btn-success link" link="copy{{$query->id}}">Link</button>
<button  class="btn  btn-info open-AddBookDialog" data-id="{{$query->query_reference}}" data-toggle="modal" >View Leads</button>
 

@if(Sentinel::check())
@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
 <form action="{{URL::to('/disable_quotation/'.$query->quo_ref)}}" onsubmit="return confirm('Do you really want to delete this.?');" method="POST" style="float: left !important;">
   
    {{csrf_field()}}

   
                      
    <button type="submit" class="btn btn-danger deletePackage">Delete</button>
    
  </form>


@endif
@endif
</td>


<td>
  @if(CustomHelpers::get_query_field($query->query_reference,'packageId')!="N" && CustomHelpers::get_query_field($query->query_reference,'packageId')!="" && is_numeric(CustomHelpers::get_query_field($query->query_reference,'packageId')))
  <a href="{{url('/Holidays/'.str_slug($query->package_name).'?package_id='.CustomHelpers::custom_encrypt(CustomHelpers::get_query_field($query->query_reference,'packageId')))}}" target="_blank">
  {{$query->package_name}}
  </a>

  @endif
  
</td>

<td>{{$query->destination}}</td>
<td>
  @if(CustomHelpers::get_query_field($query->query_reference,'date_arrival')!="N" && CustomHelpers::get_query_field($query->query_reference,'date_arrival')!="")
<?php
$date_arrival = CustomHelpers::get_query_field($query->query_reference,'date_arrival');
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
<td id={{$query->query_reference}}>
  <select class="query_status" style="width: 100px">
    
      <option value="0" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="0") selected @endif>--Choose Status--</option>
    
    
    
   <option value="quote_sent" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="quote_sent") selected  @endif>Quote sent</option>
   
   
   <option value="payment_follow_up" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="payment_follow_up") selected  @endif>Payment follow-up</option>
   
   <option value="advance_received" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="advance_received") selected  @endif>Advance received</option>
   
<option value="balance_payment" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="balance_payment") selected  @endif>Balance Payment</option>

<option value="full_payment_received" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="full_payment_received") selected  @endif>Full payment received</option>

<option value="quote_rejected" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="quote_rejected") selected  @endif>Quote rejected</option>

<option value="booked_with_other" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="booked_with_other") selected  @endif>Booked with other</option>

<option value="tour_cancelled" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="tour_cancelled") selected  @endif>Tour cancelled</option>

<option value="no_response" @if(CustomHelpers::get_query_field($query->query_reference,'status')!="N" && CustomHelpers::get_query_field($query->query_reference,'status')=="no_response") selected  @endif>No Response</option>
  </select>
</td>
<td>
  @if($query->send_option=='0' && $query->accept_status=='0')
   <p style="color:#08acef">Not Sent</p>
  @elseif($query->send_option=='1' && $query->accept_status=='0')
   <p style="color:#ed5249">No Response</p>
  @elseif($query->send_option=='1' && $query->accept_status=='1')
<p style="color:green">Quote Accepted</p>
 @elseif($query->send_option=='0' && $query->accept_status=='1')
<p style="color:green">Quote Accepted</p>
  @elseif($query->send_option=='1' && $query->accept_status=='2')
<p style="color:#ff0011">Quote Rejected</p>
@elseif($query->send_option=='0' && $query->accept_status=='2')
<p style="color:#ff0011">Quote Rejected</p>
  @endif
  
  @if($query->quote_view=='0')
  <p style="color: red;margin-top: 10px;border-top: 1px solid black">Unseen</p>
  @else
 <p style="color: green;margin-top: 10px;border-top: 1px solid black">Seen</p>
  @endif
</td>
<td>
  <?php
  $newDate_flight = date("d M'y H:i:s", strtotime($query->created_at));
  ?>
  {{date('D', strtotime($query->created_at))}}, {{$newDate_flight}}
  <br>
  <?php
   $user_data = DB::table('users')
                ->where('id', $query->assign_id)
                ->first();
     
  ?>
  @if($user_data)
  <p style="border-top: 1px solid #fff;margin-top: 10px;padding-top: 10px"><b>Assign to: </b>{{$user_data->first_name}} {{$user_data->last_name}}</p>
  @endif
</td>
<td>
  <select class="form-control">
    <option id="0" quotation_no='0' ref_no='0'>--Choose--</option>
    {{CustomHelpers::get_quotation_option($query->quo_ref)}}
  </select>
  
  <button class="btn btn-success quotation_send" style="margin-top: 5px">Send Quote</button>
</td>


</tr>
@endif
@endforeach
</tbody>
</table>
</div>
<!-- /.box-body -->
</div>
</div>
</div>


<!---->
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
 <form action="{{URL::to('/send_custom_quote')}}"  method="POST" id="send_custom_quote">
   
  {{csrf_field()}}

  <input type="hidden" name="quote_id" id="quote_id" value="0">
  <input type="hidden" name="quote_no" id="quote_no" value="0">
  <input type="hidden" name="ref_no" id="ref_no" value="0">
</form>
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
    //
     $(document).on("click",".details",function(){
   $(this).siblings("form").attr('target', '_blank') 
     $(this).siblings("form").submit()
})
    //
});
  //
  $(document).on("click",".quotation_send",function(){
 var quo_id=$(this).siblings().find('option:selected').attr("id");
 var quo_no=$(this).siblings().find('option:selected').attr("quotation_no");
 var ref_no=$(this).siblings().find('option:selected').attr("ref_no");
 if(quo_id=="0" || quo_no=="0")
 {
  return false;
 }
 else
 {
  $("#quote_id").val("").val(quo_id)
  $("#quote_no").val("").val(quo_no)
  $("#ref_no").val("").val(ref_no)
  var r=confirm("Are you sure ?")
  if (r==true)
   {
    $('#send_custom_quote').submit();
    }
   else
   {
       return false;
   }

 }
  })
</script>
<!-- /.content-wrapper -->
@endsection

