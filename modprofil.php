<?php

include "./lesdeux/header.php";
require 'config.php';


// Identification de la session à travers la mise ne place d'une condition 

if ($_SESSION["role"] == "user" || $_SESSION["role"] == "admin") {

    if (isset($_SESSION["id"])) {
        // Creation d'une varaible $requse
        // Mise en palce d'une reuqete préprarée avec utilisation de la requete SQL SELECT
        //    Utilisation de * stipulant la prise e ncompte de toutes les colones de la table users
        // Utilisation de ? stipulant la donnée entrée lors de la saisie
        // Utilisation de WHERE stipulant la cible id_users visée
        $requser = $dbname->prepare("SELECT * FROM users WHERE id_users = ?");

        // ON execute la requete 
        // Execution de la requete avec le stockage de la session dans un tableau 
        $requser->execute(array($_SESSION['id']));

        // On termine l'execution avec en fetchant dans une variable
        $user = $requser->fetch();
    }




    // -----MODIFICATION DU PRENOM-----

    // Mise en place d'une condition cde declaration de variable avec la fonction isset
    // Utilsiation de !empty specifiant le caractère non vide des variables
    if (isset($_POST['newprenom']) && !empty($_POST['newprenom']) && $_POST['newprenom'] != $user['prenom']) {

        // Creaton d'une nouvelle variable prenat en compte la fonction cnvertissantles caractères speciaux en entités html
        $newprenom = htmlspecialchars($_POST['newprenom']);
        // 
        // Creation d'une variable prenant en compte la requete preparée 
        // Mise en place de la requete preparé avec utilisation de la requete SQL UPDATE
        // Utilisation de ? stipulant une donnée entrée lors de la saisie 
        //  Utilisation de * stipulant la prise en compte de toutes les colones de la table users
        $insertprenom = $dbname->prepare("UPDATE users SET prenom =? WHERE id_users =?");

        // Execution de la requete sous forme de tableau + concatenation avec la variable de session 
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        header('Location: monespace.php?id=' . $_SESSION['id']);
    }



    // -----MODIIFCATION DU NOM ------

    // Mise en place d'une condition cde declaration de variable avec la fonction isset
    // Utilsiation de !empty specifiant le caractère non vide des variables
    if (isset($_POST['newnom']) && !empty($_POST['newnom']) && $_POST['newnom'] != $user['nom']) {

        // Creation d'une nouvelle variable  prenant en compte le convertisseur htmlsepcialhars en entités html 

        $newnom = htmlspecialchars($_POST['newnom']);

        // Creation d'une variable prenant en compte la requete préparée 
        //    Utilsiation de la requete SQL Update permettant de mettre à jour les 
        $insertnom = $dbname->prepare("UPDATE users SET nom =? WHERE id_users=?");

        // Exectution de la requete sous forme de tableau + concatenation avec la session 
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header('Location: monespace.php?id=' . $_SESSION['id']);
    }






    //--- MODIFICATION DE L'ADRESSE EMAIL----


    //Mise en place d'une condition de declaration de variable avec la foncton isset 
    // Utilisaton de !empty specifiant le caractère non vide des variables
    if (isset($_POST['newemail']) && !empty($_POST['newemail']) && $_POST['newemail'] != $user['email']) {

        // Creation d'une nouvelle variable prenant en compte le convertisseur htmlspecialchars en entités html
        // Execution de la requete sous 

        $newemail = htmlspecialchars($_POST['newemail']);

        // Creation d'une variable prenant en compte la la reuqqete prépraée 
        // Utilisation de la requete SQL UPDATE permettant de mettre à jour les lignes existantes
        $insertionemail = $dbname->prepare("UPDATE users SET email=? WHERE id_users=?");

        // Execution de la requete sous forme de tableau + concatenation de la sesssion 

        $insertionemail->execute(array($newemail, $_SESSION['id']));
        header('Location: monespace.php?id=' . $_SESSION['id']);
    }



    //------- MODFICATION DE L'ADRESSE ------
    // Mise en palce d'une condition de déclaration de variable avec la fonction isset



    // Utilisation de la fonction filter_input permettant de recuperer une variable externe et la filtrer
    // Utilisation de la constante INPUT_POST et la variable récupérée "adresse"
    if (filter_input(INPUT_POST, "adresse")) {

        $newadresse = htmlspecialchars(filter_input(INPUT_POST, "adresse"));

        // Creation d'une variable prenant en compte la requeéte préparée 
        // Utilsation de requete SQL UPDATE permettant de mettre à jpour les lignes existantes
        $insertadresse = $dbname->prepare("UPDATE users SET adresse=? WHERE id_users=?");

        // Execution de la requete sous forme de tableau + concatenation de la session
        $insertadresse->execute(array($insertadresse, $_SESSION['id']));
        header('Location: monespace.php?id=' . $_SESSION['id']);
    }


    //----MODIFICATION DE LA VILLE------
    // Mise en place de la condition de recupération de la variable externe 

    // Utilisation de la fonction filter_input permettant de recuperer une variable externe et la filtrer
    // Utilisation de la  constante INPUT_POST et la variable récuprée ville 
    if (filter_input(INPUT_POST, "ville")) {

        $newville = htmlspecialchars(filter_input(INPUT_POST, "ville"));
        // Creation d'une variable $insertville prenant en compte la requete preparée 
        // Utilisation de la requete SQL permettant de mettre à jour les lignes existantes 
        $insertville = $dbname->prepare("UPDATE users SET ville=? WHERE id_users=?");

        // Execution de la requete sous forme de tableau + concatenation de la session 
        $insertville->execute(array($insertville, $_SESSION['id']));
        header('Location: monespace.php?id=' . $_SESSION['id']);
    }

    // ----MODIFICATION DU CODE POSTAL-------
    // Mise en palce de la condition de recupetration de la variablle externe 

    // Utilisation de la fonction filter_input permettant de recuperer une variable externe et la filtrer
    // Utilisation de la constante INPUT_POST et la variable récupérée code postal 
    if (filter_input(INPUT_POST, "cp")) {

        $newcp = htmlspecialchars(filter_input(INPUT_POST, "cp"));
        // creation d'une variable prenant en compte la requete préparée 
        // Utilisation de la requete SQL permettant de mettre à jour les lignes existantes
        $intertcp = $dbname->prepare("UPDATE users SET cp=? WHERE id_user=?");

        // Execution de la requete sous forme de tableau + concatenation de la variable $_SESSION
        $insertcp->execute(array($insertcp, $_SESSION['id']));
        header('Location: monespace.php?=' . $_SESSION['id']);
    }


    // ----MODIFICATION DU TYPE -----

    // Mise en place de la fonction filter_input permettant de recuperer une variable externe et la filtrer
    // Utilisation de la constante INPUT_POST et la variable récupérée pseudo les lignes existantes 

    // Mise en palce de la condition de recuperation de la variable externe 
    if (filter_input(INPUT_POST, "type")) {

        $newtype = htmlspecialchars(filter_input(INPUT_POST, "type"));
        // creation d'une variable prenant en compte la requete préparée 
        // Utilisation de la requeete SQL permettant de mettre à jour les lignes existantes 
        $inserttype->prepare("UPDATE users SET type=? WHERE id_users=?");

        // Execution de la requete sous forme de tableau + concatenation de la variable $_SESSION
        $inserttype->execute(array($inserttype, $_SESSION['id']));
        header('Location: monespace.php?=' . $_SESSION['id']);
    }

    // ----MODIFICATION DU PSEUDO-------------

    // Mise en palce de la focntion filter_inout permetttant de recuperer une variable externe et de la filtrer
    // Utiilisation de la ocnstante INPUT_POST et la variable récupérée pseudo les lignes existantes 

    // Mise en place de la condition de recuperation de la variable externe 
    if (filter_input(INPUT_POST, "pseudo")) {

        $newpseudo = htmlspecialchars(filter_input(INPUT_POST, "pseudo"));
        // creation d'une variable prenant en compte la requete preéparée 
        //    Utilsiation de la reuqete sous forme de tableau + concatenation de la variable $_SESSION
        $insertpseudo->prepare("UPDATE users SET pseudo=? id_users=?");
        //    Utilsiation de la requete sous forme de tableau + concatenation de la variable $_SESSION
        $insertpseudo->execute(array($insertpseudo, $_SESSION['id']));
        header('location: monespace.php?=' . $_SESSION['id']);
    }


    //----- MODIFICATION DU MOT DE PASSE ----
    // MODIFICATION DU MOT DE PASSE 

    //   Mise en place d'une condtion de declaration de variable avec la fonction isset
    //   Utilsation de !empty specifiant le caractère non vide des variables newmdp2
    if (isset($_POST['newmdp1']) && !empty($_POST['newmdp1']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2'])) {

        //  Utilisation de la fonction sha permettant une securité accrue du mdp 
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);

        //   Mise en place d'une condition entre la varaible $mdp1 et $mdp2 
        // Mise en place d'une comparaison des valeurs des variables
        if ($mdp1 == $mdp2) {

            //    Creation d'une variable prenant en compte la requete préparée
            // Mise en place de la requete preparée avec utilisation de la requete SQL UPDATE
            //  Utilisation de ? stipulant une donnée entrée lors de la saisie                 
            $insertmdp = $debname->prepare("UPDATE users SET mdp = ? WHERE id_users = ?");
            //   On execute la requete et on renvoie le resultat sous forme de tableau
            $insertmdp->execute(array($mdp1, $_SESSION['id']));

            // Redirection vers la page correspondante en sauvegardantla sessin via une concatenation 
            header('Location: monespace.php?id=' . $_SESSION['id']);
        } else {
            $msg = "Vos deux mots de passe ne sont pas identiques !";
        }
    }

?>

    <html>

    <head>
        <!-- Utilisation de la balise tilte stipulant le caractère entrée comme étant un titre  -->
        <title>Modification du profil </title>
        <meta charset="utf-8">
    </head>

    <body>
        <div>

            <!--Utilisation de la balise h2 specifiant une taille de titre  -->
            <h2>Edition de mon profil</h2>
            <div>

                <!-- Utilisation de la balise form representant un formulaire c'est à dire une section permettant à l'utilisateur de rentrer des infos-->
                <form method="POST" action="" enctype="multipart/form-data">


                    <!--Utilisation de la balise label representant une legende  pour un objet d'une interface  -->
                    <label>Nom :</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure le nom  -->
                    <!--  Utlisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="newnom" placeholder="Nom" value="<?php echo $afficher_profil['nom']; ?>" /><br />







                    <!--Utilisation de la balise label representant une legende  pour un objet d'une interface  -->
                    <label>Prenom :</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure le prenom  -->
                    <!--  Utlisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="newprenom" placeholder="prenom" value="<?php echo $afficher_profil['prenom']; ?>" /><br /><br /> <br />




                    <!--Utilisation de la balise label representant une legende  pour un objet d'une interface  -->
                    <label>Pseudo :</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure le pseudo  -->
                    <!--  Utlisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $afficher_profil['pseudo']; ?>" /><br /><br />




                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Email :</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure le pseudo  -->
                    <!--  Utlisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="newmail" placeholder="Mail" value="<?php echo $afficher_profil['email']; ?>" /><br /><br />





                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Mot de passe :</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure le mot de passe   -->
                    <!--  Utlisation  des balises br specifiant un saut de ligne -->
                    <!-- Utilisation du type password  permettant de saisir un mot de passe sans que celui-ci ne soit pas visible sur l'écran  -->
                    <!-- Utilisation de name comme  newmdp1 permettant de saisir le new mdp  -->
                    <input type="password" name="newmdp1" placeholder="Mot de passe" /><br /><br />





                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Confirmation - mot du passe :</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure le mot de passe   -->
                    <!--  Utlisation  des balises br specifiant un saut de ligne -->
                    <!-- Utilisation du type password  permettant de saisir un mot de passe sans que celui-ci ne soit pas visible sur l'écran  -->
                    <!--  Utilisation de name comme  newmdp2 permettant de confirmer le mdp-->
                    <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />









                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Adresse :</label>


                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure l'adresse   -->
                    <!--  Utilisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="newadresse" placeholder="Adresse" value="<?php echo $afficher_profil['adresse']; ?>" /><br /><br /> <br />





                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Ville :</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure la ville   -->
                    <!--  Utilisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="newville" placeholder="Ville" value="<?php echo $afficher_profil['ville']; ?>" /><br /><br /> <br />






                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Code Postal:</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure le code postal   -->
                    <!--  Utilisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="newnom" placeholder="Code postal" value="<?php echo $afficher_profil['cp']; ?>" /><br /><br /> <br />





                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Type :</label>

                    <!-- Utilisation de balise input de type text  permettant de rentrer du texte -->
                    <!-- Utilisation de value sepcifiant l'entrée de la valeur venant du php echo dans ce cas de figure le type  -->
                    <!--  Utilisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="newtype" placeholder="type" value="<?php echo $afficher_profil['type']; ?>" /><br /><br /> <br />



                    <!-- Utilisation de la balise input de type submit permettant d'envoyer des données d'un formulaire -->
                    <input type="submit" value="Mettre à jour mon profil !" />

                </form>



                <?php if (isset($msg)) {
                    echo $msg;
                } ?>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: connexion.php");
}

?>