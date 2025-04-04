<?
echo "<pre>";
print_r($_POST);
echo "</pre>";
include '../load.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cashfree Subscription Authorization Response</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <?php
    // Database configuration
    // require_once "../load.php";

    // Include Cashfree Configuration
    require_once "cashfree.conf.php";
    require_once "cashfree.class.php";

    // Cashfree response parameters
    $cf_subscriptionId = $_POST["cf_subscriptionId"];
    $cf_status = $_POST["cf_status"];
    $cf_message = $_POST["cf_message"];
    $cf_subscriptionPaymentId = $_POST["cf_subscriptionPaymentId"];
    $cf_subReferenceId = $_POST["cf_subReferenceId"];
    $cf_umn = $_POST["cf_umn"];
    $cf_mode = $_POST["cf_mode"];
    $cf_authAmount = $_POST["cf_authAmount"];
    $cf_referenceId = $_POST["cf_referenceId"];
    $cf_checkoutStatus = $_POST["cf_checkoutStatus"];
    $signature = $_POST["signature"];

    // Compute signature to verify authenticity
    $secretkey = SECRECTKEY; // Secret key from cashfree.conf.php
    $data = $cf_subscriptionId . $cf_status . $cf_message . $cf_subscriptionPaymentId . $cf_subReferenceId . $cf_umn . $cf_mode . $cf_authAmount . $cf_referenceId . $cf_checkoutStatus;
    $hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
    $computedSignature = base64_encode($hash_hmac);

    // $username = $_SESSION['session_user'];

    // Verify the signature
    if (strcmp($cf_status,"SUCCESS")) {
        // Insert subscription details into the database
        $con = Database::getConnection();
        $id = NULL; // Allows MySQL to auto-increment
        $username = "kalai";
        $query = "INSERT INTO `subscriptions-test` (id, username, signature, cf_subscriptionId, cf_status, cf_message, cf_subscriptionPaymentId, cf_subReferenceId, cf_umn, cf_mode, cf_authAmount, cf_referenceId, cf_checkoutStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("isssssiissdss", $id, $username, $signature, $cf_subscriptionId, $cf_status, $cf_message, $cf_subscriptionPaymentId, $cf_subReferenceId, $cf_umn, $cf_mode, $cf_authAmount, $cf_referenceId, $cf_checkoutStatus);

        // Assign other variables as needed

        $stmt->execute();
        $cashfree = new Cashfree(get_config('cf_AppId'), get_config('cf_SecKey'));

        $subscriptionDetails = $cashfree->fetchSubscriptionDetails($cf_subReferenceId);
        echo "<pre>";
        print_r($subscriptionDetails);
        echo "<pre>";

        // Display success message
        ?>
        <div class="container">
            <div class="card m-5">
                <div class="card-heading text-success mt-3">
                    <h3 align="center">Your Subscription has been Authorized Successfully</h3>
                </div>
                <div class="card-body mt-2">
                    <div class="container">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>Subscription ID</td>
                                    <td><?php echo htmlspecialchars($cf_subscriptionId); ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?php echo htmlspecialchars($cf_status); ?></td>
                                </tr>
                                <tr>
                                    <td>Message</td>
                                    <td><?php echo htmlspecialchars($cf_message); ?></td>
                                </tr>
                                <tr>
                                    <td>Subscription Payment ID</td>
                                    <td><?php echo htmlspecialchars($cf_subscriptionPaymentId); ?></td>
                                </tr>
                                <tr>
                                    <td>Sub Reference ID</td>
                                    <td><?php echo htmlspecialchars($cf_subReferenceId); ?></td>
                                </tr>
                                <tr>
                                    <td>UMN</td>
                                    <td><?php echo htmlspecialchars($cf_umn); ?></td>
                                </tr>
                                <tr>
                                    <td>Mode</td>
                                    <td><?php echo htmlspecialchars($cf_mode); ?></td>
                                </tr>
                                <tr>
                                    <td>Authorization Amount</td>
                                    <td><?php echo htmlspecialchars($cf_authAmount); ?></td>
                                </tr>
                                <tr>
                                    <td>Reference ID</td>
                                    <td><?php echo htmlspecialchars($cf_referenceId); ?></td>
                                </tr>
                                <tr>
                                    <td>Checkout Status</td>
                                    <td><?php echo htmlspecialchars($cf_checkoutStatus); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="index.php" class="btn-link">Back to Products</a>
                </div>
            </div>
        </div>
        <?php
    } else {
        // Display error message
        ?>
        <div class="container">
            <div class="card mt-5">
                <div class="card-heading text-danger mt-3">
                    <h3 align="center">Subscription Authorization Failed</h3>
                </div>
                <div class="card-body mt-2">
                    <div class="container">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>Subscription ID</td>
                                    <td><?php echo htmlspecialchars($cf_subscriptionId); ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?php echo htmlspecialchars($cf_status); ?></td>
                                </tr>
                                <tr>
                                    <td>Message</td>
                                    <td><?php echo htmlspecialchars($cf_message); ?></td>
                                </tr>
                                <tr>
                                    <td>Subscription Payment ID</td>
                                    <td><?php echo htmlspecialchars($cf_subscriptionPaymentId); ?></td>
                                </tr>
                                <tr>
                                    <td>Sub Reference ID</td>
                                    <td><?php echo htmlspecialchars($cf_subReferenceId); ?></td>
                                </tr>
                                <tr>
                                    <td>UMN</td>
                                    <td><?php echo htmlspecialchars($cf_umn); ?></td>
                                </tr>
                                <tr>
                                    <td>Mode</td>
                                    <td><?php echo htmlspecialchars($cf_mode); ?></td>
                                </tr>
                                <tr>
                                    <td>
                                    <tr>
    <td>Authorization Amount</td>
    <td><?php echo htmlspecialchars($cf_authAmount); ?></td>
</tr>
<tr>
    <td>Reference ID</td>
    <td><?php echo htmlspecialchars($cf_referenceId); ?></td>
</tr>
<tr>
    <td>Checkout Status</td>
    <td><?php echo htmlspecialchars($cf_checkoutStatus); ?></td>
</tr>
</tbody>
</table>
</div>
<a href="index.php" class="btn-link">Back to Products</a>
</div>
</div>
</div>
<?php
}
?>
</body>
</html>
