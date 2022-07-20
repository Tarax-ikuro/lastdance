<?php


// CONNEXION A LA BASE DE DONNÉES 


// Utilisation de l'extension orientée objet PDO en utilisant comme paramètres 

// le nom de l'hote : localhost 
// la base de donnée: last
// l'identifiant: ARIAS
//  Et le mot de passe identique 
try {
    $dbname = new PDO('mysql:host=localhost;dbname=last', 'ARIAS', 'ARIAS');
} catch (Exception $e) {
    //  Utilisation de la fonction integrée pour afficher le message et quitter le script php actuel 
    die('could not connect to database' . $e->getMessage());
}
