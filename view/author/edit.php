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
            <div class="card wiki-in">
                <form action="/update" method="post" style="gap: 10px;" class="wiki-form" onsubmit="return false;">
                <input type="text"  value="<?=$_GET['id']?>" style="display:none;" name="id">
                    <i class="bi bi-x-lg" id="ex" onclick="showWiki('hide')"></i>
                    <label class="label-title">
                        <p class="moved">Title</p>
                        <input type="text" name="title" class="wiki-inp" placeholder="Wiki's Title" required value="<?=$wiki['title']?>">
                    </label>
                    <label class="label-title">
                        <p class="moved">Description</p>
                        <input type="text" name="description" class="wiki-inp" placeholder="Wiki's Description" value="<?=$wiki['description']?>" required>
                    </label>
                    <script>
                        tinymce.init({
                          selector: '.wiki-text',
                          plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
                          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                          tinycomments_mode: 'embedded',
                          tinycomments_author: 'Author name',
                          mergetags_list: [
                            { value: 'First.Name', title: 'First Name' },
                            { value: 'Email', title: 'Email' },
                          ],
                          ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                        });
                      </script>
                      <label class="label-title">
                        <p class="moved">Body</p>
                        <textarea name="body" class="wiki-text" placeholder="Wiki's Body" required ><?=$wiki['body']?></textarea>
                      </label>
                    <div class="selects">
                        <label>Category
                            <select class="select-category" style="width: 100%;height: 50px;" name="category" required>
                                <?php
                                    foreach($data['category'] as $category) {
                                        if ($category['id'] == $wiki['category_id']) {
                                            echo '<option value="'.$category['id'].'" selected> '.$category['name'].'</option>';
                                        } else {
                                            echo '<option value="'.$category['id'].'"> '.$category['name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </label>
                        <label for="">Tags
                            <select class="select-tags-" multiple="multiple" style="width: 100%;height: 50px;" name="tags" id="tags-select" onchange="retreiveData(this)">
                                <?php
                                foreach ($tags as $tag) {
                                    if ($tag['wiki_id'] == $wiki['wiki_id']) {
                                        echo '<option value="'.$tag['tag_id'].'" selected> '.$tag['name'].'</option>';
                                    }
                                }
                                foreach ($allTags as $allTag) {
                                    echo '<option value="'.$allTag['id'].'"> '.$allTag['name'].'</option>';
                                }
                                ?>
                            </select>
                            <input type="text" style="display:none" name="tags-json" id="tags-json">
                        </label>
                    </div>
                    <div class="card-2" style="justify-content: end;margin: 20px;padding-right: 50px;">
                        <a href="/account" href="/accounts">
                            <button class="back">
                            <i class="bi bi-arrow-left-square-fill"></i> Cancel
                            </button>
                        </a>
                        <button class="back" type="submit" onclick="this.parentNode.parentNode.submit()">
                            Save <i class="bi bi-arrow-right-square-fill"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-inv"><h1>Your Work :</h1></div>
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
                        </div>
                        <div class="card-btn">
                            <a href="/delete?id='.$sameWiki['wiki_id'].'"<button class="delete-btn">Delete <i class="bi bi-trash"></i></button></a>
                            <a href="/edit?id='.$sameWiki['wiki_id'].'"<button class="edit-btn">Edit <i class="bi bi-pencil-square"></i></button></a>
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
    retreiveData(document.getElementById('tags-select'));
</script>
