<?php
session_start();
include "config.php";
if (isset($_SESSION['id']))
{
    if (isset($_POST['ajout']))
    {
        if (empty($_POST['comment']))
        {
            echo "Ecrivez un commentaire.";

        } 
        else
         {
            try
             {
                $reponse=$bdd->prepare('insert into commentaire (id_billet, commentaire, fk_membre, fk_commentaire, date_commentaire) values (?, ?, ?, ?, now())');
                $reponse->execute(array($_GET['id'], $_POST['comment'], $_SESSION['id'], $_GET['fk_commentaire']));
                header('Location:article.php?id=' . $_GET['id']);
                
            } 
            catch (Exception $error)
            {
                echo $error->getMessage();

            }
        }
    }
}
    
?>


