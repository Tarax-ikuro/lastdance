<?php
include("./lesdeux/header.php");
require 'config.php';
require_once("./addart_traitement.php");

$requete = $dbname->prepare("SELECT * FROM categorie");
$requete->execute();
$categories = $requete->fetchAll();

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

                <input type="date" name="date_publication" placeholder="date de publication" value="<?= $article['date_publication'] ?>">

                <input type="text" name="cuisson" placeholder="Temps de cuisson">

                <input type="text" name="nb_personnes" placeholder="Nombre de personnes">

                <textarea id="ing" name="ingredient" rows="5" cols="40" placeholder="Ecrire la liste des ingrédients."></textarea>
                <label>Contenu:</label>
                <input type="text" name="contenu" placeholder="Contenu">



                Selectionner une image à envoyer:
                <input type="file" name="fileToUpload" id="fileToUpload">

                <input hidden type="text" name="id_users" value="<?= $_SESSION["id"] ?>">
                <input hidden type="text" name="id_article">
                <input hidden type="text" name="addart">
                <select name="id_categorie" id="menu">
                    <?php
                    foreach ($categories as $categorie) {
                    ?>
                        <option value="<?= $categorie["id_categorie"] ?>"><?= $categorie["thème"] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="submit" value="Ajouter l'article">
            </form>



            <!-- Utilisation de la balise select permettant de spumettre des formulaires -->








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