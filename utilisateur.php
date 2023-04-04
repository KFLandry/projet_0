<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enregistrez-vous</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <section>
        <form action="insert2.php" method="POST">

            <h1><i>enregistrez-vous</i></h1>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required><br>

            <label for="pseudo">Pseudonyme :</label>
            <input type="text" id="pseudo" name="pseudo" required><br>

            <label for="email">email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="age">Âge :</label>
            <input type="text" id="age" name="age" required><br>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required><br>

            <label for="origine">Origine :</label>
            <input type="text" id="origine" name="origine" required><br>

            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" placeholder="10 caractères nettes.Exemple: +336XXXXXXX"
                required><br>

            <label for="mdp">mot de passe :</label>
            <input type="password" id="mdp" name="mdp" placeholder="6 caractères nettes" required><br>

            <input type="submit" value="Enregistrer">
        </form>
        <a href="authen.php"><i>si vous avez deja un compte</i></a>
    </section>

</body>

</html>