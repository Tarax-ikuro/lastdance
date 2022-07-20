<?php
require_once './config.php';


// prepare la requete 
// on crée une requete qu'on nomme show on l'egalise à notre base de donée nommé $dbname.
$requeteShow = $dbname->prepare('SELECT id_article,titre,contenu,image,id_categorie,id_users FROM article');

// on execute,contenu,idCategorie,idUserute la requete crée precedemment  
$requeteShow->execute();
$reponse = $requeteShow->fetchAll();
