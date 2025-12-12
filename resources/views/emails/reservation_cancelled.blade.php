<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reservation Cancelled</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

<div style="max-width:600px; margin:auto; background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

    <h2 style="text-align:center; color:#E02E2E; margin-bottom:20px;">
        ❌ Reservation Cancelled
    </h2>

    <p style="font-size:16px;">
        Hi <strong>{{ $reservation->user->name }}</strong>,
    </p>

    <p style="font-size:16px;">
        Your reservation <strong>{{ $reservation->reservation_code }}</strong> has been cancelled.
    </p>

    <hr style="margin:20px 0;">

    <table style="width:100%; font-size:16px; line-height:1.6;">
        <tr>
            <td><strong>From:</strong></td>
            <td>{{ $reservation->trip->origin }}</td>
        </tr>

        <tr>
            <td><strong>To:</strong></td>
            <td>{{ $reservation->trip->destination }}</td>
        </tr>

        <tr>
            <td><strong>Original Trip Date:</strong></td>
            <td>
                {{ \Carbon\Carbon::parse($reservation->trip->departure_date)->format('F d, Y') }}
                at
                {{ \Carbon\Carbon::parse($reservation->trip->departure_time)->format('g:i A') }}
            </td>
        </tr>
    </table>

    <hr style="margin:20px 0;">

    @if($reservation->payment_intent_id)
        <p style="font-size:16px; color:#0A7C1F;">
            💵 A refund has been issued for your payment.
        </p>
    @else
        <p style="font-size:16px;">
            No payment was processed, so no refund is needed.
        </p>
    @endif

    <p style="font-size:16px; margin-top:20px;">
        We're sorry to see your trip cancelled. If you need help, feel free to contact us anytime.
    </p>

    <p style="text-align:center; font-size:14px; color:#777; margin-top:30px;">
        &copy; {{ date('Y') }} Bus Reservation System
    </p>

</div>

</body>
</html>
