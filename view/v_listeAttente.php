<?php
require_once 'controller/c_liste_attente.php';
require_once 'model/Competition.php';
$competition = new competition();
require_once 'model/Joueur.php';
$joueur = new Joueur();
?>
<div class="alert alert-warning">
    <p>Liste Participants Aux Competitions</p>
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
                <th data-sortable="true" data-field="nr_ffe">Nrffe</th>
                <th data-sortable="true" data-field="nom">nom</th>
                <th data-sortable="true" data-field="prenom">prénom</th>
                <th data-sortable="true" data-field="id_competition">Competition</th>
                <th data-sortable="true" data-field="etat">Etat</th>
                <th data-sortable="true" data-field="date_inscription">Date Inscription</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($listeAttente <> null) {
            foreach ($listeAttente as $liste) {
                $id_joueur=$liste->id_joueur;
                $id_competition=$liste->id_competition;
                $NrFFE=$liste->nr_ffe;
                $nom = $liste->nom;
                $prenom = $liste->prenom;
                $nom_competition = $liste->nom_competition;
                $date_inscription = $liste->date_inscription;
                $etat =$liste->etat;
                ?>
                 
                <tr> 
                    <td><?=$NrFFE; ?></td>
                     <td><?=$nom;?></td>
                    <td><?= $prenom;?></td>
                    <td><?=$nom_competition ;?></td>
                    <?php if($etat=="attente"){?>
                    <td><a href="index.php?uc=participants&action=confirme&id_joueur=<?=$id_joueur;?>&id_competition=<?=$id_competition;?>"><?=$etat; ?></a></td>
                        <?php } else { ?>
                            <td><?=$etat; ?></td>
                       <?php } ?>
                    <td><?=$date_inscription; ?></td>
                    <td><a href="index.php?uc=participants&action=deleteParticipant&id_joueur=<?=$id_joueur;?>&id_competition=<?=$id_competition;?>"><i class="fas fa-trash-alt"  title="Supprimer de la liste"></i></a></td>
                </tr> 
                
            <?php } }?>
            </tbody>
        </table>


