<?php
session_start();
include "config.php";
if ($_SESSION['admin'] and $_SESSION['admin']==1)
{
    $reponse=$bdd->prepare('delete from commentaire where fk_commentaire=?');
    $reponse->execute(array($_GET['id_commentaire']));
    $reponse->closeCursor();
    $reponse=$bdd->prepare('delete from commentaire where id=?');
    $reponse->execute(array($_GET['id_commentaire']));
    $reponse->closeCursor();
    
    header('Location: article.php?id=' . $_GET['id']);
}
?>
