<?php $__env->startSection("custom_css_code"); ?>

<!-- user-profile-backend -->
<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/backend/css/user-profile-backend.css')); ?>" />

<!-- select2 css -->
<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/backend/css/select2-customized.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Add New User</h3>
				</div>
				<div class="box-body">
					<div class="add">
						<a href="<?php echo e(URL::previous()); ?>" class="btn btn-success appendRight20"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
					</div>

					<div class="modal-body_main">
					<?php if($errors->any()): ?>
					<div class="alert alert-danger">
						<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</ul>
					</div>
					<?php endif; ?>
					<form action="<?php echo e(URL::to('/postusers')); ?>" method="POST" enctype="multipart/form-data" onsubmit="return profilepicValidation()" class="customform" id="customform">
						<?php echo e(csrf_field()); ?>

						<!-- left section -->
						<!-- profile image -->
						<div class="col-md-2">
							<div class="item-container">
								<!-- <div class="form-group profile-img-wrapper">
									<label for="profile_pic field-required">Profile Image</label>
									<div class="profile-img-box" id="imagePreview">
										<img src="https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png" alt="user-img" loading="lazy">
									</div>
									<input type="file" id="profilepic" class="form-control profilepicattachment" name="profile_pic" accept=".jpeg,.jpg,.webp" onchange="return profilepicValidation()" required />
									<div class="upload-profilepic">
										<p class="upload-text textUppercase">Upload</p>
										<p class="upload-size-text">(225x200)</p>
									</div>
								</div> -->
								<div class="form-group profile-img-wrapper">
								    <label for="profilepic" class="field-required">Profile Image</label>
								    
								    <!-- Profile Image Preview Box -->
								    <div class="profile-img-box" id="imagePreview">
								        <img id="previewImage" src="<?php echo e(url('public/uploads/user_profiles/default-user.png')); ?>" 
								             alt="Profile Image Preview" loading="lazy">
								    </div>
								    
								    <!-- File Upload Input -->
								    <input type="file" id="profilepic" class="form-control profilepicattachment" 
								           name="profile_pic" accept=".jpeg,.jpg,.webp" 
								           onchange="return profilepicValidation()" aria-label="Profile Image Upload" style="display: none;" />
								    
								    <!-- Upload Text -->
								    <div class="upload-profilepic" onclick="document.getElementById('profilepic').click();">
								        <p class="upload-text textUppercase">Upload</p>
								        <p class="upload-size-text">(225px x 200px)</p>
								    </div>
								</div>

							</div>
						</div>

						<!-- right section -->
						<div class="col-md-10">

							<!-- user details -->
							<div class="item-container">
								<!-- user role -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="user_role" class="field-required">User Role</label>
										<select class="form-control" name="user_role" id="user_role">
											<?php if(Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->email=='admin@theworldgateway.com'): ?>
											<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<option value="<?php echo e($role->slug); ?>"><?php echo e($role->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											<?php else: ?>
											<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<?php if($role->slug!='super_admin'): ?>
											<option value="<?php echo e($role->slug); ?>" <?php if((Sentinel::getUser()->inRole('supervisor') && $role->slug=='administrator') || (Sentinel::getUser()->inRole('supervisor') && $role->slug=='supervisor')): ?> disabled <?php endif; ?>><?php echo e($role->name); ?></option>
											<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											<?php endif; ?>
										</select>
									</div>
								</div>

								<!-- user category -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="usercategory" class="field-required">User Category</label>
										<select class="form-control" name="usercategory" required>
											<option value="">Select</option>
											<option value="categoryA">Category A</option>
											<option value="categoryB">Category B</option>
											<option value="categoryC">Category C</option>
											<option value="categoryD">Category D</option>
										</select>
									</div>
								</div>

								<!-- first name -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="first_name" class="field-required">First Name</label>
										<input type="text" class="form-control" name="first_name" maxlength="30" placeholder="Enter First Name" required />
									</div>
								</div>

								<!-- last name -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="last_name" class="field-required">Last Name</label>
										<input type="text" class="form-control" name="last_name" maxlength="15" placeholder="Enter Last Name" required />
									</div>
								</div>

								<!-- mobile number -->
								<div class="col-md-6">
									<div class="makeflex">
										<div class="form-group fullWidth apndRt5" style="max-width: 25%;">
											<label for="country_code" class="field-required">Country Code</label>
											<select class="form-control" id="country_code">
												<!-- populate from -->
											</select>
										</div>
										<div class="form-group fullWidth">
											<label for="mobile" class="field-required">Mobile No</label>
											<input type="tel" class="form-control" id="mobile" name="mobile" pattern="^\d{10}$" maxlength="10" placeholder="Enter Mobile Number" required>
										</div>
									</div>
								</div>

								<!-- email -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="email" class="field-required">User Email</label>
										<input type="email" id="email" class="form-control" name="email" maxlength="40" placeholder="Enter Email ID" required />
									</div>
								</div>

								<div class="col-md-12"></div>

								<!-- password -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="password" class="field-required">Password</label>
										<div class="show-password-input-group fullWidth">
											<input type="password" id="password" class="form-control" name="password" maxlength="6" placeholder="Enter password (max 6 digit)" />
											<div class="show-password-input-group-append">
								                <button type="button" class="btn-password" id="togglePasswordBtn1">
								                    <i class="fa fa-eye" aria-hidden="true" id="togglePasswordIcon1"></i>
								                </button>
								            </div>
								        </div>
									</div>
								</div>

								<!-- confirm password -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="password_confirmation" class="field-required">Confirm Password</label>
										<div class="show-password-input-group fullWidth">
											<input type="password" id="password_confirmation" class="form-control" name="password_confirmation" maxlength="6" placeholder="Re-confirm password (max 6 digit)" />
											<div class="show-password-input-group-append">
								                <button type="button" class="btn-password" id="togglePasswordBtn2">
								                    <i class="fa fa-eye" id="togglePasswordIcon2"></i>
								                </button>
								            </div>
								        </div>
									</div>
								</div>

								<div class="col-md-12"></div>

								<!-- active status -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="status" class="field-required">Status</label>
										<select class="form-control" name="status">
											<option value="1">Enable</option>
											<option value="0">Disable</option>
										</select>
									</div>
								</div>
							</div>

							<!-- Subscription Service -->
							<div class="item-container">
							    <div class="col-md-12">
							        <div class="form-group">
							            <label for="subscription" class="field-required">Subscription</label>
							            <select class="form-control subscription" name="subscription" required>
							                <option value="" disabled>Select</option>
							                <option value="subscribed">Subscribed</option>
							                <option value="partialsubscribed" disabled>Partial Subscribed</option>
							                <option value="unsubscribed">Unsubscribed</option>
							            </select>
							        </div>

							        <div class="form-group">
							            <div class="service-item-cont">
							                <label for="emailsubscription">
							                    <input type="checkbox" id="emailsubscription" name="subscription_service[]" value="email" class="subscription_service" />
							                    <span class="apndLft5">Email</span>
							                </label>
							            </div>

							            <div class="service-item-cont">
							                <label for="smssubscription">
							                    <input type="checkbox" id="smssubscription" name="subscription_service[]" value="sms" class="subscription_service" />
							                    <span class="apndLft5">SMS</span>
							                </label>
							            </div>

							            <div class="service-item-cont">
							                <label for="whatsappsubscription">
							                    <input type="checkbox" id="whatsappsubscription" name="subscription_service[]" value="whatsapp" class="subscription_service" />
							                    <span class="apndLft5">WhatsApp</span>
							                </label>
							            </div>
							        </div>
							    </div>
							</div>

							<!-- service type -->
							<div class="item-container">
								<div class="col-md-12">
								    <label for="servicetype" class="field-required">Service Type</label>
								    <div class="form-group">
								        <div class="service-item-cont">
								        	<label for="tourpackage">
								            	<input type="checkbox" id="tourpackage" name="tourpackage" value="1" />
								            	<span class="apndLft5">Holidays</span>
								            </label>
								        </div>
								        <div class="service-item-cont">
								            <label for="visa">
								            	<input type="checkbox" id="visa" name="visa" value="1" />
								            	<span class="apndLft5">Visa</span>
								            </label>
								        </div>
								    </div>

									<div class="" id="tourdestination" style="display: none">
										<div class="form-group">
											<label for="holidaydestination" class="field-required">Holiday Destination</label>
											<select class="form-control select3" name="destination[]" id="holidaydestination" multiple>
												<!-- populate from -->
											</select>
										</div>
									</div>

									<div class="" id="visadestination" style="display: none">
										<div class="form-group">
											<label for="visadestination" class="field-required">Visa Destination</label>
											<select class="form-control select4" name="visadestination[]" id="visadestinations" multiple>
												<!-- populate from -->
											</select>
										</div>
									</div>
								</div>
							</div>

							<!-- enquiry details lock -->
							<div class="item-container">
								<div class="col-md-12">
									<label for="servicetype" class="field-required">Enquiry Details</label>
									<div class="form-group">
										<div class="service-item-cont">
											<label for="lock_before_quote_send">
												<input type="checkbox" id="lock_before_quote_send" name="lock_before_quote_send" value="1" />
												<span class="apndLft5">Lock Before Quote Send</span>
											</label>
										</div>
										<div class="service-item-cont">
											<label for="lock_after_quote_send">
												<input type="checkbox" id="lock_after_quote_send" name="lock_after_quote_send" value="1" />
												<span class="apndLft5">Lock After Quote Send</span>
											</label>
										</div>
									</div>
								</div>
							</div>

							<!-- <div class="col-md-12 fontSize14 lineHeight14 appendTop10 appendBottom5 colorA1 fontWeight600">SIGNATURE</div> -->

							<!-- header -->
							<div class="item-container">
								<!-- web header -->
								<div class="col-md-12">
									<div class="form-group">
										<div class="makeflex align-center space-between">
											<label for="quotation_footer" class="field-required">Web Header</label>
											<span class="makeflex align-center colorA1 fontSize20 pointer">
												<input type="hidden" name="lock_header" value="" class="lock_header">
												<i class="fa fa-unlock lock_header_icon" aria-hidden="true"></i>
											</span>
										</div>
										<div>
											<input type="hidden" name="quotation_header" class="quotation_header" value="">
											<select  class="form-control select2 lock_header_box" name="" required >
												<option value="" disabled>Select</option>
												<?php $__currentLoopData = $quotation_header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($pol->id); ?>"><?php echo e($pol->header); ?> </option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</div>
									</div>
								</div>

								<!-- email header -->
								<div class="col-md-12">
									<div class="form-group">
										<div class="makeflex align-center space-between">
											<label for="signature">Email Header <span class="requiredcolor">*</span></label>
											<span class="makeflex align-center colorA1 fontSize20 pointer">
												<input type="hidden" name="lock_header_email" value="" class="lock_header_email">
												<i class="fa fa-unlock lock_header_email_icon" aria-hidden="true"></i>
											</span>
										</div>
										<textarea class="form-control ckeditor" name="signature_header"></textarea>
									</div>
								</div>
							</div>

							<!-- footer -->
							<div class="item-container">
								<!-- web footer -->
								<div class="col-md-12">
									<div class="form-group">
										<div class="makeflex align-center space-between">
											<label for="quotation_footer" class="field-required">Web Footer</label>
											<span class="makeflex align-center colorA1 fontSize20 pointer">
												<input type="hidden" name="lock_footer" value="" class="lock_footer">
												<i class="fa fa-unlock lock_footer_icon" aria-hidden="true"></i>
											</span>
										</div>
										<div>
											<input type="hidden" name="quotation_footer" class="quotation_footer" value="">
											<select  class="form-control select2 lock_footer_box" name="" required >
												<option value="" disabled>Select</option>
												<?php $__currentLoopData = $quotation_footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($pol->id); ?>"><?php echo e($pol->footer); ?></option>
		                                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</div>
									</div>
								</div>

								<!-- email footer -->
								<div class="col-md-12">
									<div class="form-group">
										<div class="makeflex align-center space-between">
											<label for="signature" class="field-required">Email Footer</label>
											<span class="makeflex align-center colorA1 fontSize20 pointer">
												<input type="hidden" name="lock_footer_email" value="" class="lock_footer_email">
												<i class="fa fa-unlock lock_footer_email_icon" aria-hidden="true"></i>
											</span>
										</div>
										<textarea class="form-control ckeditor" name="signature"></textarea>
									</div>
								</div>
							</div>

							<!-- submit -->
							<div class="col-md-12">
								<div class="form-group">
									<div class="textCenter">
										<button type="submit" class="btn-user-profile-submit">Submit</button>
									</div>
								</div>
							</div>
						</div> <!-- close of col-md-10 -->

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
	<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>

<!-- <script type="text/javascript">
	var APP_URL=$("#APP_URL").val()
</script -->

<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<!-- user-profile-backend -->
<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/user-profile-backend.js")); ?>'></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>