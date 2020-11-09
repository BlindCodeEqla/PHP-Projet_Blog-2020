<?php
session_start();
include "config.php";

//  afficher le détail des billets
 $prepare =$bdd->prepare('select *, DATE_FORMAT(date_creation, "%d/%m/%Y") as date_fr from billet where id=?');
 $prepare->execute(array($_GET['id']));
 $donnee=$prepare->fetch();
  ?>
    <p> <strong>Billet</strong>:
<?php
echo $donnee["titre"];
?>
<br>
<br>
<?php
if (!empty($donnee['lien_image']))
{
   ?>
   <img src="image/<?php echo $donnee['lien_image'] ?>" alt="test"  width="150"> 
   <br>
    <br>
  <?php
  }
echo $donnee['contenu'] .  $donnee['date_fr'];
  ?>
  </p>

<?php
  $prepare->closeCursor();

  ?>

<?php

$prepare =$bdd->prepare('select *, commentaire.id as ref, DATE_FORMAT(date_commentaire, "%d/%m/%Y") as date_fr from commentaire inner join membre on membre.id = commentaire.fk_membre  where  id_billet=? and fk_commentaire is null order by date_commentaire');
$prepare->execute(array($_GET['id']));

while ($donnee=$prepare->fetch())
 {

 ?>

    <p> <strong>Commentaire</strong>:

 <?php
 echo $donnee['pseudo'] . $donnee['commentaire'] .  $donnee['date_fr'];
  ?>
<?php
if (isset($_SESSION['admin']))
 {
  if ($_SESSION['admin'] == 1)
  {
    ?>
    <a href="delete_commentaire_parent.php?id=<?php echo $_GET['id']; ?>&id_commentaire=<?php echo $donnee['ref']; ?>">supprimer le commentaire parent.</a>
    <?php


  }
}
?>

 </p>

 <?php
 $rep=$bdd->prepare('select *, commentaire.id as ref, date_format  (date_commentaire, "%d/%m/%Y") as date_fr from commentaire inner join membre on membre.id = commentaire.fk_membre where id_billet=? and fk_commentaire is not null and fk_commentaire=? order by date_commentaire');
 $rep->execute(array($_GET['id'], 
   $donnee['ref']));


 while ($donnee_enfant=$rep->fetch())
 {

   ?>
   <p style=margin-left:40px;>
   <strong>
     <?php
     echo $donnee_enfant['pseudo'];
     ?>
     </strong>
     <em>Répond</em>:
     <?php
     echo $donnee_enfant['commentaire'];
     ?>
     <em>le</em>
     <?php
     echo $donnee_enfant['date_fr'];
     ?>
<?php
if (isset($_SESSION['admin']))
{
  if ($_SESSION['admin'] ==1)
  {
    ?>
    <a href="delete_commentaire_enfant.php?id=<?php echo $_GET['id']; ?>&id_commentaire=<?php echo $donnee_enfant['ref']; ?>">Supprimer les commmentaires enfants.</a>
    <?php

  }
}
 ?>
  </p>
  <?php
 }
 $rep->closeCursor();
 ?>
 <br>
 <br>
 
<?php

 if (isset($_SESSION['id']))
  {

 if ($_SESSION['admin'] == 1 or $_SESSION['admin'] == 2)
  {

 ?>
 
<br><br>
  <form style=margin-left:40px; action="repondre_comment.php?id=
   <?php
    echo $_GET['id'];
     ?>&fk_commentaire=
      <?php echo $donnee['ref'];
       ?>" method="post">
  <label for="contenu">comentaire de <?php echo $donnee['pseudo']; ?></label>:<br>
  <textarea name="comment" id="contenu" cols="100" rows="10"></textarea><br><br>
  <input type="submit" name="ajout" value="répondre à un commentaire">
  </form>
     <?php
 }

}

}
 ?>


<?php
$prepare->closeCursor();
 ?>



<?php
if (isset($_SESSION['id']))
{ 
if ($_SESSION['admin'] == 1 or $_SESSION['admin'] == 2)
{
  ?>
  <br><br>
  <form action="insert_comment.php?id=
   <?php 
   echo $_GET['id'];
    ?>" method="post">
  <label for="contenu">comentaire de <?php echo $_SESSION['pseudo']; ?></label>:<br>
  <textarea name="comment" id="contenu" cols="100" rows="10"></textarea><br><br>
  <input type="submit" name="ajout" value="ajouter un commentaire">
  </form>
  <?php 
}
}
?>
<a href="index.php">Retour à la liste des articles</a>
