<?php
// activer les messages d'erreur
ini_set('display_errors', 1); // utile pour les développeurs
ini_set('display_startup_errors', 1); // utile pour les développeurs
error_reporting(E_ALL);

echo $_SERVER['REQUEST_URI'];

$url = explode(
    '/',
    filter_var(
        $_SERVER['REQUEST_URI'],
        FILTER_SANITIZE_URL
    ));

    $lastUrl = end($url);

    $map = [
        'accueil' => ['accueil', 'accueil', ''],
        'blog' => ['blog', 'blog', ''],
        'contact' => ['contact', 'contact', ''],
        '' => ['accueil', 'accueil', '']
    ];
    
    if (is_numeric($lastUrl)) {
        $controller = 'blog';
        $action = 'lire';
        $id = $lastUrl;
    } elseif (isset($map[$lastUrl])) {
        list($controller, $action, $id) = $map[$lastUrl];
    } else {
        $controller = 'accueil';
        $action = 'accueil';
        $id = '';
    }

// routeur
switch ($controller) {
    case 'accueil':
        require_once 'views/accueil.view.php';
        break;
    case 'blog':
        require_once 'controllers/Blog.controller.php';
        $blogController = new BlogController();
        if ($action === 'lire') {
            $blogController->displaySinglePost($id);
            break; // on sort du switch
        }
        $blogController->displayPosts();
        break;
    case 'contact':
        require_once 'views/contact.view.php';
        break;
    default:
        require_once 'views/accueil.view.php'; // page par défaut
        break;
}

?>