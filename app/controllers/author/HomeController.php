<?php 
    namespace App\controllers\author;

    use App\Controller;
    use App\models\UserModel;
    use App\models\author\HomeModel;
    use App\models\author\AuthorModel;
    use App\models\admin\AdminModel;

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
            $data['tagsCount'] = HomeModel::getTagsCount();
            $data['categoryCount'] = HomeModel::getCategoryCount();
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
        public function error() {
            $this->view('error');
        }
        public function notFound() {
            $this->view('404');
        }
        public function wikis() {
            $data['user'] = UserModel::userInfo();
            $data['category'] = AuthorModel::getCategory();
            $data['allTags'] = AuthorModel::getTags();
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = AuthorModel::getAuthor();
            $data['same'] = HomeModel::getSameAuthorAll($_SESSION['user']['id']);
            $data['tagsCount'] = HomeModel::getTagsCount();
            $data['categoryCount'] = HomeModel::getCategoryCount();
            $this->view('author/wikis', $data);
        }
        public function search() {
            $data['wikis'] = HomeModel::search($_GET['search']);
            echo $data['wikis'];
        }
        public function searchTag() {
            $data['wikis'] = HomeModel::searchTag($_GET['search']);
            echo $data['wikis'];
        }
        public static function categories() {
            $data['categories'] = AdminModel::getCategories();
            $controller = new \App\Controller();
            $controller->view('author/categories', $data);
        }
        public static function getCategoryId() {
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = HomeModel::getCategoryId($_GET['id']);
            $controller = new \App\Controller();
            $controller->view('author/category', $data);
        }
        public static function banned() {
            $controller = new \App\Controller();
            $controller->view('/banned');
        }
    }