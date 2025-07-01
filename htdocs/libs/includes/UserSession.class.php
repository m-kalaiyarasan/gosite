
<?php



class UserSession
{
    public $conn;
    public $id;
    public $uid;
    public $data;
    public $token;


    public static function authenticate($user, $pass)
    {
        $username = User::login($user,$pass);
         print($username);
        $user = new User($username);
        if($username){
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $fingerprint = $_POST['fingerprint'];                         
            $token = md5(rand(0,9999).$ip.$agent.time());
            $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`,`fingerprint`) 
            VALUES ('$user->id', '$token', now(), '$ip', '$agent', '1','$fingerprint')";
            if($conn->query($sql))
            {
                Session::set('session_token',$token);
                Session::set('fingerprint',$fingerprint);
                return $token;
            }
            else{ return false; }
        }else{ return false; }
    }

    public static function authorize($token)
    {
        // print("40");
         try{
        $session = new UserSession($token);
         if($session->isValid() and $session->isActive())
         {
            // print("45");
            if($_SESSION['fingerprint'] == $session->getFingerprint())
            {   
                return true;
            }
            else
            {
                $session->deactivate();
                throw new ExceException("Fingerprint did not match");
            }
         }else {
            // print("60");
            throw new Exception("agent or an ip doesnot match");
         }
         }
         catch(Exception $e){
            print($e);
            return false;

         }
    }

    public function __construct($token){
        $this->conn = Database::getConnection();
        $this->token = $token;
        // $this->token=null;
        $sql= "SELECT * FROM `session` WHERE `token`= '$token' LIMIT 1";     // mark
        $result = $this->conn->query($sql);
        // print_r($result);
        if($result->num_rows){  
            $row=$result->fetch_assoc();
            $this->data=$row;
            $this->uid=$row['uid'];
            $this->id = $row['id'];
            // print($this->uid);
        }
        else{
            throw new Exception("session does't exist");
        }
    }

    public function getUser()
    {
        return new User($this->uid);
    }

    public function getIP(){
        $this->conn = Database::getConnection();
        $sql = "SELECT * FROM `session` WHERE `token`='$this->token' LIMIT 1";   // mark
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['ip'];
    }

    public function getUserAgent(){
        $this->conn = Database::getConnection();
        $sql = "SELECT * FROM `session` WHERE `token`='$this->token' LIMIT 1";   // mark
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['user_agent'];

    }

    public function isValid(){
        // print($this->getUserAgent());
        // echo "<br>";
        // print($this->getIP());
        // echo "<br>";

        if($_SERVER['HTTP_USER_AGENT'] == $this->getUserAgent() || $_SERVER['REMOTE_ADDR'] == $this->getIP()){
            return true;
        }
        else{
            return false;
        }
    }

    public function deactivate(){
        $this->conn = Database::getConnection();
        $sql = "UPDATE `session` SET `active` = '0' WHERE ((`id` = '$this->id'));";   // mark
        $result = $this->conn->query($sql);

    }

    public function isActive()
    {
        if (isset($this->data['active'])) {
            return $this->data['active'] ? true : false;
        }
    }

    public function getFingerprint(){
        if (isset($this->data['fingerprint'])) {
            return $this->data['fingerprint'];
        }
        else{
            return false;
        }
    }

    public static function isAdmin(){
        if($_SESSION['session_user'] == "kalai")
        {
            return true;
        }
        else{
            return false;
        }
    }

}
?>