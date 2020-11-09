<?php
session_start();
?>

<?php
if(isset($_SESSION['id'])) { // vérifie si un utilisateur est bien connecté, si une session existe bien.

    ?>

    <?php echo 'Bonjour ' . $_SESSION['pseudo']?>&nbsp;

    <a href="profil.php">Mon profil</a>&nbsp;
    <a href="deconnexion.php"> Se déconnecter </a>

    <?php

    if ($_SESSION['admin'] == 1) {
        ?>
        <a href="insert.php"> Ajouter un article </a>
        <?php
    }
} else
{
    ?>
    <a href="inscription.php"> S'inscrire </a>
    <a href="connexion.php"> Se connecter </a>

<?php
}

?>


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
        <em><a href="article.php?id=<?php echo $donnees['id']; ?>">Lire la suite
                ...</a></em>
    </p>
    <?php
}
$reponse->closeCursor();
?>

