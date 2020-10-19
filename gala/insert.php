<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="insert.php" method="post">

<label for="titre">Titre</label>
<input type="text" name="titre" id="titre"> <br>
<label for="contenu">Contenu</label> <br>
<textarea rows="2" cols="100" name="contenu" id="contenu"></textarea> <br><br>
<input type="submit" name="ajout" value="ajouter">


</form>

<?php
include '../config.php';
if(isset($_POST["ajout"])) {

 if ((empty($_POST["titre"])) || (empty($_POST["contenu"])) )
{
    echo "<div class='alert alert-danger'><p class='lead'>Vous devez remplir les champs vides</p></div><br><br> ";
}
else
{
try

{
    $reponse = $bdd->prepare('INSERT INTO billet(titre,contenu, date_creation) VALUES (?, ?, NOW())');
    $reponse->execute(array(
        $_POST['titre'],
        $_POST['contenu']
    ));
    echo "<div class='alert alert-success'><p class='lead'>Votre article a bien été ajouté</p></div><br><br>";

}
catch (Exception $error)
{
    echo $error->getMessage();  //génère un message d'erreur

}
//}
}
} 
?>
<a href="index.php">Retournez vers la liste des articles</a>