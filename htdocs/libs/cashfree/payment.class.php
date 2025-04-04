<?php
include '../load.php';
class Payment
{
    private $apiUrl;
    private $appId;
    private $secretKey;
    
    public function __construct($appId, $secretKey) {
        $this->appId = $appId;
        $this->secretKey = $secretKey;
        $this->apiUrl = get_config('api_link');
    }
    public function paymentLink($email, $name, $phone, $amount, $username, $planname, $plantype)
    {
        $expiryTime = date('Y-m-d\TH:i:sP', strtotime('+5 minutes')); // Generate expiry time (5 mins from now)

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",        
            CURLOPT_POSTFIELDS => json_encode([
                "customer_details" => [
                    "customer_email" => $email,
                    "customer_name" => $name,
                    "customer_phone" => $phone
                ],
                "link_amount" => $amount,
                "link_auto_reminders" => true,
                "link_currency" => "INR",
                "link_expiry_time" => $expiryTime, // Dynamically generated expiry time
                "link_id" => "payment_" . time(),
                "link_meta" => [
                    "notify_url" => "https://ee08e626ecd88c61c85f5c69c0418cb5.m.pipedream.net",
                    "return_url" =>  get_config('return_url'),
                    "upi_intent" => false
                ],
                // "link_minimum_partial_amount" => 20,
                "link_notes" => [
                    "username" => $username,
                    "plan_name" => $planname,
                    "plan_type" => $plantype
                ],
                "link_notify" => [
                    "send_email" => true,
                    "send_sms" => false
                ],
                // "link_partial_payments" => true,
                "link_purpose" => "Payment for web hosting",
                // "order_splits" => [
                //     [
                //         "vendor_id" => "Jane",
                //         "amount" => 1.45,
                //         "tags" => [
                //             "address" => "Hyderabad"
                //         ]
                //     ],
                //     [
                //         "vendor_id" => "Barbie",
                //         "amount" => 3.45,
                //         "tags" => [
                //             "address" => "Bengaluru, India"
                //         ]
                //     ]
                // ]    
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            'x-api-version: 2025-01-01',
            'x-client-id: ' . $this->appId,
            'x-client-secret: ' . $this->secretKey
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        
        if ($err) {
            return "cURL Error #:" . $err; 
        } else {
            return $response;

        }
    }
    public function verifyPayment($link_id) {
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            // CURLOPT_URL => "https://sandbox.cashfree.com/pg/links/{$link_id}",
            CURLOPT_URL => get_config('api_link')."/{$link_id}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
              'x-api-version: 2025-01-01',
            'x-client-id: ' . $this->appId,
            'x-client-secret: ' . $this->secretKey
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    
        if ($err) {
            echo "cURL Error: " . $err;
            return false;
        }
    
        // Decode JSON response
        $paymentData = json_decode($response, true);
        // print_r($paymentData);
    
        if ($paymentData && isset($paymentData['link_status'])) {
            $status = $paymentData['link_status']; // ACTIVE, PAID, EXPIRED, etc.
    
            // Update status in the database
            $this->updateStatus($paymentData['cf_link_id'], $status);
            return $status;
        } else {
            echo "Invalid response from Cashfree.";
            return false;
        }
    }
    

    public function updatePayment($username, $cf_link_id, $customer_name, $customer_phone, $customer_email, $link_amount,$link_id, $link_created_at, $link_currency, $plan_name, $plan_type, $link_purpose, $link_url){
        // $username = "kalaiyarasan";
        // $cf_link_id = "6390585";
        // $customer_name = "kalaiyarasan";
        // $customer_phone = "7418073126";
        // $customer_email = "kalaiyarasan.offl.2004@gmail.com";
        // $link_amount = 10.00;
        // $link_created_at = "2025-03-11T11:19:55+05:30";
        // $link_currency = "INR";
        // $plan_name = "starter";
        // $plan_type = "monthly";
        // $link_purpose = "Payment for web hosting";
        // $link_url = "https://payments-test.cashfree.com/links/e87sa8jkjc40";
        $conn = Database::getConnection();

        if ($plan_type === "monthly") {
            $end_at = date("Y-m-d", strtotime("+30 days", strtotime($link_created_at)));
        } elseif ($plan_type === "annual") {
            $end_at = date("Y-m-d", strtotime("+1 year", strtotime($link_created_at)));
        } else {
            $end_at = NULL; // Default if plan_type is unknown
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $payment_status = "pending";

        // SQL query to insert data
        $sql = "INSERT INTO payment 
                (username, cf_link_id, customer_name, customer_phone, customer_email, link_amount, link_id, link_created_at, link_currency, plan_name, plan_type, link_purpose, link_url, payment_status, end_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssdsssssssss", $username, $cf_link_id, $customer_name, $customer_phone, $customer_email, $link_amount, $link_id, $link_created_at, $link_currency, $plan_name, $plan_type, $link_purpose, $link_url, $payment_status, $end_at);

        if ($stmt->execute()) {
            // echo "Payment data inserted successfully!";
            return true;
        } else {
            echo "Error: " . $stmt->error;
            die("Failed, contact at support@gosite.in");
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }

    public function updateStatus($cf_link_id,$status){

        $conn = Database::getConnection();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE payment SET payment_status = ? WHERE cf_link_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $status, $cf_link_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error: " . $stmt->error;
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }
    public static function isPaid($id) {
        $conn = Database::getConnection();
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Fetch payment status for the given ID
        $sql = "SELECT payment_status FROM payment WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($payment_status);
        $stmt->fetch();
        $stmt->close();
        
        print($payment_status);
        // Check if payment status is 'paid' or 'pending'
        if ($payment_status === "PAID") {
            return true;  // Payment is completed
        } else {
            return false; // Payment is still pending
        }
    }
    
}
