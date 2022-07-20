<?php
require_once './config.php';

if (isset($_POST['titre'])) {
    // && isset($_POST['contenu']) && isset($_POST['preparation']) && isset($_POST['date_publication']) && isset($_POST['fichier']) && isset($_POST['cuisson']) && isset($_POST['nb_personnes']) && isset($_POST['ingredient']) && isset($_POST['id_categorie'])

    $titre = htmlspecialchars($_POST['titre']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $preparation = htmlspecialchars($_POST['preparation']);
    $datePublication = htmlspecialchars($_POST['date_publication']);
    $cuisson = htmlspecialchars($_POST['cuisson']);
    $nbPersonnes = htmlspecialchars($_POST['nb_personnes']);
    $ingredient = htmlspecialchars($_POST['ingredient']);
    $idCategorie = htmlspecialchars($_POST['id_categorie']);
    $idUser = htmlspecialchars($_POST['id_users']);


    // PARTIE UPLOAD ============================================================================
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //$fileName = $_FILES["fileToUpload"]["name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        // Allow certain file formats
        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {

            $uploadOk = 1;
        } else {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['error'] = 'Type de fichier non supporter';
            $uploadOk = 0;
            header("Location: index.php?page=uploadP1");
            exit;
        }
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['error'] = "Le fichier n'a pas pu être envoyé ";
        header("Location: index.php?page=uploadP1");
        exit;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            // echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['error'] = "Erreur d'envoie";
            $uploadOk = 0;
            header("Location: index.php?page=uploadP1");
            exit;
        }
    }









    // On prepare la requete 
    $requeteAdd = $dbname->prepare('INSERT INTO article (titre,contenu,preparation,date_publication,`image`,cuisson,nb_personnes,ingredient,id_categorie,id_users) 
    VALUES (:titre, :contenu, :preparation, :date_publication, :fichier, :cuisson, :nb_personnes, :ingredient, :id_categorie ,:id_users)');


    // On execute la reuqete crée precedemment 
    $requeteAdd->execute(
        [
            'titre' => $titre,
            'contenu' => $contenu,
            'preparation' => $preparation,
            'date_publication' => $datePublication,
            'fichier' => $target_file,
            'cuisson' => $cuisson,
            'nb_personnes' => $nbPersonnes,
            'ingredient' => $ingredient,
            'id_categorie' => intval($idCategorie),
            'id_users' => intval($idUser)

        ]
    );



    header('Location:index.php');
} else {
    echo ('fail');
}
