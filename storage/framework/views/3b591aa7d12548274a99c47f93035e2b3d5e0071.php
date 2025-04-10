<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Login</title>
		
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link href="<?php echo e(asset("/resources/assets/admin-lte/bootstrap/css/bootstrap.min.css")); ?>" rel="stylesheet" type="text/css" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link href="<?php echo e(asset("/resources/assets/admin-lte/dist/css/AdminLTE.min.css")); ?>" rel="stylesheet" type="text/css" />
		<!-- iCheck -->
		<link href="<?php echo e(asset("/resources/assets/admin-lte/plugins/iCheck/square/blue.css")); ?>" rel="stylesheet" type="text/css" />
		<style>
		.loginBox {
			background: #fff;
			padding: 40px 30px;
			border: 0;
			border-radius: 5px;
			margin: 10% auto;
			width: 470px;
			max-width: 100%;
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
		.loginBox label{
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
		.loginBG {
			background: #fc4a1a;
			background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);
			background: linear-gradient(to right, #f7b733, #fc4a1a);
			}
		.loginLogo {
			font-size: 22px;
			line-height: 26px;
			color: #4a4a4a;
			font-weight: 300;
			text-align: center;
			}
		.separatorLine {
			margin-top: 20px;
			margin-bottom: 20px;
			border: 0;
			border-top: 2px solid #eee;
			}
		.btnLogin {
			display: inline-block;
			padding: 6px 12px;
			border: 1px solid transparent;
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
			-webkit-appearance: button;
			outline: 0;
			width: 100%;
			height: 40px;
			background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);
			background: linear-gradient(to right, #f7b733, #fc4a1a)
			}
		.btnLogin:hover {
			background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);
			background: linear-gradient(to right, #f7b733, #fc4a1a)
			color: #fff;
			}
		.apndTop30 {
			margin-top: 30px;
			}
		
		</style>
    </head>
    <body class="loginBG">
        <div class="container">
            <div class="loginBox">
			<div class="loginLogo">
				<?php if(env("WEBSITENAME")==1): ?>
				<b>The World Gateway</b><br>
				Admin
				<?php elseif(env("WEBSITENAME")==0): ?>
				<b>Rapidex Travels</b><br>
				Admin
				<?php endif; ?>
			</div>
			<div class="separatorLine"></div>
			<?php if(session('error')): ?>
				<div class="alert alert-danger" style="padding: 8px;font-size: 14px;font-weight: 600;text-align: center;border-radius: 5px;">
                <?php echo e(session('error')); ?>

				</div>
			<?php endif; ?>
			<form action="<?php echo e(URL::to('/login')); ?>" method="POST">
				<?php echo e(csrf_field()); ?>

				<div class="form-group">
					<label>Email ID</label>
					<div class="user-input-group">
						<span class="user-input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
						<input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter Email ID" required />
					</div>
				</div>
				<div class="form-group">
					<label>Password</label>
					<div class="user-input-group">
						<span class="user-input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
						<input type="password" name="password" id="password" placeholder="Enter Password" required />
					</div>
				</div>
				<div class="apndTop30">
					<input type="submit" class="btnLogin" value="LOGIN">
				</div>
			</form>
            </div>
        </div>
		<!-- jQuery 2.2.3 -->
		<script src='<?php echo e(asset ("/resources/assets/admin-lte/plugins/jQuery/jquery-2.2.3.min.js")); ?>'></script>
		<!-- Bootstrap 3.3.6 -->
		<script src='<?php echo e(asset ("/resources/assets/admin-lte/bootstrap/js/bootstrap.min.js")); ?>'></script>
		<!-- iCheck -->
		
	</body>
</html>
