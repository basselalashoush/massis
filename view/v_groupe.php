<?php

require_once 'controller/c_groupes.php';
require_once 'model/Groupe.php';
$title = $_REQUEST['action'];
if ($title == 'updateGroupe') {
    $title = 'Modifier Le Groupe';
} else {
    $title = 'Ajouter Un Groupe';
}
?>

<form class="groupe" name="groupe" action="index.php?uc=groupe&action=recordGroupe" method="post" onsubmit="return chambreVide()">
    <fieldset>
        <div class=" col-md-6 alert alert-warning"><strong><?= $title; ?>&nbsp;<?php if (isset($leGroupe)): echo strtoupper($leGroupe->nom_groupe);
endif;
?></strong></div>   
        <div class="form-group col-md-6">
            <input type="hidden" name="id_groupe" class="form-control" value="<?= isset($leGroupe) ? $leGroupe->id_groupe : ''; ?>" />
            <label for="id_competition">Competition</label>
            <select  name="id_competition" id="id_competition" class="form-control" >  
            <?php if (isset($cetteCompetition)) : ?>
                    <option value="<?= $cetteCompetition->id_competition;?>"> <?= $cetteCompetition->nom_competition;?> </option>
                <?php endif; ?>
                <?php if (!isset($leGroupe) && !isset($lacompetition)) : ?>
                    <option>Sélectionner la compétition</option>
                <?php endif; ?>
                <?php foreach ($competitions as $competition) : ?>
                    <option value="<?php echo $competition->id_competition; ?> "
                            <?php if ((isset($leGroupe) && $leGroupe->id_competition === $competition->id_competition) || (isset($lacompetition) && $lacompetition->id_competition === $competition->id_competition)) : ?>
                                selected = "selected"
                                <?php endif; ?>>
                    <?php echo $competition->nom_competition; ?>                        
                    </option>
<?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="nom_groupe">Nom Groupe</label>
            <input type="text" name="nom_groupe" class="form-control" value="<?= isset($leGroupe) ? $leGroupe->nom_groupe : ''; ?>" />
        </div>
        <button type="submit" class="btn btn-outline-light">Valider</button>
        <button type="reset" class="btn btn-outline-light" onClick="window.location.href = 'index.php?uc=groupe&action=listeGroupes';">Annuler</button>
    </fieldset>
</form>