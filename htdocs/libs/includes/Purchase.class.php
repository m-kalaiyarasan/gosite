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

    public static function setdetails($domain, $plan, $path){
        $conn = Database::getConnection();
        $username = Session::get('session_user');
        $sql = "INSERT INTO `purchase` (`username`, `domain`, `plan`, `path`,`status`) VALUES ('$username', '$domain', '$plan', '$path', 1)";
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

}