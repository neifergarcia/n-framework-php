<?php

class Session{

    static $SESSION_STARTED = FALSE;

    static private function init(){
        if(!self::$SESSION_STARTED){
            session_start();
            self::$SESSION_STARTED = TRUE;
        }
    }

    static function doLogin($usuario){
        self::init();

        $_SESSION["username"] = $usuario;
    }

    static function getUser(){

        self::init();
        if(isset($_SESSION["username"])) return $_SESSION["username"];
        else return null;
    }

    static function doLogout(){

        self::init();

        session_unset();
        session_destroy();
        self::$SESSION_STARTED = FALSE;

    }

    public static function set($key, $value){
        self::init();

        $_SESSION[$key] = $value;
    }

    public static function get($key){
        self::init();

        $value = null;
        if(isset($_SESSION[$key]))
            $value = $_SESSION[$key];
        unset($_SESSION[$key]);

        return $value;
    }
}