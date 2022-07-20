<?php
include("./lesdeux/header.php");
require 'config.php';
include_once("./list_traitement.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATION </title>
</head>

<body>

    <!-- Utilisation de la balise a suivi de la balise lien href permetteant une redirection vers des pages  -->
    <h3>Voici ta page administration </h3>

    <!-- Mise en place de la balise de liste ul ainsi que <li> qui represente un élément dans une liste-->
    <ul>
        <li><a href="./addart.php">Ajouter une recette</a>

        <li><a href="./modart.php">Modifier une recette</a>

        <li><a href="./delart.php">Supprimer une recette</a>

        <li><a href="./modprofil.php">Modifier son profil</a>

        <li><a href="./monespace.php">Voir mes informations</a>

    </ul>

    <?php foreach ($reponse as $requeteShow) :
    ?>
        <!-- <form action="./recette.php" method="POST"> -->

        <article class="cards">
            <!-- info publication  -->
            <!-- Mise en place de la balise titre permettant de mettre un titre  -->

            <h2>Voici la liste des recettes postés </h2>

            <!-- Mise en place d'une balise img src reprenant l'image stcocké dans un tableau  -->
            <img src="<?php echo $requeteShow['image'] ?>" class="imgtext">


            <h2> <?php echo $requeteShow['titre'] ?></h1>

                <p><?php echo $requeteShow['contenu'] ?> </p>

                <p><?php echo $requeteShow['id_categorie'] ?> </p>



                <!-- le reste  -->
                <div class="show">
                    <!-- Mise en place d'uen redirection de lien vers le voir + en sauvegardant l'identifiant de l'article -->
                    <a href="./recette.php?id=<?php echo $requeteShow['id_article'] ?>"><button type="submit" name="">Voir plus</button></a>
                    <a href="./modart.php?id=<?php echo $requeteShow['id_article'] ?>"><button type="submit" name="">Modifier</button></a>

                    <hr>
                    <!-- </form> -->

                </div>









            <?php endforeach ?>
        </article>
</body>

</html>