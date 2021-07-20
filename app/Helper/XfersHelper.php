<?php

namespace App\Helper;

use Illuminate\Support\Facades\Http;

class XfersHelper {

    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const BASE_URL = 'https://sandbox-id.xfers.com/api/v4/payments/';
    const DEFAULT_HEADERS = [
        'Accept' => 'application/vnd.api+json',
        'Content-Type' => 'application/vnd.api+json'
    ];

    private function generateDefaultHttpObject() {
        return Http::withBasicAuth(
                env('XFERS_USERNAME',''), env('XFERS_PASSWORD', ''))
            ->withHeaders(self::DEFAULT_HEADERS);
    }

    private function executeWithResponseValidation($method, $url, $payload = null) {
        $response = $this->executeRequest($method, $url, $payload);
        return $this->validateResponse($response);
    }

    private function executeRequest($method, $url, $payload = null) {
        if ($method == self::METHOD_GET)
            return $this->generateDefaultHttpObject()->get($url);
        elseif ($method == self::METHOD_POST)
            return $this->generateDefaultHttpObject()->post($url, $payload);
    }

    private function validateResponse($response) {
        $responseData = json_decode($response->body(), true);
        if ($response->failed()) {
            $status = 'Failed';
            if ($response->clientError()) {
                if (array_key_exists('errors', $responseData)) {
                    $error_message = 'Errors Found -';
                    foreach ($responseData['errors'] as $error) {
                        $error_message .= ' "' . $error['title'] . '",';
                    }
                    $error_message = substr($error_message, 0, -1);
                } else
                    $error_message = 'Unknown Client Error';
            } elseif ($response->serverError())
                $error_message = 'Server Error';
            else
                $error_message = 'Unknown Error';
        } elseif ($response->successful())
            $status = 'Success';

        return [
            'status' => $status,
            'errors' => $status == 'Failed' ? [
                'code' => $response->status(),
                'message' => $error_message
            ] : null,
            'data' => $responseData
        ];
    }

    // Function to simulate payment (only works on sandbox version)
    public static function simulatePayment($id) {
        $url = self::BASE_URL . $id . '/tasks';
        $payload = [
            "data" => [
                "attributes" => [
                    "action" => "receive_payment"
                ]
            ]
        ];
        $xfersHelper = new XfersHelper;
        return $xfersHelper->executeWithResponseValidation(self::METHOD_POST, $url, $payload);
    }

    // Function to cancel payment.
    public static function cancelPayment($id) {
        $url = self::BASE_URL . $id . '/tasks';
        $payload = [
            "data" => [
                "attributes" => [
                    "action" => "cancel"
                ]
            ]
        ];
        $xfersHelper = new XfersHelper;
        return $xfersHelper->executeWithResponseValidation(self::METHOD_POST, $url, $payload);
    }

    // Function to get payment detail by id.
    public static function getPaymentDetail($id) {
        $url = self::BASE_URL . $id;
        $xfersHelper = new XfersHelper;
        return $xfersHelper->executeWithResponseValidation(self::METHOD_GET, $url);
    }

    // Function to create a payment object.
    public static function createPayment($request, $no_invoice, $invoice_id) {
        $url = self::BASE_URL;
        $payload = [
            "data" => [
                "attributes" => [
                    "paymentMethodType" => "virtual_bank_account",
                    "amount" => $request['grand_total'],
                    "referenceId" => $no_invoice,
                    "expiredAt" => $request['date'].'T'.$request['time'].'+07:00',
                    "description" => "Order Number ".$invoice_id,
                    "paymentMethodOptions" =>[
                        "bankShortCode" => $request['bankShortCode'],
                        "displayName" => "Venidici",
                        "suffixNo" => ""
                    ]
                ]
            ]
        ];
        $xfersHelper = new XfersHelper;
        return $xfersHelper->executeWithResponseValidation(self::METHOD_POST, $url, $payload);
    }

    public static function createQRISPayment($request, $no_invoice, $invoice_id) {
        $url = self::BASE_URL;
        $payload = [
            "data" => [
                "attributes" => [
                    "paymentMethodType" => "qris",
                    "amount" => $request['grand_total'],
                    "referenceId" => $no_invoice,
                    "expiredAt" => $request['date'].'T'.$request['time'].'+07:00',
                    "description" => "Order Number ".$invoice_id,
                    "paymentMethodOptions" =>[
                        "displayName" => "Venidici",
                    ]
                ]
            ]
        ];
        $xfersHelper = new XfersHelper;
        return $xfersHelper->executeWithResponseValidation(self::METHOD_POST, $url, $payload);
    }
}