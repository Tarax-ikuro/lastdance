<?php

include("./lesdeux/header.php");
require 'config.php';


// ON recupeère l'id 

if (($_SESSION["role"] == "admin") || ($_SESSION["role"] == "user")) {
    if (isset($_GET["id"])) {
        $idArticle = htmlspecialchars($_GET['id']);
        $requete = $dbname->prepare("SELECT * FROM article INNER JOIN categorie ON 
                                        article.id_categorie = categorie.id_categorie 
                                        WHERE id_article = ?");
        // ON execute la requete 
        // Execution de la requete avec le stockage de la session dans un tableau 
        $requete->execute(array($idArticle));
        // On termine l'execution avec en fetchant dans une variable
        $article = $requete->fetch(PDO::FETCH_ASSOC);

        $requete = $dbname->prepare('SELECT * FROM users_has_article WHERE id_users = :id_users AND id_article = :id_article');
        $requete->execute(array(
            'id_users' => $_SESSION['id'],
            'id_article' => $idArticle
        ));
        $favoris = $requete->fetch();
        if (is_array($favoris) && count($favoris) > 0) {
            $isFav = "far fa-heart";
        } else {
            $isFav = 'fas fa-heart';
        }
    }
    if (isset($_GET['id']) && isset($_GET["action"]) && $_GET['action'] == 'fav') {
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
                <p><?php echo $article['preparation'] ?></p>
                <p><?php echo $article['cuisson'] ?></p>
                <p><?php echo $article['nb_personnes'] ?></p>
            </div>
            <div class="prepa2">
                <div>
                    <p><?php echo $article['ingredient'] ?></p>
                </div>
                <div>
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