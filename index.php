<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php'; // cela charge toutes les classes de Composer (FastRoute, etc.)

use FastRoute\Dispatcher; // Import the FastRoute\Dispatcher class

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); // __DIR__ est le dossier courant donc le .env est à la racine du projet
$dotenv->load();

$base = dirname($_SERVER['SCRIPT_NAME']);
if (substr($base, -1) === '/') {
    $base = substr($base, 0, -1);
}
define('BASE_URI', $base);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) { // $r représente le routeur
    $r->addRoute('GET', BASE_URI.'/accueil', ['accueil', 'accueil', '']);
    $r->addRoute('GET', BASE_URI.'/blog', ['BlogController', 'blog', '']);
    $r->addRoute('GET', BASE_URI.'/blog/lire/{id:\d+}', ['BlogController', 'lire', '{id}']);
    $r->addRoute('GET', BASE_URI.'/contact', ['contact', 'contact', '']);
    $r->addRoute('GET', BASE_URI.'/search{q}', ['SearchController', 'search', '{q}']);
    $r->addRoute('GET', BASE_URI.'/blog/add', ['BlogController', 'addPostForm', '']);
    $r->addRoute('POST', BASE_URI.'/blog/add', ['BlogController', 'submitPost', '']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found', true, 404);
        $controller = 'accueil';
        $action = 'accueil';
        $id = '';
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        header($_SERVER["SERVER_PROTOCOL"] . ' 405 Method Not Allowed', true, 405);
        exit;
        break;
    case Dispatcher::FOUND:
        list($controller, $action) = $routeInfo[1];
        switch ($controller) {
            case 'accueil':
                require_once 'views/accueil.view.php';
                break;
            case 'BlogController':
                require_once 'controllers/Blog.controller.php';
                $blogController = new BlogController();
                switch ($action) {
                    case 'lire':
                        try {
                            $id = $routeInfo[2]['id'];
                        } catch (Exception $e) {
                            header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found', true, 404);
                            $controller = 'accueil';
                            $action = 'accueil';
                            $id = '';
                        }
                        $blogController->displaySinglePost($id);
                        break;
                    case 'addPostForm':
                        $blogController->addPostForm();
                        break;
                    case 'submitPost':
                        $blogController->submitPost();
                        break;
                    default:
                        $blogController->displayPosts();
                        break;
                }
                break;
            case 'SearchController':
                require_once 'controllers/SearchController.php';
                $searchController = new SearchController();
                if ($action === 'search') {
                    $q = $routeInfo[2]['q'];
                    $searchController->search($q);
                    break;
                }
                break;
            case 'contact':
                require_once 'views/contact.view.php';
                break;
            default:
                require_once 'views/accueil.view.php'; // page par défaut
                break;
        }
        break;
}

require_once 'views/accueil.view.php'; // page par défaut