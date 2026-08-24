<?php
return [
    'security_key' => env('KURV_SECURITY_KEY'),
    'api_url'      => env('KURV_API_URL', 'https://secure.nmi.com/api/transact.php'),
    'collect_js'   => env('KURV_COLLECT_JS_URL', 'https://secure.nmi.com/token/Collect.js'),
    'sandbox'      => env('KURV_SANDBOX', true),
];