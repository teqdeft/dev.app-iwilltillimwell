<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\KurvPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct(protected KurvPaymentService $kurv) {}

    /** Show the payment form */
    public function showForm()
    {
        return view('payment.form', [
            'collectJsUrl' => config('kurv.collect_js'),
            'publicKey'    => config('kurv.security_key'), // tokenization key
        ]);
    }

    /** Process payment after Collect.js tokenises the card */
    public function process(Request $request)
    {
        $request->validate([
            'payment_token' => ['required', 'string'],
            'amount'        => ['required', 'numeric', 'min:0.01'],
            'first_name'    => ['required', 'string', 'max:100'],
            'last_name'     => ['required', 'string', 'max:100'],
            'email'         => ['required', 'email'],
            'zip'           => ['nullable', 'string', 'max:20'],
        ]);

        $orderId = 'ORD-' . strtoupper(Str::random(10));

        $result = $this->kurv->chargeWithToken([
            'payment_token' => $request->payment_token,
            'amount'        => $request->amount,
            'order_id'      => $orderId,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'zip'           => $request->zip,
            'ip'            => $request->ip(),
        ]);

        // NMI: response=1 means success, response=2 means declined, response=3 means error
        $status = match($result['response'] ?? '3') {
            '1'     => 'success',
            '2'     => 'declined',
            default => 'failed',
        };

        $payment = Payment::create([
            'order_id'       => $orderId,
            'amount'         => $request->amount,
            'currency'       => 'USD',
            'status'         => $status,
            'transaction_id' => $result['transactionid']  ?? null,
            'auth_code'      => $result['authcode']       ?? null,
            'response_code'  => $result['response_code']  ?? null,
            'response_text'  => $result['responsetext']   ?? null,
            'cardholder_name'=> $request->first_name . ' ' . $request->last_name,
            'email'          => $request->email,
            'raw_response'   => $result,
        ]);

        if ($status === 'success') {
            return redirect()->route('payment.success', $payment->order_id);
        }

        return redirect()->route('payment.failed')->with([
            'error'    => $result['responsetext'] ?? 'Payment failed.',
            'order_id' => $orderId,
        ]);
    }

    public function success(string $orderId)
    {
        $payment = Payment::where('order_id', $orderId)->firstOrFail();
        return view('payment.success', compact('payment'));
    }

    public function googleMap() {

        return view('payment.google-map');
    }

    public function failed()
    {
        return view('payment.failed', [
            'error'    => session('error', 'Payment was not completed.'),
            'order_id' => session('order_id'),
        ]);
    }

    public function webhook(){

        
        return response()->json([
            'status' => true,
            'message' => 'WebHook Succesfully Updated'
        ]);

    }
}