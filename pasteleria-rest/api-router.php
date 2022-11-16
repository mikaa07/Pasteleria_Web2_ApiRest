<?php
require_once './libs/Router.php';
require_once './app/controllers/product-api.controller.php';
require_once './app/controllers/auth-api.controller.php';
require_once './app/controllers/apiComentarioController.php';


// crea el router
$router = new Router();

$router->addRoute('products', 'GET', 'ProductApiController', 'getProducts');
$router->addRoute('products/:ID', 'GET', 'ProductApiController', 'getProduct');
$router->addRoute('products/:ID', 'DELETE', 'ProductApiController', 'deleteProduct');
$router->addRoute('products', 'POST', 'ProductApiController', 'insertProduct'); 
$router->addRoute("auth/token", 'GET', 'AuthApiController', 'getToken');

$router->addRoute('comentarios', 'GET', 'apiComentarioController', 'getComentarios');
$router->addRoute('comentarios/:ID', 'GET', 'apiComentarioController', 'getComentario');
$router->addRoute('comentarios', 'POST', 'apiComentarioController', 'insertComentario');
$router->addRoute('comentarios/:ID', 'DELETE', 'apiComentarioController', 'deleteComentario');
// ejecuta la ruta 
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);


