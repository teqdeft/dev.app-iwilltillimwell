<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout — Kurv</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://dev.iwilltilimwell.com/assets/dashboard/htmlv/assets/js/jquery-3.7.1.js"></script>

    {{-- Collect.js from NMI / Kurv — replaces raw card fields with hosted iframes --}}
    <script
        src="{{ $collectJsUrl }}"
        data-tokenization-key="{{ $publicKey }}"
        data-variant="inline"
        data-custom-css='{"color":"#1f2937","font-size":"15px"}'
        data-invalid-css='{"color":"#dc2626"}'
        data-placeholder-css='{"color":"#9ca3af"}'
    ></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

<div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Secure Checkout</h1>
        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-medium">🔒 PCI Compliant</span>
    </div>

    {{-- Order summary --}}
    <div class="bg-gray-50 rounded-xl p-4 mb-6">
        <div class="flex justify-between text-sm text-gray-600">
            <span>Order Total</span>
            <span class="font-semibold text-gray-800">$49.99</span>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-lg p-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
        @csrf
        <input type="hidden" name="amount" value="49.99">
        <input type="hidden" name="payment_token" id="payment_token">

        {{-- Cardholder info --}}
        <div class="grid grid-cols-2 gap-3 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">First Name</label>
                <input type="text" name="first_name" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="John">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Last Name</label>
                <input type="text" name="last_name" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Doe">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-600 mb-1">Email</label>
            <input type="email" name="email" required
                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="john@example.com">
        </div>

        {{-- Collect.js hosted card fields (no raw card data on your server) --}}
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-600 mb-1">Card Number</label>
            <div id="ccnumber"
                class="border border-gray-200 rounded-lg px-3 py-2.5 bg-white h-10">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Expiry Date</label>
                <div id="ccexp"
                    class="border border-gray-200 rounded-lg px-3 py-2.5 bg-white h-10">
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CVV</label>
                <div id="cvv"
                    class="border border-gray-200 rounded-lg px-3 py-2.5 bg-white h-10">
                </div>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-xs font-medium text-gray-600 mb-1">ZIP / Postal Code</label>
            <input type="text" name="zip"
                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="10001">
        </div>

        <button type="submit" id="submit-btn"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition-colors text-sm">
            Pay $49.99 Securely
        </button>

        <p class="text-center text-xs text-gray-400 mt-4">
            Powered by Kurv · Your card data is encrypted and never stored on our servers.
        </p>
    </form>
</div>

<script>
    // Wait for Collect.js to fully load before configuring
    window.addEventListener('load', function () {

        CollectJS.configure({
            variant: 'inline',
            styleSniffer: false,

            fields: {
                ccnumber: { 
                    selector: '#ccnumber', 
                    title: 'Card Number', 
                    placeholder: '•••• •••• •••• ••••' 
                },
                ccexp: { 
                    selector: '#ccexp',    
                    title: 'MM/YY',       
                    placeholder: 'MM/YY' 
                },
                cvv: { 
                    selector: '#cvv',      
                    title: 'CVV',         
                    placeholder: '•••' 
                },
            },

            callback: function (response) {
                document.getElementById('payment_token').value = response.token;
                document.getElementById('payment-form').submit();
            },

            validationCallback: function (field, status, message) {
                const el = document.getElementById(field);
                if (el) {
                    el.style.borderColor = status ? '#86efac' : '#fca5a5';
                }
            },
        });

    });

    document.getElementById('payment-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.textContent = 'Processing…';

        CollectJS.startPaymentRequest();
    });
</script>

</body>
</html>