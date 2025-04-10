<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>Dear Guest,</p>

<p>Find attached the reservation voucher for your Trip.</p>

<p>We wish you a pleasant journey.</p>
<p>Thanks and Regards</p>

<h3>{{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}}</h3>
@if(env("WEBSITENAME")=="1")
<a href="www.theworldgateway.com">Theworldgateway.com</a>
@else
<a href="www.rapidextravels.com">rapidextravels.com</a>
@endif
</body>
</html>