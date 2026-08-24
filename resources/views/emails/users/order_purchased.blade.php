@include('emails.users.inc.email-header')
	<tr>
    <td style="padding:0 30px">
        <h1 style="color:#000;font-size:18px;margin-top:30px">
            Payment Confirmation
        </h1>
    </td>
</tr>

<tr>
    <td style="padding:0 30px">
        <p style="font-size:15px;line-height:24px;margin:10px 0 10px">
			Hello <span style="color:#683e95;font-weight:700;">{{$order['user_name']}}</span>,
		</p>

        <p style="font-size:15px; line-height:24px; margin:0 0 20px">
            Thank you for your payment. We are pleased to confirm that your purchase of the
            <span style="color:#683e95;font-weight:700;">{{$order['packag_name']}}</span> package
            has been successful.
        </p>

        <table style="margin:20px 0;border-collapse:collapse; border-bottom: 1px solid gray; border-top: 1px solid gray;">
            <tr>
                <td style="padding:10px 0 2px;font-size:14px;">Package:</td>
                <td style="padding:10px 0 2px 20px;font-size:15px;color:#683e95;font-weight:700;">
					{{$order['packag_name']}}
                </td>
            </tr>
            <tr>
                <td style="padding:2px 0;font-size:14px;">Amount:</td>
                <td style="padding:2px 0 2px 20px;font-size:15px;color:#683e95;font-weight:700; display: inline-flex;">
                    <span style="font-size:17px;">$</span>{{$order['package_price']}}
                </td>
            </tr>
			@if($order['optional_amount']) 
				
				<tr>
					<td style="padding:2px 0;font-size:14px;">Add-ons:</td>
					<td style="padding:2px 0 2px 20px;font-size:15px;color:#683e95;font-weight:700; display: inline-flex;">
						<span style="font-size:17px;">$</span>{{$order['optional_amount']}}
					</td>
				</tr>
				
				<tr>
					<td style="padding:2px 0;font-size:14px;">Total:</td>
					<td style="padding:2px 0 2px 20px;font-size:15px;color:#683e95;font-weight:700; display: inline-flex;">
						<span style="font-size:17px;">$</span>{{$order['package_price']+$order['optional_amount']}}
					</td>
				</tr>
			
			@endif 
			
			
            <tr>
                <td style="padding:2px 0;font-size:14px;">Date:</td>
                <td style="padding:2px 0 2px 20px;font-size:15px;color:#683e95;font-weight:700;">
                   {{$order['package_purchase_date']}}
                </td>
            </tr>
            <tr>
                <td style="padding:2px 0 10px;font-size:14px;">Time:</td>
                <td style="padding:2px 0 10px 20px;font-size:15px;color:#683e95;font-weight:700;">
                     {{$order['package_purchase_time']}}
                </td>
            </tr>
        </table>

        <p style="font-size:15px;line-height:24px;margin:20px 0">
			Your subscription will automatically renew on <span style="color:#683e95;font-weight:700;">{{$order['subscription_end_date']}}</span>
        </p>

        <p style="font-size:15px;line-height:24px;margin-top:30px; margin-bottom:50px">
            Regards,<br>
            <strong>Iwilltilimwell</strong>
        </p>
    </td>
</tr>
	
@include('emails.users.inc.email-footer')