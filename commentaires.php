<?php
include "config.php";

$reponse=$bdd->prepare('SELECT *, DATE_FORMAT(date_creation,"%d/%m/%Y")  AS date_fr FROM billet WHERE id = ?');
$reponse->execute(array($_GET['id']));
$donnees = $reponse->fetch();

?>
<p>
    <strong>Titre</strong>: <?php echo $donnees['titre'] ; ?><br>
    <strong>Contenu</strong>: <?php echo $donnees['contenu'] ; ?><br>
    <strong>Date</strong>: <?php echo $donnees['date_fr'] ; ?>
</p>
<?php
$reponse->closeCursor();

$reponse=$bdd->prepare('SELECT *, DATE_FORMAT(date_commentaire,"%d/%m/%Y")  AS date_fr FROM commentaire WHERE id_billet= ? ORDER BY date_commentaire');
$reponse->execute(array($_GET['id']));

while($donnees=$reponse->fetch())
{
    ?>
    <p>
        <strong>Auteur</strong>: <?php echo $donnees['auteur'] ; ?>
        <strong>Commentaire</strong>: <?php echo $donnees['commentaire'] ; ?>
        <strong>Date</strong>: <?php echo $donnees['date_fr'] ; ?>
    </p>
    <?php
}
$reponse->closeCursor();
?>
