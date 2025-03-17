<?php
require_once "Database.class.php";


class User
{
    public $conn;
    public $username;
    public $id;    


    public function __call($name, $arguments)
    {



        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
       
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        }

        else{
            throw new Exception("User::__call() -> $name, function unavailable. ");
        }
    }

//-------------------------------------------------------------------------------------------------------------------
    public static function signup($user, $pass, $email, $phone) {

        $options = [
            'cost' => 9, 
        ];
        $pass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();
        $sql = "INSERT INTO auth (username, password, email, phone, blocked, active) 
                VALUES (?,?,?,?, '0',0);";
        $stmt = $conn->prepare($sql);
        $defaultValue = 0;
        $stmt->bind_param("ssss", $user, $pass, $email, $phone);
        $result = false;    
        if ($stmt->execute()) {
            $result = true;
        } 
        else {
            $result = false;    
        }
        // $conn->close();
        return $result;
    }
//-----------------------------------------------------------------------------------------------------------------
    


    public static function login($user,$pass)
    {
     
        $query = "SELECT * FROM auth WHERE username = ?";
        $conn = Database::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();  
        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if(password_verify($pass,$row['password']))
            {
                

                return $row['username'];
            }
            else{
                return false;
            }
        }
        else{ 
            return false;
        }
    }

//-------------------------------------------------------------------------------------------------------------------
 

    public function __construct($username){
        $this->conn = Database::getConnection();
        $this->username = $username;
        $this->id=null;
        $sql= "SELECT `id` FROM `auth` WHERE `username`= '$username' or `id`='$username' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows){
            $row=$result->fetch_assoc();
            $this->id=$row['id'];
        }
        else{
            throw new Exception("Username does't exist");
        }

    }

//---------------------------------------------------------------------------------------------------------------------
    private function _get_data($var){
        if(!$this->conn){
            $this->conn = Database::getConnection();
        }
        
        $sql = "SELECT `$var` FROM `auth` WHERE `username` = '$this->username' "; 
        
        
        $result = $this->conn->query($sql);
        if ($result and $result->num_rows == 1){
            
            return $result->fetch_assoc()["$var"];  
            
        }
        else {
            return null;
        }
    }
    
    public static function getdata($var, $value) {
        print("125 user class");
        // Define allowed column names to prevent SQL injection
        $allowedColumns = ['id', 'username', 'email', 'phone']; // Update this list based on your table schema
        
        if (!in_array($var, $allowedColumns)) {
            throw new Exception("Invalid column name.");
        }
        
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `auth` WHERE `$var` = ?";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        
        $stmt->bind_param("s", $value); // Use "s" for string, "i" for integer, etc., based on the data type of `$value`
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result && $result->num_rows === 1) {
            return $result->fetch_assoc()[$var];
        } else {
            return null;
        }
    }
    

    private function _set_data($var, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "UPDATE `users` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function setDob($year, $month, $day)
    {
        if (checkdate($month, $day, $year)) { 
            return $this->_set_data('dob', "$year.$month.$day");
        } else {
            return false;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function Authenticate(){
        
    }

    public static function active($value){
        $conn = Database::getConnection();
        $email = Session::get('email');
        $sql = "UPDATE `auth` SET `active` = '$value' WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }

    }

    public static function getFreePlan(){
        
    }


 // public function setBio($bio)
    // {
    //     //TODO: Write UPDATE command to change new bio
    //     return $this->_set_data('bio', $bio);
    // }

    // public function getBio()
    // {
    //     //TODO: Write SELECT command to get the bio.
    //     return $this->_get_data('bio');
    // }

    // public function setAvatar($link)
    // {
    //     return $this->_set_data('avatar', $link);
    // }

    // public function getAvatar()
    // {
    //     return $this->_get_data('avatar');
    // }

    // public function setFirstname($name)
    // {
    //     return $this->_set_data("firstname", $name);
    // }

    // public function getFirstname()
    // {
    //     return $this->_get_data('firstname');
    // }

    // public function setLastname($name)
    // {
    //     return $this->_set_data("lastname", $name);
    // }

    // public function getLastname()
    // {
    //     return $this->_get_data('lastname');
    // }



    // public function getDob()
    // {
    //     return $this->_get_data('dob');
    // }

    // public function setInstagramlink($link)
    // {
    //     return $this->_set_data('instagram', $link);
    // }

    // public function getInstagramlink()
    // {
    //     return $this->_get_data('instagram');
    // }

    // public function setTwitterlink($link)
    // {
    //     return $this->_set_data('twitter', $link);
    // }

    // public function getTwitterlink()
    // {
    //     return $this->_get_data('twitter');
    // }
    // public function setFacebooklink($link)
    // {
    //     return $this->_set_data('facebook', $link);
    // }

    // public function getFacebooklink()
    // {
    //     return $this->_get_data('facebook');
    // }







    
}               