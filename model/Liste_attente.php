<?php

require_once 'connections/Connection.php';

class Liste_attente {

    public function getLesListe_attentes() {
        try {
            $req = "SELECT liste_attente.id_joueur ,liste_attente.id_competition ,date_inscription,etat, competition.nom_competition,joueur.nom,prenom,nr_ffe
                FROM liste_attente
                LEFT JOIN competition ON (liste_attente.id_competition = competition.id_competition)
                LEFT JOIN joueur ON (liste_attente.id_joueur = joueur.id_joueur)";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $listeAttente = $res->fetchAll(PDO::FETCH_OBJ);
            return $listeAttente;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getListe_attente($id_joueur, $id_competition) {
        try {
            $req = "SELECT liste_attente.date_inscription,etat, competition.nom_competition,joueur.nom,prenom,nr_ffe
                FROM liste_attente
                LEFT JOIN competition ON (liste_attente.id_competition = competition.id_competition)
                LEFT JOIN joueur ON (liste_attente.id_joueur = joueur.id_joueur)
                WHERE id_joueur='$id_joueur' AND id_competition='$id_competition'";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $listeAttente = $res->fetchAll(PDO::FETCH_OBJ);
            return $listeAttente;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function ajouterParticipant($myinputs) {
        try {
            $req = "INSERT INTO liste_attente (id_joueur,id_competition,etat,date_inscription)
                    VALUES('" . $myinputs['id_joueur'] . "','" . $myinputs['id_competition'] . "','attente',NOW())";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            $res->execute();
        } catch (PDOException $ex) {
            if($ex->getCode()=="23000"){
                echo "Erreur !! l'ajout de joueur a échoué,Merci de sélectionner une Competition et un Joueur  au bien  verifier que  Ce numéro  NRFFE n'existe pas dans la même Competition ";
        }else{
            echo $ex;
        }
     }
    }

    public function confirmer($id_joueur, $id_competition) {
        try {
            $req = "UPDATE liste_attente SET etat = 'confirmee' 
                Where id_joueur='$id_joueur' AND id_competition = '$id_competition'";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            $res->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function deleteParticipant($id_joueur, $id_competition) {
        try {
            $req = "DELETE FROM liste_attente
                WHERE id_joueur=$id_joueur AND id_competition=$id_competition";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            $res->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

}
