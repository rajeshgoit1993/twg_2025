<style>
.apndBtm10 {
	margin-bottom: 10px;
	}
.appndTop25 {
	margin-top: 25px;
	}
.textCentre {
	text-align: center;
	}
.popup-wrapper .popup-content {
    float: none;
    padding: 0;
    margin: 0 auto;
    text-align: left;
    z-index: 10003;
    position: relative;
    display: inline-block;
    vertical-align: middle;
	}
.travel_login {
    width: 65%;
	}
.user-login-box, .user-signup-box {
	background: #fff;
	padding: 20px;
	border: 2px solid #01b7f2;
	border-radius: 5px;
	margin: 0 auto;
    display: none;
	}
.user-login-box h3, .user-signup-box h2, .email-signup h3 {
	font-size: 21px;
	line-height: 26px;
	color: #000001;
	font-weight: 600;
	text-align: center;
	margin-bottom: 15px;
	}
.user-login-box label, .user-signup-box label, .email-signup label {
	font-size: 14px;
    line-height: 16px;
    font-weight: 600;
    color: #000001 !important;
    text-align: left;
    margin-bottom: 5px;
	cursor: default;
	}
.user-input-group {
    position: relative;
    display: table;
    border-collapse: separate;
	}	
.user-input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;	
	width: 1%;
    white-space: nowrap;
    vertical-align: middle;
	display: table-cell;
	border-right: none !important;
	border-radius: 4px 0px 0px 4px;
	border: 1px solid #ccc
	}
.user-signup-box .signup-email-section {
    margin-bottom: 10px;
	}
.user-signup-box .signup-email-section a {
	padding: 2px 0px;
	font-size: 18px;
	line-height: 36px;
	color: #fff;
	border-radius: 4px;
	display: flex;
	justify-content: center;
	margin-bottom: 20px;
	}
.user-login-box .login-email, .user-signup-box .login-email {
    background: #155c92;
    padding: 2px 0px;
    font-size: 18px;
	line-height: 36px;
	font-weight: 400;
	color: #3b5998;
	border: 1px solid #ccc;
    border-radius: 4px;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
	}
.user-login-box .login-facebook, .user-signup-box .login-facebook{
    background: #155c92;
    padding: 2px 0px;
    font-size: 18px;
	line-height: 36px;
	font-weight: 400;
	color: #fff;
	border: 1px solid #ccc;
    border-radius: 4px;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
	}
.user-login-box .login-googleplus, .user-signup-box .login-googleplus {
    background: #d13535;
    padding: 2px 0px;
    font-size: 18px;
	line-height: 36px;
	font-weight: 400;
	color: #fff;
	border: 1px solid #ccc;
    border-radius: 4px;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
	}
.soap-icon-letter:before {
	content: '\e85e';
	font-family: "soap-icons";
    font-style: normal;
    font-weight: normal;
    speak: none;
    display: inline-block;
    text-decoration: inherit;
    text-align: center;
    font-variant: normal;
    text-transform: none;
    line-height: 1px;
	}
.soap-icon-facebook:before {
	content: '\e8a0';
	font-family: "soap-icons";
    font-style: normal;
    font-weight: normal;
    speak: none;
    display: inline-block;
    text-decoration: inherit;
    text-align: center;
    font-variant: normal;
    text-transform: none;
    line-height: 1px;
	}
.soap-icon-googleplus:before {
	content: '\e8a1';
	font-family: "soap-icons";
    font-style: normal;
    font-weight: normal;
    speak: none;
    display: inline-block;
    text-decoration: inherit;
    text-align: center;
    font-variant: normal;
    text-transform: none;
    line-height: 1px;
	}
.soap-icon-letter, .soap-icon-facebook, .soap-icon-googleplus {
	font-size: 24px;
    margin-right: 20px
	}
	
.user-signup-box .goto-login, .user-signup-box .goto-signup, .user-signup-box .signup-email, .user-login-box .goto-login, .user-login-box .goto-signup, .user-login-box .signup-email {
    color: #01b7f2;
    font-size: 15px;
    line-height: 15px;
	}
.checkbox {
    position: relative;
    margin: 0;
    line-height: 20px;
	}
.user-signup-box .checkbox label {
    display: -webkit-inline-box;
    font-size: 14px;
    line-height: 16px;
    color: #000001 !important;
    font-weight: 600;
    text-align: left;
    margin-bottom: 10px;
	}
.user-login-box .checkbox label {
    display: -webkit-inline-box;
    font-size: 14px;
    line-height: 16px;
    color: #01b7f2 !important;
    font-weight: 500;
    text-align: left;
	margin: 0;
	}
.checkbox input[type="checkbox"] {
    position: relative;
    z-index: 1;
    filter: alpha(opacity=0);
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    -moz-opacity: 0;
    -khtml-opacity: 0;
    opacity: 0;
	}
.user-login-box .forgot-password {
    color: #01b7f2;
    text-decoration: underline;
	}
.user-signup-box .seperator, .user-login-box .seperator {
    line-height: 0;
    border-top: 1px solid #f5f5f5;
    position: relative;
    margin-top: 30px;
    margin-bottom: 30px;
	}
.user-signup-box .seperator label, .user-login-box .seperator label {
    display: block;
    font-size: 14px;
	color: #9b9b9b !important;
	font-weight: 400;
    position: absolute;
    left: 50%;
    top: 50%;
    line-height: 1;
    background: #fff;
    padding: 0 10px;
    margin: -1px 0 0;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
	}

<!--Email Signup-->
.user-signup-box .email-signup {
    margin-top: 5px;
    margin-bottom: 20px;
    display: none;
	}

.user-input-group input[type=email], .user-input-group input[type=password] {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 0px 4px 4px 0px;
    font-size: 14px;
    line-height: 14px;
    padding: 12px 16px;
    outline: 0;
    height: 38px;
	width: 100%;
	-moz-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -o-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	cursor: text;
	}
.email-signup input[type=text], .email-signup input[type=password] {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    line-height: 14px;
    padding: 12px 16px;
    outline: 0;
    height: 38px;
	width: 100%;
	-moz-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -o-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	cursor: text;
	}
.user-signup-box p {
	font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 500;
    text-align: left;
    margin-top: 20px;
    margin-bottom: 20px;
	}
.user-signup-box p a {
    color: #01b7f2;
    font-weight: 600;
	}
.forgotCont {
	margin-bottom: 20px;
	display: flex;
	justify-content: space-between;
	}
.description {
	font-size: 14px;
	line-height: 16px;
	color: #4a4a4a;
	font-weight: 400;
	text-align: left;
	margin: 0;
	}
.btnCreate {
    display: inline-block;
    padding: 6px 12px;
	border: 1px solid #2e6da4;
    border-radius: 4px;
    font-size: 18px;
    line-height: 20px;
	color: #fff;
	font-weight: 600;
    text-align: center;
	margin-bottom: 0;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    background: #337ab7;
    -webkit-appearance: button;
    outline: 0;
	width: 100%;
    height: auto;
	}
.btnCreate:hover {
	background: #337ab7;
	color: #fff;
	}
	.modal { overflow-y: auto }
	.login_resend
	{
		cursor: pointer;
	}
</style>


  


<!--Guest Signup-->
<!-- Modal -->
  <div class="modal fade" id="user-signup" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SignUp</h4>
        </div>
        <div class="modal-body">
        <div class="simple-signup">
		
		<div class="text-center signup-email-section">
			<a href="#" class="signup-email login-email" style=""><i class="soap-icon-letter" aria-hidden="true"></i>Signup with Email</a>
		</div>
		<div class="seperator">
			<label>Or Signup with</label>
		</div>
		<div class="login-social">
			<!-- <a href="#" class="login-facebook"><i class="soap-icon-facebook" aria-hidden="true"></i>Signup with Facebook</a> -->
			<a href="{{url('/login_with_google')}}" class="login-googleplus"><i class="soap-icon-googleplus" aria-hidden="true"></i>Signup with Google+</a>
		</div>
		<p>By signing up, you agree to @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif <a href="{{ URL::to('/User-Agreement') }}" target="_blank">Terms of Service</a> and <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank">Privacy Policy</a>
		</p>
	</div>
        
	<!--Guest Email Signup-->
	<div class="email-signup">

		<h3>Email Signup</h3>
		<form  id="register-customer" name="register-customer" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			
			<div class="form-group">
				<label>First Name</label>
				<input type="text" id="firstName" name="first_name"  value="{{ old('first_name') }}" placeholder="First Name" required />
			</div>
			<div class="form-group">
				<label>Last Name</label>
				<input type="text" id="lastName" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required />
			</div>
			<div class="form-group">
				<label>Email ID</label>
				<div class="user-input-group">
					<span class="user-input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
					<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email ID" required />
				</div>
			</div>
			<div class="form-group">
				<label>Password</label>
				<div class="user-input-group">
					<span class="user-input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
					<input type="password" name="password" id="password" placeholder="Enter Password" style="border-radius: 0 4px 4px 0;" required />
				</div>
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<div class="user-input-group">
					<span class="user-input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
					<input type="password" name="password_confirmation" id="password2" placeholder="Re-enter Password" style="border-radius: 0 4px 4px 0;" required />
				</div>
			</div>
			<div class="checkbox">
				<label>
				<input type="checkbox">
					@if(env("WEBSITENAME")==1)Subscribe for latest promotions and offers
					@elseif(env("WEBSITENAME")==0)Subscribe for latest promotions and offers
					@endif
				</label>
			</div>
			<div class="form-group">
				<p>By signing up, you agree to @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif <a href="{{ URL::to('/User-Agreement') }}" target="_blank">Terms of Service</a> and <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank">Privacy Policy</a>
				</p>
			</div>
			<div class="appndTop25">
				<input type="submit" value="Create Account" class="btnCreate">
			</div>
			</form>
	</div>
		
		<div class="seperator"></div>
		<div>
			<p>Already a @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif member?
				<a href="#user-login"  data-dismiss="modal" data-toggle="modal" class="soap-popupbox"> Login</a>
			</p>
		</div>




        </div>
       
      </div>
      
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="otp_signup_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign-up Email Verify </h4>
        </div>
        <div class="modal-body">
        
	<form action="#" method="post" id="login_customer" name="login_customer">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			
				<p class="pfwmt fontWeight500">OTP has been sent to EMAIL</p>
			
        </div>
		<label>Enter OTP  </label>
		<div class="user-input-group apndBtm10">
			<span class="user-input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
			<input type="text" class="form-control" id="signup_otp_value" name="signup_otp_value" value="{{ old('email') }}" placeholder="Enter OTP" required />
		</div>
		
		
		<div>
			<input type="hidden" name="currentURL" value="{{ url()->current() }}">
			<p style="text-align: center;color: red;" id="error_box"></p>
			<input type="button" id="otp_signup" value="Submit" class="btnCreate">
           
	

		</div>
	</form>
	<div class="seperator">
		<label>Or Login with</label>
	</div>
	<div class="login-social">
			<!-- <a href="#" class="login-facebook"><i class="soap-icon-facebook" aria-hidden="true"></i>Login with Facebook</a> -->
			<a href="{{url('/login_with_google')}}" class="login-googleplus"><i class="soap-icon-googleplus" aria-hidden="true"></i>Login with Google+</a>
		</div>



        </div>
       
      </div>
      
    </div>
  </div>


<!-- Modal -->


<!--Guest Login-->
@include('home.profile_pages.processing')
<!-- Modal -->
  <div class="modal fade" id="user-login" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login </h4>
        </div>
        <div class="modal-body">
        
	<form action="{{ URL::to('/login-customer') }}" method="post" id="login_customer" name="login_customer">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<label>Email ID</label>
		<div class="user-input-group apndBtm10">
			<span class="user-input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
			<input type="email" id="login_email" name="email" value="{{ old('email') }}" placeholder="Enter Email ID" required />
		</div>
		<label>Password</label>
		<div class="user-input-group apndBtm10">
			<span class="user-input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
			<input type="password" name="password" id="password" placeholder="Enter Password" required />
		</div>
		<div class="forgotCont">
			<div class="checkbox">
				<input type="checkbox" name="rememberme" value="rememberme" />
				<label for="rememberme">Remember me</label>
			</div>
			<div>
				<a href="#forget_password" data-dismiss="modal" data-toggle="modal" class="soap-popupbox forgot-password pull-right">Forgot password?</a>
			</div>
		</div>
		<div>
			<input type="hidden" name="currentURL" value="{{ url()->current() }}">
			<p style="text-align: center;color: red;" id="error_box"></p>
			<input type="submit" value="LOGIN" class="btnCreate">
           
			<input type="button" id="login_with_otp" value="LOGIN WITH OTP" class="btnCreate" style="margin-top:15px">

		</div>
	</form>
	<div class="seperator">
		<label>Or Login with</label>
	</div>
	<div class="login-social">
			<!-- <a href="#" class="login-facebook"><i class="soap-icon-facebook" aria-hidden="true"></i>Login with Facebook</a> -->
			<a href="{{url('/login_with_google')}}" class="login-googleplus"><i class="soap-icon-googleplus" aria-hidden="true"></i>Login with Gmail</a>
		</div>
	<div class="seperator"></div>
	<p>Don't have an account? <a href="#user-signup" data-dismiss="modal" data-toggle="modal"  class="goto-signup soap-popupbox">Sign up</a></p>


        </div>
       
      </div>
      
    </div>
  </div>

<!-- Modal -->
  <div class="modal fade" id="otp_login_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login </h4>
        </div>
        <div class="modal-body">
        
	<form action="{{ URL::to('/login-customer') }}" method="post" id="login_customer" name="login_customer">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			
				<p class="pfwmt fontWeight500">OTP has been sent to EMAIL & Mobile</p>
			
        </div>
		<label>Enter OTP  <span class="timer" id="timer">	 </span>  </label>
		<div class="user-input-group apndBtm10">
			<span class="user-input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
			<input type="text" class="form-control" id="login_otp_value" name="login_otp_value" value="{{ old('email') }}" placeholder="Enter OTP" required />
		</div>
		
		
		<div>
			<input type="hidden" name="currentURL" value="{{ url()->current() }}">
			<p style="text-align: center;color: red;" id="error_box"></p>
			<input type="button" id="otp_login" value="LOGIN" class="btnCreate">
           
	

		</div>
	</form>
	<div class="seperator">
		<label>Or Login with</label>
	</div>
	<div class="login-social">
			<!-- <a href="#" class="login-facebook"><i class="soap-icon-facebook" aria-hidden="true"></i>Login with Facebook</a> -->
			<a href="{{url('/login_with_google')}}" class="login-googleplus"><i class="soap-icon-googleplus" aria-hidden="true"></i>Login with Google+</a>
		</div>
	<div class="seperator"></div>
	<p>Don't have an account? <a href="#user-signup" data-dismiss="modal" data-toggle="modal"  class="goto-signup soap-popupbox">Sign up</a></p>


        </div>
       
      </div>
      
    </div>
  </div>


<!-- Modal -->

 <div class="modal fade" id="forget_password" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Forgot Password</h4>
        </div>
        <div class="modal-body">
        
<form action="#" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="modal-body">
			<div class="row">
				<label>Email ID</label>
				<div class="user-input-group apndBtm10">
					<span class="user-input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
					<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email id registered with us" required />
				</div>
				<div class="form-group">
					<p class="description">Please enter your email in the box above. We will send you a link to access further instructions.</p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<div class="row">
				<button type="submit" class="btnCreate">Reset Password</button>
			</div>
		</div>
	</form>
	<p class="textCentre"><a href="#user-login" data-dismiss="modal" data-toggle="modal" class="soap-popupbox">Back to Login</a></p>


        </div>
       
      </div>
      
    </div>
  </div>




<div id="forget_password" class="user-login-box travel_login">
	<h3></h3>
	
</div>
<!--Login ends-->