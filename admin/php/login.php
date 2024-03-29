<?php
require_once "../../connexion/connect.php";
require_once "./function.php";
if (!empty($_POST)) {
    if (isset($_POST['userMail'], $_POST['userPwd'])
        && !empty($_POST["userMail"]) && !empty($_POST["userPwd"])) {
        if (!filter_var($_POST['userMail'], FILTER_VALIDATE_EMAIL)) {
            die("L'adresse e-mail n'est pas valide.");
        }

        $user = getUserByEmail($_POST['userMail'], $conn);

        if (!$user) {
            die("L'utilsateur et/ou le mot de passe est incorrect.");
        }
        if (password_verify($_POST["userPwd"], $user["userPwd"])) {
            die("L'utilsateur et/ou le mot de passe est incorrect.");
        }
        session_start();
        // Enregistrer les informations de l'utilisateur dans la session
        $_SESSION["user"]["userId"] = $user["userId"];
        $_SESSION["user"]["prenom"] = $user["userSurname"];
        $_SESSION["user"]["nom"] = $user["userName"];
        $_SESSION["user"]["role"] = $user["role"];

        $role = $user['role'];
        if ($role === 'super_admin') {
            header('Location: ../views/index.php');
        } elseif ($role === 'admin') {
            header('Location: ../views/index.php');
        } elseif ($role === 'user') {
            header('Location: ../../user/views/index.php');
        } else {
            // Rôle non reconnu, afficher un message d'erreur ou rediriger vers une page par défaut
            die("Rôle non autorisé.");
        }
    }
}
