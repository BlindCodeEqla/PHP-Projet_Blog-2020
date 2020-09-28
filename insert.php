<! DOCTYPE html>
<html>

<head>
    <meta charset=""utf-8"/>
    <title>Insérer un article</title>
</head>

<form action="insert.php" method="post">

        <label for="titre">Titre</label>:
        <input type="text" name="titre" id="titre" /><br/>
        <label for="contenu">Contenu</label>: <br/>
        <textarea class="form-control" rows="10" cols="100" name="contenu" id="contenu" ></textarea><br><br>

        <input type="submit" class="btn btn-success" name="ajout" value="Ajouter"/>
        </br>
</form>

<?php
include "config.php";

if(isset($_POST['ajout']))
{
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
}
}
//header('Location:commentaires.php');

?>

<a type="button" href="index.php"> Retourner à la liste des articles </a>