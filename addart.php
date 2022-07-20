<?php
include("./lesdeux/header.php");
require 'config.php';
require_once("./addart_traitement.php");



if ($_SESSION["role"] == "admin") {


?>
    <!--Utilisation d'<article> destiné à être distribuée iu réutiliser de manière independante  -->
    <article class="ajout">
        <!-- permettant à l'admin de fournir des informations -->
        <!-- 
        <form action="./addart_traitement.php" method="POST"> -->

        <!-- Utilisation de <div> pour diviser du contenu  -->
        <div>
            <form action="./addart_traitement.php" method="POST" enctype="multipart/form-data">>
                <input type="text" name="titre" placeholder="Titre">

                <textarea type="text" name="contenu" placeholder="Mettre le contenu"></textarea>

                <textarea type="text" name="preparation" placeholder="Ecrire les étapes de la préparation "></textarea>

                <textarea type="text" name="date_publication" placeholder="date de publication"></textarea>

                <input type="text" name="cuisson" placeholder="Temps de cuisson">

                <input type="text" name="nb_personnes" placeholder="Nombre de personnes">

                <textarea id="ing" name="ingredient" rows="5" cols="40">Ecrire la liste des ingrédients.</textarea>
                <label>Contenu:</label>
                <input type="text" name="contenu" placeholder="Contenu">



                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" name="submit">

                <input hidden type="text" name="id_users" value="<?= $_SESSION["id"] ?>">
                <input hidden type="text" name="id_article">

                <select name="id_categorie" id="menu">
                    <option value="1">Appertitf</option>
                    <option value="2">Plat</option>
                    <option value="3">dessert</option>

            </form>



            <!-- Utilisation de la balise select permettant de spumettre des formulaires -->




            </select>
            <input type="submit" value="Ajouter l'article">


        </div>


        </form>

    <?php
} else {
    ?>
        <p>Vous n'êtes pas autorisé à voir cette page</p>
    <?php
}
include("./lesdeux/footer.php");
    ?>