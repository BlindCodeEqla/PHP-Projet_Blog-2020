<! DOCTYPE html>
<html>

<head>
    <meta charset=""utf-8"/>
    <title>Espace membre</title>
</head>

<body>
<h2>Inscription</h2>

<form action="inscription.php" method="post">

    <label for="pseudo">Pseudo</label>:
    <input type="text" name="pseudo" id="pseudo" value="<?php if (!empty($_POST['pseudo'])){ echo $_POST['pseudo'];} ?>"/><br/>
    <label for="mail">Mail</label>:
    <input type="email" name="mail" id="mail" value="<?php if (!empty($_POST['mail'])){ echo $_POST['mail'];} ?>" /><br/>
    <label for="mdp">Mot de passe</label>:
    <input type="password" name="mdp" id="mdp" value="<?php if (!empty($_POST['mdp'])){ echo $_POST['mdp'];} ?>" /><br/>
    <label for="mdp2">Confirmez le Mot de passe</label>:
    <input type="password" name="mdp2" id="mdp2" value="<?php if (!empty($_POST['mdp2'])){ echo $_POST['mdp2'];} ?>" /><br/>


    <input type="submit" class="btn btn-success" name="inscription" value="S'inscrire"/>
    </br>
</form>
<a type="button" href="index.php"> Retourner à la liste des articles </a>



<?php

include "config.php";

if (isset($_POST['inscription'])){


    if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){
//        echo '<br>ok';

        $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
        $reqmail->execute(array($_POST['mail']));
        $mailexist = $reqmail->rowCount(); // va compter le nombre de lignes qui existent pour la requête demandée

        if ($mailexist == 0){

        if ($_POST['mdp'] == $_POST['mdp2']){

            try

            {
                $reponse = $bdd->prepare('INSERT INTO membre(pseudo,mail, mot_passe) VALUES (?, ?, ?)');
                $reponse->execute(array(
                    $_POST['pseudo'],
                    $_POST['mail'],
                    $_POST['mdp']
                ));
                echo "<p>Vous êtes bien inscrit</p><br><br>";
                header('Location:index.php');

            }
            catch (Exception $error)
            {
                echo $error->getMessage();  //génère un message d'erreur rencontré par PDO

            }

        }
        else{
            echo "<br><br>Vos mots de passe ne correspondent pas";
        }
        } else{

        echo "<br><br>L'adresse mail est déjà utilisée";
    }
    }
    else{
        echo "<br><br>Tous les champs doivent être remplis";
    }

}



?>


</body>

