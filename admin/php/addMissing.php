<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";

if (isset($_POST['absentBtn'])) {
    $userId = $_POST['userId'];
    $date = date("Y-m-d");

    // Insertion de la date d'absence dans la table "tblabsent"
    $insertQuery = "INSERT INTO tblabsent (userId, date) VALUES (:userId, :date)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':date', $date);
    $result = $stmt->execute();

    if ($result) {
        // Redirection vers la page précédente (index.php)
        header("Location: ../index.php");
        exit();
    } else {
        // Gestion des erreurs lors de l'insertion de la date d'absence
        echo "Erreur lors de l'enregistrement de la date d'absence.";
    }
}
