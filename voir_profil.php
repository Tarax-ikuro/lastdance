<?php
include("./lesdeux/header.php");
require 'config.php';


// Mise en place d'une condition detectant la session 
// si la variable n'est pas defini alors il y a une redirection vers la page principale

if (($_SESSION["role"] == "admin") || ($_SESSION["role"] == "user")) {




    // Mise en place d'une condition = stipulant l'affichage de l'utilisateur selectionné
    $afficher_profil = $dbname->prepare('SELECT * FROM users WHERE id_users = :id_users');

    // On execute la requete 
    $afficher_profil->execute(array(":id_users" => $_SESSION['id']));


    $fin = $afficher_profil->fetch(PDO::FETCH_ASSOC);
    $p = 0;
    // Mise en place d'une condition stipulant la non déclaration de la variable après le processus de preaparation et d'execution de la requete  


}

//////////////////////////////////////////////////////////////////////
///////////////////////////PAGE///////////////////////////
///////////////////////////////////////////////////////////////////////


?>





<body>
    <div class="title">
        <h2>Voici le profil de : <?= $fin['prenom'] . " " . $fin['nom']; ?> </h2>
    </div>
    <div class="state">Information sur son profil : </div>

    <div class="perso">

        <ul>
            <li>Ton id est : <?= $fin['id_users'] ?></li>
            <li>Ton email est :<?= $fin['email'] ?></li>
            <li>Ton mot de passe est : <?= $fin['mdp'] ?></li>
            <li>Ta ville est :<?= $fin['ville'] ?></li>
            <li>Ton code postale est: <?= $fin['cp'] ?></li>
            <li>Ton pseudo est: <?= $fin['pseudo'] ?></li>

        </ul>



    </div>


</body>




</html>