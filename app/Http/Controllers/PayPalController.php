<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use App\Models\Plan;
use App\Services\PaymentService;

class PayPalController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function payForm()
    {
        return view('paypal.payment-form');
    }

    public function createFormPaypal()
    {
        return view('paypal.payment-form-ui');
    }

    /* ---------- Card Fields AJAX endpoints (kept for rollback) ---------- */

    public function createOrder(Request $request)
    {
        $total_price = $request->total_price;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => config('paypal.currency', 'USD'),
                    "value"         => $total_price,
                ],
            ]],
        ]);

        return response()->json($response);
    }

    public function captureOrder(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->orderID);

        if (($response['status'] ?? null) === 'COMPLETED') {
            $data['payment_response'] = $response;
            $data['payment_method']   = 'paypal';
            $this->paymentService->store($request, $data);
        }

        return response()->json($response);
    }

    /* ---------- Hosted Checkout (redirect flow) ---------- */

public function createPayment(Request $request)
{
    $backToCheckout = '/dashboard?action=change-plan&active-tab=payment&paymentmethodselection=true&paymode=paypal';

    // 1. Verify reCAPTCHA server-side
    $recaptchaToken = $request->input('g-recaptcha-response');
    if (!$recaptchaToken) {
        return redirect()->to($backToCheckout)
            ->withErrors(['paypal' => 'Please verify reCAPTCHA.']);
    }

    $secret = env('RECAPTCHA_SECRET_KEY');
    if ($secret) {
        $captchaCheck = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => $secret,
            'response' => $recaptchaToken,
            'remoteip' => $request->ip(),
        ])->json();

        if (!($captchaCheck['success'] ?? false)) {
            return redirect()->to($backToCheckout)
                ->withErrors(['paypal' => 'reCAPTCHA verification failed.']);
        }
    }

    // 2. Authenticated user
    $user = Auth::user();
    if (!$user) {
        return redirect('/login');
    }

    // 3. Resolve the chosen plan:
    //    prefer the form's plan_id (user's current UI choice from localStorage),
    //    fall back to $user->plan (last saved plan) only if no plan_id was posted.
    $requestedPlanId = $request->input('plan_id');
    $planId = $requestedPlanId ?: $user->plan;

    $planDetails = Plan::where('id', $planId)->first();
    if (!$planDetails) {
        return redirect('/dashboard?action=change-plan')
            ->withErrors(['paypal' => 'Selected plan not found.']);
    }

    // Price comes from the DB, NOT from the form. Form can only choose which plan.
    $optionalAmount = function_exists('GetPackageOptionalAmount') ? GetPackageOptionalAmount() : 0;
    $amount = number_format(((float) $planDetails->amount + (float) $optionalAmount), 2, '.', '');

    // 4. Create PayPal order
    try {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => config('paypal.currency', 'USD'),
                    "value"         => $amount,
                ],
                "description" => 'Plan: ' . $planDetails->name,
            ]],
            "application_context" => [
                "brand_name"  => config('app.name', 'IWillTillImWell'),
                "user_action" => "PAY_NOW",
                "return_url"  => route('paypal.success'),
                "cancel_url"  => route('paypal.cancel'),
            ],
        ]);
    } catch (\Throwable $e) {
        Log::error('PayPal createOrder failed: ' . $e->getMessage());
        return redirect()->to($backToCheckout)
            ->withErrors(['paypal' => 'Could not initiate PayPal payment. Please try again.']);
    }

    if (empty($response['id']) || empty($response['links'])) {
        Log::error('PayPal createOrder bad response: ' . json_encode($response));
        return redirect()->to($backToCheckout)
            ->withErrors(['paypal' => 'Could not initiate PayPal payment. Please try again.']);
    }

    // 5. Stash for return-trip verification
    session([
        'paypal_order_id' => $response['id'],
        'paypal_amount'   => $amount,
        'paypal_plan_id'  => $planId,
    ]);

    foreach ($response['links'] as $link) {
        if (($link['rel'] ?? null) === 'approve') {
            return redirect()->away($link['href']);
        }
    }

    return redirect()->to($backToCheckout)
        ->withErrors(['paypal' => 'PayPal did not return an approval link.']);
}

public function success(Request $request)
{
    $token = $request->query('token');
    if (!$token) {
        return redirect('/dashboard?action=change-plan')
            ->withErrors(['paypal' => 'Missing PayPal order token.']);
    }

    if (session('paypal_order_id') && session('paypal_order_id') !== $token) {
        Log::warning('PayPal success: token mismatch.');
        return redirect('/dashboard?action=change-plan')
            ->withErrors(['paypal' => 'PayPal order verification failed.']);
    }

    $processedKey = 'paypal-processed-' . $token;
    if (Cache::has($processedKey)) {
        session()->forget(['paypal_order_id', 'paypal_amount', 'paypal_plan_id']);
        return redirect('/dashboard')->with('success', 'Payment already completed.');
    }

    if (!Cache::add('paypal-lock-' . $token, true, 60)) {
        return redirect('/dashboard')->with('info', 'Payment is being processed.');
    }

    try {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($token);
    } catch (\Throwable $e) {
        Cache::forget('paypal-lock-' . $token);
        Log::error('PayPal capture failed: ' . $e->getMessage());
        return redirect('/dashboard?action=change-plan')
            ->withErrors(['paypal' => 'Payment capture failed.']);
    }

    $status = $response['status'] ?? null;

    if ($status === 'COMPLETED') {
        // Promote the chosen plan to $user->plan BEFORE PaymentService::store(),
        // so the subscription row records the plan the user actually paid for.
        $intentPlanId = session('paypal_plan_id');
        $user = Auth::user();
        if ($intentPlanId && $user && $user->plan != $intentPlanId) {
            $user->plan = $intentPlanId;
            $user->stripe_planid = $intentPlanId;
            $user->save();
        }

        try {
            $this->paymentService->store($request, [
                'payment_response' => $response,
                'payment_method'   => 'paypal',
            ]);
        } catch (\Throwable $e) {
            Log::error('PaymentService store failed: ' . $e->getMessage());
        }

        Cache::put($processedKey, true, now()->addHours(24));
        Cache::forget('paypal-lock-' . $token);
        session()->forget(['paypal_order_id', 'paypal_amount', 'paypal_plan_id']);

        return redirect('/dashboard')->with('success', 'Payment successful.');
    }

    Cache::forget('paypal-lock-' . $token);
    Log::warning('PayPal capture non-completed: ' . json_encode($response));

    return redirect('/dashboard?action=change-plan')
        ->withErrors(['paypal' => 'Payment was not completed.']);
}

    public function cancel(Request $request)
    {
        session()->forget(['paypal_order_id', 'paypal_amount']);
        return redirect('/dashboard?action=change-plan')
            ->with('info', 'Payment cancelled.');
    }
}