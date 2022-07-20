<?php
include("./lesdeux/header.php");
require 'config.php';
include_once("./list_traitement.php");

?>

<!-- Mise en palce d'une boucle foreach recuperant les données des differents champs -->
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
                <a href="./recette.php?id=<?php echo $requeteShow['id_article'] ?>"><button type="submit" name=""> Voir plus</button></a>

                <hr>
                <!-- </form> -->

            </div>









        <?php endforeach ?>
    </article>

    <?php
    include("./lesdeux/footer.php");
    ?>