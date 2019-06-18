<?php

require_once 'connections/Connection.php';

class Competition {

    public function
    getLesCompetitions() {
        try {
            $req = "SELECT id_competition, nom_competition,lieu_competition,commentaire,img, 
                    DATE_FORMAT(date_competition, '%e %b %Y %H:%i')as date_competition, date_competition as datedesc,
                    DATE_FORMAT(date_fin_competition, '%e %b %Y %H:%i')as date_fin_competition, 
                    cout,YEAR(date_competition)AS anne 
                    FROM competition
                    ORDER BY datedesc DESC";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesCompetitions = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesCompetitions;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getCompetition($id_competition) {
        try {
            $req = "SELECT  id_competition, nom_competition,lieu_competition,commentaire,img, DATE(date_competition) AS date_competition, TIME(date_competition) AS time_competition,  DATE(date_fin_competition) AS date_fin_competition, TIME(date_fin_competition) AS time_fin_competition, cout 
                FROM competition 
                WHERE id_competition='$id_competition'";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lacompetition = $res->fetch(PDO::FETCH_OBJ);
            return $lacompetition;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function modifierCompetition($myinputs, $id_competition) {
        // 1 : On récupère les clés de $myinputs 
        // qui correspondent aux colonnes de la table competition
        $keys = array_keys($myinputs);
        // 2 : On construit une chaîne (id_competition, nom_competition,etc...)
        // automatiquement
        $fields = '`' . implode('`=?, `', $keys) . '`';
        $fields .= '=?';
        $values = array_values($myinputs);
        try {
            // 4 On prépare la requête, on se connecte à PDO
            $req = "UPDATE  `competition` SET $fields WHERE id_competition=$id_competition";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            // 5 On éxécute la requête en envoyant directement 
            // les valeurs de $myinputs
            $res->execute($values);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function ajouterCompetition($myinputs) {
        // 1 : On récupère les clés de $myinputs 
        // qui correspondent aux colonnes de la table competition
        $keys = array_keys($myinputs);
        // 2 : On construit une chaîne (id_competition, nom_competition,etc...)
        // automatiquement
        $fields = '`' . implode('`, `', $keys) . '`';

        // 3 on sécurise la requête, il faut mettre  des ?, 
        // autant de ? qu'il y a de colonne dans le tableau des colonnes, $keys
        $placeholder = substr(str_repeat('?,', count($keys)), 0, -1);
        $values = array_values($myinputs);
                    
        try {
            // 4 On prépare la requête, on se connecte à PDO
            $req = "INSERT INTO `competition`($fields) VALUES($placeholder)";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            // 5 On éxécute la requête en envoyant directement 
            // les valeurs de $myinputs
            $res->execute($values);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function deleteCompetition($id_competition) {
        try {
            $req = "DELETE FROM competition 
                    WHERE id_competition='$id_competition'";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            $res->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

}
