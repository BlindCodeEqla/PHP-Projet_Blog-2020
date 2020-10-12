<! DOCTYPE html>
<html>

<head>
    <meta charset=""utf-8"/>
    <title>Espace membre</title>
</head>

<body>
<h2>Connexion</h2>

<form action="connexion.php" method="post">

    <label for="mail">Mail</label>:
    <input type="email" name="mailconnect" id="mail" /><br/>
    <label for="mdp">Mot de passe</label>:
    <input type="password" name="mdpconnect" id="mdp" /><br/>



    <input type="submit" class="btn btn-success" name="connexion" value="Se connecter"/>
    </br>
</form>
<a type="button" href="index.php"> Retourner à la liste des articles </a>



<?php
session_start(); // commencer une session en début de code php (obligatoire pour récupérer les varaibles de session sur chaque page)

include "config.php";

if (isset($_POST['connexion'])){


    if (!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect'])){
//        echo '<br>ok';

        $requser = $bdd->prepare("SELECT * FROM membre WHERE mail = ? AND mot_passe = ? ");
        $requser->execute(array(
            $_POST['mailconnect'],
            $_POST['mdpconnect']
            ));
        $userexist = $requser->rowCount(); // va compter le nombre de lignes qui existent pour la requête demandée

        if ($userexist == 1){

            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: profil.php?id=".$_SESSION['id']); // pour rediriger vers la page profil de la personne


        } else {
            echo "<br><br>Mauvais identifiants ou le compte n'existe pas.";
        }

    }
    else{
        echo "<br><br>Tous les champs doivent être remplis";
    }

}



?>




</body>


