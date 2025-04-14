<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="robots" content="noindex, nofollow" />
	<title>@yield("title")</title>
	<meta name="keywords" content="@yield('keywords')" />
	<meta name="description" content=" @yield('desc')" />
	
	@if(env("WEBSITENAME")==1)
	<meta name="author" content="The World Gateway" />
	<link rel="canonical" href="{{ url()->full() }}" />
	<link rel="alternate" href="{{ url()->full() }}" hreflang="en-in" />
	<!--<link rel="alternate" href="{{ url('?lang=hi') }}" hreflang="hi-in" />-->
	<link rel="alternate" href="{{ url()->full() }}" hreflang="x-default" />
	<input type="hidden" value="{{ url('/') }}" name="" id="APP_URL">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141582107-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-141582107-1');
	</script>
	
	@elseif(env("WEBSITENAME")==0)
	<meta name="author" content="Rapidex Travels" />
	<link rel="canonical" href="{{ url()->current() }}" />
	<link rel="alternate" href="{{ url('/') }}" hreflang="en-in" />
	<link rel="alternate" href="{{ url('?lang=hi') }}" hreflang="hi-in" />
	<link rel="alternate" href="{{ url('/') }}" hreflang="x-default" />
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118897981-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-118897981-1');
	</script>
@endif
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<input type="hidden" name="_token" value="{!! csrf_token() !!}" />

<!-- Bootstrap 3.3.2 -->
<link href="{{ asset('/resources/assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Font Awesome Icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
{{--<link href="{{ asset('/resources/assets/frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />--}}
<link href="{{ asset('/resources/assets/frontend/css/animate.min.css') }}" rel="stylesheet" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type="text/css" />

<!-- Current Page Styles -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/components/revolution_slider/css/settings.css') }}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/components/revolution_slider/css/style.css') }}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/components/jquery.bxslider/jquery.bxslider.css') }}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/components/flexslider/flexslider.css') }}" media="screen" />
<link id="main-style" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style.css') }}" />
<link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css" />

<!-- Main Style -->
<link id="main-style" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style.css') }}" />
<link id="main-style" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style-2.css') }}" />

<!-- Updated Styles -->
<link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/updates.css') }}" />

<!-- Custom Styles -->
<link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/custom.css') }}" />

<!-- Responsive Styles -->
<link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/responsive.css') }}" />
<link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/responsive-2.css') }}" />
<link href="{{ asset('/resources/assets/frontend/css/bootstrap-formhelpers.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/resources/assets/frontend/css/bootstrap-validator.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" rel="stylesheet" />

<!--calender css start-->
<!--<link rel="stylesheet" href="{{ asset("/resources/assets/frontend/css/fullcalendar.css") }}">-->
<link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/fullcalendar.min.css') }}" />

<!--calender css end-->
<link rel="stylesheet" href="{{ asset('/resources/assets/slick/css/slick.css') }}" />
<link rel="stylesheet" href="{{ asset('/resources/assets/slick/css/slick-theme.css') }}" />
<link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style_nex.css') }}" />

<!--slick css-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!--header & footer css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/header.css') }}" />

<!--common css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/common.css') }}" />
</head>

<body>
	<input type="hidden" id="base_url" value="{{ url('/')}}">
		<div id="page-wrapper">
			<header id="header" class="navbar-static-top" style="margin: 0px;">
			<?php
				$something=$errors->all();
				if(!empty($something)):
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="danger" style="text-align: center;color: #fff;background: #d44646;padding: 12px 0px;">
						@foreach($errors->all(':message') as $input_error)
						{{ $input_error }}
						@endforeach
						</p>
					</div>
				</div>
			</div>
			<?php
			endif;
			?>
			@if(Session('error'))
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="danger" style="text-align: center;color: #fff;background: #d44646; padding: 12px 0px;"> {{ Session('error') }} </p>
					</div>
				</div>
			</div>
			@endif
			@if(Session('success'))
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="danger" style="text-align: center;color: #fff;background: green; padding: 12px 0px;"> {{ Session('success') }} </p>
					</div>
				</div>
			</div>
			@endif
			<!--Logo starts-->
			<div class="main-header">
				<div class="destop_test_exp">
				@include('layouts.front.logo.desktoplogo')
				</div>
				<div class="mobile_test_exp">
				@include('layouts.front.logo.mobilelogo')
				@include('layouts.front.logo.mobilebottombar')
				</div>
			</div>
			<!--Logo ends-->
			
			<!--Login process starts-->
			@include('layouts.front.login')
			<!--Login process ends-->
			</header>
			<!-- Header Part End  -->