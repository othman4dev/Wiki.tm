<?php

use App\Router;
use App\controllers\LoginController;
use App\controllers\author\HomeController;
use App\controllers\author\AuthorController;
use App\controllers\admin\AdminController;

$routes = new Router();

$routes->get('/', HomeController::class, 'index');
$routes->get('/home', HomeController::class, 'index');
$routes->get('/author/home', HomeController::class, 'index');
$routes->get('/category/books', HomeController::class, 'books');
$routes->get('/category/gaming', HomeController::class, 'gaming');
$routes->get('/category/cars', HomeController::class, 'cars');
$routes->get('/category/technologies', HomeController::class, 'technologies');
$routes->get('/category/science', HomeController::class, 'science');
$routes->get('/category/others', HomeController::class, 'others');
$routes->get('/login', HomeController::class, 'login');
$routes->get('/register', HomeController::class ,'login');
$routes->get('/accounts', HomeController::class, 'account');
$routes->get('/category', CategoryController::class, 'category');
$routes->get('/wiki', HomeController::class, 'wiki');
$routes->get('/logout', LoginController::class, 'logout');
$routes->post('/login/verify', LoginController::class, 'login');
$routes->get('/login/error', HomeController::class, 'login');
$routes->post('/register/verify', LoginController::class, 'register');
$routes->post('/wiki/add', AuthorController::class, 'createWiki');
$routes->get('/edit' , AuthorController::class, 'editWiki');
$routes->post('/edit/account' , AuthorController::class, 'editAccount');
$routes->post('/update', AuthorController::class, 'updateWiki');
$routes->get('/delete', AuthorController::class, 'deleteWiki');
$routes->get('/error' , HomeController::class, 'error');
$routes->get('/404' , HomeController::class, 'notFound');
$routes->get('/myWikis' , HomeController::class, 'wikis');
$routes->get('/search' , HomeController::class, 'search');
$routes->get('/searchTag' , HomeController::class, 'searchTag');
$routes->get('/categories' ,  HomeController::class , 'categories');
$routes->get('/getCategory' ,  HomeController::class , 'getCategoryId');
$routes->get('/banned' ,  HomeController::class , 'banned');
# Admin controllers
$routes->get('/admin', AdminController::class , 'adminHome');
$routes->get('/admin/home', AdminController::class , 'adminHome');
$routes->get('/admin/allwikis', AdminController::class , 'adminWikis');
$routes->get('/admin/users', AdminController::class , 'adminUsers');
$routes->get('/admin/categories', AdminController::class , 'adminCategories');
$routes->get('/admin/alltags', AdminController::class , 'adminTags');
$routes->get('/admin/accounts', AdminController::class , 'adminAccount');
$routes->get('/deleteCat', AdminController::class , 'deleteCat');
$routes->post('/editCat', AdminController::class , 'editCat');
$routes->post('/addCat', AdminController::class , 'addCat');
$routes->get('/admin/wiki', AdminController::class , 'adminWiki');
$routes->get('/turnAuthor', AdminController::class , 'turnAuthor');
$routes->post('/admin/editTag', AdminController::class , 'editTag');
$routes->post('/admin/deleteTag', AdminController::class , 'deleteTag');
$routes->post('/admin/addTag', AdminController::class , 'addTag');
$routes->get('/admin/archive', AdminController::class , 'archive');
$routes->get('/admin/unarchive', AdminController::class , 'unarchive');
$routes->get('/admin/ban', AdminController::class , 'ban');
$routes->get('/admin/unban', AdminController::class , 'unban');
$routes->dispatch();

?>