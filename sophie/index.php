
<?php
session_start(); 
include "config.php";
?>


<?php
if (isset($_SESSION["id"])){
 ?>
<a href="deconnection.php">Se déconnecter.</a>
<a href="../profil.php">mon profil</a>
<?php
    if ($_SESSION["admin"] ==1 ){
     ?>
  

<a href="insert_article.php">Ajouter un article</a> 
<?php
}
}
else {
    ?>
    <a href="inscriptioncork.php">s'inscrire</a>
<a href="connectionso.php">Seconnecter.</a>
<?php
}
 ?>



<?php
include "config.php";

// afficher les 5 dernier articles et modifier le format de la date dans la même requête
$reponse=$bdd->query('select id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y") as date_fr  from billet ');
while($donnees=$reponse->fetch())
{
    ?>
    <p>
        <strong>Titre</strong>: <?php echo $donnees['titre'] ; ?>
        <strong>Date</strong>: <?php echo $donnees['date_fr'] ; ?>
        <br>
        <em><a href="article.php?id=<?php echo $donnees['id']; ?>">Lire la suite
                ...</a></em>
    </p>
    <?php
}
$reponse->closeCursor();
?>


