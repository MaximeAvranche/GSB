<?php
//acces au controller parent pour l heritage
namespace App\Controllers;
use CodeIgniter\Controller;
//=========================================================================================
//définition d'une classe Controleur (meme nom que votre fichier Controleur.php) 
//héritée de Controller et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================

class Controleur extends Controller {

//=====================================================================
//Fonction index correspondant au Controleur frontal (ou index.php) en MVC libre
//=====================================================================
public function index(){
	
	if(isset($_POST['libelle_HF'])){
		session_start();
		$modele = new \App\Models\Modele();
		$id = $_SESSION['id'];
		$mois = date('F');
		$resultat = $modele->chercheFicheVisiteur($id,$mois);
		if(sizeof($resultat) == 0){
			$modele->creationFicheFrais($id,$mois);
		}

		$resultat = $modele->horsFrais($id,$mois,$_POST['libelle_HF'],$_POST['date'],$_POST['montant']);
		echo view('vue_ajouterFraisForfait');
		$this->affichageFraisHF();
	}
	else if(isset($_POST['login'])){
		$resultat = $this->connect($_POST['login'], $_POST['password']);
	}
	else {
		$this->accueil();
	}
}


//======================================================
// Code du controleur simple (ex fichier Controleur.php)
//======================================================

public function accueil() {
	session_start();
	echo view('vue_connection');
}


public function connect($login,$mdp){
	$modele = new \App\Models\Modele();
	$resultat = $modele->mdpVerif($login);
	$message = ''; 
	if (!$resultat)
	{
		$message = 'erreur impossible';
	}
	else
	{
		if ($_POST['password'] == $resultat[0]->mdp) {
			$_SESSION['id'] = $resultat[0]->id;
			$_SESSION['login'] = $login;

			//echo view('vue_fichefrais');
			//$this->afficheFrais($_SESSION['id'],date('F'));
			echo view('vue_ajouterFraisForfait');
			$this->affichageFraisHF();
			

		}
		else {
			$message = "Mauvais identifiant ou mot de passe !";
		}
	}
	echo($message);

}
// Affiche une erreur
public function erreur($msgErreur) {
  echo view('vueErreur.php', $data);
}

public function affichageFraisHF(){
				  $modele = new \App\Models\Modele();
				  $mois_actuel = date('F');
                  $affichage = $modele->FraisHFMensuel($mois_actuel);
                  foreach($affichage as $donnees)
                    { 

											 echo "<br> date: ";
                                             print_r($donnees->date) ;
											 echo "<br> libelle: ";
                                             print_r($donnees->libelle) ;
											 echo "<br> montant: ";
                                             print_r($donnees->montant) ;
											 echo "€ <hr />";

                        }
                        
}

public function afficheFrais($id,$mois){
	$modele = new \App\Models\Modele();
	$resultat = $modele->chercheFicheVisiteur($id,$mois);
	if(sizeof($resultat) == 0){
		$modele->creationFicheFrais($id,$mois);
	}
	
	$modele->fraisCreate($id,$mois,"ETP");
	$modele->fraisCreate($id,$mois,"KM");
	$modele->fraisCreate($id,$mois,"NUI");
	$modele->fraisCreate($id,$mois,"REP");
	$modele->echo("test reussi!");



}
//==========================
//Fin du code du controleur simple
//===========================

//fin de la classe
}
?>