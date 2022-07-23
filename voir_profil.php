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
<div class="perso">
    <title>Profil de l'utilisateur actuel </title>
    </head>
</div>

<body>
    <h2>Voici le profil de : <? echo $fin['prenom'] . " " . $fin['nom']; ?> </h2>
    <div>Information sur son profil : </div>
    <ul>
        <li>Ton id est : <?= $fin['id_users'] ?></li>
        <li>Ton email est :<?= $fin['email'] ?></li>
        <li>Ton mot de passe est : <?= $fin['adresse'] ?></li>
        <li>Ta ville est :<?= $fin['ville'] ?></li>
        <li>Ton code postale est: <?= $fin['cp'] ?></li>
        <li>Ton pseudo est: <?= $fin['pseudo'] ?></li>

    </ul>







</body>




</html>