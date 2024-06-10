# Neptune

## Prérequis

- Serveur web local (ex: XAMPP, WAMP, MAMP)
- PHP 7.0 ou supérieur
- MySQL ou MariaDB

## Installation

1. Clonez ce dépôt sur votre machine locale :

```
git clone https://github.com/Melanie-devv/Neptune
```

2. Placez le dossier du projet dans le répertoire de votre serveur web local (ex: `htdocs` pour XAMPP ou `www` pour WAMP).

3. Créez une nouvelle base de données MySQL pour le projet.

4. Importez le fichier SQL de la structure de la base de données (`database.sql`) dans votre nouvelle base de données.

5. Renommez le fichier `config.php.example` en `config.php` et mettez à jour les paramètres de connexion à la base de données avec vos informations.

6. Assurez-vous que les permissions des fichiers et dossiers sont correctement définies pour permettre l'écriture.

## Exécution

1. Démarrez votre serveur web local.

2. Dans votre navigateur, accédez à `http://localhost/Neptune` pour afficher la page d'accueil du site.

3. Vous pouvez vous connecter en utilisant les comptes d'administrateur ou de client créés dans la base de données importée.



## Fonctionnalités principales

- Inscription et connexion des clients
- Réservation de chambres
- Gestion des chambres, clients et réservations pour les administrateurs
- Etc.

N'hésitez pas à consulter le code source et la documentation pour plus de détails sur les fonctionnalités et l'utilisation du site web. Issue de mon portfolio.
