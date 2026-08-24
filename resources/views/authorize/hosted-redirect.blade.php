<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Redirecting to Authorize.Net…</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 100px; color: #444; }
        .spinner { display:inline-block; width:28px; height:28px; border:3px solid #ccc; border-top-color:#0d6efd; border-radius:50%; animation:spin 0.8s linear infinite; vertical-align:middle; margin-right:10px; }
        @keyframes spin { to { transform: rotate(360deg); } }
        button { padding:10px 20px; font-size:14px; margin-top:20px; }
    </style>
</head>
<body onload="document.getElementById('anet-form').submit();">
    <p><span class="spinner"></span> Redirecting to <strong>Authorize.Net</strong> to complete your payment…</p>

    <form id="anet-form" method="POST" action="{{ $hostedUrl }}">
        <input type="hidden" name="token" value="{{ $token }}">
        <noscript>
            <p>JavaScript is disabled. Click the button below to continue.</p>
            <button type="submit">Continue to Authorize.Net</button>
        </noscript>
    </form>
</body>
</html>