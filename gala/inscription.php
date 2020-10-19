<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="post" action="inscription.php" id="forminscription"> 
<label for="pseudo">pseudo</label>
<input type="text" name="pseudo" id="pseudo" value="<?php if(!empty($_POST['pseudo'])) {echo $_POST['pseudo'];}?>"> <br>

<label for="mail">email</label>
<input type="email" name="mail" id="mail"> <br>
<label for="mdp1">Inserez votre mot de passe</label>
<input type="password" name="mdp1" id="mdp1"> <br>
<label for="mdp2">Confirmez votre mot de passe</label>
<input type="password" name="mdp2" id="mdp2"> <br>
<input type="submit" name="inscription" value="inscription"></form> 
<a href="index.php">Retournez vers la liste des articles</a>
<?php
include "../config.php";
if (isset($_POST["inscription"])){ 
    if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp1']) AND !empty($_POST['mdp2'])){
        $reqmail=$bdd->prepare("select * from membre where mail=?");
        $reqmail->execute(Array($_POST["mail"]));
        $mailexist=$reqmail->rowCount();
        if($mailexist == 0) {
            if($_POST["mdp1"] == $_POST["mdp2"]) {
try {
    $reponse=$bdd->prepare("insert into membre(pseudo, mail, mot_passe) values (?, ?, ?)");
    $reponse->execute(Array($_POST["pseudo"], $_POST["mail"], $_POST["mdp1"]));
    header("Location:index.php"); 
}
catch(Exception $error) {
    echo $error->getMessage();

}
            }
            else {
                echo "<br>" . "Votre mot de passe ne coresponde pas";

            }
 }
 else {
     echo "<br>". "L'email est dejâ outilisé.";
 }
    }
}


?>

</body>
</html>
