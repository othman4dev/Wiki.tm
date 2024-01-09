<?php

    namespace app;

    use app\Models\User;
    use app\routes\controller;

    class Login {
        public function index() {
            $this->view('login');
        }
        public function login() {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = User::login($email, $password);
            if ($user && $user['role'] === 'author') {
                $_SESSION['user'] = $user;
                $this->view('author/home');
            } else if ($user && $user['role'] === 'admin') {
                $_SESSION['user'] = $user;
                $this->view('admin/home');
            } else {
                $this->view('login?error=1');
            }
        }
        public function register() {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $user = User::register($email, $password, $name);
            if ($user) {
                $this->view('author/home');
            } else {
                $this->view('register?error=1');
            }
        }
        public function logout() {
            session_destroy();
            header('location: /');
        }
    }