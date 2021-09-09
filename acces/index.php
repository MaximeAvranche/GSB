<?php
session_start();
include 'includes/connexion.php';
include 'includes/db.php';
if(isset($_SESSION['login'])) {
    header('Location: http://localhost/gsb/espace-visiteur/ajouter.php');
}
if (isset($_POST['formconnexion'])) {
    connect($_POST['login'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/alert.css">
</head>
<body>
    <?php include 'includes/form_connexion.php'; ?>
<div class="wrapper">
    <img src="img/logo.png">

    <section class="login-container">
        <div>
            <header>
                <h2>Identification</h2>
                <?php

      if(isset($erreur))
      {
        echo '
        <div class="alert text-white bg-danger" role="alert">
                              <div class="iq-alert-text">
                              <FONT size="2px">'.$erreur.'</FONT>
                              </div>
                           </div>';
      }
      if(isset($validation))
      {
        echo '<font size="2px" color="green">'.$validation.'</font>';
      }
      ?> 



            </header>

            <form action="" method="post">
                <?php echo $message; ?>
                <input type="text" name="login" placeholder="Merci de saisir votre identiant visiteur" required="">
                <input type="password" name="password" placeholder="Veuillez saisir votre mot de passe" required="">
				<button type="submit" name="formconnexion">Connexion</button>
            </form>
        </div>
    </section>

</div>




</body>
</html>