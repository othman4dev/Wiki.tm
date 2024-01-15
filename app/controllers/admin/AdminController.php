<?php

    namespace App\controllers\admin;

    use App\Controller;
    use App\models\UserModel;
    use App\models\author\HomeModel;
    use App\models\author\AuthorModel;
    use App\models\admin\AdminModel;

    class AdminController {
        public static function adminHome() {
            $data['statistic'] = AdminModel::getStats();
            $controller = new \App\Controller();
            $controller->view('admin/home', $data);
        }
        public static function adminAccount() {
            $data['user'] = UserModel::userInfo();
            $data['category'] = AuthorModel::getCategory();
            $data['allTags'] = AuthorModel::getTags();
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = AuthorModel::getAuthor();
            $data['same'] = HomeModel::getSameAuthor($_SESSION['user']['id']);
            $data['tagsCount'] = HomeModel::getTagsCount();
            $data['categoryCount'] = HomeModel::getCategoryCount();
            $controller = new \App\Controller();
            $controller->view('admin/account', $data);
        }
        public static function turnAuthor() {
            $data['user'] = UserModel::userInfo();
            $data['category'] = AuthorModel::getCategory();
            $data['allTags'] = AuthorModel::getTags();
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = AuthorModel::getAuthor();
            $data['same'] = HomeModel::getSameAuthor($_SESSION['user']['id']);
            $data['tagsCount'] = HomeModel::getTagsCount();
            $data['categoryCount'] = HomeModel::getCategoryCount();
            $controller = new \App\Controller();
            $controller->view('admin/account', $data);
            $_SESSION['user']['role'] = 'user';
            $controller->view('author/account', $data);
        }
        public static function adminUsers() {
            $data['users'] = AdminModel::getUsers();
            $controller = new \App\Controller();
            $controller->view('admin/users', $data);
        }
        public static function adminWikis() {
            $data['wikis'] = AdminModel::getWikis();
            $data['tags'] = HomeModel::getTags();
            $controller = new \App\Controller();
            $controller->view('admin/allwikis', $data);
        }
        public static function adminTags() {
            $data['tags'] = AdminModel::getTags();
            $controller = new \App\Controller();
            $controller->view('admin/tags', $data);
        }
        public static function adminCategories() {
            $data['categories'] = AdminModel::getCategories();
            $controller = new \App\Controller();
            $controller->view('admin/categories', $data);
        }
        public static function deleteCat() {
            $id = $_GET['id'];
            if ($_SESSION['user']['role'] == 'admin') {
                AdminModel::deleteCat($id);
                $data['categories'] = AdminModel::getCategories();
                $controller = new \App\Controller();
                $controller->view('admin/categories', $data);
            } else {
                $controller = new \App\Controller();
                $controller->view('error');
            }
            
        }
        public static function editCat() {
            $id = $_POST['id'];
            $name = $_POST['name'];
            if ($_SESSION['user']['role'] == 'admin') {
                AdminModel::editCat($id, $name);
                $data['categories'] = AdminModel::getCategories();
                $controller = new \App\Controller();
                $controller->view('admin/categories', $data);
            } else {
                $controller = new \App\Controller();
                $controller->view('error');
            }
        }
        public static function addCat() {
            $name = $_POST['name'];
            if ($_SESSION['user']['role'] == 'admin') {
                AdminModel::addCat($name);
                $data['categories'] = AdminModel::getCategories();
                $controller = new \App\Controller();
                $controller->view('admin/categories', $data);
            } else {
                $controller = new \App\Controller();
                $controller->view('error');
            }
        }
        public static function adminWiki() {
            $data['wikis'] = HomeModel::getThis();
            extract($data);
            $data['same'] = HomeModel::getSameAuthor($wikis['author_id']);
            $data['tags'] = HomeModel::getTags();
            $data['allTags'] = AuthorModel::getTags();
            $controller = new \App\Controller();
            $controller->view('/admin/wiki', $data);
        }
        public static function editTag() {
            $id = $_POST['id'];
            $name = $_POST['name'];
            if ($_SESSION['user']['role'] == 'admin') {
                AdminModel::editTag($id, $name);
                $data['tags'] = AdminModel::getTags();
                $controller = new \App\Controller();
                $controller->view('admin/tags', $data);
            } else {
                $controller = new \App\Controller();
                $controller->view('error');
            }
        }
        public static function deleteTag() {
            $id = $_POST['id'];
            if ($_SESSION['user']['role'] == 'admin') {
                AdminModel::deleteTag($id);
                $data['tags'] = AdminModel::getTags();
                $controller = new \App\Controller();
                $controller->view('admin/tags', $data);
            } else {
                $controller = new \App\Controller();
                $controller->view('error');
            }
        }
        public static function addTag() {
            $name = $_POST['name'];
            if ($_SESSION['user']['role'] == 'admin') {
                AdminModel::addTag($name);
                $data['tags'] = AdminModel::getTags();
                $controller = new \App\Controller();
                $controller->view('admin/tags', $data);
            } else {
                $controller = new \App\Controller();
                $controller->view('error');
            }
        }
        public static function archive() {
            if ($_SESSION['user']['role'] == 'admin') {
                AdminModel::archive();
                $data['wikis'] = AdminModel::getWikis();
                $data['tags'] = HomeModel::getTags();
                $controller = new \App\Controller();
                $controller->view('admin/allwikis', $data);
            } else {
                $controller = new \App\Controller();
                $controller->view('error');
            }
        }
        public static function unarchive() {
            if ($_SESSION['user']['role'] == 'admin') {
                AdminModel::unarchive();
                $data['wikis'] = AdminModel::getWikis();
                $data['tags'] = HomeModel::getTags();
                $controller = new \App\Controller();
                $controller->view('admin/allwikis', $data);
            } else {
                $controller = new \App\Controller();
                $controller->view('error');
            }
        }
    }