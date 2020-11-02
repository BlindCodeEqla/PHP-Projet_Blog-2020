<?php
session_start();
include "config.php";

$reponse=$bdd->prepare('SELECT *, DATE_FORMAT(date_creation,"%d/%m/%Y")  AS date_fr FROM billet WHERE id = ?');
$reponse->execute(array($_GET['id']));
$donnees = $reponse->fetch();

?>
<p>
    <strong>Titre</strong>: <?php echo $donnees['titre'] ; ?><br>


    <br><br>
    <?php
    if(!empty($donnees['lien_image']))
    {
        ?>
    <img alt = "test" src="images/<?php echo $donnees['lien_image']?>" width="150" />
        <br><br>

    <?php
    }
    ?>



    <strong>Contenu</strong>: <?php echo $donnees['contenu'] ; ?><br>
    <strong>Date</strong>: <?php echo $donnees['date_fr'] ; ?>
</p>

<a type="button" href="index.php"> Retourner à la liste des articles </a>
<?php
$reponse->closeCursor();


$reponse=$bdd->prepare('SELECT *, commentaire.id AS ref, DATE_FORMAT(date_commentaire,"%d/%m/%Y")  AS date_fr FROM commentaire INNER JOIN membre ON membre.id = commentaire.fk_membre WHERE id_billet= ? AND fk_commentaire IS NULL ORDER BY date_commentaire');
$reponse->execute(array($_GET['id']));

while($donnees=$reponse->fetch())
{
    ?>
    <p>

        <strong> <?php echo $donnees['pseudo'] ; ?></strong><em> dit </em>:
        <?php echo $donnees['commentaire'] ; ?>
        <em>le</em>: <?php echo $donnees['date_fr'] ; ?>

<!--        AJOUT-->

        <?php
        if (isset($_SESSION['admin'])){
        if ($_SESSION['admin'] == 1){
            ?>
            <a href="delete_comment.php?id=<?php echo $_GET['id']; ?>&id_commentaire=<?php echo $donnees['ref']; ?>">Suppprimer</a>
        <?php
            }
            }


        ?>

        <!--      FIN  AJOUT-->


    </p>



    <?php
    $rep=$bdd->prepare('SELECT *, commentaire.id AS ref, DATE_FORMAT(date_commentaire,"%d/%m/%Y")  AS date_fr FROM commentaire INNER JOIN membre ON membre.id = commentaire.fk_membre WHERE id_billet= ? AND fk_commentaire IS NOT NULL AND fk_commentaire = ? ORDER BY date_commentaire');
    $rep->execute(array(
            $_GET['id'],
            $donnees['ref']
    ));
    while($donnees_enfants=$rep->fetch()) {
        ?>
        <p style = margin-left:40px;>

            <strong><?php echo $donnees_enfants['pseudo']; ?></strong>
            <em>répond</em>: <?php echo $donnees_enfants['commentaire']; ?>
            <em>le</em> <?php echo $donnees_enfants['date_fr']; ?>

            <!--        AJOUT-->

            <?php
        if (isset($_SESSION['admin'])){
            if ($_SESSION['admin'] == 1){
                ?>
                <a href="delete_comment_enfant.php?id=<?php echo $_GET['id']; ?>&id_commentaire=<?php echo $donnees_enfants['ref']; ?>">Suppprimer</a>
                <?php
            }
            }


            ?>

            <!--      FIN  AJOUT-->

        </p>
        <?php
    }
    $rep->closeCursor();


    if(isset($_SESSION['id'])) { // vérifie si un utilisateur est bien connecté, si une session existe bien.
    if ($_SESSION['admin'] == 1 OR $_SESSION['admin'] ==2){
        ?>


    <form style = margin-left:40px; action="repondre_comment.php?id=<?php echo $_GET['id']; ?>&fk_commentaire=<?php echo $donnees['ref']; ?>" method="post">

        <label for="contenu">Répondez à <?php echo $donnees['pseudo']; ?></label>: <br/>
        <textarea rows="3" cols="50" name="comment" id="comment" ></textarea><br><br>

        <input type="submit" name="ajout" value="Répondre"/>
        </br>
    </form>


    <?php
    }
    }
}
$reponse->closeCursor();


if(isset($_SESSION['id'])) { // vérifie si un utilisateur est bien connecté, si une session existe bien.
if ($_SESSION['admin'] == 1 OR $_SESSION['admin'] ==2){

    ?>
    <br><br>
    <form action="insert_comment.php?id=<?php echo $_GET['id']; ?>" method="post">

        <label for="contenu">Commentaire de <?php echo $_SESSION['pseudo']; ?></label>: <br/>
        <textarea rows="10" cols="100" name="comment" id="comment" ></textarea><br><br>

        <input type="submit" name="ajout" value="Ajouter"/>
        </br>
    </form>


<?php

}
}

?>


