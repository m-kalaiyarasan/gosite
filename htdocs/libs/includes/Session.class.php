<?php

// this is not related to a database but user for sessions in php to handle the session functionalities

// This is is file used to session functionalities 

    
class Session
{
    public static function start()
    {
        session_start();
    }
    public static function unset()
    {
        session_unset();
    }
    public static function destroy()
    {
        session_destroy();
    }
    public static function set($key,$value)
    {
        /*
        A session is a way to store information (in variables) to be used across multiple pages.
        Unlike a cookie, the information is not stored on the users computer.
        */
        //By default, session variables last until the user closes the browser.
        $_SESSION[$key] = $value;
    }
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }
    public static function isset($key)
    {
        return isset($_SESSION[$key]);
    }
    public static function get($key,$default = false)
    {
        if (Session::isset($key)){
            return $_SESSION[$key];
        }
        else {
            return $default;    
        }
    }
}
?>