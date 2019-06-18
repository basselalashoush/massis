<?php

require_once 'model/Joueur.php';

$joueur = new joueur();
$act=['lesGroupeDeJoueur','updateJoueur','deleteJoueur','addJoueur','listejoueurGroupe','listejoueurCategorie','listejoueurCompetition','lesJoueurDeMassis','listejoueur','recordJoueur'];
$action = $_REQUEST['action'] ?? '';?>
<?php if (!in_array($action,$act)) : ?>
<div class="alert-danger">
    <?= 'page introuvable' ?>
</div>
<?php endif ; ?>

<?php
$titel = $action;
switch ($action) {
    case 'listejoueur':
        $lesjoueur = $joueur->getLesjoueur();
        include 'view/v_listeJoueur.php';
       
        break;
    
    case'lesJoueurDeMassis':
        $lesjoueur=$joueur->getLesjoueurDeMassis();
        include 'view/v_listeJoueur.php';
        break;
    
    case 'listejoueurCompetition' :
        $id_competition = $_REQUEST['id_competition'];
        $lesjoueur = $joueur->lesjoueurParCompetition($id_competition);
        include 'view/v_listeJoueur.php';
        break;

    case 'listejoueurCategorie':
       // $Categorie = new Categorie();
        $id_categorie = $_REQUEST['id_categorie'];
        $lesjoueur = $joueur->getLesjoueurCategories($id_categorie);
        include 'view/v_listeJoueur.php';
        break;

    case 'listejoueurGroupe':
       // $groupe = new Groupe();
        $id_groupe = $_REQUEST['id_groupe'];
        $lesjoueur = $joueur->getLesjoueurParGroupe($id_groupe);
        include 'view/v_listeJoueur.php';
        break;

    case 'addJoueur':
        $categories = $joueur->getCategorie();
        include 'view/v_Joueur.php';
        break;

    case 'deleteJoueur':
        $id_joueur = $_REQUEST['id_joueur'];
        $joueur->deleteJoueur($id_joueur);
        ?>
                <div class="alert alert-success">
                    <?= $success = "le joueur a été supprimer"; ?>
                    <p><a href="index.php?uc=joueur&action=listejoueur">Liste Joueurs</a></p>
                 </div>
            <?php
        break;

    case 'updateJoueur':
        $id_joueur = $_REQUEST['id_joueur'];
        $categories = $joueur->getCategorie();
        $lejoueur = $joueur->getLeJoueur($id_joueur);
        include 'view/v_Joueur.php';
        break;

    case 'recordJoueur':
        $args = array(
            'id_joueur' => FILTER_VALIDATE_INT,
            'nr_ffe' => FILTER_SANITIZE_STRING,
            'adherent'=>FILTER_SANITIZE_STRING,
            'nom'=>FILTER_SANITIZE_STRING,
            'prenom' => FILTER_SANITIZE_STRING,
            'parent' => FILTER_SANITIZE_STRING,
            'adresse' => FILTER_SANITIZE_STRING,
            'code_postal' => FILTER_SANITIZE_STRING,
            'ville' => FILTER_SANITIZE_STRING,
            'tel' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_STRING,
            'af' => FILTER_SANITIZE_STRING,
            'elo' => FILTER_SANITIZE_STRING,
            'type' => FILTER_SANITIZE_STRING,
            'rapide' => FILTER_SANITIZE_STRING,
            'mute' => FILTER_SANITIZE_STRING,
            'id_categorie'=> FILTER_VALIDATE_INT
        );
        $lesjoueur = $joueur->getLesjoueur();
        $players = [];
        foreach ($lesjoueur as $player) {
           $players [] = $player->nr_ffe;
        }
        $myinputs = filter_input_array(INPUT_POST, $args, false);
        if(empty($myinputs['id_categorie'])){
            //ce sera ajouter une categorie par defult teporaire base de donéé .
            unset($myinputs['id_categorie']);
        }
    if(empty($myinputs['nr_ffe'])){
        // un clé unique et on oblige pas l'utilisateur à entrer son numéro car peut être il le connait pas 
        // et on peut pas enregistrer deux numéro vide car ce sont identique 
       $tables =  $joueur->trouver_nr_ffe();
       $nrffes = [];
       foreach ($tables as $table){
        // si le retoure est un object stdclass
        //convertire un object stdclass into arry 
        // $tab1 = json_decode(json_encode($table), true);
            $table1 = implode($table);
           $nrffe = substr($table1,1);
           $nrffes [] = (int)$nrffe;
       }
       if(!empty($nrffes)){
        $new_nrffe = strval(max($nrffes)+1);
       $myinputs['nr_ffe'] ='A'. $new_nrffe ;
       }
       else{
        $myinputs['nr_ffe'] = 'A';
       }
    }
 ?>
         <?php if(in_array($myinputs['nr_ffe'] , $players) && empty($myinputs['id_joueur'])) : ?>
                <div class="alert alert-danger">
                    <?= $erreur = "le numéro NR8FFE  de joueur exisste déjà"; ?>
                    <p><a href="index.php?uc=joueur&action=listejoueur">Liste Joueurs</a></p>
                </div>
                <?php exit(); ?>
            <?php else : ?>
                <?php
        if ($myinputs["id_joueur"] > 0) {
             $id_joueur=$myinputs["id_joueur"];
             unset($myinputs["id_joueur"]);
        $joueur->modifierJoueur($myinputs,$id_joueur);
        ?>
                <div class="alert alert-success">
                    <?= $success = "le joueur a été modifiée"; ?>
                    <p><a href="index.php?uc=joueur&action=listejoueur">Liste Joueurs</a></p>
                 </div>
            <?php
    } else {
        // Puisque qu'on ajoute un joueur, pas besoin de id_joueur
        // On le supprime du tableau
        unset($myinputs['id_joueur']);
        $joueur->ajouterJoueur($myinputs);
             ?>
                <div class="alert alert-success">
                        <?= $success = "le joueur a été engregistrée"; ?>
                        <p><a href="index.php?uc=joueur&action=listejoueur">Liste Joueurs</a></p>
                </div>
                <?php } ?>
        <?php break; ?>
        <?php endif; ?>
        
        <?php
    case 'lesGroupeDeJoueur':
        $id_joueur = $_REQUEST['id_joueur'];
        $lejoueur = $joueur->getLeJoueur($id_joueur);
        $lesGroupes = $joueur->lesGroupeDeJoueur($id_joueur);
        include 'view/v_listeGroupeDeJoueur.php';
        break;
}
?>

   

