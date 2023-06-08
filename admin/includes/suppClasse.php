<?php
session_start();

// Suppression d'une classe

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $classId = $_POST["classId"];

    deleteClass($conn, $classId);

    http_response_code(200);
    echo "La classe a été supprimée avec succès";
}
