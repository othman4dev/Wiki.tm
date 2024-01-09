<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/style/style.css">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../../public/assets/images/favicon.svg" type="image/x-icon">
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
                <h1>Wiki's Title</h1>
                <p>Wiki's category</p>
            </div>
            <div class="card big">
                <h2 style="display: flex;align-items: center;gap: 15px;">
                    <div class="image-wiki">
                        <div>
                            BE
                        </div>
                    </div>
                    Best Cars Manifacturers
                </h2>
                <p class="des">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                </p>
                <div class="tags">
                    <span># tag1</span>
                    <span># tag1</span>
                    <span># tag1</span>
                </div>
                <article>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo autem, earum ullam nihil possimus eius aliquid nostrum quisquam laudantium sed quasi. Fugit libero dolore repellat delectus cum expedita fugiat nobis.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo autem, earum ullam nihil possimus eius aliquid nostrum quisquam laudantium sed quasi. Fugit libero dolore repellat delectus cum expedita fugiat nobis.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo autem, earum ullam nihil possimus eius aliquid nostrum quisquam laudantium sed quasi. Fugit libero dolore repellat delectus cum expedita fugiat nobis.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo autem, earum ullam nihil possimus eius aliquid nostrum quisquam laudantium sed quasi. Fugit libero dolore repellat delectus cum expedita fugiat nobis.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo autem, earum ullam nihil possimus eius aliquid nostrum quisquam laudantium sed quasi. Fugit libero dolore repellat delectus cum expedita fugiat nobis.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo autem, earum ullam nihil possimus eius aliquid nostrum quisquam laudantium sed quasi. Fugit libero dolore repellat delectus cum expedita fugiat nobis.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo autem, earum ullam nihil possimus eius aliquid nostrum quisquam laudantium sed quasi. Fugit libero dolore repellat delectus cum expedita fugiat nobis.

                </article>
            </div>
            <div class="card-inv"><h1>Same Author :</h1></div>
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
<script src="../../public/assets/script/script.js"></script>