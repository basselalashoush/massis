
<?php
require_once 'model/Joueur.php';
require_once 'controller/c_Joueur.php';
if ($lesjoueur <> null) {
    ?>
<div class="alert alert-warning">
    <p>Liste Joueurs</p>
</div>
    <table id="myTable" class=" table table-striped snipe-table"
           data-locale="fr-FR"
           data-toolbar="#toolbar"
           data-page-size="5"
           data-search="true"
           data-show-columns="true"
           data-show-toggle="true"  
           data-detail-view="true"
           data-detail-formatter="detailFormatter" 
           data-show-pagination-switch="true"
           data-pagination="true"
           data-page-list="[5,10, 25, ALL]">
        <thead>   
            <tr>
                <th data-sortable="true" data-field="nr_ffe">NrFFE</th>
                <th data-sortable="true" data-field="nom">Nom</th>
                <th data-sortable="true" data-field="prenom">Prénom</th>
                <th data-sortable="true" data-field="id_categorie">Categorie</th>
                <th>  Action   </th>
                <th data-sortable="true" data-field="adherent" data-visible="false">Adherent</th>
                <th data-sortable="true" data-field="email" data-visible="false">Email</th>
                <th data-sortable="true" data-field="adresse" data-visible="false">Adresse</th>
                <th data-sortable="true" data-field="code_postal" data-visible="false">Code Postal</th>
                <th data-sortable="true" data-field="ville" data-visible="false">Ville</th>
                <th data-sortable="true" data-field="tel" data-visible="false">Téléphone</th>
                <th data-sortable="true" data-field="parent" data-visible="false">Parent</th>
                <th data-sortable="true" data-field="af" data-visible="false">AF</th>
                <th data-sortable="true" data-field="elo" data-visible="false">ELO</th>
                <th data-sortable="true" data-field="type" data-visible="false">Type</th>
                <th data-sortable="true" data-field="rapide" data-visible="false">Rapide</th>
                <th data-sortable="true" data-field="mute" data-visible="false">Muté</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($lesjoueur as $unjoueur) {
                $id_joueur = $unjoueur->id_joueur;
                $NrFFE = $unjoueur->nr_ffe;
                $nom = $unjoueur->nom;
                $prenom = $unjoueur->prenom;
                $categorie = $unjoueur->nom_categorie;
                $adherent = $unjoueur->adherent;
                $Email = $unjoueur->email;
                $Adresse = $unjoueur->adresse;
                $CP = $unjoueur->code_postal;
                $Ville = $unjoueur->ville;
                $Tel = $unjoueur->tel;
                $parent = $unjoueur->parent;
                $AF = $unjoueur->af;
                $ELO = $unjoueur->elo;
                $type = $unjoueur->type;
                $RAPIDE = $unjoueur->rapide;
                $MUTE = $unjoueur->mute;
                ?>
                <tr>
                    <td><?= $NrFFE; ?></td>
                    <td><?= $nom; ?></td>
                    <td><?= $prenom; ?></td>
                    <td><?= $categorie; ?></td>
                    <td> <a href=index.php?uc=joueur&action=updateJoueur&id_joueur=<?php echo $id_joueur; ?>><i class="fas fa-user-edit" title="Modifier"></i></a>
                        &emsp;<a href=index.php?uc=joueur&action=deleteJoueur&id_joueur=<?php echo $id_joueur; ?>><i class="fas fa-trash-alt"  title="Supprimer"></i></a>
                        &emsp;<a href=index.php?uc=joueur&action=lesGroupeDeJoueur&id_joueur=<?= $id_joueur; ?>><i class="fas fa-users" title="Les Groupes De Joueur"></i></a>
                        &emsp;<a href=index.php?uc=participants&action=addParticipant&id_joueur=<?php echo $id_joueur; ?>><i class="fas fa-sign-in-alt" title="Inscrire aux competitions"></i></a>
                        &emsp;<a href=index.php?uc=joueurGroupe&action=addJoueurGroupe&id_joueur=<?php echo $id_joueur; ?>><i class="fas fa-sign-in-alt" title="ajouter aux groupes"></i></a></td>
                    <td><?= $adherent; ?></td>
                    <td><?= $Email; ?></td>
                    <td><?= $Adresse; ?></td>
                    <td><?= $CP; ?></td>
                    <td><?= $Ville; ?></td>
                    <td><?= $Tel; ?></td>
                    <td><?= $parent; ?></td>
                    <td><?= $AF; ?></td>
                    <td><?= $ELO; ?></td>
                    <td><?= $type; ?></td>
                    <td><?= $RAPIDE; ?></td>
                    <td><?= $MUTE; ?></td>
                    <?php
                }
                ?>
            </tr>
        </tbody>      
    </table>
    <?php
} else {
    if (isset($_REQUEST['id_competition'])) {
        ?>
        <h4>Aucun Joueur Trouvé Dans Cette Competition </h4>
        <?php
    } elseif (isset($_REQUEST['id_categorie'])) {
        ?>
        <h4>Aucun Joueur Trouvé Dans Cette Categorie </h4>
        <?php
    } elseif (isset($_REQUEST['id_groupe'])) {
        ?>
        <h4>Aucun Joueur Trouvé Dans Ce Groupe </h4>
        <?php
    } else {
        ?>
        <h4>Aucun Joueur Trouvé </h4>
        <?php
    }
}
?>




