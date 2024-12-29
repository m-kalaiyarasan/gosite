<?php

//this file is used to edit or change the apache configuration files

class Conf
{

    public static function changeapacheConfig($name,$newDirName) {   
        global $workdone;

        $apacheConfigFile = '/etc/apache2/sites-available/gosite.template.conf';
        $apacheConfig = file_get_contents($apacheConfigFile);
        $newApacheConfig = str_replace('DocumentRoot /var/www/html', "DocumentRoot $newDirName", $apacheConfig);
        $newApacheConfig = str_replace('ServerName gosite.in', "ServerName $name.gosite.in", $newApacheConfig);
        
        $newfile = '/etc/apache2/sites-available/'.$name.'.gosite.conf';
        if (file_put_contents($newfile, $newApacheConfig)) {
            echo "Apache config updated successfully.\n<br>";
            $workdone = $workdone + 1;
            return $workdone;
        } else {
            echo "Failed to update Apache config.\n<br>";
        }
    }
    
}