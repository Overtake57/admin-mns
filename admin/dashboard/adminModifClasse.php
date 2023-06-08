<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

// Vérifier si la connexion à la base de données est établie avec succès
if (!$conn) {
    echo "Erreur de connexion à la base de données.";
    exit();
}

// Vérifier si l'ID de classe est spécifié dans l'URL
if (!isset($_GET['classId'])) {
    echo "ID de classe non spécifié.";
    exit();
}

$classId = $_GET['classId'];

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $className = $_POST['className'];
    $classDesc = $_POST['classDesc'];

    // Appeler la fonction pour mettre à jour la classe dans la base de données
    updateClass($conn, $classId, $className, $classDesc);

    // Rediriger vers la page d'affichage des classes
    header("Location: adminClasse.php");
    exit();
}

// Récupérer les détails de la classe à partir de l'ID
$class = getClassById($conn, $classId);

// Vérifier si la classe existe
if (!$class) {
    echo "Classe non trouvée.";
    exit();
}

$title = "Modification d'une classe";
$link = "../../assets/style/adminAjoutClasse.css";
include "../includes/header.php";
?>

<div id="container-main">
    <form method="post" action="">
        <div class="form-group">
            <label for="className">Nom de la classe :</label>
            <input type="text" id="className" name="className" required value="<?php echo $class['className']; ?>" />
        </div>
        <div class="form-group">
            <label for="classDesc">Description :</label>
            <input type="text" id="classDesc" name="classDesc" required value="<?php echo $class['classDesc']; ?>" />
        </div>
        <div class="center-button">
            <button type="submit" id="button">Valider</button><br>
            <button type="submit" name="deleteClasse" id="deleteClasse">Supprimer la classe</button>
        </div>
    </form>
</div>

</body>

</html>

<?php
$conn = null;
?>
