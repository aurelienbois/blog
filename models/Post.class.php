<?php

class Post {
    private $id;
    private $title;
    private $content;
    private $author;
    private $date;
    private $header;
    private $image;

    // static public $posts = array(); // utilisé plus loin via self::$posts

    public function __construct($id, $title, $header, $author, $image, $content, $date) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->date = $date;
        $this->header = $header;
        $this->image = $image;
        // le double crochet [] permet d'ajouter un élément à un tableau
        //self::$posts[] = $this; // fait référence à la classe elle-même
        // array push
        // array_push(self::$posts, $this);
    }

    private function getPassedDays() { 
        $postDate = new DateTime($this->date);
        $now = new DateTime(); // la date d'aujourd'hui
        $interval = $now->diff($postDate); // on calcule la différence entre les deux dates
        $days = $interval->format('%a'); // on récupère le nombre de jours
        // utiliser un switch pour afficher le bon texte
        // (hier, ajourd'hui, et default affiche le nb de jours
        switch($days) {
            case 0:
                return 'Aujourd\'hui';
            case 1:
                return 'Hier';
            default:
                return $days . ' jours';
        }
    }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function setTitle($title) { $this->title = $title; }
    public function getContent() { return $this->content; }
    public function setContent($content) { $this->content = $content; }
    public function getAuthor() { return $this->author; }
    public function setAuthor($author) { $this->author = $author; }
    public function getDate($lisible = false) { return $lisible ? $this->getPassedDays() : $this->date; }
    public function setDate($date) { $this->date = $date; }
    public function getHeader() { return $this->header; }
    public function setHeader($header) { $this->header = $header; }
    public function getImage() { return $this->image; }
    public function setImage($image) { $this->image = $image; }

}