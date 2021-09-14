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

// Vérification de la fiche frais
function verifFicheFrais($id, $mois) {
    // On cherche la fiche frais du visiteur
    $verifFicheFrais = $this->bdd->prepare('SELECT * FROM fichefrais WHERE idVisiteur = :id AND mois = :mois');
    // Si la fiche n'existe pas, on la créée
    $verifFicheFrais->execute(array(
      'id' => $id,
      'mois' => $mois
    ));

    $resultat = $verifFicheFrais->fetch();

// Fiche n'existe pas
    if (sizeof($resultat) == 0) {
      $creationFicheFrais = $this->bdd->prepare('INSERT INTO fichefrais VALUES(:idVisiteur, :mois, 0, 0, now(), "CR")');
      $creationFicheFrais->execute(array(
        'idVisiteur' => $id,
        'mois' => $mois
      ));           
    }
    // Sinon, on actualise son état pour la mettre en "Fiche créée, saisie en cours"
    else if ($resultat['idEtat'] != "CR") {
      $updateFicheFrais = $this->bdd->prepare('UPDATE fichefrais SET idEtat  = "CR" WHERE idVisiteur = :idVisiteur AND mois = :mois');
      $updateFicheFrais->execute(array(
        'idVisiteur' => $id,
        'mois' => $mois
      ));
    }
  }


  // Insertion d'une ligne Frais Hors Forfait
function insert_horsf($id, $mois, $libelle, $date, $montant) {
    $mois_actuel = date('F');
    if ($mois_actuel != $mois) {
    // Le mois étant différent, on créé une nouvelle ligne    
    $horsf = $this->bdd->prepare('INSERT INTO lignefraishorsforfait VALUES(0, :idVisiteur, :mois, :libelle, :date, :montant)');
    $horsf->execute(array(
      'idVisiteur' => $id,
      'mois' => date('F'),
      'libelle' => $libelle,
      'date' => $date,
      'montant' => $montant));
      echo "<FONT size='555px'>Insérée</FONT>";
    }
  }

}

?>  