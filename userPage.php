<?php
include("./lesdeux/header.php");
require 'config.php';
include_once("./list_traitement.php");
?>



<!-- Utilisation de la balise title permettant de metttre u ntitre -->
<title> MON ESPACE</title>
</head>

<body>

    <div class="members">
        <!-- Utilisation de la balise de  -->
        <h3> Voici ton espace <h3>
                <!-- Mise en place de la balise ul ainsi que li qui represente un élément dans une liste -->

                <ul>


                    <li><a href="./modprofil.php?id=<?php echo $_SESSION['id'] ?>">Modifier son profil</a>

                    <li><a href="./voir_profil.php?id=<?php echo $_SESSION['id'] ?>">Voir mes informations</a>

                </ul>

    </div>
    <?php foreach ($reponse as $requeteShow) :
    ?>
        <!-- <form action="./recette.php" method="POST"> -->
        <h2>Voici la liste des recettes postés </h2>
        <article class="cards">
            <!-- info publication  -->
            <!-- Mise en place de la balise titre permettant de mettre un titre  -->



            <!-- Mise en place d'une balise img src reprenant l'image stcocké dans un tableau  -->
            <img src="<?php echo $requeteShow['image'] ?>" class="imgtext">


            <h2> <?php echo $requeteShow['titre'] ?></h1>


                <div class="content">
                    <p><?php echo $requeteShow['contenu'] ?> </p>
                </div>
                <p><?php echo $requeteShow['id_categorie'] ?> </p>



                <!-- le reste  -->
                <div class="show">
                    <!-- Mise en place d'uen redirection de lien vers le voir + en sauvegardant l'identifiant de l'article -->
                    <a href="./recette.php?id=<?php echo $requeteShow['id_article'] ?>"><button type="submit" name="">Voir plus</button></a>


                </div>



            <?php endforeach ?>
        </article>

</body>

</html>