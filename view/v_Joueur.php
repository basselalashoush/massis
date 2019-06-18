<?php
require_once 'controller/c_Joueur.php';
require_once 'model/Joueur.php';
$joueur = new Joueur();
$title = $_REQUEST['action'];
if ($title == 'addJoueur') {
    $title = 'Ajouter Un Joueur';
} else {
    $title = 'Modifier Le Joueur';
}
?>

<form class="form" action="index.php?uc=joueur&action=recordJoueur" method="post" onsubmit="return joueurvide()">
    <fieldset>
        <div class="col-md-6 alert alert-warning"><strong><?= $title ?>&nbsp;<?php
                if (isset($lejoueur)) : echo strtoupper($lejoueur->nom);
                endif;
                ?>&nbsp;<?php
                if (isset($lejoueur)) :echo ucfirst($lejoueur->prenom);
                endif;
                ?></strong></div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputNom">Nom</label>
                <input type="text" name="nom" class="form-control" value="<?= isset($lejoueur) ? $lejoueur->nom : ''; ?>" required />
            </div>
            <div class="form-group col-md-3">
                <label for="inputPrenom">Prénom</label>
                <input name="prenom"  class="form-control" value="<?= isset($lejoueur) ? $lejoueur->prenom : ''; ?>" required />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">

                <label for="id_categorie">Categorie</label>
                <select  name="id_categorie" id="id_categorie" class="form-control" >  
                    <?php if (!isset($lejoueur)) : ?>
                        <option> Sélectionner la categorie </option>
                    <?php endif; ?>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie->id_categorie ?> "
                        <?php if (isset($lejoueur) && $lejoueur->id_categorie === $categorie->id_categorie) : ?>
                                    selected = "selected"
                                <?php endif; ?>>
                                    <?= $categorie->nom_categorie; ?>                        
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="adherent">Adherent</label>
                <select name="adherent" class="form-control" >
                    <option> massis</option>
                    <option> exterieur</option>
                    <?php if (isset($lejoueur)) : ?>
                        <option value="<?php echo $lejoueur->adherent ?> "
                                selected = "selected"
                            <?php endif; ?>><?php echo $lejoueur->adherent ?>
                    </option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="nr_ffe">NrFFE</label>
                <input name="nr_ffe" class="form-control" value="<?= isset($lejoueur) ? $lejoueur->nr_ffe : ''; ?>" />
            </div>
            <div class="form-group col-md-2">
                <label for="af">AF</label>
                <select name="af" class="form-control" >
                    <option>A</option>
                    <option>B</option>
                    <?php if (isset($lejoueur)) : ?>
                        <option value="<?php echo $lejoueur->af ?> "
                                selected = "selected"
                            <?php endif; ?>><?php echo $lejoueur->af ?>
                </select>           
            </div>
            <div class="form-group col-md-2">
                <label for="elo">ELO</label>
                <input name="elo"  class="form-control" value="<?= isset($lejoueur) ? $lejoueur->elo : ''; ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="parent">Parent</label>
                <input type="text" name="parent" class="form-control" value="<?= isset($lejoueur) ? $lejoueur->parent : ''; ?>" />
            </div>
            <div class="form-group col-md-3">
                <label for="tel">Téléphone</label>
                <input name="tel"  class="form-control" value="<?= isset($lejoueur) ? $lejoueur->tel : ''; ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="adresse">Adresse</label>
                <input name="adresse"  class="form-control" value="<?= isset($lejoueur) ? $lejoueur->adresse : ''; ?>" />
            </div>
            <div class="form-group col-md-3">
                <label for="code_postal">Code Postal</label>
                <input name="code_postal" class="form-control" value="<?= isset($lejoueur) ? $lejoueur->code_postal : ''; ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <input type="hidden" name="id_joueur" id="idjoueur" class="champ" value="<?= isset($lejoueur) ? $lejoueur->id_joueur : ''; ?>"  />
                <label for="ville">Ville</label>
                <input name="ville"  class="form-control" value="<?= isset($lejoueur) ? $lejoueur->ville : ''; ?>" />
            </div>
            <div class="form-group col-md-3">
                <label for="email">Email</label>
                <input name="email" id="mail" class="form-control" value="<?= isset($lejoueur) ? $lejoueur->email : ''; ?>" onchange="verifieMail(this);"/>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="mute">Muté</label>
                <input name="mute"  class="form-control" value="<?= isset($lejoueur) ? $lejoueur->mute : ''; ?>" />
            </div>
            <div class="form-group col-md-2">
                <label for="rapide">Rapide</label>
                <input name="rapide"  class="form-control" value="<?= isset($lejoueur) ? $lejoueur->rapide : ''; ?>" />
            </div>
            <div class="form-group col-md-2">
                <label for="type">Type</label>
                <select name="type" class="form-control" >
                    <option> N</option>
                    <option> F</option>
                    <option> E</option>
                    <?php if (isset($lejoueur)) : ?>
                        <option value="<?php echo $lejoueur->type ?> "
                                selected = "selected"
                            <?php endif; ?>><?php echo $lejoueur->type ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-light">Valider</button>
        <button type="reset" class="btn btn-outline-light" onClick="window.location.href = 'index.php?uc=joueur&action=listejoueur';">Annuler</button>
    </fieldset>
</form>
