<?php
session_start();

// Ajout d'une classe

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['className']) && !empty($_POST['className'])
        && isset($_POST['classDesc']) && !empty($_POST['classDesc'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
        require_once "../php/function.php";

        $className = htmlspecialchars($_POST['className']);
        $classDesc = htmlspecialchars($_POST['classDesc']);

        addClass($conn, $className, $classDesc);

        $_SESSION['message'] = "Classe ajoutée";

        require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/close.php";

        header('Location: ../adminClass.php');
        exit();
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: ../adminAjoutClasse.php');
        exit();
    }
}
