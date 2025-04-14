<!DOCTYPE html>
<html lang="en">
<head>
	@php
	    // Fetch website-related data from the WebsiteNameHelpers function
	    // This retrieves key information like social media links, contact details, etc.
	    $websiteData = getWebsiteData();
	@endphp

	<!-- Basic Meta Tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Page Title & SEO Meta -->
	<title>@yield("title", $websiteData['defaultTitle'])</title>
	<meta name="keywords" content="@yield('keywords', $websiteData['metaKeywords'])" />
	<meta name="description" content="@yield('desc', $websiteData['metaDescription'])" />
	<meta name="robots" content="index, follow">
	<meta name="author" content="{{ $websiteData['metaAuthor'] }}">

	<!-- csrf token -->
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<!-- Open Graph (Facebook, LinkedIn) -->
	<meta property="og:title" content="@yield('title', $websiteData['ogTitle'])">
	<meta property="og:description" content="@yield('desc', $websiteData['ogDescription'])">
	<meta property="og:image" content="@yield('ogImage', $websiteData['ogImage'])">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:image:alt" content="Find the best travel deals on flights, hotels, and holiday packages">

	<meta property="og:url" content="{{ url()->full() }}">
	<meta property="og:type" content="website">

	<!-- Twitter Card Meta -->
	<meta name="twitter:card" content="{{ $websiteData['logo'] }}">
	<meta name="twitter:title" content="@yield('title', $websiteData['twitterTitle'])">
	<meta name="twitter:description" content="@yield('desc', $websiteData['twitterDescription'])">
	<meta name="twitter:image" content="@yield('twitterImage', $websiteData['twitterImage'])">
	<meta name="twitter:site" content="@<?php echo $websiteData['twitter']; ?>">

	<!-- Canonical URL -->
	<link rel="canonical" href="{{ url()->full() }}">

	<!-- Alternate Language Versions -->
	<link rel="alternate" href="{{ url()->full() }}" hreflang="en-in">
	<link rel="alternate" href="{{ url()->full() }}" hreflang="x-default">

	<!-- Favicon & Apple Touch Icons -->
	<link rel="icon" href="{{ $websiteData['favicon'] }}" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ $websiteData['faviconApple'] }}">

	<!-- Structured Data (Schema.org) -->
	<script type="application/ld+json">
	{
	    "@context": "https://schema.org",
	    "@type": "Organization",
	    "name": "{{ $websiteData['metaAuthor'] }}",
	    "url": "{{ $websiteData['route'] }}",
	    "logo": "{{ $websiteData['logo'] }}",
	    "contactPoint": {
	        "@type": "ContactPoint",
	        "telephone": "{{ $websiteData['phone'] }}",
	        "contactType": "customer service"
	    }
	}
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	@if(!empty($websiteData['gtagId']))
	    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $websiteData['gtagId'] }}"></script>
	    <script>
	        window.dataLayer = window.dataLayer || [];
	        function gtag(){dataLayer.push(arguments);}
	        gtag('js', new Date());
	        gtag('config', '{{ $websiteData['gtagId'] }}');
	    </script>
	@endif

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

	<!-- Hidden inputs for APP_URL and CSRF token -->
    <input type="hidden" value="{{ url('/') }}" name="" id="APP_URL">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />

	<!-- Desktop-Mobile Fixed Header Starts -->
	@include('layouts.front.header.desktopMobileHeader')

	<!-- header error message -->
	<!-- <div class="dPageContainer">
		<div class="row">
			<div class="col-md-12">
				@if ($errors->any())
				<p class="danger error-msg-cont">
					@foreach($errors->all(':message') as $input_error)
						{{ $input_error }}
					@endforeach
				</p>
				@endif

				@if(Session('error'))
				<p class="danger error-msg-cont">
					{{ Session('error') }}
				</p>
				@endif

				@if(Session('success'))
				<p class="danger success-msg-cont">
					{{ Session('success') }}
				</p>
				@endif
			</div>
		</div>
	</div> -->

	<!-- User Login process -->
	@include('layouts.front.login')