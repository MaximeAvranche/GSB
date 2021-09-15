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
      if ($resultat == NULL) {
        $creationFicheFrais = $this->bdd->prepare('INSERT INTO fichefrais VALUES(:id, :mois, 0, 0, now(), "CR")');
        $creationFicheFrais->execute(array(
          'id' => $id,
          'mois' => $mois
        ));           
        
        // On créé et initialise 4 Lignes Frais Forfait correspondant au mois
        $fraisEtp = $this->bdd->prepare('INSERT INTO lignefraisforfait VALUES(:idVisiteur, :mois, "ETP", 0)');
        $fraisEtp->execute(array(
        'idVisiteur' => $id,
        'mois' => $mois
        ));

        $fraisKm = $this->bdd->prepare('INSERT INTO lignefraisforfait VALUES(:idVisiteur, :mois, "KM", 0)');
        $fraisKm->execute(array(
        'idVisiteur' => $id,
        'mois' => $mois
        ));


        $fraisNui = $this->bdd->prepare('INSERT INTO lignefraisforfait VALUES(:idVisiteur, :mois, "NUI", 0)');
        $fraisNui->execute(array(
        'idVisiteur' => $id,
        'mois' => $mois
        ));


        $fraisRep = $this->bdd->prepare('INSERT INTO lignefraisforfait VALUES(:idVisiteur, :mois, "REP", 0)');
        $fraisRep->execute(array(
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

/**
*
** Delete les fiches manuellement avec compte Admin / Compta
* Ce qui donne : Créer compte comptable et y générer une interface avec possibilité de réinialiser toutes les données
*
**/
    // Insertion d'une ligne Frais Hors Forfait
  function insert_horsf($id, $mois, $libelle, $date, $montant) {
      $mois_actuel = date('F');
      if ($mois_actuel == $mois) {
      // Le mois étant différent, on créé une nouvelle ligne    
      $horsf = $this->bdd->prepare('INSERT INTO lignefraishorsforfait VALUES(0, :idVisiteur, :mois, :libelle, :date, :montant)');
      $horsf->execute(array(
        'idVisiteur' => $id,
        'mois' => date('F'),
        'libelle' => $libelle,
        'date' => $date,
        'montant' => $montant));
        // Test de fonctionnement, on affiche un message echo "<FONT size='35px' color=red>Insérée</FONT>";
        header("Location: add-frais-hf.php");
      }
    }

    // Vérification et création d'une ligne frais
 /** function ligneFrais() {
      if ($mois_actuel == $mois) {
          //DELETE TOUTE
      }
      else {

      }
  }**/

  function insert_forfait($id, $mois, $type, $qte) {
      $forfait = $this->bdd->prepare('UPDATE lignefraisforfait SET quantite = :quantite WHERE idVisiteur = :idVisiteur AND mois = :mois AND idFraisForfait = :idFraisForfait');
        $forfait->execute(array(
          'quantite' => $qte,
          'idVisiteur' => $id,
          'mois' => $mois,
          'idFraisForfait' => $type
        ));
        header("Location: add-frais-forfait.php");
  }
}

?>  