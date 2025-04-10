<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php 
	    if ($file_type == 0) {
	        $subject = 'Reservation Voucher';
	    } elseif ($file_type == 1) {
	        $subject = 'TCS';
	    } elseif ($file_type == 2) {
	        $subject = 'Reservation Invoice';  
	    }
    ?>

    <p>Dear Guest,</p>
    <br>
    <p>Find attached the {{ $subject }} for your Trip</p>
    <br>
    <p>We wish you a pleasant journey</p>
    <br>
    <br>
    <p>Thanks and Regards</p>
    <br>
    <h3>{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</h3>
    
    @if(env("WEBSITENAME") == "1")
        <a href="http://www.theworldgateway.com">Theworldgateway.com</a>
    @else
        <a href="http://www.rapidextravels.com">rapidextravels.com</a>
    @endif
</body>
</html>