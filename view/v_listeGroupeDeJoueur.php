<?php
require_once 'controller/c_Joueur.php';
?>
<div class="alert alert-warning">
<p> <strong>&nbsp;<?php if (isset($lejoueur)) : echo strtoupper($lejoueur->nom);
endif; ?>
        &nbsp;<?php if (isset($lejoueur)) :echo ucfirst($lejoueur->prenom);
endif; ?></strong> Appartient Au(x) Groupe(s)</p>
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
            <th data-sortable="true" data-field="nom">Nom</th>
            <th data-sortable="true" data-field="prenom">Prenom</th>
            <th data-sortable="true" data-field="nom_groupe">Groupe</th>
            <th data-sortable="true" data-field="nom_competition">Competition</th>
            <th></th>
        </tr>
    </thead>
     <tbody>
    <?php
    foreach ($lesGroupes as $ungroupe) {
        $id_joueur = $ungroupe->id_joueur;
        $id_groupe = $ungroupe->id_groupe;
        $id_competition = $ungroupe->id_competition;
        $nom = $ungroupe->nom;
        $prenom = $ungroupe->prenom;
        $nom_competition = $ungroupe->nom_competition;
        $nom_groupe = $ungroupe->nom_groupe;
        ?>

       
            <tr> 
                <td><?= $nom ?></td>
                <td><?= $prenom; ?></td>
                <td><?= $nom_groupe; ?></td>
                <td><?= $nom_competition; ?></td>
                <td><a href="index.php?uc=joueurGroupe&action=deletJoueurFromGroupe&id_joueur=<?= $id_joueur; ?>
                       &id_groupe=<?= $id_groupe; ?>"><i class="fas fa-trash-alt" title="Supprimer de ce groupe"></i></a></td>
            </tr> 
<?php } ?>
    </tbody>
</table>

