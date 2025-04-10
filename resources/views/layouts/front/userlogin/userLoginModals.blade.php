				<!-- Guest Login Modal -->
				<div class="guest-login-modal fade" id="user-login" role="dialog">
				    <div class="modal-dialog">
				    	<!-- Modal content-->
				    	<div class="login-modal-content">
					        <div class="login-modal-header">
					        	<button type="button" class="close-login" data-dismiss="modal"></button>
					        	<!-- <button type="button" class="close-login" data-dismiss="modal">&times;</button> -->
					        	<h4>Login/Signup</h4>
					        </div>
					        <div class="login-modal-body">
								<form action="{{ route('guestlogin') }}" method="post" id="login_customer" name="login_customer">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<!-- login id -->
									<div class="user-login-field">
										<label for="login_email">Email ID</label>
										<div class="user-input-group innerField">
											<span class="user-input-group-addon email-ico" aria-hidden="true">
												<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" class="envelope-icon" ><path d="M21 3H3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM3 5l9 7 9-7M3 19" class="envelope-shape" /></svg>
												<!-- <i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> -->
											</span>
											<input type="email" id="login_email" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="Enter email id" />
										</div>
										<div class="flexCenter">
											<span id="error-icon"></span>
											<span id="emailErrorMessage" class="error-message"></span>
										</div>
									</div>

									<!-- login password -->
									<div class="user-login-field">
										<label for="password">Password</label>
										<div class="user-input-group innerField-login-password">
											<span class="user-input-group-addon">
												<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="lock-icon"><rect x="5" y="11" width="14" height="10" rx="2" ry="2" class="lock-body" /><path d="M16 11V7a4 4 0 0 0-8 0v4" class="lock-shackle" /></svg>
											</span>
											<input type="password" name="password" id="password" autocomplete="off" placeholder="Enter Password" />
											<button type="button" class="showPassword" id="toggleLoginPassword">
												<i id="showEyeIcon" class="fa fa-eye" aria-hidden="true"></i>
											</button>
										</div>
										<p id="loginPasswordErrorMessage" class="error-message"></p>
									</div>

									<!-- OTP login and reset password -->
									<div class="resetCont">
										<!-- otp login -->
										<div>
											<button type="button" id="login_with_otp" class="btn-otp-login">Login via OTP</button>
										</div>
										<!-- reset password -->
										<div class="forgot-password">
											<a href="#forget_password" data-dismiss="modal" data-toggle="modal">Reset password?</a>
										</div>
									</div>

									<!-- Submit -->
									<div class="btn-login-cont">
										<input type="hidden" name="currentURL" value="{{ url()->current() }}">
										<p class="textCentre error" id="error_box"></p>
										<button type="submit" class="btn-login" id="btnSubmit" disabled="disabled">Login</button>
									</div>

								</form>

								<!-- don't have an account -->
								<div class="email-signup-cont">
									<p>Don't have an account?
										<a href="#user-signup" data-dismiss="modal" data-toggle="modal" class="link-color">Sign up</a>
									</p>
								</div>

								<!-- social media login -->
								<div class="socialMediaLoginBar">
									<span>Or Login/Signup with</span>
								</div>
								<div class="social-media-cont">
									<!-- <a href="{{url('/login_with_google')}}" class="login-googleplus"> -->
									<a href="{{ route('loginViaGoogle') }}" class="login-googleplus">
										<div class="socialMedia-enrollment-button">
											<div class="social-media-wrapper">
												<div class="google-icon">
													<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class=""><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg>
												</div>
												<div class="icon-tag-line">Continue with Google</div>
											</div>
										</div>
									</a>
								</div>
								<div class="login-footer-cont">
									<!-- <p>By proceeding, you agree to 
										@if(env("WEBSITENAME")==1)The World Gateway's @elseif(env("WEBSITENAME")==0) Rapidex Travels's @endif <a href="{{ route('privacyPolicy') }}" class="link-color" target="_blank">Privacy Policy</a> and <a href="{{ route('userAgreement') }}" class="link-color" target="_blank">User Agreement</a>
									</p> -->
									@php
										$websiteData = getWebsiteData();
									@endphp
									<p>By proceeding, you agree to {{ getWebsiteData('name') }} 
										<a href="{{ route('privacyPolicy') }}" class="link-color" target="_blank">Privacy Policy</a> and 
										<a href="{{ route('userAgreement') }}" class="link-color" target="_blank">User Agreement</a>
									</p>
								</div>

					        </div>
				      	</div>
				    </div>
				</div>

				<!-- Login with OTP Modal -->
				<div class="guest-login-modal fade" id="otp_login_modal" role="dialog">
				    <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="login-modal-content">
					        <div class="login-modal-header">
					          <button type="button" class="close-login" data-dismiss="modal"></button>
					          <h4>Enter OTP to continue</h4>
					        </div>
					        <div class="login-modal-body">
								<!-- <form action="{{ URL::to('/login-customer') }}" method="post" id="login_customer" name="login_customer"> -->
								<form action="{{ route('guestlogin') }}" method="post" id="login_customer" name="login_customer">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="login-modal-body-title">
										<!-- <h3>Verify your Email-id and Mobile Number</h3> -->
										<p>Login OTP has been sent successfully on <br> registered email-id & mobile number</p>
									</div>
									<div class="user-login-field">
										<label for="login_otp_value">OTP</label>
										<div class="user-input-group innerField-enter-otp">
											<input type="text" name="login_otp_value" id="login_otp_value" autocomplete="off" value="{{ old('email') }}" maxlength="5" placeholder="Enter OTP here" style="width: 75%" required />
											<!-- OTP timer & Resend -->
											<span class="timer otp-timer" id="timer"></span>
										</div>
										<div class="flexCenter"><span id="error-icon"></span><span id="otpErrorMessage" class="error-message"></span></div>
									</div>
									<div class="btn-login-cont">
										<input type="hidden" name="currentURL" value="{{ url()->current() }}">
										<p class="textCentre errorColor" id="error_box"></p>
										<button type="button" id="otp_login" class="btn-login">Continue</button>
									</div>
								</form>
								<p class="textCentre">
									<a href="#user-login" data-dismiss="modal" data-toggle="modal">Login with Password</a>
								</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Reset Password Modal -->
				<div class="guest-login-modal fade" id="forget_password" role="dialog"> 
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="login-modal-content">
					        <div class="login-modal-header">
					          <button type="button" class="close-login" data-dismiss="modal">&times;</button>
					          <h4>Reset Password</h4>
					        </div>
					        <div class="login-modal-body">
					        	<form action="#" method="post" id="forget_password_form" name="forget_password_form">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="reset-password-instructions">
										<p>Please enter your registered email id associated with us.<br>We will send you the instructions to reset your password.</p>
									</div>
									<!-- email id -->
									<div class="user-login-field">
										<label for="email">Email ID</label>
										<div class="user-input-group innerField-pwd-reset">
											<span class="user-input-group-addon" aria-hidden="true">
												<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" class="envelope-icon" ><path d="M21 3H3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM3 5l9 7 9-7M3 19" class="envelope-shape" /></svg>
											</span>
											<input type="email" id="email-pwd-reset" name="email" value="{{ old('email') }}" placeholder="Enter email id registered with us" required />
										</div>
										<div class="flexCenter">
											<span id="error-icon-pwd-reset"></span>
											<span id="reset-email-pwd-error-message" class="error-message"></span>
										</div>
									</div>
									<div class="login-modal-footer">
										<button type="submit" id="btn-email-pwd-reset" class="btn-reset-pwd">Reset Password</button>
									</div>
									<p class="textCentre">
										<a href="#user-login" data-dismiss="modal" data-toggle="modal">Back to Login</a>
									</p>
								</form>
								
							</div>
						</div>
					</div>
				</div>

				<!--Guest Email Signup Modal-->
				<div class="guest-login-modal fade" id="user-signup" role="dialog">
					<div class="modal-dialog">
				    	<!-- Modal content-->
					    <div class="login-modal-content">
					    	<div class="login-modal-header">
					          <button type="button" class="close-login" data-dismiss="modal"></button>
					        	<h4>Email Signup</h4>
					        </div>
					        <div class="login-modal-body">
								<!--Guest Email Signup-->
								<form id="register-customer" name="register-customer" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}" />
									<!-- first name -->
									<div class="user-login-field">
										<label for="firstName">First Name</label>
										<div class="user-input-group innerField-signup-firstName">
											<input type="text" name="first_name" id="firstName" autocomplete="off" value="{{ old('first_name') }}" placeholder="Enter first name" />
										</div>
										<p id="firstNameErrorMessage" class="error-message"></p>
									</div>
									<!-- last name -->
									<div class="user-login-field">
										<label for="lastName">Last Name</label>
										<div class="user-input-group innerField-signup-lastName">
											<input type="text" name="last_name" id="last_name" autocomplete="off" value="{{ old('last_name') }}" placeholder="Enter last name" />
										</div>
										<p id="lastNameErrorMessage" class="error-message"></p>
										<p id="sameNameErrorMessage" class="error-message"></p>
									</div>
									<!-- signup email id -->
									<div class="user-login-field">
										<label for="signupEmail">Email ID</label>
										<div class="user-input-group innerField-signup">
											<span class="user-input-group-addon" aria-hidden="true">
												<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" class="envelope-icon" ><path d="M21 3H3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM3 5l9 7 9-7M3 19" class="envelope-shape" /></svg>
												<!-- <i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> -->
											</span>
											<input type="email" name="email" id="signupEmail" value="{{ old('email') }}" autocomplete="off" placeholder="Enter email id" />
										</div>
										<p id="signupEmailErrorMessage" class="error-message"></p>
									</div>
									<!-- signup password -->
									<div class="user-login-field">
										<label for="signupPassword">Password</label>
										<div class="user-input-group innerField-signup-password">
											<span class="user-input-group-addon">
												<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="lock-icon"><rect x="5" y="11" width="14" height="10" rx="2" ry="2" class="lock-body" /><path d="M16 11V7a4 4 0 0 0-8 0v4" class="lock-shackle" /></svg>
											</span>
											<input type="password" name="password" id="signupPassword" autocomplete="off" placeholder="Enter password" />
											<button type="button" class="showPassword" id="togglePassword">
												<i id="eyeIcon" class="fa fa-eye" aria-hidden="true"></i>
											</button>
										</div>
										<p id="signupPasswordErrorMessage" class="error-message"></p>
									</div>
									<!-- reconfirm password -->
									<div class="user-login-field">
										<label for="password2">Reconfirm Password</label>
										<div class="user-input-group innerField-signup-password2">
											<span class="user-input-group-addon">
												<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="lock-icon"><rect x="5" y="11" width="14" height="10" rx="2" ry="2" class="lock-body" /><path d="M16 11V7a4 4 0 0 0-8 0v4" class="lock-shackle" /></svg>
												<!-- <i class="glyphicon glyphicon-lock" aria-hidden="true"></i> -->
											</span>
											<input type="password" name="password_confirmation" id="password2" autocomplete="off" placeholder="Re-enter password" />
											<button type="button" class="showPassword" id="togglePassword2">
												<i id="eyeIconReconfirm" class="fa fa-eye" aria-hidden="true"></i>
											</button>
										</div>
										<p id="password2ErrorMessage" class="error-message"></p>
									</div>
									<!-- subscribe -->
									<div class="acceptance-cont">
										<label class="checkmarkCont">
											<input type="checkbox" checked="checked">
											<span class="checkmark signup-acceptance"></span>
										</label>
										<!-- <p>@if(env("WEBSITENAME")==1)Subscribe for latest promotions and offers @elseif(env("WEBSITENAME")==0)Subscribe for latest promotions and offers @endif</p> -->
										<p>Subscribe for latest promotions and offers</p>
									</div>
									<!-- signup acceptance -->
									<div class="acceptance-cont">
										<label class="checkmarkCont">
											<input type="checkbox" id="signupAcceptance" />
											<span class="checkmark signup-acceptance"></span>
										</label>
										<!-- <p>By signing up, you agree to @if(env("WEBSITENAME")==1) The World Gateway's @elseif(env("WEBSITENAME")==0) Rapidex Travels's @endif <a href="{{ URL::to('/Privacy-Policy') }}" class="link-color" target="_blank">Privacy Policy</a> and <a href="{{ URL::to('/User-Agreement') }}" class="link-color" target="_blank">User Agreement</a></p> 
										-->
										<p>By signing up, you agree to {{ getWebsiteData('name') }} 
											<a href="{{ route('privacyPolicy') }}" class="link-color" target="_blank">Privacy Policy</a> and 
											<a href="{{ route('userAgreement') }}" class="link-color" target="_blank">User Agreement</a>
										</p>
									</div>
									<!-- signup button -->
									<div class="appndTop25">
										<button type="submit" class="btnCreate btn-login disabled" id="btnEmailSignup" disabled="disabled">Create Account</button>
									</div>
								</form>
								<div class="existing-user-cont">
									<!-- <p>Already a @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif member? 
										<a href="#user-login" class="link-color" data-dismiss="modal" data-toggle="modal">Login</a>
									</p> -->
									<p>Already a {{ getWebsiteData('name') }} member? 
										<a href="#user-login" class="link-color" data-dismiss="modal" data-toggle="modal">Login</a>
									</p>
								</div>
					        </div>
					    </div>
				    </div>
				</div>

				<!--Processing Modal-->
				@include('home.profile_pages.processing')

				<!-- Guest Email Signup - Email Verify OTP  Modal -->
				<div class="guest-login-modal fade" id="otp_signup_modal" role="dialog">
				    <div class="modal-dialog">
				    	<!-- Modal content-->
				    	<div class="login-modal-content">
					        <div class="login-modal-header">
					        	<button type="button" class="close-login" data-dismiss="modal"></button>
					        	<h4>Enter OTP to continue</h4>
					        </div>
					        <div class="login-modal-body">
					        	<form action="#" method="post" id="login_customer" name="login_customer">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="login-modal-body-title">
										<h3>Verify your Email id</h3>
										<p>OTP has been sent successfully on registered Email-id</p>
									</div>
									<div class="user-login-field">
										<label for="signup_otp_value">OTP</label>
										<div class="user-input-group innerField-enter-signup-otp">
											<input type="text" id="signup_otp_value" name="signup_otp_value" autocomplete="off" maxlength="5" placeholder="Enter OTP here" style="width: 75%" required />
											<!-- OTP timer & Resend -->
											<span class="timer otp-timer" id="timer"></span>
										</div>
										<!-- <span class="otp-validity disabled">Enter valid OTP</span> -->
										<div class="flexCenter"><span id="error-icon"></span><span id="signupOtpErrorMessage" class="error-message"></span></div>
									</div>
									<div class="btn-login-cont">
										<input type="hidden" name="currentURL" value="{{ url()->current() }}">
										<!-- <p style="text-align: center;color: red;" id="error_box"></p> -->
										<button type="submit" id="otp_signup" class="btn-login disabled" disabled="disabled">Continue</button>
									</div>
								</form>
							</div>
						</div>
				    </div>
				</div>