<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        
<form method="post" action="connexion.php" id="formconnexion"> 
<label for="mailconnect">email</label>
<input type="email" name="mailconnect" id="mailconnect"> <br>
<label for="mdpconnect">Inserez votre mot de passe</label>
<input type="password" name="mdpconnect" id="mdpconnect"> <br>
<input type="submit" name="connexion" value="connexion"></form> 
<?php

session_start(); 
include "../config.php";
if (isset($_POST['connexion'])){
    if (!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect'])) {
        $requser=$bdd->prepare("select * from membre where mail = ? and mot_passe = ?");
        $requser->execute(array($_POST['mailconnect'], $_POST['mdpconnect']));
        $userexist=$requser->rowCount();
if ($userexist == 1){
    $userinfo=$requser->fetch();
    $_SESSION['id']=$userinfo['id'];
    $_SESSION['pseudo']=$userinfo['pseudo'];
    $_SESSION['mail']=$userinfo['mail'];
    $_SESSION["admin"] = $userinfo["admin"];
    
    header ("Location: profile.php?id=".$_SESSION['id']);


}else {
    echo "Utilisateur nonexistant";
}
    }else {
        echo "Touts les champs doivent etre remplit";
    }
} ?>

</body>
</html>