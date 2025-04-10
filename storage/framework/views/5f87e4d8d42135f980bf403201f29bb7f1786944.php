<?php $__env->startSection('keywords', CustomHelpers::theme_data($theme_name,'theme_key')); ?>
<?php $__env->startSection('desc', CustomHelpers::theme_data($theme_name,'theme_desc')); ?>
<?php $__env->startSection('title', CustomHelpers::theme_data($theme_name,'title')); ?>
<?php $__env->startSection('content'); ?>

<!--Package Theme css-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/packagetheme.css')); ?>" />

<style>
.dThemeBG {
	/*background-image: linear-gradient(rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0.5)), url("resources/assets/frontend/img/banner-2.jpg") !important;*/
	background-image: linear-gradient(rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0.5)), url(<?php echo e(url('/public/uploads/theme/'.CustomHelpers::theme_data($theme_name,'theme_image'))); ?>);
	/*background-image: linear-gradient(#065AF3, #53b2fe) !important;*/
	background-position: center;
	/*background-attachment: fixed;*/
	/*background-size: cover;*/
	background-size: 100% 300px;
	background-repeat: no-repeat;
	position: relative;
	min-height: 300px;
	}
.dThemeHdCont {
	position: absolute;
	top: 40%;
	width: 85%;
	text-align: center;
	/*display: flex;
    justify-content: center;
    align-items: center;*/
	}
</style>

<!--Front Page Domestic & International Packages-->
<!--Breadcrumbs-->
<!--<div class="container d-none">
	<div class="row">
		<div class="col-md-12">
			<div class="packagelist_head">
				<ul class="breadcrumbs ">
					<li><a href="<?php echo e(url('/')); ?>">Home /</a></li>
					<li class="active" Style="text-transform: capitalize;"><?php echo e($theme_name); ?> <span Style="text-transform: lowercase;">tour packages</span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>-->
<section>
<div class="destop_test_exp">
	<?php echo $__env->make('packages.theme.dTheme', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="mobile_test_exp">
	<?php echo $__env->make('packages.theme.mTheme', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="testing">
 <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="testvalue">
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
		$("#add_more_theme").click(function(){  
	   var custom_length=$(".custom_length").length;
	   var theme_name=$(".theme_name").html();
	   var id =$("input[name='pack_id_list[]']")
			.map(function(){return $(this).val();}).get();
	   var APP_URL=$("#testvalue").val();
	   var url=APP_URL+'/add_theme';  
	   var data={custom_length:custom_length,id:id,theme_name:theme_name,_token:"<?php echo e(csrf_token()); ?>"};
			  $.post(url,data,function(rdata) {
			  //console.log(rdata)
			  $("#dynamic_theme_add").append(rdata)
			  })
		})
</script>      
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>