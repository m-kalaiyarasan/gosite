<?php


echo "<pre>";
print_r($_POST);
echo "</pre>";


// Set the header to accept JSON data
header("Content-Type: application/json");

// Get the raw POST data
$payload = file_get_contents("https://ee08e626ecd88c61c85f5c69c0418cb5.m.pipedream.net/");

// Decode the JSON payload
$data = json_decode($payload, true);
print($data);

// Log the webhook data for debugging
file_put_contents("cashfree_webhook.log", date('Y-m-d H:i:s') . " - " . print_r($data, true) . "\n", FILE_APPEND);

// Process the webhook data (example: checking payment status)
if (!empty($data) && isset($data['order_id'])) {
    // Example: Extract payment details
    $order_id = $data['order_id'];
    $payment_status = $data['txStatus']; // Success, Failed, Pending
    $amount = $data['orderAmount'];
    $transaction_id = $data['referenceId'] ?? 'N/A';

    // Example: Save to database (if needed)
    // $pdo->prepare("INSERT INTO payments (order_id, status, amount, transaction_id) VALUES (?, ?, ?, ?)")
    //     ->execute([$order_id, $payment_status, $amount, $transaction_id]);

    // Send a success response to Cashfree
    echo json_encode(["success" => true, "message" => "Webhook received"]);
} else {
    // Invalid request
    echo json_encode(["success" => false, "message" => "Invalid payload"]);
}
?>
