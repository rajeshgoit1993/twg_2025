<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1>Hello</h1>
		<p>Please Click the following link to reset your password <a href="{{url('/activates/'.$user->email.'/'.$code)}}">Reset Password</a></p>
	</body>
</html>