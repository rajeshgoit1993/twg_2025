<!-- this is not in use (in use is front-sidemenu) -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
       <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/resources/admin_logo.png') }}" class="img-circle" alt="User Image" />
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
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="active"><a href="index2.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>General</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/General/settings.html"><i class="fa fa-circle-o"></i>Settings</a></li>
            <li><a href="pages/General/modules.html"><i class="fa fa-circle-o"></i> Modules</a></li>
            <li><a href="pages/General/currencies.html"><i class="fa fa-circle-o"></i> Currencies</a></li>
            <li><a href="pages/General/payment-gateways.html"><i class="fa fa-circle-o"></i> Payment Gateways</a></li>
            <li><a href="pages/General/social-connections.html"><i class="fa fa-circle-o"></i>Social Connections</a></li>
            <li><a href="pages/General/email-templates.html"><i class="fa fa-circle-o"></i>Email Templates</a></li>
            <li><a href="pages/General/backup.html"><i class="fa fa-circle-o"></i>BackUp</a></li>
          </ul>
        </li>
        @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('digital_marketing'))

                <li class="{{ Request::path() == 'managesalesusers' ? 'active' : '' }}">
                    <a href="{{URL::to('/managesalesusers')}}"><i class="fa fa-users"></i> <span>Sales Users</span></span></a>
                </li>
               
           @endif 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Accounts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/Accounts/admins.html"><i class="fa fa-circle-o"></i>Admins</a></li>
          </ul>
        </li>

        <li><a href="cms-page.html"><i class="fa fa-book"></i> <span>CMS Page</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Hotels</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('/hotel')}}"><i class="fa fa-circle-o"></i>Hotels</a></li>
            <li><a href="{{URL::to('/room')}}"><i class="fa fa-circle-o"></i>Rooms</a></li>
            <li><a href="{{URL::to('/hotel-settings')}}"><i class="fa fa-circle-o"></i>Hotels Settings</a></li>
          </ul>
        </li>

        <li><a href="flights.html"><i class="fa fa-book"></i> <span>Flights</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Packages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/Packages/tours.html"><i class="fa fa-circle-o"></i> Tours</a></li>
            <li><a href="{{URL::to('/add-package')}}"><i class="fa fa-circle-o"></i> Add New</a></li>
            <li><a href="{{URL::to('/extra')}}"><i class="fa fa-circle-o"></i>Extras</a></li>
            <li><a href="pages/Packages/settings.html"><i class="fa fa-circle-o"></i>Settings</a></li>
          </ul>
        </li>

        <li class="treeview">
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

        <li><a href="coupon.html"><i class="fa fa-book"></i> <span>Coupons</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>