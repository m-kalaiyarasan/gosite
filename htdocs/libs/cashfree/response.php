<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Cashfree Payment Gateway Integration in PHP Step by Step</title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   </head>
<body>
 <?php  
  // Database configuration  
  require_once "inc/config.php";

  // Include Cashfree Configuration
  require_once "inc/cashfree-config.php";

   $secretkey = SECRECTKEY;  // Secret key from cashfree-config.php
   $orderId = $_POST["orderId"];
   $orderAmount = $_POST["orderAmount"];
   $referenceId = $_POST["referenceId"];
   $txStatus = $_POST["txStatus"];
   $paymentMode = $_POST["paymentMode"];
   $txMsg = $_POST["txMsg"];
   $txTime = $_POST["txTime"];
   $signature = $_POST["signature"];

   $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
   $hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
   $computedSignature = base64_encode($hash_hmac);

  /* update payment status, date and txnsId by order Id */
  $query = "UPDATE payment_transaction SET txns_id ='$referenceId', txns_date ='$txTime', status='$txStatus' WHERE order_id = '$orderId'";
    $con->query($query);

   if ($signature == $computedSignature) {
  ?>
 <div class="container"> 
  <div class="card m-5">
   <div class="card-heading text-success mt-3">
    <h3 align="center">Your Payment has been Successful</h3>
   </div>
   <div class="card-body mt-2">
    <div class="container">
     <table class="table table-hover table-striped">
      <tbody>
       <tr>
        <td>Order ID</td>
        <td><?php echo $orderId; ?></td>
       </tr>
       <tr>
        <td>Order Amount</td>
        <td><?php echo $orderAmount; ?></td>
       </tr>
       <tr>
        <td>Reference ID</td>
        <td><?php echo $referenceId; ?></td>
       </tr>
       <tr>
        <td>Transaction Status</td>
        <td><?php echo $txStatus; ?></td>
       </tr>
       <tr>
        <td>Payment Mode </td>
        <td><?php echo $paymentMode; ?></td>
       </tr>
       <tr>
        <td>Message</td>
        <td><?php echo $txMsg; ?></td>
       </tr>
       <tr>
        <td>Transaction Time</td>
        <td><?php echo $txTime; ?></td>
       </tr>
      </tbody>
     </table>
    </div>
    <a href="index.php" class="btn-link">Back to Products</a>
   </div>
  </div>
 </div>
 <?php } else { ?>
 <div class="container"> 
  <div class="card mt-5">
   <div class="card-heading text-danger mt-3">
    <h3 align="center">Your PayPal Transaction has been Cancelled</h3>
   </div>
  <div class="card-body mt-2">
   <div class="container">
    <table class="table table-hover table-striped">
     <tbody>
      <tr>
       <td>Order ID</td>
       <td><?php echo $orderId; ?></td>
      </tr>
      <tr>
       <td>Order Amount</td>
       <td><?php echo $orderAmount; ?></td>
      </tr>
      <tr>
       <td>Reference ID</td>
       <td><?php echo $referenceId; ?></td>
      </tr>
      <tr>
       <td>Transaction Status</td>
       <td><?php echo $txStatus; ?></td>
      </tr>
      <tr>
       <td>Payment Mode </td>
       <td><?php echo $paymentMode; ?></td>
      </tr>
      <tr>
       <td>Message</td>
       <td><?php echo $txMsg; ?></td>
      </tr>
      <tr>
       <td>Transaction Time</td>
       <td><?php echo $txTime; ?></td>
      </tr>
     </tbody>
    </table>
   </div>
   <a href="index.php" class="btn-link">Back to Products</a>
  </div>
 </div>
 <?php } ?>
</body>
</html>