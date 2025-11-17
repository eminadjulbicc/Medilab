<?php
class Database {


    public static function connect() {
        $host = "localhost";
        $db_name = "medilab";
        $username = "root";
        $password = "";
        $conn = null;
        try {
            $conn = new PDO(
                "mysql:host=" . $host . ";dbname=" . $db_name,
                $username,
                $password
            );
            $conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $conn;
    }
}
