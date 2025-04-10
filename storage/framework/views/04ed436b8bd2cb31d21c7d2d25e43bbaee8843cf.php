<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <title>Error Page</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    
    <?php if(env("WEBSITENAME")==1): ?>
    <meta name="author" content="The World Gateway" />
        <link rel="canonical" href="<?php echo e(url()->full()); ?>" />
        <link rel="alternate" href="<?php echo e(url()->full()); ?>" hreflang="en-in" />
        <!--<link rel="alternate" href="<?php echo e(url('?lang=hi')); ?>" hreflang="hi-in" />-->
        <link rel="alternate" href="<?php echo e(url()->full()); ?>" hreflang="x-default" />
        <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141582107-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-141582107-1');
        </script>

    <?php elseif(env("WEBSITENAME")==0): ?>
    <meta name="author" content="Rapidex Travels" />
        <link rel="canonical" href="<?php echo e(url()->current()); ?>" />
        <link rel="alternate" href="<?php echo e(url('/')); ?>" hreflang="en-in" />
        <link rel="alternate" href="<?php echo e(url('?lang=hi')); ?>" hreflang="hi-in" />
        <link rel="alternate" href="<?php echo e(url('/')); ?>" hreflang="x-default" />
        <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118897981-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-118897981-1');
        </script>
    <?php endif; ?>
    
    <!--<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">-->
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <!-- Bootstrap 3.3.2 -->
    <!-- <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/bootstrap.min.css')); ?>" crossorigin="anonymous" /> -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!--common css-->
    <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/common.css')); ?>" />

    <!--header & footer css-->
    <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/header.css')); ?>" />

    <!--custom checkmark-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/custom-checkmark.css')); ?>" />

    <!--user login-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/user-login.css')); ?>" />

    <!--datepicker css-->
    <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/ui-datepicker.css')); ?>" />

    <!-- Font Awesome Icons -->
    <link rel="preload stylesheet" type="text/css" as="style" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous" />
    <!-- <link href="<?php echo e(asset('/resources/assets/frontend/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" /> -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/animate.min.css')); ?>" />

    <!-- google font -->
    <link rel="stylesheet" type="text/css" href='https://fonts.googleapis.com/css?family=Lato:300,400,700' crossorigin="anonymous" />

    <!-- Main Style 
    <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/style.css')); ?>" crossorigin="anonymous" />
    <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/style-2.css')); ?>" crossorigin="anonymous" />-->

    <!--slick css-->
    <link rel="preload stylesheet" type="text/css" as="style" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" crossorigin="anonymous" />

    <!--Testimonials Slick-->
    <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/slick/css/slick.css')); ?>" />
    <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/slick/css/slick-theme.css')); ?>" />
    
    <!--gateway css-->
    <link type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/gateway.css')); ?>" rel="stylesheet" />

    <!--scroll-to-top css-->
    <link type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/scroll-to-top.css')); ?>" rel="stylesheet" />

    <!--footer css-->
    <link type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/footer.css')); ?>" rel="stylesheet" />

    <!--Lazy-loading-images (to be check and remove from footer and try-->
    <!-- <script rel="preload" as="script" type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/lazy-loading.js")); ?>'></script> -->

    <!--Page Loader Script-->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/pace.min.js")); ?>' data-pace-options='{ "ajax": false }'></script>
    <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/page-loading.js")); ?>'></script> -->

    <!-- jquery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    
</head>

<body>

    <!-- D-M Fixed Header Starts -->
    <?php echo $__env->make('layouts.front.header.desktopMobileHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- D-M Fixed Header Ends -->

        <!--<div id="page-wrapper">-->
        <!-- <div> Check-->
        <!--<header id="header">-->

        <!-- Error Message Starts -->
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
            <?php echo $__env->make('layouts.front.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- User Login process ends -->

        <!--</header>-->
    <!--Header Part End-->