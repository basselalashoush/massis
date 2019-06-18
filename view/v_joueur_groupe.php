<?php
require_once 'controller/c_joueur_groupe.php';
require_once 'model/Joueur_groupe.php';
$title = $_REQUEST['action'];

if ($title == 'ajouterJoueur') {
    $title = 'Ajouter Un Joueur';
} else {
    $title = 'Ajouter Le Joueur';
}
?>

<form class="form" action="index.php?uc=joueurGroupe&action=recordJoueurGroupe" method="post" onsubmit="return joueur_groupevide()">
    <fieldset>
        <div class="col-md-6 alert alert-warning"><strong><?= $title ?>&nbsp;<?php if (isset($lejoueur)) : echo strtoupper($lejoueur->nom);
            endif; ?>&nbsp;<?php if (isset($lejoueur)) :echo ucfirst($lejoueur->prenom);
            endif; ?> dans un groupe</strong></div>   
        <div class="form-group col-md-6">
            <label for="id_joueur">Joueur</label>
            <select  name="id_joueur" id="id_joueur" class="form-control" />  
                <?php if (!isset($lejoueur)) : ?>
                    <option>Sélectionner joueur</option>
            <?php endif; ?>
                <?php foreach ($lesjoueur as $joueur) : ?>

                    <option value="<?php echo $joueur->id_joueur ?> "
                            <?php if (isset($lejoueur) && $lejoueur->id_joueur === $joueur->id_joueur) : ?>
                                selected = "selected"
                    <?php endif; ?>>
                    <?= strtoupper($joueur->nom); ?>&nbsp;<?= ucfirst($joueur->prenom); ?>&nbsp;<?= "N°FFE : $joueur->nr_ffe" ?>                        
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="id_groupe">Groupe</label>
            <select  name="id_groupe" id="id_groupe" class="form-control">  
                <?php if (!isset($Gjoueur)) : ?>
                    <option>Sélectionner groupe</option>
                <?php endif; ?>
                <?php foreach ($groupes as $groupe) : ?>
                    <option value="<?php echo $groupe->id_groupe; ?> "
                            <?php if (isset($Gjoueur) && $Gjoueur->id_groupe === $groupe->id_groupe) : ?>
                                selected = "selected"
                    <?php endif; ?>>
                    <?php echo $groupe->nom_groupe; ?>                        
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-outline-light">Valider</button>
        <button type="reset" class="btn btn-outline-light" onClick="window.location.href = 'index.php?';">Annuler</button>
    </fieldset>
</form>
