<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	    // Fetch website-related data from the WebsiteNameHelpers function
	    // This retrieves key information like social media links, contact details, etc.
	    $websiteData = getWebsiteData();
	 ?>

	<!-- Basic Meta Tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Page Title & SEO Meta -->
	<title><?php echo $__env->yieldContent("title", $websiteData['defaultTitle']); ?></title>
	<!-- <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', $websiteData['metaKeywords']); ?>" />
	<meta name="description" content="<?php echo $__env->yieldContent('desc', $websiteData['metaDescription']); ?>" /> -->
	<meta name="robots" content="noindex, nofollow">
	<meta name="author" content="<?php echo e($websiteData['metaAuthor']); ?>">

	<!-- csrf token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
	<!-- <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" /> -->

	<!-- Open Graph (Facebook, LinkedIn) -->
	<meta property="og:title" content="<?php echo $__env->yieldContent('title', $websiteData['ogTitle']); ?>">
	<meta property="og:description" content="<?php echo $__env->yieldContent('desc', $websiteData['ogDescription']); ?>">
	<meta property="og:image" content="<?php echo $__env->yieldContent('ogImage', $websiteData['ogImage']); ?>">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:image:alt" content="Find the best travel deals on flights, hotels, and holiday packages">

	<meta property="og:url" content="<?php echo e(url()->full()); ?>">
	<meta property="og:type" content="website">

	<!-- Twitter Card Meta -->
	<meta name="twitter:card" content="<?php echo e($websiteData['logo']); ?>">
	<meta name="twitter:title" content="<?php echo $__env->yieldContent('title', $websiteData['twitterTitle']); ?>">
	<meta name="twitter:description" content="<?php echo $__env->yieldContent('desc', $websiteData['twitterDescription']); ?>">
	<meta name="twitter:image" content="<?php echo $__env->yieldContent('twitterImage', $websiteData['twitterImage']); ?>">
	<meta name="twitter:site" content="@<?php echo $websiteData['twitter']; ?>">

	<!-- Canonical URL -->
	<link rel="canonical" href="<?php echo e(url()->full()); ?>">

	<!-- Alternate Language Versions -->
	<link rel="alternate" href="<?php echo e(url()->full()); ?>" hreflang="en-in">
	<link rel="alternate" href="<?php echo e(url()->full()); ?>" hreflang="x-default">

	<!-- Favicon & Apple Touch Icons -->
	<link rel="icon" href="<?php echo e($websiteData['favicon']); ?>" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e($websiteData['faviconApple']); ?>">

	<!-- Structured Data (Schema.org) -->
	<script type="application/ld+json">
	{
	    "@context": "https://schema.org",
	    "@type": "Organization",
	    "name": "<?php echo e($websiteData['metaAuthor']); ?>",
	    "url": "<?php echo e($websiteData['route']); ?>",
	    "logo": "<?php echo e($websiteData['logo']); ?>",
	    "contactPoint": {
	        "@type": "ContactPoint",
	        "telephone": "<?php echo e($websiteData['phone']); ?>",
	        "contactType": "customer service"
	    }
	}
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<?php if(!empty($websiteData['gtagId'])): ?>
	    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($websiteData['gtagId']); ?>"></script>
	    <script>
	        window.dataLayer = window.dataLayer || [];
	        function gtag(){dataLayer.push(arguments);}
	        gtag('js', new Date());
	        gtag('config', '<?php echo e($websiteData['gtagId']); ?>');
	    </script>
	<?php endif; ?>



	<!-- <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="index, follow" />
	<title><?php echo $__env->yieldContent("title"); ?></title>
	<meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>" />
	<meta name="description" content=" <?php echo $__env->yieldContent('desc'); ?>" />
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />	

	<meta name="author" content="<?php echo e($websiteData['metaAuthor']); ?>" />
	<link rel="canonical" href="<?php echo e(url()->full()); ?>" />
	<link rel="alternate" href="<?php echo e(url()->full()); ?>" hreflang="en-in" />
	<link rel="alternate" href="<?php echo e(url()->full()); ?>" hreflang="x-default" />
	<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL"> -->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <?php if($websiteData['gtagId']): ?>
	    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($websiteData['gtagId']); ?>"></script>
	    <script>
	        window.dataLayer = window.dataLayer || [];
	        function gtag(){dataLayer.push(arguments);}
	        gtag('js', new Date());
	        gtag('config', '<?php echo e($websiteData['gtagId']); ?>');
	    </script>
	<?php endif; ?> -->

	
	<!--<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">-->
	<!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" /> -->

	<!-- front header CSS -->
	<?php echo $__env->make('layouts.front.header-css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
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
    <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

	<!-- Desktop-Mobile Fixed Header Starts -->
	<?php echo $__env->make('layouts.front.header.desktopMobileHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- header error message -->
	<!-- <div class="dPageContainer">
		<div class="row">
			<div class="col-md-12">
				<?php if($errors->any()): ?>
				<p class="danger error-msg-cont">
					<?php $__currentLoopData = $errors->all(':message'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input_error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<?php echo e($input_error); ?>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</p>
				<?php endif; ?>

				<?php if(Session('error')): ?>
				<p class="danger error-msg-cont">
					<?php echo e(Session('error')); ?>

				</p>
				<?php endif; ?>

				<?php if(Session('success')): ?>
				<p class="danger success-msg-cont">
					<?php echo e(Session('success')); ?>

				</p>
				<?php endif; ?>
			</div>
		</div>
	</div> -->

	<!-- User Login process -->
	<?php echo $__env->make('layouts.front.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>