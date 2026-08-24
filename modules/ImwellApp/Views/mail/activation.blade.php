<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $org->name }}</title>
</head>
<body style="margin:0;padding:0;background:#f4f5f7;font-family:'Open Sans','Helvetica Neue',Arial,sans-serif;">
    <div style="max-width:600px;margin:40px auto;background:#ffffff;border-radius:10px;overflow:hidden;
                box-shadow:0 4px 14px rgba(0,0,0,.07)">

        <div style="background:{{ $org->primary_color ?: '#994c8d' }};padding:28px;text-align:center;">
            @if($org->logoUrl())
                <img src="{{ $org->logoUrl() }}" alt="{{ $org->name }}"
                     style="max-height:60px;max-width:200px;background:#fff;border-radius:8px;padding:8px;">
            @endif
            <h1 style="color:#ffffff;font-size:20px;margin:14px 0 0;font-weight:600;">{{ $org->name }}</h1>
        </div>

        <div style="padding:30px 34px;color:#2f3440;">
            <p style="font-size:16px;margin:0 0 14px;">Hello {{ $memberName }},</p>

            <p style="line-height:1.65;font-size:14px;margin:0 0 18px;">
                Your {{ $org->name }} member account has been created. Click the button
                below to choose your password and activate your account.
            </p>

            <p style="text-align:center;margin:26px 0;">
                <a href="{{ $activationUrl }}"
                   style="display:inline-block;background:{{ $org->primary_color ?: '#994c8d' }};color:#ffffff;
                          text-decoration:none;padding:14px 30px;border-radius:8px;font-size:15px;font-weight:600;">
                    Activate my account
                </a>
            </p>

            <p style="line-height:1.65;font-size:13px;color:#6b7280;margin:0 0 18px;">
                If the button does not work, copy this link into your browser:<br>
                <a href="{{ $activationUrl }}" style="color:{{ $org->primary_color ?: '#994c8d' }};word-break:break-all;">
                    {{ $activationUrl }}
                </a>
            </p>

            <p style="line-height:1.65;font-size:13px;color:#6b7280;margin:0 0 18px;">
                This link can only be used once and expires in 14 days.
            </p>

            <div style="border-top:1px solid #eceef2;padding-top:18px;margin-top:22px;">
                <p style="line-height:1.65;font-size:13px;color:#6b7280;margin:0;">
                    After activating, you can sign in any time at<br>
                    <a href="{{ $orgUrl }}" style="color:{{ $org->primary_color ?: '#994c8d' }};">{{ $orgUrl }}</a>
                </p>
            </div>
        </div>

        <div style="background:{{ $org->primary_color ?: '#994c8d' }};padding:18px;text-align:center;">
            <p style="color:#ffffff;font-size:12px;margin:0;opacity:.92;">
                Questions? Email <a href="mailto:support@iwilltilimwell.com" style="color:#fff;">support@iwilltilimwell.com</a>
            </p>
        </div>
    </div>
</body>
</html>
