<?php
session_start();
include "config.php";


if($_SESSION['admin'] AND $_SESSION['admin'] == 1) {
    $reponse = $bdd->prepare("DELETE FROM commentaire WHERE fk_commentaire = ?");
    $reponse->execute(array(
        $_GET['id_commentaire']
    ));

    $reponse->closeCursor();

    $reponse = $bdd->prepare("DELETE FROM commentaire WHERE id = ?");
    $reponse->execute(array(
        $_GET['id_commentaire']
    ));

    $reponse->closeCursor();


    header("Location: commentaires.php?id=" . $_GET['id']);
}





