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


TO DO:

- Ajouter une photo à un article et le stocker dans la base de données
- Afficher la photo d'un article
- conditions d'affichage des liens : include un header?
- si admin alors pouvoir gérer autorisations des utilisateurs
- modération des commentaires par admin (boolean: publié ou non)
- modifier le nom du fichier commentaires.php par article.php
- modifier le nom du fichier insert.php par insert_article.php
- commenter un commentaire (ajouter un champ fk_commentaire dans la table commentaire)

Ibrahim: bouton rester connecter (via cookies?)