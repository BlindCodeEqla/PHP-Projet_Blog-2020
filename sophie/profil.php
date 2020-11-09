<?php
session_start();  // obligatoire pour récupérer les variables de session
include 'config.php';


// on va vérifier si la variable get id existe bien (si elle n'existe pas, ça n'affiche rien)

if (isset($_SESSION['id'])){

?>

<h2>Profil de <?php echo $_SESSION['pseudo'];?></h2>
<p>mail: <?php echo $_SESSION['mail'];?></p>

<?php
$admin = "";

if ($_SESSION['admin'] == 1){
    $admin = "admin";
} else {
    $admin= "non admin";
}

?>

<p>Vous avez un compte <?php echo $admin ?></p>

    <!-- ajout -->
<?php

    $reponse=$bdd->prepare('SELECT * FROM membre WHERE id = ?');
    $reponse->execute(array($_SESSION['id']));
    $donnees = $reponse->fetch();

    if ($donnees['actif'] == 1){
?>
    <p>Votre profil est activé
    <a href="activer_profil.php?id=<?php echo $donnees['id'];?>&actif=<?php echo $donnees['actif']?>">désactiver</a>
    </p>
        <?php

    } elseif ($donnees['actif'] == 2)  {
?>
        <p>Votre profil est désactivé
        <a href="activer_profil.php?id=<?php echo $donnees['id'];?>&actif=<?php echo $donnees['actif']?>">activer</a>
    </p>
        <?php

    }

    ?>


    <!-- fin ajout -->

<?php
}
?>
<a href="index.php"> Retourner à la liste des articles </a>
