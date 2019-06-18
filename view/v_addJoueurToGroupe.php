<?php
require_once 'controller/c_liste_attente.php';
require_once 'model/Groupe.php';

$title = $_REQUEST['action'] ?? 'Séléctionnez un Groupe';
if ($title == 'addGroupe') {
    $title = 'Ajouter Un Groupe';
} else {
    $title = 'Modifier Le Groupe';
}
?>
<form class="form"  action="index.php?uc=joueurGroupe&action=recordJoueurGroupe" method="post">
    <fieldset>
        <div class="col-md-3 alert alert-warning"><strong><?php $title ?></strong></div>
        <div>
            <input type="hidden" name="id_joueur" class="champ" value="<?= $id_joueur; ?>" />
        </div>
        <div>
            <input type="hidden" name="id_competition" class="champ" value="<?= $id_competition; ?>" />
        </div>
<?php if ($groupes <> null) { ?>
            <div class="form-group col-md-3">
                <label for="id_groupe">Groupe</label>
                <select name = "id_groupe" id = "id_groupe" class="form-control" >
                    <option> Sélectionner le groupe </option>
    <?php foreach ($groupes as $ungroupe) : ?>
                        <option value="<?php echo $ungroupe->id_groupe ?> "><?= $ungroupe->nom_groupe; ?>                       
                        </option>
    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-outline-light">Valider</button>
            <button type="reset" class="btn btn-outline-light" onClick="window.location.href = 'index.php?uc=joueur&action=listejoueur';">Annuler</button>
        <?php
        }
        else {
            ?>
            <h4>veuillez créer un groupe puis confirmer la participation a la competition</h4>
            <a href="index.php?uc=groupe&action=addGroupe&id_competition=<?= $id_competition ?>">crée un groupe</a>
            <?php
        }
        ?>   
    </fieldset>
</form>
