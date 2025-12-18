<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Cancelled - MoveON</title>
</head>
<body style="margin:0; padding:0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color:#f4f7fa;">

<!-- Email Container -->
<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f7fa; padding:40px 20px;">
    <tr>
        <td align="center">
            <!-- Main Card -->
            <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">

                <!-- Header -->
                <tr>
                    <td style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); padding:40px 30px; text-align:center;">
                        <h1 style="margin:0; color:#ffffff; font-size:28px; font-weight:600;">❌ Reservation Cancelled</h1>
                        <p style="margin:10px 0 0; color:#fecaca; font-size:16px;">Your booking has been cancelled</p>
                    </td>
                </tr>

                <!-- Greeting -->
                <tr>
                    <td style="padding:30px 30px 20px;">
                        <p style="margin:0; font-size:18px; color:#2d3748;">Hi <strong style="color:#dc2626;">{{ $reservation->user->name }}</strong>,</p>
                        <p style="margin:15px 0 0; font-size:16px; color:#4a5568;">
                            We're writing to confirm that your bus reservation has been successfully cancelled.
                        </p>
                    </td>
                </tr>

                <!-- Reservation Code -->
                <tr>
                    <td style="padding:0 30px;">
                        <div style="background-color:#fef2f2; border-left:4px solid #dc2626; padding:20px; border-radius:8px; margin:10px 0;">
                            <p style="margin:0; font-size:14px; color:#991b1b; text-transform:uppercase; letter-spacing:0.5px;">Cancelled Reservation</p>
                            <p style="margin:8px 0 0; font-size:24px; color:#2d3748; font-weight:700;">{{ $reservation->reservation_code }}</p>
                            <p style="margin:8px 0 0; font-size:14px; color:#7f1d1d;">
                                Cancelled on: {{ \Carbon\Carbon::parse($reservation->updated_at)->format('F j, Y \a\t g:i A') }}
                            </p>
                        </div>
                    </td>
                </tr>

                <!-- Trip Details -->
                <tr>
                    <td style="padding:30px 30px 20px;">
                        <h2 style="margin:0 0 20px; font-size:20px; color:#2d3748; font-weight:600;">📍 Cancelled Trip Details</h2>

                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                            <tr>
                                <td style="padding:15px; background-color:#f3f4f6; border-radius:8px;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%" style="vertical-align:top;">
                                                <p style="margin:0; font-size:12px; color:#718096; text-transform:uppercase;">From</p>
                                                <p style="margin:5px 0 0; font-size:18px; color:#2d3748; font-weight:600;">{{ $reservation->trip->origin }}</p>
                                            </td>
                                            <td width="50%" style="vertical-align:top; text-align:right;">
                                                <p style="margin:0; font-size:12px; color:#718096; text-transform:uppercase;">To</p>
                                                <p style="margin:5px 0 0; font-size:18px; color:#2d3748; font-weight:600;">{{ $reservation->trip->destination }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="48%" style="padding:15px; background-color:#f9fafb; border-radius:8px;">
                                    <p style="margin:0; font-size:12px; color:#718096; text-transform:uppercase;">🗓️ Original Date & Time</p>
                                    <p style="margin:8px 0 0; font-size:16px; color:#2d3748; font-weight:600;">
                                        {{ $reservation->trip->formatted_date }}
                                    </p>
                                    <p style="margin:5px 0 0; font-size:14px; color:#4a5568;">
                                        Departure: {{ $reservation->trip->formatted_time }}
                                    </p>
                                </td>
                                <td width="4%"></td>
                                <td width="48%" style="padding:15px; background-color:#f9fafb; border-radius:8px;">
                                    <p style="margin:0; font-size:12px; color:#718096; text-transform:uppercase;">👥 Passengers</p>
                                    <p style="margin:8px 0 0; font-size:16px; color:#2d3748; font-weight:600;">
                                        {{ $reservation->adults }} Adult(s)
                                        @if($reservation->children > 0)
                                            <br>{{ $reservation->children }} Child(ren)
                                        @endif
                                    </p>
                                    <p style="margin:5px 0 0; font-size:14px; color:#4a5568;">
                                        Seats:
                                        @foreach($reservation->reservedSeats as $seat)
                                            {{ $seat->seat_number }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

{{--                <!-- Refund Information -->--}}
{{--                <tr>--}}
{{--                    <td style="padding:0 30px 30px;">--}}
{{--                        @if($reservation->payment_status === 'paid')--}}
{{--                            <div style="background-color:#ecfdf5; border-left:4px solid #10b981; padding:20px; border-radius:8px; margin-bottom:20px;">--}}
{{--                                <h3 style="margin:0 0 10px; font-size:18px; color:#065f46; font-weight:600;">--}}
{{--                                    💵 Refund Information--}}
{{--                                </h3>--}}
{{--                                <p style="margin:0; font-size:14px; color:#047857; line-height:1.6;">--}}
{{--                                    A refund has been initiated for your payment of <strong>₱{{ number_format($reservation->total_price, 2) }}</strong>.--}}
{{--                                </p>--}}
{{--                                <p style="margin:10px 0 0; font-size:14px; color:#047857; line-height:1.6;">--}}
{{--                                    Please allow <strong>5-10 business days</strong> for the refund to be processed.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <div style="background-color:#f0f9ff; border-left:4px solid #3b82f6; padding:20px; border-radius:8px; margin-bottom:20px;">--}}
{{--                                <h3 style="margin:0 0 10px; font-size:18px; color:#1e40af; font-weight:600;">--}}
{{--                                    💳 Payment Information--}}
{{--                                </h3>--}}
{{--                                <p style="margin:0; font-size:14px; color:#1e3a8a; line-height:1.6;">--}}
{{--                                    No payment was processed for this reservation, so no refund is necessary.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        <!-- Original Amount -->
                        <div style="background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); padding:20px; border-radius:8px;">
                            <table width="100%">
                                <tr>
                                    <td style="color:#e5e7eb; font-size:16px;">Original Booking Amount</td>
                                    <td style="color:#ffffff; font-size:28px; font-weight:700; text-align:right;">
                                        ₱{{ number_format($reservation->total_price, 2) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>

                <!-- What Happens Next -->
                <tr>
                    <td style="padding:0 30px 30px;">
                        <div style="background-color:#eff6ff; border-left:4px solid #3b82f6; padding:20px; border-radius:8px;">
                            <h3 style="margin:0 0 10px; font-size:16px; color:#1e40af; font-weight:600;">
                                ℹ️ What Happens Next?
                            </h3>
                            <ul style="margin:0; padding-left:20px; color:#1e3a8a; font-size:14px; line-height:1.8;">
                                <li>Your seats have been released and are now available for other passengers</li>
                                @if($reservation->payment_status === 'paid')
                                    <li>You will receive a confirmation email once your refund is processed</li>
                                @endif
                                <li>You can book a new trip anytime by visiting our website</li>
                                <li>If you have any questions, our support team is here to help</li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <!-- Call to Action -->
                <tr>
                    <td style="padding:0 30px 30px; text-align:center;">
                        <p style="margin:0 0 20px; font-size:16px; color:#4a5568;">
                            We're sorry to see your trip cancelled. Ready to plan another journey?
                        </p>
                        <a href="{{ config('app.url') }}" style="display:inline-block; background-color:#2C7BE5; color:#ffffff; text-decoration:none; padding:14px 32px; border-radius:8px; font-size:16px; font-weight:600; box-shadow:0 4px 12px rgba(44, 123, 229, 0.4);">
                            Book a New Trip
                        </a>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="padding:30px; background-color:#f7fafc; text-align:center; border-top:1px solid #e2e8f0;">
                        <p style="margin:0 0 10px; font-size:14px; color:#4a5568;">
                            Need help? Contact us at
                            <a href="mailto:support@moveon.com" style="color:#2C7BE5; text-decoration:none;">support@moveon.com</a>
                        </p>
                        <p style="margin:0; font-size:12px; color:#718096;">
                            &copy; {{ date('Y') }} MoveON. All rights reserved.
                        </p>
                        <p style="margin:10px 0 0; font-size:12px; color:#a0aec0;">
                            This is an automated email. Please do not reply to this message.
                        </p>
                    </td>
                </tr>

            </table>
            <!-- End Main Card -->
        </td>
    </tr>
</table>
<!-- End Email Container -->

</body>
</html>
