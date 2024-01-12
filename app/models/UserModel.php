<?php

    namespace App\models;

    use App\models\connection;

    class UserModel {

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
            $sql = "SELECT * FROM user WHERE email = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        }
        public static function register($email, $password, $name) {
            $sql = "INSERT INTO user (email, password, name) VALUES (?, ?, ?)";
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
        public static function userInfo() {
            $sql = "SELECT *, wikis.id as wikiID, COUNT(*) as rowCount FROM user RIGHT JOIN wikis ON user.id = wikis.author_id WHERE user.id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$_SESSION['user']['id']]);
            $user = $stmt->fetch();
            return $user;
        }
        public static function updatePassword($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET password = ? WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$hashedPassword, $_SESSION['user']['id']]);
            return true;
        }
        public static function updateName($name) {
            $sql = "UPDATE user SET name = ? WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$name, $_SESSION['user']['id']]);
            return true;
        }
        public static function updateEmail($email) {
            $sql = "UPDATE user SET email = ? WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$email, $_SESSION['user']['id']]);
            return true;
        }
    }