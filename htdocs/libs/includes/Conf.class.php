<?php

//this file is used to edit or change the apache configuration files

class Conf
{

    public static function changeapacheConfig($name,$newDirName) {   
        global $workdone;

        $apacheConfigFile = '/etc/apache2/sites-available/000-default.conf';
        $apacheConfig = file_get_contents($apacheConfigFile);
        $newApacheConfig = str_replace('DocumentRoot /var/www/html', "DocumentRoot $newDirName", $apacheConfig);
        $newApacheConfig = str_replace('#ServerName www.example.com', "ServerName $name.gosite.in", $newApacheConfig);
        
        $newfile = '/etc/apache2/sites-available/'.$name.'.gosite.conf';
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
        $apacheConfigFile = '/etc/apache2/sites-available/'.$name.'.gosite.conf';
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
        $output = shell_exec('sudo a2dissite '.$name.'.gosite.conf || a2dissite '.$name.'.gosite.conf');
        echo "Site disabled successfully.\n<br>";
    }
    //write a method to a2enconf the site
    public static function enableSite($name) {
        $output = shell_exec('sudo a2ensite '.$name.'.gosite.conf || a2ensite '.$name.'.gosite.conf');
        echo "Site enabled successfully.\n<br>";
    }

    //write a method to delete the folder
    public static function deleteFolder($name) {
        $output = shell_exec('rm -rf '.__DIR__."/../../../site/".$name);
        echo "Folder deleted successfully.\n<br>";
    }
    
}