<?php
require_once 'controller/c_Competition.php';
require_once 'model/Competition.php';
?>
<div class="alert alert-warning">
    <p>Liste Competitions</p>
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
            <th data-sortable="true" data-field="nom_competition">Nom</th>
            <th data-sortable="true" data-field="lieu_competition">Lieu</th>
            <th data-sortable="true" data-field="commentaire" data-visible="false">Commentaire</th>
            <th data-sortable="true" data-field="date_competition">Date debut</th>
            <th data-sortable="true" data-field="date_fin_competition">Date Fin</th>
            <th data-sortable="true" data-field="cout">Coût</th>
            <th data-sortable="true" data-field="anne" data-visible="false">Anée</th>
            <th data-sortable="true" data-field="img">image</th>
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($lesCompetitions as $unecompetition) {
                $id_competition = $unecompetition->id_competition;
                $nom_competition = $unecompetition->nom_competition;
                $lieu_competition = $unecompetition->lieu_competition;
                $Commentaire = $unecompetition->commentaire;
                $date_competition = $unecompetition->date_competition;
                $date_fin_competition = $unecompetition->date_fin_competition;
                $cout = $unecompetition->cout;
                $anne = $unecompetition->anne;
                $img =$unecompetition->img;
                ?>
            <tr> 
                <td><?= $nom_competition; ?></td>
                <td><?= $lieu_competition; ?></td>
                <td><?= $Commentaire; ?></td> 
                <td><?= $date_competition; ?></td> 
                <td><?=$date_fin_competition; ?></td> 
                <td><?= $cout; ?></td> 
                <td><?= $anne ?></td>
                <td><img src="<?=$img ?>" id="imageReduite" ></td>
                <td><a href="index.php?uc=joueur&action=listejoueurCompetition&id_competition=<?= $id_competition ?>"><i class="fas fa-eye" title="Afficher Les Joueurs"></i></a>
                    &emsp;<a href="index.php?uc=competition&action=updateCompetition&id_competition=<?= $id_competition ?>"><i class="fas fa-edit" title="Modifier"></i></a>
                    &emsp;<a href="index.php?uc=competition&action=deleteCompetition&id_competition=<?=$id_competition ?>"><i class="fas fa-trash-alt" title="Supprimer"></i></a></td>
            </tr> 
        <?php } ?>
    </tbody>
</table>


