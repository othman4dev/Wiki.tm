<?php
session_start();
require_once '../vendor/autoload.php';

use app\Routes;

$router = new Routes();

$routes->get('/', 'HomeController@index');
$routes->get('/home', 'HomeController@index');
$routes->post('/login', 'LoginController@login');
$routes->post('/register', 'LoginController@register');
$routes->post('account', 'AccountController@store');
$routes->post('/category', 'CategoryController@store');
$routes->post('/logout', 'LoginController@store');
$routes->post('/users', 'UserController@store');

$routes->dispatch();

?>