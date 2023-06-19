<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
        require_once "../php/function.php";

        // Nettoyer et valider les valeurs du formulaire
        $surname = trim($_POST['userSurname']);
        $name = trim($_POST['userName']);
        $age = filter_var($_POST['userAge'], FILTER_VALIDATE_INT);
        $phone = trim($_POST['userPhone']);
        $email = filter_var($_POST['userMail'], FILTER_VALIDATE_EMAIL);
        $city = trim($_POST['userCity']);
        $street = trim($_POST['userStreet']);
        $cp = trim($_POST['userCp']);
        $className = filter_var($_POST['className'], FILTER_VALIDATE_INT);

        // Valider les valeurs du formulaire
        if (empty($surname) || empty($name) || empty($age) || empty($phone) || empty($email) || empty($city) || empty($street) || empty($cp) || empty($className)) {
            throw new Exception("Tous les champs doivent être remplis.");
        }

        // Appliquer htmlspecialchars aux valeurs avant insertion dans la base de données
        $surname = htmlspecialchars($surname, ENT_QUOTES);
        $name = htmlspecialchars($name, ENT_QUOTES);
        $phone = htmlspecialchars($phone, ENT_QUOTES);
        $email = htmlspecialchars($email, ENT_QUOTES);
        $city = htmlspecialchars($city, ENT_QUOTES);
        $street = htmlspecialchars($street, ENT_QUOTES);
        $cp = htmlspecialchars($cp, ENT_QUOTES);

        // Stocker l'adresse e-mail dans une variable
        $userMail = $email;

        // Générer un mot de passe aléatoire
        //? $password = randomPassword();

        $password = "qwerty";

        // Hacher le mot de passe
        $passwordHash = passwordHash($password);

        // Créer un objet User avec les détails de l'utilisateur
        $user = new User($surname, $name, $age, $phone, $email, $city, $street, $cp, $className, $passwordHash);

        // Appeler la fonction addUser pour insérer les données
        addUser($conn, $user);

        //? Envoyer l'e-mail contenant le mot de passe généré à l'adresse e-mail de l'utilisateur
        // $subject = "Nouveau mot de passe";
        // $message = "Votre mot de passe temporaire est : " . $password;
        // $headers = "From: your_email@example.com"; // Remplacez par notre adresse e-mail

        // $mailSent = mail($email, $subject, $message, $headers);

        // if (!$mailSent) {
        //     throw new Exception("Une erreur s'est produite lors de l'envoi de l'e-mail.");
        // }

        // Rediriger vers la page principale avec un message de succès
        $_SESSION['success'] = "L'élève a été ajouté avec succès.";
        header("Location: ../views/index.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['erreur'] = "Une erreur s'est produite lors de l'ajout de l'élève : " . $e->getMessage();
        header("Location: ../views/ajoutUtilisateur.php");
        exit();
    }
} else {
    // Rediriger vers la page d'ajout d'élève si la méthode de requête n'est pas POST
    header("Location: ../views/ajoutUtilisateur.php");
    exit();
}