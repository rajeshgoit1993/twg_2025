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
					<h3 class="box-title">Edit User</h3>
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
					<form action="<?php echo e(URL::to('/postusers')); ?>" method="POST" enctype="multipart/form-data" class="customform" id="customform">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="id" value="<?php echo e($user->id); ?>">
							<!-- left section -->
						<!-- profile image -->
						<div class="col-md-2">
							<div class="item-container">
								<!-- <div class="form-group profile-img-wrapper">
									<label for="profile_pic field-required">Profile Image</label>
									<div class="profile-img-box" id="imagePreview">
									    <?php if(!empty($user->profile_image) && file_exists(public_path('uploads/user_profiles/' . $user->profile_image))): ?>
									        <img src="<?php echo e(url('public/uploads/user_profiles/' . $user->profile_image)); ?>" alt="user-img" loading="lazy">
									    <?php else: ?>
									        <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png" alt="user-img" loading="lazy">
									    <?php endif; ?>
									</div>

									<input type="file" id="profilepic" class="form-control profilepicattachment" name="profile_pic" accept=".jpeg,.jpg,.png,.webp" onchange="return profilepicValidation()" 
									    <?php if($user->profile_image == ''): ?> required <?php endif; ?> 
									    <?php if($user->id == Sentinel::getUser()->id): ?> 
									    <?php elseif(
									        (Sentinel::getUser()->inRole('supervisor') || 
									        Sentinel::getUser()->inRole('agent') || 
									        Sentinel::getUser()->inRole('employee') || 
									        Sentinel::getUser()->inRole('customer')) && 
									        (CustomHelpers::get_user_role($user->id) == 'administrator' || 
									        CustomHelpers::get_user_role($user->id) == 'super_admin')
									    ): ?> 
									        disabled 
									    <?php elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')): ?> 
									        disabled 
									    <?php endif; ?>
									/>
									<div class="upload-profilepic">
										<p class="upload-text textUppercase">Upload</p>
										<p class="upload-size-text">(225px x 200px)</p>
									</div>								
								</div> -->
								<div class="form-group profile-img-wrapper">
								    <label for="profilepic" class="field-required">Profile Image</label>

								    <!-- Profile Image Preview Box -->
								    <div class="profile-img-box" id="imagePreview">
								        <?php if(!empty($user->profile_image) && file_exists(public_path('uploads/user_profiles/' . $user->profile_image))): ?>
								            <img src="<?php echo e(url('public/uploads/user_profiles/' . $user->profile_image)); ?>" alt="Profile Image" loading="lazy">
								        <?php else: ?>
								            <img src="<?php echo e(url('public/uploads/user_profiles/default-user.png')); ?>" alt="Default Profile Image" loading="lazy">
								        <?php endif; ?>
								    </div>

								    <!-- File Upload Input -->
								    <input type="file" id="profilepic" class="form-control profilepicattachment" name="profile_pic" accept=".jpeg,.jpg,.png,.webp"
								        <?php if(empty($user->profile_image)): ?> required <?php endif; ?>
								        <?php if($user->id == Sentinel::getUser()->id): ?>
								        <?php elseif(
								            (Sentinel::getUser()->inRole('supervisor') || 
								            Sentinel::getUser()->inRole('agent') || 
								            Sentinel::getUser()->inRole('employee') || 
								            Sentinel::getUser()->inRole('customer')) && 
								            (CustomHelpers::get_user_role($user->id) == 'administrator' || 
								            CustomHelpers::get_user_role($user->id) == 'super_admin')
								        ): ?> 
								            disabled
								        <?php elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')): ?> 
								            disabled
								        <?php endif; ?>
								        onchange="return profilepicValidation()"
								        style="display: none;"
								    />

								    <!-- Upload Text (Clickable to Trigger File Input) -->
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
										<input type="hidden" name="pre_user_role" value="<?php echo e(CustomHelpers::get_user_role($user->id)); ?>">
										<select class="form-control" name="user_role" id="user_role">
										    <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
										        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										            <option value="<?php echo e($role->slug); ?>" 
										                <?php if(CustomHelpers::get_user_role($user->id) == $role->slug): ?> selected="selected" <?php endif; ?>>
										                <?php echo e($role->name); ?>

										            </option>
										        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										    <?php else: ?>
										        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										            <?php if($role->slug != 'super_admin'): ?>
										                <option value="<?php echo e($role->slug); ?>"
										                    <?php if(
										                        Sentinel::getUser()->inRole('supervisor') && 
										                        ($role->slug == 'administrator' || $role->slug == 'super_admin')
										                    ): ?> disabled
										                    <?php elseif(
										                        Sentinel::getUser()->inRole('employee') && 
										                        ($role->slug == 'administrator' || $role->slug == 'super_admin' || $role->slug == 'supervisor')
										                    ): ?> disabled
										                    <?php elseif(
										                        Sentinel::getUser()->inRole('agent') && 
										                        ($role->slug == 'administrator' || $role->slug == 'super_admin' || $role->slug == 'supervisor' || $role->slug == 'employee')
										                    ): ?> disabled
										                    <?php elseif(
										                        Sentinel::getUser()->inRole('supervisor') && 
										                        CustomHelpers::get_user_role($user->id) == 'supervisor'
										                    ): ?> disabled
										                    <?php elseif(
										                        Sentinel::getUser()->inRole('employee') && 
										                        CustomHelpers::get_user_role($user->id) == 'employee'
										                    ): ?> disabled
										                    <?php elseif(Sentinel::getUser()->inRole('supervisor') && $role->slug == 'supervisor'): ?> 
										                        disabled
										                    <?php elseif(Sentinel::getUser()->inRole('employee')): ?> 
										                        disabled
										                    <?php elseif(Sentinel::getUser()->inRole('agent')): ?> 
										                        disabled
										                    <?php elseif(Sentinel::getUser()->inRole('customer')): ?> 
										                        disabled
										                    <?php endif; ?>
										                    <?php if(CustomHelpers::get_user_role($user->id) == $role->slug): ?> selected="selected" <?php endif; ?>>
										                    <?php echo e($role->name); ?>

										                </option>
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
										<select class="form-control" name="usercategory">
											<option disabled selected>Select</option>
											<option value="categoryA" <?php if($user->usercategory=='categoryA'): ?> selected <?php endif; ?>>Category A</option>
											<option value="categoryB" <?php if($user->usercategory=='categoryB'): ?> selected <?php endif; ?>>Category B</option>
											<option value="categoryC" <?php if($user->usercategory=='categoryC'): ?> selected <?php endif; ?>>Category C</option>
											<option value="categoryD" <?php if($user->usercategory=='categoryD'): ?> selected <?php endif; ?>>Category D</option>
										</select>
									</div>
								</div>

								<!-- first name -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="first_name" class="field-required">First Name</label>
										<input type="text" class="form-control" name="first_name" value="<?php echo e($user->first_name); ?>" maxlength="30" placeholder="Enter First Name" <?php if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor'): ?> readonly <?php elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')): ?> readonly <?php elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')): ?> readonly <?php endif; ?>>
									</div>
								</div>

								<!-- last name -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="last_name" class="field-required">Last Name</label>
										<input type="text" class="form-control" name="last_name" value="<?php echo e($user->last_name); ?>" maxlength="15" placeholder="Enter Last Name" <?php if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor'): ?> readonly <?php elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')): ?> readonly <?php elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')): ?> readonly <?php endif; ?>>
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
											<input type="tel" class="form-control" name="mobile" pattern="^\d{10}$" value="<?php echo e($user->mobile); ?>" maxlength="10" placeholder="Enter Mobile Number" <?php if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor' ): ?> readonly <?php elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')): ?> readonly <?php elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')): ?> readonly <?php endif; ?>>
										</div>
									</div>
								</div>

								<!-- email -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="email" class="field-required">User Email</label>
										<input type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>" value="<?php echo e(old('email')); ?>" maxlength="40" placeholder="Enter Email ID" readonly <?php if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id)=='supervisor' ): ?> readonly
										<?php elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && (CustomHelpers::get_user_role($user->id)=='administrator' || CustomHelpers::get_user_role($user->id)=='super_admin')): ?> readonly <?php elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')): ?> readonly <?php endif; ?>>
									</div>
								</div>

								<div class="col-md-12"></div>

								<!-- password -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="password" class="field-required">Password</label>
										<div class="show-password-input-group fullWidth">
											<input type="password" id="password" class="form-control" name="password" value="" maxlength="6" placeholder="Enter password (max 6 digit)" />
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
											<input type="password" id="password_confirmation" class="form-control" name="password_confirmation" value="" maxlength="6" placeholder="Re-confirm password (max 6 digit)" />
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
								<?php if(Sentinel::getUser()->id == $user->id): ?>
								<?php else: ?>
								    <?php
								        // Define $sevtinel_activated before using it in the Blade conditions
								        $sevtinel_activated = Sentinel::findById($user->id);
								    ?>
								    <!-- active status -->
								    <div class="col-md-6">
								        <div class="form-group">
								            <label for="status" class="field-required">Status</label>
								            <select class="form-control" name="status">
								                <option value="1"
								                    <?php if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id) == 'supervisor'): ?> disabled
								                    <?php elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && 
								                    (CustomHelpers::get_user_role($user->id) == 'administrator' || CustomHelpers::get_user_role($user->id) == 'super_admin')): ?> disabled
								                    <?php elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')): ?> disabled
								                    <?php endif; ?>
								                    <?php if($activation = Activation::completed($sevtinel_activated)): ?> selected <?php endif; ?>
								                >Enable</option>
								                <option value="0"
								                    <?php if(Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($user->id) == 'supervisor'): ?> disabled
								                    <?php elseif((Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee') || Sentinel::getUser()->inRole('customer')) && 
								                    (CustomHelpers::get_user_role($user->id) == 'administrator' || CustomHelpers::get_user_role($user->id) == 'super_admin')): ?> disabled
								                    <?php elseif(Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')): ?> disabled
								                    <?php endif; ?>
								                    <?php if(!$activation): ?> selected <?php endif; ?>
								                >Disable</option>
								            </select>
								        </div>
								    </div>

								    <div class="col-md-6">
								    	<div class="form-group">
								            <label for="status" class="field-required" style="visibility: hidden;">Current Status</label>
								            <div>
										        <?php
										            if ($activation) {
										                echo "<button type='button' class='btn btn-sm btn-success no-event'>Activated</button>";
										            } else {
										                echo "<button type='button' class='btn btn-sm btn-danger no-event'>De-activated</button>";
										            }
										        ?>
										    </div>
								    	</div>
								    </div>
								<?php endif; ?>
							</div>

							<!-- Subscription Service -->
							<div class="item-container">
								<div class="col-md-12">
									<div class="form-group">
										<label for="subscription" class="field-required">Subscription</label>
										<select class="form-control subscription" name="subscription" >
											<option value="" disabled>Select</option>
											<option value="subscribed" <?php if($user->subscription=='subscribed'): ?> selected <?php endif; ?>>Subscribed</option>
											<option value="partialsubscribed" <?php if($user->subscription=='partialsubscribed'): ?> selected <?php else: ?> disabled <?php endif; ?> >Partial Subscribed</option>
											<option value="unsubscribed" <?php if($user->subscription=='unsubscribed'): ?> selected <?php endif; ?>>Unsubscribed</option>
										</select>
									</div>
								

									<?php $subscription=unserialize($user->subscription_service); ?>
									<div class="form-group">

										<div class="service-item-cont">
											<label for="emailsubscription">
												<input type="checkbox" id="emailsubscription" name="subscription_service[]" value="email" class="subscription_service" <?php if(is_array($subscription) && in_array('email',$subscription) && ($user->subscription=='subscribed' || $user->subscription=='partialsubscribed') ): ?> checked <?php endif; ?>>
												<span class="apndLft5">Email</span>
											</label>
										</div>

										<div class="service-item-cont">
											<label for="smssubscription">
												<input type="checkbox" id="smssubscription" name="subscription_service[]" value="sms" class="subscription_service" <?php if(is_array($subscription) && in_array('sms',$subscription) &&  ($user->subscription=='subscribed' || $user->subscription=='partialsubscribed') ): ?> checked <?php endif; ?>>
												<span class="apndLft5">SMS</span>
											</label>
										</div>

										<div class="service-item-cont">
											<label for="whatsappsubscription">
												<input type="checkbox" id="whatsappsubscription" name="subscription_service[]" value="whatsapp" class="appendAllZero subscription_service" <?php if(is_array($subscription) && in_array('whatsapp',$subscription) &&  ($user->subscription=='subscribed' || $user->subscription=='partialsubscribed')): ?> checked <?php endif; ?>>
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
									            <input type="checkbox" id="tourpackage" name="tourpackage" value="1" 
									                   <?php if($user->tourpackage == 1): ?> checked <?php endif; ?> />
									            <span class="apndLft5">Holidays</span>
									        </label>
									    </div>
									    <div class="service-item-cont">
									        <label for="visa">
									            <input type="checkbox" id="visa" name="visa" value="1" 
									                   <?php if($user->visa == 1): ?> checked <?php endif; ?> />
									            <span class="apndLft5">Visa</span>
									        </label>
									    </div>
									</div>

									<div id="tourdestination" <?php if($user->tourpackage==1): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>  >
										<div class="form-group">
											<label for="holidaydestination" class="field-required">Holiday Destination</label>
											<?php $destinations=unserialize($user->destination); ?>
											<select class="form-control select3" name="destination[]" id="holidaydestination" multiple>
												<?php if(is_array($destinations)): ?>
												<?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				                                <option value="<?php echo e($destination); ?>" selected><?php echo e($destination); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												<?php endif; ?>
											</select>
										</div>
									</div>

									<div id="visadestination" <?php if($user->visa==1): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
										<div class="form-group">
											<label for="visadestination" class="field-required">Visa Destination</label>
											<?php $visadestinations=unserialize($user->visadestination); ?>
											<select class="form-control select4" name="visadestination[]" id="visadestinations" multiple>
												<?php if(is_array($visadestinations)): ?>
												<?php $__currentLoopData = $visadestinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visadestination): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				                                <option value="<?php echo e($visadestination); ?>" selected><?php echo e($visadestination); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												<?php endif; ?>
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
												<input type="checkbox" id="lock_before_quote_send" name="lock_before_quote_send" value="1" <?php if($user->lock_before_quote_send==1): ?> checked <?php endif; ?> />
												<span class="apndLft5">Lock Before Quote Send</span>
											</label>
										</div>
										<div class="service-item-cont">
											<label for="lock_after_quote_send">
												<input type="checkbox" id="lock_after_quote_send" name="lock_after_quote_send" value="1" <?php if($user->lock_after_quote_send==1): ?> checked <?php endif; ?> />
												<span class="apndLft5">Lock After Quote Send</span>
											</label>
										</div>
									</div>
								</div>
							</div>

							<!-- header -->
							<div class="item-container">
								<!-- web header -->
								<div class="col-md-12">
									<div class="form-group">
										<div class="makeflex align-center space-between">
											<label for="quotation_footer">Web Header</label>
											<span class="makeflex align-center colorA1 fontSize20 pointer">
												<input type="hidden" name="lock_header" value="<?php echo e($user->lock_header); ?>" class="lock_header">
												<i class="fa  <?php if($user->lock_header==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> lock_header_icon" aria-hidden="true"></i>
											</span>
										</div>
										<div>
											<input type="hidden" name="quotation_header" class="quotation_header" value="<?php echo e($user->quotation_header); ?>">
											<select  class="form-control lock_header_box" name="" required <?php if($user->lock_header==1): ?> disabled <?php endif; ?>>
												<option disabled>Select</option>
												<?php $__currentLoopData = $quotation_header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($pol->id); ?>" <?php if($user->quotation_header==$pol->id): ?> selected <?php endif; ?>><?php echo e($pol->header); ?> </option>
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
												<input type="hidden" name="lock_header_email" value="<?php echo e($user->lock_header_email); ?>" class="lock_header_email">
												<i class="fa <?php if($user->lock_header_email==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> lock_header_email_icon" aria-hidden="true"></i>
											</span>
										</div>
										<textarea class="form-control ckeditor" <?php if($user->lock_header_email==1): ?> readonly <?php endif; ?>  name="signature_header"> <?php echo $user->signature_header; ?></textarea>
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
												<input type="hidden" name="lock_footer" value="<?php echo e($user->lock_footer); ?>" class="lock_footer">
												<i class="fa <?php if($user->lock_footer==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> lock_footer_icon" aria-hidden="true"></i>
											</span>
										</div>
										<div>
											<input type="hidden" name="quotation_footer" class="quotation_footer" value="<?php echo e($user->quotation_footer); ?>">
											<select  class="form-control  lock_footer_box" name="" required <?php if($user->lock_footer==1): ?> disabled <?php endif; ?>>
												<option disabled>Select</option>
												<?php $__currentLoopData = $quotation_footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($pol->id); ?>" <?php if($user->quotation_footer==$pol->id): ?> selected <?php endif; ?>><?php echo e($pol->footer); ?> </option>
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
												<i class="fa <?php if($user->lock_footer_email==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> lock_footer_email_icon" aria-hidden="true"></i>
											</span>
										</div>
										<textarea class="form-control ckeditor" name="signature" <?php if($user->lock_footer_email==1): ?> readonly <?php endif; ?>><?php echo $user->signature; ?></textarea>
									</div>
								</div>
							</div>

							<!-- submit -->
							<div class="col-md-12">
								<div class="form-group">
									<div class="textCenter">
										<button type="submit" class="btn-user-profile-submit">Update</button>
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

<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<!-- user-profile-backend -->
<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/backend/js/user-profile-backend.js")); ?>'></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>