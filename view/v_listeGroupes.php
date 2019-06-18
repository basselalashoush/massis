<?php
require_once 'controller/c_groupes.php';
?>
<div class="alert alert-warning">
<p>Liste Groupes</p>
</div>
<table id="myTable" class=" table table-striped snipe-table" 
       data-locale="fr-FR"
       data-toolbar="#toolbar"
       data-page-size="5"
       data-search="true"
       data-show-columns="true"
       data-show-toggle="true"   
       data-show-pagination-switch="true"
       data-pagination="true"
       data-page-list="[5,10, 25, ALL]">
    <thead>
        <tr>
            <th data-sortable="true" data-field="id_groupe">Groupe</th>
            <th data-sortable="true" data-field="id_competition">Competition</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($lesGroupes as $ungroupe) {
            $id_groupe = $ungroupe->id_groupe;
            $id_competition = $ungroupe->id_competition;
            $nom_competition = $ungroupe->nom_competition;
            $nom_groupe = $ungroupe->nom_groupe;
            ?>
            <tr> 
                <td><?php echo $nom_groupe; ?></td>
                <td><?php echo $nom_competition; ?></td>
                <td><a href="index.php?uc=joueur&action=listejoueurGroupe&id_groupe=<?= $id_groupe ?>"><i class="fas fa-eye" title="Afficher Les Joueurs"></i></a>
                    &emsp; <a href="index.php?uc=groupe&action=updateGroupe&id_groupe=<?= $id_groupe?>&id_competition=<?= $id_competition; ?>"><i class="fas fa-edit" title="Modifier"></i></a>
                    &emsp;<a href="index.php?uc=groupe&action=deleteGroupe&id_groupe=<?= $id_groupe ?>"><i class="fas fa-trash-alt" title="Supprimer"></i></a></td>
            </tr> 
        <?php } ?>
    </tbody>
</table>

