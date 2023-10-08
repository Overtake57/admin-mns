<?php
include "../_protect.php";
$title = "Mes documents";
$link = "../../assets/style/userDocument.css";
include "../includes/header.php";

$disallowedRoles = array("admin", "super_admin");

if (!isset($_SESSION["user"]) || in_array($_SESSION["user"]["role"], $disallowedRoles)) {
    header("Location: ../index.php");
    exit();
}

require_once "../../admin/php/function.php";

// Vérifier si la clé "user" existe dans la variable de session
if (isset($_SESSION['user'])) {
    // Récupérer l'identifiant de l'utilisateur connecté
    $userId = $_SESSION['user']['userId'];

    // Récupérer les informations de l'utilisateur depuis la table "tbluser"
    $userData = getUserData($userId);

    if ($userData) {
        $prenom = $userData['prenom'];
        $nom = $userData['nom'];

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
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['file']['name'];
            $fileTmpPath = $_FILES['file']['tmp_name'];

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
                    // Enregistrement des informations dans la base de données
                    addDocument($newFileName, $newFilePath, $userId);

                    echo 'Le fichier a été téléchargé et enregistré avec succès.';
                } else {
                    echo 'Erreur lors du déplacement du fichier.';
                }
            } else {
                echo 'Le fichier doit être au format PDF.';
            }
        } else if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
            echo 'Une erreur s\'est produite lors du téléchargement du fichier.';
        }
    } else {
        echo 'Les informations de session sont incorrectes.';
    }
} else {
    echo 'Les informations de session sont manquantes.';
}

// Affichage HTML
echo '
<div id="container-main">
    <div id="container-1">
        <h2>Ajouter un document :</h2>
        <form action="' . $_SERVER['PHP_SELF'] . '" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" id="fileToUpload" accept=".pdf">
            <input type="submit" value="Envoyer" name="submit">
        </form>
    </div>

    <div id="container-2">
        <div>
            <table class="tableau">
                <h2>Mes documents :</h2>
                <tr>
                    <th>Date</th>
                    <th>Nom</th>
                </tr>';

// Requête pour récupérer les documents de l'utilisateur
$documents = getUserDocuments($userId);

foreach ($documents as $document) {
    echo "<tr>";
    echo "<td>" . $document["uploaded_at"] . "</td>";
    echo "<td>" . $document["filename"] . "</td>";
    echo "</tr>";
}
echo '
    <div id="margin">
        <table class="tableau">
            <h2>Absence à fournir :</h2>
            <tr>
                <th>Date</th>
                <th>Document</th>
                <th>Type</th>
            </tr>';

// Requête pour récupérer les documents demandés par l'administrateur
$requestedDocuments = getRequestedDocuments($userId);

foreach ($requestedDocuments as $document) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($document["requestedAt"]) . "</td>";
    echo "<td>" . htmlspecialchars($document["justificationDocument"]) . "</td>";
    echo "<td>" . htmlspecialchars($document["status"]) . "</td>";
    echo "</tr>";
}

echo '
        </table>
    </div>
</div>';

include "../includes/footer.php";
