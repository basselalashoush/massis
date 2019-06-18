<?php

require_once 'model/Joueur_groupe.php';
$joueur_groupe = new Joueur_groupe();
require_once 'model/Joueur.php';
$joueur = new Joueur();
$action = $_GET['action'];
$titel = $action;
switch ($action) {
    case 'addJoueurGroupe':
        if (!empty($_REQUEST['id_joueur'])) {
            $id_joueur = $_REQUEST['id_joueur'];
        }
        $lesjoueur = $joueur->getLesjoueur();
        if (isset($id_joueur)) {
            $lejoueur = $joueur->getLeJoueur($id_joueur);
        }
        $groupes = $joueur_groupe->getGroupes();
        include 'view/v_joueur_groupe.php';
        break;
    case 'recordJoueurGroupe':
        $id_joueur = filter_input(INPUT_POST, 'id_joueur', FILTER_VALIDATE_INT);
        $id_groupe = filter_input(INPUT_POST, 'id_groupe', FILTER_VALIDATE_INT);
        if(!empty($id_groupe) && !empty($id_joueur)){
        $groupes = $joueur_groupe->getGroupe($id_groupe);
        $player = $joueur->getjoueur($id_joueur);
        foreach($player as $p){
        $joueur_groupe->AjouterJoueurGroupes($id_joueur, $id_groupe);
        ?>
                <div class="alert alert-success">
                    <?= $success = "le joueur <strong>$p->nom $p->prenom</strong> a été ajouté au groupe <strong>$groupes->nom_groupe</strong>"; ?><br>
                   <button class="btn btn-success"><a href="index.php?uc=joueur&action=lesGroupeDeJoueur&id_joueur=<?=$id_joueur; ?>">Les groupes de joueur</a></button>
                 </div>
       <?php
        }
    }
    else{
        ?>
                <div class="alert alert-danger">
                    <?= $error = "merci de selectioner un groupe et un joueur"; ?><br>
                    <button class="btn btn-danger"><a href="index.php?uc=joueurGroupe&action=addJoueurGroupe">Inscrire aux Groupes</a></button>
                 </div>
       <?php
    }
        break;
    case 'deletJoueurFromGroupe':
        $id_joueur = $_REQUEST['id_joueur'];
        $id_groupe = $_REQUEST['id_groupe']; $groupes = $joueur_groupe->getGroupe($id_groupe);
        $player = $joueur->getjoueur($id_joueur);
        foreach($player as $p){
        $joueur_groupe->deleteJoueurFromGroupe($id_joueur, $id_groupe);
        ?>
        <div class="alert alert-success">
            <?= $success = "le joueur <strong>$p->nom $p->prenom</strong> a été supprimé de la groupe <strong>$groupes->nom_groupe</strong>"; ?>
           <p><a href="index.php?uc=joueur&action=lesGroupeDeJoueur&id_joueur=<?=$id_joueur; ?>">Les groupes de joueur</a></p>
         </div>
<?php
}
}

