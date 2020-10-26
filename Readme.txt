Inscription : https://www.youtube.com/watch?v=s7qtAnH5YkY
Connexion + Profil + se déconnecter : https://www.youtube.com/watch?v=vHs9sPIA61k&t=10s




Modification table commentaire:
_________________________________

1. Changer tous les noms par un id de la table membre qui existe
-----------------------------------------------------------------
UPDATE commentaire
SET auteur = 1;

2. Changer le nom du champ auteur par fk_membre
-------------------------------------------------
ALTER TABLE commentaire CHANGE auteur fk_membre INT;

3. Déclarer que kle fk_membre est la clé étrangère de l'id de la table membre
-----------------------------------------------------------------------------
ALTER TABLE commentaire ADD FOREIGN KEY (fk_membre) references membre(id);

4. Ajouter le champ fk_commentaire
-----------------------------------------------
ALTER TABLE commentaire ADD fk_commentaire INT;
ALTER TABLE commentaire ADD FOREIGN KEY (fk_commentaire) references commentaire(id);

4. Ajouter le champ image
-----------------------------------------------
ALTER TABLE billet ADD lien_image VARCHAR(1000);


JOURNAL:

- Adapter le formulaire (pour répondre à un commentaire ) à la page commentaires.php
- Créer le fichier repondre_comment.php

- ajouter à la table 'billet' un champ 'lien_image' de type varchar (1000 caractères)
- créer un nouveau dossier 'images' à la racine du projet (pour stocker les images)
- ajouter au formulaire de l'insertion d'article, la possibilité d'uploader l'image depuis le pc (dans fichier insert.php)
- ajouter la langue fr dasn la page insert.php pour que le texte du bouton d'upload s'affiche en français
- pour que le navigateur gère l'upload du fichier, il faut ajouter dans la balise ouvrant form : enctype="multipart/form-data"
- Ajouter les vérifications, le transfert de l'image sur notre serveur et l'import du chemin dans la base de données dans le fichier insert.php
- Faire afficher la photo dans le détail d'un article (fichier commentaires.php)


TO DO:

- conditions d'affichage des liens : include un header?
- si admin alors pouvoir gérer autorisations des utilisateurs
- modération des commentaires par admin (boolean: publié ou non)
- modifier le nom du fichier commentaires.php par article.php
- modifier le nom du fichier insert.php par insert_article.php


Ibrahim: bouton rester connecter (via cookies?)