<?php 
    extract($data);
    if(!isset($_SESSION['user'])) {
        header('Location: /login');
    }  else if ($_SESSION['user']['role'] == 'user') {
        header('Location: /author/home');
    } else if ($_SESSION['user']['role'] != 'admin') {
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
            <div class="category" style="display:none"></div>
            <h4 class="subs">General</h4>
            <div class="category">
                <a href="/admin/home"><li class="home"><i class="bi bi-clipboard2-data-fill"></i> &nbsp; Statistics</li></a>
                <a href="/admin/allwikis"><li class="allwikis"><i class="bi bi-wikipedia"></i> &nbsp; Wikis</li></a>
                <a href="/admin/users"><li class="users"><i class="bi bi-person-circle"></i> &nbsp; Users</li></a>
                <a href="/admin/categories"><li class="categories"><i class="bi bi-columns-gap"></i> &nbsp; Categories</li></a>
                <a href="/admin/alltags"><li class="alltags"><i class="bi bi-hash"></i></i> &nbsp; Tags</li></a>
            </div>
            <div class="divi" onclick="hideSide(this)">
                <p><i class="bi bi-caret-left-fill" style="rotate:90deg" id="side-carret"></i></p>
            </div>
        </div>
        <div class="main">
            <div class="card-inv">
                <h1>Tags</h1>
                <p>All Tags available</p>
            </div>
            <?php 
            extract($data);
            ?>
            <div class="card big" style="padding:20px !important">
                <h1 style="margin-bottom:15px">All tags</h1>
                <p style="margin-bottom:15px">Click on a tag to see options</p>
                <div class="tags-flex">
                    <?php
                    foreach ($tags as $tag) {
                        echo '<span class="tag-test" onclick="tagModal('.$tag['id'].',\''.$tag['name'].'\')"># '.$tag['name'].'</span>';
                    }
                    ?>
                    <span class="tag-test" onclick="showAddTag()">&nbsp; + &nbsp;</span>
                </div>
            </div>
            <div class="card-2 slim">
                <button class="back" onclick="showAddTag()">
                    Add A Tag <i class="bi bi-plus"></i>
                </button>
            </div>
            <div id="tagModal">
                <form action="/404" id="actionHere" method="post" class="cat-edit" onsubmit="event.preventDefault();">
                    <label for="">
                        <p id="moved">
                            Tag name
                        </p>
                        <input autocomplete="off" spellcheck="false" type="text" class="inp-acc" id="valueHere" name="name">
                    </label>
                    <input type="text" style="display:none" id="idHere" name="id">
                    <div class="delete-btns">
                        <div class="back success" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'">Cancel</div>
                        <div class="back help" onclick="submit('edit')">Edit <i class="bi bi-pencil-square"></i></div></a>
                        <div class="back danger" onclick="submit('delete')">Delete <i class="bi bi-trash"></i></div>
                    </div>
                </form>
            </div>
            <div id="addTagModal">
                <form action="/admin/addTag" method="post" class="cat-edit">
                    <label for="">
                        <p id="moved">
                            Tag name
                        </p>
                        <input autocomplete="off" spellcheck="false" type="text" class="inp-acc" name="name">
                    </label>
                    <div class="delete-btns">
                        <div class="back success" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'">Cancel</div>
                        <button class="back" role="submit">Add <i class="bi bi-plus-circle-fill"></i></button></a>
                    </div>
                </form>
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