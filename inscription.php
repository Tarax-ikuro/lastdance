<?php

include("./lesdeux/header.php");
require 'config.php';
include_once("./inscription_traitement.php");

?>
<!--  utilisation d'article> destiné à être distribué ou réutiliser de manière independante -->

<!-- <article class="mb-3"> -->
<div class="inscription">
    <!-- Ajout de h2 pour dimensionner une taille de police équivalent à un tritre  -->
    <h2>Inscription</h2>
    <p>Veuillez remplir les champs</p>
    <!-- utilisation de l'élément form afin de créer un formulaire contenant des ibtréractions permettant à l'admin de fournir des informations -->

    <!--Utilisation de la methode POST qui envoie des données au serveur   -->
    <form action="./inscription_traitement.php" method="POST">


        <!-- utilistion de <div> pour diviser du contenu -->
        <div class="champs">
            <!-- Mise en place de la balise id pour pouvoir récuperer le ping dans le css  -->
            <!-- Utilisation d'<input> permettant de saisir des données dependant de la valeur indiquée dans son attribut type  -->
            <input type="text" id="name" name="prenom" placeholder="Prenom">

            <input type="text" id="name" name="nom" placeholder="Nom">


            <input type="email" id="name" name="email" placeholder="Email">

            <input type="password" id="name" name="mdp" placeholder="Mot de passe">

            <input type="text" id="name" name="adresse" placeholder="Adresse">

            <input type="text" id="name" name="ville" placeholder="ville">

            <input type="text" id="name" name="cp" placeholder="Code Postal">

            <input type="text" id="name" name="pseudo" placeholder="Pseudo">

            <!-- <input type="text" name="status" placeholder="Status"> -->
            <button class="submit" class="btn btn-primary btn-block">Inscription</button>

        </div>
        <!-- l'utilisation de <button> permettant de soumettre des formulaires n'importe ou ou n'importe ou dans le document -->




    </form>
</div>

</div>

<?php
include("./lesdeux/footer.php");
?>