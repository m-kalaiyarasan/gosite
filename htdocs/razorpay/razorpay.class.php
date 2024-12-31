<?php

use Razorpay\Api\Api;
require 'vendor/autoload.php';

class Razorpay {

    private $api;

    // Constructor to initialize Razorpay API
    public function __construct($key_id, $secret) {
        $this->api = new Api($key_id, $secret);
    }


    public function createPlanAndSubscription($plan, $price, $pricingPeriod) {
        try {
            // Convert price to smallest currency unit (e.g., ₹99 -> 9900 paise)
            $amount = intval($price) * 100;

            // Create the plan
            $planDetails = [
                'period' => $pricingPeriod,
                'interval' => 1,
                'item' => [
                    'name' => ucfirst($pricingPeriod) . " Plan - ₹" . $price,
                    'description' => "Subscription Plan for $pricingPeriod",
                    'amount' => $amount,
                    'currency' => 'INR'
                ]
            ];

            $createdPlan = $this->api->plan->create($planDetails);
            session_start();
            $username = $_SESSION['session_user'];
            // Create the subscription
            $subscriptionDetails = [    
                'plan_id' => $createdPlan->id,
                'customer_notify' => 1,
                'total_count' => ($pricingPeriod === 'monthly') ? 12 : 1, // Adjust for period
                'notes'=>array(
                        'plan'=>$plan,
                        'period'=>$pricingPeriod,
                        'user'=>$username
                    ),
            ];

            $createdSubscription = $this->api->subscription->create($subscriptionDetails);

            // Return subscription details
            echo "<pre>";
            // print_r($createdSubscription);
            echo "</pre>";
           
            return [
                'success' => true,
                'plan_id' => $createdPlan->id,
                'subscription_id' => $createdSubscription->id,
                'short_url' => $createdSubscription->short_url,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    // Create a ₹99 monthly plan
    public function staterMonthly() {
        try {
            $plan = $this->api->plan->create([
                'period' => 'monthly',
                'interval' => 1,
                'item' => [
                    'name' => 'Monthly Plan - ₹99',
                    'description' => 'Subscription Plan for monthly',
                    'amount' => 9900, // Amount in paise (₹99)
                    'currency' => 'INR'
                ]
            ]);
            return $plan;
        } catch (\Exception $e) {
            return "Error creating monthly plan: " . $e->getMessage();
        }
    }

    // Create a ₹999 yearly plan
    public function staterYearly() {
        try {
            $plan = $this->api->plan->create([
                'period' => 'yearly',
                'interval' => 1,
                'item' => [
                    'name' => 'Yearly Plan - ₹999',
                    'description' => 'Subscription Plan for per Year',
                    'amount' => 99900, // Amount in paise (₹999)
                    'currency' => 'INR'
                ]
            ]);
            return $plan;
        } catch (\Exception $e) {
            return "Error creating yearly plan: " . $e->getMessage();
        }
    }

    // Create a subscription for the monthly plan
    public function monthlySub($plan_id) {
        try {
            $subscription = $this->api->subscription->create([
                'plan_id' => $plan_id,
                'customer_notify' => 1,
                'total_count' => 12, // Valid for 12 months
            ]);
            return $subscription;
        } catch (\Exception $e) {
            return "Error creating monthly subscription: " . $e->getMessage();
        }
    }

    // Create a subscription for the yearly plan
    public function yearlySub($plan_id) {
        try {
            $subscription = $this->api->subscription->create([
                'plan_id' => $plan_id,
                'customer_notify' => 1,
                'total_count' => 2, // Example: 2 years
            ]);
            return $subscription;
        } catch (\Exception $e) {
            return "Error creating yearly subscription: " . $e->getMessage();
        }
    }
}
