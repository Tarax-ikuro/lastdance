<?php
include("./lesdeux/header.php");
require 'config.php';
include("./monespace_traitement.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil</title>
</head>

<body>
    <form>


        <h2>Voici le profil de <? $afficher_profil['prenom'] . $afficher_profil['nom']; ?></h2>
        <!-- Afficher les coordonnées de la personne -->
        <input type="texte" id="name" name="prenom" value="<?= $afficher_profil['prenom'] ?>">
        <input type="texte" id="name" name="nom" value="<?= $afficher_profil['nom'] ?>">

        <ul>
            <!-- Utilisation de l'input de type hidden afin de masquer les informations -->
            <input type="hidden" id="name" name="name" value="<?= $afficher_profil['id_users'] ?>">

            <!-- Utilisation de l'élément d'input ayant ppour valeur une variable  -->
            <li>Votre pseudo est </li>
            <input type="texte" id="name" name="name" value="<?= $afficher_profil['pseudo'] ?>">


            <li>Votre adresse émail est </li>
            <input type="texte" id="name" name="name" value="<?= $afficher_profil['email'] ?>">

            <!-- Utilisation de l'input ayant pour valeu une variable -->
            <li>Votre adresse est </li>
            <input type="texte" id="name" name="name" value="<?= $afficher_profil['adresse'] ?>">

            <!-- Utilisation de l'input ayant  -->
            <li>Votre ville est </li>
            <input type="texte" id="name" name="name" value="<?= $afficher_profil['ville'] ?>">

            <li>Votre code postal est </li>
            <input type="texte" id="name" name="name" value="<?= $afficher_profil['cp'] ?>">

            <li>Votre type est </li>
            <input type="texte" id="name" name="name" value="<?= $afficher_profil['type'] ?>">



    </form>

    </ul>
</body>

</html>