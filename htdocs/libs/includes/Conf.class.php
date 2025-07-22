<?php

//this file is used to edit or change the apache configuration files

class Conf
{

    public static function changeapacheConfig($name,$newDirName) {   
        global $workdone;

        $apacheConfigFile = '/etc/apache2/sites-available/000-default.conf';
        $apacheConfig = file_get_contents($apacheConfigFile);
        $newApacheConfig = str_replace('DocumentRoot /var/www/html', "DocumentRoot $newDirName", $apacheConfig);
    

        

        $newApacheConfig = str_replace('ServerName www.example.com', "ServerName $name", $newApacheConfig);
        
        $newfile = '/etc/apache2/sites-available/'.$name.".conf";
        if (file_put_contents($newfile, $newApacheConfig)) {
            echo "Apache config updated successfully.\n<br>";
            return $workdone;
        } else {
            echo "Failed to update Apache config.\n<br>";
        }
    }

  
    //write a function to delete the apache config file
    public static function deleteapacheConfig($name) {
        global $workdone;
        $apacheConfigFile = '/etc/apache2/sites-available/'.$name.".conf";
        if (unlink($apacheConfigFile)) {
            echo "Apache config deleted successfully.\n<br>";
            return $workdone;
        } else {
            echo "Failed to delete Apache config.\n<br>";
        }
    }
    public static function deletesslConfig($name) {
        global $workdone;
        $apacheConfigFile = '/etc/apache2/sites-available/'.$name;
        if (unlink($apacheConfigFile)) {
            echo "Apache config deleted successfully.\n<br>";
            return $workdone;
        } else {
            echo "Failed to delete Apache config.\n<br>";
        }
    }

    //write a class to reload apache
    public static function reloadApache() {
        $output = shell_exec('sudo service apache2 reload || service apache2 reload');
        echo "Apache reloaded successfully.\n<br>";
    }

    //write a method to a2disconf the site
    public static function disableSite($name) {
        $output = shell_exec('sudo a2dissite '.$name.'.conf || a2dissite '.$name.'.conf');
        echo "Site disabled successfully.\n<br>";
    }
    //write a method to a2enconf the site
    public static function enableSite($name) {
        $output = shell_exec('sudo a2ensite '.$name.'.conf || a2ensite '.$name.'.conf');
        echo "Site enabled successfully.\n<br>";
    }

    //write a method to delete the folder
    public static function deleteFolder($name) {
        if($name){
        $output = shell_exec('rm -rf '.__DIR__."/../../../site/".$name);
        echo $output;
        echo "Folder deleted successfully.\n<br>";
        }
    }

    public static function renameFolder($name , $rename) {
        if($name){
        $output = shell_exec('mv '.__DIR__."/../../../site/".$name." ".__DIR__."/../../../site/".$rename);
        echo $output;
        echo "Folder rename successfully.\n<br>";
        }
    }

    public static function updateApacheConf($name , $rename) {
        if($name){
        $output = shell_exec("mv /etc/apache2/sites-enabled/".$name.".conf /etc/apache2/sites-enabled/".$rename.".conf");
        echo $output;
        echo "apache2 updated successfully.\n<br>";
        }
    }
    public static function confssl2($domain) {
        if($domain){
        $output = shell_exec("certbot --apache --non-interactive --agree-tos --email gosite.site@gmail.com --redirect --keep-until-expiring --config-dir /var/www/html/ApacheConfig/letsencrypt/certbot-config --work-dir /var/www/html/ApacheConfig/letsencrypt/certbot-work --logs-dir /var/www/html/ApacheConfig/letsencrypt/certbot-logs -d ".$domain);
        echo $output;
        echo "ssl updated successfully.\n<br>";
        }
    }
    public static function confssl($domain) {
        if ($domain) {
            $webroot = "/var/www/html/site".$domain;
            $certbotCommand = "certbot certonly --webroot -w $webroot --non-interactive --agree-tos --email gosite.site@gmail.com --keep-until-expiring --config-dir /var/www/html/ApacheConfig/letsencrypt/certbot-config --work-dir /var/www/html/ApacheConfig/letsencrypt/certbot-work --logs-dir /var/www/html/ApacheConfig/letsencrypt/certbot-logs -d ".$domain;
            
            shell_exec($certbotCommand);
    
            // Define the Apache configuration content
            $apacheConfig = "
    <VirtualHost *:80>
        ServerName $domain
        Redirect permanent / https://$domain/
    </VirtualHost>
    
    <VirtualHost *:443>
        ServerName $domain
        DocumentRoot /var/www/html/site/$domain
    
        SSLEngine on
        SSLCertificateFile /var/www/html/ApacheConfig/letsencrypt/certbot-config/live/$domain/fullchain.pem
        SSLCertificateKeyFile /var/www/html/ApacheConfig/letsencrypt/certbot-config/live/$domain/privkey.pem
    
        <Directory /var/www/html>
            AllowOverride All
            Require all granted
        </Directory>
    
        ErrorLog \${APACHE_LOG_DIR}/error.log
        CustomLog \${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>";
    
            // Save Apache config file
            $configPath = "/etc/apache2/sites-available/$domain.conf";
            file_put_contents($configPath, $apacheConfig);
    
            // Enable site and reload Apache
            shell_exec("a2ensite $domain.conf");
            shell_exec("a2enmod ssl");
            shell_exec("service apache2 reload");
    
            echo "SSL configured successfully for $domain\n<br>";
        }
    }
    

    public static function delconfssl($domain) {
        if($domain){
        $output = shell_exec("certbot delete --cert-name $domain --config-dir /var/www/html/ApacheConfig/letsencrypt/certbot-config --work-dir /var/www/html/ApacheConfig/letsencrypt/certbot-work --logs-dir /var/www/html/ApacheConfig/letsencrypt/certbot-logs");
        echo $output;
        echo "ssl updated successfully.\n<br>";
        }
    }

    
}