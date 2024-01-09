<?php
    namespace app\models\author;

    use app\models\connection;
    use app\models\user;

    class Home extends User{
        public static function getRecent($x) {
            $sql = "SELECT * FROM wikis ORDER BY created_at DESC LIMIT ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$x]);
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getAll() {
            $sql = "SELECT * FROM wikis";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
    }