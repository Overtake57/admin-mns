<?php
session_start();

// Ajout d'un élève

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['userSurname']) && !empty($_POST['userSurname'])
        && isset($_POST['userName']) && !empty($_POST['userName'])
        && isset($_POST['userAge']) && !empty($_POST['userAge'])
        && isset($_POST['userPhone']) && !empty($_POST['userPhone'])
        && isset($_POST['userMail']) && !empty($_POST['userMail'])
        && isset($_POST['userCity']) && !empty($_POST['userCity'])
        && isset($_POST['userStreet']) && !empty($_POST['userStreet'])
        && isset($_POST['userCp']) && !empty($_POST['userCp'])
        && isset($_POST['className']) && !empty($_POST['className'])
    ) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
        require_once "../php/function.php";

        $surname = htmlspecialchars($_POST['userSurname']);
        $name = htmlspecialchars($_POST['userName']);
        $age = htmlspecialchars($_POST['userAge']);
        $phone = htmlspecialchars($_POST['userPhone']);
        $email = htmlspecialchars($_POST['userMail']);
        $city = htmlspecialchars($_POST['userCity']);
        $street = htmlspecialchars($_POST['userStreet']);
        $cp = htmlspecialchars($_POST['userCp']);
        $className = htmlspecialchars($_POST['className']);

        addUser($conn, $surname, $name, $age, $phone, $email, $city, $street, $cp, $className);

        $_SESSION['message'] = "Utilisateur ajouté";

        require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/close.php";

        header('Location: ../adminAccueil.php');
        exit();
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        header('Location: ../adminAjoutEleve.php');
        exit();
    }
}
