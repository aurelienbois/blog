<?php

require_once ('models/Post.class.php');

ob_start(); // start c'est comme une banane dans le pot d'échappement de PHP
?>
<div class="card mb-3">
    <h3 class="card-header"><?= $post->getHeader() ?></h3>
    <div class="card-body">
        <h5 class="card-title"><?= $post->getTitle() ?></h5>
        <h6 class="card-subtitle text-muted"><?= $post->getAuthor() ?></h6>
    </div>
    <img src="<?= $post->getImage() ?>" alt="...">
    <div class="card-body">
        <p class="card-text"><?= nl2br($post->getContent()) ?></p>
    </div>
    <div class="card-footer text-muted">
        <?php
            echo $post->getDate(true);
        ?>
    </div>
    <div class="card-body">
        <a href="#" class="card-link">Modifier</a>
        <a href="#" class="card-link">Supprimer</a>
    </div>
</div>

<a href="#"><button type="button" class="btn btn-secondary">Ajouter un post</button></a>
<?php
$title = 'Blog';
$content = ob_get_clean(); // clean c'est comme retirer la banane du pot d'échappement
require_once 'template.php';