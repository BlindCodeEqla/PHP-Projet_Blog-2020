<?php
session_start();
include "config.php";
if(isset($_SESSION['id'])){
    if(isset($_POST['ajout'])){
        if(empty($_POST['comment'])){
            echo "Ecrivez votre commentaire";

        }
     else{
        try {
         $reponse=$bdd->prepare("insert into commentaire(id_billet, commentaire, fk_membre, date_commentaire) values (?,?,?, now())");
         $reponse->execute(Array($_GET['id'], $_POST['comment'], $_SESSION['id']));
         echo "Votre commentaire a éte bien ajouté";

            
        }
    catch(Exception $error){
        echo $error->getMessage();

    } }
    } }
    