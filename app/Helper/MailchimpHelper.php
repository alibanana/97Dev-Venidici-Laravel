<?php

namespace App\Helper;

use Illuminate\Support\Facades\Http;

class MailchimpHelper {

    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';
    const DEFAULT_HEADERS = [
        'Accept' => 'application/vnd.api+json',
        'Content-Type' => 'application/vnd.api+json'
    ];

    private function generateDefaultHttpObject() {
        return Http::withBasicAuth('key', env('MAILCHIMP_APIKEY', ''))
            ->withHeaders(self::DEFAULT_HEADERS);
    }

    private function executeWithResponseValidation($method, $url, $payload = null) {
        $response = $this->executeRequest($method, $url, $payload);
        return $this->validateResponse($response);
    }

    private function executeRequest($method, $url, $payload = null) {
        if ($method == self::METHOD_GET)
            return $this->generateDefaultHttpObject()->get($url, $payload);
        elseif ($method == self::METHOD_POST)
            return $this->generateDefaultHttpObject()->post($url, $payload);
        elseif ($method == self::METHOD_PUT)
            return $this->generateDefaultHttpObject()->put($url, $payload);
    }

    private function validateResponse($response) {
        $responseData = json_decode($response->body(), true);
        if ($response->failed()) {
            $status = 'Failed';
            if ($response->clientError()) {
                if (array_key_exists('title', $responseData)) {
                    $error_message = 'Errors Found - ' . $responseData['title'];
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

    // STARTS OF CLIENT METHODS
    // Hit Add-Member-To-List API from Mailchimp.
    public static function addMemberToList($skip_merge_validation, $params) {
        $url = env('MAILCHIMP_BASE_URL') . '/lists/' . env('MAILCHIMP_LIST_ID') . '/members?skip_merge_validation=' . $skip_merge_validation;
        $helper = new MailchimpHelper;
        return $helper->executeWithResponseValidation(self::METHOD_POST, $url, $params);
    }

    // Hit Get-Member-Info API from Mailchimp.
    public static function getMemberInfo($email, $params = null) {
        $url = env('MAILCHIMP_BASE_URL') . '/lists/' . env('MAILCHIMP_LIST_ID') . '/members/' . $email;
        $helper = new MailchimpHelper;
        return $helper->executeWithResponseValidation(self::METHOD_GET, $url, $params);
    }

    // Hit Add-Or-Update-List-Member
    public static function addOrUpdateListMember($email, $skip_merge_validation, $params = null) {
        $url = env('MAILCHIMP_BASE_URL') . '/lists/' . env('MAILCHIMP_LIST_ID') . '/members/' . $email . 
            '?skip_merge_validation=' . $skip_merge_validation;
        $helper = new MailchimpHelper;
        return $helper->executeWithResponseValidation(self::METHOD_PUT, $url, $params);
    }
    // END OF CLIENT METHODS


    // STARTS OF UTILS METHODS
    // Check if a certain user has been subscribed by email.
    public static function isSubscribed($email) {
        $response = MailchimpHelper::getMemberInfo($email, ["fields" => "status"]);
        if ($response['status'] == 'Success') {
            $data = $response['data'];
            if ($data) {
                return $data['status'] == 'subscribed';
            }
        }
        return false;
    }

    // Subscribe a new email to the list.
    public static function subscribe($email) {
        return MailchimpHelper::addOrUpdateListMember($email, true, [
            "email_address" => $email,
            "status_if_new" => "subscribed",
            "status" => "subscribed"
        ]);
    }
    // END OF UTILS METHODS
}