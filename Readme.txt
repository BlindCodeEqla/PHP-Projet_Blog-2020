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

3. Déclarer que le fk_membre est la clé étrangère de l'id de la table membre
-----------------------------------------------------------------------------
ALTER TABLE commentaire ADD FOREIGN KEY (fk_membre) references membre(id);

4. Ajouter le champ fk_commentaire
-----------------------------------------------
ALTER TABLE commentaire ADD fk_commentaire INT;
ALTER TABLE commentaire ADD FOREIGN KEY (fk_commentaire) references commentaire(id);

5. Ajouter le champ image
-----------------------------------------------
ALTER TABLE billet ADD lien_image VARCHAR(1000);

5. Ajouter le champ actif
-----------------------------------------------
ALTER TABLE membre ADD actif INT;
UPDATE membre
SET actif = 1;


6. ajouter le champ legende
-------------------------------------
ALTER TABLE billet ADD legende VARCHAR(100) NOT NULL DEFAULT 'image';


JOURNAL:




TO DO:

- si admin alors pouvoir gérer autorisations des utilisateurs
- modération des commentaires par admin (boolean: publié ou non)
- Ibrahim: bouton rester connecter (via cookies?) : https://www.youtube.com/watch?v=2h6Hve6_CP0&list=PLEagTQfI6nPN2sdrLWhX_hO1pMOmC9JGU&index=41
- pouvoir écrire un artcile sans mettre l'image

