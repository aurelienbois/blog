<?php

//require_once ('models/Post.class.php');
ob_start(); // start c'est comme une banane dans le pot d'échappement de PHP
?>
<h1>Ajout d'un nouvel article (post)</h1>
<a href="#"><button type="button" class="btn btn-secondary">Ajouter un post</button></a>
<?php
$title = 'Blog';
$content = ob_get_clean(); // clean c'est comme retirer la banane du pot d'échappement
require_once 'template.php';