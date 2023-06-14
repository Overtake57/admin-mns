<?php

// Vérifier si l'ID de la classe est présent dans l'URL
if (!isset($_GET['classId'])) {
    // Rediriger vers une page d'erreur ou afficher un message d'erreur approprié
    echo "ID de classe non spécifié.";
    exit();
}

$classId = $_GET['classId'];

require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

// Récupérer les détails de la classe à partir de la base de données
$class = getClassById($conn, $classId);

// Vérifier si la classe existe
if (!$class) {
    // Rediriger vers une page d'erreur ou afficher un message d'erreur approprié
    echo "Classe non trouvée.";
    exit();
}

// Vérifier si les champs requis sont présents
if (
    isset($_POST['className']) && !empty($_POST['className'])
    && isset($_POST['classDesc']) && !empty($_POST['classDesc'])
) {
    $className = htmlspecialchars($_POST['className']);
    $classDesc = htmlspecialchars($_POST['classDesc']);

    // Validation des données d'entrée
    if (strlen($className) > 50 || strlen($classDesc) > 255) {
        $_SESSION['erreur'] = "Les valeurs entrées sont trop longues";
        header('Location: ../modificationClasse.php?classId=' . $classId);
        exit();
    }

    try {
        // Mettre à jour les détails de la classe dans la base de données
        updateClass($conn, $classId, $className, $classDesc);

        $_SESSION['message'] = "Classe mise à jour";

        header('Location: ../views/listeClasse.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['erreur'] = "Une erreur s'est produite lors de la mise à jour de la classe";
        // Vous pouvez afficher ou enregistrer l'erreur complète pour le débogage : $e->getMessage()

        header('Location: ../modificationClasse.php?classId=' . $classId);
        exit();
    }
} else {
    $_SESSION['erreur'] = "Le formulaire est incomplet";
    header('Location: ../modificationClasse.php?classId=' . $classId);
    exit();
}
