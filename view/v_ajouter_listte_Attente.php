<?php
require_once 'controller/c_liste_attente.php';
require_once 'model/Liste_attente.php';
$liste_attente = new Liste_attente();

if (!empty($_REQUEST['id_joueur'])) {
    $title = "Ajouter Le Joueur";
} else {
    $title = 'Ajouter Un Joueur';
}
?>

<form  class="form" action="index.php?uc=participants&action=recordParticipant" method="post" onsubmit="return competitionvide()">
    <fieldset>
        <div class="col-md-6  alert alert-warning"><strong><?= $title ?>&nbsp;<?php if (isset($lejoueur)) : echo strtoupper($lejoueur->nom);
            endif; ?>&nbsp;<?php if (isset($lejoueur)) :echo ucfirst($lejoueur->prenom);
            endif; ?> dans une competition</strong></div> 
        <div class="form-group col-md-6">
            <label for="id_joueur">Joueur</label>
            <select  name="id_joueur" id="id_joueur" class="form-control" >  
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
            <label for="id_competition">Competition</label>
            <select  name="id_competition" id="id_competition" class="form-control" >  
                <option>Sélectionner competition</option>
                    <?php foreach ($lesCompetitions as $competition) : ?>
                    <option value="<?php echo $competition->id_competition ?> ">
                    <?php echo $competition->nom_competition; ?>                        
                    </option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div>   
            <input type="hidden" name="etat"  class="form-control" value=" ''"  />
        </div>
        <div>
            <input type="hidden" name="date_inscription"  class="form-control" value="''"  />
        </div>
        <button type="submit" class="btn btn-outline-light">Valider</button>
        <button type="reset" class="btn btn-outline-light" onClick="window.location.href = 'index.php?uc=joueur&action=listejoueur';">Annuler</button>
    </fieldset>
</form>
