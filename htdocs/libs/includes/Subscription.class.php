<?php

class Subscription {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection(); // Ensure Database::getConnection() is implemented correctly
    }

    public function getUniquePlansFromsub($username) {
        // Prepare SQL query
        $sql = "SELECT * 
                FROM subscriptions 
                WHERE status = 'ACTIVE' 
                  AND customer_name = ? 
                  AND id IN (
                      SELECT MIN(id)
                      FROM subscriptions
                      GROUP BY subscription_id
                  )";   

        // Use prepared statements to prevent SQL injection
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if results exist
        if ($result->num_rows > 0) {
            // Fetch all rows as an array
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            throw new Exception("No active subscriptions found for username: $username");
        }
    }
    public function getUniquePlans($username) {
        // Prepare SQL query
        $sql = "SELECT * 
                FROM payment 
                WHERE payment_status = 'PAID' 
                  AND username = ? 
                  AND id IN (
                      SELECT MIN(id)
                      FROM payment
                      GROUP BY link_id
                  )";   

        // Use prepared statements to prevent SQL injection
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if results exist
        if ($result->num_rows > 0) {
            // Fetch all rows as an array
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            throw new Exception("No active subscriptions found for username: $username");
        }
    }
}

// Example Usage
// try {
//     $subscription = new Subscription();
//     $uniquePlans = $subscription->getUniquePlans('kalai');
//     print_r($uniquePlans);
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }
