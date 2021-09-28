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
//Fonction index correspondant au Controleur frontal, il faut retourner a l'index pour appeler la plupart des fonction PHP
//=====================================================================
public function index(){
	//vérifie si le bouton "ajouter Hors Forfait" a été préssé
	/*if(isset($_POST['libelle_HF'])){
		session_start();
		$modele = new \App\Models\Modele();

		$userInfos = $modele->userInfos()[0];
		$data['prenom'] = $userInfos->prenom;
		print_r($data['prenom']);

		$mois = date('F');
		$resultat = $modele->chercheFicheVisiteur($id,$mois);
		if(sizeof($resultat) == 0){
			$modele->creationFicheFrais($id,$mois);
		}


		echo view('vue_ajouterFraisForfait', $data);
		$this->affichageFraisHF();
	}*/
	//vérifie si le bouton "connexion" a été préssé
	if(isset($_POST['formconnexion'])){
		$this->connect($_POST['login'], $_POST['password']);
	}

	else {
		$this->accueil();
	}
}


//======================================================
// mène a l'écran de connexion
//======================================================

public function accueil() {
	echo view('vue_connexion');
}

//a utilisé pour verifier si le mot de passe et l'identifiant sont correct
public function connect($login,$mdp){
	$modele = new \App\Models\Modele();
	$resultat = $modele->mdpVerif($login);
	$message = ''; 
		if ($mdp == $resultat[0]->mdp) {
			session_start();
			$_SESSION['id'] = $resultat[0]->id;
			$_SESSION['login'] = $login;
			$_SESSION['prenom'] = $resultat[0]->prenom;
			$_SESSION['nom'] = $resultat[0]->nom;

			// Redirection vers le tableau de bord
			echo view('vue_ajouterFraisForfait');
			//$this->affichageFraisHF();
		}

		else {
			$message = "Mauvais identifiant ou mot de passe !";
		}

	echo($message);

}



//affiche les frais HF du mois (n'affiche pas juste les frais de l'utilisateur mais les frais de TOUT LE MONDE, a changé plus tard)
public function affichageFraisHF(){
				  $modele = new \App\Models\Modele();

				  // Si l'utilisateur n'est pas connecté alors, on le redirige vers la page de connexion
				  if(!isset($_SESSION['id'])) {
				  		return redirect()->to(base_url('vue_connexion'));
				  }

				  $mois_actuel = date('F');
                  $affichage = $modele->FraisHFMensuel($mois_actuel);
                  /**foreach($affichage as $donnees)
                    { 

											 echo "<br> date: ";
                                             print_r($donnees->date) ;
											 echo "<br> libelle: ";
                                             print_r($donnees->libelle) ;
											 echo "<br> montant: ";
                                             print_r($donnees->montant) ;
											 echo "€ <hr />";

                        }**/
          if($_POST) {
          	if(isset($_POST['btn-deco'])) {
          		session_destroy();
          		return redirect()->to(base_url('vue_connexion'));
          	}
          }

}

//(en construction) affiche les frais du mois
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

// Affiche une erreur
public function erreur($msgErreur) {
	echo view('vueErreur.php', $data);
  }

  //==========================
//Fin du code du controleur simple
//===========================
//fin de la classe
}
?>