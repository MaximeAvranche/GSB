<?php
session_start();
include 'includes/connexion.php';
include 'includes/db.php';
if(!isset($_SESSION['id']))
{
  header('Location: http://localhost/gsb/acces/');
  exit();
}
else {
  $id = isset($_SESSION['id']);
  $req = $db->prepare('SELECT * FROM LigneFraisForfait WHERE idVisiteur = :id AND mois = :mois');
  $req->execute(array(
    'id' => $id,
    'mois' => date('F')
  ));

  $result = $req->fetchAll();

  foreach($result as $line){
    if($line['idFraisForfait'] == "ETP"){
      $etape = $line['quantite'];
    }
    elseif ($line['idFraisForfait'] == "KM") {
      $km = $line['quantite'];
    }
    elseif ($line['idFraisForfait'] == "NUI") {
      $nuit = $line['quantite'];
    }
    elseif ($line['idFraisForfait'] == "REP") {
      $repas = $line['quantite'];
    }
  }
    }

  include 'includes/variables.php';
  $page = 1;
  if (isset($_GET['s'])) {
   $succes = $_GET['s'];
  }
  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Espace client - Fiche frais</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<header>
	<img src="img/logo.png" class="petit" align="left">
  <h1><?php echo $prenom; echo " "; echo $nom; ?></h1>
  <h3>Visiteur</h3>
  <div align="right">
    Montant du mois : 
    <?php 
          $mois_actuel = date('F');
          $stmt = $db->prepare('SELECT SUM(montant) as total FROM lignefraishorsforfait WHERE idVisiteur = ? AND mois = ?');
          $stmt->execute(array($id, $mois_actuel));
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $sum = $row['total'];
          $total = $sum;

     if(isset($_POST['km'])){
          $ETP = 110 * $etape;
          $KLM = 1 * $km;
          $NUI = 80 * $nuit;
          $REP = 25 * $repas;
          $total += $ETP + $KLM + $NUI + $REP;
}
echo $total;
          ?>€</div>
</header>

<div style="overflow:auto">
  <?php include 'includes/header.php'; ?>
  <div class="main">
    <h2>Gestion fiches frais</h2>
    <?php 
    if (isset($succes) && $succes == "succes"){
      echo "<div class='succes'><h3> <i class='fa fa-check'></i> Votre fiche frais vient d'être créée.</h3></div>";
    }
      ?>
  	<center><a href="ajouter.php" class="link"><i class="fa fa-plus"></i> Ajouter une fiche frais</a></center>
  	<br />
    <table id="t01">
  <tr>
  	<th>Date</th>
    <th>Libellé</th>
    <th>Montant</th>
    <th>Action</th>
  </tr>
  <?php
                  $affichage = $db->prepare('SELECT * FROM lignefraishorsforfait WHERE mois = ? ORDER BY date DESC');
                  $affichage->execute(array($mois_actuel));
                  while ($donnees = $affichage->fetch())
                    { 
                    ?>
  <tr>
  	<td><?php echo $donnees['date']; ?></td>
    <td><?php echo $donnees['libelle']; ?></td>
    <td><?php echo $donnees['montant']; ?>€</td>
    <td class="centre"><a href="delete.php?id=<?php echo $donnees['id']; ?>" class="red"><i class="fa fa-trash-o"></i></a></td>
  </tr>  
  <?php
                        }
                        $affichage->closeCursor(); // Termine le traitement de la requête
                    ?>

</table>

<table id="t01">
   <tr>
    <th><?php echo date("Y-m-d"); ?></th>
    <th>Forfait étape</th>
    <th>Frais kilométriques</th> 
    <th>Nuitée hôtel</th>
    <th>Repas restaurant</th>


  </tr>
  <tr>
    <td></td>
    <td><?= (isset($etape)) ? $etape : '' ?></td>
    <td><?= (isset($km)) ? $km : '' ?></td>
    <td><?= (isset($nuit)) ? $nuit : '' ?></td>
    <td><?= (isset($repas)) ? $repas : '' ?></td>
  </tr>
</table>

  </div>

 
</div>


<footer> Copyright - GSB</footer>

</body>
</html>