<?php $__env->startSection('content'); ?>
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
@keyframes  animatetop {
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
@keyframes  sp-anime {
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
<div class="card" style="padding: 20px;background: lightgray;">
	<div class="row">
		<div class="col-md-5">
			<select class="form-control" name="country" id="country">
				<option value="" selected >Select Country</option>
				<?php $__currentLoopData = $country_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<option value="<?php echo e($data->id); ?>" ><?php echo e($data->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</select>
		</div>
		<div class="col-md-2">
			<button class="btn btn-success btn-block find_state">Find State</button>
		</div>
	</div>
</div>
<section class="content" id="content">
	<div class="row">
		<div class="box pdngTwenty">
			<?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') ): ?>
			<a href="" class="btn btn-success appendRight20 add_state"><i class="glyphicon glyphicon-plus-sign"></i> Add New State</a>
			<div class="box-header">
				<h3 class="box-title">State List</h3>
			</div>
			<?php endif; ?>
			<div class="box-body">
				<?php if(Session::has('success')): ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<?php echo e(Session::get('success')); ?>

					</div>
				<?php endif; ?>
				<table id="example2" class="table table-bordered table-striped example2">
					<thead>
						<tr>
							<!--<th>S.No.</th>-->
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
				<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</section>
</div>
<!--Edit State-->
<div id="myModal" class="modal">
	<div class="modalContent">
		<div class="modalHeader">
			<div>
				<h2>Edit State</h2>
			</div>
			<div>
				<span class="close">&times;</span>
			</div>
		</div>
		<form action="#" method="post" id="country_update" name="country_update">
		<?php echo e(csrf_field()); ?>

		<div class="modal-body edit_country_body"></div>
		</form>
	</div>
</div>
<!--Add State-->
<div id="add_country" class="modal">
<!-- Modal content -->
	<div class="modalContent">
		<div class="modalHeader">
			<div>
				<h2>Add New State</h2>
			</div>
			<div>
				<span class="close">&times;</span>
			</div>
		</div>
		<form action="#" method="post" id="state_save" name="state_save">
			<?php echo e(csrf_field()); ?>

			<div class="modal-body">
				<input type="hidden" name="country_id" id="country_id">
				<div class="form-group">
					<label for="name">State</label>
					<input type="text" name="name" class="form-control" required>
				</div>
				<button type="submit" class="btn btn-success">Save</button>
			</div>
		</form>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_js_code'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
// $(document).ready(function() {
//     oTable = $('#example2').DataTable({
//         processing: true,
//         serverSide: true,
//          ajax : "<?php echo e(route('getstate')); ?>",
//           columns: [
//             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
//             {data: 'name', name: 'name'},
//             {
//                 data: 'action',
//                 name: 'action',
//                 orderable: true,
//                 searchable: true
//             },
//         ]
//     });
// });
//
$(document).on("click",".find_state",function(){
	var country=$("#country").val()
	if(country=='') {
		alert('Kindly Select Country')
		}
	else {
		get_state_datable()
		}
	})
	function get_state_datable() {
		var country=$("#country").val()
		if ($.fn.DataTable.isDataTable('#example2')) {
			$('#example2').DataTable().destroy()
			}
		var table = $('#example2').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: "<?php echo e(route('getstate')); ?>",
				data: {country:country},
				},
			columns: [
				{data: 'name', name: 'name'}, {
				data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
				},
				],
			});
		}
</script>
<script>
$(document).on('click',".edit",function(e){
	e.preventDefault();
	var id=$(this).attr('id')
	var modal = document.getElementById("myModal");
	$.ajax({
		type: 'get',
        url: APP_URL + '/edit-state',
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
	var add_country = document.getElementById("add_country");
	if (event.target == modal || event.target == add_country) {
		modal.style.display = "none";
		add_country.style.display = "none";
		}
	}
//add_country
$(document).on('click',".add_state",function(e){
	e.preventDefault();
	var country=$("#country").val()
	if(country=='') {
		alert('Kindly Select Country')
		}
	else {
		$("#country_id").val('').val(country)
		var modal = document.getElementById("add_country");
		modal.style.display = "block";
		}
	})
//country_save
$("#state_save").on("submit", function(e){
	e.preventDefault()
	$.ajax({
		url : APP_URL + '/state_save',
		type: "POST",
		data: new FormData(this),
		processData: false,
		contentType: false,
		// dataType: "JSON",
		success: function(data) {
			if(data=='success') {
				swal({
					title: "Done !",
					text: "Successfully Added !",
					icon: "success",
					timer:500
					});
				var add_country = document.getElementById("add_country");
				add_country.style.display = "none";
				get_state_datable()
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
 $("#country_update").on("submit", function(e){
 e.preventDefault()
     $.ajax({
            url : APP_URL + '/update_state',
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            // dataType: "JSON",
            success: function(data)
            {
               if(data=='success')
               {
                swal({
                  title: "Done !",
                  text: "Successfully Updated !",
                  icon: "success",
                  timer:500
                   });
               var modal = document.getElementById("myModal");
               modal.style.display = "none";
               get_state_datable()
               // swal("Done !", 'Successfully Updated', "success");
             // setTimeout(function(){
             //  window.location.reload(1);
             //  }, 400);
               }
               else
               {
              swal("Error", data, "error");
               }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
 })
//
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
			url: APP_URL + '/delete-state',
			// dataType: 'json',
			data: {id:id},
			success: function (data) {
				button.css('display','none')
				// console.log(data)
				$("#overlay").fadeOut(300);
				// get_state_datable()
				},
			error: function (data) {
				//console.log('Error : '+data);
				}
			});
		} else {
		
		}
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>