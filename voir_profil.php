<?php
include("./lesdeux/header.php");
require 'config.php';


// Mise en place d'une condition detectant la session 
// si la variable n'est pas defini alors il y a une redirection vers la page principale

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}



// Récuperation de l'id passer en argumentent l'URL 
// On récupère les informations de l'utilisateur grâce à son ID
$id = $_GET['id'];



// Mise en place d'une condition = stipulant l'affichage de l'utilisateur selectionné
$afficher_profil = $dbname->prepare('SELECT * FROM users WHERE id_users = ?');

// On execute la requete 
$afficher_profil->execute([$id]);

// On fetch les requêtes precedentes 
$fin = $afficher_profil->fetch();

// Mise en place d'une condition stipulant la non déclaration de la variable après le processus de preaparation et d'execution de la requete  

if (!isset($afficher_profil['id'])) {
    header('Location: index.php');
    exit;
}


//////////////////////////////////////////////////////////////////////
///////////////////////////PAGE///////////////////////////
///////////////////////////////////////////////////////////////////////


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'utilisateur actuel </title>
</head>

<body>
    <h2>Voici le profil de <?= $afficher_profil['prenom'] . " " . $afficher_profil['nom']; ?> </h2>
    <div>Information sur son profil : </div>
    <ul>
        <li>Ton id est : <? $afficher_profil['id_users'] ?></li>
        <li>Ton email est :<?= $afficher_profil['email'] ?></li>
        <li>Ton mot de passe est : <?= $afficher_profil['adresse'] ?></li>
        <li>Ta ville est :<?= $afficher_profil['ville'] ?></li>
        <li>Ton code postale est: <?= $afficher_profil['cp'] ?></li>
        <li>Ton pseudo est: <?= $afficher_profil['pseudo'] ?></li>

    </ul>







</body>




</html>