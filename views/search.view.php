<?php

require_once('models/Post.class.php');

$title = 'Résultats de recherche'; // Titre de la page de recherche
$content = ob_start(); // Début de la capture du contenu

?>
<h1>Résultats de recherche pour "<?= $q ?>"</h1> <!-- Affichage de la requête de recherche -->
<div class="row">
<?php 
if (!empty($results)) { // Vérifie si des résultats sont présents
    foreach ($results as $p) {
        $firstSentence = strstr($p->getContent(), '.', true) ?: $p->getContent();
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
                        <?= $p->getDate(true) ?>
                    </div>
                </a>
                <!-- Les liens Modifier et Supprimer peuvent être masqués ou adaptés en fonction des besoins -->
            </div>
        </div>
        <?php 
    }
} else {
    echo "<p>Aucun résultat trouvé pour la recherche '" , $q , "'.</p>";
}
?>
</div>
<?php
$content = ob_get_clean(); // Fin de la capture du contenu
require_once 'template.php'; // Inclure le template qui contient le header et le footer
