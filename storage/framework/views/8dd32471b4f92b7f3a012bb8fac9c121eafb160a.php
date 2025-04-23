<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	Hello <?php echo e($data->name); ?>,
	<br>
	<p>Your enquiry has been assigned to <?php echo e($assign_user); ?></p>
	<br>
	<br>
	Best Regards,
	<br>
	<?php if(env("WEBSITENAME")==1): ?> 
		The World Gateway 
	<?php elseif(env("WEBSITENAME")==0): ?> 
		Rapidex Travels 
	<?php endif; ?>
</body>
</html>