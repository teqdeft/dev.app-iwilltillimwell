@include('emails.users.inc.email-header')

<tr>
    <td style="padding:0 30px">
        <h1 style="color:#000;font-size:18px;margin-top:30px">
            Subscription Renewal Reminder
        </h1>
    </td>
</tr>

<tr>
    <td style="padding:0 30px">
        <p style="font-size:15px;line-height:24px;margin:10px 0 10px">
            Dear <span style="color:#683e95;font-weight:700;">
                {{ ucfirst($order['user_name']) }}
            </span>,
        </p>

        <p style="font-size:15px; line-height:24px; margin:0 0 20px">
			
			Your <span style="color:#683e95;font-weight:700;">{{ $order['packag_name'] }}</span> package subscription is scheduled for automatic renewal in {{ $daysLeft }} {{ $daysLeft == 1 ? 'day' : 'days' }}. No action is required from your side, and your access will continue seamlessly.
        </p>

        <table style="margin:20px 0;border-collapse:collapse; border-bottom: 1px solid gray; border-top: 1px solid gray;">
            
            <tr>
                <td style="padding:10px 0 2px;font-size:14px;">Package Name :-</td>
                <td style="padding:10px 0 2px 20px;font-size:15px;color:#683e95;font-weight:700;">
                    {{ $order['packag_name'] }}
                </td>
            </tr>

            <tr>
                <td style="padding:2px 0;font-size:14px;">Auto Renewal Date :-</td>
                <td style="padding:2px 0 2px 20px;font-size:15px;color:#683e95;font-weight:700;">
                    {{ $order['subscription_end_date'] }}
                </td>
            </tr>

            <tr>
                <td style="padding:2px 0 10px;font-size:14px;">Time Remaining :-</td>
                <td style="padding:2px 0 10px 20px;font-size:15px;color:#683e95;font-weight:700;">
                    {{ $daysLeft }} {{ $daysLeft == 1 ? 'Day' : 'Days' }}
                </td>
            </tr>
        </table>

        <p style="font-size:15px;line-height:24px;margin:20px 0">Please ensure that sufficient balance is available in your card/account to avoid any interruption in service.</p>
		
        <p style="font-size:15px; line-height:24px; margin:20px 0;">If you have any questions or require further assistance, please feel free to reach out to our support team at <a href="mailto:support@iwilltilimwell.com" style="color:#683e95; font-weight:600; text-decoration:none;">support@iwilltilimwell.com</a>.</p>
		
        <p style="font-size:15px;line-height:24px;margin-top:30px; margin-bottom:50px">
            Regards,<br>
            <strong>Iwilltilimwell</strong>
        </p>
		
		
    </td>
</tr>

@include('emails.users.inc.email-footer')