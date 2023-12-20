<?php
require_once('models/Model.class.php');
require_once('models/Post.class.php');
class PostManager extends Model { // le extends ajoute les propriétés et méthodes de Model à PostManager soit $pdo, setBdd() et getBdd(). C'est l'héritage.
    private $posts = [];
    public function getPosts() { return $this->posts; }
    public function addPost(Post $post) { $this->posts[] = $post; }
    public function getPostsFromDb() {
        $req = $this->getBdd()->prepare('SELECT * FROM posts');
        $req->execute();
        $posts = $req->fetchAll(PDO::FETCH_ASSOC); 
        foreach ($posts as $p) {
            $this->addPost(new Post(
                $p['id'], // champ de la table posts
                $p['title'],
                $p['header'],
                $p['author'],
                $p['image'],
                $p['body'],
                $p['date']
            ));
        }
    }
}