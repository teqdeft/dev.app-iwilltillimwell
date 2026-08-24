<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Services\AuthorizeNetService;
use App\Services\PaymentService;
use App\Models\Plan;

class AuthorizeController extends Controller
{
    protected $payment;
    protected $paymentService;

    public function __construct(AuthorizeNetService $payment, PaymentService $paymentService)
    {
        $this->payment = $payment;
        $this->paymentService = $paymentService;
    }

    /* ---------- existing legacy methods (untouched) ---------- */

    public function index(Request $request)
    {
        return view('authorize/payment-form');
    }

    public function pay(Request $request)
    {
        $recaptcha = $request->recaptcha;

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => env('RECAPTCHA_SECRET_KEY'),
            'response' => $recaptcha,
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();
        if (!($result['success'] ?? false)) {
            return response()->json(['error' => 'reCAPTCHA verification failed'], 422);
        }

        $request->validate([
            'amount'      => 'required|numeric|min:1',
            'card_number' => 'required',
            'expiry'      => 'required',
            'cvv'         => 'required',
        ]);

        $response_auth = response()->json($this->payment->charge($request->all()));
        if ($response_auth->original['status'] == 1) {
            $data['payment_response'] = $response_auth;
            $data['payment_method']   = 'authorize';
            $this->paymentService->store($request, $data);
        }

        return $response_auth;
    }

    /* ---------- new hosted-page flow ---------- */

    public function createPayment(Request $request)
    {
        $backToCheckout = '/dashboard?action=change-plan&active-tab=payment&paymentmethodselection=true&paymode=authorize';

        // 1. reCAPTCHA
        $recaptchaToken = $request->input('g-recaptcha-response');
        if (!$recaptchaToken) {
            return redirect()->to($backToCheckout)
                ->withErrors(['authorize' => 'Please verify reCAPTCHA.']);
        }

        $secret = env('RECAPTCHA_SECRET_KEY');
        if ($secret) {
            $check = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secret,
                'response' => $recaptchaToken,
                'remoteip' => $request->ip(),
            ])->json();

            if (!($check['success'] ?? false)) {
                return redirect()->to($backToCheckout)
                    ->withErrors(['authorize' => 'reCAPTCHA verification failed.']);
            }
        }

        // 2. User + plan
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        $requestedPlanId = $request->input('plan_id');
        $planId = $requestedPlanId ?: $user->plan;

        $planDetails = Plan::where('id', $planId)->first();
        if (!$planDetails) {
            return redirect('/dashboard?action=change-plan')
                ->withErrors(['authorize' => 'Selected plan not found.']);
        }

        $optionalAmount = function_exists('GetPackageOptionalAmount') ? GetPackageOptionalAmount() : 0;
        $amount = number_format(((float) $planDetails->amount + (float) $optionalAmount), 2, '.', '');

        // 3. Unique invoiceNumber (max 20 chars, used as our marker)
        $invoiceNumber = 'INV' . substr((string) time(), -7) . strtoupper(substr(uniqid(), -6));
        $invoiceNumber = substr($invoiceNumber, 0, 20);

        // 4. Get hosted-page token
        try {
            $tokenResult = $this->payment->getHostedPaymentToken([
                'amount'        => $amount,
                'invoiceNumber' => $invoiceNumber,
                'planName'      => $planDetails->name,
                'returnUrl'     => route('authorize.success'),
                'cancelUrl'     => route('authorize.cancel'),
            ]);
        } catch (\Throwable $e) {
            Log::error('Authorize.Net getHostedPaymentToken failed: ' . $e->getMessage());
            return redirect()->to($backToCheckout)
                ->withErrors(['authorize' => 'Could not initiate payment. Please try again.']);
        }

        if (!($tokenResult['status'] ?? false) || empty($tokenResult['token'])) {
            Log::error('Authorize.Net token error: ' . ($tokenResult['error'] ?? 'unknown'));
            return redirect()->to($backToCheckout)
                ->withErrors(['authorize' => 'Could not initiate payment: ' . ($tokenResult['error'] ?? '')]);
        }

        // 5. Stash for return verification
        session([
            'authorize_invoice_number' => $invoiceNumber,
            'authorize_plan_id'        => $planId,
            'authorize_amount'         => $amount,
        ]);

        // 6. Render auto-submit form to Authorize.Net's hosted page
        $hostedUrl = config('services.authorize_net.environment') == 'production'
            ? 'https://accept.authorize.net/payment/payment'
            : 'https://test.authorize.net/payment/payment';

        return view('authorize.hosted-redirect', [
            'token'     => $tokenResult['token'],
            'hostedUrl' => $hostedUrl,
        ]);
    }

    public function success(Request $request)
    {
        $invoiceNumber = session('authorize_invoice_number');
        if (!$invoiceNumber) {
            return redirect('/dashboard?action=change-plan')
                ->withErrors(['authorize' => 'No pending Authorize.Net payment found.']);
        }

        // Idempotency
        $processedKey = 'authorize-processed-' . $invoiceNumber;
        if (Cache::has($processedKey)) {
            session()->forget(['authorize_invoice_number', 'authorize_plan_id', 'authorize_amount']);
            return redirect('/dashboard')->with('success', 'Payment already completed.');
        }

        if (!Cache::add('authorize-lock-' . $invoiceNumber, true, 60)) {
            return redirect('/dashboard')->with('info', 'Payment is being processed.');
        }

        // Verify with Authorize.Net by invoiceNumber.
        // Retry a couple of times in case of brief settlement-list propagation delay.
        $txResult = ['status' => false, 'error' => 'unknown'];
        for ($i = 0; $i < 3; $i++) {
            try {
                $txResult = $this->payment->getTransactionByInvoiceNumber($invoiceNumber);
            } catch (\Throwable $e) {
                Log::error('Authorize.Net lookup failed: ' . $e->getMessage());
                $txResult = ['status' => false, 'error' => $e->getMessage()];
            }
            if ($txResult['status']) break;
            usleep(800000); // 0.8s
        }

        if (!($txResult['status'] ?? false)) {
            Cache::forget('authorize-lock-' . $invoiceNumber);
            Log::warning('Authorize.Net verify failed: ' . json_encode($txResult));
            return redirect('/dashboard?action=change-plan')
                ->withErrors(['authorize' => 'Payment verification failed.']);
        }

        // Verify the amount matches what we created
        $expectedAmount = (float) session('authorize_amount');
        $actualAmount   = (float) ($txResult['amount'] ?? 0);
        if ($expectedAmount > 0 && abs($expectedAmount - $actualAmount) > 0.01) {
            Cache::forget('authorize-lock-' . $invoiceNumber);
            Log::warning("Authorize.Net amount mismatch. expected={$expectedAmount} got={$actualAmount}");
            return redirect('/dashboard?action=change-plan')
                ->withErrors(['authorize' => 'Payment amount verification failed.']);
        }

        // Promote plan + store subscription
        $intentPlanId = session('authorize_plan_id');
        $user = Auth::user();
        if ($intentPlanId && $user && $user->plan != $intentPlanId) {
            $user->plan = $intentPlanId;
            $user->stripe_planid = $intentPlanId;
            $user->save();
        }

        try {
            $this->paymentService->store($request, [
                'payment_response' => $txResult,
                'payment_method'   => 'authorize',
            ]);
        } catch (\Throwable $e) {
            Log::error('PaymentService store failed (authorize): ' . $e->getMessage());
        }

        Cache::put($processedKey, true, now()->addHours(24));
        Cache::forget('authorize-lock-' . $invoiceNumber);
        session()->forget(['authorize_invoice_number', 'authorize_plan_id', 'authorize_amount']);

        return redirect('/dashboard')->with('success', 'Payment successful.');
    }

    public function cancel(Request $request)
    {
        session()->forget(['authorize_invoice_number', 'authorize_plan_id', 'authorize_amount']);
        return redirect('/dashboard?action=change-plan')
            ->with('info', 'Payment cancelled.');
    }
}