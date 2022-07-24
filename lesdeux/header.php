<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../script.js" async></script>

    <script src="https://kit.fontawesome.com/f00c55aea5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./ressources/styles/styles.css">

</head>

<header class="base">

    <nav>

        <a href="./index.php"><img src="/image/imagess.jpg" class="logo"></a>

        <div class="identification">
            <!--------------- MISE NE PLACE D'UNE SERIE D'INSTRUCTIONS STIPULANT LE ROLE DE LA PERSONNE CONNECTÉ  ---------->


            <!-- Mise en place d'une instruction  d'une condition pour admin -->
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>

                <p class="insc"><a href="./adminPage.php">Administration</a></p>
                <p class="insc"><a href="./deconnexion.php">Deconnexion</a></p>
                <p class="insc"><a href="./mesfav.php">Mes favoris</a></p>
                <p class="insc"><a href="./list.php">Recettes</a></p>


                <!-- Mise en place d'une instruction d'une condition pour user -->

            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user') : ?>
                <p class="insc"><a href="./userPage.php">Mon compte</a></p>
                <p class="insc"><a href="./deconnexion.php">Deconnexion</a></p>
                <p class="fav"><a href="./mesfav.php">Mes favoris</a></p>
                <p class="insc"><a href="./list.php">Recettes</a></p>


                <!-- Mise en place d'une éventualitée si ce n'est qu'un visiteur-->

            <?php elseif (!isset($_SESSION['role'])) : ?>
                <p class="insc"><a href="./inscription.php"> Inscription</a></p>
                <p class="insc"><a href="./connexion.php">Connexion</a></p>
                <p class="insc"><a href="a_propos.php">A propos</a></p>
                <p class="insc"><a href="./list.php">Recettes</a></p>
            <?php endif; ?>

        </div>
    </nav>

</header>