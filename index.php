<?php

use FastRoute\Dispatcher; // Import the FastRoute\Dispatcher class

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

$base = dirname($_SERVER['SCRIPT_NAME']);
if (substr($base, -1) === '/') {
    $base = substr($base, 0, -1);
}
define('BASE_URI', $base);
echo BASE_URI;

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', BASE_URI.'/accueil', ['accueil', 'accueil', '']);
    $r->addRoute('GET', BASE_URI.'/blog', ['blog', 'blog', '']);
    $r->addRoute('GET', BASE_URI.'/contact', ['contact', 'contact', '']);
    $r->addRoute('GET', BASE_URI.'/blog/{id:\d+}', ['blog', 'lire', '{id}']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
echo '<pre>';
var_dump($routeInfo);
echo '</pre>';
switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND: // Use the imported Dispatcher class
        // ... 404 Not Found
        $controller = 'accueil';
        $action = 'accueil';
        $id = '';
        break;
    case Dispatcher::METHOD_NOT_ALLOWED: // Use the imported Dispatcher class
        $allowedMethods = $routeInfo[1];
        // directly returns "405 Method Not Allowed"
        

        break;
    case Dispatcher::FOUND: // Use the imported Dispatcher class
        list($controller, $action, $id) = $routeInfo[1];
        echo 'controller: ', $controller, ', action: ' , $action , ', id: ' , $id;
        // ... call $handler with $vars

        break;
}


?>


