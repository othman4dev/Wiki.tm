let side = true;
let current = "home";
let account = false;
let sideForm1 = `
<div class="register">
    <form onsubmit="return false;">
        <h1 class="white">Welcome To Wiki.tm</h1>
        <div class="bg-white">
            <img src="../public/assets/images/wikis.svg" alt=""><h1>iki.tm</h1>
        </div>
        <p class="white">Don't have an Account ? .Sign Up Now !</p>
        <button class="sign-up" onclick="toggleAuth(0)">
            Sign Up
        </button>
    </form>
</div>
`;
let sideForm2 = `
<div class="register">
    <form onsubmit="return false;">
        <h1 class="white">Welcome To Wiki.tm</h1>
        <div class="bg-white">
            <img src="../public/assets/images/wikis.svg" alt=""><h1>iki.tm</h1>
        </div>
        <p class="white">Already have an Account ? .Login Now !</p>
        <button class="sign-up" onclick="toggleAuth(1)">
            Login
        </button>
    </form>
</div>
`;
let login = `
<form action="../public/index.php?route=login" method="post" class="ini-form">
    <div class="login-header">
        <i class="bi bi-person-circle" style="font-size: 48px;"></i>
        <h2>Login</h2>
    </div>
    <label>
        <p class="moved">Email</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" name="email" required>
    </label>
    <label>
        <p class="moved">Password</p>
        <input type="password" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" name="password" required>
    </label>
    <a href="reset.php">Forgot Password ?</a>
    <input type="submit" value="Login" name="login">
</form>
`;
let register = `
<form action="../public/index.php?route=register" method="post"  onsubmit="return false;" class="ini-form">
    <div class="login-header">
        <i class="bi bi-person-circle" style="font-size: 48px;"></i>
        <h2>Register</h2>
    </div>
    <label>
        <p class="moved">Full Name</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" name="name" required>
    </label>
    <label>
        <p class="moved">Email</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" name="email"required>
    </label>
    <label>
        <p class="moved">New Password</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" name="password" required id="pass1" autocomplete="off">
    </label>
    <label>
        <p class="moved">Rewrite Password</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" required id="pass2" autocomplete="off">
    </label>
    <input type="submit" value="Create Account" name="register" onclick="verifyPassword()">
</form>
`;
if (localStorage.getItem("side") == null) {
    side = true;
    localStorage.setItem("side", JSON.stringify(side));
} else {
    side = JSON.parse(localStorage.getItem("side"));
}
if (localStorage.getItem("current") == null) {
    current = 'home';
    localStorage.setItem("current", current);
} else {
    current = localStorage.getItem("current");
    document.querySelector(`.${current}`).classList.add("current");
    console.log(current);
}
function hideSide() {
    let width = document.querySelector(".left-side").offsetWidth;
    let masked = width - 60;
    let lis = document.querySelectorAll('.category')[1].querySelectorAll('li');
    let lis2 = document.querySelectorAll('.category')[0].querySelectorAll('li');
    if (side == true) {
        document.querySelector(".left-side").style.transition = "all 0.5s";
        document.querySelector(".left-side").style.marginLeft = `-${masked}px`;
        document.getElementById("side-carret").style.transform = "rotate(180deg)";
        console.log(lis);
        setTimeout(() => {
            lis.forEach(element => {
                element.style.flexDirection = "row-reverse";
            });
            lis2.forEach(element => {
                element.style.flexDirection = "row-reverse";
            });
        }, 500);
        side = false;
        localStorage.setItem("side", JSON.stringify(side));
    } else {
        document.querySelector(".left-side").style.transition = "all 0.5s";
        document.querySelector(".left-side").style.marginLeft = `0px`;
        document.getElementById("side-carret").style.transform = "rotate(0deg)";
        lis.forEach(element => {
            element.style.flexDirection = "row";
        });
        lis2.forEach(element => {
            element.style.flexDirection = "row";
        });
        side = true;
        localStorage.setItem("side", JSON.stringify(side));
    }
}
function hideSide2() {
    let width = document.querySelector(".left-side").offsetWidth;
    let masked = width - 60;
    let lis = document.querySelectorAll('.category')[1].querySelectorAll('li');
    let lis2 = document.querySelectorAll('.category')[0].querySelectorAll('li');
    if (side == true) {
        document.querySelector(".left-side").style.transition = "all 0s";
        document.querySelector(".left-side").style.marginLeft = `-${masked}px`;
        document.getElementById("side-carret").style.transform = "rotate(180deg)";
        console.log(lis);
        setTimeout(() => {
            lis.forEach(element => {
                element.style.flexDirection = "row-reverse";
            });
            lis2.forEach(element => {
                element.style.flexDirection = "row-reverse";
            });
        }, 500);
        side = false;
        localStorage.setItem("side", JSON.stringify(side));
    } else {
        document.querySelector(".left-side").style.transition = "all 0.5s";
        document.querySelector(".left-side").style.marginLeft = `0px`;
        document.getElementById("side-carret").style.transform = "rotate(0deg)";
        lis.forEach(element => {
            element.style.flexDirection = "row";
        });
        lis2.forEach(element => {
            element.style.flexDirection = "row";
        });
        side = true;
        localStorage.setItem("side", JSON.stringify(side));
    }
}
function setSide() {
    if (side == false) {
        side = true;
        hideSide2();
        document.getElementById("side-carret").style.transform = "rotate(180deg)";
        let lis = document.querySelectorAll('.category')[1].querySelectorAll('li');
        let lis2 = document.querySelectorAll('.category')[0].querySelectorAll('li');
        lis.forEach(element => {
            element.style.flexDirection = "row-reverse";
        });
        lis2.forEach(element => {
            element.style.flexDirection = "row-reverse";
        });
    }
}
setSide();
function redirect(e) {
    localStorage.removeItem("current");
    localStorage.setItem("current", e);
    goTo(e);
}
function goTo(e) {
    if (e == 'home') {
        window.location.href = "home.php";
    } else {
        console.log(e);
        window.location.href = "category.php?category=" + e;
    }
}
function showAccount() {
    if (account == false) {
        document.querySelector("#accDown").style.display = "flex";
        account = true;
    } else {
        document.querySelector("#accDown").style.display = "none";
        account = false;
    }
}
function moveUp(e) {
    let parent = e.parentElement;
    let moved = parent.querySelector(".moved");
    moved.style.top = "-15px";
}
function moveDown(e) {
    let parent = e.parentElement;
    let moved = parent.querySelector(".moved");
    moved.style.top = "-15px";
    if (e.value == "") {
        moved.style.top = "9px";
    } else {
        moved.style.top = "-15px";
    }
}
function toggleAuth(e) {
    if (e == 1) {
        document.querySelector(".login").style.order = "0";
        document.querySelector(".register").outerHTML = sideForm1;
        document.querySelector(".ini-form").outerHTML = login;
    } else {
        document.querySelector(".login").style.order = "1";
        document.querySelector(".register").outerHTML = sideForm2;
        document.querySelector(".ini-form").outerHTML = register;
    }
}
function verifyPassword() {
    let pass1 = document.getElementById("pass1").value;
    let pass2 = document.getElementById("pass2").value;
    if (pass1 == pass2) {
        document.querySelector(".ini-form").submit();
    } else {
        document.getElementById("pass2").setCustomValidity("Passwords Don't Match");
    }
}
function showWiki(option) {
    if (option == 'show') {
        document.getElementById("wikiModal").style.display = "flex";
    } else {
        document.getElementById("wikiModal").style.display = "none";
    }
}
