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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
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
                <h1>Dashboard</h1>
                <p>Most recent Wikis</p>
            </div>
            <?php 
            extract($data);
            ?>
            <div class="card big">
                <table id="myTable2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Wikis</th>
                            <th>Role</th>
                            <th>Joined in</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['wikiCount'] ?></td>
                            <td>
                            <?php
                                if ($user['role'] == 'user') {
                                    echo 'Author';
                                } else if ($user['role'] == 'admin') {
                                    echo ucfirst($user['role']);
                                } else {
                                    echo 'Banned';
                                }
                            ?>
                            </td>
                            <td><?php echo $user['created_at'] ?></td>
                            <td>
                                <?php
                                if ($user['role'] == 'banned') {
                                    echo '
                                    <a href="/admin/unban?id='.$user['id'].'">
                                        <button class="table-btn">
                                            Unban
                                            <i class="bi bi-person-check-fill"></i>
                                        </button>
                                    </a>
                                    ';
                                } else if($user['role'] == 'user') {
                                    echo '
                                    <a href="/admin/ban?id='.$user['id'].'">
                                        <button class="table-btn">
                                            Ban
                                            <i class="bi bi-ban"></i>
                                        </button>
                                    </a>
                                    ';
                                }
                                
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
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
<script>
    $('#myTable2').DataTable( {
    scrollY: 400
} );
</script>