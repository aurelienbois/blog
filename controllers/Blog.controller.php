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
        global $posts; // on récupère la variable globale $posts en la créant dans l'espace de nom global
        $posts = $this->postManager->getPosts(); // on récupère les posts depuis la base de données
        require_once('views/blog.view.php');
    }

    public function displaySinglePost($id)
    {
        global $post;
        $post = $this->postManager->getPostById($id);
        require_once('views/singlePost.view.php');
    }

    public function displayAddPostForm()
    {
        require_once('views/addPost.view.php');
    }
}