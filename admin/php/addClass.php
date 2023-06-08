<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['className'], $_POST['classDesc'])) {
        $className = htmlspecialchars($_POST['className']);
        $classDesc = htmlspecialchars($_POST['classDesc']);

        // Validation des données d'entrée
        if (strlen($className) > 50 || strlen($classDesc) > 255) {
            $_SESSION['erreur'] = "Les valeurs entrées sont trop longues";
            header('Location: ../adminAjoutClasse.php');
            exit();
        }

        try {
            // Début de la transaction
            $conn->beginTransaction();

            addClass($conn, $className, $classDesc);

            // Validation réussie, enregistrement des modifications
            $conn->commit();

            $_SESSION['message'] = "Classe ajoutée";

            header('Location: ../dashboard/adminClasse.php');
            exit();
        } catch (Exception $e) {
            // En cas d'erreur, annulation des modifications
            $conn->rollBack();

            // Gestion des erreurs
            $_SESSION['erreur'] = "Une erreur s'est produite lors de l'ajout de la classe";
            // Vous pouvez afficher ou enregistrer l'erreur complète pour le débogage : $e->getMessage()

            header('Location: ../dashboard/adminAjoutClasse.php');
            exit();
        }
    }
}

// Si le formulaire est incomplet
$_SESSION['erreur'] = "Le formulaire est incomplet";
header('Location: ../adminAjoutClasse.php');
exit();
