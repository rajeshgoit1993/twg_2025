@extends('layouts.front.masternoindex')
 @section('content')

<style type="text/css">
.custom-margin {
	margin-top: 10px;
	margin-bottom: 10px
	}
.error {
	color: red
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
			<div class="col-md-4">
				<h1>Password Reset</h1>
					<form action="{{url('Password-Reset/'.Request::segment(2).'/'.Request::segment(3))}}" method="post" name="password_reset_form">
					{{ csrf_field() }}
						<label>Enter New Password</label>
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon" style="border-radius: 5px 0px 0px 5px"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="text" name="password" placeholder="New Password" class="form-control" style="border-radius: 0px 5px 5px 0px">
							<span id="password_error" class="error"></span>
						</div>
						
						<label>Re-enter Password</label>
						<div style="margin-bottom: 40px" class="input-group">
							<span class="input-group-addon" style="border-radius: 5px 0px 0px 5px"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="text" name="cpassword" placeholder="Re-enter new Password" class="form-control" style="border-radius: 0px 5px 5px 0px">
							<span id="cpassword_error" class="error"></span>
						</div>
						
						<button type="submit" class="btn btn-success" style="font-size: 18px;border-radius: 5px;font-weight: 600;background-color: #204d74;border-color: #122b40" >SUBMIT</button>
					</form>
					<br>
			</div>
			<div class="col-md-4"></div>
	</div>
</div>
<script type="text/javascript">
document.password_reset_form.onsubmit=function(){ return pass_reset()};
function pass_reset() {
	var password=document.password_reset_form.password.value;
	var cpassword=document.password_reset_form.cpassword.value;
	if(password.trim()=="") {
		document.querySelector("#password_error").innerHTML="Enter Password";
		return false;
		}
	else if(password.trim()!="" && password.length<6) {
		document.querySelector("#password_error").innerHTML="Enter minimum 6 characters";
		return false
		}
	else if(cpassword.trim()=="") {
		document.querySelector("#password_error").innerHTML="";
		document.querySelector("#cpassword_error").innerHTML="Enter new password";
		return false;
		}
	else if(password!=cpassword) {
		document.querySelector("#password_error").innerHTML="";
       	document.querySelector("#cpassword_error").innerHTML="Re-enter Password";
       	return false;
		}
	}
</script>
 @endsection