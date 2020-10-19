<?php
session_start();
include "config.php";

$reponse = $bdd->prepare('select *, DATE_FORMAT(date_creation,"%d/%m/%Y") as dateCreation from billet where id = ?');
$reponse->execute(array($_GET["id"]));

$donnee = $reponse->fetch();

echo "titre de l'article: " . $donnee["titre"] . " contenu:" .
    $donnee["contenu"] . " date de l'article: " . $donnee["dateCreation"]
    . "<br>";

$reponse->closeCursor();

$reponse = $bdd->prepare('select *, DATE_FORMAT(date_commentaire,"%d/%m/%Y") as dateCommentaire from commentaire inner join membre on membre.id = commentaire.fk_membre where id_billet = ? ');
$reponse->execute(array($_GET['id']));

while ($donnee = $reponse->fetch()) {

    echo "commentaire: <em>auteur</em>: " . $donnee['pseudo'] . "
<strong>datant du </strong>:" . $donnee['dateCommentaire'] . " " .
        $donnee['commentaire'] . "<br>";


}
$reponse->closeCursor();
?>
<a href="index.php">Retournez vers la liste des articles</a>
