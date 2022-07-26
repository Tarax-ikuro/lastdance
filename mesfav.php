<?php
include("./lesdeux/header.php");
require 'config.php';



if (($_SESSION["role"] == "admin") || ($_SESSION["role"] == "user")) {



    $requete = $dbname->prepare('SELECT * FROM users_has_article INNER JOIN article ON
 users_has_article.id_article = article.id_article INNER JOIN categorie ON 
 article.id_categorie = categorie.id_categorie WHERE users_has_article.id_users = :id_users');
    $requete->execute(array(":id_users" => $_SESSION['id']));
    $mesfav = $requete->fetchall(PDO::FETCH_ASSOC);
    $t = 0;

?>
    <div class="favi">
        <h2>Ma liste de recettes favorites </h2>
    </div>
    <table>
        <thead>

            <tr>
                <th>
                    Nom de la recette
                </th>
                <th>
                    Thèmes
                </th>
            </tr>

        </thead>
        <tbody>

            <?php
            foreach ($mesfav as $monfav) {
            ?>
                <tr>
                    <td><?= $monfav['titre'] ?></td>
                    <td><?= $monfav['thème'] ?></td>
                </tr>

            <?php
            }
            ?>

        </tbody>


    </table>
<?php
} else {
    header('location:./index.php');
}

require_once("./lesdeux/footer.php"); ?>