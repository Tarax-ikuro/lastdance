<?php

require './config.php';

// Detection de la session en cours 
// Mise en place d'une condition stipulant la deteection du role de la session dans ce cas de figure soit utilisateur soit administrateur

if (($_SESSION["role"] == "user") || ($_SESSION["role"] == "admin")) {

    // Mise en place d'une condition dans une autre condition 
    if (!isset($_SESSION['id'])) {
        header('Location:index.php');
        exit;
    }
    //    On recupère les informations de l'article par l'utilsiatuer
    // Utilisation de la requete SQL INNER JOIN stipulant le lien entre deux tables
    // On prepare la requête 
    $afficher_favoris = $dbnmae->prepare('SELECT * users INNER JOIN article ON users.id_users = article.id_users  = ' . $_SESSION['id']);


    // On execute les variables et la valeur de retour en tableau 
    $afficher_favoris->executre();

    // On fetch le tout 
    $afficher_favoris->fetchAll();
} else {
    header('location: ./index.php');
}
