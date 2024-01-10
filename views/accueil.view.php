<?php ob_start(); // start c'est comme une banane dans le pot d'échappement de PHP
?>
<h1>Index (accueil)</h1>
<?php
$title = 'Accueil - site de YY';
$content = ob_get_clean(); // clean c'est comme retirer la banane du pot d'échappement
require_once 'template.php';