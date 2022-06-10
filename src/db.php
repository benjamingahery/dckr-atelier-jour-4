<?php

/**
 * db.php - v2 (compatible avec MySQL !)
 * O'ShoppingList
 * 
 * Ce fichier sert à établir la connexion à la BDD SQLite ou MySQL.
 * Utilisation : inclure le fichier (avec include ou require) et utiliser l'objet $pdo
 */


// On commence par vérifier si la variable d'environnement DB_PROVIDER est définie ou non
if (getenv("DB_PROVIDER") === false || getenv("DB_PROVIDER") == "SQLite") {
    // si elle est définie à SQLite ou non définie, on se connecte à la base de données SQLite
    try {
        // connexion à la DB SQLite, le fichier sera créé s'il n'existe pas.
        //$pdo = new PDO('sqlite:'.dirname(__FILE__).'/db.sqlite');
        $pdo = new PDO('sqlite:db/db.sqlite');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        // en cas de connexion impossible, on renvoi un message d'erreur.
        // Attention, dans une application sérieuse il faut faire attention au contenu de ces messages,
        // la divulgation d'informations techniques est une faille de sécurité potentielle.
        echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
        die();
    }

    prepareDB($pdo);

} else if (getenv("DB_PROVIDER") == "MySQL") { // sinon, on regarde si la variable d'environnement est définie sur MySQL
    // on vérifie que toutes les variables d'environnement nécessaires sont bien définies pour MySQL
    if (getenv("MYSQL_HOST") !== false || getenv("MYSQL_USER") !== false || getenv("MYSQL_PASSWORD") !== false || getenv("MYSQL_DB") !== false)
    {
        // On récupère ces variables d'environnement
        $host = getenv("MYSQL_HOST");
        $user = getenv("MYSQL_USER");
        $password = getenv("MYSQL_PASSWORD");
        $db = getenv("MYSQL_DB");

        // et on se connecte à MySQL
        try
        {
            $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            // en cas de connexion impossible, on renvoi un message d'erreur.
            // Attention, dans une application sérieuse il faut faire attention
            // au contenu de ces messages, la divulgation d'informations 
            // techniques est une faille de sécurité potentielle.
            echo "Impossible d'accéder à la base de données MySQL : ".$e->getMessage();
            die();
        }
    }
    else
    {
        // il manque des variables d'environnement, on renvoi un message d'erreur
        echo "Variables d'environnement manquantes.";
        die();
    }
    
    prepareDB($pdo);
}
else
{
    echo "Mauvais SGBD renseigné dans la variable d'environnement DB_PROVIDER. Les SGBD supportés sont SQLite ou MySQL.";
    die();
}

function prepareDB($pdo)
{
    if (getenv("DB_PROVIDER") === false || getenv("DB_PROVIDER") == "SQLite") {
        // si la table n'existe pas, on la créé
        $pdo->query("CREATE TABLE IF NOT EXISTS item ( 
        id      INTEGER         PRIMARY KEY,
        name    VARCHAR( 255 )  NOT NULL,
        done    INTEGER         DEFAULT 0
        );");

        // on sécurise notre appli avec des utilisateurs
        $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
        `id`    INTEGER         PRIMARY KEY,
        `login` VARCHAR( 255 )  NOT NULL,
        `mdp`   VARCHAR( 255 )  NOT NULL
        );");
    } else {
        // si la table n'existe pas, on la créé
        $pdo->query("CREATE TABLE IF NOT EXISTS item ( 
            id      INTEGER         PRIMARY KEY AUTO_INCREMENT,
            name    VARCHAR( 255 )  NOT NULL,
            done    INTEGER         DEFAULT 0
            );");
    
            // on sécurise notre appli avec des utilisateurs
            $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
            `id`    INTEGER         PRIMARY KEY AUTO_INCREMENT,
            `login` VARCHAR( 255 )  NOT NULL,
            `mdp`   VARCHAR( 255 )  NOT NULL
            );");
    }
    
    // je vérifie si j'ai déjà l'admin, sinon je l'ajoute
    $stm = $pdo->query("SELECT COUNT(*) as `nbUser` FROM `users` WHERE `login` = 'admin'", PDO::FETCH_ASSOC);
    //$rows = $stm->fetchAll();
    if ($stm->fetchAll()[0]['nbUser'] < 1){
        // on crée l'admin comme ça il est tout le temps là
        $pdo->query("INSERT INTO `users` (`login`, `mdp`) VALUES ('admin', '" . md5('admin') . "');");
    }
}