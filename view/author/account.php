<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/style/style.css">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../../public/assets/images/favicon.svg" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/w5o6851coln6uxz4eqge6bq0qi2ez0n5zwyprq67sybzjlf9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Welcome to Wiki.tm</title>
</head>
<body>
    <header>
        <div class="flex-center">
            <img src="../../public/assets/images/wikis.svg" alt="wiki.tm" class="logo-top">
            <h2>iki.tm</h2>
            <div class="search-div">
                <input type="text" class="search" name="search" placeholder="Search">
                <i class="bi bi-search" style="cursor: pointer;"></i>
            </div>
        </div>
        <div class="account" onclick="showAccount()">
            <i class="bi bi-person-circle"></i>
            <span style="font-size: 20px;">Account</span>
            <i class="bi bi-caret-down" style="font-size: 15px;"></i>
        </div>
        <div class="account-down" id="accDown">
            <div class="account-info">
                <div class="account-all">
                    <i class="bi bi-person-circle"></i>
                    <div class="account-info-text">
                        <p class="username">Username</p>
                        <p class="mail">example@email.com</p>
                    </div>
                </div>
                <a href="account.php">
                    <li class="account-btn"><i class="bi bi-person"></i>Account</li>
                </a>
                <a href="../login.php">
                    <li class="account-btn"><i class="bi bi-box-arrow-left"></i>Logout</li>
                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="left-side">
            <h4 class="subs">General</h4>
            <div class="category">
                <a onclick="redirect('home')"><li class="current home"><i class="bi bi-table"></i> &nbsp; Dashboard</li></a>
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
                <h1>Profile</h1>
            </div>
            <div class="card profile-card">
                <h1 style="font-size: 70px;"><i class="bi bi-person-circle"></i></h1>
                <div>
                    <h2>Username</h2>
                    <p>example@email.com</p>
                </div>
                <div class="status">
                    <div class="stat">
                        <h3>Wikis</h3>
                        <p>0</p>
                    </div>
                    <div class="stat">
                        <h3>Followers</h3>
                        <p>0</p>
                    </div>
                    <div class="stat">
                        <h3>Following</h3>
                        <p>0</p>
                    </div>
                    <div class="stat">
                        <h3>Comments</h3>
                        <p>0</p>
                    </div>
                </div>
            </div>
            <div class="card-2" style="justify-content: space-between;align-items: center;">
                <h1>What do you have in mind ?</h1>
                <div class="back" onclick="showWiki('show')">
                    Add A Wiki <i class="bi bi-plus-circle"></i>
                </div>
            </div>
            <div class="card wiki-in" id="wikiModal">
                <form action="" method="post" style="gap: 10px;">
                    <i class="bi bi-x-lg" id="ex" onclick="showWiki('hide')"></i>
                    <label class="label-title">
                        <p class="moved">Title</p>
                        <input type="text" name="title" class="wiki-inp" placeholder="Wiki's Title" required>
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
                    <textarea name="body" class="wiki-text" required></textarea>
                    <div class="selects">
                        <label>Category
                            <select class="select-category" style="width: 100%;height: 50px;" required>
                                <option value="books">Books</option>
                                <option value="gaming">Gaming</option>
                                <option value="cars">Cars</option>
                                <option value="technologies">Technologies</option>
                                <option value="science">Science</option>
                                <option value="others">Others</option>
                            </select>
                        </label>
                        <label for="">Tags
                            <select class="select-tags-" multiple="multiple" style="width: 100%;height: 50px;">
                                <option value="books"># Books</option>
                                <option value="gaming"># Gaming</option>
                                <option value="cars"># Cars</option>
                                <option value="technologies"># Technologies</option>
                                <option value="science"># Science</option>
                                <option value="others"># Others</option>
                            </select>
                        </label>
                    </div>
                    <div class="card-2" style="justify-content: end;margin: 20px;padding-right: 50px;">
                        <button class="back">
                            Post <i class="bi bi-arrow-right-square-fill"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-inv"><h1>Your Work :</h1></div>
            <div class="card-2">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>
            <div class="card-2">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>
            <div class="card-inv">
                <a href="home.php">
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
        theme: "classic"
    });

</script>
<script src="../../public/assets/script/script.js" ></script>