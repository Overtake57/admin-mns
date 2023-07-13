<?php
include "../_protect.php";
$title = "Affichage des classes";
$link = "../../assets/style/adminClasses.css";

require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../includes/header.php";
require_once "../php/function.php";

if (!$conn) {
    echo "Erreur de connexion à la base de données.";
    exit();
}

if (isset($_GET['view'])) {
    $view = $_GET['view'];
} else {
    $view = 'current';
}

$classes = [];
if ($view === 'current') {
    $classes = getClasses($conn);
} else if ($view === 'archived') {
    $classes = getArchivedClasses($conn);
}

if ($classes === false) {
    echo "Erreur lors de la récupération des classes.";
    exit();
}
?>
<div id="container-eleves">
    <div>
        <li><button><a href="./ajoutClasse.php"> <i class="fa-solid fa-user-plus"></i></a></button></li>
        <a href="?view=current" class="btn btn-primary">Voir les classes actuelles</a>
        <a href="?view=archived" class="btn btn-secondary">Voir les classes archivées</a>
    </div>
</div>

<div id="container-main">
    <table class="tableau">
        <tr>
            <th>Classe</th>
            <th>Description</th>
            <th>Nombre d'élèves</th>
            <th>Action</th>
        </tr>
        <?php
if (count($classes) > 0) {
    $index = 0;
    foreach ($classes as $class) {
        echo "<tr>";
        echo "<td>" . $class["className"] . "</td>";
        echo "<td>" . $class["classDesc"] . "</td>";

        $classId = $class["classId"];
        $countQuery = $conn->prepare("SELECT COUNT(*) AS count FROM tbluser WHERE classId = :classId");
        $countQuery->bindValue(':classId', $classId, PDO::PARAM_INT);
        $countQuery->execute();
        $countResult = $countQuery->fetch(PDO::FETCH_ASSOC);
        $studentCount = $countResult["count"];

        echo "<td>" . $studentCount . "</td>";
        echo "<td>";
        echo '<a href="./modificationClasse.php?classId=' . $class["classId"] . '" class="button">Modifier</a>';
        echo "</td>";
        echo "</tr>";
        $index++;
    }
} else {
    echo "<tr><td>Aucune classe trouvée</td></tr>";
}
?>
    </table>
</div>


<script src="../../assets/javascript/script.js"></script>
</body>

</html>
