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
            'returnUrl' => 'https://dys.selfmade.one/gosite/htdocs/cashfree/verify.php', // Replace with actual notification URL
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

$cashfree = new Cashfree('TEST10415338d02ddc9044ea7f3e348083351401', 'cfsk_ma_test_c8f46887ca2ac8d1276076fc2ce3d60e_f0d05ada');
$plan = $cashfree->createPlan('Basic Plan', 9900, 'month');

echo "<pre>";
print_r($plan);
echo "</pre>";

$planId = $plan['data']['planId'];

$subscription = $cashfree->createSubscription($planId, "kalaiyarasan", "7418073126", "kalaiyarasan.offl@gmail.com") ;
// $subscription = $cashfree->createSubscription($planId, $customerName, $customerPhone, $customerEmail) ;

echo "<pre>";
print_r($subscription);
echo "</pre>";

?>
<!-- Trigger Button -->
<button id="payNowButton">Pay Now</button>

<!-- Modal -->
<div id="paymentModal" style="display:none; position:fixed; top:10%; left:10%; width:80%; height:80%; background:white; z-index:1000; border-radius:10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <iframe id="paymentIframe" src="" style="width:100%; height:100%; border:none;"></iframe>
    <button onclick="closeModal()" style="position:absolute; top:10px; right:10px;">Close</button>
</div>

<script>
document.getElementById('payNowButton').addEventListener('click', function() {
    const paymentUrl = '<? echo $subscription['data']['authLink']; ?>'; // Replace with the actual link
    document.getElementById('paymentIframe').src = paymentUrl;
    document.getElementById('paymentModal').style.display = 'block';
});

function closeModal() {
    document.getElementById('paymentModal').style.display = 'none';
    document.getElementById('paymentIframe').src = ""; // Clear the iframe content
}
</script>
