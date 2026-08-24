<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KurvController;
use App\Http\Controllers\AuthorizeController;

/* PayPal Card-Fields AJAX (kept for rollback) */
Route::get('/paypal/create-form',    [PayPalController::class, 'createFormPaypal']);
Route::post('/paypal/create-order',  [PayPalController::class, 'createOrder']);
Route::post('/paypal/capture-order', [PayPalController::class, 'captureOrder']);

/* PayPal Hosted Checkout */
Route::middleware('auth')->group(function () {
    Route::post('paypal/payment', [PayPalController::class, 'createPayment'])->name('paypal.payment');
    Route::get('paypal/success',  [PayPalController::class, 'success'])->name('paypal.success');
    Route::get('paypal/cancel',   [PayPalController::class, 'cancel'])->name('paypal.cancel');
});

/* Kurv */
Route::get('/kurv/payment',           [KurvController::class, 'showForm'])->name('payment.form');
Route::post('/kurv/process',          [KurvController::class, 'process'])->name('payment.process');
Route::get('/kurv/success/{orderId}', [KurvController::class, 'success'])->name('payment.success');
Route::get('/kurv/failed',            [KurvController::class, 'failed'])->name('payment.failed');
Route::get('/kurv/payment/webhook',   [KurvController::class, 'webhook'])->name('kurv.payment.webhook');

/* Authorize.Net legacy custom-form endpoints (kept for rollback) */
Route::get('/authorize/payment',         [AuthorizeController::class, 'index']);
Route::post('/authorize/payment/charge', [AuthorizeController::class, 'charge']);
Route::post('/authorize/pay',            [AuthorizeController::class, 'pay']);

/* Authorize.Net Hosted Checkout (redirect flow) */
Route::middleware('auth')->group(function () {
    Route::post('authorize/initiate',                  [AuthorizeController::class, 'createPayment'])->name('authorize.payment');
    Route::match(['get','post'], 'authorize/success',  [AuthorizeController::class, 'success'])->name('authorize.success');
    Route::match(['get','post'], 'authorize/cancel',   [AuthorizeController::class, 'cancel'])->name('authorize.cancel');
});

Route::get('/google-map', [PaymentController::class, 'googleMap'])->name('google.map');