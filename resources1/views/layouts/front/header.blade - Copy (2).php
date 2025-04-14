<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="index, follow" />
	<title>@yield("title")</title>
	<meta name="keywords" content="@yield('keywords')" />
	<meta name="description" content=" @yield('desc')" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
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
		<!-- <link rel="alternate" href="{{ url('?lang=hi') }}" hreflang="hi-in" /> -->
		<link rel="alternate" href="{{ url('/') }}" hreflang="x-default" />
		<input type="hidden" value="{{ url('/') }}" name="" id="APP_URL">

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118897981-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-118897981-1');
		</script>
	@endif
	
	<!--<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">-->
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" />

	<!-- front header CSS -->
	@include('layouts.front.header-css')
    
</head>

<body>

<style type="text/css">
.error-msg-cont {
	text-align: center;
	color: #fff;
	background-color: #d44646;
	padding: 12px 0;
}
.success-msg-cont {
	text-align: center;
	color: #fff;
	background-color: green;
	padding: 12px 0;
}
</style>

	<!-- Desktop-Mobile Fixed Header Starts -->
	@include('layouts.front.header.desktopMobileHeader')

		<!--<div id="page-wrapper">-->
		<!-- <div> Check-->
		<!--<header id="header">-->

		<!-- Error Message Starts -->
		<div>
			
			@if ($errors->any())
			<div class="dPageContainer">
				<div class="row">
					<div class="col-md-12">
						<p class="danger error-msg-cont">
							@foreach($errors->all(':message') as $input_error)
								{{ $input_error }}
							@endforeach
						</p>
					</div>
				</div>
			</div>
			@endif

			@if(Session('error'))
			<div class="dPageContainer">
				<div class="row">
					<div class="col-md-12">
						<p class="danger error-msg-cont">
							{{ Session('error') }}
						</p>
					</div>
				</div>
			</div>
			@endif

			@if(Session('success'))
			<div class="dPageContainer">
				<div class="row">
					<div class="col-md-12">
						<p class="danger success-msg-cont"> {{ Session('success') }} </p>
					</div>
				</div>
			</div>
			@endif
		</div>
		<!-- Error Message Ends -->
		
			<!--Logo starts-->

			<!--<div class="main-header">-->
			<!-- <div class="destop_test_exp">
				include('layouts.front.header.desktoplogo')
			</div>
			<div class="mobile_test_exp">
				include('layouts.front.header.mobilelogo')
				include('layouts.front.header.mobilebottombar')
			</div> -->
			<!--Logo ends-->
			
			<!-- User Login process starts -->
			@include('layouts.front.login')
			<!-- User Login process ends -->

		<!--</header>-->
	<!--Header Part End-->