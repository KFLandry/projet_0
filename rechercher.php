<?php session_start();
include_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rechercher</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include_once("header.php"); ?>

    <?php

    $query = $_GET["rechercher"];

    $sql = "SELECT * FROM recette WHERE nom_recette LIKE '%$query%' OR origine LIKE '%$query%' OR etapes LIKE '%$query%'";

    $searchRecipe = $db->prepare($sql);
    $searchRecipe->execute();
    $resultQuery = $searchRecipe->fetchAll();
    ?>

    <?php foreach ($resultQuery as $resultSearch): ?>
        <div class="recipe">
            <h2>
                <?php echo strip_tags($resultSearch['nom_recette']); ?>
            </h2>
            <p class="origin">
                <?php echo strip_tags($resultSearch['origine']); ?>
            </p>

            <!-- affichage de l'image -->

            <?php if (!empty($resultSearch['img'])): ?>
                <img src="uploads/<?= $resultSearch['img']; ?>" alt="image de la recette" width="100%">
            <?php endif; ?>
            <p class="steps">

            <h2><i>Les etapes de preparations</i></h2>
            <?php echo strip_tags($resultSearch['etapes']); ?>
            </p>
        </div>
    <?php endforeach ?>

    <?php include_once("footer.php"); ?>

</body>

</html>