<?php
require_once('models/PostManager.class.php');
class BlogController
{
    private $postManager; // permet d'accéder aux méthodes de la classe PostManager
    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->postManager->getPostsFromDb();
    }
    public function displayPosts()
    {
        $posts = $this->postManager->getPosts(); // on récupère les posts depuis la base de données
        print_r($posts);
        require_once('views/blog.views.php');
    }
}