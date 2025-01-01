<?php

include '../libs/load.php';

$plan = $_POST['plan'];
$price = $_POST['price'];
$pricingPeriod = $_POST['pricingPeriod'];
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
                  <img
                    src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=100"
                    alt="Profile"
                    class="rounded-circle me-3"
                    width="60"
                  />
                  <div>
                    <h5 class="mb-1">John Doe</h5>
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
                  <span><?print($price);?></span>
                </div>
                <hr class="my-4" />
                <div class="d-flex justify-content-between mb-3">
                  <span class="h5 fw-bold">Total Amount</span>
                  <span class="h5 text-primary fw-bold"><?print($price);?></span>
                </div>
              </div>
              <button onclick="startPayment()" class="btn btn-primary btn-lg w-100 fw-bold" aria-label="Pay now button">Pay Now</button>
              <p class="text-center text-muted mt-4 mb-0 small">
                Secure Payment Powered by Stripe
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 

<?php


require 'razorpay.class.php';

$key_id = 'rzp_test_mWWPK4Xg13CyPi';
$key_secret = 'C1RusLdHei7cDZkQdMXHV8Cq';
// Set your callback URL

$callback_url  = get_config('callback_url');

// $callback_url = "https://dys.selfmade.one/gosite/htdocs/razorpay/paymentverify.php";

// Include Razorpay Checkout.js library
echo '<script src="https://checkout.razorpay.com/v1/checkout.js"></script>';

// Create a payment button with Checkout.js
// echo '<button onclick="startPayment()">Pay with Razorpay</button>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $razorpayHandler = new Razorpay($key_id, $key_secret);

    // Retrieve POST data
 

    // Call the method to create plan and subscription
    $response = $razorpayHandler->createPlanAndSubscription($plan, $price, $pricingPeriod);
    $subscription_id = $response['subscription_id'];

}
// Add a script to handle the payment
echo '<script src="https://checkout.razorpay.com/v1/checkout.js"></script>';
    echo '
        <script>
            function startPayment() {
                var options = {
                    key: "' . $key_id . '", // Enter your Key ID
                    subscription_id: "' . $subscription_id . '", // Subscription ID
                    name: "Your Company Name",
                    description: "' . $plan . '",
                    image: "https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png",
                    prefill: {
                        name: "Customer Name",
                        email: "customer@example.com",
                        contact: "9000090000"
                    },
                    notes: {
                        address: "Customer Address"
                    },
                    theme: {
                        color: "#3399cc"
                    },
                     callback_url: "' . $callback_url . '" // Redirect to this URL after payment
                };
                var rzp = new Razorpay(options);
                rzp.open();
            }
        </script>';


    ?>


</body>
</html>