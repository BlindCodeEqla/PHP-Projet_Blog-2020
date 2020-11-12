<! DOCTYPE html>
<html lang="fr">

<head>
    <meta charset=""utf-8"/>
    <title>Insérer un article</title>
</head>

<form action="insert.php" method="post" enctype="multipart/form-data">

        <label for="titre">Titre</label>:
        <input type="text" name="titre" id="titre" /><br/>
        <label for="contenu">Contenu</label>: <br/>
        <textarea class="form-control" rows="10" cols="100" name="contenu" id="contenu" ></textarea><br><br>

    <label> Image</label>
    <input type="file" name="image" value="Télécharger"/>

    <label for="legende">Légende de l'image</label>:
    <input type="text" name="legende" id="legende" /><br/>

<br>
        <input type="submit" class="btn btn-success" name="ajout" value="Ajouter"/>

        </br>
</form>

<?php
include "config.php";

if(isset($_POST['ajout']))
{

//    MODIFICATION
//    Vérification si le fichier a été uploader + On vérifie si un nom existe dans le fichier qui a été uploader
    if (isset($_FILES['image']) AND !empty($_FILES['image']['name']))
    {
        $taillemax = 2097152; // limite de 2 méga octets (conversion un peu spéciale)
        $extensionvalide = array('jpg', 'jpeg', 'gif', 'png'); // pour des raisons de sécurité (empêche de permettre de mettre n'importe quel fichier qui pourrait contenir des virus

        // vérifier si la taille est inférieure à la taille max qu'on vient de déterminer
        if ($_FILES['image']['size'] <= $taillemax){

            // https://www.youtube.com/watch?v=lDZLZAdr1is : 11:00
            // strtolower va permettre de mettre toutes les chaines en minuscule
            // substr: ignore un caractère (le 1 sera la limite de la chaine)
            // strrchr: va nous permettre de prendre l'extension du fichier (le '.' est le caractère que la chaine ne va pas prendre en compte et éliminer (le séparateur))

            $extensionupload = strtolower(substr(strrchr($_FILES['image']['name'], '.'),1));

            // ON EST ARRIVE ICI!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            //_______________________________________________________________________________

            // in_array: vérifie si c'est dans le tableau
            // si la variable  extensionupload intègre bien l'une des valeur initailisée dans la variable extensionvalide
            if(in_array($extensionupload, $extensionvalide)){

                // importation de l'image vers le serveur du site
                // créer un chemin pour notre fichier et le renommer
                $chemin= "images/".$_POST['titre'].".".$extensionupload;
                // fonction qui permet de déplacer l'image que la personne vient d'uploader
                // tmp_name: chemin temporaire du fichier
                $transfert= move_uploaded_file($_FILES['image']['tmp_name'], $chemin);

                // vérifier si le transfert s'est bien effectué
                if($transfert){


                    // COPIER CODE EN BAS
                    if ((empty($_POST["titre"])) || (empty($_POST["contenu"])) || (empty($_POST['legende'])))
                    {
                        echo "<div class='alert alert-danger'><p class='lead'>Vous devez remplir les champs vides</p></div><br><br> ";
                    }
                    else
                    {
                        try

                        {
                            // à adapter
                            $reponse = $bdd->prepare('INSERT INTO billet(titre,contenu, lien_image, legende, date_creation) VALUES (?, ?, ?, ?, NOW())');
                            $reponse->execute(array(
                                $_POST['titre'],
                                $_POST['contenu'],
                                $_POST['titre'].".".$extensionupload,
                                $_POST['legende']
                            ));
//                            echo "<div class='alert alert-success'><p class='lead'>Votre article a bien été ajouté</p></div><br><br>";
                            header("Location: insert.php");

                        }
                        catch (Exception $error)
                        {
                            echo $error->getMessage();  //génère un message d'erreur

                        }
                    }

                }


                else {
                    echo "<div class='alert alert-danger'><p class='lead'>Erreur durant l'importation de votre image. Veuillez recommencer.</p></div><br><br> ";
                }


            } else {
                echo "<div class='alert alert-danger'><p class='lead'>Votre image doit être au format jpg, jpeg, png ou gif</p></div><br><br> "; //2 mégas octets
            }

        } else{
            echo "<div class='alert alert-danger'><p class='lead'>Votre image ne doit pas dépasser 2Mo</p></div><br><br> "; //2 mégas octets
        }
    } else
        echo " vous devez télécharger une  image";
    }



?>

<a type="button" href="index.php"> Retourner à la liste des articles </a>