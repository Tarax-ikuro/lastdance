<?php

include "./lesdeux/header.php";
require 'config.php';


// Identification de la session à travers la mise ne place d'une condition 

if ($_SESSION["role"] == "admin") {


    if (isset($_POST) && isset($_POST['modart'])) {
        // PARTIE UPLOAD ============================================================================
        if ($_FILES['fileToUpload']['error'] == 0) {




            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            //$fileName = $_FILES["fileToUpload"]["name"];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                // Allow certain file formats
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
                    $uploadOk = 1;
                } else {
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $_SESSION['error'] = 'Type de fichier non supporter';
                    $uploadOk = 0;
                    header("Location: index.php?page=uploadP1");
                    exit;
                }
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['error'] = "Le fichier n'a pas pu être envoyé ";
                header("Location: index.php?page=uploadP1");
                exit;
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                    // echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                } else {
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $_SESSION['error'] = "Erreur d'envoie";
                    $uploadOk = 0;
                    header("Location: index.php?page=uploadP1");
                    exit;
                }
            }

            $sql = 'UPDATE article SET titre = :titre, contenu = :contenu, 
     preparation = :preparation, cuisson = :cuisson, nb_personnes = :nb_personnes, 
     ingredient = :ingredient, id_categorie = :id_categorie, id_users = :id_users, `image` = :fichier WHERE 
     id_article = :id_article';
            $data = array(
                ':titre' => htmlspecialchars(filter_input(INPUT_POST, 'titre')),
                ':contenu' => htmlspecialchars(filter_input(INPUT_POST, 'contenu')),
                ':preparation' => htmlspecialchars(filter_input(INPUT_POST, 'preparation')),
                ':cuisson' => htmlspecialchars(filter_input(INPUT_POST, 'cuisson')),
                ':nb_personnes' => htmlspecialchars(filter_input(INPUT_POST, 'nb_personnes')),
                ':ingredient' => htmlspecialchars(filter_input(INPUT_POST, 'ingredient')),
                ':id_categorie' => htmlspecialchars(filter_input(INPUT_POST, 'id_categorie')),
                ':id_users' => htmlspecialchars(filter_input(INPUT_POST, 'id_users')),
                ':id_article' => htmlspecialchars(filter_input(INPUT_POST, 'id_article')),
                ':fichier' => $target_file
            );
        } else {
            $sql = 'UPDATE article SET titre = :titre, contenu = :contenu, 
            preparation = :preparation, cuisson = :cuisson, nb_personnes = :nb_personnes, 
            ingredient = :ingredient, id_categorie = :id_categorie, id_users = :id_users WHERE 
            id_article = :id_article';
            $data = array(
                ':titre' => htmlspecialchars(filter_input(INPUT_POST, 'titre')),
                ':contenu' => htmlspecialchars(filter_input(INPUT_POST, 'contenu')),
                ':preparation' => htmlspecialchars(filter_input(INPUT_POST, 'preparation')),
                ':cuisson' => htmlspecialchars(filter_input(INPUT_POST, 'cuisson')),
                ':nb_personnes' => htmlspecialchars(filter_input(INPUT_POST, 'nb_personnes')),
                ':ingredient' => htmlspecialchars(filter_input(INPUT_POST, 'ingredient')),
                ':id_categorie' => htmlspecialchars(filter_input(INPUT_POST, 'id_categorie')),
                ':id_users' => htmlspecialchars(filter_input(INPUT_POST, 'id_users')),
                ':id_article' => htmlspecialchars(filter_input(INPUT_POST, 'id_article')),

            );
        }
        $requete = $dbname->prepare($sql);

        $requete->execute($data);
    }

    if (isset($_GET["id"])) {
        // Creation d'une varaible $requse
        // Mise en palce d'une reuqete préprarée avec utilisation de la requete SQL SELECT
        //    Utilisation de * stipulant la prise e ncompte de toutes les colones de la table users
        // Utilisation de ? stipulant la donnée entrée lors de la saisie
        // Utilisation de WHERE stipulant la cible id_users visée
        $idArticle = htmlspecialchars($_GET['id']);
        $requete = $dbname->prepare("SELECT * FROM article INNER JOIN categorie ON 
                                    article.id_categorie = categorie.id_categorie 
                                    WHERE id_article = ?");
        // ON execute la requete 
        // Execution de la requete avec le stockage de la session dans un tableau 
        $requete->execute(array($idArticle));
        // On termine l'execution avec en fetchant dans une variable
        $article = $requete->fetch();

        $requete = $dbname->prepare("SELECT * FROM categorie");
        $requete->execute();
        $categories = $requete->fetchAll();
    }

?>

    <html>

    <head>
        <!-- Utilisation de la balise tilte stipulant le caractère entrée comme étant un titre  -->
        <title>Modification du profil </title>
        <meta charset="utf-8">
    </head>

    <body>
        <article class="ajout">
            <!-- permettant à l'admin de fournir des informations -->
            <!-- 
        <form action="./addart_traitement.php" method="POST"> -->

            <!-- Utilisation de <div> pour diviser du contenu  -->
            <div>
                <form action="./modart.php?id=<?= $article["id_article"] ?>" method="POST" enctype="multipart/form-data">>
                    <input type="text" name="titre" placeholder="Titre" value="<?= $article['titre'] ?>">

                    <textarea type="text" name="contenu" placeholder="Mettre le contenu"><?= $article['contenu'] ?></textarea>

                    <textarea type="text" name="preparation" placeholder="Ecrire les étapes de la préparation "><?= $article['preparation'] ?></textarea>


                    <input type="text" name="cuisson" placeholder="Temps de cuisson" value="<?= $article['cuisson'] ?>">

                    <input type="text" name="nb_personnes" placeholder="Nombre de personnes" value="<?= $article['nb_personnes'] ?>">

                    <textarea id="ing" name="ingredient" rows="5" cols="40" placeholder="Ecrire la liste des ingrédients."> <?= $article['ingredient'] ?></textarea>



                    Selectionner une image à envoyer:
                    <input type="file" name="fileToUpload" id="fileToUpload">


                    <img src="<?php echo $article['image'] ?>" class="imgtext">



                    <input hidden type="text" name="id_users" value="<?= $_SESSION["id"] ?>">
                    <input hidden type="text" name="id_article" value="<?= $article["id_article"] ?>">
                    <input hidden type="text" name="modart">
                    <select name="id_categorie" id="menu">
                        <option value="<?= $article["id_categorie"] ?>"><?= $article["thème"] ?></option>
                        <?php
                        foreach ($categories as $categorie) {
                        ?>
                            <option value="<?= $categorie["id_categorie"] ?>"><?= $categorie["thème"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="submit" value="Modifier l'article">
                </form>



                <!-- Utilisation de la balise select permettant de spumettre des formulaires -->








            </div>


            </form>


    </body>

    </html>
<?php
} else {
    header("Location: connexion.php");
}

?>