<?php

require_once ('models/Post.class.php');


ob_start(); // start c'est comme une banane dans le pot d'échappement de PHP
?>
<h1>Blog</h1>
<div class="row">
<?php  foreach ($posts as $p) { 
    
    $content = $p->getContent();
    $firstSentence = strstr($content, '.', true);
    if ($firstSentence !== false) {
        $firstSentence .= '...';
    } else {
        $firstSentence = $content;
    }

    ?>
    <div class="col-md-6">
        <div class="card mb-3">
            <a href="./blog/lire/<?= $p->getId() ?>" class="post text-body text-decoration-none">
                <h3 class="card-header"><?= $p->getHeader() ?></h3>
                <div class="card-body">
                    <h5 class="card-title"><?= $p->getTitle() ?></h5>
                    <h6 class="card-subtitle text-muted"><?= $p->getAuthor() ?></h6>
                </div>
                <img src="<?= $p->getImage() ?>" alt="..." class="img-fluid" style="width: 100%">
                <div class="card-body">
                    <p class="card-text"><?= nl2br($firstSentence) ?></p>
                </div>
                <div class="card-footer text-muted">
                    <?php
                        echo $p->getDate(true);
                    ?>
                </div>
            </a>
            <div class="card-body">
                <a href="#" class="card-link">Modifier</a>
                <a href="#" class="card-link">Supprimer</a>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<?php
$title = 'Blog';
$content = ob_get_clean(); // clean c'est comme retirer la banane du pot d'échappement
require_once 'template.php';