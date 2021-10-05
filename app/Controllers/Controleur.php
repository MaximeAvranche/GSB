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

session_start();

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
	

		// On appelle la fonction pour afficher le calcul des frais dans le mois courant
		//$resFrais = $modele->clcFrais($_SESSION['id'], $mois_actuel);
		//$data['clcFraisMois'] = $resFrais;

	// Redirection vers les différentes pages du site
	if(isset($_GET['action'])) {
		// Redirection vers "mes fiches"
		if ($_GET['action'] == "afficherFF") {
			$this->goAFF();
		}
		// Redirection vers "frais forfait"
		if ($_GET['action'] == "fraisF") {
			$this->goFF();
		}
		// Redirection vers "frais hors forfait"
		if ($_GET['action'] == "fraisHF") {
			$this->goHF();
		}

		if ($_GET['action'] == "deco") {
			$this->formconnect();
		}
	}



	// Le visiteur valide le formulaire de connexion
	else if (isset($_POST['formconnexion'])) {
		// On appelle la fonction qui permet de vérifier si les informations sont valides
		$this->connect($_POST['login'], $_POST['password']);
	}

	else if (isset($_POST['ajouter'])) {
		$this->addHF();
	}

	else if (isset($_POST['modifier'])) {
		$this->majFF();
	}
	// Par défaut, l'utilisateur est redirigé vers le formulaire de connexion
	// Si rien n'est saisi, il est redirigé vers la vue connexion
	else {
			$this->formconnect();
		}

}

	// Vue Mes frais (voir tous les frais saisis depuis le début de l'année)
	public function goAFF() {
		$modele = new \App\Models\Modele();
		$mois_actuel = date('F');
    $modele->FraisHFMensuel($mois_actuel);
	}

	// Vue Frais Forfait (ajouter des frais forfait)
	public function goFF() {
		$modele = new \App\Models\Modele();
		$mois_actuel = date('F');
    $modele->FraisHFMensuel($mois_actuel);
   
		echo view('vue_addFrais');
	}

	// Vue Frais Hors Forfait (ajouter des frais hors forfait)
	public function goHF() {
		$modele = new \App\Models\Modele();
		$mois_actuel = date('F');
    $modele->FraisHFMensuel($mois_actuel);

    echo view('vue_addHF');

	}

	public function addHF() {
		$modele = new \App\Models\Modele();
		$modele->addHF($_SESSION['id'], date('F'), $_POST['libelle'], $_POST['date'], $_POST['montant']);

		$resultat = $modele->clcFrais($_SESSION['id'], date('F'));
		$data['fraisMois'] = $resultat[0]->totalFrais;

			// Redirection vers le tableau de bord
      echo view('vue_Accueil', $data);
	}

	public function majFF() {
		$modele = new \App\Models\Modele();
		$modele->fraisforfait($_POST['qte'], $_SESSION['id'], date('F'), $_POST['type']);
		$resultatETP = $modele->recupFF("ETP");
		$resultatKM = $modele->recupFF("KM");
		$resultatNUI = $modele->recupFF("NUI");
		$resultatREP = $modele->recupFF("REP");


		//echo view('vue_addFrais');
	}


	// Vue affichant le formulaire de connexion
	public function formconnect() {
		echo view('vue_connexion.php');
	}

//a utilisé pour verifier si le mot de passe et l'identifiant sont correct
public function connect($login,$mdp){
	$modele = new \App\Models\Modele();
	$resultat = $modele->mdpVerif($login);
	$message = ''; 
		if ($mdp == $resultat[0]->mdp) {
			$_SESSION['id'] = $resultat[0]->id;
			$_SESSION['login'] = $login;
			$_SESSION['prenom'] = $resultat[0]->prenom;
			$_SESSION['nom'] = $resultat[0]->nom;

			$resultat = $modele->chercheFicheVisiteur($_SESSION['id'], date('F'));

			if (!isset($resultat[0])) {
				$modele->initialiseFicheFrais();
			}

		$resultat = $modele->clcFrais($_SESSION['id'], date('F'));
		$data['fraisMois'] = $resultat[0]->totalFrais;

			// Redirection vers le tableau de bord
      echo view('vue_Accueil', $data);
			//$this->affichageFraisHF();
		}

		else {
			$message = "Mauvais identifiant ou mot de passe !";
			echo($message);
			echo view('vue_connexion');
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