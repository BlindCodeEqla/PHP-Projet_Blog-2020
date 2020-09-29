<! DOCTYPE html>
<html>

<head>
    <meta charset=""utf-8"/>
    <title>Espace membre</title>
</head>

<body>
<h2>Inscription</h2>

<form action="inscription.php" method="post">

    <label for="titre">Pseudo</label>:
    <input type="text" name="pseudo" id="pseudo" /><br/>
    <label for="mail">Mail</label>:
    <input type="email" name="mail" id="mail" /><br/>
    <label for="mdp">Mot de passe</label>:
    <input type="password" name="mdp" id="mdp" /><br/>
    <label for="mdp2">Confirmez le Mot de passe</label>:
    <input type="password" name="mdp2" id="mdp2" /><br/>


    <input type="submit" class="btn btn-success" name="inscription" value="S'inscrire"/>
    </br>
</form>
<a type="button" href="index.php"> Retourner à la liste des articles </a>



<?php

include "config.php";

if (isset($_POST['inscription'])){

    if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){
        echo '<br>ok';
    }

}



?>


</body>

