<?php
session_start();

include_once("config.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>projet_0</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/b8937a4147.css" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b8937a4147.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <?php include_once("header.php"); ?>

    <section class="body">
        <h1>Liste des recettes</h1>

        <?php include_once('config.php');

        $select = 'SELECT * FROM recette';

        // préparation et exécution de la requête
        
        $selectRecipes = $db->prepare($select);
        $selectRecipes->execute();
        $result = $selectRecipes->fetchAll();
        ?>

        <?php foreach ($result as $recipe): ?>
            <div class="recipe">
                <h2>
                    <?php echo strip_tags($recipe['nom_recette']); ?>
                </h2>
                <p class="origin">
                    <?php echo strip_tags($recipe['origine']); ?>
                </p>

                <!-- affichage de l'image -->

                <?php if (!empty($recipe['img'])): ?>
                    <img src="uploads/<?= $recipe['img']; ?>" alt="image de la recette" width="100%">
                <?php endif; ?>
                <p class="steps">

                <h2><i>Les etapes de preparations</i></h2>
                <?php echo strip_tags($recipe['etapes']); ?>
                </p>
                <div class="rating">
                    <span class="stars">

                        <!--note moyenne de la recette -->
                        <i>
                            Note de la recette:
                            <?php

                            $average = 'SELECT ROUND(AVG(note)) AS moyenne_note FROM commentaire WHERE recette_id =' . $recipe['id'] . ';';

                            // preparation et execution de la requete
                        
                            $averageComment = $db->prepare($average);
                            $averageComment->execute();
                            if ($averageComment->rowCount() > 0) {
                                echo $averager = $averageComment->fetch(PDO::FETCH_ASSOC)['moyenne_note'];
                            } else {
                                echo $averager = "Rien";
                            }
                            ?>
                        </i>

                    </span><br>
                    <span class="votes">

                        <!-- nombre de commentaire piblié -->

                        <?php
                        // intialisation de la  requete
                    
                        $count = 'SELECT COUNT(*) AS nb_commentaires FROM commentaire WHERE recette_id = ' . $recipe['id'] . ';';

                        // preparation et execution de la requete
                    
                        $countComment = $db->prepare($count);
                        $countComment->execute();
                        $counter = $countComment->fetch(PDO::FETCH_ASSOC)['nb_commentaires']; ?>

                        (
                        <?= $counter; ?>avis)
                    </span>

                    <form action="comment.php" method="POST" class="form" id="commentform_<?= $recipe['id']; ?>">

                        <label for="contenu">


                            <!-- <h3>Commentez la recette
                                                                                                                                                                                                                                                                                                                                                                                                                                    <? echo $_SESSION['pseudo']; ?>
                            </h3> -->


                        </label><br>
                        <label for="note">Note</label><br>
                        <input type="number" name="note" id="note" min="0" max="5" step="0.1"><Br><br>
                        <textarea name="contenu" id="contenu" cols="30" rows="2"></textarea><br>

                        <!-- Champ caché pour l'ID du visiteur -->

                        <input type="hidden" name="utilisateurs_id">
                        <input type="hidden" name="recette_id"
                            value="<?php echo $_SESSION['recette_id'] = $result[0]['id']; ?>">
                        <input type="hidden" name="heures">


                        <input type="submit" class="submit">

                    </form>
                    <h1>
                    </h1>
                    <!-- Icone commentaire -->


                    <i class="fa-regular fa-comment" id="monIcone_<?= $recipe['id']; ?>" class='monIcone'></i><br>

                    <script>
                        // Cacher le formulaire lors du chargement de la page
                        document.getElementById("commentform_<?= $recipe['id']; ?>").style.display = "none";

                        // Ajouter un gestionnaire d'événements pour l'icône
                        document.getElementById("monIcone_<?= $recipe['id']; ?>").addEventListener("click", function () {
                            var formulaire = document.getElementById("commentform_<?= $recipe['id']; ?>");
                            if (formulaire.style.display === "none") {
                                formulaire.style.display = "block";
                            } else {
                                formulaire.style.display = "none";
                            }
                        });
                    </script>
                    <br>

                    <?php

                    $show = 'SELECT utilisateurs.pseudo, commentaire.contenu, recette.nom_recette,commentaire.heure 
                            FROM utilisateurs 
                            JOIN commentaire ON utilisateurs.id = commentaire.utilisateurs_id 
                            JOIN recette ON recette.id = commentaire.recette_id
                            WHERE recette.id = :recipe_id;';

                    $shows = $db->prepare($show);
                    $shows->execute(
                        [
                            'recipe_id' => $recipe['id']
                        ]
                    );
                    $resultShow = $shows->fetchAll();
                    ?>
                    <button id="toggleCommentsButton_<?= $recipe['id']; ?>"
                        class="toggleCommentsButton">Commentaires</button><br>
                    <div class="comments" id="commentsSection_<?= $recipe['id']; ?>">
                        <article class="commentaires">
                            <?php foreach ($resultShow as $resultShows): ?>
                                <strong> <i>
                                        <?= $resultShows['pseudo']; ?>
                                    </i></strong><i> a publié le :
                                    <?php
                                    // Cconvertir la date en timestamp
                                    $timestamp_comment = strtotime($resultShows['heure']);
                                    // calcul de l'age du comment
                                    $age_comment = time() - $timestamp_comment;
                                    // affichage
                                    echo floor($age_comment / (60 * 60 * 24));
                                    ?> Jour(s)
                                </i><br>
                                <i>:
                                    <?= $resultShows['nom_recette']; ?>
                                </i>
                                <p>
                                    <?= $resultShows['contenu']; ?>
                                </p>
                            <?php endforeach; ?>
                        </article>
                    </div>

                    <!-- on masque les commentaires -->
                    <script>
                        // Masquer les commentaires au chargement de la page
                        document.getElementById("commentsSection_<?= $recipe['id']; ?>").style.display = "none";

                        document.getElementById("toggleCommentsButton_<?= $recipe['id']; ?>").addEventListener("click", function () {
                            var commentsSection = document.getElementById("commentsSection_<?= $recipe['id']; ?>");
                            if (commentsSection.style.display === "none") {
                                commentsSection.style.display = "block";
                            } else {
                                commentsSection.style.display = "none";
                            }
                        });
                    </script>

                </div>
            </div>

        <?php endforeach; ?>
    </section>

    <?php include_once('footer.php'); ?>
</body>

</html>