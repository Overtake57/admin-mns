<?php
session_start();
// Vérification des droits d'accès de la page
$allowedRoles = array("user");
// Vérifie si l'utilisateur est connecté et a le rôle approprié, sinon redirection vers la page de connexion
if (!isset($_SESSION["user"]) || !in_array($_SESSION["user"]["role"], $allowedRoles)) {
    header("Location: ../index.php");
    exit();
}
