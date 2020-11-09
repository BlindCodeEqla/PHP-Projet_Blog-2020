<?php
session_start();
include "config.php";

if(isset($_SESSION['id'])) {

if(isset($_POST['ajout']))
{
    if (empty($_POST["comment"]))
    {
        echo "<div><p>Vous devez écrire les commentaires</p></div><br><br> ";
    }
    else
    {
        try

        {
            $reponse = $bdd->prepare('INSERT INTO commentaire(id_billet, commentaire, fk_membre, date_commentaire) VALUES (?, ?, ?, NOW())');
            $reponse->execute(array(
                $_GET['id'],
                $_POST['comment'],
                $_SESSION['id']
            ));


            header("Location: article.php?id=" .$_GET['id']);

        }
        catch (Exception $error)
        {
            echo $error->getMessage();  //génère un message d'erreur

        }
        }
    }
}


?>