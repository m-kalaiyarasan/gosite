<?php
  include '../load.php';
  require_once "cashfree.class.php";


// $servername = "your_server_name";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database_name";
echo "<pre>";
print_r($_POST);
echo "<pre>";

$cashfree = new Cashfree(get_config('cf_AppId'), get_config('cf_SecKey'));
$subscriptionDetails = $cashfree->fetchSubscriptionDetails($_POST['cf_subReferenceId']);

echo "<pre>";
print_r($subscriptionDetails);
echo "<pre>";
// Create connection
$conn = Database::getConnection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve subscription data from $_POST
$subscriptionData = [
    'subscriptionId' => $_POST['cf_subscriptionId'],
    'subReferenceId' => $_POST['cf_subReferenceId'],
    'planId' => $subscriptionDetails['subscription']['planId'],
    'planName' => $subscriptionDetails['subscription']['planName'],
    'maxCycles' => $subscriptionDetails['subscription']['maxCycles'],
    'type' => $subscriptionDetails['subscription']['type'],
    'intervals' => $subscriptionDetails['subscription']['intervals'],   
    'intervalType' => $subscriptionDetails['subscription']['intervalType'],
    'maxAmount' => $subscriptionDetails['subscription']['maxAmount'],
    'recurringAmount' => $subscriptionDetails['subscription']['recurringAmount'],
    'currency' => $subscriptionDetails['subscription']['currency'],
    'customerName' => $subscriptionDetails['subscription']['customerName'],
    'customerEmail' => $subscriptionDetails['subscription']['customerEmail'],
    'customerPhone' => $subscriptionDetails['subscription']['customerPhone'],
    'mode' => $_POST['cf_mode'],
    'status' => $_POST['cf_status'],
    'firstChargeDate' => $subscriptionDetails['subscription']['firstChargeDate'],
    'expiryDate' => $subscriptionDetails['subscription']['expiryDate'],
    'addedOn' => $subscriptionDetails['subscription']['addedOn'],
    'scheduledOn' => $subscriptionDetails['subscription']['scheduledOn'],
    'currentCycle' => $subscriptionDetails['subscription']['currentCycle'],
    'authLink' => $subscriptionDetails['subscription']['authLink'],
    'upiId' => $subscriptionDetails['subscription']['upiId'],
    'umn' => $_POST['cf_umn'],
    'authFlow' => $subscriptionDetails['subscription']['authFlow'],
    'tpvEnabled' => $subscriptionDetails['subscription']['tpvEnabled'],
    'signature' => $_POST['signature']
];
echo "<pre>";
print_r($subscriptionData);
echo "<pre>";

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO subscriptions (
    subscription_id, sub_reference_id, plan_id, plan_name, max_cycles, type, intervals, interval_type, max_amount, recurring_amount, currency, customer_name, customer_email, customer_phone, mode, status, first_charge_date, expiry_date, added_on, scheduled_on, current_cycle, auth_link, upi_id, umn, auth_flow, tpv_enabled, signature, created_at
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

// Bind Parameters
$stmt->bind_param(
    "ssssisisddssssssssssissssss",
    $subscriptionData['subscriptionId'],
    $subscriptionData['subReferenceId'],
    $subscriptionData['planId'],
    $subscriptionData['planName'],
    $subscriptionData['maxCycles'],
    $subscriptionData['type'],
    $subscriptionData['intervals'],
    $subscriptionData['intervalType'],
    $subscriptionData['maxAmount'],
    $subscriptionData['recurringAmount'],
    $subscriptionData['currency'],
    $subscriptionData['customerName'],
    $subscriptionData['customerEmail'],
    $subscriptionData['customerPhone'],
    $subscriptionData['mode'],
    $subscriptionData['status'],
    $subscriptionData['firstChargeDate'],
    $subscriptionData['expiryDate'],
    $subscriptionData['addedOn'],
    $subscriptionData['scheduledOn'],
    $subscriptionData['currentCycle'],
    $subscriptionData['authLink'],
    $subscriptionData['upiId'],
    $subscriptionData['umn'],
    $subscriptionData['authFlow'],
    $subscriptionData['tpvEnabled'],
    $subscriptionData['signature']
);

// Execute the statement
if ($stmt->execute()) {
    echo "New subscription record created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
// header("Location: /dashboard.php?host");
// exit();
?>
