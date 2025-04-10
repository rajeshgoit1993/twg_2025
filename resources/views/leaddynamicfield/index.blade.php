@extends('layouts.master')
@section('content')
<style>
.pdngTwenty {
	padding: 20px;
	}

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
<style>
body {font-family: Arial, Helvetica, sans-serif;}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content */
.modalContent {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s;
  border-radius: 5px;
  overflow: hidden;
  }
/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}
@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}
/* The Close Button */
.close {
  color: #000001;
  float: right;
  font-size: 28px;
  font-weight: 600;
}
.close:hover, .close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.modalHeader {
  padding: 0 10px;
  background: #f2f2f2;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.modalHeader h2 {
  font-size: 24px;
  line-height: 26px;
  color: #000001;
  font-weight: 600;
  text-align: left;
  }
.modal-body {
	padding: 16px;
	}
.modal-footer {
  padding: 20px;
  background-color: #5cb85c;
  color: white;
}
</style>
<style>
#overlay{
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
  height:100%;
  display: none;
  background: rgba(0,0,0,0.6);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% {
    transform: rotate(360deg);
  }
}
.is-hide{
  display:none;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
	<!-- Main content -->
	<section class="content" id="content">
		<div class="row">
			<div class="">
				<div class="box pdngTwenty">
					@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') )
					<a href="" class="btn btn-success appendRight20 add_country"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
					<div class="box-header">
						<h3 class="box-title">
							@if($val==1)
							Lead Cancelled Reasons
							@elseif($val==2)
							Add Lead Follow-up
							@elseif($val==3)
							Booking Status
							@elseif($val==4)
							Lead Payment Status
							@elseif($val==5)
							Payment Method
							@elseif($val==6)
							Service Type
							@elseif($val==7)
							Service Status
							@elseif($val==8)
							Booking Label
							@endif
						
					 </h3>
					</div>
					@endif
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
									<th style="width: 40px">S.No</th>
									<th style="width: 140px">Name</th>
									<th style="width: 70px">Status</th>
									<th style="width: 70px">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php $a=1; ?>
								@foreach($datas as $data)
								<tr>
									<td>{{$a++}}</td>
									<td>{{$data->field_name}}</td>
									<td>
										@if($data->status==1)
<p style="background:green;color:white;padding:2px 5px;text-align:center">Enabled</p>
										@else
<p style="background:red;color:white;padding:2px 5px;text-align:center">Disabled</p>
										@endif
										

									</td>
									<td>
                                      <a href="#" id="{{$data->id}}" class="edit btn btn-warning fontSize14 lineHeight14 borderRadius3">Edit</a>
                                  
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!--Edit Country-->
<div id="myModal" class="modal">
<!-- Modal content -->
	<div class="modalContent">
		<div class="modalHeader">
			<div>
				<h2>Edit</h2>
			</div>
			<div>
				<span class="close">&times;</span>
			</div>
		</div>
        <form action="#" method="post" id="lead_field_update" name="lead_field_update">
		{{csrf_field()}}
			<div class="modal-body edit_country_body">
			
			</div>
		</form>
	</div>
</div>

<!--Add_country-->
<div id="add_country" class="modal">
	<!-- Modal content -->
	<div class="modalContent">
		<div class="modalHeader">
			<div>
				<h2>Add</h2>
			</div>
			<div>
				<span class="close">&times;</span>
			</div>
		</div>
		<form action="#" method="post" id="lead_field_save" name="lead_field_save">
			{{csrf_field()}}
			<div class="modal-body">
				<input type="hidden" name="field_type" value="{{$val}}">
				<div class="form-group">
					<label for="sortname">@if($val==1)
							Lead Cancelled Reasons
							@elseif($val==2)
							Add Lead Follow-up
							@elseif($val==3)
							Booking Status
							@elseif($val==4)
							Lead Payment Status
							@elseif($val==5)
							Payment Method
							@elseif($val==6)
							Service Type
							@elseif($val==7)
							Service Status
							@elseif($val==8)
							Booking Label
							@endif</label>
					<input type="text" name="field_name" class="form-control" 
             @if($val==1)
							placeholder="Lead Cancelled Reasons"
							@elseif($val==2)
							placeholder="Add Lead Follow-up"
							@elseif($val==3)
							placeholder="Booking Status"
							@elseif($val==4)
							placeholder="Lead Payment Status"
							@elseif($val==5)
							placeholder="Payment Method"
							@elseif($val==6)
							placeholder="Service Type"
							@elseif($val==7)
							placeholder="Service Status"
							@elseif($val==8)
							placeholder="Booking Label"
							@endif

		   required>
				</div>
				<div class="form-group">
					<label for="country">Status</label>
					<select name="status" class="form-control">	
						<option value="1">Enable</option>
						<option value="0">Disable</option>
					</select>
				</div>
			
				<button type="submit" class="btn btn-success">Save</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('custom_js_code')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
// swal("Done !", 'Successfully Saved Basic Details', "success");
$(document).on('click',".edit",function(e){
	e.preventDefault();
	var id=$(this).attr('id')
	var modal = document.getElementById("myModal");
	$.ajax({
		type: 'get',
        url: APP_URL + '/edit-leatdynamictable',
        // dataType: 'json',
        data: {id:id},
        success: function (data) {
            console.log('Sucess : '+data);
            $(".edit_country_body").html('').html(data)
           modal.style.display = "block";
			},
        error: function (data) {
            //console.log('Error : '+data);
			}
		});
	})
$(document).on('click','.close',function(){
	var modal = document.getElementById("myModal");
	var add_country = document.getElementById("add_country");
	modal.style.display = "none";
	add_country.style.display = "none";
	})
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		var modal = document.getElementById("myModal");
		var modal = document.getElementById("add_country");
		if (event.target == modal) {
			modal.style.display = "none";
			}
		}
	//add_country
	$(document).on('click',".add_country",function(e){
		e.preventDefault();
		var modal = document.getElementById("add_country");
		modal.style.display = "block";
		})
	//country_save
	$("#lead_field_save").on("submit", function(e){
		e.preventDefault()
		$.ajax({
			url : APP_URL + '/lead_field_save',
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            // dataType: "JSON",
            success: function(data) {
				if(data=='success') {
					swal("Done !", 'Successfully Added', "success");
					setTimeout(function(){
						window.location.reload(1);
						}, 400);
					}
				else {
					swal("Error", data, "error");
					}
				},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				}
			});
		})
	//country_update
	$("#lead_field_update").on("submit", function(e){
		e.preventDefault()
		$.ajax({
			url : APP_URL + '/lead_field_update',
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            // dataType: "JSON",
            success: function(data) {
				if(data=='success') {
					swal("Done !", 'Successfully Updated', "success");
					setTimeout(function(){
						window.location.reload(1);
						}, 400);
					}
				else {
					swal("Error", data, "error");
					}
				},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				}
			});
		})
	$(document).on('click',".delete",function(e){
		e.preventDefault();
		var id=$(this).attr('id')
		var button=$(this).parent().parent()
		// .css('display','none')
		var isGood =confirm('Are you sure ?');
		if (isGood) {
			$("#overlay").fadeIn(300);
			$.ajax({
				type: 'get',
				url: APP_URL + '/delete-country',
				// dataType: 'json',
				data: {id:id},
				success: function (data) {
					button.css('display','none')
					console.log(data)
					$("#overlay").fadeOut(300);
					},
				error: function (data) {
					//console.log('Error : '+data);
					}
				});
			} else {
				
			}
		})
</script>
@endsection