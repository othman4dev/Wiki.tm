<?php

    namespace app\models\author;

    use App\models\connection;
    use App\models\UserModel;

    class AuthorModel {

        public static function createWiki($title, $description, $body, $author_id, $category, $tags) {
            $title = HTMLspecialchars($title);
            $description = HTMLspecialchars($description);
            $sqlx = "SELECT COUNT(*) FROM wikis WHERE title = ?";
            $stmtx = connection::connect()->prepare($sqlx);
            $stmtx->execute([$title]);
            $titlex = $stmtx->fetch();
            if ($titlex['COUNT(*)'] == 0) {
                $sql = "INSERT INTO wikis (title, description, body, author_id, category_id) VALUES (?, ?, ? ,? ,?)";
                $sql2 = "INSERT INTO wiki_tag (wiki_id, tag_id) VALUES (?, ?)";
                $sql3 = "SELECT * FROM wikis WHERE title = ? AND author_id = ? AND category_id = ? AND description = ? AND body = ?";
                $stmt = connection::connect()->prepare($sql);
                $stmt->execute([$title, $description, $body, $author_id, $category]);
                $stmt2 = connection::connect()->prepare($sql3);
                $stmt2->execute([$title, $author_id, $category, $description, $body]);
                $id = $stmt2->fetch();
                foreach ($tags as $tag) {
                    $stmt3 = connection::connect()->prepare($sql2);
                    $stmt3->execute([$id['id'], $tag]);
                }
                return true;
            } else {
                return false;
            }
        }
        public static function updateWiki($id, $title, $description, $body, $author_id, $category, $tags) {
            $title = HTMLspecialchars($title);
            $description = HTMLspecialchars($description);
            $sql = "DELETE FROM wikis WHERE id = ? ;";
            $sqladd = "INSERT INTO wikis (id,title,description,body,category_id,author_id) VALUES ( ? , ? , ? , ? , ? , ?)";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$id ]);
            $sql2 = "DELETE FROM wiki_tag WHERE wiki_id = ?; ";
            $stmt2 = connection::connect()->prepare($sql2);
            $stmt2->execute([$id]);
            $stmtadd = connection::connect()->prepare($sqladd);
            $stmtadd->execute([$id,$title,$description,$body,$category,$author_id]);
            $sql3 = "INSERT INTO wiki_tag (wiki_id, tag_id) VALUES (?, ?)";
            foreach ($tags as $tag) {
                $stmt3 = connection::connect()->prepare($sql3);
                $stmt3->execute([$id, $tag]);
            }
            return true;
        }
        public static function deleteWiki($id) {
            $sql = "DELETE FROM wikis WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$id]);
            return true;
        }
        public static function getCategory() {
            $sql = "SELECT * FROM category";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $category = $stmt->fetchAll();
            return $category;
        }
        public static function getTags() {
            $sql = "SELECT * FROM tags";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $allTags = $stmt->fetchAll();
            return $allTags;
        }
        public static function getAuthor() {
            $sql = "SELECT * FROM wikis WHERE author_id = ? LIMIT 3";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$_SESSION['user']['id']]);
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function checkAvailability($option,$title) {
            if ($option == 'wikiTitle') {
                $sql = "SELECT * FROM wikis WHERE title = ?";
                $stmt = connection::connect()->prepare($sql);
                $stmt->execute([$title]);
                $wiki = $stmt->fetch();
                return $wiki;
            } else if ($option == 'tagTitle') {
                $sql = "SELECT * FROM tags WHERE name = ?";
                $stmt = connection::connect()->prepare($sql);
                $stmt->execute([$title]);
                $wiki = $stmt->fetch();
                return $wiki;
            } else if ($option == 'catTitle') {
                $sql = "SELECT * FROM category WHERE name = ?";
                $stmt = connection::connect()->prepare($sql);
                $stmt->execute([$title]);
                $wiki = $stmt->fetch();
                return $wiki;
            }
        }
    }