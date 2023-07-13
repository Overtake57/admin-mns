<?php
include "../_protect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

if (!$conn) {
    echo "Erreur de connexion à la base de données.";
    exit();
}

if (!isset($_GET['classId'])) {
    echo "ID de classe non spécifié.";
    exit();
}

$classId = $_GET['classId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteClasse'])) {
        archiveClass($conn, $classId);
        header("Location: listeClasse.php");
        exit();
    } else {
        $className = $_POST['className'];
        $classDesc = $_POST['classDesc'];
        updateClass($conn, $classId, $className, $classDesc);
        header("Location: listeClasse.php");
        exit();
    }
}

$class = getClassById($conn, $classId);

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
            <button type="submit" name="deleteClasse" id="deleteClasse">Archiver la classe</button>
        </div>
    </form>
</div>

</body>

</html>

<?php
$conn = null;
?>
