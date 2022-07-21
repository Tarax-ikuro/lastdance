<?php

include("./lesdeux/header.php");
require 'config.php';


// On met en place une condition rde role 

if (($_SESSION["role"] == "admin") || ($_SESSION["role"] == "user")) {
    // ACTION DE FAV qunad je clique sur le bouton favoris article favoris du users verefication si ce n'est pas le cas il renvoie false si il est plus grand que 0 alros on delete et donc si il n'est pas le plus grand je l'insert 
    if (isset($_GET['id']) && isset($_GET["action"]) && $_GET['action'] == 'fav') {
        $idArticle = htmlspecialchars($_GET['id']);
        $requete = $dbname->prepare('SELECT * FROM users_has_article WHERE id_users = :id_users AND id_article = :id_article');
        $requete->execute(array(
            'id_users' => $_SESSION['id'],
            'id_article' => $idArticle
        ));
        $favoris = $requete->fetch();

        if (is_array($favoris) && count($favoris) > 0) {

            $requete = $dbname->prepare("DELETE FROM users_has_article WHERE id_users = :id_users AND id_article = :id_article");
            $requete->execute(array(
                'id_users' => $_SESSION['id'],
                'id_article' => $idArticle
            ));
        } else {
            $requete = $dbname->prepare("INSERT INTO users_has_article ( id_users,id_article ) VALUES (:id_users,:id_article)");
            $requete->execute(array(
                'id_users' => $_SESSION['id'],
                'id_article' => $idArticle
            ));
            $e = $requete->errorinfo();
        }
    }
    // Afficahge d'article 
    if (isset($_GET["id"])) {

        $idArticle = htmlspecialchars($_GET['id']);
        // On prepare la requete 
        $requete = $dbname->prepare("SELECT * FROM article INNER JOIN categorie ON 
                                        article.id_categorie = categorie.id_categorie 
                                        WHERE id_article = ?");
        // ON execute la requete 
        // Execution de la requete avec le stockage de la session dans un tableau 
        $requete->execute(array($idArticle));
        // On termine l'execution avec en fetchant dans un tableau associatif si je donne pas d'arguments donc pas d'index mais leresultat avec ne nom des colonnes vec leurs valuers 
        $article = $requete->fetch(PDO::FETCH_ASSOC);

        $requete = $dbname->prepare('SELECT * FROM users_has_article WHERE id_users = :id_users AND id_article = :id_article');
        $requete->execute(array(
            'id_users' => $_SESSION['id'],
            'id_article' => $idArticle
        ));
        $favoris = $requete->fetch();
        //   Je verrife la table favoris par rapport à l'artcile et le user 
        if (is_array($favoris) && count($favoris) > 0) {
            $isFav = 'fas fa-heart';
        } else {
            $isFav = "far fa-heart";
        }
    }


?>

    <section class="section_recette">

        <div class="mainRecette">
            <div class="titre">
                <h2><?= $article["titre"] ?></h2>
                <h3><?= $article["thème"] ?></h3>
            </div>
            <div class="imgBox">
                <img src="<?php echo $article['image'] ?>">
            </div>
            <div class="prepa">

                <img src="photos/toque.png" id="toque">

                <p>Difficulté:<?php echo $article['preparation'] ?></p>

                <i class="fa-solid fa-hourglass"></i>
                <p>Durée de la cuisson<?php echo $article['cuisson'] ?></p>


                <i class="fa-solid fa-user"></i>
                <p><?php echo $article['nb_personnes'] ?></p>
            </div>
            <div class="prepa2">
                <div>
                    <i class="fa-solid fa-clipboard"></i>
                    <p>Préparation</p>
                    <p><?php echo $article['ingredient'] ?></p>
                </div>
                <div>
                    <img src="photos/carnet.jpg" id="carnet">
                    <p><?php echo $article['contenu'] ?></p>
                </div>
            </div>
            <div class="favoris">
                <div class="text">
                    <p>Favoris</p>
                </div>
                <div class="icon">
                    <a href="./recette.php?id=<?= $article['id_article'] ?>&action=fav"><i class="<?= $isFav ?>"></i></a>
                </div>

            </div>
        </div>

    </section>


<?php
} else {
    header('Location:./index.php');
}
?>



<?php

include("./lesdeux/footer.php")
?>