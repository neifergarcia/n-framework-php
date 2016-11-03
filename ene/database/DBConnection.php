<?php

class DBConnection
{

    static private $conn;
    static private $lastError = null;
    static private $connected = false;

    static function connect()
    {
        try {
            $driver = DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            self::$conn = new PDO($driver, DB_USER, DB_PASS);
            self::$conn->exec("SET NAMES UTF-8");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$connected = true;
        } catch (PDOException $e) {
            self::$lastError = $e;
        }
    }

    static function connection(){
        return self::$conn;
    }

    static function isConnected(){
        return self::$connected;
    }

    static function getLastError()
    {
        return self::$lastError;
    }

    static function close()
    {
        self::$conn = null;
        self::$connected = false;
    }


}