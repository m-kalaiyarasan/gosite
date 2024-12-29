<?php

class UserDetails{

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

    private function _get_data($var){
        if(!$this->conn){
            $this->conn = Database::getConnection();
        }
        
        //neeeed to alter
        $sql = "SELECT `$var` FROM `users` WHERE `id` = $this->id"; 
        
        
        $result = $this->conn->query($sql);
        if ($result and $result->num_rows == 1){
            
            return $result->fetch_assoc()["$var"];  
            
        }
        else {
            return null;
        }
    }
    private function _set_data($var, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        
        //neeeed to alter
        $sql = "UPDATE `users` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    // public function setDomain($domain){
        
    // }
    // public function setPath($path){
        
    // }
    // public function setPlan($plan){

    // }

    // public function getDomain(){

    // }
    // public function getPath(){

    // }
    // public function getPlan(){

    // }

}