<?php 
    extract($data);
    if(!isset($_SESSION['user'])) {
        header('Location: /login');
    } else if ($_SESSION['user']['role'] == 'admin') {
        header('Location: /admin/accounts');
    }  else if ($_SESSION['user']['role'] != 'user') {
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/w5o6851coln6uxz4eqge6bq0qi2ez0n5zwyprq67sybzjlf9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                <h1>Profile</h1>
            </div>
            <div class="card profile-card">
                <h1 style="font-size: 70px;"><i class="bi bi-person-circle"></i></h1>
                <div>
                    <h2><?php echo $_SESSION['user']['name'] ?></h2>
                    <p><?php echo $_SESSION['user']['email'] ?></p>
                </div>
                <div class="status">
                    <div class="stat">
                        <h3>Wikis</h3>
                        <p><?=$data['user']['rowCount']?></p>
                    </div>
                    <div class="stat">
                        <h3>Tags Used</h3>
                        <p><?=$tagsCount[0]['total_tag_count']?></p>
                    </div>
                    <div class="stat">
                        <h3>Categories Used</h3>
                        <p><?=$categoryCount[0]['rowCount']?></p>
                    </div>
                    <div class="stat">
                        <h3>Member Since</h3>
                        <?= date('Y-m-d', strtotime($data['user']['created_at'])) ?>
                    </div>
                </div>
            </div>
            <div class="card-inv"><h1>Your Work :</h1></div>
            <div class="card-2 wrap">
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
                        </div>
                        <div class="card-btn">
                            <button onclick="transferHref('.$sameWiki['wiki_id'].')" class="delete-btn">Delete <i class="bi bi-trash"></i></button></a>
                            <a href="/edit?id='.$sameWiki['wiki_id'].'"><button class="edit-btn">Edit <i class="bi bi-pencil-square"></i></button></a>
                        </div>
                        
                        </div>';
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
    <div id="editAcc">
        <form action="edit/account" onsubmit="return false;" method="post">
            <h1>Edit You Account Info</h1>
            <div class="columns">
                <fieldset class="password-zone">
                    <legend><h2>Change Name Or Email</h2></legend>
                    <label><p class="moved">New Name</p><input class="inp-acc" placeholder="New Name" type="text" name="name"></label>
                    <label><p class="moved">New Email</p><input class="inp-acc" placeholder="New Email" type="email" name="email"></label>
                </fieldset>
                <fieldset class="password-zone">
                    <legend><h2>Change Password</h2></legend>
                    <label><p class="moved">Old Password</p><input class="inp-acc" placeholder="Old Password" type="text" name="old-password" id="passold"></label>
                    <label><p class="moved">New Password</p><input class="inp-acc" placeholder="(As It is)" type="text" name="password" id="pass1"></label>
                    <label><p class="moved">Confirm New Password</p><input class="inp-acc" placeholder="(As It is)" type="text" name="password" id="pass2"></label>
                </fieldset>
            </div>
            <fieldset class="danger-zone">
                <legend><h2>Danger Zone</h2></legend>
                <div class="acc-danger">
                    <button class="back danger" onclick="closeAcc()">Delete Account</button>
                    <button class="back danger" onclick="submitAcc()">Delete All Wikis</button>
                </div>
            </fieldset>
            <div class="acc-btns">
                <button class="back success" onclick="closeAcc()">Cancel</button>
                <button class="back success" type="submit" onclick="submitAcc()">Save Changes</button>
            </div>
        </form>
    </div>
    <div id="deleteModal">
            <h1>Are You Sure ?</h1>
            <p>Are you sure you want to delete this wiki ?</p>
            <div class="delete-btns">
                <button class="back success" onclick="this.parentNode.parentNode.style.display = 'none'">Cancel</button>
                <a href="/delete?id=" id="deleteHref"><button class="back danger">Delete</button></a>
            </div>
    </div>
</body>
</html>
<script>
    $('.select-category').select2({
    placeholder: 'Select an option',
    theme: "classic"
    });

    $(".select-tags-").select2({
        placeholder: 'Select an option',
        maximumSelectionLength: 4,
        theme: "classic"
    });

</script>
<script src="/assets/script/script.js" ></script>
<script>
    function retreiveData(e) {
        let data = $('#tags-select').select2('data');
        console.log(data);
        let tags = [];
        for (let i = 0; i < data.length; i++) {
            tags.push(data[i].id);
        }
        document.getElementById('tags-json').value = JSON.stringify(tags);
        console.log(document.getElementById('tags-json').value);
    }
</script>
