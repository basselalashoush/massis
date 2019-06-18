<?php

require_once 'model/Groupe.php';
require_once 'model/Liste_attente.php';
require_once 'model/Joueur_groupe.php';
require_once 'model/Joueur.php';
include_once 'model/Competition.php';
$competition = new Competition();
$joueur = new Joueur();
$liste = new Liste_attente();
$action = $_REQUEST['action'];
switch ($action) {
    case 'listeParticipants':
        $listeAttente = $liste->getLesListe_attentes();
        include 'view/v_listeAttente.php';
        break;
    case 'confirme':
        $id_joueur = $_REQUEST['id_joueur'];
        $id_competition = $_REQUEST['id_competition'];
        $groupe = new Groupe();
        $groupes = $groupe->getGroupeCompetition($id_competition);
        $player = $joueur->getjoueur($id_joueur);
            foreach($player as $p){
        if($groupes<>null){
            $grs = [];
            $lesGroupeDeJoueur =$joueur->lesGroupeDeJoueur($id_joueur);
            foreach($lesGroupeDeJoueur as $gr){
               $grs []= $gr->nom_groupe;
            }
            $grs1 = [];
            foreach($groupes as $gr){
                 $grs1 []= $gr->nom_groupe;
            }
            $common = array_intersect($grs,$grs1);
            if($common<> null){
                $liste->confirmer($id_joueur, $id_competition);
                ?>
                        <div class="alert alert-success">
                            <?= $success = "La Paricipation Du Joueur <strong>$p->nom $p->prenom</strong> à été confirmée"; ?>
                        </div>
            <?php
                
            }else{
                include 'view/v_addJoueurToGroupe.php'; 
                ?>
                <div class="alert alert-danger">
                    <?= $danger = " pour confirmé la participation du  joueur <strong>$p->nom $p->prenom</strong> merci d'affecter un groupe pour le joueur et puis confirmé la participation"; ?>
                </div>
                <?php
                }
    }else {
       $cetteCompetition = $competition-> getCompetition($id_competition);
        include 'view/v_groupe.php';
        ?>
        <div class="alert alert-danger">
            <?= $danger = " pour confirmé la participation du  joueur <strong>$p->nom $p->prenom</strong> merci de crée un  groupe appartien de cette competition et puis confirmé la participation"; ?>
        </div>
        <?php
    }
    }
        break;
    case 'addParticipant':
        if(!empty($_REQUEST['id_joueur'])){
        $id_joueur = $_REQUEST['id_joueur'];}
        $lesjoueur = $joueur->getLesjoueur();
        if (isset($id_joueur)) {
            $lejoueur = $joueur->getLeJoueur($id_joueur);
        }
        $lesCompetitions = $competition->getLesCompetitions();
        include 'view/v_ajouter_listte_Attente.php';
        break;

    case 'recordParticipant':
        $args = array(
            'id_joueur' => FILTER_VALIDATE_INT,
            'id_competition' => FILTER_VALIDATE_INT);
           $myinputs = filter_input_array(INPUT_POST, $args, false);
        $liste->ajouterParticipant($myinputs);
        break;
    
    case 'deleteParticipant':
        $id_competition = $_REQUEST['id_competition'];
        $id_joueur = $_REQUEST['id_joueur'];
        $liste->deleteParticipant($id_joueur, $id_competition);
}

