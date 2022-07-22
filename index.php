<?php
include("./lesdeux/header.php");
require 'config.php';
include_once("./list_traitement.php");


?>

<section class="textPresentation">
    <div class="prez">
        <h2>Bienvenue sur EZ Gourmet !</h2>

        <p>Vous trouverez ci dessous une liste de mes recettes crées que je partage à la communauté</p>
    </div>
    <div class="voicirec">
        <h3>Voici la liste des recettes postés </h3>
    </div>

    <div class="home">
        <!-- Mise en palce d'une boucle foreach recuperant les données des differents champs -->
        <?php foreach ($reponse as $requeteShow) :
        ?>
            <!-- <form action="./recette.php" method="POST"> -->

            <article class="cards">
                <!-- info publication  -->
                <!-- Mise en place de la balise titre permettant de mettre un titre  -->



                <!-- Mise en place d'une balise img src reprenant l'image stcocké dans un tableau  -->
                <img src="<?php echo $requeteShow['image'] ?>" class="imgtext">

                <div class="align">
                    <h1> <?php echo $requeteShow['titre'] ?></h1>

                    <p><?php echo $requeteShow['preparation'] ?> </p>

                    <p><?php echo $requeteShow['id_categorie'] ?> </p>



                    <!-- le reste  -->
                    <div class="show">
                        <!-- Mise en place d'uen redirection de lien vers le voir + en sauvegardant l'identifiant de l'article -->
                        <a href="./recette.php?id=<?php echo $requeteShow['id_article'] ?>"><button type="submit" name=""> Voir plus</button></a>

                        <hr>
                        <!-- </form> -->
                    </div>
                </div>









            <?php endforeach ?>
            </article>
    </div>
    <?php
    include("./lesdeux/footer.php");
    ?>