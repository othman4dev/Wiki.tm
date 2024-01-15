<?php
    namespace App\models\author;

    use App\models\connection;
    use App\models\UserModel;

    class HomeModel extends UserModel{
        public static function getRecent() {
            $sql = "SELECT *, category.id as categoryID , category.name as category_name , category.created_at as category_date FROM wikis JOIN category ON category_id = category.id WHERE visible = 1 ORDER BY wikis.created_at DESC LIMIT 5";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute();
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getAll() {
            $sql = "SELECT *, wikis.id as wiki_id, category.id as categoryID , category.name as category_name , category.created_at as category_date  FROM wikis LEFT JOIN category ON category_id = category.id WHERE visible = 1 ORDER BY wikis.created_at DESC;";
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
            $sql = "SELECT * , category.name as category_name , category.id as category_id , wikis.id as wiki_id FROM wikis JOIN category ON wikis.category_id = category.id WHERE author_id = ? AND visible = 1 ORDER BY RAND() LIMIT 3";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$author_id]);
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getSameAuthorAll($author_id) {
            $sql = "SELECT * , category.name as category_name , category.id as category_id , wikis.id as wiki_id FROM wikis JOIN category ON wikis.category_id = category.id WHERE author_id = ? AND visible = 1 ORDER BY wikis.created_at DESC";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$author_id]);
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getCategory($category) {
            $sql = "SELECT * , category.name as category_name , category.id as category_id , wikis.id as wiki_id FROM wikis JOIN category ON category_id = category.id WHERE category.name = ? AND visible = 1 ORDER BY wikis.created_at DESC";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$category]);
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
        public static function getTagsCount() {
            $sql = "SELECT SUM(tag_count) AS total_tag_count
            FROM (
                SELECT wikis.*, COUNT(wiki_tag.tag_id) AS tag_count 
                FROM wikis 
                LEFT JOIN wiki_tag ON wikis.id = wiki_tag.wiki_id 
                WHERE wikis.author_id = ?
                GROUP BY wikis.id
            ) AS subquery";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$_SESSION['user']['id']]);
            $tagsCount = $stmt->fetchAll();
            return $tagsCount;
        }
        public static function getCategoryCount() {
            $sql = "SELECT COUNT(*) as rowCount
            FROM wikis
            WHERE author_id = ?";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$_SESSION['user']['id']]);
            $categoryCount = $stmt->fetchAll();
            return $categoryCount;
        }
        public static function search($search) {
            $tags = HomeModel::getTags();
            $sql = "SELECT DISTINCT wikis.*, category.name as category_name , wikis.id as wikis_id
            FROM wikis 
            INNER JOIN wiki_tag ON wiki_tag.wiki_id = wikis.id 
            LEFT JOIN category ON wikis.category_id = category.id 
            WHERE visible = 1 AND ( title LIKE ? OR description LIKE ? OR body LIKE ? OR category.name LIKE ? )
            ORDER BY wikis.created_at DESC 
            LIMIT 10 OFFSET 0;";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute(['%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%']);
            $wikis = $stmt->fetchAll();
            $results = '';
            foreach ($wikis as $wiki) {
                $results = $results . '
                <a href="/wiki?id='.$wiki['wikis_id'].'"><div class="result">
                    <div class="title-img">
                        '.substr($wiki['title'], 0 , 2).'
                    </div>
                    <div class="title-result">
                        <p>'.$wiki['title'].'</p>
                        <div class="tags">
                            ';
                            foreach ($tags as $tag) {
                                if ($tag['wiki_id'] == $wiki['wikis_id']) {
                                    $results = $results . '<span class="tag">'.$tag['name'].'</span>';
                                }
                            }
                            $results = $results . '
                            <span class="category-wiki">'.$wiki['category_name'].'</span>
                        </div>
                    </div>
                </div></a>
                ';
            }
            if (empty($wikis)) {
                $results = '<div class="result"><div style="color:#00000030;"><i class="bi bi-ban">&nbsp;&nbsp;</i>No Result</div></div>';
            }
            return $results;
        }
        public static function searchTag($search) {
            $tags = HomeModel::getTags();
            $sql = "SELECT * , wikis.id as wikis_id , category.name as category_name FROM wikis JOIN category ON wikis.category_id = category.id JOIN wiki_tag ON wikis.id = wiki_tag.wiki_id JOIN tags ON wiki_tag.tag_id = tags.id WHERE tags.name LIKE ? AND visible = 1 ORDER BY wikis.created_at DESC LIMIT 10 OFFSET 0";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute(['%'.$search.'%',]);
            $wikis = $stmt->fetchAll();
            $results = '';
            foreach ($wikis as $wiki) {
                $results = $results . '
                <a href="/wiki?id='.$wiki['wikis_id'].'"><div class="result">
                    <div class="title-img">
                        '.substr($wiki['title'], 0 , 2).'
                    </div>
                    <div class="title-result">
                        <p>'.$wiki['title'].'</p>
                        <div class="tags">
                            ';
                            foreach ($tags as $tag) {
                                if ($tag['wiki_id'] == $wiki['wikis_id']) {
                                    $results = $results . '<span class="tag">'.$tag['name'].'</span>';
                                }
                            }
                            $results = $results . '
                            <span class="category-wiki">'.$wiki['category_name'].'</span>
                        </div>
                    </div>
                </div></a>
                ';
            }
            if (empty($wikis)) {
                $results = '<div class="result"><div style="color:#00000030;"><i class="bi bi-ban">&nbsp;&nbsp;</i>No Result</div></div>';
            }
            return $results;
        }
        public static function getCategoryId($id) {
            $sql = "SELECT * , category.name as category_name , category.id as category_id , wikis.id as wiki_id FROM wikis JOIN category ON category_id = category.id WHERE category.id = ? AND visible = 1 ORDER BY wikis.created_at DESC";
            $stmt = connection::connect()->prepare($sql);
            $stmt->execute([$id]);
            $wikis = $stmt->fetchAll();
            return $wikis;
        }
    }