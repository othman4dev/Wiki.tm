<?php
    namespace App\models;

    class connection {
        private $host = "localhost";
        private $dbname = "wiki";
        private $username = "root";
        private $password = "";
        private $conn;

        public static function connect() {
            $conn = new \PDO("mysql:host=localhost;dbname=wiki", "root", "");
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
    }

?>