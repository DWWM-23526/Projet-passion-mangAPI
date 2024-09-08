# REST API in PHP with WAMP

This project is a RESTful API developed in PHP and hosted on a WAMP server. The API interacts with a MySQL database. Sensitive configuration, such as database connection information, is securely managed using configuration files ignored by Git.

### Prerequisites

- WAMP (Windows, Apache, MySQL, PHP)
- Composer (for PHP dependency management)

# Installation

### Step 1: Clone the repository

Clone the repository into your desired directory:

```
git clone https://github.com/DWWM-23526/Projet-passion-mangAPI.git
cd Projet-passion-mangAPI
```

### Step 2: Install dependencies

Make sure Composer is installed, then run the following command to install project dependencies:

```
composer install
```

### Step 3: Configure the database

Create a db.config.php file in the config directory with the following content:

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

> Note: This file is added to .gitignore for security reasons. Make sure not to include your connection details in your repository.

Also, ensure to create a migration.log file in a log folder at the root of your project.

### Step 4: Configure the log

Create a migration.log file in a log folder at the root of the project.

### Step 5: Set up the Virtual Host

Add a virtual host configuration in your WAMP server.

### Step 6: Initialize the database

MySQL is required.

The database is automatically created when initializing the project, so no additional steps are needed.

### Usage

Once the WAMP server is configured and running, you can access your API by navigating to http://api.your-project.local in your browser or using a tool like Postman to send HTTP requests.

#

Thank you for using our REST API in PHP with WAMP.