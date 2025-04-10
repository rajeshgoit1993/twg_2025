@extends('layouts.master')
@section('content')
<style type="text/css">
	.custom_sor .dt-buttons
	{
		display: none;
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
<h3 class="box-title">Package Management</h3>
</div>
<!-- /.box-header -->
<div class="box-body custom_sor">
<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
<p>Package Deleted Successfully.</p>
</div>
<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul> 
</div>
<table  class="table table-bordered table-striped ">
<div class="row">
	<div class="col-md-8">
     @if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
		<div class="add">
<a href="{{URL::to('/add-package')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Package</a>

</div>
@endif
@endif
</div>
<div class="col-md-4">
	<input type="text" id="packages_searchs" class="form-control" name="" placeholder="Search... By Package Name or Country">
</div>
	
</div>
<thead>
<tr>
<th>S. No.</th>
<th>Image</th>
<th style="width: 100px">Package Name</th>
<th>No of Days</th>
<th>Price</th>
<th>Destination</th>
@if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
<th>Supplier Name </th>

<th>Image Upload</th>
@endif
@endif
@if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
<th>Package Status</th>

<th>First Page Package Status</th>
@endif
@endif
<th style="width: 200px">Actions</th>
</tr>
</thead>
<?php
 $i="1";
 ?>  
<tbody id="list_dynamic_data">
              
@foreach($all_packages as $package) 
<tr>
<td>{{$i++}}</td>
                 <!--  <td>{{$package->id}}</td> -->
 <?php  

$gallery_id=CustomHelpers::get_first_galleryid($package->id);
 ?>
 <td style="width: 10%;">


 @if(CustomHelpers::get_image_gallery($gallery_id,'thum_small')!="0")
<img src="{{CustomHelpers::get_image_gallery($gallery_id,'thum_small')}}" href="#" class="img-responsive">
@elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_small')=="0")
<img src="{{url('/public/uploads/no.png')}}" href="#" class="img-responsive">
@endif	

</td>

<td>
@if(is_numeric($package->id))
 
  <a href="{{url('/Holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))}}" target="_blank">{{$package->title}}
  </a>
 
@endif


	</td>
<td>{{$package->duration}} Nights</td>
<td>
	
@if($package->onrequest == 1 && $package->upcoming == 1)
On Request 
@elseif($package->onrequest != 1 && $package->upcoming == 1)

@if(CustomHelpers::get_price($package->id)=="On Request")
 {{ CustomHelpers::get_price($package->id)  }}  
@else
&#x20B9 {{ CustomHelpers::get_price($package->id)  }}  
@endif

@elseif($package->onrequest == 1 && $package->upcoming != 1)

@if(CustomHelpers::get_up_price($package->id)=="On Request")
 {{ CustomHelpers::get_up_price($package->id)  }}  
@else
&#x20B9 {{ CustomHelpers::get_up_price($package->id)  }}  
@endif


 
                  
@endif
</td>

<td>{{substr(implode(',',unserialize($package->country)),0,15)}} 
	@if(strlen(implode(',',unserialize($package->country)))>=15) ... @endif</td>
  @if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
 <td>{{ CustomHelpers::get_supplier_data($package->id,"supplier_name")  }}  </td>                 
<td><a href="{{URL::to('/packageUploads/'.$package->id)}}">Uploads</a></td>
@endif
@endif

 @if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))

<td>
@if($package->status == 1)

<button type="button" class=" btn-success btn_enable" value="{{$package->id}}">Disable</button>
@else
<button type="button" class=" btn-danger btn_enable" value="{{$package->id}}">Enable</button>
@endif


</td>

<td>
@if($package->front_show == 1)
<button type="button" class=" btn-success btn_front_enable" value="{{$package->id}}">Disable</button>
@else
<button type="button" class=" btn-danger btn_front_enable" value="{{$package->id}}">Enable</button>
@endif
</td>
@endif
@endif
<td>
   @if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
<form action="{{URL::to('/delete-package')}}"  method="POST" id="packagedel{{$package->id}}">
 {{csrf_field()}}
<input type="hidden" name="id" value="{{$package->id}}"/>
	</form>
  @endif
@endif
<span class="btn-group">
     @if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))      
<button class="btn btn-default btn-xcrud btn btn-warning" >
	<a href="{{ URL::to('/editpackage/'.$package->id) }}" style="color:white">
 Edit
</a>
</button>
<button class="btn btn-default btn-xcrud btn btn-info"><a style="color:white" href="{{ URL::to('/clonepackage/'.$package->id) }}">
 Clone
</a></button>
 @endif
@endif
 @if(Sentinel::check())
 @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
<button  id="packagedel{{$package->id}}" class="btn btn-danger deletePackage" > Delete </button>
 @endif
@endif
</span>

</td>
</tr>

@endforeach
<tr>
  <td colspan="11">
    <div class="package_list_paginate" style="text-align: center;">
  {{ $all_packages->links() }}

</div>

  </td>
</tr>
</tbody>


</table>
</div>
<!-- /.box-body -->
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section("custom_js_code")
<script type="text/javascript">

	$(document).on("click",".deletePackage",function(e){
		e.preventDefault()
var user_choice = window.confirm('Would you like to continue?');
var delete_id=$(this).attr("id")
if(user_choice==true) {


document.getElementById(delete_id).submit()


} else {


return false;


}
		

	})
	//
	$(document).on("click",".package_list_paginate .pagination a",function(e){
e.preventDefault()

var page=$(this).attr('href').split('page=')[1];
fetch_datas(page);
})
	//
	
 function fetch_datas(page)
{
  $("#list_dynamic_data").html("").html('<div class="loading" style="" ></div>')
       
       var APP_URL = $('#baseurl').val();    
       var key=$("#packages_searchs").val();
     
        $.ajax({
        type:'get',
        url: APP_URL+"/package_list_filter_data?page="+page,
        data: {key:key},
         cache: false,         
        success:function(data)
        {
        $("#list_dynamic_data").html("").html(data)
      
       },
       error:function()
       {

       }
       })
       
}
//
// $(document).on("click",".details",function(){
//    $(this).siblings("form").attr('target', '_blank') 
//      $(this).siblings("form").submit()
// })
//
$(document).on("keyup","#packages_searchs",function(){

    fetch_data();
    
})

//
 function fetch_data()
{
  $("#list_dynamic_data").html("").html('<div class="loading" style="" ></div>')
       
       var APP_URL = $('#baseurl').val();    
       var key=$("#packages_searchs").val();
      
        $.ajax({
        type:'get',
        url: APP_URL+"/package_list_filter_data",
        data: {key:key},
        cache: false,          
        success:function(data)
        {
        $("#list_dynamic_data").html("").html(data)
      
       },
       error:function()
       {

       }
       })
       
}
</script>
@endsection