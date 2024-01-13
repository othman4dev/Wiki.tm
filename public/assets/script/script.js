let side = true;
let current = "home";
let account = false;
let sideForm1 = `
<div class="register">
    <form onsubmit="return false;">
        <h1 class="white">Welcome To Wiki.tm</h1>
        <div class="bg-white">
            <img class="logo-middle" style="height:50px;margin-top:0px" src="/assets/images/wikis.svg" alt=""><h1>iki.tm</h1>
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
            <img class="logo-middle" style="height:50px;margin-top:0px" src="/assets/images/wikis.svg" alt=""><h1>iki.tm</h1>
        </div>
        <p class="white">Already have an Account ? .Login Now !</p>
        <button class="sign-up" onclick="toggleAuth(1)">
            Login
        </button>
    </form>
</div>
`;
let login = `
<form action="/login/verify" method="post" class="ini-form">
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
<form action="/register/verify" method="post"  onsubmit="return false;" class="ini-form">
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
console.log(window.location.href);
let position = window.location.href.split('/');
position = position[position.length - 1].split('?')[0];
let all = document.querySelectorAll(".category")[0].querySelectorAll("li");
all.forEach(element => {
    element.classList.remove("current");
});
if (position == "wiki") {
    position = "allwikis";
}
document.querySelector(`.${position}`).classList.add("current");
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
function closeAcc() {
    document.getElementById('editAcc').style.display = "none";
}
function showEdit() {
    document.getElementById('editAcc').style.display = "flex";
}
function submitAcc() {
    let pass1 = document.getElementById('pass1');
    let pass2 = document.getElementById('pass2');
    let passold = document.getElementById('passold');
    if (pass1.value != '' || pass2.value != ''|| passold.value != ''){
        if (pass1.value =='') {
            pass1.setCustomValidity('Please Fill This Feild');
        } else 
        if (pass2.value == '') {
            pass2.setCustomValidity('Please Fill This Feild');
        } else 
        if (passold.value == '') {
            passold.setCustomValidity('Please Fill This Feild');
        } else 
        if (pass1.value != pass2.value) {
            pass1.setCustomValidity("Passwords Don't not match");
        } else {
            document.getElementById('editAcc').firstElementChild.submit();
        }
    }
    if ( pass1.value == '' && pass2.value == '' && passold.value == '') {
        document.getElementById('editAcc').firstElementChild.submit();
    }
}
function transferHref(href) {
    document.getElementById('deleteHref').href = '/delete?id=' + href;
    document.getElementById('deleteModal').style.display = "flex";
}
document.getElementById('passold').addEventListener('keydown', function () {
    this.type = "password";
});
function ajaxSearch(e) {
    let defaults = `
    <div class="result">
        <img src="/assets/images/loading.svg" class="loading" alt="">
    </div>
    `;
    document.getElementById('searchTags').value = "";
    document.getElementById('searchDrop').style.display = "flex";
    document.getElementById('searchDrop').innerHTML = defaults;
    if (e.value == '') {
        document.getElementById('searchDrop').style.display = "none";
    }
    let search = e.value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('#searchDrop').innerHTML = this.responseText;
        }
    };
    setTimeout(() => {
        xhttp.open("GET", "/search?search=" + search, true);
        xhttp.send();
    }, 500);
    
}
function ajaxSearchTags(e) {
    let defaults = `
    <div class="result">
        <img src="assets/images/loading.svg" class="loading" alt="">
    </div>
    `;
    document.getElementById('search').value = "";
    document.getElementById('searchDrop').style.display = "flex";
    document.getElementById('searchDrop').innerHTML = defaults;
    if (e.value == '') {
        document.getElementById('searchDrop').style.display = "none";
    }
    let search = e.value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('#searchDrop').innerHTML = this.responseText;
        }
    };
    setTimeout(() => {
        xhttp.open("GET", "/searchTag?search=" + search, true);
        xhttp.send();
    }, 500);
    
}
function warning(choice) {
    if (choice == 'account') {
        document.getElementById('deleteAccount').style.display = "flex";
    } else if (choice == 'wikis'){
        document.getElementById('deleteWikis').style.display = "flex";
    }
    
}
function transferHrefEdit(href,val) {
    document.getElementById('editModal').querySelector('#hrefHere').action =  '/editCat?id=' + href;
    document.getElementById('editModal').querySelector('#idHere').value = parseInt(href);
    document.getElementById('editModal').querySelector('#valueHere').value = val;
    document.getElementById('editModal').style.display = "flex";
}
function transferHrefDelete(href) {
    document.getElementById('deleteModal').querySelector('#hrefHere1').href = '/deleteCat?id=' + href;
    document.getElementById('deleteModal').style.display = "flex";
}
function addCat () {
    document.getElementById('addModal').style.display = "flex";
}