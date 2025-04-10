<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You for Your Enquiry</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f4f4f4">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="background-color: #ffffff; padding: 20px; text-align: center;">
                    <tr>
                        <td>
                            <h4 style="color: #333;">Hi {{ $query->name }}!</h4>
                            @php
                                $websiteData = getWebsiteData();
                            @endphp
                            <p style="font-size: 16px; color: #555; line-height: 1.6;">
                                Thank you for reaching out to <strong>{{ $websiteData['name'] }}</strong>!
                            </p>
                            <p style="font-size: 16px; color: #555; line-height: 1.6;">
                                We truly appreciate your interest. Your enquiry has been received, and our team is currently reviewing it. One of our travel consultants will get in touch with you shortly with further details.
                            </p>
                            <p style="font-size: 16px; color: #555; line-height: 1.6;">
                                In the meantime, feel free to explore our website for travel inspiration and exclusive offers.
                            </p>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tr>
                                    <td align="center" bgcolor="#008cff" style="border-radius: 5px;">
                                        <a href="{{ $websiteData['website_address'] }}" target="_blank"
                                           style="display: inline-block; font-size: 16px; color: #ffffff; text-decoration: none; background-color: #008cff; padding: 10px 20px; border-radius: 5px;">
                                           🔗 Visit Our Website
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <p class="footer" style="font-size: 14px; color: #777; margin-top: 20px;">
                                Warm regards,<br>
                                <strong>{{ $websiteData['name'] }} Team</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>