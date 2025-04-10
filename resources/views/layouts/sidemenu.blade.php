
<!-- sidemenu starts -->
<style type="text/css">
.user-img-cont {
	width: 45px;
	height: 45px;
	background-color: #f9f9f9;
	border-radius: 50%;
	/*box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
	border: 1px solid #e9e9e9;*/
	overflow: hidden;
}
.user-img-cont img {
	width: 45px;
	height: 45px;
}
.lead-count {
	display: inline-block;
	background-color: #f2f2f2;
	border-radius: 50%;
	padding: 2px 2px;
	font-size: 11px;
	line-height: 12px;
	color: #001;
	font-weight: 700;
}
</style>

<?php
	use App\Role;
	use App\ActivateService;
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel">
        	<!-- user image -->
            <div class="user-img-cont pull-left">
                @if(Sentinel::check())
				    @php
				        $profileImage = Sentinel::getUser()->profile_image;
				        $imagePath = '/public/uploads/user_profiles/' . $profileImage;
				        $imageUrl = asset(file_exists(public_path($imagePath)) && $profileImage ? $imagePath : '/public/uploads/user_profiles/default-user.png');
				    @endphp
				    <img src="{{ $imageUrl }}" alt="img">
				@endif
            </div>

            <!-- name and status -->
            <div class="pull-left info">
			    <p>
			        @php
			            $user = Sentinel::check() ? Sentinel::getUser() : null;
			        @endphp
			        @if($user)
			            {{ $user->first_name ?? 'User' }} {{ $user->last_name ?? '' }}
			        @else
			            Hello, Guest
			        @endif
			    </p>
			    <p class="font11"><i class="fa fa-circle text-success apndRt5"></i>Online</p>
			</div>

        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Dashboard -->
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ URL::to('/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
            </li>

            <!-- Activate Services -->
            @if(Sentinel::check() 
            && Sentinel::getUser()->inRole('super_admin'))
                <li class="{{ Request::is('Activate-Services') ? 'active' : '' }}">
                    <a href="{{ URL::to('/Activate-Services') }}"><i class="fa fa-dashboard"></i>Service Activation</a>
                </li>
            @endif

            <!-- Company Profile -->
            @if(Sentinel::check() 
            && (Sentinel::getUser()->inRole('super_admin') 
            || Sentinel::getUser()->inRole('administrator')))
                <li class="{{ Request::is('Company-Profile') ? 'active' : '' }}">
                    <a href="{{ URL::to('/Company-Profile') }}"><i class="fa fa-user"></i>Company Profile</a>
                </li>
            @endif

            <!-- Manage Users -->
            <?php $all_roles = Role::all(); ?>
            @if(env("WEBSITENAME") == 1 
            && Sentinel::check())
                <?php
	                $check_data_managerole = ActivateService::where('services','=','manage_roles')->first();
	                if($check_data_managerole->activation == 1):
                ?>
                @if(Sentinel::getUser()->inRole('super_admin'))
                <li class="treeview
	                @foreach($all_roles as $role)
		                @if($role->slug == Request::segment(2)) active
		                @endif
	                @endforeach">
                	<a href="#"><i class="fa fa-users"></i>Manage Users<span class="pull-right-container font18"><i class="fa fa-angle-down pull-right"></i></span></a>
                	<ul class="treeview-menu">
                		@foreach($all_roles as $role)
                		<li class="@if($role->slug == Request::segment(2)) active @endif">
                			<a href="{{ URL::to('/roles/'.$role->slug) }}"><i class="fa fa-circle-o"></i> {{$role->name}}</a>
                		</li>
                		@endforeach
                	</ul>
                </li>
                @endif
                
                @if(Sentinel::getUser()->inRole('administrator') 
                || Sentinel::getUser()->inRole('supervisor') 
                || Sentinel::getUser()->inRole('agent') 
                || Sentinel::getUser()->inRole('employee'))
                <li class="treeview @foreach($all_roles as $role) @if($role->slug == Request::segment(2)) active @endif @endforeach">
                	<a href="#">
                		<i class="fa fa-users"></i>
                		Manage Users
                		<span class="pull-right-container font18">
                			<i class="fa fa-angle-down pull-right"></i>
                		</span>
                	</a>

                	<ul class="treeview-menu">
                		@foreach($all_roles as $role)
                		@if($role->slug != 'super_admin')
                		<li class="@if($role->slug == Request::segment(2)) active @endif">
                			<a href="{{ URL::to('/roles/'.$role->slug) }}"><i class="fa fa-circle-o"></i> {{$role->name}}</a>
                		</li>
                		@endif
                		@endforeach
                	</ul>
                </li>
                @endif
                
                <?php endif; ?>
            @endif

            <!-- calendar -->
            <li class="treeview {{ Request::is('booking-calendar') ? 'active' : '' }}">
			    <!-- Main navigation item for Calendar -->
			    <a href="#">
			        <i class="fa fa-briefcase"></i>Calendar
			        <!-- Dropdown icon for expanding the treeview menu -->
			        <span class="pull-right-container font18">
			            <i class="fa fa-angle-down pull-right"></i>
			        </span>
			    </a>

			    <!-- Submenu for the Calendar treeview -->
			    <ul class="treeview-menu">
			        @if(Sentinel::check())
			            <!-- Booking Calendar link, active if the current route is 'booking-calendar' -->
			            <li class="{{ Request::is('booking-calendar') ? 'active' : '' }}">
			                <a href="{{ URL::to('/booking-calendar') }}">
			                    <i class="fa fa-circle-o"></i>
			                    Tour Calendar
			                </a>
			            </li>
			        @endif
			    </ul>
			</li>

			<!--Lead Manager-->
			<li class="treeview {{ Request::is('add-lead') || Request::is('myRequests') || Request::is('search-lead') || Request::is('web-leads') || Request::is('lead-verification') || Request::is('quote-pending') || Request::is('quote-saved') || Request::is('quote-sent') || Request::is('outbox') || Request::is('lead-follow-up') || Request::is('process-booking') || Request::is('payment-follow-up') || Request::is('trip-under-cancellation') || Request::is('issue-voucher') || Request::is('trip-vouchers') || Request::is('trip-cancelled') || Request::is('trip-refund') || Request::is('lead-cancelled') || Request::is('trip-review') || Request::is('Post-Tour') || Request::is('add_quotation') || Request::is('Deleted-Leads') || Request::is('lead_settings') ? 'active' : '' }}">
				<!-- lead manager -->
			    <a href="#">
			    	<i class="fa fa-briefcase"></i>
			    	Lead Manager
			    	<span class="pull-right-container font18">
			    		<i class="fa fa-angle-down pull-right"></i>
			    	</span>
			    </a>
			    <ul class="treeview-menu">
			        @if(Sentinel::check())
			            @if(Sentinel::getUser()->inRole('administrator') 
			            || Sentinel::getUser()->inRole('supervisor') 
			            || Sentinel::getUser()->inRole('super_admin') 
			            || Sentinel::getUser()->inRole('employee'))
			            	<!-- add new lead -->
			                <?php
			                    $check_data_leads = ActivateService::where('services', '=', 'leads')->first();
			                    if ($check_data_leads->activation == 1):
			                ?>
			                    <li class="{{ Request::is('add-lead') ? 'active' : '' }}">
			                    	<a href="{{ URL::to('/add-lead') }}"><i class="fa fa-circle-o"></i>Add New Lead</a>
			                    </li>
			                <?php endif; ?>
			            @endif

			            <!-- guest raised request/concern -->
			            <li class="{{ Request::is('myRequests') ? 'active' : '' }}">
			                <a href="{{ URL::to('/myRequests') }}"><i class="fa fa-circle-o"></i>Guest Requests <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('my_requests') }}</span></a>
			            </li>

			            <!-- search lead -->
			            <li class="{{ Request::is('search-lead') ? 'active' : '' }}">
			                <a href="{{ URL::to('/search-lead') }}"><i class="fa fa-circle-o"></i>Search Lead <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('search_lead') }}</span></a>
			            </li>

			            <!-- web leads -->
			            <?php
			                $check_data_leads = ActivateService::where('services', '=', 'leads')->first();
			                if ($check_data_leads->activation == 1):
			            ?>
			            <li class="{{ Request::is('web-leads') ? 'active' : '' }}">
			               	<a href="{{ URL::to('/web-leads') }}"><i class="fa fa-circle-o"></i>Web Leads <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('web_leads') }}</span></a>
			            </li>

			            <!-- lead verification -->
			            <li class="{{ Request::is('lead-verification') ? 'active' : '' }}">
			               	<a href="{{ URL::to('/lead-verification') }}"><i class="fa fa-circle-o"></i>Lead Verification <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('lead_verification') }}</span>
			               	</a>
			            </li>
			            
			            <?php endif; ?>

			            <!-- quote pending -->
			            <?php
			                $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
			                if ($check_data_lm->activation == 1):
			            ?>
			            <li class="{{ Request::is('quote-pending') ? 'active' : '' }}">
			               	<a href="{{ URL::to('/quote-pending') }}"><i class="fa fa-circle-o"></i>Quote Pending <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('quote_pending') }}</span></a>
			            </li>

			            <!-- quote saved -->
			            <li class="{{ Request::is('quote-saved') ? 'active' : '' }}">
			               	<a href="{{ URL::to('/quote-saved') }}"><i class="fa fa-circle-o"></i>Quote Saved <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('quote_saved') }}</span></a>
			            </li>

			            <!-- quote sent -->
			            <li class="{{ Request::is('quote-sent') ? 'active' : '' }}">
			                <a href="{{ URL::to('/quote-sent') }}"><i class="fa fa-circle-o"></i>Quote Sent <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('quote_sent') }}</span></a>
			            </li>

			            <!-- quote sent -->
			            <li class="{{ Request::is('outbox') ? 'active' : '' }}">
			                <a href="{{ URL::to('/outbox') }}"><i class="fa fa-circle-o"></i>Outbox <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('quote_sent') }}</span></a>
			            </li>

			            <!-- leads follow-up -->
			            <li class="{{ Request::is('lead-follow-up') ? 'active' : '' }}">
			                <a href="{{ URL::to('/lead-follow-up') }}"><i class="fa fa-circle-o"></i>Lead Follow-up <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('lead_follow_up') }}</span></a>
			            </li>

			            <!-- process booking -->
			            <li class="{{ Request::is('process-booking') ? 'active' : '' }}">
			                <a href="{{ URL::to('/process-booking') }}"><i class="fa fa-circle-o"></i>Process Booking <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('process_booking') }}</span></a>
			            </li>

			            <!-- payment follow-up -->
			            <li class="{{ Request::is('payment-follow-up') ? 'active' : '' }}">
			                <a href="{{ URL::to('/payment-follow-up') }}"><i class="fa fa-circle-o"></i>Payment Follow-up <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('payment_follow_up') }}</span></a>
			            </li>

			            <!-- trip under cancellation -->
			            <li class="{{ Request::is('trip-under-cancellation') ? 'active' : '' }}">
			                <a href="{{ URL::to('/trip-under-cancellation') }}"><i class="fa fa-circle-o"></i>Under Cancellation <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('trip_under_cancellation') }}</span></a>
			            </li>

			            <!-- issue voucher -->
			            <li class="{{ Request::is('issue-voucher') ? 'active' : '' }}">
			                <a href="{{ URL::to('/issue-voucher') }}"><i class="fa fa-circle-o"></i>Issue Voucher <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('issue_voucher') }}</span></a>
			            </li>

			            <!-- trip vouchers -->
			            <li class="{{ Request::is('trip-vouchers') ? 'active' : '' }}">
			                <a href="{{ URL::to('/trip-vouchers') }}"><i class="fa fa-circle-o"></i>Trip Vouchered <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('trip_vouchers') }}</span></a>
			            </li>
			                
			            <!-- trip cancelled -->
			            <li class="{{ Request::is('trip-cancelled') ? 'active' : '' }}">
			                <a href="{{ URL::to('/trip-cancelled') }}"><i class="fa fa-circle-o"></i>Trip Cancelled <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('trip_cancelled') }}</span></a>
			            </li>

			            <!-- process refund -->
			            <li class="{{ Request::is('trip-refund') ? 'active' : '' }}">
			                <a href="{{ URL::to('/trip-refund') }}"><i class="fa fa-circle-o"></i>Process Refund <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('trip_refund') }}</span></a>
			            </li>

			            <!-- lead cancelled -->
			            <li class="{{ Request::is('lead-cancelled') ? 'active' : '' }}">
			                <a href="{{ URL::to('/lead-cancelled') }}"><i class="fa fa-circle-o"></i>Lead Cancelled <span class="pull-right-container lead-count">{{ NotificationHelpers::get_leads_notification('lead_cancelled') }}</span></a>
			            </li>

			            <!-- post tour -->
			            <li class="{{ Request::is('trip-review') ? 'active' : '' }}">
			                <a href="{{ URL::to('/trip-review') }}"><i class="fa fa-circle-o"></i>Trip Review</a>
			            </li>

			            <!-- tour refund -->
			            <li class="{{ Request::is('Post-Tour') ? 'active' : '' }}">
			                <a href="{{ URL::to('/Post-Tour') }}"><i class="fa fa-circle-o"></i>Tour Refund</a>
			            </li>

			            <!-- tour review -->
			            <li class="{{ Request::is('Post-Tour') ? 'active' : '' }}">
			                <a href="{{ URL::to('/Post-Tour') }}"><i class="fa fa-circle-o"></i>Post Tour</a>
			            </li>

			            <?php endif; ?>

			            <!-- lead manager settings -->
			            @if(Sentinel::getUser()->inRole('super_admin'))
			            <li class="{{ Request::is('lead_settings') ? 'active' : '' }}">
			                <a href="{{ URL::to('/lead_settings') }}"><i class="fa fa-circle-o"></i>Lead Settings</a>
			            </li>

			            <!-- sitemap -->
			            <!-- <li class="{{ Request::is('links') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/links') }}"><i class="fa fa-circle-o"></i>Links</a>
			            </li> -->
			            @endif
			        @endif
			    </ul>
			</li>
		
			<!--Tour Package Manager-->
			@if(env('WEBSITENAME') == 1 && Sentinel::check())
			    <?php
			        $check_data_tour = ActivateService::where('services','=','tour_package_manager')->first();
			        if($check_data_tour->activation == 1):
			    ?>
			    <li class="treeview {{ Request::is('tours') || Request::is('add-package') || Request::is('extra') || Request::is('package-settings') || Request::is('package-locations') || Request::is('package-add-tours') || Request::is('theme_data') || Request::is('add_theme_data') || Request::is('package_hotel') || Request::is('add_packagehotel') || Request::is('img_gallery') || Request::is('add_image_ingallery') ? 'active' : '' }}">
			        <a href="#"><i class="fa fa-briefcase"></i>Tour Manager<span class="pull-right-container font18"><i class="fa fa-angle-down pull-right"></i></span>
			        </a>
			        <ul class="treeview-menu">
			        	<!-- add new package -->
			        	@if(Sentinel::getUser()->inRole('administrator') 
			        	|| Sentinel::getUser()->inRole('super_admin'))
			                <li class="{{ Request::is('add-package') ? 'active' : '' }}">
			                	<a href="{{ URL::to('/add-package') }}"><i class="fa fa-circle-o"></i>Add New Package</a>
			                </li>
			            @endif

			        	<!-- tour packages -->
			            <li class="{{ Request::is('tours') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/tours') }}"><i class="fa fa-circle-o"></i>Tour Package</a>
			            </li>

			            <!-- package policy -->
			            <li class="{{ Request::is('extra') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/extra') }}"><i class="fa fa-circle-o"></i>Tour Policy</a>
			            </li>

			            <!-- package hotels -->
			            <li class="{{ Request::is('package_hotel') || Request::is('add_packagehotel') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/package_hotel') }}"><i class="fa fa-circle-o"></i>Tour Hotels</a>
			            </li>

			            <!-- tour settings -->
			            <li class="{{ Request::is('package-settings') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/package-settings') }}"><i class="fa fa-circle-o"></i>Tour Settings</a>
			            </li>

			            <!-- tour destination -->
			            <li class="{{ Request::is('package-locations') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/package-locations') }}"><i class="fa fa-circle-o"></i>Tour Destinations</a>
			            </li>

			            <!-- theme -->
			            <li class="{{ Request::is('theme_data') || Request::is('add_theme_data') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/theme_data') }}"><i class="fa fa-circle-o"></i>Themes</a>
			            </li>

			            <!-- tour gallery -->
			            <li class="{{ Request::is('img_gallery') || Request::is('add_image_ingallery') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/img_gallery') }}"><i class="fa fa-circle-o"></i>Tour Gallery</a>
			            </li>
			        </ul>
			    </li>
			    <?php endif; ?>
			@endif
			
			<!--Tour Settings (Settings)-->
			@if(env("WEBSITENAME")==1 && Sentinel::check())
			    <?php
			        $check_data_settings = ActivateService::where('services','=','settings')->first();
			        if($check_data_settings->activation == 1):
			    ?>
			    <!-- tour settings -->
			    <li class="treeview {{ Request::is('rate') || Request::is('Country-List') || Request::is('State-List') || Request::is('add_city') || Request::is('mid_images') || Request::is('testimonials') || Request::is('add_testimonial') || Request::is('newsletter_back') || Request::is('Lead-Cancelled-Reasons') || Request::is('Add-Lead-Follow-up') || Request::is('Booking-Status') || Request::is('Lead-Payment-Status') || Request::is('Payment-Method') || Request::is('Service-Type') || Request::is('Service-Status') || Request::is('Booking-Label') || Request::is('otp-validation') ? 'active' : '' }}">
			        <a href="#">
			            <i class="fa fa-briefcase"></i><span>Tour Settings</span><span class="pull-right-container font18"><i class="fa fa-angle-down pull-right"></i></span>
			        </a>
			        <ul class="treeview-menu">
			            @if(Sentinel::getUser()->inRole('administrator') 
			            || Sentinel::getUser()->inRole('super_admin'))
			            	<!-- manage currency -->
			                <li class="{{ Request::is('rate') ? 'active' : '' }}">
			                	<a href="{{URL::to('/rate')}}"><i class="fa fa-circle-o"></i>Manage Currency</a>
			                </li>

			                <!-- front page -->
			                <li class="{{ Request::is('mid_images') ? 'active' : '' }}">
			                	<a href="{{URL::to('/mid_images')}}"><i class="fa fa-circle-o"></i>Manage Front Page</a>
			                </li>

			                <!-- testimonials -->
			                <li class="{{ Request::is('testimonials') || Request::is('add_testimonial') ? 'active' : '' }}">
			                	<a href="{{URL::to('/testimonials')}}"><i class="fa fa-circle-o"></i>Testimonials</a>
			                </li>

			                <!-- suscribers -->
			                <li class="{{ Request::is('newsletter_back') ? 'active' : '' }}">
			                	<a href="{{URL::to('/newsletter_back')}}"><i class="fa fa-circle-o"></i>Manage Subscriber</a>
			                </li>
			            @endif
			            @if(Sentinel::getUser()->inRole('administrator') 
			            || Sentinel::getUser()->inRole('super_admin'))
			                <!-- manage city -->
			                <li class="{{ Request::is('add_city') ? 'active' : '' }}">
			                	<a href="{{URL::to('/add_city')}}"><i class="fa fa-circle-o"></i>Manage City</a>
			                </li>

			                <!-- manage state -->
			                <li class="{{ Request::is('State-List') ? 'active' : '' }}">
			                	<a href="{{URL::to('/State-List')}}"><i class="fa fa-circle-o"></i>Manage State</a>
			                </li>

			                <!-- manage coutry -->
			                <li class="{{ Request::is('Country-List') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Country-List')}}"><i class="fa fa-circle-o"></i>Manage Country</a>
			                </li>

			                <!-- lead cancelled reason -->
			                <li class="{{ Request::is('Lead-Cancelled-Reasons') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Lead-Cancelled-Reasons')}}"><i class="fa fa-circle-o"></i>Lead Cancel</a>
			                </li>

			                <li class="{{ Request::is('Add-Lead-Follow-up') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Add-Lead-Follow-up')}}"><i class="fa fa-circle-o"></i>Lead Follow-up</a>
			                </li>

			                <li class="{{ Request::is('Booking-Status') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Booking-Status')}}"><i class="fa fa-circle-o"></i>Booking Status</a>
			                </li>

			                <li class="{{ Request::is('Lead-Payment-Status') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Lead-Payment-Status')}}"><i class="fa fa-circle-o"></i>Payment Type</a>
			                </li>

			                <li class="{{ Request::is('Payment-Method') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Payment-Method')}}"><i class="fa fa-circle-o"></i>Payment Method</a>
			                </li>

			                <li class="{{ Request::is('Service-Type') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Service-Type')}}"><i class="fa fa-circle-o"></i>Service Type</a>
			                </li>

			                <li class="{{ Request::is('Service-Status') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Service-Status')}}"><i class="fa fa-circle-o"></i>Service Status</a>
			                </li>

			                <li class="{{ Request::is('Booking-Label') ? 'active' : '' }}">
			                	<a href="{{URL::to('/Booking-Label')}}"><i class="fa fa-circle-o"></i>Booking Label</a>
			                </li>

			                <li class="{{ Request::is('otp-validation') ? 'active' : '' }}">
			                	<a href="{{URL::to('/otp-validation')}}"><i class="fa fa-circle-o"></i>OTP Settings</a>
			                </li>
			            @endif
			        </ul>
			    </li>
			    <?php endif; ?>
			@endif

			<!-- site url (Settings)-->
			@if(env("WEBSITENAME")==1 && Sentinel::check())
			    <?php
			        $check_data_settings = ActivateService::where('services','=','settings')->first();
			        if($check_data_settings->activation == 1):
			    ?>
			    <li class="treeview {{ Request::is('Short-URLs') || Request::is('Add-Short-URLs') || Request::is('links') ? 'active' : '' }}">
			        <a href="#">
			            <i class="fa fa-briefcase"></i>Site URL<span class="pull-right-container font18"><i class="fa fa-angle-down pull-right"></i></span>
			        </a>
			        <ul class="treeview-menu">
			            @if(Sentinel::getUser()->inRole('administrator') 
			            || Sentinel::getUser()->inRole('super_admin'))
			            	<!-- short url -->
			                <li class="{{ Request::is('Short-URLs') || Request::is('Add-Short-URLs') ? 'active' : '' }}">
			                	<a href="{{URL::route('short_urls')}}"><i class="fa fa-circle-o"></i>Short URLs</a>
			                </li>
			            @endif

			            <!-- sitemap -->
			            <li class="{{ Request::is('links') ? 'active' : '' }}">
			            	<a href="{{ URL::to('/links') }}"><i class="fa fa-circle-o"></i>Links</a>
			            </li>
			        </ul>
			    </li>
			    <?php endif; ?>
			@endif

			<!--Tour Offers (Settings)-->
			@if(env("WEBSITENAME")==1 && Sentinel::check())
			    <?php
			        $check_data_settings = ActivateService::where('services','=','settings')->first();
			        if($check_data_settings->activation == 1):
			    ?>
			    <!-- tour offers -->
			    <li class="treeview {{ Request::is('Coupon') || Request::is('Add-Coupon') ? 'active' : '' }}">
			        <a href="#">
			            <i class="fa fa-briefcase"></i><span>Tour Coupon</span><span class="pull-right-container font18"><i class="fa fa-angle-down pull-right"></i></span>
			        </a>
			        <ul class="treeview-menu">
			            @if(Sentinel::getUser()->inRole('administrator') 
			            || Sentinel::getUser()->inRole('super_admin'))
			                <li class="{{ Request::is('Coupon') || Request::is('Add-Coupon') ? 'active' : '' }}"><a href="{{URL::to('/Coupon')}}"><i class="fa fa-circle-o"></i>Discount Coupons</a></li>
			            @endif
			        </ul>
			    </li>
			    <?php endif; ?>
			@endif

			<!--Tour Supplier (Settings)-->
			@if(env("WEBSITENAME")==1 && Sentinel::check())
			    <?php
			        $check_data_settings = ActivateService::where('services','=','settings')->first();
			        if($check_data_settings->activation == 1):
			    ?>
			    <li class="treeview {{ Request::is('Supplier') || Request::is('addsupplier') || Request::is('Supplier-Email') || Request::is('Supplier-Email-Non-Lead') || Request::is('Compose-Non-Lead-Email') ? 'active' : '' }}">
			        <a href="#">
			            <i class="fa fa-book"></i>Supplier<span class="pull-right-container font18"><i class="fa fa-angle-down pull-right"></i></span>
			        </a>
			        <ul class="treeview-menu">
			            @if(Sentinel::getUser()->inRole('administrator') 
			            || Sentinel::getUser()->inRole('super_admin'))
			                <li class="{{ Request::is('Supplier') || Request::is('addsupplier') ? 'active' : '' }}"><a href="{{URL::to('/Supplier')}}"><i class="fa fa-circle-o"></i><span>Supplier List</span></a></li>
			            @endif
			            <li class="{{ Request::is('Supplier-Email') ? 'active' : '' }}"><a href="{{URL::to('/Supplier-Email')}}"><i class="fa fa-circle-o"></i><span>Supplier Email (Lead)</span></a></li>
			            <li class="{{ Request::is('Supplier-Email-Non-Lead') || Request::is('Compose-Non-Lead-Email') ? 'active' : '' }}"><a href="{{URL::to('/Supplier-Email-Non-Lead')}}"><i class="fa fa-circle-o"></i><span>Compose Email</span></a></li>
			        </ul>
			    </li>
			    <?php endif; ?>
			@endif

			<!--Hotels-->
			@if(env("WEBSITENAME")==1 && Sentinel::check() 
			&& (Sentinel::getUser()->inRole('administrator') 
			|| Sentinel::getUser()->inRole('super_admin')))
			    <?php
			        $check_data_hotels = ActivateService::where('services','=','hotels')->first();
			        if($check_data_hotels->activation == 1):
			    ?>
			    <li class="treeview">
			        <a href="#"><i class="fa fa-building-o"></i><span>Hotels</span><span class="pull-right-container font18"><i class="fa fa-angle-down pull-right"></i></span></a>
			        <ul class="treeview-menu">
			            <li><a href="{{URL::to('/hotel')}}"><i class="fa fa-circle-o"></i>Hotels</a></li>
			            <li><a href="{{URL::to('/hotel-settings')}}"><i class="fa fa-circle-o"></i>Hotels Settings</a></li>
			        </ul>
			    </li>
			    <?php endif; ?>
			@endif
			
			<!--Rooms-->
			<?php
			    $check_data_rooms = ActivateService::where('services','=','rooms')->first();
			    if($check_data_rooms->activation == 1):
			?>
			<li class="treeview">
			    <a href="#"><i class="fa fa-bed"></i>Rooms<span class="pull-right-container font18"><i class="fa fa-angle-down pull-right"></i></span></a>
			    <ul class="treeview-menu">
			        <li><a href="{{URL::to('/rooms')}}"><i class="fa fa-circle-o"></i> All Rooms</a></li>
			        <li><a href="{{URL::to('/room-rate-plans')}}"><i class="fa fa-circle-o"></i> Price Manager</a></li>
			        {{--  <li><a href="{{URL::to('/room-plans')}}"><i class="fa fa-circle-o"></i> Rate Plans</a></li>
			        <li><a href="{{URL::to('/taxes')}}"><i class="fa fa-circle-o"></i> Taxes</a></li>
			        <li><a href="{{URL::to('/policies')}}"><i class="fa fa-circle-o"></i> Policies</a></li>  --}}
			        <li><a href="{{URL::to('/room-settings')}}"><i class="fa fa-circle-o"></i> Room Settings</a></li>
			    </ul>
			</li>
			<?php endif; ?>
		
			<!-- manage roles -->
			@if(env("WEBSITENAME") == 1)
			    @if(Sentinel::check())
			        @if(Sentinel::getUser()->inRole('administrator'))
			            <li class="{{ Request::path() == 'role' ? 'active' : '' }}">
			                <a href="{{ URL::to('/role') }}"><i class="fa fa-user"></i><span>Manage Roles</span></a>
			            </li>
			        <!---->
			        @endif
			    @endif
			@endif

			<!-- payment transactions -->
			<li class="treeview {{ Request::is('Transactions') || Request::is('Quote-Transactions') ? 'active' : '' }}">
			    <a href="#">
			        <i class="fa fa-exchange"></i>Transactions
			        <span class="pull-right-container font18">
			            <i class="fa fa-angle-down pull-right"></i>
			        </span>
			    </a>
			    <ul class="treeview-menu">
			        <li class="{{ Request::is('Transactions') ? 'active' : '' }}"><a href="{{ route('transactions') }}"><i class="fa fa-circle-o"></i> All Transactions</a></li>
			        <li class="{{ Request::is('Quote-Transactions') ? 'active' : '' }}"><a href="{{ route('quotetransactions') }}"><i class="fa fa-circle-o"></i> Quote Wise</a></li>
			    </ul>
			</li>

			<!-- payment gateway settings -->
			<li class="treeview {{ Request::is('Gateway-Settings') || Request::is('Payment-Modes') || Request::is('Add-Payment-Mode') ? 'active' : '' }} @if(Request::segment(1)=='editgatewaysetting' || Request::segment(1)=='editpaymentmode') active @endif">
			    <a href="#">
			        <i class="fa fa-cogs"></i>Payment Settings
			        <span class="pull-right-container font18">
			            <i class="fa fa-angle-down pull-right"></i>
			        </span>
			    </a>
			    <ul class="treeview-menu">
			        <li class="{{ Request::is('Payment-Modes') || Request::is('Add-Payment-Mode') ? 'active' : '' }} @if(Request::segment(1)=='editpaymentmode') active @endif"><a href="{{ route('payment_mode') }}"><i class="fa fa-circle-o"></i> Payment Mode</a></li>
			        <li class="{{ Request::is('Gateway-Settings') ? 'active' : '' }} @if(Request::segment(1)=='editgatewaysetting') active @endif"><a href="{{ route('gateway_settings') }}"><i class="fa fa-circle-o"></i> Gateway Settings</a></li>
			    </ul>
			</li>
		</ul>
	</section>
</aside>
<!-- sidemenu ends -->