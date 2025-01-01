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


    public static function setdetails($domain, $plan_id,$plan_name, $path){
        $conn = Database::getConnection();
        $username = Session::get('session_user');
        $sql = "INSERT INTO `purchase` (`username`, `domain` ,`plan_id`, `plan_name`, `path`,`status`) VALUES ('$username', '$domain','$plan_id', '$plan_name', '$path', 1)";
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

}