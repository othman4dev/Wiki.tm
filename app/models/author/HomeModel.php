<?php
    namespace App\models\author;

    use App\models\connection;
    use App\models\UserModel;

    class HomeModel extends UserModel{
        public static function getRecent() {
            $sql = "SELECT *, category.id as categoryID , category.name as category_name , category.created_at as category_date FROM wikis JOIN category ON category_id = category.id ORDER BY wikis.created_at DESC LIMIT 5";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getAll() {
            $sql = "SELECT *, wikis.id as wiki_id, category.id as categoryID , category.name as category_name , category.created_at as category_date  FROM wikis LEFT JOIN category ON category_id = category.id  ORDER BY wikis.created_at DESC;";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getTags() {
            $sql2 = "SELECT * FROM wiki_tag LEFT JOIN tags ON tag_id = tags.id";
            $stmt2 = connection::connect()->prepare($sql2);
            $stmt2->execute();
            $tags = $stmt2->fetchAll();
            return $tags;
        }
        public static function getThis() {
            $sql = "SELECT * , category.name as category_name , category.id as category_id , wikis.id as wiki_id FROM wikis JOIN category ON category_id = category.id WHERE wikis.id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$_GET['id']]);
            $wiki = $stmt->fetch();
            return $wiki;
        }
        public static function getSameAuthor($author_id) {
            $sql = "SELECT * , category.name as category_name , category.id as category_id , wikis.id as wiki_id FROM wikis JOIN category ON wikis.category_id = category.id WHERE author_id = ? ORDER BY RAND() LIMIT 3";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$author_id]);
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getCategory($category) {
            $sql = "SELECT * , category.name as category_name , category.id as category_id , wikis.id as wiki_id FROM wikis JOIN category ON category_id = category.id WHERE category.name = ? ORDER BY wikis.created_at DESC";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$category]);
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
    }