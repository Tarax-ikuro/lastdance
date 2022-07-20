<?php
require_once "./config.php";


// Mise en place des conditions prenant en compte les differents champs 
if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['cp']) && isset($_POST['pseudo'])) {

    // mise en place des specialchars convertissants des caractères spéciaux en php 
    // Transmission des infos du formulaire de manière masquée avec $_POST
    //  Utilisation des htmlspecialchars evitant les injections xss 
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $cp = htmlspecialchars($_POST['cp']);
    // $type = htmlspecialchars($_POST['type']);
    $pseudo = htmlspecialchars($_POST['pseudo']);


    //Declaration d'une variable ayant pour valeur un tableau stockant une limitaiton de caractère utilisé pendant l'entrée du mot de passe 
    $option = ['cost' => 12,];

    //Utilisation de hachage permettant une securitée optimale  optimale des mots de passe.Genreation d'une suite de caractère unique et aléatoire
    $hash = password_hash($mdp, PASSWORD_BCRYPT, $option);


    // prepare la requete 
    $requete = $dbname->prepare('SELECT prenom,nom,email,mdp,adresse,ville,cp,type,pseudo FROM users WHERE email = :email');
    //execute la requete 
    $requete->execute(['email' => $email]);

    //transforme le retour en tableau 
    $reponse = $requete->fetchAll();
    //verifiation du mot de passe en variable 
    $verifUser = count($reponse);

    if ($verifUser == 0) {
        // verification si l'utilisateur existe 
        //Utilisation de la requete INSERT afin de récuprer les données remplis precedemment

        $requeteInscription = "INSERT INTO users(prenom,nom,email,mdp,adresse,ville,cp,type,pseudo) VALUES (:prenom, :nom, :email, :mdp, :adresse, :ville, :cp, :type , :pseudo)";

        //TEST 
        $requete = $dbname->prepare($requeteInscription);

        // SI SUCCES ALORS LOGIN ()
        $_SESSION['login'] = 1;


        //Requete executé sous forme de tableau 
        $requete->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'mdp' => $hash,
            'adresse' => $adresse,
            'ville' => $ville,
            'cp' => $cp,
            'type' => 'user',
            'pseudo' => $pseudo
        ]);
        $test = $requete->errorInfo();
        header('location:./connexion.php?succes');
    } else {

        // SI NON FAIL  //Si echec de l'inscription redirection vers la page d'accueil 
        $_SESSION['erreur'] = 2;
        header('location:./inscription.php.?erreur3');
    }
}
