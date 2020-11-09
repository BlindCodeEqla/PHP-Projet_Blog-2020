<?php
session_start();
include "config.php";
// ma version

$reponse = $bdd->prepare('select *, DATE_FORMAT(date_creation,
"%d/%m/%Y") as dateCreation from billet where id = ?');
$reponse->execute(array($_GET["id"]));
$donnee = $reponse->fetch();
echo "titre de l'article: " . $donnee['titre'];
?>
<br><br>
<?php
if(!empty($donnee["lien_image"])) {
?>
<img src="image/<?php echo $donnee["lien_image"]?>"
alt="image_article" width="150">
<br><br>
<?php
}
echo " contenu:" . $donnee['contenu'] . " date de l'article: " .
$donnee['dateCreation'] . "<br>";
$reponse->closeCursor();

$reponse = $bdd->prepare('select *, commentaire.id as ref,
DATE_FORMAT(date_commentaire, "%d/%m/%Y") as dateCommentaire from
commentaire inner join membre on membre.id = commentaire.fk_membre
where id_billet = ? and fk_commentaire is null');
$reponse->execute(array($_GET["id"]));
while ($donnee = $reponse->fetch()) {
echo "commentaire: <em>auteur</em>: " . $donnee['pseudo'] . "
<strong>datant du </strong>:" . $donnee['dateCommentaire'] . " " .
$donnee['commentaire'] . "<br>";
if(isset($_SESSION["admin"])) {
if($_SESSION["admin"] == 1 || $_SESSION["id"] == $donnee["fk_membre"]) {
?>
<a href="deleteComment.php?id=<?php echo
$_GET['id'];?>&id_commentaire=<?php echo
$donnee['ref'];?>&fk_membre=<?php echo
$donnee['fk_membre'];?>">Supprimer le commentaire en tant qu'admin</a>
<?php
}
}
$rep = $bdd->prepare('select *, commentaire.id as ref,
DATE_FORMAT(date_commentaire, "%d/%m/%Y") as dateCommentaire from
commentaire inner join membre on membre.id = commentaire.fk_membre
where id_billet = ? and fk_commentaire is not null and fk_commentaire
= ? order by date_commentaire');
$rep->execute(array($_GET["id"], $donnee["ref"]));
while ($donnee_enfant = $rep->fetch()) {
?>
<p style=margin-left:40px;>
<strong>
<?php
echo $donnee_enfant["pseudo"];
?>
</strong>
<em>répond</em>:
<?php
echo $donnee_enfant["commentaire"];
?>
<em>le </em>
<?php
echo $donnee_enfant["dateCommentaire"];
if(isset($_SESSION["admin"])) {
if($_SESSION["admin"] == 1 || $_SESSION["id"] ==
$donnee_enfant["fk_membre"]) {
?>
<a href="deleteCommentEnfant.php?id=<?php echo
$_GET['id'];?>&id_commentaire=<?php echo
$donnee_enfant['ref'];?>&fk_membre=<?php echo
$donnee_enfant['fk_membre'];?>">Supprimer le sous-commentaire en tant
qu'admin</a>
<?php
}
}
?>
</p>
<?php
}
$rep->closeCursor();
if(isset($_SESSION["id"])) {
if($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
?>
<form style=margin-left:40px; action="repondreComment.php?id=<?php
echo $_GET['id'];?>&fk_commentaire=<?php echo $donnee["ref"];?>"
method="POST">
<label for="contenu">commentaire de
<?php
echo $donnee["pseudo"];
?>
</label>
:<br>
<textarea name="comment" id="contenu" cols="100" rows="10"></textarea>
<br><br>
<input type="submit" name="ajout" value="répondre au commentaire">
</form>

<?php
}
}
}
$reponse->closeCursor();
?>
<a href="index.php">Retournez vers la liste des articles</a>

<?php
if (isset($_SESSION["id"])) {
if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
?>
<br> <br>
<form action="insertComment.php?id=<?php echo $_GET['id'];?>" method="POST">
<label for="contenu">commentaire de
<?php
echo $_SESSION["pseudo"];
?>
</label>
:<br>
<textarea name="comment" id="contenu" cols="100" rows="10"></textarea>
<br><br>
<input type="submit" name="ajout" value="ajoutez votre commentaire">
</form>

<?php
}
}