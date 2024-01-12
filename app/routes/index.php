<?php

use App\Router;
use App\controllers\LoginController;
use App\controllers\author\HomeController;
use App\controllers\author\AuthorController;

$routes = new Router();

$routes->get('/', HomeController::class, 'index');
$routes->get('/home', HomeController::class, 'index');
$routes->get('/category/books', HomeController::class, 'books');
$routes->get('/category/gaming', HomeController::class, 'gaming');
$routes->get('/category/cars', HomeController::class, 'cars');
$routes->get('/category/technologies', HomeController::class, 'technologies');
$routes->get('/category/science', HomeController::class, 'science');
$routes->get('/category/others', HomeController::class, 'others');
$routes->get('/login', HomeController::class, 'login');
$routes->get('/register', HomeController::class ,'login');
$routes->get('/account', HomeController::class, 'account');
$routes->get('/category', CategoryController::class, 'category');
$routes->get('/wiki', HomeController::class, 'wiki');
$routes->get('/logout', LoginController::class, 'logout');
$routes->post('/login/verify', LoginController::class, 'login');
$routes->get('/login/error', HomeController::class, 'login');
$routes->post('/register/verify', LoginController::class, 'register');
$routes->get('/wiki', HomeController::class, 'wiki');
$routes->post('/wiki/add', AuthorController::class, 'createWiki');
$routes->get('/edit' , AuthorController::class, 'editWiki');
$routes->post('/update', AuthorController::class, 'updateWiki');
$routes->get('/delete', AuthorController::class, 'deleteWiki');

$routes->dispatch();

?>