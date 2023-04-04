<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajoutes ta recette </title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <section>

        <form action="insert.php" method="POST" enctype="multipart/form-data">
            <label for="nom_recette">Nom de la recette :</label>
            <input type="text" id="nom_recette" name="nom_recette"><br>

            <label for="origine">Origine :</label>
            <input type="text" id="origine" name="origine" placeholder="Donner le nom d'un pays existant"><br>

            <label for="img">une image de la recette.
                <br><i>les fichiers autorisés sont ['jpg', 'jpeg', 'png', 'gif'].</i>
            </label>
            <input type="file" name="img" id="img"><br><br>

            <label for="etapes">Étapes de la préparation :</label><br>
            <textarea id="etapes" name="etapes" rows="10" cols="50" placeholder="Entrez les recettes en suivant le modele:
            1-....
            2-....
            3-....
            ....
Pour faciliter  la comprehension de vos recettes"></textarea><br>

            <input type="submit" value="Enregistrer">
        </form>

    </section>
</body>

</html>