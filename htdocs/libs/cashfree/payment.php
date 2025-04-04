<?php

// include_once '../load.php';
include_once 'payment.class.php';

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$plan = $_POST['plan'];
$official_name = $_POST['name'];
$price = $_POST['price'];
$pricingPeriod = $_POST['pricingPeriod'];

// $pricingPeriod = substr($pricingPeriod, 0, -2);
// print($pricingPeriod  );


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout Summary</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-light">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <div class="card shadow-lg border-0">
            <div class="card-body p-5">
              <h1 class="text-center mb-4">Checkout Summary</h1>
              <div
                class="d-flex align-items-center justify-content-between mb-4 p-3 bg-light rounded"
              >
                <div class="d-flex align-items-center">
                  <!-- <img
                    src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=100"
                    alt="Profile"
                    class="rounded-circle me-3"
                    width="60"
                  /> -->
                  <div>
                    <h5 class="mb-1"><?=$_SESSION['session_user']?></h5>
                    <p class="text-muted mb-0">Premium Account</p>
                  </div>
                </div>
              </div>
              <div class="mb-4">
                <div class="d-flex justify-content-between mb-3">
                  <span class="fw-bold">Plan Type</span>
                  <span class="text-primary"><?print($plan);?></span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <span class="fw-bold">Billing Cycle</span>
                  <span><?print($pricingPeriod);?></span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <span class="fw-bold">Plan Price</span>
                  <span>&#8377;<?print($price);?></span>
                </div>
                <hr class="my-4" />
                <div class="d-flex justify-content-between mb-3">
                  <span class="h5 fw-bold">Total Amount</span>
                  <span class="h5 text-primary fw-bold">&#8377;<?print($price);?></span>
                </div>
              </div>
              <button  id="payNowButton" class="btn btn-primary btn-lg w-100 fw-bold" aria-label="Pay now button">Pay Now</button>
              <p class="text-center text-muted mt-4 mb-0 small">
                Secure Payment Powered by Cashfree
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 
<?

$cashfree = new Payment(get_config('cf_AppId'), get_config('cf_SecKey'));

// $plan = $cashfree->createPlan($plan, $price, $pricingPeriod);
// $planId = $plan['data']['planId'];


$username = Session::get('session_user');
$userobj = new User($username);

// print($userobj->getemail());


$paymentLink = $cashfree->paymentLink($userobj->getemail(),$official_name , $userobj->getphone(),$price, $username, $plan, $pricingPeriod);
// $subscription = $cashfree->createSubscription($planId, $customerName, $customerPhone, $customerEmail) ;
$paymentLink = json_decode($paymentLink);
echo "<pre>";

// print_r($paymentLink);
echo "</pre>";

echo "<br>";

//insert payment datas into database

// print($paymentLink->cf_link_id);

$paymentDetails = $cashfree->updatePayment($username, $paymentLink->cf_link_id, $paymentLink->customer_details->customer_name, $paymentLink->customer_details->customer_phone, $paymentLink->customer_details->customer_email, $paymentLink->link_amount, $paymentLink->link_id, $paymentLink->link_created_at, $paymentLink->link_currency, $paymentLink->link_notes->plan_name, $paymentLink->link_notes->plan_type, $paymentLink->link_purpose, $paymentLink->link_url);

$_SESSION['link_id'] = $paymentLink->link_id;
?>
<!-- Trigger Button -->
<!-- <button id="payNowButton">Pay Now</button> -->

<!-- Modal -->
<div id="paymentModal" 
     style="display:none; 
            position:fixed; 
            top:50%; 
            left:50%; 
            transform:translate(-50%, -50%); 
            width:90%; 
            max-width:600px; 
            height:100%; 
            background:white; 
            z-index:1000; 
            border-radius:10px; 
            box-shadow: 0 8px 16px rgba(0,0,0,0.2); 
            overflow:hidden;">
    
    <!-- Header with Close Button -->
    <div style="position:relative; background:#f5f5f5; padding:10px; border-bottom:1px solid #ddd;">
        <h2 style="margin:0; font-size:18px; color:#333;">Pay Now</h2>
        <button onclick="closeModal()" 
                style="position:absolute; 
                       top:10px; 
                       right:10px; 
                       background:none; 
                       border:none; 
                       font-size:18px; 
                       cursor:pointer; 
                       color:#666;">
            &times;
        </button>
    </div>
    
    <!-- Iframe Content -->
    <iframe id="paymentIframe" 
            src="" 
            style="width:100%; 
                   height:calc(100% - 50px); 
                   border:none;">
    </iframe>
</div>

<script>
document.getElementById('payNowButton').addEventListener('click', function() {
    const paymentUrl = '<? echo $paymentLink->link_url; ?>'; // Replace with the actual link
    document.getElementById('paymentIframe').src = paymentUrl;
    document.getElementById('paymentModal').style.display = 'block';
});

function closeModal() {
    document.getElementById('paymentModal').style.display = 'none';
    document.getElementById('paymentIframe').src = ""; // Clear the iframe content
    // window.location.href = "https://gosite.zeal.lol/libs/cashfree/verify.php"; 
}
</script>
</body>
</html>

<?//Print("sucess");?>