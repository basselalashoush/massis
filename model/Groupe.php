<?php

require_once 'connections/Connection.php';
require_once 'Competition.php';

class Groupe {

    public function getLesGroupes() {
        try {
            $req = "SELECT groupe.nom_groupe,id_groupe, competition.nom_competition,groupe.id_competition
                    FROM groupe
                    LEFT JOIN competition ON (groupe.id_competition = competition.id_competition)";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesgroupes = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesgroupes;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getGroupe($id_groupe) {
        try {
            $req = "SELECT id_groupe, id_competition, nom_groupe
                    FROM `groupe`
                    WHERE `id_groupe` ='$id_groupe'";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $groupe = $res->fetch(PDO::FETCH_OBJ);
            return $groupe;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
/*** recuperer les groupes  correspondant $id_competition
 * via table groupe
 * @param int $id_competition
 * @return array
 */
    public function getGroupeCompetition(int $id_competition):array {
        try {
            $req = "SELECT groupe.nom_groupe,id_groupe 
                    FROM `groupe`
                    WHERE `id_competition` ='$id_competition'";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesgroupes = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesgroupes;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getCompetitions() {
        try {
            $competition = new Competition();
            return $competition->getLesCompetitions();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function ajouterGroupe($myinputs) {
        // 1 : On récupère les clés de $myinputs 
        // qui correspondent aux colonnes de la table groupe
        $keys= array_keys($myinputs);
         // 2 : On construit une chaîne (id_groupe, id_competition,etc...) automatiquement
        $fields = '`'.implode('`, `',$keys).'`';
        // 3 on sécurise la requête, il faut mettre  des ?, 
        // autant de ? qu'il y a de colonne dans le tableau des colonnes, $keys
        $placeholder = substr(str_repeat('?,',count($keys)),0,-1); 
        $values= array_values($myinputs);
        try {
            // 4 On prépare la requête, on se connecte à PDO
            $req = "INSERT INTO `groupe`($fields) VALUES ($placeholder)";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            // 5 On éxécute la requête en envoyant directement 
            // les valeurs de $myinputs
            $res->execute($values);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function modifierGroupe($myinputs, $id_groupe) {
        // 1 : On récupère les clés de $myinputs 
        // qui correspondent aux colonnes de la table groupe
        $kyes = array_keys($myinputs);
        // 2 : On construit une chaîne (id_groupe, id_competition,etc...) automatiquement
        $fileds = '`' . implode('`=?, `', $kyes) . '`';
        $fileds .= '=?';
        $values = array_values($myinputs);
        try {
            // 3 : On prépare la requête, on se connecte à PDO
            $req = "UPDATE `groupe` SET $fileds
                    WHERE id_groupe=$id_groupe";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            // 4 : On éxécute la requête en envoyant directement 
            // les valeurs de $myinputs
            $res->execute($values);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function deleteGroupe($id_groupe) {
        try {
            $req = "DELETE FROM  `groupe`
                    WHERE id_groupe='$id_groupe'";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            $res->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

}
