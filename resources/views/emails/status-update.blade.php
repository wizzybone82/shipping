<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Update</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Hello {{ $name }},</h2>
    <p>We wanted to let you know that your shipping order <strong>#{{ $orderId }}</strong> has been updated.</p>
    <p><strong>New Status:</strong> {{ $status }}</p>
    <p><strong>Delivery Address:</strong> {{ $deliveryAddress }}, {{ $deliveryCity }}</p>
    <p>Thank you for choosing our services. If you have any questions, feel free to reach out to us.</p>
    <p>Best regards,<br>Your Shipping Team</p>
</body>
</html>
