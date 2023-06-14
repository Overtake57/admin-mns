<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

// Vérifier si l'ID de l'élève est présent dans l'URL
if (isset($_GET['studentId'])) {
    $studentId = $_GET['studentId'];
    $student = getStudentById($conn, $studentId);

    // Vérifier si l'élève existe
    if ($student) {
        // Vérifier si le formulaire a été soumis
        if (isset($_POST['submit'])) {
            // Vérifier si les champs requis sont présents
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
                $surname = htmlspecialchars($_POST['userSurname']);
                $name = htmlspecialchars($_POST['userName']);
                $age = htmlspecialchars($_POST['userAge']);
                $phone = htmlspecialchars($_POST['userPhone']);
                $email = htmlspecialchars($_POST['userMail']);
                $city = htmlspecialchars($_POST['userCity']);
                $street = htmlspecialchars($_POST['userStreet']);
                $cp = htmlspecialchars($_POST['userCp']);
                $className = htmlspecialchars($_POST['className']);

                // Validation des données d'entrée
                if (strlen($surname) > 50 || strlen($name) > 50 || strlen($age) > 3 || strlen($phone) > 20 || strlen($email) > 255 || strlen($city) > 50 || strlen($street) > 100 || strlen($cp) > 10) {
                    $_SESSION['erreur'] = "Les valeurs entrées sont trop longues";
                    header('Location: ../views/modificationUtilisateur.php?studentId=' . $studentId);
                    exit();
                }

                try {
                    // Mettre à jour les détails de l'élève dans la base de données
                    updateStudentDetails($conn, $studentId, $surname, $name, $age, $phone, $email, $city, $street, $cp, $className);

                    $_SESSION['message'] = "Détails de l'élève mis à jour";

                    header('Location: ../views/index.php');
                    exit();
                } catch (Exception $e) {
                    $_SESSION['erreur'] = "Une erreur s'est produite lors de la mise à jour des détails de l'élève";
                    // Vous pouvez afficher ou enregistrer l'erreur complète pour le débogage : $e->getMessage()

                    header('Location: ../views/modificationUtilisateur.php?studentId=' . $studentId);
                    exit();
                }
            } else {
                $_SESSION['erreur'] = "Le formulaire est incomplet";
                header('Location: ../views/modificationUtilisateur.php?studentId=' . $studentId);
                exit();
            }
        }
    } else {
        $_SESSION['erreur'] = "Elève non trouvé";
        header('Location: ../views/index.php');
        exit();
    }
} else {
    $_SESSION['erreur'] = "Aucun élève sélectionné pour la modification";
    header('Location: ../views/index.php');
    exit();
}
