		<!-- google font -->
		<!-- <link rel="stylesheet" type="text/css" href='https://fonts.googleapis.com/css?family=Lato:300,400,700' crossorigin="anonymous" /> -->
		<link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900&display=swap" onload="this.rel='stylesheet'" crossorigin="anonymous">	
	
		<!-- Bootstrap 3.3.2 -->
		<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/admin-lte/bootstrap/css/bootstrap.min.css') }}" />

		<!--common css-->
		<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/common.css') }}" />

        <!-- Font Awesome Icons -->
        <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous" />

        <!-- Ionicons -->
        <link type="text/css" rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" crossorigin="anonymous" />

		<!-- Database Tables -->
        <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" crossorigin="anonymous" />

        <!-- Theme style -->
        <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/admin-lte/dist/css/AdminLTE.min.css') }}" />
        <!-- <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/admin-lte/dist/css/style.css') }}" /> -->
        <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/admin-lte/dist/css/skins/skin-blue.min.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/bootstrap-formhelpers.min.css') }}" >
        <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/admin-lte/dist/css/skins/_all-skins.min.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/admin-lte/dist/css/select2.min.css') }}" />

        <link type="text/css" rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css" crossorigin="anonymous"/>
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" crossorigin="anonymous" />
        <link type="text/css" rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css" crossorigin="anonymous" />
        <link type="text/css" rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" crossorigin="anonymous" />

	    <!--top header-->
		<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/backend/css/top-menu-bar.css') }}" />

		<!-- Main Style--> 
		<!-- <link rel="stylesheet" type="text/css" as="style" href="{{ asset('/resources/assets/frontend/css/style.css') }}" /> -->
		<!-- <link rel="stylesheet" type="text/css" as="style" href="{{ asset('/resources/assets/frontend/css/style-2.css') }}" /> -->

	    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	    <style type="text/css">
	    	.add {
	    		padding-bottom: 23px;
	    	}

	    </style>

	    @yield('custom_css_code')