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
    public function getPostById($id) {
       
        $req = $this->getBdd()->prepare('SELECT * FROM posts WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $post = $req->fetch(PDO::FETCH_ASSOC);
        // todo : vérifier que $post n'est pas vide
       
        return new Post(
            $post['id'], // champ de la table posts
            $post['title'],
            $post['header'],
            $post['author'],
            $post['image'],
            $post['body'],
            $post['date']
        );
    }

    public function searchPosts($query) {
        $query = '%' . $query . '%';
        $req = $this->getBdd()->prepare('
        (
            SELECT * FROM posts
            WHERE MATCH(title, header, body) AGAINST(:query IN NATURAL LANGUAGE MODE)
        )
        UNION
        (
            SELECT * FROM posts
            WHERE title LIKE :query OR header LIKE :query OR body LIKE :query
        );
        ');
        $req->bindValue(':query', '%'.$query.'%', PDO::PARAM_STR);
        $req->execute();
        $posts = $req->fetchAll(PDO::FETCH_ASSOC);
        // Convertir les résultats en objets Post
        $resultPosts = [];
        foreach ($posts as $p) {
            $resultPosts[] = new Post(
                $p['id'], $p['title'], $p['header'], $p['author'], $p['image'], $p['body'], $p['date']
            );
        }
        return $resultPosts;
    }
    
}