<?php
require_once 'controller/c_Competition.php';
require_once 'model/Competition.php';
$title = $_REQUEST['action'];
if ($title == 'addCompetition') {
    $title = 'Ajouter Une Competition';
} else {
    $title = 'Modifier La Competition';
}
?>
<form class="form" action="index.php?uc=competition&action=recordCompetition" method="post">
    <fieldset>
        <div class="col-md-6 alert alert-warning"><strong><?= $title; ?>&nbsp;<?php
                if (isset($lacompetition)): echo strtoupper($lacompetition->nom_competition);
                endif;
                ?></strong></div>    
        <div>
            <input type="hidden" name="id_competition" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->id_competition : ''; ?>" />
        </div>
        <div class="form-group col-md-6">
            <label for="nom_competition">Nom Competition</label>
            <input type="text" name="nom_competition" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->nom_competition : ''; ?>" />
        </div>
        <div class="form-group col-md-6">
            <label for="lieu_competition">Lieu Competition</label>
            <input type="text" name="lieu_competition" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->lieu_competition : 'Lyon'; ?>"  />
        </div>
        <div class="form-group col-md-6">
            <label for="commentaire">Commentaire</label>
            <input type="text" name="commentaire" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->commentaire : ''; ?>"  />
        </div>
         <div class="form-row">
            <div class="form-group col-md-3">
                <label for="date_competition">Date Debut</label>
                <input type="date" name="date_competition" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->date_competition : ''; ?>" required />
            </div>
            <div class="form-group col-md-3">
                <label for="time_competition">Heure</label>
                <input type="time" name="time_competition" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->time_competition : ''; ?>" />
            </div>
         </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="date_fin_competition">Date Fin</label>
                <input type="date" name="date_fin_competition" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->date_fin_competition : ''; ?>" required />
            </div>
            <div class="form-group col-md-3">
                <label for="time_fin_competition">Heure</label>
                <input type="time" name="time_fin_competition" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->time_fin_competition : ''; ?>" />
            </div>
         </div>
        <div class="form-group col-md-6">
            <label for="cout">Coût</label>
            <input type="text" name="cout" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->cout : '€'; ?>" />
        </div>
        <div class="form-group col-md-6">
            <label for="img">Image</label>
            <input type="text" name="img" class="form-control" value="<?= isset($lacompetition) ? $lacompetition->img : '/c_img/logo.png'; ?>"/>
            <i class="fa fa-link"></i> /c_image/nom_image.type_image  EX: /c_img/logo.png
        </div>
        <button type="submit" class="btn btn-outline-light">Valider</button>
        <button type="reset" class="btn btn-outline-light" onClick="window.location.href = 'index.php?uc=competition&action=listeCompetition';">Annuler</button>
    </fieldset>
</form>
