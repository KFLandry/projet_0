<?php
session_start();

include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // recuperation des données

    $email = $_POST['email'];
    $password = $_POST['mdp'];

    // verification de l'email

    $verif = 'SELECT mdp FROM utilisateurs WHERE email =:email';
    $verifUsers = $db->prepare($verif);
    $verifUsers->execute([
        'email' => $email,
    ]);
    $utilisateurs = $verifUsers->fetchAll();

    foreach ($utilisateurs as $utilisateur) {
        echo $utilisateur['mdp'];
    }

    // verification du mot de passe 

    // if ($password && password_verify($password, $utilisateur['mdp'])) {
    if ($password === $utilisateur['mdp']) {


        // authentification réussie

        $_SESSION['utilisateurs_id'] = $utilisateur[0]['id'];
        $_SESSION['email'] = $utilisateur[0]['email'];
        $_SESSION['pseudo'] = $utilisateur[0]['pseudo'];

        // redirection

        header('Location:main.php');
        exit();
    } else {
        echo '<div class="alert alert-danger"><h1>Authentication Failed</h1></div>
            <i>Identifiants ou mot de passe incorrects</i></div>';
    }
}