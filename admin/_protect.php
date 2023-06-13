<?php
session_start();
// Vérification des droits d'accès de la page
$allowedRoles = array("admin", "super_admin");
// Vérifie si l'utilisateur est connecté, sinon redirection vers la page de connexion
if (!isset($_SESSION["user"]) || !in_array($_SESSION["user"]["role"], $allowedRoles)) {
    header("Location: ../index.php");
    exit();
}
