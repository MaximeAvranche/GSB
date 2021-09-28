<?php
//acces au Modele parent pour l heritage
namespace App\Models;
use CodeIgniter\Model;

//=========================================================================================
//définition d'une classe Modele (meme nom que votre fichier Modele.php) 
//héritée de Modele et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================
class Modele extends Model {

//==========================
// Code du modele
//==========================

//=========================================================================
// Fonction 1 (exemple)
// récupère les données BDD dans une fonction getBillets
// Renvoie la liste de tous les billets, triés par identifiant décroissant
//=========================================================================
public function getBillets() { 

//==========================================================================================
// Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
//==========================================================================================
	$db = db_connect();

//=============================
// rédaction de la requete sql
//=============================
    $sql = 'select BIL_ID, BIL_TITRE, BIL_DATE from T_BILLET order by BIL_ID desc';
	
//=============================
// execution de la requete sql
//=============================	
    $resultat = $db->query($sql);

//=============================
// récupération des données de la requete sql
//=============================
	$resultat = $resultat->getResult();

//=============================
// renvoi du résultat au Controleur
//=============================	
    return $resultat;
   
}


//=========================================================================
// mdpVerif
// vérifie si le login de l'utilisateur a le bon mot de passe
// Renvoie le détail d'un billet précédemment sélectionné par son id
//=========================================================================
public function mdpVerif($login) {
    $db = db_connect();	
	$sql = 'SELECT id, mdp FROM visiteur WHERE login =?';
    $resultat = $db->query($sql, [$login]);
	$resultat = $resultat->getResult();	
    return $resultat;
  
}




public function fraisCreate($id,$mois,$type) {
        $db = db_connect();	
        $sql = 'INSERT INTO lignefraisforfait VALUES(?, ?, ?, 0)';
        $resultat = $db->query($sql, [$id,$mois,$type]);
        $resultat = $resultat->getResult();	
        return $resultat;
      
    }

    public function ligneFraisForfait($id,$mois) {
            $db = db_connect();	
            $sql = 'SELECT * FROM LigneFraisForfait WHERE idVisiteur =? AND mois =?';
            $resultat = $db->query($sql, [$id,$mois]);
            $resultat = $resultat->getResult();	
            return $resultat;
          
        }

    public function chercheFicheVisiteur($id,$mois) {
            $db = db_connect();	
            $sql = 'SELECT * FROM fichefrais WHERE idVisiteur =? AND mois =? ';
            $resultat = $db->query($sql, [$id,$mois]);
            $resultat = $resultat->getResult();	
            return $resultat;
          
        }

    public function creationFicheFrais($id,$mois) {
            $db = db_connect();	
            $sql = 'INSERT INTO fichefrais VALUES(?, ?, 0, 0, now(), "CR")';
            $resultat = $db->query($sql, [$id,$mois]);
            $resultat = $resultat->getResult();
            return $resultat;
              
        }


    public function horsFrais($id, $mois, $libelle, $date, $montant) {
        $db = db_connect();	
        $sql = 'INSERT INTO lignefraishorsforfait VALUES(0, ?, ?, ?, ?, ?)';
        $resultat = $db->query($sql, [$id,$mois,$libelle,$date,$montant]);
        $resultat = $resultat->getResult();
        return $resultat;
      
        }
    public function fraisforfait($qte,$idVis, $mois, $idForf) {
            $db = db_connect();	
            $sql = 'UPDATE lignefraisforfait SET quantite =? WHERE idVisiteur =? AND mois =? AND idFraisForfait =?';
            $resultat = $db->query($sql, [$qte,$idVis, $mois, $idForf]);
            $resultat = $resultat->getResult();
            return $resultat;
          
        }
        public function updateFicheFrais($id,$mois) {
                $db = db_connect();	
                $sql = 'UPDATE fichefrais SET idEtat  = "CR" WHERE idVisiteur =? AND mois =?';
                $resultat = $db->query($sql, [$id,$mois]);
                $resultat = $resultat->getResult();
                return $resultat;
              
            }         
public function calculFrais($idVisiteur,$mois) {
            $db = db_connect();	
            $sql = 'SELECT COUNT(id) as totalFrais FROM lignefraishorsforfait WHERE idVisiteur =? AND mois =?';
            $resultat = $db->query($sql, [$idVisiteur,$mois]);
            $resultat = $resultat->getResult();	
            return $resultat;
          
        }
public function stmt($idVisiteur,$mois) {
            $db = db_connect();	
            $sql = 'SELECT SUM(montant) as total FROM lignefraishorsforfait WHERE idVisiteur =? AND mois =?';
            $resultat = $db->query($sql, [$idVisiteur,$mois]);
            $resultat = $resultat->getResult();	
            return $resultat;
          
        }
public function calculFraisSansMois($idVisiteur) {
            $db = db_connect();	
            $sql = 'SELECT COUNT(id) as totalFrais FROM lignefraishorsforfait WHERE idVisiteur = ?';
            $resultat = $db->query($sql, [$idVisiteur]);
            $resultat = $resultat->getResult();	
            return $resultat;
          
        }

        public function chercheVisiteurTest($nom) {
                $db = db_connect();	
                $sql = 'SELECT nom FROM visiteur WHERE nom =?';
                $resultat = $db->query($sql, [$nom]);
                $resultat = $resultat->getResult();	
                return $resultat;
              
            }
        public function FraisHFMensuel($mois){
	
                $db = db_connect();	
                $sql = 'SELECT * FROM lignefraishorsforfait WHERE mois =? ORDER BY date DESC';
                $resultat = $db->query($sql, [$mois]);
                $resultat = $resultat->getResult();
                return $resultat;
              
            }
}
?>