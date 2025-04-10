<!-- resources/views/auth/login_via_otp_verification.blade.php -->
<!-- <form action="/login_via_otp_verification" method="POST">
    @csrf
    <div>
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" id="otp" required>
    </div>
    <button type="submit">Verify OTP</button>
</form> -->


<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h2>OTP Verification</h2>

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <div>
            <label for="otp">Enter OTP:</label>
            <input type="text" name="otp" required>
        </div>

        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
