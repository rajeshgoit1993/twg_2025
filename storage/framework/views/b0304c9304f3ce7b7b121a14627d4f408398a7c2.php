						<?php if(Sentinel::check()): ?>
							<?php if(Sentinel::getUser()->roles()->first()->slug == 'customer' ): ?>
								<li>
									<div role="button" id="myaccount">Hi <?php echo e(Sentinel::getUser()->first_name); ?></div>
								</li>
							<?php else: ?>
								<li>
									<!-- <a href="<?php echo e(url('/dashboard')); ?>">My Account</a> -->
									<a href="<?php echo e(route('dashboard')); ?>">My Account</a>
								</li>
							<?php endif; ?>
							<div class="account">
								<div class="dUserIcon">
									<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
								</div>
								<!-- <form action="<?php echo e(URL::to('/logout-customer')); ?>" id="logout-form" method="POST"> -->
								<form action="<?php echo e(route('userLogout')); ?>" id="logout-form" method="POST">
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
									<ul>
										<li class="myAccount_item">
											<!-- <a href="<?php echo e(URL::to('/my-booking')); ?>"> -->
											<a href="<?php echo e(route('myBooking')); ?>">
												<i class="fa fa-cog myAccount_itemIcon" aria-hidden="true"></i>My Trips
											</a>
										</li>
										<li class="myAccount_item">
											<!-- <a href="<?php echo e(URL::to('/customer-panel')); ?>"> -->
											<a href="<?php echo e(route('userProfile')); ?>">
												<i class="fa fa-user myAccount_itemIcon" aria-hidden="true"></i>My Profile
											</a>
										</li>
										<li class="myAccount_item">
											<a href="#" onclick="document.getElementById('logout-form').submit()" class="soap-popupbox">
												<i class="fa fa-sign-out myAccount_itemIcon" aria-hidden="true"></i>Logout
											</a>
										</li>
									</ul>
								</form>
							</div>
							<?php else: ?>
							<li href="#" class="makeflex alignitemsCenter" data-toggle="modal" data-target="#user-login">
								<div class="userLogOut downArrow"> 
									<div class="userIconWrapper">
										<svg class="user-svg-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
											<path d="M512 552.2432c-112.5376 0-182.8352 64.6144-222.208 190.1568h444.416c-39.3728-125.5424-109.6704-190.1568-222.208-190.1568z m0-51.2c148.7872 0 238.4896 93.7984 280.832 260.6592A25.6 25.6 0 0 1 768 793.6H256a25.6 25.6 0 0 1-24.832-31.8976c42.3424-166.912 132.096-260.6592 280.832-260.6592z m0 0c73.3696 0 133.0176-60.5184 133.0176-135.3216C645.0176 290.9184 585.3696 230.4 512 230.4c-73.3696 0-133.0176 60.5184-133.0176 135.3216 0 74.8032 59.648 135.3216 133.0176 135.3216z m0 51.2c-101.8368 0-184.2176-83.6096-184.2176-186.5216S410.2144 179.2 512 179.2c101.8368 0 184.2176 83.6096 184.2176 186.5216s-82.432 186.5216-184.2176 186.5216z" />
										</svg>
									</div>
									<div class="userLogoutTag">Sign-In or Create Account</div>
								</div>
							</li>
							<?php endif; ?>