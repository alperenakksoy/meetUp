<?php
// session_start();
require_once '../helpers.php';

$routes=['/'=>'controllers/HomeController.php',
'404'=>'controllers/ErrorController.php'];

$uri = $_SERVER['REQUEST_URI'];

if(array_key_exists($uri,$routes)){
    require basePath($routes[$uri]);
} else{
    require basePath('404');
}