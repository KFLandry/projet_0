<?php
session_start();

include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Vérifie si tous les champs ont été remplis
    if (!empty($_POST['nom_recette']) && !empty($_POST['origine']) && !empty($_POST['etapes']) && isset($_FILES['img']) && isset($_SESSION['utilisateurs_id'])) {

        $nom_recette = $_POST['nom_recette'];
        $origine = $_POST['origine'];
        $etapes = $_POST['etapes'];
        $filename = $_FILES['img']['name'];
        // teste si le fichier a bien été envoyé

        if ($_FILES['img']['error'] == 0) {

            // recuperons le nom du du fichier

            // verifie l'extention de l'image
            $fileinfo = pathinfo($_FILES['img']['name']);
            $extension = $fileinfo['extension'];
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            // Vérifie si le fichier est une image
            if (in_array($extension, $allowedExtensions) && getimagesize($_FILES['img']['tmp_name'])) {
                move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . $filename);
            } else {
                echo '<h1>Erreur : fichier non valide.</h1><br/>
                      <a href="recettes.php">Retourner aux formulaire</a>';
                exit();
            }
        }

        // requete pour enregistrer les recettes
        $save = 'INSERT INTO recette(utilisateurs_id,nom_recette,origine,img,etapes) VALUES (:utilisateurs_id,:nom_recette,:origine,:etapes,:img)';

        // preparation
        $insertRecipe = $db->prepare($save);

        // execution
        $insertRecipe->execute([
            'utilisateurs_id' => $_SESSION['utilisateurs_id'],
            'nom_recette' => $nom_recette,
            'origine' => $origine,
            'etapes' => $etapes,
            'img' => $filename,

        ]);

        // verification de l'effectivité de l'insertion
        $rowCount = $insertRecipe->rowCount();
        if ($rowCount > 0) {
            // rediriger l'utilisateur ves la page principale
            header('location:main.php');
            exit();
        } else {
            echo '<div class="alert alert-danger"><h1>L\'insertion a échoué</h1></div>';
        }
    } else {

        header('location:utilisateur.php');
        exit();
        // echo '<div class="alert alert-danger"><h1>Tous les champs doivent être remplis</h1></div>';
    }
}
?>