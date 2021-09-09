<?php
session_start();
include 'includes/connexion.php';
if(!isset($_SESSION['id']))
{
  header('Location: http://localhost/gsb/acces/');
  exit();
}
else {
    $idV = $_SESSION['id'];
  include 'includes/variables.php';
  include 'includes/insert.php';
  $page = 2;
if(isset($_POST['ajouter']))
  {
    
    $libelle = $_POST['libelle'];
    $date = $_POST['date'];
    $montant = $_POST['montant'];
  insert_horsf($idV, $libelle, $date, $montant);
  }
if(isset($_POST['modifier']))
  {
    $etape = $_POST['etape'];
    $km = $_POST['km'];
    $nuit = $_POST['nuit'];
    $repas = $_POST['repas'];
  insert_lignefrais($idV, $etape, $km, $nuit, $repas);
  }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Espace client - Ajouter une fiche hors forfait</title>
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
</header>

<div style="overflow:auto">
  <?php include 'includes/header.php'; ?>

  <div class="main">
    <div class="container">
   <form action="" method="POST" autocomplete="off">
    <h2>Ajouter Hors Forfait</h2>
        <legend>Libelle</legend>
        <input type="text" class="form" name="libelle" placeholder="Ex : Fleuriste">

        <legend>Date</legend>
        <input type="date" class="form" name="date" placeholder="Date du frais">

        <legend>Montant</legend>
        <input type="number" class="form" min="0.0" max="5000.00" step="0.5" name="montant" placeholder="Ex : 500€">
 

     <center><button type="submit" name="ajouter">Ajouter</button></center>
   </form> 

   <form action="add-frais-forfait.php" method="POST" autocomplete="off">
    <h2>Ajouter des Frais</h2>
        <legend>Forfait étape</legend>
        <input type="number" class="form" name="etape" placeholder="0">

        <legend>Forfait kilométrique</legend>
        <input type="number" class="form" name="km" placeholder="0">
        
        <legend>Nuitées hotel</legend>
        <input type="number" class="form" name="nuit" placeholder="0">

        <legend>Repas </legend>
        <input type="number" class="form" name="repas" placeholder="0">


     <center><button type="submit" name="modifier">Ajouter</button></center>
   </form> 
 </div>
</div>
</div>
<footer> Copyright - GSB</footer>

</body>
</html>
