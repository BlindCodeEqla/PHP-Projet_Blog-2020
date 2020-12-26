<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Mon Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="normalize.css" />
    <link rel="stylesheet" href="style.css">
    
    <script  src="menu.js" defer></script>
   
 
  </head>
<header>
    <figure>          
      <img src="" alt="Logo" id="logoImg" />
  </figure>  
  <h1 id="title">Mon Blog</h1>
     <button id="menuToggle"><img src="hamburger.svg" alt="Ouvrir/ Fermer le menu" /></button>

</header> 
  <?php
  session_start();
  ?>

  <?php
  if(isset($_SESSION['id'])) { // vérifie si un utilisateur est bien connecté, si une session existe bien.

  ?>
  <nav id="NavBar">
          <h1 class="accessibility">Menu</h1>
          <p class="accessibility"><a href="#contenu_principal" title="Aller au contenu principal">Passer le menu</a></p>
                <ul id="contenu_nav">
                     
                    <li><a href="profil.php" title="voir mon profil">Mon profil</a></li>&nbsp;
                    <li><a href="deconnexion.php" title="se déconnecter"> Se déconnecter </a></li>

                </ul>
                   
  </nav>
  <?php 
  echo 'Bonjour ' . $_SESSION['pseudo'] 
  ?>&nbsp;

<?php
} 
?>

  <?php
  else
{
    ?>
    <nav id="NavBar">
          <h1 class="accessibility">Menu</h1>
          <p class="accessibility"><a href="#contenu_principal" title="Aller au contenu principal">Passer le menu</a></p>
                <ul id="contenu_nav">
                     
                <li><a href="inscription.php" title="s'inscrire"> S'inscrire </a></li>
                <li><a href="connexion.php" title="se connecter"> Se connecter </a></li>

                </ul>
                   
    </nav>
 
<?php
}

?>
 <?php
  if ($_SESSION['admin'] == 1) {
?>
        <a href="insert.php"> Ajouter un article </a>
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
        <em><a href="commentaires.php?id=<?php echo $donnees['id']; ?>">Lire la suite
                ...</a></em>
    </p>
<?php
}
$reponse->closeCursor();
?>

