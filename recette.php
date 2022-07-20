<?php

include("./lesdeux/header.php");
require 'config.php';


// ON recupeère l'id 


// On crée une variable dans laquelle on stack la méthode GET dans laquelle on pour paramètre l'id 
$sql =  'SELECT id_article,titre,contenu,image FROM `article` WHERE id_article = ?';
// Requete préparée avec requete SQL SELECT pour selecitonner une serie de données
$reponse = $dbname->prepare('SELECT id_article,titre,contenu,image FROM article WHERE id_article = ?');
$reponse->execute([$id]);
$fin = $reponse->fetch();

if (($_SESSION["role"] == "admin") || ($_SESSION["role"] == "user")) {

?>




    <section class="section_recette">
        <img src="<?php echo $fin['image']; ?>">
        <p>
            <?php
            echo $fin['contenu'];
            ?>
        <h2> <?php echo $fin['titre'] ?></h2>

        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam modi placeat est aliquam earum recusandae, debitis doloribus ratione architecto, vitae ex quibusdam. Dolorum molestiae
        praesentium, eos veniam numquam sint ex!
        </p>
        <hr>
        <input type="submit" value="Voir plus">


        <form action=".recette_traitement.php" method="GET">
            <h3>laisser un commentaire</h3>
            <!--Utilisation de <input> permettant à l'admin de saisir des données dependant de la valuer indiquée dans son attribut type   -->
            <input type="text" name="id_article" placeholder="pseudo">

            <textarea name="texte" name="texte" cols="30" rows="10" placeholder="Mettre un commentaire"></textarea>


            <input type="submit" value="Envoyer">

            <!-- Mise en place d'un input hidden correspondant à la de à la detection du role pendant la session " -->

            <input hidden type="text" name="id_users" value="<?= $_SESSION["id"] ?>">

        </form>



        <img src="images/<?php echo $reponse['image']; ?>">
        <h4>Nulla gravida condimentum justo nec rhoncus</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae illum doloribus expedita laboriosam, temporibus vel architecto molestiae fugit nisi nesciunt officiis aperiam nulla,
            fugiat incidunt error consectetur molestias non distinctio.</p>
        <button type="submit" action="voir" class="button"><a class="voir" href="recette.php">Voir plus</a></button>
    </section>

    </main>
<?php
} else {
    header('Location:./index.php');
}
?>



<?php

include("./lesdeux/footer.php")
?>