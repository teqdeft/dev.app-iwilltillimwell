<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-2xl shadow-lg max-w-md w-full p-8 text-center">
    <div class="text-5xl mb-4">✅</div>
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Payment Successful!</h1>
    <p class="text-gray-500 text-sm mb-6">Thank you, your transaction has been processed.</p>
    <div class="bg-gray-50 rounded-xl p-4 text-left text-sm space-y-2">
        <div class="flex justify-between"><span class="text-gray-500">Order ID</span> <span class="font-mono font-medium">{{ $payment->order_id }}</span></div>
        <div class="flex justify-between"><span class="text-gray-500">Transaction ID</span> <span class="font-mono">{{ $payment->transaction_id }}</span></div>
        <div class="flex justify-between"><span class="text-gray-500">Auth Code</span> <span>{{ $payment->auth_code }}</span></div>
        <div class="flex justify-between"><span class="text-gray-500">Amount</span> <span class="font-semibold">${{ number_format($payment->amount, 2) }}</span></div>
    </div>
</div>
</body>
</html>