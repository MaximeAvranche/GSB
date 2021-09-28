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
// Fonction 1
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
// Fonction 2 
// récupère les données BDD dans une fonction getDetails
// Renvoie le détail d'un billet précédemment sélectionné par son id
//=========================================================================
public function mdpVerif($login) {
	
//==========================================================================================
// Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
//==========================================================================================
    $db = db_connect();	
	
//=====================================
// rédaction de la requete sql préparée 'SELECT id, mdp FROM visiteur WHERE login = :login'
//=====================================
	$sql = 'SELECT id, mdp FROM visiteur WHERE login =?';
	
//=====================================================
// execution de la requete sql en passant un parametre id
//=====================================================	
    $resultat = $db->query($sql, [$login]);
	
//=============================
// récupération des données de la requete sql
//=============================
	$resultat = $resultat->getResult();
//=============================
// renvoi du résultat au Controleur
//=============================		
    return $resultat;
  
}
//==========================
// Fin Code du modele
//===========================


//fin de la classe


public function fraisCreate($id,$mois,$type) {
	
    //==========================================================================================
    // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
    //==========================================================================================
        $db = db_connect();	
        
    //=====================================
    // rédaction de la requete sql préparée 'INSERT INTO lignefraisforfait VALUES(:idVisiteur, :mois, "ETP", 0)'
    //=====================================
        $sql = 'INSERT INTO lignefraisforfait VALUES(?, ?, ?, 0)';
        
    //=====================================================
    // execution de la requete sql en passant un parametre id
    //=====================================================	
        $resultat = $db->query($sql, [$id,$mois,$type]);
        
    //=============================
    // récupération des données de la requete sql
    //=============================
        $resultat = $resultat->getResult();
    
    //=============================
    // renvoi du résultat au Controleur
    //=============================		
        return $resultat;
      
    }

    public function ligneFraisForfait($id,$mois) {
	
        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
            $db = db_connect();	
            
        //=====================================
        // rédaction de la requete sql préparée 'SELECT * FROM LigneFraisForfait WHERE idVisiteur = :id AND mois = :mois'
        //=====================================
            $sql = 'SELECT * FROM LigneFraisForfait WHERE idVisiteur =? AND mois =?';
            
        //=====================================================
        // execution de la requete sql en passant un parametre id
        //=====================================================	
            $resultat = $db->query($sql, [$id,$mois]);
            
        //=============================
        // récupération des données de la requete sql
        //=============================
            $resultat = $resultat->getResult();
        
        //=============================
        // renvoi du résultat au Controleur
        //=============================		
            return $resultat;
          
        }

    public function chercheFicheVisiteur($id,$mois) {
	
        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
            $db = db_connect();	
            
        //=====================================
        // rédaction de la requete sql préparée 
        //=====================================
            $sql = 'SELECT * FROM fichefrais WHERE idVisiteur =? AND mois =? ';
            
        //=====================================================
        // execution de la requete sql en passant un parametre id
        //=====================================================	
            $resultat = $db->query($sql, [$id,$mois]);
            
        //=============================
        // récupération des données de la requete sql
        //=============================
            $resultat = $resultat->getResult();
        
        //=============================
        // renvoi du résultat au Controleur
        //=============================		
            return $resultat;
          
        }

        public function creationFicheFrais($id,$mois) {
	
            //==========================================================================================
            // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
            //==========================================================================================
                $db = db_connect();	
                
            //=====================================
            // rédaction de la requete sql préparée
            //=====================================
                $sql = 'INSERT INTO fichefrais VALUES(?, ?, 0, 0, now(), "CR")';
                
            //=====================================================
            // execution de la requete sql en passant un parametre id
            //=====================================================	
                $resultat = $db->query($sql, [$id,$mois]);
                
            //=============================
            // récupération des données de la requete sql
            //=============================
                $resultat = $resultat->getResult();
            
            //=============================
            // renvoi du résultat au Controleur 
            //=============================		
                return $resultat;
              
            }


    public function horsFrais($id, $mois, $libelle, $date, $montant) {
	
    //==========================================================================================
    // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
    //==========================================================================================
        $db = db_connect();	
        
    //=====================================
    // rédaction de la requete sql préparée  
    //=====================================
        $sql = 'INSERT INTO lignefraishorsforfait VALUES(0, ?, ?, ?, ?, ?)';
        
    //=====================================================
    // execution de la requete sql en passant un parametre id
    //=====================================================	
        $resultat = $db->query($sql, [$id,$mois,$libelle,$date,$montant]);
        
    //=============================
    // récupération des données de la requete sql
    //=============================
        $resultat = $resultat->getResult();
    
    //=============================
    // renvoi du résultat au Controleur 
    //=============================		
        return $resultat;
      
    }
    public function fraisforfait($qte,$idVis, $mois, $idForf) {
	
        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
            $db = db_connect();	
            
        //=====================================
        // rédaction de la requete sql préparée  
        //=====================================
            $sql = 'UPDATE lignefraisforfait SET quantite =? WHERE idVisiteur =? AND mois =? AND idFraisForfait =?';
            
        //=====================================================
        // execution de la requete sql en passant un parametre id
        //=====================================================	
            $resultat = $db->query($sql, [$qte,$idVis, $mois, $idForf]);
            
        //=============================
        // récupération des données de la requete sql
        //=============================
            $resultat = $resultat->getResult();
        
        //=============================
        // renvoi du résultat au Controleur 
        //=============================		
            return $resultat;
          
        }
        public function updateFicheFrais($id,$mois) {
	
            //==========================================================================================
            // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
            //==========================================================================================
                $db = db_connect();	
                
            //=====================================
            // rédaction de la requete sql préparée 
            //=====================================
                $sql = 'UPDATE fichefrais SET idEtat  = "CR" WHERE idVisiteur =? AND mois =?';
                
            //=====================================================
            // execution de la requete sql en passant un parametre id
            //=====================================================	
                $resultat = $db->query($sql, [$id,$mois]);
                
            //=============================
            // récupération des données de la requete sql
            //=============================
                $resultat = $resultat->getResult();
            
            //=============================
            // renvoi du résultat au Controleur 
            //=============================		
                return $resultat;
              
            }         
public function calculFrais($idVisiteur,$mois) {
	
        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
            $db = db_connect();	
            
        //=====================================
        // rédaction de la requete sql préparée
        //=====================================
            $sql = 'SELECT COUNT(id) as totalFrais FROM lignefraishorsforfait WHERE idVisiteur =? AND mois =?';
            
        //=====================================================
        // execution de la requete sql en passant un parametre id
        //=====================================================	
            $resultat = $db->query($sql, [$idVisiteur,$mois]);
            
        //=============================
        // récupération des données de la requete sql
        //=============================
            $resultat = $resultat->getResult();
        
        //=============================
        // renvoi du résultat au Controleur 
        //=============================		
            return $resultat;
          
        }
public function stmt($idVisiteur,$mois) {
	
        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
            $db = db_connect();	
            
        //=====================================
        // rédaction de la requete sql préparée  
        //=====================================
            $sql = 'SELECT SUM(montant) as total FROM lignefraishorsforfait WHERE idVisiteur =? AND mois =?';
            
        //=====================================================
        // execution de la requete sql en passant un parametre id
        //=====================================================	
            $resultat = $db->query($sql, [$idVisiteur,$mois]);
            
        //=============================
        // récupération des données de la requete sql
        //=============================
            $resultat = $resultat->getResult();
        
        //=============================
        // renvoi du résultat au Controleur 
        //=============================		
            return $resultat;
          
        }
public function calculFraisSansMois($idVisiteur) {
	
        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
            $db = db_connect();	
            
        //=====================================
        // rédaction de la requete sql préparée  
        //=====================================
            $sql = 'SELECT COUNT(id) as totalFrais FROM lignefraishorsforfait WHERE idVisiteur = ?';
            
        //=====================================================
        // execution de la requete sql en passant un parametre id
        //=====================================================	
            $resultat = $db->query($sql, [$idVisiteur]);
            
        //=============================
        // récupération des données de la requete sql
        //=============================
            $resultat = $resultat->getResult();
        
        //=============================
        // renvoi du résultat au Controleur 
        //=============================		
            return $resultat;
          
        }

        public function chercheVisiteurTest($nom) {
	
            //==========================================================================================
            // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
            //==========================================================================================
                $db = db_connect();	
                
            //=====================================
            // rédaction de la requete sql préparée  
            //=====================================
                $sql = 'SELECT nom FROM visiteur WHERE nom =?';
                
            //=====================================================
            // execution de la requete sql en passant un parametre id
            //=====================================================	
                $resultat = $db->query($sql, [$nom]);
                
            //=============================
            // récupération des données de la requete sql
            //=============================
                $resultat = $resultat->getResult();
            
            //=============================
            // renvoi du résultat au Controleur 
            //=============================		
                return $resultat;
              
            }
        public function FraisHFMensuel($mois){
	
            //==========================================================================================
            // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
            //==========================================================================================
                $db = db_connect();	
                
            //=====================================
            // rédaction de la requete sql préparée  
            //=====================================
                $sql = 'SELECT * FROM lignefraishorsforfait WHERE mois =? ORDER BY date DESC';
                
            //=====================================================
            // execution de la requete sql en passant un parametre id
            //=====================================================	
                $resultat = $db->query($sql, [$mois]);
                
            //=============================
            // récupération des données de la requete sql
            //=============================
                $resultat = $resultat->getResult();
            
            //=============================
            // renvoi du résultat au Controleur 
            //=============================		
                return $resultat;
              
            }
}
?>