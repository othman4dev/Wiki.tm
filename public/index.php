<?php
    session_start();
    require '../vendor/autoload.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();
    $router = require '../app/routes/index.php';
