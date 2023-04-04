<?php
session_start();

include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifie si tous les champs ont été remplis
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['age']) && !empty($_POST['adresse']) && !empty($_POST['origine']) && !empty($_POST['telephone']) && !empty($_POST['mdp'])) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $origine = $_POST['origine'];
        $age = $_POST['age'];
        $adresse = $_POST['adresse'];
        $tel = $_POST['telephone'];
        $mdp = $_POST['mdp'];
        if (strlen($tel) === 10 && is_numeric($tel) && strlen($mdp) === 6 && is_string($nom) && is_string($prenom) && is_string($pseudo) && is_string($origine) && is_string($adresse)) {
            // requete pour enregistrer les utitlisateurs
            $save = 'INSERT INTO utilisateurs (nom, prenom, pseudo, email, origine, age, adresse, tel, mdp) VALUES (:nom, :prenom, :pseudo, :email, :origine, :age, :adresse, :tel, :mdp)';

            // preparation
            $insertRecipe = $db->prepare($save);

            // execution
            $insertRecipe->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'pseudo' => $pseudo,
                'email' => $email,
                'origine' => $origine,
                'age' => $age,
                'adresse' => $adresse,
                'tel' => $tel,
                'mdp' => $mdp,
            ]);

            // Vérifie si l'insertion a réussi
            $rowCount = $insertRecipe->rowCount();
            if ($rowCount > 0) {
                // Redirigez l'utilisateur vers la page d'accueil
                header('Location: main.php');
                exit();
            } else {
                echo 'L\'insertion a échoué.';
            }
        } else {
            echo '<h1> Erreur:mot de passe ou nom ou prenom ou pseudo ou adresse incorrect</h1>';
        }
    } else {
        echo 'Tous les champs doivent être remplis.';
    }
}
?>