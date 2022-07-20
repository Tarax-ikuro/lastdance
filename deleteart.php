<?php

include "./lesdeux/header.php";
require 'config.php';


if ($_SESSION["role"] == "admin") {

    if (isset($_GET["id"]) && isset($_GET["action"]) && $_GET['action'] == "delete") {
        // Creation d'une varaible $requse
        // Mise en palce d'une reuqete préprarée avec utilisation de la requete SQL SELECT
        // Utilisation de * stipulant la prise e ncompte de toutes les colones de la table users
        // Utilisation de ? stipulant la donnée entrée lors de la saisie
        // Utilisation de WHERE stipulant la cible id_users visée
        $idArticle = htmlspecialchars($_GET['id']);
        $requete = $dbname->prepare("DELETE FROM article WHERE id_article = ?");
        // ON execute la requete 
        // Execution de la requete avec le stockage de la session dans un tableau 
        $requete->execute(array($idArticle));
        // On termine l'execution avec en fetchant dans une variable
        header('location:./adminPage.php');
        exit();
    }
}
