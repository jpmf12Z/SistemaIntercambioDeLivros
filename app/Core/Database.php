<?php
namespace App\Core;
use PDO;

class Database {
    private static $instance = null;
    public static function getConnection() {
        if(self::$instance === null) {
            $host = '127.0.0.1'; $db='bookswap'; $user='root'; $pass='';
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            self::$instance = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        return self::$instance;
    }
}
