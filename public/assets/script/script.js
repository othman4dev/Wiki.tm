// GITHUB :  Othman4dev.
//Script 100% Made By Othmane Kharbouch.

// Global variables

let side = true;
let current = "home";
let account = false;

// Here is the HTML for the login and register forms

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
    <a href="/reset">Forgot Password ?</a>
    <input type="submit" value="Login" onclick="validation('login')" name="login">
</form>
`;
let register = `
<form action="/register/verify" method="post" id="register-form"  onsubmit="return false;" class="ini-form">
    <div class="login-header">
        <i class="bi bi-person-circle" style="font-size: 48px;"></i>
        <h2>Register</h2>
    </div>
    <label>
        <p class="moved">Full Name</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" min="4" name="name" required>
    </label>
    <label>
        <p class="moved">Email</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" id="register-email" name="email"required>
    </label>
    <label>
        <p class="moved">New Password</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" name="password" required id="pass1" autocomplete="off">
    </label>
    <label>
        <p class="moved">Rewrite Password</p>
        <input type="text" class="inp" onkeyup="moveUp(this)" onfocus="moveUp(this)" onblur="moveDown(this)" required id="pass2" autocomplete="off">
    </label>
    <input type="submit" value="Create Account" name="register" onclick="validation('register')">
</form>
`;


// Here is the redirection system for preventing doubled actions.
var position = window.location.href.split('/');
position = position[position.length - 1].split('?')[0];

var locations = window.location.href.split('/');
locations = locations[locations.length - 1].split('?')[0];
console.log('This is the location : ' + locations);
if (locations == 'deleteTag') {
    position = 'alltags';
    window.location.href = '/admin/alltags';
} else if (locations == 'editTag') {
    position = 'alltags';
    window.location.href = '/admin/alltags';
} else if (locations == 'addTag') {
    position = 'alltags';
    window.location.href = '/admin/alltags';
} else if (locations == 'deleteCat') {
    position = 'categories';
    window.location.href = '/admin/categories';
} else if (locations == 'editCat') {
    position = 'categories';
    window.location.href = '/admin/categories';
} else if (locations == 'addCat') {
    position = 'categories';
    window.location.href = '/admin/categories';
} else if (locations == "turnAuthor") {
    position = 'home';
    window.location.href = '/';
} else if (locations == "add") {
    position = 'accounts';
    window.location.href = '/accounts';
} else if (locations == "update") {
    position = 'accounts';
    window.location.href = '/accounts';
} else if (locations == "delete") {
    position = 'accounts';
    window.location.href = '/accounts';
} else if (locations == "update") {
    position = 'accounts';
    window.location.href = '/accounts';
} else if (locations == "localhost:8080") {
    position = 'home';
} else if (locations == "categories") {
    position = 'categories';
} else if (locations == 'getCategory') {
    position = 'categories';
} else if (locations == "wiki") {
    position = 'home';
} else if (locations == "archive") {
    window.location.href = '/admin/allwikis';
    position = 'allwikis';
} else if (locations == "unarchive") {
    window.location.href = '/admin/allwikis';
    position = 'allwikis';
} else if (locations == "ban") {
    window.location.href = '/admin/users';
    position = 'users';
}

// Here is the side status system

if (localStorage.getItem("side") == null) {
    side = true;
    localStorage.setItem("side", JSON.stringify(side));
} else {
    side = JSON.parse(localStorage.getItem("side"));
}
console.log(window.location.href);
let all = document.querySelectorAll(".category")[0].querySelectorAll("li");
all.forEach(element => {
    element.classList.remove("current");
});
if (position == "wiki") {
    position = "allwikis";
}
if (document.getElementById('category-title')) {
    document.getElementById('category-title').innerText = position.toUpperCase();
}
if (document.querySelector(`.${position}`)) {
    document.querySelector(`.${position}`).classList.add("current");
} else {
    document.querySelector(`.home`).classList.add("current");
}

//Here is the functions for the website

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
    let pass1 = document.getElementById("pass1");
    let pass2 = document.getElementById("pass2");
    if (pass1.value == "" || pass2.value == "") {
        document.getElementById("pass1").setCustomValidity("Please fill this field");
    }
    if (pass1.value.length < 8) {
        document.getElementById("pass1").setCustomValidity("Password must be at least 8 characters long");
    }
    if (pass1.value == pass2.value) {
        document.querySelector("#login-form").submit();
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
        <img src="/assets/images/loading.svg" class="loading" alt="">
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
function showInfo() {
    document.getElementById('infoModal').style.display='flex';
}
var ids = 0;
function tagModal(id , name) {
    ids = id;
    document.getElementById('tagModal').style.display='flex';
    document.getElementById('tagModal').querySelector('#valueHere').value = name;

}
function submit(option) {
    if (option == 'edit') {
        document.getElementById('tagModal').querySelector('#actionHere').action = '/admin/editTag';
        document.getElementById('tagModal').querySelector('#idHere').value = ids;
        document.getElementById('tagModal').querySelector('#actionHere').submit();
    } else if (option == 'delete') {
        document.getElementById('tagModal').querySelector('#actionHere').action = '/admin/deleteTag';
        document.getElementById('tagModal').querySelector('#idHere').value = ids;
        document.getElementById('tagModal').querySelector('#actionHere').submit();
    } else {
        window.location.href = '/error';
    }
}
function showAddTag() {
    document.getElementById('addTagModal').style.display='flex';
}
function validation(type) {
    if (type == 'login') {
        let email = document.querySelector('#email-login');
        if (email.value == '') {
            email.setCustomValidity('Please fill this field');
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.setCustomValidity('Please enter a valid email address');
            } else {
                email.setCustomValidity('');
                if (document.querySelector('#pass-login').value == '') {
                    document.querySelector('#pass-login').setCustomValidity('Please fill this field');
                } else {
                    if (document.querySelector('#pass-login').value.length < 7) {
                        document.querySelector('#pass-login').setCustomValidity('Password must be at least 8 characters long');
                        
                    } else {
                        document.querySelector('#pass-login').setCustomValidity('');
                        document.querySelector('#login-form').submit();
                    }
                }
            }
        }
    } else if (type == "register") {
        let email = document.querySelector('#register-email');
        if (email.value == '') {
            email.setCustomValidity('Please fill this field');
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.setCustomValidity('Please enter a valid email address');
            } else {
                email.setCustomValidity('');
                if (document.querySelector('#pass1').value == '') {
                    document.querySelector('#pass1').setCustomValidity('Please fill this field');
                } else {
                    if (document.querySelector('#pass1').value.length < 7) {
                        document.querySelector('#pass1').setCustomValidity('Password must be at least 8 characters long');
                        
                    } else {
                        document.querySelector('#pass1').setCustomValidity('');
                        if (document.querySelector('#pass2').value == '') {
                            document.querySelector('#pass2').setCustomValidity('Please fill this field');
                        } else {
                            if (document.querySelector('#pass2').value.length < 7) {
                                document.querySelector('#pass2').setCustomValidity('Password must be at least 8 characters long');
                                
                            } else {
                                document.querySelector('#pass2').setCustomValidity('');
                                if (document.querySelector('#pass1').value != document.querySelector('#pass2').value) {
                                    document.querySelector('#pass2').setCustomValidity("Passwords Don't Match");
                                } else {
                                    document.querySelector('#pass2').setCustomValidity('');
                                    document.querySelector('#register-form').submit();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
