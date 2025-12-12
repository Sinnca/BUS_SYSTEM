<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reservation Confirmed</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

<div style="max-width:600px; margin:auto; background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

    <h2 style="text-align:center; color:#2C7BE5; margin-bottom:20px;">
        🎉 Reservation Confirmed!
    </h2>

    <p style="font-size:16px;">
        Hi <strong>{{ $reservation->user->name }}</strong>,
    </p>

    <p style="font-size:16px;">
        Your reservation <strong>{{ $reservation->reservation_code }}</strong> has been successfully confirmed.
    </p>

    <hr style="margin:20px 0;">

    <table style="width:100%; font-size:16px; line-height:1.6;">
        <tr>
            <td><strong>Total Amount:</strong></td>
            <td>₱{{ number_format($reservation->total_price, 2) }}</td>
        </tr>

        <tr>
            <td><strong>Departure:</strong></td>
            <td>{{ $reservation->trip->origin }}</td>
        </tr>

        <tr>
            <td><strong>Arrival:</strong></td>
            <td>{{ $reservation->trip->destination }}</td>
        </tr>

        <tr>
            <td><strong>Date:</strong></td>
            <td>
                {{ \Carbon\Carbon::parse($reservation->trip->departure_date)->format('F d, Y') }}
                at
                {{ \Carbon\Carbon::parse($reservation->trip->departure_time)->format('g:i A') }}
            </td>
        </tr>
    </table>

    <hr style="margin:20px 0;">

    <p style="font-size:16px;">
        Thank you for using our <strong>Bus Reservation System</strong>!
    </p>

    <p style="text-align:center; font-size:14px; color:#777; margin-top:30px;">
        &copy; {{ date('Y') }} Bus Reservation System
    </p>

</div>

</body>
</html>
