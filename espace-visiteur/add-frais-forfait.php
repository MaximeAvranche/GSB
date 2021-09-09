<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=gsbv2', 'root', '');

$etape = $_POST['etape'];
$km = $_POST['km'];
$nuit = $_POST['nuit'];
$repas = $_POST['repas'];

$id = isset($_SESSION['id']);

$req = $db->prepare('INSERT INTO lignefraisforfait VALUES (:id_user, :mois, "ETP", :etp), (:id_user, :mois, "KM", :km), (:id_user, :mois, "NUI", :nuit), (:id_user, :mois, "REP", :rep)');
$req->execute(array(
	'id_user' => $id,
	'mois' => date('F'),
	'etp' => $etape,
	'km' => $km,
	'nuit' => $nuit,
	'rep' => $repas
));

header('Location: index.php');

?>