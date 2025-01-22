<?php

require 'vendor/autoload.php';

class Cashfree {

    private $apiUrl = "https://test.cashfree.com";
    private $appId;
    private $secretKey;

    public function __construct($appId, $secretKey) {
        $this->appId = $appId;
        $this->secretKey = $secretKey;
    }

    // Create a Plan
    public function createPlan($planName, $amount, $period) {
        $url = $this->apiUrl . "/api/v2/subscription-plans";
        $headers = [
            'Content-Type: application/json',
            'x-api-version: 1.0',
            'x-client-id: ' . $this->appId,
            'x-client-secret: ' . $this->secretKey
        ];
        $PlanId = "plan".mt_rand(1000,10000); 
        

        $data = [ 
            'planId' => $PlanId,
            'planName' => $planName,
            'type' => "PERIODIC",
            "recurringAmount"=> $amount,
            "maxAmount"=> 10000,
            "intervals"=> 1,
            "intervalType"=> $period
        ];

        $response = $this->sendRequest($url, 'POST', $data, $headers);
        print_r($response);
        return $response;
    }

    // Create Subscription
    public function createSubscription($planId, $customerName, $customerPhone, $customerEmail) {
        $url = $this->apiUrl . "/api/v2/subscriptions/nonSeamless/subscription";
        $headers = [
            'Content-Type: application/json',
            'x-api-version: 1.0',
            'x-client-id: ' . $this->appId,
            'x-client-secret: ' . $this->secretKey
        ];
        $subscriptionId = "sub".mt_rand(1000,10000);
        $data = [
            'subscriptionId' => $subscriptionId,
            'planId' => $planId,
            'customerName' => $customerName,
            'customerPhone' => $customerPhone,
            'customerEmail' => $customerEmail,
            'linkExpiry' => 5,
            'returnUrl' => 'https://gosite.zeal.lol/libs/cashfree/verify.php', // Replace with actual notification URL
        ];

        $response = $this->sendRequest($url, 'POST', $data, $headers);
        print_r($response);
        return $response;
    }

    // Send API request
    private function sendRequest($url, $method, $data = [], $headers = []) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        
        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}


