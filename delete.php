<?php
include('includes/db.php');
    if(isset($_GET['id'])){
      $del = $db->prepare('DELETE FROM lignefraishorsforfait WHERE id = ?');
      $del->execute(array($_GET['id']));
      header('Location: index.php');
    }
    else
    {
      header('Location: index.php');
    }

?>