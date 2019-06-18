<?php
require_once 'controller/c_categorie.php';
require_once 'model/Categorie.php';
?>
<div class="alert alert-warning">
    <p>Liste Categories</p>
</div>
<table id="myTable" class=" table table-striped snipe-table" 
       data-locale="fr-FR"
       data-toolbar="#toolbar"
       data-search="true"
       data-show-columns="true"
       data-show-toggle="true"   
       data-show-pagination-switch="true"
       data-pagination="true"
       data-page-size="5"
       data-page-list="[5,10, 25, ALL]">
    <thead>
        <tr>
            <th data-sortable="true" data-field="id_categorie">Categorie</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody >
        <?php
        foreach ($lesCategories as $unecategorie) :
            $id_categorie = $unecategorie->id_categorie;
            $nom_categorie = $unecategorie->nom_categorie;
            ?>

            <tr> 
                <td><?= $nom_categorie; ?></td>
                <td><a href="index.php?uc=joueur&action=listejoueurCategorie&id_categorie=<?= $id_categorie ?>"><i class="fas fa-eye" title="Afficher Les Joueurs"></i></a>
                    &emsp; <a href="index.php?uc=categorie&action=updateCategorie&id_categorie=<?= $id_categorie ?>"><i class="fas fa-edit" title="Modifier"></i></a>
                    &emsp;<a href="index.php?uc=categorie&action=deleteCategorie&id_categorie=<?= $id_categorie ?>"><i class="fas fa-trash-alt" title="Supprimer"></i></a>
                    <!-- <button type="submit" class="btn btn-outline-light" ><a href="index.php?uc=joueur&action=listejoueurCategorie&id_categorie=<?= $id_categorie ?>"><i class="fas fa-eye" title="Afficher Les Joueurs"></i></a></button>
                    <button type="submit" class="btn btn-outline-light" ><a href="index.php?uc=categorie&action=updateCategorie&id_categorie=<?= $id_categorie ?>"><i class="fas fa-edit" title="Modifier"></i></a></button>
                    <button type="submit" class="btn btn-outline-light" ><a href="index.php?uc=categorie&action=deleteCategorie&id_categorie=<?= $id_categorie ?>"><i class="fas fa-trash-alt" title="Supprimer"></i></a></button> -->
                </td>
            </tr> 
        <?php endforeach; ?>
    </tbody>

</table>



