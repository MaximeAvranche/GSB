<?php
/**
 * Création d'une class qui permet la connexion à la base de données
 */
class ConnexionBase
{
  private $bdd;
  
  public function __construct()
  {
    // On récupère l'accès (nouvelle connexion)
    $this->bdd = new PDO('mysql:host=localhost;dbname=gsbv2;charset=utf8', 'root', '');
  }






// Insertion d'une ligne Frais Hors Forfait
function insert_horsf($id, $mois, $libelle, $date, $montant) {
    // Le mois étant différent, on créé une nouvelle ligne    
    $horsf = $this->bdd->prepare('INSERT INTO lignefraishorsforfait VALUES(0, :idVisiteur, :mois, :libelle, :date_hors, :montant)');
    $horsf->execute(array(
      'idVisiteur' => $id,
      'mois' => $mois,
      'libelle' => $libelle,
      'date_hors' => $date,
      'montant' => $montant
    ));
      $message = "bravo";

  }
  

  /**
  // Insertion d'une ligne Frais Hors Forfait
function insert_horsf($id, $libelle, $date, $montant) {
    if ($mois_actuel != $mois) {
    // Le mois étant différent, on créé une nouvelle ligne    
    $horsf = $this->bdd->prepare('INSERT INTO lignefraishorsforfait VALUES(0, :idVisiteur, :mois, :libelle, :date, :montant)');
    $horsf->execute(array(
      'idVisiteur' => $id,
      'mois' => date('F'),
      'libelle' => $libelle,
      'date' => date("d-m-Y"), 
      'montant' => $montant));
      header('Location: ../espace-visiteur/index.php?s=succes');
    }
    else {

    }
  }**/

}

?>  