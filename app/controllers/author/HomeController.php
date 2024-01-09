<?php 
    namespace app\controllers\author;

    use app\controllers\controller;
    use app\models\author\User;

    class HomeController extends Controller {

        public function index() {
            $this->view('author/home', User::getRecent(5));
        }
        public function account() {
            $this->view('author/account');
        }
        public function books() {
            $this->view('author/books');
        }
        public function gaming() {
            $this->view('author/gaming');
        }
        public function cars() {
            $this->view('author/cars');
        }
        public function technologies() {
            $this->view('author/technologies');
        }
        public function science() {
            $this->view('author/science');
        }
        public function others() {
            $this->view('author/others');
        }
    }