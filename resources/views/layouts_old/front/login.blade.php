			<!--Guest Signup-->
			<div id="travelo-signup" class="travelo-signup-box travelo-box travel_login" style="padding: 20px 20px;border-radius: 5px;">
				<div class="simple-signup" style="margin: 0px">
					<h2 style="text-align: center;color: #4a4a4a;font-weight: 600;margin-bottom: 30px;">Signup</h2>
					<div class="text-center signup-email-section">
						<a href="#" class="signup-email login-facebook" style="color: #ffffff;padding: 2px 0px;line-height: 36px;font-size: 18px;border-radius: 4px;display: flex;justify-content: center;margin-bottom: 20px"><i class="soap-icon-letter" style="font-size: 24px;margin-right: 20px;" aria-hidden="true"></i>Signup with Email</a>
					</div>
					<div class="seperator" style="margin: 40px 0px;"><label style="color: #9b9b9b !important;font-size: 14px">Or Signup with</label></div>
					<div class="login-social" style="">
						<a href="#" class="login-facebook" style="border: 1px solid #ccc;background-color: #ffffff;color: #3b5998;padding: 2px 0px;line-height: 36px;font-size: 18px;border-radius: 4px;display: flex;justify-content: center;margin-bottom: 20px"><i class="soap-icon-facebook" style="font-size: 24px;margin-right: 20px; aria-hidden="true"></i>Signup with Facebook</a>
						<a href="#" class="login-googleplus" style="border: 1px solid #ccc;background-color: #ffffff;color:  #db4a39;padding: 2px 0px;line-height: 36px;font-size: 18px;border-radius: 4px;display: flex;justify-content: center;margin-bottom: 20px"><i class="soap-icon-googleplus" style="font-size: 24px;margin-right: 20px;" aria-hidden="true"></i>Signup with Google+</a>
					</div>
					<p class="description" style="text-align: left;margin: 30px 0px;font-size: 14px;color: #4a4a4a">By signing up, you agree to @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif <a href="{{ URL::to('/User-Agreement') }}" target="_blank"><span style="color: #01b7f2;font-weight: 500;">Terms of Service</span></a> and <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank"><span style="color: #01b7f2;font-weight: 500;">Privacy Policy</span></a></p>
				</div>
				<!--Guest Email Signup-->
				<div class="email-signup">
					<h3 style="text-align: center;color: #4a4a4a;font-weight: 600;margin-bottom: 10px;">Email Signup</h3>
					<form action="{{ URL::to('/register-customer') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<label style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">First Name</label>
							<div style="" class="form-group">
								<input type="text" id="firstName" name="first_name"  value="{{ old('first_name') }}" placeholder="First Name" class="input-text full-width" style="background-color: #ffffff;border-color: #ccc;border-radius:4px;height: 38px" required >
							</div>
							<label style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Last Name</label>
							<div style="" class="form-group">
								<input type="text" id="lastName" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="input-text full-width" style="background-color: #ffffff;border-color: #ccc;border-radius: 4px;height: 38px" required >
							</div>
							<label style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Email ID</label>
							<div style="margin-bottom: 10px" class="input-group">
								<span class="input-group-addon" style="border-right: none !important;border-radius: 4px 0px 0px 4px;border: 1px solid #ccc"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
								<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email ID" class="input-text full-width" style="background-color: #ffffff;border-color: #ccc;border-radius: 0px 4px 4px 0px;height: 38px" required >
							</div>
							<label style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Password</label>
							<div style="margin-bottom: 10px" class="input-group">
								<span class="input-group-addon" style="border-right: none !important;border-radius: 4px 0px 0px 4px;border: 1px solid #ccc;height: 38px"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
								<input type="password" name="password" id="password" placeholder="Enter Password" class="input-text full-width" style="background-color: #ffffff;border-color: #ccc;border-radius: 0px 4px 4px 0px;height: 38px" required >
							</div>
							<label style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Confirm Password</label>
							<div style="margin-bottom: 10px" class="input-group">
								<span class="input-group-addon" style="border-right: none !important;border-radius: 4px 0px 0px 4px;border: 1px solid #ccc;height: 38px"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
								<input type="password" name="password_confirmation" id="password2" placeholder="Re-enter Password" class="input-text full-width" style="background-color: #ffffff;border-color: #ccc;border-radius: 0px 4px 4px 0px;height: 38px" required >
							</div>
							<div class="checkbox" style="margin-top: 10px">
								<label style="font-weight: bold">
								<input type="checkbox">
									@if(env("WEBSITENAME")==1)Subscribe for latest promotions and offers
									@elseif(env("WEBSITENAME")==0)Subscribe for latest promotions and offers
									@endif
								</label>
							</div>
					<div class="form-group">
						<p class="description" style="text-align: left;margin: 0px;font-size: 14px;color: #4a4a4a">By signing up, you agree to @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif <a href="{{ URL::to('/User-Agreement') }}" target="_blank"><span style="color: #01b7f2;font-weight: 500;">Terms of Service</span></a> and <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank"><span style="color: #01b7f2;font-weight: 500;">Privacy Policy</span></a></p>
					</div>
					<div style="margin-top: 25px;">
						<input type="submit" value="Create Account" class="btn btn-primary btn-block btn-flat" style="font-size: 18px;border-radius: 4px;font-weight: 600">
					</div>
				</div>
					</form>
				<div class="seperator"></div>
					<p>Already a @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif member?
					<a href="#travelo-login" class="goto-login soap-popupbox" style="font-weight: 600"> Login</a></p>
			</div>
		</div>
			<!--Guest Login-->
			<div id="travelo-login" class="travelo-login-box travelo-box travel_login" style="padding: 30px 20px;border-radius: 5px;">
				<h3 style="text-align: center;color: #4a4a4a;font-weight: 600;margin-bottom: 10px;">Login/Signup</h3>
				<form action="{{ URL::to('/login-customer') }}" method="post" id="login_customer" name="login_customer">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<label style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Email ID</label>
							<div style="margin-bottom: 10px" class="input-group">
								<span class="input-group-addon" style="border-right: none !important;border-radius: 4px 0px 0px 4px;border: 1px solid #ccc"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
								<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email ID" class="input-text full-width" style="background-color: #ffffff;border-color: #ccc;border-radius: 0px 4px 4px 0px;height: 38px" required >
							</div>
						<label style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Password</label>
							<div style="margin-bottom: 10px" class="input-group">
								<span class="input-group-addon" style="border-right: none !important;border-radius: 4px 0px 0px 4px;border: 1px solid #ccc;height: 38px"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
								<input type="password" name="password" id="password" placeholder="Enter Password" class="input-text full-width" style="background-color: #ffffff;border-color: #ccc;border-radius: 0px 4px 4px 0px;height: 38px" required >
							</div>
						<div class="form-group">
							<a href="#publisher_forget" class="soap-popupbox  forgot-password pull-right">Forgot password?</a>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox"> Remember me
									</label>
								</div>
						</div>
						<div>
							<input type="hidden" name="currentURL" value="{{ url()->current() }}">
							<p style="text-align: center;color: red;" id="error_box"></p>
							<input type="submit" value="LOGIN" class="btn btn-primary btn-block btn-flat" style="font-size: 18px;border-radius: 4px;font-weight: 600">
						</div>
				</form>
				<div class="seperator" style="margin: 40px 0px;"><label style="color: #9b9b9b !important;font-size: 14px">Or Login with</label></div>
				<div class="login-social">
					<a href="#" class="button login-facebook" style="padding: 2px 0px;height: 40px;text-align: center;font-size: 18px;border-radius: 4px;display: flex;justify-content: center;"><i class="soap-icon-facebook" style="margin-right: 20px;" aria-hidden="true"></i>Login with Facebook</a>
					<a href="#" class="button login-googleplus" style="padding: 2px 0px;height: 40px;text-align: center;font-size: 18px;border-radius: 4px;display: flex;justify-content: center;"><i class="soap-icon-googleplus" style="margin-right: 20px;" aria-hidden="true"></i>Login with Google+</a>
				</div>
				<div class="seperator"></div>
					<p>Don't have an account? <a href="#travelo-signup" class="goto-signup soap-popupbox">Sign up</a></p>
				</div>
				<!---->
				<!-- Modal -->
				<div id="publisher_forget" class="travelo-login-box travelo-box travel_login" style="padding: 30px 20px;border-radius: 5px;">
					<h3 style="margin-bottom: 10px;">Forgot Password</h3>
						<form action="#" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="modal-body">
									<div class="row">
										<label style="font-size: 14px;font-weight: bold;color: #4a4a4a !important;">Email ID</label>
										<div style="margin-bottom: 10px" class="input-group">
											<span class="input-group-addon" style="border-right: none !important;border-radius: 4px 0px 0px 4px;border: 1px solid #ccc"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
											<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email id registered with us" class="input-text full-width" style="background-color: #ffffff;border-color: #ccc;border-radius: 0px 4px 4px 0px;height: 38px" required >
										</div>
										<div class="form-group">
											<p class="description" style="text-align: left;margin: 0px;font-size: 14px;color: #4a4a4a">Please enter your email in the box above. We will send you a link to access further instructions.</p>
										</div>
									</div>
								</div>
							<div class="modal-footer" style="text-align: left;">
								<div class="row">
									<button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-top: 10px;padding: 0px;font-size: 16px;border-radius: 4px;font-weight: 600">Reset Password</button>
								</div>
							</div>
						</form>
						<p style="text-align: center;"><a href="#travelo-login" class="goto-login soap-popupbox">Back to Login</a></p>
					</div>
					<!---->