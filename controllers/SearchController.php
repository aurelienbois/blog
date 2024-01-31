<?php
require_once('models/PostManager.class.php');

class SearchController
{
    public function search($q)
    {
        // vérifier que $q n'est pas vide, et que c'est une chaîne de caractères et vérifier qu'il commence par ?q= 
        if (empty($q) || !is_string($q) || substr($q, 0, 3) !== '?q=') {
            header($_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request', true, 400);
            exit;
        }
     
        $q = htmlspecialchars(urldecode(trim(substr($q, 3))));
        // si q est vide on redirige vers l'accueil
        if (empty($q)) {
            header('Location: ' . BASE_URI);
            exit;
        }

        $postManager = new PostManager();
        $results = $postManager->searchPosts($q); // Effectuer la recherche
        require_once('views/search.view.php'); // Afficher les résultats
    }
}
