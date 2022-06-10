<?php

/**
 * auth.php
 * O'ShoppingList
 * 
 * Ce fichier est une solution d'authentification pour O'ShoppingList.
 */

// inclusion du fichier db.php, qui établi la connexion à la DB
require_once 'db.php';

if (isset($_POST["username"])) {
    
    $stm = $pdo->query("SELECT * FROM users WHERE `login` = '".$_POST["username"]."' AND `mdp` = '" . md5($_POST["password"]) . "'", PDO::FETCH_ASSOC);
    $result = $stm->fetch();
    
    if ($result === false) {
        // on est pas loggé, on renvoit vers le formulaire d'authentification
        header("Location: logout.php");
        die();
    } else {
        
        // on est loggé, on renvoit vers l'application
        $_SESSION['user'] = $result;
        header("Location: app.php");
        die();
    }
} else {
    // pas d'envoi de formulaire, on affiche le formulaire
    header("Location: logout.php");
    die();
}