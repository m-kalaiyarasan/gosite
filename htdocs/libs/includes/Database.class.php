<?php

// This is a class file, used to just connect the database in anywhere in this project just using "Database::getconnection"

class Database{

    public static $conn;

    public static function getConnection()
    {
        if(Database::$conn == null)
        {
            $servername = "mysql.selfmade.ninja:3306";
            $username = "gosite";
            $password = "MKYgosite#2004@";
            $dbname = "gosite_db";

            // get_config is a function that basically write in the load.php file,
            // Used to get the login details of the database from the json file
            // That is located on the out side of this project because of safty purpose when we push this project in the git 
            // $servername = get_config('db_server');
            // $username = get_config('db_username');
            // $password = get_config('password');
            // $dbname = get_config('dbname'); 
            
            // Create connection
            $connection = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($connection->connect_error) 
            {
                die("Connection failed: " . $connection->connect_error);
            }
            else
            {
                //printf("new connection - print in Database.class.php in line 31");
                Database::$conn = $connection;
                return Database::$conn;
            }
        }
        else
        {   
            // printf("return existing connection");
            return Database::$conn;
        }

    }

}