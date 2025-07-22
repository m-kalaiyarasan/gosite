<?php

class Wordpress{

    public function setupWordPress($user_id, $port) {
        $base_dir = __DIR__."/../../../wp/$user_id";
        print($base_dir);

        // Ensure directories exist
        if (!is_dir("$base_dir/html")) {
            mkdir("$base_dir/html", 0777, true);
        }
        if (!is_dir("$base_dir/db")) {
            mkdir("$base_dir/db", 0777, true);
        }

        // Generate the docker-compose
        $docker_compose_content = <<<EOL
    # version: '3.8'

services:
  wordpress:
    image: wordpress:latest
    container_name: wp_$user_id
    restart: always
    ports:
      - "$port:80"
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: wpuser
      WORDPRESS_DB_PASSWORD: wppassword
      WORDPRESS_DB_NAME: wpdatabase
    volumes:
      - ./html:/var/www/html
    networks:
      - wp_network

  db:
    image: mysql:5.7
    container_name: db_$user_id
    restart: always
    environment:
      MYSQL_DATABASE: wpdatabase
      MYSQL_USER: wpuser
      MYSQL_PASSWORD: wppassword
      MYSQL_ROOT_PASSWORD: rootpassword
    volumes:
      - ./db:/var/lib/mysql
    networks:
      - wp_network

networks:
  wp_network:
EOL;


        // Write the docker-compose file
        file_put_contents("$base_dir/docker-compose.yml", $docker_compose_content);

        // Start the Docker containers
        $output = shell_exec(" sudo docker-compose -f $base_dir/docker-compose.yml up -d");

        return [
            "status" => "success",
            "message" => "WordPress for $user_id is now running on port $port",
            "output" => $output,
            "docker_compose_path" => "$base_dir/docker-compose.yml",
            "port" => $port,
            "user_id" => $user_id,
            "base_dir" => $base_dir,
        ];
    }

    public function findAvailablePort($start = 8081, $end = 9000) {
        // $user_id = 5;
        // $base_dir = __DIR__."../../../../wp/$user_id";
        // if (!is_dir("$base_dir/html")) {
        //     mkdir("$base_dir/html", 0777, true);
        // }
        // print($base_dir);
        for ($port = $start; $port <= $end; $port++) {
            $connection = @fsockopen("localhost", $port);
            if (!$connection) {
                return $port;  // Port is free, return it
            }
            fclose($connection);
        }
        return false; // No available ports
    }
    public function findLastPort() {
      $conn = Database::getConnection();
      $username = Session::get('session_user');
      $sql = "SELECT * FROM `config` WHERE `id` = '1' ";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
          $row = $result->fetch_assoc();
          return $row['port_count'];
      }else{
          return false;
      }
    }
    public function updatePortCount($port) {
        $conn = Database::getConnection();
        $sql = "UPDATE `config` SET `port_count` = '$port' WHERE `id` = '1'";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function setDetails($user_id,$port,$base_dir,$docker_compose_path) {
        $conn = Database::getConnection();
        $sql = "INSERT INTO `config` (`user_id`, `port`, `base_dir`, `docker_compose_path`) VALUES ('$user_id', '$port', '$base_dir', '$docker_compose_path')";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }

        
    }

// Get user ID and port from request (POST method recommended)


// $user_id = $_POST['user_id'] ?? 'default_user';
// $port = $_POST['port'] ?? 8080;

// $response = setupWordPress($user_id, $port);

// // Return JSON response
// header('Content-Type: application/json');
// echo json_encode($response);



}