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
    public function createPlan($planName, $recurringAmount, $intervalType) {
        $url = "https://api.cashfree.com/api/v2/subscription-plans";
        $headers = [
            'Content-Type: application/json',
            'X-Client-Id: ' . $this->appId,
            'X-Client-Secret: ' . $this->secretKey
        ];
        $PlanId = "plan".mt_rand(1000,10000); 
        $data = json_encode([
            'planId' => $planId,
            'planName' => $planName,
            'type' => 'PERIODIC',
            'recurringAmount' => $recurringAmount, // in paise
            'intervals' => 1,
            'intervalType' => $intervalType
        ]);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($response, true);
    }
    

    // Create Subscription
    public function createSubscription($planId, $customerName, $customerPhone, $customerEmail,) {
        $url = "https://api.cashfree.com/api/v2/subscriptions/nonSeamless/subscription";
        $headers = [
            'Content-Type: application/json',
            'X-Client-Id: ' . $this->appId,
            'X-Client-Secret: ' . $this->secretKey
        ];
        $subscriptionId = "sub".mt_rand(1000000,10000000); 
        $data = json_encode([
            'subscriptionId' => $subscriptionId,
            'planId' => $planId,
            'customerName' => $customerName,
            'customerPhone' => $customerPhone,
            'customerEmail' => $customerEmail,
            'returnUrl' => "https://gosite.in",
            'notes' => [
                'key1' => 'value1',
                'key2' => 'value2',
                'key3' => 'value3',
                'key4' => 'value4'
            ],
            'linkExpiry' => 5,
            'notificationChannels' => ['EMAIL', 'SMS']
        ]);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($response, true);
    }
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

$cashfree = new Cashfree('TEST10415338d02ddc9044ea7f3e348083351401', 'cfsk_ma_test_c8f46887ca2ac8d1276076fc2ce3d60e_f0d05ada');
$planId = $cashfree->createPlan("starter", "1000", "month");
print_r($planId);
$subscription = $cashfree->createSubscription($planId, "kalai", "7418073126", "kalaiyarasan.offl@gmail.com",);

echo "<pre>";
print_r($subscription);
echo "</pre>";
?>
