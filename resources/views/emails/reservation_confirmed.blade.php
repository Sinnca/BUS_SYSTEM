<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmed - MoveON</title>
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
                    <td style="background: linear-gradient(135deg, #2C7BE5 0%, #764ba2 100%); padding:40px 30px; text-align:center;">
                        <h1 style="margin:0; color:#ffffff; font-size:28px; font-weight:600;">🎉 Booking Confirmed!</h1>
                        <p style="margin:10px 0 0; color:#e0e7ff; font-size:16px;">Your journey with MoveON is all set!</p>
                    </td>
                </tr>

                <!-- Greeting -->
                <tr>
                    <td style="padding:30px 30px 20px;">
                        <p style="margin:0; font-size:18px; color:#2d3748;">Hi <strong style="color:#2C7BE5;">{{ $reservation->user->name }}</strong>,</p>
                        <p style="margin:15px 0 0; font-size:16px; color:#4a5568;">
                            Your bus reservation has been successfully confirmed. Here are the details of your trip:
                        </p>
                    </td>
                </tr>

                <!-- Reservation Code -->
                <tr>
                    <td style="padding:0 30px;">
                        <div style="background-color:#f7fafc; border-left:4px solid #2C7BE5; padding:20px; border-radius:8px; margin:10px 0;">
                            <p style="margin:0; font-size:14px; color:#718096; text-transform:uppercase; letter-spacing:0.5px;">Reservation Code</p>
                            <p style="margin:8px 0 0; font-size:24px; color:#2d3748; font-weight:700;">{{ $reservation->reservation_code }}</p>
                        </div>
                    </td>
                </tr>

                <!-- Trip Details -->
                <tr>
                    <td style="padding:30px 30px 20px;">
                        <h2 style="margin:0 0 20px; font-size:20px; color:#2d3748; font-weight:600;">📍 Trip Details</h2>

                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                            <tr>
                                <td style="padding:15px; background-color:#edf2f7; border-radius:8px;">
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
                                <td width="48%" style="padding:15px; background-color:#f7fafc; border-radius:8px;">
                                    <p style="margin:0; font-size:12px; color:#718096; text-transform:uppercase;">🗓️ Date & Time</p>
                                    <p style="margin:8px 0 0; font-size:16px; color:#2d3748; font-weight:600;">
                                        {{ $reservation->trip->formatted_date }}
                                    </p>
                                    <p style="margin:5px 0 0; font-size:14px; color:#4a5568;">
                                        Departure: {{ $reservation->trip->formatted_time }}
                                    </p>
                                </td>
                                <td width="4%"></td>
                                <td width="48%" style="padding:15px; background-color:#f7fafc; border-radius:8px;">
                                    <p style="margin:0; font-size:12px; color:#718096; text-transform:uppercase;">🚌 Bus Info</p>
                                    <p style="margin:8px 0 0; font-size:16px; color:#2d3748; font-weight:600;">{{ $reservation->trip->bus->bus_number }}</p>
                                    <p style="margin:5px 0 0; font-size:14px; color:#4a5568;">Seats: {{ $reservation->trip->bus->capacity }}</p>
                                    <p style="margin:3px 0 0; font-size:14px; color:#4a5568;">Type: {{ ucfirst($reservation->trip->bus->bus_type ?? 'Standard') }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Passenger & Seats -->
                <tr>
                    <td style="padding:0 30px 20px;">
                        <h2 style="margin:0 0 15px; font-size:20px; color:#2d3748; font-weight:600;">👥 Passenger Information</h2>
                        <table width="100%" cellpadding="10" cellspacing="0" style="background-color:#f7fafc; border-radius:8px;">
                            <tr>
                                <td style="font-size:14px; color:#718096;">Passengers</td>
                                <td style="font-size:14px; color:#2d3748; font-weight:600; text-align:right;">
                                    {{ $reservation->adults }} Adult(s)
                                    @if($reservation->children > 0), {{ $reservation->children }} Child(ren)@endif
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:14px; color:#718096;">Seat Numbers</td>
                                <td style="font-size:14px; color:#2d3748; font-weight:600; text-align:right;">
                                    @foreach($reservation->reservedSeats as $seat)
                                        {{ $seat->seat_number }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:14px; color:#718096;">Email</td>
                                <td style="font-size:14px; color:#2d3748; font-weight:600; text-align:right;">{{ $reservation->user->email }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Payment -->
                <tr>
                    <td style="padding:0 30px 30px;">
                        <div style="background: linear-gradient(135deg, #2C7BE5 0%, #764ba2 100%); padding:20px; border-radius:8px;">
                            <table width="100%">
                                <tr>
                                    <td style="color:#e0e7ff; font-size:16px;">Total Paid</td>
                                    <td style="color:#ffffff; font-size:28px; font-weight:700; text-align:right;">
                                        ₱{{ number_format($reservation->total_price,2) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 0 30px 30px;">
                        <div style="background-color: #fffbeb; border-left: 4px solid #f59e0b; padding: 20px; border-radius: 8px;">
                            <h3 style="margin: 0 0 10px; font-size: 16px; color: #92400e; font-weight: 600;">
                                ⚠️ Important Reminders
                            </h3>
                            <ul style="margin: 0; padding-left: 20px; color: #78350f; font-size: 14px; line-height: 1.8;">
                                <li>Please arrive at the terminal at least <strong>30 minutes before departure</strong></li>
                                <li>Bring a valid ID for verification</li>
                                <li>Present your reservation code: <strong>{{ $reservation->reservation_code }}</strong></li>
                                <li><strong>Cancellation Rules:</strong></li>
                                <ul style="margin: 5px 0 0 20px; list-style-type: disc;">
                                    <li>You <strong>cannot cancel</strong> this reservation if you booked it more than <strong>10 hours ago</strong> (Rule 1)</li>
                                    <li>You <strong>cannot cancel</strong> this reservation if the trip departs in <strong>10 hours or less</strong> (Rule 2)</li>
                                </ul>
                                <li>Contact us if you need assistance regarding your reservation</li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="padding:30px; background-color:#f7fafc; text-align:center; border-top:1px solid #e2e8f0;">
                        <p style="margin:0 0 10px; font-size:14px; color:#4a5568;">Need help? Contact us at
                            <a href="mailto:support@moveon.com" style="color:#2C7BE5; text-decoration:none;">support@moveon.com</a>
                        </p>
                        <p style="margin:0; font-size:12px; color:#718096;">&copy; {{ date('Y') }} MoveON. All rights reserved.</p>
                        <p style="margin:10px 0 0; font-size:12px; color:#a0aec0;">This is an automated email. Please do not reply.</p>
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
