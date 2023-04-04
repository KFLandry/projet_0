<?php

session_start(); //demarrer la session

include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifie si tous les champs ont été remplis
    if (!empty($_POST['contenu']) && $_POST['note'] && isset($_SESSION['utilisateurs_id'])) {

        $commentText = htmlspecialchars($_POST['contenu']); // nettoyer les données saisies par l'utilisateur
        $note = $_POST['note']; // Note
        $heure = date('Y-m-d H-i-s'); // Heure de soumission du formulaire

        // requete pour enregistrer les utilisateurs et leurs id dans la table de liasion

        $commentQuery = 'INSERT INTO commentaire(utilisateurs_id, recette_id, note, contenu, heure) VALUES (:utilisateurs_id, :recette_id, :note, :contenu, :heure)';

        // préparation
        $commentRecipe = $db->prepare($commentQuery); // $pdo est une instance de PDO

        // exécution
        $commentRecipe->execute([

            'utilisateurs_id' => $_SESSION['utilisateurs_id'],
            'recette_id' => $_SESSION['recette_id'],
            'note' => $note,
            'contenu' => $commentText,
            'heure' => $heure

        ])
        ;

        // vérification de l'effectivité de l'insertion
        $rowCount = $commentRecipe->rowCount();
        if ($rowCount > 0) {
            // rediriger l'utilisateur vers la page principale
            header('location: main.php');
            exit();
        } else {
            echo '<div class="alert alert-danger"><h1>L\'insertion a échoué</h1></div>';
        }
    } else {

        header('location: utilisateur.php');
        exit();
        // echo '<div class="alert alert-danger"><h1>Vous devez remplis tous les champs</h1></div>';
    }

}