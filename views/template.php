<?php
$listeLiens = [
  'Accueil' => '/accueil',
  'Blog' => '/blog',
  'Contact' => '/contact'
];

// ajouter la BASE_URI au début de chaque lien
$listeLiens = array_map(function($lien) {
  return BASE_URI . $lien;
}, $listeLiens);

?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URI ?>/public/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Basculer le menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <?php
        foreach ($listeLiens as $titre => $lien) {
        ?>
          <li class="nav-item">
            <a
              class="nav-link<?php
                // strtolower() permet de mettre en minuscules
                // ça permet de comparer par ex. Accueil avec accueil
                if (strtolower($titre) === @$_GET['action'] ) {
                  echo ' active'; // l'espace avant active est important
                  // car il y a un espace entre les classes
                  // sinon ça ferait class="nav-linkactive"
                }
              ?>"
              href="<?= $lien ?>"
            >
              <?= $titre ?>
              <span class="visually-hidden">(actif)</span>
            </a>
          </li>
        <?php
        }
        ?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<main class="container">
    <?= $content ?>
</main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>