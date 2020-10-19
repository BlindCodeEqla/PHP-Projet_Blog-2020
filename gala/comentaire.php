<?php
include '../config.php';
$reponse=$bdd->prepare('select *, DATE_FORMAT(date_creation, "&d/&m/&Y") as date_fr from billet where id=?');
$reponse->execute(array($_GET['id']));
$donnes=$reponse->fetch(); ?>
<p> <strong>titre</strong>:

<?php

echo$donnes["titre"];

?>

<strong> contenu</strong>:
<?php 
echo  $donnes["contenu"];
?>
<strong> date_creation</strong>


<?php echo $donnes["date_fr"]; ?>
</p>
<?php

$reponse->closeCursor(); ?>

<?php

$reponse=$bdd->prepare('select *, DATE_FORMAT(date_commentaire, "%d/%m/%Y") as date_fr from commentaire where id_billet=? order by date_commentaire');
$reponse->execute(array($_GET["id"]));
while($donnes=$reponse->fetch()){

    ?>

    <p> <strong>auteur</strong>:

    <?php

    echo$donnes["auteur"];

?>

<strong> commentaire</strong>:
<?php 
echo  $donnes["commentaire"]; ?>
<strong> date_commentaire</strong>


<?php echo $donnes["date_fr"]; ?>  </p>

    </p>
    <?php
}

$reponse->closeCursor(); ?>
<a href="index.php">Retournez vers la liste des articles</a>