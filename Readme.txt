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





JOURNAL:

- ajouter session_start à la page commentaire.php
- ajouter à la page commentaire.php les conditions si admin = 1 ou 2
- modification base de données (voir ci-dessus)
- modification requête + récupération du nom d'auteur dans la page commentaires.php


TO DO:

- afficher le nom du pseudo sur une entête de page
- régler le problème du profil (quand on clique sur le lien à partir de la page index.php)
- page insert_comment.php
- conditions d'affichage des liens : include un header?
- si admin alors pouvoir gérer autorisations des utilisateurs
- modération des commentaires par admin (boolean: publié ou non)
- modifier le nom du fichier commentaires.php par article.php
- modifier le nom du fichier insert.php par insert_article.php
- commenter un commentaire (ajouter un champ fk_commentaire dans la table commentaire)

Ibrahim: bouton rester connecter (via cookies?)