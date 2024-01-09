<?php

    namespace app\models\user;

    use app\models\connection;

    class User {

        public $id;

        public $name;

        public $email;

        public $password;

        public $role;

        public function __construct($id, $name, $email, $password, $role) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }
        public static function login($email, $password) {
            $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$email, $password]);
            $user = $stmt->fetch();
            return $user;
        }
        public static function register($email, $password, $name) {
            $sql = "INSERT INTO users (email, password, name) VALUES (?, ?, ?)";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$email, $password, $name]);
            return true;
        }
        public static function displayWiki($id) {
            $sql = "SELECT * FROM wikis WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$id]);
            $wiki = $stmt->fetch();
            return $wiki;
        }
        public static function account($userID) {
            $sql = "SELECT * FROM users RIGHT JOIN wikis ON user.id = wikis.user_id WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$userID]);
            $user = $stmt->fetch();
            return $user;
        }
    }