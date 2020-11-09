<?php
session_start();
include "config.php";
if ($_SESSION['admin'] and $_SESSION['admin'] ==1)
{
    $reponse=$bdd->prepare('delete from commentaire where id=?');
    
    $reponse->execute(array($_GET['id_commentaire']));
    header('Location: article.php?id=' . $_GET['id']);
}
?>
