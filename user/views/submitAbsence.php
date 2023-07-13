<?php
include "../../connexion/connect.php";
include "../_protect.php";
$title = "Soumettre une absence";
$link = "../../assets/style/submitAbsence.css";
include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si la clé "user" existe dans la variable de session
    if (isset($_SESSION['user'])) {
        // Récupérer l'identifiant de l'utilisateur connecté
        $userId = $_SESSION['user']['userId'];
        $date = $_POST['date'];
        $motif = $_POST['motif'];

        // Gérer le fichier justificatif
        $nom = $_SESSION['user']['nom'];
        $prenom = $_SESSION['user']['prenom'];
        $folderName = $prenom . '_' . $nom;
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/admin/uploads/' . $folderName . '/';

        // Vérifier si le dossier existe déjà
        if (!is_dir($targetDir)) {
            // Créer le dossier
            if (!mkdir($targetDir, 0777, true)) {
                die('Impossible de créer le dossier de destination.');
            }
        }

        // Vérifier si un fichier a été téléchargé
        if (isset($_FILES['justificationFile']) && $_FILES['justificationFile']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['justificationFile']['name'];
            $fileTmpPath = $_FILES['justificationFile']['tmp_name'];

            // Vérifier si c'est un fichier PDF
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $mime = mime_content_type($fileTmpPath);

            if (strtolower($fileExtension) === 'pdf' && $mime === 'application/pdf') {
                // Nouveau nom de fichier avec l'ID de l'utilisateur
                $newFileName = $userId . '_' . uniqid() . '.' . $fileExtension;

                // Chemin du nouveau fichier avec le nouveau nom
                $newFilePath = $targetDir . $newFileName;

                // Déplacer le fichier téléchargé vers le dossier de destination
                if (move_uploaded_file($fileTmpPath, $newFilePath)) {
                    // Insertion des données dans la table
                    $query = "INSERT INTO tblabsent (userId, date, motif, justification) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$userId, $date, $motif, $newFilePath]);
                    echo 'Le fichier a été téléchargé et enregistré avec succès.';
                    header("Location: ./index.php"); // redirection
                    exit();
                } else {
                    echo 'Erreur lors du déplacement du fichier.';
                }
            } else {
                echo 'Le fichier doit être au format PDF.';
            }
        } else if (isset($_FILES['justificationFile']) && $_FILES['justificationFile']['error'] !== UPLOAD_ERR_NO_FILE) {
            echo 'Une erreur s\'est produite lors du téléchargement du fichier.';
        }
    } else {
        echo 'Les informations de session sont manquantes.';
    }
}

?>

<form action="submitAbsence.php" method="post" enctype="multipart/form-data">
    <label for="date">Date :</label><br>
    <input type="date" id="date" name="date"><br>

    <label for="motif">Motif :</label><br>
    <textarea id="motif" name="motif"></textarea><br>

    <label for="justificationFile">Justificatif (PDF) :</label><br>
    <input type="file" id="justificationFile" name="justificationFile" accept=".pdf"><br>

    <input type="submit" value="Soumettre l'absence">
</form>
