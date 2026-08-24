@include('emails.users.inc.email-header')			
                <tr>
                    <td style="position: relative; padding: 0 30px;">
                        <h1 style="color:#000; font-size: 22px; margin-top: 30px;">Forgot your password?</h1>
                    </td>
                </tr>
                <tr>
                    <td style="position: relative; padding: 0 30px;">
                        <div class="helo" style="position: relative;">
                            <p style="font-size: 15px; line-height: 24px;">Hello</p>
                        </div>
                        <div class="account" style="position: relative;">
                            <p style="font-size: 15px; line-height: 24px;">You are receiving this email because we
                                received a password reset request for your
                                account.</p>
                        </div>
                        <div class="cta" style="position: relative; margin: 30px 0px 20px;">
                            <a href="{{ $url }}"
                                style="padding: 0px 40px; margin-right: 5px; height: 45px; font-size: 18px;	border-radius: 7px;	background:#683e95; border: 1px solid #683e95; color: #fff; display: block; width: max-content; text-decoration: none; line-height: 40px;">Reset
                                Password</a>
                        </div>
                        <div class="after-cta" style="position: relative;">
                            <p style="font-size: 15px; line-height: 24px;">This password reset link will expire in 60
                                min.<br> If you did not request a password
                                reset, no futher action is required.</p>
                        </div>
                        <div class="regards">
                            <p style="font-size: 15px; line-height: 24px;">Regards,<br> <strong> Iwilltilimwell</strong>
                            </p>
                        </div>
                        <div class="reset-pwe" style="margin: 25px 0 35px;">
                            <p style="font-size: 15px; line-height: 24px;">If you're having trouble clicking the
                                <span><a href="{{ $url }}"
                                        style="font-weight:600; color: #683E95; text-decoration: none;">"Reset
                                        Password"</a></span>
                                button, copy and paste the <span><a href="{{ $url }}"
                                        style="font-weight:600; color: #683E95; text-decoration: none;">{{ $url }}</a></span>
                                below into your
                                web Browser: <span><a href="#"
                                        style="font-weight:600; color: #683E95; text-decoration: none;">{{ $url }}</a></span>
                            </p>
                        </div>
                    </td>
                </tr>
				
@include('emails.users.inc.email-footer')
				
                