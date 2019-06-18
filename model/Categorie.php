<?php
require_once 'connections/Connection.php';
class Categorie {
    
    public function getLesCategories(): array {
        try{
        $req = "SELECT categorie.id_categorie,nom_categorie from categorie";
        $pdo= Connection::getPDO();
        $res = $pdo->query($req);
        $lesCategories=$res->fetchAll(PDO::FETCH_OBJ);
        return $lesCategories;
        } catch (PDOException $ex) {
                echo $ex;
        }
    }

    public function getCategorie($id_categorie) {
        try{
        $req = "select * from categorie where id_categorie='$id_categorie'";
        $pdo= Connection::getPDO();
        $res = $pdo->query($req);
        $laCategorie=$res->fetch(PDO::FETCH_OBJ);
        return $laCategorie;
        } catch (PDOException $ex) {
                echo $ex;
        }
    }

    public function modifierCategorie($myinputs,$id_categorie) {
         // 1 : On récupère les clés de $myinputs 
        // qui correspondent aux colonnes de la table categorie
        $keys = array_keys($myinputs); 
        // 2 : On construit une chaîne (id_categorie, nom_categorie) automatiquement
        $fields = '`'.implode('`=?, `',$keys).'`';
        $fields .= '=?';
        $values = array_values($myinputs);       
        try {
            // 4 On prépare la requête, on se connecte à PDO
            $req = "UPDATE  `categorie` SET $fields WHERE id_categorie=$id_categorie";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            // 5 On éxécute la requête en envoyant directement 
            // les valeurs de $myinputs
            $res->execute($values);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function ajouterCategorie($myinputs) {

        // 1 : On récupère les clés de $myinputs 
        // qui correspondent aux colonnes de la table categorie
        $keys = array_keys($myinputs); 
        // 2 : On construit une chaîne (id_categorie, nom_categorie) automatiquement
        $fields = '`'.implode('`, `',$keys).'`';
        // 3 on sécurise la requête, il faut mettre  des ?, 
        // autant de ? qu'il y a de colonne dans le tableau des colonnes, $keys
        $placeholder = substr(str_repeat('?,',count($keys)),0,-1);        
        $values = array_values($myinputs);  

        try {
            // 4 On prépare la requête, on se connecte à PDO
            $req = "INSERT INTO `categorie`($fields) VALUES($placeholder)";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            // 5 On éxécute la requête en envoyant directement 
            // les valeurs de $myinputs
            $res->execute($values);
        } catch (PDOException $ex) {
            $ex;
        }
    }

    public function deleteCategorie($id_categorie) {
        try{
        $req = "DELETE FROM categorie WHERE id_categorie='$id_categorie'";
        $pdo= Connection::getPDO();
        $res = $pdo->prepare($req);
        $res->execute();
        } catch (PDOException $ex) {
                echo $ex;
        }
    }
}
