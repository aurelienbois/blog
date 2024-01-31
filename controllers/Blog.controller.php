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

    public function addPostForm()
    {
        require_once('views/addPost.view.php');
    }

    public function submitPost()
    {
        // Traitement des données du formulaire
        // valider et nettoyer les données reçues
        // Ajouter le post dans la base de données

        $title = htmlspecialchars($_POST['title']);
        $header = htmlspecialchars($_POST['header']);
        $author = htmlspecialchars($_POST['author']);
        $image = htmlspecialchars($_POST['image']);
        $body = htmlspecialchars($_POST['body']);

        // valider les données
        if (empty($title) || empty($header) || empty($author) || empty($image) || empty($body)) {
            header($_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request', true, 400);
            exit;
        }

        // ajouter le post dans la base de données
        $this->postManager->addPost(new Post(null, $title, $header, $author, $image, $body, null));

        echo '<div class="alert alert-success" role="alert">
            Le post a bien été ajouté !
            </div>';

        echo '<script>setTimeout(function(){window.location.href = "'.BASE_URI.'/blog";}, 2000);</script>';

    }

}