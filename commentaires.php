<?php
session_start();
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

//$reponse=$bdd->prepare('SELECT *, DATE_FORMAT(date_commentaire,"%d/%m/%Y")  AS date_fr FROM commentaire WHERE id_billet= ? ORDER BY date_commentaire');
$reponse=$bdd->prepare('SELECT *, DATE_FORMAT(date_commentaire,"%d/%m/%Y")  AS date_fr FROM commentaire INNER JOIN membre ON membre.id = commentaire.fk_membre WHERE id_billet= ? ORDER BY date_commentaire');
$reponse->execute(array($_GET['id']));

while($donnees=$reponse->fetch())
{
    ?>
    <p>
<!--        <strong>Auteur</strong>: --><?php //echo $donnees['auteur'] ; ?>
        <strong>Auteur</strong>: <?php echo $donnees['pseudo'] ; ?>
        <strong>Commentaire</strong>: <?php echo $donnees['commentaire'] ; ?>
        <strong>Date</strong>: <?php echo $donnees['date_fr'] ; ?>
    </p>
    <?php
}
$reponse->closeCursor();
?>
<a type="button" href="index.php"> Retourner à la liste des articles </a>

<?php

if(isset($_SESSION['id'])) { // vérifie si un utilisateur est bien connecté, si une session existe bien.
if ($_SESSION['admin'] == 1 OR $_SESSION['admin'] ==2){

    ?>
    <br><br>
    <form action="insert_comment.php" method="post">

        <label for="contenu">Commentaire de <?php echo $_SESSION['pseudo']; ?></label>: <br/>
        <textarea rows="10" cols="100" name="comment" id="comment" ></textarea><br><br>

        <input type="submit" name="ajout" value="Ajouter"/>
        </br>
    </form>


<?php

}
}

?>


