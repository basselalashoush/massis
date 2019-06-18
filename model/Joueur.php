<?php

require_once 'connections/Connection.php';
require_once 'Categorie.php';

class Joueur {
    
    public function getLesjoueur(): array {
        try {
            $req = "SELECT joueur.id_joueur,nr_ffe,adherent,nom,prenom,parent,adresse,code_postal, ville,tel,email,af,elo,type,rapide,mute, categorie.nom_categorie
               FROM joueur
               LEFT JOIN categorie ON ( categorie.id_categorie = joueur.id_categorie)";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesjoueur = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesjoueur;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
    /**
     * Undocumented function
     *
     * @return array
     */
    function trouver_nr_ffe(): array{
        try{
        $req = "SELECT `nr_ffe`
                FROM `Joueur`
                WHERE `nr_ffe` LIKE 'A%'";
                $pdo = Connection::getPDO();
                $res = $pdo->query($req);
                $nr_ffe = $res->fetchall(PDO::FETCH_ASSOC);
                return $nr_ffe;
            } catch (PDOException $ex) {
                echo $ex;
            }
        }
        // on récupére les jours de club massi et pas de l'exterieur 
    public function getLesjoueurDeMassis(): array {
        try {
            $req = "SELECT joueur.id_joueur,nr_ffe,adherent,nom,prenom,parent,adresse,code_postal, ville,tel,email,af,elo,type,rapide,mute, categorie.nom_categorie
               FROM joueur
               INNER JOIN categorie ON ( categorie.id_categorie = joueur.id_categorie)
               WHERE `adherent`='massis'";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesjoueur = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesjoueur;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function lesjoueurParCompetition($id_competition): array {
        try {
            $req = "SELECT joueur.`id_joueur`, `nr_ffe`, `adherent`, `nom`, `prenom`, `parent`, `adresse`, `code_postal`, `ville`, `tel`, `email`, 
               `af`, `elo`, `type`, `rapide`, `mute`,liste_attente.`id_competition`,categorie.nom_categorie
                FROM `joueur` 
                INNER JOIN liste_attente ON (liste_attente.id_joueur = joueur.id_joueur )
                INNER JOIN categorie ON (categorie.id_categorie=joueur.id_categorie)
                INNER JOIN competition ON(liste_attente.id_competition= competition.id_competition ) AND competition.id_competition=$id_competition AND liste_attente.etat ='confirmée' ";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesjoueur = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesjoueur;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getLesjoueurCategories($id_categorie): array {
        try {
            $req = "SELECT joueur.`id_joueur`, `nr_ffe`, `adherent`, `nom`, `prenom`, `parent`, `adresse`, `code_postal`, `ville`, `tel`, `email`, 
               `af`, `elo`, `type`, `rapide`, `mute`,categorie.nom_categorie
                FROM `joueur` 
                INNER JOIN categorie ON (categorie.id_categorie=joueur.id_categorie)
                WHERE categorie.id_categorie=$id_categorie";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesjoueur = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesjoueur;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getLesjoueurParGroupe($id_groupe): array {
        try {
            $req = "SELECT joueur.`id_joueur`, `nr_ffe`, `adherent`, `nom`, `prenom`, `parent`, `adresse`, `code_postal`, `ville`, `tel`, `email`, `af`, `elo`, `type`, `rapide`, `mute`, `username`, `password`, categorie.nom_categorie
                FROM `joueur`
                INNER JOIN joueur_groupe ON (joueur_groupe.id_joueur = joueur.id_joueur AND joueur_groupe.id_groupe = $id_groupe )
                LEFT JOIN categorie ON ( categorie.id_categorie = joueur.id_categorie)";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesjoueur = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesjoueur;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function ajouterJoueur($myinputs) {
        // 1 : On récupère les clés de $myinputs 
        // qui correspondent aux colonnes de la table joueur
        $keys = array_keys($myinputs); 
        // 2 : On construit une chaîne (id_joueur, adhétent, id_categorie,etc...)
        // automatiquement
        $fields = '`'.implode('`, `',$keys).'`';
        // 3 on sécurise la requête, il faut mettre  des ?, 
        // autant de ? qu'il y a de colonne dans le tableau des colonnes, $keys
        $placeholder = substr(str_repeat('?,',count($keys)),0,-1);        
        $values = array_values($myinputs);       
        try {
            // 4 On prépare la requête, on se connecte à PDO
            $req = "INSERT INTO `joueur`($fields) VALUES($placeholder)";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            // 5 On éxécute la requête en envoyant directement 
            // les valeurs de $myinputs
            $res->execute($values);
        } catch (PDOException $ex) {
            if($ex->getCode()=="23000"){ ?>
                <div class="alert alert-danger">
                    <?= "Erreur !! l'ajout de joueur a échoué, Ce numéro  NRFFE existe déjà"; ?>
                    <p><a href="index.php?uc=joueur&action=listejoueur">Liste Joueurs</a></p>
                 </div>
                 <?php
            }else{
               echo $ex; 
            }
        }
    }

    public function modifierJoueur($myinputs,$id_joueur) {
        // 1 : On récupère les clés de $myinputs 
        // qui correspondent aux colonnes de la table joueur
        $keys = array_keys($myinputs); 
        // 2 : On construit une chaîne (id_joueur, adhétent, id_categorie,etc...)
        // automatiquement
        $fields = '`'.implode('`=?, `',$keys).'`';
        $fields .= '=?';      
        $values = array_values($myinputs);       
        try {
            // 3 : On prépare la requête, on se connecte à PDO
            $req = "UPDATE  `joueur` SET $fields WHERE id_joueur=$id_joueur";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            // 4 On éxécute la requête en envoyant directement 
            // les valeurs de $myinputs
            $res->execute($values);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
   
    public function getCategorie() {
        try {
            $categorie = new Categorie();
            return $categorie->getLesCategories();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getjoueur($id_joueur) {
        try {
            $req = "SELECT joueur.`id_joueur`, `nr_ffe`, `adherent`, `nom`, `prenom`, `parent`, `adresse`, `code_postal`, `ville`, `tel`, `email`, `af`, `elo`, `type`, `rapide`, `mute`, `username`, `password`, categorie.nom_categorie
                FROM `joueur`
                LEFT JOIN categorie ON ( categorie.id_categorie = joueur.id_categorie)
                WHERE joueur.id_joueur=$id_joueur";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesjoueur = $res->fetchALL(PDO::FETCH_OBJ);
            return $lesjoueur;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getLeJoueur($id_joueur) {
        try {
            $req = "SELECT joueur.`id_joueur`, `nr_ffe`, `adherent`, `nom`, `prenom`, `parent`, `adresse`, `code_postal`, `ville`, `tel`, `email`, `af`, `elo`, `type`, `rapide`, `mute`,`id_categorie`, `username`, `password`
        FROM `joueur`
        WHERE id_joueur= '$id_joueur'";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lejoueur = $res->fetch(PDO::FETCH_OBJ);
            return $lejoueur;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function deleteJoueur($id_joueur) {
        try {
            $req = "DELETE FROM joueur WHERE id_joueur='$id_joueur'";
            $pdo = Connection::getPDO();
            $res = $pdo->prepare($req);
            $res->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function lesGroupeDeJoueur($id_joueur) {
        try {
            $req = "SELECT joueur.nom,joueur.prenom, joueur_groupe.id_groupe,joueur_groupe.id_joueur,groupe.id_competition,nom_groupe,competition.nom_competition  from joueur
            INNER JOIN joueur_groupe ON (joueur_groupe.id_joueur = joueur.id_joueur)
            INNER JOIN groupe ON (joueur_groupe.id_groupe = groupe.id_groupe)
            INNER JOIN competition ON(groupe.id_competition = competition.id_competition)
            WHERE joueur.id_joueur=$id_joueur";
            $pdo = Connection::getPDO();
            $res = $pdo->query($req);
            $lesGroupes = $res->fetchAll(PDO::FETCH_OBJ);
            return $lesGroupes;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

}
