<?php
  include '../load.php';


// $servername = "your_server_name";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database_name";
echo "<pre>";
print_r($_POST);
echo "<pre>";

$cashfree = new Cashfree(get_config('cf_AppId'), get_config('cf_SecKey'));
$subscriptionDetails = $cashfree->fetchSubscriptionDetails($cf_subReferenceId);

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
    'planId' => $_POST['subscription']['planId'],
    'planName' => $_POST['subscription']['planName'],
    'maxCycles' => $_POST['subscription']['maxCycles'],
    'type' => $_POST['subscription']['type'],
    'intervals' => $_POST['subscription']['intervals'],
    'intervalType' => $_POST['subscription']['intervalType'],
    'maxAmount' => $_POST['subscription']['maxAmount'],
    'recurringAmount' => $_POST['subscription']['recurringAmount'],
    'currency' => $_POST['subscription']['currency'],
    'customerName' => $_POST['subscription']['customerName'],
    'customerEmail' => $_POST['subscription']['customerEmail'],
    'customerPhone' => $_POST['subscription']['customerPhone'],
    'mode' => $_POST['cf_mode'],
    'status' => $_POST['cf_status'],
    'firstChargeDate' => $_POST['subscription']['firstChargeDate'],
    'expiryDate' => $_POST['subscription']['expiryDate'],
    'addedOn' => $_POST['subscription']['addedOn'],
    'scheduledOn' => $_POST['subscription']['scheduledOn'],
    'currentCycle' => $_POST['subscription']['currentCycle'],
    'authLink' => $_POST['subscription']['authLink'],
    'upiId' => $_POST['subscription']['upiId'],
    'umn' => $_POST['cf_umn'],
    'authFlow' => $_POST['subscription']['authFlow'],
    'tpvEnabled' => isset($_POST['subscription']['tpvEnabled']) ? 1 : 0,
    'signature' => $_POST['signature']
];
echo "<pre>";
print_r($subscriptionData);
echo "<pre>";

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO subscriptions (
    subscription_id, sub_reference_id, plan_id, plan_name, max_cycles, type, intervals, interval_type, max_amount, recurring_amount, currency, customer_name, customer_email, customer_phone, mode, status, first_charge_date, expiry_date, added_on, scheduled_on, current_cycle, auth_link, upi_id, umn, auth_flow, tpv_enabled, signature
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

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
?>
