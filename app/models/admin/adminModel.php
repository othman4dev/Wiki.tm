<?php 

    namespace App\models\admin;

    use App\models\connection;
    use App\models\UserModel;


    class AdminModel {
        public static function getStats() {
            $sql = "SELECT COUNT(*) FROM wikis";
            $sql2 = "SELECT COUNT(*) FROM tags";
            $sql3 = "SELECT COUNT(*) FROM category";
            $sql4 = "SELECT COUNT(*) FROM user WHERE role = 'user'";
            $sql5 = "SELECT COUNT(*) FROM user WHERE role = 'admin'";
            $sql6 = "SELECT COUNT(*) FROM wiki_tag";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $wikis['wikisCount'] = $stmt->fetch();
            $stmt2 = connection::connect()->prepare($sql2);
            $stmt2->execute();
            $wikis['tagsCount'] = $stmt2->fetch();
            $stmt3 = connection::connect()->prepare($sql3);
            $stmt3->execute();
            $wikis['categoryCount'] = $stmt3->fetch();
            $stmt4 = connection::connect()->prepare($sql4);
            $stmt4->execute();
            $wikis['usersCount'] = $stmt4->fetch();
            $stmt5 = connection::connect()->prepare($sql5);
            $stmt5->execute();
            $wikis['adminCount'] = $stmt5->fetch();
            $stmt6 = connection::connect()->prepare($sql6);
            $stmt6->execute();
            $wikis['tagUseCount'] = $stmt6->fetch();
            return $wikis;
        }
        public static function getUsers() {
            $sql = "SELECT user.*, COUNT(wikis.id) AS wikiCount FROM user LEFT JOIN wikis ON user.id = wikis.author_id GROUP BY user.id";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll();
            return $users;
        }
        public static function getWikis() {
            $sql = "SELECT *, wikis.id as wikis_id , user.name as author_name , category.name as category_name FROM wikis JOIN category ON category_id = category.id JOIN user ON author_id = user.id ORDER BY wikis.created_at DESC";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getTags() {
            $sql = "SELECT * FROM tags";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $tags = $stmt->fetchAll();
            return $tags;
        }
        public static function getCategories() {
            $sql = "SELECT * FROM category";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll();
            return $categories;
        }
        public static function deleteCat($id) {
            $sql = "DELETE FROM category WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$id]);
            return true;
        }
        public static function editCat($id, $name) {
            $sql = "UPDATE category SET name = ? WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$name, $id]);
            return true;
        }
        public static function addCat($name) {
            $sql = "INSERT INTO category (name) VALUES (?)";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$name]);
            return true;
        }
        public static function deleteTag($id) {
            $sql = "DELETE FROM tags WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$id]);
            return true;
        }
        public static function editTag($id, $name) {
            $sql = "UPDATE tags SET name = ? WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$name, $id]);
            return true;
        }
        public static function addTag($name) {
            $sql = "INSERT INTO tags (name) VALUES (?)";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$name]);
            return true;
        }
        public static function archive() {
            $sql = "UPDATE wikis SET visible = 0 WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$_GET['id']]);
            return true;
        }
        public static function unarchive() {
            $sql = "UPDATE wikis SET visible = 1 WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$_GET['id']]);
            return true;
        }
        public static function ban($id) {
            $sql = "UPDATE user SET role = 'banned' WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$id]);
            return true;
        }
        public static function unban($id) {
            $sql = "UPDATE user SET role = 'user' WHERE id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$id]);
            return true;
        }
    }