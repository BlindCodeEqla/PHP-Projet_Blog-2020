<?php

session_start();
include "config.php";

$activation ="";

if ($_GET['actif'] == 1){
    $activation = 2;
} elseif (($_GET['actif'] == 2)) {
    $activation = 1;
}

if(isset($_SESSION['admin']) AND  $_SESSION['id'] == $_GET['id'] ) {
    $reponse = $bdd->prepare("UPDATE membre SET actif = ? WHERE id = ?");
    $reponse->execute(array(
        $activation,
        $_GET['id']
    ));

    $reponse->closeCursor();


    header("Location: profil.php?id=" . $_GET['id']);
}

