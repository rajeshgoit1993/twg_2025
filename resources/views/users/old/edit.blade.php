@extends('layouts.master')
@section('content')
<style>
span.select2.select2-container {
width: 100% !important;
}

.select2-selection--single {
	height: 34px !important;
	}
.select2-selection--single {
	padding: 6px !important;
	}
.select2-selection--multiple {
	border-radius: 3px !important;
	}
.appendAllZero {
	margin: 0px !important;
	}
.appendBottom0 {
	margin-bottom: 0px;
	}
.fontSize14 {
	font-size: 14px;
	}
.whiteText{
	color: #ffffff;
	}
.color008 {
	color: #008cff;
	}
.fontWeight700 {
	font-weight: 700;
	}
.textCenter {
	text-align: center;
	}
.borderE9 {
	border: 1px solid #e9e9e9;
	}
.borderRadius3 {
	border-radius: 3px;
	}
.profilepicattachment {
	width: 100%;
    height: 20%;
    opacity: 0;
    position: absolute;
    cursor: pointer;
	}
.upload-profilepic {
    width: 215px;
    padding: 10px;
	}
.format-txt {
    font-size: 11px;
    color: #9b9b9b;
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
.fontWeight600 {
	font-weight: 600;
	}
.paddingUpDown10 {
	padding-top: 10px;
	padding-bottom: 10px;
	}
.paddingLeftRight60 {
	padding-left: 60px;
	padding-right: 60px;
	}
</style>
<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<a href="{{ URL::previous() }}" class="btn btn-success appendRight20"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
					<h3 class="box-title">Edit User</h3>
				</div>
				<div class="box-body">
					<div class="modal-body_main">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
						</ul>
					</div>
					@endif
					<form action="{{URL::to('/postusers')}}" method="POST" enctype="multipart/form-data" class="customform" id="customform">
					{{csrf_field()}}
					<input type="hidden" name="id" value="{{$user->id}}">
					<div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group">
								<label for="profile_pic">Profile Image <span class="requiredcolor">*</span></label>
								<div id="imagePreview">
									@if($user->profile_image!='')
									<img width="225" height="200" src="{{ url('public/uploads/user_profiles/'.$user->profile_image) }}" alt="Profile Pic" class="borderE9 borderRadius3">
									@else
                                    <img width="225" height="200" src="https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png" alt="Profile Pic" class="borderE9 borderRadius3">
									@endif
								</div>
								<input type="file" @if($user->profile_image=='') required @endif id="profilepic" class="form-control profilepicattachment" name="profile_pic" accept=".jpeg,.jpg" onchange="return profilepicValidation()" @if( $user->id==Sentinel::getUser()->id) @elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')) disabled  @elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')) disabled  @endif>
								<div class="upload-profilepic">
									<p class="pfwmt textCenter fontSize14 color008 fontWeight700">UPLOAD</p>
									<p class="pfwmt textCenter format-txt">(225x200)</p>
								</div>
								
							</div>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-9">
						<div class="col-md-6">
							<div class="form-group">
								<label for="user_role">User Role <span class="requiredcolor">*</span></label>
								<input type="hidden" name="pre_user_role" value="{{CustomHelpers::get_user_role($user->id)}}">
								<select class="form-control" name="user_role" id="user_role">
								@if(Sentinel::getUser()->inRole('super_admin'))
									@foreach($roles as $role)
									<option value="{{$role->slug}}" @if(CustomHelpers::get_user_role($user->id) == $role->slug) selected="selected" @endif>{{$role->name}}</option>
									@endforeach
								@else
									@foreach($roles as $role)
									@if($role->slug!='super_admin')
									<option value="{{$role->slug}}"
									@if(Sentinel::getUser()->inRole('supervisor') && ($role->slug=='administrator' || $role->slug=='super_admin'))
									disabled
									@elseif(Sentinel::getUser()->inRole('employee') && ($role->slug=='administrator' || $role->slug=='super_admin' || $role->slug=='supervisor'))
									disabled
									@elseif(Sentinel::getUser()->inRole('agent') && ($role->slug=='administrator' || $role->slug=='super_admin' || $role->slug=='supervisor' || $role->slug=='employee'))

									disabled
									@elseif(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor')

									disabled
									@elseif(Sentinel::getUser()->inRole('employee') && CustomHelpers::get_user_role($user->id)=='employee')

									disabled
									@elseif(Sentinel::getUser()->inRole('supervisor') && $role->slug=='supervisor')
									disabled

									@elseif(Sentinel::getUser()->inRole('employee'))
									disabled
									@elseif(Sentinel::getUser()->inRole('agent'))
									disabled
									@elseif(Sentinel::getUser()->inRole('customer'))
									disabled
									 @endif
									 @if(CustomHelpers::get_user_role($user->id) == $role->slug) selected="selected" @endif>{{$role->name}}</option>
									@endif
									@endforeach
								@endif
								</select>
							</div>
						</div>
						@if(Sentinel::getUser()->id==$user->id)
						@else
						<div class="col-md-6 row makeflex flexRowReverse alignitemsCenter">
						<div class="col-md-3">
							<?php
								$sevtinel_activated=Sentinel::findById($user->id);
								if ($activation = Activation::completed($sevtinel_activated))
								{echo "<p style='background:green;color:white;padding:2px 5px;text-align:center;border-radius: 3px;display: inline-block;margin: 0px'>Activated</p>";}
							   else
							   {echo "<p style='background:#dd4b39;color:white;padding:2px 5px;text-align:center;border-radius: 3px;display: inline-block;margin: 0px'>Not Activated</p>";}
							  ?>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label for="status">Status <span class="requiredcolor">*</span></label>
								<select class="form-control select2heightpaddingleft" name="status">
									<option value="1" @if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor' ) disabled 
									@elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')) disabled  @elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')) disabled @endif @if($activation = Activation::completed($sevtinel_activated)) selected="" @else @endif >Enable</option>
									<option value="0" @if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor' ) disabled @elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')) disabled  @elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')) disabled @endif @if($activation = Activation::completed($sevtinel_activated)) @else selected="" @endif>Disable</option>
								</select>
							</div>
						</div>
						</div>
						@endif
						<div class="col-md-12"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="first_name">First Name <span class="requiredcolor">*</span></label>
								<input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" maxlength="30" placeholder="Enter First Name" @if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor') readonly @elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')) readonly @elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')) readonly @endif>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="last_name">Last Name <span class="requiredcolor">*</span></label>
								<input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" maxlength="15" placeholder="Enter Last Name" @if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor') readonly @elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')) readonly @elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')) readonly @endif>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="mobile">Mobile No <span class="requiredcolor">*</span></label>
								<input type="tel" class="form-control" name="mobile" pattern="^\d{10}$" value="{{$user->mobile}}" maxlength="10" placeholder="Enter Mobile Number" @if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor' ) readonly @elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')) readonly @elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')) readonly @endif>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">User Email</label>
								<input type="email" class="form-control" name="email" value="{{$user->email}}" value="{{old('email')}}" maxlength="40" placeholder="Enter Email ID" readonly @if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor' ) readonly
								@elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')) readonly @elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')) readonly @endif>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="password">Password <span class="requiredcolor">*</span></label>
								<input type="password" class="form-control" name="password" maxlength="6" placeholder="Enter Password" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="password_confirmation">Confirm Password <span class="requiredcolor">*</span></label>
								<input type="password" class="form-control" name="password_confirmation" maxlength="6" placeholder="Re-confirm Password" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="usercategory">User Category <span class="requiredcolor">*</span></label>
								<select class="form-control" name="usercategory">
									<option disabled selected>Select</option>
									<option value="categoryA" @if($user->usercategory=='categoryA') selected @endif>Category A</option>
									<option value="categoryB" @if($user->usercategory=='categoryB') selected @endif>Category B</option>
									<option value="categoryC" @if($user->usercategory=='categoryC') selected @endif>Category C</option>
									<option value="categoryD" @if($user->usercategory=='categoryD') selected @endif>Category D</option>
								</select>
							</div>
						</div>
						<div class="col-md-12"></div>
					<div class="col-md-6">
							<div class="form-group">
								<label for="subscription">Subscription <span class="requiredcolor">*</span></label>
								<select class="form-control subscription" name="subscription" >
									<option value="">--select one--</option>

									<option value="subscribed" @if($user->subscription=='subscribed') selected @endif>Subscribed</option>
									<option value="partialsubscribed" @if($user->subscription=='partialsubscribed') selected @else disabled @endif >Partial Subscribed</option>
									<option value="unsubscribed" @if($user->subscription=='unsubscribed') selected @endif>Unsubscribed</option>
								</select>
							</div>
						</div>
						<?php  
                        $subscription=unserialize($user->subscription_service);
                   
                      
						?>
							<div class="col-md-6">
							<label for="subscriptionservicetype">Subscription Service <span class="requiredcolor">*</span></label>
							<div class="form-group makeflex">
							<div class="makeflex alignitemsCenter appendRight20">
								<input type="checkbox" id="email" value="email" name="subscription_service[]" value="" class="appendAllZero subscription_service"  @if(is_array($subscription) && in_array('email',$subscription) &&  ($user->subscription=='subscribed' || $user->subscription=='partialsubscribed') ) checked @endif>
								<label for="email" class="appendLeft5 appendBottom0">Email</label>
							</div>
							<div class="makeflex alignitemsCenter appendRight20">
								<input type="checkbox" id="sms" value="sms" name="subscription_service[]" value="" class="appendAllZero subscription_service" 
								@if(is_array($subscription) && in_array('sms',$subscription) &&  ($user->subscription=='subscribed' || $user->subscription=='partialsubscribed') ) checked @endif>
								<label for="sms" class="appendLeft5 appendBottom0">SMS</label>
							</div>
							<div class="makeflex alignitemsCenter">
								<input type="checkbox" id="whatsapp" value="whatsapp" name="subscription_service[]" value="whatsapp" class="appendAllZero subscription_service"
								 @if(is_array($subscription) && in_array('whatsapp',$subscription) &&  ($user->subscription=='subscribed' || $user->subscription=='partialsubscribed')) checked @endif>
								<label for="whatsapp" class="appendLeft5 appendBottom0">WhatsApp</label>
							</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<label for="servicetype">Service Type <span class="requiredcolor">*</span></label>
							<div class="form-group makeflex">
							<div class="makeflex alignitemsCenter appendRight20">
						<input type="checkbox" id="tourpackage" @if($user->tourpackage==1) checked @endif name="tourpackage" value="1" class="appendAllZero" onclick="ShowHideServiceType()" />
								<label for="tourpackage" class="appendLeft5 appendBottom0">Holidays</label>
							</div>
							<div class="makeflex alignitemsCenter">
								<input type="checkbox" id="visa" name="visa" value="1" class="appendAllZero" onclick="ShowHideServiceType()" @if($user->visa==1) checked @endif />
								<label for="visa" class="appendLeft5 appendBottom0">Visa</label>
							</div>
							</div>
						</div>
					
					<div class="col-md-12" id="tourdestination" @if($user->tourpackage==1) style="display: block"  @else style="display: none" @endif  >
							<div class="form-group">
								<label for="holidaydestination">Holiday Destination <span class="requiredcolor">*</span></label>
								<?php  
                                $destinations=unserialize($user->destination);
								?>
								<select class="form-control select3" name="destination[]" id="holidaydestination" multiple>
								@if(is_array($destinations))
								 @foreach($destinations as $destination)
                                 <option value="{{$destination}}" selected>{{$destination}}</option>
								 @endforeach
								 @endif
								</select>
							</div>
						</div>
					<div class="col-md-12" id="visadestination" @if($user->visa==1) style="display: block"  @else style="display: none" @endif>
							<div class="form-group">
								<label for="visadestination">Visa Destination <span class="requiredcolor">*</span></label>
								<?php  
                                $visadestinations=unserialize($user->visadestination);
								?>
								<select class="form-control select4" name="visadestination[]" id="visadestinations" multiple>
								@if(is_array($visadestinations))
								 @foreach($visadestinations as $visadestination)
                                 <option value="{{$visadestination}}" selected>{{$visadestination}}</option>
								 @endforeach
								 @endif
								</select>
							</div>
						</div>


						<div class="col-md-12">
							<label for="servicetype">Enquiry Details<span class="requiredcolor">*</span></label>
							<div class="form-group makeflex">
							<div class="makeflex alignitemsCenter appendRight20">
						<input type="checkbox" name="lock_before_quote_send" id="lock_before_quote_send" value="1" class="appendAllZero" @if($user->lock_before_quote_send==1) checked @endif />
								<label for="lock_before_quote_send" class="appendLeft5 appendBottom0">Lock Befoure Quote Send</label>
							</div>
							<div class="makeflex alignitemsCenter">
								<input type="checkbox" id="lock_after_quote_send"  name="lock_after_quote_send" value="1" class="appendAllZero" @if($user->lock_after_quote_send==1) checked @endif />
								<label for="lock_after_quote_send" class="appendLeft5 appendBottom0">Lock After Quote Send</label>
							</div>
							</div>
						</div>

					<div class="col-md-12 fontSize14 lineHeight14 appendTop10 appendBottom5 colorA1 fontWeight600">SIGNATURE</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="makeflex justifycontentBetween">
									<label for="quotation_footer">Web Header</label>
							         <div class="makeflex alignitemsCenter">
										<input type="hidden" name="lock_header" value="{{$user->lock_header}}" class="lock_header">
										<i class="fa  @if($user->lock_header==1) fa-lock @else fa-unlock @endif colorA1 fontSize14 lock_header_icon" aria-hidden="true" style="cursor:pointer;font-size: 20px;margin-bottom: 7px;"></i>
									</div>
								</div>
								<input type="hidden" name="quotation_header" class="quotation_header" value="{{$user->quotation_header}}">
									<select  class="form-control  lock_header_box" name="" required @if($user->lock_header==1) style="cursor:not-allowed" disabled @endif>
										<option disabled>Select</option>
									@foreach($quotation_header as $pol)
<option value="{{$pol->id}}" @if($user->quotation_header==$pol->id) selected @endif>{{$pol->header}} </option>
                                    @endforeach
									</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="makeflex justifycontentBetween">
									<label for="signature">Email Header <span class="requiredcolor">*</span></label>
									<div class="makeflex alignitemsCenter">
										<input type="hidden" name="lock_header_email" value="{{$user->lock_header_email}}" class="lock_header_email">
										<i class="fa @if($user->lock_header_email==1) fa-lock @else fa-unlock @endif colorA1 fontSize14 lock_header_email_icon" aria-hidden="true" style="cursor:pointer;font-size: 20px;margin-bottom: 7px;"></i>
									</div>
								</div>
									<textarea class="form-control ckeditor" @if($user->lock_header_email==1) readonly @endif  name="signature_header"> {!! $user->signature_header !!}  </textarea>
							</div>
						</div>
							<div class="col-md-12">
							<div class="form-group">
								<div class="makeflex justifycontentBetween">
									<label for="quotation_footer">Web Footer</label>
									<div class="makeflex alignitemsCenter">
										<input type="hidden" name="lock_footer" value="{{$user->lock_footer}}" class="lock_footer" >

										<i class="fa @if($user->lock_footer==1) fa-lock @else fa-unlock @endif colorA1 fontSize14 lock_footer_icon" aria-hidden="true" style="cursor:pointer;font-size: 20px;margin-bottom: 7px;"></i>
									</div>
								</div>
								<input type="hidden" name="quotation_footer" class="quotation_footer" value="{{$user->quotation_footer}}">
									<select  class="form-control  lock_footer_box" name="" required @if($user->lock_footer==1) style="cursor:not-allowed" disabled @endif>
										<option disabled>Select</option>
										@foreach($quotation_footer as $pol)
<option value="{{$pol->id}}" @if($user->quotation_footer==$pol->id) selected @endif>{{$pol->footer}} </option>
                                    @endforeach
									</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="makeflex justifycontentBetween">
									<label for="signature">Email Footer <span class="requiredcolor">*</span></label>
									<div class="makeflex alignitemsCenter">
										<input type="hidden" name="lock_footer_email" value="" class="lock_footer_email">
										<i class="fa @if($user->lock_footer_email==1) fa-lock @else fa-unlock @endif colorA1 fontSize14 lock_footer_email_icon" aria-hidden="true" style="cursor:pointer;font-size: 20px;margin-bottom: 7px;"></i>
									</div>
								</div>
									<textarea class="form-control ckeditor" name="signature" @if($user->lock_footer_email==1) readonly @endif>{!! $user->signature !!}</textarea>
							</div>
						</div>

						<!--<div class="col-md-6">
							<div class="form-group">
								<label for="profile_pic">Profile Image <span class="requiredcolor">*</span></label>
								<input type="file" class="form-control" name="profile_pic">
							</div>
						</div>-->
						<div class="col-md-12">
							<div class="form-group">
								<div class="textCenter">
									<input type="submit" value="SUBMIT" class="btnblue fontWeight600 paddingUpDown10 paddingLeftRight60" />
								</div>
							</div>
						</div>
						</div>
					</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
</div>
<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="APP_URL">
</div>
@endsection

@section('custom_js_code')
<script type="text/javascript">

//subscription_service
$(document).on('click',".subscription_service",function(){

var checked_condition=$(this).is(':checked');
checkedValue=[];

$('.subscription_service:checkbox:checked').each(function(){
    checkedValue.push($(this).val());
});
var count=checkedValue.length;
if(count==3)
{
$('.subscription').html('').html('<option value="">--select one--</option><option value="subscribed" selected>Subscribed</option><option value="partialsubscribed" disabled>Partial Subscribed</option><option value="unsubscribed">Unsubscribed</option>')	
}
else if(count==2 || count==1)
{
$('.subscription').html('').html('<option value="">--select one--</option><option value="subscribed" >Subscribed</option><option value="partialsubscribed" selected>Partial Subscribed</option><option value="unsubscribed">Unsubscribed</option>')	
}
else
{
$('.subscription').html('').html('<option value="">--select one--</option><option value="subscribed" >Subscribed</option><option value="partialsubscribed" disabled>Partial Subscribed</option><option value="unsubscribed" selected>Unsubscribed</option>')	
}


})

//
$(document).on('change','.subscription',function(){
	$("select option[value='partialsubscribed']").attr('disabled', true);
var value=$(this).val()
if(value=='subscribed')
{
	$('.subscription_service').prop('checked', true);
	
}
else
{
	$('.subscription_service').prop('checked', false);
}
})
//lock_header_icon
$(document).on("click",".lock_header_icon",function(){
var lock_header=$(".lock_header").val()

if(lock_header==1)
{
	$(this).removeClass('fa-lock')
	$(this).addClass('fa-unlock')
	$(".lock_header").val('').val(0)
	$(".lock_header_box").prop('disabled', false);
}
else
{
	$(this).removeClass('fa-unlock')
	$(this).addClass('fa-lock')
	$(".lock_header").val('').val(1)
	$(".lock_header_box").prop('disabled', 'disabled');
}

})
//lock_header_email_icon
$(document).on("click",".lock_header_email_icon",function(){
var lock_header_email=$(".lock_header_email").val()

if(lock_header_email==1)
{
	$(this).removeClass('fa-lock')
	$(this).addClass('fa-unlock')
	$(".lock_header_email").val('').val(0)
	CKEDITOR.instances['signature_header'].setReadOnly(false);
}
else
{
	$(this).removeClass('fa-unlock')
	$(this).addClass('fa-lock')
	$(".lock_header_email").val('').val(1)
	CKEDITOR.instances['signature_header'].setReadOnly(true);
}

})

//lock_footer_icon
$(document).on("click",".lock_footer_icon",function(){
var lock_footer=$(".lock_footer").val()

if(lock_footer==1)
{
	$(this).removeClass('fa-lock')
	$(this).addClass('fa-unlock')
	$(".lock_footer").val('').val(0)
	$(".lock_footer_box").prop('disabled', false);
}
else
{
	$(this).removeClass('fa-unlock')
	$(this).addClass('fa-lock')
	$(".lock_footer").val('').val(1)
	$(".lock_footer_box").prop('disabled', 'disabled');
}

})
//lock_footer_icon
$(document).on("click",".lock_footer_email_icon",function(){
var lock_footer_email=$(".lock_footer_email").val()

if(lock_footer_email==1)
{
	$(this).removeClass('fa-lock')
	$(this).addClass('fa-unlock')
	$(".lock_footer_email").val('').val(0)
	CKEDITOR.instances['signature'].setReadOnly(false);
}
else
{
	$(this).removeClass('fa-unlock')
	$(this).addClass('fa-lock')
	$(".lock_footer_email").val('').val(1)
	CKEDITOR.instances['signature'].setReadOnly(true);
}

})
//
$(document).on("change",".lock_header_box",function(){
var lock_header_box=$(this).val()
$(".quotation_header").val('').val(lock_header_box)
})
$(document).on("change",".lock_footer_box",function(){
var lock_footer_box=$(this).val()
$(".quotation_footer").val('').val(lock_footer_box)
})
//
//JavaScript Validation for Height & Width and Preview of Image
function profilepicValidation(){
    var fileInput = document.getElementById('profilepic');
    var filePath = fileInput.value;
    //Check whether the file is valid Image.
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png|.gif)$");
    if (regex.test(fileInput.value.toLowerCase())) {
 
        //Check whether HTML5 is supported.
        if (typeof (fileInput.files) != "undefined") {
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileInput.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
 
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                       
                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (height > 225 || width > 200) {
                        alert("Image file must not exceed Height = 225px and Width = 200px");
                        return false;
                    }
                    else {
						//Image preview
						if (fileInput.files && fileInput.files[0]) {
							var reader = new FileReader();
							reader.onload = function(e) {
								document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
							};
							reader.readAsDataURL(fileInput.files[0]);
						}
					}
                };
            }
        } else {
            alert("This browser does not support HTML5.");
            return false;
			}
    } else {
        alert("Please select only .jpg,.jpeg Image file.");
        return false;
    }
}
//showhide div element script
function ShowHideServiceType() {
	{
	var tourdestination = document.getElementById("tourdestination");
	var holidaydestination = document.getElementById("holidaydestination");

	tourdestination.style.display = tourpackage.checked ? "block"  : "none";
	tourpackage.checked ? holidaydestination.setAttribute("required", " ")  : holidaydestination.removeAttribute("required");
    }
	{
	var visadestination = document.getElementById("visadestination");
	var visadestinations = document.getElementById("visadestinations");
	visadestination.style.display = visa.checked ? "block" : "none";
	visa.checked ? visadestinations.setAttribute("required", " ")  : visadestinations.removeAttribute("required");
    }
}
</script>

<script type="text/javascript">

const form = document.querySelector('.customform');

function insertAfter(newNode, referenceNode) {
  this.insertBefore(newNode, referenceNode.nextElementSibling);
  
  return newNode;
}


class FieldValidator {
  constructor(field) {
    this._field = field;
    this._error = null;
    
    this._onInvalid = this._onInvalid.bind(this);
    this._onInput = this._onInput.bind(this);
    this._onBlur = this._onBlur.bind(this);
    
    this.bindEventListeners();
  }
  
  bindEventListeners() {
    this._field.addEventListener('invalid', this._onInvalid);
    this._field.addEventListener('input', this._onInput);
    this._field.addEventListener('blur', this._onBlur);
  }
  
  // Displays an error message and adds error styles and aria attributes
  showError() {
    let errorNode;
    
    if (this._error !== null) {
      return this.updateError();
    }
    
    this._error = document.createElement('div');
    this._error.className = 'help-block';
    this._error.innerHTML = this._field.validationMessage;
    
    this._field.setAttribute('aria-invalid', 'true');
    this._field.closest('.form-group').classList.add('has-error');
    
    insertAfter.call(this._field.parentNode, this._error, this._field);
  }
  
  // Updates an existing error message
  updateError() {
    if (this._error === null) return;
    
    this._error.innerHTML = this._field.validationMessage;
  }
  

  hideError() {
    if (this._error !== null) {
      this._error.parentNode.removeChild(this._error);
      this._error = null;
    }

    this._field.removeAttribute('aria-invalid');
    this._field.closest('.form-group').classList.remove('has-error');
  }
  
  // Suppress the browsers default error messages
  _onInvalid(event) {
    event.preventDefault();
  }
  
  // When the user inputs something in to the field,
  // hide the error message if the field is now valid,
  // otherwise update the existing error if one is being shown
  _onInput(event) {
    if (this._field.validity.valid) {
      this.hideError();
    } else {
      this.updateError();
    }
  }
  
  // When this field loses focus and is invalid, then
  // show the error message
  _onBlur(event) {
    if ( ! this._field.validity.valid) {
      this.showError();
    }
  }
}

Array.prototype.slice.call(form.elements).forEach((element) => {
  element._validator = new FieldValidator(element);
});

// For some reason without setting the forms novalidate option
// we are unable to focus on an input inside the form when handling
// the 'submit' event
form.setAttribute('novalidate', true);

// When the form is submitted and fields don't pass validation
// we show the error messages for invalid fields
form.addEventListener('invalid', (event) => {
  event.preventDefault();
  
  event.target._validator.showError();
}, true);

// Suppress the submit event when validation fails and
// focus on the first invalid field
form.addEventListener('submit', (event) => {
  if ( ! form.checkValidity()) {
    event.preventDefault();
    
    form.querySelectorAll(':invalid')[0].focus();
    return;
  }
  //
 event.preventDefault();
  var form_data = new FormData($("#customform")[0]);

  $.ajax({
        url:APP_URL+'/user_data_check',
        data:form_data,
        type:'post',
        contentType: false,
        processData: false,
      
        success:function(data)
        {

        if(data=='success')
        {
        $("#customform").unbind('submit').submit()
        }
        else
        {
        alert(data)
        
        }
        },
        error:function(data)
        {

        }
    })

  // console.log('submit');
 
});

</script>
@endsection