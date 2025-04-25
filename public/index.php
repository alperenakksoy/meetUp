<?php
// session_start();
require_once '../helpers.php';
require basePath('App/views/listings/Framework/Database.php');
require basePath('App/views/listings/Framework/Router.php');

$router = new Router();

$routes = require basePath('routes.php');

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


if(array_key_exists($uri,$routes)){
    require basePath($routes[$uri]);
} else{
    require basePath($routes['404']);
}