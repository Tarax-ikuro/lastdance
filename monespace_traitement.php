<?php

require 'config.php';


// Detection de la session par la mise en place d'une condition stipulant le role de la personne connété 
// Exectution du paramèretre avec la msie en place d'une condition reprenant la session qui stock la variable
if (($_SESSION["role"] == "admin") || ($_SESSION["role"] == "user")) {

    if (!isset($_SESSION['id'])) {

        header('Location: index.php');
        exit;
    }

    //On récupèere les données les informations de l'utilisateur connecté 
    $afficher_profil = $dbname->prepare('SELECT * FROM users WHERE id_users =? ');

    // On execute le tout 
    $afficher_profil->execute([$_SESSION['id']]);

    //  On fetch le tout en récupérant les lignes de l'ensemble des resultats
    $afficher_profil = $afficher_profil->fetchAll();

    // Mise en place d'une solution de redirection en cas de non execution du script
} else {
    header('Location:./index.php');
}
