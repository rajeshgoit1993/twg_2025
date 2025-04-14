<style>
/*Common Starts*/
a {
	background-color: transparent;
	text-decoration: none;
	color: inherit;
	}
a:focus {
	outline: none;	
	}

a:link, a:visited, a:hover, a:active, a:focus {
	color: unset;
	background-color: transparent;
	text-decoration: none;
	}
.apndBtm10 {
	margin-bottom: 10px;
	}
.appndTop25 {
	margin-top: 25px;
	}
.textCentre {
	text-align: center;
	}


/*.popup-wrapper .popup-content {
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
	}*/

/*Email Signup Starts*/
	.user-signup-box .email-signup {
	    margin-top: 5px;
	    margin-bottom: 20px;
	    display: none;
		}
	.user-input-group input[type=email], .user-input-group input[type=password] {
	   /* background: #fff;
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
		cursor: text;*/
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
	
	.description {
		font-size: 14px;
		line-height: 16px;
		color: #4a4a4a;
		font-weight: 400;
		text-align: left;
		margin: 0;
		}
/*	.btnCreate {
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
		}*/
	.modal {
		z-index: 1054; /*for login box at top*/
		overflow-y: auto
		}
	
/*Email Signup Ends*/
</style>

<style type="text/css">
/*Guest Login Starts*/
	.link-color {
		color: #01b7f2 !important;
		}
	.guest-login-modal {
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: 1055;
		display: none;
		overflow: hidden;
		-webkit-overflow-scrolling: touch;
		outline: 0;
		}
	.guest-login-modal .modal-dialog {
	    max-width: 525px;
	    margin: 30px auto;
		}
	.guest-login-modal .login-modal-content {
		width: 100%;
		max-width: 525px;
		min-height: 575px;
		box-shadow: 0 1px 7px 0 rgba(0, 0, 0, 0.4);
		padding: 30px;
		border-radius: 10px;
		background-color: #fff;
		overflow: hidden;
		}
	.guest-login-modal .login-modal-header {
	    padding: 0;
	    /*border-bottom: 1px solid #e5e5e5;*/
	    margin-bottom: 15px;
		}
	.guest-login-modal .login-modal-header h4 {
	    font-size: 26px;
	    line-height: 26px;
	    color: #000001;
	    text-align: left;
	    font-weight: 600;
	    margin: 0;
		}
	.close-login {
		background-color: #e7e7e7;
		position: absolute;
		display: flex;
		align-items: center;
		justify-content: center;
		top: 30px;
		right: 30px;
		width: 26px;
		height: 26px;
		border: 0;
		border-radius: 50%;
		z-index: 1;
		/*opacity: 0.2;*/
		cursor: default;
		}
	.close-login:hover {
		cursor: pointer;
		}
	.close-login:before {
		transform: rotate(45deg);
		}
	.close-login:before, .close-login:after {
		position: absolute;
		left: 12px;
		content: ' ';
		height: 13px;
		width: 2px;
		background-color: #8b8b8b;
		}
	.close-login:after {
		transform: rotate(-45deg);
		}
	.login-modal-body {
		position: relative;
		padding-top: 15px;
		}
	.user-login-field {
		margin-bottom: 15px;
		}
	.user-login-field label {
	    display: inline-block;
	    max-width: 100%;
	    font-size: 14px;
	    line-height: 14px;
	    color: #4a4a4a;
	    font-weight: 700;
	    text-align: left;
	    margin-bottom: 10px;
		}
	.user-input-group {
	    position: relative;
	    display: table;
	    border-collapse: separate;
	    height: 43px;
	    border: 1px solid #c8c8c8;
	    border-radius: 4px;
	    overflow: hidden;
	    width: 100%;
		}
	.user-input-group-addon {
	    padding: 6px 12px;
	    font-size: 14px;
	    font-weight: 400;
	    line-height: 1;
	    color: #555;
	    text-align: center;
	    background-color: #f9f9f9;	
		width: 1%;
	    white-space: nowrap;
	    vertical-align: middle;
		display: table-cell;
		/*border-right: none !important;
		border-radius: 4px 0px 0px 4px;
		border: 1px solid #9b9b9b;*/
		height: auto;
		border-right: 1px solid #c8c8c8;
		}
	.user-input-group input {
	    background-color: #fff;
	    /*border: 1px solid #9b9b9b;
	    border-radius: 0px 4px 4px 0px;*/
	    border: none;
	    border-radius: 0;
	    font-size: 14px;
	    line-height: 14px;
	    color: #000001;
	    padding: 12px 16px;
	    outline: 0;
	    height: auto;
		width: 100%;
		-moz-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	    -o-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	    -webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
		cursor: text;
		}
	.user-input-group input::placeholder {
		color: #9b9b9b;
		}
	.user-input-group input::-ms-input-placeholder {
		color: #9b9b9b;
		}
	.email-icon:before {
		content: "\2709";
		}
	.envelope-icon {
		fill: none;
		stroke: #000000; /* Change color as needed */
		stroke-width: 2px; /* Change stroke width as needed */
		}
	.envelope-shape {
		fill: none;
		stroke: #4a4a4a; /* Change color as needed */
		stroke-width: 2px; /* Change stroke width as needed */
		}
	.user-input-group:focus, .user-input-group input[type=email]:focus {
	    border-color: #08b2ed;
		}
	.lock-icon {
		fill: none;
		stroke: #4a4a4a; /* Change color as needed */
		stroke-width: 2px; /* Change stroke width as needed */
		}
	.lock-body{
		fill: #fff; /* Change color as needed */
		}
	.lock-shackle {
		fill: none;
		stroke: #4a4a4a; /* Change color as needed */
		stroke-width: 2px; /* Change stroke width as needed */
		}
	.resetCont {
		margin-bottom: 30px;
		display: flex;
		justify-content: space-between;
		}
	.btn-otp-login {
	    background-color: #fff;
	    border: 0;
	    outline: 0;
	    font-size: 13px;
	    line-height: 15px;
	    color: #08B2ED;
	    font-weight: 500;
	    text-align: left;
		}
	.btn-otp-login.disabled {
	    color: #9b9b9b;
		}
	.forgot-password {
		font-size: 13px;
		line-height: 15px;
		color: #9b9b9b;
		font-weight: 500;
		text-align: right;
		}
	.forgot-password a:hover {
		color: #9b9b9b;
		}
	.btn-login-cont {
		margin-bottom: 25px;
		}
	.disabled {
		/*color: #c2c2c2 !important;
		opacity: 0.6;
		pointer-events: none;
		text-decoration-color: #c2c2c2 !important;*/
		}
	.btn-login, .btn-reset-pwd, .btnCreate {
	    display: inline-block;
	    padding: 6px 12px;
	    box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.3);
	    border: 0;
		/*border: 1px solid #2e6da4;*/
	    border-radius: 30px;
	    font-size: 16px;
	    line-height: 16px;
		color: #fff;
		font-weight: 600;
	    text-align: center;
	    text-transform: uppercase;
		margin-bottom: 0;
	    white-space: nowrap;
	    vertical-align: middle;
	    -ms-touch-action: manipulation;
	    touch-action: manipulation;
	    -webkit-user-select: none;
	    -moz-user-select: none;
	    -ms-user-select: none;
	    user-select: none;
	    background-image: none;
	    background-color: #08b2ed;
	    -webkit-appearance: button;
	    outline: 0;
		width: 100%;
	    height: 42px;
	    cursor: pointer;
		}
	.btn-login.disabled, .btn-reset-pwd.disabled, .btnCreate.disabled {
	    box-shadow: none;
	    background-color: #c2c2c2;
	    opacity: 0.6;
		}
	.btn-login:hover, .btn-reset-pwd:hover, .btnCreate:hover {
		background-color: #08b2ed;
		color: #fff;
		}
	.btn-login.disabled:hover, .btn-reset-pwd.disabled:hover, .btnCreate.disabled:hover {
		background-color: #c2c2c2;
		}
	.email-signup-cont {
		margin-bottom: 30px;
		display: flex;
		justify-content: center;
		}
	.email-signup-cont p {
		font-size: 13px;
		line-height: 15px;
		color: #9b9b9b;
		font-weight: 500;
		text-align: center;
		}
	.goto-signup {
    	font-size: 13px;
    	line-height: 15px;
    	color: #01b7f2;
    	font-weight: 500;
    	text-align: left;
		}
	.socialMediaLoginBar {
		width: 100%;
		display: flex;
		align-items: center;
		justify-content: center;
		border-bottom: 1px solid #d8d8d8;
		margin-bottom: 26px;
		}
	.socialMediaLoginBar > span {
		display: inline-flex;
		padding: 0 10px;
		background-color: #fff;
		font-size: 12px;
		line-height: 14px;
		color: #9b9b9b;
		font-weight: 700;
		margin-bottom: -7px;
		}
	.socialMedia-enrollment-buttons {
		display: flex;
		position: relative;
		padding: 0 8px 0 52px;
		background: #fff;
		align-items: center;
		width: 100%;
		font-size: 16px;
		font-family: inherit;
		height: 52px;
		border: 1px solid #c2c8d0;
		border-radius: 3px;
		color: #2d333a;
		cursor: pointer;
		outline: 0;
		transition: box-shadow .15s ease-in-out,background-color .15s ease-in-out;
		}
	.socialMedia-enrollment-button {
		/*display: inline-block;*/
		position: relative;
		/*background-size: contain;
		background-repeat: no-repeat;
		background-position: 50%;*/
		border: 1px solid #e7e7e7;
		border-radius: 5px;
		background-color: #fff;
		padding: 10px 20px;
		width: 250px;
		height: 46px;
		user-select: none;
		-webkit-user-select: none;
		display: flex;
		align-items: center;
		justify-content: center;
		}
	.social-media-cont, .social-media-wrapper {
		display: flex;
		align-items: center;
		justify-content: center;
		}
	.google-icon {
		width: 20px;
		height: 20px;
		}
	.icon-tag-line {
		font-family: "Google Sans",arial,sans-serif;
		font-size: 14px;
		line-height: 14px;
		color: #9b9b9b;
		font-weight: 500;
		text-align: left;
		margin-left: 10px;
		white-space: nowrap;
		}
	.login-footer-cont {
		margin-top: 45px;
		}
	.login-footer-cont p, .login-modal-footer p {
		font-size: 12px;
		line-height: 18px;
		color: #000001;
		text-align: left;
		font-weight: 500;
		margin: 0;
		}
	.login-modal-footer {
		padding: 20px;
		}
/*Guest Login Starts*/
/*Email Signup Starts*/
	.existing-user-cont {
		margin-top:20px;
		margin-bottom: 10px;
		}
	.existing-user-cont p {
		font-size: 13px;
		line-height: 18px;
		color: #000001;
		text-align: left;
		font-weight: 500;
		margin: 0;
		}
	.showPassword {
		position: absolute;
		z-index: 1;
		right: 8px;
		top: 10px;
		font-size: 20px;
		color: #c8c8c8;
		outline: 0;
		border: none;
		background: none;
		}
/*Email Signup Ends*/
/*Forgot Password Starts*/
	.reset-password-instructions {
		margin-top: 5px;
		margin-bottom: 20px;
		}
	.reset-password-instructions p {
		font-size: 14px;
		line-height: 18px;
		color: #000001;
		text-align: left;
		font-weight: 500;
		margin: 0;
		}
/*Forgot Password Ends*/
/*OTP Login Starts*/
	.login-modal-body-title {
		margin-bottom: 25px;
		}
	.login-modal-body-title h3 {
		font-size: 20px;
		line-height: 28px;
		color: #000001;
		text-align: left;
		font-weight: 500;
		margin-bottom: 2px;
		}
	.login-modal-body-title p {
		font-size: 13px;
		line-height: 18px;
		color: #4a4a4a;
		text-align: left;
		font-weight: 500;
		margin: 0;
		/*width: 250px;*/
		}
	.otp-timer {
		font-size: 13px;
		line-height: 13px;
		color: #9b9b9b;
		text-align: left;
		font-weight: 500;
		margin: 0;
		position: relative;
		top: 15px;
		right: 15px;
		float: right;
		}
	.resendOTP {
		font-size: 12px;
		line-height: 12px;
		color: #08b2ed;
		font-weight: 600;
		cursor: pointer;
		}
	.otp-validity {
		font-size: 12px;
		line-height: 14px;
		color: red;
		text-align: left;
		font-weight: 500;
		margin: 0;
		}
	/*Swal alignment starts*/
	.swal-modal {
		vertical-align: inherit;
		}
	.swal-button {
		background-color: #08b2ed;
		outline: 0;
		}
	.swal-icon {
		width: 60px;
		height: 60px;
		border-width: 3px;
		}
	.swal-icon--error {
		border-color: red;
		}
	.swal-icon--error__line {
		background-color: red;
		position: absolute;
		height: 3px;
		width: 28px;
		display: block;
		top: 28px;
		border-radius: 2px;
		}
	/*Swal alignment ends*/
/*OTP Login Ends*/

/*Email Signup Error Starts*/
	.innerField.error, .innerField-login-password.error, .innerField-pwd-reset.error, .innerField-signup-firstName.error, .innerField-signup-lastName.error, .innerField-signup.error, .innerField-signup-password.error, .innerField-signup-password2.error, .innerField-enter-otp.error {
		border-color: #eb2026;
		}
	.error-icon {
		background-color: #eb2026;
		position: relative;
		z-index: 1;
		width: 13px;
		height: 13px;
		border: 0;
		border-radius: 50%;
		margin-top: 5px;
    	margin-right: 5px;
    	display: flex;
		align-items: center;
		justify-content: center;
		}
	.error-icon:before {
		transform: rotate(45deg);
		}
	.error-icon:before, .error-icon:after {
		position: absolute;
		left: 6px;
		content: ' ';
		height: 7px;
		width: 1px;
		background-color: #fff;
		}
	.error-icon:after {
		transform: rotate(-45deg);
		}
	.error-message {
		font-size: 12px;
		line-height: 15px;
		margin-top: 2px;
		font-weight: 500;
		text-align: left;
		color: red;
		}
/*Email Error Ends*/
</style>
<style>
	.acceptance-cont {
		margin-bottom: 5px;
		}
	/* The checkmarkCont */
	.checkmarkCont {
		display: block;
		position: relative;
		/*padding-left: 35px;
		margin-bottom: 12px;
		font-size: 22px;*/
		cursor: default;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		}
	/* Hide the browser's default checkbox */
	.checkmarkCont input {
		position: absolute;
		opacity: 0;
		cursor: pointer;
		height: 0;
		width: 0;
		left: -999px;
		}
	/* Create a custom checkbox */
	.checkmark {
		position: absolute;
		top: 0;
		left: 0;
		}
	.checkmark.signup-acceptance {
		width: 15px;
		height: 14px;
		border: 1px solid #4a4a4a;
		border-radius: 2px;
		background-color: #fff;
		position: absolute; /*can be removed*/
    	top: 2px;
		}
	/* On mouse-over, add a grey background color */
	.checkmarkCont:hover input ~ .checkmark {
		background-color: #fff;
		}
	/* When the checkbox is checked, add a blue background */
	.checkmarkCont input:checked ~ .checkmark {
		background-color: #01b7f2;
		border-color: #01b7f2;
		}
	/* Create the checkmark/indicator (hidden when not checked) */
	.checkmark:after {
		content: "";
		position: absolute;
		display: none;
		}
	/* Show the checkmark when checked */
	.checkmarkCont input:checked ~ .checkmark:after {
		display: block;
		}
	/* Style the checkmark/indicator */
	.checkmarkCont .checkmark:after {
		left: 4px;
		top: 0;
		width: 5px;
		height: 10px;
		border: solid white;
		border-width: 0 2px 2px 0;
		-webkit-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		transform: rotate(45deg);
		}
	.acceptance-cont p {
		padding-left: 20px;
		font-size: 12px;
		line-height: 18px;
		color: #4a4a4a;
		font-weight: 500;
		text-align: left;
		margin: 0;
		}
</style>

<!--custom checkmark-->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/custom-checkmark.css') }}" /> -->

<!--guest login-->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/user-login.css') }}" /> -->

<!-- Email Signup OTP Modal Starts -->
<div class="guest-login-modal fade" id="otp_signup_modal" role="dialog">
    <div class="login-modal-dialog">
    	<!-- Modal content-->
    	<div class="login-modal-content">
	        <div class="modal-header">
	        	<button type="button" class="close-login" data-dismiss="modal"></button>
	        	<h4>Signup Email Verification</h4>
	        </div>
	        <div class="login-modal-body">
	        	<form action="#" method="post" id="login_customer" name="login_customer">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="login-modal-body-title">
						<h3>Verify your Email-id</h3>
						<p>OTP has been sent successfully on registered Email-id</p>
					</div>
					<div class="user-login-field">
						<label for="password">OTP</label>
						<div class="user-input-group apndBtm10">
							<input type="text" id="signup_otp_value" name="signup_otp_value" autocomplete="off" maxlength="6" placeholder="Enter OTP here" style="width: 75%" required />
							<!-- OTP timer & Resend -->
							<!-- <span class="timer otp-timer" id="timer"></span> -->
						</div>
						<span class="otp-validity disabled">Enter valid OTP</span>
					</div>

					<!-- <label>Enter OTP  </label>
					<div class="user-input-group apndBtm10">
						<span class="user-input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
						<input type="text" class="form-control" id="signup_otp_value" name="signup_otp_value" value="{{ old('email') }}" placeholder="Enter OTP" required />
					</div> -->
					<div class="btn-login-cont">
						<input type="hidden" name="currentURL" value="{{ url()->current() }}">
						<p style="text-align: center;color: red;" id="error_box"></p>
						<!-- <input type="button" id="otp_login" value="LOGIN" class="btnCreate"> -->
						<button type="button" id="otp_signup" class="btn-login">Login</button>
					</div>
					<!-- <div>
						<input type="hidden" name="currentURL" value="{{ url()->current() }}">
						<p style="text-align: center;color: red;" id="error_box"></p>
						<input type="button" id="otp_signup" value="Submit" class="btnCreate">
					</div> -->
				</form>
				<!-- <div class="seperator">
					<label>Or Login with</label>
				</div>
				<div class="login-social">
					<a href="#" class="login-facebook"><i class="soap-icon-facebook" aria-hidden="true"></i>Login with Facebook</a>
					<a href="{{url('/login_with_google')}}" class="login-googleplus"><i class="soap-icon-googleplus" aria-hidden="true"></i>Login with Google+</a>
				</div> -->
			</div>
		</div>
    </div>
</div>
<!-- Email Signup OTP Modal Ends -->

<!--Guest Login-->
@include('home.profile_pages.processing')

<!-- Guest Login Modal Starts -->
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
				<form action="{{ URL::to('/login-customer') }}" method="post" id="login_customer" name="login_customer">
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
						<div class="flexCenter"><span id="error-icon"></span><span id="emailErrorMessage" class="error-message"></span></div>
					</div>
					<!-- signup password -->
					<!-- <div class="user-login-field">
						<label for="signupPassword">Password</label>
						<div class="user-input-group innerField-signup-password">
							<span class="user-input-group-addon">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="lock-icon"><rect x="5" y="11" width="14" height="10" rx="2" ry="2" class="lock-body" /><path d="M16 11V7a4 4 0 0 0-8 0v4" class="lock-shackle" /></svg>
							</span>
							<input type="password" name="password" id="signupPassword" autocomplete="off" placeholder="Enter password" />
							<button type="button" class="showPassword" id="togglePassword"><i id="eyeIcon" class="fa fa-eye" aria-hidden="true"></i></button>
						</div>
						<p id="signupPasswordErrorMessage" class="error-message"></p>
					</div> -->
					<!-- login password -->
					<div class="user-login-field">
						<label for="password">Password</label>
						<div class="user-input-group innerField-login-password">
							<span class="user-input-group-addon">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="lock-icon"><rect x="5" y="11" width="14" height="10" rx="2" ry="2" class="lock-body" /><path d="M16 11V7a4 4 0 0 0-8 0v4" class="lock-shackle" /></svg>
								<!-- <i class="glyphicon glyphicon-lock" aria-hidden="true"></i> -->
							</span>
							<input type="password" name="password" id="password" autocomplete="off" placeholder="Enter Password" />
							<button type="button" class="showPassword" id="togglePassword"><i id="showEyeIcon" class="fa fa-eye" aria-hidden="true"></i></button>
						</div>
						<p id="loginPasswordErrorMessage" class="error-message"></p>
					</div>
					<!-- OTP login and reset password -->
					<div class="resetCont">
						<!-- <div class="checkbox">
							<input type="checkbox" name="rememberme" value="rememberme" />
							<label for="rememberme">Remember me</label>
						</div> -->
						<!-- otp login -->
						<div><button type="button" id="login_with_otp" class="btn-otp-login">Login via OTP</button></div>
						<!-- reset password -->
						<div class="forgot-password">
							<a href="#forget_password" data-dismiss="modal" data-toggle="modal">Reset password?</a>
						</div>
					</div>
					<!-- Submit -->
					<div class="btn-login-cont">
						<input type="hidden" name="currentURL" value="{{ url()->current() }}">
						<p style="text-align: center;color: red;" id="error_box"></p>
						<!-- <input type="submit" value="Login" class="btnCreate disabled"> -->
						<button type="submit" class="btn-login" id="btnSubmit" disabled="disabled">Login</button>
						<!-- <input type="button" id="login_with_otp" value="Login with OTP" class="btnCreate"> -->
						<!-- <button type="button" id="login_with_otp" class="btn-login disabled">Login with OTP</button> -->
					</div>
				</form>
				<div class="email-signup-cont">
					<p>Don't have an account?
						<a href="#user-signup" data-dismiss="modal" data-toggle="modal" class="goto-signupp link-color">Sign up</a>
					</p>
				</div>
				<!-- social media login -->
				<div class="socialMediaLoginBar"><span>Or Login/Signup with</span></div>
				<div class="social-media-cont">
					<a href="{{url('/login_with_google')}}" class="login-googleplus">
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
					<p>By proceeding, you agree to 
						@if(env("WEBSITENAME")==1)The World Gateway's @elseif(env("WEBSITENAME")==0) Rapidex Travels's @endif <a href="{{ URL::to('/Privacy-Policy') }}" class="link-color" target="_blank">Privacy Policy</a> and <a href="{{ URL::to('/Privacy-Policy') }}" class="link-color" target="_blank">User Agreement</a></p>
				</div>
				<!-- <div class="login-social">
					<a href="#" class="login-facebook"><i class="soap-icon-facebook" aria-hidden="true"></i>Login with Facebook</a>
					<a href="{{ url('/login_with_google') }}" class="">
						<i class="soap-icon-googleplus" aria-hidden="true"></i>Login with Gmail
					</a>
				</div> -->
				<!-- <div class="seperator"></div> -->
				<!-- <p>Don't have an account? <a href="#user-signup" data-dismiss="modal" data-toggle="modal"  class="goto-signup soap-popupbox">Sign up</a></p> -->
	        </div>
      	</div>
    </div>
</div>
<!-- Guest Login Modal Ends -->

<!-- Login with OTP Login Modal Starts -->
<div class="guest-login-modal fade" id="otp_login_modal" role="dialog">
    <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="login-modal-content">
	        <div class="login-modal-header">
	          <button type="button" class="close-login" data-dismiss="modal"></button>
	          <!-- <h4>Login via OTP</h4> -->
	          <h4>Enter OTP to continue</h4>
	        </div>
	        <div class="login-modal-body">
				<form action="{{ URL::to('/login-customer') }}" method="post" id="login_customer" name="login_customer">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="login-modal-body-title">
						<!-- <h3>Verify your Email-id and Mobile Number</h3> -->
						<p>Login OTP has been sent successfully on <br> registered email-id & mobile number</p>
					</div>
					<div class="user-login-field">
						<label for="login_otp_value">OTP</label>
						<div class="user-input-group innerField-enter-otp">
							<!-- <span class="user-input-group-addon">
								<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
							</span> -->
							<input type="text" name="login_otp_value" id="login_otp_value" autocomplete="off" value="" maxlength="6" placeholder="Enter OTP here" style="width: 75%" required />
							<!-- OTP timer & Resend -->
							<span class="timer otp-timer" id="timer"></span>
						</div>
						<!-- <span class=" otp-validity">Enter valid OTP</span> -->
						<div class="flexCenter"><span id="error-icon"></span><span id="otpErrorMessage" class="error-message"></span></div>
					</div>
					<!-- <div class="user-input-group apndBtm10">
						<span class="user-input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
						<input type="text" class="form-control" id="login_otp_value" name="login_otp_value" value="{{ old('email') }}" placeholder="Enter OTP" required />
					</div> -->
					<div class="btn-login-cont">
						<input type="hidden" name="currentURL" value="{{ url()->current() }}">
						<p style="text-align: center;color: red;" id="error_box"></p>
						<!-- <input type="button" id="otp_login" value="LOGIN" class="btnCreate"> -->
						<button type="button" id="otp_login" class="btn-login">Continue</button>
					</div>
				</form>
				<p class="textCentre"><a href="#user-login" data-dismiss="modal" data-toggle="modal" class="">Login with Password</a></p>
				<!-- <div class="seperator">
					<label>Or Login with</label>
				</div>
				<div class="login-social">
					<a href="#" class="login-facebook"><i class="soap-icon-facebook" aria-hidden="true"></i>Login with Facebook</a>
					<a href="{{url('/login_with_google')}}" class="login-googleplus"><i class="soap-icon-googleplus" aria-hidden="true"></i>Login with Google+</a>
				</div>
				<div class="seperator"></div>
				<p>Don't have an account? <a href="#user-signup" data-dismiss="modal" data-toggle="modal" class="goto-signupp link-color">Sign up</a></p> -->
			</div>
		</div>
	</div>
</div>
<!-- Login via OTP Login Modal Ends -->

<!-- Reset Password Modal Starts -->
<div class="guest-login-modal fade" id="forget_password" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="login-modal-content">
	        <div class="login-modal-header">
	          <button type="button" class="close-login" data-dismiss="modal">&times;</button>
	          <h4>Reset Password</h4>
	        </div>
	        <div class="login-modal-body">
	        	<form action="#" method="post">
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
								<!-- <i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> -->
							</span>
							<input type="email" id="email-pwd-reset" name="email" value="" placeholder="Enter email id registered with us" required />
						</div>
						<div class="flexCenter"><span id="error-icon-pwd-reset"></span><span id="reset-email-pwd-error-message" class="error-message"></span></div>
					</div>
					<!-- <div class="modal-body">
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
					</div> -->
					<div class="login-modal-footer">
						<button type="submit" id="btn-email-pwd-reset" class="btn-reset-pwd">Reset Password</button>
					</div>
					<p class="textCentre"><a href="#user-login" data-dismiss="modal" data-toggle="modal" class="">Back to Login</a></p>
				</form>
				
			</div>
		</div>
	</div>
</div>
<!-- Forget Password Modal Ends -->

<!-- <div id="forget_password" class="user-login-box travel_login">
	<h3></h3>
</div> -->
<!--Login ends-->

<!--Guest Email Signup Modal Ends-->
<div class="guest-login-modal fade" id="user-signup" role="dialog">
	<div class="modal-dialog">
    	<!-- Modal content-->
	    <div class="login-modal-content">
	    	<div class="login-modal-header">
	          <button type="button" class="close-login" data-dismiss="modal"></button>
	        	<!-- <button type="button" class="close-login" data-dismiss="modal">&times;</button> -->
	        	<h4>Email Signup</h4>
	        </div>
	    	<!-- <div class="modal-header">
	    		<button type="button" class="close" data-dismiss="modal">&times;</button>
	    		<h4 class="modal-title">SignUp</h4>
	        </div> -->
	        <div class="login-modal-body">
		        <!-- <div class="simple-signup">
					<div class="text-center signup-email-section">
						<a href="#" class="signup-email login-email" style=""><i class="soap-icon-letter" aria-hidden="true"></i>Signup with Email</a>
					</div>
					<div class="seperator">
						<label>Or Signup with</label>
					</div>
					<div class="login-social">
						<a href="#" class="login-facebook"><i class="soap-icon-facebook" aria-hidden="true"></i>Signup with Facebook</a>
						<a href="{{url('/login_with_google')}}" class="login-googleplus"><i class="soap-icon-googleplus" aria-hidden="true"></i>Signup with Google+</a>
					</div>
					<p>By signing up, you agree to @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif <a href="{{ URL::to('/User-Agreement') }}" target="_blank">Terms of Service</a> and <a href="{{ URL::to('/Privacy-Policy') }}" target="_blank">Privacy Policy</a>
					</p>
				</div> -->
				<!--Guest Email Signup-->
				<div class="">
				<!-- <h3>Email Signup</h3> -->
				<form id="register-customer" name="register-customer" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<!-- first name -->
					<div class="user-login-field">
						<label for="firstName">First Name</label>
						<div class="user-input-group innerField-signup-firstName">
							<input type="text" name="first_name" id="firstName" autocomplete="off" placeholder="Enter first name" />
						</div>
						<p id="firstNameErrorMessage" class="error-message"></p>
					</div>
						<!-- <div class="form-group">
							<label>First Name</label>
							<input type="text" id="firstName" name="first_name"  value="{{ old('first_name') }}" placeholder="First Name" required />
						</div> -->
					<!-- last name -->
					<div class="user-login-field">
						<label for="lastName">Last Name</label>
						<div class="user-input-group innerField-signup-lastName">
							<input type="text" name="last_name" id="last_name" autocomplete="off" placeholder="Enter last name" />
						</div>
						<p id="lastNameErrorMessage" class="error-message"></p>
						<p id="sameNameErrorMessage" class="error-message"></p>
					</div>
						<!-- <div class="form-group">
							<label>Last Name</label>
							<input type="text" id="lastName" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required />
						</div> -->
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
					<!-- <div class="form-group">
							<label>Email ID</label>
							<div class="user-input-group">
								<span class="user-input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
								<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email ID" required />
							</div>
					</div> -->
					<!-- signup password -->
					<div class="user-login-field">
						<label for="signupPassword">Password</label>
						<div class="user-input-group innerField-signup-password">
							<span class="user-input-group-addon">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="lock-icon"><rect x="5" y="11" width="14" height="10" rx="2" ry="2" class="lock-body" /><path d="M16 11V7a4 4 0 0 0-8 0v4" class="lock-shackle" /></svg>
								<!-- <i class="glyphicon glyphicon-lock" aria-hidden="true"></i> -->
							</span>
							<input type="password" name="password" id="signupPassword" autocomplete="off" placeholder="Enter password" />
							<button type="button" class="showPassword" id="togglePassword">
								<i id="eyeIcon" class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</div>
						<p id="signupPasswordErrorMessage" class="error-message"></p>
					</div>
					<!-- <div class="form-group">
						<label>Password</label>
						<div class="user-input-group">
							<span class="user-input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
							<input type="password" name="password" id="password" placeholder="Enter Password" style="border-radius: 0 4px 4px 0;" required />
						</div>
					</div> -->
					<!-- reconfirm password -->
					<div class="user-login-field">
						<label for="password2">Reconfirm Password</label>
						<div class="user-input-group innerField-signup-password2">
							<span class="user-input-group-addon">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="lock-icon"><rect x="5" y="11" width="14" height="10" rx="2" ry="2" class="lock-body" /><path d="M16 11V7a4 4 0 0 0-8 0v4" class="lock-shackle" /></svg>
								<!-- <i class="glyphicon glyphicon-lock" aria-hidden="true"></i> -->
							</span>
							<input type="password" name="password_confirmation" id="password2" autocomplete="off" placeholder="Re-enter password" />
							<button type="button" class="showPassword" id="togglePassword2"><i id="eyeIconReconfirm" class="fa fa-eye" aria-hidden="true"></i></button>
						</div>
						<p id="password2ErrorMessage" class="error-message"></p>
					</div>
					<!-- <div class="form-group">
						<label>Confirm Password</label>
						<div class="user-input-group">
							<span class="user-input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
							<input type="password" name="password_confirmation" id="password2" placeholder="Re-enter Password" style="border-radius: 0 4px 4px 0;" required />
						</div>
					</div> -->
					<!-- subscribe -->
					<div class="acceptance-cont">
						<label class="checkmarkCont">
							<input type="checkbox" checked="checked">
							<span class="checkmark signup-acceptance"></span>
						</label>
						<p>@if(env("WEBSITENAME")==1)Subscribe for latest promotions and offers @elseif(env("WEBSITENAME")==0)Subscribe for latest promotions and offers @endif</p>
					</div>
					<!-- signup acceptance -->
					<div class="acceptance-cont">
						<label class="checkmarkCont">
							<input type="checkbox" id="signupAcceptance" />
							<span class="checkmark signup-acceptance"></span>
						</label>
						<p>By signing up, you agree to @if(env("WEBSITENAME")==1) The World Gateway's @elseif(env("WEBSITENAME")==0) Rapidex Travels's @endif <a href="{{ URL::to('/Privacy-Policy') }}" class="link-color" target="_blank">Privacy Policy</a> and <a href="{{ URL::to('/User-Agreement') }}" class="link-color" target="_blank">User Agreement</a></p>
					</div>
					<!-- signup button -->
					<div class="appndTop25">
						<!-- <input type="submit" value="Create Account" class="btnCreate"> -->
						<!-- <button type="submit" class="btn-login" id="btnSubmit" disabled="disabled">Login</button>btnCreate -->
						<button type="submit" class="btnCreate btn-login disabled" id="btnEmailSignup" disabled>Create Account</button>
						<!-- <button type="submit" class="btn-login" id="btnSignup">Create Account</button> -->
						<!-- <button type="button" class="btn-login" id="btnSignup">Submit</button> -->
					</div>
				</form>
				</div>
				<div class="existing-user-cont">
					<p>Already a @if(env("WEBSITENAME")==1) The World Gateway @elseif(env("WEBSITENAME")==0) Rapidex Travels @endif member?<a href="#user-login" class="link-color" data-dismiss="modal" data-toggle="modal"> Login</a>
					</p>
				</div>
	        </div>
	    </div>
    </div>
</div>
<!--Guest Email Signup Modal Ends-->

<!-- Add this script at the end of your HTML -->

<!-- ------------------------------------------------------------------- -->

<!-- Guest Email Login Validation Script-->

<!-- Option-I -->
<!-- <script type="text/javascript">
	//Separate function
	document.addEventListener("DOMContentLoaded", function () {
		// Initial call to set the button state based on the input values
		userLoginValidation();

		// Add event listeners for input events
		document.getElementById("login_email").addEventListener("input", userLoginValidation);
		document.getElementById("password").addEventListener("input", userLoginValidation);
		document.getElementById("password").addEventListener("keyup", function () {
			ValidateLoginPassword();
			/*EnableDisable();*/
			});

		// Add onclick attribute to togglePassword button
		var togglePasswordButton = document.getElementById("togglePassword");
		if (togglePasswordButton) {
			togglePasswordButton.addEventListener("click", toggleLoginPasswordVisibility);
			}
		});

	function toggleLoginPasswordVisibility() {
		var passwordInput = document.getElementById("password");
		var eyeIcon = document.getElementById("eyeIcon");

		if (passwordInput.type === "password") {
			passwordInput.type = "text";
			eyeIcon.classList.remove("fa-eye");
			eyeIcon.classList.add("fa-eye-slash");
			} else {
			passwordInput.type = "password";
			eyeIcon.classList.remove("fa-eye-slash");
			eyeIcon.classList.add("fa-eye");
			}
		}

	// Login Password
	function ValidateLoginPassword() {
	    var password = document.getElementById("password");
	    var loginPasswordErrorMessage = document.getElementById("loginPasswordErrorMessage");
	    var loginPasswordField = document.querySelector('.innerField-login-password');

	    var trimmedPassword = password.value.trim();

	    if (trimmedPassword === "") {
	        loginPasswordErrorMessage.textContent = "";
	        loginPasswordField.classList.remove("error");
	        return false;
		    } else if (trimmedPassword.length >= 6) {
	        loginPasswordErrorMessage.textContent = "";
	        loginPasswordField.classList.remove("error");
	        return true;
		    } else {
	        loginPasswordErrorMessage.textContent = "Password should be at least 6 characters long";
	        loginPasswordField.classList.add("error");
	        return false;
		    }
		}
	function userLoginValidation() {
		var registeredEmail = document.getElementById("login_email");
		var loginPassword = document.getElementById("password");
		var btnUserLogin = document.getElementById("btnSubmit");
		var emailErrorMessage = document.getElementById("emailErrorMessage");
		var inputEmailField = document.querySelector('.innerField');
		var inputEmailErrorIcon = document.querySelector("#error-icon");

		// Email validation using a simple regex pattern
		var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

		if (registeredEmail.value.trim() === "") {
			// Clear error message and remove error class if the field is empty
			emailErrorMessage.textContent = "";
			inputEmailField.classList.remove("error");
			inputEmailErrorIcon.classList.remove("error-icon");
			} 
			else if (emailRegex.test(registeredEmail.value.trim())) {
			// Clear error message and remove error class if email is valid
			emailErrorMessage.textContent = "";
			inputEmailField.classList.remove("error");
			inputEmailErrorIcon.classList.remove("error-icon");
			} else {
			// Display error message and add error class for invalid email
			emailErrorMessage.textContent = "Please enter a valid Email id";
			inputEmailField.classList.add("error");
			inputEmailErrorIcon.classList.add("error-icon");
			}

		// Check if email and loginPassword are non-empty
		var isEmailValid = registeredEmail.value.trim() !== "" && emailRegex.test(registeredEmail.value.trim());
		var isPasswordValid = loginPassword.value.trim() !== "" && ValidateLoginPassword();
		/*var isPasswordValidLogin = ValidateLoginPassword();*/

		// Enable or disable the submit button based on input states
		btnUserLogin.disabled = !(isEmailValid && isPasswordValid);
		btnUserLogin.classList.toggle("disabled", !isEmailValid || !isPasswordValid);
		}
</script> -->

<!-- Option-II -->
<!-- Guest Email Login Validation Script-->
<script type="text/javascript">
        // Combined function
    document.addEventListener("DOMContentLoaded", function () {
        // Initial call to set the button state based on the input values
        userLoginValidation();

        // Add event listeners for input events
        document.getElementById("login_email").addEventListener("input", userLoginValidation);
        document.getElementById("password").addEventListener("keyup", userLoginValidation);

        // Add onclick attribute to togglePassword button
        var toggleLoginPasswordButton = document.getElementById("toggleLoginPassword");
        if (toggleLoginPasswordButton) {
            toggleLoginPasswordButton.addEventListener("click", toggleLoginPasswordVisibility);
        }
    });

    function toggleLoginPasswordVisibility() {
        var loginPasswordInput = document.getElementById("password");
        var showEyeIcon = document.getElementById("showEyeIcon");

        if (loginPasswordInput.type === "password") {
            loginPasswordInput.type = "text";
            showEyeIcon.classList.remove("fa-eye");
            showEyeIcon.classList.add("fa-eye-slash");
        } else {
            loginPasswordInput.type = "password";
            showEyeIcon.classList.remove("fa-eye-slash");
            showEyeIcon.classList.add("fa-eye");
        }
    }

    function userLoginValidation() {
        var registeredEmail = document.getElementById("login_email");
        var loginPassword = document.getElementById("password");
        var btnUserLogin = document.getElementById("btnSubmit");
        var emailErrorMessage = document.getElementById("emailErrorMessage");
        var inputEmailField = document.querySelector('.innerField');
        var inputEmailErrorIcon = document.querySelector("#error-icon");

        var loginPasswordErrorMessage = document.getElementById("loginPasswordErrorMessage");
        var loginPasswordField = document.querySelector('.innerField-login-password');

        // Email validation using a simple regex pattern
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (registeredEmail.value.trim() === "") {
            // Clear error message and remove error class if the field is empty
            emailErrorMessage.textContent = "";
            inputEmailField.classList.remove("error");
            inputEmailErrorIcon.classList.remove("error-icon");
        } else if (emailRegex.test(registeredEmail.value.trim())) {
            // Clear error message and remove error class if email is valid
            emailErrorMessage.textContent = "";
            inputEmailField.classList.remove("error");
            inputEmailErrorIcon.classList.remove("error-icon");
        } else {
            // Display error message and add error class for invalid email
            emailErrorMessage.textContent = "Please enter a valid Email id";
            inputEmailField.classList.add("error");
            inputEmailErrorIcon.classList.add("error-icon");
        }

        // Login Password Check
        var trimmedPassword = loginPassword.value.trim();

        if (trimmedPassword === "") {
            loginPasswordErrorMessage.textContent = "";
            loginPasswordField.classList.remove("error");
        } else if (trimmedPassword.length >= 6) {
            loginPasswordErrorMessage.textContent = "";
            loginPasswordField.classList.remove("error");
        } else {
            loginPasswordErrorMessage.textContent = "Password should be at least 6 characters long";
            loginPasswordField.classList.add("error");
        }

        // Check if email and loginPassword are non-empty
        var isEmailValid = registeredEmail.value.trim() !== "" && emailRegex.test(registeredEmail.value.trim());
        var isPasswordValid = trimmedPassword.length >= 6;

        // Enable or disable the submit button based on input states
        btnUserLogin.disabled = !(isEmailValid && isPasswordValid);
        btnUserLogin.classList.toggle("disabled", !isEmailValid || !isPasswordValid);
    }
</script>

<!-- ------------------------------------------------------------------- -->

<!-- login with OTP Script -->
<script type="text/javascript">
//login with OTP - Combined function
document.addEventListener("DOMContentLoaded", function () {
	// Initial call to set the button state based on the input values
	loginViaOTPValidation();

	// Add event listeners for input events
	document.getElementById("login_email").addEventListener("input", loginViaOTPValidation);

	//login with OTP
	$(document).on("click","#login_with_otp", function(e) {

	    e.preventDefault();

	    var login_email=$("#login_email").val()
	    
	    if(login_email=='') {
	        swal("", 'Enter valid email id', "error");
	        } else {
	            $('#user-login').modal('hide');
	            var APP_URL=$("#APP_URL").val()
	            // $('#under_processing').modal('toggle');
	            $('#otp_login_modal').modal('toggle');
	            timer(120);
	            var url=APP_URL+'/send_login_otp';
	            var data={_token:"{{ csrf_token() }}",login_email:login_email};
	            $.get(url,data,function(rdata) {
	                if(rdata=='success') {
	                    // $('#under_processing').modal('hide');
	                    // swal("Done !", 'OTP successfully sent to your Email & Mobile No.', "success");
	                    } else {
	                        swal("Error", rdata, "error");
	                        }
	                })
	            }
	    });
	});

function loginViaOTPValidation() {
	var registeredEmail = document.getElementById("login_email");
	var btnlogin_with_otp = document.getElementById("login_with_otp");
	var emailErrorMessage = document.getElementById("emailErrorMessage");
	var inputEmailField = document.querySelector('.innerField');
	var inputEmailErrorIcon = document.querySelector("#error-icon");

	// Email validation using a simple regex pattern
	var emailRegex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;

	if (registeredEmail.value.trim() === "") {
		// Clear error message and remove error class if the field is empty
		emailErrorMessage.textContent = "";
		inputEmailField.classList.remove("error");
		inputEmailErrorIcon.classList.remove("error-icon");
		} 
		else if (emailRegex.test(registeredEmail.value.trim())) {
		// Clear error message and remove error class if email is valid
		emailErrorMessage.textContent = "";
		inputEmailField.classList.remove("error");
		inputEmailErrorIcon.classList.remove("error-icon");
		} else {
		// Display error message and add error class for invalid email
		emailErrorMessage.textContent = "Please enter a valid Email id";
		inputEmailField.classList.add("error");
		inputEmailErrorIcon.classList.add("error-icon");
		}

	// Check if email is non-empty
	var isEmailValid = registeredEmail.value.trim() !== "" && emailRegex.test(registeredEmail.value.trim());

	// Enable or disable the login via OTP button based on input states
	btnlogin_with_otp.disabled = !(isEmailValid);
	btnlogin_with_otp.classList.toggle("disabled", !isEmailValid);
	}
</script>

<!-- ------------------------------------------------------------------- -->

<!-- Enter OTP Validation Script-->
<script type="text/javascript">
//Combined function
document.addEventListener("DOMContentLoaded", function () {
	// Initial call to set the button state based on the input values
	enterOTPValidation();

	// Add event listeners for input events
	document.getElementById("login_otp_value").addEventListener("input", enterOTPValidation);

	// Clear the input field when the page loads (check, not working here)
	document.getElementById("login_otp_value").value = '';

	//otp_login
	$(document).on("click","#otp_login", function() {

	    var APP_URL=$("#APP_URL").val()
	    var otp_value=$("#login_otp_value").val()

	    if(otp_value=='') {
	        swal("Error", 'Enter OTP', "error");
	        } else {
	            var url=APP_URL+'/login_with_otp';
	            var data={_token:"{{ csrf_token() }}",otp_value:otp_value};
	            $.get(url,data,function(rdata) {
	                if(rdata=='success') {
	                    swal("Done !", 'successfully login', "success");
	                    location.reload("/")
	                    } else {
	                        swal("Error", rdata, "error");
	                        }
	                })
	            }
	    });
	});

// OTP Validation
        function enterOTPValidation() {
            var enterOTP = document.getElementById("login_otp_value");
            var btn_otp_login = document.getElementById("otp_login");
            var otpErrorMessage = document.getElementById("otpErrorMessage");
            var inputOTPField = document.querySelector('.innerField-enter-otp');

            var otpLength = enterOTP.value.trim();

            if (otpLength === "") {
                otpErrorMessage.textContent = "";
                inputOTPField.classList.remove("error");
                btn_otp_login.disabled = true;
                btn_otp_login.classList.add("disabled");
                return false;
            } else if (otpLength.length === 6) {
                otpErrorMessage.textContent = "";
                inputOTPField.classList.remove("error");
                btn_otp_login.disabled = false;
                btn_otp_login.classList.remove("disabled");
                return true;
            } else {
                otpErrorMessage.textContent = "Please enter a valid OTP";
                inputOTPField.classList.add("error");
                btn_otp_login.disabled = true;
                btn_otp_login.classList.add("disabled");
                return false;
            }

	// Check if email and loginPassword are non-empty
	var isOTPValid = enterOTP.value.trim() !== "";

	// Enable or disable the submit button based on input states
	btn_otp_login.disabled = !(isOTPValid);
	btn_otp_login.classList.toggle("disabled", !isOTPValid);
	}
</script>

<!-- ------------------------------------------------------------------- -->

<!-- Reset Password Validation Script-->
<script type="text/javascript">
// Combined function
document.addEventListener("DOMContentLoaded", function () {
	// Initial call to set the button state based on the input values
	emailPasswordReset();

	// Add event listeners for input events
	document.getElementById("email-pwd-reset").addEventListener("input", emailPasswordReset);
});

function emailPasswordReset() {
	var registeredEmailPwdReset = document.getElementById("email-pwd-reset");
	var btnResetPwd = document.getElementById("btn-email-pwd-reset");
	var resetEmailPwdErrorMessage = document.getElementById("reset-email-pwd-error-message");
	var emailFieldPwdReset = document.querySelector('.innerField-pwd-reset');
	
	// Email validation using a simple regex pattern
	var emailRegex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;

	if (registeredEmailPwdReset.value.trim() === "") {
		// Clear error message and remove error class if the field is empty
		resetEmailPwdErrorMessage.textContent = "";
		emailFieldPwdReset.classList.remove("error");
		}
		else if (emailRegex.test(registeredEmailPwdReset.value.trim())) {
		// Clear error message and remove error class if email is valid
		resetEmailPwdErrorMessage.textContent = "";
		emailFieldPwdReset.classList.remove("error");
		}
		else {
		// Display error message and add error class for invalid email
		resetEmailPwdErrorMessage.textContent = "Enter a valid email id";
		emailFieldPwdReset.classList.add("error");
		}

	// Check if email and password are non-empty
	var isEmailValid = registeredEmailPwdReset.value.trim() !== "" && emailRegex.test(registeredEmailPwdReset.value.trim());

	// Enable or disable the submit button based on input states
	btnResetPwd.disabled = !(isEmailValid);
	btnResetPwd.classList.toggle("disabled", !isEmailValid);
	}
</script>

<!-- ------------------------------------------------------------------- -->

<!-- Email Signup Validation Script -->
<script type="text/javascript">
		//Separate Functions (working)
        document.addEventListener("DOMContentLoaded", function () {
        
            // Add the event listeners for the oninput events
            document.getElementById("firstName").addEventListener("input", function () {
                ValidateFirstName();
                checkLastNameDifferent();
                EnableDisable();
                });

            document.getElementById("last_name").addEventListener("input", function () {
                ValidateLastName();
                checkLastNameDifferent();
                EnableDisable();
                });

            document.getElementById("signupEmail").addEventListener("input", function () {
                ValidateEmail();
                EnableDisable();
                });

            document.getElementById("signupPassword").addEventListener("keyup", function () {
                ValidatePassword();
                EnableDisable();
                });

            document.getElementById("password2").addEventListener("input", function () {
                ValidateReconfirmPassword();
                EnableDisable();
                });

            // Add onclick attribute to togglePassword button
            var togglePasswordButton = document.getElementById("togglePassword");
                if (togglePasswordButton) {
                    togglePasswordButton.addEventListener("click", togglePasswordVisibility);
                    }

            // Add onclick attribute to togglePassword2 button
            var togglePassword2Button = document.getElementById("togglePassword2");
                if (togglePassword2Button) {
                    togglePassword2Button.addEventListener("click", togglePassword2Visibility);
                    }
            
            document.getElementById("signupAcceptance").addEventListener("change", function () {
                EnableDisable();
                });

            // user registration
            $(document).on("submit", "#register-customer", function (event) {

                event.preventDefault();

                $('#under_processing').modal('show');

                var form_data = new FormData($("#register-customer")[0]);
                var APP_URL=$("#APP_URL").val();
                $.ajax({
                    url:APP_URL+'/register-customer',
                    data:form_data,
                    type:'post',
                    contentType: false,
                    processData: false,
                    success:function(data) {
                        if(data=='success') {
                            $('#under_processing').modal('hide');
                            $('#user-signup').modal('hide');
                            $('#otp_signup_modal').modal('show');
                            // $('#edit_modal').modal('hide');
                            // swal("Done !", 'Successfully Updated', "success");
                            // var url=APP_URL+'/Utensil-List';
                            // window.location.href = url;
                            } else {
                                $('#under_processing').modal('hide');
                                swal("Oops!", data, "error");
                                }
                        },
                    error:function(data) {
                        }
                    })
                });
            });

        function ValidateFirstName() {
            var firstName = document.getElementById("firstName");
            var firstNameErrorMessage = document.getElementById("firstNameErrorMessage");
            var firstNameField = document.querySelector('.innerField-signup-firstName');

            var trimmedFirstName = firstName.value.trim();

            // First name validation using a simple regex pattern
            /*var nameRegex = /^[A-Za-z]+(?:\s[A-Za-z]+)?$/;*/
            var firstNameRegex = /^[A-Za-z]+(?:\s[A-Za-z]+)?$/;

            if (trimmedFirstName === "") {
                firstNameErrorMessage.textContent = "";
                firstNameField.classList.remove("error");
                return false;
                } else if (firstNameRegex.test(trimmedFirstName) && trimmedFirstName.length >= 3) {
                firstNameErrorMessage.textContent = "";
                firstNameField.classList.remove("error");
                return true;
                } else {
                firstNameErrorMessage.textContent = "Enter a valid name";
                firstNameField.classList.add("error");
                return false;
                }
            }

        function ValidateLastName() {
            var lastName = document.getElementById("last_name");
            var lastNameErrorMessage = document.getElementById("lastNameErrorMessage");
            var lastNameField = document.querySelector('.innerField-signup-lastName');

            var trimmedLastName = lastName.value.trim();

            // Last name validation using a simple regex pattern
            var lastNameRegex = /^[A-Za-z]+$/;

            if (trimmedLastName === "") {
                lastNameErrorMessage.textContent = "";
                lastNameField.classList.remove("error");
                return false;
                } else if (lastNameRegex.test(trimmedLastName) && trimmedLastName.length >= 3) {
                lastNameErrorMessage.textContent = "";
                lastNameField.classList.remove("error");
                return true;
                } else {
                lastNameErrorMessage.textContent = "Enter a valid last name";
                lastNameField.classList.add("error");
                return false;
                }
            }

        // New function to check if first name and last name are different
        function checkLastNameDifferent() {
            var firstName = document.getElementById("firstName").value.trim();
            var lastName = document.getElementById("last_name").value.trim();
            var sameNameErrorMessage = document.getElementById("sameNameErrorMessage");
            var lastNameField = document.querySelector('.innerField-signup-lastName');

            // Check for spaces in the last name
            if (/\s/.test(lastName)) {
                sameNameErrorMessage.textContent = "";
                lastNameField.classList.add("error");
                return false;
                }

            if (firstName === "" || lastName === "") {
            // Clear error message and remove error class if either field is blank
            sameNameErrorMessage.textContent = "";
            lastNameField.classList.remove("error");
            return false;
            } else if (firstName === lastName) {
            // Display error message and add error class for identical first and last names
            sameNameErrorMessage.textContent = "First Name and Last Name should be different";
            lastNameField.classList.add("error");
            return false;
            } else {
            // Clear error message and remove error class if names are different
            sameNameErrorMessage.textContent = "";
            lastNameField.classList.remove("error");
            return true;
            }
            }

        // Separate email validation function
        function ValidateEmail() {
            var signupEmail = document.getElementById("signupEmail");
            var emailErrorMessage = document.getElementById("signupEmailErrorMessage");
            var emailField = document.querySelector('.innerField-signup');

            // Email validation using a simple regex pattern
            var emailRegex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;
            /*var emailRegex = /^[^\s@,:;{}/*<>?$%&()=+!`~^#]+@[^\s@,:;{}/*<>?$%&()=+!`~^#]+\.[^\s@,:;{}/*<>?$%&()=+!`~.^#]+$/;*/
            /*var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;*/

            if (signupEmail.value.trim() === "") {
                // Clear error message and remove error class if the field is empty
                emailErrorMessage.textContent = "";
                emailField.classList.remove("error");
                return false;
                } else if (emailRegex.test(signupEmail.value.trim())) {
                // Clear error message and remove error class if email is valid
                emailErrorMessage.textContent = "";
                emailField.classList.remove("error");
                return true;
                } else {
                // Display error message and add error class for invalid email
                emailErrorMessage.textContent = "Enter valid email id";
                emailField.classList.add("error");
                return false;
                }
            }

        // Password
        function ValidatePassword() {
            var password = document.getElementById("signupPassword");
            var signupPasswordErrorMessage = document.getElementById("signupPasswordErrorMessage");
            var signupPasswordField = document.querySelector('.innerField-signup-password');

            var trimmedPassword = password.value.trim();

            if (trimmedPassword === "") {
                signupPasswordErrorMessage.textContent = "";
                signupPasswordField.classList.remove("error");
                return false;
                } else if (trimmedPassword.length >= 6) {
                    signupPasswordErrorMessage.textContent = "";
                    signupPasswordField.classList.remove("error");
                    return true;
                } else {
                    signupPasswordErrorMessage.textContent = "Password should be at least 6 characters long";
                    signupPasswordField.classList.add("error");
                    return false;
                }
            }

        //Reconfirm Password
        function ValidateReconfirmPassword() {
            var signupPassword = document.getElementById("signupPassword");
            var reconfirmPassword = document.getElementById("password2");
            var password2ErrorMessage = document.getElementById("password2ErrorMessage");
            var signupReconfirmPasswordField = document.querySelector('.innerField-signup-password2');


            if (reconfirmPassword.value.trim() === "") {
            password2ErrorMessage.textContent = "";
            /*signupReconfirmPasswordField.classList.remove("error");*/
            return false;
            } else if (reconfirmPassword.value.trim() === signupPassword.value.trim()) {
            password2ErrorMessage.textContent = "";
            signupReconfirmPasswordField.classList.remove("error");
            return true;
            } else {
            password2ErrorMessage.textContent = "Password does not match";
            signupReconfirmPasswordField.classList.add("error");
            return false;
            }
            }

        function togglePasswordVisibility() {
            var signupPasswordInput = document.getElementById("signupPassword");
            var eyeIcon = document.getElementById("eyeIcon");

            if (signupPasswordInput.type === "password") {
                signupPasswordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
                } else {
                signupPasswordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
                }
            }

        function togglePassword2Visibility() {
            var passwordConfirmInput = document.getElementById("password2");
            var eyeIconReconfirm = document.getElementById("eyeIconReconfirm");

            if (passwordConfirmInput.type === "password") {
                passwordConfirmInput.type = "text";
                eyeIconReconfirm.classList.remove("fa-eye");
                eyeIconReconfirm.classList.add("fa-eye-slash");
                } else {
                passwordConfirmInput.type = "password";
                eyeIconReconfirm.classList.remove("fa-eye-slash");
                eyeIconReconfirm.classList.add("fa-eye");
                }
            }

        function EnableDisable() {
            var isFirstNameValidSignup = ValidateFirstName();
            var isLastNameValidSignup = ValidateLastName();
            var isLastNameDifferentSignup = checkLastNameDifferent();
            var isEmailValidSignup = ValidateEmail();
            var isPasswordNotEmptySignup = document.getElementById("signupPassword").value.trim() !== "";
            var isPasswordValidSignup = ValidatePassword();
            var isReconfirmPasswordValidSignup = ValidateReconfirmPassword();
            var isAgreeCheckedSignup = document.getElementById("signupAcceptance").checked;

            var btnEmailSignup = document.getElementById("btnEmailSignup");

            if (isFirstNameValidSignup && isLastNameValidSignup && isLastNameDifferentSignup && isEmailValidSignup && isPasswordNotEmptySignup && isPasswordValidSignup && isReconfirmPasswordValidSignup && isAgreeCheckedSignup) {
                btnEmailSignup.disabled = false;
                btnEmailSignup.classList.remove("disabled");
                } else {
                    btnEmailSignup.disabled = true;
                    btnEmailSignup.classList.add("disabled");
                    }
            }

		/*function submitForm() {
			// Reference the form by its ID
			var form = document.getElementById("register-customer");

			// Your existing validation logic here
			var isFirstNameValid = ValidateFirstName();
			var isLastNameValid = ValidateLastName();
			var isLastNameDifferent = checkLastNameDifferent();
			var isEmailValid = ValidateEmail();
			var isPasswordNotEmpty = document.getElementById("password").value.trim() !== "";
			var isReconfirmPasswordValid = ValidateReconfirmPassword();
			var isAgreeChecked = document.getElementById("signupAcceptance").checked;

			if (isFirstNameValid && isLastNameValid && isLastNameDifferent && isEmailValid && isPasswordNotEmpty && isPasswordValid && isReconfirmPasswordValid && isAgreeChecked) {
				// Trigger Swal message
				Swal.fire({
					icon: 'success',
					title: 'Form Submitted Successfully!',
					//showConfirmButton: false,
					//timer: 1500
					showConfirmButton: true, // Display the "OK" button
					confirmButtonText: 'OK', // Text for the "OK" button
					}).then((result) => {
						if (result.isConfirmed) {
							// Reset the form
							form.reset();
							}
						});

				// You can optionally add logic here to submit the form to the server or take other actions
				} else {
				// You can optionally add logic here for handling unsuccessful form submission
				}
			}*/
</script>

<!-- ------------------------------------------------------------------- -->