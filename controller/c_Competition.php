<?php

require_once 'model/Competition.php';
$competition = new Competition();


$action = $_REQUEST['action'];
switch ($action) {
    case 'listeCompetition': {
            $lesCompetitions = $competition->getLesCompetitions();
            include 'view/v_listeCompetition.php';
            break;
        }
    case 'addCompetition': {
            include 'view/v_Competition.php';
            break;
        }
    case 'deleteCompetition': {
            $id_competition = $_REQUEST['id_competition'];
            $competition->deleteCompetition($id_competition);
            ?>
                    <div class="alert alert-success">
                       <?= $success = "la competition a été supprimée"; ?>
                      <p><a href="index.php?uc=competition&action=listeCompetition">Liste Competitions</a></p>
                    </div>
            <?php
            break;
        }
    case 'updateCompetition': {
            $id_competition = $_REQUEST['id_competition'];
            $lacompetition = $competition->getCompetition($id_competition);
            include 'view/v_Competition.php';
            break;
        }
    case 'recordCompetition': {
            $args1 = array(
                'id_competition' => FILTER_VALIDATE_INT,
                'nom_competition' => FILTER_SANITIZE_STRING,
                'lieu_competition' => FILTER_SANITIZE_STRING,
                'commentaire' => FILTER_SANITIZE_STRING,
                'date_competition' => FILTER_SANITIZE_STRING,
                'time_competition' => FILTER_SANITIZE_STRING,
                'date_fin_competition' => FILTER_SANITIZE_STRING,
                'time_fin_competition' => FILTER_SANITIZE_STRING,
                'cout' => FILTER_SANITIZE_STRING,
                'img' => FILTER_SANITIZE_STRING
            );
            $lesCompetitions = $competition->getLesCompetitions();
            $competitions = [];
            foreach ($lesCompetitions  as $compt) {
                $competitions [] = $compt->nom_competition;
            }
            
            $myinputs1 = filter_input_array(INPUT_POST, $args1, false);
            //  var_dump(!is_null($myinputs1['id_competition'])); 
            // exit(); 

            if(in_array($myinputs1['nom_competition'] , $competitions) && empty($myinputs1['id_competition'])) : ?>

                <div class="alert alert-danger">
                    <?= $erreur = "le nom de competition exisste déjà"; ?>
                    <p><a href="index.php?uc=competition&action=listeCompetition">Liste Competitions</a></p>
                </div>
            <?php else : ?>
                <?php
            $date_competition = $myinputs1['date_competition'] . ' ' . $myinputs1['time_competition'];
            $date_fin_competition = $myinputs1['date_fin_competition'] . ' ' . $myinputs1['time_fin_competition'];
            unset($myinputs1["date_competition"], $myinputs1["time_competition"], $myinputs1["date_fin_competition"], $myinputs1["time_fin_competition"]);
             $args2=array(
                'date_competition'=>$date_competition,
                'date_fin_competition'=>$date_fin_competition);
            // $myinputs1['date_competition'] = $date_competition;
            // $myinputs1['date_fin_competition'] = $date_fin_competition;
             $myinputs=(array_merge($myinputs1,$args2));
            if ($myinputs["id_competition"] > 0) {
                $id_competition = $myinputs["id_competition"];
                unset($myinputs["id_competition"]);
                $competition->modifierCompetition($myinputs,$id_competition);
                ?>
                             <div class="alert alert-success">
                                <?= $success = "la competition a été modifiée"; ?>
                                <p><a href="index.php?uc=competition&action=listeCompetition">Liste Competitions</a></p>
                            </div>
            <?php
            } else {
                // Puisque qu'on ajoute une compétition, pas besoin de id_competition
                // On le supprime du tableau
                unset($myinputs['id_competition']);
                $competition->ajouterCompetition($myinputs);
                ?>
                            <div class="alert alert-success">
                                <?= $success = "la Competition a été engregistrée"; ?>
                                <p><a href="index.php?uc=competition&action=listeCompetition">Liste Competitions</a></p>
                            </div>
                <?php } ?>
        <?php break; ?>
        <?php endif; ?>
        <?php }}?>