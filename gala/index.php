<?php
session_start();
?>
<?php
if(isset($_SESSION["id"])){ ?>
<a href="profile.php">Mon profile </a><a href="connexion.php">Connexion</a>
<a href="deconnexion.php">deconnexion</a>
<?php
if($_SESSION["admin"] == 1){
        ?> 
    
<a href="insert.php">Ajoutez un article</a>
<?php
    }} else{
        ?>
        <a href="inscription.php">s'inscrire</a>
<a href="connexion.php">se connecter</a>


    <?php
    }

include '../config.php';
 

$reponse=$bdd->query('select id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y") as date_fr from billet order by id desc limit 0,5');
while($donnes=$reponse->fetch()){

    ?>

    <p> <strong>titre</strong>:
    <?php

    echo $donnes["titre"];
echo $donnes["date_fr"]; 
?> 


<br> <em><a href="comentaire.php?id=<?php echo $donnes['id']; ?> ">lire le suite</a> </em>

</p> <?php 
}
$reponse->closeCursor(); 



?>




