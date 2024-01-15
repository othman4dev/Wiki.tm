<?php 
    namespace App\controllers\author;

    use App\Controller;
    use App\models\UserModel;
    use App\models\author\HomeModel;
    use App\models\author\AuthorModel;

    class AuthorController
    {
        public static function createWiki() {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $body = $_POST['body'];
            $author_id = $_SESSION['user']['id'];
            $tags_json = $_POST['tags-json'];
            $tags = json_decode($tags_json);
            $category = $_POST['category'];
            $wiki = AuthorModel::createWiki($title, $description, $body, $author_id, $category, $tags);
            $controller = new \App\Controller();
            if ($wiki == true ) {
                $data['user'] = UserModel::userInfo();
                $data['category'] = AuthorModel::getCategory();
                $data['all-tags'] = AuthorModel::getTags();
                $data['tags'] = HomeModel::getTags();
                $data['wikis'] = AuthorModel::getAuthor();
                $data['same'] = HomeModel::getSameAuthor($_SESSION['user']['id']);
                $controller->view('/author/account', $data);
            } else {
                $controller->view('/error');
            }
        }
        public static function editWiki() {
            $controller = new \App\Controller();
            $data['wiki'] = HomeModel::getThis();
            $data['user'] = UserModel::userInfo();
            $data['category'] = AuthorModel::getCategory();
            $data['allTags'] = AuthorModel::getTags();
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = AuthorModel::getAuthor();
            $data['same'] = HomeModel::getSameAuthor($_SESSION['user']['id']);
            $controller->view('/author/edit', $data);
        }
        public static function updateWiki() {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $body = $_POST['body'];
            $author_id = $_SESSION['user']['id'];
            $tags_json = $_POST['tags-json'];
            $tags = json_decode($tags_json);
            $category = $_POST['category'];
            $wiki = AuthorModel::updateWiki($id, $title, $description, $body, $author_id, $category, $tags);
            $controller = new \App\Controller();
            if ($wiki) {
                $data['user'] = UserModel::userInfo();
                $data['category'] = AuthorModel::getCategory();
                $data['all-tags'] = AuthorModel::getTags();
                $data['tags'] = HomeModel::getTags();
                $data['wikis'] = AuthorModel::getAuthor();
                $data['same'] = HomeModel::getSameAuthor($_SESSION['user']['id']);
                $controller->view('author/account' , $data);
            } else {
                $controller->view('/error');
            }
        }
        public static function deleteWiki() {
            $wiki = AuthorModel::deleteWiki($_GET['id']);
            $controller = new \App\Controller();
            if ($wiki) {
                $data['user'] = UserModel::userInfo();
                $data['category'] = AuthorModel::getCategory();
                $data['allTags'] = AuthorModel::getTags();
                $data['tags'] = HomeModel::getTags();
                $data['wikis'] = AuthorModel::getAuthor();
                $data['same'] = HomeModel::getSameAuthor($_SESSION['user']['id']);
                $controller->view('author/account' , $data);
            } else {
                $controller->view('/error');
            }
        }
        public static function editAccount() {
            if (!empty($_POST['old-password']) && !empty($_POST['password'])) {
                if (password_verify($_POST['old-password'], $_SESSION['user']['password'])) {
                    $data['success'] = UserModel::updatePassword($_POST['old-password'], $_POST['password']);
                } else {
                    $data['message'] = 'Password is incorrect';
                }
            }
            if (!empty($_POST['name'])) {
                $data['success'] = UserModel::updateName($_POST['name']);
            }
            $email = $_POST['email'];
            if (!empty($email)) {
                $data['success'] = UserModel::updateEmail($email);
            }
            $controller = new \App\Controller();
            $data['user'] = UserModel::userInfo();
            $data['category'] = AuthorModel::getCategory();
            $data['allTags'] = AuthorModel::getTags();
            $data['tags'] = HomeModel::getTags();
            $data['wikis'] = AuthorModel::getAuthor();
            $data['same'] = HomeModel::getSameAuthor($_SESSION['user']['id']);
            $data['tagsCount'] = HomeModel::getTagsCount();
            $data['categoryCount'] = HomeModel::getCategoryCount();
            $controller->view('/author/account', $data);
        }
        
    }