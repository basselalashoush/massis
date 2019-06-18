<?php

require_once 'connections/Connection.php';
require_once 'Groupe.php';
require_once 'Joueur.php';

class Joueur_groupe {

   

    /**
     * Ajouter un joueur dans un groupe,
     * via la table joueur_groupe
     * @param int $id_joueur
     * @param int $id_groupe
     * @return void
     */
    public function AjouterJoueurGroupes(int $id_joueur, int $id_groupe): void {
        try {
            $req = "INSERT INTO joueur_groupe (id_joueur,id_groupe) VALUES (?,?)";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            $res->execute(array($id_joueur,$id_groupe));
        } catch (PDOException $ex) {
           if($ex->getCode()=="23000"){
                echo "Erreur !! l'ajout de joueur a échoué,Merci de sélectionner un Groupe et un Joueur  au bien  verifier que  Ce numéro  NRFFE n'existe pas dans le même Groupe ";
        }else{
            echo $ex;
        }
        }
    }

    /**delete joueur from groupe
     * via la table joueur_groupe
     * @param int $id_joueur
     * @param int $id_groupe
     * @return void
     */
    public function deleteJoueurFromGroupe($id_joueur, $id_groupe):void {
         try {
            $req ="DELETE FROM `joueur_groupe` 
                   WHERE id_joueur= $id_joueur
                   AND id_groupe = $id_groupe";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            $res->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
    
    public function getGroupes() {
        try {
            $groupe = new Groupe();
            return $groupe->getLesGroupes();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
    
    public function getjoueur($id_joueur) {
        try {
            $joueur = new Joueur();
            return $joueur->getLeJoueur($id_joueur);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getGroupe($id_groupe) {
        try {
            $groupe = new Groupe();
            return $groupe->getGroupe($id_groupe);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
