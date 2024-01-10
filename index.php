<?php

// activer les messages d'erreur
ini_set('display_errors', 1); // utile pour les développeurs
ini_set('display_startup_errors', 1); // utile pour les développeurs
error_reporting(E_ALL);

// routeur
switch (@$_GET['action']) {
    case 'accueil':
        require_once 'views/accueil.view.php';
        break;
    case 'blog':
        require_once 'controllers/Blog.controller.php';
        $blogController = new BlogController();
        $blogController->displayPosts();
        break;
    case 'contact':
        require_once 'views/contact.view.php';
        break;
    default:
        require_once 'views/accueil.view.php'; // page par défaut
        break;
}