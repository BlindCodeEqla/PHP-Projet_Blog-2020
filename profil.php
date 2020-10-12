<?php
session_start();  // obligatoire pour récupérer les variables de session
include 'config.php';


// on va vérifier si la variable get id existe bien (si elle n'existe pas, ça n'affiche rien)

if (isset($_GET['id'])){

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
<?php
}
?>
<a type="button" href="index.php"> Retourner à la liste des articles </a>
