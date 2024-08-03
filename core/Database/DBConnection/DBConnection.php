<?php

namespace Core\Database\DBConnection;

use PDO;
use PDOException;

class DBConnection
{
    private static $DBConnectionInstance = null;

    private function __construct()
    {
    }

    public static function GetDBConnection()
    {
        if (self::$DBConnectionInstance == null) {
            $DBConnectionInstance = new DBConnection();
            self::$DBConnectionInstance = $DBConnectionInstance->dbConnection();
        }
        return self::$DBConnectionInstance;
    }

    public function dbConnection()
    {
        $dbname = DB_NAME;
        $servername = DB_HOST;
        $username = DB_USER;
        $password = DB_PASS;
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        try {
            return new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function newInsertedId()
    {
        return self::getDBConnection()->lastInsertId();
    }
}