# API REST en PHP avec WAMP

Ce projet est une API RESTful développée en PHP et hébergée sur un serveur WAMP. L'API interagit avec une base de données MySQL. La configuration sensible, telle que les informations de connexion à la base de données, est gérée de manière sécurisée en utilisant des fichiers de configuration ignorés par Git.

### Prérequis

* WAMP (Windows, Apache, MySQL, PHP)
* Composer (pour la gestion des dépendances PHP)

# Installation

### Étape 1: Cloner le dépôt

Clonez le dépôt dans le répertoire de votre choix :


```
git clone https://github.com/DWWM-23526/Projet-passion-mangAPI.git
cd Projet-passion-mangAPI
```

### Étape 2: Installer les dépendances

Assurez-vous d'avoir Composer installé, puis exécutez la commande suivante pour installer les dépendances du projet :


```
composer install
```

### Étape 3: Configurer la base de données

Créez un fichier db.config.php dans le répertoire config avec le contenu suivant :

```
<?php 
return [
    'database' => [
        'host' => 'votre_hote',
        'port' => votre_port,
        'db' => 'votre_nom_de_bdd',
        'user' => 'votre_utilisateur',
        'pass' => 'votre_mot_de_passe',
        'charset' => 'utf8mb4',
        'collate' => 'utf8mb4_general_ci',
    ]
];

```
> Remarque : Ce fichier est ajouté au .gitignore pour des raisons de sécurité. Assurez-vous de ne pas inclure vos informations de connexion dans votre dépôt.

Veillez également a créer un fichier migration.log dans un dossier log à la racine de votre projet

### Étape 4: Configurer le Virtual Host

Ajoutez une configuration de virtual host dans votre serveur WAMP.


### Étape 5: Initialiser la base de données

MySQL est requis.

La base de données est automatiquement créée lors de l'initialisation du projet, vous n'avez donc aucune action supplémentaire à effectuer. 

### Utilisation

Une fois que le serveur WAMP est configuré et en cours d'exécution, vous pouvez accéder à votre API en naviguant vers http://api.votre-projet.local dans votre navigateur ou en utilisant un outil comme Postman pour effectuer des requêtes HTTP.

#

Merci d'utiliser notre API REST en PHP avec WAMP.
