<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KurvPaymentService
{
    protected string $apiUrl;
    protected string $securityKey;

    public function __construct()
    {
        $this->apiUrl      = config('kurv.api_url');
        $this->securityKey = config('kurv.security_key');
    }

    /**
     * Charge a credit card using a Collect.js payment token.
     */
    public function chargeWithToken(array $data): array
    {
        $payload = [
            'security_key' => $this->securityKey,
            'type'         => 'sale',          // authorize + capture
            'payment_token'=> $data['payment_token'],
            'amount'       => number_format((float) $data['amount'], 2, '.', ''),
            'currency'     => $data['currency'] ?? 'USD',
            'orderid'      => $data['order_id'],
            'first_name'   => $data['first_name'] ?? '',
            'last_name'    => $data['last_name']  ?? '',
            'email'        => $data['email']      ?? '',
            'address1'     => $data['address']    ?? '',
            'city'         => $data['city']       ?? '',
            'state'        => $data['state']      ?? '',
            'zip'          => $data['zip']        ?? '',
            'country'      => $data['country']    ?? 'US',
            'ipaddress'    => $data['ip']         ?? request()->ip(),
        ];

        Log::info('Kurv (NMI) charge request', ['order_id' => $data['order_id']]);

        try {
            $response = Http::timeout(30)
                ->asForm()
                ->post($this->apiUrl, $payload);

            parse_str($response->body(), $result);

            Log::info('Kurv (NMI) charge response', $result);

            return $result;
        } catch (\Throwable $e) {
            Log::error('Kurv (NMI) HTTP exception', ['error' => $e->getMessage()]);

            return [
                'response'     => '3',
                'responsetext' => 'Gateway connection failed: ' . $e->getMessage(),
                'response_code'=> '999',
            ];
        }
    }

    /**
     * Refund a previously settled transaction.
     */
    public function refund(string $transactionId, float $amount): array
    {
        $payload = [
            'security_key'   => $this->securityKey,
            'type'           => 'refund',
            'transactionid'  => $transactionId,
            'amount'         => number_format($amount, 2, '.', ''),
        ];

        $response = Http::timeout(30)->asForm()->post($this->apiUrl, $payload);
        parse_str($response->body(), $result);

        return $result;
    }

    /**
     * Void a pending / unsettled transaction.
     */
    public function void(string $transactionId): array
    {
        $payload = [
            'security_key'  => $this->securityKey,
            'type'          => 'void',
            'transactionid' => $transactionId,
        ];

        $response = Http::timeout(30)->asForm()->post($this->apiUrl, $payload);
        parse_str($response->body(), $result);

        return $result;
    }
}