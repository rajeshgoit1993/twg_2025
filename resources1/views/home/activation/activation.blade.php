<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>Hello</h1>

<p>Please Click the following link to Activate your Account <a href="{{url('/activation/'.$user->email.'/'.$code)}}">Activate Account</a></p>
</body>
</html>