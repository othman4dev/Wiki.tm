<?php
    extract($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style/style.css">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/x-icon">
    <title>Welcome to Wiki.tm</title>
</head>
<body>
<header>
        <div class="flex-center">
            <img src="assets/images/wikis.svg" alt="wiki.tm" class="logo-top">
            <h2>iki.tm</h2>
            <div class="search-div">
                <input type="search" onkeyup="ajaxSearch(this)" id="search" autocomplete="off" spellcheck="false" class="search" name="search" placeholder="Search Anything">
                <input type="search" onkeyup="ajaxSearchTags(this)" id="searchTags" autocomplete="off" spellcheck="false" class="search" name="search" placeholder="Search With Tags">
                <i class="bi bi-search" style="cursor: pointer;"></i>
            </div>
            <div id="searchDrop">
                <div class="result">
                    <img src="assets/images/loading.svg" class="loading" alt="">
                </div>
            </div>
        </div>
        <div class="account" onclick="showAccount()">
            <i class="bi bi-person-circle"></i>
            <span style="font-size: 20px;"><?php echo $_SESSION['user']['name'] ?></span>
            <i class="bi bi-caret-down" style="font-size: 15px;"></i>
        </div>
        <div class="account-down" id="accDown">
            <div class="account-info">
                <div class="account-all">
                    <i class="bi bi-person-circle"></i>
                    <div class="account-info-text">
                        <p class="username"><?php echo $_SESSION['user']['name'] ?></p>
                        <p class="mail"><?php echo $_SESSION['user']['email'] ?></p>
                    </div>
                </div>
                <a onclick="redirect('accounts')">
                    <li class="account-btn"><i class="bi bi-person"></i>Account</li>
                </a>
                <a href="/logout">
                    <li class="account-btn"><i class="bi bi-box-arrow-left"></i>Logout</li>
                </a>
            </div>
        </div>
    </header>
    <main>
    <div class="left-side">
            <h4 class="subs">General</h4>
            <div class="category">
                <a onclick="redirect('home')"><li class="home"><i class="bi bi-table"></i> &nbsp; Dashboard</li></a>
                <a onclick="redirect('accounts')"><li class="accounts"><i class="bi bi-person-circle"></i> &nbsp; Account</li></a>
            </div>
            <h4 class="subs">Categories</h4>
            <div class="category">
                <a onclick="redirect('books')"><li class="books"><i class="bi bi-book-half"></i> Books</li></a>
                <a onclick="redirect('gaming')"><li class="gaming"><i class="bi bi-controller"></i> Gaming</li></a>
                <a onclick="redirect('cars')"><li class="cars"><i class="bi bi-car-front-fill"></i> Cars</li></a>
                <a onclick="redirect('technologies')"><li class="technologies"><i class="bi bi-apple"></i> Technologies</li></a>
                <a onclick="redirect('science')"><li class="science"><i class="bi bi-binoculars-fill"></i> Science</li></a>
                <a onclick="redirect('others')"><li class="others"><i class="bi bi-columns-gap"></i> Others</li></a>
            </div>
            <div class="divi" onclick="hideSide(this)">
                <p><i class="bi bi-caret-left-fill" style="rotate:90deg" id="side-carret"></i></p>
            </div>
        </div>
        <div class="main">
            <div class="card-inv">
                <h1><?=$wikis['title']?></h1>
                <p><?=$wikis['category']?></p>
            </div>
            <div class="card big">
                <h2 style="display: flex;align-items: center;gap: 15px;">
                    <div class="image-wiki">
                        <div>
                            <?php
                                echo strtoupper(substr($wikis['title'], 0, 2));
                            ?>
                        </div>
                    </div>
                    <?=$wikis['title']?>
                </h2>
                <p class="des">
                    <?=$wikis['description']?>
                </p>
                    <div class="tags">
                    <?php
                            foreach ($tags as $tag) {
                                if ($tag['wiki_id'] == $wikis['wiki_id']) {
                                    echo '<span># ' . $tag['name'] . '</span>';
                                }
                            }
                            echo '<span class="category-wiki">' . $wikis['category_name'] . '</span>';
                            echo '<span class="words-count">' . str_word_count($wikis['body']) . ' Words' . '</span>';
                            echo '<span class="date-wiki">' . date('d M Y', strtotime($wikis['created_at'])) . '</span>';
                        ?> 
                        </div>
                <article class="body-article">
                    <?=$wikis['body'] ?>
                </article>
            </div>
            <div class="card-inv"><h1>Same Author :</h1></div>
            <div class="card-2">
                <?php
                    foreach ($same as $sameWiki) {
                        echo '<div class="card fixed">
                        <a href="/wiki?id='.$sameWiki['wiki_id'].'" >
                        <h2 style="display: flex;align-items: center;gap: 15px;">
                            <div class="image-wiki">
                                <div>
                                    '.strtoupper(substr($sameWiki['title'], 0, 2)).'
                                </div>
                            </div>
                            '.$sameWiki['title'].'
                        </h2></a>
                        <p class="des">
                            '.$sameWiki['description'].'
                        </p>
                        <div class="tags">';?> 
                            <?php
                                foreach ($tags as $tag) {
                                    if ($tag['wiki_id'] == $sameWiki['wiki_id']) {
                                        echo '<span># ' . $tag['name'] . '</span>';
                                    }
                                }
                                echo '<span class="category-wiki">' . $sameWiki['category_name'] . '</span>';
                                echo '<span class="words-count">' . str_word_count($sameWiki['body']) . ' Words' . '</span>';
                                echo '<span class="date-wiki">' . date('d M Y', strtotime($sameWiki['created_at'])) . '</span>';
                            ?> 
                            <?php echo '
                        </div></div>';
                    }
                
                
                ?>
            
            </div>
            <div class="card-inv">
                <a href="home">
                    <button class="back">
                        <i class="bi bi-caret-left-fill"></i> Back to dashboard
                    </button>
                </a>
            </div>
            <div class="card-2">
                <div class="footer">
                    <p>© 2024 Wiki.tm</p>
                    <p>Privacy Policy</p>
                    <p>Terms of Service</p>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>
<script src="/assets/script/script.js"></script>