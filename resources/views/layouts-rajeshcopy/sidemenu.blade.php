<?php
use App\Role;
use App\ActivateService;
?>
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
	<div class="user-panel">
		<div class="pull-left image">
		@if(Sentinel::check())
			<img src="{{ asset('/public/uploads/user_profiles/'.Sentinel::getUser()->profile_image) }}" class="img-circle" alt="User Image" / style="margin-bottom: 15px">
		@endif
		</div>
		<div class="pull-left info">
			<p>
			@if(Sentinel::check())
			{{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}}
			@else
			Guest User
			@endif
			</p>
			<!-- Status -->
			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	</div>
	<ul class="sidebar-menu" data-widget="tree">
		<!--Dashboard-->
		<li class="Request::is('dashboard') ? 'active' : ''"><a href="{{URL::to('/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>

		<!--Activate Services-->
		@if(Sentinel::check())
		@if(Sentinel::getUser()->inRole('super_admin'))
		<li class="{{Request::is('Activate-Services') ? 'active' : ''}} ">
			<a href="{{URL::to('/Activate-Services')}}"><i class="fa fa-dashboard"></i>Activate Services</a>
		</li>
		@endif
		@endif

		<!--Company Profile-->
		@if(Sentinel::check())
		@if(Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('administrator'))
			<li class="{{Request::is('Company-Profile') ? 'active' : ''}} "><a href="{{URL::to('/Company-Profile')}}"><i class="fa fa-user"></i>Company Profile</a></li>
		@endif
		@endif

		<!--Manage Users-->
		<?php $all_roles = Role::all(); ?>
		@if(env("WEBSITENAME")==1)
		@if(Sentinel::check())
		<?php
			$check_data_managerole=ActivateService::where('services','=','manage_roles')->first();
			if($check_data_managerole->activation==1):
		?>
		@if(Sentinel::getUser()->inRole('super_admin'))
			<li class="treeview @foreach($all_roles as $role) @if($role->slug==Request::segment(2)) active @endif @endforeach">
				<a href="#"><i class="fa fa-users"></i><span>Manage Users</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
					@foreach($all_roles as $role)
					<li class="@if($role->slug==Request::segment(2)) active @endif">
						<a href="{{URL::to('/roles/'.$role->slug)}}"><i class="fa fa-circle-o"></i>{{$role->name}}</a>
					</li>
					@endforeach
				</ul>
			</li>
		@endif
		
		@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee'))
		<li class="treeview @foreach($all_roles as $role) @if($role->slug==Request::segment(2)) active @endif @endforeach">
			<a href="#"><i class="fa fa-users"></i><span>Manage Users</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				@foreach($all_roles as $role)
				@if($role->slug!='super_admin')
				<li class="@if($role->slug==Request::segment(2)) active @endif"><a href="{{URL::to('/roles/'.$role->slug)}}">
				<i class="fa fa-circle-o"></i>{{$role->name}}</a></li>
				@endif
				@endforeach
			</ul>
		</li>
		@endif
		
		<!--Lead Manager-->
		@endif
		@endif
		<?php endif; ?>
		<li class="treeview {{Request::is('query') || Request::is('enquiry') || Request::is('quotation') || Request::is('add_quotation') || Request::is('add_customer') || Request::is('Leads-Follow-up') || Request::is('Payment') || Request::is('Saved-Quote') || Request::is('Confirmation') || Request::is('Cancelled-Leads') || Request::is('Deleted-Leads') || Request::is('Vouchers') || Request::is('Post-Tour') || Request::is('lead_settings') || Request::is('Verification-Pending-Add-Lead-Followup') || Request::is('Booking-Hold') || Request::is('Under-Cancellation') || Request::is('Tour-Cancelled') || Request::is('Refund-Issued') || Request::is('booking-calendar') || Request::is('raise-concern') || Request::is('search-leads') ? 'active' : '' }}"> 
			<a href="#"><i class="fa fa-briefcase"></i><span>Lead Manager</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				@if(Sentinel::check())
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('employee') )
				<?php
					$check_data_leads=ActivateService::where('services','=','leads')->first();
					if($check_data_leads->activation==1):
				?>
				<li class="{{Request::is('add_customer')  ? 'active' : ''  }}"><a href="{{URL::to('/add_customer')}}"><i class="fa fa-circle-o"></i>Add New Lead</a></li>
				<?php endif; ?>
				@endif
				<?php
					$check_data_leads=ActivateService::where('services','=','leads')->first();
					if($check_data_leads->activation==1):
				?>
				<li class="{{Request::is('enquiry')  ? 'active' : ''  }}"><a href="{{URL::to('/enquiry')}}"><i class="fa fa-circle-o"></i>Web Leads 
					<span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('web_leads')}}</small>
</span>  </a></li>
				<li class="{{Request::is('Verification-Pending-Add-Lead-Followup')  ? 'active' : ''  }}"><a href="{{URL::to('/Verification-Pending-Add-Lead-Followup')}}"><i class="fa fa-circle-o"></i>Pending Verification  <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('verification_pending_add_lead_follow_up')}}</small>
</span> </a></li>

				<?php endif; ?>
				<?php
					$check_data_lm=ActivateService::where('services','=','laed_manager')->first();
					if($check_data_lm->activation==1):
				?>
				<li class="{{Request::is('query')  ? 'active' : ''  }}"><a href="{{URL::to('/query')}}"><i class="fa fa-circle-o"></i>Pending Quote <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('query')}}</small>
</span> </a></li>

				<li class="{{Request::is('Saved-Quote')  ? 'active' : ''  }}"><a href="{{URL::to('/Saved-Quote')}}"><i class="fa fa-circle-o"></i>Saved Quote <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('saved_quote')}}</small>
</span> </a></li>

				<li class="{{Request::is('quotation')  ? 'active' : ''  }}"><a href="{{URL::to('/quotation')}}"><i class="fa fa-circle-o"></i>Quote Sent <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('quotation')}}</small>
</span> </a></li>
				<li class="{{Request::is('Leads-Follow-up')  ? 'active' : ''  }}"><a href="{{URL::to('/Leads-Follow-up')}}"><i class="fa fa-circle-o"></i>Leads Follow-up <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('leads_follow_up')}}</small>
</span> </a></li>
				<li class="{{Request::is('Booking-Hold')  ? 'active' : ''  }}"><a href="{{URL::to('/Booking-Hold')}}"><i class="fa fa-circle-o"></i>Booking Hold  <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('booking_hold')}}</small>
</span> </a></li>

				<li class="{{Request::is('Payment')  ? 'active' : ''  }}"><a href="{{URL::to('/Payment')}}"><i class="fa fa-circle-o"></i>Payment Follow-up <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('payment')}}</small>
</span> </a></li>

				<li class="{{Request::is('Under-Cancellation')  ? 'active' : ''  }}"><a href="{{URL::to('/Under-Cancellation')}}"><i class="fa fa-circle-o"></i>Under Cancellation <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('under_cancellation')}}</small>
</span> </a></li>

				<li class="{{Request::is('Confirmation')  ? 'active' : ''  }}"><a href="{{URL::to('/Confirmation')}}"><i class="fa fa-circle-o"></i>Issue Voucher <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('confirmation')}}</small>
</span> </a></li>

<li class="{{Request::is('search-leads')  ? 'active' : ''  }}"><a href="{{URL::to('/search-leads')}}"><i class="fa fa-circle-o"></i>Search Leads <span class="pull-right-container">
<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('search_leads')}}</small>

</span> </a></li>

<li class="{{Request::is('raise-concern')  ? 'active' : ''  }}"><a href="{{URL::to('/raise-concern')}}"><i class="fa fa-circle-o"></i>Raise concern <span class="pull-right-container">
<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('raise_data')}}</small>

</span> </a></li>

<li class="{{Request::is('booking-calendar')  ? 'active' : ''  }}"><a href="{{URL::to('/booking-calendar')}}"><i class="fa fa-circle-o"></i>Booking Calendar <span class="pull-right-container">


</span> </a></li>



				<li class="{{Request::is('Vouchers')  ? 'active' : ''  }}"><a href="{{URL::to('/Vouchers')}}"><i class="fa fa-circle-o"></i>Tour Vouchered <span class="pull-right-container">
<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('vouchers')}}</small>
</span>  </a></li>


<li class="{{Request::is('Tour-Cancelled')  ? 'active' : ''  }}"><a href="{{URL::to('/Tour-Cancelled')}}"><i class="fa fa-circle-o"></i>Tour Cancelled <span class="pull-right-container">
<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('tour_cancelled')}}</small>
</span>  </a></li>


<li class="{{Request::is('Refund-Issued')  ? 'active' : ''  }}"><a href="{{URL::to('/Refund-Issued')}}"><i class="fa fa-circle-o"></i>Process Refund <span class="pull-right-container">
<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('refund_issued')}}</small>
</span>  </a></li>



				<li class="{{Request::is('Cancelled-Leads')  ? 'active' : ''  }}"><a href="{{URL::to('/Cancelled-Leads')}}"><i class="fa fa-circle-o"></i>Cancelled Leads <span class="pull-right-container">

<small class="label pull-right bg-blue">{{NotificationHelpers::get_leads_notification('cancelled_leads')}}</small>
</span>  </a></li>
				
				<li class="{{Request::is('Post-Tour')  ? 'active' : ''  }}"><a href="{{URL::to('/Post-Tour')}}"><i class="fa fa-circle-o"></i>Post Tour</a></li>
				<li class="{{Request::is('Post-Tour')  ? 'active' : ''  }}"><a href="{{URL::to('/Post-Tour')}}"><i class="fa fa-circle-o"></i>Tour Refund</a></li>
				<li class="{{Request::is('Post-Tour')  ? 'active' : ''  }}"><a href="{{URL::to('/Post-Tour')}}"><i class="fa fa-circle-o"></i>Tour Reviews</a></li>
				<?php endif; ?>
					@if(Sentinel::getUser()->inRole('administrator') ||  Sentinel::getUser()->inRole('super_admin') )
				<?php
					$check_data_leads=ActivateService::where('services','=','leads')->first();
					if($check_data_leads->activation==1):
				?>
				<li class="{{Request::is('Deleted-Leads')  ? 'active' : ''  }}"><a href="{{URL::to('/Deleted-Leads')}}"><i class="fa fa-circle-o"></i>Deleted Leads</a></li>
				<?php endif; ?>
				@endif
				<?php
					$check_data_lm=ActivateService::where('services','=','laed_manager')->first();
					if($check_data_lm->activation==1):
				?>
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') )
				<li class="{{ Request::is('lead_settings') ? 'active' : '' }}"><a href="{{URL::to('/lead_settings')}}"><i class="fa fa-circle-o"></i>Lead Settings</a></li>
				@endif
				@endif
				<?php endif; ?>
			</ul>
		</li>
		
		<!--Tour Package Manager-->
		@if(env("WEBSITENAME")==1)
		@if(Sentinel::check())
		<?php
			$check_data_tour=ActivateService::where('services','=','tour_package_manager')->first();
			if($check_data_tour->activation==1):
		?>
		<li class="treeview  {{ Request::is('tours')||Request::is('add-package')||Request::is('extra')||Request::is('package-settings')||Request::is('package-locations')||Request::is('package-add-tours') || Request::is('theme_data') || Request::is('add_theme_data') || Request::is('package_hotel') || Request::is('add_packagehotel') || Request::is('img_gallery') || Request::is('add_image_ingallery') || Request::is('links') ? 'active' : '' }} ">
			<a href="#"><i class="fa fa-briefcase"></i><span>Tour Manager</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li class="{{ Request::is('tours') ? 'active' : '' }}"><a  href="{{URL::to('/tours')}}"><i class="fa fa-circle-o"></i>Tour Packages</a></li>
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
				<li class="{{ Request::is('add-package') ? 'active' : '' }}"><a href="{{URL::to('/add-package')}}"><i class="fa fa-circle-o"></i>Add New Package</a></li>
				@endif
				<li class="{{ Request::is('extra') ? 'active' : '' }}"><a href="{{URL::to('/extra')}}"><i class="fa fa-circle-o"></i>Package Policies</a></li>
				<li class="{{ Request::is('package_hotel') || Request::is('add_packagehotel') ? 'active' : '' }}">
					<a href="{{URL::to('/package_hotel')}}"><i class="fa fa-circle-o"></i>Package Hotels</a></li>
					<li class="{{ Request::is('package-settings') ? 'active' : '' }}"><a href="{{URL::to('/package-settings')}}"><i class="fa fa-circle-o"></i>Tour Settings</a></li>
					<li class="{{ Request::is('package-locations') ? 'active' : '' }}"><a href="{{URL::to('/package-locations')}}"><i class="fa fa-circle-o"></i>Tour Destinations</a></li>
					<li class="{{ Request::is('theme_data') || Request::is('add_theme_data')  ? 'active' : '' }}"><a  href="{{URL::to('/theme_data')}}"><i class="fa fa-circle-o"></i>Themes</a></li>
					<li class="{{ Request::is('img_gallery') || Request::is('add_image_ingallery')  ? 'active' : '' }}"><a  href="{{URL::to('/img_gallery')}}"><i class="fa fa-circle-o"></i>Image Gallery</a></li>

					<li class="{{ Request::is('links')   ? 'active' : '' }}"><a  href="{{URL::to('/links')}}"><i class="fa fa-circle-o"></i>Links</a></li>


					<!-- <li class="{{ Request::is('package-add-tours') ? 'active' : '' }}"><a href="{{URL::to('/package-add-tours')}}"><i class="fa fa-circle-o"></i>Additional Tours</a></li>-->
			</ul>
		</li>
		<?php endif; ?>
		@endif
		@endif
		
		<!--Tour Settings (Settings)-->
		@if(env("WEBSITENAME")==1)
		@if(Sentinel::check())
		<?php
			$check_data_settings=ActivateService::where('services','=','settings')->first();
			if($check_data_settings->activation==1):
		?>
		<li class="treeview {{ Request::is('rate') || Request::is('Country-List') || Request::is('State-List') || Request::is('add_city') || Request::is('mid_images') || Request::is('testimonials')  || Request::is('add_testimonial') || Request::is('newsletter_back') || Request::is('Lead-Cancelled-Reasons') || Request::is('Add-Lead-Follow-up') || Request::is('Booking-Status') || Request::is('Lead-Payment-Status') || Request::is('Payment-Method') || Request::is('Service-Type') || Request::is('Service-Status') || Request::is('Booking-Label') || Request::is('otp-validation')? 'active' : '' }} " >
			<a href="#"><i class="fa fa-briefcase"></i><span>Tour Settings</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
					<li class="{{ Request::is('rate') ? 'active' : '' }}"><a  href="{{URL::to('/rate')}}"><i class="fa fa-circle-o"></i>Manage Currency</a></li>
					<li class="{{ Request::is('mid_images') ? 'active' : '' }}"><a  href="{{URL::to('/mid_images')}}"><i class="fa fa-circle-o"></i>Manage Front Page</a></li>
					<li class="{{ Request::is('testimonials') || Request::is('add_testimonial')  ? 'active' : '' }}"><a  href="{{URL::to('/testimonials')}}"><i class="fa fa-circle-o"></i>Testimonials</a></li>
					<li class="{{ Request::is('newsletter_back')   ? 'active' : '' }}"><a  href="{{URL::to('/newsletter_back')}}"><i class="fa fa-circle-o"></i>Manage Subscriber</a></li>
				@endif
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
					<li class="{{ Request::is('add_city') ? 'active' : '' }}"><a  href="{{URL::to('/add_city')}}"><i class="fa fa-circle-o"></i>Manage City</a></li>
					<li class="{{ Request::is('State-List') ? 'active' : '' }}"><a  href="{{URL::to('/State-List')}}"><i class="fa fa-circle-o"></i>Manage State</a></li>
					<li class="{{ Request::is('Country-List') ? 'active' : '' }}"><a  href="{{URL::to('/Country-List')}}"><i class="fa fa-circle-o"></i>Manage Country</a></li>
                  
                  <li class="{{ Request::is('Lead-Cancelled-Reasons') ? 'active' : '' }}"><a  href="{{URL::to('/Lead-Cancelled-Reasons')}}"><i class="fa fa-circle-o"></i>Lead Cancelled Reasons</a></li>

                 
                  <li class="{{ Request::is('Add-Lead-Follow-up') ? 'active' : '' }}"><a  href="{{URL::to('/Add-Lead-Follow-up')}}"><i class="fa fa-circle-o"></i>Add Lead Follow-up</a></li>


                   <li class="{{ Request::is('Booking-Status') ? 'active' : '' }}"><a  href="{{URL::to('/Booking-Status')}}"><i class="fa fa-circle-o"></i>Booking Status</a></li>

                    <li class="{{ Request::is('Lead-Payment-Status') ? 'active' : '' }}"><a  href="{{URL::to('/Lead-Payment-Status')}}"><i class="fa fa-circle-o"></i>Lead Payment Status</a></li>

                     <li class="{{ Request::is('Payment-Method') ? 'active' : '' }}"><a  href="{{URL::to('/Payment-Method')}}"><i class="fa fa-circle-o"></i>Payment Method</a></li>

                      <li class="{{ Request::is('Service-Type') ? 'active' : '' }}"><a  href="{{URL::to('/Service-Type')}}"><i class="fa fa-circle-o"></i>Service Type</a></li>

                       <li class="{{ Request::is('Service-Status') ? 'active' : '' }}"><a  href="{{URL::to('/Service-Status')}}"><i class="fa fa-circle-o"></i>Service Status</a></li>

                        <li class="{{ Request::is('Booking-Label') ? 'active' : '' }}"><a  href="{{URL::to('/Booking-Label')}}"><i class="fa fa-circle-o"></i>Booking Label</a></li>

                        <li class="{{ Request::is('otp-validation') ? 'active' : '' }}"><a  href="{{URL::to('/otp-validation')}}"><i class="fa fa-circle-o"></i>Enquiry OTP Setting</a></li>


				@endif
			</ul>
		</li>
		<?php endif; ?>
		@endif
		@endif

		<!--Short URL's (Settings)-->
		@if(env("WEBSITENAME")==1)
		@if(Sentinel::check())
		<?php
			$check_data_settings=ActivateService::where('services','=','settings')->first();
			if($check_data_settings->activation==1):
		?>
		<li class="treeview {{ Request::is('Short-URLs') || Request::is('Add-Short-URLs') ? 'active' : '' }} " >
			<a href="#"><i class="fa fa-briefcase"></i><span>Tour URL's</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
				<li class="{{ Request::is('Short-URLs') || Request::is('Add-Short-URLs')   ? 'active' : '' }}"><a  href="{{URL::route('short_urls')}}"><i class="fa fa-circle-o"></i>Short URLs</a></li>	
				@endif
			</ul>
		</li>
		<?php endif; ?>
		@endif
		@endif

		<!--Tour Offers (Settings)-->
		@if(env("WEBSITENAME")==1)
		@if(Sentinel::check())
		<?php
			$check_data_settings=ActivateService::where('services','=','settings')->first();
			if($check_data_settings->activation==1):
		?>
		<li class="treeview {{ Request::is('Coupon') || Request::is('Add-Coupon') ? 'active' : '' }} " >
			<a href="#"><i class="fa fa-briefcase"></i><span>Tour Offers</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
					<li class="{{ Request::is('Coupon') || Request::is('Add-Coupon')  ? 'active' : '' }}"><a  href="{{URL::to('/Coupon')}}"><i class="fa fa-circle-o"></i>Discount Coupons</a></li>
				@endif
			</ul>
		</li>
		<?php endif; ?>
		@endif
		@endif

		<!--Tour Supplier (Settings)-->
		@if(env("WEBSITENAME")==1)
		@if(Sentinel::check())
		<?php
			$check_data_settings=ActivateService::where('services','=','settings')->first();
			if($check_data_settings->activation==1):
		?>
		<li class="treeview {{ Request::is('Supplier') || Request::is('addsupplier') || Request::is('Supplier-Email') || Request::is('Supplier-Email-Non-Lead') || Request::is('Compose-Non-Lead-Email') ? 'active' : '' }} " >
			<a href="#"><i class="fa fa-book"></i><span>Tour Suppliers</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
					<li class="{{ Request::is('Supplier') || Request::is('addsupplier')   ? 'active' : '' }}"><a href="{{URL::to('/Supplier')}}"><i class="fa fa-circle-o"></i><span>Supplier List</span></a></li>
				@endif

				<li class="{{ Request::is('Supplier-Email')   ? 'active' : '' }}"><a href="{{URL::to('/Supplier-Email')}}"><i class="fa fa-circle-o"></i><span>Supplier Email (Lead)</span></a></li>

<li class="{{ Request::is('Supplier-Email-Non-Lead') || Request::is('Compose-Non-Lead-Email')  ? 'active' : '' }}"><a href="{{URL::to('/Supplier-Email-Non-Lead')}}"><i class="fa fa-circle-o"></i><span>Compose Email </span></a></li>

			</ul>
		</li>
		<?php endif; ?>
		@endif
		@endif




		
		<!--Hotels-->
		@if(env("WEBSITENAME")==1)
		@if(Sentinel::check())
		@if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin'))
		<?php
			$check_data_hotels=ActivateService::where('services','=','hotels')->first();
			if($check_data_hotels->activation==1):
		?>
		<li class="treeview">
			<a href="#"><i class="fa fa-building-o"></i><span>Hotels</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li><a href="{{URL::to('/hotel')}}"><i class="fa fa-circle-o"></i>Hotels</a></li>
				<li><a href="{{URL::to('/hotel-settings')}}"><i class="fa fa-circle-o"></i>Hotels Settings</a></li>
			</ul>
		</li>
		<?php endif; ?>
		
		<!--Rooms-->
		<?php
			$check_data_rooms=ActivateService::where('services','=','rooms')->first();
			if($check_data_rooms->activation==1):
		?>
		<li class="treeview">
			<a href="#"><i class="fa fa-bed"></i><span>Rooms</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
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
		<!--<li><a href="flights.html"><i class="fa fa-book"></i> <span>Flights</span></a></li>-->
		@endif
		@endif
		@endif
		
		<!---->
		@if(env("WEBSITENAME")==1)
		@if(Sentinel::check())
		@if(Sentinel::getUser()->inRole('administrator') )
		<li class="{{ Request::path() == 'role' ? 'active' : '' }}">
			<a href="{{URL::to('/role')}}"><i class="fa fa-user"></i><span>Manage Roles</span></a>
		</li>
		<!---->
		@endif
		@endif
		@endif

	

<li class="treeview {{ Request::is('Transactions') || Request::is('Quote-Transactions')  ? 'active' : '' }}">
		<a href="#">
		<i class="fa fa-exchange"></i>
		<span>Transactions</span>
		<span class="pull-right-container">
		<i class="fa fa-angle-left pull-right"></i>
		</span>
		</a>
		<ul class="treeview-menu">
		<li class="{{ Request::is('Transactions')  ? 'active' : '' }}"><a href="{{route('transactions')}}"><i class="fa fa-circle-o"></i> All Transactions</a></li>
		

		<li class="{{ Request::is('Quote-Transactions')  ? 'active' : '' }}"><a href="{{route('quotetransactions')}}"><i class="fa fa-circle-o"></i> Quote Wise</a></li>


		</ul>
		</li>
		


		<li class="treeview {{ Request::is('Gateway-Settings') || Request::is('Payment-Modes') || Request::is('Add-Payment-Mode')  ? 'active' : '' }} @if(Request::segment(1)=='editgatewaysetting' || Request::segment(1)=='editpaymentmode') active @endif">
		<a href="#">
		<i class="fa fa-cogs"></i>
		<span>Payment Settings</span>
		<span class="pull-right-container">
		<i class="fa fa-angle-left pull-right"></i>
		</span>
		</a>
		<ul class="treeview-menu">
		<li class="{{ Request::is('Payment-Modes') || Request::is('Add-Payment-Mode') ? 'active' : '' }} @if(Request::segment(1)=='editpaymentmode') active @endif"><a href="{{route('payment_mode')}}"><i class="fa fa-circle-o"></i>Payment Mode</a></li>
		<li class="{{ Request::is('Gateway-Settings')  ? 'active' : '' }} @if(Request::segment(1)=='editgatewaysetting') active @endif"><a href="{{route('gateway_settings')}}"><i class="fa fa-circle-o"></i>Gateway Settings</a></li>
		</ul>
		</li>
		


		<!-- <li class="treeview">
		<a href="#">
		<i class="fa fa-cogs"></i>
		<span>Offers</span>
		<span class="pull-right-container">
		<i class="fa fa-angle-left pull-right"></i>
		</span>
		</a>
		<ul class="treeview-menu">
		<li><a href="pages/Offers/manage-offers.html"><i class="fa fa-circle-o"></i>Manage Offers</a></li>
		<li><a href="pages/Offers/offers-settings.html"><i class="fa fa-circle-o"></i>Offers Settings</a></li>
		</ul>
		</li>
		<li><a href="coupon.html"><i class="fa fa-book"></i> <span>Coupons</span></a></li> -->
	</ul>
</section>
</aside>