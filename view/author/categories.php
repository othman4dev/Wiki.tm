<?php 
    extract($data);
    if(!isset($_SESSION['user'])) {
        header('Location: /login');
    }  else if ($_SESSION['user']['role'] == 'admin') {
        header('Location: /admin/home');
    } else if ($_SESSION['user']['role'] != 'user') {
        header('Location: /404');
    }
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
            <img src="/assets/images/wikis.svg" alt="wiki.tm" class="logo-top">
            <h2>iki.tm</h2>
            <div class="search-div">
                <input type="search" onkeyup="ajaxSearch(this)" id="search" autocomplete="off" spellcheck="false" class="search" name="search" placeholder="Search Anything">
                <input type="search" onkeyup="ajaxSearchTags(this)" id="searchTags" autocomplete="off" spellcheck="false" class="search" name="search" placeholder="Search With Tags">
                <i class="bi bi-search" style="cursor: pointer;"></i>
            </div>
            <div id="searchDrop">
                <div class="result">
                    <img src="/assets/images/loading.svg" class="loading" alt="">
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
                <a href="/accounts">
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
                <a href="/home"><li class="home"><i class="bi bi-table"></i> &nbsp; Dashboard</li></a>
                <a href="/accounts"><li class="accounts"><i class="bi bi-person-circle"></i> &nbsp; Account</li></a>
            </div>
            <h4 class="subs">Categories</h4>
            <div class="category">
                <a href="/category/books"><li class="books"><i class="bi bi-book-half"></i> Books</li></a>
                <a href="/category/gaming"><li class="gaming"><i class="bi bi-controller"></i> Gaming</li></a>
                <a href="/category/cars"><li class="cars"><i class="bi bi-car-front-fill"></i> Cars</li></a>
                <a href="/category/technologies"><li class="technologies"><i class="bi bi-apple"></i> Technologies</li></a>
                <a href="/category/science"><li class="science"><i class="bi bi-binoculars-fill"></i> Science</li></a>
                <a href="/category/others"><li class="others"><i class="bi bi-columns-gap"></i> Others</li></a>
                <a href="/categories"><li class="categories"><i class="bi bi-folder-fill"></i> All Categories</li></a>
            </div>
            <div class="divi" onclick="hideSide(this)">
                <p><i class="bi bi-caret-left-fill" style="rotate:90deg" id="side-carret"></i></p>
            </div>
        </div>
        <div class="main">
            <div class="card-inv">
                <h1>Dashboard</h1>
                <p>Most recent Wikis</p>
            </div>
            <?php 
            extract($data);
            ?>
            <div class="card-2 wrap">
                <?php 
                foreach ($categories as $category) {
                    echo '
                    <div class="card fixed" style="position:relative;overflow:hidden">
                    <i class="bi bi-bookmark-fill styled"></i>
                        <a href="/getCategory?id='.$category["id"].'"><h1 style="text-align:center;" class="big-link">'.$category["name"].'</h1></a>
                    </div>';
                }
                ?>
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
<script src="/assets/script/script.js" ></script>