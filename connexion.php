<?php

require_once("./lesdeux/header.php");
require 'config.php';
require("./connexion_traitement.php");


?>
<!--  Utilisation de la session permettant de modifier des variables globales qui permet de lire les informations sauvegardés en session
 Elle fonctionne comme un tableau -->
<script src="./script.js" async></script>
<!-- Utilisation d'<article> destinée à être distribuée ou réutiliser de manière indépendante -->
<div class="register">
    <!-- Ajout de h2 pour dimensionner une taille de police équivalente à un titre -->
    <h2>Connexion</h2>
    <!-- Utilisation de l'élément form afin de créer un formulaire contenant des intéractions permettant à l'admin de fournir des informations  -->
    <form action="./connexion_traitement.php" method="POST">
        <!-- Utilisation d'<input> permettant à l'admin de saisir des données dependant de la valeur indiquée dans son attribut type  -->
        <!-- Utilisation de la balise div stipulant une separation entre les corps de la page  -->
        <div class="loger">
            <input type="email" name="email" placeholder="Entrez l'adresse email">
            <input type="password" name="mdp" placeholder="Entrez le mode de passe">
            <button onclick="alert('bonjour! Vous êtes bien connecté')" button="connexion" class="btn">Connexion</button>
        </div>
        <!-- Utilisation d'<button> permettant de soumettre des formulaires n'importe oudans un doc -->

</div>
</div>

<?php
require_once("./lesdeux/footer.php");
?>