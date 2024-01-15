<?php

    namespace App\controllers;

    use App\models\UserModel;
    use App\Controller;

    class LoginController {
        public static function index() {
            Controller->view('/login');
        }
        public static function login() {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = UserModel::login($email, $password);
            if ($user && $user['role'] === 'user') {
                $_SESSION['user'] = $user;
                header('Location: /home');
            } else if ($user && $user['role'] === 'admin') {
                $_SESSION['user'] = $user;
                header('Location: /admin');
            } else {
                header('Location: /login?login=failed');
            }
        }
        public static function register() {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $name = $_POST['name'];
            $user = UserModel::register($email, $hashedPassword, $name);
            if ($user) {
                header('Location: /login');
            } else {
                header('Location: /error');
            }
        }
        public static function logout() {
            session_destroy();
            header('Location: /login');
        }
    }