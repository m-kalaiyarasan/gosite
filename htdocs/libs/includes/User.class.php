
<?php

class User {
    public $conn;
    public $username;
    public $id;


    public static function signup($user, $pass, $email, $phone) {
  
        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();
        $sql = "INSERT INTO auth (username, password, email, phone, blocked, active) 
                VALUES (?,?,?,?, '0', '1');";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $user, $pass, $email, $phone);
        $result = false;    
        if ($stmt->execute()) {
            $result = true;
        } 
        else {
            $result = false;    
        }
        $conn->close();
        return $result;
    }

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

}