<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>

<body>

    <!-- //  formulaire d'authetification -->

    <form action="connect.php" method="POST">
        <h1><i>Authentifiez-vous</i></h1>

        <label for="emaim">Entrez votre identifiant :</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="mdp">mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" required><br>

        <input type="submit" value="Enregistrer">
    </form>


</body>

</html>