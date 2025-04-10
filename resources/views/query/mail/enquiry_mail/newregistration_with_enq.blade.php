<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Email</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#f4f4f4" style="background-color: #f4f4f4;">
        <tr>
            <td align="center">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" bgcolor="#ffffff" style="background-color: #ffffff; max-width: 600px; width: 100%; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;">
                    <tr>
                        <td align="center">
                            @php
                                $websiteData = getWebsiteData();
                            @endphp
                            <h2 style="font-family: Arial, sans-serif; color: #333; margin: 0;">Welcome, {{ $loginuser->first_name }}!</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial, sans-serif; color: #555; font-size: 16px; line-height: 1.6; padding: 20px;">
                            <p>We’re excited to have you onboard at <strong>{{ $websiteData['name'] }}</strong>!</p>
                            <p>Please complete your profile using the details below:</p>
                            <p><strong>🔗 Link:</strong> <a href="{{ url('/') }}" target="_blank" style="color: #008cff; text-decoration: none;">{{ url('/') }}</a></p>
                            <p><strong>📧 Login ID:</strong> {{ $query->email }}</p>
                            <p><strong>🔑 Temporary Password:</strong> <span style="font-weight: bold; color: #d9534f;">123456</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="{{ url('/') }}" target="_blank" style="display: inline-block; padding: 12px 20px; background: #008cff; color: #ffffff; text-decoration: none; font-size: 16px; border-radius: 5px;">Complete Your Profile</a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-family: Arial, sans-serif; color: #777; font-size: 14px; padding: 20px;">
                            <p>Best Wishes,<br><strong>{{ $websiteData['name'] }} Team</strong></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>