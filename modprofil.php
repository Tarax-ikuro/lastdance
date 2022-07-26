<?php

include "./lesdeux/header.php";
require 'config.php';


// Identification de la session à travers la mise ne place d'une condition 

if ($_SESSION["role"] == "user" || $_SESSION["role"] == "admin") {


    if (isset($_POST['action']) && $_POST['action'] == 'modprofil' && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['cp'])) {


        // Maj des éléments 
        $user = 'UPDATE users SET nom = :nom, prenom = :prenom, pseudo = :pseudo, email = :email, adresse= :adresse, ville = :ville ,cp = :cp WHERE id_users = :id_users';
        $save = array(
            ':nom' => htmlspecialchars(filter_input(INPUT_POST, 'nom')),
            ':prenom' => htmlspecialchars(filter_input(INPUT_POST, 'prenom')),
            ':pseudo' => htmlspecialchars(filter_input(INPUT_POST, 'pseudo')),
            ':email' => htmlspecialchars(filter_input(INPUT_POST, 'email')),
            ':adresse' => htmlspecialchars(filter_input(INPUT_POST, 'adresse')),
            ':ville' => htmlspecialchars(filter_input(INPUT_POST, 'ville')),
            ':cp' => htmlspecialchars(filter_input(INPUT_POST, 'cp')),
            ':id_users' => $_SESSION['id']

        );

        $req = $dbname->prepare($user);
        $req->execute($save);
    }

    //----- MODIFICATION DU MOT DE PASSE ----
    // MODIFICATION DU MOT DE PASSE 

    //   Mise en place d'une condtion de declaration de variable avec la fonction isset
    //   Utilsation de !empty specifiant le caractère non vide des variables mdp2
    if (isset($_POST['mdp1']) && !empty($_POST['mdp1']) && isset($_POST['mdp2']) && !empty($_POST['mdp2'])) {

        //  On crée 2 variable avec lesquels on stock les valeurs des 2 mot de passe 
        $mdp1 = ($_POST['mdp1']);
        $mdp2 = ($_POST['mdp2']);

        //   Mise en place d'une condition entre la varaible $mdp1 et $mdp2 
        // Mise en place d'une comparaison des valeurs des variables
        if ($mdp1 == $mdp2) {
            $option = ['cost' => 12,];
            $mdp1 = password_hash($mdp1, PASSWORD_BCRYPT, $option);

            //    Creation d'une variable prenant en compte la requete préparée
            // Mise en place de la requete preparée avec utilisation de la requete SQL UPDATE
            //  Utilisation de ? stipulant une donnée entrée lors de la saisie                 
            $insertmdp = $dbname->prepare("UPDATE users SET mdp = ? WHERE id_users = ?");
            //   On execute la requete et on renvoie le resultat sous forme de tableau
            $insertmdp->execute(array($mdp1, $_SESSION['id']));

            // Redirection vers la page correspondante en sauvegardantla sessin via une concatenation 

        } else {
            $msg = "Vos deux mots de passe ne sont pas identiques !";
        }
    }
    if (isset($_SESSION["id"])) {

        $requser = $dbname->prepare("SELECT * FROM users WHERE id_users = ?");

        // ON execute la requete 
        // Execution de la requete avec le stockage de la session dans un tableau 
        $requser->execute(array($_SESSION['id']));

        // On termine l'execution avec en fetchant dans une variable
        $user = $requser->fetch();
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

                    <input type="text" name="nom" placeholder="Nom" value="<?php echo $user['nom']; ?>" /><br />

                    <!--Utilisation de la balise label representant une legende  pour un objet d'une interface  -->
                    <label>Prenom :</label>


                    <input type="text" name="prenom" placeholder="prenom" value="<?php echo $user['prenom']; ?>" /><br /><br /> <br />
                    <input hidden type="text" name="action" value="modprofil">

                    <!--Utilisation de la balise label representant une legende  pour un objet d'une interface  -->
                    <label>Pseudo :</label>

                    <input type="text" name="pseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />

                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Email :</label>

                    <input type="text" name="email" placeholder="Mail" value="<?php echo $user['email']; ?>" /><br /><br />

                    <label>Mot de passe :</label>

                    <input type="password" name="mdp1" placeholder="Mot de passe" /><br /><br />


                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Confirmation - mot du passe :</label>

                    <!--  Utilisation de name comme  newmdp2 permettant de confirmer le mdp-->
                    <input type="password" name="mdp2" placeholder="Confirmation du mot de passe" /><br /><br />


                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Adresse :</label>

                    <!--  Utilisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="adresse" placeholder="Adresse" value="<?php echo $user['adresse']; ?>" /><br /><br /> <br />


                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Ville :</label>


                    <!--  Utilisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="ville" placeholder="Ville" value="<?php echo $user['ville']; ?>" /><br /><br /> <br />

                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->
                    <label>Code Postal:</label>


                    <!--  Utilisation  des balises br specifiant un saut de ligne -->
                    <input type="text" name="cp" placeholder="Code postal" value="<?php echo $user['cp']; ?>" /><br /><br /> <br />

                    <!-- Utilisation de la balise label representant une legende pour un objet d'une interface   -->



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
<?php
include("./lesdeux/footer.php");
?>