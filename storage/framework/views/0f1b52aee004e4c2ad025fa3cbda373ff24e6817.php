<!DOCTYPE html>
<html>
	<head>
		<?php 
		    // Fetch website-related data from the WebsiteNameHelpers function
		    // This retrieves key information like social media links, contact details, etc.
		    $websiteData = getWebsiteData();
		 ?>

		<!-- Basic Meta Tags -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Page Title & SEO Meta -->
		<title><?php echo e($websiteData['adminLoginTitle']); ?></title>
		<meta name="robots" content="noindex, nofollow">

		<!-- Favicon & Apple Touch Icons -->
		<link rel="icon" href="<?php echo e($websiteData['favicon']); ?>" type="image/x-icon">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e($websiteData['faviconApple']); ?>">

		<!-- csrf token -->
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
		<meta name="_token" content="<?php echo csrf_token(); ?>"/>
		<!-- <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL"> -->

		<!-- backend header CSS -->
		<?php echo $__env->make('layouts.backend.backend-header-css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</head>

   	<body class="skin-blue" onload="startTime()">
   	<!--<body class="skin-blue sidebar-collapse" onload="startTime()">--> <!-- // collapsed sidebar -->

   		<!-- Hidden inputs for APP_URL and CSRF token -->
    	<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL">
    	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

		<input type="hidden" value="<?php echo e(url('/')); ?>" id="baseurl" name="baseurl">

		<div class="wrapper">
			<header class="main-header">
				<a href="<?php echo e($websiteData['route'] ?? '#'); ?>" target="_blank" class="logo logoBox">
					<img src="<?php echo e($websiteData['logo'] ?? 'default-logo.png'); ?>" alt="<?php echo e($websiteData['alt'] ?? 'Default Alt'); ?>" />
				</a>

				<!-- Header Navbar -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="height: 50px;">
						<span class="sr-only">Toggle navigation</span>
					</a>

					<!-- date -->
					<div class="date-container">
						<span class="apndRt5"></span><?php echo e(date('l, d M, Y')); ?>

					</div>

					<!-- time -->
					<div id="txt" class="font16"></div> <!-- Add this element to display the time (not coming)-->
 
					<!-- Navbar Z Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Messages: style can be found in dropdown.less-->
							<!-- Notifications Menu -->
							<li class="dropdown notifications-menu">
							    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
							        <i class="fa fa-bell"></i>
							        <span class="badge badge-danger notification-badge total_notification">0</span>
							    </a>

							    <ul class="dropdown-menu dropdown-menu-right notifications-dropdown">
							        <li class="dropdown-header">
							            <strong>Notifications</strong> 
							            <span class="total_notification badge badge-light">0</span>
							        </li>
							        <li>
							        	<!-- Inner Menu: contains the notifications -->
							            <!-- <ul class="menu notification_data list-unstyled"> -->
							            <ul class="notification_data list-unstyled">
							                <!-- Notifications will be dynamically added here from NotificationController -->
							                <li class="text-center p-3 no-notifications">No new notifications</li>
							            </ul>
							        </li>
							        <li class="notification-footer text-center">
							            <a href="#">View all notifications</a>
							        </li>
							    </ul>
							</li>

							<!-- Tasks Menu -->

							<!-- User Account Menu -->
							<li class="dropdown user user-menu">

								<!-- Menu Toggle Button -->
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<!-- The user image in the navbar-->
									<div class="profile-img-cont user-image">
						                <?php if(Sentinel::check()): ?>
										    <?php 
										        $profileImage = Sentinel::getUser()->profile_image;
										        $imagePath = '/public/uploads/user_profiles/' . $profileImage;
										        $imageUrl = asset(file_exists(public_path($imagePath)) && $profileImage ? $imagePath : '/public/uploads/user_profiles/default-user.png');
										     ?>
										    <img src="<?php echo e($imageUrl); ?>" alt="user-img">
										<?php endif; ?>
						            </div>
									<!-- hidden-xs hides the username on small devices so only the image appears. -->
									<span class="hidden-xs">
										<?php if(Sentinel::check()): ?>
											Hello, <?php echo e(Sentinel::getUser()->first_name); ?>

										<?php else: ?>
											Hello, Guest
										<?php endif; ?>
									</span>
								</a>
								<ul class="dropdown-menu" style="background-color: #23527c;border: none">

									<!-- The user image in the menu -->
									<li class="user-header" style="border: 1px solid #3c8dbc">
										<!-- user image -->
							            <div class="dropdown-user-img-cont">
							                <?php if(Sentinel::check()): ?>
											    <?php 
											        $profileImage = Sentinel::getUser()->profile_image;
											        $imagePath = '/public/uploads/user_profiles/' . $profileImage;
											        $imageUrl = asset(file_exists(public_path($imagePath)) && $profileImage ? $imagePath : '/public/uploads/user_profiles/default-user.png');
											     ?>
											    <img src="<?php echo e($imageUrl); ?>" alt="user-img">
											<?php endif; ?>
							            </div>
										<p class="apndBtm5">
									        <?php 
									            $user = Sentinel::check() ? Sentinel::getUser() : null;
									         ?>
									        <?php if($user): ?>
									            <?php echo e($user->first_name ?? 'User'); ?> <?php echo e($user->last_name ?? ''); ?>

									        <?php else: ?>
									            Hello, Guest
									        <?php endif; ?>
									    </p>
									    <?php if(Sentinel::check()): ?>
										    <?php 
										        // Get user role (assuming each user has one role)
										        $userRole = $user->roles->first()->name ?? 'User'; 
										     ?>
										    <span style="color: #ffffffcc"><?php echo e($userRole); ?></span>
										<?php endif; ?>
									</li>

									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="#" onclick="" class="btn btn-default btn-flat">My Profile</a>
										</div>
										<div class="pull-right">
											<form action="<?php echo e(route('logout')); ?>" id="logout-form" method="POST">
											    <?php echo e(csrf_field()); ?>

											    <a href="#" onclick="document.getElementById('logout-form').submit()" class="btn btn-default btn-flat">Sign out</a>
											</form>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- closing in footer -->