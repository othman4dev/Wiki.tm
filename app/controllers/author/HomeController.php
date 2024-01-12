<?php 
    namespace App\controllers\author;

    use App\Controller;
    use App\models\UserModel;
    use App\models\author\HomeModel;
    use App\models\author\AuthorModel;

    class HomeController extends Controller {

        public function index() {
            $data['wikis'] = HomeModel::getAll();
            $data['tags'] = HomeModel::getTags();
            $this->view('/author/home', $data);
        }
        public function login() {
            $this->view('login');
        }
        public function account() {
            $data['user'] = UserModel::userInfo();
            $data['category'] = AuthorModel::getCategory();
            $data['allTags'] = AuthorModel::getTags();
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = AuthorModel::getAuthor();
            $data['same'] = HomeModel::getSameAuthor($_SESSION['user']['id']);
            $this->view('author/account', $data);
        }
        public function category() {
            $this->view('author/category');
        }
        public function cars() {
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = HomeModel::getCategory('cars');
            $this->view('author/category' , $data);
        }
        public function books() {
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = HomeModel::getCategory('books');
            $this->view('author/category' , $data);
        }
        public function technologies() {
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = HomeModel::getCategory('technologies');
            $this->view('author/category' , $data);
        }
        public function others() {
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = HomeModel::getCategory('others');
            $this->view('author/category' , $data);
        }
        public function science() {
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = HomeModel::getCategory('science');
            $this->view('author/category' , $data);
        }
        public function gaming() {
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = HomeModel::getCategory('gaming');
            $this->view('author/category' , $data);
        }
        public function wiki() {
            $data['wikis'] = HomeModel::getThis();
            extract($data);
            $data['same'] = HomeModel::getSameAuthor($wikis['author_id']);
            $data['tags'] = HomeModel::getTags();
            $data['allTags'] = AuthorModel::getTags();
            $this->view('author/wiki', $data);
        }
    }