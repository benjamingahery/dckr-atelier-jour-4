<?php

/**
 * api.php
 * O'ShoppingList
 * 
 * Ce fichier est une API très basique permettant la communication
 * entre le front et la BDD.
 */

// inclusion du fichier db.php, qui établi la connexion à la DB
require_once 'db.php';
require_once 'utils.php';

// s'il y a des données en POST, c'est qu'on envoie un nouvel élément de liste.
if(isset($_POST["name"])) {
    
    if (isShoppingListElementValid($_POST['name'])) {
        // On insère la nouvelle tâche dans la table.
        $result = $pdo->query("INSERT INTO item (name) VALUES ('".$_POST["name"]."')");
        
        if($result) {
            // si l'insertion s'est bien passée, on renvoit OK et le code HTTP 201 Created
            http_response_code(201);
            //echo "OK !";

            $stmt = $pdo->prepare("SELECT * FROM item WHERE id = :id");
            $stmt->execute(array(
                'id' =>  $pdo->lastInsertId()
            ));
            $elem = $stmt->fetch();

            header('Content-Type: application/json');
            echo json_encode($elem);
        } else {
            // sinon on renvoit NOK et le code 500.
            http_response_code(500);
            echo "NOK";
        }
    } else {
        // si l'élément est invalide, on retourne 400
        http_response_code(400);
        echo "400 - Bad Request";
    }
    
} else {
    // on récupère les données dans la BDD avec une requête SELECT
    $stmt = $pdo->prepare("SELECT * FROM item");
    $stmt->execute();
    $results = $stmt->fetchAll();
    
    // et on retourne les résultats encodés en JSON
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($results);
}

