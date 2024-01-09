<?php

    namespace app\models\author;

    use app\models\connection;
    use app\modals\user;

    class Author extends User{

        public static function createWiki($title, $body, $author_id) {
            $sql = "INSERT INTO wikis (title, content, author_id) VALUES (?, ?, ?)";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$title, $content, $author_id]);
            return true;
        }
        public static function updateWiki($title, $body, $author_id) {
            $sql = "UPDATE wikis SET title = ?, content = ? WHERE author_id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$title, $content, $author_id]);
            return true;
        }
        public static function deleteWiki($title, $body, $author_id) {
            $sql = "DELETE FROM wikis WHERE author_id = ? AND title = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$author_id , $title]);
            return true;
        }
    }