<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style/style.css">
    <link rel="stylesheet" href="/assets/style/login.css">
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
        </div>
    </header>
    <main class="main-login">
        <div class="auth">
            <div class="login">
                <form action="/login/verify" onsubmit="event.preventDefault()" method="post" class="ini-form" id="login-form">
                    <div class="login-header">
                        <i class="bi bi-person-circle" style="font-size: 48px;"></i>
                        <h2>Login</h2>
                    </div>
                    <label>
                        <p class="moved">Email</p>
                        <input type="text" class="inp" id="email-login" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" name="email" required>
                    </label>
                    <label>
                        <p class="moved">Password</p>
                        <input type="password" min="6" id="pass-login" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" name="password" required>
                    </label>
                    <?php 
                    if (isset($_GET['login']) && $_GET['login'] == 'failed') {
                        echo '<p class="error-text">Incorrect username or password</p>';
                    }
                    ?>
                    <a href="/reset">Forgot Password ?</a>
                    <input type="submit" value="Login" onclick="validation('login')" name="login">
                </form>
            </div>
            <div class="register">
                <form onsubmit="return false;">
                    <h1 class="white">Welcome To Wiki.tm</h1>
                    <div class="bg-white">
                        <img class="logo-middle" style="height:50px;margin-top:0px" src="/assets/images/wikis.svg" alt=""><h1>iki.tm</h1>
                    </div>
                    <p class="white">Don't have an Account ?. Sign Up Now !</p>
                    <button class="sign-up" onclick="toggleAuth(2)">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer">
            <div class="footer-left">
                <img src="/assets/images/wikis.svg" alt="wiki.tm" class="logo" style="height: 30px;">
                <h2>iki.tm</h2>
            </div>
            <div class="footer-right">
                <p>© 2024 Wiki.tm</p>
            </div>
    </footer>
</body>
<script src="/assets/script/script.js"></script>