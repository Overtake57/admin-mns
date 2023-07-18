<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
        require_once "../php/function.php";

        $data = [
            'userSurname' => trim($_POST['userSurname']),
            'userName' => trim($_POST['userName']),
            'userAge' => filter_var($_POST['userAge'], FILTER_VALIDATE_INT),
            'userPhone' => trim($_POST['userPhone']),
            'userMail' => filter_var($_POST['userMail'], FILTER_VALIDATE_EMAIL),
            'userCity' => trim($_POST['userCity']),
            'userStreet' => trim($_POST['userStreet']),
            'userCp' => trim($_POST['userCp']),
            'className' => filter_var($_POST['className'], FILTER_VALIDATE_INT),
        ];

        // Valider les valeurs du formulaire
        foreach ($data as $key => $value) {
            if (empty($value) || ctype_space($value)) {
                throw new Exception("$key doit être rempli et ne peut pas contenir seulement des espaces.");
            }
        }

        // Validation spécifique de l'âge
        if ($data['userAge'] < 0 || $data['userAge'] > 130) {
            throw new Exception("L'âge doit être compris entre 0 et 130.");
        }

        // Appliquer htmlspecialchars aux valeurs avant insertion dans la base de données
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

        $password = "qwerty";
        $passwordHash = passwordHash($password);
        $userImage = '/assets/img/default.png';

        $user = new User(
            $data['userSurname'],
            $data['userName'],
            $data['userAge'],
            $data['userPhone'],
            $data['userMail'],
            $data['userCity'],
            $data['userStreet'],
            $data['userCp'],
            $data['className'],
            $passwordHash,
            $userImage
        );

        $loggedInUserRole = 'admin';

        if ($loggedInUserRole === 'admin') {
            addUser($conn, $user, 'user', $data['className']);
        } elseif ($loggedInUserRole === 'super_admin') {
            addUser($conn, $user, 'admin', $data['className']);
        }

        $_SESSION['success'] = "L'élève a été ajouté avec succès.";
        header("Location: ../views/index.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['erreur'] = "Une erreur s'est produite lors de l'ajout de l'élève : " . $e->getMessage();
        header("Location: ../views/ajoutUtilisateur.php");
        exit();
    }
} else {
    header("Location: ../views/ajoutUtilisateur.php");
    exit();
}
