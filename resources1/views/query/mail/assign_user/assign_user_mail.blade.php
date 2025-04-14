<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	Hello {{ $data->name }},
	<br>
	<p>Your enquiry has been assigned to {{ $assign_user }}</p>
	<br>
	<br>
	Best Regards,
	<br>
	@if(env("WEBSITENAME")==1) 
		The World Gateway 
	@elseif(env("WEBSITENAME")==0) 
		Rapidex Travels 
	@endif
</body>
</html>