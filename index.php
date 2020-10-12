
<a href="inscription.php"> S'inscrire </a>
<a href="connexion.php"> Se connecter </a>

<a href="insert.php"> Ajouter un article </a>

<?php
include "config.php";

$reponse=$bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation,"%d/%m/%Y")  AS date_creation_fr FROM billet ORDER BY ID DESC LIMIT 0,120');


while($donnees=$reponse->fetch())
{
    ?>
    <p>
        <strong>Titre</strong>: <?php echo $donnees['titre'] ; ?>
        <strong>Date</strong>: <?php echo $donnees['date_creation_fr'] ; ?>
        <br>
        <em><a href="commentaires.php?id=<?php echo $donnees['id']; ?>">Lire la suite
                ...</a></em>
    </p>
    <?php
}
$reponse->closeCursor();
?>

