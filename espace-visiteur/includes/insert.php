<?php
/**
 * 
 */
class ConnexionBase
{
  
  function __construct()
  {
    $this->bdd = new PDO('mysql:host=localhost;dbname=gsbv2', 'root', '');
  }

// FicheFrais création
function fiche_frais($id, $date, $justificatifs, $montantV, $now, $etat) {

    if(isset($id) AND !empty($id) AND isset($date) AND !empty($date) AND isset($montantV) AND !empty($montantV))
    {
      
      $fiche_frais = $this->bdd->prepare('INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) VALUES(?, ?, ?, ?, ?, ?)');
      $fiche_frais->execute(array($id, $date, $justificatifs, $montantV, $now, $etat));
      header('Location: ../espace-visiteur/index.php?s=succes');
    }
    else
    {
      $message = "Un problème est survenu, veuillez réessayer.";
    }
}


// Insertion d'une ligne Frais Hors Forfait
function insert_horsf($idV, $libelle, $date, $montant) {
    $horsf = $this->bdd->prepare('INSERT INTO lignefraishorsforfait VALUES(0, :idVisiteur, :mois, :libelle, :date, :montant)');
    $horsf->execute(array(
      'idVisiteur' => $idV,
      'mois' => date('F'),
      'libelle' => $libelle,
      'date' => $date, 
      'montant' => $montant));
      header('Location: ../espace-visiteur/index.php?s=succes');
}


function  insert_lignefrais($idV, $etape, $km, $nuit, $repas) {
  $lignefraiskm = $this->bdd->prepare('INSERT INTO lignefraisforfait VALUES(0, :idVisiteur, :mois, :idFraisForfait, :quantite)');
  $lignefraiskm->execute(array(
    'idVisiteur' => $idV,
      'mois' => date('F'),
      'idFraisForfait' => "KM",
      'quantite' => $km));

$lignefraisetape = $this->bdd->prepare('INSERT INTO lignefraisforfait VALUES(0, :idVisiteur, :mois, :idFraisForfait, :quantite)');
  $lignefraisetape->execute(array(
    'idVisiteur' => $idV,
      'mois' => date('F'),
      'idFraisForfait' => "ETP",
      'quantite' => $etape));

  $lignefraisnuit = $this->bdd->prepare('INSERT INTO lignefraisforfait VALUES(0, :idVisiteur, :mois, :idFraisForfait, :quantite)');
  $lignefraisnuit->execute(array(
    'idVisiteur' => $idV,
      'mois' => date('F'),
      'idFraisForfait' => "NUI",
      'quantite' => $nuit));

  $lignefraisrepas = $this->bdd->prepare('INSERT INTO lignefraisforfait VALUES(0, :idVisiteur, :mois, :idFraisForfait, :quantite)');
  $lignefraisrepas->execute(array(
    'idVisiteur' => $idV,
      'mois' => date('F'),
      'idFraisForfait' => "REP",
      'quantite' => $repas));
      header('Location: ../espace-visiteur/index.php?s=succes');
}

}

?>  