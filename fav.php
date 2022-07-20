<?php
include(".lesdeux/header.php");
require 'config.php';
include('./favrec_traitement.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Utilsiation de l'encoddage Utf-8 pour coder l'ensemble des caractères  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mes recettes favorites</title>




</head>

<body>
    <!-- Utilisasation de la balise form representant  un formulaire permettant à l'utilisateur  de foournir des informations -->

    <form>
        <h2> Voici la liste de mes recettes favorites</h2>
        <!-- LISTE -->
        <!-- Affichage des informations sous forme d'une lise via la balsie ul -->
        <?php
        foreach ($afficher_favoris as $elem) : ?>

            <!-- Utilisation de m'element input ayant pour valeur une variable stockabt le contenant l'élément id-favoris de la bdd -->
            <img src="<?php echo $elem['image'] ?>">

            <!-- Utilisation de la lbalise h5 stipulant la taille de la police  -->

            <h5>Titre: <?php echo $elem['titre'] ?></h5>
            <!-- Utilisation d'echo afficant le resultat des éléments choises-->
            <p class="text-center">Nombre de personnes <?= $elem['nb_personnes'] ?></p>
            <p class="text-center">Cuisson <?= $elem['cuisson'] ?></p>




    </form>

    <!-- Marquage de fin la boucle endforeach -->
<?php endforeach ?>