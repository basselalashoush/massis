<?php
require_once 'model/Categorie.php';
$categorie = new Categorie();
$erreur = null;
$success = null;

$action = $_REQUEST['action'];
switch ($action) {
    case 'listeCategories':
        $lesCategories = $categorie->getLesCategories();
        include 'view/v_listeCategories.php';
        break;

    case 'addCategorie':
        include 'view/v_Categorie.php';
        break;

    case 'deleteCategorie':
        $id_categorie = $_REQUEST['id_categorie'];
        $categorie->deleteCategorie($id_categorie);
        ?>
                <div class="alert alert-success">
                 <?= $success = "la categorie a été supprimée"; ?>
                <p><a href="index.php?uc=categorie&action=listeCategories">Liste Categories</a></p>
                </div>
        <?php 
        break;

    case 'updateCategorie':
        $id_categorie = $_REQUEST['id_categorie'];
        $lacategorie = $categorie->getCategorie($id_categorie);
        include 'view/v_Categorie.php';
        break;

    case 'recordCategorie':
        $args = array(
            'id_categorie' => FILTER_VALIDATE_INT,
            'nom_categorie' => FILTER_SANITIZE_STRING,);
        $myinputs = filter_input_array(INPUT_POST, $args, false);
        
        $lesCategories = $categorie->getLesCategories();
        $categories=[];
         foreach ($lesCategories as $cat) {
            $categories [] =$cat->nom_categorie;
        }
                    if ($myinputs["id_categorie"] > 0) {
                        $id_categorie = $myinputs["id_categorie"];
                        unset($myinputs["id_categorie"]);
                        $categorie->modifierCategorie($myinputs, $id_categorie);
                        ?>
                            <div class="alert alert-success">
                                <?= $success = "la categorie a été modifiée"; ?>
                                <p><a href="index.php?uc=categorie&action=listeCategories">Liste Categories</a></p>
                            </div>
                        <?php
                    } else {  
                            if (in_array($myinputs['nom_categorie'], $categories)): ?>
                            <div class="alert alert-danger">
                                <?= $erreur = "le nom de categorie exisste déjà"; ?>
                                <p><a href="index.php?uc=categorie&action=listeCategories">Liste Categories</a></p>
                            </div>
                             <?php
                              else : ?>  
                                <?php
                        // pas besoin de id_categorie On le supprime du tableau
                        unset($myinputs["id_categorie"]);
                        $categorie->ajouterCategorie($myinputs);
                        ?>
                            <div class="alert alert-success">
                                <?= $success = "la categorie a été engregistrée"; ?>
                                <p><a href="index.php?uc=categorie&action=listeCategories">Liste Categories</a></p>
                            </div>
                        <?php
                        // ecrire une fichier text contient toutes les categorie ajoutées 
                        $file= __DIR__ .DIRECTORY_SEPARATOR . 'cat' . DIRECTORY_SEPARATOR . 'Categories.txt';
                        if(file_exists($file)){
                               $cats = file($file);
                               $lescats =[];
                               foreach($cats as  $cat){
                               $lescats []= trim($cat);
                               }
                               if(!in_array($myinputs['nom_categorie'], $lescats)){
                                   file_put_contents($file,$myinputs["nom_categorie"] .PHP_EOL,FILE_APPEND);
                               }
                        }else{
                           file_put_contents($file,$myinputs["nom_categorie"] .PHP_EOL,FILE_APPEND);
                        }
                        ?>
                        <?php endif; ?> 
                        <?php
                    }
                    ?>
                
        <?php break; ?>
         
<?php }?>


