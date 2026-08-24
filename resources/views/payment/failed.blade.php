<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Failed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-2xl shadow-lg max-w-md w-full p-8 text-center">
    <div class="text-5xl mb-4">❌</div>
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Payment Failed</h1>
    <p class="text-red-500 text-sm mb-4">{{ $error }}</p>
    @if($order_id)
        <p class="text-xs text-gray-400 mb-6">Reference: {{ $order_id }}</p>
    @endif
    <a href="{{ route('payment.form') }}" class="inline-block bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700">
        Try Again
    </a>
</div>
</body>
</html>