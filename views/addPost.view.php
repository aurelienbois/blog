<?php
$title = 'Ajouter un Post';
$content = ob_start();
?>
<h1>Ajouter un Nouveau Post</h1>
<form action="<?= BASE_URI ?>/blog/add" method="post">
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Titre:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="header" class="col-sm-2 col-form-label">En-tête:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="header" name="header" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="author" class="col-sm-2 col-form-label">Auteur:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="image" class="col-sm-2 col-form-label">URL de l'Image:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="image" name="image" value="https://picsum.photos/321/180">
        </div>
    </div>

    <div class="form-group row">
        <label for="body" class="col-sm-2 col-form-label">Contenu:</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="body" name="body" required></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<?php
$content = ob_get_clean();
require_once 'template.php';