
<?php
require_once 'model/Groupe.php';
require_once 'model/Competition.php';
$competition = new Competition();
$groupe = new groupe();
$action = $_REQUEST['action'];
switch ($action) {
    case 'listeGroupes': 
            $lesGroupes = $groupe->getLesGroupes();
            include 'view/v_listeGroupes.php';
            break;
        
    case 'addGroupe': 
        if(!empty($_REQUEST['id_competition'])){
            $id_competition=$_REQUEST['id_competition'];
        $lacompetition=$competition->getCompetition($id_competition);}
       $competitions = $groupe->getCompetitions();
        include 'view/v_groupe.php';
            break;
        
    case 'deleteGroupe': 
             $id_groupe =$_REQUEST['id_groupe'];
             $groupe->deleteGroupe($id_groupe);
             ?>
                <div class="alert alert-success">
                    <?= $success = "le Groupe a été supprimé"; ?>
                    <p><a href="index.php?uc=groupe&action=listeGroupes">Liste Groupes</a></p>
                 </div>
            <?php
            break;
        
    case 'updateGroupe': 
            $id_groupe =$_REQUEST['id_groupe'];
            $leGroupe = $groupe->getGroupe($id_groupe);
            $competitions = $groupe->getCompetitions();
            include 'view/v_groupe.php';
            break;
        
        case 'recordGroupe':
           $args = array(
            'id_groupe' => FILTER_VALIDATE_INT,
            'id_competition' => FILTER_SANITIZE_STRING,
            'nom_groupe'=>FILTER_SANITIZE_STRING);
            $myinputs = filter_input_array(INPUT_POST, $args, false);
            $groupes = $groupe->getLesGroupes();
            $nom_groupes = [];
            foreach($groupes as $g){
                $nom_groupes [] = $g->nom_groupe;
            }
            ?>

           <?php if(in_array($myinputs['nom_groupe'],$nom_groupes)&& empty($myinputs['id_groupe'])): ?>
           <div class="alert alert-danger">
               <?= $error = "le nom de groupe  exisste déjà"; ?>
                    <p><a href="index.php?uc=groupe&action=listeGroupes">Liste Groupes</a></p>
           </div>
           <?php exit; ?>
           <?php else : ?>
           <?php 
           
            if ($myinputs['id_groupe']> 0) {
                $id_groupe=$myinputs['id_groupe'];
                unset($myinputs['id_groupe']);
        $groupe->modifierGroupe($myinputs,$id_groupe);
        ?>
        <div class="alert alert-success">
               <?= $error = "le groupe à été modifié"; ?>
                    <p><a href="index.php?uc=groupe&action=listeGroupes">Liste Groupes</a></p>
           </div>
           <?php
    } else {
        unset($myinputs['id_groupe']);
         $groupe->ajouterGroupe($myinputs);
         ?>
         <div class="alert alert-success">
               <?= $error = "le groupe à été enregistré"; ?>
                    <p><a href="index.php?uc=groupe&action=listeGroupes">Liste Groupes</a></p>
           </div>
           <?php
    }
            endif;
            break;
}

