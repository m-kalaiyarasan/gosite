<?php

/*
// This is a class file, used to just connect the database in anywhere in this project just using "Database::getconnection"

class Database{

    public static $conn;

    public static function getConnection()
    {
        if(Database::$conn == null)
        {
            $servername = "mysql.selfmade.ninja:3306";
            $username = "kalaiyarasan";
            $password = "MKYsna#2004@";
            $dbname = "";

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

*/


// This class provides a reusable connection to the database
// Use "Database::getConnection()" to connect anywhere in the project

class Database {

    public static $conn; // Static property to store the database connection

    public static function getConnection() {
        if (Database::$conn == null) {
            // Database credentials
            $servername = get_config('server');;
            $port = get_config('port');;
            $username = get_config('username');;
            $password = get_config('password'); // Replace with your actual 
            $dbname = get_config('dbname');;
            $ssl_ca = get_config('ssl');; // Path to your CA certificate
            

            // Create connection
            $connection = mysqli_init();

            // Configure SSL
            if (!mysqli_ssl_set($connection, NULL, NULL, $ssl_ca, NULL, NULL)) {
                die("Failed to configure SSL: " . mysqli_error($connection));
            }

            // Establish connection
            if (!mysqli_real_connect($connection, $servername, $username, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Store the connection for reuse
            Database::$conn = $connection;
            return Database::$conn;
        } else {
            // Return the existing connection
            return Database::$conn;
        }
    }
}
