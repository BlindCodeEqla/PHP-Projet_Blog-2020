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



TO DO:

- supprimer un de ses propres commentaires
- Supprimer ou désactiver mon profil (activer et désactiver)  --- ajouter conditions sur arrticles et commentaires: si id n'existe pas (changer par 'anonyme' ou 'profil supprimé')
- si admin alors pouvoir gérer autorisations des utilisateurs
- pas rendre visible url (passage paramètres,...) par l'internaute
- conditions d'affichage des liens : include un header?
- modération des commentaires par admin (boolean: publié ou non)
- modifier le nom du fichier commentaires.php par article.php
- modifier le nom du fichier insert.php par insert_article.php


Ibrahim: bouton rester connecter (via cookies?)