<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeNetService
{
    /* ---------- existing direct-charge method (untouched, kept for rollback) ---------- */
    public function charge($data)
    {
        $firstName = Auth::user()->first_name;
        $lastName  = Auth::user()->last_name;

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('services.authorize_net.login_id'));
        $merchantAuthentication->setTransactionKey(config('services.authorize_net.transaction_key'));

        $refId = uniqid('ref_', true);

        $cardNumber = preg_replace('/\D/', '', $data['card_number']);

        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($data['expiry']);
        $creditCard->setCardCode($data['cvv']);

        $payment = new AnetAPI\PaymentType();
        $payment->setCreditCard($creditCard);

        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber("INV-" . time());
        $order->setDescription("Payment About Package");

        $billTo = new AnetAPI\CustomerAddressType();
        $billTo->setFirstName($firstName);
        $billTo->setLastName($lastName);

        $transactionRequest = new AnetAPI\TransactionRequestType();
        $transactionRequest->setTransactionType("authCaptureTransaction");
        $transactionRequest->setAmount($data['amount']);
        $transactionRequest->setPayment($payment);
        $transactionRequest->setOrder($order);
        $transactionRequest->setBillTo($billTo);

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequest);

        $controller = new AnetController\CreateTransactionController(clone $request);
        $response = $controller->executeWithApiResponse($this->environment());

        return $this->formatResponse($response);
    }

    private function formatResponse($response)
    {
        if ($response && $response->getMessages()->getResultCode() == "Ok") {
            $tresponse = $response->getTransactionResponse();
            if ($tresponse && $tresponse->getMessages()) {
                return [
                    'status'         => true,
                    'transaction_id' => $tresponse->getTransId(),
                    'auth_code'      => $tresponse->getAuthCode(),
                    'message'        => $tresponse->getMessages()[0]->getDescription(),
                ];
            }
        }

        $error = "Transaction failed";
        if ($response && $response->getTransactionResponse() && $response->getTransactionResponse()->getErrors()) {
            $error = $response->getTransactionResponse()->getErrors()[0]->getErrorText();
        } elseif ($response && $response->getMessages()) {
            $error = $response->getMessages()->getMessage()[0]->getText();
        }

        return ['status' => false, 'error' => $error];
    }

    /* ---------- new methods for hosted-payment-page flow ---------- */

    /**
     * Request a form token to open the hosted payment page.
     * $data keys: amount, invoiceNumber, planName, returnUrl, cancelUrl
     */
    public function getHostedPaymentToken(array $data): array
    {
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('services.authorize_net.login_id'));
        $merchantAuthentication->setTransactionKey(config('services.authorize_net.transaction_key'));

        $order = new AnetAPI\OrderType();
        // invoiceNumber is our marker to look up the transaction on return.
        $order->setInvoiceNumber(substr($data['invoiceNumber'], 0, 20));
        $order->setDescription(substr('Plan: ' . ($data['planName'] ?? 'Subscription'), 0, 255));

        $billTo = new AnetAPI\CustomerAddressType();
        if (Auth::check()) {
            $billTo->setFirstName(Auth::user()->first_name ?? '');
            $billTo->setLastName(Auth::user()->last_name ?? '');
        }

        $transactionRequest = new AnetAPI\TransactionRequestType();
        $transactionRequest->setTransactionType("authCaptureTransaction");
        $transactionRequest->setAmount($data['amount']);
        $transactionRequest->setOrder($order);
        $transactionRequest->setBillTo($billTo);

        // Hosted payment settings
        $settings = [];

        $returnOptions = new AnetAPI\SettingType();
        $returnOptions->setSettingName("hostedPaymentReturnOptions");
        $returnOptions->setSettingValue(json_encode([
            "showReceipt"   => true,
            "url"           => $data['returnUrl'],
            "urlText"       => "Continue",
            "cancelUrl"     => $data['cancelUrl'],
            "cancelUrlText" => "Cancel",
        ]));
        $settings[] = $returnOptions;

        $buttonOptions = new AnetAPI\SettingType();
        $buttonOptions->setSettingName("hostedPaymentButtonOptions");
        $buttonOptions->setSettingValue(json_encode(["text" => "Pay"]));
        $settings[] = $buttonOptions;

        $orderOptions = new AnetAPI\SettingType();
        $orderOptions->setSettingName("hostedPaymentOrderOptions");
        $orderOptions->setSettingValue(json_encode([
            "show"         => true,
            "merchantName" => config('app.name', 'Merchant'),
        ]));
        $settings[] = $orderOptions;

        $paymentOptions = new AnetAPI\SettingType();
        $paymentOptions->setSettingName("hostedPaymentPaymentOptions");
        $paymentOptions->setSettingValue(json_encode([
            "cardCodeRequired" => true,
            "showCreditCard"   => true,
            "showBankAccount"  => false,
        ]));
        $settings[] = $paymentOptions;

        $billingAddressOptions = new AnetAPI\SettingType();
        $billingAddressOptions->setSettingName("hostedPaymentBillingAddressOptions");
        $billingAddressOptions->setSettingValue(json_encode([
            "show"     => true,
            "required" => false,
        ]));
        $settings[] = $billingAddressOptions;

        $securityOptions = new AnetAPI\SettingType();
        $securityOptions->setSettingName("hostedPaymentSecurityOptions");
        $securityOptions->setSettingValue(json_encode(["captcha" => false]));
        $settings[] = $securityOptions;

        $request = new AnetAPI\GetHostedPaymentPageRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setTransactionRequest($transactionRequest);
        foreach ($settings as $s) {
            $request->addToHostedPaymentSettings($s);
        }

        $controller = new AnetController\GetHostedPaymentPageController($request);
        $response = $controller->executeWithApiResponse($this->environment());

        if ($response && $response->getMessages()->getResultCode() == "Ok") {
            return [
                'status' => true,
                'token'  => $response->getToken(),
            ];
        }

        $error = 'Could not get hosted payment token';
        if ($response && $response->getMessages()) {
            $msgs = $response->getMessages()->getMessage();
            if (!empty($msgs)) {
                $error = $msgs[0]->getCode() . ': ' . $msgs[0]->getText();
            }
        }

        return ['status' => false, 'error' => $error];
    }

    /**
     * Look up a transaction by the invoiceNumber we stored on it.
     * Used after the hosted page redirects the user back.
     */
    public function getTransactionByInvoiceNumber(string $invoiceNumber): array
    {
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('services.authorize_net.login_id'));
        $merchantAuthentication->setTransactionKey(config('services.authorize_net.transaction_key'));

        $listRequest = new AnetAPI\GetUnsettledTransactionListRequest();
        $listRequest->setMerchantAuthentication($merchantAuthentication);

        $listController = new AnetController\GetUnsettledTransactionListController($listRequest);
        $listResponse = $listController->executeWithApiResponse($this->environment());

        if (!$listResponse || $listResponse->getMessages()->getResultCode() != "Ok") {
            $error = 'Could not list unsettled transactions';
            if ($listResponse && $listResponse->getMessages()) {
                $msgs = $listResponse->getMessages()->getMessage();
                if (!empty($msgs)) $error = $msgs[0]->getText();
            }
            return ['status' => false, 'error' => $error];
        }

        $transactions = $listResponse->getTransactions() ?: [];
        $foundTransId = null;

        foreach ($transactions as $tx) {
            if (method_exists($tx, 'getInvoiceNumber') && $tx->getInvoiceNumber() == substr($invoiceNumber, 0, 20)) {
                $foundTransId = $tx->getTransId();
                break;
            }
        }

        if (!$foundTransId) {
            return ['status' => false, 'error' => 'Transaction not found for invoiceNumber ' . $invoiceNumber];
        }

        // Pull full details
        $detailsRequest = new AnetAPI\GetTransactionDetailsRequest();
        $detailsRequest->setMerchantAuthentication($merchantAuthentication);
        $detailsRequest->setTransId($foundTransId);

        $detailsController = new AnetController\GetTransactionDetailsController($detailsRequest);
        $detailsResponse = $detailsController->executeWithApiResponse($this->environment());

        if (!$detailsResponse || $detailsResponse->getMessages()->getResultCode() != "Ok") {
            return ['status' => false, 'error' => 'Could not fetch transaction details'];
        }

        $tx = $detailsResponse->getTransaction();
        if (!$tx) {
            return ['status' => false, 'error' => 'Transaction details empty'];
        }

        $txStatus = $tx->getTransactionStatus();
        $approved = in_array($txStatus, [
            'capturedPendingSettlement',
            'settledSuccessfully',
            'authorizedPendingCapture',
        ]);

        return [
            'status'         => $approved,
            'transaction_id' => $tx->getTransId(),
            'auth_code'      => $tx->getAuthCode(),
            'amount'         => $tx->getSettleAmount() ?: $tx->getAuthAmount(),
            'tx_status'      => $txStatus,
            'message'        => $approved ? 'Payment captured' : ('Transaction status: ' . $txStatus),
        ];
    }

    private function environment()
    {
        return config('services.authorize_net.environment') == 'production'
            ? \net\authorize\api\constants\ANetEnvironment::PRODUCTION
            : \net\authorize\api\constants\ANetEnvironment::SANDBOX;
    }
}