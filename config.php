<?php
// connexion a notre base de données

$db = new PDO('mysql:host=localhost;dbname=projet_0;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION], );
try {
    // On se connecte
    $db = new PDO('mysql:host=localhost;dbname=projet_0;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION], );
} catch (Exception $e) {
    // En cas d'erreur
    die('Erreur : ' . $e->getMessage());
}