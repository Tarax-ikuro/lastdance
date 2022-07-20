<?php

require_once './config.php';

// Mise d'une condition sur des declarations de varialbes 
// Utilisation de la fonction isset stipulant si une variable est declarée et differente de null 
if (isset($_POST['email']) && isset($_POST['mdp'])) {



    // connexion à la base de données

    // on applique les  fonctions  htmlspecialchars
    // pour éliminer toutes attaques de type injection SQL et XSS
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);

    // $pseudo = htmlspecialchars($_POST['pseudo']);






    // si les chant du formulaire ne sont pas vide on continue le processus 
    if (isset($email) && isset($mdp)) {

        // prepare la requete dans une variable pour appeler la donnée (1 seul ligne viendra) 

        //* signifie qu'on prend tous les élements  
        $requete = $dbname->prepare("SELECT * FROM users where email = ? ");


        // execution de la requete préparée au dessus 
        $requete->execute(array($email));


        // transformer le retour en tableau 
        //Recuperer toutes les lignes et transformer le jeu de résultats sous forme de tableau

        $reponse = $requete->fetchAll();


        // vérification du mot de passe en variable -> verifie que le hachage fourni correspond bien au mdp fourni 
        // verification de la signature 
        $verifPwd = password_verify($mdp, $reponse[0]['mdp']);





        // Si le mot de passe et l'émail sont bons alors on continue le processus 
        if ($verifPwd == true && ($email == $reponse[0]['email'])) // nom d'utilisateur et mot de passe correctes

        {
            // $_SESSION['email'] = $email;
            session_start();
            $_SESSION['id'] = $reponse[0]['id_users'];
            $_SESSION['role'] = $reponse[0]['type'];



            // Selon le traitement des données, renvoie à la page correspondante que ce soit admin et user 
            // if ($reponse[0]->type == 'admin') {
            //     header('Location: ./contact.php');

            if ($reponse[0]['type'] == 'user') {
                header('Location:./index.php');

                // execution d'une instruction après un if dans le cas ou le if precedant est évalué comme false      
            } else {
                header('Location:./index.php');
            }


            // Selon les conditions activés redirection vers les pages correpsondantes 
        } else {
            header('Location:index.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
        // Selon les conditions activés redirection vers les pages correpsondantes

        // Selon les conditions activés redirection vers les pages correspondantes 
    } else {
        header('Location:index.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
