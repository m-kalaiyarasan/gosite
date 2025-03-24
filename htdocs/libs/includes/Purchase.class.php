<?php

require_once "Database.class.php";

class Purchase{
    public $conn;
    public $username;
    public $id;

    public function __construct($username){
    
        $this->username = $username;
    }

    public function getdetails(){
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `purchase` WHERE `username` = '$this->username'";
        $result = $conn->query($sql);
        $details = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $details[] = $row;
            }
            return $details;
        }else{
            return false;
        }

    }
    public function getPaymentDetails(){
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `payment` ORDER BY STR_TO_DATE(link_created_at, '%Y-%m-%d %H:%i:%s') DESC";
        $result = $conn->query($sql);
        $details = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $details[] = $row;
            }
            return $details;
        }else{
            return false;
        }

    }

    public function getDetailsAdmin(){
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `purchase`";
        $result = $conn->query($sql);
        $details = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $details[] = $row;
            }
            return $details;
        }else{
            return false;
        }
    }
    public function subscriptionsDetailsAdmin(){
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `payment` ORDER BY `username`;";
        $result = $conn->query($sql);
        $details = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $details[] = $row;
            }
            return $details;
        }else{
            return false;
        }
    }

    public function isPlanIdExists($plan_id) {
        $conn = Database::getConnection();

        // SQL query to check if the plan_id exists
        $sql = "SELECT 1 FROM purchase WHERE plan_id = ? LIMIT 1";

        // Use prepared statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $plan_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Return true if a row is found, else false
        return $result->num_rows > 0;
    }


    public static function setdetails($domain, $plan_id,$plan_name, $path,$gitlink){
        $conn = Database::getConnection();
        $username = Session::get('session_user');
        $sql = "INSERT INTO `purchase` (`username`, `domain` ,`plan_id`, `plan_name`, `path`,`status`,`git_repo`) VALUES ('$username', '$domain','$plan_id', '$plan_name', '$path', 1,'$gitlink')";
        $result = $conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public static function setPlanDetails($domain, $plan_id,$plan_name, $path,$gitlink){
        $conn = Database::getConnection();
        $username = Session::get('session_user');
        $sql = "INSERT INTO `purchase` (`username`, `domain` ,`plan_id`, `plan_name`, `path`,`status`,`git_repo`) VALUES ('$username', '$domain','$plan_id', '$plan_name', '$path', 1,'$gitlink')";
        $result = $conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function updatedetails($index, $name, $status){
        $conn = Database::getConnection();
        $username = Session::get('session_user');
        $sql = "UPDATE `purchase` SET `domain` = '$name', `status` = '$status' WHERE `username` = '$username' AND `id` = '$index'";
        $result = $conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function deletedetails($index){
        $conn = Database::getConnection();
        $username = Session::get('session_user');
        $sql = "DELETE FROM `purchase` WHERE `username` = '$username' AND `id` = '$index'";
        $result = $conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function getDomain($domain){
        $conn = Database::getConnection();
        $username = Session::get('session_user');
        $sql = "SELECT '$domain' FROM `purchase` WHERE `username` = '$username' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['domain'];
        }else{
            return false;
        }
    }
    public function getDomainById($plan_id){
        $conn = Database::getConnection();
        $username = Session::get('session_user');
        $sql = "SELECT * FROM `purchase` WHERE `plan_id` = '$plan_id' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['domain'];
        }else{
            return false;
        }
    }

    public function gitdetails($value){
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `purchase` WHERE `username` = '$this->username' AND `id` = '$value' ";
        $result = $conn->query($sql);
        // $details = array();
        if($result->num_rows > 0){
        
                $details = $result->fetch_assoc();
            
            return $details;
        }else{
            return false;
        }

    }
    public static function daysLeftInSubscription($expiryDate) {
        $currentDate = new DateTime();
        // print($expiryDate);
        $expiry = new DateTime($expiryDate);
        $interval = $currentDate->diff($expiry);
    
        if ($currentDate > $expiry) {
            return "Subscription expired.";
        } else {
            return $interval->days . " days left.";
        }
    }
    
    public static function freePlanUp($username){
        $conn = Database::getConnection();

        $d=strtotime("+15 Days");
        $cf_link_id = rand(10,1000000);
        $customer_name = $username;
        $customer_phone = "1234567887";
        $customer_email = "free@freeplan.com";
        $link_amount = "0";
        $link_id = "free_".rand(10,1000000);
        $link_created_at = date("Y-m-d H:i:s");
        $link_currency = "INR";
        $plan_name = "freeplan";
        $plan_type = "freeplan";
        $link_purpose = "for free plan";
        $link_url = "none";
        $payment_status = "PAID";
        $end_at = date("Y-m-d H:i:s", $d);






        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $payment_status = "PAID";

        // SQL query to insert data
        $sql = "INSERT INTO payment 
                (username, cf_link_id, customer_name, customer_phone, customer_email, link_amount, link_id, link_created_at, link_currency, plan_name, plan_type, link_purpose, link_url, payment_status, end_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssdsssssssss", $username, $cf_link_id, $customer_name, $customer_phone, $customer_email, $link_amount, $link_id, $link_created_at, $link_currency, $plan_name, $plan_type, $link_purpose, $link_url, $payment_status, $end_at);

        if ($stmt->execute()) {
            // echo "Payment data inserted successfully!";
            return true;
        } else {
            echo "Error: " . $stmt->error;
            die("Failed, contact at support@gosite.in");
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }
    public static function freePlanUpsub($username){
        $d=strtotime("+15 Days");
        $razorpay_payment_id = "freeplan1234";
        $razorpay_subscription_id = "freeplan12345";
        $razorpay_signature = "freeplan123e4";
        $plan_id = "freeplan".rand(10,1000000);
        $status = "active";
        $start_at = date("Y-m-d H:i:s");
        $end_at = date("Y-m-d H:i:s", $d);
        $charge_at = date("Y-m-d H:i:s");
        $total_count = "0";
        $paid_count = "0";
        $remaining_count = "0";
        $payment_method = "free";
        $customer_notify = "1";
        $plan_name = "freeplan";
        


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

        $result = $conn->query($sql);
        if($result){
            print("hello success");
            return true;
        }else{
            print("fail");
            return false;
        }
    }
    public static function isPaid($id) {
        try {
            $conn = Database::getConnection();
            
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }
    
            // Fetch payment status for the given ID
            $sql = "SELECT payment_status FROM payment WHERE link_id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }
            $stmt->bind_param("s", $id);
            if (!$stmt->execute()) {
                throw new Exception("Execution failed: " . $stmt->error);
            }
    
            $stmt->bind_result($payment_status);
            if (!$stmt->fetch()) {
                throw new Exception("No record found for ID: " . $id);
            }
    
            $stmt->close();
            
            // print($payment_status);
            // Check if payment status is 'paid' or 'pending'
            return $payment_status;
    
        } catch (Exception $e) {
            error_log("Error in isPaid: " . $e->getMessage()); // Logs the error
            return false; // Treat as 'pending' if an error occurs
        }
    }
    

}