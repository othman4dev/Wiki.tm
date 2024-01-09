<?php
    namespace app\models;

    class connection {
        private $host = "localhost";
        private $dbname = "wiki";
        private $username = "root";
        private $password = "";
        private $conn;

        public function __construct() {
            try {
                $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

?>