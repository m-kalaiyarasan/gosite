<?php

include 'libs/load.php';
$savedOtp = $_SESSION['otp'] ?? null;



        $razorpay_payment_id = "freeplan1234";
        $razorpay_subscription_id = "freeplan12345";
        $razorpay_signature = "freeplan123e4";
        $plan_id = "freeplan123";
        $status = "active";
        $start_at = "2024-12-31 06:12:02";
        $end_at = "2024-12-31 06:12:02";
        $charge_at = "2024-12-31 06:12:02";
        $total_count = "0";
        $paid_count = "0";
        $remaining_count = "0";
        $payment_method = "free";
        $customer_notify = "1";
        $plan_name = "freeplan";
        $username = Session::get('session_user');


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

        // // Execute SQL query
        // if ($conn->query($sql) === TRUE) {
        //     echo "Subscription details stored successfully!";
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        // $conn->close();

        $result = $conn->query($sql);
        if($result){
            print("hello success");
            return true;
        }else{
            print("fail");
            return false;
        }