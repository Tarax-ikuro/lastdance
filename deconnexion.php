<?php
// démarre une nouvelle session ou reprned une session existante
session_start();

// Détruit une session existante.
session_destroy();
//  Dans ce cas de figure destruction de la session donc destruction du cookie à une periode donnée. 
setcookie('utilisateur', 'id_users', time() + 60 * 60 * 24 * 30);
// Redirection vers la page d'accueil 
header("Location:./index.php");
exit();
