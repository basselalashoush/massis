<?php
require_once 'controller/c_categorie.php';
require_once 'model/Categorie.php';
$title = $_REQUEST['action'];
if ($title == 'addCategorie') {
    $title = 'Ajouter Une Categorie';
} else {
    $title = 'Modifier La Categorie';
}
?>
<form class="form" action="index.php?uc=categorie&action=recordCategorie" method="post">
           <fieldset>
               <div class=" col-md-6 alert alert-warning"><strong><?= $title;?>&nbsp;<?php if(isset     ($lacategorie)): echo strtoupper($lacategorie->nom_categorie); endif; ?></strong>
                </div>
                <div>
                    <input type="hidden" name="id_categorie" class="form-control" value="<?= isset($lacategorie) ? $lacategorie->id_categorie : ''; ?>" />
                </div>
                <div class="form-group col-md-6">
                            <label for="nom_categorie">Nom Categorie</label>
                            <input type="text" name="nom_categorie" class="form-control" value="<?= isset($lacategorie) ? $lacategorie->nom_categorie : ''; ?>" />
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-light">Valider</button>
                    <button type="reset" class="btn btn-outline-light" onClick="window.location.href = 'index.php?uc=categorie&action=listeCategories';">Annuler</button>
                </div>
    </fieldset>
</form>

   