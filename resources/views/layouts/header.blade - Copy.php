<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="robots" content="noindex, nofollow" />
		@if(env("WEBSITENAME")==1)
		<title>The World Gateway</title>
		@elseif(env("WEBSITENAME")==0)
		<title>Rapidex Travels</title>
		@endif
		<input type="hidden" value="{{ url('/') }}" name="" id="APP_URL">
        
		<!--<link rel="SHORTCUT ICON" href="http://www.globtierinfotech.com/images/glbfav.ico">-->
		
		<meta name="_token" content="{!! csrf_token() !!}"/>
		
		<!--common css-->
		<link rel="preload stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/common.css') }}" crossorigin="anonymous" />
        <!-- Bootstrap 3.3.2 -->
		<link href="{{ asset("/resources/assets/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Database Tables -->
        <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset("/resources/assets/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/resources/assets/admin-lte/dist/css/style.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/resources/assets/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/resources/assets/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/resources/assets/frontend/css/bootstrap-formhelpers.min.css") }}" rel="stylesheet">
        <link href="{{ asset("/resources/assets/admin-lte/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/resources/assets/admin-lte/dist/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="https://adminlte.io/themes/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" rel="stylesheet">
        <link href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
		
        <style>
            @media (min-width: 768px)
                {
                #price_add .modal-dialog 
                   {
                width: 831px;
               margin: 30px auto;
                    }
                #price_add .table>tbody>tr>td {
                     padding: 6px;
                     line-height: 1.42857143;
                     vertical-align: top;
                     border-top: 1px solid #ddd;
                     width: 1%;
                      }
                #price_add th
                    {
                    text-align: center;
                    }
                }
        </style>
    </head>
    <body class="skin-blue" onload="startTime()">
	<!--<body class="skin-blue sidebar-collapse" onload="startTime()">-->
        <input type="hidden" value="{{url('/')}}" id="baseurl" name="baseurl">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="{{ URL::to('/') }}" class="logo">
					@if(env("WEBSITENAME")==1)
					<b>WorldGateway</b>
					@elseif(env("WEBSITENAME")==0)
					<b>Rapidex</b>
					@endif
				</a>
				<!-- Header Navbar -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<span style="float: left; padding-top: 12px; color: #fff;font-size: 16px;"><span id="txt" style="padding-right: 30px;">| </span>{{date('d  M,  Y')}}</span>
					<!-- Navbar Z Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Messages: style can be found in dropdown.less-->
							<!-- User Account Menu -->
							<li class="dropdown user user-menu">
								<!-- Menu Toggle Button -->
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<!-- The user image in the navbar-->
									<img src="{{ asset("/resources/assets/admin-lte/dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image"/>
									<!-- hidden-xs hides the username on small devices so only the image appears. -->
									<span class="hidden-xs">
										@if(Sentinel::check())
											Hello, {{Sentinel::getUser()->first_name}}
										@else
											Guest User
										@endif
									</span>
								</a>
								<ul class="dropdown-menu" style="background-color: #23527c;border: none">
									<!-- The user image in the menu -->
									<li class="user-header" style="border: 1px solid #3c8dbc">
										<img src="{{ asset("/resources/assets/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
										<p style="margin-bottom: 5px;">
											@if(Sentinel::check())
											{{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}}
											@endif
										</p>
										<span style="color: #ffffffcc">Super Admin</span>
									</li>
									<!-- Menu Footer-->
									<li class="user-footer" style="padding: 10px 20px;border: 1px solid #CED0D4;border-radius: 0px 0px 3px 3px">
										<div class="pull-left">
											<a href="#" onclick="" class="btn btn-default btn-flat" style="border-radius: 5px">Profile</a>
										</div>
										<div class="pull-right">
											<form action="{{URL::to('/logout')}}" id="logout-form" method="POST">
											{{ csrf_field() }}
											<a href="#" onclick="document.getElementById('logout-form').submit()" class="btn btn-default btn-flat" style="border-radius: 5px">Sign out</a>
											</form> 
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>