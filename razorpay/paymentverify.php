<?php
// Database connection
print("hello");
use Razorpay\Api\Api;
require 'vendor/autoload.php';

include '../libs/load.php';

print_r($_POST);
// Create connection
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$razorpay_subscription_id = $_POST['razorpay_subscription_id'];
$razorpay_signature = $_POST['razorpay_signature'];

// Check connection


$key_id = 'rzp_test_mWWPK4Xg13CyPi';
$key_secret = 'C1RusLdHei7cDZkQdMXHV8Cq';

$api = new Api($key_id, $key_secret);

$result = $api->subscription->fetch($razorpay_subscription_id);

print_r($result);
// Payment and subscription details from Razorpay


$plan_id = $result['plan_id'];
$status = $result['status'];
$start_at = date('Y-m-d H:i:s', $result['start_at']);
$end_at = date('Y-m-d H:i:s', $result['end_at']);
$charge_at = date('Y-m-d H:i:s', $result['charge_at']);
$total_count = $result['total_count'];
$paid_count = $result['paid_count'];
$remaining_count = $result['remaining_count'];
$payment_method = $result['payment_method'];
$customer_notify = $result['customer_notify'];
$plan_name = $result['notes']['plan'];
$username = $_SESSION['session_user'];


echo "Plan ID: $plan_id <br>";
echo "Status: $status <br>";
echo "Start At: $start_at <br>";
echo "End At: $end_at <br>";
echo "Charge At: $charge_at <br>";
echo "Total Count: $total_count <br>";
echo "Paid Count: $paid_count <br>";
echo "Remaining Count: $remaining_count <br>";
echo "Payment Method: $payment_method <br>";
echo "Customer Notify: $customer_notify <br>";


// Prepare SQL to insert subscription data
$sql = "INSERT INTO subscriptions (
    `username`,`plan_name`,`razorpay_payment_id`, `razorpay_subscription_id`, `razorpay_signature`, `plan_id`, `status`, 
    `start_at`, `end_at`, `charge_at`, `total_count`, `paid_count`, `remaining_count`, 
    `payment_method`, `customer_notify`
) VALUES (
    '$username','$plan_name','$razorpay_payment_id', '$razorpay_subscription_id', '$razorpay_signature', '$plan_id', '$status',
    '$start_at', '$end_at', '$charge_at', '$total_count', '$paid_count', '$remaining_count',
    '$payment_method', '$customer_notify'
)";

$conn = Database::getConnection();

// Execute SQL query
if ($conn->query($sql) === TRUE) {
    echo "Subscription details stored successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect to dashboard


header("Location: ../dashboard.php?host");
exit;
?>
